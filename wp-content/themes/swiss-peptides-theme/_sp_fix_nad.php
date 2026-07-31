<?php
define('ABSPATH', dirname(__FILE__) . '/../../../');
require_once ABSPATH . 'wp-load.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
header('Content-Type: text/plain; charset=utf-8');

$image_url = 'https://swisspeptideslabs.com/wp-content/uploads/2025/09/NAD-1000mgg-Full.png';
$product_id = 69;

// Download and sideload
$tmp = download_url($image_url);
if (is_wp_error($tmp)) {
    echo "Download error: " . $tmp->get_error_message() . "\n";
    exit;
}

$file_array = [
    'name' => 'NAD-1000mg-Full.png',
    'tmp_name' => $tmp,
];

$attach_id = media_handle_sideload($file_array, $product_id, 'NAD+ Product Image');
if (is_wp_error($attach_id)) {
    @unlink($tmp);
    echo "Sideload error: " . $attach_id->get_error_message() . "\n";
    exit;
}

set_post_thumbnail($product_id, $attach_id);
echo "SUCCESS: NAD+ image attached (attachment ID: $attach_id)\n";

// Verify
$thumb = get_post_thumbnail_id($product_id);
echo "Verify thumbnail ID: $thumb\n";
$url = wp_get_attachment_url($thumb);
echo "Image URL: $url\n";
