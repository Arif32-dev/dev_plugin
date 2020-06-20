<?php

class CbFunctions
{
    public static function parentMenuPage()
    {
        include MAIN_PATH . '/include/HTML/main-menu.php';
    }

    public static function subMenuPage()
    {
        include MAIN_PATH . '/include/HTML/custom-post-type.php';
    }

    public static function taxonomy_Page()
    {
        include MAIN_PATH . '/include/HTML/taxonomy-page.php';
    }
    public static function google_map()
    {
        include MAIN_PATH . '/include/HTML/google-map.php';
    }
    public static function watermark()
    {
        include MAIN_PATH . '/include/HTML/watermark.php';
    }

    public static function addMetaBox()
    {
        global $post;
        $email_value = get_post_meta($post->ID, '_email_value_key', true);
        $phn_value = get_post_meta($post->ID, '_phn_value_key', true);
        ?>
<div>
    <strong>
        <label for="author_mail">Authon Email :</label>
    </strong>
    <br>
    <input type="email" value="<?php echo esc_attr($email_value) ?>" name="author_email" id="author_email">
</div>
<br>
<div>
    <strong>
        <label for="author_phn" id="author_meta">Authon phone :</label>
    </strong>
    <br>
    <input type="number" value="<?php echo esc_attr($phn_value) ?>" name="author_phn" id="author_phn">
</div>


<?php

    }

    public static function activationHook()
    {
        add_option('post_types');
        DB::db_create();
        DB::create_cpt_table();
        DB::create_tax_table();
        flush_rewrite_rules();
    }

    public static function deActivationHook()
    {
        flush_rewrite_rules();
    }

}