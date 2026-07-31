<?php
/**
 * Template Name: Nosotros Master 2026
 * Description: Ultra-luxury About Us page for Swiss Peptides Labs
 */
get_header();
$theme_uri = get_template_directory_uri();
?>

<style>
/* NOSOTROS PAGE DESIGN SYSTEM 2026 */
.sp-nos-hero {
    background: linear-gradient(180deg, rgba(7,15,30,0.85) 0%, rgba(11,26,48,0.96) 100%),
                url('<?php echo $theme_uri; ?>/img/hero/hero-scientists.png') center/cover no-repeat;
    color: #ffffff;
    padding: 120px 24px 70px 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sp-nos-hero-content {
    position: relative;
    z-index: 2;
    max-width: 850px;
    margin: 0 auto;
}

.sp-nos-badge {
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
    margin-bottom: 20px;
}

.sp-nos-hero h1 {
    font-size: 46px;
    font-weight: 900;
    line-height: 1.15;
    margin-bottom: 18px;
    letter-spacing: -0.02em;
    color: #ffffff;
}

.sp-nos-hero p {
    font-size: 17px;
    color: #cbd5e1;
    line-height: 1.65;
    max-width: 720px;
    margin: 0 auto;
}

/* SECTION CONTAINERS */
.sp-nos-section {
    padding: 80px 24px;
    background: #ffffff;
    color: #0f172a;
}

.sp-nos-section-gray {
    padding: 80px 24px;
    background: #f8fafc;
    color: #0f172a;
}

.sp-nos-container {
    max-width: 1240px;
    margin: 0 auto;
}

/* ABOUT GRID */
.sp-about-grid {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 50px;
    align-items: center;
}

.sp-about-text h2 {
    font-size: 34px;
    font-weight: 900;
    color: #0f172a;
    line-height: 1.25;
    margin: 0 0 20px 0;
    letter-spacing: -0.01em;
}

.sp-about-text p {
    font-size: 15.5px;
    color: #475569;
    line-height: 1.7;
    margin-bottom: 18px;
}

.sp-about-img-card {
    border-radius: 24px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    box-shadow: 0 20px 50px rgba(7, 15, 30, 0.08);
    position: relative;
}

.sp-about-img-card img {
    width: 100%;
    height: 480px;
    object-fit: cover;
    display: block;
}

.sp-about-img-badge {
    position: absolute;
    bottom: 20px;
    left: 20px;
    right: 20px;
    background: rgba(7, 15, 30, 0.88);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(0, 168, 255, 0.3);
    padding: 16px 20px;
    border-radius: 16px;
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 700;
}

/* KPI STATS GRID */
.sp-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

.sp-stat-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 32px 24px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(7, 15, 30, 0.03);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.sp-stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 40px rgba(7, 15, 30, 0.08);
}

.sp-stat-val {
    font-size: 40px;
    font-weight: 900;
    color: #00a8ff;
    line-height: 1;
    margin-bottom: 8px;
}

.sp-stat-label {
    font-size: 13.5px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 4px;
}

.sp-stat-sub {
    font-size: 12px;
    color: #64748b;
    line-height: 1.45;
}

/* CERTS GRID */
.sp-certs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
    margin-top: 40px;
}

.sp-cert-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 36px 28px;
    text-align: left;
    box-shadow: 0 10px 30px rgba(7, 15, 30, 0.03);
    transition: all 0.25s ease;
}

.sp-cert-card:hover {
    transform: translateY(-4px);
    border-color: #00a8ff;
    box-shadow: 0 15px 40px rgba(0, 168, 255, 0.12);
}

.sp-cert-icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    background: rgba(0, 168, 255, 0.08);
    border: 1.5px solid rgba(0, 168, 255, 0.25);
    color: #00a8ff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.sp-cert-card h3 {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px 0;
}

.sp-cert-card p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* VALUES PILLARS */
.sp-values-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

.sp-value-item {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 24px;
    display: flex;
    gap: 18px;
    align-items: flex-start;
    box-shadow: 0 6px 20px rgba(7, 15, 30, 0.03);
}

.sp-value-num {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #070f1e;
    color: #00a8ff;
    font-size: 18px;
    font-weight: 900;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.sp-value-content h4 {
    font-size: 17px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px 0;
}

.sp-value-content p {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.55;
    margin: 0;
}

/* CTA BOX */
.sp-nos-cta {
    background: linear-gradient(135deg, #070f1e 0%, #0b1a30 100%);
    color: #ffffff;
    padding: 80px 24px;
    text-align: center;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.sp-nos-cta-box {
    max-width: 850px;
    margin: 0 auto;
}

.sp-nos-cta h2 {
    font-size: 36px;
    font-weight: 900;
    color: #ffffff;
    margin: 0 0 16px 0;
    letter-spacing: -0.02em;
}

.sp-nos-cta p {
    font-size: 16px;
    color: #cbd5e1;
    max-width: 650px;
    margin: 0 auto 32px auto;
    line-height: 1.65;
}

.sp-nos-cta-btns {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}

/* RESPONSIVE MEDIA QUERIES */
@media (max-width: 1024px) {
    .sp-stats-grid { grid-template-columns: repeat(2, 1fr); }
    .sp-certs-grid { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
    .sp-nos-hero { padding: 90px 16px 40px 16px; }
    .sp-nos-hero h1 { font-size: 30px; line-height: 1.2; }
    .sp-nos-hero p { font-size: 14.5px; }
    .sp-nos-section, .sp-nos-section-gray { padding: 50px 16px; }
    .sp-about-grid { grid-template-columns: 1fr; gap: 30px; }
    .sp-about-text h2 { font-size: 26px; }
    .sp-about-img-card img { height: 320px; }
    .sp-values-grid { grid-template-columns: 1fr; gap: 16px; }
    .sp-stats-grid { grid-template-columns: 1fr 1fr; gap: 14px; }
    .sp-nos-cta { padding: 50px 16px; }
    .sp-nos-cta h2 { font-size: 26px; }
    .sp-nos-cta-btns a { width: 100%; box-sizing: border-box; }
}
</style>

<!-- HERO HEADER -->
<section class="sp-nos-hero">
    <div class="sp-nos-hero-content">
        <span class="sp-nos-badge">MÁXIMA PUREZA HPLC ≥99% · ALLSCHWIL, SUIZA</span>
        <h1>Swiss Peptides Labs<br><span style="color:#00a8ff;">Excelencia Biotecnológica</span> en Colombia</h1>
        <p>Pioneros en la distribución autorizada de compuestos peptídicos de alta fidelidad científica, respaldados por rigurosos análisis de calidad en laboratorio.</p>
    </div>
</section>

<!-- ABOUT / WHO WE ARE -->
<section class="sp-nos-section">
    <div class="sp-nos-container">
        <div class="sp-about-grid">
            
            <div class="sp-about-text">
                <span class="sp-nos-badge" style="margin-bottom:12px;">DISTRIBUIDOR EXCLUSIVO AUTORIZADO</span>
                <h2>Biología Molecular de Alta Precisión</h2>
                <p><strong>Swiss Peptides Colombia</strong> es el representante oficial y distribuidor exclusivo en Colombia de <strong>Swiss Peptides Labs</strong>, laboratorio biotecnológico suizo con sede en Allschwil, ampliamente reconocido por sintetizar cadenas peptídicas de máxima pureza para investigación médica y científica.</p>
                <p>Nuestra infraestructura logística está diseñada para preservar la integridad biológica de cada molécula mediante empaques térmicos especializados y controles de temperatura continua durante la cadena de transporte nacional.</p>
                <p>Proporcionamos a investigadores, profesionales clínicos e instituciones el catálogo más completo de péptidos en Colombia, incluyendo COA verificado por laboratorios independientes.</p>
            </div>

            <div class="sp-about-img-card">
                <img src="<?php echo $theme_uri; ?>/img/hero/hero-scientists.png" alt="Swiss Peptides Labs - Equipo Científico">
                <div class="sp-about-img-badge">
                    📍 Allschwil, Suiza — Sede Central de Producción & Control de Calidad
                </div>
            </div>

        </div>
    </div>
</section>

<!-- KPI STATS COUNTER -->
<section class="sp-nos-section-gray">
    <div class="sp-nos-container">
        <div class="sp-stats-grid">
            
            <div class="sp-stat-card">
                <div class="sp-stat-val">40+</div>
                <div class="sp-stat-label">Fórmulas Activas</div>
                <div class="sp-stat-sub">Catálogo completo disponible en Colombia</div>
            </div>

            <div class="sp-stat-card">
                <div class="sp-stat-val">≥99%</div>
                <div class="sp-stat-label">Pureza Certificada</div>
                <div class="sp-stat-sub">Verificada por análisis HPLC & MS</div>
            </div>

            <div class="sp-stat-card">
                <div class="sp-stat-val">100%</div>
                <div class="sp-stat-label">Envíos Asegurados</div>
                <div class="sp-stat-sub">Despacho exprés a todo el país</div>
            </div>

            <div class="sp-stat-card">
                <div class="sp-stat-val">&lt; 2h</div>
                <div class="sp-stat-label">Atención VIP</div>
                <div class="sp-stat-sub">Soporte directo con expertos</div>
            </div>

        </div>
    </div>
</section>

<!-- CERTIFICATIONS & QUALITY -->
<section class="sp-nos-section">
    <div class="sp-nos-container">
        <div style="text-align:center;max-width:700px;margin:0 auto 20px auto;">
            <span class="sp-nos-badge">ESTÁNDARES INTERNACIONALES</span>
            <h2 style="font-size:34px;font-weight:900;color:#0f172a;margin:10px 0 0 0;letter-spacing:-0.01em;">Garantía de Calidad Certificada</h2>
        </div>

        <div class="sp-certs-grid">
            
            <div class="sp-cert-card">
                <div class="sp-cert-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <h3>HPLC Testing (≥99%)</h3>
                <p>Cada lote es sometido a Cromatografía Líquida de Alta Eficiencia para asegurar una pureza constante y libre de residuos sintéticos.</p>
            </div>

            <div class="sp-cert-card">
                <div class="sp-cert-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v4m0 14v4m-8.66-14.5l3.46 2m10.4 6l3.46 2M1.34 16.5l3.46-2m10.4-6l3.46-2"/></svg>
                </div>
                <h3>Espectrometría de Masas (MS)</h3>
                <p>Validación de la masa molecular exacta de la secuencia peptídica mediante espectrometría de alta resolución.</p>
            </div>

            <div class="sp-cert-card">
                <div class="sp-cert-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3>Liofilización al Vacío</h3>
                <p>Proceso de secado por congelación que conserva la potencia activa del principio molécular a temperatura ambiente pre-reconstitución.</p>
            </div>

        </div>
    </div>
</section>

<!-- VALUES PILLARS -->
<section class="sp-nos-section-gray">
    <div class="sp-nos-container">
        <div style="text-align:center;max-width:700px;margin:0 auto 40px auto;">
            <span class="sp-nos-badge">NUESTROS PILARES</span>
            <h2 style="font-size:34px;font-weight:900;color:#0f172a;margin:10px 0 0 0;letter-spacing:-0.01em;">Compromiso con la Excelencia</h2>
        </div>

        <div class="sp-values-grid">
            
            <div class="sp-value-item">
                <div class="sp-value-num">01</div>
                <div class="sp-value-content">
                    <h4>Trazabilidad & Transparencia Total</h4>
                    <p>Acceso a reportes de análisis de laboratorio verificables e independientes para cada lote comercializado.</p>
                </div>
            </div>

            <div class="sp-value-item">
                <div class="sp-value-num">02</div>
                <div class="sp-value-content">
                    <h4>Asesoría Científica Especializada</h4>
                    <p>Soporte técnico capacitado para resolver consultas sobre reconstituciones, tablas de mezcla y equivalencias.</p>
                </div>
            </div>

            <div class="sp-value-item">
                <div class="sp-value-num">03</div>
                <div class="sp-value-content">
                    <h4>Logística de Cadena Fría Exprés</h4>
                    <p>Envíos seguros prioritarios con guía de rastreo a Bogotá, Medellín, Cali, Barranquilla y todo el país.</p>
                </div>
            </div>

            <div class="sp-value-item">
                <div class="sp-value-num">04</div>
                <div class="sp-value-content">
                    <h4>Garantía 100% Auténtica</h4>
                    <p>Productos sellados de fábrica con sellos holográficos de seguridad directos de Swiss Peptides Labs.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FINAL CTA -->
<section class="sp-nos-cta">
    <div class="sp-nos-cta-box">
        <h2>Impulsa tu Investigación con Fórmulas de Grado Científico</h2>
        <p>Explora nuestras 40 fórmulas peptídicas con certificación de pureza HPLC ≥99% y despacho prioritario en Colombia.</p>
        
        <div class="sp-nos-cta-btns">
            <a href="<?php echo home_url('/tienda/'); ?>" style="display:inline-flex;align-items:center;justify-content:center;gap:10px;background:linear-gradient(135deg, #00a8ff 0%, #0088cc 100%);color:#ffffff !important;padding:16px 32px;border-radius:12px;font-size:15.5px;font-weight:800;text-decoration:none !important;box-shadow:0 8px 25px rgba(0,168,255,0.35);transition:all 0.25s ease;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3h6m-5 0v5.882a2 2 0 0 0 .586 1.414l5.828 5.828A2 2 0 0 1 17 17.54V20a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-2.46a2 2 0 0 1 .586-1.414l5.828-5.828A2 2 0 0 0 14 8.882V3"/></svg>
                Ver Catálogo Completo
            </a>
            
            <a href="https://wa.me/573189163091?text=Hola%2C%20quiero%20informaci%C3%B3n%20sobre%20Swiss%20Peptides" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;justify-content:center;gap:10px;background:#25D366;color:#ffffff !important;padding:16px 32px;border-radius:12px;font-size:15.5px;font-weight:800;text-decoration:none !important;box-shadow:0 8px 25px rgba(37,211,102,0.35);transition:all 0.25s ease;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                Asesoría por WhatsApp
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
