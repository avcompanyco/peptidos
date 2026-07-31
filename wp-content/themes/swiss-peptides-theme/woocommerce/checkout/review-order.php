<?php
/**
 * Custom Order Review template for WooCommerce — Swiss Peptides
 * Renders the checkout sidebar order summary and updates dynamically via AJAX.
 */
defined('ABSPATH') || exit;

$cart_items = WC()->cart->get_cart();
$subtotal   = WC()->cart->get_subtotal();
?>

<div class="woocommerce-checkout-review-order-table">
    <!-- Products Loop -->
    <?php foreach ($cart_items as $cart_item_key => $cart_item) :
        $product = $cart_item['data'];
        $product_name = $product->get_name();
        $product_price = $product->get_price();
        $qty = $cart_item['quantity'];
        $subtotal_item = $product_price * $qty;
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($cart_item['product_id']), 'thumbnail');
        $image_url = $image ? $image[0] : wc_placeholder_img_src('thumbnail');
    ?>
    <div class="sp-order-item">
        <div class="sp-order-item-img"><img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($product_name); ?>"></div>
        <div class="sp-order-item-info">
            <div class="sp-order-item-name"><?php echo esc_html($product_name); ?></div>
            <div class="sp-order-item-qty">Cant: <?php echo $qty; ?></div>
        </div>
        <div class="sp-order-item-price">$ <?php echo number_format($subtotal_item, 0, ',', '.'); ?></div>
    </div>
    <?php endforeach; ?>

    <!-- Totals Area -->
    <div style="margin-top:var(--space-lg)">
        <!-- Subtotal -->
        <div class="sp-order-row">
            <span style="color:var(--gray-600)">Subtotal</span>
            <span style="font-weight:600">$ <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
        </div>

        <!-- Coupons (applied coupons list) -->
        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : 
            $discount = WC()->cart->get_coupon_discount_amount($code);
        ?>
        <div class="sp-order-row coupon-row" style="color:var(--accent); font-weight: 500;">
            <span>Cupón: <strong><?php echo esc_html($code); ?></strong></span>
            <span style="font-weight:700">-$ <?php echo number_format($discount, 0, ',', '.'); ?></span>
        </div>
        <?php endforeach; ?>

        <!-- Shipping -->
        <?php $shipping_total = WC()->cart->get_shipping_total(); ?>
        <div class="sp-order-row">
            <span style="color:var(--gray-600)">Envío</span>
            <span style="color:var(--success);font-weight:500">
                <?php echo ($shipping_total > 0) ? '$ ' . number_format($shipping_total, 0, ',', '.') : 'Gratis'; ?>
            </span>
        </div>

        <!-- Total -->
        <div class="sp-order-total">
            <span>Total</span>
            <span><?php echo WC()->cart->get_total(); ?></span>
        </div>
    </div>
</div>
