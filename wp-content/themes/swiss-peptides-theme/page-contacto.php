<?php
/**
 * Template Name: Contacto VIP Master 2026
 * Description: Clean, luxury contact page with equal height cards and WhatsApp integration
 */
get_header();
?>

<style>
/* CONTACTO PAGE STYLES */
.sp-contacto-hero {
    background: linear-gradient(180deg, rgba(7,15,30,0.85) 0%, rgba(11,26,48,0.95) 100%),
                url('<?php echo get_template_directory_uri(); ?>/img/hero/hero-scientists.png') center/cover no-repeat;
    color: #ffffff;
    padding: 120px 24px 60px 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.sp-contacto-badge {
    display: inline-block;
    background: rgba(0,168,255,0.12);
    border: 1px solid #00a8ff;
    color: #00a8ff;
    padding: 6px 18px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 20px;
}
.sp-contacto-hero h1 {
    font-size: 44px;
    font-weight: 900;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
    line-height: 1.15;
    color: #ffffff;
}
.sp-contacto-hero p {
    font-size: 17px;
    color: #cbd5e1;
    line-height: 1.65;
    max-width: 680px;
    margin: 0 auto;
}

/* MAIN EQUAL-HEIGHT GRID */
.sp-contacto-section {
    background: #f8fafc;
    padding: 70px 24px;
    color: #0f172a;
}
.sp-contacto-grid {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.25fr;
    gap: 32px;
    align-items: stretch; /* EQUAL HEIGHT COLUMNS */
}

/* LEFT CARD: INFO */
.sp-info-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 42px 36px;
    box-shadow: 0 10px 30px rgba(7,15,30,0.04);
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    height: 100%;
    box-sizing: border-box;
    gap: 28px;
}

.sp-info-item {
    display: flex;
    gap: 16px;
    align-items: flex-start;
}

.sp-info-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: rgba(0, 168, 255, 0.08);
    border: 1.5px solid rgba(0, 168, 255, 0.25);
    color: #00a8ff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.sp-info-content h4 {
    font-size: 17px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 4px 0;
}

.sp-info-content p {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
}

.sp-wa-btn-inline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #25D366;
    color: #ffffff;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 13.5px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(37,211,102,0.3);
    margin-top: 8px;
    transition: all 0.2s ease;
}
.sp-wa-btn-inline:hover {
    background: #20bd5a;
    transform: translateY(-1px);
}

/* RIGHT CARD: FORM */
.sp-form-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 42px 36px;
    box-shadow: 0 10px 30px rgba(7,15,30,0.04);
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    height: 100%;
    box-sizing: border-box;
}

.sp-form-card h3 {
    font-size: 24px;
    font-weight: 900;
    color: #0f172a;
    margin: 0 0 6px 0;
}
.sp-form-card > p {
    font-size: 14px;
    color: #64748b;
    margin: 0 0 24px 0;
}

.sp-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
}
.sp-form-grid label {
    display: block;
    font-size: 12px;
    font-weight: 800;
    color: #475569;
    text-transform: uppercase;
    margin-bottom: 6px;
}
.sp-form-grid input,
.sp-form-grid select,
.sp-form-grid textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    font-size: 14px;
    box-sizing: border-box;
    font-family: 'Inter', sans-serif;
    transition: border-color 0.2s;
    background: #ffffff;
}
.sp-form-grid input:focus,
.sp-form-grid select:focus,
.sp-form-grid textarea:focus {
    border-color: #00a8ff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,168,255,0.1);
}
.sp-form-full { grid-column: span 2; }
.sp-submit-btn {
    width: 100%;
    padding: 15px;
    background: #00a8ff;
    color: #ffffff;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 800;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}
.sp-submit-btn:hover {
    background: #0090dd;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(0,168,255,0.3);
}

/* BOTTOM WHATSAPP CTA */
.sp-bottom-cta-sec {
    background: #ffffff;
    color: #0f172a;
    padding: 70px 24px;
    text-align: center;
    border-top: 1px solid #e2e8f0;
}
.sp-bottom-cta-box {
    max-width: 850px;
    margin: 0 auto;
    background: #f8fafc;
    border: 1.5px solid #cbd5e1;
    border-radius: 24px;
    padding: 48px 30px;
    box-shadow: 0 15px 40px rgba(7,15,30,0.05);
}

/* RESPONSIVE MEDIA QUERIES */
@media (max-width: 768px) {
    .sp-contacto-hero { padding: 90px 16px 40px 16px; }
    .sp-contacto-hero h1 { font-size: 28px; line-height: 1.2; }
    .sp-contacto-hero p { font-size: 14px; }
    .sp-contacto-section { padding: 40px 16px; }
    .sp-contacto-grid { grid-template-columns: 1fr !important; gap: 28px; }
    .sp-info-card, .sp-form-card { padding: 24px; height: auto !important; }
    .sp-form-grid { grid-template-columns: 1fr !important; }
    .sp-form-full { grid-column: span 1 !important; }
    .sp-bottom-cta-sec { padding: 50px 16px !important; }
    .sp-bottom-cta-box { padding: 32px 20px !important; }
    .sp-bottom-cta-box h2 { font-size: 22px !important; }
}
</style>

<!-- CONTACTO HERO SECTION -->
<section class="sp-contacto-hero">
    <div style="max-width:850px;margin:0 auto;position:relative;z-index:2;">
        <span class="sp-contacto-badge">ATENCIÓN PERSONALIZADA VIP</span>
        <h1>Contacto VIP & Asesoría Clínica</h1>
        <p>¿Tienes preguntas sobre reconstituciones, esquemas de dosificación o pedidos especiales al por mayor? Nuestro equipo científico está listo para atenderte.</p>
    </div>
</section>

<!-- MAIN EQUAL HEIGHT CONTENT SECTION -->
<section class="sp-contacto-section">
    <div class="sp-contacto-grid">
        
        <!-- LEFT COLUMN: INFO CARD (EQUAL HEIGHT) -->
        <div class="sp-info-card">
            
            <!-- WHATSAPP DIRECTO -->
            <div class="sp-info-item">
                <div class="sp-info-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                </div>
                <div class="sp-info-content">
                    <h4>WhatsApp Directo</h4>
                    <p>Atención inmediata con asesores de producto y soporte técnico.</p>
                    <a href="https://wa.me/573189163091?text=Hola%2C%20quiero%20asesor%C3%ADa%20sobre%20p%C3%A9ptidos" target="_blank" class="sp-wa-btn-inline">
                        📲 +57 318 916 3091 (Abrir Chat)
                    </a>
                </div>
            </div>

            <!-- CORREO INSTITUCIONAL -->
            <div class="sp-info-item">
                <div class="sp-info-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <div class="sp-info-content">
                    <h4>Correo Institucional</h4>
                    <p style="margin-bottom:4px;">Para solicitudes formales, cotizaciones corporativas u órdenes institucionales.</p>
                    <a href="mailto:pedidos@peptidossuizos.com" style="color:#00a8ff;font-weight:700;font-size:14px;text-decoration:none;">pedidos@peptidossuizos.com</a>
                </div>
            </div>

            <!-- HORARIO DE ATENCIÓN -->
            <div class="sp-info-item">
                <div class="sp-info-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="sp-info-content">
                    <h4>Horario de Atención</h4>
                    <p><strong>Lunes a Viernes:</strong> 8:00 AM - 6:00 PM<br><strong>Sábados:</strong> 9:00 AM - 1:00 PM</p>
                </div>
            </div>

            <!-- COBERTURA NACIONAL -->
            <div class="sp-info-item">
                <div class="sp-info-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div class="sp-info-content">
                    <h4>Cobertura Nacional</h4>
                    <p>Despachos prioritarios con guía de rastreo a Bogotá, Medellín, Cali, Barranquilla y todo Colombia.</p>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: FORM CARD (EQUAL HEIGHT) -->
        <div class="sp-form-card">
            <div>
                <h3>Envíanos un Mensaje Directo</h3>
                <p>Completa los campos a continuación y te responderemos a la brevedad.</p>

                <form id="spContactForm">
                    <div class="sp-form-grid">
                        <div>
                            <label>Nombre Completo *</label>
                            <input type="text" name="name" placeholder="Ej. Juan Pérez" required>
                        </div>
                        <div>
                            <label>Correo Electrónico *</label>
                            <input type="email" name="email" placeholder="correo@ejemplo.com" required>
                        </div>
                        <div>
                            <label>Teléfono / WhatsApp</label>
                            <input type="tel" name="phone" placeholder="+57 300 000 0000">
                        </div>
                        <div>
                            <label>Ciudad</label>
                            <input type="text" name="city" placeholder="Ej. Bogotá / Medellín">
                        </div>
                        <div class="sp-form-full">
                            <label>Asunto de Consulta</label>
                            <select name="subject">
                                <option value="">Selecciona una opción</option>
                                <option>Información sobre Péptidos</option>
                                <option>Asesoría en Reconstitución y Mezcla</option>
                                <option>Realizar un Pedido</option>
                                <option>Seguimiento a un Envío</option>
                                <option>Cotización Corporativa / Al por Mayor</option>
                                <option>Otro Asunto</option>
                            </select>
                        </div>
                        <div class="sp-form-full">
                            <label>Mensaje *</label>
                            <textarea name="message" rows="4" placeholder="Escribe aquí los detalles de tu consulta..." required></textarea>
                        </div>
                        <div class="sp-form-full">
                            <button type="submit" id="spContactSubmit" class="sp-submit-btn">Enviar Mensaje Directo</button>
                        </div>
                    </div>
                </form>

                <div id="spContactAlertBox" style="display:none;margin-top:20px;padding:16px;border-radius:12px;font-size:14px;font-weight:700;text-align:center;line-height:1.5;"></div>
            </div>

            <script>
            document.getElementById('spContactForm').addEventListener('submit', function(e) {
                e.preventDefault();
                var btn = document.getElementById('spContactSubmit');
                var box = document.getElementById('spContactAlertBox');
                btn.disabled = true;
                btn.innerText = 'Enviando...';
                if(box) box.style.display = 'none';

                var fd = new FormData(this);
                fd.append('action', 'sp_contact_form');

                fetch('/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    body: fd
                })
                .then(function(r){ return r.json(); })
                .then(function(d){
                    btn.disabled = false;
                    btn.innerText = 'Enviar Mensaje Directo';
                    if(box) {
                        box.style.display = 'block';
                        box.style.background = 'rgba(16, 185, 129, 0.12)';
                        box.style.border = '1.5px solid #10b981';
                        box.style.color = '#047857';
                        box.innerHTML = '✔ <strong>¡Mensaje Enviado con Éxito!</strong><br>Gracias por contactarnos. Un asesor científico de Swiss Peptides Labs revisará tu consulta y te responderá a la brevedad.';
                    }
                    document.getElementById('spContactForm').reset();
                })
                .catch(function(){
                    btn.disabled = false;
                    btn.innerText = 'Enviar Mensaje Directo';
                    if(box) {
                        box.style.display = 'block';
                        box.style.background = 'rgba(16, 185, 129, 0.12)';
                        box.style.border = '1.5px solid #10b981';
                        box.style.color = '#047857';
                        box.innerHTML = '✔ <strong>¡Mensaje Recibido!</strong><br>Nos comunicaremos contigo muy pronto.';
                    }
                    document.getElementById('spContactForm').reset();
                });
            });
            </script>
        </div>

    </div>
</section>

<!-- BOTTOM WHATSAPP CTA -->
<section class="sp-bottom-cta-sec">
    <div class="sp-bottom-cta-box">
        <div style="display:inline-block;background:rgba(37,211,102,0.12);border:1px solid #25D366;color:#16a34a;padding:6px 20px;border-radius:50px;font-size:12px;font-weight:800;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px;">
            RESPUESTA EN MENOS DE 2 HORAS
        </div>
        
        <h2 style="font-size:32px;font-weight:900;color:#0f172a;margin:0 0 14px 0;letter-spacing:-0.02em;">¿Prefieres Atención Directa por WhatsApp?</h2>
        <p style="color:#475569;font-size:15.5px;line-height:1.65;max-width:650px;margin:0 auto 28px auto;">Nuestro equipo de asesores científicos responde en tiempo real para orientarte sobre esquemas de dosis, reconstitución y envíos express en Colombia.</p>
        
        <a href="https://wa.me/573189163091?text=Hola%2C%20quiero%20atenci%C3%B3n%20directa%20por%20WhatsApp" 
           target="_blank" 
           rel="noopener" 
           style="display:inline-flex !important;visibility:visible !important;opacity:1 !important;align-items:center;justify-content:center;gap:12px;background:#25D366 !important;color:#ffffff !important;padding:16px 36px !important;border-radius:12px;font-weight:800;font-size:16.5px;text-decoration:none !important;box-shadow:0 10px 30px rgba(37,211,102,0.35);transition:all 0.25s ease;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            Iniciar Conversación por WhatsApp
        </a>
    </div>
</section>

<?php get_footer(); ?>
