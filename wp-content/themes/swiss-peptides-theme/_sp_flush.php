<?php
define('ABSPATH', dirname(__FILE__) . '/../../../');
require_once ABSPATH . 'wp-load.php';
header('Content-Type: text/plain; charset=utf-8');

// Flush SpeedyCache
if (function_exists('speedycache_delete_cache')) {
    speedycache_delete_cache();
    echo "SpeedyCache flushed\n";
}

// Delete cache files manually
$cache_dir = ABSPATH . 'wp-content/cache/speedycache/';
if (is_dir($cache_dir)) {
    $it = new RecursiveDirectoryIterator($cache_dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    $count = 0;
    foreach ($files as $f) {
        if ($f->isDir()) {
            @rmdir($f->getRealPath());
        } else {
            @unlink($f->getRealPath());
            $count++;
        }
    }
    echo "Deleted $count cache files\n";
}

// Also clear WP transients
global $wpdb;
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");
echo "Transients cleared\n";

// Check for NAD+ product image
$nad = get_page_by_path('nad-plus', OBJECT, 'product');
if ($nad) {
    $thumb = get_post_thumbnail_id($nad->ID);
    echo "NAD+ ID: {$nad->ID}, Thumbnail ID: " . ($thumb ?: 'NONE') . "\n";
}

echo "DONE\n";
