<?php
/**
 * 2026 World-Class High-Conversion Single Product Template
 * Swiss Peptides Clinical Luxury - Size Variations + Aligned Buttons + 100% Mobile Optimized
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

// 100% Spanish metadata fallbacks
$purity = get_post_meta($product->get_id(), 'sp_purity', true);
if (!$purity || strpos($purity, 'Tested') !== false) {
    $purity = '≥99.8% Certificada por HPLC';
}
$content_val = get_post_meta($product->get_id(), 'sp_content', true) ?: '10mg / presentación estéril';

$storage = get_post_meta($product->get_id(), 'sp_storage', true);
if (!$storage || strpos($storage, 'Store') !== false || strpos($storage, 'lyophilized') !== false) {
    $storage = 'Conservar a 2°C - 8°C (Refrigeración continua)';
}

$molecular = get_post_meta($product->get_id(), 'sp_molecular', true) ?: 'Síntesis de Grado Clínico Suizo';

$benefits_raw = get_post_meta($product->get_id(), 'sp_benefits', true);
$benefits = $benefits_raw ? array_filter(explode("\n", $benefits_raw)) : [
    'Máxima biodisponibilidad y pureza garantizada ≥99.8%',
    'Certificado de análisis de laboratorio de síntesis suiza',
    'Optimización metabólica y celular de alta precisión',
    'Envase estéril hermético con sellado de seguridad'
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

// Size variations setup
$sizes = [
    ['label' => '5mg', 'multiplier' => 0.75, 'badge' => 'Inicial'],
    ['label' => '10mg', 'multiplier' => 1.0, 'badge' => 'Estándar', 'default' => true],
    ['label' => '15mg', 'multiplier' => 1.35, 'badge' => 'Concentrado']
];
?>

<style id="single-product-master-v2-2026">
/* LIGHT CLINICAL LUXURY THEME */
body.single-product,
body.wp-singular.single-product {
    background-color: #f8fafc !important;
    color: #0f172a !important;
    font-family: var(--font-primary, system-ui, -apple-system, sans-serif) !important;
    overflow-x: hidden !important;
}

/* Master Wrapper */
.sp-perfect-product-wrapper {
    background-color: #f8fafc !important;
    padding-top: calc(var(--navbar-height, 80px) + 24px) !important;
    padding-bottom: 80px !important;
    min-height: 90vh !important;
    width: 100% !important;
}

.sp-perfect-container {
    max-width: 1280px !important;
    margin: 0 auto !important;
    padding: 0 24px !important;
    width: 100% !important;
    box-sizing: border-box !important;
}

/* Breadcrumb */
.sp-p-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.88rem;
    color: #64748b;
    margin-bottom: 24px;
    flex-wrap: wrap;
}
.sp-p-breadcrumb a {
    color: #64748b;
    text-decoration: none;
    transition: color 0.2s;
}
.sp-p-breadcrumb a:hover {
    color: #0284c7;
}

/* Master 2-Column Grid Layout */
.sp-p-grid {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 44px !important;
    align-items: start !important;
    width: 100% !important;
}

/* Left Column: Product Gallery Sticky Card */
.sp-p-gallery-sticky {
    position: sticky !important;
    top: calc(var(--navbar-height, 80px) + 20px) !important;
    z-index: 10 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 16px !important;
}

/* ZERO PADDING IMAGE CONTAINER */
.sp-p-media-card-zero-padding {
    background: #ffffff !important;
    border-radius: 24px !important;
    padding: 0 !important;
    margin: 0 !important;
    box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.08), 0 0 1px rgba(15, 23, 42, 0.12) !important;
    border: 1px solid #e2e8f0 !important;
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    aspect-ratio: 1 / 1 !important;
    overflow: hidden !important;
}

.sp-p-media-card-zero-padding img {
    width: 100% !important;
    height: 100% !important;
    max-width: 100% !important;
    max-height: 100% !important;
    object-fit: cover !important;
    margin: 0 !important;
    padding: 0 !important;
    display: block !important;
    transition: transform 0.4s ease !important;
}
.sp-p-media-card-zero-padding:hover img {
    transform: scale(1.03) !important;
}

/* BADGES POSITIONED BELOW THE IMAGE CONTAINER */
.sp-p-badges-row-below {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
    width: 100% !important;
    flex-wrap: wrap !important;
}

.sp-p-badge-purity-below {
    background: #f0f9ff !important;
    color: #0284c7 !important;
    border: 1px solid #bae6fd !important;
    padding: 8px 16px !important;
    border-radius: 30px !important;
    font-size: 0.8rem !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    display: flex !important;
    align-items: center !important;
    gap: 6px !important;
}

.sp-p-badge-stock-below {
    background: #ecfdf5 !important;
    color: #047857 !important;
    border: 1px solid #a7f3d0 !important;
    padding: 8px 16px !important;
    border-radius: 30px !important;
    font-size: 0.8rem !important;
    font-weight: 700 !important;
    display: flex !important;
    align-items: center !important;
    gap: 6px !important;
}
.sp-p-badge-stock-below::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #10b981;
    box-shadow: 0 0 6px #10b981;
}

/* Right Column Information */
.sp-p-info {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.sp-p-category-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #e0f2fe;
    border: 1px solid #bae6fd;
    color: #0284c7;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    width: fit-content;
}

.sp-p-title {
    font-family: var(--font-heading, system-ui, sans-serif);
    font-size: clamp(2rem, 3.8vw, 2.7rem);
    font-weight: 800;
    color: #0f172a;
    line-height: 1.15;
    margin: 0;
    letter-spacing: -0.5px;
}

.sp-p-subtitle {
    color: #475569;
    font-size: 1.02rem;
    line-height: 1.6;
    margin: 0;
}

/* Price Card Box */
.sp-p-price-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
}

.sp-p-main-price-row {
    display: flex;
    align-items: baseline;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}

.sp-p-current-price {
    font-family: var(--font-heading, system-ui, sans-serif);
    font-size: 2.8rem;
    font-weight: 900;
    color: #0284c7;
    letter-spacing: -1px;
}

.sp-p-regular-price {
    font-size: 1.25rem;
    color: #94a3b8;
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
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
}

.sp-p-breakdown-table {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    background: #f8fafc;
    border-radius: 12px;
    padding: 14px;
    border: 1px solid #e2e8f0;
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
    color: #0f172a;
    font-weight: 700;
}

/* NEW: SIZE / DOSAGE VARIATION SELECTOR */
.sp-p-size-variation-box {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.sp-p-size-variation-label {
    font-size: 0.92rem;
    font-weight: 800;
    color: #0f172a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.sp-p-size-variation-label span {
    color: #0284c7;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: none;
}

.sp-p-size-pills-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.sp-p-size-pill {
    background: #ffffff;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    padding: 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: center;
}
.sp-p-size-pill:hover {
    border-color: #0284c7;
    background: #f0f9ff;
}
.sp-p-size-pill.active {
    border-color: #0284c7;
    background: #f0f9ff;
    box-shadow: 0 4px 16px rgba(2, 132, 199, 0.15);
}

.sp-p-size-pill-name {
    font-size: 1.05rem;
    font-weight: 800;
    color: #0f172a;
}
.sp-p-size-pill-badge {
    font-size: 0.72rem;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
}
.sp-p-size-pill.active .sp-p-size-pill-name {
    color: #0284c7;
}

/* Key Benefits Grid Box */
.sp-p-benefits-card {
    background: #f0f9ff;
    border: 1px solid #bae6fd;
    border-radius: 20px;
    padding: 20px 24px;
}

.sp-p-benefits-title {
    color: #0284c7;
    font-size: 0.9rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.sp-p-benefits-title svg {
    width: 20px !important;
    height: 20px !important;
    flex-shrink: 0 !important;
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
    color: #334155;
    font-weight: 600;
}
.sp-p-benefit-item svg {
    width: 18px !important;
    height: 18px !important;
    color: #10b981 !important;
    flex-shrink: 0 !important;
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
    color: #0f172a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.sp-p-protocol-header span {
    color: #059669;
    font-size: 0.8rem;
    font-weight: 700;
}

.sp-p-protocol-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    transition: all 0.25s ease;
    position: relative;
    box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);
}
.sp-p-protocol-card:hover {
    border-color: #0284c7;
    background: #f0f9ff;
}
.sp-p-protocol-card.active {
    background: #f0f9ff;
    border: 2px solid #0284c7;
    box-shadow: 0 8px 25px rgba(2, 132, 199, 0.12);
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
    border: 2px solid #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    flex-shrink: 0;
}
.sp-p-protocol-card.active .sp-p-radio-dot {
    border-color: #0284c7;
    background: #0284c7;
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
    color: #0f172a;
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
    background: #0284c7;
    color: #ffffff;
}
.sp-p-protocol-badge.save {
    background: #d1fae5;
    color: #047857;
    border: 1px solid #a7f3d0;
}

.sp-p-protocol-right {
    text-align: right;
}
.sp-p-protocol-price {
    font-size: 1.1rem;
    font-weight: 800;
    color: #0284c7;
}
.sp-p-protocol-savings {
    font-size: 0.78rem;
    color: #059669;
    font-weight: 600;
}

/* Urgency Card Box */
.sp-p-urgency-card {
    background: #fef2f2;
    border: 1px solid #fecaca;
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
    color: #334155;
}
.sp-p-urgency-row svg {
    width: 18px !important;
    height: 18px !important;
    flex-shrink: 0 !important;
}

/* PERFECTLY ALIGNED 3-BUTTON ACTION CONTAINER */
.sp-p-unified-actions-stack {
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
    width: 100% !important;
    margin-top: 8px !important;
}

.sp-p-btn-action-base {
    width: 100% !important;
    height: 56px !important;
    border-radius: 16px !important;
    font-family: var(--font-heading, system-ui, sans-serif) !important;
    font-size: 1.05rem !important;
    font-weight: 800 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
    gap: 10px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    text-decoration: none !important;
    box-sizing: border-box !important;
    transition: all 0.25s ease !important;
    cursor: pointer !important;
}

/* Button 1: Primary Cart */
.sp-p-btn-add-primary {
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;
    color: #ffffff !important;
    border: none !important;
    box-shadow: 0 10px 25px rgba(2, 132, 199, 0.3) !important;
}
.sp-p-btn-add-primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 14px 35px rgba(2, 132, 199, 0.45) !important;
    background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%) !important;
}

/* Button 2: Outlined Checkout */
.sp-p-btn-buy-secondary {
    background: #ffffff !important;
    border: 2px solid #0284c7 !important;
    color: #0284c7 !important;
}
.sp-p-btn-buy-secondary:hover {
    background: #f0f9ff !important;
    color: #0284c7 !important;
}

/* Button 3: WhatsApp Green Pill Button */
.sp-p-btn-whatsapp-pill {
    background: #25D366 !important;
    border: none !important;
    color: #ffffff !important;
    box-shadow: 0 8px 20px rgba(37, 211, 102, 0.25) !important;
}
.sp-p-btn-whatsapp-pill:hover {
    background: #20bd5a !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 12px 28px rgba(37, 211, 102, 0.38) !important;
}

/* Trust Strip */
.sp-p-trust-strip {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    padding-top: 16px;
    border-top: 1px solid #e2e8f0;
    margin-top: 8px;
}

.sp-p-trust-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 0.82rem;
    color: #64748b;
    font-weight: 600;
    text-align: center;
}
.sp-p-trust-item svg {
    width: 18px !important;
    height: 18px !important;
    color: #0284c7 !important;
    flex-shrink: 0 !important;
}

/* Combo Card Box */
.sp-l-combo-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 20px 24px;
    margin-top: 12px;
    box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
}
.sp-l-combo-card h4 {
    font-size: 0.95rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 14px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.sp-l-combo-card h4 svg {
    width: 18px !important;
    height: 18px !important;
    flex-shrink: 0 !important;
}
.sp-l-combo-row {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.88rem;
    color: #334155;
    padding: 8px 0;
}
.sp-l-combo-row input[type="checkbox"] {
    accent-color: #0284c7;
    width: 18px;
    height: 18px;
    cursor: pointer;
}

/* ==========================================================================
   MASTER REDESIGNED BELOW-THE-FOLD SECTION (HIGH VISUAL IMPACT)
   ========================================================================== */
.sp-master-bottom-section {
    width: 100% !important;
    margin-top: 64px !important;
    padding-top: 50px !important;
    border-top: 2px solid #e2e8f0 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 60px !important;
}

.sp-m-title-block {
    text-align: center !important;
    margin-bottom: 32px !important;
}
.sp-m-title-block h3 {
    font-family: var(--font-heading, system-ui, sans-serif) !important;
    font-size: clamp(1.8rem, 3vw, 2.4rem) !important;
    font-weight: 800 !important;
    color: #0f172a !important;
    margin: 0 0 10px 0 !important;
    letter-spacing: -0.5px !important;
}
.sp-m-title-block p {
    font-size: 1.05rem !important;
    color: #64748b !important;
    margin: 0 !important;
}

/* 4-Column High-Visual Technical Specs Cards Grid */
.sp-m-specs-4col-grid {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 24px !important;
    width: 100% !important;
}

.sp-m-spec-luxury-card {
    background: #ffffff !important;
    border: 1.5px solid #cbd5e1 !important;
    border-radius: 20px !important;
    padding: 26px 22px !important;
    box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.06) !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
    transition: all 0.3s ease !important;
    position: relative !important;
    overflow: hidden !important;
}
.sp-m-spec-luxury-card:hover {
    transform: translateY(-4px) !important;
    box-shadow: 0 20px 40px -10px rgba(2, 132, 199, 0.15) !important;
    border-color: #0284c7 !important;
}

.sp-m-spec-header-row {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}

.sp-m-spec-icon-box {
    width: 46px !important;
    height: 46px !important;
    border-radius: 14px !important;
    background: #e0f2fe !important;
    color: #0284c7 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    flex-shrink: 0 !important;
    border: 1px solid #bae6fd !important;
}
.sp-m-spec-icon-box svg {
    width: 22px !important;
    height: 22px !important;
    flex-shrink: 0 !important;
}

.sp-m-spec-label {
    font-size: 0.78rem !important;
    font-weight: 800 !important;
    color: #64748b !important;
    text-transform: uppercase !important;
    letter-spacing: 0.8px !important;
}

.sp-m-spec-value {
    font-size: 1rem !important;
    font-weight: 800 !important;
    color: #0f172a !important;
    line-height: 1.45 !important;
}

/* Master FAQ Accordion Styling */
.sp-m-faq-container {
    max-width: 900px !important;
    margin: 0 auto !important;
    width: 100% !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 16px !important;
}

.sp-m-faq-card {
    background: #ffffff !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 20px !important;
    overflow: hidden !important;
    box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03) !important;
    transition: all 0.25s ease !important;
}
.sp-m-faq-card:hover {
    border-color: #0284c7 !important;
}

.sp-m-faq-header {
    padding: 22px 28px !important;
    font-size: 1.08rem !important;
    font-weight: 800 !important;
    color: #0f172a !important;
    cursor: pointer !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    gap: 16px !important;
    user-select: none !important;
}
.sp-m-faq-header svg {
    width: 20px !important;
    height: 20px !important;
    color: #0284c7 !important;
    flex-shrink: 0 !important;
    transition: transform 0.3s ease !important;
}

.sp-m-faq-card.open .sp-m-faq-header svg {
    transform: rotate(180deg) !important;
}

.sp-m-faq-content {
    padding: 0 28px 24px 28px !important;
    color: #334155 !important;
    font-size: 0.98rem !important;
    line-height: 1.7 !important;
    background: #f8fafc !important;
    border-top: 1px solid #f1f5f9 !important;
    display: none;
}
.sp-m-faq-card.open .sp-m-faq-content {
    display: block !important;
}

/* ==========================================================================
   100% MOBILE RESPONSIVE OPTIMIZATIONS
   ========================================================================== */
@media (max-width: 1024px) {
    .sp-p-grid {
        grid-template-columns: 1fr !important;
        gap: 32px !important;
    }
    .sp-p-gallery-sticky {
        position: relative !important;
        top: 0 !important;
    }
    .sp-m-specs-4col-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 16px !important;
    }
}
@media (max-width: 640px) {
    .sp-perfect-container {
        padding: 0 16px !important;
    }
    .sp-p-title {
        font-size: 1.9rem !important;
    }
    .sp-p-current-price {
        font-size: 2.2rem !important;
    }
    .sp-p-benefits-grid {
        grid-template-columns: 1fr !important;
    }
    .sp-p-trust-strip {
        grid-template-columns: 1fr !important;
        gap: 10px !important;
    }
    .sp-m-specs-4col-grid {
        grid-template-columns: 1fr !important;
        gap: 12px !important;
    }
    .sp-m-faq-header {
        padding: 18px 20px !important;
        font-size: 0.96rem !important;
    }
    .sp-m-faq-content {
        padding: 0 20px 20px 20px !important;
        font-size: 0.92rem !important;
    }
    .sp-p-btn-action-base {
        font-size: 0.95rem !important;
        height: 52px !important;
        padding: 14px 18px !important;
    }
    .sp-p-breakdown-table {
        grid-template-columns: 1fr !important;
        gap: 8px !important;
    }
    .sp-p-size-pills-grid {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 8px !important;
    }
    .sp-p-size-pill {
        padding: 10px 6px !important;
    }
    .sp-p-size-pill-name {
        font-size: 0.95rem !important;
    }
}
</style>

<div class="sp-perfect-product-wrapper">
  <div class="sp-perfect-container">
    
    <!-- Breadcrumb -->
    <nav class="sp-p-breadcrumb">
      <a href="<?php echo home_url(); ?>">Inicio</a>
      <span>/</span>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Tienda</a>
      <span>/</span>
      <span style="color:#0f172a;font-weight:600;"><?php echo esc_html($product->get_name()); ?></span>
    </nav>

    <!-- Master 2-Column Grid -->
    <div class="sp-p-grid">
      
      <!-- LEFT COLUMN: STICKY PRODUCT GALLERY & BADGES BELOW -->
      <div class="sp-p-gallery-sticky">
        
        <!-- ZERO PADDING IMAGE CONTAINER -->
        <div class="sp-p-media-card-zero-padding">
          <?php echo $product->get_image('large', array('alt' => esc_attr($product->get_name()), 'loading' => 'eager')); ?>
        </div>

        <!-- BADGES ROW BELOW THE IMAGE CONTAINER -->
        <div class="sp-p-badges-row-below">
          <div class="sp-p-badge-purity-below">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>Pureza ≥99.8% HPLC</span>
          </div>
          <div class="sp-p-badge-stock-below">
            <span>Stock Disponible Colombia</span>
          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN: HIGH CONVERSION PURCHASE FORM -->
      <div class="sp-p-info">
        
        <div class="sp-p-category-pill">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <?php echo esc_html($cat_name); ?>
        </div>

        <h1 class="sp-p-title"><?php echo esc_html($product->get_name()); ?></h1>
        
        <div class="sp-p-subtitle"><?php echo esc_html($product->get_short_description() ?: 'Fórmula de síntesis avanzada en grado clínico para investigación y optimización de alta precisión.'); ?></div>

        <!-- Price Card -->
        <div class="sp-p-price-card">
          <div class="sp-p-main-price-row">
            <span class="sp-p-current-price" id="spMainPriceDisplay">$ <?php echo number_format($price, 0, ',', '.'); ?></span>
            <?php if ($regular > $price) : ?>
              <span class="sp-p-regular-price" id="spRegularPriceDisplay">$ <?php echo number_format($regular, 0, ',', '.'); ?></span>
              <span class="sp-p-discount-tag" id="spDiscountTagDisplay">-<?php echo $discount; ?>% AHORRO</span>
            <?php endif; ?>
          </div>

          <div class="sp-p-breakdown-table">
            <div class="sp-p-breakdown-item">
              <label>Ref. Internacional</label>
              <strong id="spRefPriceDisplay">$ <?php echo number_format($ref_price, 0, ',', '.'); ?></strong>
            </div>
            <div class="sp-p-breakdown-item">
              <label>Costo semanal</label>
              <strong id="spWeekPriceDisplay">$ <?php echo number_format($price_per_week, 0, ',', '.'); ?></strong>
            </div>
            <div class="sp-p-breakdown-item">
              <label>Envío Colombia</label>
              <strong style="color:#059669;">GRATIS</strong>
            </div>
          </div>
        </div>

        <!-- NEW: SIZE / DOSAGE VARIATION SELECTOR -->
        <?php if ($product->get_id() != 25 && $cat_name != 'Accesorios') : ?>
        <div class="sp-p-size-variation-box">
          <div class="sp-p-size-variation-label">
            Selecciona la Presentación / Concentración:
            <span id="spSelectedSizeText">10mg (Estándar)</span>
          </div>

          <div class="sp-p-size-pills-grid" id="spSizePillsGrid">
            <?php foreach ($sizes as $s) : ?>
              <div class="sp-p-size-pill <?php echo !empty($s['default']) ? 'active' : ''; ?>" data-size="<?php echo esc_attr($s['label']); ?>" data-multiplier="<?php echo esc_attr($s['multiplier']); ?>">
                <span class="sp-p-size-pill-name"><?php echo esc_html($s['label']); ?></span>
                <span class="sp-p-size-pill-badge"><?php echo esc_html($s['badge']); ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Key Benefits Card -->
        <div class="sp-p-benefits-card">
          <div class="sp-p-benefits-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Beneficios Principales Demostrados
          </div>
          <div class="sp-p-benefits-grid">
            <?php foreach ($benefits as $b) : $b = trim($b); if (!$b) continue; ?>
            <div class="sp-p-benefit-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
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
          <div class="sp-p-protocol-card" data-qty="1" data-discount="0">
            <div class="sp-p-protocol-left">
              <div class="sp-p-radio-dot"></div>
              <div class="sp-p-protocol-info-text">
                <span class="sp-p-protocol-name">1 Unidad — Protocolo Inicial</span>
              </div>
            </div>
            <div class="sp-p-protocol-right">
              <span class="sp-p-protocol-price sp-calc-proto-price" data-qty="1" data-discount="0">$ <?php echo number_format($price, 0, ',', '.'); ?></span>
            </div>
          </div>

          <!-- 2 Units -->
          <div class="sp-p-protocol-card" data-qty="2" data-discount="0.10">
            <div class="sp-p-protocol-left">
              <div class="sp-p-radio-dot"></div>
              <div class="sp-p-protocol-info-text">
                <span class="sp-p-protocol-name">2 Unidades — Protocolo Avanzado</span>
                <span class="sp-p-protocol-badge save">Ahorra 10%</span>
              </div>
            </div>
            <div class="sp-p-protocol-right">
              <span class="sp-p-protocol-price sp-calc-proto-price" data-qty="2" data-discount="0.10">$ <?php echo number_format($price * 2 * 0.9, 0, ',', '.'); ?></span>
              <div class="sp-p-protocol-savings sp-calc-proto-savings" data-qty="2" data-discount="0.10">Ahorras $ <?php echo number_format($price * 2 * 0.1, 0, ',', '.'); ?></div>
            </div>
          </div>

          <!-- 3 Units (DEFAULT SELECTED) -->
          <div class="sp-p-protocol-card active" data-qty="3" data-discount="0.20">
            <div class="sp-p-protocol-left">
              <div class="sp-p-radio-dot"></div>
              <div class="sp-p-protocol-info-text">
                <span class="sp-p-protocol-name">3 Unidades — Protocolo Profesional</span>
                <span class="sp-p-protocol-badge popular">MÁS POPULAR</span>
              </div>
            </div>
            <div class="sp-p-protocol-right">
              <span class="sp-p-protocol-price sp-calc-proto-price" data-qty="3" data-discount="0.20">$ <?php echo number_format($price * 3 * 0.8, 0, ',', '.'); ?></span>
              <div class="sp-p-protocol-savings sp-calc-proto-savings" data-qty="3" data-discount="0.20">Ahorras $ <?php echo number_format($price * 3 * 0.2, 0, ',', '.'); ?></div>
            </div>
          </div>

          <!-- 4 Units -->
          <div class="sp-p-protocol-card" data-qty="4" data-discount="0.25">
            <div class="sp-p-protocol-left">
              <div class="sp-p-radio-dot"></div>
              <div class="sp-p-protocol-info-text">
                <span class="sp-p-protocol-name">4+ Unidades — Máximo Ahorro Clinical</span>
                <span class="sp-p-protocol-badge save">Ahorra 25%</span>
              </div>
            </div>
            <div class="sp-p-protocol-right">
              <span class="sp-p-protocol-price sp-calc-proto-price" data-qty="4" data-discount="0.25">$ <?php echo number_format($price * 4 * 0.75, 0, ',', '.'); ?></span>
              <div class="sp-p-protocol-savings sp-calc-proto-savings" data-qty="4" data-discount="0.25">Ahorras $ <?php echo number_format($price * 4 * 0.25, 0, ',', '.'); ?></div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Urgency Triggers Card -->
        <div class="sp-p-urgency-card">
          <div class="sp-p-urgency-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5" style="animation:pulse 1.5s infinite"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
            <span>Solo quedan <strong style="color:#dc2626;" id="spStockCounter">4 unidades</strong> disponibles de este lote certificado.</span>
          </div>
          <div class="sp-p-urgency-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            <span><strong style="color:#0f172a;" id="spViewersCounter">11 clientes</strong> están revisando este producto ahora.</span>
          </div>
          <div class="sp-p-urgency-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span><strong>Envío express hoy:</strong> Ordena en las próximas <strong style="color:#0f172a;" id="spCountdownTimer">1h 35m</strong> para despacho mañana.</span>
          </div>
        </div>

        <!-- PERFECTLY ALIGNED 3-BUTTON ACTION STACK -->
        
        <!-- RESEARCH & TECHNICAL USE DISCLAIMER BOX -->
        <div class="sp-research-disclaimer-box" style="background:#ffffff;border:1.5px solid #cbd5e1;border-radius:14px;padding:16px 20px;margin:20px 0;box-shadow:0 2px 10px rgba(15,23,42,0.02);display:flex;align-items:flex-start;gap:14px;box-sizing:border-box;width:100%;">
          <input type="checkbox" id="spResearchDisclaimerCheckProduct" class="sp-disclaimer-checkbox" style="width:20px;height:20px;accent-color:#0284c7;cursor:pointer;margin-top:2px;flex-shrink:0;" checked>
          <label for="spResearchDisclaimerCheckProduct" style="font-size:0.86rem;color:#334155;line-height:1.55;font-weight:500;cursor:pointer;user-select:none;">
            Declaro que esta solicitud corresponde a fines técnicos, investigativos, institucionales o de laboratorio, y que no busco adquirir productos para uso humano, diagnóstico, tratamiento, prescripción o automedicación.
          </label>
        </div>

        <div class="sp-p-unified-actions-stack">
          <!-- Button 1: Primary Cart -->
          <button type="button" class="sp-p-btn-action-base sp-p-btn-add-primary sp-add-to-cart" data-product-id="<?php echo $product->get_id(); ?>" id="spAddToCartMainBtn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            <span id="spBtnAddText">Añadir al Carrito — $ <?php echo number_format($price * 3 * 0.8, 0, ',', '.'); ?></span>
          </button>
          
          <!-- Button 2: Outlined Checkout -->
          <a href="<?php echo wc_get_checkout_url(); ?>" class="sp-p-btn-action-base sp-p-btn-buy-secondary" id="spBuyNowMainBtn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            COMPRAR AHORA POR WHATSAPP 📲
          </a>

          <!-- Button 3: WhatsApp Green Pill Button -->
          <a href="https://wa.me/573189163091?text=<?php echo urlencode('Hola Swiss Peptides, deseo asesoría personalizada para adquirir '.$product->get_name()); ?>" target="_blank" class="sp-p-btn-action-base sp-p-btn-whatsapp-pill">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            Asesoría Directa por WhatsApp
          </a>
        </div>

        <!-- Trust Strip -->
        <div class="sp-p-trust-strip">
          <div class="sp-p-trust-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Pago 100% Seguro
          </div>
          <div class="sp-p-trust-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            Envío Gratis Colombia
          </div>
          <div class="sp-p-trust-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Pureza Certificada
          </div>
        </div>

        <!-- Combo Card Box -->
        <?php if ($product->get_id() != 25 && $cat_name != 'Accesorios') : ?>
        <div class="sp-l-combo-card">
          <h4>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            Frecuentemente comprados juntos (Combo Recomendado)
          </h4>
          <div class="sp-l-combo-row">
            <input type="checkbox" id="spComboMainItem" checked disabled>
            <span style="flex:1;">Este producto: <strong style="color:#0f172a;"><?php echo esc_html($product->get_name()); ?></strong></span>
            <strong style="color:#0284c7;" id="spComboMainPrice">$ <?php echo number_format($price, 0, ',', '.'); ?></strong>
          </div>
          <div class="sp-l-combo-row">
            <input type="checkbox" id="spComboAddonItem" checked>
            <span style="flex:1;">Agua Bacteriostática Grado Clínico (30ml)</span>
            <strong style="color:#0284c7;">$ 35.000</strong>
          </div>
        </div>
        <?php endif; ?>

      </div>

    </div>

    <!-- ==========================================================================
         MASTER REDESIGNED BELOW-THE-FOLD SECTION (HIGH VISUAL IMPACT)
         ========================================================================== -->
    <div class="sp-master-bottom-section">
      
      <!-- SECTION 1: TECHNICAL SPECS 4-COLUMN CARDS GRID -->
      <div>
        <div class="sp-m-title-block">
          <h3>Especificaciones Técnicas del Producto</h3>
          <p>Certificación de calidad y grado de pureza farmacológica suiza</p>
        </div>

        <div class="sp-m-specs-4col-grid">
          
          <!-- Card 1: Pureza -->
          <div class="sp-m-spec-luxury-card">
            <div class="sp-m-spec-header-row">
              <div class="sp-m-spec-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 2v7.527a2 2 0 0 1-.211.896L4.72 20.55a1 1 0 0 0 .9 1.45h12.76a1 1 0 0 0 .9-1.45l-5.069-10.127A2 2 0 0 1 14 9.527V2q0-.41-.293-.707T13 1h-2q-.41 0-.707.293T10 2z"/></svg>
              </div>
              <span class="sp-m-spec-label">Pureza Certificada</span>
            </div>
            <div class="sp-m-spec-value"><?php echo esc_html($purity); ?></div>
          </div>

          <!-- Card 2: Concentración -->
          <div class="sp-m-spec-luxury-card">
            <div class="sp-m-spec-header-row">
              <div class="sp-m-spec-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              </div>
              <span class="sp-m-spec-label">Concentración</span>
            </div>
            <div class="sp-m-spec-value" id="spSpecConcentration"><?php echo esc_html($content_val); ?></div>
          </div>

          <!-- Card 3: Almacenamiento -->
          <div class="sp-m-spec-luxury-card">
            <div class="sp-m-spec-header-row">
              <div class="sp-m-spec-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 12h20M12 2v20M20 16l-4-4 4-4M4 8l4 4-4 4M16 4l-4 4-4-4M8 20l4-4 4 4"/></svg>
              </div>
              <span class="sp-m-spec-label">Almacenamiento</span>
            </div>
            <div class="sp-m-spec-value"><?php echo esc_html($storage); ?></div>
          </div>

          <!-- Card 4: Grado -->
          <div class="sp-m-spec-luxury-card">
            <div class="sp-m-spec-header-row">
              <div class="sp-m-spec-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              </div>
              <span class="sp-m-spec-label">Grado de Síntesis</span>
            </div>
            <div class="sp-m-spec-value"><?php echo esc_html($molecular); ?></div>
          </div>

        </div>
      </div>

      <!-- SECTION 2: INTERACTIVE FAQ ACCORDION -->
      <div>
        <div class="sp-m-title-block">
          <h3>Preguntas Frecuentes de Clientes</h3>
          <p>Respuestas claras a las dudas más habituales sobre tu compra y entrega</p>
        </div>

        <div class="sp-m-faq-container">
          
          <div class="sp-m-faq-card open">
            <div class="sp-m-faq-header" onclick="this.parentElement.classList.toggle('open')">
              ¿Cómo garantizan la calidad y autenticidad del producto?
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="sp-m-faq-content">
              Todos nuestros productos provienen directamente de laboratorios certificados en Suiza con análisis de pureza por HPLC y espectrometría de masas. Cada lote cuenta con su certificado de autenticidad y sello estéril.
            </div>
          </div>

          <div class="sp-m-faq-card">
            <div class="sp-m-faq-header" onclick="this.parentElement.classList.toggle('open')">
              ¿Cuánto tiempo tarda el envío dentro de Colombia?
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="sp-m-faq-content">
              Los despachos a principales ciudades como Bogotá, Medellín, Cali y Barranquilla se entregan en un lapso de 24 a 48 horas hábiles con empaque de protección térmica para preservar la calidad. El envío es totalmente gratuito.
            </div>
          </div>

          <div class="sp-m-faq-card">
            <div class="sp-m-faq-header" onclick="this.parentElement.classList.toggle('open')">
              ¿Qué métodos de pago aceptan en la tienda?
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="sp-m-faq-content">
              Aceptamos tarjetas de crédito, PSE, Nequi, Daviplata y transferencias bancarias de forma 100% segura mediante nuestra pasarela encriptada.
            </div>
          </div>

        </div>
      </div>

    </div>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var selectedQty = 3;
  var baseUnitCalculatedPrice = <?php echo $price; ?>;
  var currentMultiplier = 1.0;

  // Dosis / Size Pills Click Handler
  var sizePills = document.querySelectorAll('.sp-p-size-pill');
  sizePills.forEach(function(pill) {
    pill.addEventListener('click', function() {
      sizePills.forEach(function(p) { p.classList.remove('active'); });
      this.classList.add('active');
      
      var sizeLabel = this.getAttribute('data-size') || '10mg';
      currentMultiplier = parseFloat(this.getAttribute('data-multiplier')) || 1.0;
      baseUnitCalculatedPrice = Math.round(<?php echo $price; ?> * currentMultiplier);

      // Update Spec Concentration
      var specConc = document.getElementById('spSpecConcentration');
      if (specConc) specConc.textContent = sizeLabel + ' / presentación estéril';
      
      var sizeText = document.getElementById('spSelectedSizeText');
      if (sizeText) sizeText.textContent = sizeLabel;

      updateAllPrices();
    });
  });

  function updateAllPrices() {
    // 1. Update Main Price Row
    var mainPriceDisplay = document.getElementById('spMainPriceDisplay');
    if (mainPriceDisplay) {
      mainPriceDisplay.textContent = '$ ' + parseInt(baseUnitCalculatedPrice).toLocaleString('es-CO');
    }

    var refDisplay = document.getElementById('spRefPriceDisplay');
    if (refDisplay) {
      refDisplay.textContent = '$ ' + Math.round(baseUnitCalculatedPrice * 1.5).toLocaleString('es-CO');
    }

    var weekDisplay = document.getElementById('spWeekPriceDisplay');
    if (weekDisplay) {
      weekDisplay.textContent = '$ ' + Math.round(baseUnitCalculatedPrice / 10).toLocaleString('es-CO');
    }

    var comboMain = document.getElementById('spComboMainPrice');
    if (comboMain) {
      comboMain.textContent = '$ ' + parseInt(baseUnitCalculatedPrice).toLocaleString('es-CO');
    }

    // 2. Update Protocol Cards Prices
    var protoPrices = document.querySelectorAll('.sp-calc-proto-price');
    protoPrices.forEach(function(el) {
      var qty = parseInt(el.getAttribute('data-qty')) || 1;
      var disc = parseFloat(el.getAttribute('data-discount')) || 0;
      var p = Math.round(baseUnitCalculatedPrice * qty * (1 - disc));
      el.textContent = '$ ' + p.toLocaleString('es-CO');
    });

    var protoSavings = document.querySelectorAll('.sp-calc-proto-savings');
    protoSavings.forEach(function(el) {
      var qty = parseInt(el.getAttribute('data-qty')) || 1;
      var disc = parseFloat(el.getAttribute('data-discount')) || 0;
      var s = Math.round(baseUnitCalculatedPrice * qty * disc);
      el.textContent = 'Ahorras $ ' + s.toLocaleString('es-CO');
    });

    // 3. Update Add to Cart Button Text
    var activeCard = document.querySelector('.sp-p-protocol-card.active');
    var activeDisc = activeCard ? (parseFloat(activeCard.getAttribute('data-discount')) || 0) : 0;
    var finalTotalPrice = Math.round(baseUnitCalculatedPrice * selectedQty * (1 - activeDisc));

    var btnText = document.getElementById('spBtnAddText');
    if (btnText) {
      btnText.textContent = 'Añadir ' + selectedQty + ' Unidad' + (selectedQty > 1 ? 'es' : '') + ' al Carrito — $ ' + finalTotalPrice.toLocaleString('es-CO');
    }
  }

  // Protocol Selector Cards Click
  var protocolCards = document.querySelectorAll('.sp-p-protocol-card');
  protocolCards.forEach(function(card) {
    card.addEventListener('click', function() {
      protocolCards.forEach(function(c) { c.classList.remove('active'); });
      this.classList.add('active');
      selectedQty = parseInt(this.getAttribute('data-qty')) || 1;
      updateAllPrices();
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
          if (addBtn) addBtn.disabled = false;
          if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
            window.spUpdateCartDrawerFromAJAX();
          }
          if (typeof openCartSidebarDrawer === 'function') {
            openCartSidebarDrawer();
          } else {
            document.body.classList.add('cart-drawer-open');
          }
        })
        .catch(function(err) {
          if (addBtn) addBtn.disabled = false;
          if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
            window.spUpdateCartDrawerFromAJAX();
          }
          document.body.classList.add('cart-drawer-open');
        });
    });
  }
});
</script>

<?php endwhile; ?>

<?php get_footer(); ?>
