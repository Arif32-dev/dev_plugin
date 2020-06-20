<?php

class Create_Cpt
{
    private $table;
    private $result;
    public function __construct()
    {
        global $wpdb;
        $this->table = $wpdb->prefix . 'cpt_table';
        $this->result = $wpdb->get_results('SELECT * FROM ' . $this->table . '');
        add_action('init', array($this, 'create_cpt'));

    }
    public function create_cpt()
    {
        if (get_option('activate_cpt')) {

            if (!empty($this->result)) {

                foreach ($this->result as $cpt) {
                    $labels = array('name' => _x($cpt->cpt_name, 'Post Type General Name', 'textdomain'),
                        'singular_name' => _x($cpt->cpt_s_name, ' Post Type Singular Name', 'textdomain'),
                        'menu_name' => _x($cpt->cpt_name, 'Admin Menu text', 'textdomain'),
                        'name_admin_bar' => _x($cpt->cpt_name, 'Add New on Toolbar', 'textdomain'),
                        'archives' => __(' ' . $cpt->cpt_name . ' Post Archives', 'textdomain'),
                        'attributes' => __('' . $cpt->cpt_name . ' Post Attributes', 'textdomain'),
                        'parent_item_colon' => __('Parent ' . $cpt->cpt_name . ' Post:', 'textdomain'),
                        'all_items' => __(' All ' . $cpt->cpt_name . ' Posts', 'textdomain'),
                        'add_new_item' => __('Add New ' . $cpt->cpt_name . ' Post', 'textdomain'),
                        'add_new' => __('Add New ' . $cpt->cpt_name . '', 'textdomain'),
                        'new_item' => __('New ' . $cpt->cpt_name . ' Post', 'textdomain'),
                        'edit_item' => __('Edit ' . $cpt->cpt_name . ' Post', 'textdomain'),
                        'update_item' => __('Update ' . $cpt->cpt_name . ' Post', 'textdomain'),
                        'view_item' => __('View ' . $cpt->cpt_name . ' Post', 'textdomain'),
                        'view_items' => __('View ' . $cpt->cpt_name . ' Posts', 'textdomain'),
                        'search_items' => __('Search ' . $cpt->cpt_name . ' Post', 'textdomain'),
                        'not_found' => __('' . $cpt->cpt_name . ' Not found', 'textdomain'),
                        'not_found_in_trash' => __('Not found in Trash', 'textdomain'),
                        'featured_image' => __('Featured Image', 'textdomain'),
                        'set_featured_image' => __('Set featured image', 'textdomain'),
                        'remove_featured_image' => __('Remove featured image', 'textdomain'),
                        'use_featured_image' => __('Use as featured image', 'textdomain'),
                        'insert_into_item' => __('Insert into ' . $cpt->cpt_name . ' Post', 'textdomain'),
                        'uploaded_to_this_item' => __('Uploaded to this ' . $cpt->cpt_name . ' Post', 'textdomain'),
                        'items_list' => __('' . $cpt->cpt_name . ' list', 'textdomain'),
                        'items_list_navigation' => __('' . $cpt->cpt_name . '  list navigation', 'textdomain'),
                        'filter_items_list' => __('Filter ' . $cpt->cpt_name . '  list', 'textdomain'),
                    );
                    $args = array('label' => __($cpt->cpt_name, 'textdomain'),
                        'description' => __('', 'textdomain'),
                        'labels' => $labels,
                        'menu_icon' => '' . $cpt->cpt_dashicon . '',
                        'supports' => array($cpt->cpt_title == 1 ? 'title' : "",
                            $cpt->cpt_editor == 1 ? 'editor' : "",
                            $cpt->cpt_excerpt == 1 ? 'excerpt' : "",
                            $cpt->cpt_thumbnail == 1 ? 'thumbnail' : "",
                        ),
                        'taxonomies' => array(),
                        'public' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'menu_position' => 5,
                        'show_in_admin_bar' => true,
                        'show_in_nav_menus' => true,
                        'can_export' => true,
                        'has_archive' => true,
                        'hierarchical' => false,
                        'exclude_from_search' => false,
                        'show_in_rest' => true,
                        'publicly_queryable' => true,
                        'capability_type' => 'post',
                    );
                    register_post_type($cpt->cpt_s_name, $args);

                }

            }
        }

    }
}

new Create_Cpt();
