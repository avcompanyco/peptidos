<?php
define('ABSPATH', dirname(__FILE__) . '/../../../');
require_once ABSPATH . 'wp-load.php';
header('Content-Type: text/plain; charset=utf-8');

$args = array('post_type'=>'product','posts_per_page'=>-1,'post_status'=>'publish','orderby'=>'ID','order'=>'ASC');
$q = new WP_Query($args);
while ($q->have_posts()) {
    $q->the_post();
    $id = get_the_ID();
    $p = wc_get_product($id);
    echo "=== ID:$id | " . $p->get_name() . " ===\n";
    echo "SHORT: " . substr(wp_strip_all_tags($p->get_short_description()), 0, 200) . "\n";
    echo "DESC_LEN: " . strlen($p->get_description()) . "\n\n";
}
wp_reset_postdata();
