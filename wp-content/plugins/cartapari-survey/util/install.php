<?php

global $survey_db_version;
$survey_db_version = '1.0';

function create_wp_survey_answer_table() {
    global $wpdb;
    global $survey_db_version;
    $table_name = $wpdb->prefix . 'survey_answer';
    $users_table = $wpdb->prefix . 'users';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
          `id` bigint(20) NOT NULL AUTO_INCREMENT,
          `answer` varchar(5) NOT NULL,
          `note` int(11) DEFAULT NULL,
          `question_id` int(11) NOT NULL,
          `user_id` bigint(20) unsigned DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `fk_survey_answer_user_id` (`user_id`),
          CONSTRAINT `fk_survey_answer_user_id` FOREIGN KEY (`user_id`) REFERENCES $users_table (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
        )$charset_collate";
    dbDelta( $sql );
    add_option( 'survey_db_version', $survey_db_version );
}

function drop_tables(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."survey_answer;";
    $wpdb->query($sql);
    delete_option( 'survey_db_version');
}

function createRequiredTables(){
    create_wp_survey_answer_table();
}