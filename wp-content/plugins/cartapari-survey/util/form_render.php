<?php

require_once(ABSPATH . 'wp-config.php');

function surveyForm(){
    global $wpdb;
    $states = array("AG","AL","AN","AO","AQ","AR","AP","AT","AV","BA","BT","BL","BN","BG","BI","BO","BZ","BS","BR","CA",
        "CL","CB","CI","CE","CT","CZ","CH","CO","CS","CR","KR","CN","EN","FM","FE","FI","FG","FC","FR","GE","GO","GR",
        "IM","IS","SP","LT","LE","LC","LI","LO","LU","MC","MN","MS","MT","VS","ME","MI","MO","MB","NA","NO","NU","OG","OT",
        "OR","PD","PA","PR","PV","PG","PU","PE","PC","PI","PT","PN","PZ","PO","RG","RA","RC","RE","RI","RN","Roma","RO",
        "SA","SS","SV","SI","SR","SO","TA","TE","TR","TO","TP","TN","TV","TS","UD","VA","VE","VB","VC","VR","VV","VI","VT");

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    mysqli_select_db($link, DB_NAME);

    $query = "SELECT *FROM ".$wpdb->prefix."survey_questions";
    $result_questions = mysqli_query ($link, $query) or die ("Query  failed $query");
    $grouped_question_data = array();

# Table with the parent and child criteria
    while ($question_row = mysqli_fetch_assoc ($result_questions)) {
        $action_id = $question_row["action_id"];
        if(array_key_exists($action_id, $grouped_question_data)){
            $grouped_data_array = $grouped_question_data[$action_id];
        }else{
            $grouped_data_array = array();
        }
        array_push($grouped_data_array, $question_row);
        $grouped_question_data[$action_id] = $grouped_data_array;
    }

# Table with requirement and reference
    $query = "SELECT *FROM ".$wpdb->prefix."survey_questions_action;";
    $result_questions_action = mysqli_query ($link, $query) or die ("Query  failed $query");
    $grouped_question_action_data = array();

    while ($question_action_row = mysqli_fetch_assoc ($result_questions_action)) {
        $action_id = $question_action_row["action_id"];
        if(array_key_exists($action_id, $grouped_question_action_data)){
            $grouped_data_array = $grouped_question_action_data[$action_id];
        }else{
            $grouped_data_array = array();
        }
        array_push($grouped_data_array, $question_action_row);
        $grouped_question_action_data[$action_id] = $grouped_data_array;
    }


    echo "
    <style>
    #table-2 {
        border-collapse: collapse;
        padding: 15px;
        margin: 30px 10px 10px;
    }
    #table-1{
        padding: 25PX;
    }
    #table-2 td {
        border: 1px solid #333;
        padding: 5px;
    }
    #table-1 th{
        float: left;
    }
    #table-1 select, #table-1 input[type='text'], #table-1 input[type='date'], #table-1 textarea{
      width:100%;
      box-sizing:border-box;
      margin-left: 20px;
      margin-top: 5px;
    }
    caption{
        padding: 20px;
        font-size: 20px;
    }
    #table-1 textarea::placeholder {
          color: #444;
          text-align: center;
          overflow: hidden;
    }
    </style>";

    $query = "SELECT *FROM ".$wpdb->prefix."survey_action;";
    $result_actions = mysqli_query ($link, $query) or die ("Query  failed $query");
    echo "<form>";
    echo "<table id='table-1'>";
    echo "<caption>COMPANY DATA</caption></hr>";
    echo "<tbody>";
    echo "<tr>
            <th>COMPANY NAME</th>
            <td><textarea name='company_name' required='required'></textarea></td>
        </tr>";
    echo "<tr>
            <th>COMPANY DATA</th>
            <td>
            <select name='company_data' required='required'>
                <option value='1'>IMPRESA-ASSOCIAZIONE IMPRENDITORIALE</option>
                <option value='2'>ENTE PUBBLICO</option>
                <option value='3'>TERZO SETTORE E SOCIETA' CIVILE</option>
            </select>
            </td>
        </tr>";
    echo "<tr>
            <th>SECTOR</th>
            <td><textarea name='sector' required='required'></textarea></td>
        </tr>";
    echo "<tr>
            <th>NUMBER OF EMPLOYEES</th>
            <td>
            <select name='no_of_employee' required='required'>
                <option value='1'>0-10</option>
                <option value='2'>11-50</option>
                <option value='3'>51-250</option>
                <option value='4'>251-1000</option>
                <option value='5'>1001-5000</option>
                <option value='6'>Oltre 5000</option>
            </select>
            </td>
        </tr>";
    echo "<tr>
            <th>STATE</th>
            <td>
            <select name='state' required='required'>";
    foreach ($states as $state){
        echo "<option value='$state'>$state</option>";
    }
    echo "</select>
            </td>
        </tr>";
    echo "<tr>
            <th>PERSON WHO IS FILLING THE QUESTIONAIRE</th>
            <td><input type='text' name='author' placeholder='Person Who Is Filling The Questionaire' required='required'/></td>
        </tr>";
    echo "<tr>
            <th>DATE OF ISSUE</th>
            <td><input type='date' name='issued_date' placeholder='Date of Issue' required='required'/></td>
        </tr>";

    echo "</tbody>";
    echo "</table>";
    echo "<table id='table-2'>";
    echo "<thead><th>AZIONE</th><th>RIFERIMENTO</th><th>REQUISITO</th><th>CRITERIO</th><th></th><th>ANSWER</th><th>Note</th></thead>";
    echo "<tbody>";
    while ($action_row = mysqli_fetch_assoc ($result_actions)) {
        $parent_action_id = $action_row["id"];
        $action = $action_row["action"];

        $grouped_question_action_rows = $grouped_question_action_data[$parent_action_id];
        $item_list = array();
        $total_row_span = 0;
        foreach ($grouped_question_action_rows as $each_row) {
            $reference = $each_row["reference"];
            $requirement = $each_row["requirement"];
            $child_action_id = $each_row["survey_questions_action_id"];
            $grouped_question_rows = $grouped_question_data[$child_action_id];
            $child_index = 0;
            $action_row_span = 0;
            foreach ($grouped_question_rows as $question_row){
                if(strlen($question_row["criterion_child"]) > 0)
                    $action_row_span += 1;
            }
            if($action_row_span > 0){
                $action_row_span = sizeof($grouped_question_rows);
            }
            $rendered = false;
            foreach ($grouped_question_rows as $question_row){
                if(strlen($question_row["criterion_child"]) > 0){
                    if($child_index == 0){
                        $reference_el = $rendered == true ? '' : "<td width='5%' rowspan='".$action_row_span."'>".$reference."</td>";
                        if($rendered == true){
                            $action_row_span -= 1;
                        }
                        array_push($item_list,
                            "
                            $reference_el
                            <td width='10%' rowspan='".$action_row_span."'>".$requirement."</td>
                            <td width='45%' rowspan='".$action_row_span."'>".$question_row['criterion_parent']."</td>
                            <td width='45%'>".$question_row['criterion_child']."</td>
                            <td width='5%'>
                                <select name='id1'>
                                    <option value='yes'>Yes</option>
                                    <option value='no'>No</option>
                                </select>
                            </td>
                            <td width='20%'>
                                <textarea rows='4' placeholder='Note' id='note1'></textarea>
                            </td>"
                        );
                    }else{
                        array_push($item_list,
                            "
                            <td width='45%'>".$question_row['criterion_child']."</td>
                            <td width='5%'>
                                <select required='required' name='".$question_row['survey_id']."_ans'>
                                    <option value='yes'>Yes</option>
                                    <option value='no'>No</option>
                                </select>
                            </td>
                            <td width='20%'>
                                <textarea rows='4' placeholder='Note' name='".$question_row['survey_id']."_note'></textarea>
                            </td>"
                        );
                    }
                    $child_index += 1;
                }else{
                    $rowspan = $action_row_span > 0 ? $action_row_span: 1;
                    $col_span = 1;
                    $reference_ele= "<td width='5%' rowspan='".$rowspan."'>".$reference."</td>";
                    if($action == "Target Diversity&Inclusion"){
                        $col_span = 2;
                        $reference_ele = "";
                    }
                    array_push($item_list,
                        "
                    $reference_ele
                    <td width='10%' colspan='".$col_span."'>".$requirement."</td>
                    <td width='45%' colspan='2'>".$question_row['criterion_parent']."</td>
                    <td width='5%'>
                        <select name='id1'>
                            <option value='yes'>Yes</option>
                            <option value='no'>No</option>
                        </select>
                    </td>
                    <td width='20%'>
                        <textarea rows='4' placeholder='Note' id='note1'></textarea>
                    </td>");
                    $rendered = true;
                }
            }
            $total_row_span += $action_row_span;
        }
        $row_span = sizeof($item_list);
        $index = 0;
        foreach ($item_list as $each_item){
            if($action == "Target Diversity&Inclusion"){
                echo "<tr>";
            }else{
                echo "<tr>";
            }
            if($index == 0){
                echo "<td width='15%' rowspan='".$row_span."'>".$action."</td>";
            }
            echo $each_item;
            echo "</tr>";
            $index += 1;
        }
    }
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
}

add_shortcode("survey_form", "surveyForm");