<?php
if (is_front_page() || is_home() || (isset($post) && $post->ID == 12) || $_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php') {
    include __DIR__ . '/front-page.php';
    exit;
}

get_header();
if (have_posts()) :
    while (have_posts()) : the_post();
        the_content();
    endwhile;
endif;
get_footer();
