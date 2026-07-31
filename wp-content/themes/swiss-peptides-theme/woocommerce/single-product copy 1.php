<?php
/**
 * WooCommerce Single Product
 */
get_header();

while ( have_posts() ) :
    the_post();

global $product;
if (!$product || !is_a($product, 'WC_Product')) {
    $product = wc_get_product(get_the_ID());
}
if (!$product) { wp_redirect(get_permalink(wc_get_page_id('shop'))); exit; }

$cats = wp_get_post_terms($product->get_id(), 'product_cat');
$cat_name = !empty($cats) ? $cats[0]->name : '';
$purity = get_post_meta($product->get_id(), 'sp_purity', true);
$content_val = get_post_meta($product->get_id(), 'sp_content', true);
$molecular = get_post_meta($product->get_id(), 'sp_molecular', true);
$mol_weight = get_post_meta($product->get_id(), 'sp_mol_weight', true);
$storage = get_post_meta($product->get_id(), 'sp_storage', true);
$benefits_raw = get_post_meta($product->get_id(), 'sp_benefits', true);
$benefits = $benefits_raw ? array_filter(explode("\n", $benefits_raw)) : [];

$regular = $product->get_regular_price();
$sale = $product->get_sale_price();
$discount = ($regular && $sale && $regular > $sale) ? round((1 - $sale/$regular)*100) : 0;
?>

<style>
.product-detail{padding:calc(var(--navbar-height) + 30px) 0 var(--space-3xl)}
.product-grid{display:grid;grid-template-columns:1fr 1fr;gap:var(--space-3xl);align-items:start}
.product-img-main{border-radius:var(--radius-2xl);overflow:hidden;background:var(--gray-50);border:1px solid var(--border-color);position:relative}
.product-img-main img{width:100%;height:auto;display:block}
.product-badge-abs{position:absolute;top:16px;left:16px;background:var(--accent);color:var(--white);padding:4px 14px;border-radius:var(--radius-full);font-size:var(--fs-xs);font-weight:600}
.product-meta{display:flex;flex-direction:column;gap:var(--space-md)}
.product-breadcrumb{font-size:var(--fs-sm);color:var(--text-muted)}
.product-breadcrumb a{color:var(--text-muted);text-decoration:none}
.product-detail-cat{font-size:var(--fs-sm);color:var(--accent);font-weight:600;text-transform:uppercase;letter-spacing:.05em}
.product-detail-name{font-family:var(--font-heading);font-size:var(--fs-3xl);font-weight:800;color:var(--navy);line-height:1.1}
.product-detail-subtitle{font-size:var(--fs-md);color:var(--text-secondary)}
.product-detail-price{font-family:var(--font-heading);font-size:2.5rem;font-weight:800;color:var(--navy)}
.product-detail-original{font-size:var(--fs-lg);color:var(--text-muted);text-decoration:line-through;margin-left:var(--space-sm)}
.product-discount-badge{background:var(--error);color:var(--white);padding:4px 10px;border-radius:var(--radius-full);font-size:var(--fs-xs);font-weight:700;margin-left:var(--space-sm)}
.product-detail-desc{font-size:var(--fs-md);color:var(--text-secondary);line-height:1.8}
.qty-control{display:flex;align-items:center;gap:0;border:1px solid var(--border-color);border-radius:var(--radius-lg);overflow:hidden;width:fit-content}
.qty-btn{width:44px;height:44px;background:var(--gray-50);border:none;cursor:pointer;font-size:var(--fs-lg);display:flex;align-items:center;justify-content:center;color:var(--navy);transition:background .2s}
.qty-btn:hover{background:var(--gray-200)}
.qty-input{width:50px;height:44px;text-align:center;border:none;border-left:1px solid var(--border-color);border-right:1px solid var(--border-color);font-weight:600;font-size:var(--fs-base);background:var(--white)}
.product-actions{display:grid;grid-template-columns:1fr 1fr;gap:var(--space-sm)}
.spec-grid{display:grid;grid-template-columns:1fr 1fr;gap:var(--space-sm)}
.spec-card{padding:var(--space-md);background:var(--gray-50);border-radius:var(--radius-lg);border:1px solid var(--border-subtle)}
.spec-card-label{font-size:var(--fs-xs);color:var(--text-muted);margin-bottom:4px}
.spec-card-value{font-family:var(--font-heading);font-weight:700;color:var(--navy);font-size:var(--fs-sm)}
.benefits-list{list-style:none;padding:0}
.benefits-list li{display:flex;align-items:flex-start;gap:var(--space-sm);padding:var(--space-sm) 0;border-bottom:1px solid var(--border-subtle);font-size:var(--fs-sm);color:var(--text-secondary)}
.benefits-list li svg{flex-shrink:0;color:var(--success);margin-top:2px}
.trust-badges{display:flex;gap:var(--space-xl);margin-top:var(--space-md)}
.trust-badge-item{display:flex;align-items:center;gap:6px;font-size:var(--fs-xs);color:var(--text-muted)}
.trust-badge-item svg{width:16px;height:16px;color:var(--accent)}
.shipping-bar-wrap{margin-top:var(--space-lg)}
.recommended-section{padding:var(--space-3xl) 0}
.recommended-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:var(--space-lg)}
@media(max-width:768px){.product-grid{grid-template-columns:1fr}.recommended-grid{grid-template-columns:repeat(2,1fr)}}
</style>

<section class="product-detail">
  <div class="container">
    <!-- Breadcrumb -->
    <nav class="product-breadcrumb" style="margin-bottom:var(--space-lg);">
      <a href="<?php echo home_url(); ?>">Inicio</a> /
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Tienda</a> /
      <span style="color:var(--text-primary);font-weight:600;"><?php echo $product->get_name(); ?></span>
    </nav>

    <div class="product-grid">
      <!-- Image -->
      <div class="product-img-main">
        <?php if ($product->is_featured()) : ?><span class="product-badge-abs">Popular</span><?php endif; ?>
        <?php echo $product->get_image('product-hero'); ?>
      </div>

      <!-- Info -->
      <div class="product-meta">
        <div class="product-detail-cat"><?php echo esc_html($cat_name); ?></div>
        <h1 class="product-detail-name"><?php echo $product->get_name(); ?></h1>
        <div class="product-detail-subtitle"><?php echo $product->get_short_description(); ?></div>

        <div style="display:flex;align-items:center;">
          <span class="product-detail-price">$ <?php echo number_format($product->get_price(), 0, ',', '.'); ?></span>
          <?php if ($discount > 0) : ?>
            <span class="product-detail-original">$ <?php echo number_format($regular, 0, ',', '.'); ?></span>
            <span class="product-discount-badge">-<?php echo $discount; ?>%</span>
          <?php endif; ?>
        </div>

        <div class="product-detail-desc"><?php echo $product->get_description(); ?></div>

        <!-- Stock -->
        <?php if ($product->get_stock_quantity() && $product->get_stock_quantity() <= 10) : ?>
          <div style="font-size:var(--fs-sm);color:var(--error);font-weight:600;">Solo quedan <?php echo $product->get_stock_quantity(); ?> unidades</div>
        <?php endif; ?>

        <!-- Qty + Add to Cart -->
        <div style="display:flex;align-items:center;gap:var(--space-lg);">
          <span style="font-weight:600;color:var(--navy);">Cantidad:</span>
          <div class="qty-control">
            <button class="qty-btn" id="qtyMinus">−</button>
            <input type="number" class="qty-input" id="qtyInput" value="1" min="1">
            <button class="qty-btn" id="qtyPlus">+</button>
          </div>
        </div>

        <div class="product-actions">
          <button class="btn btn-primary btn-lg sp-add-to-cart" data-product-id="<?php echo $product->get_id(); ?>" id="addToCartBtn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            Agregar al carrito
          </button>
          <a href="<?php echo wc_get_checkout_url(); ?>" class="btn btn-outline btn-lg" id="buyNowBtn">Comprar ahora</a>
        </div>

        <a href="https://wa.me/573126317694?text=<?php echo urlencode('Hola, estoy interesado en '.$product->get_name().'. Precio: $ '.number_format($product->get_price(),0,',','.').'. Me gustaria mas informacion.'); ?>" target="_blank" class="btn btn-lg" style="background:#25D366;color:white;width:100%;display:flex;align-items:center;justify-content:center;gap:8px;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
          Consultar por WhatsApp
        </a>

        <!-- Trust badges -->
        <div class="trust-badges">
          <div class="trust-badge-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Pago seguro</div>
          <div class="trust-badge-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>Envio refrigerado</div>
          <div class="trust-badge-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Autenticidad</div>
        </div>

        <!-- Shipping bar -->
        <div class="shipping-bar-wrap" id="productShippingBar"></div>

        <!-- Specs -->
        <?php if ($purity || $content_val || $molecular || $mol_weight) : ?>
        <div class="spec-grid" style="margin-top:var(--space-lg);">
          <?php if ($purity) : ?><div class="spec-card"><div class="spec-card-label">Pureza</div><div class="spec-card-value"><?php echo esc_html($purity); ?></div></div><?php endif; ?>
          <?php if ($content_val) : ?><div class="spec-card"><div class="spec-card-label">Contenido</div><div class="spec-card-value"><?php echo esc_html($content_val); ?></div></div><?php endif; ?>
          <?php if ($molecular) : ?><div class="spec-card"><div class="spec-card-label">Formula</div><div class="spec-card-value"><?php echo esc_html($molecular); ?></div></div><?php endif; ?>
          <?php if ($mol_weight) : ?><div class="spec-card"><div class="spec-card-label">Peso Molecular</div><div class="spec-card-value"><?php echo esc_html($mol_weight); ?></div></div><?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Benefits -->
        <?php if (!empty($benefits)) : ?>
        <div style="margin-top:var(--space-lg);">
          <h3 style="font-family:var(--font-heading);font-weight:700;color:var(--navy);margin-bottom:var(--space-md);">Beneficios de Investigacion</h3>
          <ul class="benefits-list">
            <?php foreach ($benefits as $b) : ?>
            <li><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><?php echo esc_html(trim($b)); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <!-- Storage -->
        <?php if ($storage) : ?>
        <div style="margin-top:var(--space-md);padding:var(--space-md);background:var(--gray-50);border-radius:var(--radius-lg);border:1px solid var(--border-subtle);">
          <strong style="font-size:var(--fs-sm);color:var(--navy);">Almacenamiento:</strong>
          <p style="font-size:var(--fs-sm);color:var(--text-secondary);margin-top:4px;"><?php echo esc_html($storage); ?></p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- Recommended Products -->
<section class="recommended-section" style="background:var(--gray-50);">
  <div class="container">
    <h2 style="font-family:var(--font-heading);font-size:var(--fs-2xl);font-weight:800;color:var(--navy);margin-bottom:var(--space-2xl);">Tambien te puede interesar</h2>
    <div class="recommended-grid">
      <?php
      $related = wc_get_related_products($product->get_id(), 4);
      foreach ($related as $rid) :
        $rp = wc_get_product($rid);
        if (!$rp) continue;
        $rcats = wp_get_post_terms($rid, 'product_cat');
        $rcat = !empty($rcats) ? $rcats[0]->name : '';
      ?>
      <div class="product-card" onclick="window.location.href='<?php echo $rp->get_permalink(); ?>'">
        <div class="product-image-wrap"><?php echo $rp->get_image('product-card'); ?></div>
        <div class="product-info">
          <div class="product-category"><?php echo esc_html($rcat); ?></div>
          <h3 class="product-name"><?php echo $rp->get_name(); ?></h3>
          <div class="product-price-row">
            <span class="product-price"><?php echo $rp->get_price_html(); ?></span>
            <button class="product-add-btn sp-add-to-cart" data-product-id="<?php echo $rp->get_id(); ?>" onclick="event.stopPropagation();">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  let qty = 1;
  const qtyInput = document.getElementById('qtyInput');
  document.getElementById('qtyMinus').addEventListener('click', () => { if (qty > 1) { qty--; qtyInput.value = qty; }});
  document.getElementById('qtyPlus').addEventListener('click', () => { qty++; qtyInput.value = qty; });
  document.getElementById('addToCartBtn').addEventListener('click', function() {
    this.dataset.qty = qty;
  });
  document.getElementById('buyNowBtn').addEventListener('click', function(e) {
    e.preventDefault();
    const btn = document.getElementById('addToCartBtn');
    btn.dataset.qty = qty;
    btn.click();
    setTimeout(() => { window.location.href = '<?php echo wc_get_checkout_url(); ?>'; }, 500);
  });
  // Shipping bar
  if (typeof spRenderShippingBar === 'function') spRenderShippingBar('productShippingBar');
});
</script>

<?php endwhile; // end of the loop ?>

<?php get_footer(); ?>
