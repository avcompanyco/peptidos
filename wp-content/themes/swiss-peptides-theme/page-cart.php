<?php
/**
 * Template Name: Carrito Premium
 * Custom Cart Page — Swiss Peptides Clinical Luxury
 */
defined('ABSPATH') || exit;

get_header();

// Ensure WC cart exists
if (!function_exists('WC') || !WC()->cart) {
    echo '<p>Error cargando el carrito.</p>';
    get_footer();
    return;
}

WC()->cart->calculate_totals();
$cart_items = WC()->cart->get_cart();
$is_empty   = WC()->cart->is_empty();
$subtotal   = WC()->cart->get_subtotal();
$total      = WC()->cart->get_total('');
?>

<style>
/* ── Cart Page Shell ── */
.sp-cart-page{padding:calc(var(--navbar-height) + 60px) 0 var(--space-4xl);background:var(--bg-secondary);min-height:100vh}
.sp-cart-breadcrumb{margin-bottom:var(--space-lg);font-size:var(--fs-xs);color:var(--text-muted)}
.sp-cart-breadcrumb a{color:var(--text-muted);text-decoration:none;transition:color .2s}
.sp-cart-breadcrumb a:hover{color:var(--accent)}
.sp-cart-title{font-family:var(--font-heading);font-size:clamp(1.6rem,3vw,2.2rem);font-weight:800;color:var(--navy);margin-bottom:var(--space-2xl)}
.sp-cart-title span{color:var(--accent)}

/* ── 2-Column Grid ── */
.sp-cart-grid{display:grid;grid-template-columns:1.4fr .6fr;gap:var(--space-2xl);align-items:start}

/* ── Items Card ── */
.sp-cart-items-card{background:var(--white);border:1px solid var(--border-color);border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm)}

/* Header Row */
.sp-cart-header{display:grid;grid-template-columns:60px 1fr 120px 120px 120px 40px;gap:var(--space-md);padding:var(--space-md) var(--space-xl);background:var(--gray-50);border-bottom:1px solid var(--border-color);align-items:center}
.sp-cart-header span{font-family:var(--font-heading);font-weight:700;font-size:var(--fs-xs);text-transform:uppercase;letter-spacing:.08em;color:var(--gray-500)}

/* Item Row */
.sp-cart-item{display:grid;grid-template-columns:60px 1fr 120px 120px 120px 40px;gap:var(--space-md);padding:var(--space-lg) var(--space-xl);border-bottom:1px solid var(--border-subtle);align-items:center;transition:background .2s}
.sp-cart-item:last-child{border-bottom:none}
.sp-cart-item:hover{background:var(--gray-50)}
.sp-cart-item-img{width:56px;height:56px;border-radius:var(--radius-md);overflow:hidden;background:var(--gray-50);border:1px solid var(--border-color);display:flex;align-items:center;justify-content:center}
.sp-cart-item-img img{max-width:90%;max-height:90%;object-fit:contain}
.sp-cart-item-name{font-family:var(--font-heading);font-weight:700;font-size:var(--fs-sm);color:var(--navy)}
.sp-cart-item-name a{color:inherit;text-decoration:none;transition:color .2s}
.sp-cart-item-name a:hover{color:var(--accent)}
.sp-cart-item-cat{font-size:var(--fs-xs);color:var(--gray-500);margin-top:2px}
.sp-cart-item-price{font-family:var(--font-heading);font-weight:700;color:var(--navy);font-size:var(--fs-sm)}
.sp-cart-item-subtotal{font-family:var(--font-heading);font-weight:700;color:var(--navy);font-size:var(--fs-sm)}

/* Quantity Control */
.sp-qty-control{display:inline-flex;align-items:center;border:1.5px solid var(--border-color);border-radius:var(--radius-md);overflow:hidden}
.sp-qty-btn{width:32px;height:36px;display:flex;align-items:center;justify-content:center;background:var(--gray-50);border:none;cursor:pointer;color:var(--navy);font-size:16px;font-weight:600;transition:background .2s}
.sp-qty-btn:hover{background:var(--gray-200)}
.sp-qty-input{width:40px;height:36px;text-align:center;border:none;border-left:1.5px solid var(--border-color);border-right:1.5px solid var(--border-color);font-family:var(--font-heading);font-weight:700;font-size:var(--fs-sm);color:var(--navy);background:var(--white);-moz-appearance:textfield}
.sp-qty-input::-webkit-inner-spin-button,.sp-qty-input::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}

/* Remove Button */
.sp-cart-remove{width:32px;height:32px;display:flex;align-items:center;justify-content:center;background:var(--gray-50);border:none;border-radius:var(--radius-md);cursor:pointer;color:var(--gray-400);transition:all .2s}
.sp-cart-remove:hover{background:#fef2f2;color:#ef4444}

/* ── Coupon Row ── */
.sp-cart-actions{display:flex;gap:var(--space-md);padding:var(--space-lg) var(--space-xl);background:var(--gray-50);align-items:center;flex-wrap:wrap}
.sp-coupon-form{display:flex;gap:var(--space-sm);flex:1;min-width:200px}
.sp-coupon-input{padding:12px 16px;border:1.5px solid var(--border-color);border-radius:var(--radius-lg);font-size:var(--fs-sm);font-family:var(--font-primary);background:var(--white);flex:1;max-width:240px;color:var(--navy)}
.sp-coupon-input:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 4px rgba(14,165,233,.08)}
.sp-coupon-btn{padding:12px 20px;background:var(--navy);color:var(--white);border:none;border-radius:var(--radius-lg);font-family:var(--font-heading);font-weight:600;font-size:var(--fs-xs);cursor:pointer;transition:all .3s;white-space:nowrap}
.sp-coupon-btn:hover{background:var(--accent)}
.sp-continue-shopping{margin-left:auto;font-size:var(--fs-sm);color:var(--accent);text-decoration:none;font-weight:500;display:flex;align-items:center;gap:6px;transition:color .2s}
.sp-continue-shopping:hover{color:var(--navy)}

/* ── Summary Sidebar ── */
.sp-cart-summary{background:var(--white);border:1px solid var(--border-color);border-radius:var(--radius-xl);padding:var(--space-2xl);position:sticky;top:calc(var(--navbar-height) + var(--space-lg));box-shadow:var(--shadow-sm)}
.sp-cart-summary h3{font-family:var(--font-heading);font-size:var(--fs-lg);font-weight:700;color:var(--navy);margin-bottom:var(--space-xl);padding-bottom:var(--space-md);border-bottom:1px solid var(--border-subtle)}
.sp-summary-row{display:flex;justify-content:space-between;padding:var(--space-sm) 0;font-size:var(--fs-sm)}
.sp-summary-row .label{color:var(--gray-600)}
.sp-summary-row .value{font-weight:600;color:var(--navy)}
.sp-summary-total{display:flex;justify-content:space-between;padding:var(--space-lg) 0 var(--space-md);font-family:var(--font-heading);font-weight:800;font-size:var(--fs-xl);color:var(--navy);border-top:2px solid var(--navy);margin-top:var(--space-md)}
.sp-checkout-btn{display:block;width:100%;padding:18px 24px;background:var(--navy);color:var(--white);border:none;border-radius:var(--radius-xl);font-family:var(--font-heading);font-size:var(--fs-md);font-weight:700;cursor:pointer;transition:all .3s;text-align:center;text-decoration:none;margin-top:var(--space-lg)}
.sp-checkout-btn:hover{background:var(--accent);transform:translateY(-2px);box-shadow:0 8px 25px rgba(14,165,233,.25);color:var(--white)}
.sp-summary-secure{display:flex;align-items:center;justify-content:center;gap:6px;margin-top:var(--space-lg);font-size:var(--fs-xs);color:var(--text-muted)}
.sp-summary-secure svg{width:14px;height:14px;flex-shrink:0}
.sp-summary-badges{display:flex;gap:8px;justify-content:center;margin-top:var(--space-md);flex-wrap:wrap}
.sp-summary-badge{display:flex;align-items:center;gap:4px;font-size:10px;color:var(--gray-400);text-transform:uppercase;letter-spacing:.05em;font-weight:600}
.sp-summary-badge svg{width:12px;height:12px;color:var(--accent)}

/* ── Empty Cart ── */
.sp-cart-empty{text-align:center;padding:var(--space-5xl) var(--space-xl)}
.sp-cart-empty-icon{width:80px;height:80px;border-radius:var(--radius-full);background:var(--gray-50);display:flex;align-items:center;justify-content:center;margin:0 auto var(--space-xl)}
.sp-cart-empty-icon svg{width:36px;height:36px;color:var(--gray-400)}
.sp-cart-empty h2{font-family:var(--font-heading);font-size:var(--fs-xl);font-weight:700;color:var(--navy);margin-bottom:var(--space-md)}
.sp-cart-empty p{font-size:var(--fs-sm);color:var(--gray-500);margin-bottom:var(--space-xl);max-width:400px;margin-left:auto;margin-right:auto}
.sp-cart-empty .btn{display:inline-flex;align-items:center;gap:8px;padding:16px 32px;background:var(--navy);color:var(--white);border-radius:var(--radius-xl);text-decoration:none;font-family:var(--font-heading);font-weight:700;font-size:var(--fs-sm);transition:all .3s}
.sp-cart-empty .btn:hover{background:var(--accent);transform:translateY(-2px);box-shadow:0 8px 25px rgba(14,165,233,.25)}

/* ── Responsive ── */
@media(max-width:1024px){
  .sp-cart-grid{grid-template-columns:1fr}
  .sp-cart-summary{position:static}
}
@media(max-width:768px){
  .sp-cart-page{padding:calc(var(--navbar-height)+30px) 0 var(--space-2xl)}
  .sp-cart-header{display:none}
  .sp-cart-item{grid-template-columns:56px 1fr auto;gap:var(--space-sm);padding:var(--space-md)}
  .sp-cart-item-price{display:none}
  .sp-cart-item .sp-qty-control{grid-column:2;justify-self:start}
  .sp-cart-item-subtotal{grid-column:3;grid-row:1/3}
  .sp-cart-remove{grid-column:3;grid-row:2}
  .sp-cart-actions{flex-direction:column;gap:var(--space-sm)}
  .sp-coupon-form{width:100%;min-width:0}
  .sp-continue-shopping{margin-left:0;justify-content:center}
}
</style>

<section class="sp-cart-page">
  <div class="container">
    <!-- Breadcrumb -->
    <nav class="sp-cart-breadcrumb">
      <a href="<?php echo home_url(); ?>">Inicio</a>
      <span style="margin:0 var(--space-xs)">/</span>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Tienda</a>
      <span style="margin:0 var(--space-xs)">/</span>
      <span style="color:var(--navy);font-weight:500">Carrito</span>
    </nav>

    <h1 class="sp-cart-title">Tu <span>Carrito</span></h1>

    <?php wc_print_notices(); ?>

    <?php if ($is_empty) : ?>
    <!-- Empty Cart -->
    <div class="sp-cart-empty">
      <div class="sp-cart-empty-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
      </div>
      <h2>Tu carrito está vacío</h2>
      <p>Aún no has agregado productos a tu carrito. Explora nuestra tienda y encuentra los péptidos que necesitas.</p>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Explorar Tienda
      </a>
    </div>

    <?php else : ?>
    <!-- Cart with Items -->
    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
      <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

      <div class="sp-cart-grid">
        <!-- LEFT: Items -->
        <div>
          <div class="sp-cart-items-card">
            <div class="sp-cart-header">
              <span></span>
              <span>Producto</span>
              <span>Precio</span>
              <span>Cantidad</span>
              <span>Subtotal</span>
              <span></span>
            </div>

            <?php foreach ($cart_items as $cart_item_key => $cart_item) :
              $product = $cart_item['data'];
              $product_id = $cart_item['product_id'];
              $product_name = $product->get_name();
              $product_price = $product->get_price();
              $qty = $cart_item['quantity'];
              $subtotal_item = $product_price * $qty;
              $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'thumbnail');
              $image_url = $image ? $image[0] : wc_placeholder_img_src('thumbnail');
              $permalink = $product->get_permalink($cart_item);
              $cats = wp_get_post_terms($product_id, 'product_cat', ['fields' => 'names']);
              $cat_name = !empty($cats) ? $cats[0] : '';
            ?>
            <div class="sp-cart-item">
              <div class="sp-cart-item-img">
                <a href="<?php echo esc_url($permalink); ?>"><img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($product_name); ?>"></a>
              </div>
              <div>
                <div class="sp-cart-item-name"><a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($product_name); ?></a></div>
                <?php if ($cat_name) : ?><div class="sp-cart-item-cat"><?php echo esc_html($cat_name); ?></div><?php endif; ?>
              </div>
              <div class="sp-cart-item-price">$ <?php echo number_format($product_price, 0, ',', '.'); ?></div>
              <div>
                <div class="sp-qty-control">
                  <button type="button" class="sp-qty-btn sp-qty-minus" data-key="<?php echo esc_attr($cart_item_key); ?>">−</button>
                  <input type="number" class="sp-qty-input" name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]" value="<?php echo $qty; ?>" min="0" max="99" data-key="<?php echo esc_attr($cart_item_key); ?>">
                  <button type="button" class="sp-qty-btn sp-qty-plus" data-key="<?php echo esc_attr($cart_item_key); ?>">+</button>
                </div>
              </div>
              <div class="sp-cart-item-subtotal">$ <?php echo number_format($subtotal_item, 0, ',', '.'); ?></div>
              <button type="button" class="sp-cart-remove" data-key="<?php echo esc_attr($cart_item_key); ?>" title="Eliminar">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </button>
            </div>
            <?php endforeach; ?>
          </div>

          <!-- Actions Row -->
          <div class="sp-cart-items-card" style="margin-top:var(--space-md);border-radius:var(--radius-xl)">
            <div class="sp-cart-actions">
              <div class="sp-coupon-form">
                <input type="text" name="coupon_code" class="sp-coupon-input" placeholder="Código de cupón" id="coupon_code">
                <button type="submit" name="apply_coupon" class="sp-coupon-btn" value="Aplicar cupón">Aplicar</button>
              </div>
              <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="sp-continue-shopping">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Seguir comprando
              </a>
            </div>
          </div>

          <input type="hidden" name="update_cart" value="Actualizar carrito">
        </div>

        <!-- RIGHT: Summary -->
        <div class="sp-cart-summary">
          <h3>Resumen del pedido</h3>

          <div class="sp-summary-row">
            <span class="label">Subtotal (<?php echo WC()->cart->get_cart_contents_count(); ?> productos)</span>
            <span class="value">$ <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
          </div>
          <div class="sp-summary-row">
            <span class="label">Envío</span>
            <span class="value" style="color:var(--success)">Gratis</span>
          </div>

          <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
          <div class="sp-summary-row">
            <span class="label">Cupón: <?php echo esc_html($code); ?></span>
            <span class="value" style="color:var(--success)">-<?php echo wc_cart_totals_coupon_html($coupon); ?></span>
          </div>
          <?php endforeach; ?>

          <div class="sp-summary-total">
            <span>Total</span>
            <span><?php echo WC()->cart->get_total(); ?></span>
          </div>

          <a href="<?php echo wc_get_checkout_url(); ?>" class="sp-checkout-btn">
            Finalizar Compra
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;margin-left:4px"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>

          <div class="sp-summary-secure">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Pago 100% seguro con Stripe
          </div>

          <div class="sp-summary-badges">
            <div class="sp-summary-badge">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
              Envío gratis
            </div>
            <div class="sp-summary-badge">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              Pureza ≥98%
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
  // Quantity buttons
  document.querySelectorAll('.sp-qty-minus').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var input = this.closest('.sp-qty-control').querySelector('.sp-qty-input');
      var val = parseInt(input.value) || 1;
      if (val > 1) { input.value = val - 1; input.dispatchEvent(new Event('change')); }
    });
  });
  document.querySelectorAll('.sp-qty-plus').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var input = this.closest('.sp-qty-control').querySelector('.sp-qty-input');
      var val = parseInt(input.value) || 1;
      if (val < 99) { input.value = val + 1; input.dispatchEvent(new Event('change')); }
    });
  });

  // Auto-update cart on quantity change
  var updateTimer;
  document.querySelectorAll('.sp-qty-input').forEach(function(input) {
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

  // Remove item
  document.querySelectorAll('.sp-cart-remove').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var key = this.getAttribute('data-key');
      var input = document.querySelector('.sp-qty-input[data-key="' + key + '"]');
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
