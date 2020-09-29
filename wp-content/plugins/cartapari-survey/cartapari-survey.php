<?php
/**
 * @package CartaPariSurvey Plugin
 */

/*
 * Plugin Name: CartaPari Survey
 * Plugin URI: https://www.cartapariopportunita.it/
 * Description: This is Carta Pari Survey Plugin
 * Version: 1.0.0
 * Author: CartaPari
 * Author URI: https://www.cartapariopportunita.it/
 * License: GPLv2 or later
 * Text Domain: CartaPari Survey
 */

defined('ABSPATH') or die("go away and bring abs path.");
function_exists('add_action') or die("go away and bring the add_action.");

require_once(ABSPATH . 'wp-config.php');
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
require_once( ABSPATH . 'wp-content/plugins/cartapari-survey/util/install.php');
require_once( ABSPATH . 'wp-content/plugins/cartapari-survey/util/form_render.php');
require_once( ABSPATH . 'wp-content/plugins/cartapari-survey/util/form_render_submit.php');
require_once( ABSPATH . 'wp-content/plugins/cartapari-survey/util/data-exporter.php');

add_action("wp_enqueue_scripts","render_css");
add_action("admin_menu", "addMenu");
function addMenu(){
    add_menu_page("Questionario Pari opportunita", "Questionario Pari opportunita", "edit_pages", "questionario-pari-opportunita", "cartapariSurvey");
//    add_submenu_page("questionario-pari-opportunita", "Export Data", "Survey Form", "edit_pages", "cartapari-survey-export", "exportCartapariSurveyData");
}

function cartapariSurvey(){
    echo '
    <div id="treecontrol" style="width: 80%;margin: 30px auto;">
    <form method="post" id="download_form" action="">
    <input type="submit" name="download_excel_report" class="button-primary" value="Download Report" />
    </form>
    </div>';
    require_once('util/_chart.php');
}

function exportCartapariSurveyData(){
    surveyForm();
}

register_activation_hook( __FILE__, 'createRequiredTables' );
register_deactivation_hook( __FILE__, 'drop_tables' );

function render_css(){
    wp_register_style('render',get_template_directory_uri() . '/assets/css/formRenter');
}