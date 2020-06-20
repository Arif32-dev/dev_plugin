<?php
define('WP_USE_THEMES', false);
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/wp-load.php';

class Like_dislike
{
    private $data;
    private $table;
    private $result;
    private $msg;
    public function __construct()
    {
        $this->data = $_REQUEST;
        global $wpdb;
        $this->table = $wpdb->prefix . 'like_dislike_sys';
        // Create LIke in database bu calling this class methods
        if ($this->data['action'] == 'like') {

            $this->result = $wpdb->get_results(
                "SELECT * FROM " . $this->table . "
                 WHERE user_Id = " . $this->data['user_id'] . "
                  AND post_id = " . $this->data['post_id'] . "
                  ");

            if (!$this->result) {
                $this->create_like_dislike(1, 0, 'like_created', 'like_creation_failed');
            } else {
                $this->result = $wpdb->get_results(
                    "SELECT * FROM " . $this->table . "
                 WHERE user_Id = " . $this->data['user_id'] . "
                  AND post_id = " . $this->data['post_id'] . "
                  AND dislike_count = 1
                  ");

                if ($this->result) {
                    $this->update(1, 0, 'dislike_updated', 'dislike_update_failed');
                } else {
                    $this->delete_like_dislike('like_deleted', 'like_delete_failed');
                }

            }
        }
        // Create dislike in database bu calling this class methods
        if ($this->data['action'] == 'dislike') {

            $this->result = $wpdb->get_results(
                "SELECT * FROM " . $this->table . "
                 WHERE user_Id = " . $this->data['user_id'] . "
                  AND post_id = " . $this->data['post_id'] . "
                  ");

            if (!$this->result) {
                $this->create_like_dislike(0, 1, 'dislike_created', 'dislike_creation_failed');
            } else {
                $this->result = $wpdb->get_results(
                    "SELECT * FROM " . $this->table . "
                 WHERE user_Id = " . $this->data['user_id'] . "
                  AND post_id = " . $this->data['post_id'] . "
                  AND like_count = 1
                  ");

                if ($this->result) {
                    $this->update(0, 1, 'like_updated', 'like_update_failed');
                } else {
                    $this->delete_like_dislike('dislike_deleted', 'dislike_delete_failed');
                }

            }

        }

    }
    // Update LIke and Dislike method
    public function update($like_count, $dislike_count, $update, $failed)
    {
        global $wpdb;
        $success = $wpdb->update(
            $this->table,
            array(
                'user_id' => $this->data['user_id'],
                'post_id' => $this->data['post_id'],
                'like_count' => $like_count,
                'dislike_count' => $dislike_count,
                'time_stamp' => $this->data['time_stamp'],
            ),
            array(
                'user_id' => $this->data['user_id'],
                'post_id' => $this->data['post_id'],
            ),

            array(
                '%d',
                '%d',
                '%d',
                '%d',
                '%s',
            )

        );
        $this->success_msg($success, $update, $failed);

    }
    // create LIke and Dislike method

    public function create_like_dislike($like_count, $dislike_count, $create, $delete)
    {
        global $wpdb;
        $success = $wpdb->insert(
            $this->table,
            array(
                'user_id' => $this->data['user_id'],
                'post_id' => $this->data['post_id'],
                'like_count' => $like_count,
                'dislike_count' => $dislike_count,
                'time_stamp' => $this->data['time_stamp'],
            ),
            array(
                '%d',
                '%d',
                '%d',
                '%d',
                '%s',
            )
        );
        $this->success_msg($success, $create, $delete);
    }

    // Delete LIke and Dislike method

    public function delete_like_dislike($delete, $failed)
    {
        global $wpdb;
        $success = $wpdb->delete($this->table,
            array(
                'user_id' => $this->data['user_id'],
                'post_id' => $this->data['post_id'],
            ),
            array(
                '%d',
                '%d',
            )
        );
        $this->success_msg($success, $delete, $failed);
    }

    public function success_msg($success, $param1, $param2)
    {
        if ($success) {
            $this->msg['respond'] = $param1;
        } else {
            $this->msg['respond'] = $param2;
        }
        echo json_encode($this->msg);

    }

}
new Like_dislike();
