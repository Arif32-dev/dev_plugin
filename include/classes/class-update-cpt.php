<?php define('WP_USE_THEMES', false);
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/wp-load.php';

global $wpdb;
$table = $wpdb->prefix . 'cpt_table';

$response = $wpdb->update($table,
    array('cpt_name' => $_POST['cpt_name'],
        'cpt_s_name' => $_POST['cpt_s_name'],
        'cpt_dashicon' => $_POST['cpt_dashicon'],
        'cpt_title' => $_POST['cpt_title'],
        'cpt_excerpt' => $_POST['cpt_excerpt'],
        'cpt_editor' => $_POST['cpt_editor'],
        'cpt_thumbnail' => $_POST['cpt_thumbnail']),
    array('id' => $_POST['id']), array('%s',
        '%s',
        '%s',
        '%d',
        '%d',
        '%d',
        '%d',
    ));

if ($response) {
    echo 1;
} else {
    echo 0;
}
