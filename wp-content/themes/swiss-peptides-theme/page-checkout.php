<?php
/**
 * Custom High-Conversion WhatsApp Checkout Page
 * Swiss Peptides Clinical Luxury 2026
 */
get_header();
?>

<style id="sp-whatsapp-checkout-style">
:root {
    --navy: #0f172a;
    --accent: #0284c7;
    --whatsapp-green: #25D366;
    --whatsapp-hover: #20bd5a;
    --border-color: #cbd5e1;
    --bg-light: #f8fafc;
}

body.woocommerce-checkout {
    background-color: var(--bg-light) !important;
    color: var(--navy) !important;
}

.sp-checkout-page {
    padding: calc(var(--navbar-height, 80px) + 30px) 0 80px 0;
    min-height: 85vh;
}
.sp-checkout-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}
.sp-checkout-breadcrumb {
    font-size: 0.88rem;
    color: #64748b;
    margin-bottom: 24px;
}
.sp-checkout-breadcrumb a {
    color: #64748b;
    text-decoration: none;
}

.sp-checkout-title {
    font-family: var(--font-heading, system-ui, sans-serif);
    font-size: clamp(2rem, 3.5vw, 2.6rem);
    font-weight: 800;
    color: var(--navy);
    margin-bottom: 32px;
}
.sp-checkout-title span {
    color: var(--accent);
}

.sp-checkout-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 40px;
    align-items: start;
}

.sp-checkout-card {
    background: #ffffff;
    border: 1.5px solid var(--border-color);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 24px;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
}

.sp-checkout-card-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--navy);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.sp-step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #e0f2fe;
    color: var(--accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    font-weight: 800;
}

/* Place Order Button - WHATSAPP GREEN STYLING */
#place_order {
    width: 100% !important;
    height: 60px !important;
    background: var(--whatsapp-green) !important;
    color: #ffffff !important;
    font-family: var(--font-heading, system-ui, sans-serif) !important;
    font-size: 1.15rem !important;
    font-weight: 800 !important;
    border: none !important;
    border-radius: 16px !important;
    cursor: pointer !important;
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    transition: all 0.3s ease !important;
    margin-top: 20px !important;
}
#place_order:hover {
    background: var(--whatsapp-hover) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 14px 35px rgba(37, 211, 102, 0.45) !important;
}

.sp-whatsapp-guarantee-note {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 16px;
    padding: 16px 20px;
    margin-top: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #166534;
    font-size: 0.9rem;
    font-weight: 600;
}
.sp-whatsapp-guarantee-note svg {
    width: 24px;
    height: 24px;
    flex-shrink: 0;
    color: var(--whatsapp-green);
}

.sp-order-summary {
    background: #ffffff;
    border: 1.5px solid var(--border-color);
    border-radius: 20px;
    padding: 30px;
    position: sticky;
    top: calc(var(--navbar-height, 80px) + 20px);
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
}
.sp-order-summary h3 {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--navy);
    margin-bottom: 20px;
}

@media (max-width: 1024px) {
    .sp-checkout-grid {
        grid-template-columns: 1fr;
    }
    .sp-order-summary {
        position: static;
        order: -1;
    }
}
@media (max-width: 640px) {
    .sp-checkout-container {
        padding: 0 16px;
    }
    .sp-checkout-card {
        padding: 20px;
    }
    #place_order {
        font-size: 1rem !important;
        height: 54px !important;
    }
}
</style>

<section class="sp-checkout-page">
  <div class="sp-checkout-container">
    
    <!-- Breadcrumb -->
    <nav class="sp-checkout-breadcrumb">
      <a href="<?php echo home_url(); ?>">Inicio</a>
      <span>/</span>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Tienda</a>
      <span>/</span>
      <a href="<?php echo wc_get_cart_url(); ?>">Carrito</a>
      <span>/</span>
      <span style="color:var(--navy);font-weight:700;">Confirmar Pedido por WhatsApp</span>
    </nav>

    <h1 class="sp-checkout-title">Finalizar y <span>Pagar por WhatsApp 📲</span></h1>

    <?php wc_print_notices(); ?>
    <?php do_action('woocommerce_before_checkout_form', WC()->checkout()); ?>

    <div class="sp-checkout-grid">
      
      <!-- LEFT: Checkout Form -->
      <div>
        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
          <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>

          <!-- Step 1: Contact & Delivery Info -->
          <div class="sp-checkout-card">
            <div class="sp-checkout-card-title">
              <span class="sp-step-num">1</span>Datos de Envío y Contacto
            </div>
            <?php do_action('woocommerce_checkout_billing'); ?>
          </div>

          <!-- Step 2: Payment Method (WhatsApp Direct) -->
          <div class="sp-checkout-card">
            <div class="sp-checkout-card-title">
              <span class="sp-step-num">2</span>Confirmación y Pago por WhatsApp
            </div>

            <div class="sp-whatsapp-guarantee-note">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
              <span>Tu venta quedará registrada de inmediato en WooCommerce. Al presionar el botón se abrirá WhatsApp con el resumen de tu compra para recibir la cuenta de Nequi, Daviplata, Bancolombia o PSE.</span>
            </div>

            <?php
            if (function_exists('woocommerce_checkout_payment')) {
                woocommerce_checkout_payment();
            }
            ?>
          </div>
        </form>
      </div>

      <!-- RIGHT: Order Summary -->
      <div class="sp-order-summary">
        <h3>Resumen de tu Pedido</h3>

        <div class="woocommerce-checkout-review-order">
          <?php woocommerce_order_review(); ?>
        </div>
      </div>

    </div>

  </div>
</section>

<?php get_footer(); ?>
