<?php
/**
 * Master Light Clinical Luxury Cart Page V10
 * Swiss Peptides 2026 - Instant Live Sidebar Summary Sync & Zero Lag
 */
get_header();

$cart_items = WC()->cart ? WC()->cart->get_cart() : array();
$subtotal = 0;
if (WC()->cart) {
    foreach ($cart_items as $ci) {
        if (!empty($ci['data']) && $ci['data']->exists()) {
            $subtotal += ((float) $ci['data']->get_price()) * ((int) $ci['quantity']);
        }
    }
}
?>

<style id="sp-master-cart-style-v10">
html, body {
    overflow-x: hidden !important;
    max-width: 100vw !important;
}

body.woocommerce-cart {
    background-color: #f8fafc !important;
    color: #0f172a !important;
    font-family: var(--font-primary, system-ui, -apple-system, sans-serif) !important;
}

.sp-cart-page-wrapper {
    padding: calc(var(--navbar-height, 80px) + 24px) 0 90px 0;
    min-height: 85vh;
    width: 100% !important;
    max-width: 100vw !important;
    box-sizing: border-box !important;
    overflow-x: hidden !important;
}

.sp-cart-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 24px;
    box-sizing: border-box !important;
    width: 100% !important;
    overflow: hidden !important;
}

.sp-cart-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.88rem;
    color: #64748b;
    margin-bottom: 20px;
    flex-wrap: wrap;
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
    font-size: clamp(1.8rem, 3.5vw, 2.6rem);
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 24px !important;
    letter-spacing: -0.5px;
    word-break: break-word;
}
.sp-cart-page-title span {
    color: #0284c7;
}

/* LIGHT CLINICAL LUXURY WOOCOMMERCE NOTICES BANNER */
.woocommerce-message,
.woocommerce-info,
.woocommerce-error {
    background: #f0fdf4 !important;
    border: 1px solid #bbf7d0 !important;
    border-radius: 16px !important;
    padding: 14px 20px !important;
    color: #166534 !important;
    font-weight: 600 !important;
    font-size: 0.92rem !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    box-shadow: 0 4px 12px rgba(22, 101, 52, 0.05) !important;
    margin-bottom: 24px !important;
    list-style: none !important;
    width: 100% !important;
    box-sizing: border-box !important;
}
.woocommerce-message a,
.woocommerce-info a {
    color: #0284c7 !important;
    font-weight: 800 !important;
    text-decoration: none !important;
    background: #e0f2fe !important;
    padding: 5px 14px !important;
    border-radius: 20px !important;
    font-size: 0.82rem !important;
    transition: all 0.2s !important;
}
.woocommerce-message a:hover {
    background: #0284c7 !important;
    color: #ffffff !important;
}

.sp-cart-grid {
    display: grid !important;
    grid-template-columns: 1.25fr 0.75fr !important;
    gap: 36px !important;
    align-items: start !important;
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
}

/* Left Column Container */
.sp-cart-items-column {
    display: flex;
    flex-direction: column;
    gap: 16px;
    width: 100%;
    box-sizing: border-box;
}

/* MASTER ULTRA-PREMIUM PRODUCT CARD */
.sp-cart-product-card {
    background: #ffffff !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 20px !important;
    padding: 20px 24px !important;
    box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03) !important;
    display: grid !important;
    grid-template-columns: 80px 1.4fr 130px 130px 40px !important;
    gap: 20px !important;
    align-items: center !important;
    width: 100% !important;
    box-sizing: border-box !important;
    transition: transform 0.2s, box-shadow 0.2s !important;
}
.sp-cart-product-card:hover {
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06) !important;
    border-color: #cbd5e1 !important;
}

/* Col 1: Img */
.sp-cart-card-img {
    width: 80px !important;
    height: 80px !important;
    border-radius: 14px !important;
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
    flex-shrink: 0 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.sp-cart-card-img img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
}

/* Col 2: Details */
.sp-cart-card-details {
    display: flex !important;
    flex-direction: column !important;
    gap: 6px !important;
    min-width: 0 !important;
    justify-content: center !important;
}
.sp-cart-card-title {
    font-size: 1.08rem !important;
    font-weight: 800 !important;
    color: #0f172a !important;
    text-decoration: none !important;
    line-height: 1.3 !important;
    display: block !important;
}
.sp-cart-card-title:hover {
    color: #0284c7 !important;
}

.sp-cart-card-badge {
    display: inline-block !important;
    background: #e0f2fe !important;
    color: #0284c7 !important;
    font-size: 0.72rem !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    padding: 3px 10px !important;
    border-radius: 6px !important;
    width: fit-content !important;
    letter-spacing: 0.5px !important;
}

.sp-cart-card-unit-price {
    font-size: 0.88rem !important;
    color: #64748b !important;
    font-weight: 600 !important;
}

/* SLEEK PERFECTLY CENTERED QUANTITY PILL COUNTER */
.sp-cart-card-qty {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.sp-qty-pill-box-perfect {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: #f1f5f9 !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 30px !important;
    padding: 3px 6px !important;
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
    padding: 0 !important;
    line-height: 1 !important;
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
    width: 36px !important;
    height: 28px !important;
    line-height: 28px !important;
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

/* Col 4: Subtotal */
.sp-cart-card-subtotal {
    font-size: 1.2rem !important;
    font-weight: 800 !important;
    color: #0284c7 !important;
    text-align: right !important;
    white-space: nowrap !important;
}

/* Col 5: Direct Remove Link */
.sp-cart-card-remove {
    width: 36px !important;
    height: 36px !important;
    border-radius: 10px !important;
    background: #fef2f2 !important;
    border: 1px solid #fecaca !important;
    color: #ef4444 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    transition: all 0.2s !important;
    margin-left: auto !important;
    text-decoration: none !important;
}
.sp-cart-card-remove:hover {
    background: #ef4444 !important;
    color: #ffffff !important;
}

/* Coupon & Actions Bar Card */
.sp-cart-actions-card {
    background: #ffffff !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 20px !important;
    padding: 20px 24px !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 16px !important;
    width: 100% !important;
    box-sizing: border-box !important;
}

.sp-coupon-bar-seamless {
    display: flex;
    background: #f8fafc;
    border: 1.5px solid #cbd5e1;
    border-radius: 30px;
    padding: 4px 4px 4px 16px;
    width: 340px;
    max-width: 100%;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.02);
    box-sizing: border-box;
}
.sp-coupon-input-field {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
    flex: 1;
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
    background: #ffffff !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 24px !important;
    padding: 30px !important;
    position: sticky !important;
    top: calc(var(--navbar-height, 80px) + 20px) !important;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05) !important;
    box-sizing: border-box !important;
    width: 100% !important;
    max-width: 100% !important;
    overflow: hidden !important;
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

html body .sp-cart-btn-whatsapp-checkout {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 12px !important;
    width: 100% !important;
    max-width: 100% !important;
    height: auto !important;
    min-height: 64px !important;
    padding: 16px 24px !important;
    background: #25D366 !important;
    background-color: #25D366 !important;
    color: #ffffff !important;
    font-family: var(--font-heading, system-ui, sans-serif) !important;
    font-size: 1.02rem !important;
    font-weight: 800 !important;
    border-radius: 50px !important;
    border: none !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    line-height: 1.3 !important;
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35) !important;
    margin-top: 24px !important;
    transition: all 0.25s ease !important;
    box-sizing: border-box !important;
}
html body .sp-cart-btn-whatsapp-checkout:hover {
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
        grid-template-columns: 1fr !important;
    }
    .sp-cart-summary-card {
        position: static !important;
    }
}

@media (max-width: 768px) {
    .sp-cart-page-wrapper {
        padding-top: calc(var(--navbar-height, 80px) + 24px) !important;
    }

    .sp-cart-container {
        padding: 0 16px !important;
    }

    .sp-cart-product-card {
        display: flex !important;
        flex-direction: column !important;
        gap: 14px !important;
        padding: 18px !important;
        position: relative !important;
    }

    .sp-cart-card-img {
        width: 64px !important;
        height: 64px !important;
        border-radius: 12px !important;
    }

    .sp-cart-card-remove {
        position: absolute !important;
        top: 18px !important;
        right: 18px !important;
        margin-left: 0 !important;
    }

    .sp-qty-pill-box-perfect {
        margin: 0 !important;
    }

    .sp-coupon-bar-seamless {
        width: 100% !important;
    }
    .sp-cart-actions-card {
        flex-direction: column !important;
        align-items: stretch !important;
        padding: 18px !important;
    }
    .sp-continue-shopping-link {
        justify-content: center !important;
    }

    html body .sp-cart-btn-whatsapp-checkout {
        min-height: 66px !important;
        padding: 16px 20px !important;
        font-size: 0.96rem !important;
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

    <?php if (WC()->cart && WC()->cart->is_empty()) : ?>
      <div class="sp-cart-empty-box">
        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5" style="margin-bottom:16px;"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
        <h2 style="font-size:1.4rem;font-weight:800;color:#0f172a;margin-bottom:10px;">Tu carrito está vacío</h2>
        <p style="color:#64748b;margin-bottom:24px;">Explora nuestro catálogo de péptidos de grado clínico suizo y añade los productos que necesitas.</p>
        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="sp-cart-btn-whatsapp-checkout" style="background:#0284c7!important;box-shadow:0 8px 20px rgba(2,132,199,0.25)!important;max-width:280px;margin:0 auto!important;">Ir a la Tienda</a>
      </div>
    <?php else : ?>

    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post" id="spCartForm">
      <div class="sp-cart-grid">
        
        <!-- LEFT: Items Column -->
        <div class="sp-cart-items-column">
          
          <?php foreach ($cart_items as $cart_item_key => $cart_item) :
            $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
            if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
              $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
              $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key);
              $product_name = $_product->get_name();
              $product_price = (float) $_product->get_price();
              $subtotal_val = $product_price * $cart_item['quantity'];
              $cats = wp_get_post_terms($product_id, 'product_cat', ['fields' => 'names']);
              $cat_name = !empty($cats) ? $cats[0] : 'PÉPTIDOS SUIZOS';
              $remove_url = wc_get_cart_remove_url($cart_item_key);
          ?>
          
          <!-- INDIVIDUAL LUXURY PRODUCT CARD -->
          <div class="sp-cart-product-card" data-price="<?php echo $product_price; ?>">
            
            <!-- Col 1: Image -->
            <div class="sp-cart-card-img">
              <?php if ($product_permalink) : ?>
                <a href="<?php echo esc_url($product_permalink); ?>"><?php echo $thumbnail; ?></a>
              <?php else : echo $thumbnail; endif; ?>
            </div>

            <!-- Col 2: Details (Name + Category + Unit Price) -->
            <div class="sp-cart-card-details">
              <?php if ($product_permalink) : ?>
                <a href="<?php echo esc_url($product_permalink); ?>" class="sp-cart-card-title"><?php echo esc_html($product_name); ?></a>
              <?php else : ?>
                <span class="sp-cart-card-title"><?php echo esc_html($product_name); ?></span>
              <?php endif; ?>
              <span class="sp-cart-card-badge"><?php echo esc_html($cat_name); ?></span>
              <span class="sp-cart-card-unit-price">$ <?php echo number_format($product_price, 0, ',', '.'); ?> c/u</span>
            </div>

            <!-- Col 3: Perfectly Centered Quantity Counter -->
            <div class="sp-cart-card-qty">
              <div class="sp-qty-pill-box-perfect">
                <button type="button" class="sp-qty-btn-sub-perfect sp-qty-minus" data-key="<?php echo esc_attr($cart_item_key); ?>">-</button>
                <input type="number" class="sp-qty-input-sub-perfect" name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]" value="<?php echo $cart_item['quantity']; ?>" min="1" max="99" data-key="<?php echo esc_attr($cart_item_key); ?>">
                <button type="button" class="sp-qty-btn-sub-perfect sp-qty-plus" data-key="<?php echo esc_attr($cart_item_key); ?>">+</button>
              </div>
            </div>

            <!-- Col 4: Subtotal -->
            <div class="sp-cart-card-subtotal">
              $ <?php echo number_format($subtotal_val, 0, ',', '.'); ?>
            </div>

            <!-- Col 5: Direct WooCommerce Remove Link -->
            <a href="<?php echo esc_url($remove_url); ?>" class="sp-cart-card-remove" title="Eliminar producto">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </a>

          </div>

          <?php endif; endforeach; ?>

          <!-- Coupon & Action Card -->
          <div class="sp-cart-actions-card">
            <div class="sp-coupon-bar-seamless">
              <input type="text" name="coupon_code" class="sp-coupon-input-field" placeholder="Código de cupón" id="coupon_code">
              <button type="submit" name="apply_coupon" class="sp-coupon-btn-apply" value="Aplicar cupón">Aplicar</button>
            </div>

            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="sp-continue-shopping-link">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
              Seguir comprando
            </a>
          </div>

          <!-- Hidden update_cart button for auto-submission -->
          <input type="submit" name="update_cart" value="Actualizar carrito" id="spUpdateCartSubmitBtn" style="display:none!important;">
        </div>

        <!-- RIGHT: Order Summary Card -->
        <div class="sp-cart-summary-card">
          <h3>Resumen del Pedido</h3>

          <div class="sp-summary-line">
            <span id="spSummaryProductCountLabel">Subtotal (<?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?> productos)</span>
            <span id="spSummarySubtotalAmount">$ <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
          </div>

          <div class="sp-summary-line" style="border-bottom:none!important;">
            <span>Envío a Colombia</span>
            <span style="color:#059669;font-weight:700;">GRATIS</span>
          </div>

          <div class="sp-summary-total-line">
            <span>Total</span>
            <span id="spSummaryGrandTotalAmount">$ <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
          </div>

          <a href="<?php echo wc_get_checkout_url(); ?>" class="sp-cart-btn-whatsapp-checkout">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink:0;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
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
  function formatMoney(num) {
    return '$ ' + Math.round(num).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
  }

  function spRecalculateCartSummary() {
    var totalSum = 0;
    var totalQty = 0;

    document.querySelectorAll('.sp-cart-product-card').forEach(function(card) {
      var price = parseFloat(card.getAttribute('data-price')) || 0;
      var input = card.querySelector('.sp-qty-input-sub-perfect');
      var qty = parseInt(input ? input.value : 1) || 1;
      var lineSubtotal = price * qty;
      
      totalQty += qty;
      totalSum += lineSubtotal;

      var lineSubtotalEl = card.querySelector('.sp-cart-card-subtotal');
      if (lineSubtotalEl) {
        lineSubtotalEl.textContent = formatMoney(lineSubtotal);
      }
    });

    var countLabel = document.getElementById('spSummaryProductCountLabel');
    if (countLabel) {
      countLabel.textContent = 'Subtotal (' + totalQty + ' producto' + (totalQty !== 1 ? 's' : '') + ')';
    }

    var subtotalAmountEl = document.getElementById('spSummarySubtotalAmount');
    if (subtotalAmountEl) {
      subtotalAmountEl.textContent = formatMoney(totalSum);
    }

    var grandTotalAmountEl = document.getElementById('spSummaryGrandTotalAmount');
    if (grandTotalAmountEl) {
      grandTotalAmountEl.textContent = formatMoney(totalSum);
    }
    if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
      window.spUpdateCartDrawerFromAJAX();
    }
  }

  function spSubmitCartForm() {
    var submitBtn = document.getElementById('spUpdateCartSubmitBtn');
    if (submitBtn) {
      submitBtn.click();
    } else {
      var form = document.getElementById('spCartForm');
      if (form) form.submit();
    }
  }

  document.querySelectorAll('.sp-qty-minus').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      var card = this.closest('.sp-cart-product-card');
      var input = card.querySelector('.sp-qty-input-sub-perfect');
      var val = parseInt(input.value) || 1;
      if (val > 1) {
        input.value = val - 1;
        spRecalculateCartSummary();
        spSubmitCartForm();
      }
    });
  });

  document.querySelectorAll('.sp-qty-plus').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      var card = this.closest('.sp-cart-product-card');
      var input = card.querySelector('.sp-qty-input-sub-perfect');
      var val = parseInt(input.value) || 1;
      if (val < 99) {
        input.value = val + 1;
        spRecalculateCartSummary();
        spSubmitCartForm();
      }
    });
  });

  document.querySelectorAll('.sp-qty-input-sub-perfect').forEach(function(input) {
    input.addEventListener('change', function() {
      spRecalculateCartSummary();
      spSubmitCartForm();
    });
  });
});
</script>

<?php get_footer(); ?>
