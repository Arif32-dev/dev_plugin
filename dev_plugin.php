<?php
/**
 * Dev Plugin
 * @wordpress-plugin
 * Plugin Name:       Dev Plugin
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Description of the plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Your Name
 * Author URI:        https://example.com
 * Text Domain:       plugin-slug
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (!defined('ABSPATH')) {
    die('Sorry you cant access this plugin');
}
define('MAIN_PATH', plugin_dir_path(__FILE__));
class DEV
{

    // class initializar
    public function __construct()
    {

        $this->including_class();
        $this->hooks_call();
    }

    public function hooks_call()
    {
        register_activation_hook(__FILE__, function () {
            CbFunctions::activationHook();
        });
        register_deactivation_hook(__FILE__, function () {
            CbFunctions::deActivationHook();
        });
    }

    public function including_class()
    {
        include MAIN_PATH . '/include/classes/class-enqueue-scripts.php';
        include MAIN_PATH . '/include/functions/class_cb.php';
        include MAIN_PATH . '/include/classes/class-db.php';
        include MAIN_PATH . '/include/classes/class_custom_menu.php';
        include MAIN_PATH . '/include/classes/class-custom-post-type.php';
        include MAIN_PATH . '/include/classes/class-metabox.php';
        include MAIN_PATH . '/include/classes/class-add-category.php';
        include MAIN_PATH . '/include/classes/class-media-widget.php';
        include MAIN_PATH . '/include/classes/dashborad-tab.php';
        include MAIN_PATH . '/include/classes/class-custom-post-column.php';
        include MAIN_PATH . '/include/classes/class-social.php';
        include MAIN_PATH . '/include/classes/class-shortcodes.php';
        include MAIN_PATH . '/include/classes/class-show-theme-current-file.php';
        include MAIN_PATH . 'include/classes/class-watermark.php';

    }

}
new DEV();
