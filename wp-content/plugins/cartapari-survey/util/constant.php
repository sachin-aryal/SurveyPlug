<?php

$question_map = array(
    array(1, 2),
    array(3, 4),
    array(5, 6),
    array(array(7, 8, 9, 10, 11), array(12, 13, 14, 15)),
    array(array(16, 17, 18, 19), array(20, 21, 22, 23, 24, 25)),
    array(26, 27, 28, array(29, 30)),
    array(32, 33),
    array(array(34, 35, 36, 37, 38, 39, 40), array(41, 42, 43, 44, 45, 46, 47, 48, 49), array(50, 51, 52, 53, 54)),
    array(55, 56),
    array(57, 58)
//    array(59, 60, 61, 62, 63, 64, 65, 66)
);

function calculateRating(){
    $_POST = array();
    global $question_map;
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
                    if($last_level == 34){
                        $partial_sum += 40;
                        $partial_score += $_POST["input_$last_level"] == "yes" ? 40: 20;
                    }else{
                        $partial_score += $_POST["input_$last_level"] == "yes" ? 10: 5;
                        $partial_sum += 10;
                    }
                }
                $partial_percentage = round(($partial_score/$partial_sum) * 100, 2);
                $total_percentage += $partial_percentage;
            }else{
                $partial_score = $_POST["input_$each_question"] == "yes" ? 10: 5;
                $partial_percentage = ($partial_score/10)*100;
                $total_percentage += $partial_percentage;
            }
            array_push($partial_rating, $partial_percentage);
        }
        $final_rating = round($total_percentage/$count, 2);
        array_push($total_rating, $final_rating);
    }
}