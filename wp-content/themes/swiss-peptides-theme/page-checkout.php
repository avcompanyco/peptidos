<?php
/**
 * Template Name: Checkout Premium
 * Custom Checkout — Swiss Peptides Clinical Luxury
 * Replaces default WooCommerce checkout with premium 2-column layout
 */
defined('ABSPATH') || exit;

// If on thank you page, render thankyou template directly
if ( is_wc_endpoint_url( 'order-received' ) ) {
    $order_id = absint( get_query_var( 'order-received' ) );
    $order    = $order_id ? wc_get_order( $order_id ) : false;
    $key      = isset( $_GET['key'] ) ? wc_clean( wp_unslash( $_GET['key'] ) ) : '';
    
    // Security check: verify order key matches
    if ( ! $order || $order->get_order_key() !== $key ) {
        $order = false;
    }
    
    $thankyou_template = locate_template( 'woocommerce/checkout/thankyou.php' );
    if ( $thankyou_template ) {
        include $thankyou_template;
    } else {
        wc_get_template( 'checkout/thankyou.php', array( 'order' => $order ) );
    }
    exit;
}

// Redirect to shop if cart is empty
if (!WC()->cart || WC()->cart->is_empty()) {
    wp_redirect(wc_get_page_permalink('shop'));
    exit;
}

get_header();

$cart_items = WC()->cart->get_cart();
$subtotal   = WC()->cart->get_subtotal();
$total      = WC()->cart->get_total('');
?>

<style>
/* ── Checkout Page Shell ── */
.sp-checkout-page{padding:calc(var(--navbar-height) + 60px) 0 var(--space-4xl);background:var(--bg-secondary);min-height:100vh}
.sp-checkout-breadcrumb{margin-bottom:var(--space-lg);font-size:var(--fs-xs);color:var(--text-muted)}
.sp-checkout-breadcrumb a{color:var(--text-muted);text-decoration:none;transition:color .2s}
.sp-checkout-breadcrumb a:hover{color:var(--accent)}
.sp-checkout-title{font-family:var(--font-heading);font-size:clamp(1.6rem,3vw,2.2rem);font-weight:800;color:var(--navy);margin-bottom:var(--space-2xl)}
.sp-checkout-title span{color:var(--accent)}

/* ── 2-Column Grid ── */
.sp-checkout-grid{display:grid;grid-template-columns:1.2fr .8fr;gap:var(--space-2xl);align-items:start}

/* ── Cards ── */
.sp-checkout-card{background:var(--white);border:1px solid var(--border-color);border-radius:var(--radius-xl);padding:var(--space-2xl);margin-bottom:var(--space-lg);box-shadow:var(--shadow-sm)}
.sp-checkout-card-title{display:flex;align-items:center;gap:var(--space-sm);font-family:var(--font-heading);font-size:var(--fs-lg);font-weight:700;color:var(--navy);margin-bottom:var(--space-xl)}
.sp-step-num{width:30px;height:30px;border-radius:var(--radius-full);background:var(--accent);color:var(--white);display:flex;align-items:center;justify-content:center;font-size:var(--fs-xs);font-weight:700;flex-shrink:0}

/* ── Billing Fields ── */
.sp-checkout-card .woocommerce-billing-fields__field-wrapper{display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md)}
.sp-checkout-card .form-row-wide{grid-column:1/-1}
.sp-checkout-card .form-row label{font-family:var(--font-heading);font-weight:600;font-size:var(--fs-sm);color:var(--navy);margin-bottom:6px;display:block}
.sp-checkout-card .form-row input.input-text,
.sp-checkout-card .form-row select,
.sp-checkout-card .form-row textarea{width:100%;padding:14px 16px;border:1.5px solid var(--border-color);border-radius:var(--radius-lg);font-size:var(--fs-sm);font-family:var(--font-primary);color:var(--navy);background:var(--white);transition:border-color .3s,box-shadow .3s}
.sp-checkout-card .form-row input.input-text:focus,
.sp-checkout-card .form-row select:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 4px rgba(14,165,233,.08)}
.sp-checkout-card .form-row .required{color:var(--accent)}
.sp-checkout-card .form-row.woocommerce-invalid .input-text{border-color:#ef4444}

/* ── Payment Section ── */
.sp-checkout-card #payment{background:transparent!important;border:none!important;padding:0!important;border-radius:0!important}
.sp-checkout-card #payment ul.payment_methods{list-style:none;padding:0;margin:0 0 var(--space-lg)}
.sp-checkout-card #payment ul.payment_methods li{padding:var(--space-lg);border:1.5px solid var(--border-color);border-radius:var(--radius-xl);background:var(--white);margin-bottom:var(--space-sm);transition:border-color .3s}
.sp-checkout-card #payment ul.payment_methods li:hover,
.sp-checkout-card #payment ul.payment_methods li.wc_payment_method input:checked ~ *{border-color:var(--accent)}
.sp-checkout-card #payment ul.payment_methods li label{font-family:var(--font-heading);font-weight:600;color:var(--navy);cursor:pointer;display:flex;align-items:center;gap:var(--space-sm)}
.sp-checkout-card #payment .payment_box{padding:var(--space-md) 0 0;background:transparent!important;color:var(--gray-600);font-size:var(--fs-sm)}
.sp-checkout-card #payment .payment_box::before{display:none!important}

/* ── Stripe Elements ── */
.sp-checkout-card .StripeElement,
.sp-checkout-card .wc-stripe-elements-field{padding:14px 16px;border:1.5px solid var(--border-color);border-radius:var(--radius-lg);background:var(--white);transition:border-color .3s,box-shadow .3s}
.sp-checkout-card .StripeElement--focus{border-color:var(--accent);box-shadow:0 0 0 4px rgba(14,165,233,.08)}
.sp-checkout-card .StripeElement--invalid{border-color:#ef4444}

/* Place Order Button */
.sp-checkout-card #place_order{width:100%;padding:18px 24px;font-family:var(--font-heading);font-size:var(--fs-md);font-weight:700;background:var(--navy);color:var(--white);border:none;border-radius:var(--radius-xl);cursor:pointer;transition:all .3s;margin-top:var(--space-lg);letter-spacing:0}
.sp-checkout-card #place_order:hover{background:var(--accent);transform:translateY(-2px);box-shadow:0 8px 25px rgba(14,165,233,.25)}

/* ── Order Summary Sidebar ── */
.sp-order-summary{background:var(--white);border:1px solid var(--border-color);border-radius:var(--radius-xl);padding:var(--space-2xl);position:sticky;top:calc(var(--navbar-height) + var(--space-lg));box-shadow:var(--shadow-sm)}
.sp-order-summary h3{font-family:var(--font-heading);font-size:var(--fs-lg);font-weight:700;color:var(--navy);margin-bottom:var(--space-xl)}
.sp-order-item{display:flex;gap:var(--space-md);padding:var(--space-md) 0;border-bottom:1px solid var(--border-subtle);align-items:center}
.sp-order-item:last-of-type{border-bottom:none}
.sp-order-item-img{width:56px;height:56px;background:var(--gray-50);border-radius:var(--radius-md);overflow:hidden;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid var(--border-color)}
.sp-order-item-img img{max-width:90%;max-height:90%;object-fit:contain}
.sp-order-item-info{flex:1;min-width:0}
.sp-order-item-name{font-weight:600;font-size:var(--fs-sm);color:var(--navy);line-height:1.3}
.sp-order-item-qty{font-size:var(--fs-xs);color:var(--gray-500);margin-top:2px}
.sp-order-item-price{font-weight:700;font-size:var(--fs-sm);color:var(--navy);white-space:nowrap}
.sp-order-row{display:flex;justify-content:space-between;padding:var(--space-sm) 0;font-size:var(--fs-sm)}
.sp-order-total{display:flex;justify-content:space-between;padding:var(--space-md) 0;font-family:var(--font-heading);font-weight:700;font-size:var(--fs-xl);color:var(--navy);border-top:2px solid var(--border-color);margin-top:var(--space-md)}
.sp-trust-badges{display:flex;gap:var(--space-lg);margin-top:var(--space-xl);flex-wrap:wrap;justify-content:center}
.sp-trust-item{display:flex;align-items:center;gap:4px;font-size:var(--fs-xs);color:var(--gray-500)}
.sp-trust-item svg{width:14px;height:14px;color:var(--accent)}
.sp-secure-note{text-align:center;font-size:var(--fs-xs);color:var(--text-muted);margin-top:var(--space-md);display:flex;align-items:center;justify-content:center;gap:6px}
.sp-secure-note svg{width:14px;height:14px;flex-shrink:0}
.sp-edit-cart{display:inline-flex;align-items:center;gap:4px;font-size:var(--fs-xs);color:var(--accent);text-decoration:none;margin-top:var(--space-md);font-weight:500;transition:color .2s}
.sp-edit-cart:hover{color:var(--navy)}

/* ── Responsive ── */
@media(max-width:1024px){
  .sp-checkout-grid{grid-template-columns:1fr}
  .sp-order-summary{position:static;order:-1}
}
@media(max-width:768px){
  .sp-checkout-page{padding:calc(var(--navbar-height)+30px) 0 var(--space-2xl)}
  .sp-checkout-card{padding:var(--space-lg)}
  .sp-checkout-card .woocommerce-billing-fields__field-wrapper{grid-template-columns:1fr}
  .sp-order-summary{padding:var(--space-lg)}
}
</style>

<section class="sp-checkout-page">
  <div class="container">
    <!-- Breadcrumb -->
    <nav class="sp-checkout-breadcrumb">
      <a href="<?php echo home_url(); ?>">Inicio</a>
      <span style="margin:0 var(--space-xs)">/</span>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Tienda</a>
      <span style="margin:0 var(--space-xs)">/</span>
      <a href="<?php echo wc_get_cart_url(); ?>">Carrito</a>
      <span style="margin:0 var(--space-xs)">/</span>
      <span style="color:var(--navy);font-weight:500">Finalizar Compra</span>
    </nav>

    <h1 class="sp-checkout-title">Finalizar <span>Compra</span></h1>

    <?php wc_print_notices(); ?>
    <?php do_action('woocommerce_before_checkout_form', WC()->checkout()); ?>

    <div class="sp-checkout-grid">
      <!-- LEFT: Form -->
      <div>
        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
          <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>

          <!-- Step 1: Contact & Billing -->
          <div class="sp-checkout-card">
            <div class="sp-checkout-card-title">
              <span class="sp-step-num">1</span>Información de contacto
            </div>
            <?php do_action('woocommerce_checkout_billing'); ?>
          </div>

          <!-- Step 2: Shipping (if needed) -->
          <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
          <div class="sp-checkout-card">
            <div class="sp-checkout-card-title">
              <span class="sp-step-num">2</span>Información de envío
            </div>
            <?php do_action('woocommerce_checkout_shipping'); ?>
          </div>
          <?php endif; ?>

          <!-- Step 3: Payment -->
          <div class="sp-checkout-card">
            <div class="sp-checkout-card-title">
              <span class="sp-step-num"><?php echo WC()->cart->needs_shipping() ? '3' : '2'; ?></span>Método de pago
            </div>

            <!-- Stripe Express (Apple/Google Pay) -->
            <div id="wc-stripe-payment-request-wrapper" style="margin-bottom:var(--space-md)"></div>

            <?php
            // Render WooCommerce payment methods + Place Order button
            // This calls the actual function (hooked at priority 20 on woocommerce_checkout_order_review)
            if (function_exists('woocommerce_checkout_payment')) {
                woocommerce_checkout_payment();
            }
            ?>

            <p class="sp-secure-note">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
              Transacción segura procesada por Bold. Tus datos están encriptados con SSL de 256 bits.
            </p>
          </div>
        </form>
      </div>

      <!-- RIGHT: Order Summary -->
      <div class="sp-order-summary">
        <h3>Resumen del pedido</h3>

        <div class="woocommerce-checkout-review-order">
          <?php woocommerce_order_review(); ?>
        </div>

        <div class="sp-trust-badges">
          <div class="sp-trust-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Pago seguro SSL
          </div>
          <div class="sp-trust-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Bold certificado
          </div>
          <div class="sp-trust-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>Datos encriptados
          </div>
        </div>

        <div style="text-align:center">
          <a href="<?php echo wc_get_cart_url(); ?>" class="sp-edit-cart">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Editar carrito
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>