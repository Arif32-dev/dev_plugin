<?php
defined('ABSPATH') || die('plugin unistalled');
include plugin_dir_path(__FILE__) . '/include/classes/class-db.php';

DB::db_delete();
DB::delete_cpt_table();
DB::delete_tax_table();
delete_option('activate_cpt');
delete_option('activate_tax_manager');
delete_option('activate_media_widget');
delete_option('activate_like_dislike');
delete_option('activate_google_map');
delete_option('map_location');
delete_option('post_types');
$settings = array(
    array(
        'parent_option_group' => 'dev_options_group',
        'option_name' => 'activate_cpt',
    ),
    array(
        'parent_option_group' => 'dev_options_group',
        'option_name' => 'activate_tax_manager',
    ),
    array(
        'parent_option_group' => 'dev_options_group',
        'option_name' => 'activate_media_widget',
    ),
    array(
        'parent_option_group' => 'dev_options_group',
        'option_name' => 'activate_like_dislike',
    ),
    array(
        'parent_option_group' => 'dev_options_group',
        'option_name' => 'activate_google_map',
    ),
    array(
        'parent_option_group' => 'map_options_group',
        'option_name' => 'map_location',
    ),
);
foreach ($settings as $setting) {
    unregister_setting($setting['parent_option_group'], $setting['option_name']);
}
