  </main>

  <style>
  /* MOBILE FOOTER PERFECT CENTER ALIGNMENT */
  @media (max-width: 768px) {
      .master-luxury-footer {
          text-align: center !important;
          padding: 60px 20px 30px 20px !important;
      }
      .footer-grid-container {
          grid-template-columns: 1fr !important;
          text-align: center !important;
          gap: 36px !important;
      }
      .footer-brand-col {
          grid-column: span 1 !important;
          display: flex !important;
          flex-direction: column !important;
          align-items: center !important;
          text-align: center !important;
      }
      .footer-brand-col p {
          margin-left: auto !important;
          margin-right: auto !important;
      }
      .footer-badges-flex {
          justify-content: center !important;
      }
      .footer-col-item {
          display: flex !important;
          flex-direction: column !important;
          align-items: center !important;
          text-align: center !important;
      }
      .footer-col-item ul {
          align-items: center !important;
          text-align: center !important;
      }
      .footer-bottom-flex {
          flex-direction: column !important;
          text-align: center !important;
          justify-content: center !important;
          gap: 12px !important;
      }
  }
  </style>

  <!-- MASTER 2026 LUXURY FOOTER -->
  <footer class="master-luxury-footer" style="background:#050b14;color:#cbd5e1;padding:80px 24px 30px 24px;border-top:1px solid rgba(255,255,255,0.08);position:relative;">
    <div style="max-width:1280px;margin:0 auto;">
      <div class="footer-grid-container" style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:40px;margin-bottom:60px;">
        
        <!-- COL 1: BRAND -->
        <div class="footer-brand-col" style="grid-column: span 2;">
          <a href="<?php echo home_url(); ?>" style="display:inline-block;margin-bottom:20px;">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo/logo_swiss.png" alt="Swiss Peptides Labs" style="height:38px;width:auto;">
          </a>
          <p style="font-size:14px;color:#94a3b8;line-height:1.65;max-width:420px;margin-bottom:24px;">
            Proveedor exclusivo en Colombia de Swiss Peptides Labs. Líder en biotecnología de síntesis peptídica con pureza certificada HPLC ≥99% para investigación científica y médica avanzada.
          </p>
          <div class="footer-badges-flex" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
            <span style="background:rgba(0,168,255,0.1);color:#00a8ff;border:1px solid rgba(0,168,255,0.25);padding:6px 14px;border-radius:50px;font-size:11px;font-weight:700;">PUREZA ≥99% HPLC</span>
            <span style="background:rgba(255,255,255,0.05);color:#e2e8f0;border:1px solid rgba(255,255,255,0.15);padding:6px 14px;border-radius:50px;font-size:11px;font-weight:700;">ENVÍOS COLOMBIA</span>
          </div>
        </div>

        <!-- COL 2: CATEGORÍAS -->
        <div class="footer-col-item">
          <h4 style="font-size:16px;font-weight:800;color:#ffffff;margin-bottom:20px;letter-spacing:0.5px;text-transform:uppercase;">Categorías</h4>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;font-size:14px;">
            <li><a href="#catalogo" onclick="filterCatalog('Pérdida de Peso')" style="color:#cbd5e1;text-decoration:none;transition:color 0.2s;">Pérdida de Peso</a></li>
            <li><a href="#catalogo" onclick="filterCatalog('Masa Muscular')" style="color:#cbd5e1;text-decoration:none;transition:color 0.2s;">Masa Muscular & Fuerza</a></li>
            <li><a href="#catalogo" onclick="filterCatalog('Salud Celular')" style="color:#cbd5e1;text-decoration:none;transition:color 0.2s;">Salud Celular & Energía</a></li>
            <li><a href="#catalogo" onclick="filterCatalog('Longevidad & Piel')" style="color:#cbd5e1;text-decoration:none;transition:color 0.2s;">Longevidad & Piel</a></li>
            <li><a href="#catalogo" onclick="filterCatalog('Sueño & Bienestar')" style="color:#cbd5e1;text-decoration:none;transition:color 0.2s;">Sueño & Bienestar</a></li>
          </ul>
        </div>

        <!-- COL 3: RECURSOS Y HERRAMIENTAS -->
        <div class="footer-col-item">
          <h4 style="font-size:16px;font-weight:800;color:#ffffff;margin-bottom:20px;letter-spacing:0.5px;text-transform:uppercase;">Herramientas</h4>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;font-size:14px;">
            <li><a href="/calculadora/" style="color:#cbd5e1;text-decoration:none;">Calculadora de Mezcla</a></li>
            <li><a href="/nosotros/" style="color:#cbd5e1;text-decoration:none;">Sobre Nosotros</a></li>
            <li><a href="/contacto/" style="color:#cbd5e1;text-decoration:none;">Contacto VIP</a></li>
            <li><a href="#catalogo" style="color:#cbd5e1;text-decoration:none;">Catálogo Completo</a></li>
          </ul>
        </div>

        <!-- COL 4: CONTACTO VIP -->
        <div class="footer-col-item">
          <h4 style="font-size:16px;font-weight:800;color:#ffffff;margin-bottom:20px;letter-spacing:0.5px;text-transform:uppercase;">Atención VIP</h4>
          <p style="font-size:13px;color:#94a3b8;margin-bottom:14px;line-height:1.5;">Atención personalizada para asesoría de productos y pedidos al por mayor.</p>
          <a href="https://wa.me/573189163091?text=Hola%2C%20quiero%20asesor%C3%ADa%20sobre%20p%C3%A9ptidos" target="_blank" rel="noopener" class="btn-ws-order" style="display:inline-flex;align-items:center;gap:8px;background:#25d366;color:#ffffff;padding:12px 22px;border-radius:8px;font-size:14px;font-weight:700;text-decoration:none;transition:all 0.2s ease;box-shadow:0 4px 12px rgba(37,211,102,0.25);">
            <svg viewBox="0 0 24 24" width="18" height="18"><path fill="white" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            WhatsApp Directo
          </a>
        </div>

      </div>

      <!-- FOOTER BOTTOM BAR -->
      <div class="footer-bottom-flex" style="border-top:1px solid rgba(255,255,255,0.08);padding-top:30px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;font-size:13px;color:#64748b;">
        <div>
          © 2026 Swiss Peptides Labs Colombia. Todos los derechos reservados.
        </div>
        <div style="display:flex;gap:20px;">
          <span>Bogotá • Medellín • Cali • Barranquilla</span>
        </div>
      </div>
    </div>
  </footer>

  
  

  
  <!-- MASTER PERFECT GLOBAL FLOATING CART WIDGET -->
  <?php
  $sp_f_count = 0;
  $sp_f_subtotal = 0;
  if (function_exists('WC') && WC()->cart) {
      $sp_f_count = WC()->cart->get_cart_contents_count();
      $sp_f_subtotal = (float) WC()->cart->get_cart_contents_total();
  }
  ?>
  <a href="#" class="floating-cart-widget open-cart-btn" id="floatingCartWidget" style="position:fixed;bottom:24px;right:24px;z-index:999999;background:#050b14!important;border:1.5px solid #00a8ff!important;border-radius:50px!important;padding:8px 16px!important;display:flex!important;align-items:center!important;gap:10px!important;text-decoration:none!important;box-shadow:0 10px 30px rgba(0,168,255,0.3)!important;transition:all 0.3s ease!important;">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2.2" style="flex-shrink:0;"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
      <span id="floatingCartSubtotal" style="color:#00a8ff!important;font-weight:800!important;font-size:0.95rem!important;white-space:nowrap!important;">$ <?php echo number_format($sp_f_subtotal, 0, ',', '.'); ?></span>
      <span class="floating-cart-badge floating-cart-count" id="floatingCartCount" style="<?php echo ($sp_f_count > 0) ? 'display:flex;' : 'display:none;'; ?>min-width:28px!important;height:28px!important;padding:0 8px!important;border-radius:50px!important;font-size:12px!important;background:#00a8ff!important;color:#ffffff!important;font-size:11px!important;font-weight:800!important;align-items:center!important;justify-content:center!important;padding:0!important;margin:0!important;box-sizing:border-box!important;line-height:1!important;flex-shrink:0!important;"><?php echo $sp_f_count; ?></span>
  </a>

  <?php wp_footer(); ?>
</body>
</html>