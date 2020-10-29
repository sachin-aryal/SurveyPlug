<?php

require_once('constant.php');
require_once( ABSPATH . 'wp-content/plugins/cartapari-survey/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

function create_pdf_survey_report($rating, $report_directory){
    $reader = IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load(ABSPATH . 'wp-content/plugins/cartapari-survey/assets/form_render_template.xlsx');
    
    add_company_info($spreadsheet);
    add_select_yes_no($spreadsheet);
    add_partial_rating($spreadsheet, $rating[0]);
    add_total_rating($spreadsheet, $rating[1]);
    add_answer_note($spreadsheet);

    $xmlWriter = IOFactory::createWriter($spreadsheet,'Mpdf');
    $xmlWriter->writeAllSheets();
    $report_path = $report_directory."/form_report.pdf";
    $xmlWriter->save($report_path);
    return $report_path;
}

function add_partial_rating($spreadsheet, $partial_rating){
    global $index_to_partial_rating;
    for($i = 0; $i < count($index_to_partial_rating); $i++){
        $j = $i - 1;
        if(reset($index_to_partial_rating) === $index_to_partial_rating[$i]){
            $row_num = $index_to_partial_rating[$i] + 17;
            $spreadsheet->getActiveSheet()
            ->getCell('G' . $row_num)
            ->setValue($partial_rating[$i] . '%');
        }else{
            if($index_to_partial_rating[$i] - $index_to_partial_rating[$j] === 1){
                $row_num = $index_to_partial_rating[$i] + 17;
                $spreadsheet->getActiveSheet()
                ->getCell('G' . $row_num)
                ->setValue($partial_rating[$i] . '%');
            }else{
                $row_num = $index_to_partial_rating[$i] + 17;
                $last_row_num = $index_to_partial_rating[$j] + 18;
                
                $spreadsheet->getActiveSheet()
                    ->getCell('G' . $last_row_num)
                    ->setValue($partial_rating[$i] . '%');
                
            }
        }
        
    }
}

function add_total_rating($spreadsheet, $total_rating){
    global $index_to_total_excel;
    for($i = 0; $i < count($index_to_total_excel); $i++){
        $row_num = $index_to_total_excel[$i] + 17;
        $spreadsheet->getActiveSheet()
        ->getCell('H' . $row_num)
        ->setValue($total_rating[$i] . "%");
    }   
}

function add_answer_note($spreadsheet){
    global $index_to_note2;
    foreach($_POST as $key => $value){
        $note = explode('_',$key);
        if(($note[0] == 'note')){
            $row_num = 17 + $index_to_note2[(int)$note[1]-1];
            if($row_num === 76){
                $spreadsheet->getActiveSheet()
                ->getCell('G' . $row_num)
                ->setValue($value);
            }else{
                $spreadsheet->getActiveSheet()
                ->getCell('I' . $row_num)
                ->setValue($value);
            }  
        }     
    }
}

function add_select_yes_no($spreadsheet){
    foreach($_POST as $key => $value){
        $select = explode('_',$key);
        
        if(($select[0] == 'select')){
            $row_num = 17 + (int)$select[1];
            if($row_num < 75){
                $spreadsheet->getActiveSheet()
                    ->getCell('F' . $row_num)
                    ->setValue($value);
            }else{
                $row_num = $row_num + 1;
                $spreadsheet->getActiveSheet()
                    ->getCell('F' . $row_num)
                    ->setValue($value);
            }
            
        }       
    }
}

function add_company_info($spreadsheet){
    $base_path = ABSPATH . 'wp-content/plugins/cartapari-survey/assets';
    $drawing = new Drawing();
    $drawing->setName('Paid');
    $drawing->setDescription('Paid');
    $drawing->setPath($base_path.'/logo/header-completo.png'); // put your path and image here
    $drawing->setCoordinates('A1');
    $drawing->setOffsetX(110);
    $drawing->setRotation(25);
    $drawing->getShadow()->setVisible(true);
    $drawing->getShadow()->setDirection(45);
    $drawing->setWorksheet($spreadsheet->getActiveSheet());
    $spreadsheet->getActiveSheet()
        ->getCell('B5')
        ->setValue($_POST['company_name']);
    $spreadsheet->getActiveSheet()
        ->getCell('B6')
        ->setValue($_POST['company_type']);
    $spreadsheet->getActiveSheet()
        ->getCell('B7')
        ->setValue($_POST['sector']);
    $spreadsheet->getActiveSheet()
        ->getCell('B8')
        ->setValue($_POST['no_of_employee']);
    $spreadsheet->getActiveSheet()
        ->getCell('B9')
        ->setValue($_POST['state']);
    $spreadsheet->getActiveSheet()
        ->getCell('B10')
        ->setValue($_POST['author']);
    $spreadsheet->getActiveSheet()
        ->getCell('B11')
        ->setValue($_POST['author_email']);
    $spreadsheet->getActiveSheet()
        ->getCell('B12')
        ->setValue($_POST['issued_date']);
}
?>