<?php
/**
 * Custom Checkout Template — Swiss Peptides Clinical Luxury
 * Replaces default WooCommerce checkout with premium design matching checkout.html
 */
defined('ABSPATH') || exit;

get_header();

// Ensure WC cart is loaded
if (!WC()->cart) return;
$cart_items = WC()->cart->get_cart();
$subtotal = WC()->cart->get_subtotal();
$total = WC()->cart->get_total('');
?>

<style>
.checkout-page { padding: calc(var(--navbar-height) + 60px) 0 var(--space-4xl); }
.checkout-grid { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: var(--space-3xl); align-items: start; }
.checkout-form-card { background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-xl); padding: var(--space-2xl); }
.checkout-form-title { font-family: var(--font-heading); font-size: var(--fs-lg); font-weight: 700; color: var(--navy); margin-bottom: var(--space-xl); display: flex; align-items: center; gap: var(--space-sm); }
.checkout-form-title .step-num { width: 28px; height: 28px; border-radius: var(--radius-full); background: var(--accent); color: var(--white); display: flex; align-items: center; justify-content: center; font-size: var(--fs-xs); font-weight: 700; flex-shrink: 0; }
.checkout-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-md); }
.order-summary { background: var(--gray-50); border: 1px solid var(--border-color); border-radius: var(--radius-xl); padding: var(--space-2xl); position: sticky; top: calc(var(--navbar-height) + var(--space-lg)); }
.order-summary h3 { font-family: var(--font-heading); font-size: var(--fs-lg); font-weight: 700; color: var(--navy); margin-bottom: var(--space-xl); }
.order-item { display: flex; gap: var(--space-md); padding: var(--space-md) 0; border-bottom: 1px solid var(--border-color); align-items: center; }
.order-item:last-child { border-bottom: none; }
.order-item-img { width: 60px; height: 60px; background: var(--white); border-radius: var(--radius-md); overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid var(--border-color); }
.order-item-img img { max-width: 90%; max-height: 90%; object-fit: contain; }
.order-row { display: flex; justify-content: space-between; padding: var(--space-sm) 0; font-size: var(--fs-sm); }
.order-total { display: flex; justify-content: space-between; padding: var(--space-md) 0; font-family: var(--font-heading); font-weight: 700; font-size: var(--fs-xl); color: var(--navy); border-top: 2px solid var(--border-color); margin-top: var(--space-md); }
.trust-badges-checkout { display: flex; gap: var(--space-lg); margin-top: var(--space-xl); flex-wrap: wrap; justify-content: center; }
.trust-badges-checkout .trust-item { display: flex; align-items: center; gap: 4px; font-size: var(--fs-xs); color: var(--gray-500); }
.trust-badges-checkout svg { width: 14px; height: 14px; color: var(--accent); }
.express-pay-row { display: flex; gap: var(--space-md); margin-bottom: var(--space-lg); }
.express-btn { flex: 1; padding: 14px; border: 1.5px solid var(--border-color); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: var(--space-xs); cursor: pointer; font-size: var(--fs-sm); font-weight: 600; transition: all 0.2s ease; }
.express-btn:hover { opacity: 0.85; }
.express-btn.apple-pay { background: #000; color: #fff; }
.express-btn.google-pay { background: var(--white); color: var(--navy); }
.express-btn.google-pay:hover { border-color: var(--navy); }
.divider-or { display: flex; align-items: center; gap: var(--space-md); margin-bottom: var(--space-lg); }
.divider-or::before, .divider-or::after { content: ''; flex: 1; height: 1px; background: var(--border-color); }
.divider-or span { font-size: var(--fs-xs); color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em; }
.card-box { border: 1.5px solid var(--accent); border-radius: var(--radius-lg); padding: var(--space-lg); background: rgba(14,165,233,0.02); }
.card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-lg); }
.card-brands { display: flex; gap: 6px; align-items: center; }
@media(max-width: 768px) { .checkout-grid { grid-template-columns: 1fr; } .checkout-form-row { grid-template-columns: 1fr; } .order-summary { position: static; } }
</style>

<section class="checkout-page">
  <div class="container">
    <nav style="margin-bottom:var(--space-xl);font-size:var(--fs-xs);color:var(--text-muted);">
      <a href="<?php echo home_url(); ?>" style="color:var(--text-muted);">Inicio</a>
      <span style="margin:0 var(--space-xs);">/</span>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" style="color:var(--text-muted);">Tienda</a>
      <span style="margin:0 var(--space-xs);">/</span>
      <span style="color:var(--navy);font-weight:500;">Finalizar Compra</span>
    </nav>

    <h1 style="font-size:var(--fs-2xl);margin-bottom:var(--space-2xl);">Finalizar <span class="text-gradient">Compra</span></h1>

    <?php wc_print_notices(); ?>
    <?php do_action('woocommerce_before_checkout_form', $checkout); ?>

    <div class="checkout-grid">
      <!-- LEFT: Checkout Form -->
      <div>
        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
          <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>

          <!-- Step 1: Contact Info -->
          <div class="checkout-form-card" style="margin-bottom:var(--space-lg);">
            <div class="checkout-form-title"><span class="step-num">1</span>Informacion de contacto</div>
            <?php do_action('woocommerce_checkout_billing'); ?>
          </div>

          <!-- Step 2: Payment -->
          <div class="checkout-form-card">
            <div class="checkout-form-title"><span class="step-num">2</span>Metodo de pago</div>

            <!-- Stripe Express Checkout (Apple/Google Pay) -->
            <div id="wc-stripe-payment-request-wrapper" style="margin-bottom:var(--space-md);"></div>

            <!-- Card Payment -->
            <?php do_action('woocommerce_checkout_payment'); ?>

            <p style="text-align:center;font-size:var(--fs-xs);color:var(--text-muted);margin-top:var(--space-md);">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
              Transaccion segura procesada por Stripe. Tus datos estan encriptados con SSL de 256 bits.
            </p>
          </div>
        </form>
      </div>

      <!-- RIGHT: Order Summary -->
      <div class="order-summary">
        <h3>Resumen del pedido</h3>

        <div class="woocommerce-checkout-review-order">
          <?php woocommerce_order_review(); ?>
        </div>

        <div class="trust-badges-checkout">
          <div class="trust-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Pago seguro SSL
          </div>
          <div class="trust-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Stripe certificado
          </div>
          <div class="trust-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>Datos encriptados
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
