<?php
require_once('constant.php');
require_once( ABSPATH . 'wp-content/plugins/cartapari-survey/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportReportFile(){
    if(!isset($_POST['download_excel_report'])){
        return;
    }
    global $table_name_mapping;
    global $wpdb, $question_answer_mapping, $question_map, $index_to_partial_rating, $index_to_total_rating, $index_to_note;
    $result = $wpdb->get_results ( "SELECT * FROM  ".$table_name_mapping["company_info"]);
    $header = array("DATI ANAGRIFICI, DOMANDE, PUNTEGGI E NOTE", "NOME AZIENDA", "TIPOLOGIA DI ORGANIZZAZIONE",
        "SETTORE", "NUMERO DI DIPENDENTI", "PROVINCIA", "PERSONA INCARICATA DELLA COMPILAZIONE",
        "EMAIL PER RICEZIONE RISULTATI", "DATA DELLA COMPILAZIONE");
    foreach ($question_map as $questions){
        foreach ($questions as $each_question){
            $main_label = "";
            if(is_array($each_question)){
                foreach($each_question as $last_level){
                    $map = $question_answer_mapping[$last_level];
                    array_push($header, $map. " - Risposta");
                    array_push($header, $map. " - Score parziale");
                    if($last_level == 33){
                        array_push($header, $map. " - Note");
                    }
                    $main_label = $map;
                    $last_question_id = $last_level;
                }
            }else{
                $map = $question_answer_mapping[$each_question];
                array_push($header, $map. " - Risposta");
                array_push($header, $map. " - Score parziale");
                $main_label = $map;
                $last_question_id = $each_question;
            }
            if(in_array($last_question_id, $index_to_note)){
                array_push($header, substr($main_label, 0, 4). " - Note");
            }
            array_push($header, substr($main_label, 0, 4). " - Rating requisito");
        }
        array_push($header, str_replace(".", "", substr($main_label, 0, 2)). " – Rating complessivo");
    }
    array_push($header, "Target Diversity&Inclusion - Donne");
    array_push($header, "Target Diversity&Inclusion - Giovani");
    array_push($header, "Target Diversity&Inclusion - Senior");
    array_push($header, "Target Diversity&Inclusion - Disabili");
    array_push($header, "Target Diversity&Inclusion - Minoranze etniche");
    array_push($header, "Target Diversity&Inclusion - Minoranze religiose");
    array_push($header, "Target Diversity&Inclusion - LGBT");
    array_push($header, "Target Diversity&Inclusion - Altro (specificare in Note)");
    array_push($header, "Commento libero non obbligatorio");
    $final_rows = array();
    array_push($final_rows, $header);
    foreach ( $result as $company )
    {
        $csv_rows = array();
        array_push($csv_rows, "COMPILATORE");
        $company_id = $company ->id;
        $company_name = $company -> company_name;
        $company_type = $company -> company_type;
        array_push($csv_rows, $company_name);
        array_push($csv_rows, $company_type);
        array_push($csv_rows, $company -> sector);
        array_push($csv_rows, $company -> no_of_employee);
        array_push($csv_rows, $company -> state);
        array_push($csv_rows, $company -> author);
        array_push($csv_rows, $company -> author_email);
        array_push($csv_rows, $company -> issued_date);
        $answers = $wpdb->get_results("SELECT *FROM ".$table_name_mapping["survey_answer"]." WHERE company_id=$company_id ORDER BY question_id ASC");
        $partial_rating = $wpdb->get_results("SELECT *FROM ".$table_name_mapping["partial_rating"]." WHERE company_id=$company_id ORDER BY partial_id ASC");
        $total_rating = $wpdb->get_results("SELECT *FROM ".$table_name_mapping["total_rating"]." WHERE company_id=$company_id ORDER BY total_id ASC");
        $question_note = $wpdb->get_results("SELECT *FROM ".$table_name_mapping["question_note"]." WHERE company_id=$company_id ORDER BY note_id ASC");
        $final_index = 0;
        $partial_index = 0;
        $note_index = 0;
        foreach ($answers as $answer){
            if($answer->question_id < 58){
                if($answer->question_id == 33){
                    $score = $answer->answer == "SI" ? 40: 20;
                }else{
                    $score = $answer->answer == "SI" ? 10: 5;
                }
                array_push($csv_rows, $answer->answer);
                array_push($csv_rows, $score);
                if(in_array($answer->question_id, $index_to_note)){
                    array_push($csv_rows, $question_note[$note_index]->survey_question_note);
                    $note_index += 1;
                }
                if(in_array($answer->question_id, $index_to_partial_rating)){
                    array_push($csv_rows, $partial_rating[$partial_index]->survey_partial_rating. "%");
                    $partial_index += 1;
                }
                if(in_array($answer->question_id, $index_to_total_rating)){
                    array_push($csv_rows, $total_rating[$final_index]->survey_total_rating. "%");
                    $final_index += 1;
                }
            }else{
                array_push($csv_rows, $answer->answer);
                if(in_array($answer->question_id, $index_to_note)){
                    array_push($csv_rows, $question_note[$note_index]->survey_question_note);
                    $note_index += 1;
                }
            }
        }
        array_push($final_rows, $csv_rows);

    }
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Data Sheet');
    $rowIndex = 1;
    foreach ($final_rows as $row){
        $columnIndex = 0;
        foreach($row as $cell){
            $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $cell);
            $columnIndex += 1;
        }
        $rowIndex += 1;
    }

    $writer = new Xlsx($spreadsheet);
    $file_path = ABSPATH. 'wp-content/plugins/cartapari-survey/data_'.date("Ymd").'.xlsx';
    $writer->save($file_path);
    $content = file_get_contents($file_path);
    header("Content-Disposition: attachment; filename=data_".date("Ymd").'.xlsx');
    unlink($file_path);
    exit($content);
}
add_action('admin_init','exportReportFile');