<link rel="stylesheet" href="<?php echo plugins_url('/dev_plugin/assets/Design/CSS/style.min.css') ?>">
<link rel="stylesheet" href="<?php echo plugins_url('/dev_plugin/assets/Design/CSS/pretext.min.css') ?>">
<link rel="stylesheet" href="<?php echo plugins_url('/dev_plugin/assets/Design/CSS/table_dropdown.min.css') ?>">
<link rel="stylesheet" href="<?php echo plugins_url('/dev_plugin/assets/Design/CSS/ios_toggle.min.css') ?>">

<div class="notice notice-success">
    <p>done</p>
</div>

<h1>Taxonomy Manger</h1>

<?php
class Taxonomy_page extends Dashboard
{
    // all properties defiend here
    private $table;
    private $result;
    public function __construct()
    {
        global $wpdb;
        $this->table = $wpdb->prefix . 'taxonomy_manager';
        $this->result = $wpdb->get_results(" SELECT * FROM " . $this->table . "");

        parent::__construct('Create Taxonomy', 'Your Taxonomies', 'Export Taxonomies');
    }
    public function inner_html_sec1()
    {
        ?>
            <div class="wrap">
                <form action="" method="post">
                    <div class="input_sec">
                        <label for="tax_name">
                            Custom Taxonomy Name :
                        </label>
                        <input type="text" name="tax_name" required placeholder="eg: News" />
                    </div>
                    <br>
                    <div class="input_sec align ios_toggle">
                        <label for="cpt_s_name">
                            Hierarchical:
                        </label>

                        <label class="check-1">
                            <input type="checkbox" name="hierarchical" />
                            <div class="inner"></div>
                            <div class="bullet"></div>
                        </label>
                    </div>
                    <br>
                    <div class="input_sec align ios_toggle">
                        <label for="cpt_icon">
                            Show in Public :
                        </label>
                        <label class="check-1">
                            <input type="checkbox" name="public" />
                            <div class="inner"></div>
                            <div class="bullet"></div>
                        </label>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <?php submit_button('Create Taxonomy');?>
                </form>
            </div>
        <?php

    }
    public function inner_html_sec2()
    {
        ?>
            <table>
                <tr>
                    <th class="th">Taxonomy Name</th>
                    <th class="th">Hierarchical</th>
                    <th class="th">Show in Public</th>
                    <th class="th">Update Taxonomy</th>
                    <th class="th">Delete Taxonomy</th>
                </tr>
                <?php

        if (!empty($this->result)) {
            foreach ($this->result as $tax) {
                ?>
                <tr>
                    <td colspan="1" class="td_inp">
                        <input value="<?php echo $tax->tax_name ?>" required class="text_field" type="text" name="tax_name" />
                    </td>
                    <td class="table_checkbox">
                        <label class="check-1">
                            <input <?php echo $tax->hierarchical == 1 ? "checked" : "" ?> type="checkbox" name="hierarchical" />
                            <div class="inner"></div>
                            <div class="bullet"></div>
                        </label>
                    </td>
                    <td class="table_checkbox">
                        <label class="check-1">
                            <input <?php echo $tax->public == 1 ? "checked" : "" ?> type="checkbox" name="public" />
                            <div class="inner"></div>
                            <div class="bullet"></div>
                        </label>
                    </td>
                    <td class='btn_td'><button id="<?php echo $tax->id ?>" class="button button2 update_btn">Update Taxonomy</button></td>
                    <td class='btn_td'><button id="<?php echo $tax->id ?>" class="button button3 delete_btn">Delete Taxonomy</button></td>
                </tr>
                <?php

            }
        }
        ?>
            </table>
        <?php

    }
    public function inner_html_sec3()
    {

        if (!empty($this->result)) {
            foreach ($this->result as $tax) {
                ?>
            <div class="code_block">
                <h1><?php echo $tax->tax_name ?> Taxonomy</h1>
                <hr>
                <pre>
            add_action('init', function() {
                    $labels=array(
                            'name'=> __('<?php echo $tax->tax_name ?>'),
                            'singular_name'=> __('<?php echo $tax->tax_name ?>'),
                            'search_items'=> __('Search '.'<?php echo $tax->tax_name ?>'.' Categories'),
                            'popular_items'=> null,
                            'all_items'=> __('All '. '<?php echo $tax->tax_name ?>' .' Categories'),
                            'edit_item'=> __('Edit '. '<?php echo $tax->tax_name ?>' .' Category'),
                            'update_item'=> __('Update '. '<?php echo $tax->tax_name ?>' .' Category'),
                            'add_new_item'=> __('Add New '. '<?php echo $tax->tax_name ?>' .' Category'),
                            'new_item_name'=> __('New '. '<?php echo $tax->tax_name ?>' .' Category Name'),
                            'separate_items_with_commas'=> null,
                            'add_or_remove_items'=> null,
                            'choose_from_most_used'=> null,
                            'back_to_items'=> __('Back to News Categories'),
                    );
                    $args=array(
                            'labels'=> $labels,
                            'description'=>(''),
                            'hierarchical'=> <?php echo $tax->hierarchical == 1 ? 'true' : 'false' ?>,
                            'public'=> <?php echo $tax->public == 1 ? 'true' : 'false' ?>,
                            'publicly_queryable'=> true,
                            'show_ui'=> true,
                            'show_in_menu'=> true,
                            'show_in_nav_menus'=> true,
                            'show_tagcloud'=> true,
                            'show_in_quick_edit'=> true,
                            'show_admin_column'=> false,
                            'show_in_rest'=> true,
                    );
                register_taxonomy('<?php echo $tax->tax_name; ?>', array('post'), $args);
            };
        );
    </pre>
</div>
            <?php

            }
        }
    }
}
new Taxonomy_page();

?>
<script
    id="scirpt"
    src="<?php echo plugins_url('/dev_plugin/assets/JS/taxonomy_manager.js') ?>"
    data-create-tax = <?php echo plugins_url('/dev_plugin/include/classes/class-insert-taxonomy.php'); ?>
    data-update-tax = <?php echo plugins_url('/dev_plugin/include/classes/class-update-taxonomy.php') ?>
    data-delete-tax = <?php echo plugins_url('/dev_plugin/include/classes/class-delete-taxonomy.php') ?>
    >
</script>
<script>

</script>