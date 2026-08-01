/* ============================================
   SWISS PEPTIDES — WordPress App v3.1
   Uses WC native wc-ajax endpoints (add_to_cart, 
   get_refreshed_fragments) which are NOT blocked
   by the hosting firewall.
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {

  /* --- Cart Sidebar Toggle --- */
  const cartToggle = document.getElementById('cartToggle');
  const cartSidebar = document.getElementById('cartSidebar');
  const cartCloseBtn = document.getElementById('cartCloseBtn');
  const overlay = document.getElementById('overlay');

  function openCart() {
    if (cartSidebar) cartSidebar.classList.add('open');
    if (overlay) overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
  function closeCart() {
    if (cartSidebar) cartSidebar.classList.remove('open');
    if (overlay) overlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  if (cartToggle) cartToggle.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    refreshCart();
    openCart();
  });
  if (cartCloseBtn) cartCloseBtn.addEventListener('click', closeCart);
  if (overlay) overlay.addEventListener('click', closeCart);

  /* --- Add to Cart (WC Native wc-ajax=add_to_cart) --- */
  document.addEventListener('click', function(e) {
    const btn = e.target.closest('.sp-add-to-cart');
    if (!btn) return;
    e.preventDefault();
    e.stopPropagation();

    const productId = btn.dataset.productId;
    const qty = btn.dataset.qty || 1;

    btn.disabled = true;
    btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" class="sp-spin"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="30 60"/></svg>';

    fetch('/?wc-ajax=add_to_cart', {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `product_id=${productId}&quantity=${qty}`
    })
    .then(r => r.json())
    .then(data => {
      if (data.fragments) {
        updateFromFragments(data.fragments);
        showToast('Producto agregado al carrito', 'success');
        openCart();
      } else if (data.error) {
        showToast('Error al agregar producto', 'error');
      }
    })
    .catch(err => {
      console.error('Add to cart error:', err);
      showToast('Error de conexion', 'error');
    })
    .finally(() => {
      btn.disabled = false;
      btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>';
    });
  });

  /* --- Refresh Cart (WC Native get_refreshed_fragments) --- */
  function refreshCart() {
    fetch('/?wc-ajax=get_refreshed_fragments', {
      method: 'POST',
      credentials: 'same-origin',
    })
    .then(r => r.json())
    .then(data => {
      if (data && data.fragments) {
        updateFromFragments(data.fragments);
      }
    })
    .catch(err => console.error('Cart refresh error:', err));
  }

  /* --- Parse WC Fragments into sidebar --- */
  function updateFromFragments(fragments) {
    const html = fragments['div.widget_shopping_cart_content'] || '';
    const tmp = document.createElement('div');
    tmp.innerHTML = html;

    // Parse mini-cart items
    const miniItems = tmp.querySelectorAll('.mini_cart_item');
    updateCartCount(miniItems.length);

    const items = [];
    miniItems.forEach(el => {
      const link = el.querySelector('a:not(.remove)');
      const img = el.querySelector('img');
      const removeEl = el.querySelector('a.remove');
      const qtySpan = el.querySelector('.quantity');

      if (link) {
        // Extract name from link text (after the img)
        const nameText = link.textContent.trim();
        
        // Extract price from quantity span: "1 × $ 1.110.000"
        let priceText = '';
        let qtyVal = 1;
        if (qtySpan) {
          const qtyContent = qtySpan.textContent.trim();
          const qtyMatch = qtyContent.match(/^(\d+)/);
          if (qtyMatch) qtyVal = parseInt(qtyMatch[1]);
          const priceEl = qtySpan.querySelector('.woocommerce-Price-amount');
          if (priceEl) priceText = priceEl.textContent.trim();
        }

        items.push({
          name: nameText,
          image: img ? img.src : '',
          qty: qtyVal,
          price: priceText,
          removeUrl: removeEl ? removeEl.href : '',
          cartItemKey: removeEl ? removeEl.getAttribute('data-cart_item_key') : '',
        });
      }
    });

    renderCartItems(items); spUpdateCartDrawerFromAJAX();

    // Get subtotal
    const totalEl = tmp.querySelector('.total .woocommerce-Price-amount');
    if (totalEl) {
      const el = document.getElementById('cartTotalAmount');
      if (el) el.textContent = totalEl.textContent.trim();
    }

    // Show free shipping bar
    spRenderShippingBar('cartShippingBar');
  }

  function updateCartCount(count) {
    const countElems = document.querySelectorAll('#cartCount, .cart-count, .floating-cart-count, #floatingCartCount');
    countElems.forEach(el => {
      el.textContent = count;
      el.style.display = count > 0 ? 'flex' : 'none';
    });
  }

  function renderCartItems(items) {
    const body = document.getElementById('cartSidebarBody');
    if (!body) return;

    if (!items || items.length === 0) {
      body.innerHTML = `<div style="text-align:center;padding:60px 20px;color:#64748b;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:12px;opacity:.5;">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
        </svg>
        <div style="font-size:1rem;font-weight:700;color:#0f172a;">Tu carrito está vacío</div>
      </div>`;
      return;
    }

    let htmlContent = items.map(item => `
      <div style="display:flex;align-items:center;gap:12px;background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;padding:12px 14px;box-shadow:0 4px 12px rgba(15,23,42,0.03);margin-bottom:10px;box-sizing:border-box;">
        <div style="width:60px;height:60px;border-radius:12px;overflow:hidden;background:#ffffff;border:1px solid #e2e8f0;flex-shrink:0;">
          <img src="${item.image}" alt="${item.name}" style="width:100%;height:100%;object-fit:cover;">
        </div>
        <div style="flex:1;min-width:0;">
          <div style="font-weight:800;font-size:0.94rem;color:#0f172a;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${item.name}</div>
          <div style="font-size:0.78rem;color:#64748b;font-weight:600;margin-top:2px;">Cantidad: ${item.qty}</div>
          <div style="font-weight:800;font-size:0.94rem;color:#0284c7;margin-top:2px;">${item.price}</div>
        </div>
        ${item.removeUrl ? `<button type="button" style="width:32px;height:32px;border-radius:10px;background:#fef2f2;border:1px solid #fecaca;color:#ef4444;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;" onclick="event.preventDefault();event.stopPropagation();spRemoveItemByUrl('${item.removeUrl}');" title="Eliminar"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>` : ''}
      </div>
    `).join('');

    const hasWater = items.some(item => item.name.toLowerCase().includes('bacteriost'));
    if (!hasWater && items.length > 0) {
      htmlContent += `
        <div style="background:#f0f9ff;border:1.5px solid #bae6fd;border-radius:16px;padding:14px;display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:8px;">
          <div style="width:40px;height:40px;border-radius:12px;background:#e0f2fe;color:#0284c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2v7.527a2 2 0 0 1-.211.896L4.72 20.55a1 1 0 0 0 .9 1.45h12.76a1 1 0 0 0 .9-1.45l-5.069-10.127A2 2 0 0 1 14 9.527V2q0-.41-.293-.707T13 1h-2q-.41 0-.707.293T10 2z"/></svg>
          </div>
          <div style="flex:1;min-width:0;">
            <div style="font-weight:800;font-size:0.85rem;color:#0f172a;">¿Necesitas Agua Bacteriostática?</div>
            <div style="font-size:0.78rem;font-weight:700;color:#0284c7;margin-top:2px;">30ml Grado Clínico — $ 75.000</div>
          </div>
          <button type="button" onclick="spAddAddonWater(this)" style="background:#0284c7;color:#ffffff;padding:8px 14px;border-radius:20px;font-weight:800;font-size:0.75rem;border:none;cursor:pointer;text-transform:uppercase;box-shadow:0 4px 12px rgba(2,132,199,0.25);flex-shrink:0;">
            + AGREGAR
          </button>
        </div>
      `;
    }
    body.innerHTML = htmlContent;
  }

  /* --- Remove Item --- */
  window.spRemoveItem = function(el) {
    const url = el.href;
    el.textContent = '...';
    fetch(url, { credentials: 'same-origin' })
      .then(() => {
        refreshCart();
        showToast('Producto eliminado', 'info');
      });
  };

  /* --- Shipping Progress Bar --- */
  window.spRenderShippingBar = function(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    container.innerHTML = `<div style="background:linear-gradient(135deg,#10B981,#059669);color:white;padding:12px 16px;border-radius:var(--radius-lg);font-size:var(--fs-sm);font-weight:600;text-align:center;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:6px;"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
      Envio GRATIS aplicado</div>`;
  };

  /* --- Toast --- */
  window.showToast = function(msg, type) {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = 'toast toast-' + (type || 'info');
    toast.textContent = msg;
    toast.style.cssText = 'padding:12px 20px;background:var(--navy);color:white;border-radius:var(--radius-lg);font-size:var(--fs-sm);font-weight:500;box-shadow:var(--shadow-lg);animation:slideIn .3s ease;margin-bottom:8px;';
    if (type === 'success') toast.style.background = '#059669';
    if (type === 'error') toast.style.background = '#DC2626';
    container.appendChild(toast);
    setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 300); }, 3000);
  };

  /* --- Navbar Scroll --- */
  const navbar = document.getElementById('navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    });
  }

  /* --- Mobile Menu --- */
  const hamburger = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobileMenu');
  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => {
      mobileMenu.classList.toggle('open');
      hamburger.classList.toggle('active');
    });
  }

  /* --- Scroll Progress --- */
  const scrollProgress = document.getElementById('scrollProgress');
  if (scrollProgress) {
    window.addEventListener('scroll', () => {
      const h = document.documentElement.scrollHeight - window.innerHeight;
      scrollProgress.style.width = h > 0 ? (window.scrollY / h * 100) + '%' : '0%';
    });
  }

  /* --- Preloader --- */
  const preloader = document.getElementById('preloader');
  if (preloader) {
    setTimeout(() => preloader.classList.add('hidden'), 1200);
    setTimeout(() => preloader.remove(), 1700);
  }

  /* --- Intersection Observer for Animations --- */
  const animItems = document.querySelectorAll('[data-animate]');
  if (animItems.length && 'IntersectionObserver' in window) {
    const obs = new IntersectionObserver((entries) => {
      entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }});
    }, { threshold: 0.01, rootMargin: '50px' });
    animItems.forEach(el => obs.observe(el));
    setTimeout(() => { animItems.forEach(el => el.classList.add('visible')); }, 2000);
  } else {
    document.querySelectorAll('[data-animate]').forEach(el => el.classList.add('visible'));
  }

  /* --- Search Overlay --- */
  const searchBtn = document.getElementById('searchBtn');
  const searchOverlay = document.getElementById('searchOverlay');
  const searchInput = document.getElementById('searchOverlayInput');
  const searchClose = document.getElementById('searchOverlayClose');

  if (searchBtn && searchOverlay) {
    searchBtn.addEventListener('click', function(e) {
      e.preventDefault();
      searchOverlay.classList.add('active');
      setTimeout(() => { if (searchInput) searchInput.focus(); }, 300);
    });
    if (searchClose) searchClose.addEventListener('click', () => searchOverlay.classList.remove('active'));
    searchOverlay.addEventListener('click', (e) => { if (e.target === searchOverlay) searchOverlay.classList.remove('active'); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && searchOverlay.classList.contains('active')) searchOverlay.classList.remove('active'); });
  }

  /* --- Initial Cart Load --- */
  refreshCart();
});


  window.spAddWaterFromDrawer = function(btn) {
    btn.disabled = true;
    btn.textContent = '...';
    
    fetch('/?wc-ajax=add_to_cart', {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `product_id=25&quantity=1`
    })
    .then(r => r.json())
    .then(data => {
      if (data.fragments) {
        updateFromFragments(data.fragments);
        showToast('Agua Bacteriostatica agregada', 'success');
      } else {
        window.location.reload();
      }
    })
    .catch(() => {
      window.location.reload();
    });
  };


/* Spin animation */
const style = document.createElement('style');
style.textContent = '@keyframes sp-spin{to{transform:rotate(360deg)}}.sp-spin{animation:sp-spin .8s linear infinite}@keyframes slideIn{from{transform:translateX(100%);opacity:0}to{transform:translateX(0);opacity:1}}';
document.head.appendChild(style);


/* ==========================================================================
   REAL WOOCOMMERCE CART SYNC & DRAWER RENDERING (SWISS PEPTIDES 2026)
   ========================================================================== */
window.spFetchWCCart = function() {
  fetch('/?wc-ajax=get_refreshed_fragments', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
  })
  .then(res => res.json())
  .then(data => {
    if (data && data.fragments) {
      spUpdateCartDrawerFromAJAX();
    }
  })
  .catch(err => console.log('Cart fetch error', err));
};

window.spUpdateCartDrawerFromAJAX = function() {
  fetch('/cart/?sp_ajax_cart=1')
  .then(res => res.json())
  .then(data => {
    if (!data) return;
    const count = data.count || 0;
    const totalFormatted = data.total_formatted || ('$ ' + parseInt(data.total || 0).toLocaleString('es-CO'));

    // Update all count badges across header, navbar, floating widget
    const countElems = document.querySelectorAll('#cartCount, .cart-count, .floating-cart-count, #floatingCartCount');
    countElems.forEach(el => {
      el.textContent = count;
      el.style.display = (count > 0) ? 'flex' : 'none';
    });

    // Update all subtotal displays
    const subtotalElems = document.querySelectorAll('#floatingCartSubtotal, #cartTotalAmount, .cart-total-amount');
    subtotalElems.forEach(el => {
      el.textContent = totalFormatted;
    });

    // Update drawer body
    const body = document.getElementById('cartSidebarBody');
    if (!body) return;

    if (!data.items || data.items.length === 0) {
      body.innerHTML = `
        <div style="text-align:center;padding:60px 20px;color:#64748b;">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:12px;opacity:.5;"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
          <div style="font-size:1rem;font-weight:700;color:#0f172a;">Tu carrito está vacío</div>
        </div>`;
      return;
    }

    let itemsHtml = '';
    let hasWater = false;

    data.items.forEach(item => {
      if (item.name.toLowerCase().includes('bacteriost')) hasWater = true;

      itemsHtml += `
        <div style="display:flex;align-items:center;gap:12px;background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;padding:12px 14px;box-shadow:0 4px 12px rgba(15,23,42,0.03);margin-bottom:10px;box-sizing:border-box;">
          <div style="width:60px;height:60px;border-radius:12px;overflow:hidden;background:#ffffff;border:1px solid #e2e8f0;flex-shrink:0;">
            <img src="${item.image}" alt="${item.name}" style="width:100%;height:100%;object-fit:cover;">
          </div>
          <div style="flex:1;min-width:0;">
            <div style="font-weight:800;font-size:0.94rem;color:#0f172a;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${item.name}</div>
            <div style="font-size:0.78rem;color:#64748b;font-weight:600;margin-top:2px;">Cantidad: ${item.qty}</div>
            <div style="font-weight:800;font-size:0.94rem;color:#0284c7;margin-top:2px;">$ ${parseInt(item.subtotal).toLocaleString('es-CO')}</div>
          </div>
          <button type="button" onclick="spRemoveWCCartItem('${item.key}')" style="width:32px;height:32px;border-radius:10px;background:#fef2f2;border:1px solid #fecaca;color:#ef4444;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;" title="Eliminar">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
      `;
    });

    if (!hasWater) {
      itemsHtml += `
        <div style="background:#f0f9ff;border:1.5px solid #bae6fd;border-radius:16px;padding:14px;display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:8px;">
          <div style="width:40px;height:40px;border-radius:12px;background:#e0f2fe;color:#0284c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2v7.527a2 2 0 0 1-.211.896L4.72 20.55a1 1 0 0 0 .9 1.45h12.76a1 1 0 0 0 .9-1.45l-5.069-10.127A2 2 0 0 1 14 9.527V2q0-.41-.293-.707T13 1h-2q-.41 0-.707.293T10 2z"/></svg>
          </div>
          <div style="flex:1;min-width:0;">
            <div style="font-weight:800;font-size:0.85rem;color:#0f172a;">¿Necesitas Agua Bacteriostática?</div>
            <div style="font-size:0.78rem;font-weight:700;color:#0284c7;margin-top:2px;">30ml Grado Clínico — $ 75.000</div>
          </div>
          <button type="button" onclick="spAddAddonWater(this)" style="background:#0284c7;color:#ffffff;padding:8px 14px;border-radius:20px;font-weight:800;font-size:0.75rem;border:none;cursor:pointer;text-transform:uppercase;box-shadow:0 4px 12px rgba(2,132,199,0.25);flex-shrink:0;">
            + AGREGAR
          </button>
        </div>
      `;
    }

    body.innerHTML = itemsHtml;
  })
  .catch(err => console.log('Cart drawer update error', err));
};

window.spRemoveWCCartItem = function(key) {
  fetch('/?wc-ajax=remove_from_cart', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'cart_item_key=' + key
  })
  .then(() => spUpdateCartDrawerFromAJAX());
};

window.spAddAddonWater = function(btn) {
  if (btn) btn.textContent = '...';
  fetch('/?wc-ajax=add_to_cart', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'product_id=25&quantity=1'
  })
  .then(() => spUpdateCartDrawerFromAJAX());
};

// Auto fetch real cart on DOM ready
document.addEventListener('DOMContentLoaded', function() {
  spUpdateCartDrawerFromAJAX();

  var overlay = document.getElementById('overlay');
  var closeBtn = document.getElementById('cartCloseBtn');
  var sidebar = document.getElementById('cartSidebar');

  function openDrawer() {
    spUpdateCartDrawerFromAJAX();
    if (sidebar) sidebar.classList.add('active');
    if (overlay) overlay.classList.add('active');
  }

  function closeDrawer() {
    if (sidebar) sidebar.classList.remove('active');
    if (overlay) overlay.classList.remove('active');
  }

  if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
  if (overlay) overlay.addEventListener('click', closeDrawer);

  var toggles = document.querySelectorAll('#cartToggle, #floatingCartWidget, .open-cart-btn, [data-open-cart]');
  toggles.forEach(function(t) {
    t.addEventListener('click', function(e) {
      e.preventDefault();
      openDrawer();
    });
  });
});


// ALWAYS RE-FETCH FRESH CART DATA WHEN DRAWER OPENS OR PAGE LOADS
document.addEventListener('DOMContentLoaded', function() {
  document.body.addEventListener('click', function(e) {
    if (e.target.closest('.open-cart-btn, #openCartDrawerBtn, .floating-cart-widget, .header-cart-icon, .cart-icon-btn')) {
      if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
        window.spUpdateCartDrawerFromAJAX();
      }
    }
  });
  if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
    window.spUpdateCartDrawerFromAJAX();
  }
});


window.spAddToCart = function(productId, qty) {
    qty = qty || 1;
    fetch('/?wc-ajax=add_to_cart', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'product_id=' + encodeURIComponent(productId) + '&quantity=' + encodeURIComponent(qty)
    })
    .then(res => res.json())
    .then(data => {
        if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
            window.spUpdateCartDrawerFromAJAX();
        }
        if (typeof openCartSidebarDrawer === 'function') {
            openCartSidebarDrawer();
        } else {
            document.body.classList.add('cart-drawer-open');
        }
    })
    .catch(err => {
        if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
            window.spUpdateCartDrawerFromAJAX();
        }
        document.body.classList.add('cart-drawer-open');
    });
};
