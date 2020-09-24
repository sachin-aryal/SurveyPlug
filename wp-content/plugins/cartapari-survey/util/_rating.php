<?php
require_once 'helper.php';
require_once('constant.php');

echo "<div id = 'test'>";
    echo "<div class = 'average-total'>";
        echo "<div class = 'title'>Hello all</div>";
        echo "<div class = 'value'>hi</div>";
    echo "</div>";
    echo "<div>";
    echo "</div>";
echo "</div>";;
echo "<button onclick='javascript:demoFromHTML();'>PDF</button>";
echo "<script src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js'></script>";
echo "<script>
function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    source = $('#test')[0];
    specialElementHandlers = {
        
        '#bypassme': function (element, renderer) {
            
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Test.pdf');
    }, margins);
}
</script>";

?>