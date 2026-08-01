<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title><?php
    if (is_front_page()) {
        echo 'Swiss Peptides Labs | Péptidos de Investigación en Colombia (HPLC ≥99%)';
    } elseif (is_page('tienda') || (function_exists('is_shop') && is_shop())) {
        echo 'Tienda de Péptidos en Colombia | Catálogo Completo 40 Fórmulas HPLC ≥99%';
    } elseif (is_page('calculadora')) {
        echo 'Calculadora de Mezcla & Reconstitución de Péptidos | Swiss Peptides Colombia';
    } elseif (is_page('contacto')) {
        echo 'Contacto VIP & Asesoría Clínica Peptídica | Swiss Peptides Colombia';
    } elseif (is_page('nosotros')) {
        echo 'Sobre Nosotros | Swiss Peptides Labs Colombia - Laboratorio Suizo';
    } elseif (is_singular('product') || is_single()) {
        echo get_the_title() . ' | Swiss Peptides Labs Colombia';
    } else {
        wp_title('|', true, 'right'); bloginfo('name');
    }
  ?></title>

  <meta name="description" content="Proveedor exclusivo en Colombia de Swiss Peptides Labs. Venta de péptidos de alta pureza (HPLC ≥99%) para investigación médica.">
  <meta name="keywords" content="peptidos colombia, comprar semaglutide colombia, tirzepatide bogota, retatrutide medellin, bpc 157 colombia, nad+ colombia">

  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/logo/logo_swiss.png">
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/logo/logo_swiss.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?v=1785444306_<?php echo time(); ?>">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?v=1785444306_<?php echo time(); ?>">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/woo-overrides.css?v=<?php echo time(); ?>">
  
  <?php wp_head(); ?>

  <style id="master-bulletproof-2026-css">
    /* --- MASTER BULLETPROOF CORE STYLES 2026 --- */
    body {
        margin: 0 !important;
        padding: 0 !important;
        background-color: #070f1e !important;
        color: #f8fafc !important;
        font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
        -webkit-font-smoothing: antialiased !important;
    }

    .navbar {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 75px !important;
        background: rgba(7, 15, 30, 0.94) !important;
        backdrop-filter: blur(12px) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        z-index: 1000 !important;
    }
    .nav-logo img {
        height: 38px !important;
        width: auto !important;
        display: block !important;
    }
    .nav-links {
        display: flex !important;
        align-items: center !important;
        gap: 32px !important;
    }
    .nav-link {
        color: #cbd5e1 !important;
        text-decoration: none !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        transition: color 0.2s ease !important;
    }
    .nav-link:hover, .nav-link.active {
        color: #00a8ff !important;
    }

    main {
        padding-top: 75px !important;
    }

    /* FILTER BAR */
    .catalog-filter-bar {
        display: flex !important;
        justify-content: center !important;
        gap: 12px !important;
        flex-wrap: wrap !important;
        margin-bottom: 36px !important;
    }
    .cat-filter-btn {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #334155 !important;
        padding: 10px 22px !important;
        border-radius: 50px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: all 0.25s ease !important;
        outline: none !important;
        box-shadow: 0 2px 8px rgba(7, 15, 30, 0.04) !important;
    }
    .cat-filter-btn:hover {
        border-color: #00a8ff !important;
        color: #00a8ff !important;
        transform: translateY(-1px) !important;
    }
    .cat-filter-btn.active {
        background: #070f1e !important;
        border-color: #070f1e !important;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(7, 15, 30, 0.2) !important;
    }

    /* GRID LAYOUT */
    #mainCatalogGrid {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 28px !important;
        max-width: 1280px !important;
        margin: 0 auto !important;
    }
    @media (max-width: 1024px) {
        #mainCatalogGrid { grid-template-columns: repeat(2, 1fr) !important; }
    }
    @media (max-width: 640px) {
        #mainCatalogGrid { grid-template-columns: 1fr !important; }
    }

    /* CARDS */
    .prod-card-luxury {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 18px !important;
        overflow: hidden !important;
        display: flex !important;
        flex-direction: column !important;
        position: relative !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        box-shadow: 0 10px 30px rgba(7, 15, 30, 0.05) !important;
    }
    .prod-card-luxury:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 20px 45px rgba(7, 15, 30, 0.12) !important;
        border-color: #00a8ff !important;
    }

    .card-category-badge {
        position: absolute !important;
        top: 14px !important;
        left: 14px !important;
        background: #070f1e !important;
        color: #00a8ff !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        padding: 6px 14px !important;
        border-radius: 50px !important;
        z-index: 5 !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        box-shadow: 0 4px 12px rgba(7, 15, 30, 0.2) !important;
    }

    .card-image-wrapper {
        position: relative !important;
        width: 100% !important;
        height: 250px !important;
        background: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 16px !important;
        overflow: hidden !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .card-prod-img {
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
        filter: drop-shadow(0 8px 18px rgba(7, 15, 30, 0.08)) !important;
        transition: transform 0.35s ease !important;
    }
    .prod-card-luxury:hover .card-prod-img {
        transform: scale(1.05) !important;
    }

    .card-body-content {
        padding: 20px 22px 24px 22px !important;
        display: flex !important;
        flex-direction: column !important;
        flex: 1 !important;
    }
    .card-prod-title {
        font-size: 20px !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin: 0 0 8px 0 !important;
        line-height: 1.25 !important;
    }
    .card-prod-desc {
        font-size: 13.5px !important;
        color: #64748b !important;
        line-height: 1.55 !important;
        margin: 0 0 16px 0 !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
    }

    /* BENEFIT ITEMS */
    .card-benefits-list {
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
        margin-bottom: 16px !important;
        background: #f8fafc !important;
        padding: 12px 14px !important;
        border-radius: 12px !important;
        border: 1px solid #f1f5f9 !important;
    }
    .benefit-item-row {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
    }
    .benefit-item-row span {
        color: #1e293b !important;
    }

    /* OPTIONS & PILLS - FORCED VISIBLE DARK SLATE TEXT & STYLED PILLS */
    .card-options-row {
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
        margin-bottom: 14px !important;
    }
    .opt-label, .card-options-row .opt-label {
        font-size: 11px !important;
        font-weight: 800 !important;
        color: #475569 !important; /* DARK SLATE COLOR SO IT IS 100% VISIBLE */
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin: 0 0 4px 0 !important;
        display: block !important;
    }
    .opt-pills-group {
        display: flex !important;
        gap: 6px !important;
        flex-wrap: wrap !important;
    }
    .opt-pill, button.opt-pill, span.opt-pill {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #0f172a !important; /* DARK SLATE TEXT */
        padding: 6px 12px !important;
        border-radius: 8px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        display: inline-block !important;
        outline: none !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
    }
    .opt-pill:hover, button.opt-pill:hover {
        border-color: #00a8ff !important;
        color: #00a8ff !important;
    }
    .opt-pill.active, button.opt-pill.active, span.opt-pill.active {
        background: #070f1e !important;
        border-color: #070f1e !important;
        color: #ffffff !important;
    }

    /* FOOTER ACTION & BUTTONS */
    .card-footer-action {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-top: auto !important;
        padding-top: 16px !important;
        border-top: 1px solid #f1f5f9 !important;
    }
    .card-price-container {
        display: flex !important;
        flex-direction: column !important;
        gap: 2px !important;
    }
    .card-reg-price {
        font-size: 13px !important;
        color: #94a3b8 !important;
        text-decoration: line-through !important;
        font-weight: 600 !important;
    }
    .card-main-price {
        font-size: 24px !important;
        font-weight: 900 !important;
        color: #0f172a !important;
        letter-spacing: -0.02em !important;
    }

    .card-btn-group {
        display: flex !important;
        gap: 8px !important;
    }
    .btn-add-cart {
        background: #070f1e !important;
        color: #ffffff !important;
        border: none !important;
        padding: 10px 16px !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
    }
    .btn-ws-order {
        background: #25d366 !important;
        color: #ffffff !important;
        border: none !important;
        padding: 10px 14px !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        display: inline-flex !important;
        align-items: center !important;
        text-decoration: none !important;
    }

    .savings-banner {
        background: rgba(0, 168, 255, 0.08) !important;
        border: 1px dashed #00a8ff !important;
        color: #00a8ff !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        padding: 8px 12px !important;
        border-radius: 8px !important;
        margin-bottom: 14px !important;
        text-align: center !important;
    }
    .savings-banner:empty {
        display: none !important;
    }

    /* FLOATING CART WIDGET */
    .floating-cart-widget {
        position: fixed !important;
        bottom: 24px !important;
        right: 24px !important;
        background: #070f1e !important;
        color: #ffffff !important;
        border: 1px solid #00a8ff !important;
        padding: 12px 22px !important;
        border-radius: 50px !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        box-shadow: 0 8px 25px rgba(0, 168, 255, 0.35) !important;
        z-index: 9999 !important;
        text-decoration: none !important;
        transition: all 0.25s ease !important;
    }
    .floating-cart-widget:hover {
        transform: translateY(-3px) scale(1.03) !important;
        box-shadow: 0 12px 30px rgba(0, 168, 255, 0.5) !important;
        background: #00a8ff !important;
        color: #ffffff !important;
    }

    /* CART SIDEBAR SLIDE DRAWER */
    .cart-sidebar {
        position: fixed !important;
        top: 0 !important;
        right: -420px !important;
        width: 380px !important;
        max-width: 90vw !important;
        height: 100vh !important;
        background: #ffffff !important;
        color: #0f172a !important;
        z-index: 99999 !important;
        box-shadow: -10px 0 35px rgba(7, 15, 30, 0.3) !important;
        transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        display: flex !important;
        flex-direction: column !important;
    }
    .cart-sidebar.open {
        right: 0 !important;
    }
    .overlay {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(7, 15, 30, 0.65) !important;
        backdrop-filter: blur(6px) !important;
        z-index: 99998 !important;
        opacity: 0 !important;
        pointer-events: none !important;
        transition: opacity 0.3s ease !important;
    }
    .overlay.active {
        opacity: 1 !important;
        pointer-events: auto !important;
    }
  </style>


  <style id="master-perfect-cards-2026-v2">
    /* --- 1. CATEGORY FILTER BAR BUTTONS --- */
    .catalog-filter-bar {
        display: flex !important;
        justify-content: center !important;
        gap: 12px !important;
        flex-wrap: wrap !important;
        margin-bottom: 36px !important;
    }
    .cat-filter-btn {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #334155 !important;
        padding: 10px 22px !important;
        border-radius: 50px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: all 0.25s ease !important;
        outline: none !important;
        box-shadow: 0 2px 8px rgba(7, 15, 30, 0.04) !important;
    }
    .cat-filter-btn:hover {
        border-color: #00a8ff !important;
        color: #00a8ff !important;
        transform: translateY(-1px) !important;
    }
    .cat-filter-btn.active {
        background: #070f1e !important;
        border-color: #070f1e !important;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(7, 15, 30, 0.2) !important;
    }

    /* --- 2. GRID LAYOUT --- */
    #mainCatalogGrid {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 28px !important;
        max-width: 1280px !important;
        margin: 0 auto !important;
    }
    @media (max-width: 1024px) {
        #mainCatalogGrid { grid-template-columns: repeat(2, 1fr) !important; }
    }
    @media (max-width: 640px) {
        #mainCatalogGrid { grid-template-columns: 1fr !important; }
    }

    /* --- 3. LUXURY PRODUCT CARDS --- */
    .prod-card-luxury {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 18px !important;
        overflow: hidden !important;
        display: flex !important;
        flex-direction: column !important;
        position: relative !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        box-shadow: 0 10px 30px rgba(7, 15, 30, 0.05) !important;
    }
    .prod-card-luxury:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 20px 45px rgba(7, 15, 30, 0.12) !important;
        border-color: #00a8ff !important;
    }

    /* TOP LEFT CATEGORY BADGE */
    .card-category-badge {
        position: absolute !important;
        top: 14px !important;
        left: 14px !important;
        background: #070f1e !important;
        color: #00a8ff !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        padding: 6px 14px !important;
        border-radius: 50px !important;
        z-index: 5 !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        box-shadow: 0 4px 12px rgba(7, 15, 30, 0.2) !important;
    }

    .card-image-wrapper {
        position: relative !important;
        width: 100% !important;
        height: 250px !important;
        background: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 16px !important;
        overflow: hidden !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .card-prod-img {
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
        filter: drop-shadow(0 8px 18px rgba(7, 15, 30, 0.08)) !important;
        transition: transform 0.35s ease !important;
    }
    .prod-card-luxury:hover .card-prod-img {
        transform: scale(1.05) !important;
    }

    .card-body-content {
        padding: 20px 22px 24px 22px !important;
        display: flex !important;
        flex-direction: column !important;
        flex: 1 !important;
    }
    .card-prod-title {
        font-size: 20px !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin: 0 0 8px 0 !important;
        line-height: 1.25 !important;
    }
    .card-prod-desc {
        font-size: 13.5px !important;
        color: #64748b !important;
        line-height: 1.55 !important;
        margin: 0 0 16px 0 !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
    }

    /* BENEFIT ITEMS */
    .card-benefits-list {
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
        margin-bottom: 16px !important;
        background: #f8fafc !important;
        padding: 12px 14px !important;
        border-radius: 12px !important;
        border: 1px solid #f1f5f9 !important;
    }
    .benefit-item-row {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
    }
    .benefit-item-row span {
        color: #1e293b !important;
    }

    /* OPTIONS & PILLS - FORCED VISIBLE DARK SLATE TEXT & STYLED PILLS */
    .card-options-row {
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
        margin-bottom: 14px !important;
    }
    .opt-label, .card-options-row .opt-label {
        font-size: 11px !important;
        font-weight: 800 !important;
        color: #475569 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin: 0 0 4px 0 !important;
        display: block !important;
    }
    .opt-pills-group {
        display: flex !important;
        gap: 6px !important;
        flex-wrap: wrap !important;
    }
    .opt-pill, button.opt-pill, span.opt-pill {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #0f172a !important;
        padding: 6px 12px !important;
        border-radius: 8px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        display: inline-block !important;
        outline: none !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
    }
    .opt-pill:hover, button.opt-pill:hover {
        border-color: #00a8ff !important;
        color: #00a8ff !important;
    }
    .opt-pill.active, button.opt-pill.active, span.opt-pill.active {
        background: #070f1e !important;
        border-color: #070f1e !important;
        color: #ffffff !important;
    }

    /* FOOTER ACTION & BUTTONS */
    .card-footer-action {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-top: auto !important;
        padding-top: 16px !important;
        border-top: 1px solid #f1f5f9 !important;
    }
    .card-price-container {
        display: flex !important;
        flex-direction: column !important;
        gap: 2px !important;
    }
    .card-reg-price {
        font-size: 13px !important;
        color: #94a3b8 !important;
        text-decoration: line-through !important;
        font-weight: 600 !important;
    }
    .card-main-price {
        font-size: 24px !important;
        font-weight: 900 !important;
        color: #0f172a !important;
        letter-spacing: -0.02em !important;
    }

    .card-btn-group {
        display: flex !important;
        gap: 8px !important;
    }
    .btn-add-cart {
        background: #070f1e !important;
        color: #ffffff !important;
        border: none !important;
        padding: 10px 16px !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
    }
    .btn-ws-order {
        background: #25d366 !important;
        color: #ffffff !important;
        border: none !important;
        padding: 10px 14px !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        display: inline-flex !important;
        align-items: center !important;
        text-decoration: none !important;
    }

    .savings-banner {
        background: rgba(0, 168, 255, 0.08) !important;
        border: 1px dashed #00a8ff !important;
        color: #00a8ff !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        padding: 8px 12px !important;
        border-radius: 8px !important;
        margin-bottom: 14px !important;
        text-align: center !important;
    }
    .savings-banner:empty {
        display: none !important;
    }

    /* FLOATING CART WIDGET */
    .floating-cart-widget {
        position: fixed !important;
        bottom: 24px !important;
        right: 24px !important;
        background: #070f1e !important;
        color: #ffffff !important;
        border: 1px solid #00a8ff !important;
        padding: 12px 22px !important;
        border-radius: 50px !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        box-shadow: 0 8px 25px rgba(0, 168, 255, 0.35) !important;
        z-index: 9999 !important;
        text-decoration: none !important;
        transition: all 0.25s ease !important;
    }
    .floating-cart-widget:hover {
        transform: translateY(-3px) scale(1.03) !important;
        box-shadow: 0 12px 30px rgba(0, 168, 255, 0.5) !important;
        background: #00a8ff !important;
        color: #ffffff !important;
    }

    /* CART SIDEBAR SLIDE DRAWER */
    .cart-sidebar {
        position: fixed !important;
        top: 0 !important;
        right: -420px !important;
        width: 380px !important;
        max-width: 90vw !important;
        height: 100vh !important;
        background: #ffffff !important;
        color: #0f172a !important;
        z-index: 99999 !important;
        box-shadow: -10px 0 35px rgba(7, 15, 30, 0.3) !important;
        transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        display: flex !important;
        flex-direction: column !important;
    }
    .cart-sidebar.open {
        right: 0 !important;
    }
    .overlay {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(7, 15, 30, 0.65) !important;
        backdrop-filter: blur(6px) !important;
        z-index: 99998 !important;
        opacity: 0 !important;
        pointer-events: none !important;
        transition: opacity 0.3s ease !important;
    }
    .overlay.active {
        opacity: 1 !important;
        pointer-events: auto !important;
    }
  </style>


  <style id="master-fixes-2026-v3">
    /* 1. SHRINK NAVBAR LOGO TO SLEEK PROPORTIONS */
    .nav-logo img {
        height: 28px !important;
        max-height: 28px !important;
        width: auto !important;
        display: block !important;
    }

    /* 2. REMOVE STRAY BOTTOM-LEFT WHATSAPP ICON */
    .whatsapp-sticky, a[href*="wa.me"].whatsapp-sticky, .whatsapp-float {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
    }

    /* 3. PERFECT FLOATING CART HOVER CONTRAST */
    .floating-cart-widget {
        position: fixed !important;
        bottom: 24px !important;
        right: 24px !important;
        background: #070f1e !important;
        color: #ffffff !important;
        border: 1px solid #00a8ff !important;
        padding: 10px 20px !important;
        border-radius: 50px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        box-shadow: 0 8px 25px rgba(0, 168, 255, 0.35) !important;
        z-index: 9999 !important;
        text-decoration: none !important;
        transition: all 0.25s ease !important;
    }
    
    .floating-cart-widget span, #floatingCartSubtotal {
        color: #00a8ff !important;
        transition: color 0.25s ease !important;
    }

    .floating-cart-widget:hover {
        transform: translateY(-3px) scale(1.03) !important;
        box-shadow: 0 12px 30px rgba(0, 168, 255, 0.55) !important;
        background: #00a8ff !important;
        color: #070f1e !important;
    }

    .floating-cart-widget:hover span, 
    .floating-cart-widget:hover #floatingCartSubtotal,
    .floating-cart-widget:hover .floating-cart-count {
        color: #070f1e !important;
        font-weight: 900 !important;
    }
    
    .floating-cart-widget:hover svg {
        stroke: #070f1e !important;
    }
  </style>


  <style id="master-mobile-responsive-2026">
    /* SLEEK DESKTOP LOGO SIZE */
    .nav-logo img {
        height: 24px !important;
        max-height: 24px !important;
        width: auto !important;
        display: block !important;
    }

    /* RESPONSIVE MOBILE NAVBAR (PREVENTS LOGO & MENU OVERLAP) */
    @media (max-width: 768px) {
        .navbar {
            height: 65px !important;
        }
        .navbar .container {
            padding: 0 12px !important;
            gap: 8px !important;
        }
        .nav-logo img {
            height: 18px !important;
            max-height: 18px !important;
            width: auto !important;
        }
        .nav-links {
            gap: 10px !important;
            overflow-x: auto !important;
            white-space: nowrap !important;
            -webkit-overflow-scrolling: touch !important;
            padding-bottom: 2px !important;
        }
        .nav-links::-webkit-scrollbar {
            display: none !important;
        }
        .nav-link {
            font-size: 11.5px !important;
            padding: 4px 6px !important;
        }
        main {
            padding-top: 65px !important;
        }
    }

    /* PERMANENTLY HIDE ANY STRAY BOTTOM-LEFT WHATSAPP FLOATING ICON */
    a[href*="wa.me"]:not(.btn-ws-order):not(.btn-exact-cyan),
    a[href*="whatsapp"]:not(.btn-ws-order):not(.btn-exact-cyan),
    .whatsapp-sticky,
    .whatsapp-float,
    img[src*="whatsapp"] {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
    }

    /* RE-ENABLE THE VIP BUTTON INSIDE FOOTER AND CARDS */
    .footer-col a[href*="wa.me"],
    .card-btn-group a[href*="wa.me"],
    .btn-ws-order,
    a.btn-ws-order {
        display: inline-flex !important;
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
    }
  </style>


  


  <style id="master-cart-sidebar-global-2026">
    /* ─── CART SIDEBAR OVERLAY ─── */
    .cart-sidebar-overlay {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        background: rgba(7, 15, 30, 0.55) !important;
        backdrop-filter: blur(4px) !important;
        z-index: 99998 !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transition: all 0.3s ease !important;
    }
    .cart-sidebar-overlay.active {
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* ─── CART SIDEBAR PANEL ─── */
    .cart-sidebar {
        position: fixed !important;
        top: 0 !important;
        right: -420px !important;
        width: 400px !important;
        max-width: 92vw !important;
        height: 100vh !important;
        background: #ffffff !important;
        z-index: 99999 !important;
        display: flex !important;
        flex-direction: column !important;
        box-shadow: -8px 0 40px rgba(7, 15, 30, 0.2) !important;
        transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .cart-sidebar.active {
        right: 0 !important;
    }

    /* ─── CART HEADER ─── */
    .cart-sidebar-header {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 20px 24px !important;
        border-bottom: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        flex-shrink: 0 !important;
    }
    .cart-sidebar-header h3 {
        font-size: 18px !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin: 0 !important;
    }
    .cart-sidebar-close {
        background: none !important;
        border: none !important;
        font-size: 24px !important;
        color: #64748b !important;
        cursor: pointer !important;
        padding: 4px !important;
        line-height: 1 !important;
        transition: color 0.2s !important;
    }
    .cart-sidebar-close:hover {
        color: #0f172a !important;
    }

    /* ─── CART ITEMS AREA ─── */
    .cart-sidebar-items {
        flex: 1 !important;
        overflow-y: auto !important;
        padding: 16px 24px !important;
    }
    .cart-sidebar-items::-webkit-scrollbar {
        width: 4px !important;
    }
    .cart-sidebar-items::-webkit-scrollbar-thumb {
        background: #cbd5e1 !important;
        border-radius: 4px !important;
    }

    /* ─── EMPTY CART MESSAGE ─── */
    .cart-empty-msg {
        text-align: center !important;
        color: #94a3b8 !important;
        font-size: 14px !important;
        padding: 60px 20px !important;
    }

    /* ─── CART ITEM ROW ─── */
    .cart-item-row {
        display: flex !important;
        gap: 14px !important;
        padding: 16px 0 !important;
        border-bottom: 1px solid #f1f5f9 !important;
        align-items: center !important;
    }
    .cart-item-row:last-child {
        border-bottom: none !important;
    }
    .cart-item-img {
        width: 64px !important;
        height: 64px !important;
        border-radius: 10px !important;
        object-fit: contain !important;
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        flex-shrink: 0 !important;
    }
    .cart-item-info {
        flex: 1 !important;
        min-width: 0 !important;
    }
    .cart-item-name {
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        margin: 0 0 4px 0 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }
    .cart-item-meta {
        font-size: 12px !important;
        color: #64748b !important;
    }
    .cart-item-price {
        font-size: 15px !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        white-space: nowrap !important;
    }
    .cart-item-remove {
        background: none !important;
        border: none !important;
        color: #94a3b8 !important;
        cursor: pointer !important;
        font-size: 18px !important;
        padding: 4px !important;
        transition: color 0.2s !important;
    }
    .cart-item-remove:hover {
        color: #ef4444 !important;
    }

    /* ─── CART FOOTER ─── */
    .cart-sidebar-footer {
        border-top: 1px solid #e2e8f0 !important;
        padding: 20px 24px !important;
        background: #ffffff !important;
        flex-shrink: 0 !important;
    }
    .cart-subtotal-row {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        margin-bottom: 16px !important;
    }
    .cart-subtotal-label {
        font-size: 14px !important;
        color: #64748b !important;
        font-weight: 500 !important;
    }
    .cart-subtotal-value {
        font-size: 22px !important;
        font-weight: 900 !important;
        color: #0f172a !important;
    }

    /* ─── CART ACTION BUTTONS ─── */
    .cart-btn-checkout {
        display: block !important;
        width: 100% !important;
        padding: 14px 24px !important;
        background: #070f1e !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 10px !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        text-align: center !important;
        cursor: pointer !important;
        text-decoration: none !important;
        transition: all 0.25s ease !important;
        margin-bottom: 10px !important;
        letter-spacing: 0.02em !important;
    }
    .cart-btn-checkout:hover {
        background: #00a8ff !important;
        color: #ffffff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 20px rgba(0, 168, 255, 0.3) !important;
    }
    .cart-btn-view {
        display: block !important;
        width: 100% !important;
        padding: 12px 24px !important;
        background: transparent !important;
        color: #00a8ff !important;
        border: 1px solid #00a8ff !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        text-align: center !important;
        cursor: pointer !important;
        text-decoration: none !important;
        transition: all 0.25s ease !important;
    }
    .cart-btn-view:hover {
        background: rgba(0, 168, 255, 0.08) !important;
        transform: translateY(-1px) !important;
    }

    /* ─── FLOATING CART WIDGET (bottom-right) ─── */
    .floating-cart-widget {
        position: fixed !important;
        bottom: 24px !important;
        right: 24px !important;
        background: #070f1e !important;
        color: #ffffff !important;
        border: 1px solid rgba(0, 168, 255, 0.3) !important;
        border-radius: 14px !important;
        padding: 12px 20px !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        cursor: pointer !important;
        z-index: 9999 !important;
        box-shadow: 0 8px 30px rgba(7, 15, 30, 0.35) !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        font-family: 'Inter', system-ui, sans-serif !important;
    }
    .floating-cart-widget:hover {
        background: #00a8ff !important;
        border-color: #00a8ff !important;
        transform: translateY(-3px) scale(1.03) !important;
        box-shadow: 0 12px 35px rgba(0, 168, 255, 0.35) !important;
    }
    .floating-cart-widget:hover span,
    .floating-cart-widget:hover #floatingCartSubtotal,
    .floating-cart-widget:hover .floating-cart-count {
        color: #070f1e !important;
    }
    .floating-cart-widget:hover svg {
        stroke: #070f1e !important;
    }
    .floating-cart-count {
        background: #00a8ff !important;
        color: #ffffff !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        min-width: 20px !important;
        height: 20px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: absolute !important;
        top: -6px !important;
        right: -6px !important;
    }
    .floating-cart-widget:hover .floating-cart-count {
        background: #070f1e !important;
        color: #00a8ff !important;
    }
  </style>


  <style id="definitive-catalog-cards-2026">
    /* ═══════════════════════════════════════════════════════════════
       DEFINITIVE PRODUCT CARD STYLES — Matches interactive-catalog.js
       ═══════════════════════════════════════════════════════════════ */

    /* --- GRID --- */
    #mainCatalogGrid {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 28px !important;
        max-width: 1280px !important;
        margin: 0 auto !important;
    }
    @media (max-width: 1024px) { #mainCatalogGrid { grid-template-columns: repeat(2, 1fr) !important; } }
    @media (max-width: 640px) { #mainCatalogGrid { grid-template-columns: 1fr !important; } }

    /* --- CARD SHELL --- */
    .prod-card-luxury {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 18px !important;
        overflow: hidden !important;
        display: flex !important;
        flex-direction: column !important;
        position: relative !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        box-shadow: 0 4px 20px rgba(7, 15, 30, 0.06) !important;
    }
    .prod-card-luxury:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 20px 50px rgba(7, 15, 30, 0.14) !important;
        border-color: #00a8ff !important;
    }

    /* --- TOP BAR (Category + Purity badges) --- */
    .card-top-bar {
        position: absolute !important;
        top: 14px !important;
        left: 14px !important;
        right: 14px !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        z-index: 5 !important;
    }
    .card-cat-badge {
        background: #070f1e !important;
        color: #00a8ff !important;
        font-size: 10px !important;
        font-weight: 800 !important;
        padding: 5px 12px !important;
        border-radius: 50px !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        box-shadow: 0 4px 12px rgba(7, 15, 30, 0.25) !important;
    }
    .card-purity-badge {
        background: rgba(16, 185, 129, 0.15) !important;
        color: #059669 !important;
        font-size: 10px !important;
        font-weight: 800 !important;
        padding: 5px 10px !important;
        border-radius: 50px !important;
        letter-spacing: 0.3px !important;
    }

    /* --- IMAGE --- */
    .card-image-wrapper {
        position: relative !important;
        width: 100% !important;
        height: 260px !important;
        background: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 20px !important;
        overflow: hidden !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .card-prod-img {
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
        filter: drop-shadow(0 8px 18px rgba(7, 15, 30, 0.08)) !important;
        transition: transform 0.35s ease !important;
    }
    .prod-card-luxury:hover .card-prod-img {
        transform: scale(1.06) !important;
    }

    /* --- DETAILS BOX --- */
    .card-details-box {
        padding: 20px 22px 24px !important;
        display: flex !important;
        flex-direction: column !important;
        flex: 1 !important;
    }
    .card-prod-title {
        font-size: 20px !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin: 0 0 10px 0 !important;
        line-height: 1.25 !important;
    }
    .card-prod-title a {
        color: #0f172a !important;
        text-decoration: none !important;
    }

    /* --- BENEFITS --- */
    .card-benefits-list {
        display: flex !important;
        flex-direction: column !important;
        gap: 7px !important;
        margin-bottom: 16px !important;
        background: #f8fafc !important;
        padding: 12px 14px !important;
        border-radius: 12px !important;
        border: 1px solid #f1f5f9 !important;
    }
    .benefit-item-row {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
    }

    /* --- SELECTOR SECTIONS (Concentration & Quantity) --- */
    .selector-section {
        margin-bottom: 12px !important;
    }
    .selector-label {
        font-size: 11px !important;
        font-weight: 800 !important;
        color: #475569 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin-bottom: 6px !important;
        display: block !important;
    }
    .selector-pills-flex {
        display: flex !important;
        gap: 6px !important;
        flex-wrap: wrap !important;
    }

    /* --- PILLS (size-pill & qty-pill) --- */
    .size-pill, .qty-pill {
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        color: #0f172a !important;
        padding: 7px 14px !important;
        border-radius: 8px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        outline: none !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
        font-family: 'Inter', sans-serif !important;
    }
    .size-pill:hover, .qty-pill:hover {
        border-color: #00a8ff !important;
        color: #00a8ff !important;
        transform: translateY(-1px) !important;
    }
    .size-pill.active, .qty-pill.active {
        background: #070f1e !important;
        border-color: #070f1e !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(7, 15, 30, 0.2) !important;
    }

    /* --- SAVINGS BANNER --- */
    .savings-banner {
        background: rgba(16, 185, 129, 0.08) !important;
        border: 1px solid rgba(16, 185, 129, 0.2) !important;
        color: #059669 !important;
        padding: 8px 14px !important;
        border-radius: 8px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        margin-bottom: 14px !important;
        text-align: center !important;
    }

    /* --- FOOTER ACTION --- */
    .card-footer-action {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-top: auto !important;
        padding-top: 16px !important;
        border-top: 1px solid #f1f5f9 !important;
    }
    .card-price-container {
        display: flex !important;
        flex-direction: column !important;
        gap: 2px !important;
    }
    .card-reg-price {
        font-size: 13px !important;
        color: #94a3b8 !important;
        text-decoration: line-through !important;
        font-weight: 600 !important;
    }
    .card-main-price {
        font-size: 24px !important;
        font-weight: 900 !important;
        color: #0f172a !important;
        letter-spacing: -0.02em !important;
    }
    .card-btn-group {
        display: flex !important;
        gap: 8px !important;
    }
    .btn-add-cart {
        background: #070f1e !important;
        color: #ffffff !important;
        border: none !important;
        padding: 10px 16px !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        transition: all 0.2s ease !important;
        font-family: 'Inter', sans-serif !important;
    }
    .btn-add-cart:hover {
        background: #00a8ff !important;
        transform: translateY(-1px) !important;
    }
    .btn-ws-order {
        background: #25d366 !important;
        color: #ffffff !important;
        border: none !important;
        padding: 10px 14px !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        display: inline-flex !important;
        align-items: center !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
    }
    .btn-ws-order:hover {
        background: #1da851 !important;
        transform: translateY(-1px) !important;
    }

    /* ═══ FLOATING CART BADGE — ALWAYS VISIBLE ═══ */
    .floating-cart-count {
        background: #00a8ff !important;
        color: #ffffff !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        min-width: 22px !important;
        height: 22px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: absolute !important;
        top: -8px !important;
        right: -8px !important;
        border: 2px solid #070f1e !important;
        z-index: 10 !important;
    }
    .floating-cart-widget:hover .floating-cart-count {
        background: #070f1e !important;
        color: #00a8ff !important;
        border-color: #00a8ff !important;
    }

    /* ═══ FILTER BUTTONS ═══ */
    .catalog-filter-bar {
        display: flex !important;
        justify-content: center !important;
        gap: 12px !important;
        flex-wrap: wrap !important;
        margin-bottom: 36px !important;
    }
    .cat-filter-btn {
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        color: #334155 !important;
        padding: 10px 22px !important;
        border-radius: 50px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: all 0.25s ease !important;
        outline: none !important;
        font-family: 'Inter', sans-serif !important;
    }
    .cat-filter-btn:hover {
        border-color: #00a8ff !important;
        color: #00a8ff !important;
    }
    .cat-filter-btn.active {
        background: #070f1e !important;
        border-color: #070f1e !important;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(7, 15, 30, 0.2) !important;
    }
  </style>


  <style id="master-perfect-corrections-2026">
    /* 1. FLOATING CART BADGE — CONTRAST FIX (FORCE DARK NAVY TEXT ON CYAN CIRCLE) */
    .floating-cart-widget .floating-cart-count,
    .floating-cart-count,
    #floatingCartCount {
        background: #00a8ff !important;
        color: #070f1e !important;
        font-weight: 900 !important;
        font-size: 11.5px !important;
        width: 22px !important;
        height: 22px !important;
        min-width: 22px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: absolute !important;
        top: -7px !important;
        right: -7px !important;
        border: 2px solid #070f1e !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3) !important;
        z-index: 99 !important;
    }
    .floating-cart-widget:hover .floating-cart-count {
        background: #070f1e !important;
        color: #00a8ff !important;
        border-color: #00a8ff !important;
    }

    /* 2. REMOVE 'INICIO' FROM MOBILE HEADER */
    @media (max-width: 768px) {
        .nav-links a[href="<?php echo home_url(); ?>"],
        .nav-links a[href="<?php echo home_url('/'); ?>"],
        .nav-links a[href="/"],
        .nav-links a.nav-link-inicio {
            display: none !important;
        }
        .navbar .container {
            padding: 0 10px !important;
        }
        .nav-logo img {
            height: 20px !important;
            max-height: 20px !important;
        }
    }

    /* 3. MOBILE HERO SECTION OPTIMIZATIONS */
    @media (max-width: 768px) {
        section.hero, .hero-section, .hero {
            padding: 90px 16px 30px 16px !important;
            text-align: center !important;
        }
        .hero h1, .hero-title, h1.hero-title {
            font-size: 26px !important;
            line-height: 1.2 !important;
            margin-bottom: 10px !important;
        }
        .hero p, .hero-subtitle, p.hero-subtitle {
            font-size: 13px !important;
            line-height: 1.5 !important;
            margin-bottom: 16px !important;
        }
        .hero-badges, .hero-checklist {
            gap: 6px !important;
            margin-bottom: 20px !important;
            font-size: 12px !important;
        }
        .hero-cta-group, .hero-buttons {
            flex-direction: column !important;
            gap: 10px !important;
            width: 100% !important;
        }
        .hero-cta-group a, .hero-buttons a, .btn-hero {
            width: 100% !important;
            padding: 12px 18px !important;
            font-size: 13.5px !important;
            justify-content: center !important;
            box-sizing: border-box !important;
        }
    }

    /* 4. MOBILE CARD PRICE & BUTTON LAYOUT OPTIMIZATIONS (PREVENTS PRICE WRAPPING) */
    @media (max-width: 768px) {
        .card-footer-action {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 12px !important;
        }
        .card-price-container {
            flex-direction: row !important;
            align-items: baseline !important;
            justify-content: space-between !important;
            width: 100% !important;
        }
        .card-main-price {
            font-size: 20px !important;
            white-space: nowrap !important;
            font-weight: 900 !important;
        }
        .card-reg-price {
            font-size: 12.5px !important;
            white-space: nowrap !important;
        }
        .card-btn-group {
            width: 100% !important;
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 8px !important;
        }
        .btn-add-cart, .btn-ws-order {
            width: 100% !important;
            justify-content: center !important;
            padding: 10px 6px !important;
            font-size: 12px !important;
            text-align: center !important;
            box-sizing: border-box !important;
        }
    }
  </style>


  <style id="master-mobile-hamburger-2026">
    /* MOBILE HEADER: SHOW ONLY TIENDA & HAMBURGER BUTTON */
    @media (max-width: 768px) {
        .nav-links a:not(.nav-link-tienda):not([href*="tienda"]) {
            display: none !important;
        }
        .nav-links a.nav-link-tienda,
        .nav-links a[href*="tienda"] {
            display: inline-block !important;
            font-weight: 800 !important;
            color: #00a8ff !important;
            font-size: 13px !important;
        }
        .mobile-hamburger-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: transparent !important;
            border: none !important;
            color: #ffffff !important;
            font-size: 22px !important;
            cursor: pointer !important;
            padding: 4px !important;
        }

        /* SHIFT HERO SECTION UP AND CENTER VERTICALLY */
        section.hero, .hero-section, .hero {
            padding-top: 50px !important;
            padding-bottom: 25px !important;
            margin-top: 0 !important;
            text-align: center !important;
        }
        .hero-top-badge {
            display: inline-flex !important;
            flex-direction: column !important;
            align-items: center !important;
            gap: 2px !important;
            padding: 8px 18px !important;
            line-height: 1.3 !important;
            font-size: 11px !important;
        }
        .hero h1, .hero-title {
            font-size: 25px !important;
            line-height: 1.2 !important;
            margin-top: 10px !important;
            margin-bottom: 8px !important;
        }
        .hero p, .hero-subtitle {
            font-size: 12.5px !important;
            line-height: 1.45 !important;
            margin-bottom: 14px !important;
        }
        .hero-badges-list {
            gap: 4px !important;
            margin-bottom: 16px !important;
        }
    }
  </style>


  <style id="master-hamburger-strict-2026">
    /* DESKTOP (> 768px): HIDE HAMBURGER BUTTON COMPLETELY */
    @media (min-width: 769px) {
        .mobile-hamburger-btn,
        #mobileHamburgerBtn {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
        .nav-links {
            display: flex !important;
            align-items: center !important;
            gap: 32px !important;
        }
        .nav-links a {
            display: inline-block !important;
        }
    }

    /* MOBILE (<= 768px): SHOW ONLY TIENDA + HAMBURGER BUTTON */
    @media (max-width: 768px) {
        .nav-links a:not([href*="tienda"]) {
            display: none !important;
        }
        .nav-links a[href*="tienda"] {
            display: inline-block !important;
            font-weight: 800 !important;
            color: #00a8ff !important;
            font-size: 13.5px !important;
        }
        .mobile-hamburger-btn,
        #mobileHamburgerBtn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: transparent !important;
            border: none !important;
            color: #ffffff !important;
            cursor: pointer !important;
            padding: 6px !important;
            margin-left: 8px !important;
        }
    }

    /* LUXURIOUS MOBILE SLIDE DRAWER */
    #mobileMenuDrawer {
        position: fixed !important;
        top: 0 !important;
        right: -320px !important;
        width: 300px !important;
        max-width: 85vw !important;
        height: 100vh !important;
        background: #070f1e !important;
        border-left: 1px solid rgba(255, 255, 255, 0.1) !important;
        z-index: 999999 !important;
        transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        padding: 28px 24px !important;
        display: flex !important;
        flex-direction: column !important;
        box-shadow: -10px 0 40px rgba(0, 0, 0, 0.6) !important;
        font-family: 'Inter', system-ui, sans-serif !important;
    }
    #mobileMenuDrawer.active {
        right: 0 !important;
    }
    .mobile-drawer-overlay {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        background: rgba(7, 15, 30, 0.6) !important;
        backdrop-filter: blur(4px) !important;
        z-index: 999998 !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transition: all 0.3s ease !important;
    }
    .mobile-drawer-overlay.active {
        opacity: 1 !important;
        visibility: visible !important;
    }
  </style>


  <style id="master-hero-shift-up-mobile-2026">
    /* SHIFT HERO SECTION UP ON MOBILE */
    @media (max-width: 768px) {
        .navbar .container {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center !important;
            justify-content: space-between !important;
            height: 60px !important;
            padding: 0 14px !important;
        }
        .nav-actions {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
        }
        main {
            padding-top: 60px !important;
        }
        section.hero, .hero-section, .hero, div.hero {
            padding-top: 25px !important;
            padding-bottom: 20px !important;
            margin-top: 0 !important;
            min-height: auto !important;
            height: auto !important;
        }
        .hero h1, .hero-title, h1.hero-title {
            font-size: 24px !important;
            line-height: 1.2 !important;
            margin-top: 8px !important;
            margin-bottom: 8px !important;
        }
        .hero p, .hero-subtitle, p.hero-subtitle {
            font-size: 12.5px !important;
            line-height: 1.4 !important;
            margin-bottom: 12px !important;
        }
        .hero-badges, .hero-checklist {
            gap: 4px !important;
            margin-bottom: 14px !important;
        }
        .hero-cta-group, .hero-buttons {
            gap: 8px !important;
        }
        .hero-cta-group a, .hero-buttons a {
            padding: 10px 16px !important;
            font-size: 13px !important;
        }
    }
  </style>


  <script>
    function spToggleMobileMenu(e) {
        if (e) { e.preventDefault(); e.stopPropagation(); }
        var drawer = document.getElementById('mobileMenuDrawer');
        var overlay = document.getElementById('mobileDrawerOverlay');
        if (drawer) {
            drawer.classList.toggle('active');
        }
        if (overlay) {
            overlay.classList.toggle('active');
        }
    }
  </script>


  <script>
    function spToggleMobileMenu(e) {
        if (e) { e.preventDefault(); e.stopPropagation(); }
        var drawer = document.getElementById('mobileMenuDrawer');
        var overlay = document.getElementById('mobileDrawerOverlay');
        if (drawer) {
            drawer.classList.toggle('active');
        }
        if (overlay) {
            overlay.classList.toggle('active');
        }
    }
  </script>


  <style id="master-hero-and-popup-2026">
    /* MOBILE HERO SHIFT UP (HEIGHT AUTO, MIN-HEIGHT AUTO, NO PADDING OVERKILL) */
    @media (max-width: 768px) {
        .exact-hero-container, section.hero, .hero-section, .hero {
            height: auto !important;
            min-height: auto !important;
            padding-top: 75px !important;
            padding-bottom: 35px !important;
            margin-top: 0 !important;
        }
        .exact-hero-content {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        .exact-badge {
            margin-bottom: 12px !important;
            padding: 5px 14px !important;
            font-size: 10.5px !important;
        }
        .exact-hero-title {
            font-size: 25px !important;
            margin-bottom: 10px !important;
            line-height: 1.2 !important;
        }
        .exact-hero-sub {
            font-size: 12.5px !important;
            line-height: 1.45 !important;
            margin-bottom: 16px !important;
        }
        .exact-checklist {
            margin-bottom: 18px !important;
            gap: 8px !important;
            font-size: 12px !important;
        }
        .exact-hero-btns {
            gap: 10px !important;
        }
        .exact-hero-btns a {
            padding: 10px 18px !important;
            font-size: 13.5px !important;
            width: 100% !important;
            box-sizing: border-box !important;
            text-align: center !important;
            justify-content: center !important;
        }
    }

    /* LUXURY EXIT INTENT POPUP 2026 */
    .sp-exit-modal-overlay {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        background: rgba(7, 15, 30, 0.75) !important;
        backdrop-filter: blur(8px) !important;
        z-index: 9999999 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 20px !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transition: all 0.3s ease !important;
    }
    .sp-exit-modal-overlay.active {
        opacity: 1 !important;
        visibility: visible !important;
    }
    .sp-exit-modal-card {
        background: #070f1e !important;
        border: 1.5px solid #00a8ff !important;
        border-radius: 20px !important;
        max-width: 460px !important;
        width: 100% !important;
        padding: 30px 24px !important;
        text-align: center !important;
        position: relative !important;
        box-shadow: 0 20px 60px rgba(0, 168, 255, 0.25) !important;
        color: #ffffff !important;
        font-family: 'Inter', system-ui, sans-serif !important;
    }
    .sp-exit-close-btn {
        position: absolute !important;
        top: 14px !important;
        right: 16px !important;
        background: transparent !important;
        border: none !important;
        color: #94a3b8 !important;
        font-size: 24px !important;
        cursor: pointer !important;
    }
  </style>


  <style id="master-mobile-100vh-hero-2026">
    /* MOBILE HERO SECTION: FILL 100% OF VIEWPORT HEIGHT */
    @media (max-width: 768px) {
        .exact-hero-container, section.hero, .hero-section, .hero {
            height: calc(100vh - 60px) !important;
            min-height: calc(100vh - 60px) !important;
            max-height: calc(100vh - 60px) !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            padding: 16px !important;
            margin-top: 0 !important;
            box-sizing: border-box !important;
        }
        .exact-hero-content {
            margin-top: 0 !important;
            padding: 0 10px !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .exact-hero-title {
            font-size: 24px !important;
            line-height: 1.2 !important;
            margin-bottom: 8px !important;
        }
        .exact-hero-sub {
            font-size: 12.5px !important;
            line-height: 1.4 !important;
            margin-bottom: 14px !important;
        }
        .exact-checklist {
            margin-bottom: 16px !important;
            gap: 6px !important;
            font-size: 11.5px !important;
        }
    }
  </style>
  <script>
    // EVENT DELEGATION FOR MOBILE HAMBURGER MENU (GUARANTEED WORKING)
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            var btn = e.target.closest('#mobileHamburgerBtn') || e.target.closest('.mobile-hamburger-btn');
            if (btn) {
                e.preventDefault();
                e.stopPropagation();
                var drawer = document.getElementById('mobileMenuDrawer');
                var overlay = document.getElementById('mobileDrawerOverlay');
                if (drawer) drawer.classList.toggle('active');
                if (overlay) overlay.classList.toggle('active');
            }
        });
    });
  </script>


<style id="sp-navbar-cart-badge-fix">
/* NAVBAR CART ICON TOP-RIGHT FLOATING BADGE */
#cartToggle,
.cart-toggle-btn,
.nav-action-btn[data-open-cart],
a[href*="/cart/"] {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

#cartCount,
.cart-count,
.sp-cart-count-badge {
    position: absolute !important;
    top: -4px !important;
    right: -8px !important;
    background: #0284c7 !important;
    color: #ffffff !important;
    font-size: 0.7rem !important;
    font-weight: 900 !important;
    min-width: 18px !important;
    height: 18px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border: 2px solid #0f172a !important;
    padding: 0 4px !important;
    box-sizing: border-box !important;
    line-height: 1 !important;
    margin: 0 !important;
}
</style>
</head>
<body <?php body_class(); ?>>

  <!-- Navbar -->
  <nav class="navbar" id="navbar">
    <div class="container" style="display:flex;align-items:center;justify-content:space-between;height:100%;max-width:1280px;margin:0 auto;padding:0 24px;">
      <a href="<?php echo home_url(); ?>" class="nav-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/img/logo/logo_swiss.png" alt="Swiss Peptides Labs">
      </a>
      <div class="nav-links">
        <a href="<?php echo home_url(); ?>" class="nav-link<?php if (is_front_page()) echo ' active'; ?>">Inicio</a>
        <a href="<?php echo home_url('/tienda/'); ?>" class="nav-link<?php if (is_page('tienda') || (function_exists('is_shop') && is_shop())) echo ' active'; ?>">Tienda</a>
        <a href="<?php echo home_url('/nosotros'); ?>" class="nav-link<?php if (is_page('nosotros')) echo ' active'; ?>">Nosotros</a>
        <a href="<?php echo home_url('/calculadora'); ?>" class="nav-link<?php if (is_page('calculadora')) echo ' active'; ?>">Calculadora de Mezcla</a>
        <a href="<?php echo home_url('/contacto'); ?>" class="nav-link<?php if (is_page('contacto')) echo ' active'; ?>">Contacto</a>
      </div>
      
<button type="button" class="mobile-hamburger-btn" id="mobileHamburgerBtn" aria-label="Abrir Menú" onclick="document.getElementById('mobileNavModal').style.display='flex'">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
<div class="nav-actions" style="display:flex;align-items:center;gap:12px;">
        
        <button class="nav-action-btn cart-toggle" id="cartToggle" aria-label="Carrito" style="background:transparent;border:none;cursor:pointer;color:#ffffff;">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
          <?php
          $sp_header_count = 0;
          if (function_exists('WC') && WC()->cart) {
              $sp_header_count = WC()->cart->get_cart_contents_count();
          }
          ?>
          <span class="cart-count" id="cartCount" style="background:#00a8ff;color:#fff;border-radius:50px;padding:2px 8px;font-size:11px;font-weight:700;<?php echo ($sp_header_count > 0) ? 'display:inline-flex;' : 'display:none;'; ?>"><?php echo $sp_header_count; ?></span>
        </button>
      </div>
    </div>
  
        

</nav>

<!-- MOBILE FULLSCREEN NAVIGATION MODAL -->
<div id="mobileNavModal" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(7,15,30,0.97);backdrop-filter:blur(20px);z-index:99999999;flex-direction:column;align-items:center;justify-content:center;gap:0;font-family:'Inter',system-ui,sans-serif;">
  <button type="button" onclick="document.getElementById('mobileNavModal').style.display='none'" style="position:absolute;top:18px;right:20px;background:transparent;border:none;color:#94a3b8;font-size:36px;cursor:pointer;z-index:10;line-height:1;">&times;</button>
  <div style="display:flex;flex-direction:column;align-items:center;gap:6px;width:100%;max-width:300px;">
    <a href="/" onclick="document.getElementById('mobileNavModal').style.display='none'" style="display:block;width:100%;padding:16px 0;text-align:center;color:#ffffff;font-size:18px;font-weight:700;text-decoration:none;border-bottom:1px solid rgba(255,255,255,0.08);transition:color 0.2s;">Inicio</a>
    <a href="/tienda/" onclick="document.getElementById('mobileNavModal').style.display='none'" style="display:block;width:100%;padding:16px 0;text-align:center;color:#00a8ff;font-size:18px;font-weight:800;text-decoration:none;border-bottom:1px solid rgba(255,255,255,0.08);transition:color 0.2s;">Tienda</a>
    <a href="/nosotros/" onclick="document.getElementById('mobileNavModal').style.display='none'" style="display:block;width:100%;padding:16px 0;text-align:center;color:#ffffff;font-size:18px;font-weight:700;text-decoration:none;border-bottom:1px solid rgba(255,255,255,0.08);transition:color 0.2s;">Nosotros</a>
    <a href="/calculadora/" onclick="document.getElementById('mobileNavModal').style.display='none'" style="display:block;width:100%;padding:16px 0;text-align:center;color:#ffffff;font-size:18px;font-weight:700;text-decoration:none;border-bottom:1px solid rgba(255,255,255,0.08);transition:color 0.2s;">Calculadora de Mezcla</a>
    <a href="/contacto/" onclick="document.getElementById('mobileNavModal').style.display='none'" style="display:block;width:100%;padding:16px 0;text-align:center;color:#ffffff;font-size:18px;font-weight:700;text-decoration:none;border-bottom:1px solid rgba(255,255,255,0.08);transition:color 0.2s;">Contacto</a>
    <a href="https://wa.me/573189163091?text=Hola%2C%20quiero%20asesor%C3%ADa%20sobre%20p%C3%A9ptidos" target="_blank" onclick="document.getElementById('mobileNavModal').style.display='none'" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;margin-top:16px;padding:14px 0;background:#25D366;color:#ffffff;font-size:16px;font-weight:800;text-decoration:none;border-radius:12px;box-shadow:0 8px 25px rgba(37,211,102,0.35);">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
      WhatsApp Directo
    </a>
  </div>
</div>


  <!-- Master 2026 Light Clinical Luxury Drawer CSS & Overlay -->
<style id="sp-master-drawer-cart-fix">
#cartSidebar {
    position: fixed !important;
    top: 0 !important;
    right: -100% !important;
    width: 420px !important;
    max-width: 100vw !important;
    height: 100vh !important;
    height: 100dvh !important;
    background: #ffffff !important;
    z-index: 999999 !important;
    box-shadow: -10px 0 40px rgba(15, 23, 42, 0.15) !important;
    display: flex !important;
    flex-direction: column !important;
    transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    box-sizing: border-box !important;
    overflow-x: hidden !important;
}
#cartSidebar.active,
#cartSidebar.open {
    right: 0 !important;
}

.cart-sidebar-header {
    padding: 20px 24px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    border-bottom: 1px solid #e2e8f0 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
}
.cart-sidebar-header h3 {
    margin: 0 !important;
    font-size: 1.15rem !important;
    font-weight: 800 !important;
    color: #0f172a !important;
}
.cart-close-btn {
    background: #f1f5f9 !important;
    border: none !important;
    width: 32px !important;
    height: 32px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    color: #64748b !important;
    transition: all 0.2s ease !important;
}
.cart-close-btn:hover {
    background: #ef4444 !important;
    color: #ffffff !important;
}

.cart-sidebar-body {
    flex: 1 !important;
    overflow-y: auto !important;
    padding: 20px !important;
    box-sizing: border-box !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
}

.cart-sidebar-footer {
    padding: 20px !important;
    border-top: 1px solid #e2e8f0 !important;
    background: #ffffff !important;
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
}

.cart-btn-checkout-whatsapp {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    width: 100% !important;
    max-width: 100% !important;
    height: 52px !important;
    background: #25D366 !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 16px !important;
    font-size: 0.98rem !important;
    font-weight: 800 !important;
    text-align: center !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
    box-shadow: 0 8px 20px rgba(37,211,102,0.25) !important;
    box-sizing: border-box !important;
    transition: all 0.25s ease !important;
}
.cart-btn-checkout-whatsapp:hover {
    background: #20bd5a !important;
    transform: translateY(-2px) !important;
}

.cart-btn-view-cart {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100% !important;
    max-width: 100% !important;
    height: 48px !important;
    background: #ffffff !important;
    color: #0284c7 !important;
    border: 2px solid #0284c7 !important;
    border-radius: 16px !important;
    font-size: 0.9rem !important;
    font-weight: 800 !important;
    text-align: center !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
    box-sizing: border-box !important;
    transition: all 0.25s ease !important;
}
.cart-btn-view-cart:hover {
    background: #f0f9ff !important;
}

#overlay,
.overlay {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    background: rgba(15, 23, 42, 0.4) !important;
    backdrop-filter: blur(4px) !important;
    z-index: 999998 !important;
    opacity: 0 !important;
    pointer-events: none !important;
    transition: opacity 0.3s ease !important;
}
#overlay.active,
.overlay.active {
    opacity: 1 !important;
    pointer-events: auto !important;
}
</style>

<!-- Overlay -->
<div class="overlay" id="overlay"></div>

<!-- Cart Sidebar Drawer -->
<div class="cart-sidebar" id="cartSidebar">
  <div class="cart-sidebar-header">
    <h3>Tu Carrito</h3>
    <button class="cart-close-btn" id="cartCloseBtn" title="Cerrar carrito">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>
  <div class="cart-sidebar-body" id="cartSidebarBody"></div>
  <div class="cart-sidebar-footer">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
      <span style="font-size:0.92rem;color:#64748b;font-weight:600;">Subtotal:</span>
      <span class="cart-total-amount" id="cartTotalAmount" style="font-size:1.3rem;font-weight:900;color:#0284c7;">$ 0</span>
    </div>
    <a href="<?php echo wc_get_checkout_url(); ?>" class="cart-btn-checkout-whatsapp">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink:0!important;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
      Finalizar Pedido por WhatsApp
    </a>
    <a href="<?php echo wc_get_cart_url(); ?>" class="cart-btn-view-cart">Ver mi carrito completo</a>
  </div>
</div>

  <main>
