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

  <!-- MASTER CART DRAWER CONTROLLER (ZERO-LATENCY 2026) -->
  
  <!-- ═══════════════════════════════════════════════════════════════════
       MASTER COMPLETE STANDALONE INLINE CART ENGINE (0ms, Zero Dependencies)
       ═══════════════════════════════════════════════════════════════════ -->
  <script>
  window.spUpdateCartBadges = function(count, totalFormatted) {
    count = parseInt(count) || 0;
    var badges = document.querySelectorAll('#cartCount, .cart-count, #floatingCartCount, .floating-cart-count, .floating-cart-badge');
    badges.forEach(function(b) {
      if (count > 0) {
        b.textContent = count;
        b.classList.add('has-items');
        b.style.setProperty('display', 'inline-flex', 'important');
      } else {
        b.textContent = '';
        b.classList.remove('has-items');
        b.style.setProperty('display', 'none', 'important');
      }
    });

    if (totalFormatted) {
      var subEl = document.getElementById('floatingCartSubtotal');
      if (subEl) subEl.textContent = totalFormatted;
      var drawerSub = document.getElementById('cartTotalAmount');
      if (drawerSub) drawerSub.textContent = totalFormatted;
    }

    try {
      localStorage.setItem('sp_cart_count', count);
      if (totalFormatted) localStorage.setItem('sp_cart_total', totalFormatted);
    } catch(e) {}
  };

  window.openCartSidebarDrawer = window.openCart = function(skipFetch) {
    var sb = document.getElementById('cartSidebar');
    var ov = document.getElementById('overlay');
    if (sb) {
      sb.classList.add('open');
      sb.classList.add('active');
    }
    if (ov) {
      ov.classList.add('active');
      ov.classList.add('open');
    }
    document.body.style.overflow = 'hidden';
    document.body.classList.add('cart-open', 'cart-drawer-open');
    if (!skipFetch && typeof window.spUpdateCartDrawerFromAJAX === 'function') {
      window.spUpdateCartDrawerFromAJAX();
    }
  };

  window.closeCartSidebarDrawer = window.closeCart = function() {
    var sb = document.getElementById('cartSidebar');
    var ov = document.getElementById('overlay');
    if (sb) {
      sb.classList.remove('open');
      sb.classList.remove('active');
    }
    if (ov) {
      ov.classList.remove('active');
      ov.classList.remove('open');
    }
    document.body.style.overflow = '';
    document.body.classList.remove('cart-open', 'cart-drawer-open');
  };

  window.spRenderCartData = function(data) {
    if (!data) return;
    var totalCount = parseInt(data.count) || 0;
    var formattedTotal = data.total || '$ 0';

    // 1. Update badges & subtotals
    window.spUpdateCartBadges(totalCount, formattedTotal);

    // 2. Render items in drawer
    var body = document.getElementById('cartSidebarBody');
    if (!body) return;

    if (!data.items || data.items.length === 0) {
      body.innerHTML = '<div style="text-align:center;padding:40px 20px;"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" style="margin:0 auto 16px;display:block;"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg><div style="font-weight:700;color:#94a3b8;font-size:0.95rem;">Tu carrito está vacío</div><div style="color:#cbd5e1;font-size:0.82rem;margin-top:4px;">Agrega productos para comenzar</div></div>';
      return;
    }

    var itemsHtml = '';
    var hasWater = false;

    data.items.forEach(function(item) {
      if (item.name && item.name.toLowerCase().indexOf('bacteri') >= 0) hasWater = true;

      var discPct = 0;
      if (item.price > 0 && item.unit_price > 0 && item.unit_price < item.price) {
        discPct = Math.round((1 - item.unit_price / item.price) * 100);
      }
      var discBadge = discPct > 0 ? '<span style="background:rgba(2,132,199,0.12);color:#0284c7;font-size:11px;font-weight:800;padding:2px 6px;border-radius:6px;margin-left:6px;border:1px solid rgba(2,132,199,0.25);">' + discPct + '% OFF</span>' : '';

      itemsHtml += '<div class="cart-item-card" data-key="' + item.key + '" data-name="' + encodeURIComponent(item.name) + '" data-price="' + item.price + '" data-qty="' + item.qty + '" style="background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;padding:12px 14px;display:flex;align-items:center;gap:12px;box-shadow:0 2px 8px rgba(15,23,42,0.03);margin-bottom:8px;">'
        + '<div style="width:48px;height:48px;border-radius:12px;overflow:hidden;background:#f8fafc;border:1px solid #f1f5f9;flex-shrink:0;">'
        + '<img src="' + item.image + '" alt="' + item.name + '" style="width:100%;height:100%;object-fit:cover;">'
        + '</div>'
        + '<div style="flex:1;min-width:0;">'
        + '<div style="font-weight:800;font-size:0.92rem;color:#0f172a;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' + item.name + '</div>'
        + '<div style="display:flex;align-items:center;gap:6px;margin-top:4px;flex-wrap:wrap;">'
        + '<div style="display:inline-flex;align-items:center;gap:4px;background:#f8fafc;border:1px solid #cbd5e1;border-radius:50px;padding:2px 6px;box-sizing:border-box;">'
        + '<button type="button" onclick="spChangeDrawerItemQty(\'' + item.key + '\', -1, this)" style="width:20px;height:20px;border-radius:50px;border:none;background:#e2e8f0;color:#0f172a;font-weight:800;font-size:12px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;line-height:1;user-select:none;">-</button>'
        + '<span class="sp-drawer-qty-num" style="font-weight:800;font-size:0.85rem;color:#0f172a;min-width:24px;text-align:center;display:inline-block;line-height:1;margin:0 2px;">' + item.qty + '</span>'
        + '<button type="button" onclick="spChangeDrawerItemQty(\'' + item.key + '\', 1, this)" style="width:20px;height:20px;border-radius:50px;border:none;background:#e2e8f0;color:#0f172a;font-weight:800;font-size:12px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;line-height:1;user-select:none;">+</button>'
        + '</div>'
        + discBadge
        + '</div>'
        + '<div class="sp-drawer-item-subtotal" style="font-weight:800;font-size:0.94rem;color:#0284c7;margin-top:4px;">' + item.subtotal_fmt + '</div>'
        + '</div>'
        + '<button type="button" onclick="spRemoveWCCartItem(\'' + item.key + '\', this)" style="width:32px;height:32px;border-radius:10px;background:#fef2f2;border:1px solid #fecaca;color:#ef4444;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;" title="Eliminar">'
        + '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>'
        + '</button>'
        + '</div>';
    });

    if (!hasWater) {
      itemsHtml += '<div style="background:#f0f9ff;border:1.5px solid #bae6fd;border-radius:16px;padding:14px;display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:8px;">'
        + '<div style="width:40px;height:40px;border-radius:12px;background:#e0f2fe;color:#0284c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">'
        + '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2v7.527a2 2 0 0 1-.211.896L4.72 20.55a1 1 0 0 0 .9 1.45h12.76a1 1 0 0 0 .9-1.45l-5.069-10.127A2 2 0 0 1 14 9.527V2q0-.41-.293-.707T13 1h-2q-.41 0-.707.293T10 2z"/></svg>'
        + '</div>'
        + '<div style="flex:1;min-width:0;">'
        + '<div style="font-weight:800;font-size:0.85rem;color:#0f172a;">¿Necesitas Agua Bacteriostática?</div>'
        + '<div style="font-size:0.78rem;font-weight:700;color:#0284c7;margin-top:2px;">30ml Grado Clínico — $ 35.000</div>'
        + '</div>'
        + '<button type="button" onclick="spAddAddonWater(this)" style="background:#0284c7;color:#ffffff;padding:8px 14px;border-radius:20px;font-weight:800;font-size:0.75rem;border:none;cursor:pointer;text-transform:uppercase;box-shadow:0 4px 12px rgba(2,132,199,0.25);flex-shrink:0;">'
        + '+ AGREGAR'
        + '</button>'
        + '</div>';
    }

    body.innerHTML = itemsHtml;
  };

  window.spUpdateCartDrawerFromAJAX = function() {
    fetch('/?sp_ajax_cart=1', {
      method: 'GET',
      credentials: 'same-origin',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
      window.spRenderCartData(data);
    })
    .catch(function(err) { console.log('Cart drawer update error', err); });
  };

  window.spChangeDrawerItemQty = function(key, delta, btnElem) {
    var card = btnElem ? btnElem.closest('.cart-item-card') : null;
    var currentQty = card ? (parseInt(card.getAttribute('data-qty')) || 1) : 1;
    var newQty = currentQty + delta;

    if (newQty <= 0) {
      window.spRemoveWCCartItem(key, btnElem);
      return;
    }

    fetch('/?sp_ajax_cart=1&sp_update_qty=' + newQty + '&cart_key=' + encodeURIComponent(key), {
      method: 'GET',
      credentials: 'same-origin',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
      window.spRenderCartData(data);
    });
  };

  window.spRemoveWCCartItem = function(key, btnElem) {
    if (btnElem) {
      var card = btnElem.closest('.cart-item-card');
      if (card) card.remove();
    }
    fetch('/?sp_ajax_cart=1&sp_remove_key=' + encodeURIComponent(key), {
      method: 'GET',
      credentials: 'same-origin',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
      window.spRenderCartData(data);
    });
  };

  window.spAddAddonWater = function(btnElem) {
    if (btnElem) {
      btnElem.disabled = true;
      btnElem.textContent = 'AGREGANDO...';
    }
    fetch('/?sp_ajax_cart=1&add_product_id=25&qty=1', {
      method: 'GET',
      credentials: 'same-origin',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
      window.spRenderCartData(data);
    });
  };

  document.addEventListener('DOMContentLoaded', function() {
    window.spUpdateCartDrawerFromAJAX();
  });
  </script>
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
        
        <?php
        $sp_h_count = (function_exists('WC') && WC()->cart) ? WC()->cart->get_cart_contents_count() : 0;
        ?>
        <button type="button" class="nav-action-btn cart-toggle" id="cartToggle" aria-label="Carrito" onclick="window.openCartSidebarDrawer(); return false;" style="background:transparent;border:none;cursor:pointer;color:#ffffff;position:relative;">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
          <span class="cart-count <?php echo $sp_h_count > 0 ? 'has-items' : ''; ?>" id="cartCount" style="<?php echo $sp_h_count > 0 ? 'display:inline-flex!important;' : 'display:none;'; ?>"><?php echo $sp_h_count > 0 ? $sp_h_count : ''; ?></span>
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
<div class="overlay" id="overlay" onclick="window.closeCartSidebarDrawer()"></div>

<!-- Cart Sidebar Drawer -->
<div class="cart-sidebar" id="cartSidebar">
  <div class="cart-sidebar-header">
    <h3>Tu Carrito</h3>
    <button type="button" class="cart-close-btn" id="cartCloseBtn" title="Cerrar carrito" onclick="window.closeCartSidebarDrawer()">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>
    <div class="cart-sidebar-body" id="cartSidebarBody">
    <?php
    if (function_exists('WC') && WC()->cart && !WC()->cart->is_empty()) {
        WC()->cart->calculate_totals();
        $cart = WC()->cart->get_cart();
        $has_water = false;
        foreach ($cart as $key => $item) {
            $_product = isset($item['data']) ? $item['data'] : null;
            if ($_product && $_product->exists()) {
                $qty = (int) $item['quantity'];
                $pid = $_product->get_id();
                $name = $_product->get_name();
                if (stripos($name, 'bacteri') !== false) $has_water = true;
                $base_price = (float) get_post_meta($pid, '_regular_price', true);
                if ($base_price <= 0) $base_price = (float) get_post_meta($pid, '_price', true);
                if ($base_price <= 0) $base_price = (float) $_product->get_regular_price();
                $unit_price = (float) $_product->get_price();
                $line_subtotal = round($unit_price * $qty);
                $thumb_id = $_product->get_image_id();
                $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'thumbnail') : wc_placeholder_img_src();
                $disc_pct = 0;
                if ($base_price > 0 && $unit_price > 0 && $unit_price < $base_price) {
                    $disc_pct = round((1 - $unit_price / $base_price) * 100);
                }
                ?>
                <div class="cart-item-card" data-key="<?php echo esc_attr($key); ?>" data-name="<?php echo esc_attr($name); ?>" data-price="<?php echo esc_attr($base_price); ?>" data-qty="<?php echo esc_attr($qty); ?>" style="background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;padding:12px 14px;display:flex;align-items:center;gap:12px;box-shadow:0 2px 8px rgba(15,23,42,0.03);margin-bottom:8px;">
                  <div style="width:48px;height:48px;border-radius:12px;overflow:hidden;background:#f8fafc;border:1px solid #f1f5f9;flex-shrink:0;">
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($name); ?>" style="width:100%;height:100%;object-fit:cover;">
                  </div>
                  <div style="flex:1;min-width:0;">
                    <div style="font-weight:800;font-size:0.92rem;color:#0f172a;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo esc_html($name); ?></div>
                    <div style="display:flex;align-items:center;gap:6px;margin-top:4px;flex-wrap:wrap;">
                      <div style="display:inline-flex;align-items:center;gap:4px;background:#f8fafc;border:1px solid #cbd5e1;border-radius:50px;padding:2px 6px;box-sizing:border-box;">
                        <button type="button" onclick="spChangeDrawerItemQty('<?php echo esc_js($key); ?>', -1, this)" style="width:20px;height:20px;border-radius:50px;border:none;background:#e2e8f0;color:#0f172a;font-weight:800;font-size:12px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;line-height:1;user-select:none;">-</button>
                        <span class="sp-drawer-qty-num" style="font-weight:800;font-size:0.85rem;color:#0f172a;min-width:24px;text-align:center;display:inline-block;line-height:1;margin:0 2px;"><?php echo $qty; ?></span>
                        <button type="button" onclick="spChangeDrawerItemQty('<?php echo esc_js($key); ?>', 1, this)" style="width:20px;height:20px;border-radius:50px;border:none;background:#e2e8f0;color:#0f172a;font-weight:800;font-size:12px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;line-height:1;user-select:none;">+</button>
                      </div>
                      <?php if ($disc_pct > 0): ?>
                        <span style="background:rgba(2,132,199,0.12);color:#0284c7;font-size:11px;font-weight:800;padding:2px 6px;border-radius:6px;margin-left:6px;border:1px solid rgba(2,132,199,0.25);"><?php echo $disc_pct; ?>% OFF</span>
                      <?php endif; ?>
                    </div>
                    <div class="sp-drawer-item-subtotal" style="font-weight:800;font-size:0.94rem;color:#0284c7;margin-top:4px;">$ <?php echo number_format($line_subtotal, 0, ',', '.'); ?></div>
                  </div>
                  <button type="button" onclick="spRemoveWCCartItem('<?php echo esc_js($key); ?>', this)" style="width:32px;height:32px;border-radius:10px;background:#fef2f2;border:1px solid #fecaca;color:#ef4444;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;" title="Eliminar">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                  </button>
                </div>
                <?php
            }
        }
        if (!$has_water) {
            ?>
            <div style="background:#f0f9ff;border:1.5px solid #bae6fd;border-radius:16px;padding:14px;display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:8px;">
              <div style="width:40px;height:40px;border-radius:12px;background:#e0f2fe;color:#0284c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2v7.527a2 2 0 0 1-.211.896L4.72 20.55a1 1 0 0 0 .9 1.45h12.76a1 1 0 0 0 .9-1.45l-5.069-10.127A2 2 0 0 1 14 9.527V2q0-.41-.293-.707T13 1h-2q-.41 0-.707.293T10 2z"/></svg>
              </div>
              <div style="flex:1;min-width:0;">
                <div style="font-weight:800;font-size:0.85rem;color:#0f172a;">¿Necesitas Agua Bacteriostática?</div>
                <div style="font-size:0.78rem;font-weight:700;color:#0284c7;margin-top:2px;">30ml Grado Clínico — $ 35.000</div>
              </div>
              <button type="button" onclick="spAddAddonWater(this)" style="background:#0284c7;color:#ffffff;padding:8px 14px;border-radius:20px;font-weight:800;font-size:0.75rem;border:none;cursor:pointer;text-transform:uppercase;box-shadow:0 4px 12px rgba(2,132,199,0.25);flex-shrink:0;">
                + AGREGAR
              </button>
            </div>
            <?php
        }
    } else {
        ?>
        <div style="text-align:center;padding:40px 20px;"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" style="margin:0 auto 16px;display:block;"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg><div style="font-weight:700;color:#94a3b8;font-size:0.95rem;">Tu carrito está vacío</div><div style="color:#cbd5e1;font-size:0.82rem;margin-top:4px;">Agrega productos para comenzar</div></div>
        <?php
    }
    ?>
  </div>
  <div class="cart-sidebar-footer">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
      <span style="font-size:0.92rem;color:#64748b;font-weight:600;">Subtotal:</span>
      <?php
$sp_h_total = (function_exists('WC') && WC()->cart) ? WC()->cart->get_cart_contents_total() : 0;
$sp_h_total_fmt = '$ ' . number_format($sp_h_total, 0, ',', '.');
?>
<span class="cart-total-amount" id="cartTotalAmount" style="font-size:1.3rem;font-weight:900;color:#0284c7;"><?php echo $sp_h_total_fmt; ?></span>
    </div>
    <a href="<?php echo wc_get_checkout_url(); ?>" class="cart-btn-checkout-whatsapp">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink:0!important;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
      Finalizar Pedido por WhatsApp
    </a>
    <a href="<?php echo wc_get_cart_url(); ?>" class="cart-btn-view-cart">Ver mi carrito completo</a>
  </div>
</div>

  <main>
