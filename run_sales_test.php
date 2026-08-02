<?php
require_once('/www/wwwroot/peptidossuizos.com/wp-load.php');

echo "=== STARTING FINAL MASTER SALES & DISPATCH SIMULATION ===\n";

// 1. Create a fresh WooCommerce Order
$order = wc_create_order();

// Add high-demand peptides to order
$order->add_product(wc_get_product(92), 2); // Tirzepatide 10mg x 2 ($ 1.800.000)
$order->add_product(wc_get_product(80), 1); // Retatrutide 10mg x 1 ($ 1.100.000)
$order->add_product(wc_get_product(25), 1); // Agua Bacteriostática 30ml x 1 ($ 75.000)

// Set billing and shipping address for Antonio Varona
$address = array(
    'first_name' => 'Antonio',
    'last_name'  => 'Varona',
    'email'      => 'antoniovarona@avcompany.co',
    'phone'      => '+57 318 916 3091',
    'address_1'  => 'Calle 100 # 15-20, Edificio Clinical Suite 402',
    'city'       => 'Bogotá, D.C.',
    'country'    => 'CO'
);

$order->set_address($address, 'billing');
$order->set_address($address, 'shipping');
$order->calculate_totals();

$order_id = $order->get_id();
echo "[+] Step 1: Order #" . $order_id . " created in WooCommerce with total $ " . number_format($order->get_total(), 0, ',', '.') . "\n";

// 2. Set status to processing (Triggers Email 1: Processing / Cotización Recibida)
$order->update_status('processing', 'Cotización y orden recibida vía WhatsApp / Sitio Web.');
echo "[+] Step 2: Order #" . $order_id . " set to 'processing'. Email 1 (Cotización / Pedido Recibido) sent to antoniovarona@avcompany.co!\n";

// 3. Attach Servientrega tracking guide #SERVI-9876543210CO
update_post_meta($order_id, '_sp_shipping_carrier', 'Servientrega');
update_post_meta($order_id, '_sp_tracking_number', 'SERVI-9876543210CO');
update_post_meta($order_id, '_sp_tracking_url', 'https://mobile.servientrega.com/WebSitePortal/RastreoEnvioDetalle.aspx?id=SERVI-9876543210CO');
echo "[+] Step 3: Attached Servientrega tracking guide #SERVI-9876543210CO to Order #" . $order_id . "\n";

// 4. Set status to completed (Triggers Email 2: Despachado con Guía de Rastreo)
$order->update_status('completed', 'Pedido despachado exitosamente con guía de rastreo.');
echo "[+] Step 4: Order #" . $order_id . " set to 'completed'. Email 2 (Despachado con Guía de Rastreo) sent to antoniovarona@avcompany.co!\n";

echo "=== FINAL MASTER SALES SIMULATION COMPLETED FOR ORDER #" . $order_id . "! ===\n";
?>