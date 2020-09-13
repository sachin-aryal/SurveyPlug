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
require_once(ABSPATH .'wp-content/plugins/cartapari-survey/util/form_render.php');


add_action("admin_menu", "addMenu");
function addMenu(){
    add_menu_page("CartaPari Survey", "CartaPari Survey", "edit_pages", "cartapari-survey", "cartapariSurvey");
    add_submenu_page("cartapari-survey", "Export Data", "Export", "edit_pages", "cartapari-survey-export", "exportCartapariSurveyData");
}

function cartapariSurvey(){
    echo "Dashbaord...";
}

function exportCartapariSurveyData(){
    surveyForm();
}