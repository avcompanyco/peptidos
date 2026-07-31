<?php
if(!isset($_GET['key'])||$_GET['key']!=='sp2026secure')die('Unauthorized');
require_once(dirname(__FILE__).'/../../../wp-load.php');
header('Content-Type: text/plain; charset=utf-8');

$cart_id = wc_get_page_id('cart');
$checkout_id = wc_get_page_id('checkout');

echo "Cart Page ID: $cart_id\n";
echo "Cart Content:\n" . get_post($cart_id)->post_content . "\n\n";
echo "Checkout Page ID: $checkout_id\n";
echo "Checkout Content:\n" . get_post($checkout_id)->post_content . "\n\n";

// Check if using blocks or shortcodes
echo "=== Analysis ===\n";
$cart_content = get_post($cart_id)->post_content;
$checkout_content = get_post($checkout_id)->post_content;

if(strpos($cart_content, 'wp:woocommerce/cart') !== false) echo "Cart: USING BLOCKS (Gutenberg)\n";
elseif(strpos($cart_content, '[woocommerce_cart]') !== false) echo "Cart: USING SHORTCODE (Classic)\n";
else echo "Cart: UNKNOWN FORMAT\n";

if(strpos($checkout_content, 'wp:woocommerce/checkout') !== false) echo "Checkout: USING BLOCKS (Gutenberg)\n";
elseif(strpos($checkout_content, '[woocommerce_checkout]') !== false) echo "Checkout: USING SHORTCODE (Classic)\n";
else echo "Checkout: UNKNOWN FORMAT\n";
