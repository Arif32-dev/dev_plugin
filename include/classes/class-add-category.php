<?php // Register Taxonomy News

if (get_option('activate_tax_manager')) {

    add_action('init', function () {
        global $wpdb;
        $table = $wpdb->prefix . 'taxonomy_manager';
        $result = $wpdb->get_results('SELECT * FROM ' . $table . '');

        if (!empty($result)) {
            foreach ($result as $tax) {
                $labels = array('name' => __($tax->tax_name),
                    'singular_name' => __($tax->tax_name),
                    'search_items' => __('Search ' . $tax->tax_name . ' Categories'),
                    'popular_items' => null,
                    'all_items' => __('All ' . $tax->tax_name . ' Categories'),
                    'edit_item' => __('Edit ' . $tax->tax_name . ' Category'),
                    'update_item' => __('Update ' . $tax->tax_name . ' Category'),
                    'add_new_item' => __('Add New ' . $tax->tax_name . ' Category'),
                    'new_item_name' => __('New ' . $tax->tax_name . ' Category Name'),
                    'separate_items_with_commas' => null,
                    'add_or_remove_items' => null,
                    'choose_from_most_used' => null,
                    'back_to_items' => __('&larr; Back to News Categories'),
                );
                $args = array('labels' => $labels,
                    'description' => (''),
                    'hierarchical' => $tax->hierarchical == 1 ? true : false,
                    'public' => $tax->public == 1 ? true : false,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_nav_menus' => true,
                    'show_tagcloud' => true,
                    'show_in_quick_edit' => true,
                    'show_admin_column' => false,
                    'show_in_rest' => true,
                );
                register_taxonomy($tax->tax_name,
                    get_post_types(array('public' => true,
                        'capability_type' => 'post',
                        'show_in_rest' => true,
                        'menu_position' => 5,
                        'exclude_from_search' => false,
                    ), 'names'),
                    $args);
            }
        }
    }
    );

}
