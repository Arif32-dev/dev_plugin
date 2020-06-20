<link rel="stylesheet" href="<?php echo plugins_url('/dev_plugin/assets/Design/CSS/style.min.css') ?>">

<link rel="stylesheet" href="<?php echo plugins_url('/dev_plugin/assets/Design/CSS/dashboard_input.min.css') ?>">
<link rel="stylesheet" href="<?php echo plugins_url('/dev_plugin/assets/Design/CSS/table_dropdown.min.css') ?>">
<link rel="stylesheet" href="<?php echo plugins_url('/dev_plugin/assets/Design/CSS/pretext.min.css') ?>">
<div class="notice notice-success">
    <p>done</p>
</div>
<h1>CPT Manger</h1>
<?php

class CPT_Page extends Dashboard
{
    private $table;
    private $result;
    public function __construct()
    {
        global $wpdb;
        $this->table = $wpdb->prefix . 'cpt_table';
        $this->result = $wpdb->get_results("SELECT * FROM " . $this->table . " ");

        parent::__construct('Create CPT', 'Your CPT', 'Export CPT');
    }

    public function inner_html_sec1()
    {
        ?>

<div class="wrap">
    <form action="" method="post">
        <div class="input_sec">
            <label for="cpt_name">Custom Post Type Name:</label>
            <input type="text" name="cpt_name" required placeholder="eg: Products" />
        </div>
        <br>
        <div class="input_sec">
            <label for="cpt_s_name"> CPT Singular Name: </label>
            <input type="text" name="cpt_s_name" required placeholder="eg: Product" />
        </div>
        <br>
        <div class="input_sec">
            <label for="cpt_icon"> CPT DashIcon: </label>
            <input type="text" name="cpt_icon_name" placeholder="eg: dashicons-admin-plugins" />
        </div>
        <br>
        <div class="input_sec dropdown_sec">
            <div class="cpt_supports"> Custom Post Type Supports: </div>
            <div class="dropdown"> <input type="checkbox" id="checkbox-toggle"> <label for="checkbox-toggle">Supports</label>
                <ul>
                    <li> <span>Title</span> <input type="checkbox" name="title"> </li>
                    <li> <span>Editor</span> <input type="checkbox" name="editor"> </li>
                    <li> <span>Excerpt</span> <input type="checkbox" name="excerpt"> </li>
                    <li> <span>Thumbnail</span> <input type="checkbox" name="thumbnail"> </li>
                </ul>
            </div>
        </div> <br> <br> <br> <br> <?php submit_button('Create CPT');
        ?>
    </form>
</div>

<?php

    }

    public function inner_html_sec2()
    {

        ?><table>
    <tr>
        <th class="th" width=22%>CPT Name</th>
        <th class="th" width=22%>Singular Name</th>
        <th class="th" width=22%>DashIcon</th>
        <th class="th" width=11.33% id='drop_header'>Supports</th>
        <th class="th" width=11.33%>Update CPT</th>
        <th class="th" width=11.33%>Delete CPT</th>
    </tr>
    <?php

        foreach ($this->result as $cpt) {

            ?>
    <tr>
        <td colspan="1" class="td_inp"><input class="text_field " type="text" name="cpt_name" value="<?php echo $cpt->cpt_name ?>" /></td>
        <td colspan="1" class="td_inp"><input class="text_field " type="text" name="cpt_s_name" value="<?php echo $cpt->cpt_s_name ?>" /></td>
        <td colspan="1" class="td_inp"><input class="text_field" type="text" name="cpt_dashicon" value="<?php echo $cpt->cpt_dashicon ?>" /></td>
        <td id="drop_down">
            <div class="dropdown"><input type="checkbox" class="checkbox-toggle"><label for="checkbox-toggle">Supports</label>
                <ul>
                    <li><span>Title</span><input class="chk_data" <?php echo $cpt->cpt_title == 1 ? "checked" : "" ?> type="checkbox" name="title"> </li>
                    <li> <span>Editor</span> <input class="chk_data" <?php echo $cpt->cpt_editor == 1 ? "checked" : "" ?> type="checkbox" name="editor"> </li>
                    <li> <span>Excerpt</span> <input class="chk_data" <?php echo $cpt->cpt_excerpt == 1 ? "checked" : "" ?> type="checkbox" name="excerpt"> </li>
                    <li> <span>Thumbnail</span> <input class="chk_data" <?php echo $cpt->cpt_thumbnail == 1 ? "checked" : "" ?> type="checkbox" name="thumbnail"> </li>
                </ul>
            </div>
        </td>
        <td class='btn_td'><button type="submit" id="<?php echo $cpt->id ?>" class="button button2 update_btn">Update CPT</button></td>
        <td class='btn_td'><button type="submit" id="<?php echo $cpt->id ?>" class="button button3 delete_btn">Delete CPT</button></td>
    </tr>

    <?php

        }

        ?>

</table>

<?php

    }

    public function inner_html_sec3()
    {
        ?>

<?php

        if (!empty($this->result)) {
            foreach ($this->result as $cpt) {

                ?>

<div class="code_block">
    <h1><?php echo $cpt->cpt_name ?> Post Type</h1>
    <hr>
    <pre>
        add_action('init', function() {
                $labels=array(
                        'name'=> _x(<?php echo $cpt->cpt_name ?>, 'Post Type General Name', 'textdomain'),
                        'singular_name'=> _x(<?php echo $cpt->cpt_s_name ?>, ' Post Type Singular Name', 'textdomain'),
                        'menu_name'=> _x(<?php echo $cpt->cpt_name ?>, 'Admin Menu text', 'textdomain'),
                        'name_admin_bar'=> _x(<?php echo $cpt->cpt_name ?>, 'Add New on Toolbar', 'textdomain'),
                        'archives'=> __(' <?php echo $cpt->cpt_name ?>  Post Archives', 'textdomain'),
                        'attributes'=> __('<?php echo $cpt->cpt_name ?>  Post Attributes', 'textdomain'),
                        'parent_item_colon'=> __('Parent <?php echo $cpt->cpt_name ?>  Post:', 'textdomain'),
                        'all_items'=> __(All <?php echo $cpt->cpt_name ?> Posts', 'textdomain'),
                        'add_new_item'=> __('Add New <?php echo $cpt->cpt_name ?>  Post', 'textdomain'),
                        'add_new'=> __('Add New <?php echo $cpt->cpt_name ?>  '', 'textdomain'),
                        'new_item'=> __('New <?php echo $cpt->cpt_name ?>  Post', 'textdomain'),
                        'edit_item'=> __('Edit <?php echo $cpt->cpt_name ?>  Post', 'textdomain'),
                        'update_item'=> __('Update <?php echo $cpt->cpt_name ?>  Post', 'textdomain'),
                        'view_item'=> __('View <?php echo $cpt->cpt_name ?>  Post', 'textdomain'),
                        'view_items'=> __('View <?php echo $cpt->cpt_name ?>  Posts', 'textdomain'),
                        'search_items'=> __('Search <?php echo $cpt->cpt_name ?>  Post', 'textdomain'),
                        'not_found'=> __('<?php echo $cpt->cpt_name ?>  Not found', 'textdomain'),
                        'not_found_in_trash'=> __('Not found in Trash', 'textdomain'),
                        'featured_image'=> __('Featured Image', 'textdomain'),
                        'set_featured_image'=> __('Set featured image', 'textdomain'),
                        'remove_featured_image'=> __('Remove featured image', 'textdomain'),
                        'use_featured_image'=> __('Use as featured image', 'textdomain'),
                        'insert_into_item'=> __('Insert into <?php echo $cpt->cpt_name ?>  Post', 'textdomain'),
                        'uploaded_to_this_item'=> __('Uploaded to this <?php echo $cpt->cpt_name ?>  Post', 'textdomain'),
                        'items_list'=> __('<?php echo $cpt->cpt_name ?>  list', 'textdomain'),
                        'items_list_navigation'=> __('<?php echo $cpt->cpt_name ?>   list navigation', 'textdomain'),
                        'filter_items_list'=> __('Filter <?php echo $cpt->cpt_name ?>   list', 'textdomain'),
                );
                $args=array(
                        'label'=> __(<?php echo $cpt->cpt_name ?>, 'textdomain'),
                        'description'=> __('', 'textdomain'),
                        'labels'=> $labels,
                        'menu_icon'=> ''<?php echo $cpt->cpt_dashicon ?>'',
                        'supports'=> array(<?php echo $cpt->cpt_title == 1 ? ' "title",' : "" ?><?php echo $cpt->cpt_editor == 1 ? '"editor",' : "" ?><?php echo $cpt->cpt_excerpt == 1 ? '"excerpt",' : "" ?><?php echo $cpt->cpt_thumbnail == 1 ? '"thumbnail"' : "" ?>),
                        'taxonomies'=> array(),
                        'public'=> true,
                        'show_ui'=> true,
                        'show_in_menu'=> true,
                        'menu_position'=> 5,
                        'show_in_admin_bar'=> true,
                        'show_in_nav_menus'=> true,
                        'can_export'=> true,
                        'has_archive'=> true,
                        'hierarchical'=> false,
                        'exclude_from_search'=> false,
                        'show_in_rest'=> true,
                        'publicly_queryable'=> true,
                        'capability_type'=> 'post',
                );

            register_post_type(<?php echo $cpt->cpt_name ?>, $args);
            }
        );
</pre>
</div>

<?php

            }
        }

    }
}

new CPT_Page();
function add_all_cpt_type_to_option()
{
    $post_types = get_post_types(array('public' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'menu_position' => 5,
        'exclude_from_search' => false,
    ), 'names');

    $json_data = json_encode($post_types);
    update_option('post_types', $json_data);
}
add_all_cpt_type_to_option();

?>
<script id="scirpt" data-cpt-create="<?php echo plugins_url('/dev_plugin/include/classes/class-create-cpt.php') ?>" data-cpt-update="<?php echo plugins_url('/dev_plugin/include/classes/class-update-cpt.php') ?>" data-cpt-delete="<?php echo plugins_url('/dev_plugin/include/classes/class-delete-cpt.php') ?>" src="<?php echo plugins_url('/dev_plugin/assets/JS/cpt_manager.js') ?>">
</script>