<?php
/**
 * Template Name: FAQ
 */
get_header(); ?>

<style>
.page-hero{padding:calc(var(--navbar-height) + 60px) 0 var(--space-3xl);background:var(--bg-secondary);text-align:center;position:relative;overflow:hidden}
.page-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 0%,rgba(14,165,233,.06) 0%,transparent 60%)}
.faq-container{max-width:800px;margin:0 auto}
.faq-item{border:1px solid var(--border-color);border-radius:var(--radius-xl);margin-bottom:var(--space-md);background:var(--white);overflow:hidden;transition:all .3s ease}
.faq-item.active{border-color:var(--accent);box-shadow:0 4px 20px rgba(14,165,233,.08)}
.faq-question{display:flex;justify-content:space-between;align-items:center;padding:var(--space-xl);cursor:pointer;gap:var(--space-md)}
.faq-question h3{font-family:var(--font-heading);font-size:var(--fs-base);font-weight:600;color:var(--navy);margin:0}
.faq-toggle{width:32px;height:32px;border-radius:var(--radius-full);background:var(--gray-100);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .3s ease;color:var(--text-secondary)}
.faq-item.active .faq-toggle{background:var(--accent);color:var(--white);transform:rotate(45deg)}
.faq-answer{max-height:0;overflow:hidden;transition:max-height .4s ease,padding .3s ease}
.faq-item.active .faq-answer{max-height:500px;padding:0 var(--space-xl) var(--space-xl)}
.faq-answer p{font-size:var(--fs-sm);color:var(--gray-600);line-height:1.8}
.faq-cta{background:var(--navy);padding:var(--space-4xl) 0;text-align:center;position:relative;overflow:hidden}
.faq-cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 50%,rgba(14,165,233,.1) 0%,transparent 60%)}
</style>

<section class="page-hero">
  <div class="container" style="position:relative;z-index:1;">
    <div class="section-label" data-animate="fade-up">FAQ</div>
    <h1 class="section-title" data-animate="fade-up" data-delay="1" style="font-size:clamp(2rem,4vw,3.2rem);">Preguntas <span class="text-gradient">Frecuentes</span></h1>
    <p class="section-subtitle" style="margin:var(--space-md) auto 0;" data-animate="fade-up" data-delay="2">Respuestas a las consultas mas comunes sobre nuestros peptidos.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="faq-container">
      <div class="faq-item active" data-animate="fade-up" data-delay="1">
        <div class="faq-question" onclick="this.parentElement.classList.toggle('active')"><h3>Que son los peptidos de investigacion?</h3><div class="faq-toggle"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div></div>
        <div class="faq-answer"><p>Los peptidos de investigacion son cadenas cortas de aminoacidos sintetizados para uso exclusivo en investigacion cientifica y desarrollo preclinico. No estan destinados para consumo humano ni uso veterinario. Se utilizan en laboratorios, universidades e instituciones de investigacion para estudiar mecanismos biologicos.</p></div>
      </div>
      <div class="faq-item" data-animate="fade-up" data-delay="2">
        <div class="faq-question" onclick="this.parentElement.classList.toggle('active')"><h3>Cual es la pureza de los productos?</h3><div class="faq-toggle"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div></div>
        <div class="faq-answer"><p>Todos nuestros productos tienen una pureza minima de ≥98%, verificada mediante cromatografia liquida de alta eficacia (HPLC) y Espectrometria de Masas (MS). Cada lote de produccion incluye un Certificado de Analisis (CoA) detallado.</p></div>
      </div>
      <div class="faq-item" data-animate="fade-up" data-delay="3">
        <div class="faq-question" onclick="this.parentElement.classList.toggle('active')"><h3>Como se realizan los envios?</h3><div class="faq-toggle"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div></div>
        <div class="faq-answer"><p>Utilizamos envio refrigerado con cadena de frio garantizada a todas las ciudades principales de Colombia. Los pedidos se procesan en 24-48 horas habiles y el tiempo estimado de entrega es de 2-5 dias habiles dependiendo de la ubicacion. Incluimos empaque termico especializado.</p></div>
      </div>
      <div class="faq-item" data-animate="fade-up" data-delay="4">
        <div class="faq-question" onclick="this.parentElement.classList.toggle('active')"><h3>Que metodos de pago aceptan?</h3><div class="faq-toggle"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div></div>
        <div class="faq-answer"><p>Aceptamos tarjetas de credito y debito (Visa, Mastercard, AMEX), Apple Pay y Google Pay a traves de nuestra pasarela de pago segura Stripe. Todas las transacciones estan encriptadas con certificacion PCI DSS.</p></div>
      </div>
      <div class="faq-item" data-animate="fade-up" data-delay="5">
        <div class="faq-question" onclick="this.parentElement.classList.toggle('active')"><h3>Los productos incluyen certificado de analisis?</h3><div class="faq-toggle"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div></div>
        <div class="faq-answer"><p>Si. Cada producto de Swiss Peptides Labs incluye un Certificado de Analisis (CoA) con los resultados de las pruebas HPLC y MS. Estos certificados pueden ser verificados directamente con el laboratorio fabricante en Suiza.</p></div>
      </div>
      <div class="faq-item" data-animate="fade-up" data-delay="6">
        <div class="faq-question" onclick="this.parentElement.classList.toggle('active')"><h3>Como debo almacenar los peptidos?</h3><div class="faq-toggle"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div></div>
        <div class="faq-answer"><p>Los peptidos liofilizados (sin reconstituir) deben almacenarse en congelador a -20C. Una vez reconstituidos con agua bacteriostatica, deben refrigerarse entre 2-8C y utilizarse dentro de las 4 semanas siguientes para mantener su estabilidad.</p></div>
      </div>
      <div class="faq-item" data-animate="fade-up">
        <div class="faq-question" onclick="this.parentElement.classList.toggle('active')"><h3>Realizan envios internacionales?</h3><div class="faq-toggle"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div></div>
        <div class="faq-answer"><p>Actualmente nuestro servicio esta disponible unicamente dentro del territorio colombiano. Para compras internacionales, le recomendamos visitar la web principal de Swiss Peptides Labs en swisspeptideslabs.com.</p></div>
      </div>
      <div class="faq-item" data-animate="fade-up">
        <div class="faq-question" onclick="this.parentElement.classList.toggle('active')"><h3>Cual es la politica de devolucion?</h3><div class="faq-toggle"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div></div>
        <div class="faq-answer"><p>Dado que nuestros productos son compuestos sensibles que requieren cadena de frio, no aceptamos devoluciones una vez entregados. Si recibe un producto danado o incorrecto, contactenos dentro de las 48 horas siguientes a la entrega para gestionar reemplazo.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="faq-cta">
  <div class="container" style="position:relative;z-index:2;">
    <h2 class="section-title" style="color:var(--white);max-width:500px;margin:0 auto var(--space-md);" data-animate="fade-up">Tienes mas preguntas?</h2>
    <p style="color:rgba(255,255,255,0.5);max-width:400px;margin:0 auto var(--space-xl);font-size:var(--fs-md);" data-animate="fade-up" data-delay="1">Nuestro equipo esta listo para resolver cualquier duda.</p>
    <div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;" data-animate="fade-up" data-delay="2">
      <a href="<?php echo home_url('/contacto'); ?>" class="btn btn-accent btn-lg">Contactar</a>
      <a href="https://wa.me/573189163091" target="_blank" class="btn btn-lg" style="background:rgba(255,255,255,0.1);color:var(--white);border:1px solid rgba(255,255,255,0.2);">WhatsApp</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
