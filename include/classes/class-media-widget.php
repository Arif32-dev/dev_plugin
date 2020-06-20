<?php
// Adds widget: Dev Plugin Widget

class Devpluginwidget_Widget extends WP_Widget
{
    private $widget_fields = array(
        array(
            'label' => 'Image Link',
            'id' => 'image_uploader',
            'type' => 'text',
            'place_holder' => "Click upload button/put a image link with http or https",
            'class' => 'img_link',
        ),

    );

    public function __construct()
    {
        parent::__construct(
            'devpluginwidget_widget',
            esc_html__('Dev Plugin Widget', 'dev_plugin'),
            array('description' => esc_html__('A widget that enhance theme functionality', 'dev_plugin')) // Args
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo '<h2>' . $instance['title'] . '</h2>';
        if ($instance['image_uploader']) {
            ?>
            <img src="<?php echo $instance['image_uploader'] ?>" height="300px" width="300px" alt="dev_image from widget">
            <?php
}
        echo $args['after_widget'];

    }

    public function field_generator($instance)
    {
        $output = '';
        if (!empty($this->widget_fields)) {
            foreach ($this->widget_fields as $widget_field) {
                $widget_value = !empty($instance[$widget_field['id']]) ? $instance[$widget_field['id']] : esc_html__("", 'dev_plugin');

                $output .= '<p>';
                $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'dev_plugin') . ':</label> ';
                $output .= '<input placeholder="' . $widget_field['place_holder'] . '"
                 class="widefat ' . $widget_field['class'] . '" id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" type="' . $widget_field['type'] . '" value="' . esc_attr($widget_value) . '">';
                $output .= '</p>';

            }
        }
        echo $output;
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('', 'dev_plugin');
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'dev_plugin');?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>
            <?php
$this->field_generator($instance);
        ?>

        <p>
        <button class="media_uploader_btn" type="button">Upload Image to Image Link</button>
        </p>

		<?php
}

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        if (!empty($this->widget_fields)) {
            foreach ($this->widget_fields as $widget_field) {
                if (array_key_exists('class', $widget_field)) {

                    $instance[$widget_field['id']] = $new_instance[$widget_field['id']];
                } else {
                    $instance[$widget_field['id']] = !empty($new_instance[$widget_field['id']]) ? strip_tags($new_instance[$widget_field['id']]) : '';
                }

            }
            return $instance;
        }
    }
}

function register_devpluginwidget_widget()
{
    if (get_option('activate_media_widget')) {
        if (get_option('activate_media_widget')) {

            register_widget('Devpluginwidget_Widget');
        } else {
            return;
        }
    }
}
add_action('widgets_init', 'register_devpluginwidget_widget');
// print_r(get_option('activate_media_widget'));
// die();