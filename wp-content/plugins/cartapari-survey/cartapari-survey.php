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
require_once( ABSPATH . 'wp-content/plugins/cartapari-survey/util/form_rendering.php');

add_action("wp_enqueue_scripts","render_css");
add_action("admin_menu", "addMenu");
function addMenu(){
    add_menu_page("CartaPari Survey", "CartaPari Survey", "edit_pages", "cartapari-survey", "cartapariSurvey");
    add_submenu_page("cartapari-survey", "Export Data", "Export", "edit_pages", "cartapari-survey-export", "exportCartapariSurveyData");
}

function cartapariSurvey(){
    echo "Dashboard....";
}

function exportCartapariSurveyData(){
    echo "Exporting..";
    surveyForm();

}

register_activation_hook( __FILE__, 'createRequiredTables' );
register_deactivation_hook( __FILE__, 'drop_tables' );

function render_css(){
    wp_register_style('render',get_template_directory_uri() . '/assets/css/formRenter');
}