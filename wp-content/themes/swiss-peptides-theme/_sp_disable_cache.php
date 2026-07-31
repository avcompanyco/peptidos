<?php
define('ABSPATH', dirname(__FILE__) . '/../../../');
require_once ABSPATH . 'wp-load.php';
header('Content-Type: text/plain; charset=utf-8');

// Deactivate SpeedyCache
$active_plugins = get_option('active_plugins', []);
$removed = 0;
$new_plugins = [];
foreach ($active_plugins as $p) {
    if (strpos($p, 'speedycache') !== false) {
        $removed++;
        echo "Deactivated: $p\n";
    } else {
        $new_plugins[] = $p;
    }
}
if ($removed > 0) {
    update_option('active_plugins', $new_plugins);
    echo "SpeedyCache deactivated!\n";
} else {
    echo "SpeedyCache was not in active plugins\n";
}

// Delete cache files
$cache_dir = ABSPATH . 'wp-content/cache/speedycache/';
if (is_dir($cache_dir)) {
    $it = new RecursiveDirectoryIterator($cache_dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($files as $f) {
        if ($f->isDir()) @rmdir($f->getRealPath()); else @unlink($f->getRealPath());
    }
    echo "Cache files deleted\n";
}

echo "DONE\n";
