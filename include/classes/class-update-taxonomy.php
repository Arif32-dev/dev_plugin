<?php define('WP_USE_THEMES', false);
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/wp-load.php';

global $wpdb;
$table = $wpdb->prefix . 'taxonomy_manager';

$response = $wpdb->update($table,
    array('tax_name' => $_POST['tax_name'],
        'hierarchical' => $_POST['hierarchical'],
        'public' => $_POST['public'],
    ), array('id' => $_POST['id']),
    array('%s',
        '%d',
        '%d',
    ));

if ($response) {
    echo 1;
} else {
    echo 0;
}
