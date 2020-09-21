<?php
require_once('constant.php');
function form_render_save(){
    global $wpdb;
    $company_table = $wpdb->prefix . 'company_info';
    $company_name = $_POST['company_name'];
    $company_data = $_POST['company_data'];
    $sector = $_POST['sector'];
    $no_of_employee = $_POST['no_of_employee'];
    $state = $_POST['state'];
    $author = $_POST['author'];
    $author_email = $_POST['author_email'];
    $issued_date = $_POST['issued_date'];
    
    $query = "INSERT INTO `$company_table` 
                (`company_name`,`company_data`,`sector`,`no_of_employee`,`state`,`author`,`author_email`,`issue_date`)
                VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";


    $sql = $wpdb->prepare($query,$company_name,$company_data,$sector,$no_of_employee,$state,$author,$author_email,$issued_date);
    $test = $wpdb->query($sql);
    $lastid = $wpdb->insert_id;
    $rating = calculateRating();
    if($lastid != 0){
        save_partial_rating($wpdb, $lastid, $rating[0]);
        save_partial_rating($wpdb, $lastid, $rating[1]);
        save_note($wpdb, $lastid);
    }
    
}

add_action("admin_post_form_render_save","form_render_save");

function save_partial_rating($wpdb, $lastid, $partial_rating){
    $table_name = $wpdb->prefix . 'partial_rating';
    $query = "INSERT INTO `$table_name` (`company_id`, `partial_id`, `partial_rating`)
        VALUES ('%d','%d', '%d')";
    foreach($partial_rating as $key => $value){
        $sql = $wpdb->prepare($query, $lastid, $key, $value);
        $wpdb->query($sql);
    }
}

function save_total_rating($wpdb, $lastid, $total_rating){
    $table_name = $wpdb->prefix . 'total_rating';
    $query = "INSERT INTO `$table_name` (`company_id`, `total_id`, `total_rating`)
        VALUES ('%d','%d', '%d')";
    foreach($total_rating as $key => $value){
        $sql = $wpdb->prepare($query, $lastid, $key, $value);
        $wpdb->query($sql);
    }
}

function save_note($wpdb, $lastid){
    $table_name = $wpdb->prefix . 'note';
    $query = "INSERT INTO `$table_name` (`company_id`, `note_id`, `note`)
        VALUES ('%d','%d', '%s')";
    foreach($_POST as $key => $value){
        $note = explode('_',$key);
        if(($note[0] == 'note') && !empty($value)){            
            $sql = $wpdb->prepare($query, $lastid, $note[1], $value);
            $wpdb->query($sql);
        }       
    }
}
?>