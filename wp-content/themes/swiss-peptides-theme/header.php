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





    <!-- Preload critical resources -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/css/main.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" as="style">

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
          <span class="cart-count" id="cartCount" style="display:none;"></span>
          <script>
          (function(){
            try {
              var c = localStorage.getItem('sp_cart_count');
              var t = localStorage.getItem('sp_cart_total');
              if (c && parseInt(c) > 0) {
                var el = document.getElementById('cartCount');
                if (el) { el.textContent = c; el.style.display = 'flex'; }
              }
            } catch(e){}
          })();
          </script>
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
