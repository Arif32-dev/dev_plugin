<?php
class EnqueueScripts
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scirpts'));
        add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scirpts'));
    }

    public function enqueue_scirpts()
    {
        // wp_enqueue_style('plugin_style', plugins_url('/dev_plugin/assets/CSS/style.css'));
        // this file is not included here beacuse it will confilts with other css file
        // check every individual page that have its own css link reference
        wp_enqueue_script('plugin_js', plugins_url('/dev_plugin/assets/JS/scirpt.js'), array('jquery'), microtime(), true);
        wp_enqueue_script('dev_media_uploader', plugins_url('/dev_plugin/assets/JS/media_uploader.js'), array('jquery'), microtime(), true);
    }
    public function wp_enqueue_scirpts()
    {
        wp_enqueue_style('social_style', plugins_url('/dev_plugin/assets/Design/CSS/social.min.css'));

        wp_enqueue_script('fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js', array('jquery'), microtime(), true);
        wp_enqueue_script('like_fun', plugins_url('/dev_plugin/assets/JS/like.js'), array('jquery'), microtime(), true);
        wp_localize_script('like_fun', 'page_url', array(
            'url' => plugins_url('/dev_plugin/include/classes/create_like_dislike.php'),
        ));
    }
}
new EnqueueScripts();
