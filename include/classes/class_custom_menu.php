<?php
class CustomMenu
{
    public $submenu;
    private $settings;
    public function __construct()
    {
        $this->arguments();
        $this->register_settings();
        add_action('admin_menu', array($this, 'addPage'));
        add_action('admin_menu', array($this, 'adminMenuRename'));
        add_action('admin_init', array($this, 'add_settings'));
    }

    public function arguments()
    {
        $submenu = array();
        // Push an array to $submenu variable to create an submenu page
        if (get_option('activate_cpt')) {

            array_push($submenu, array('parant_slug' => 'dev_plugin',
                'page_title' => 'CPT',
                'menu_title' => 'CPT Manger',
                'manage_options' => 'manage_options',
                'menu_slug' => 'cpt_manager',
                'cb_function' => function () {
                    CbFunctions::subMenuPage();
                },

            ));
        }

        if (get_option('activate_tax_manager')) {

            array_push($submenu, array('parant_slug' => 'dev_plugin',
                'page_title' => 'CPT Taxonomy',
                'menu_title' => 'Taxonomy Manger',
                'manage_options' => 'manage_options',
                'menu_slug' => 'taxonomy_manager',
                'cb_function' => function () {
                    CbFunctions::taxonomy_Page();
                },

            ));
        }

        if (get_option('activate_google_map')) {

            array_push($submenu, array('parant_slug' => 'dev_plugin',
                'page_title' => 'Google Map',
                'menu_title' => 'Google Map',
                'manage_options' => 'manage_options',
                'menu_slug' => 'google_map',
                'cb_function' => function () {
                    CbFunctions::google_map();
                },

            ));
        }
        if (get_option('watermark')) {

            array_push($submenu, array('parant_slug' => 'dev_plugin',
                'page_title' => 'Add Water Mark',
                'menu_title' => 'Add Water Mark',
                'manage_options' => 'manage_options',
                'menu_slug' => 'watermark',
                'cb_function' => function () {
                    CbFunctions::watermark();
                },

            ));
        }

        $this->submenu = $submenu;
    }

    public function addPage()
    {

        add_menu_page('Dev Plugin',
            'Dev Plugin',
            'manage_options',
            'dev_plugin',
            function () {
                CbFunctions::parentMenuPage();
            }

            ,
            'dashicons-plugins-checked',
            100);

        if (!empty($this->submenu)) {

            foreach ($this->submenu as $sub) {
                add_submenu_page($sub['parant_slug'],
                    $sub['page_title'],
                    $sub['menu_title'],
                    $sub['manage_options'],
                    $sub['menu_slug'],
                    $sub['cb_function'],
                );
            }
        }

    }

    public function adminMenuRename()
    {
        if (get_option('activate_cpt')) {

            global $submenu;
            $submenu['dev_plugin'][0][0] = 'DashBoard';
        }
    }
    public function register_settings()
    {
        $all_settings = array(
            array(
                'parent_option_group' => 'dev_options_group',
                'option_name' => 'activate_cpt',
            ),
            array(
                'parent_option_group' => 'dev_options_group',
                'option_name' => 'activate_tax_manager',
            ),
            array(
                'parent_option_group' => 'dev_options_group',
                'option_name' => 'activate_media_widget',
            ),
            array(
                'parent_option_group' => 'dev_options_group',
                'option_name' => 'activate_like_dislike',
            ),
            array(
                'parent_option_group' => 'dev_options_group',
                'option_name' => 'activate_google_map',
            ),
            array(
                'parent_option_group' => 'dev_options_group',
                'option_name' => 'theme_current_file',
            ),
            array(
                'parent_option_group' => 'dev_options_group',
                'option_name' => 'watermark',
            ),
            array(
                'parent_option_group' => 'map_options_group',
                'option_name' => 'map_location',
            ),
            array(
                'parent_option_group' => 'slider_options_group',
                'option_name' => 'range_slider_x_pos',
            ),
            array(
                'parent_option_group' => 'slider_options_group',
                'option_name' => 'range_slider_y_pos',
            ),
            array(
                'parent_option_group' => 'slider_options_group',
                'option_name' => 'water_image_id',
            ),

        );
        $this->settings = $all_settings;
    }
    public function add_settings()
    {
        foreach ($this->settings as $setting) {
            register_setting($setting['parent_option_group'], $setting['option_name']);
        }
        add_settings_section('dev_section_id', 'Features', "", 'dev_plugin');
        add_settings_section('map_sec_id', "", "", 'google_map');
        add_settings_section('range_sec_id', "", "", 'watermark');
        add_settings_field(
            'input_group_id',
            "",
            array($this, 'input_fields'),
            'dev_plugin',
            'dev_section_id'
        );
        add_settings_field(
            'map_group_id',
            "",
            array($this, 'map_fields'),
            'google_map',
            'map_sec_id'
        );
        add_settings_field(
            'range_group_id',
            "",
            array($this, 'range_fields'),
            'watermark',
            'range_sec_id'
        );

    }

    /**
     * @return input fields for watermark page
     */
    public function range_fields()
    {
        $x_pos_value = get_option('range_slider_x_pos') ? get_option('range_slider_x_pos') : 0;
        $y_pos_value = get_option('range_slider_y_pos') ? get_option('range_slider_y_pos') : 0;
        $image_id = get_option('water_image_id') ? get_option('water_image_id') : false;
        ?>
            <div class="slider_container">
                <input type="hidden" name="water_image_id" value="<?php echo $image_id ?>" id="water_image_id">
                <div class="slidecontainer">
                    <h3>
                    <label for="range">X-Positon: </label>
                    </h3>
                    <input type="range" name='range_slider_x_pos' min="1" max="100" value="<?php echo esc_attr($x_pos_value) ?>" class="slider" >
                </div>
                <div class="slidecontainer">
                    <h3>
                    <label for="range">Y-Positon: </label>
                    </h3>
                    <input type="range" name='range_slider_y_pos' min="1" max="100" value="<?php echo esc_attr($y_pos_value) ?>" class="slider">
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="dev_img_container">
                <?php

        if ($image_id) {

            $upload_dir = wp_upload_dir();

            $water_mark_file = isset(wp_get_attachment_metadata($image_id)['file']) ? wp_get_attachment_metadata($image_id)['file'] : false;
            if ($water_mark_file) {

                echo wp_get_attachment_image($image_id);
                // echo '<img src="' . $upload_dir['url'] . '/' . $water_mark_file . '" alt="" >';

            } else {
                return;
            }
        } else {
            return;
        }

        ?>

                <img src="<?php echo plugins_url('/dev_plugin/assets/images/water_image.jpg') ?>" width='400' height='300' alt="watermark">

            </div>

        <?php

    }
    public function map_fields()
    {
        $map_location = get_option('map_location');

        ?>
        <div class="input_sec" style='width: 50%; display: flex; justify-content: space-between'>
            <strong>
             <label for="map_location">Custom Post Type Name:</label>
            </strong>
            <input style='width: 200px;' type="text"
                name="map_location"
                placeholder="university of san francisco"
                value="<?php echo esc_attr($map_location) ?>" />
        </div>

        <?php

    }
    public function input_fields()
    {
        $active_cpt = get_option('activate_cpt') ? 'checked' : "";
        $activate_tax_manager = get_option('activate_tax_manager') ? 'checked' : "";
        $activate_media_widget = get_option('activate_media_widget') ? 'checked' : "";
        $activate_like_dislike = get_option('activate_like_dislike') ? 'checked' : "";
        $activate_google_map = get_option('activate_google_map') ? 'checked' : "";
        $theme_current_file = get_option('theme_current_file') ? 'checked' : "";
        $watermark = get_option('watermark') ? 'checked' : "";

        ?>
<div class="input_box">
    <h3>Activate CPT</h3>
    <div class="overlay"></div>
    <input class="animated_chk" type="checkbox" name="activate_cpt" <?php echo $active_cpt ?> />
    <label for="animated_chk">
        <div class="tick_mark"></div>
    </label>
</div>
<div class="input_box">
    <h3>Activate Taxonomy Manger</h3>
    <div class="overlay"></div>
    <input class="animated_chk" type="checkbox" name="activate_tax_manager" <?php echo $activate_tax_manager ?> />

    <label for="animated_chk">
        <div class="tick_mark"></div>
    </label>
</div>
<div class="input_box">
    <h3>Activate Media Widget</h3>
    <div class="overlay"></div>
    <input class="animated_chk" type="checkbox" name="activate_media_widget" <?php echo $activate_media_widget ?> />

    <label for="anactivate_media_widgetmated_chk">
        <div class="tick_mark"></div>
    </label>
</div>

<div class="input_box">
    <h3>Activate Like Dislike System</h3>
    <div class="overlay"></div>
    <input class="animated_chk" type="checkbox" name="activate_like_dislike" <?php echo $activate_like_dislike ?> />

    <label for="animated_chk">
        <div class="tick_mark"></div>
    </label>
</div>

<div class="input_box">
    <h3>Activate Google Map</h3>
    <div class="overlay"></div>
    <input class="animated_chk" type="checkbox" name="activate_google_map" <?php echo $activate_google_map ?> />

    <label for="animated_chk">
        <div class="tick_mark"></div>
    </label>
</div>

<div class="input_box">
    <h3>Show theme current file</h3>
    <div class="overlay"></div>
    <input class="animated_chk" type="checkbox" name="theme_current_file" <?php echo $theme_current_file ?> />

    <label for="animated_chk">
        <div class="tick_mark"></div>
    </label>
</div>
<div class="input_box">
    <h3>Activate Water Mark System</h3>
    <div class="overlay"></div>
    <input class="animated_chk" type="checkbox" name="watermark" <?php echo $watermark ?> />

    <label for="animated_chk">
        <div class="tick_mark"></div>
    </label>
</div>
<?php

    }
}

new CustomMenu();