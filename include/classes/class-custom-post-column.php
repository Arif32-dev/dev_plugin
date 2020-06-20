<?php
class Custom_colum
{
    public function __construct()
    {
        $post_types = get_option('post_types');
        $decode_post_types = json_decode($post_types);

        foreach ($decode_post_types as $post_type) {

            add_action("manage_" . $post_type . "_posts_columns", array($this, 'custom_column'));
            add_action("manage_" . $post_type . "_posts_custom_column", array($this, 'add_data_to_columns'), 10, 2);
            add_filter('manage_edit-' . $post_type . '_sortable_columns', array($this, 'sort_custom_column'));
        }
    }
    public function custom_column($columns)
    {
        $this->data = $columns;
        $date = $columns['date'];
        unset($columns['date']);
        $columns['author_mail'] = "<strong>Author Mail</strong>";
        $columns['author_phn'] = "<strong>Author Phone</strong>";
        $columns['date'] = $date;
        return $columns;

    }
    public function add_data_to_columns($column, $post_id)
    {
        $email_value = get_post_meta($post_id, '_email_value_key', true);
        $phn_value = get_post_meta($post_id, '_phn_value_key', true);
        switch ($column) {
            case 'author_mail':
                echo $email_value;
                break;

            case 'author_phn':
                echo $phn_value;
                break;
        }
    }
    public function sort_custom_column($column)
    {
        $column['author_mail'] = 'Author Mail';
        $column['author_phn'] = 'Author Phone';
        return $column;
    }
}
new Custom_colum();
