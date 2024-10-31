<?php
/*
Plugin Name: Redirect Rules
Plugin URI: https://wordpress.org/plugins/redirect-rules/
Description: Redirect users on login/logout based on their role
Author: Nicky Woolf
Version: 1.2.2
Text Domain: redirect-rules
*/

defined('ABSPATH') or die('No script kiddies please!');

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/register/helpers.php';

require_once __DIR__ . '/register/hooks.php';