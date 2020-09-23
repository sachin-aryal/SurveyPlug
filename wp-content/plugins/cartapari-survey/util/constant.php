<?php
global $wpdb;

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
);
$question_answer_mapping = array(
    1 => "1.1",
    2 => "1.2",
    3 => "2.1",
    4 => "2.2",
    5 => "3.1",
    6 => "3.2",
    7 => "4.1 a",
    8 => "4.1 b",
    9 => "4.1 c",
    10 => "4.1 d",
    11 => "4.1 e",
    12 => "4.2 a",
    13 => "4.2 b",
    14 => "4.2 c",
    15 => "4.2 d",
    16 => "5.1 a",
    17 => "5.1 b",
    18 => "5.1 c",
    19 => "5.1 d",
    20 => "5.2.1",
    21 => "5.2 b",
    22 => "5.2 c",
    23 => "5.2 d",
    24 => "5.2 e",
    25 => "5.2 f",
    26 => "6.1",
    27 => "6.2",
    28 => "6.3",
    29 => "6.4 a",
    30 => "6.4 b",
    31 => "7.1",
    32 => "7.2",
    33 => "8.1.1",
    34 => "8.1 a",
    35 => "8.1 b",
    36 => "8.1 c",
    37 => "8.1 d",
    38 => "8.1 e",
    39 => "8.1 f",
    40 => "8.2 a",
    41 => "8.2 b",
    42 => "8.2 c",
    43 => "8.2 d",
    44 => "8.2 e",
    45 => "8.2 f",
    46 => "8.2 g",
    47 => "8.2 h",
    48 => "8.2 i",
    49 => "8.3 a",
    50 => "8.3 b",
    51 => "8.3 c",
    52 => "8.3 d",
    53 => "8.3 e",
    54 => "9.1 a",
    55 => "9.1 b",
    56 => "10.1",
    57 => "10.2"
);
$index_to_partial_rating = array(1, 2, 3, 4, 5, 6, 11, 15, 19, 25, 26, 27, 28, 30, 31, 32, 39, 48, 53, 54, 55, 56, 57);
$index_to_total_rating = array(2, 4, 6, 15, 25, 30, 32, 53, 55, 57);
$index_to_note = array(1, 2, 3, 4, 6, 11, 15, 19, 25, 30, 32, 33, 39, 48, 53, 54, 55, 56, 57);
$table_name_mapping = array(
    "survey_answer" => $wpdb->prefix . 'survey_answer',
    "company_info" => $wpdb->prefix . 'survey_company_info',
    "partial_rating" => $wpdb->prefix . 'survey_partial_rating',
    "total_rating" => $wpdb->prefix . 'survey_total_rating',
    "question_note" => $wpdb->prefix . 'question_note',
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