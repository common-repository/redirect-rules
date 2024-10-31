<?php

namespace redirect_rules;

defined('ABSPATH') or die('No script kiddies please!');

function plugin_file()
{
    return dirname(__DIR__) . '/redirect-rules.php';
}

function plugin_action_links()
{
    return 'plugin_action_links_' . plugin_basename(plugin_file());
}

function roles_option_updated()
{
    return 'update_option_' . wp_roles()->role_key;
}

function settings_page_url()
{
    return admin_url() . 'options-general.php?page=redirect-rules';
}