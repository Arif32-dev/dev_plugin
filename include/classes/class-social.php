<?php

class Social
{
    private $table;
    private $result;
    public function __construct()
    {
        global $wpdb;
        $this->table = $wpdb->prefix . 'like_dislike_sys';
        add_filter('the_content', array($this, 'add_like_dislike'));

    }
    public function add_like_dislike($content)
    {

        $login_status;
        if (is_user_logged_in()) {
            $login_status = "logged_in";
        } else {
            $login_status = "logged_out";
        }
        $user_id = get_current_user_id();
        $post_id = get_the_ID();
        $current_time = current_time('Y-m-d h:i:s');

        // Database Functionality
        $like_exists;

        if ($this->user_exists($post_id, $user_id, 'like_count')) {
            $like_exists = 'liked';
        } else {
            $like_exists = "";
        }
        $dislike_exists;

        if ($this->user_exists($post_id, $user_id, 'dislike_count')) {
            $dislike_exists = 'disliked';
        } else {
            $dislike_exists = "";
        }

        $content_body = $content;
        $content_body .=
        "
            <span class='login_alert'>Please login or register</span>
    <div id='container_main'>
        <div class='like_container'>
            <div class='social_container'>
                <div class='social_sharing'>
                    <a target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=" . get_permalink($post_id, true) . " '>
                        <i class='fab fa-facebook-f s_icon'></i>
                    </a>
                    <a target='_blank' href='https://twitter.com/share?url=" . get_permalink($post_id, true) . "'>
                        <i class='fab fa-twitter s_icon'></i>
                    </a>
                    <a target='_blank' href='https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink($post_id, true) . " '>
                        <i class='fab fa-linkedin-in s_icon'></i>
                    </a>
                </div>
            </div>
            <span
                data-action='like'
                data-current_time = '" . $current_time . "'
                data-post_id = ' " . $post_id . "'
                data-user_id=' " . $user_id . " '
                data-user_status=' " . $login_status . "'
                 class='bottom_sec bottom_like  " . $like_exists . " '>
                    <i class='fas fa-thumbs-up'></i>
                    <span class='like_icon'>" . $this->totals('like_count', $post_id) . "</span>
            </span>

        </div>
        <div class='dislike_container'>
            <span
                data-action='dislike'
                data-current_time = '" . $current_time . "'
                data-post_id = ' " . $post_id . "'
                data-user_id=' " . $user_id . " '
                data-user_status=' " . $login_status . "  '
                 class='bottom_sec bottom_dislike " . $dislike_exists . "'>
                    <i class='fas fa-thumbs-down'></i>
                    <span class='dislike_icon'>" . $this->totals('dislike_count', $post_id) . "</span>
            </span>
        </div>
    </div>";
        ?>


<?php

        if (is_home()) {
            return $content_body;
        } else {
            return $content;
        }

    }

    public function totals($param, $post_id)
    {
        global $wpdb;

        $this->result = $wpdb->get_results(
            "SELECT SUM($param)
             as total_like FROM " . $this->table . "
              WHERE post_id = " . $post_id . ""
        );
        if ($this->result[0]->total_like) {
            return $this->result[0]->total_like;
        } else {
            return 0;
        }

    }

    public function user_exists($post_id, $user_id, $param)
    {
        global $wpdb;
        return $this->result = $wpdb->get_results(
            "SELECT user_id, post_id FROM " . $this->table . "
            WHERE user_id = " . $user_id . "
            AND post_id = " . $post_id . "
            AND " . $param . " = 1 "
        );
    }
}
if (get_option('activate_like_dislike')) {
    new Social();
} else {
    return;
}