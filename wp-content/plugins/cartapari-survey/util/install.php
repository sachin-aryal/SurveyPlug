<?php

global $survey_db_version;
$survey_db_version = '1.0';

function create_wp_company_info_table($table_name_mapping){
    global $wpdb;
    $table_name = $table_name_mapping["company_info"];
    $users_table = $table_name_mapping["users"];
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
     `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
     `user_id` bigint(20) UNSIGNED NOT NULL,
     `company_name` varchar(100) NOT NULL,
     `company_type` varchar(50) NOT NULL,
     `sector` varchar(50) NOT NULL,
     `no_of_employee` varchar(20) NOT NULL,
     `state` varchar(3) NOT NULL,
     `author` varchar(50) NOT NULL,
     `author_email` varchar(50) NOT NULL,
     `issue_date` date NOT NULL,
     PRIMARY KEY (`id`),
     KEY `fk_company_info_user_id` (`user_id`),
     CONSTRAINT `fk_company_info_user_id` FOREIGN KEY (`user_id`) REFERENCES $users_table (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
   )$charset_collate";
    dbDelta( $sql );
}

function create_wp_survey_answer_table($table_name_mapping) {
    global $wpdb;
    global $survey_db_version;
    $table_name = $table_name_mapping["survey_answer"];
    $company_table = $table_name_mapping["company_info"];
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
          `id` bigint(20) NOT NULL AUTO_INCREMENT,
          `answer` varchar(5) NOT NULL,
          `question_id` int(11) NOT NULL,
          `company_id` bigint(20) unsigned DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `fk_survey_answer_company_id` (`company_id`),
          CONSTRAINT `fk_survey_answer_company_id` FOREIGN KEY (`company_id`) REFERENCES $company_table (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
        )$charset_collate";
    dbDelta( $sql );
    add_option( 'survey_db_version', $survey_db_version );
}

function create_wp_partial_rating_table($table_name_mapping){
    global $wpdb;
    $table_name = $table_name_mapping["partial_rating"];
    $company_table = $table_name_mapping["company_info"];
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
     `id` bigint(20) NOT NULL AUTO_INCREMENT,
     `partial_id` int NOT NULL,
     `survey_partial_rating` int NOT NULL,
     `company_id` bigint(20) unsigned DEFAULT NULL,
     PRIMARY KEY (`id`),
     KEY `fk_partial_rating_company_id` (`company_id`),
     CONSTRAINT `fk_partial_rating_company_id` FOREIGN KEY (`company_id`) REFERENCES $company_table (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
    )$charset_collate";
    dbDelta( $sql );
 }

 function create_wp_total_rating_table($table_name_mapping){
    global $wpdb;
    $table_name = $table_name_mapping["total_rating"];
    $company_table = $table_name_mapping["company_info"];
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
     `id` bigint(20) NOT NULL AUTO_INCREMENT,
     `total_id` int NOT NULL,
     `survey_total_rating` int NOT NULL,
     `company_id` bigint(20) unsigned DEFAULT NULL,
     PRIMARY KEY (`id`),
     KEY `fk_total_rating_company_id` (`company_id`),
     CONSTRAINT `fk_total_rating_company_id` FOREIGN KEY (`company_id`) REFERENCES $company_table (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
    )$charset_collate";
    dbDelta( $sql );
 }

 function create_wp_note_table($table_name_mapping){
    global $wpdb;
    $table_name = $table_name_mapping["question_note"];
    $company_table = $table_name_mapping["company_info"];
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
     `id` bigint(20) NOT NULL AUTO_INCREMENT,
     `note_id` int NOT NULL,
     `survey_question_note` varchar(500) NOT NULL,
     `company_id` bigint(20) unsigned DEFAULT NULL,
     PRIMARY KEY (`id`),
     KEY `fk_note_company_id` (`company_id`),
     CONSTRAINT `fk_note_company_id` FOREIGN KEY (`company_id`) REFERENCES $company_table (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
    )$charset_collate";
    dbDelta( $sql );
 }

function drop_table_survey_answer($table_name_mapping){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$table_name_mapping["survey_answer"];
    $wpdb->query($sql);
    delete_option( 'survey_db_version');
}

function drop_table_partial_rating($table_name_mapping){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$table_name_mapping["partial_rating"];
    $wpdb->query($sql);
}

function drop_table_total_rating($table_name_mapping){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$table_name_mapping["total_rating"];
    $wpdb->query($sql);
}

function drop_table_note($table_name_mapping){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$table_name_mapping["question_note"];
    $wpdb->query($sql);
}

function drop_table_company_info($table_name_mapping){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$table_name_mapping["company_info"];
    $wpdb->query($sql);
}

function drop_tables(){
    global $table_name_mapping;
    drop_table_survey_answer($table_name_mapping);
    drop_table_partial_rating($table_name_mapping);
    drop_table_total_rating($table_name_mapping);
    drop_table_note($table_name_mapping);
    drop_table_company_info($table_name_mapping);
}

function createRequiredTables(){
    global $wpdb;
    $table_name_mapping = array(
        "survey_answer" => $wpdb->prefix . 'survey_answer',
        "company_info" => $wpdb->prefix . 'survey_company_info',
        "partial_rating" => $wpdb->prefix . 'survey_partial_rating',
        "total_rating" => $wpdb->prefix . 'survey_total_rating',
        "question_note" => $wpdb->prefix . 'question_note',
        "users" => $wpdb->prefix . 'users',
    );
    create_wp_company_info_table($table_name_mapping);
    create_wp_survey_answer_table($table_name_mapping);
    create_wp_partial_rating_table($table_name_mapping);
    create_wp_total_rating_table($table_name_mapping);
    create_wp_note_table($table_name_mapping);
}