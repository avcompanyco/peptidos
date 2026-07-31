<?php
/**
 * WooCommerce Shop / Product Archive — Exact match to tienda.html
 */
get_header();

$current_cat = get_queried_object();
$is_cat = is_product_category();
?>

<style>
.shop-hero { padding: calc(var(--navbar-height) + var(--space-3xl) + 28px) 0 var(--space-2xl); background: var(--bg-secondary); }
.shop-hero h1 { font-size: clamp(var(--fs-2xl), 4vw, var(--fs-4xl)); }
.shop-layout { display: grid; grid-template-columns: 260px 1fr; gap: var(--space-2xl); }
.shop-sidebar { position: sticky; top: calc(var(--navbar-height) + var(--space-lg)); align-self: start; }
.filter-section { background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-xl); padding: var(--space-xl); margin-bottom: var(--space-lg); }
.filter-title { font-family: var(--font-heading); font-size: var(--fs-sm); font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--navy); margin-bottom: var(--space-md); }
.shop-toolbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-xl); flex-wrap: wrap; gap: var(--space-md); }
.shop-result-text { font-size: var(--fs-sm); color: var(--text-muted); }
.shop-result-text strong { color: var(--accent); font-weight: 700; }
.shop-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--space-lg); }
.category-tags { display: flex; flex-wrap: wrap; gap: var(--space-xs); margin-bottom: var(--space-lg); }
.price-display { display: flex; justify-content: space-between; font-size: var(--fs-xs); color: var(--text-muted); margin-top: var(--space-xs); }
@media (max-width: 1024px) { .shop-layout { grid-template-columns: 1fr; } .shop-sidebar { position: static; } .shop-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px) { .shop-grid { grid-template-columns: 1fr; } }
</style>

<!-- Shop Hero -->
<section class="shop-hero">
  <div class="container">
    <div class="section-label">Catalogo completo</div>
    <h1>Nuestra <span class="text-gradient">Tienda</span></h1>
    <p class="section-subtitle" style="margin-top:var(--space-sm);">
      <?php echo wp_count_posts('product')->publish; ?> peptidos de investigacion con pureza certificada. Directo de nuestro laboratorio suizo.
    </p>
    <!-- Category Tags -->
    <div class="category-tags" style="margin-top:var(--space-xl);">
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="tag <?php echo !$is_cat ? 'active' : ''; ?>">Todos</a>
      <?php
      $categories = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => true, 'parent' => 0, 'exclude' => [get_option('default_product_cat')]]);
      if ($categories) :
        foreach ($categories as $cat) :
      ?>
      <a href="<?php echo get_term_link($cat); ?>" class="tag <?php echo ($is_cat && $current_cat->term_id === $cat->term_id) ? 'active' : ''; ?>"><?php echo $cat->name; ?></a>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>

<!-- Shop Content -->
<section class="section">
  <div class="container">
    <div class="shop-layout">
      <!-- Sidebar -->
      <aside class="shop-sidebar">
        <div class="filter-section">
          <div class="filter-title">Buscar</div>
          <input type="text" class="form-input" id="spSearchInput" placeholder="Buscar peptidos...">
        </div>
        <div class="filter-section">
          <div class="filter-title">Precio</div>
          <input type="range" id="spPriceRange" min="0" max="2500000" value="2500000" style="width:100%;accent-color:var(--accent);">
          <div class="price-display"><span>$0</span><span id="spPriceMax">$2.500.000</span></div>
        </div>
        <div class="filter-section">
          <div class="filter-title">Ordenar por</div>
          <select class="form-select" id="spSortSelect">
            <option value="featured">Destacados</option>
            <option value="price-low">Precio: Menor a Mayor</option>
            <option value="price-high">Precio: Mayor a Menor</option>
            <option value="name">Nombre A-Z</option>
          </select>
        </div>
      </aside>
      <!-- Products -->
      <div>
        <div class="shop-toolbar">
          <div class="shop-result-text">Mostrando <strong id="spResultCount"><?php global $wp_query; echo isset($wp_query->found_posts) ? $wp_query->found_posts : 0; ?></strong> productos</div>
        </div>
        <div class="shop-grid" id="spShopGrid">
          <?php if (have_posts()) : while (have_posts()) : the_post();
            global $product;
            $cats = wp_get_post_terms($product->get_id(), 'product_cat');
            $cat_name = !empty($cats) ? $cats[0]->name : '';
            $price = $product->get_price();
            $regular = $product->get_regular_price();
            $badge_text = '';
            if ($product->is_on_sale()) $badge_text = 'Oferta';
            elseif ($product->is_featured()) $badge_text = 'Popular';
          ?>
          <div class="product-card sp-product-item" data-name="<?php echo esc_attr(strtolower($product->get_name())); ?>" data-price="<?php echo esc_attr($price); ?>" data-featured="<?php echo $product->is_featured() ? '1' : '0'; ?>" onclick="if(!event.target.closest('.sp-add-to-cart')){window.location.href='<?php the_permalink(); ?>'}">
            <div class="product-image-wrap">
              <?php echo $product->get_image('product-card'); ?>
              <?php if ($badge_text) : ?><span class="product-badge"><?php echo $badge_text; ?></span><?php endif; ?>
            </div>
            <div class="product-info">
              <div class="product-category"><?php echo esc_html($cat_name); ?></div>
              <h3 class="product-name"><?php the_title(); ?></h3>
              <div class="product-subtitle"><?php echo wp_trim_words(wp_strip_all_tags($product->get_short_description()), 20, '...'); ?></div>
              <div class="product-price-row">
                <div>
                  <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                </div>
                <button class="product-add-btn sp-add-to-cart" data-product-id="<?php echo $product->get_id(); ?>">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </button>
              </div>
            </div>
          </div>
          <?php endwhile; else : ?>
          <p style="text-align:center;padding:var(--space-3xl);color:var(--text-muted);grid-column:1/-1;">No se encontraron productos con esos criterios.</p>
          <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav class="sp-pagination">
          <?php
          echo paginate_links([
            'prev_text' => '&larr; Anterior',
            'next_text' => 'Siguiente &rarr;',
          ]);
          ?>
        </nav>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('spSearchInput');
  const priceRange = document.getElementById('spPriceRange');
  const priceMax = document.getElementById('spPriceMax');
  const sortSelect = document.getElementById('spSortSelect');
  const grid = document.getElementById('spShopGrid');
  const resultCount = document.getElementById('spResultCount');
  if (!grid) return;
  const items = Array.from(grid.querySelectorAll('.sp-product-item'));

  function formatPrice(n) {
    return '$' + parseInt(n).toLocaleString('es-CO');
  }

  function filterAndSort() {
    const search = (searchInput?.value || '').toLowerCase();
    const maxPrice = parseInt(priceRange?.value || 2500000);
    const sort = sortSelect?.value || 'featured';

    if (priceMax) priceMax.textContent = formatPrice(maxPrice);

    let visible = 0;
    items.forEach(item => {
      const name = item.dataset.name || '';
      const price = parseFloat(item.dataset.price || 0);
      const show = name.includes(search) && price <= maxPrice;
      item.style.display = show ? '' : 'none';
      if (show) visible++;
    });

    if (resultCount) resultCount.textContent = visible;

    // Sort
    const sorted = items.filter(i => i.style.display !== 'none');
    if (sort === 'price-low') sorted.sort((a,b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
    else if (sort === 'price-high') sorted.sort((a,b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
    else if (sort === 'name') sorted.sort((a,b) => (a.dataset.name || '').localeCompare(b.dataset.name || ''));
    else sorted.sort((a,b) => parseInt(b.dataset.featured||0) - parseInt(a.dataset.featured||0));

    sorted.forEach(item => grid.appendChild(item));
  }

  searchInput?.addEventListener('input', filterAndSort);
  priceRange?.addEventListener('input', filterAndSort);
  sortSelect?.addEventListener('change', filterAndSort);
});
</script>

<?php get_footer(); ?>
