<?php
/**
 * Template Name: Front Page Master 2026
 * Description: 100vh Minimalist Hero + Master Catalog (Light) + Calculator (Light Ice) + Quality (Dark Navy) + Contact (Light White)
 */
get_header();
?>

<style>
:root {
    --cyan-accent: #00a8ff;
    --medical-navy: #070f1e;
    --text-slate: #cbd5e1;
    --border-subtle: rgba(255, 255, 255, 0.15);
}

.exact-hero-container {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 720px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    background-color: #070f1e;
}

.exact-hero-video {
    position: absolute;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    transform: translate(-50%, -50%);
    object-fit: cover;
    z-index: 1;
}

.exact-hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, rgba(11, 26, 48, 0.40) 0%, rgba(7, 15, 30, 0.88) 100%),
                linear-gradient(180deg, rgba(7, 15, 30, 0.50) 0%, rgba(7, 15, 30, 0.85) 100%);
    z-index: 2;
}

.exact-hero-content {
    position: relative;
    z-index: 3;
    max-width: 860px;
    text-align: center;
    padding: 0 24px;
    margin-top: 40px;
}

.exact-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(11, 26, 48, 0.65);
    border: 1px solid var(--cyan-accent);
    border-radius: 50px;
    padding: 7px 22px;
    font-size: 12px;
    font-weight: 700;
    color: var(--cyan-accent);
    letter-spacing: 1.2px;
    text-transform: uppercase;
    margin-bottom: 28px;
    backdrop-filter: blur(10px);
    box-shadow: 0 0 15px rgba(0, 168, 255, 0.2);
}

.exact-hero-title {
    font-size: 64px;
    font-weight: 900;
    line-height: 1.1;
    margin-bottom: 22px;
    letter-spacing: -0.03em;
}

.exact-hero-title .line-white {
    color: #ffffff !important;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.9);
}

.exact-hero-title .line-cyan {
    color: #00a8ff !important;
    text-shadow: 0 0 25px rgba(0, 168, 255, 0.5);
}

.exact-hero-sub {
    font-size: 18px;
    color: #e2e8f0;
    max-width: 720px;
    margin: 0 auto 32px auto;
    line-height: 1.65;
    font-weight: 400;
    text-shadow: 0 2px 10px rgba(0,0,0,0.8);
}

.exact-checklist {
    display: flex;
    justify-content: center;
    gap: 28px;
    flex-wrap: wrap;
    margin-bottom: 36px;
    font-size: 14px;
    font-weight: 600;
    color: #ffffff;
    text-shadow: 0 2px 8px rgba(0,0,0,0.8);
}

.exact-checklist span {
    display: flex;
    align-items: center;
    gap: 6px;
}

.exact-hero-btns {
    display: flex;
    gap: 18px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-exact-cyan {
    background: #00a8ff;
    color: #ffffff;
    padding: 16px 36px;
    border-radius: 10px;
    font-weight: 800;
    font-size: 16px;
    text-decoration: none;
    box-shadow: 0 8px 25px rgba(0, 168, 255, 0.4);
    transition: all 0.25s ease;
    border: none;
}

.btn-exact-cyan:hover {
    background: #0095e0;
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(0, 168, 255, 0.6);
    color: #ffffff;
}

.btn-exact-navy {
    background: #070f1e;
    color: #ffffff;
    padding: 16px 36px;
    border-radius: 10px;
    font-weight: 800;
    font-size: 16px;
    text-decoration: none;
    box-shadow: 0 8px 25px rgba(7, 15, 30, 0.25);
    transition: all 0.25s ease;
    border: none;
}

.btn-exact-navy:hover {
    background: #00a8ff;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(0, 168, 255, 0.4);
}

.btn-exact-outline {
    background: rgba(11, 26, 48, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.35);
    color: #ffffff;
    padding: 16px 36px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 16px;
    text-decoration: none;
    backdrop-filter: blur(8px);
    transition: all 0.25s ease;
}

.btn-exact-outline:hover {
    background: rgba(11, 26, 48, 0.9);
    border-color: #ffffff;
    transform: translateY(-2px);
    color: #ffffff;
}

.btn-exact-outline-dark {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    color: #0f172a;
    padding: 16px 36px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.25s ease;
}

.btn-exact-outline-dark:hover {
    background: #f1f5f9;
    border-color: #070f1e;
    color: #070f1e;
    transform: translateY(-2px);
}

.exact-bottom-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(7, 15, 30, 0.92);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    z-index: 4;
    padding: 14px 0;
    overflow: hidden;
}

.exact-ticker-flex {
    display: flex;
    justify-content: space-around;
    align-items: center;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 20px;
    color: #cbd5e1;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
}

.exact-ticker-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.section-space { padding: 90px 24px; position: relative; overflow: hidden; }
.bg-white { background-color: #ffffff; }
.bg-ice-light { background-color: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; }

.sec-title-box { text-align: center; max-width: 820px; margin: 0 auto 36px auto; position: relative; z-index: 2; }
.sec-tag { color: #00a8ff; font-size: 12px; font-weight: 800; letter-spacing: 1.8px; text-transform: uppercase; margin-bottom: 12px; background: rgba(0,168,255,0.08); display: inline-block; padding: 6px 16px; border-radius: 50px; }
.sec-h2 { font-size: 42px; font-weight: 800; color: #0f172a; margin-bottom: 14px; letter-spacing: -0.02em; line-height: 1.15; transition: all 0.3s ease; }
.sec-p { font-size: 16px; color: #64748b; line-height: 1.65; transition: all 0.3s ease; }

@media (max-width: 768px) {
    .exact-hero-title { font-size: 38px; }
    .exact-hero-sub { font-size: 15px; }
    .exact-bottom-bar { display: none; }
    .sec-h2 { font-size: 30px; }
}
</style>

<!-- HERO SECTION (DARK 100VH VIDEO) -->
<section class="exact-hero-container">
    <video autoplay loop muted playsinline class="exact-hero-video">
        <source src="<?php echo get_template_directory_uri(); ?>/video/hero-visual.mp4" type="video/mp4">
    </video>
    <div class="exact-hero-overlay"></div>
    
    <div class="exact-hero-content">
        <div class="exact-badge">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle></svg>
            LABORATORIO CLÍNICO SUIZO<br><span style="color:#00a8ff;font-weight:800;">PUREZA CERTIFICADA</span>
        </div>
        
        <h1 class="exact-hero-title">
            <span class="line-white">Ciencia Suiza.</span><br>
            <span class="line-cyan">Pureza Absoluta.</span>
        </h1>
        
        <p class="exact-hero-sub">
            Proveedor exclusivo en Colombia de péptidos de ultra-alta pureza (HPLC ≥99%). Diseñados para investigación científica avanzada con máxima precisión.
        </p>
        
        <div class="exact-checklist">
            <span><svg width="16" height="16" fill="none" stroke="#00a8ff" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> Envío Express Gratis</span>
            <span><svg width="16" height="16" fill="none" stroke="#00a8ff" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> Hasta 25% OFF por Volumen</span>
            <span><svg width="16" height="16" fill="none" stroke="#00a8ff" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> Análisis HPLC Incluido</span>
        </div>
        
        <div class="exact-hero-btns">
            <a href="#catalogo" class="btn-exact-cyan">Explorar Catálogo</a>
            <a href="/calculadora/" class="btn-exact-outline">Calculadora de Mezcla</a>
        </div>
    </div>
    
    <!-- BOTTOM TICKER BAR -->
    <div class="exact-bottom-bar">
        <div class="exact-ticker-flex">
            <div class="exact-ticker-item">
                <svg width="14" height="14" fill="none" stroke="#00a8ff" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
                CALIDAD DE GRADO CLÍNICO SUIZO
            </div>
            <div class="exact-ticker-item">
                <svg width="14" height="14" fill="none" stroke="#00a8ff" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                ENVÍO EXPRESS GRATUITO EN COLOMBIA
            </div>
            <div class="exact-ticker-item">
                <svg width="14" height="14" fill="none" stroke="#00a8ff" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                PUREZA ≥99% HPLC VERIFICADA
            </div>
        </div>
    </div>
</section>

<!-- SECTION 1: MASTER CATALOG SECTION (LIGHT WHITE BACKGROUND) -->
<section class="section-space bg-white" id="catalogo">
    <div class="sec-title-box">
        <div class="sec-tag" id="catalogSecTag">EFECTIVIDAD Y PUREZA CLÍNICA SUIZA</div>
        <h2 class="sec-h2" id="catalogSecTitle">Catálogo General de Péptidos</h2>
        <p class="sec-p" id="catalogSecDesc">Explora todas nuestras 40 fórmulas con certificación HPLC ≥99%. Potencia tus resultados con biotecnología de grado médico y máxima efectividad.</p>
    </div>

    <!-- CATEGORY FILTER BAR -->
    <div class="catalog-filter-bar">
        <button type="button" class="cat-filter-btn active" onclick="filterCatalog('all', this)">Todos los Péptidos</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Pérdida de Peso', this)">Pérdida de Peso</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Masa Muscular', this)">Masa Muscular</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Salud Celular', this)">Salud Celular</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Longevidad & Piel', this)">Longevidad & Piel</button>
        <button type="button" class="cat-filter-btn" onclick="filterCatalog('Sueño & Bienestar', this)">Sueño & Bienestar</button>
    </div>

    <!-- DYNAMIC JS CATALOG GRID -->
    <div id="mainCatalogGrid"></div>

    <!-- LOAD MORE BUTTON (MANUAL CLICK ONLY) -->
    <div style="text-align:center;margin-top:50px;">
        <button type="button" id="loadMoreCatalogBtn" onclick="loadMoreProducts()" class="cat-filter-btn" style="padding:14px 36px;font-size:14px;background:#070f1e;color:#fff;">
            Cargar Más Productos
        </button>
    </div>
</section>

<!-- SECTION 2: INTERACTIVE CALCULATOR PREVIEW (LIGHT SOFT ICE BLUE BACKGROUND + AMBIENT LAB EQUIPMENT IMAGE) -->
<section class="section-space bg-ice-light" id="calculadora-preview">
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:url('/wp-content/uploads/2026/07/lab_biotech_equipment.jpg') center/cover no-repeat;opacity:0.07;pointer-events:none;"></div>
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:radial-gradient(circle at center, rgba(248,250,252,0.6) 0%, #f8fafc 100%);pointer-events:none;"></div>

    <div class="sec-title-box">
        <div class="sec-tag" style="background:rgba(0,168,255,0.1);color:#00a8ff;">DOSIFICACIÓN EXACTA EN SEGUNDOS</div>
        <h2 class="sec-h2" style="color:#0f172a;">Calculadora de Mezcla & Reconstitución Peptídica</h2>
        <p class="sec-p" style="color:#475569;">¿No sabes cómo calcular la dilución exacta de tu vial? Nuestra herramienta convierte automáticamente miligramos (mg), mililitros de agua bacteriostática (ml) y unidades de jeringa (UI) para una aplicación precisa y segura.</p>
    </div>

    <div style="max-width:1000px;margin:0 auto;background:#ffffff;border:1px solid #e2e8f0;border-radius:20px;padding:40px 30px;box-shadow:0 15px 45px rgba(7,15,30,0.06);position:relative;z-index:2;">
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:24px;margin-bottom:32px;text-align:center;">
            <div style="background:#f8fafc;padding:22px 18px;border-radius:14px;border:1px solid #cbd5e1;">
                <div style="font-size:12px;color:#00a8ff;font-weight:800;letter-spacing:1px;margin-bottom:6px;">PASO 1</div>
                <div style="font-size:16px;font-weight:800;color:#0f172a;">Ingresa los mg del Vial</div>
                <div style="font-size:13px;color:#64748b;margin-top:4px;">Ejemplo: 5 mg o 10 mg</div>
            </div>

            <div style="background:#f8fafc;padding:22px 18px;border-radius:14px;border:1px solid #cbd5e1;">
                <div style="font-size:12px;color:#00a8ff;font-weight:800;letter-spacing:1px;margin-bottom:6px;">PASO 2</div>
                <div style="font-size:16px;font-weight:800;color:#0f172a;">Añade los ml de Agua</div>
                <div style="font-size:13px;color:#64748b;margin-top:4px;">Ejemplo: 2 ml de Agua Bac</div>
            </div>

            <div style="background:#f8fafc;padding:22px 18px;border-radius:14px;border:1px solid #cbd5e1;">
                <div style="font-size:12px;color:#00a8ff;font-weight:800;letter-spacing:1px;margin-bottom:6px;">PASO 3</div>
                <div style="font-size:16px;font-weight:800;color:#0f172a;">Obtén UI en tu Jeringa</div>
                <div style="font-size:13px;color:#64748b;margin-top:4px;">Ejemplo: 250 mcg = 10 UI</div>
            </div>
        </div>

        <div style="text-align:center;">
            <a href="/calculadora/" class="btn-exact-navy" style="display:inline-flex;align-items:center;gap:10px;font-size:17px;padding:18px 40px;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="16" y1="14" x2="16" y2="18"/><line x1="8" y1="10" x2="8.01" y2="10"/><line x1="12" y1="10" x2="12.01" y2="10"/><line x1="16" y1="10" x2="16.01" y2="10"/><line x1="8" y1="14" x2="8.01" y2="14"/><line x1="12" y1="14" x2="12.01" y2="14"/><line x1="8" y1="18" x2="8.01" y2="18"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                Usar Calculadora de Mezcla Gratis
            </a>
        </div>
    </div>
</section>

<!-- SECTION 3: ESTÁNDAR DE CALIDAD & PROCESO CLÍNICO SUIZO (DEEP NAVY LUXURY DARK + SCIENTIST AMBIENT IMAGE) -->
<section class="section-space" style="background:#070f1e;color:#ffffff;" id="garantia">
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:url('/wp-content/uploads/2026/07/lab_swiss_scientist.jpg') center/cover no-repeat;opacity:0.14;pointer-events:none;"></div>
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:radial-gradient(circle at center, rgba(7,15,30,0.5) 0%, #070f1e 100%);pointer-events:none;"></div>
    
    <div class="sec-title-box">
        <div class="sec-tag" style="background:rgba(0,168,255,0.15);color:#00a8ff;">GARANTÍA DE BIOTECNOLOGÍA SUIZA</div>
        <h2 class="sec-h2" style="color:#ffffff;">Estándar de Calidad & Proceso Clínico</h2>
        <p class="sec-p" style="color:#cbd5e1;">Nuestras instalaciones aplican los protocolos más rigurosos de síntesis peptídica y purificación para asegurar resultados de grado médico en Colombia.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:28px;max-width:1280px;margin:0 auto;position:relative;z-index:2;">
        <div style="background:rgba(11,26,48,0.85);border:1px solid rgba(255,255,255,0.12);padding:32px 24px;border-radius:16px;backdrop-filter:blur(12px);">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(0,168,255,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="24" height="24" fill="none" stroke="#00a8ff" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
            </div>
            <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;color:#fff;">Pureza Certificada HPLC ≥99%</h3>
            <p style="font-size:14px;color:#cbd5e1;line-height:1.6;">Cada lote es sometido a espectrometría de masas y cromatografía líquida de alta resolución para garantizar cero impurezas endotóxicas.</p>
        </div>

        <div style="background:rgba(11,26,48,0.85);border:1px solid rgba(255,255,255,0.12);padding:32px 24px;border-radius:16px;backdrop-filter:blur(12px);">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(0,168,255,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="24" height="24" fill="none" stroke="#00a8ff" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            </div>
            <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;color:#fff;">Cadena de Frío & Steri-Pack</h3>
            <p style="font-size:14px;color:#cbd5e1;line-height:1.6;">Liofilizado al vacío bajo atmósfera inerte de nitrógeno y sellado hermético en viales de vidrio borosilicato de grado farmacéutico.</p>
        </div>

        <div style="background:rgba(11,26,48,0.85);border:1px solid rgba(255,255,255,0.12);padding:32px 24px;border-radius:16px;backdrop-filter:blur(12px);">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(0,168,255,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="24" height="24" fill="none" stroke="#00a8ff" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            </div>
            <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;color:#fff;">Envíos Express Colombia 24/48h</h3>
            <p style="font-size:14px;color:#cbd5e1;line-height:1.6;">Despacho prioritario asegurado desde Bogotá y Medellín con rastreo en tiempo real y empaque térmico protector gratis.</p>
        </div>

        <div style="background:rgba(11,26,48,0.85);border:1px solid rgba(255,255,255,0.12);padding:32px 24px;border-radius:16px;backdrop-filter:blur(12px);">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(0,168,255,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="24" height="24" fill="none" stroke="#00a8ff" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
            </div>
            <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;color:#fff;">Asesoría VIP & Calculadora</h3>
            <p style="font-size:14px;color:#cbd5e1;line-height:1.6;">Acceso gratuito a nuestra herramienta interactiva de mezcla con agua bacteriostática y soporte directo por WhatsApp.</p>
        </div>
    </div>
</section>

<!-- SECTION 4: ASESORÍA VIP & CONTACTO CTA (LIGHT FRESH WHITE BACKGROUND + MOLECULAR BACKGROUND) -->
<section class="section-space bg-white" id="contacto-cta" style="border-top:1px solid #e2e8f0;">
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:url('/wp-content/uploads/2026/07/lab_molecular_bg.jpg') center/cover no-repeat;opacity:0.06;pointer-events:none;"></div>
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:radial-gradient(circle at center, rgba(255,255,255,0.7) 0%, #ffffff 100%);pointer-events:none;"></div>

    <div style="max-width:1000px;margin:0 auto;text-align:center;position:relative;z-index:2;">
        <div class="sec-tag" style="background:rgba(0,168,255,0.1);color:#00a8ff;">ATENCIÓN PERSONALIZADA COLOMBIA</div>
        <h2 class="sec-h2" style="color:#0f172a;">¿Tienes Dudas sobre tu Esquema o Pedido Especial?</h2>
        <p class="sec-p" style="color:#475569;max-width:750px;margin:0 auto 36px auto;">Nuestro equipo técnico te brinda asesoría científica para resolver dudas sobre protocolos de conservación, combinaciones peptídicas y despachos al por mayor en todo el país.</p>
        
        <div style="display:flex;gap:20px;justify-content:center;flex-wrap:wrap;">
            <a href="https://wa.me/573189163091?text=Hola%2C%20quiero%20asesoria%20tecnica%20sobre%20sus%20peptidos" target="_blank" class="btn-exact-cyan" style="display:inline-flex;align-items:center;gap:10px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                Hablar con Asesor VIP por WhatsApp
            </a>
            <a href="/contacto/" class="btn-exact-outline-dark">
                Formulario de Contacto
            </a>
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

<script src="<?php echo get_template_directory_uri(); ?>/js/interactive-catalog.js?v=1785444306_<?php echo time(); ?>"></script>

<?php get_footer(); ?>
