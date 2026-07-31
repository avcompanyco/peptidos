<?php
/**
 * 2026 World-Class High-Conversion Single Product Template
 * Swiss Peptides Clinical Luxury Design
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
$cat_name = !empty($cats) ? $cats[0]->name : 'Péptidos Médicos';
$cat_slug = !empty($cats) ? $cats[0]->slug : '';
$purity = get_post_meta($product->get_id(), 'sp_purity', true) ?: '≥99% HPLC';
$content_val = get_post_meta($product->get_id(), 'sp_content', true) ?: '10mg / vial';
$molecular = get_post_meta($product->get_id(), 'sp_molecular', true) ?: 'Síntesis Polipeptídica Alta Pureza';
$storage = get_post_meta($product->get_id(), 'sp_storage', true) ?: '2°C a 8°C (Refrigerado)';
$benefits_raw = get_post_meta($product->get_id(), 'sp_benefits', true);
$benefits = $benefits_raw ? array_filter(explode("\n", $benefits_raw)) : [
    'Máxima biodisponibilidad y pureza HPLC ≥99%',
    'Respaldado por análisis espectrométricos de laboratorio',
    'Estimula la respuesta metabólica y optimización celular',
    'Lote certificado con control de calidad grado clínico'
];

$regular = (float) $product->get_regular_price();
$sale = (float) $product->get_sale_price();
$price = (float) $product->get_price();
if ($price <= 0) $price = 900000;
$regular = ($regular > $price) ? $regular : round($price * 1.35);
$discount = ($regular > $price) ? round((1 - $price/$regular)*100) : 25;
$ref_price = round($price * 1.5);
$price_per_week = round($price / 10);
$price_per_day = round($price / 70);
?>

<style id="single-product-master-conversion-2026">
body.single-product,
body.wp-singular.single-product {
    background-color: #050B14 !important;
    color: #f8fafc !important;
    font-family: var(--font-primary, system-ui, -apple-system, sans-serif) !important;
}

/* Page Section Container */
.sp-product-page-wrapper {
    background-color: #050B14 !important;
    padding-top: calc(var(--navbar-height, 80px) + 30px) !important;
    padding-bottom: 80px !important;
    min-height: 90vh !important;
}

.sp-product-container {
    max-width: 1280px !important;
    margin: 0 auto !important;
    padding: 0 24px !important;
}

/* Breadcrumb */
.sp-p-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #64748b;
    margin-bottom: 24px;
}
.sp-p-breadcrumb a {
    color: #94a3b8;
    text-decoration: none;
    transition: color 0.2s;
}
.sp-p-breadcrumb a:hover {
    color: #00a8ff;
}

/* Master 2-Column Grid Layout */
.sp-p-grid {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 48px !important;
    align-items: start !important;
}

/* Left Column: Product Gallery Sticky Card */
.sp-p-gallery-sticky {
    position: sticky !important;
    top: calc(var(--navbar-height, 80px) + 20px) !important;
    z-index: 10 !important;
}

.sp-p-media-card {
    background: #ffffff !important;
    border-radius: 24px !important;
    padding: 32px !important;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 30px rgba(14, 165, 233, 0.15) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    aspect-ratio: 1 / 1 !important;
    overflow: hidden !important;
}

.sp-p-media-card img {
    max-width: 100% !important;
    max-height: 100% !important;
    width: auto !important;
    height: auto !important;
    object-fit: contain !important;
    filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.12)) !important;
    transition: transform 0.4s ease !important;
}
.sp-p-media-card:hover img {
    transform: scale(1.03) !important;
}

.sp-p-badge-purity {
    position: absolute !important;
    top: 20px !important;
    left: 20px !important;
    background: linear-gradient(135deg, #00a8ff 0%, #0066cc 100%) !important;
    color: #ffffff !important;
    padding: 6px 14px !important;
    border-radius: 30px !important;
    font-size: 0.75rem !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    box-shadow: 0 4px 15px rgba(0, 168, 255, 0.4) !important;
}

.sp-p-badge-stock {
    position: absolute !important;
    top: 20px !important;
    right: 20px !important;
    background: rgba(16, 185, 129, 0.95) !important;
    color: #ffffff !important;
    padding: 6px 14px !important;
    border-radius: 30px !important;
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    display: flex !important;
    align-items: center !important;
    gap: 6px !important;
}
.sp-p-badge-stock::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #ffffff;
    box-shadow: 0 0 8px #ffffff;
}

/* Right Column: High Conversion Info */
.sp-p-info {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.sp-p-category-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(14, 165, 233, 0.1);
    border: 1px solid rgba(14, 165, 233, 0.3);
    color: #38bdf8;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    width: fit-content;
}

.sp-p-title {
    font-family: var(--font-heading, system-ui, sans-serif);
    font-size: clamp(2.2rem, 4vw, 2.8rem);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.15;
    margin: 0;
    letter-spacing: -0.5px;
}

.sp-p-subtitle {
    color: #94a3b8;
    font-size: 1.05rem;
    line-height: 1.6;
    margin: 0;
}

/* Price Card Box */
.sp-p-price-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.sp-p-main-price-row {
    display: flex;
    align-items: baseline;
    gap: 12px;
    margin-bottom: 16px;
}

.sp-p-current-price {
    font-family: var(--font-heading, system-ui, sans-serif);
    font-size: 2.8rem;
    font-weight: 900;
    color: #00a8ff;
    letter-spacing: -1px;
}

.sp-p-regular-price {
    font-size: 1.25rem;
    color: #64748b;
    text-decoration: line-through;
    font-weight: 500;
}

.sp-p-discount-tag {
    background: #ef4444;
    color: #ffffff;
    font-weight: 800;
    font-size: 0.85rem;
    padding: 4px 12px;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.sp-p-breakdown-table {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 12px;
    padding: 14px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.sp-p-breakdown-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
    text-align: center;
}
.sp-p-breakdown-item label {
    font-size: 0.72rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.sp-p-breakdown-item strong {
    font-size: 0.95rem;
    color: #f1f5f9;
    font-weight: 700;
}

/* Key Benefits Grid Box */
.sp-p-benefits-card {
    background: rgba(14, 165, 233, 0.04);
    border: 1px solid rgba(14, 165, 233, 0.18);
    border-radius: 20px;
    padding: 20px 24px;
}

.sp-p-benefits-title {
    color: #38bdf8;
    font-size: 0.9rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sp-p-benefits-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.sp-p-benefit-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
    color: #e2e8f0;
    font-weight: 500;
}
.sp-p-benefit-item svg {
    width: 18px;
    height: 18px;
    color: #10b981;
    flex-shrink: 0;
}

/* Protocol Selector Box */
.sp-p-protocol-box {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.sp-p-protocol-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.95rem;
    font-weight: 800;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.sp-p-protocol-header span {
    color: #10b981;
    font-size: 0.8rem;
    font-weight: 700;
}

.sp-p-protocol-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1.5px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    transition: all 0.25s ease;
    position: relative;
}
.sp-p-protocol-card:hover {
    border-color: rgba(14, 165, 233, 0.4);
    background: rgba(14, 165, 233, 0.06);
}
.sp-p-protocol-card.active {
    background: linear-gradient(135deg, rgba(14, 165, 233, 0.12) 0%, rgba(14, 165, 233, 0.04) 100%);
    border: 2px solid #00a8ff;
    box-shadow: 0 8px 25px rgba(0, 168, 255, 0.2);
}

.sp-p-protocol-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.sp-p-radio-dot {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}
.sp-p-protocol-card.active .sp-p-radio-dot {
    border-color: #00a8ff;
    background: #00a8ff;
}
.sp-p-radio-dot::after {
    content: '';
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #ffffff;
    opacity: 0;
    transition: opacity 0.2s;
}
.sp-p-protocol-card.active .sp-p-radio-dot::after {
    opacity: 1;
}

.sp-p-protocol-info-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.sp-p-protocol-name {
    font-size: 0.95rem;
    font-weight: 700;
    color: #ffffff;
}
.sp-p-protocol-badge {
    font-size: 0.72rem;
    font-weight: 800;
    padding: 2px 8px;
    border-radius: 12px;
    text-transform: uppercase;
    width: fit-content;
}
.sp-p-protocol-badge.popular {
    background: linear-gradient(135deg, #00a8ff 0%, #0066cc 100%);
    color: #ffffff;
}
.sp-p-protocol-badge.save {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.4);
}

.sp-p-protocol-right {
    text-align: right;
}
.sp-p-protocol-price {
    font-size: 1.1rem;
    font-weight: 800;
    color: #00a8ff;
}
.sp-p-protocol-savings {
    font-size: 0.78rem;
    color: #10b981;
    font-weight: 600;
}

/* Urgency Bar Box */
.sp-p-urgency-card {
    background: rgba(239, 68, 68, 0.04);
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-radius: 16px;
    padding: 16px 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.sp-p-urgency-row {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.88rem;
    color: #cbd5e1;
}
.sp-p-urgency-row svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
}

/* Action Buttons Box */
.sp-p-actions-container {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 8px;
}

.sp-p-btn-add {
    width: 100% !important;
    background: linear-gradient(135deg, #00a8ff 0%, #0066cc 100%) !important;
    color: #ffffff !important;
    font-family: var(--font-heading, system-ui, sans-serif) !important;
    font-size: 1.15rem !important;
    font-weight: 800 !important;
    padding: 18px 32px !important;
    border-radius: 16px !important;
    border: none !important;
    cursor: pointer !important;
    box-shadow: 0 12px 30px rgba(0, 168, 255, 0.35) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    transition: all 0.3s ease !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}
.sp-p-btn-add:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 16px 40px rgba(0, 168, 255, 0.5) !important;
    background: linear-gradient(135deg, #38bdf8 0%, #0055b8 100%) !important;
}

.sp-p-btn-buy {
    width: 100% !important;
    background: transparent !important;
    border: 2px solid rgba(255, 255, 255, 0.2) !important;
    color: #ffffff !important;
    font-family: var(--font-heading, system-ui, sans-serif) !important;
    font-size: 1rem !important;
    font-weight: 700 !important;
    padding: 16px 32px !important;
    border-radius: 16px !important;
    cursor: pointer !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-decoration: none !important;
    transition: all 0.25s ease !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}
.sp-p-btn-buy:hover {
    border-color: #00a8ff !important;
    background: rgba(0, 168, 255, 0.1) !important;
    color: #ffffff !important;
}

.sp-p-whatsapp-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: #25D366;
    text-decoration: none;
    font-size: 0.88rem;
    font-weight: 600;
    margin-top: 4px;
    transition: opacity 0.2s;
}
.sp-p-whatsapp-link:hover {
    opacity: 0.85;
}

/* Trust Badges Strip */
.sp-p-trust-strip {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    padding-top: 16px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    margin-top: 8px;
}

.sp-p-trust-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.82rem;
    color: #94a3b8;
    font-weight: 500;
}
.sp-p-trust-item svg {
    width: 18px;
    height: 18px;
    color: #00a8ff;
    flex-shrink: 0;
}

/* Frequently Bought Together Box */
.sp-p-combo-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    padding: 20px 24px;
    margin-top: 12px;
}
.sp-p-combo-card h4 {
    font-size: 0.95rem;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 14px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.sp-p-combo-row {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.88rem;
    color: #cbd5e1;
    padding: 8px 0;
}
.sp-p-combo-row input[type="checkbox"] {
    accent-color: #00a8ff;
    width: 18px;
    height: 18px;
    cursor: pointer;
}

/* Below Fold Tabs & Details */
.sp-p-below-fold {
    margin-top: 60px;
    padding-top: 40px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
}
.sp-p-section-title {
    font-family: var(--font-heading, system-ui, sans-serif);
    font-size: 1.8rem;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 24px;
}

.sp-p-specs-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 40px;
}
.sp-p-spec-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.sp-p-spec-card label {
    font-size: 0.75rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.sp-p-spec-card strong {
    font-size: 1.05rem;
    color: #00a8ff;
    font-weight: 700;
}

/* FAQ Accordion */
.sp-p-faq-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.sp-p-faq-item {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    overflow: hidden;
}
.sp-p-faq-question {
    padding: 20px 24px;
    font-size: 1.05rem;
    font-weight: 700;
    color: #ffffff;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.sp-p-faq-answer {
    padding: 0 24px 20px 24px;
    color: #94a3b8;
    line-height: 1.7;
    font-size: 0.95rem;

}

/* Responsive Breakpoints */
@media (max-width: 1024px) {
    .sp-p-grid {
        grid-template-columns: 1fr !important;
        gap: 32px !important;
    }
    .sp-p-gallery-sticky {
        position: relative !important;
        top: 0 !important;
    }
    .sp-p-specs-grid {
        grid-template-columns: 1fr 1fr;
    }
}
@media (max-width: 640px) {
    .sp-p-title {
        font-size: 2rem !important;
    }
    .sp-p-current-price {
        font-size: 2.2rem !important;
    }
    .sp-p-benefits-grid {
        grid-template-columns: 1fr;
    }
    .sp-p-trust-strip {
        grid-template-columns: 1fr;
    }
    .sp-p-specs-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="sp-product-page-wrapper">
  <div class="sp-product-container">
    
    <!-- Breadcrumb -->
    <nav class="sp-p-breadcrumb">
      <a href="<?php echo home_url(); ?>">Inicio</a>
      <span>/</span>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Tienda</a>
      <span>/</span>
      <span style="color:#f1f5f9;font-weight:600;"><?php echo esc_html($product->get_name()); ?></span>
    </nav>

    <!-- Master 2-Column Grid -->
    <div class="sp-p-grid">
      
      <!-- LEFT COLUMN: STICKY PRODUCT GALLERY CARD -->
      <div class="sp-p-gallery-sticky">
        <div class="sp-p-media-card">
          <span class="sp-p-badge-purity">PUREZA ≥99% HPLC</span>
          <span class="sp-p-badge-stock">Stock Disponible</span>
          <?php echo $product->get_image('large', array('alt' => esc_attr($product->get_name()), 'loading' => 'eager')); ?>
        </div>
      </div>

      <!-- RIGHT COLUMN: HIGH CONVERSION PURCHASE FORM -->
      <div class="sp-p-info">
        
        <div class="sp-p-category-pill">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <?php echo esc_html($cat_name); ?>
        </div>

        <h1 class="sp-p-title"><?php echo esc_html($product->get_name()); ?></h1>
        
        <div class="sp-p-subtitle"><?php echo esc_html($product->get_short_description() ?: 'Polipéptido de síntesis avanzada en grado clínico para investigación médica de alta precisión.'); ?></div>

        <!-- Price Card -->
        <div class="sp-p-price-card">
          <div class="sp-p-main-price-row">
            <span class="sp-p-current-price" id="spMainPriceDisplay">$ <?php echo number_format($price, 0, ',', '.'); ?></span>
            <?php if ($regular > $price) : ?>
              <span class="sp-p-regular-price">$ <?php echo number_format($regular, 0, ',', '.'); ?></span>
              <span class="sp-p-discount-tag">-<?php echo $discount; ?>% AHORRO</span>
            <?php endif; ?>
          </div>

          <div class="sp-p-breakdown-table">
            <div class="sp-p-breakdown-item">
              <label>Ref. Internacional</label>
              <strong>$ <?php echo number_format($ref_price, 0, ',', '.'); ?></strong>
            </div>
            <div class="sp-p-breakdown-item">
              <label>Costo semanal</label>
              <strong>$ <?php echo number_format($price_per_week, 0, ',', '.'); ?></strong>
            </div>
            <div class="sp-p-breakdown-item">
              <label>Envío Colombia</label>
              <strong style="color:#10b981;">GRATIS</strong>
            </div>
          </div>
        </div>

        <!-- Key Benefits Card -->
        <div class="sp-p-benefits-card">
          <div class="sp-p-benefits-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Beneficios Principales Demostrados
          </div>
          <div class="sp-p-benefits-grid">
            <?php foreach ($benefits as $b) : $b = trim($b); if (!$b) continue; ?>
            <div class="sp-p-benefit-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              <span><?php echo esc_html($b); ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Protocol Multi-Pack Selector -->
        <?php if ($product->get_id() != 25 && $cat_name != 'Accesorios') : ?>
        <div class="sp-p-protocol-box" id="spProtocolSelector">
          <div class="sp-p-protocol-header">
            Elige tu Protocolo de Tratamiento
            <span>Ahorro aplicable automático</span>
          </div>

          <!-- 1 Unit -->
          <div class="sp-p-protocol-card" data-qty="1" data-discount="0" data-price="<?php echo $price; ?>">
            <div class="sp-p-protocol-left">
              <div class="sp-p-radio-dot"></div>
              <div class="sp-p-protocol-info-text">
                <span class="sp-p-protocol-name">1 Vial — Protocolo Inicial</span>
              </div>
            </div>
            <div class="sp-p-protocol-right">
              <span class="sp-p-protocol-price">$ <?php echo number_format($price, 0, ',', '.'); ?></span>
            </div>
          </div>

          <!-- 2 Units -->
          <div class="sp-p-protocol-card" data-qty="2" data-discount="0.10" data-price="<?php echo round($price * 2 * 0.9); ?>">
            <div class="sp-p-protocol-left">
              <div class="sp-p-radio-dot"></div>
              <div class="sp-p-protocol-info-text">
                <span class="sp-p-protocol-name">2 Viales — Protocolo Avanzado</span>
                <span class="sp-p-protocol-badge save">Ahorra 10%</span>
              </div>
            </div>
            <div class="sp-p-protocol-right">
              <span class="sp-p-protocol-price">$ <?php echo number_format($price * 2 * 0.9, 0, ',', '.'); ?></span>
              <div class="sp-p-protocol-savings">Ahorras $ <?php echo number_format($price * 2 * 0.1, 0, ',', '.'); ?></div>
            </div>
          </div>

          <!-- 3 Units (DEFAULT SELECTED) -->
          <div class="sp-p-protocol-card active" data-qty="3" data-discount="0.20" data-price="<?php echo round($price * 3 * 0.8); ?>">
            <div class="sp-p-protocol-left">
              <div class="sp-p-radio-dot"></div>
              <div class="sp-p-protocol-info-text">
                <span class="sp-p-protocol-name">3 Viales — Protocolo Profesional</span>
                <span class="sp-p-protocol-badge popular">MÁS POPULAR</span>
              </div>
            </div>
            <div class="sp-p-protocol-right">
              <span class="sp-p-protocol-price">$ <?php echo number_format($price * 3 * 0.8, 0, ',', '.'); ?></span>
              <div class="sp-p-protocol-savings">Ahorras $ <?php echo number_format($price * 3 * 0.2, 0, ',', '.'); ?></div>
            </div>
          </div>

          <!-- 4 Units -->
          <div class="sp-p-protocol-card" data-qty="4" data-discount="0.25" data-price="<?php echo round($price * 4 * 0.75); ?>">
            <div class="sp-p-protocol-left">
              <div class="sp-p-radio-dot"></div>
              <div class="sp-p-protocol-info-text">
                <span class="sp-p-protocol-name">4+ Viales — Máximo Ahorro Clinical</span>
                <span class="sp-p-protocol-badge save">Ahorra 25%</span>
              </div>
            </div>
            <div class="sp-p-protocol-right">
              <span class="sp-p-protocol-price">$ <?php echo number_format($price * 4 * 0.75, 0, ',', '.'); ?></span>
              <div class="sp-p-protocol-savings">Ahorras $ <?php echo number_format($price * 4 * 0.25, 0, ',', '.'); ?></div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Urgency Triggers Card -->
        <div class="sp-p-urgency-card">
          <div class="sp-p-urgency-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5" style="animation:pulse 1.5s infinite"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
            <span>Solo quedan <strong style="color:#ef4444;" id="spStockCounter">4 viales</strong> disponibles de este lote certificado.</span>
          </div>
          <div class="sp-p-urgency-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            <span><strong style="color:#ffffff;" id="spViewersCounter">11 especialistas</strong> están revisando este producto ahora.</span>
          </div>
          <div class="sp-p-urgency-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span><strong>Envío express hoy:</strong> Ordena en las próximas <strong style="color:#ffffff;" id="spCountdownTimer">1h 35m</strong> para despacho mañana.</span>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="sp-p-actions-container">
          <button type="button" class="sp-p-btn-add sp-add-to-cart" data-product-id="<?php echo $product->get_id(); ?>" id="spAddToCartMainBtn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            <span id="spBtnAddText">Añadir al Carrito</span>
          </button>
          
          <a href="<?php echo wc_get_checkout_url(); ?>" class="sp-p-btn-buy" id="spBuyNowMainBtn">
            Comprar Ahora (Pago Seguro)
          </a>

          <a href="https://wa.me/573189163091?text=<?php echo urlencode('Hola Swiss Peptides, deseo asesoría personalizada para adquirir '.$product->get_name()); ?>" target="_blank" class="sp-p-whatsapp-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            Asesoría personalizada por WhatsApp
          </a>
        </div>

        <!-- Trust Strip -->
        <div class="sp-p-trust-strip">
          <div class="sp-p-trust-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Pago 100% Seguro
          </div>
          <div class="sp-p-trust-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            Envío Gratis Colombia
          </div>
          <div class="sp-p-trust-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Pureza Certificada
          </div>
        </div>

        <!-- Combo Box -->
        <?php if ($product->get_id() != 25 && $cat_name != 'Accesorios') : ?>
        <div class="sp-p-combo-card">
          <h4>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            Frecuentemente comprados juntos (Combo Recomendado)
          </h4>
          <div class="sp-p-combo-row">
            <input type="checkbox" id="spComboMainItem" checked disabled>
            <span style="flex:1;">Este producto: <strong style="color:#fff;"><?php echo esc_html($product->get_name()); ?></strong></span>
            <strong style="color:#00a8ff;">$ <?php echo number_format($price, 0, ',', '.'); ?></strong>
          </div>
          <div class="sp-p-combo-row">
            <input type="checkbox" id="spComboAddonItem" checked>
            <span style="flex:1;">Agua Bacteriostática Grado Clínico (30ml)</span>
            <strong style="color:#00a8ff;">$ 75.000</strong>
          </div>
        </div>
        <?php endif; ?>

      </div>

    </div>

    <!-- Below Fold Technical Specs & FAQs -->
    <div class="sp-p-below-fold">
      <h3 class="sp-p-section-title">Especificaciones Técnicas del Lote</h3>
      
      <div class="sp-p-specs-grid">
        <div class="sp-p-spec-card">
          <label>Pureza Certificada</label>
          <strong><?php echo esc_html($purity); ?></strong>
        </div>
        <div class="sp-p-spec-card">
          <label>Concentración</label>
          <strong><?php echo esc_html($content_val); ?></strong>
        </div>
        <div class="sp-p-spec-card">
          <label>Almacenamiento</label>
          <strong><?php echo esc_html($storage); ?></strong>
        </div>
        <div class="sp-p-spec-card">
          <label>Secuencia / Grado</label>
          <strong><?php echo esc_html($molecular); ?></strong>
        </div>
      </div>

      <h3 class="sp-p-section-title" style="margin-top:40px;">Preguntas Frecuentes de Especialistas</h3>

      <div class="sp-p-faq-list">
        <div class="sp-p-faq-item">
          <div class="sp-p-faq-question">
            ¿Cómo se garantiza la pureza del 99% del péptido?
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
          </div>
          <div class="sp-p-faq-answer">
            Cada lote producido por Swiss Peptides Labs se somete a cromatografía líquida de alta resolución (HPLC) y espectrometría de masas (MS) para certificar su pureza y secuencia exacta antes de su distribución.
          </div>
        </div>

        <div class="sp-p-faq-item">
          <div class="sp-p-faq-question">
            ¿Cuál es el tiempo de entrega en Colombia?
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
          </div>
          <div class="sp-p-faq-answer">
            Los despachos a Bogotá, Medellín, Cali y Barranquilla demoran de 24 a 48 horas hábiles con empaque de protección térmica para preservar la integridad del péptido. El envío es totalmente gratis.
          </div>
        </div>

        <div class="sp-p-faq-item">
          <div class="sp-p-faq-question">
            ¿Cómo se realiza la reconstitución del vial?
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
          </div>
          <div class="sp-p-faq-answer">
            Se recomienda utilizar Agua Bacteriostática estéril dejando deslizar suavemente el líquido por la pared interna del vial liofilizado sin agitar bruscamente.
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var selectedQty = 3;
  var basePrice = <?php echo $price; ?>;

  // Protocol Selector Cards Click
  var protocolCards = document.querySelectorAll('.sp-p-protocol-card');
  protocolCards.forEach(function(card) {
    card.addEventListener('click', function() {
      protocolCards.forEach(function(c) { c.classList.remove('active'); });
      this.classList.add('active');
      selectedQty = parseInt(this.getAttribute('data-qty')) || 1;
      
      // Update Main Price Display
      var newPrice = this.getAttribute('data-price');
      var mainDisplay = document.getElementById('spMainPriceDisplay');
      if (mainDisplay && newPrice) {
        mainDisplay.textContent = '$ ' + parseInt(newPrice).toLocaleString('es-CO');
      }
      
      // Update Add to Cart Button Text
      var btnText = document.getElementById('spBtnAddText');
      if (btnText && newPrice) {
        btnText.textContent = 'Añadir ' + selectedQty + ' Vial' + (selectedQty > 1 ? 'es' : '') + ' al Carrito — $ ' + parseInt(newPrice).toLocaleString('es-CO');
      }
    });
  });

  // Add to Cart Click Handler
  var addBtn = document.getElementById('spAddToCartMainBtn');
  if (addBtn) {
    addBtn.addEventListener('click', function() {
      var productId = this.getAttribute('data-product-id');
      var comboAddon = document.getElementById('spComboAddonItem');
      var includeCombo = comboAddon && comboAddon.checked;
      
      this.disabled = true;
      var btnText = document.getElementById('spBtnAddText');
      var originalText = btnText ? btnText.textContent : 'Añadir al Carrito';
      if (btnText) btnText.textContent = 'Añadiendo...';

      var promises = [];
      promises.push(
        fetch('/?wc-ajax=add_to_cart', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'product_id=' + productId + '&quantity=' + selectedQty
        })
      );

      if (includeCombo) {
        promises.push(
          fetch('/?wc-ajax=add_to_cart', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'product_id=25&quantity=1'
          })
        );
      }

      Promise.all(promises)
        .then(function(responses) { return Promise.all(responses.map(function(r) { return r.json(); })); })
        .then(function(dataArray) {
          window.location.href = '/cart/';
        })
        .catch(function() {
          window.location.href = '/cart/';
        });
    });
  }
});
</script>

<?php endwhile; ?>

<?php get_footer(); ?>
