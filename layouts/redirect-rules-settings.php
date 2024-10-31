<?php

defined('ABSPATH') or die('No script kiddies please!');

?>
<div class="wrap">

    <h2><?php _e('Redirect Rules Settings', 'redirect-rules'); ?></h2>

    <form method="post" action="options.php">

        <?php settings_fields('redirect-rules'); ?>

        <h3><?php _e('Login Redirect Rules', 'redirect-rules'); ?></h3>

        <table class="form-table">
            <tr>
                <th><?php _e('Default (URL)', 'redirect-rules'); ?></th>
                <td>
                    <input type="text"
                           name="redirect-rules-login-default"
                           class="regular-text"
                           value="<?php echo esc_attr(get_option('redirect-rules-login-default')); ?>"/>
                </td>
            </tr>
            <?php foreach ($roles as $role => $name) : ?>
                <tr>
                    <th><?php printf(__('%s (URL)'), $name); ?></th>
                    <td>
                        <input type="text"
                               name="redirect-rules-login-<?php echo $role; ?>"
                               class="regular-text"
                               value="<?php echo esc_attr(get_option('redirect-rules-login-'.$role)); ?>"/>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3><?php _e('Logout Redirect Rules', 'redirect-rules'); ?></h3>

        <table class="form-table">
            <tr>
                <th><?php _e('Default (URL)', 'redirect-rules'); ?></th>
                <td>
                    <input type="text"
                           name="redirect-rules-logout-default"
                           class="regular-text"
                           value="<?php echo esc_attr(get_option('redirect-rules-logout-default')); ?>"/>
                </td>
            </tr>
            <?php foreach ($roles as $role => $name) : ?>
                <tr>
                    <th><?php printf(__('%s (URL)'), $name); ?></th>
                    <td>
                        <input type="text"
                               name="redirect-rules-logout-<?php echo $role; ?>"
                               class="regular-text"
                               value="<?php echo esc_attr(get_option('redirect-rules-logout-'.$role)); ?>"/>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php submit_button(__('Save Rules', 'redirect-rules')); ?>

    </form>
</div>