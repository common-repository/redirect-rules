<?php

defined('ABSPATH') or die('No script kiddies please!');

$callback = new \RedirectRules\HookCallbacks();

register_uninstall_hook(\redirect_rules\plugin_file(), array('\RedirectRules\HookCallbacks', 'uninstall'));

register_activation_hook(\redirect_rules\plugin_file(), array($callback, 'activate'));

add_action(\redirect_rules\plugin_action_links(), array($callback, 'actionLinks'));

add_action('admin_menu', array($callback, 'addOptionsPage'));

add_action('admin_init', array($callback, 'registerSettings'));

add_filter('login_redirect', array($callback, 'afterLoginUrl'));

add_action('wp_logout', array($callback, 'redirectAfterLogout'));

add_action(\redirect_rules\roles_option_updated(), array($callback, 'removeOrphanedOptions'), 10, 2);