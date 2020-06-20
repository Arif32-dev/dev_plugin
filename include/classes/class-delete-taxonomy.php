<?php
define('WP_USE_THEMES', false);
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/wp-load.php';
if (!empty($_POST['id'])) {

    global $wpdb;
    $table = $wpdb->prefix . 'taxonomy_manager';
    $res = $wpdb->delete($table, array('id' => $_POST['id']));
    if ($res) {
        echo "success";
    } else {
        echo "failed";
    }

}
