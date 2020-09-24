<?php
require_once 'helper.php';
require_once('constant.php');

$company_id = $row -> id;
$company_type = $row -> company_type;
$no_of_employee = $row -> no_of_employee;

$my_ratings = get_my_rating($wpdb, $company_id, $table_name_mapping["total_rating"]);
$companies = get_related_company_ids($wpdb, $table_name_mapping["company_info"], $company_type, $no_of_employee);
$company_ids = array();
foreach ($companies as $company){
    array_push($company_ids, $company->id);
}
$company_ids = join("','",$company_ids);
$best_ratings = get_best_rating($wpdb, $table_name_mapping["total_rating"], $company_ids);
$average_ratings = get_average_rating($wpdb, $table_name_mapping["total_rating"], $company_ids);
$my_data_points = array();
foreach($my_ratings as $index=>$my_rating){
    array_push($my_data_points, array("label" => $index+1, "y"=> (int)$my_rating->survey_total_rating));
}
$best_data_points = array();
foreach($best_ratings as $index=>$best_rating){
    array_push($best_data_points, array("label" => $index+1, "y"=> (int)$best_rating->survey_total_rating));
}

$average_data_points = array();
foreach($average_ratings as $index=>$average_rating){
    array_push($average_data_points, array("label" => $index+1, "y"=> (int)$average_rating->survey_total_rating));
}
?>
<script>
    let my_data_points = <?php echo json_encode($my_data_points) ?>;
    let best_data_points = <?php echo json_encode($best_data_points) ?>;
    let average_data_points = <?php echo json_encode($average_data_points) ?>;
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title:{
                text: "Punteggio di confronto"
            },
            axisY: {
                title: "Punteggio",
                titleFontColor: "#4F81BC",
                lineColor: "#4F81BC",
                labelFontColor: "#4F81BC",
                tickColor: "#4F81BC",
                maximum: 101
            },
            toolTip: {
                shared: true
            },
            data: [
                {
                    color: "#FC4971",
                    type: "column",
                    name: "Mio Punteggio",
                    legendText: "Mio Punteggio",
                    showInLegend: true,
                    dataPoints:my_data_points
                }, {
                    color: "#504E64",
                    type: "column",
                    name: "Punteggio Best In Class",
                    legendText: "Punteggio Best In Class",
                    showInLegend: true,
                    dataPoints:best_data_points
                }, {
                    color: "blue",
                    type: "spline",
                    name: "Punteggio Medio",
                    legendText: "Punteggio Medio",
                    showInLegend: true,
                    dataPoints:average_data_points
                }]
        });
        chart.render();
    }
</script>
<div id="chartContainer" style="height: 370px; width: 80%;margin: 0 auto"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
