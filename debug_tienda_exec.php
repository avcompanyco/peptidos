<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$_SERVER['REQUEST_URI'] = '/tienda/';
$_SERVER['HTTP_HOST'] = 'peptidossuizos.com';
$_SERVER['SERVER_NAME'] = 'peptidossuizos.com';
$_SERVER['REQUEST_METHOD'] = 'GET';

define('WP_USE_THEMES', true);
require_once('/www/wwwroot/peptidossuizos.com/wp-load.php');
wp();
require_once(get_template_directory() . '/page-tienda.php');
