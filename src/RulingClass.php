<?php

namespace RedirectRules;

use WP_User;

defined('ABSPATH') or die('No script kiddies please!');

class RulingClass
{

    private $fallback;

    public static function instance()
    {
        return new static;
    }

    public function fallback($url)
    {
        $this->fallback = $url;

        return $this;
    }

    public function afterLogin()
    {
        return $this->getRedirect('login');
    }

    public function afterLogout()
    {
        if (! $redirect = $this->getRedirect('logout')) {
            return;
        }
        wp_safe_redirect($redirect);
        die;
    }

    private function getRedirect($action)
    {
        if ($this->redirectToRequestedPage()) {
            return $_REQUEST['redirect_to'];
        }

        if ($redirect = $this->ruleForUserRole($action)) {
            return $redirect;
        }

        if ($this->globalUser() && $redirect = $this->defaultRule($action)) {
            return $redirect;
        }

        return $this->fallback;
    }

    private function redirectToRequestedPage()
    {
        return (isset($_REQUEST['redirect_to']) && admin_url() !== $_REQUEST['redirect_to']);
    }

    private function ruleForUserRole($action)
    {
        return ($user = $this->globalUser()) ? $this->findRule($action, current($user->roles)) : false;
    }

    private function globalUser()
    {
        global $user;

        return ($user instanceof WP_User) ? $user : null;
    }

    private function defaultRule($action)
    {
        return $this->findRule($action, 'default');
    }

    private function findRule($action, $role)
    {
        return get_option("redirect-rules-{$action}-{$role}");
    }

}