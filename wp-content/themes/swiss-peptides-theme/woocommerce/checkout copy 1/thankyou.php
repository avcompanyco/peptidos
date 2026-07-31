<?php
/**
 * WooCommerce Thank You / Order Confirmation
 */
get_header();
?>

<style>
.thankyou-wrap{padding:calc(var(--navbar-height) + 40px) 0 var(--space-4xl);min-height:60vh}
.thankyou-card{max-width:720px;margin:0 auto;background:var(--white);border:1px solid var(--border-color);border-radius:var(--radius-2xl);padding:var(--space-3xl);text-align:center}
.thankyou-icon{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#10B981,#059669);display:flex;align-items:center;justify-content:center;margin:0 auto var(--space-xl)}
.thankyou-icon svg{width:40px;height:40px;color:white}
.order-id{font-family:var(--font-heading);font-size:var(--fs-3xl);font-weight:800;color:var(--navy);margin:var(--space-md) 0}
.order-details{text-align:left;margin-top:var(--space-2xl);border-top:1px solid var(--border-subtle);padding-top:var(--space-xl)}
.order-detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:var(--space-lg);margin-top:var(--space-lg)}
.order-detail-item{padding:var(--space-md);background:var(--gray-50);border-radius:var(--radius-lg)}
.order-detail-label{font-size:var(--fs-xs);color:var(--text-muted);margin-bottom:4px;text-transform:uppercase;letter-spacing:.05em;font-weight:600}
.order-detail-value{font-weight:700;color:var(--navy);font-size:var(--fs-base)}
.order-items-table{width:100%;margin-top:var(--space-xl);text-align:left}
.order-items-table th{font-size:var(--fs-xs);text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);padding:var(--space-sm) 0;border-bottom:2px solid var(--border-color);font-weight:600}
.order-items-table td{padding:var(--space-md) 0;border-bottom:1px solid var(--border-subtle);font-size:var(--fs-sm);color:var(--text-secondary)}
.order-items-table .item-name{font-weight:600;color:var(--navy)}
.order-total-row td{font-family:var(--font-heading);font-weight:800;color:var(--navy);font-size:var(--fs-lg);border-bottom:none}
.thankyou-actions{display:flex;gap:var(--space-md);justify-content:center;margin-top:var(--space-2xl)}
@media(max-width:768px){.order-detail-grid{grid-template-columns:1fr}.thankyou-card{padding:var(--space-xl)}}
</style>

<section class="thankyou-wrap">
  <div class="container">
    <?php if (isset($order) && $order) : ?>
      <div class="thankyou-card">
        <!-- Success Icon -->
        <div class="thankyou-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>

        <p style="font-size:var(--fs-md);color:var(--success);font-weight:600;">Pedido confirmado</p>
        <div class="order-id">#<?php echo $order->get_order_number(); ?></div>
        <p style="color:var(--text-secondary);font-size:var(--fs-md);max-width:480px;margin:0 auto;">
          Gracias por tu compra, <strong><?php echo $order->get_billing_first_name(); ?></strong>. Hemos recibido tu pedido y te enviaremos una confirmacion a <strong><?php echo $order->get_billing_email(); ?></strong>.
        </p>

        <!-- Order Details -->
        <div class="order-details">
          <h3 style="font-family:var(--font-heading);font-weight:700;color:var(--navy);">Detalles del pedido</h3>

          <div class="order-detail-grid">
            <div class="order-detail-item">
              <div class="order-detail-label">Numero de pedido</div>
              <div class="order-detail-value">#<?php echo $order->get_order_number(); ?></div>
            </div>
            <div class="order-detail-item">
              <div class="order-detail-label">Fecha</div>
              <div class="order-detail-value"><?php echo wc_format_datetime($order->get_date_created()); ?></div>
            </div>
            <div class="order-detail-item">
              <div class="order-detail-label">Estado</div>
              <div class="order-detail-value" style="color:var(--success);">
                <?php echo wc_get_order_status_name($order->get_status()); ?>
              </div>
            </div>
            <div class="order-detail-item">
              <div class="order-detail-label">Metodo de pago</div>
              <div class="order-detail-value"><?php echo $order->get_payment_method_title(); ?></div>
            </div>
          </div>

          <!-- Shipping Address -->
          <?php if ($order->get_formatted_shipping_address()) : ?>
          <div style="margin-top:var(--space-lg);padding:var(--space-md);background:var(--gray-50);border-radius:var(--radius-lg);">
            <div class="order-detail-label">Direccion de envio</div>
            <div style="margin-top:4px;font-size:var(--fs-sm);color:var(--navy);">
              <?php echo $order->get_formatted_shipping_address(); ?>
            </div>
          </div>
          <?php endif; ?>

          <!-- Items -->
          <table class="order-items-table">
            <thead>
              <tr><th>Producto</th><th style="text-align:center;">Cant.</th><th style="text-align:right;">Total</th></tr>
            </thead>
            <tbody>
              <?php foreach ($order->get_items() as $item) :
                $product = $item->get_product();
              ?>
              <tr>
                <td class="item-name">
                  <?php echo $item->get_name(); ?>
                  <?php if ($product && $product->get_short_description()) : ?>
                    <br><span style="font-weight:400;color:var(--text-muted);font-size:var(--fs-xs);"><?php echo $product->get_short_description(); ?></span>
                  <?php endif; ?>
                </td>
                <td style="text-align:center;"><?php echo $item->get_quantity(); ?></td>
                <td style="text-align:right;font-weight:600;">$ <?php echo number_format($item->get_total(), 0, ',', '.'); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" style="font-size:var(--fs-sm);color:var(--text-muted);border-bottom:1px solid var(--border-subtle);">Subtotal</td>
                <td style="text-align:right;font-size:var(--fs-sm);border-bottom:1px solid var(--border-subtle);">$ <?php echo number_format($order->get_subtotal(), 0, ',', '.'); ?></td>
              </tr>
              <tr>
                <td colspan="2" style="font-size:var(--fs-sm);color:var(--text-muted);border-bottom:1px solid var(--border-subtle);">Envio</td>
                <td style="text-align:right;font-size:var(--fs-sm);color:var(--success);border-bottom:1px solid var(--border-subtle);">
                  <?php echo ($order->get_shipping_total() > 0) ? '$ '.number_format($order->get_shipping_total(), 0, ',', '.') : 'Gratis'; ?>
                </td>
              </tr>
              <tr class="order-total-row">
                <td colspan="2">Total</td>
                <td style="text-align:right;color:var(--accent);">$ <?php echo number_format($order->get_total(), 0, ',', '.'); ?></td>
              </tr>
            </tfoot>
          </table>
        </div>

        <!-- Actions -->
        <div class="thankyou-actions">
          <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn btn-primary btn-lg">Seguir comprando</a>
          <a href="https://wa.me/573126317694?text=<?php echo urlencode('Hola, acabo de realizar el pedido #'.$order->get_order_number().'. Quiero confirmar mi compra.'); ?>" target="_blank" class="btn btn-outline btn-lg">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            Confirmar por WhatsApp
          </a>
        </div>
      </div>

    <?php else : ?>
      <!-- No order -->
      <div class="thankyou-card">
        <div class="thankyou-icon" style="background:var(--gray-300);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
        </div>
        <h2 style="font-family:var(--font-heading);color:var(--navy);">No se encontro el pedido</h2>
        <p style="color:var(--text-secondary);margin:var(--space-md) 0;">Es posible que hayas llegado aqui por error.</p>
        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn btn-primary btn-lg">Ir a la tienda</a>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
