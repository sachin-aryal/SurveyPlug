<?php

global $survey_db_version;
$survey_db_version = '1.0';

function create_wp_survey_answer_table() {
    global $wpdb;
    global $survey_db_version;
    $table_name = $wpdb->prefix . 'survey_answer';
    $company_table = $wpdb->prefix . 'company_info';
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

function create_wp_company_info_table(){
    global $wpdb;
    global $survey_db_version;
    $table_name = $wpdb->prefix . 'company_info';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
     `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
     `company_name` varchar(100) NOT NULL,
     `company_data` varchar(50) NOT NULL,
     `sector` varchar(50) NOT NULL,
     `no_of_employee` varchar(20) NOT NULL,
     `state` varchar(3) NOT NULL,
     `author` varchar(50) NOT NULL,
     `author_email` varchar(50) NOT NULL,
     `issue_date` date NOT NULL,
     PRIMARY KEY (`id`)
   )$charset_collate";
    dbDelta( $sql );
}

function create_wp_partial_rating_table(){
    global $wpdb;
    global $survey_db_version;
    $table_name = $wpdb->prefix . 'partial_rating';
    $company_table = $wpdb->prefix . 'company_info';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
     `id` bigint(20) NOT NULL AUTO_INCREMENT,
     `partial_id` int NOT NULL,
     `partial_rating` varchar(100) NOT NULL,
     `company_id` bigint(20) unsigned DEFAULT NULL,
     PRIMARY KEY (`id`),
     KEY `fk_partial_rating_company_id` (`company_id`),
     CONSTRAINT `fk_partial_rating_company_id` FOREIGN KEY (`company_id`) REFERENCES $company_table (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
    )$charset_collate";
    dbDelta( $sql );
 }

 function create_wp_total_rating_table(){
    global $wpdb;
    global $survey_db_version;
    $table_name = $wpdb->prefix . 'total_rating';
    $company_table = $wpdb->prefix . 'company_info';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
     `id` bigint(20) NOT NULL AUTO_INCREMENT,
     `total_id` int NOT NULL,
     `total_rating` varchar(100) NOT NULL,
     `company_id` bigint(20) unsigned DEFAULT NULL,
     PRIMARY KEY (`id`),
     KEY `fk_total_rating_company_id` (`company_id`),
     CONSTRAINT `fk_total_rating_company_id` FOREIGN KEY (`company_id`) REFERENCES $company_table (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
    )$charset_collate";
    dbDelta( $sql );
 }

 function create_wp_note_table(){
    global $wpdb;
    global $survey_db_version;
    $table_name = $wpdb->prefix . 'note';
    $company_table = $wpdb->prefix . 'company_info';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
     `id` bigint(20) NOT NULL AUTO_INCREMENT,
     `note_id` int NOT NULL,
     `note` varchar(100) NOT NULL,
     `company_id` bigint(20) unsigned DEFAULT NULL,
     PRIMARY KEY (`id`),
     KEY `fk_note_company_id` (`company_id`),
     CONSTRAINT `fk_note_company_id` FOREIGN KEY (`company_id`) REFERENCES $company_table (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
    )$charset_collate";
    dbDelta( $sql );
 }

 function drop_table_note(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."note;";
    $wpdb->query($sql);
 }

function drop_table_survey_answer(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."survey_answer;";
    $wpdb->query($sql);
    delete_option( 'survey_db_version');
}

function drop_table_company_info(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."company_info;";
    $wpdb->query($sql);
}

function drop_table_partial_rating(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."partial_rating;";
    $wpdb->query($sql);
}

function drop_table_total_rating(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."total_rating;";
    $wpdb->query($sql);
}

function drop_tables(){
    drop_table_survey_answer();
    drop_table_partial_rating();
    drop_table_total_rating();
    drop_table_note();
    drop_table_company_info();
}

function createRequiredTables(){
    create_wp_company_info_table();
    create_wp_survey_answer_table();
    create_wp_partial_rating_table();
    create_wp_total_rating_table();
    create_wp_note_table();
}