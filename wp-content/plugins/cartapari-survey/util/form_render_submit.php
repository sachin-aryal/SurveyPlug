<?php
require_once('constant.php');
require_once('helper.php');

function form_render_save(){
    global $wpdb, $table_name_mapping;
    $company_table = $table_name_mapping["company_info"];
    $company_name = $_POST['company_name'];
    $company_type = $_POST['company_type'];
    $sector = $_POST['sector'];
    $no_of_employee = $_POST['no_of_employee'];
    $state = $_POST['state'];
    $author = $_POST['author'];
    $author_email = $_POST['author_email'];
    $issued_date = $_POST['issued_date'];
    $user_id = get_current_user_id();
    
    $query = "INSERT INTO `$company_table` 
                (`company_name`,`company_type`,`sector`,`no_of_employee`,`state`,`author`,`author_email`,`issue_date`, `user_id`)
                VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d')";


    $sql = $wpdb->prepare($query,$company_name,$company_type,$sector,$no_of_employee,$state,$author,$author_email,$issued_date, $user_id);
    $wpdb->query($sql);
    $lastid = $wpdb->insert_id;
    $rating = calculateRating();
    if($lastid != 0){
        save_survey_answer($wpdb, $lastid, $table_name_mapping);
        save_partial_rating($wpdb, $lastid, $rating[0], $table_name_mapping);
        save_total_rating($wpdb, $lastid, $rating[1], $table_name_mapping);
        save_note($wpdb, $lastid, $table_name_mapping);
        create_total_rating_pdf($rating[1]);   
    }
    $location = $_SERVER["HTTP_REFERER"];
    wp_safe_redirect($location);
    
}

add_action("admin_post_form_render_save","form_render_save");

function save_survey_answer($wpdb, $lastid, $table_name_mapping){
    $table_name = $table_name_mapping["survey_answer"];
    $query = "INSERT INTO `$table_name` (`answer`, `question_id`, `company_id`)
        VALUES ('%s','%d', '%d')";
    foreach($_POST as $key => $value){
        $select = explode('_',$key);
        if(($select[0] == 'select')){            
            $sql = $wpdb->prepare($query, $value, $select[1], $lastid);
            $wpdb->query($sql);
        }       
    }
}

function save_partial_rating($wpdb, $lastid, $partial_rating, $table_name_mapping){
    $table_name = $table_name_mapping["partial_rating"];
    $query = "INSERT INTO `$table_name` (`company_id`, `partial_id`, `survey_partial_rating`)
        VALUES ('%d','%d', '%d')";
    foreach($partial_rating as $key => $value){
        $sql = $wpdb->prepare($query, $lastid, $key, $value);
        $wpdb->query($sql);
    }
}

function save_total_rating($wpdb, $lastid, $total_rating, $table_name_mapping){
    $table_name = $table_name_mapping["total_rating"];;
    $query = "INSERT INTO `$table_name` (`company_id`, `total_id`, `survey_total_rating`)
        VALUES ('%d','%d', '%d')";
    foreach($total_rating as $key => $value){
        $sql = $wpdb->prepare($query, $lastid, $key, $value);
        $wpdb->query($sql);
    }
}

function save_note($wpdb, $lastid, $table_name_mapping){
    $table_name = $table_name_mapping["question_note"];;
    $query = "INSERT INTO `$table_name` (`company_id`, `note_id`, `survey_question_note`)
        VALUES ('%d','%d', '%s')";
    foreach($_POST as $key => $value){
        $note = explode('_',$key);
        if(($note[0] == 'note')){
            $sql = $wpdb->prepare($query, $lastid, $note[1], $value);
            $wpdb->query($sql);
        }       
    }
}

function create_total_rating_pdf($total_rating){
    echo "test";
}


function createImage($wpdb, $company_id, $total_rating_table){
    $my_ratings = get_my_rating($wpdb, $company_id, $total_rating_table);
    $total = 0;
    foreach ($my_ratings as $my_rating){
        $total += $my_rating->survey_total_rating;
    }
    $average = $total/sizeof($my_ratings);

    // Create an image of given size
    $width = 1300;
    $height = 450;
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    $font_path = 'arial.ttf';

    // Draw the rectangle of green color
    imagefilledrectangle($image, 0, 0, $width, $height, $white);
    imagerectangle($image, 20, 100, $width-20, 200, $black);
    imagettftext($image, 14, 0, 550, 150, $black, $font_path, "Punteggio Generale");
    imagettftext($image, 14, 0, 610, 180, $black, $font_path, "$average%");
    $index = 1;
    foreach ($my_ratings as $best_rating){
        $x1 = 127*($index-1);
        if($index == 1){
            $x1 = 20;
        }else{
            $x1 += 20;
        }
        $x2 = $x1+110;
        if($index == 10){
            $x2 = 1280;
        }
        imagerectangle($image, $x1, 230, $x2, 300, $black);
        imagettftext($image, 14, 0, $x1+9, 270, $black, $font_path, "Section - $index");
        imagettftext($image, 14, 0, $x1+40, 292, $black, $font_path, "$best_rating->survey_total_rating%");
        $index += 1;
    }
    # TODO:Convert this image to pdf and save it to the directory where another pdf is generated -> CHASMA
    imagejpeg($image, $company_id.'_image.jpg');
    // Free memory
    imagedestroy($image);
}

?>