<?php
/**
 * WooCommerce Checkout
 */
get_header();
?>

<style>
.checkout-wrap{padding:calc(var(--navbar-height) + 30px) 0 var(--space-3xl)}
.checkout-grid{display:grid;grid-template-columns:1.2fr .8fr;gap:var(--space-3xl);align-items:start}
.checkout-card{background:var(--white);border:1px dashed var(--border-color);border-radius:var(--radius-xl);padding:var(--space-2xl)}
.checkout-step{display:flex;align-items:center;gap:var(--space-md);margin-bottom:var(--space-xl)}
.checkout-step-num{width:32px;height:32px;border-radius:50%;background:var(--accent);color:var(--white);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:var(--fs-sm)}
.checkout-step h3{font-family:var(--font-heading);font-weight:700;color:var(--navy);font-size:var(--fs-lg)}
.checkout-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md)}
.checkout-field label{display:block;font-weight:600;font-size:var(--fs-sm);color:var(--navy);margin-bottom:6px}
.checkout-field input,.checkout-field textarea,.checkout-field select{width:100%;padding:12px 16px;border:1px solid var(--border-color);border-radius:var(--radius-lg);font-size:var(--fs-base);font-family:var(--font-body);transition:border-color .3s;background:var(--white)}
.checkout-field input:focus,.checkout-field textarea:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(14,165,233,.1)}
.checkout-field.full{grid-column:1/-1}
.order-summary{background:var(--white);border:1px dashed var(--border-color);border-radius:var(--radius-xl);padding:var(--space-2xl);position:sticky;top:calc(var(--navbar-height) + 20px)}
.order-item{display:flex;gap:var(--space-md);padding:var(--space-md) 0;border-bottom:1px solid var(--border-subtle)}
.order-item-img{width:60px;height:60px;border-radius:var(--radius-md);overflow:hidden;flex-shrink:0;background:var(--gray-50)}
.order-item-img img{width:100%;height:100%;object-fit:cover}
.payment-section{margin-top:var(--space-2xl)}
.express-pay{display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md);margin-bottom:var(--space-lg)}
.express-btn{padding:14px;border-radius:var(--radius-lg);border:1px solid var(--border-color);cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;font-weight:600;font-size:var(--fs-sm);transition:all .3s}
.express-btn.apple{background:#000;color:#fff;border-color:#000}
.express-btn.google{background:#fff;color:#333;border-color:var(--border-color)}
.express-btn:hover{opacity:.85}
.divider-text{display:flex;align-items:center;gap:var(--space-md);margin:var(--space-lg) 0;color:var(--text-muted);font-size:var(--fs-xs);text-transform:uppercase;letter-spacing:.1em}
.divider-text::before,.divider-text::after{content:'';flex:1;height:1px;background:var(--border-color)}
.card-form{border:1px solid var(--accent);border-radius:var(--radius-xl);padding:var(--space-xl)}
.card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-lg)}
.card-brands{display:flex;gap:6px}
.card-brand{width:36px;height:24px;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;color:white}
.pay-btn{width:100%;padding:18px;background:var(--navy);color:var(--white);border:none;border-radius:var(--radius-lg);font-size:var(--fs-md);font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .3s;margin-top:var(--space-xl);font-family:var(--font-heading)}
.pay-btn:hover{background:var(--navy-light);transform:translateY(-1px)}
.security-note{text-align:center;margin-top:var(--space-md);font-size:var(--fs-xs);color:var(--text-muted);display:flex;align-items:center;justify-content:center;gap:6px}
@media(max-width:768px){.checkout-grid{grid-template-columns:1fr}.checkout-form-grid{grid-template-columns:1fr}.express-pay{grid-template-columns:1fr}}
</style>

<section class="checkout-wrap">
  <div class="container">
    <nav style="font-size:var(--fs-sm);color:var(--text-muted);margin-bottom:var(--space-lg);">
      <a href="<?php echo home_url(); ?>" style="color:var(--text-muted);">Inicio</a> /
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" style="color:var(--text-muted);">Tienda</a> /
      <span style="color:var(--text-primary);font-weight:600;">Checkout</span>
    </nav>

    <h1 style="font-family:var(--font-heading);font-size:var(--fs-3xl);font-weight:800;color:var(--navy);margin-bottom:var(--space-2xl);">
      Finalizar <span class="text-gradient">Compra</span>
    </h1>

    <?php do_action('woocommerce_before_checkout_form', WC()->checkout()); ?>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

      <div class="checkout-grid">
        <!-- Left: Form -->
        <div>
          <div class="checkout-card">
            <div class="checkout-step">
              <div class="checkout-step-num">1</div>
              <h3>Informacion de contacto</h3>
            </div>
            <div class="checkout-form-grid">
              <?php do_action('woocommerce_checkout_billing'); ?>
              <?php do_action('woocommerce_checkout_shipping'); ?>
            </div>
          </div>

          <!-- Payment -->
          <div class="checkout-card payment-section">
            <div class="checkout-step">
              <div class="checkout-step-num">2</div>
              <h3>Metodo de pago</h3>
            </div>

            <!-- Express -->
            <div class="express-pay">
              <button type="button" class="express-btn apple"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83"/><path d="M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11"/></svg> Apple Pay</button>
              <button type="button" class="express-btn google"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg> Google Pay</button>
            </div>

            <div class="divider-text">o paga con tarjeta</div>

            <!-- Card form (Stripe Elements will mount here) -->
            <div class="card-form">
              <div class="card-header">
                <div style="display:flex;align-items:center;gap:8px;">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                  <span style="font-weight:700;color:var(--navy);">Tarjeta de credito / debito</span>
                </div>
                <div class="card-brands">
                  <div class="card-brand" style="background:#1A1F71;">VISA</div>
                  <div class="card-brand" style="background:#EB001B;">MC</div>
                  <div class="card-brand" style="background:#006FCF;">AMEX</div>
                </div>
              </div>
              <?php do_action('woocommerce_checkout_payment'); ?>
            </div>
          </div>
        </div>

        <!-- Right: Order Summary -->
        <div class="order-summary">
          <h3 style="font-family:var(--font-heading);font-weight:800;color:var(--navy);margin-bottom:var(--space-lg);">Resumen del pedido</h3>

          <?php do_action('woocommerce_checkout_order_review'); ?>

          <div style="display:flex;justify-content:center;gap:var(--space-lg);margin-top:var(--space-lg);padding-top:var(--space-md);border-top:1px solid var(--border-subtle);">
            <span class="trust-badge-item" style="font-size:11px;color:var(--text-muted);display:flex;align-items:center;gap:4px;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Pago seguro SSL</span>
            <span class="trust-badge-item" style="font-size:11px;color:var(--text-muted);display:flex;align-items:center;gap:4px;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Stripe certificado</span>
          </div>
          <div style="text-align:center;margin-top:8px;">
            <span style="font-size:11px;color:var(--text-muted);display:flex;align-items:center;justify-content:center;gap:4px;">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>Datos encriptados
            </span>
          </div>
        </div>
      </div>

    </form>

    <?php do_action('woocommerce_after_checkout_form', WC()->checkout()); ?>
  </div>
</section>

<?php get_footer(); ?>
