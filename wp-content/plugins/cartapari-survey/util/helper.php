<?php

function get_my_rating($wpdb, $company_id, $total_rating_table){
    return$wpdb->get_results ( "SELECT * FROM $total_rating_table WHERE company_id = $company_id ORDER BY total_id ASC");
}

function get_best_rating($wpdb, $total_rating_table, $company_ids){
    return$wpdb->get_results ( "SELECT MAX(survey_total_rating) as survey_total_rating FROM $total_rating_table WHERE company_id in ('$company_ids') GROUP BY total_id ORDER BY total_id ASC");
}

function get_average_rating($wpdb, $total_rating_table, $company_ids){
    return$wpdb->get_results ( "SELECT AVG(survey_total_rating) as survey_total_rating FROM $total_rating_table WHERE company_id in ('$company_ids') GROUP BY total_id ORDER BY total_id ASC");
}

function get_related_company_ids($wpdb, $comapany_table, $company_type, $no_of_employee){
    return $wpdb->get_results ( "SELECT id FROM $comapany_table WHERE company_type='$company_type' AND no_of_employee='$no_of_employee'");
}

function calculateRating(){
    global $question_map;
    $rating = array();
    $total_rating = array();
    $partial_rating = array();
    foreach ($question_map as $questions){
        $count = sizeof($questions);
        $total_percentage = 0;
        foreach ($questions as $each_question){
            if(is_array($each_question)){
                $partial_sum = 0;
                $partial_score = 0;
                foreach($each_question as $last_level){
                    if($last_level == 33){
                        $partial_sum += 40;
                        $partial_score += $_POST["select_$last_level"] == "SI" ? 40: 20;
                    }else{
                        $partial_score += $_POST["select_$last_level"] == "SI" ? 10: 5;
                        $partial_sum += 10;
                    }
                }
                $partial_percentage = round(($partial_score/$partial_sum) * 100, 2);
                $total_percentage += $partial_percentage;
            }else{
                $partial_score = $_POST["select_$each_question"] == "SI" ? 10: 5;
                $partial_percentage = ($partial_score/10)*100;
                $total_percentage += $partial_percentage;
            }
            array_push($partial_rating, $partial_percentage);
        }
        $final_rating = round($total_percentage/$count, 2);
        array_push($total_rating, $final_rating);
    }
    array_push($rating, $partial_rating);
    array_push($rating,$total_rating);
    return $rating;
}