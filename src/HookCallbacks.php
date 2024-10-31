<?php

namespace RedirectRules;

defined('ABSPATH') or die('No script kiddies please!');

class HookCallbacks
{

    public function activate()
    {
        $administratorLoginRule = 'redirect-rules-login-administrator';

        if (Option::inDatabase()->get($administratorLoginRule)) {
            return;
        }

        return Option::inDatabase()->update($administratorLoginRule, \redirect_rules\settings_page_url());
    }

    public static function uninstall()
    {
        $option = Option::inDatabase();
        foreach (wp_roles()->role_names as $role => $name) {
            $option->delete('redirect-rules-login-' . $role);
            $option->delete('redirect-rules-logout-' . $role);
        }
    }

    public function actionLinks($links)
    {
        $links[] = '<a href="' . \redirect_rules\settings_page_url() . '">' . __('Settings', 'redirect-rules') . '</a>';

        return $links;
    }

    public function addOptionsPage()
    {
        return add_options_page(
            __('Redirect Rules Settings', 'redirect-rules'),
            __('Redirect Rules', 'redirect-rules'),
            'manage_options',
            'redirect-rules',
            function () {
                $roles = wp_roles()->role_names;
                include_once __DIR__ . '/../layouts/redirect-rules-settings.php';
            }
        );
    }

    public function registerSettings()
    {
        register_setting('redirect-rules', 'redirect-rules-login-default');
        register_setting('redirect-rules', 'redirect-rules-logout-default');

        foreach (wp_roles()->role_names as $role => $name) {
            register_setting('redirect-rules', 'redirect-rules-login-' . $role);
            register_setting('redirect-rules', 'redirect-rules-logout-' . $role);
        }
    }

    public function afterLoginUrl($redirect)
    {
        return RulingClass::instance()->fallback($redirect)->afterLogin();
    }

    public function redirectAfterLogout()
    {
        RulingClass::instance()->afterLogout();
    }

    public function removeOrphanedOptions($old, $new)
    {
        if (count($new) >= count($old)) {
            return;
        }

        $orphaned = array_diff(array_keys($old), array_keys($new));
        $option = Option::inDatabase();
        foreach ($orphaned as $role) {
            $option->delete('redirect-rules-login-' . $role);
            $option->delete('redirect-rules-logout-' . $role);
        }
    }
}