<?php
/**
 * Master Light Clinical Luxury Checkout Page 2026
 * Swiss Peptides - Zero Emojis, High-Contrast Forms & WhatsApp Gateway
 */
get_header();

$cart_items = WC()->cart->get_cart();
$subtotal = WC()->cart->get_subtotal();
?>

<style id="sp-master-checkout-style">
body.woocommerce-checkout {
    background-color: #f8fafc !important;
    color: #0f172a !important;
    font-family: var(--font-primary, system-ui, -apple-system, sans-serif) !important;
}

.sp-checkout-wrapper {
    padding: calc(var(--navbar-height, 80px) + 30px) 0 90px 0;
    min-height: 85vh;
}

.sp-checkout-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 24px;
    box-sizing: border-box;
}

.sp-checkout-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.88rem;
    color: #64748b;
    margin-bottom: 24px;
}
.sp-checkout-breadcrumb a {
    color: #64748b;
    text-decoration: none;
    transition: color 0.2s;
}
.sp-checkout-breadcrumb a:hover {
    color: #0284c7;
}

.sp-checkout-header-group {
    margin-bottom: 36px;
}
.sp-checkout-page-title {
    font-family: var(--font-heading, system-ui, sans-serif);
    font-size: clamp(2rem, 3.5vw, 2.6rem);
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 12px;
    letter-spacing: -0.5px;
}
.sp-checkout-page-title span {
    color: #0284c7;
}

.sp-checkout-trust-pills {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: center;
}
.sp-trust-pill-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 700;
    color: #475569;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    padding: 6px 14px;
    border-radius: 20px;
    box-shadow: 0 2px 6px rgba(15,23,42,0.02);
}

/* Stock Reservation Bar */
.sp-stock-reservation-bar {
    background: #0f172a;
    border-radius: 18px;
    padding: 16px 24px;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 36px;
    box-shadow: 0 4px 15px rgba(15,23,42,0.08);
}
.sp-stock-reservation-info {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.92rem;
    font-weight: 600;
    color: #f1f5f9;
}
.sp-stock-timer-badge {
    background: rgba(2, 132, 199, 0.25);
    color: #38bdf8;
    border: 1px solid #0284c7;
    padding: 4px 12px;
    border-radius: 10px;
    font-weight: 800;
    font-size: 1rem;
    letter-spacing: 0.5px;
}

.sp-checkout-grid {
    display: grid;
    grid-template-columns: 1.25fr 0.75fr;
    gap: 40px;
    align-items: start;
}

/* Left Column: Form Card */
.sp-checkout-form-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 36px;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
}
.sp-section-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.3rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 28px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
}
.sp-step-num {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #0284c7;
    color: #ffffff;
    font-size: 0.95rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* WOOCOMMERCE FORM INPUT OVERRIDES (HIGH CONTRAST & LUXURY) */
.woocommerce-checkout form .form-row {
    margin-bottom: 20px !important;
    padding: 0 !important;
}
.woocommerce-checkout form .form-row label {
    font-size: 0.88rem !important;
    font-weight: 700 !important;
    color: #1e293b !important;
    margin-bottom: 8px !important;
    display: block !important;
}
.woocommerce-checkout form .form-row input.input-text,
.woocommerce-checkout form .form-row select,
.woocommerce-checkout form .form-row textarea {
    width: 100% !important;
    height: 52px !important;
    padding: 0 18px !important;
    border: 1.5px solid #cbd5e1 !important;
    border-radius: 14px !important;
    background: #ffffff !important;
    font-size: 0.95rem !important;
    color: #0f172a !important;
    box-sizing: border-box !important;
    outline: none !important;
    transition: all 0.2s ease !important;
    box-shadow: none !important;
}
.woocommerce-checkout form .form-row textarea {
    height: 100px !important;
    padding: 14px 18px !important;
}
.woocommerce-checkout form .form-row input.input-text:focus,
.woocommerce-checkout form .form-row select:focus,
.woocommerce-checkout form .form-row textarea:focus {
    border-color: #0284c7 !important;
    box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.12) !important;
}
.woocommerce-checkout form .form-row-first {
    width: 48.5% !important;
    float: left !important;
}
.woocommerce-checkout form .form-row-last {
    width: 48.5% !important;
    float: right !important;
}
.woocommerce-checkout form .form-row-wide {
    clear: both !important;
    width: 100% !important;
}

/* Right Column: Order Review Card */
.sp-checkout-summary-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 24px;
    padding: 32px;
    position: sticky;
    top: calc(var(--navbar-height, 80px) + 20px);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
    box-sizing: border-box;
    width: 100%;
}
.sp-checkout-summary-card h3 {
    font-size: 1.25rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 24px;
}

.sp-review-item-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 0;
    border-bottom: 1px solid #f1f5f9;
}
.sp-review-item-img {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    flex-shrink: 0;
}
.sp-review-item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sp-review-line {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    font-size: 0.95rem;
    color: #475569;
    border-bottom: 1px solid #f1f5f9;
}
.sp-review-total-line {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 18px 0;
    font-size: 1.3rem;
    font-weight: 900;
    color: #0f172a;
    border-top: 2px solid #e2e8f0;
    margin-top: 10px;
}
.sp-review-total-line span:last-child {
    color: #0284c7;
    font-size: 1.6rem;
}

/* WOOCOMMERCE SUBMIT BUTTON OVERRIDE TO WHATSAPP GREEN */
#place_order,
.sp-checkout-btn-whatsapp-submit {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    width: 100% !important;
    height: 60px !important;
    background: #25D366 !important;
    color: #ffffff !important;
    font-family: var(--font-heading, system-ui, sans-serif) !important;
    font-size: 1.05rem !important;
    font-weight: 800 !important;
    border: none !important;
    border-radius: 16px !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3) !important;
    margin-top: 24px !important;
    cursor: pointer !important;
    transition: all 0.25s ease !important;
    box-sizing: border-box !important;
}
#place_order:hover,
.sp-checkout-btn-whatsapp-submit:hover {
    background: #20bd5a !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 14px 35px rgba(37, 211, 102, 0.45) !important;
}

@media (max-width: 1024px) {
    .sp-checkout-grid {
        grid-template-columns: 1fr;
    }
    .sp-checkout-summary-card {
        position: static;
    }
    .woocommerce-checkout form .form-row-first,
    .woocommerce-checkout form .form-row-last {
        width: 100% !important;
        float: none !important;
    }
}
@media (max-width: 640px) {
    .sp-checkout-container {
        padding: 0 16px;
    }
    .sp-checkout-form-card,
    .sp-checkout-summary-card {
        padding: 20px;
    }
    #place_order {
        font-size: 0.92rem !important;
        height: 54px !important;
    }
}
</style>

<section class="sp-checkout-wrapper">
  <div class="sp-checkout-container">
    
    <!-- Breadcrumb -->
    <nav class="sp-checkout-breadcrumb">
      <a href="<?php echo home_url(); ?>">Inicio</a>
      <span>/</span>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Tienda</a>
      <span>/</span>
      <a href="<?php echo wc_get_cart_url(); ?>">Carrito</a>
      <span>/</span>
      <span style="color:#0f172a;font-weight:700;">Confirmar Pedido</span>
    </nav>

    <!-- Header Group -->
    <div class="sp-checkout-header-group">
      <h1 class="sp-checkout-page-title">Finalizar y <span>Pagar por WhatsApp</span></h1>
      <div class="sp-checkout-trust-pills">
        <div class="sp-trust-pill-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          Pago 100% Seguro
        </div>
        <div class="sp-trust-pill-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          Datos Encriptados SSL
        </div>
        <div class="sp-trust-pill-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
          Envío Gratis Incluido
        </div>
      </div>
    </div>

    <!-- Stock Reservation Banner -->
    <div class="sp-stock-reservation-bar">
      <div class="sp-stock-reservation-info">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span>RESERVA DE STOCK ACTIVA: Tus productos se encuentran reservados por</span>
      </div>
      <div class="sp-stock-timer-badge" id="spCheckoutTimer">14:57 min</div>
    </div>

    <?php wc_print_notices(); ?>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
      <div class="sp-checkout-grid">
        
        <!-- LEFT: Billing & Shipping Form -->
        <div class="sp-checkout-form-card">
          <div class="sp-section-heading">
            <div class="sp-step-num">1</div>
            <span>Datos de Envío y Contacto</span>
          </div>

          <?php do_action('woocommerce_checkout_billing'); ?>
          <?php do_action('woocommerce_checkout_shipping'); ?>
        </div>

        <!-- RIGHT: Order Review Card -->
        <div class="sp-checkout-summary-card">
          <h3>Resumen de tu Pedido</h3>

          <div style="margin-bottom:20px;">
            <?php foreach ($cart_items as $cart_item_key => $cart_item) :
              $_product = $cart_item['data'];
              if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                $thumbnail = $_product->get_image('thumbnail');
                $product_name = $_product->get_name();
                $item_price = $_product->get_price() * $cart_item['quantity'];
            ?>
            <div class="sp-review-item-row">
              <div class="sp-review-item-img"><?php echo $thumbnail; ?></div>
              <div style="flex:1;min-width:0;">
                <div style="font-weight:800;font-size:0.95rem;color:#0f172a;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo esc_html($product_name); ?></div>
                <div style="font-size:0.8rem;color:#64748b;margin-top:2px;">Cantidad: <?php echo $cart_item['quantity']; ?></div>
                <div style="font-weight:800;font-size:0.95rem;color:#0284c7;margin-top:2px;">$ <?php echo number_format($item_price, 0, ',', '.'); ?></div>
              </div>
            </div>
            <?php endif; endforeach; ?>
          </div>

          <div class="sp-review-line">
            <span>Subtotal (<?php echo WC()->cart->get_cart_contents_count(); ?> productos)</span>
            <span>$ <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
          </div>

          <div class="sp-review-line">
            <span>Envío a Colombia</span>
            <span style="color:#059669;font-weight:700;">GRATIS</span>
          </div>

          <div class="sp-review-total-line">
            <span>Total</span>
            <span>$ <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
          </div>

          <!-- Hidden payment method selection (Forces COD / WhatsApp) -->
          <div style="display:none;">
            <?php do_action('woocommerce_checkout_order_review'); ?>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="sp-checkout-btn-whatsapp-submit" name="woocommerce_checkout_place_order" id="place_order" value="Pagar ahora por WhatsApp" data-value="Pagar ahora por WhatsApp">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink:0;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            Confirmar y Pagar por WhatsApp
          </button>

          <div style="margin-top:20px;padding-top:16px;border-top:1px solid #e2e8f0;display:flex;flex-direction:column;gap:8px;font-size:0.82rem;color:#64748b;">
            <div style="display:flex;align-items:center;gap:6px;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              Garantía de Venta Directa en Colombia
            </div>
            <div style="display:flex;align-items:center;gap:6px;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
              Envío Gratis a todo el país
            </div>
          </div>

        </div>

      </div>
    </form>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Timer countdown 15 minutes
  var duration = 15 * 60;
  var timerEl = document.getElementById('spCheckoutTimer');
  if (timerEl) {
    var interval = setInterval(function() {
      var min = Math.floor(duration / 60);
      var sec = duration % 60;
      timerEl.textContent = (min < 10 ? '0' : '') + min + ':' + (sec < 10 ? '0' : '') + sec + ' min';
      if (--duration < 0) {
        clearInterval(interval);
        timerEl.textContent = '00:00 min';
      }
    }, 1000);
  }
});
</script>

<?php get_footer(); ?>
