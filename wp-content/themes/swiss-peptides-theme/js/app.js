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

    renderCartItems(items);

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
    const el = document.getElementById('cartCount');
    if (el) {
      el.textContent = count;
      el.style.display = count > 0 ? 'flex' : 'none';
    }
  }

  function renderCartItems(items) {
    const body = document.getElementById('cartSidebarBody');
    if (!body) return;

    if (!items || items.length === 0) {
      body.innerHTML = `<div style="text-align:center;padding:var(--space-3xl);color:var(--text-muted);">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin-bottom:16px;opacity:.4;">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
        </svg>
        <p>Tu carrito esta vacio</p>
      </div>`;
      return;
    }

    let htmlContent = items.map(item => `
      <div class="cart-item" style="display:flex;gap:var(--space-md);padding:var(--space-md);border-bottom:1px solid var(--border-subtle);">
        <div style="width:64px;height:64px;border-radius:var(--radius-md);overflow:hidden;flex-shrink:0;background:var(--gray-50);border:1px solid var(--border-color);">
          <img src="${item.image}" alt="${item.name}" style="width:100%;height:100%;object-fit:contain;">
        </div>
        <div style="flex:1;min-width:0;">
          <div style="font-weight:600;color:var(--navy);font-size:var(--fs-sm);line-height:1.3;">${item.name}</div>
          <div style="font-size:var(--fs-xs);color:var(--text-muted);margin-top:4px;">${item.price}</div>
          <div style="font-size:var(--fs-xs);color:var(--gray-500);margin-top:2px;">Cant: ${item.qty}</div>
        </div>
        <div style="text-align:right;display:flex;flex-direction:column;justify-content:space-between;">
          ${item.removeUrl ? `<button type="button" class="sp-cart-remove-btn-icon" style="width:32px;height:32px;border-radius:10px;background:#fef2f2;border:1px solid #fecaca;color:#ef4444;display:flex;align-items:center;justify-content:center;cursor:pointer;" onclick="event.preventDefault();event.stopPropagation();spRemoveItemByUrl('${item.removeUrl}');" title="Eliminar"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>` : ''}
        </div>
      </div>
    `).join('');

    const hasWater = items.some(item => item.name.toLowerCase().includes('bacteriost'));
    if (!hasWater && items.length > 0) {
      htmlContent += `
        <div class="cart-upsell-card" style="margin:var(--space-md);padding:var(--space-md);background:var(--teal-light);border:1.5px dashed var(--accent);border-radius:var(--radius-lg);display:flex;gap:var(--space-sm);align-items:center;">
          <div style="font-size:24px;flex-shrink:0;">🧪</div>
          <div style="flex:1;min-width:0;font-size:var(--fs-xs);line-height:1.4;color:var(--navy);">
            <div style="font-weight:700;margin-bottom:2px;">¿Olvidaste el Agua Bacteriostática?</div>
            <div>Requerida para reconstituir tus péptidos.</div>
            <div style="font-weight:700;margin-top:4px;color:var(--accent-dark);">$ 75.000</div>
          </div>
          <button type="button" class="btn btn-accent btn-sm" style="padding:6px 12px;font-size:11px;flex-shrink:0;" onclick="spAddWaterFromDrawer(this);">
            Agregar
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
