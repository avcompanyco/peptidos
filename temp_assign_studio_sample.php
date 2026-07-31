<?php
require_once('/www/wwwroot/peptidossuizos.com/wp-load.php');
require_once('/www/wwwroot/peptidossuizos.com/wp-admin/includes/image.php');
require_once('/www/wwwroot/peptidossuizos.com/wp-admin/includes/file.php');
require_once('/www/wwwroot/peptidossuizos.com/wp-admin/includes/media.php');

$image_mapping = array(
    59 => 'klowxtreme_studio_example_1784930371993.jpg',
    47 => 'glutapurex_box_vial_studio_1784930434268.jpg'
);

$upload_dir = wp_upload_dir();
$base_path = $upload_dir['basedir'] . '/2026/07/';

foreach ($image_mapping as $pid => $filename) {
    $filepath = $base_path . $filename;
    if (!file_exists($filepath)) {
        echo "Server file $filepath does not exist!\n";
        continue;
    }
    
    global $wpdb;
    $post_title = sanitize_file_name(pathinfo($filename, PATHINFO_FILENAME));
    
    // Create new attachment
    $filetype = wp_check_filetype(basename($filepath), null);
    $attachment = array(
        'post_mime_type' => $filetype['type'],
        'post_title'     => $post_title,
        'post_content'   => '',
        'post_status'    => 'inherit'
    );
    $attachment_id = wp_insert_attachment($attachment, $filepath, $pid);
    if (!is_wp_error($attachment_id)) {
        $attach_data = wp_generate_attachment_metadata($attachment_id, $filepath);
        wp_update_attachment_metadata($attachment_id, $attach_data);
        set_post_thumbnail($pid, $attachment_id);
        echo "SUCCESS: Assigned new featured image $attachment_id to product $pid\n";
    } else {
        echo "FAILED for product $pid\n";
    }
}
