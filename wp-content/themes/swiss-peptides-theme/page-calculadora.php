<?php
/**
 * Template Name: Calculadora Master 2026
 * Description: Luxury Interactive Reconstitution Calculator for Swiss Peptides Labs
 */
get_header();
?>

<style>
:root {
    --cyan-accent: #00a8ff;
    --medical-navy: #070f1e;
    --text-slate: #cbd5e1;
}

.calc-page-hero {
    background: linear-gradient(180deg, rgba(7,15,30,0.85) 0%, rgba(11,26,48,0.95) 100%),
                url('<?php echo get_template_directory_uri(); ?>/img/hero/hero-scientists.png') center/cover no-repeat;
    color: #ffffff;
    padding: 110px 24px 50px 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.calc-hero-content {
    position: relative;
    z-index: 2;
    max-width: 850px;
    margin: 0 auto;
}

.calc-badge {
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
    margin-bottom: 18px;
}

.calc-title {
    font-size: 44px;
    font-weight: 900;
    line-height: 1.12;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
    color: #ffffff;
}

.calc-sub {
    font-size: 16px;
    color: #cbd5e1;
    line-height: 1.65;
    max-width: 720px;
    margin: 0 auto;
}

.calc-sec-container {
    padding: 60px 24px 80px 24px;
    background: #f8fafc;
}

/* MAIN 2-COLUMN GRID LAYOUT */
.calc-grid-layout {
    display: grid !important;
    grid-template-columns: 1.05fr 1fr !important;
    gap: 32px !important;
    max-width: 1280px !important;
    margin: 0 auto !important;
    align-items: start !important;
}

/* LEFT COLUMN: INPUT CONTROLS */
.calc-card-box {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 24px !important;
    padding: 32px 28px !important;
    box-shadow: 0 10px 35px rgba(7, 15, 30, 0.04) !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 0 !important;
}

.calc-step-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.step-num-badge {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #00a8ff;
    color: #ffffff;
    font-size: 13px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
}

.step-title {
    font-size: 16.5px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}

.calc-chips-flex {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 12px;
}

.calc-chip-btn {
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    color: #334155;
    padding: 9px 16px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
}

.calc-chip-btn:hover, .calc-chip-btn.active {
    background: #070f1e;
    border-color: #070f1e;
    color: #ffffff;
}

.calc-custom-input {
    width: 100%;
    box-sizing: border-box;
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    padding: 11px 15px;
    border-radius: 10px;
    font-size: 13.5px;
    color: #0f172a;
    outline: none;
    transition: all 0.2s ease;
    margin-bottom: 22px;
}

.calc-custom-input:focus {
    background: #ffffff;
    border-color: #00a8ff;
    box-shadow: 0 0 0 3px rgba(0, 168, 255, 0.15);
}

/* RIGHT COLUMN: RESULTS & SYRINGE GRAPHIC */
.calc-results-box {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 24px !important;
    padding: 32px 28px !important;
    box-shadow: 0 15px 45px rgba(7, 15, 30, 0.05) !important;
}

.kpi-cards-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 24px;
}

.kpi-card-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 18px 14px;
    text-align: center;
}

.kpi-card-item.accent-kpi {
    background: rgba(0, 168, 255, 0.06);
    border-color: rgba(0, 168, 255, 0.25);
}

.kpi-label {
    font-size: 11.5px;
    font-weight: 800;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.kpi-val {
    font-size: 30px;
    font-weight: 900;
    color: #0f172a;
    line-height: 1;
    margin-bottom: 4px;
}

.accent-kpi .kpi-val {
    color: #00a8ff;
}

.kpi-unit {
    font-size: 12px;
    color: #64748b;
    font-weight: 600;
}

/* SYRINGE VISUALIZATION CONTAINER */
.syringe-container {
    background: #070f1e;
    color: #ffffff;
    border-radius: 18px;
    padding: 24px 20px;
    text-align: center;
    margin-bottom: 24px;
}

.syringe-title {
    font-size: 12.5px;
    font-weight: 800;
    color: #00a8ff;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    margin-bottom: 6px;
}

.syringe-ui-num {
    font-size: 32px;
    font-weight: 900;
    color: #ffffff;
    margin-bottom: 14px;
}

.syringe-graphic-svg {
    width: 100%;
    max-width: 320px;
    height: auto;
    margin: 0 auto;
    display: block;
}

.syringe-hint {
    font-size: 12px;
    color: #cbd5e1;
    margin-top: 12px;
}

.syringe-warn {
    display: none;
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid #ef4444;
    color: #f87171;
    font-size: 12px;
    font-weight: 700;
    padding: 10px 14px;
    border-radius: 10px;
    margin-top: 12px;
}

.syringe-warn.visible {
    display: block;
}

/* GUIDE BOX */
.guide-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 24px;
}

.guide-box h4 {
    font-size: 14.5px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.guide-box ol {
    margin: 0;
    padding-left: 18px;
    font-size: 13px;
    color: #475569;
    line-height: 1.55;
}

.guide-box li {
    margin-bottom: 6px;
}

@media (max-width: 960px) {
    .calc-grid-layout { grid-template-columns: 1fr !important; }
    .kpi-cards-grid { grid-template-columns: 1fr 1fr; }
    .calc-title { font-size: 32px; }
}
</style>

<!-- HERO HEADER -->
<section class="calc-page-hero">
    <div class="calc-hero-content">
        <div class="calc-badge">HERRAMIENTA CLÍNICA GRATUITA</div>
        <h1 class="calc-title">Calculadora de <span style="color:#00a8ff;">Reconstitución</span> Peptídica</h1>
        <p class="calc-sub">Calcula con máxima precisión los miligramos (mg), el volumen de agua bacteriostática (ml) y las Unidades (UI) exactas a cargar en tu jeringa de insulina (U-100 / 1ml).</p>
    </div>
</section>

<!-- MAIN CALCULATOR SECTION WITH GUARANTEED 2 COLUMNS -->
<section class="calc-sec-container">
    <div class="calc-grid-layout">
        
        <!-- LEFT COLUMN: INPUT CONTROLS + REFERENCE CARD -->
        <div class="calc-card-box">
            
            <!-- STEP 1: DOSIS DESEADA -->
            <div class="calc-step-header">
                <div class="step-num-badge">1</div>
                <h3 class="step-title">Dosis Deseada por Inyección</h3>
            </div>
            <div class="calc-chips-flex" data-target="dose">
                <button type="button" class="calc-chip-btn" data-value="0.1">100 mcg</button>
                <button type="button" class="calc-chip-btn" data-value="0.25">250 mcg</button>
                <button type="button" class="calc-chip-btn" data-value="0.5">500 mcg</button>
                <button type="button" class="calc-chip-btn active" data-value="1.0">1.0 mg</button>
                <button type="button" class="calc-chip-btn" data-value="2.0">2.0 mg</button>
                <button type="button" class="calc-chip-btn" data-value="5.0">5.0 mg</button>
            </div>
            <input type="number" step="any" id="dose-custom" class="calc-custom-input" placeholder="O ingresa un valor personalizado en mg (ej. 0.75)...">

            <!-- STEP 2: CONTENIDO DEL VIAL -->
            <div class="calc-step-header">
                <div class="step-num-badge">2</div>
                <h3 class="step-title">Contenido Total del Vial (mg)</h3>
            </div>
            <div class="calc-chips-flex" data-target="potency">
                <button type="button" class="calc-chip-btn" data-value="2">2 mg</button>
                <button type="button" class="calc-chip-btn" data-value="5">5 mg</button>
                <button type="button" class="calc-chip-btn active" data-value="10">10 mg</button>
                <button type="button" class="calc-chip-btn" data-value="15">15 mg</button>
                <button type="button" class="calc-chip-btn" data-value="20">20 mg</button>
            </div>
            <input type="number" step="any" id="potency-custom" class="calc-custom-input" placeholder="O ingresa los mg totales de tu vial (ej. 30)...">

            <!-- STEP 3: AGUA BACTERIOSTÁTICA -->
            <div class="calc-step-header">
                <div class="step-num-badge">3</div>
                <h3 class="step-title">Volumen de Agua Bacteriostática (ml)</h3>
            </div>
            <div class="calc-chips-flex" data-target="water">
                <button type="button" class="calc-chip-btn" data-value="1.0">1.0 ml</button>
                <button type="button" class="calc-chip-btn" data-value="1.5">1.5 ml</button>
                <button type="button" class="calc-chip-btn active" data-value="2.0">2.0 ml</button>
                <button type="button" class="calc-chip-btn" data-value="2.5">2.5 ml</button>
                <button type="button" class="calc-chip-btn" data-value="3.0">3.0 ml</button>
            </div>
            <input type="number" step="any" id="water-custom" class="calc-custom-input" placeholder="O ingresa los ml de diluyente (ej. 4.0)...">

            <!-- CONSERVATION & DILUTION REFERENCE CARD INSIDE LEFT COLUMN -->
            <div style="margin-top:10px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:18px;padding:20px 18px;display:flex;flex-direction:column;gap:14px;">
                <div style="display:flex;gap:12px;align-items:center;">
                    <div style="width:36px;height:36px;border-radius:10px;background:rgba(0,168,255,0.12);color:#00a8ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:18px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6m-4 3h2m-5-8a7 7 0 1 1 10 0c0 3-2 4.5-3 6.5H9c-1-2-3-3.5-3-6.5z"/></svg></div>
                    <div>
                        <h5 style="margin:0 0 3px 0;font-size:13.5px;font-weight:800;color:#0f172a;">Consejo de Conservación</h5>
                        <p style="margin:0;font-size:12px;color:#64748b;line-height:1.45;">Mantén el vial reconstituido refrigerado entre 2°C y 8°C. El Agua Bacteriostática preserva la estabilidad hasta por 30 días.</p>
                    </div>
                </div>

                <div style="border-top:1px dashed #cbd5e1;padding-top:14px;">
                    <h5 style="margin:0 0 10px 0;font-size:13px;font-weight:800;color:#0f172a;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg> <span>Tabla de Referencia Rápida</span> (Jeringa U-100 / 1ml)
                    </h5>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:12px;color:#475569;">
                        <div style="background:#ffffff;border:1px solid #e2e8f0;border-radius:8px;padding:8px 10px;display:flex;justify-content:space-between;align-items:center;">
                            <span><strong>10 UI</strong></span>
                            <span style="color:#00a8ff;font-weight:700;">= 0.10 ml</span>
                        </div>
                        <div style="background:#ffffff;border:1px solid #e2e8f0;border-radius:8px;padding:8px 10px;display:flex;justify-content:space-between;align-items:center;">
                            <span><strong>25 UI</strong></span>
                            <span style="color:#00a8ff;font-weight:700;">= 0.25 ml</span>
                        </div>
                        <div style="background:#ffffff;border:1px solid #e2e8f0;border-radius:8px;padding:8px 10px;display:flex;justify-content:space-between;align-items:center;">
                            <span><strong>50 UI</strong></span>
                            <span style="color:#00a8ff;font-weight:700;">= 0.50 ml</span>
                        </div>
                        <div style="background:#ffffff;border:1px solid #e2e8f0;border-radius:8px;padding:8px 10px;display:flex;justify-content:space-between;align-items:center;">
                            <span><strong>100 UI</strong></span>
                            <span style="color:#00a8ff;font-weight:700;">= 1.00 ml</span>
                        </div>
                    </div>
                </div>

                <div style="background:rgba(7,15,30,0.03);border:1px solid #e2e8f0;border-radius:10px;padding:10px 12px;font-size:11.5px;color:#64748b;line-height:1.45;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> <strong>Garantía de Esterilidad:</strong> Utilizar siempre jeringas estériles desechables de 1ml U-100 para evitar contaminación bacteriana en el vial.
                </div>
            </div>

        </div> <!-- END LEFT COLUMN calc-card-box -->

        <!-- RIGHT COLUMN: REAL-TIME RESULTS & SYRINGE GRAPHIC -->
        <div class="calc-results-box">
            
            <!-- KPI CARDS -->
            <div class="kpi-cards-grid">
                <div class="kpi-card-item">
                    <div class="kpi-label">Dosis por Inyección</div>
                    <div class="kpi-val" id="result-dose">1.00</div>
                    <div class="kpi-unit">mg</div>
                </div>

                <div class="kpi-card-item accent-kpi">
                    <div class="kpi-label">Cargar en Jeringa</div>
                    <div class="kpi-val" id="result-units">50</div>
                    <div class="kpi-unit">Unidades (UI)</div>
                </div>

                <div class="kpi-card-item">
                    <div class="kpi-label">Inyecciones / Vial</div>
                    <div class="kpi-val" id="result-doses">10</div>
                    <div class="kpi-unit">Dosis totales</div>
                </div>

                <div class="kpi-card-item">
                    <div class="kpi-label">Concentración Final</div>
                    <div class="kpi-val" id="result-concentration">5.00</div>
                    <div class="kpi-unit">mg/ml</div>
                </div>
            </div>

            <!-- DYNAMIC SYRINGE VISUALIZATION -->
            <div class="syringe-container">
                <div class="syringe-title">MEDICIÓN EN JERINGA U-100 (1ML)</div>
                <div class="syringe-ui-num" id="syringe-units-display">50 Unidades (UI)</div>
                
                <svg class="syringe-graphic-svg" viewBox="0 0 300 70">
                    <rect x="60" y="15" width="200" height="35" rx="4" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.25)" stroke-width="1.5"/>
                    <rect id="syringe-fill" x="61" y="16" width="100" height="33" rx="3" fill="#00a8ff"/>
                    <rect x="260" y="20" width="25" height="25" rx="3" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                    <line x1="285" y1="27" x2="285" y2="38" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
                    <line x1="60" y1="32" x2="12" y2="32" stroke="#cbd5e1" stroke-width="2" stroke-linecap="round"/>
                    <polygon points="12,32 4,30 4,34" fill="#cbd5e1"/>
                    
                    <line x1="110" y1="50" x2="110" y2="56" stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
                    <text x="110" y="65" text-anchor="middle" font-size="9" fill="#94a3b8">20 UI</text>
                    <line x1="160" y1="50" x2="160" y2="56" stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
                    <text x="160" y="65" text-anchor="middle" font-size="9" fill="#94a3b8">50 UI</text>
                    <line x1="210" y1="50" x2="210" y2="56" stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
                    <text x="210" y="65" text-anchor="middle" font-size="9" fill="#94a3b8">75 UI</text>
                    <line x1="255" y1="50" x2="255" y2="56" stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
                    <text x="255" y="65" text-anchor="middle" font-size="9" fill="#94a3b8">100 UI</text>
                </svg>

                <div class="syringe-hint">Carga hasta esta marca exacta utilizando una jeringa de insulina estándar U-100.</div>
                <div class="syringe-warn" id="syringe-warning">La dosis excede las 100 UI. Te sugerimos diluir el vial con más Agua Bacteriostática.</div>
            </div>

            <!-- GUIDE BOX -->
            <div class="guide-box">
                <h4>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    Instrucciones de Reconstitución Paso a Paso
                </h4>
                <ol>
                    <li><strong>Desinfección:</strong> Limpia la tapadera de goma del vial con una toallita de alcohol isopropílico.</li>
                    <li><strong>Mezcla Suave:</strong> Inyecta el agua bacteriostática haciendo deslizar el líquido despacio por la pared de vidrio del vial para evitar desnaturalizar las cadenas peptídicas.</li>
                    <li><strong>Disolución:</strong> No agites el frasco. Hazlo girar suavemente entre tus manos hasta lograr una solución 100% cristalina. Mantener refrigerado (2°C - 8°C).</li>
                </ol>
            </div>

            <!-- ACTION BUTTONS (LUXURY STYLED BUTTONS) -->
            <div style="display:flex;gap:14px;flex-wrap:wrap;margin-top:20px;">
                <a href="/producto/agua-bacteriostatica-10ml/" style="flex:1;min-width:200px;display:inline-flex;align-items:center;justify-content:center;gap:8px;background:linear-gradient(135deg, #00a8ff 0%, #0088cc 100%);color:#ffffff !important;padding:15px 22px;border-radius:12px;font-size:14.5px;font-weight:800;text-decoration:none !important;box-shadow:0 6px 20px rgba(0,168,255,0.3);transition:all 0.25s ease;border:none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg> <span>Comprar Agua Bacteriostática</span>
                </a>
                <a href="/tienda/" style="flex:1;min-width:200px;display:inline-flex;align-items:center;justify-content:center;gap:8px;background:#070f1e;color:#ffffff !important;padding:15px 22px;border-radius:12px;font-size:14.5px;font-weight:800;text-decoration:none !important;box-shadow:0 6px 20px rgba(7,15,30,0.15);transition:all 0.25s ease;border:1px solid rgba(255,255,255,0.1);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3h6m-5 0v5.882a2 2 0 0 0 .586 1.414l5.828 5.828A2 2 0 0 1 17 17.54V20a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-2.46a2 2 0 0 1 .586-1.414l5.828-5.828A2 2 0 0 0 14 8.882V3"/></svg> <span>Ver Catálogo Completo</span>
                </a>
            </div>

        </div> <!-- END RIGHT COLUMN calc-results-box -->

    </div> <!-- END 2-COLUMN calc-grid-layout -->
</section>

<!-- CALCULATOR JS ENGINE -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const state = { dose: 1.0, potency: 10, water: 2.0 };

    function calculate() {
        const concentration = state.potency / state.water;
        const volumePerDose = state.dose / concentration;
        const syringeUnits = volumePerDose * 100;
        const dosesPerVial = state.potency / state.dose;

        document.getElementById('result-dose').textContent = state.dose.toFixed(2);
        document.getElementById('result-units').textContent = (Math.round(syringeUnits * 10) / 10).toFixed(1);
        document.getElementById('result-doses').textContent = Math.floor(dosesPerVial);
        document.getElementById('result-concentration').textContent = concentration.toFixed(2);

        // Syringe graphic update
        const fillPercent = Math.min(syringeUnits / 100, 1);
        const maxWidth = 198;
        const fillWidth = fillPercent * maxWidth;
        const fillEl = document.getElementById('syringe-fill');
        if (fillEl) fillEl.setAttribute('width', fillWidth);

        const warning = document.getElementById('syringe-warning');
        if (syringeUnits > 100) {
            if (fillEl) fillEl.setAttribute('fill', '#ef4444');
            if (warning) warning.classList.add('visible');
        } else {
            if (fillEl) fillEl.setAttribute('fill', '#00a8ff');
            if (warning) warning.classList.remove('visible');
        }

        const unitsDisplay = document.getElementById('syringe-units-display');
        if (unitsDisplay) unitsDisplay.textContent = (Math.round(syringeUnits * 10) / 10) + ' Unidades (UI)';
    }

    // Chip click handlers
    document.querySelectorAll('.calc-chips-flex').forEach(function(group) {
        const target = group.dataset.target;
        group.querySelectorAll('.calc-chip-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                group.querySelectorAll('.calc-chip-btn').forEach(function(b) { b.classList.remove('active'); });
                btn.classList.add('active');
                var customInput = document.getElementById(target + '-custom');
                if (customInput) customInput.value = '';
                state[target] = parseFloat(btn.dataset.value);
                calculate();
            });
        });
    });

    // Custom inputs
    ['dose', 'potency', 'water'].forEach(function(field) {
        var input = document.getElementById(field + '-custom');
        if (!input) return;
        input.addEventListener('input', function() {
            var val = parseFloat(input.value);
            if (isNaN(val) || val <= 0) return;
            var group = document.querySelector('.calc-chips-flex[data-target="' + field + '"]');
            if (group) group.querySelectorAll('.calc-chip-btn').forEach(function(b) { b.classList.remove('active'); });
            state[field] = val;
            calculate();
        });
    });

    calculate();
});
</script>

<?php get_footer(); ?>
