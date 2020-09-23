<?php

require_once(ABSPATH . 'wp-config.php');
function surveyForm(){
        global $wpdb, $table_name_mapping;
        $company_table = $table_name_mapping["company_info"];
        $row = get_company($wpdb, $company_table, get_current_user_id());
        if($row){
            require_once('_chart.php');
        }else{
            require_once('_form.php');
        }

}
add_shortcode("survey_form", "surveyForm");

function get_company($wpdb, $company_info, $user_id){
    return $wpdb->get_row ( "SELECT *FROM $company_info WHERE user_id = $user_id LIMIT 1");
}