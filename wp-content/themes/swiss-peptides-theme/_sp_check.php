<?php
define('ABSPATH', dirname(__FILE__) . '/../../../');
require_once ABSPATH . 'wp-load.php';
header('Content-Type: text/plain; charset=utf-8');
$q = new WP_Query(['post_type'=>'product','posts_per_page'=>-1,'post_status'=>'publish']);
$missing = [];
while($q->have_posts()){$q->the_post();
  $id=get_the_ID();
  $thumb=get_post_thumbnail_id($id);
  if(!$thumb) $missing[] = get_the_title()." (ID:$id, slug:".get_post_field('post_name',$id).")";
}
wp_reset_postdata();
if(empty($missing)) echo "ALL PRODUCTS HAVE IMAGES\n";
else { echo count($missing)." products missing images:\n"; foreach($missing as $m) echo "  - $m\n"; }
