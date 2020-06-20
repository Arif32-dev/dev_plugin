<?php
define('WP_USE_THEMES', false);
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/wp-load.php';
if (isset($_REQUEST['cpt_name'])
    && isset($_REQUEST['cpt_s_name'])
) {

    global $wpdb;
    $table = $wpdb->prefix . 'cpt_table';
    $cpt_name = $_REQUEST['cpt_name'];
    $cpt_s_name = $_REQUEST['cpt_s_name'];
    $cpt_dashicon = $_REQUEST['cpt_icon_name'];
    $cpt_title = isset($_REQUEST['title']) ? true : 0;
    $cpt_excerpt = isset($_REQUEST['excerpt']) ? true : 0;
    $cpt_editor = isset($_REQUEST['editor']) ? true : 0;
    $cpt_thumbnail = isset($_REQUEST['thumbnail']) ? true : 0;
    $prefix = $wpdb->prefix;

    $res = $wpdb->insert($table, array(
        'cpt_name' => $cpt_name,
        'cpt_s_name' => $cpt_s_name,
        'cpt_dashicon' => $cpt_dashicon,
        'cpt_title' => $cpt_title,
        'cpt_excerpt' => $cpt_excerpt,
        'cpt_editor' => $cpt_editor,
        'cpt_thumbnail' => $cpt_thumbnail,
    ), array(
        '%s',
        '%s',
        '%s',
        '%d',
        '%d',
        '%d',
        '%d',
    ));
    if ($res) {
        echo 'success';
    } else {
        echo 'failed';
    }
}
