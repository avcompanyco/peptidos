<?php
/**
 * Master Light Clinical Luxury Cart Page V2
 * Swiss Peptides 2026 - Pixel-Perfect Qty Pill, Clean Headers, Zero Emojis
 */
get_header();

$cart_items = WC()->cart->get_cart();
$subtotal = WC()->cart->get_subtotal();
$total = WC()->cart->get_total();
?>

<style id="sp-master-cart-page-style-v2">
body.woocommerce-cart {
    background-color: #f8fafc !important;
    color: #0f172a !important;
    font-family: var(--font-primary, system-ui, -apple-system, sans-serif) !important;
}

.sp-cart-page-wrapper {
    padding: calc(var(--navbar-height, 80px) + 30px) 0 90px 0;
    min-height: 85vh;
}

.sp-cart-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 24px;
    box-sizing: border-box;
}

.sp-cart-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.88rem;
    color: #64748b;
    margin-bottom: 24px;
}
.sp-cart-breadcrumb a {
    color: #64748b;
    text-decoration: none;
    transition: color 0.2s;
}
.sp-cart-breadcrumb a:hover {
    color: #0284c7;
}

.sp-cart-page-title {
    font-family: var(--font-heading, system-ui, sans-serif);
    font-size: clamp(2rem, 3.5vw, 2.6rem);
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 32px;
    letter-spacing: -0.5px;
}
.sp-cart-page-title span {
    color: #0284c7;
}

.sp-cart-grid {
    display: grid;
    grid-template-columns: 1.25fr 0.75fr;
    gap: 40px;
    align-items: start;
}

/* Left Column: Cart Items Card */
.sp-cart-items-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
}

/* TABLE HEADERS BAR */
.sp-cart-table-header {
    display: grid;
    grid-template-columns: 84px 1.5fr 1fr 120px 1fr 40px;
    gap: 16px;
    align-items: center;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 12px 16px;
    font-size: 0.75rem;
    font-weight: 800;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 16px;
}
.sp-cart-table-header span.text-right {
    text-align: right;
}
.sp-cart-table-header span.text-center {
    text-align: center;
}

.sp-cart-item-row {
    display: grid;
    grid-template-columns: 84px 1.5fr 1fr 120px 1fr 40px;
    gap: 16px;
    align-items: center;
    padding: 20px 16px;
    border-bottom: 1px solid #f1f5f9;
}
.sp-cart-item-row:last-child {
    border-bottom: none;
}

.sp-cart-item-img {
    width: 84px;
    height: 84px;
    border-radius: 16px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.sp-cart-item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sp-cart-item-title {
    font-size: 1.02rem;
    font-weight: 800;
    color: #0f172a;
    text-decoration: none;
    line-height: 1.3;
}
.sp-cart-item-cat {
    font-size: 0.75rem;
    color: #0284c7;
    font-weight: 800;
    text-transform: uppercase;
    margin-top: 4px;
}

.sp-cart-item-unit-price {
    font-size: 1rem;
    font-weight: 700;
    color: #475569;
}

/* SLEEK QUANTITY PILL COUNTER (NO NATIVE BROWSER BOX / SPINNER) */
.sp-qty-pill-box-perfect {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: #f1f5f9 !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 30px !important;
    padding: 4px 6px !important;
    gap: 2px !important;
    width: fit-content !important;
}
.sp-qty-btn-sub-perfect {
    width: 28px !important;
    height: 28px !important;
    border-radius: 50% !important;
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    color: #0f172a !important;
    font-weight: 800 !important;
    font-size: 1.05rem !important;
    cursor: pointer !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: 0 2px 4px rgba(15,23,42,0.06) !important;
    transition: all 0.2s ease !important;
    user-select: none !important;
}
.sp-qty-btn-sub-perfect:hover {
    background: #0284c7 !important;
    color: #ffffff !important;
    border-color: #0284c7 !important;
}

.sp-qty-input-sub-perfect {
    -webkit-appearance: none !important;
    -moz-appearance: textfield !important;
    appearance: none !important;
    border: none !important;
    background: transparent !important;
    outline: none !important;
    box-shadow: none !important;
    width: 32px !important;
    text-align: center !important;
    font-weight: 800 !important;
    font-size: 1rem !important;
    color: #0f172a !important;
    padding: 0 !important;
    margin: 0 !important;
}
.sp-qty-input-sub-perfect::-webkit-outer-spin-button,
.sp-qty-input-sub-perfect::-webkit-inner-spin-button {
    -webkit-appearance: none !important;
    margin: 0 !important;
}

.sp-cart-item-subtotal-price {
    font-size: 1.15rem;
    font-weight: 800;
    color: #0284c7;
    text-align: right;
}

.sp-cart-btn-remove-perfect {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #ef4444;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    margin-left: auto;
}
.sp-cart-btn-remove-perfect:hover {
    background: #ef4444;
    color: #ffffff;
}

/* Coupon & Actions Bar */
.sp-cart-actions-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid #e2e8f0;
    flex-wrap: wrap;
    gap: 16px;
}

/* SEAMLESS INTEGRATED COUPON BAR */
.sp-coupon-bar-seamless {
    display: flex;
    background: #f8fafc;
    border: 1.5px solid #cbd5e1;
    border-radius: 30px;
    padding: 4px 4px 4px 16px;
    width: 320px;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.02);
}
.sp-coupon-input-field {
    border: none;
    background: transparent;
    flex: 1;
    outline: none;
    font-size: 0.88rem;
    color: #0f172a;
    padding: 6px 0;
}
.sp-coupon-btn-apply {
    background: #0f172a;
    color: #ffffff;
    border: none;
    border-radius: 24px;
    padding: 8px 20px;
    font-size: 0.82rem;
    font-weight: 800;
    cursor: pointer;
    text-transform: uppercase;
    transition: background 0.2s;
}
.sp-coupon-btn-apply:hover {
    background: #0284c7;
}

.sp-continue-shopping-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #0284c7;
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
}

/* Right Column: Order Summary Card */
.sp-cart-summary-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 24px;
    padding: 30px;
    position: sticky;
    top: calc(var(--navbar-height, 80px) + 20px);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
}
.sp-cart-summary-card h3 {
    font-size: 1.25rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 20px;
}

.sp-summary-line {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    font-size: 0.95rem;
    color: #475569;
    border-bottom: 1px solid #f1f5f9;
}
.sp-summary-total-line {
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
.sp-summary-total-line span:last-child {
    color: #0284c7;
    font-size: 1.6rem;
}

.sp-cart-btn-whatsapp-checkout {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    width: 100% !important;
    height: 56px !important;
    background: #25D366 !important;
    color: #ffffff !important;
    font-family: var(--font-heading, system-ui, sans-serif) !important;
    font-size: 1.05rem !important;
    font-weight: 800 !important;
    border-radius: 16px !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3) !important;
    margin-top: 20px !important;
    transition: all 0.25s ease !important;
}
.sp-cart-btn-whatsapp-checkout:hover {
    background: #20bd5a !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 14px 35px rgba(37, 211, 102, 0.45) !important;
}

.sp-cart-empty-box {
    text-align: center;
    padding: 80px 20px;
    background: #ffffff;
    border-radius: 24px;
    border: 1px solid #e2e8f0;
    max-width: 600px;
    margin: 0 auto;
}

@media (max-width: 1024px) {
    .sp-cart-grid {
        grid-template-columns: 1fr;
    }
    .sp-cart-table-header {
        display: none;
    }
    .sp-cart-item-row {
        grid-template-columns: 70px 1fr 1fr 40px;
        grid-template-areas:
            "img title subtotal remove"
            "img price qty remove";
        gap: 10px;
        padding: 16px 0;
    }
    .sp-cart-summary-card {
        position: static;
    }
}
@media (max-width: 640px) {
    .sp-cart-container {
        padding: 0 16px;
    }
    .sp-cart-items-card {
        padding: 18px;
    }
    .sp-coupon-bar-seamless {
        width: 100%;
    }
    .sp-cart-btn-whatsapp-checkout {
        font-size: 0.92rem !important;
        height: 52px !important;
    }
}
</style>

<section class="sp-cart-page-wrapper">
  <div class="sp-cart-container">
    
    <!-- Breadcrumb -->
    <nav class="sp-cart-breadcrumb">
      <a href="<?php echo home_url(); ?>">Inicio</a>
      <span>/</span>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Tienda</a>
      <span>/</span>
      <span style="color:#0f172a;font-weight:700;">Tu Carrito</span>
    </nav>

    <h1 class="sp-cart-page-title">Tu Carrito <span>de Compra</span></h1>

    <?php wc_print_notices(); ?>

    <?php if (WC()->cart->is_empty()) : ?>
      <div class="sp-cart-empty-box">
        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5" style="margin-bottom:16px;"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
        <h2 style="font-size:1.4rem;font-weight:800;color:#0f172a;margin-bottom:10px;">Tu carrito está vacío</h2>
        <p style="color:#64748b;margin-bottom:24px;">Explora nuestro catálogo de péptidos de grado clínico suizo y añade los productos que necesitas.</p>
        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="sp-cart-btn-whatsapp-checkout" style="background:#0284c7!important;box-shadow:0 8px 20px rgba(2,132,199,0.25)!important;max-width:280px;margin:0 auto!important;">Ir a la Tienda</a>
      </div>
    <?php else : ?>

    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
      <div class="sp-cart-grid">
        
        <!-- LEFT: Items List -->
        <div class="sp-cart-items-card">
          
          <!-- Table Header Bar -->
          <div class="sp-cart-table-header">
            <span></span>
            <span>Producto</span>
            <span>Precio</span>
            <span class="text-center">Cantidad</span>
            <span class="text-right">Subtotal</span>
            <span></span>
          </div>

          <?php foreach ($cart_items as $cart_item_key => $cart_item) :
            $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
            if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
              $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
              $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key);
              $product_name = $_product->get_name();
              $product_price = $_product->get_price();
              $subtotal_val = $product_price * $cart_item['quantity'];
              $cats = wp_get_post_terms($product_id, 'product_cat', ['fields' => 'names']);
              $cat_name = !empty($cats) ? $cats[0] : '';
          ?>
          
          <div class="sp-cart-item-row">
            <!-- Thumbnail -->
            <div class="sp-cart-item-img">
              <?php if ($product_permalink) : ?>
                <a href="<?php echo esc_url($product_permalink); ?>"><?php echo $thumbnail; ?></a>
              <?php else : echo $thumbnail; endif; ?>
            </div>

            <!-- Title & Cat -->
            <div>
              <a href="<?php echo esc_url($product_permalink); ?>" class="sp-cart-item-title"><?php echo esc_html($product_name); ?></a>
              <?php if ($cat_name) : ?><div class="sp-cart-item-cat"><?php echo esc_html($cat_name); ?></div><?php endif; ?>
            </div>

            <!-- Unit Price -->
            <div class="sp-cart-item-unit-price">$ <?php echo number_format($product_price, 0, ',', '.'); ?></div>

            <!-- Qty Counter (Perfect Pill Counter) -->
            <div style="display:flex;justify-content:center;">
              <div class="sp-qty-pill-box-perfect">
                <button type="button" class="sp-qty-btn-sub-perfect sp-qty-minus" data-key="<?php echo esc_attr($cart_item_key); ?>">-</button>
                <input type="number" class="sp-qty-input-sub-perfect" name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]" value="<?php echo $cart_item['quantity']; ?>" min="0" max="99" data-key="<?php echo esc_attr($cart_item_key); ?>">
                <button type="button" class="sp-qty-btn-sub-perfect sp-qty-plus" data-key="<?php echo esc_attr($cart_item_key); ?>">+</button>
              </div>
            </div>

            <!-- Subtotal -->
            <div class="sp-cart-item-subtotal-price">$ <?php echo number_format($subtotal_val, 0, ',', '.'); ?></div>

            <!-- Remove Button -->
            <button type="button" class="sp-cart-btn-remove-perfect sp-cart-remove" data-key="<?php echo esc_attr($cart_item_key); ?>" title="Eliminar producto">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
          </div>

          <?php endif; endforeach; ?>

          <!-- Coupon & Action Row -->
          <div class="sp-cart-actions-bar">
            <div class="sp-coupon-bar-seamless">
              <input type="text" name="coupon_code" class="sp-coupon-input-field" placeholder="Código de cupón" id="coupon_code">
              <button type="submit" name="apply_coupon" class="sp-coupon-btn-apply" value="Aplicar cupón">Aplicar</button>
            </div>

            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="sp-continue-shopping-link">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
              Seguir comprando
            </a>
          </div>

          <input type="hidden" name="update_cart" value="Actualizar carrito">
        </div>

        <!-- RIGHT: Order Summary Card -->
        <div class="sp-cart-summary-card">
          <h3>Resumen del Pedido</h3>

          <div class="sp-summary-line">
            <span>Subtotal (<?php echo WC()->cart->get_cart_contents_count(); ?> productos)</span>
            <span>$ <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
          </div>

          <div class="sp-summary-line">
            <span>Envío a Colombia</span>
            <span style="color:#059669;font-weight:700;">GRATIS</span>
          </div>

          <div class="sp-summary-total-line">
            <span>Total</span>
            <span>$ <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
          </div>

          <a href="<?php echo wc_get_checkout_url(); ?>" class="sp-cart-btn-whatsapp-checkout">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            Finalizar y Pagar por WhatsApp
          </a>

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

    <?php endif; ?>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.sp-qty-minus').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var input = this.closest('.sp-qty-pill-box-perfect').querySelector('.sp-qty-input-sub-perfect');
      var val = parseInt(input.value) || 1;
      if (val > 1) { input.value = val - 1; input.dispatchEvent(new Event('change')); }
    });
  });
  document.querySelectorAll('.sp-qty-plus').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var input = this.closest('.sp-qty-pill-box-perfect').querySelector('.sp-qty-input-sub-perfect');
      var val = parseInt(input.value) || 1;
      if (val < 99) { input.value = val + 1; input.dispatchEvent(new Event('change')); }
    });
  });

  var updateTimer;
  document.querySelectorAll('.sp-qty-input-sub-perfect').forEach(function(input) {
    input.addEventListener('change', function() {
      clearTimeout(updateTimer);
      updateTimer = setTimeout(function() {
        var form = document.querySelector('.woocommerce-cart-form');
        if (form) {
          var btn = form.querySelector('[name="update_cart"]');
          if (btn) { btn.click(); } else { form.submit(); }
        }
      }, 800);
    });
  });

  document.querySelectorAll('.sp-cart-remove').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var key = this.getAttribute('data-key');
      var input = document.querySelector('.sp-qty-input-sub-perfect[data-key="' + key + '"]');
      if (input) {
        input.value = 0;
        var form = document.querySelector('.woocommerce-cart-form');
        if (form) { form.submit(); }
      }
    });
  });
});
</script>

<?php get_footer(); ?>
