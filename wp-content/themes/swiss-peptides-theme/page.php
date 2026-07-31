<?php
/**
 * Standard WordPress Page Template
 */
if (is_front_page()) {
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
