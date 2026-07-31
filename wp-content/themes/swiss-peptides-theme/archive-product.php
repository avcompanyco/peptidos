<?php
/**
 * Template Name: Tienda Master 2026
 * Description: Dedicated 2026 Luxury Shop Page matching front-page cards 100%
 */
get_header();
?>

<style>
:root {
    --cyan-accent: #00a8ff;
    --medical-navy: #070f1e;
    --text-slate: #cbd5e1;
}

.shop-page-hero {
    background: #070f1e;
    color: #ffffff;
    padding: 95px 24px 60px 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.shop-page-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('/wp-content/uploads/2026/07/lab_molecular_bg.jpg') center/cover no-repeat;
    opacity: 0.12;
    pointer-events: none;
}

.shop-hero-content {
    position: relative;
    z-index: 2;
    max-width: 850px;
    margin: 0 auto;
}

.shop-badge {
    display: inline-block;
    background: rgba(0, 168, 255, 0.12);
    border: 1px solid #00a8ff;
    color: #00a8ff;
    padding: 6px 20px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 18px;
}

.shop-title {
    font-size: 48px;
    font-weight: 900;
    line-height: 1.12;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
}

.shop-sub {
    font-size: 16px;
    color: #cbd5e1;
    line-height: 1.65;
    max-width: 720px;
    margin: 0 auto;
}

/* SHOP CONTAINER */
.shop-sec-container {
    padding: 60px 24px 90px 24px;
    background: #ffffff;
    min-height: 800px;
}

.shop-toolbar-flex {
    max-width: 1280px;
    margin: 0 auto 36px auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 16px 24px;
    border-radius: 16px;
}

.shop-search-box {
    position: relative;
    flex: 1;
    min-width: 260px;
}

.shop-search-input {
    width: 100%;
    box-sizing: border-box;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    padding: 12px 16px 12px 42px;
    border-radius: 10px;
    font-size: 14px;
    color: #0f172a;
    outline: none;
    transition: all 0.2s ease;
}

.shop-search-input:focus {
    border-color: #00a8ff;
    box-shadow: 0 0 0 3px rgba(0, 168, 255, 0.15);
}

.shop-search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    pointer-events: none;
}

.shop-sort-box {
    display: flex;
    align-items: center;
    gap: 10px;
}

.shop-sort-select {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 14px;
    color: #0f172a;
    outline: none;
    cursor: pointer;
}

@media (max-width: 768px) {
    .shop-title { font-size: 34px; }
    .shop-toolbar-flex { flex-direction: column; align-items: stretch; }
}
</style>

<!-- HERO HEADER -->
<section class="shop-page-hero">
    <div class="shop-hero-content">
        <div class="shop-badge">TIENDA OFICIAL SUIZA • 40 FÓRMULAS DISPONIBLES</div>
        <h1 class="shop-title">Catálogo Completo de <span style="color:#00a8ff;">Péptidos</span></h1>
        <p class="shop-sub">Fórmulas biotecnológicas de ultra-alta pureza (HPLC ≥99%) con certificados de análisis incluidos. Envíos express a Bogotá, Medellín, Cali, Barranquilla y todo Colombia.</p>
    </div>
</section>

<!-- SHOP MAIN CONTENT -->
<section class="shop-sec-container" id="catalogo">
    
    <!-- CATEGORY FILTER BAR -->
    <div class="catalog-filter-bar" style="margin-bottom:30px;">
        <button type="button" class="cat-filter-btn active" onclick="filterCatalog('all', this)">Todos los Péptidos</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Pérdida de Peso', this)">Pérdida de Peso</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Masa Muscular', this)">Masa Muscular</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Salud Celular', this)">Salud Celular</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Longevidad & Piel', this)">Longevidad & Piel</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Sueño & Bienestar', this)">Sueño & Bienestar</button>
    </div>

    <!-- TOOLBAR SEARCH & SORT -->
    <div class="shop-toolbar-flex">
        <div class="shop-search-box">
            <svg class="shop-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="shopSearchInput" class="shop-search-input" placeholder="Buscar péptido (ej. Semaglutide, Tirzepatide, BPC-157, NAD+)..." onkeyup="handleShopSearch()">
        </div>
        
        <div class="shop-sort-box">
            <span style="font-size:13px;font-weight:700;color:#475569;text-transform:uppercase;">Ordenar:</span>
            <select id="shopSortSelect" class="shop-sort-select" onchange="handleShopSort()">
                <option value="default">Relevancia / Popularidad</option>
                <option value="price-low">Menor Precio</option>
                <option value="price-high">Mayor Precio</option>
                <option value="name-az">Nombre (A-Z)</option>
            </select>
        </div>
    </div>

    <!-- DYNAMIC JS CATALOG GRID -->
    <div id="mainCatalogGrid"></div>

    <!-- LOAD MORE BUTTON -->
    <div style="text-align:center;margin-top:50px;">
        <button type="button" id="loadMoreCatalogBtn" onclick="loadMoreProducts()" class="cat-filter-btn" style="padding:14px 36px;font-size:14px;background:#070f1e;color:#fff;">
            Cargar Más Productos
        </button>
    </div>
</section>

<!-- QUALITY BANNER -->
<section style="background:#070f1e;color:#ffffff;padding:60px 24px;border-top:1px solid rgba(255,255,255,0.1);">
    <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:24px;text-align:center;">
        <div>
            <div style="font-size:24px;font-weight:800;color:#00a8ff;margin-bottom:6px;">HPLC ≥99%</div>
            <div style="font-size:14px;color:#cbd5e1;">Pureza certificada con espectrometría de masas en cada lote</div>
        </div>
        <div>
            <div style="font-size:24px;font-weight:800;color:#00a8ff;margin-bottom:6px;">24 / 48 Horas</div>
            <div style="font-size:14px;color:#cbd5e1;">Envíos express asegurados a todas las ciudades de Colombia</div>
        </div>
        <div>
            <div style="font-size:24px;font-weight:800;color:#00a8ff;margin-bottom:6px;">Cadena de Frío</div>
            <div style="font-size:14px;color:#cbd5e1;">Viales liofilizados bajo atmósfera inerte de nitrógeno</div>
        </div>
    </div>
</section>

<!-- FLOATING CART WIDGET -->
<a href="#" class="floating-cart-widget" id="floatingCartWidget">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
    </svg>
    <span>Carrito</span>
    <?php 
    $sp_cart_c = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    $sp_cart_s = WC()->cart ? WC()->cart->get_subtotal() : 0;
    ?>
    <span class="floating-cart-badge floating-cart-count" style="<?php echo ($sp_cart_c > 0) ? 'display:flex;' : 'display:none;'; ?>"><?php echo $sp_cart_c; ?></span>
    <span id="floatingCartSubtotal" style="color:#00a8ff;font-weight:800;margin-left:4px;">$ <?php echo number_format($sp_cart_s, 0, ',', '.'); ?></span>
</a>

<script src="<?php echo get_template_directory_uri(); ?>/js/interactive-catalog.js?v=<?php echo time(); ?>"></script>

<script>
// SEARCH AND SORT INTEGRATED WITH INTERACTIVE-CATALOG.JS ENGINE
function handleShopSearch() {
    var query = document.getElementById('shopSearchInput').value.toLowerCase().trim();
    if (!query) {
        currentFilteredProducts = ALL_PRODUCTS_DATA.filter(p => activeCategory === 'all' || p.category === activeCategory);
        displayedCount = 6;
        renderCatalogGrid();
        return;
    }
    currentFilteredProducts = ALL_PRODUCTS_DATA.filter(p => 
        (activeCategory === 'all' || p.category === activeCategory) &&
        (p.title.toLowerCase().includes(query) || p.desc.toLowerCase().includes(query) || p.benefits.some(b => b.toLowerCase().includes(query)))
    );
    displayedCount = currentFilteredProducts.length;
    renderCatalogGrid();
}

function handleShopSort() {
    var sortVal = document.getElementById('shopSortSelect').value;
    if (sortVal === 'price-low') {
        currentFilteredProducts.sort((a, b) => a.price - b.price);
    } else if (sortVal === 'price-high') {
        currentFilteredProducts.sort((a, b) => b.price - a.price);
    } else if (sortVal === 'name-az') {
        currentFilteredProducts.sort((a, b) => a.title.localeCompare(b.title));
    } else {
        filterCatalog(activeCategory);
        return;
    }
    renderCatalogGrid();
}
</script>

<?php get_footer(); ?>
