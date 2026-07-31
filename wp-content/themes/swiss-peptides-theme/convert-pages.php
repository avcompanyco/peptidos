<?php
if(!isset($_GET['key'])||$_GET['key']!=='sp2026secure')die('Unauthorized');
require_once(dirname(__FILE__).'/../../../wp-load.php');
header('Content-Type: text/plain; charset=utf-8');

// Convert Cart page to classic shortcode
$cart_id = wc_get_page_id('cart');
wp_update_post([
    'ID' => $cart_id,
    'post_content' => '<!-- wp:shortcode -->[woocommerce_cart]<!-- /wp:shortcode -->',
]);
echo "Cart page converted to classic shortcode ✓\n";

// Convert Checkout page to classic shortcode
$checkout_id = wc_get_page_id('checkout');
wp_update_post([
    'ID' => $checkout_id,
    'post_content' => '<!-- wp:shortcode -->[woocommerce_checkout]<!-- /wp:shortcode -->',
]);
echo "Checkout page converted to classic shortcode ✓\n";

echo "\nDONE\n";
