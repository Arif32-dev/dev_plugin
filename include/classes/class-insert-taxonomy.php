<?php define('WP_USE_THEMES', false);
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/wp-load.php';

if (isset($_POST['tax_name'])) {
    // global $wpdb;
    $table = $wpdb->prefix . 'taxonomy_manager';
    $tax_name = $_POST['tax_name'];
    $hierarchical = isset($_POST['hierarchical']) ? true : 0;
    $public = isset($_POST['public']) ? true : 0;

    $res = $wpdb->insert($table,
        array('tax_name' => $tax_name,
            'hierarchical' => $hierarchical,
            'public' => $public,
        ),
        array('%s',
            '%d',
            '%d',
        ));

    if ($res) {
        echo 'success';
    } else {
        echo 'failed';
    }
}
