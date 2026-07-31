<?php
define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-load.php');

// Check reading settings
$page_for_posts = get_option('page_for_posts');
$show_on_front = get_option('show_on_front');
$page_on_front = get_option('page_on_front');

echo "show_on_front: $show_on_front\n";
echo "page_on_front: $page_on_front\n";
echo "page_for_posts: $page_for_posts\n";

// If page 16 is set as blog posts page, that overrides the template
if ($page_for_posts == 16) {
    echo "FIX: Page 16 is set as Posts page - this overrides the custom template!\n";
    // Unset it - let WordPress use the custom page template instead
    update_option('page_for_posts', 0);
    echo "FIXED: page_for_posts set to 0\n";
} else {
    echo "page_for_posts is NOT 16, checking template...\n";
}

// Verify the page template
$template = get_post_meta(16, '_wp_page_template', true);
echo "Page 16 template: $template\n";

echo "DONE\n";
