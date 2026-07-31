<?php get_header(); ?>
<style>
.shop-hero { padding: 150px 0 50px; background: #f4f4f4; text-align: center; }
.shop-layout { display: grid; grid-template-columns: 250px 1fr; gap: 30px; margin: 50px auto; max-width: 1200px; padding: 0 20px; }
.shop-sidebar { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: fit-content; }
.shop-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
.product-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); transition: transform 0.3s; text-decoration: none; color: inherit; display: block; height: 100%; border: 1px solid #eee; }
.product-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.product-info { padding: 15px; text-align: center; }
.product-info h3 { margin: 10px 0; font-size: 1.1rem; color: #333; }
.product-info .price { color: #d4af37; font-weight: bold; font-size: 1.2rem; }
.product-image img { width: 100%; height: auto; display: block; }</style>
<section class="shop-hero"><h1>Nuestra Coleccion</h1></section>
<div class="shop-layout">
<aside class="shop-sidebar">
<h3>Categorias</h3>
<div class="category-list">
<?php
$terms = get_terms("product_cat", array("hide_empty" => true));
foreach($terms as $term) {
echo '<a href="'.get_term_link($term).'" style="display:block; padding:8px 0; color:#666; text-decoration:none;">'.$term->name.'</a>';
}
?>
</div>
</aside>
<main>
<div class="shop-grid">
<?php if (have_posts()) : while (have_posts()) : the_post(); global $product; ?>
<div class="product-item">
<a href="<?php the_permalink(); ?>" class="product-card">
<div class="product-image"><?php the_post_thumbnail("medium"); ?></div>
<div class="product-info">
<h3><?php the_title(); ?></h3>
<div class="price"><?php echo $product->get_price_html(); ?></div>
</div>
</a>
</div>
<?php endwhile; endif; ?>
</div>
</main>
</div>
<?php get_footer(); ?>