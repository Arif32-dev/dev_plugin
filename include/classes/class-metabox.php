<?php
class MetaBox
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'metabox'));
        add_action('save_post', array($this, 'save_meta_box'));

    }

    public function metabox()
    {
        add_meta_box(
            'author_meta',
            'Author Info',
            function () {
                CBFunctions::addMetaBox();
            },
            get_post_types(array('public' => true,
                'capability_type' => 'post',
                'show_in_rest' => true,
                'menu_position' => 5,
                'exclude_from_search' => false,
            ), 'names'),
            'side',
            'high',
        );
    }
    public function save_meta_box($post_id)
    {

        if (!array_key_exists('author_email', $_POST)) {
            return;
        }
        update_post_meta($post_id, '_email_value_key', $_POST['author_email']);
        if (!array_key_exists('author_phn', $_POST)) {
            return;
        }
        update_post_meta($post_id, '_phn_value_key', $_POST['author_phn']);
    }
}
new MetaBox();
