<?php
require_once dirname(__FILE__) . '/wp-load.php';
if (!current_user_can('manage_options')) die('Unauthorized');
switch_theme('swiss-peptides-theme');
echo 'Theme activated: ' . wp_get_theme()->get('Name');
