<?php
class DB
{
    public static function db_create()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $collate = $wpdb->get_charset_collate();
        $wordpress_table = DB_NAME;
        $sql = "CREATE TABLE `{$wordpress_table}`.
`{$prefix}like_dislike_sys`
( `ID` INT(255) NOT NULL AUTO_INCREMENT ,
 `user_id` INT(255) NOT NULL ,
  `post_id` INT(255) NOT NULL ,
   `like_count` INT(255) NOT NULL ,
   `dislike_count` INT(255) NOT NULL ,
   `time_stamp` TIMESTAMP NOT NULL ,
    PRIMARY KEY (`ID`))
    ENGINE = InnoDB; {$collate} IF NOT EXISTS `{$prefix}like_dislike_sys`";

        $table_check_sql = "SHOW TABLES LIKE '{$prefix}like_dislike_sys'";
        $results = $wpdb->get_results($table_check_sql);
        if (count($results) == 0) {

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);
        }
    }

    public static function db_delete()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $sql = "DROP TABLE IF EXISTS `{$prefix}like_dislike_sys` ;";
        $wpdb->query($sql);
    }

    public static function create_cpt_table()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $wordpress_table = DB_NAME;
        $sql = "CREATE TABLE `{$wordpress_table}`.
     `{$prefix}cpt_table` (
         `id` INT NOT NULL AUTO_INCREMENT ,
         `cpt_name` TEXT NOT NULL ,
         `cpt_s_name` TEXT NOT NULL ,
          `cpt_dashicon` TEXT NOT NULL ,
         `cpt_title` BOOLEAN NOT NULL ,
          `cpt_excerpt` BOOLEAN NOT NULL ,
          `cpt_editor` BOOLEAN NOT NULL ,
           `cpt_thumbnail` BOOLEAN NOT NULL ,
           PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci";
        $table_check_sql = "SHOW TABLES LIKE '{$prefix}cpt_table'";
        $results = $wpdb->get_results($table_check_sql);
        if (count($results) == 0) {

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);
        }

    }

    public static function delete_cpt_table()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $sql = "DROP TABLE IF EXISTS `{$prefix}cpt_table`";
        $wpdb->query($sql);
    }
    public static function create_tax_table()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $wordpress_table = DB_NAME;
        $sql = "CREATE TABLE `{$wordpress_table}`.
      `{$prefix}taxonomy_manager`
       ( `id` INT NOT NULL AUTO_INCREMENT ,
        `tax_name` TEXT NOT NULL ,
        `hierarchical` BOOLEAN NOT NULL ,
        `public` BOOLEAN NOT NULL ,
        PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci";
        $table_check_sql = "SHOW TABLES LIKE '{$prefix}taxonomy_manager'";
        $results = $wpdb->get_results($table_check_sql);
        if (count($results) == 0) {

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);
        }

    }
    public static function delete_tax_table()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $sql = "DROP TABLE IF EXISTS `{$prefix}taxonomy_manager`";
        $wpdb->query($sql);
    }
}
