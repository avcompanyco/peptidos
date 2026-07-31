<?php
define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-load.php');

// Assign page-checkout.php template to Checkout page (ID 9)
update_post_meta(9, '_wp_page_template', 'page-checkout.php');
echo "Checkout page (ID 9) template: " . get_post_meta(9, '_wp_page_template', true) . "\n";

// Assign page-cart.php template to Cart page (ID 8)
update_post_meta(8, '_wp_page_template', 'page-cart.php');
echo "Cart page (ID 8) template: " . get_post_meta(8, '_wp_page_template', true) . "\n";

// Verify pages exist and are published
$checkout = get_post(9);
echo "Checkout slug: " . $checkout->post_name . " status: " . $checkout->post_status . "\n";

$cart = get_post(8);
echo "Cart slug: " . $cart->post_name . " status: " . $cart->post_status . "\n";

echo "DONE\n";
