<?php

namespace RedirectRules;

defined('ABSPATH') or die('No script kiddies please!');

class Option
{

    public static function inDatabase()
    {
        return new static;
    }

    public function get($option, $default = false)
    {
        return get_option($option, $default);
    }

    public function update($option, $value, $autoload = null)
    {
        return update_option($option, $value, $autoload);
    }

    public function delete($option)
    {
        return delete_option($option);
    }
}