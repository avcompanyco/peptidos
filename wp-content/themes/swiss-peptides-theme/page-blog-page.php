<?php
/**
 * Template Name: Blog Page
 */
get_header(); ?>

<style>
.page-hero{padding:calc(var(--navbar-height) + 60px) 0 var(--space-3xl);background:var(--bg-secondary);text-align:center;position:relative;overflow:hidden}
.page-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 0%,rgba(14,165,233,.06) 0%,transparent 60%)}
.blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:var(--space-xl)}
.blog-card{background:var(--white);border:1px solid var(--border-color);border-radius:var(--radius-xl);overflow:hidden;transition:all .35s var(--ease-out)}
.blog-card:hover{box-shadow:var(--shadow-lg);transform:translateY(-4px)}
.blog-card-img{height:220px;overflow:hidden}
.blog-card-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease}
.blog-card:hover .blog-card-img img{transform:scale(1.05)}
.blog-card-body{padding:var(--space-xl)}
.blog-card-tag{display:inline-block;padding:4px 12px;font-size:var(--fs-xs);font-weight:600;text-transform:uppercase;letter-spacing:.05em;background:var(--teal-light);color:var(--teal-dark);border-radius:var(--radius-full);margin-bottom:var(--space-sm)}
.blog-card-date{font-size:var(--fs-xs);color:var(--gray-500);margin-bottom:var(--space-md)}
.blog-card-title{font-family:var(--font-heading);font-size:var(--fs-base);font-weight:700;color:var(--navy);margin-bottom:var(--space-sm);line-height:1.4}
.blog-card-excerpt{font-size:var(--fs-sm);color:var(--gray-600);line-height:1.7;margin-bottom:var(--space-md)}
.blog-card-link{font-size:var(--fs-sm);font-weight:600;color:var(--accent);display:inline-flex;align-items:center;gap:4px;transition:gap .2s ease}
.blog-card-link:hover{gap:8px}
.newsletter-section{background:var(--navy);padding:var(--space-4xl) 0;text-align:center;position:relative;overflow:hidden}
.newsletter-section::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 50%,rgba(14,165,233,.1) 0%,transparent 60%)}
.newsletter-form{display:flex;gap:var(--space-sm);max-width:480px;margin:0 auto}
.newsletter-form input{flex:1;padding:14px 20px;border-radius:var(--radius-lg);border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.08);color:var(--white);font-size:var(--fs-sm)}
.newsletter-form input::placeholder{color:rgba(255,255,255,.4)}
@media(max-width:1024px){.blog-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:768px){.blog-grid{grid-template-columns:1fr}.newsletter-form{flex-direction:column}}
</style>

<section class="page-hero">
  <div class="container" style="position:relative;z-index:1;">
    <div class="section-label" data-animate="fade-up">Blog</div>
    <h1 class="section-title" data-animate="fade-up" data-delay="1" style="font-size:clamp(2rem,4vw,3.2rem);">Nuestro <span class="text-gradient">Blog</span></h1>
    <p class="section-subtitle" style="margin:var(--space-md) auto 0;" data-animate="fade-up" data-delay="2">Articulos sobre peptidos, novedades cientificas y guias para investigadores.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="blog-grid">
      <?php
      $blog_query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 9,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
      ]);

      if ($blog_query->have_posts()) :
        $delay = 1;
        while ($blog_query->have_posts()) : $blog_query->the_post();
          $cats = get_the_category();
          $cat_name = !empty($cats) ? $cats[0]->name : 'Artículo';
      ?>
      <article class="blog-card" data-animate="fade-up" data-delay="<?php echo ($delay % 3) + 1; ?>">
        <a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;">
          <div class="blog-card-img">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium_large', ['loading' => 'lazy', 'alt' => get_the_title()]); ?>
            <?php else : ?>
              <img src="https://images.pexels.com/photos/3825539/pexels-photo-3825539.jpeg?auto=compress&cs=tinysrgb&w=600" alt="<?php the_title_attribute(); ?>" loading="lazy">
            <?php endif; ?>
          </div>
          <div class="blog-card-body">
            <span class="blog-card-tag"><?php echo esc_html($cat_name); ?></span>
            <div class="blog-card-date"><?php echo get_the_date('d F, Y'); ?></div>
            <h2 class="blog-card-title"><?php the_title(); ?></h2>
            <p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
            <span class="blog-card-link">Leer más <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
          </div>
        </a>
      </article>
      <?php
          $delay++;
        endwhile;
        wp_reset_postdata();
      else :
        // Fallback placeholder articles when no posts exist yet
        $placeholders = [
          ['Semaglutide: Todo lo que Necesitas Saber', 'Una guía completa sobre Semaglutide: mecanismo de acción y resultados recientes en investigación clínica.', 'Guía', 'https://images.pexels.com/photos/3825539/pexels-photo-3825539.jpeg?auto=compress&cs=tinysrgb&w=600'],
          ['BPC-157 vs TB-500: Comparativa', 'Análisis comparativo de los dos péptidos regenerativos más populares y sus aplicaciones en investigación.', 'Ciencia', 'https://images.pexels.com/photos/2280571/pexels-photo-2280571.jpeg?auto=compress&cs=tinysrgb&w=600'],
          ['Cómo Leer un Certificado de Análisis', 'Aprende a interpretar resultados de HPLC y espectrometría de masas para investigadores.', 'Tutorial', 'https://images.pexels.com/photos/8460157/pexels-photo-8460157.jpeg?auto=compress&cs=tinysrgb&w=600'],
          ['NAD+ y Envejecimiento: La Ciencia en 2026', 'Revisión de la literatura científica más reciente sobre NAD+ y sus efectos celulares.', 'Investigación', 'https://images.pexels.com/photos/3683074/pexels-photo-3683074.jpeg?auto=compress&cs=tinysrgb&w=600'],
          ['Guía de Almacenamiento de Péptidos', 'Protocolos de almacenamiento y reconstitución con agua bacteriostática para máxima estabilidad.', 'Guía', 'https://images.pexels.com/photos/4033148/pexels-photo-4033148.jpeg?auto=compress&cs=tinysrgb&w=600'],
          ['Tirzepatide: El Agonista Dual bajo la Lupa', 'Análisis profundo de Tirzepatide y los resultados de ensayos clínicos más recientes.', 'Ciencia', 'https://images.pexels.com/photos/3912368/pexels-photo-3912368.jpeg?auto=compress&cs=tinysrgb&w=600'],
        ];
        foreach ($placeholders as $i => $ph) :
      ?>
      <article class="blog-card" data-animate="fade-up" data-delay="<?php echo ($i % 3) + 1; ?>">
        <div class="blog-card-img"><img src="<?php echo $ph[3]; ?>" alt="<?php echo $ph[0]; ?>" loading="lazy"></div>
        <div class="blog-card-body">
          <span class="blog-card-tag"><?php echo $ph[2]; ?></span>
          <div class="blog-card-date"><?php echo date('d F, Y'); ?></div>
          <h2 class="blog-card-title"><?php echo $ph[0]; ?></h2>
          <p class="blog-card-excerpt"><?php echo $ph[1]; ?></p>
          <span class="blog-card-link">Próximamente <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
        </div>
      </article>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>

<!-- Newsletter -->
<section class="newsletter-section">
  <div class="container" style="position:relative;z-index:2;">
    <h2 class="section-title" style="color:var(--white);max-width:500px;margin:0 auto var(--space-sm);" data-animate="fade-up">Mantente informado</h2>
    <p style="color:rgba(255,255,255,0.5);max-width:400px;margin:0 auto var(--space-xl);font-size:var(--fs-md);" data-animate="fade-up" data-delay="1">Recibe articulos y actualizaciones sobre peptidos en tu correo.</p>
    <form class="newsletter-form" data-animate="fade-up" data-delay="2" onsubmit="event.preventDefault();showToast('Suscripcion exitosa','success');">
      <input type="email" placeholder="Tu correo electronico" required>
      <button type="submit" class="btn btn-accent">Suscribirse</button>
    </form>
  </div>
</section>

<?php get_footer(); ?>
