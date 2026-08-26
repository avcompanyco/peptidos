<?php
/**
 * Master Thank You & WhatsApp Order Dispatcher 2026
 * 100% Immune to Brave Shields & Adblockers (Dynamic JS Trigger, Neutral Semantic Markup)
 */

defined( 'ABSPATH' ) || exit;

// 1. Retrieve order securely
$order_id = 0;
if ( isset( $order ) && $order && is_a( $order, 'WC_Order' ) ) {
    $order_id = $order->get_id();
} else {
    global $wp;
    $order_id = absint( get_query_var( 'order-received' ) );
    if ( ! $order_id && isset( $wp->query_vars['order-received'] ) ) {
        $order_id = absint( $wp->query_vars['order-received'] );
    }
    if ( ! $order_id && isset( $_SERVER['REQUEST_URI'] ) && preg_match( '#/order-received/(\d+)#', $_SERVER['REQUEST_URI'], $m ) ) {
        $order_id = absint( $m[1] );
    }
    if ( $order_id > 0 ) {
        $order = wc_get_order( $order_id );
    }
}
?>

<style>
.sp-order-done-section {
  padding: 50px 20px 90px;
  background: #f8fafc;
  min-height: 85vh;
  font-family: 'Inter', system-ui, -apple-system, sans-serif;
  color: #0f172a;
}
.sp-order-done-container {
  max-width: 740px;
  margin: 0 auto;
}
.sp-order-done-card {
  background: #ffffff;
  border: 1.5px solid #e2e8f0;
  border-radius: 24px;
  padding: 40px 32px;
  box-shadow: 0 10px 40px rgba(15,23,42,0.06);
  text-align: center;
}
.sp-order-done-badge {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  background: linear-gradient(135deg, #10b981, #059669);
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  box-shadow: 0 8px 25px rgba(16,185,129,0.35);
}
.sp-btn-order-proceed {
  display: flex !important;
  visibility: visible !important;
  opacity: 1 !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 12px !important;
  background: linear-gradient(135deg, #10b981, #059669) !important;
  color: #ffffff !important;
  font-size: 1.12rem !important;
  font-weight: 900 !important;
  text-decoration: none !important;
  padding: 20px 32px !important;
  border-radius: 50px !important;
  box-shadow: 0 10px 30px rgba(16,185,129,0.45) !important;
  margin: 0 auto 16px auto !important;
  width: 100% !important;
  max-width: 580px !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
  cursor: pointer !important;
  border: none !important;
  box-sizing: border-box !important;
  transition: all 0.25s ease !important;
}
.sp-btn-order-proceed:hover {
  transform: translateY(-2px) !important;
  box-shadow: 0 14px 35px rgba(16,185,129,0.55) !important;
  background: linear-gradient(135deg, #059669, #047857) !important;
}
.sp-order-done-table {
  width: 100%;
  border-collapse: collapse;
  margin: 16px 0;
  text-align: left;
}
.sp-order-done-table th {
  background: #f8fafc;
  color: #64748b;
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 12px 14px;
  border-bottom: 1.5px solid #e2e8f0;
}
.sp-order-done-table td {
  padding: 14px;
  border-bottom: 1px solid #f1f5f9;
  font-size: 0.92rem;
  vertical-align: middle;
}
.sp-order-done-customer-box {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 20px;
  margin-top: 24px;
  text-align: left;
}
.sp-order-done-info-row {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px solid #edf2f7;
  font-size: 0.9rem;
}
.sp-order-done-info-row:last-child {
  border-bottom: none;
}
@media (max-width: 600px) {
  .sp-order-done-card { padding: 28px 18px; }
  .sp-btn-order-proceed { font-size: 0.95rem !important; padding: 16px 20px !important; }
}
</style>

<section class="sp-order-done-section">
  <div class="sp-order-done-container">
    <?php if ( isset( $order ) && $order ) :
        $order_id = $order->get_id();
        $first_name = $order->get_billing_first_name();
        $last_name = $order->get_billing_last_name();
        $full_name = trim( $first_name . ' ' . $last_name ) ?: 'Cliente VIP';
        $phone = $order->get_billing_phone() ?: 'No especificado';
        $email = $order->get_billing_email() ?: 'No especificado';
        $address = $order->get_billing_address_1() . ( $order->get_billing_address_2() ? ', ' . $order->get_billing_address_2() : '' );
        $city = $order->get_billing_city() ?: 'Colombia';
        $state_code = $order->get_billing_state();
        $states_co = ( function_exists( 'WC' ) && WC()->countries ) ? WC()->countries->get_states( 'CO' ) : array();
        $state_name = isset( $states_co[ $state_code ] ) ? $states_co[ $state_code ] : $state_code;
        $full_address = trim( $address . ' — ' . $city . ', ' . $state_name, ' — ,' );

        $date_obj = $order->get_date_created();
        $formatted_date = $date_obj ? date_i18n( 'd M Y, h:i A', $date_obj->getTimestamp() ) : date( 'd M Y' );
        $total_fmt = '$ ' . number_format( $order->get_total(), 0, ',', '.' );

        // Build structured message lines
        $ws_lines = array();
        $ws_lines[] = "👋 *¡Hola Swiss Peptides Colombia!* Acabo de registrar mi pedido en la página:";
        $ws_lines[] = "";
        $ws_lines[] = "📋 *ORDEN:* #" . $order_id;
        $ws_lines[] = "👤 *Cliente:* " . $full_name;
        $ws_lines[] = "📱 *WhatsApp:* " . $phone;
        $ws_lines[] = "📍 *Dirección:* " . $full_address;
        $ws_lines[] = "";
        $ws_lines[] = "🔬 *DETALLE DE PRODUCTOS:*";

        foreach ( $order->get_items() as $item ) {
            $prod_name = $item->get_name();
            $qty = $item->get_quantity();
            $line_total = '$ ' . number_format( $item->get_total(), 0, ',', '.' );
            $ws_lines[] = "• " . $prod_name . " x" . $qty . " — " . $line_total;
        }

        $ws_lines[] = "";
        $ws_lines[] = "🚚 *Envío:* GRATIS a todo Colombia";
        $ws_lines[] = "💰 *TOTAL A PAGAR:* " . $total_fmt . " COP";
        $ws_lines[] = "";
        $ws_lines[] = "Por favor confírmenme el despacho y las instrucciones de pago por transferencia / contraentrega. ¡Muchas gracias!";

        $full_ws_text = implode( "
", $ws_lines );
        $ws_text_encoded = base64_encode( $full_ws_text );
    ?>
      <div class="sp-order-done-card">
        <div class="sp-order-done-badge">
          <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>

        <h1 style="font-size:1.85rem;font-weight:900;color:#0f172a;margin:0 0 8px;line-height:1.2;">¡Pedido #<?php echo esc_html( $order_id ); ?> Registrado con Éxito!</h1>
        <p style="font-size:0.96rem;color:#64748b;margin:0 0 24px;line-height:1.5;">
          Gracias <strong><?php echo esc_html( $full_name ); ?></strong>. Tu orden ha sido reservada. Haz clic en el botón verde a continuación para enviar tu pedido por WhatsApp y coordinar el despacho inmediato:
        </p>

        <!-- 100% BRAVE-PROOF & ADBLOCK-PROOF TRIGGER BUTTON -->
        <button type="button" class="sp-btn-order-proceed" id="spConfirmOrderBtn" onclick="spDispatchOrderWhatsApp()">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink:0;"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
          CONTINUAR Y CONFIRMAR POR WHATSAPP
        </button>
        <div style="font-size:0.85rem;color:#64748b;margin-bottom:28px;">(Haz clic en el botón para abrir WhatsApp con los datos de tu orden)</div>

        <!-- 3. Full Detailed Itemized Table -->
        <div style="background:#ffffff;border:1px solid #e2e8f0;border-radius:18px;overflow:hidden;margin-bottom:24px;box-shadow:0 4px 15px rgba(15,23,42,0.03);">
          <div style="background:#0f172a;color:#ffffff;padding:14px 20px;font-weight:800;font-size:0.95rem;text-align:left;display:flex;justify-content:space-between;align-items:center;">
            <span>PRODUCTOS INCLUIDOS EN LA ORDEN</span>
            <span style="font-size:0.8rem;color:#38bdf8;font-weight:700;">PUREZA &ge;99% HPLC</span>
          </div>
          <table class="sp-order-done-table">
            <thead>
              <tr>
                <th style="width:60px;">Foto</th>
                <th>Producto</th>
                <th style="text-align:center;">Cant.</th>
                <th style="text-align:right;">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ( $order->get_items() as $item ) :
                  $prod = $item->get_product();
                  $thumb_url = $prod ? wp_get_attachment_image_url( $prod->get_image_id(), 'thumbnail' ) : '';
                  if ( empty( $thumb_url ) ) $thumb_url = 'https://peptidossuizos.com/wp-content/uploads/2026/05/monttide_perfect_ai_v2_1784993894-150x150.jpg';
              ?>
              <tr>
                <td style="padding:10px 14px;">
                  <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $item->get_name() ); ?>" style="width:48px;height:48px;border-radius:10px;object-fit:cover;border:1px solid #e2e8f0;display:block;">
                </td>
                <td style="font-weight:700;color:#0f172a;">
                  <?php echo esc_html( $item->get_name() ); ?>
                </td>
                <td style="text-align:center;font-weight:800;color:#334155;">
                  <?php echo $item->get_quantity(); ?>
                </td>
                <td style="text-align:right;font-weight:800;color:#0284c7;">
                  $ <?php echo number_format( $item->get_total(), 0, ',', '.' ); ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" style="font-weight:700;color:#64748b;text-align:right;padding:12px 14px;border-top:1.5px solid #e2e8f0;">Envío Express Colombia:</td>
                <td style="text-align:right;font-weight:800;color:#10b981;padding:12px 14px;border-top:1.5px solid #e2e8f0;">GRATIS</td>
              </tr>
              <tr style="background:#f8fafc;">
                <td colspan="3" style="font-weight:900;color:#0f172a;font-size:1.1rem;text-align:right;padding:14px;">TOTAL OFICIAL:</td>
                <td style="text-align:right;font-weight:900;color:#0284c7;font-size:1.25rem;padding:14px;"><?php echo $total_fmt; ?></td>
              </tr>
            </tfoot>
          </table>
        </div>

        <!-- 4. Customer & Delivery Information Card -->
        <div class="sp-order-done-customer-box">
          <div style="font-weight:800;color:#0f172a;margin-bottom:14px;font-size:1rem;display:flex;align-items:center;gap:8px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Datos de Entrega y Contacto
          </div>
          <div class="sp-order-done-info-row">
            <span style="color:#64748b;font-weight:600;">Cliente:</span>
            <strong style="color:#0f172a;"><?php echo esc_html( $full_name ); ?></strong>
          </div>
          <div class="sp-order-done-info-row">
            <span style="color:#64748b;font-weight:600;">Teléfono / WhatsApp:</span>
            <strong style="color:#0f172a;"><?php echo esc_html( $phone ); ?></strong>
          </div>
          <div class="sp-order-done-info-row">
            <span style="color:#64748b;font-weight:600;">Correo Electrónico:</span>
            <strong style="color:#0f172a;"><?php echo esc_html( $email ); ?></strong>
          </div>
          <div class="sp-order-done-info-row">
            <span style="color:#64748b;font-weight:600;">Dirección de Entrega:</span>
            <strong style="color:#0f172a;text-align:right;max-width:340px;"><?php echo esc_html( $full_address ); ?></strong>
          </div>
          <div class="sp-order-done-info-row">
            <span style="color:#64748b;font-weight:600;">Fecha de Registro:</span>
            <span style="color:#0f172a;font-weight:600;"><?php echo esc_html( $formatted_date ); ?></span>
          </div>
        </div>

        <div style="margin-top:28px;">
          <a href="<?php echo home_url('/tienda/'); ?>" style="color:#64748b;font-size:0.9rem;font-weight:600;text-decoration:underline;">Volver al Catálogo de Péptidos</a>
        </div>

      </div>

      <script>
      function spDispatchOrderWhatsApp() {
        var base64Text = "<?php echo $ws_text_encoded; ?>";
        var rawText = decodeURIComponent(escape(window.atob(base64Text)));
        var phone = "573189163091";
        var url = "https://" + "api" + "." + "whatsapp" + ".com/send?phone=" + phone + "&text=" + encodeURIComponent(rawText);
        window.open(url, '_blank');
      }
      </script>

    <?php else : ?>
      <div class="sp-order-done-card">
        <h2 style="font-size:1.4rem;font-weight:800;color:#0f172a;margin-bottom:12px;">Solicitud no encontrada</h2>
        <p style="color:#64748b;margin-bottom:20px;">No pudimos cargar los detalles de este pedido.</p>
        <a href="<?php echo home_url('/tienda/'); ?>" style="display:inline-block;background:#0284c7;color:#fff;padding:12px 24px;border-radius:50px;text-decoration:none;font-weight:700;">Ir a la Tienda</a>
      </div>
    <?php endif; ?>
  </div>
</section>
