<?php

$question_map = array(
    array(1, 2),
    array(3, 4),
    array(5, 6),
    array(array(7, 8, 9, 10, 11), array(12, 13, 14, 15)),
    array(array(16, 17, 18, 19), array(20, 21, 22, 23, 24, 25)),
    array(26, 27, 28, array(29, 30)),
    array(31, 32),
    array(array(33, 34, 35, 36, 37, 38, 39), array(40, 41, 42, 43, 44, 45, 46, 47, 48), array(49, 50, 51, 52, 53)),
    array(54, 55),
    array(56, 57)
//    array(59, 60, 61, 62, 63, 64, 65, 66)
);

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
                        $partial_score += $_POST["select_$last_level"] == "yes" ? 40: 20;
                    }else{
                        $partial_score += $_POST["select_$last_level"] == "yes" ? 10: 5;
                        $partial_sum += 10;
                    }
                }
                $partial_percentage = round(($partial_score/$partial_sum) * 100, 2);
                $total_percentage += $partial_percentage;
            }else{
                $partial_score = $_POST["select_$each_question"] == "yes" ? 10: 5;
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