<?php
if(!isset($_GET['key'])||$_GET['key']!=='sp2026secure')die('Unauthorized');
require_once(dirname(__FILE__).'/../../../wp-load.php');
header('Content-Type: text/plain; charset=utf-8');

$cart_id = wc_get_page_id('cart');
wp_update_post(['ID' => $cart_id, 'post_title' => 'Carrito']);
echo "Cart title -> Carrito ✓\n";

$checkout_id = wc_get_page_id('checkout');
wp_update_post(['ID' => $checkout_id, 'post_title' => 'Finalizar Compra']);
echo "Checkout title -> Finalizar Compra ✓\n";

// Also add WooCommerce string translations for shipping
add_filter('woocommerce_shipping_free_shipping_instance_option', function($options) {
    $options['title'] = 'Envío gratis';
    return $options;
});

echo "DONE\n";
