<?php
class Theme_current_file
{
    public function __construct()
    {
        add_action('admin_bar_menu', array($this, 'add_menu_item'), 1000);
    }
    public function add_menu_item()
    {
        global $wp_admin_bar, $template;
        $arr = explode('/', $template);
        $string = array_slice($arr, 2);
        $current_file = implode('->', $string);
        $wp_admin_bar->add_menu(
            array(
                'id' => 'dev_theme_file',
                'title' => $current_file,
            )
        );
    }

}
if (get_option('theme_current_file')) {

    new Theme_current_file();
} else {
    return;
}
