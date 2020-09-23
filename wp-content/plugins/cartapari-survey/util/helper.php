<?php

function get_my_rating($wpdb, $company_id, $total_rating_table){
    return$wpdb->get_results ( "SELECT * FROM $total_rating_table WHERE company_id = $company_id ORDER BY total_id ASC");
}

function get_best_rating($wpdb, $total_rating_table){
    return$wpdb->get_results ( "SELECT MAX(survey_total_rating) as survey_total_rating FROM $total_rating_table GROUP BY total_id ORDER BY total_id ASC");
}

function get_average_rating($wpdb, $total_rating_table){
    return$wpdb->get_results ( "SELECT AVG(survey_total_rating) as survey_total_rating FROM $total_rating_table GROUP BY total_id ORDER BY total_id ASC");
}