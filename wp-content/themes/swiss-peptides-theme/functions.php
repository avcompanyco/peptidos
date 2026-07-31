<?php
/**
 * Swiss Peptides Colombia — Theme Functions
 * WooCommerce + Stripe Integration
 */

// ─── Theme Setup ────────────────────────────────────────────────
function sp_setup() {
    
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus([
        'primary' => 'Menu Principal',
    ]);

    // Image sizes
    add_image_size('product-card', 400, 400, false);
    add_image_size('product-hero', 800, 800, false);
    add_image_size('hero-banner', 1400, 700, true);
}
add_action('after_setup_theme', 'sp_setup');

// ─── Scripts & Styles ───────────────────────────────────────────
function sp_enqueue() {
    
    // Google Fonts
    wp_enqueue_style('sp-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@300;400;500;600;700;800&display=swap', [], null);

    // Main CSS
    $v = '2.1.' . time();
    wp_enqueue_style('sp-main', get_template_directory_uri() . '/css/main.css', [], $v);
    wp_enqueue_style('sp-animations', get_template_directory_uri() . '/css/animations.css', ['sp-main'], $v);
    wp_enqueue_style('sp-responsive', get_template_directory_uri() . '/css/responsive.css', ['sp-main'], $v);
    wp_enqueue_style('sp-woo', get_template_directory_uri() . '/css/woo-overrides.css', ['sp-main'], $v);

    // Theme JS
    wp_enqueue_script('sp-app', get_template_directory_uri() . '/js/app.js', [], $v, true);

    // Pass WooCommerce data to JS
    wp_localize_script('sp-app', 'SP_DATA', [
        'ajax_url'   => admin_url('admin-ajax.php'),
        'wc_ajax_url' => home_url('/?wc-ajax='),
        'wc_ajax'    => class_exists('WC_AJAX') ? WC_AJAX::get_endpoint('%%endpoint%%') : '',
        'nonce'      => wp_create_nonce('sp-nonce'),
        'cart_url'   => function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/'),
        'checkout_url' => function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/'),
        'currency'   => function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '$',
        'free_shipping_min' => 0,
        'whatsapp'   => '573189163091',
    ]);
}
add_action('wp_enqueue_scripts', 'sp_enqueue');

// ─── WooCommerce Overrides ──────────────────────────────────────

// Remove default WooCommerce styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Remove default wrapper
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Custom wrappers
function sp_woo_wrapper_start() {
    
    echo '<section class="section"><div class="container">';
}
function sp_woo_wrapper_end() {
    
    echo '</div></section>';
}
add_action('woocommerce_before_main_content', 'sp_woo_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'sp_woo_wrapper_end', 10);

// ─── Cart AJAX ──────────────────────────────────────────────────

function sp_add_to_cart() {
    
    $product_id = absint($_POST['product_id']);
    $qty = absint($_POST['qty'] ?? 1);

    if (!$product_id) wp_send_json_error('Invalid product');

    $added = (function_exists('WC') && WC()->cart) ? WC()->cart->add_to_cart($product_id, $qty) : false;

    if ($added) {
        if (function_exists('WC') && WC()->cart) WC()->cart->calculate_totals();
        wp_send_json_success([
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total(),
            'cart_total_raw' => WC()->cart->get_cart_contents_total(),
            'fragments' => sp_get_cart_fragments(),
        ]);
    } else {
        wp_send_json_error('Could not add to cart');
    }
}
add_action('wp_ajax_sp_add_to_cart', 'sp_add_to_cart');
add_action('wp_ajax_nopriv_sp_add_to_cart', 'sp_add_to_cart');
add_action('wc_ajax_sp_add_to_cart', 'sp_add_to_cart');

function sp_get_cart() {
    
    if (function_exists('WC') && WC()->cart) WC()->cart->calculate_totals();
    wp_send_json_success([
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total(),
        'cart_total_raw' => WC()->cart->get_cart_contents_total(),
        'fragments' => sp_get_cart_fragments(),
    ]);
}
add_action('wp_ajax_sp_get_cart', 'sp_get_cart');
add_action('wp_ajax_nopriv_sp_get_cart', 'sp_get_cart');
add_action('wc_ajax_sp_get_cart', 'sp_get_cart');

function sp_update_cart_item() {
    
    $cart_key = sanitize_text_field($_POST['cart_key']);
    $qty = absint($_POST['qty']);

    if ($qty < 1) {
        WC()->cart->remove_cart_item($cart_key);
    } else {
        WC()->cart->set_quantity($cart_key, $qty);
    }

    if (function_exists('WC') && WC()->cart) WC()->cart->calculate_totals();
    wp_send_json_success([
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total(),
        'cart_total_raw' => WC()->cart->get_cart_contents_total(),
        'fragments' => sp_get_cart_fragments(),
    ]);
}
add_action('wp_ajax_sp_update_cart_item', 'sp_update_cart_item');
add_action('wp_ajax_nopriv_sp_update_cart_item', 'sp_update_cart_item');
add_action('wc_ajax_sp_update_cart_item', 'sp_update_cart_item');

function sp_remove_cart_item() {
    
    $cart_key = sanitize_text_field($_POST['cart_key']);
    WC()->cart->remove_cart_item($cart_key);
    if (function_exists('WC') && WC()->cart) WC()->cart->calculate_totals();
    wp_send_json_success([
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total(),
        'cart_total_raw' => WC()->cart->get_cart_contents_total(),
        'fragments' => sp_get_cart_fragments(),
    ]);
}
add_action('wp_ajax_sp_remove_cart_item', 'sp_remove_cart_item');
add_action('wp_ajax_nopriv_sp_remove_cart_item', 'sp_remove_cart_item');
add_action('wc_ajax_sp_remove_cart_item', 'sp_remove_cart_item');

function sp_get_cart_fragments() {
    
    $items = [];
    foreach (WC()->cart->get_cart() as $key => $item) {
        $product = $item['data'];
        $items[] = [
            'key'       => $key,
            'id'        => $item['product_id'],
            'name'      => $product->get_name(),
            'price'     => (float) $product->get_price(),
            'qty'       => $item['quantity'],
            'subtotal'  => (float) $item['line_total'],
            'image'     => wp_get_attachment_image_url($product->get_image_id(), 'product-card') ?: wc_placeholder_img_src(),
            'permalink' => $product->get_permalink(),
        ];
    }
    return $items;
}

// ─── Custom Product Meta ────────────────────────────────────────

function sp_product_meta_boxes() {
    
    add_meta_box('sp_peptide_specs', 'Especificaciones del Péptido', 'sp_render_specs_meta', 'product', 'normal', 'high');
}
add_action('add_meta_boxes', 'sp_product_meta_boxes');

function sp_render_specs_meta($post) {
    wp_nonce_field('sp_specs_nonce', 'sp_specs_nonce_field');
    $fields = [
        'sp_purity' => 'Pureza (ej: ≥98%)',
        'sp_content' => 'Contenido (ej: 50mg por unidad)',
        'sp_molecular' => 'Fórmula Molecular',
        'sp_mol_weight' => 'Peso Molecular',
        'sp_storage' => 'Almacenamiento',
    ];
    echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;padding:10px;">';
    foreach ($fields as $key => $label) {
        $val = get_post_meta($post->ID, $key, true);
        echo "<div><label style='font-weight:600;display:block;margin-bottom:4px;'>$label</label>";
        echo "<input type='text' name='$key' value='" . esc_attr($val) . "' style='width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;'></div>";
    }
    echo '</div>';

    // Benefits
    $benefits = get_post_meta($post->ID, 'sp_benefits', true);
    echo '<div style="padding:10px;margin-top:10px;">';
    echo '<label style="font-weight:600;display:block;margin-bottom:4px;">Beneficios (uno por línea)</label>';
    echo '<textarea name="sp_benefits" rows="6" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">' . esc_textarea($benefits) . '</textarea>';
    echo '</div>';
}

function sp_save_specs_meta($post_id) {
    if (!isset($_POST['sp_specs_nonce_field']) || !wp_verify_nonce($_POST['sp_specs_nonce_field'], 'sp_specs_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $fields = ['sp_purity', 'sp_content', 'sp_molecular', 'sp_mol_weight', 'sp_storage', 'sp_benefits'];
    foreach ($fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_textarea_field($_POST[$key]));
        }
    }
}
add_action('save_post_product', 'sp_save_specs_meta');

// ─── Related Products Config ────────────────────────────────────
function sp_related_products_args($args) {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    $args['orderby'] = 'rand';
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'sp_related_products_args');

// ─── Shipping Setup ─────────────────────────────────────────────
function sp_free_shipping_threshold() {
    
    return 0;
}

// ─── Disable default sidebar ────────────────────────────────────
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// ─── Custom Order Columns for Admin ─────────────────────────────
function sp_admin_styles() {
    
    echo '<style>
        #adminmenu .wp-menu-name { font-size: 13px; }
        .woocommerce-layout__header { background: #0B1D3A !important; }
    </style>';
}
add_action('admin_head', 'sp_admin_styles');

// ─── WooCommerce Email Customization ────────────────────────────
function sp_email_from_name() {
    
    return 'Swiss Peptides Colombia';
}
add_filter('woocommerce_email_from_name', 'sp_email_from_name');

function sp_email_from_address() {
    
    return 'pedidos@peptidossuizos.com';
}
add_filter('woocommerce_email_from_address', 'sp_email_from_address');

// ─── Contact Form AJAX Handler ──────────────────────────────────
function sp_contact_form() {
    
    check_ajax_referer('sp-nonce', 'nonce');

    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $city    = sanitize_text_field($_POST['city'] ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? 'Contacto Web');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (!$name || !$email || !$message) {
        wp_send_json_error('Campos requeridos incompletos');
    }

    $to = 'pedidos@peptidossuizos.com';
    $email_subject = '[Swiss Peptides Colombia] ' . $subject;
    $body = "Nuevo mensaje de contacto desde peptidossuizos.com\n\n";
    $body .= "Nombre: $name\n";
    $body .= "Email: $email\n";
    $body .= "Teléfono: $phone\n";
    $body .= "Ciudad: $city\n";
    $body .= "Asunto: $subject\n\n";
    $body .= "Mensaje:\n$message\n";

    $headers = [
        'From: Swiss Peptides Colombia <pedidos@peptidossuizos.com>',
        'Reply-To: ' . $name . ' <' . $email . '>',
        'Content-Type: text/plain; charset=UTF-8',
    ];

    $sent = wp_mail($to, $email_subject, $body, $headers);

    if ($sent) {
        wp_send_json_success('Mensaje enviado correctamente');
    } else {
        wp_send_json_error('Error al enviar. Intenta por WhatsApp.');
    }
}
add_action('wp_ajax_sp_contact_form', 'sp_contact_form');
add_action('wp_ajax_nopriv_sp_contact_form', 'sp_contact_form');

// ─── Spanish Translation Filters ───────────────────────────────
function sp_translate_wc_strings($translated, $text, $domain) {
    if ($domain !== 'woocommerce') return $translated;

    $translations = [
        // Cart page
        'Product'           => 'Producto',
        'Price'             => 'Precio',
        'Quantity'          => 'Cantidad',
        'Subtotal'          => 'Subtotal',
        'Total'             => 'Total',
        'Apply coupon'      => 'Aplicar cupón',
        'Update cart'       => 'Actualizar carrito',
        'Cart totals'       => 'Total del carrito',
        'Cart'              => 'Carrito',
        'Coupon code'       => 'Código de cupón',
        'Proceed to checkout' => 'Finalizar compra',
        'Free shipping'     => 'Envío gratis',
        'Free!'             => '¡Gratis!',
        'Flat rate'         => 'Tarifa fija',
        'Shipping'          => 'Envío',
        'Shipment'          => 'Envío',
        'Change address'    => 'Cambiar dirección',
        'Remove this item'  => 'Eliminar este producto',
        'Your cart is currently empty.' => 'Tu carrito está vacío.',
        'Return to shop'    => 'Volver a la tienda',
        'No products in the cart.' => 'No hay productos en el carrito.',
        'View cart'         => 'Ver carrito',
        'Coupon'            => 'Cupón',
        'Coupon code'       => 'Código de cupón',
        'Discount'          => 'Descuento',
        'has been removed from your cart' => 'fue eliminado de tu carrito',
        'removed'           => 'eliminado',
        'Undo?'             => '¿Deshacer?',
        
        // Checkout
        'Checkout'          => 'Finalizar compra',
        'Billing details'   => 'Datos de facturación',
        'Billing &amp; Shipping' => 'Facturación y envío',
        'Ship to a different address?' => '¿Enviar a otra dirección?',
        'Additional information' => 'Información adicional',
        'Your order'        => 'Tu pedido',
        'Order notes'       => 'Notas del pedido',
        'Notes about your order, e.g. special notes for delivery.' => 'Notas sobre tu pedido, ej: instrucciones de entrega.',
        'Place order'       => 'Realizar pedido',
        'Sorry, your session has expired.' => 'Lo sentimos, tu sesión ha expirado.',
        'Have a coupon?'    => '¿Tienes un cupón?',
        'Click here to enter your code' => 'Haz clic aquí para ingresarlo',
        
        // Fields
        'First name'        => 'Nombre',
        'Last name'         => 'Apellidos',
        'Company name'      => 'Empresa',
        'Country / Region'  => 'País / Región',
        'Street address'    => 'Dirección',
        'House number and street name' => 'Número y nombre de la calle',
        'Apartment, suite, unit, etc. (optional)' => 'Apartamento, suite, etc. (opcional)',
        'Town / City'       => 'Ciudad',
        'State / County'    => 'Departamento',
        'State'             => 'Departamento',
        'Department'        => 'Departamento',
        'Postcode / ZIP'    => 'Código postal',
        'Phone'             => 'Teléfono',
        'Email address'     => 'Correo electrónico',
        'Create an account?' => '¿Crear una cuenta?',
        
        // Product
        'Add to cart'       => 'Agregar al carrito',
        'Read more'         => 'Ver más',
        'Description'       => 'Descripción',
        'Additional information' => 'Información adicional',
        'Reviews'           => 'Reseñas',
        'Related products'  => 'Productos relacionados',
        'You may also like&hellip;' => 'También te puede interesar…',
        'Category:'         => 'Categoría:',
        'Categories:'       => 'Categorías:',
        'Tag:'              => 'Etiqueta:',
        'Tags:'             => 'Etiquetas:',
        'SKU:'              => 'SKU:',
        'N/A'               => 'N/D',
        'In stock'          => 'En stock',
        'Out of stock'      => 'Agotado',
        'on backorder'      => 'bajo pedido',
        
        // Account
        'Username or email address' => 'Usuario o correo electrónico',
        'Password'          => 'Contraseña',
        'Remember me'       => 'Recordarme',
        'Log in'            => 'Iniciar sesión',
        'Lost your password?' => '¿Olvidaste tu contraseña?',
        'My account'        => 'Mi cuenta',
        'Dashboard'         => 'Panel',
        'Orders'            => 'Pedidos',
        'Downloads'         => 'Descargas',
        'Addresses'         => 'Direcciones',
        'Account details'   => 'Datos de la cuenta',
        'Log out'           => 'Cerrar sesión',
        
        // Messages
        'has been added to your cart.' => 'fue agregado al carrito.',
        'View cart'         => 'Ver carrito',
        'Continue shopping'         => 'Seguir comprando',
        'Thank you. Your order has been received.' => 'Gracias. Tu pedido ha sido recibido.',
        'Order received'    => 'Pedido recibido',
        
        // Search & Filter
        'Search products&hellip;' => 'Buscar productos…',
        'Search'            => 'Buscar',
        'No products were found matching your selection.' => 'No se encontraron productos con esos criterios.',
        'Showing all'       => 'Mostrando todos',
        'Showing the single result' => 'Mostrando un resultado',
        'results'           => 'resultados',
        'Default sorting'   => 'Orden predeterminado',
        'Sort by popularity' => 'Ordenar por popularidad',
        'Sort by average rating' => 'Ordenar por calificación',
        'Sort by latest'    => 'Ordenar por más recientes',
        'Sort by price: low to high' => 'Ordenar por precio: menor a mayor',
        'Sort by price: high to low' => 'Ordenar por precio: mayor a menor',
        
        // Validation
        'is a required field' => 'es un campo obligatorio',
        'Please enter a valid email address.' => 'Ingresa un correo electrónico válido.',
        'Please enter a valid phone number.' => 'Ingresa un número de teléfono válido.',
        'Please enter a valid postcode / ZIP.' => 'Ingresa un código postal válido.',

        // Payment / Checkout
        'Place order'       => 'Realizar pedido',
        'Credit / Debit Card' => 'Tarjeta de crédito / débito',
        'Credit or debit card' => 'Tarjeta de crédito o débito',
        'Card number'       => 'Número de tarjeta',
        'Expiry date'       => 'Fecha de vencimiento',
        'Card code'         => 'Código de seguridad',
        'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our %s.' => 'Tus datos personales se usarán para procesar tu pedido, mejorar tu experiencia en este sitio y para otros fines descritos en nuestra %s.',
        'privacy policy'    => 'política de privacidad',

        // Misc
        '(optional)'        => '(opcional)',
        
        // Email translations
        'Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:' => 'Gracias por tu pedido. Está en espera hasta que confirmemos que se ha recibido el pago. Mientras tanto, aquí tienes un recordatorio de lo que pediste:',
        'Your order has been received and is now being processed. Your order details are shown below for your reference:' => 'Tu pedido ha sido recibido y ahora se está procesando. Los detalles de tu pedido se muestran a continuación para tu referencia:',
        'We have finished processing your order.' => 'Hemos terminado de procesar tu pedido.',
        'Your order is complete. Your order details are shown below for your reference:' => 'Tu pedido está completo y listo para envío. Los detalles de tu pedido se muestran a continuación para tu referencia:',
        'A note has been added to your order:' => 'Se ha añadido una nota a tu pedido:',
        'For your reference, here’s the note:' => 'Para tu referencia, aquí está la nota:',
        'Hi %s, your Swiss Peptides Colombia account has been created!' => '¡Hola %s, tu cuenta de Swiss Peptides Colombia ha sido creada!',
        'Your username is %s' => 'Tu nombre de usuario es %s',
        'You can access your account area to view your orders, change your password, and more at: %s' => 'Puedes acceder al área de tu cuenta para ver tus pedidos, cambiar tu contraseña y más en: %s',
        'We look forward to seeing you soon.' => 'Esperamos verte pronto.',
        'Someone has requested a password reset for the following account:' => 'Alguien ha solicitado restablecer la contraseña para la siguiente cuenta:',
        'If this was a mistake, just ignore this email and nothing will happen.' => 'Si esto fue un error, simplemente ignora este correo y no pasará nada.',
        'To reset your password, visit the following address:' => 'Para restablecer tu contraseña, visita la siguiente dirección:',
        'Click here to reset your password' => 'Haz clic aquí para restablecer tu contraseña',
        'Your password has been automatically generated: %s' => 'Tu contraseña se ha generado automáticamente: %s',
        'Your password reset request' => 'Tu solicitud de restablecimiento de contraseña',
        'Password reset instructions' => 'Instrucciones para restablecer la contraseña',

        // New Account Email (improvements)
        'Your {site_title} account has been created!' => '¡Tu cuenta de {site_title} ha sido creada!',
        'Welcome to {site_title}' => 'Bienvenido a {site_title}',
        'Thanks for creating an account on %s. Here’s a copy of your user details.' => 'Gracias por crear una cuenta en %s. Aquí tienes una copia de tus datos de usuario.',
        'Set your new password.' => 'Establece tu nueva contraseña.',
        'You can access your account area to view orders, change your password, and more via the link below:' => 'Puedes acceder a tu área de cuenta para ver pedidos, cambiar tu contraseña y más a través del siguiente enlace:',
        'My account' => 'Mi cuenta',
        'Click here to set your new password.' => 'Haz clic aquí para establecer tu nueva contraseña.',
        'Thanks for creating an account on %1$s. Your username is %2$s. You can access your account area to view orders, change your password, and more at: %3$s' => 'Gracias por crear una cuenta en %1$s. Tu nombre de usuario es %2$s. Puedes acceder al área de tu cuenta para ver pedidos, cambiar tu contraseña y más en: %3$s',

        // Reset Password Email (improvements)
        'Someone has requested a new password for the following account on %s:' => 'Alguien ha solicitado una nueva contraseña para la siguiente cuenta en %s:',
        'Username: <b>%s</b>' => 'Usuario: <b>%s</b>',
        'Username: %s' => 'Usuario: %s',
        'Username' => 'Usuario',
        'Username:' => 'Usuario:',
        'If you didn’t make this request, just ignore this email. If you’d like to proceed, reset your password via the link below:' => 'Si no realizaste esta solicitud, simplemente ignora este correo. Si deseas continuar, restablece tu contraseña mediante el siguiente enlace:',
        'If you didn\'t make this request, just ignore this email. If you\'d like to proceed:' => 'Si no realizaste esta solicitud, simplemente ignora este correo. Si deseas continuar:',
        'Reset your password' => 'Restablecer tu contraseña',
        'Reset password' => 'Restablecer contraseña',
        'Reset your password for {site_title}' => 'Restablece la contraseña para {site_title}',
        'Password Reset Request for {site_title}' => 'Solicitud de restablecimiento de contraseña para {site_title}',
        'Password Reset Request' => 'Solicitud de restablecimiento de contraseña',
        'Thanks for reading.' => 'Gracias por leerlo.',

        // Processing Order Email (improvements)
        'Your {site_title} order has been received!' => '¡Tu pedido de {site_title} ha sido recibido!',
        'Thank you for your order' => 'Gracias por tu compra',
        'Just to let you know &mdash; we’ve received your order, and it is now being processed.' => 'Para tu información: hemos recibido tu pedido y ahora se está procesando.',
        'Here’s a reminder of what you’ve ordered:' => 'Aquí tienes un recordatorio de lo que has pedido:',
        'Just to let you know &mdash; we\'ve received your order #%s, and it is now being processed:' => 'Para tu información: hemos recibido tu pedido #%s y ahora se está procesando:',
        'Thanks again! If you need any help with your order, please contact us at {store_email}.' => '¡Gracias de nuevo! Si necesitas ayuda con tu pedido, contáctanos en {store_email}.',
        'Thanks for using {site_url}!' => '¡Gracias por comprar en {site_url}!',

        // Completed Order Email (improvements)
        'Your order from {site_title} is on its way!' => '¡Tu pedido de {site_title} está en camino!',
        'Your {site_title} order is now complete' => 'Tu pedido de {site_title} ya está completo',
        'Good things are heading your way!' => '¡Buenas noticias, tu pedido va en camino!',
        'Thanks for shopping with us' => 'Gracias por comprar con nosotros',
        'Thanks for shopping with us.' => 'Gracias por comprar con nosotros.',

        // On Hold Order Email (improvements)
        'We’ve received your order and it’s currently on hold until we can confirm your payment has been processed.' => 'Hemos recibido tu pedido y actualmente está en espera hasta que confirmemos que tu pago ha sido procesado.',
        'Thanks for your order. It’s on-hold until we confirm that payment has been received.' => 'Gracias por tu pedido. Está en espera hasta que confirmemos que se ha recibido el pago.',
        'Your order from {site_title} is on hold' => 'Tu pedido de {site_title} está en espera',
        'Payment confirmation pending' => 'Confirmación de pago pendiente',
        'We look forward to fulfilling your order soon.' => 'Esperamos procesar tu pedido muy pronto.',

        // Customer Note Email (improvements)
        'The following note has been added to your order:' => 'Se ha añadido la siguiente nota a tu pedido:',
        'As a reminder, here are your order details:' => 'Como recordatorio, aquí tienes los detalles de tu pedido:',
        'A note has been added to your order from {site_title}' => 'Se ha añadido una nota a tu pedido de {site_title}',
        'Note added to your {site_title} order from {order_date}' => 'Nota añadida a tu pedido de {site_title} del {order_date}',
        'A note has been added to your order' => 'Se ha añadido una nota a tu pedido',
        'Send an email to customers notifying them when you’ve added a note to their order' => 'Enviar un correo a los clientes notificándoles cuando añades una nota a su pedido',
    ];

    if (isset($translations[$text])) {
        return $translations[$text];
    }

    return $translated;
}
add_filter('gettext', 'sp_translate_wc_strings', 20, 3);

// Also translate Stripe gateway strings
function sp_translate_stripe_strings($translated, $text, $domain) {
    if ($domain !== 'woocommerce-gateway-stripe') return $translated;

    $translations = [
        'Credit / Debit Card' => 'Tarjeta de crédito / débito',
        'Credit or debit card' => 'Tarjeta de crédito o débito',
        'Card number'       => 'Número de tarjeta',
        'Expiry date'       => 'Fecha de vencimiento',
        'Card code'         => 'Código de seguridad',
        'Test mode'         => 'Modo de prueba',
        'Pay with credit card' => 'Pagar con tarjeta de crédito',
        'Stripe'            => 'Stripe',
        'Use a new payment method' => 'Usar un nuevo método de pago',
        'Save payment information to my account for future purchases.' => 'Guardar información de pago en mi cuenta para futuras compras.',
        'There was an error processing the payment: ' => 'Hubo un error al procesar el pago: ',
        'The transaction amount is too high for this payment method. Please choose a different payment method and try again.' => 'El monto es demasiado alto para este método de pago. Intenta con otro método.',
    ];

    return $translations[$text] ?? $translated;
}
add_filter('gettext', 'sp_translate_stripe_strings', 20, 3);

// Translate Stripe API error messages (card errors)
function sp_translate_stripe_errors($message) {
    $errors = [
        'The card number is incorrect.' => 'El número de tarjeta es incorrecto.',
        'The card has been declined.' => 'La tarjeta fue rechazada.',
        'The card has expired.' => 'La tarjeta ha expirado.',
        'The card was declined.' => 'La tarjeta fue rechazada.',
        "Your card's security code is incorrect." => 'El código de seguridad de tu tarjeta es incorrecto.',
        "Your card number is incomplete." => 'El número de tarjeta está incompleto.',
        "Your card's expiration date is incomplete." => 'La fecha de vencimiento está incompleta.',
        "Your card's expiration year is in the past." => 'El año de vencimiento ya pasó.',
        'Your card does not support this type of purchase.' => 'Tu tarjeta no soporta este tipo de compra.',
        'An error occurred while processing your card. Try again in a little bit.' => 'Ocurrió un error al procesar tu tarjeta. Intenta de nuevo.',
        'Your card has insufficient funds.' => 'Tu tarjeta no tiene fondos suficientes.',
    ];
    foreach ($errors as $en => $es) {
        $message = str_replace($en, $es, $message);
    }
    // Generic prefix
    $message = str_replace('There was an error processing the payment:', 'Hubo un error al procesar el pago:', $message);
    return $message;
}
add_filter('woocommerce_add_error', 'sp_translate_stripe_errors', 10);
add_filter('wp_die_handler', function($h) { return $h; }); // keep default

// Translate context strings (optional, etc.) - only WooCommerce domain
function sp_translate_wc_context($translated, $text, $context, $domain) {
    if ($domain !== 'woocommerce') return $translated;
    if ($text === 'optional' || $text === '(optional)') return '(opcional)';
    return $translated;
}
add_filter('gettext_with_context', 'sp_translate_wc_context', 20, 4);

// Also translate pluralized and context strings
function sp_translate_wc_ngettext($translated, $single, $plural, $number, $domain) {
    if ($domain !== 'woocommerce') return $translated;
    
    $translations = [
        '%s has been added to your cart.' => '%s fue agregado al carrito.',
        '%s have been added to your cart.' => '%s fueron agregados al carrito.',
        '%d item'           => '%d producto',
        '%d items'          => '%d productos',
    ];
    
    $key = ($number == 1) ? $single : $plural;
    if (isset($translations[$key])) {
        return sprintf($translations[$key], $number);
    }
    
    return $translated;
}
add_filter('ngettext', 'sp_translate_wc_ngettext', 20, 5);

// ─── Force Colombia as Default Country ──────────────────────────
function sp_default_checkout_country() {
    
    return 'CO';
}
add_filter('default_checkout_billing_country', 'sp_default_checkout_country');
add_filter('default_checkout_shipping_country', 'sp_default_checkout_country');

// ─── Translate Shipping Method Labels ───────────────────────────
function sp_translate_shipping_label($label) {
    $translations = [
        'Free shipping'   => 'Envío gratis',
        'Flat rate'        => 'Tarifa fija',
        'Local pickup'     => 'Recogida local',
    ];
    return $translations[$label] ?? $label;
}
add_filter('woocommerce_shipping_rate_label', 'sp_translate_shipping_label');

// ─── Default Shop Order: Pérdida de Peso first via menu_order ───
function sp_set_weight_loss_menu_order() {
    
    // Run once: set low menu_order for weight-loss products
    if (get_option('sp_weight_loss_ordered')) return;
    
    $weight_cat = get_term_by('slug', 'perdida-de-peso', 'product_cat');
    if (!$weight_cat) $weight_cat = get_term_by('slug', 'weight-loss', 'product_cat');
    if (!$weight_cat) return;
    
    $weight_products = get_posts([
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => [['taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => [$weight_cat->term_id]]],
        'fields' => 'ids',
    ]);
    
    foreach ($weight_products as $pid) {
        wp_update_post(['ID' => $pid, 'menu_order' => -10]);
    }
    
    update_option('sp_weight_loss_ordered', true);
}
add_action('init', 'sp_set_weight_loss_menu_order');

function sp_custom_shop_order() {
     return; }
add_action('pre_get_posts', 'sp_custom_shop_order');

// ─── Blog Support for Theme ─────────────────────────────────────
add_theme_support('post-thumbnails');

// ─── Force Spanish Labels on Checkout Fields ────────────────────
function sp_override_checkout_fields($fields) {
    // Billing fields
    if (isset($fields['billing'])) {
        $label_map = [
            'billing_first_name' => 'Nombre',
            'billing_last_name'  => 'Apellidos',
            'billing_company'    => 'Empresa',
            'billing_country'    => 'País / Región',
            'billing_address_1'  => 'Dirección',
            'billing_address_2'  => 'Apartamento, suite, etc.',
            'billing_city'       => 'Ciudad',
            'billing_state'      => 'Departamento',
            'billing_postcode'   => 'Código postal',
            'billing_phone'      => 'Teléfono',
            'billing_email'      => 'Correo electrónico',
        ];
        foreach ($label_map as $key => $label) {
            if (isset($fields['billing'][$key])) {
                $fields['billing'][$key]['label'] = $label;
            }
        }
    }
    // Shipping fields
    if (isset($fields['shipping'])) {
        $label_map = [
            'shipping_first_name' => 'Nombre',
            'shipping_last_name'  => 'Apellidos',
            'shipping_company'    => 'Empresa',
            'shipping_country'    => 'País / Región',
            'shipping_address_1'  => 'Dirección',
            'shipping_address_2'  => 'Apartamento, suite, etc.',
            'shipping_city'       => 'Ciudad',
            'shipping_state'      => 'Departamento',
            'shipping_postcode'   => 'Código postal',
        ];
        foreach ($label_map as $key => $label) {
            if (isset($fields['shipping'][$key])) {
                $fields['shipping'][$key]['label'] = $label;
            }
        }
    }
    // Order notes
    if (isset($fields['order']['order_comments'])) {
        $fields['order']['order_comments']['label'] = 'Notas del pedido';
        $fields['order']['order_comments']['placeholder'] = 'Notas sobre tu pedido, ej: instrucciones de entrega.';
    }
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'sp_override_checkout_fields', 9999);

// Replace (optional) with (opcional) in all field labels
function sp_translate_optional_label($field, $key, $args, $value) {
    $field = str_replace('(optional)', '(opcional)', $field);
    return $field;
}
add_filter('woocommerce_form_field', 'sp_translate_optional_label', 10, 4);

// Override the default address field labels
function sp_default_address_fields($fields) {
    if (isset($fields['state'])) {
        $fields['state']['label'] = 'Departamento';
    }
    if (isset($fields['postcode'])) {
        $fields['postcode']['label'] = 'Código postal';
    }
    if (isset($fields['city'])) {
        $fields['city']['label'] = 'Ciudad';
    }
    return $fields;
}
add_filter('woocommerce_default_address_fields', 'sp_default_address_fields', 9999);

// Override privacy policy text on checkout
function sp_privacy_policy_text($text) {
    $text = str_replace(
        'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our',
        'Tus datos personales se usarán para procesar tu pedido, mejorar tu experiencia en este sitio y para otros fines descritos en nuestra',
        $text
    );
    $text = str_replace('privacy policy', 'política de privacidad', $text);
    return $text;
}
add_filter('woocommerce_get_privacy_policy_text', 'sp_privacy_policy_text', 20);
add_filter('the_content', 'sp_privacy_policy_text', 20);

// ─── Force Spanish in WC Country Locale (for JS-rebuilt fields) ─
function sp_translate_country_locale($locale) {
    // Only fix Colombia locale
    if (isset($locale['CO'])) {
        $locale['CO']['state']['label'] = 'Departamento';
        $locale['CO']['postcode']['label'] = 'Código postal';
        $locale['CO']['city']['label'] = 'Ciudad';
    }
    return $locale;
}
add_filter('woocommerce_get_country_locale', 'sp_translate_country_locale', 9999);

// Base locale labels
function sp_translate_locale_base($base) {
    $base['state']['label'] = 'Departamento';
    $base['postcode']['label'] = 'Código postal';
    $base['city']['label'] = 'Ciudad';
    return $base;
}
add_filter('woocommerce_get_country_locale_base', 'sp_translate_locale_base', 9999);

// Inline JS to replace remaining English text on checkout (lightweight)
function sp_checkout_translate_js() {
     return; }
// add_action('wp_footer', 'sp_checkout_translate_js');

// Force Stripe Elements to use Spanish locale
function sp_stripe_elements_options($options) {
    $options['locale'] = 'es';
    return $options;
}
add_filter('wc_stripe_elements_options', 'sp_stripe_elements_options', 10);

// Force Stripe params locale
function sp_stripe_params($params) {
    if (isset($params['stripe_locale'])) {
        $params['stripe_locale'] = 'es';
    }
    return $params;
}
add_filter('wc_stripe_params', 'sp_stripe_params', 10);
add_filter('wc_stripe_upe_params', 'sp_stripe_params', 10);


// ─── Custom Shipment Tracking System ─────────────────────────────

// Add Tracking Meta Box in WP Admin
function sp_add_tracking_meta_box() {
    
    $screen = function_exists('wc_get_page_screen_id') 
        ? wc_get_page_screen_id('shop-order') 
        : 'shop_order';
        
    add_meta_box(
        'sp_shipment_tracking',
        'Información de Envío (Seguimiento)',
        'sp_render_tracking_meta_box',
        $screen,
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'sp_add_tracking_meta_box');

// Render Tracking Meta Box HTML
function sp_render_tracking_meta_box($post_or_order) {
    $order_id = ($post_or_order instanceof WP_Post) ? $post_or_order->ID : $post_or_order->get_id();
    
    $carrier = get_post_meta($order_id, '_sp_carrier_name', true);
    $tracking_number = get_post_meta($order_id, '_sp_tracking_number', true);
    $tracking_url = get_post_meta($order_id, '_sp_tracking_url', true);
    
    wp_nonce_field('sp_tracking_nonce', 'sp_tracking_nonce_field');
    
    echo '<p>';
    echo '<label style="display:block; font-weight:bold; margin-bottom:4px;" for="sp_carrier_name">Empresa Transportadora:</label>';
    echo '<input type="text" id="sp_carrier_name" name="sp_carrier_name" value="' . esc_attr($carrier) . '" style="width:100%; padding:6px; border:1px solid #ccc; border-radius:4px;" placeholder="Ej: Servientrega, Coordinadora">';
    echo '</p>';
    
    echo '<p>';
    echo '<label style="display:block; font-weight:bold; margin-bottom:4px;" for="sp_tracking_number">Número de Guía:</label>';
    echo '<input type="text" id="sp_tracking_number" name="sp_tracking_number" value="' . esc_attr($tracking_number) . '" style="width:100%; padding:6px; border:1px solid #ccc; border-radius:4px;" placeholder="Ej: 1020304050">';
    echo '</p>';
    
    echo '<p>';
    echo '<label style="display:block; font-weight:bold; margin-bottom:4px;" for="sp_tracking_url">URL de Seguimiento (Opcional):</label>';
    echo '<input type="url" id="sp_tracking_url" name="sp_tracking_url" value="' . esc_attr($tracking_url) . '" style="width:100%; padding:6px; border:1px solid #ccc; border-radius:4px;" placeholder="https://coordinadora.com/tracking/?guia=...">';
    echo '</p>';
    
    echo '<p style="margin-top:12px; padding-top:8px; border-top:1px solid #eee;">';
    echo '<label><input type="checkbox" name="sp_resend_tracking_email" value="1"> Reenviar correo de seguimiento al cliente</label>';
    echo '</p>';
}

// Save Tracking Meta Data
function sp_save_tracking_meta($order_id) {
    if (!isset($_POST['sp_tracking_nonce_field']) || !wp_verify_nonce($_POST['sp_tracking_nonce_field'], 'sp_tracking_nonce')) {
        return;
    }
    
    $order = wc_get_order($order_id);
    if (!$order) return;
    
    $old_tracking = get_post_meta($order_id, '_sp_tracking_number', true);
    
    $carrier = sanitize_text_field($_POST['sp_carrier_name'] ?? '');
    $tracking_number = sanitize_text_field($_POST['sp_tracking_number'] ?? '');
    $tracking_url = esc_url_raw($_POST['sp_tracking_url'] ?? '');
    $force_resend = isset($_POST['sp_resend_tracking_email']) && $_POST['sp_resend_tracking_email'] === '1';
    
    update_post_meta($order_id, '_sp_carrier_name', $carrier);
    update_post_meta($order_id, '_sp_tracking_number', $tracking_number);
    update_post_meta($order_id, '_sp_tracking_url', $tracking_url);
    
    if (!empty($tracking_number) && ($tracking_number !== $old_tracking || $force_resend)) {
        sp_send_tracking_email($order_id);
    }
}
add_action('woocommerce_process_shop_order_meta', 'sp_save_tracking_meta', 10, 1);

// Send Shipment Tracking Email
function sp_send_tracking_email($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;
    
    $customer_name = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
    $customer_email = $order->get_billing_email();
    $order_number = $order->get_order_number();
    
    $carrier = get_post_meta($order_id, '_sp_carrier_name', true);
    $tracking_number = get_post_meta($order_id, '_sp_tracking_number', true);
    $tracking_url = get_post_meta($order_id, '_sp_tracking_url', true);
    
    // Order Items
    $order_items_html = '';
    foreach ($order->get_items() as $item_id => $item) {
        $name = $item->get_name();
        $qty = $item->get_quantity();
        $subtotal = $order->get_formatted_line_subtotal($item);
        
        $order_items_html .= '<tr style="border-bottom:1px solid #1f2e54;">';
        $order_items_html .= '<td style="padding:12px 0;line-height:1.5;color:#e2e8f0;">' . esc_html($name) . ' <strong style="color:#06b6d4;font-size:12px;">&times; ' . $qty . '</strong></td>';
        $order_items_html .= '<td align="right" style="padding:12px 0;font-weight:600;color:#ffffff;">' . $subtotal . '</td>';
        $order_items_html .= '</tr>';
    }
    
    // CTA Button
    $cta_button = '';
    if (!empty($tracking_url)) {
        $cta_button = '<div style="text-align:center;margin:32px 0;"><a href="' . esc_url($tracking_url) . '" target="_blank" style="display:inline-block;background:linear-gradient(95deg, #0ea5e9 0%, #06b6d4 100%);color:#ffffff;font-size:15px;font-weight:800;text-decoration:none;padding:16px 36px;border-radius:12px;box-shadow:0 8px 20px rgba(6,182,212,0.3);text-transform:uppercase;letter-spacing:0.5px;">Rastrear Envío Directo</a></div>';
    }
    
    $html = <<<HTML
<!DOCTYPE html>
<html lang="es-CO">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tu pedido ha sido enviado</title>
</head>
<body style="margin:0;padding:0;background-color:#0b1329;font-family:'Manrope', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;color:#ffffff;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;">
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#0b1329;padding:40px 20px;">
    <tr>
      <td align="center">
        <table role="presentation" cellpadding="0" cellspacing="0" width="600" style="max-width:600px;width:100%;background-color:#111c35;border-radius:24px;border:1px solid #1f2e54;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.5);">
          <tr>
            <td style="background:linear-gradient(135deg, #0f1c3f 0%, #060e22 100%);padding:48px 40px;text-align:center;">
              <img src="https://peptidossuizos.com/wp-content/themes/swiss-peptides-theme/img/logo/logo_swiss.png" alt="Swiss Peptides Logo" width="238" height="28" style="display:inline-block;filter:drop-shadow(0 4px 10px rgba(6,182,212,0.4));margin-bottom:16px;">
              <h1 style="margin:0;font-size:24px;font-weight:800;color:#ffffff;letter-spacing:1px;text-transform:uppercase;">¡Tu pedido está en camino!</h1>
              <p style="margin:8px 0 0 0;font-size:14px;color:#94a3b8;font-weight:500;">Pedido #{ORDER_NUMBER}</p>
            </td>
          </tr>
          <tr>
            <td style="height:4px;background:linear-gradient(90deg, #0ea5e9 0%, #06b6d4 100%);"></td>
          </tr>
          <tr>
            <td style="padding:48px 40px;">
              <p style="margin:0 0 24px 0;font-size:16px;line-height:1.6;color:#e2e8f0;font-weight:400;">
                Hola <strong style="color:#ffffff;font-weight:700;">{CUSTOMER_NAME}</strong>,
              </p>
              <p style="margin:0 0 32px 0;font-size:15px;line-height:1.6;color:#94a3b8;">
                Tenemos excelentes noticias. Hemos preparado tu paquete y ya ha sido entregado a la empresa transportadora para su despacho. A continuación encontrarás los detalles de seguimiento de tu envío:
              </p>
              <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#1e294b;border-radius:16px;border:1px solid #334155;margin-bottom:32px;overflow:hidden;">
                <tr>
                  <td style="padding:24px;">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td style="padding-bottom:16px;border-bottom:1px solid #334155;">
                          <span style="display:block;font-size:11px;color:#06b6d4;text-transform:uppercase;letter-spacing:1.5px;font-weight:700;margin-bottom:4px;">Empresa Transportadora</span>
                          <span style="font-size:16px;color:#ffffff;font-weight:700;">{CARRIER_NAME}</span>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding-top:16px;">
                          <span style="display:block;font-size:11px;color:#06b6d4;text-transform:uppercase;letter-spacing:1.5px;font-weight:700;margin-bottom:4px;">Número de Guía / Código de Rastreo</span>
                          <span style="font-size:18px;color:#ffffff;font-weight:800;font-family:'Courier New', monospace;letter-spacing:1px;">{TRACKING_NUMBER}</span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              {CTA_BUTTON}
              <h3 style="margin:40px 0 16px 0;font-size:16px;font-weight:700;color:#ffffff;text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid #1f2e54;padding-bottom:8px;">Resumen de tu pedido</h3>
              <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="font-size:14px;color:#e2e8f0;">
                {ORDER_ITEMS}
                <tr style="border-top:1px solid #1f2e54;">
                  <td style="padding:16px 0 8px 0;color:#94a3b8;">Subtotal</td>
                  <td align="right" style="padding:16px 0 8px 0;font-weight:600;color:#ffffff;">{ORDER_SUBTOTAL}</td>
                </tr>
                <tr>
                  <td style="padding:8px 0;color:#94a3b8;">Envío</td>
                  <td align="right" style="padding:8px 0;font-weight:600;color:#ffffff;">{ORDER_SHIPPING}</td>
                </tr>
                <tr>
                  <td style="padding:8px 0 16px 0;color:#94a3b8;border-bottom:1px solid #1f2e54;">Método de Pago</td>
                  <td align="right" style="padding:8px 0 16px 0;font-weight:600;color:#ffffff;border-bottom:1px solid #1f2e54;">{ORDER_PAYMENT}</td>
                </tr>
                <tr>
                  <td style="padding:16px 0 0 0;font-size:16px;font-weight:800;color:#06b6d4;">Total</td>
                  <td align="right" style="padding:16px 0 0 0;font-size:18px;font-weight:800;color:#06b6d4;">{ORDER_TOTAL}</td>
                </tr>
              </table>
              <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:48px;padding:24px;background-color:#0f172a;border-radius:12px;border:1px solid #1e293b;text-align:center;">
                <tr>
                  <td>
                    <h4 style="margin:0 0 8px 0;font-size:14px;font-weight:700;color:#ffffff;">¿Tienes alguna pregunta o necesitas ayuda con tu entrega?</h4>
                    <p style="margin:0 0 16px 0;font-size:13px;color:#94a3b8;line-height:1.5;">Estamos listos para ayudarte en cualquier momento a través de nuestra línea de atención.</p>
                    <a href="https://wa.me/573189163091" target="_blank" style="display:inline-block;background-color:#22c55e;color:#ffffff !important;padding:10px 20px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:700;box-shadow:0 4px 10px rgba(34,197,94,0.3);"><span style="color:#ffffff !important;">Escríbenos por WhatsApp</span></a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="background-color:#080f21;padding:32px 40px;text-align:center;border-top:1px solid #1f2e54;font-size:12px;color:#64748b;line-height:1.6;">
              <p style="margin:0 0 8px 0;">&copy; 2026 Swiss Peptides Colombia. Todos los derechos reservados.</p>
              <p style="margin:0;">
                <a href="https://peptidossuizos.com/politica-privacidad/" style="color:#94a3b8;text-decoration:underline;margin-right:12px;">Política de Privacidad</a>
                <a href="https://peptidossuizos.com/terminos-condiciones/" style="color:#94a3b8;text-decoration:underline;">Términos y Condiciones</a>
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;
    
    $html = str_replace(
        ['{CUSTOMER_NAME}', '{ORDER_NUMBER}', '{CARRIER_NAME}', '{TRACKING_NUMBER}', '{CTA_BUTTON}', '{ORDER_ITEMS}', '{ORDER_SUBTOTAL}', '{ORDER_SHIPPING}', '{ORDER_PAYMENT}', '{ORDER_TOTAL}'],
        [
            esc_html($customer_name),
            esc_html($order_number),
            esc_html($carrier),
            esc_html($tracking_number),
            $cta_button,
            $order_items_html,
            $order->get_subtotal_to_display(),
            $order->get_shipping_to_display(),
            esc_html($order->get_payment_method_title()),
            $order->get_formatted_order_total()
        ],
        $html
    );
    
    $subject = '¡Tu pedido de Swiss Peptides está en camino! (Guía de seguimiento)';
    
    $headers = [
        'From: Swiss Peptides Colombia <pedidos@peptidossuizos.com>',
        'Content-Type: text/html; charset=UTF-8',
    ];
    
    wp_mail($customer_email, $subject, $html, $headers);
    wp_mail('antoniovarona@avcompany.co', '[Copia Cliente] ' . $subject, $html, $headers);
}



/**
 * Aplica un descuento de combo cuando hay Agua Bacteriostatica (ID 25) y cualquier peptido en el carrito.
 */
add_action('woocommerce_cart_calculate_fees', 'sp_apply_combo_discount', 20, 1);
function sp_apply_combo_discount($cart) {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }
    
    $has_water = false;
    $has_peptide = false;
    $water_qty = 0;
    
    foreach ($cart->get_cart() as $cart_item) {
        $product_id = $cart_item['product_id'];
        if ($product_id == 25) {
            $has_water = true;
            $water_qty = $cart_item['quantity'];
        } else {
            $terms = wp_get_post_terms($product_id, 'product_cat');
            $is_accessory = false;
            if (!empty($terms)) {
                foreach ($terms as $term) {
                    if ($term->slug == 'accesorios' || $term->slug == 'accessories') {
                        $is_accessory = true;
                        break;
                    }
                }
            }
            if (!$is_accessory) {
                $has_peptide = true;
            }
        }
    }
    
    if ($has_water && $has_peptide) {
        // Descuento de $3.700 COP por cada botella de agua en el combo (10% de $37.000)
        $discount_amount = 3700 * $water_qty;
        $cart->add_fee(__('Descuento de Combo (Pptido + Agua)', 'swiss-peptides'), -$discount_amount);
    }
}


// ═══════════════════════════════════════════════════════════════════
// SEO OPTIMIZATION — Session 1 (Added by Antigravity)
// ═══════════════════════════════════════════════════════════════════

// ─── Enhanced Product Schema (JSON-LD) ──────────────────────────
function sp_product_schema() {
     return; }
// add_action('wp_head', 'sp_product_schema', 5);

// ─── Organization Schema (Fixed) ───────────────────────────────
function sp_organization_schema() {
     return; }
add_action('wp_head', 'sp_organization_schema', 5);

// ─── Breadcrumb Schema ─────────────────────────────────────────
function sp_breadcrumb_schema() {
     return; }
// add_action('wp_head', 'sp_breadcrumb_schema', 5);

// ─── Volume Discount System (Combos) ───────────────────────────
function sp_volume_discounts($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;
    if (did_action('woocommerce_cart_calculate_fees') >= 2) return;
    
    // Count quantities per product
    $product_counts = [];
    foreach ($cart->get_cart() as $item) {
        $pid = $item['product_id'];
        if (!isset($product_counts[$pid])) {
            $product_counts[$pid] = [
                'qty' => 0,
                'price' => (float) $item['data']->get_price(),
                'name' => $item['data']->get_name(),
            ];
        }
        $product_counts[$pid]['qty'] += $item['quantity'];
    }
    
    // Apply tiered discounts per product (skip Agua Bacteriostatica ID 25)
    foreach ($product_counts as $pid => $data) {
        if ($pid == 25) continue; // Skip agua bacteriostatica
        
        $qty = $data['qty'];
        $discount_pct = 0;
        $tier_name = '';
        
        if ($qty >= 4) {
            $discount_pct = 0.25;
            $tier_name = 'Protocolo Premium 25%';
        } elseif ($qty >= 3) {
            $discount_pct = 0.20;
            $tier_name = 'Protocolo Profesional 20%';
        } elseif ($qty >= 2) {
            $discount_pct = 0.10;
            $tier_name = 'Protocolo Avanzado 10%';
        }
        
        if ($discount_pct > 0) {
            $total_for_product = $data['price'] * $qty;
            $discount_amount = $total_for_product * $discount_pct;
            $short_name = mb_substr($data['name'], 0, 20);
            $cart->add_fee("Descuento {$tier_name} — {$short_name}", -$discount_amount);
        }
    }
}
add_action('woocommerce_cart_calculate_fees', 'sp_volume_discounts');

// ─── Disable SiteSEO default schema to avoid conflicts ─────────
// (We generate our own enhanced schema above)
add_filter('siteseo_schemas_auto_enable', '__return_false');

// ─── Cookie Consent in Spanish ─────────────────────────────────
function sp_filter_cookieadmin_consent_settings($value) {
    if (!is_array($value)) {
        $value = array();
    }
    $laws = array('cookieadmin_gdpr', 'cookieadmin_ccpa', 'cookieadmin_lgpd');
    foreach ($laws as $law) {
        if (!isset($value[$law])) {
            $value[$law] = array();
        }
        $value[$law]['cookieadmin_notice_title'] = 'Respetamos tu privacidad';
        $value[$law]['cookieadmin_notice'] = 'Usamos cookies para mejorar tu experiencia. Haz clic en <b>Aceptar</b> para continuar o en <b>Personalizar</b> para elegir tus preferencias.';
        $value[$law]['cookieadmin_customize_btn'] = 'Personalizar';
        $value[$law]['cookieadmin_reject_btn'] = 'Rechazar';
        $value[$law]['cookieadmin_accept_btn'] = 'Aceptar';
        $value[$law]['cookieadmin_save_btn'] = 'Guardar';
        $value[$law]['cookieadmin_preference_title'] = 'Preferencias de Cookies';
        $value[$law]['cookieadmin_preference'] = 'Usamos cookies para asegurar la navegación y funciones esenciales del sitio.';
    }
    return $value;
}
add_filter('option_cookieadmin_consent_settings', 'sp_filter_cookieadmin_consent_settings', 99);
add_filter('default_option_cookieadmin_consent_settings', 'sp_filter_cookieadmin_consent_settings', 99);


// ═══════════════════════════════════════════════════════════════
// SESSION 4 — Homepage CRO + FAQ Schema
// ═══════════════════════════════════════════════════════════════

// ─── FAQ Schema for Homepage ────────────────────────────────
function sp_homepage_faq_schema() {
    
    if (!is_front_page()) return;
    
    $faqs = [
        [
            'question' => 'Que pureza tienen los peptidos de Swiss Peptides?',
            'answer' => 'Todos nuestros peptidos cuentan con pureza verificada HPLC mayor o igual al 98%, respaldada por certificados de analisis que incluyen cromatografia liquida y espectrometria de masas. Cada lote es trazable hasta el laboratorio de origen.'
        ],
        [
            'question' => 'Como se realizan los envios en Colombia?',
            'answer' => 'Realizamos envios gratuitos a todo el territorio colombiano. El despacho se realiza en 1-2 dias habiles y la entrega toma entre 2-5 dias habiles dependiendo de la ciudad. Todos los paquetes incluyen empaque discreto y seguro.'
        ],
        [
            'question' => 'Que incluye cada pedido?',
            'answer' => 'Cada pedido incluye: el producto sellado al vacío, certificado HPLC de pureza, guia de dosificacion digital en PDF, acceso a asesoria medica por WhatsApp, envio gratis a toda Colombia, y empaque discreto y seguro.'
        ],
        [
            'question' => 'Tienen descuentos por volumen?',
            'answer' => 'Si, ofrecemos descuentos progresivos: 10% al comprar 2 unidades del mismo producto (Protocolo Avanzado), 20% al comprar 3 unidades (Protocolo Profesional), y 25% al comprar 4 o mas unidades (Protocolo Premium).'
        ],
        [
            'question' => 'Que metodos de pago aceptan?',
            'answer' => 'Aceptamos pagos 100% seguros a traves de Bold Colombia, lo que permite pagar con PSE, tarjetas de credito Visa, Mastercard, American Express, y transferencias desde cuentas de ahorro y corriente.'
        ],
        [
            'question' => 'Como debo almacenar los peptidos?',
            'answer' => 'Antes de reconstituir (en polvo liofilizado), los peptidos deben guardarse en un lugar fresco alejado de la luz directa o en refrigeracion. Una vez reconstituidos con agua bacteriostatica, deben mantenerse refrigerados entre 2 y 8 grados centigrados.'
        ]
    ];
    
    $items = [];
    foreach ($faqs as $faq) {
        $items[] = [
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['answer']
            ]
        ];
    }
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $items
    ];
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'sp_homepage_faq_schema', 5);

// ─── WebSite Schema with SearchAction ───────────────────────
function sp_website_schema() {
     return; }
add_action('wp_head', 'sp_website_schema', 5);

// ─── Discount Badge on Product Cards ────────────────────────
function sp_discount_badge_on_cards() {
    
    global $product;
    if (!$product) return;
    $regular = (float) $product->get_regular_price();
    $sale = (float) $product->get_sale_price();
    if ($regular > 0 && $sale > 0 && $regular > $sale) {
        $pct = round((1 - $sale / $regular) * 100);
        echo '<span class="product-badge" style="background:var(--error);">-' . $pct . '%</span>';
    }
}


// ═══════════════════════════════════════════════════════════════
// SESSION 5 — Shop Page CRO + Mobile Sticky CTA
// ═══════════════════════════════════════════════════════════════

// ─── Sticky Mobile Add-to-Cart Bar ─────────────────────────
function sp_sticky_mobile_bar() {
    
    if (!(function_exists('is_product') && is_product())) return;
    global $product;
    if (!$product) return;
    ?>
    <div class="sp-sticky-bar" id="spStickyBar">
      <div class="sp-sticky-inner">
        <div class="sp-sticky-info">
          <span class="sp-sticky-name"><?php echo mb_substr($product->get_name(), 0, 25); ?></span>
          <span class="sp-sticky-price">$ <?php echo number_format($product->get_price(), 0, ',', '.'); ?></span>
        </div>
        <button class="btn btn-primary btn-sm sp-add-to-cart sp-sticky-btn" data-product-id="<?php echo $product->get_id(); ?>">
          Agregar
        </button>
      </div>
    </div>
    <style>
    .sp-sticky-bar{display:none;position:fixed;bottom:0;left:0;right:0;z-index:999;background:rgba(255,255,255,0.95);backdrop-filter:blur(12px);border-top:1px solid var(--border-color);padding:10px 16px;box-shadow:0 -4px 20px rgba(0,0,0,0.08)}
    .sp-sticky-inner{display:flex;align-items:center;justify-content:space-between;max-width:600px;margin:0 auto}
    .sp-sticky-info{display:flex;flex-direction:column;gap:2px}
    .sp-sticky-name{font-size:12px;color:var(--text-secondary);font-weight:500}
    .sp-sticky-price{font-family:var(--font-heading);font-size:16px;font-weight:800;color:var(--navy)}
    .sp-sticky-btn{padding:10px 24px;font-size:13px;white-space:nowrap}
    @media(max-width:768px){
      .sp-sticky-bar{display:block}
      main{padding-bottom:70px}
    }
    </style>
    <script>
    (function(){
      var bar = document.getElementById('spStickyBar');
      if (!bar) return;
      var addBtn = document.getElementById('addToCartBtn');
      if (!addBtn) return;
      var observer = new IntersectionObserver(function(entries){
        bar.style.transform = entries[0].isIntersecting ? 'translateY(100%)' : 'translateY(0)';
        bar.style.transition = 'transform 0.3s ease';
      }, {threshold: 0});
      observer.observe(addBtn);
    })();
    </script>
    <?php
}
add_action('wp_footer', 'sp_sticky_mobile_bar');

// ─── Volume Discount Banner on Shop Page ────────────────────
function sp_shop_discount_banner() {
    
    if (!(function_exists('is_shop') && (function_exists('is_shop') && is_shop())) && !is_product_category()) return;
    ?>
    <div style="background:linear-gradient(135deg,var(--navy) 0%,#1a365d 100%);color:var(--white);padding:16px 0;text-align:center;margin-bottom:var(--space-lg);border-radius:var(--radius-xl);">
      <div class="container" style="display:flex;align-items:center;justify-content:center;gap:var(--space-xl);flex-wrap:wrap;">
        <div style="display:flex;align-items:center;gap:8px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.7)" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
          <span style="font-size:13px;font-weight:500;opacity:0.8;">Descuentos por volumen:</span>
        </div>
        <div style="display:flex;gap:var(--space-md);flex-wrap:wrap;">
          <span style="background:rgba(255,255,255,0.1);padding:4px 12px;border-radius:var(--radius-full);font-size:12px;font-weight:600;">2 uds = 10% OFF</span>
          <span style="background:rgba(255,255,255,0.15);padding:4px 12px;border-radius:var(--radius-full);font-size:12px;font-weight:600;">3 uds = 20% OFF</span>
          <span style="background:rgba(14,165,233,0.3);padding:4px 12px;border-radius:var(--radius-full);font-size:12px;font-weight:700;">4+ uds = 25% OFF</span>
        </div>
      </div>
    </div>
    <?php
}
add_action('woocommerce_before_shop_loop', 'sp_shop_discount_banner', 5);

// ─── Discount Badge on Product Archive Cards ────────────────
function sp_archive_discount_badge() {
    
    global $product;
    if (!$product) return;
    $regular = (float) $product->get_regular_price();
    $sale = (float) $product->get_sale_price();
    if ($regular > 0 && $sale > 0 && $regular > $sale) {
        $pct = round((1 - $sale / $regular) * 100);
        echo '<span class="product-badge" style="background:var(--error);position:absolute;top:12px;right:12px;z-index:2;padding:3px 10px;border-radius:var(--radius-full);font-size:11px;font-weight:700;color:var(--white);">-' . $pct . '%</span>';
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'sp_archive_discount_badge', 5);


// ═══════════════════════════════════════════════════════════════
// BONUS — Sitemap, Checkout Trust, Performance
// ═══════════════════════════════════════════════════════════════

// ─── Dynamic XML Sitemap ────────────────────────────────────
function sp_generate_sitemap() {
    
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    
    // Homepage
    $sitemap .= '<url><loc>' . home_url('/') . '</loc><changefreq>daily</changefreq><priority>1.0</priority></url>' . "\n";
    
    // Shop
    $sitemap .= '<url><loc>' . get_permalink((function_exists('wc_get_page_id') ? wc_get_page_id('shop') : 0)) . '</loc><changefreq>daily</changefreq><priority>0.9</priority></url>' . "\n";
    
    // Products
    $products = wc_get_products(['status' => 'publish', 'limit' => -1]);
    foreach ($products as $p) {
        $sitemap .= '<url><loc>' . $p->get_permalink() . '</loc><lastmod>' . get_the_modified_date('c', $p->get_id()) . '</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>' . "\n";
    }
    
    // Categories
    $cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => true]);
    foreach ($cats as $cat) {
        $sitemap .= '<url><loc>' . get_term_link($cat) . '</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>' . "\n";
    }
    
    // Pages
    $pages = get_pages(['post_status' => 'publish']);
    $exclude = [(function_exists('wc_get_page_id') ? wc_get_page_id('cart') : 0), (function_exists('wc_get_page_id') ? wc_get_page_id('checkout') : 0), (function_exists('wc_get_page_id') ? wc_get_page_id('myaccount') : 0)];
    foreach ($pages as $page) {
        if (in_array($page->ID, $exclude)) continue;
        $sitemap .= '<url><loc>' . get_permalink($page->ID) . '</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>' . "\n";
    }
    
    $sitemap .= '</urlset>';
    
    // Write to file
    file_put_contents(ABSPATH . 'sitemap.xml', $sitemap);
}
// Regenerate sitemap on product save
add_action('save_post_product', 'sp_generate_sitemap');
add_action('created_product_cat', 'sp_generate_sitemap');
// Generate on theme activation
add_action('after_switch_theme', 'sp_generate_sitemap');

// ─── Checkout Page Trust Signals ────────────────────────────
function sp_checkout_trust_bar() {
    
    if (!function_exists('is_checkout') || !function_exists('is_checkout') && is_checkout()) return;
    ?>
    <div style="background:var(--gray-50);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:var(--space-md);margin-bottom:var(--space-lg);display:flex;align-items:center;justify-content:center;gap:var(--space-xl);flex-wrap:wrap;">
      <div style="display:flex;align-items:center;gap:6px;font-size:var(--fs-xs);color:var(--text-muted);">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Pago 100% seguro
      </div>
      <div style="display:flex;align-items:center;gap:6px;font-size:var(--fs-xs);color:var(--text-muted);">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
        Datos encriptados SSL
      </div>
      <div style="display:flex;align-items:center;gap:6px;font-size:var(--fs-xs);color:var(--text-muted);">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        Envio gratis incluido
      </div>
    </div>
    <?php
}
add_action('woocommerce_before_checkout_form', 'sp_checkout_trust_bar', 5);

// ─── Performance: Defer non-critical JS ─────────────────────
function sp_defer_scripts($tag, $handle) {
    $defer_handles = ['comment-reply', 'wp-embed'];
    if (in_array($handle, $defer_handles)) {
        return str_replace(' src=', ' defer src=', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'sp_defer_scripts', 10, 2);

// ─── Remove WooCommerce unused scripts on non-WC pages ─────
function sp_dequeue_wc_scripts() {
     return; }
add_action('wp_enqueue_scripts', 'sp_dequeue_wc_scripts', 99);

// ─── Add noindex to cart/checkout/account ───────────────────
function sp_noindex_wc_pages() {
     return; }
// add_action('wp_head', 'sp_noindex_wc_pages', 1);


// ═══════════════════════════════════════════════════════════════
// GEO SEO — Dynamic City Landing Pages
// Generates pages like /peptidos-en-bogota/, /peptidos-en-medellin/
// and product-specific: /peptidos-en-bogota/tirzepatide/
// ═══════════════════════════════════════════════════════════════

function sp_geo_cities() {
    
    return [
        'bogota' => ['name' => 'Bogota', 'dept' => 'Cundinamarca', 'pop' => '8.2M'],
        'medellin' => ['name' => 'Medellin', 'dept' => 'Antioquia', 'pop' => '2.5M'],
        'cali' => ['name' => 'Cali', 'dept' => 'Valle del Cauca', 'pop' => '2.2M'],
        'barranquilla' => ['name' => 'Barranquilla', 'dept' => 'Atlantico', 'pop' => '1.2M'],
        'cartagena' => ['name' => 'Cartagena', 'dept' => 'Bolivar', 'pop' => '1.0M'],
        'bucaramanga' => ['name' => 'Bucaramanga', 'dept' => 'Santander', 'pop' => '581K'],
        'pereira' => ['name' => 'Pereira', 'dept' => 'Risaralda', 'pop' => '477K'],
        'manizales' => ['name' => 'Manizales', 'dept' => 'Caldas', 'pop' => '434K'],
        'santa-marta' => ['name' => 'Santa Marta', 'dept' => 'Magdalena', 'pop' => '538K'],
        'villavicencio' => ['name' => 'Villavicencio', 'dept' => 'Meta', 'pop' => '531K'],
        'ibague' => ['name' => 'Ibague', 'dept' => 'Tolima', 'pop' => '529K'],
        'pasto' => ['name' => 'Pasto', 'dept' => 'Narino', 'pop' => '464K'],
        'neiva' => ['name' => 'Neiva', 'dept' => 'Huila', 'pop' => '357K'],
        'armenia' => ['name' => 'Armenia', 'dept' => 'Quindio', 'pop' => '301K'],
        'popayan' => ['name' => 'Popayan', 'dept' => 'Cauca', 'pop' => '318K'],
        'monteria' => ['name' => 'Monteria', 'dept' => 'Cordoba', 'pop' => '505K'],
        'valledupar' => ['name' => 'Valledupar', 'dept' => 'Cesar', 'pop' => '493K'],
        'cucuta' => ['name' => 'Cucuta', 'dept' => 'Norte de Santander', 'pop' => '711K'],
        'tunja' => ['name' => 'Tunja', 'dept' => 'Boyaca', 'pop' => '204K'],
        'sincelejo' => ['name' => 'Sincelejo', 'dept' => 'Sucre', 'pop' => '287K'],
        'florencia' => ['name' => 'Florencia', 'dept' => 'Caqueta', 'pop' => '170K'],
        'riohacha' => ['name' => 'Riohacha', 'dept' => 'La Guajira', 'pop' => '160K'],
        'yopal' => ['name' => 'Yopal', 'dept' => 'Casanare', 'pop' => '150K'],
        'quibdo' => ['name' => 'Quibdo', 'dept' => 'Choco', 'pop' => '130K'],
        'arauca' => ['name' => 'Arauca', 'dept' => 'Arauca', 'pop' => '85K'],
        'mocoa' => ['name' => 'Mocoa', 'dept' => 'Putumayo', 'pop' => '45K'],
        'san-andres' => ['name' => 'San Andres', 'dept' => 'San Andres', 'pop' => '55K'],
        'mitu' => ['name' => 'Mitu', 'dept' => 'Vaupes', 'pop' => '30K'],
        'inirida' => ['name' => 'Inirida', 'dept' => 'Guainia', 'pop' => '20K'],
        'puerto-carreno' => ['name' => 'Puerto Carreno', 'dept' => 'Vichada', 'pop' => '18K'],
        'bello' => ['name' => 'Bello', 'dept' => 'Antioquia', 'pop' => '520K'],
        'soledad' => ['name' => 'Soledad', 'dept' => 'Atlantico', 'pop' => '660K'],
        'envigado' => ['name' => 'Envigado', 'dept' => 'Antioquia', 'pop' => '230K'],
        'itagui' => ['name' => 'Itagui', 'dept' => 'Antioquia', 'pop' => '270K'],
        'sabaneta' => ['name' => 'Sabaneta', 'dept' => 'Antioquia', 'pop' => '80K'],
        'chia' => ['name' => 'Chia', 'dept' => 'Cundinamarca', 'pop' => '130K'],
        'zipaquira' => ['name' => 'Zipaquira', 'dept' => 'Cundinamarca', 'pop' => '120K'],
        'rionegro' => ['name' => 'Rionegro', 'dept' => 'Antioquia', 'pop' => '120K'],
        'palmira' => ['name' => 'Palmira', 'dept' => 'Valle del Cauca', 'pop' => '310K'],
        'buenaventura' => ['name' => 'Buenaventura', 'dept' => 'Valle del Cauca', 'pop' => '430K'],
        'tulua' => ['name' => 'Tulua', 'dept' => 'Valle del Cauca', 'pop' => '220K'],
        'cartago' => ['name' => 'Cartago', 'dept' => 'Valle del Cauca', 'pop' => '130K'],
        'buga' => ['name' => 'Buga', 'dept' => 'Valle del Cauca', 'pop' => '115K'],
        'ipiales' => ['name' => 'Ipiales', 'dept' => 'Narino', 'pop' => '110K'],
        'pitalito' => ['name' => 'Pitalito', 'dept' => 'Huila', 'pop' => '125K'],
        'sogamoso' => ['name' => 'Sogamoso', 'dept' => 'Boyaca', 'pop' => '112K'],
        'duitama' => ['name' => 'Duitama', 'dept' => 'Boyaca', 'pop' => '110K'],
        'girardot' => ['name' => 'Girardot', 'dept' => 'Cundinamarca', 'pop' => '105K'],
        'fusagasuga' => ['name' => 'Fusagasuga', 'dept' => 'Cundinamarca', 'pop' => '138K'],
        'facatativa' => ['name' => 'Facatativa', 'dept' => 'Cundinamarca', 'pop' => '135K'],
        'chiquinquira' => ['name' => 'Chiquinquira', 'dept' => 'Boyaca', 'pop' => '65K'],
        'pamplona' => ['name' => 'Pamplona', 'dept' => 'Norte de Santander', 'pop' => '58K'],
        'ocana' => ['name' => 'Ocana', 'dept' => 'Norte de Santander', 'pop' => '120K'],
        'barrancabermeja' => ['name' => 'Barrancabermeja', 'dept' => 'Santander', 'pop' => '190K'],
        'giron' => ['name' => 'Giron', 'dept' => 'Santander', 'pop' => '180K'],
        'floridablanca' => ['name' => 'Floridablanca', 'dept' => 'Santander', 'pop' => '260K'],
    ];
}

// ─── Rewrite Rules ──────────────────────────────────────────
function sp_geo_rewrite_rules() {
    
    add_rewrite_rule(
        '^peptidos-en-([a-z-]+)/?$',
        'index.php?sp_geo_city=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^peptidos-en-([a-z-]+)/([a-z0-9-]+)/?$',
        'index.php?sp_geo_city=$matches[1]&sp_geo_product=$matches[2]',
        'top'
    );
}
add_action('init', 'sp_geo_rewrite_rules');

function sp_geo_query_vars($vars) {
    $vars[] = 'sp_geo_city';
    $vars[] = 'sp_geo_product';
    return $vars;
}
add_filter('query_vars', 'sp_geo_query_vars');

function sp_geo_template($template) {
    $city_slug = get_query_var('sp_geo_city');
    if ($city_slug) {
        $geo_template = get_template_directory() . '/page-geo-city.php';
        if (file_exists($geo_template)) {
            return $geo_template;
        }
    }
    return $template;
}
add_filter('template_include', 'sp_geo_template');

// ─── GEO SEO Meta Tags ─────────────────────────────────────
function sp_geo_meta_tags() {
    
    $city_slug = get_query_var('sp_geo_city');
    if (!$city_slug) return;
    
    $cities = sp_geo_cities();
    if (!isset($cities[$city_slug])) return;
    
    $city = $cities[$city_slug];
    $title = 'Peptidos de Investigacion en ' . $city['name'] . ' | Swiss Peptides Colombia';
    $desc = 'Compra peptidos de ultra-alta pureza en ' . $city['name'] . ', ' . $city['dept'] . '. Envio gratis a toda Colombia. Pureza HPLC certificada. Entrega en 2-5 dias. Swiss Peptides.';
    
    // Override title
    add_filter('pre_get_document_title', function() use ($title) { return $title; });
    add_filter('wpseo_title', function() use ($title) { return $title; });
    
    echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<link rel="canonical" href="' . home_url('/peptidos-en-' . $city_slug . '/') . '">' . "\n";
}
add_action('wp_head', 'sp_geo_meta_tags', 1);

// ─── GEO Sitemap entries ────────────────────────────────────
function sp_geo_sitemap_entries() {
    
    $cities = sp_geo_cities();
    $entries = '';
    foreach ($cities as $slug => $city) {
        $entries .= '<url><loc>' . home_url('/peptidos-en-' . $slug . '/') . '</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>' . "\n";
    }
    return $entries;
}


// ═══════════════════════════════════════════════════════════════
// GOOGLE ANALYTICS 4 — G-GRT0F7LF6F
// ═══════════════════════════════════════════════════════════════

// ─── GA4 Tracking Code ──────────────────────────────────────
function sp_ga4_tracking() {
    
    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GRT0F7LF6F"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-GRT0F7LF6F');
    </script>
    <?php
}
add_action('wp_head', 'sp_ga4_tracking', 1);

// ─── GA4 E-commerce: Purchase Event ─────────────────────────
function sp_ga4_purchase_tracking($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;
    
    $items_js = [];
    foreach ($order->get_items() as $item) {
        $product = $item->get_product();
        $cats = wp_get_post_terms($product->get_id(), 'product_cat');
        $cat = !empty($cats) ? $cats[0]->name : '';
        $items_js[] = '{item_id:"' . $product->get_id() . '",item_name:"' . esc_js($product->get_name()) . '",item_category:"' . esc_js($cat) . '",price:' . $item->get_total() / $item->get_quantity() . ',quantity:' . $item->get_quantity() . '}';
    }
    ?>
    <script>
    gtag('event', 'purchase', {
      transaction_id: '<?php echo $order_id; ?>',
      value: <?php echo $order->get_total(); ?>,
      currency: 'COP',
      shipping: <?php echo $order->get_shipping_total(); ?>,
      items: [<?php echo implode(',', $items_js); ?>]
    });
    </script>
    <?php
}
add_action('woocommerce_thankyou', 'sp_ga4_purchase_tracking');

// ─── GA4 E-commerce: Add to Cart Event ──────────────────────
function sp_ga4_add_to_cart_tracking() {
    
    if (!(function_exists('is_product') && is_product())) return;
    global $product;
    if (!$product) return;
    $cats = wp_get_post_terms($product->get_id(), 'product_cat');
    $cat = !empty($cats) ? $cats[0]->name : '';
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.sp-add-to-cart').forEach(function(btn) {
        btn.addEventListener('click', function() {
          gtag('event', 'add_to_cart', {
            currency: 'COP',
            value: <?php echo $product->get_price(); ?>,
            items: [{
              item_id: '<?php echo $product->get_id(); ?>',
              item_name: '<?php echo esc_js($product->get_name()); ?>',
              item_category: '<?php echo esc_js($cat); ?>',
              price: <?php echo $product->get_price(); ?>,
              quantity: 1
            }]
          });
        });
      });
    });
    </script>
    <?php
}
add_action('wp_footer', 'sp_ga4_add_to_cart_tracking');

// ─── GA4: View Item Event on Product Pages ──────────────────
function sp_ga4_view_item() {
    
    if (!(function_exists('is_product') && is_product())) return;
    global $product;
    if (!$product) return;
    $cats = wp_get_post_terms($product->get_id(), 'product_cat');
    $cat = !empty($cats) ? $cats[0]->name : '';
    ?>
    <script>
    gtag('event', 'view_item', {
      currency: 'COP',
      value: <?php echo $product->get_price(); ?>,
      items: [{
        item_id: '<?php echo $product->get_id(); ?>',
        item_name: '<?php echo esc_js($product->get_name()); ?>',
        item_category: '<?php echo esc_js($cat); ?>',
        price: <?php echo $product->get_price(); ?>
      }]
    });
    </script>
    <?php
}
add_action('wp_footer', 'sp_ga4_view_item');


// =================================================================
// BOLD PAYMENT GATEWAY — TEST MODE
// =================================================================

// ─── Bold Gateway Class ─────────────────────────────────────
function sp_bold_gateway_init() {
    
    if (!class_exists('WC_Payment_Gateway')) return;
    
    class WC_Gateway_Bold extends WC_Payment_Gateway {
        
        public function __construct() {
            $this->id = 'bold_co';
            $this->method_title = 'Bold Colombia';
            $this->method_description = 'Paga con PSE, tarjetas de crédito/débito y más a través de Bold.';
            $this->has_fields = false;
            $this->icon = '';
            
            $this->init_form_fields();
            $this->init_settings();
            
            $this->title = $this->get_option('title', 'Bold - Pagos seguros');
            $this->description = $this->get_option('description', 'Paga de forma segura con PSE, tarjeta de crédito o débito.');
            $this->enabled = $this->get_option('enabled', 'yes');
            
            // TEST MODE
            $this->testmode = $this->get_option('testmode', 'yes');
            $this->identity_key = $this->testmode === 'yes' ? 'mnKyNLbi_o2Kmh2xK2Ajlm5d3ifCmxvwY0FpRLuWEHw' : 'zDhVrlbsGd4MvU7Pilw9z83ej-7LuauMj_1cW-k7mOM';
            $this->secret_key = $this->testmode === 'yes' ? 'UluVBWaHvsjEura42KK6mQ' : 'c8UvPwZmMGpSdFIhkEmhZA';
            $this->merchant_id = 'B5TDAOVBWK';
            
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
            add_action('woocommerce_api_bold_co', [$this, 'handle_webhook']);
        }
        
        public function init_form_fields() {
            $this->form_fields = [
                'enabled' => [
                    'title' => 'Activar/Desactivar',
                    'type' => 'checkbox',
                    'label' => 'Activar Bold Colombia',
                    'default' => 'yes'
                ],
                'title' => [
                    'title' => 'Título',
                    'type' => 'text',
                    'default' => 'Bold - Pagos seguros',
                ],
                'description' => [
                    'title' => 'Descripción',
                    'type' => 'textarea',
                    'default' => 'Paga de forma segura con PSE, tarjeta de crédito o débito a través de Bold.',
                ],
                'testmode' => [
                    'title' => 'Modo de pruebas',
                    'type' => 'checkbox',
                    'label' => 'Activar modo de pruebas',
                    'default' => 'yes',
                    'description' => 'Usa las llaves de prueba para testear sin cobros reales.',
                ],
            ];
        }
        
        public function process_payment($order_id) {
            $order = wc_get_order($order_id);
            $order->update_status('pending', 'Esperando redirección al portal seguro de Bold...');
            
            $amount = $order->get_total();
            $currency = $order->get_currency();
            
            // Format amount (closed amount)
            if ($currency === 'COP') {
                $amount_str = number_format(round($amount, 0), 0, '.', '');
            } else {
                $amount_str = number_format(round($amount, 2), 2, '.', '');
            }
            
            // Generate order reference
            $prefix = $this->testmode === 'yes' ? 'test~SP' : 'SP';
            $order_ref = $prefix . '~' . $order_id . '~' . time();
            
            // Generate integrity signature
            $integrity_string = $order_ref . $amount_str . $currency . $this->secret_key;
            $integrity_hash = hash('sha256', $integrity_string);
            
            // Store order reference
            $order->update_meta_data('_bold_order_ref', $order_ref);
            $order->update_meta_data('_bold_integrity', $integrity_hash);
            $order->save();
            
            // Webhook URL (must match the wc-api endpoint)
            $webhook_url = add_query_arg('wc-api', 'bold_co', home_url('/'));
            
            // Build API request payload (matching Bold official v2 schema)
            $payload = [
                'amount' => [
                    'total_amount' => $amount_str,
                    'currency' => $currency,
                ],
                'integrity_key' => $integrity_hash,
                'reference' => $order_ref,
                'description' => 'Swiss Peptides - Orden #' . $order_id,
                'callback_url' => $this->get_return_url($order),
                'integration_type' => 'wordpress-woocommerce-custom-1.0',
                'webhook_url' => $webhook_url,
            ];
            
            // Call Bold API to create the dynamic checkout link
            $api_url = 'https://api.online.payments.bold.co/v2/payment-btn';
            $response = wp_remote_post($api_url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'x-api-key ' . $this->identity_key,
                ],
                'body' => wp_json_encode($payload),
                'timeout' => 30,
            ]);
            
            if (is_wp_error($response)) {
                $order->update_status('failed', 'Error al conectar con Bold API: ' . $response->get_error_message());
                wc_add_notice('Error al conectar con la pasarela de pagos de Bold: ' . $response->get_error_message(), 'error');
                return;
            }
            
            $code = wp_remote_retrieve_response_code($response);
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
            
            if ($code === 200 || $code === 201) {
                $redirect_url = $data['payload']['url'] ?? $data['url'] ?? '';
                if ($redirect_url) {
                    return [
                        'result' => 'success',
                        'redirect' => $redirect_url,
                    ];
                }
            }
            
            $error_msg = 'Error en Bold API (HTTP ' . $code . ')';
            if (isset($data['errors']) && is_array($data['errors'])) {
                $error_msg .= ': ' . implode(', ', $data['errors']);
            } else if (isset($data['message'])) {
                $error_msg .= ': ' . $data['message'];
            } else {
                $error_msg .= ': ' . $body;
            }
            
            $order->update_status('failed', $error_msg);
            wc_add_notice('No se pudo iniciar el pago con Bold: ' . esc_html($error_msg), 'error');
            return;
        }
        
        // Webhook handler
        public function handle_webhook() {
            $body = file_get_contents('php://input');
            $data = json_decode($body, true);
            
            if (!$data) {
                wp_die('Invalid payload', 'Bold Webhook', ['response' => 400]);
            }
            
            // Verify signature using the official base64 hmac verification
            $received_signature = $_SERVER['HTTP_X_BOLD_SIGNATURE'] ?? $_SERVER['x-bold-signature'] ?? '';
            if (empty($received_signature)) {
                $headers = array_change_key_case(getallheaders());
                $received_signature = $headers['x-bold-signature'] ?? '';
            }
            
            $expected_signature = hash_hmac('sha256', base64_encode($body), $this->secret_key);
            
            if (empty($received_signature) || !hash_equals($expected_signature, $received_signature)) {
                wp_die('Invalid signature', 'Bold Webhook', ['response' => 401]);
            }
            
            $status = $data['status'] ?? $data['payload']['status'] ?? '';
            $order_ref = $data['order_id'] ?? $data['orderId'] ?? $data['payload']['reference'] ?? '';
            
            // Find order by reference
            $orders = wc_get_orders([
                'meta_key' => '_bold_order_ref',
                'meta_value' => $order_ref,
                'limit' => 1,
            ]);
            
            if (empty($orders)) {
                wp_die('Order not found', 'Bold Webhook', ['response' => 404]);
            }
            
            $order = $orders[0];
            
            switch (strtolower($status)) {
                case 'approved':
                case 'successful':
                    $order->payment_complete();
                    $order->add_order_note('Pago confirmed by Bold. Ref: ' . $order_ref);
                    break;
                case 'declined':
                case 'rejected':
                    $order->update_status('failed', 'Pago rechazado por Bold. Ref: ' . $order_ref);
                    break;
                case 'pending':
                    $order->update_status('on-hold', 'Pago pendiente en Bold. Ref: ' . $order_ref);
                    break;
            }
            
            wp_die('OK', 'Bold Webhook', ['response' => 200]);
        }
    }
}
add_action('woocommerce_init', 'sp_bold_gateway_init');

function sp_add_bold_gateway($gateways) {
    $gateways[] = 'WC_Gateway_Bold';
    return $gateways;
}
add_filter('woocommerce_payment_gateways', 'sp_add_bold_gateway');

// Bold payment icons on checkout
function sp_bold_payment_icons() {
    
    if (!function_exists('is_checkout') || !function_exists('is_checkout') && is_checkout()) return;
    ?>
    <style>
    .wc_payment_method label img { max-height: 28px; margin-right: 8px; }
    .payment_method_bold_co label { display: flex !important; align-items: center; gap: 8px; }
    .payment_method_bold_co .payment_box { background: var(--gray-50) !important; border-radius: var(--radius-lg) !important; }
    </style>
    <?php
}

// add_action('wp_footer', 'sp_bold_payment_icons');


// ─── Exit Intent Popup ───────────────────────────────────────
// Exit intent popup removed

function sp_exit_intent_popup() {
    ?>
    <!-- LUXURY 2026 DISCOUNT EXIT POPUP -->
    <div class="sp-exit-modal-overlay" id="spExitModalOverlay">
      <div class="sp-exit-modal-card">
        <button type="button" class="sp-exit-close-btn" onclick="spCloseExitPopup()">&times;</button>

        <div style="width:54px;height:54px;background:rgba(0,168,255,0.12);border:1px solid #00a8ff;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px auto;">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2.5"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
        </div>

        <h3 style="font-size:22px;font-weight:900;color:#ffffff;margin:0 0 8px 0;letter-spacing:-0.02em;">¡ESPERA! COMPLETA TU TRATAMIENTO</h3>
        <p style="font-size:13.5px;color:#cbd5e1;line-height:1.55;margin:0 0 20px 0;">
          Obtén hasta <strong style="color:#00a8ff;">25% de descuento</strong> por cantidad y <strong>envío gratis</strong> a toda Colombia en péptidos suizos de ultra-alta pureza certificada.
        </p>

        <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:22px;">
          <span style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.15);padding:6px 12px;border-radius:8px;font-size:12px;font-weight:700;color:#ffffff;">2 Unidades: 10% OFF</span>
          <span style="background:rgba(0,168,255,0.15);border:1px solid #00a8ff;padding:6px 12px;border-radius:8px;font-size:12px;font-weight:800;color:#00a8ff;">3 Unidades: 20% OFF</span>
          <span style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.15);padding:6px 12px;border-radius:8px;font-size:12px;font-weight:700;color:#ffffff;">4+ Unidades: 25% OFF</span>
        </div>

        <div style="display:flex;flex-direction:column;gap:10px;">
          <a href="<?php echo home_url('/tienda/'); ?>" class="btn-exact-cyan" style="width:100%;padding:14px;border-radius:10px;font-size:14.5px;font-weight:800;text-decoration:none;display:block;box-sizing:border-box;background:#00a8ff;color:#ffffff;text-align:center;" onclick="spCloseExitPopup()">
            Aprovechar Descuento VIP
          </a>
          <button type="button" onclick="spCloseExitPopup()" style="background:transparent;border:none;color:#94a3b8;font-size:13px;font-weight:600;cursor:pointer;padding:6px;">
            Seguir Navegando
          </button>
        </div>
      </div>
    </div>

    <script>
      let spExitShown = false;
      if (sessionStorage.getItem('spExitDismissed') === 'true') {
          spExitShown = true;
      }

      function spShowExitPopup() {
          if (spExitShown) return;
          spExitShown = true;
          const overlay = document.getElementById('spExitModalOverlay');
          if (overlay) overlay.classList.add('active');
      }

      function spCloseExitPopup() {
          const overlay = document.getElementById('spExitModalOverlay');
          if (overlay) overlay.classList.remove('active');
          sessionStorage.setItem('spExitDismissed', 'true');
      }

      // Exit mouse intent trigger
      document.addEventListener('mouseleave', function(e) {
          if (e.clientY < 20) spShowExitPopup();
      });

      // Mobile inactivity auto popup (30 seconds)
      if (window.innerWidth < 768) {
          setTimeout(function() {
              if (!spExitShown) spShowExitPopup();
          }, 30000);
      }
    </script>
    <?php
}

add_action("wp_footer", "sp_exit_intent_popup", 99);



// ─── CRO Urgency Timer & Abandoned Cart Recovery ───────────────────

// 1. Checkout Urgency Timer
function sp_checkout_urgency_timer() {
    
    if (!function_exists('is_checkout') && is_checkout() || is_order_received_page()) return;
    ?>
    <div class="sp-checkout-timer-banner" style="background:#0b1a30; border:1px solid #1e3a8a; border-radius:12px; padding:16px; margin-bottom:24px; display:flex; align-items:center; gap:16px; box-shadow:0 4px 20px rgba(11,26,48,0.15); color:#ffffff; font-family:'Inter', sans-serif;">
        <div class="sp-timer-icon" style="color:#3b82f6; flex-shrink:0; display:flex; align-items:center;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
        </div>
        <div style="flex:1; min-width:0; font-size:14px; line-height:1.5;">
            <span style="font-weight:600; color:#93c5fd; letter-spacing:0.05em; text-transform:uppercase; font-size:11px; display:block; margin-bottom:2px;">Reserva de Stock Activa</span>
            Tus productos de alta pureza se encuentran reservados por <span id="spCheckoutCountdown" style="font-weight:800; font-variant-numeric:tabular-nums; color:#60a5fa; font-size:15px; background:rgba(59,130,246,0.1); padding:2px 6px; border-radius:4px; border:1px solid rgba(59,130,246,0.2);">15:00</span> minutos. Completa tu pedido antes de que expire la reserva.
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const countdownEl = document.getElementById('spCheckoutCountdown');
        if (!countdownEl) return;
        
        let totalSeconds = 15 * 60; // 15 minutes
        
        // Persist timer in sessionStorage so it doesn't reset on reload
        const storedTime = sessionStorage.getItem('sp_checkout_timer_expiry');
        const now = Math.floor(Date.now() / 1000);
        
        if (storedTime) {
            const diff = parseInt(storedTime) - now;
            if (diff > 0) {
                totalSeconds = diff;
            } else {
                totalSeconds = 0;
            }
        } else {
            sessionStorage.setItem('sp_checkout_timer_expiry', (now + totalSeconds).toString());
        }
        
        function updateTimer() {
            if (totalSeconds <= 0) {
                countdownEl.textContent = "Reserva Expirada";
                countdownEl.style.color = '#f87171';
                countdownEl.style.borderColor = 'rgba(239,68,68,0.2)';
                countdownEl.style.background = 'rgba(239,68,68,0.1)';
                return;
            }
            totalSeconds--;
            const mins = Math.floor(totalSeconds / 60);
            const secs = totalSeconds % 60;
            countdownEl.textContent = `${mins}:${secs < 10 ? '0' : ''}${secs}`;
            
            const currentNow = Math.floor(Date.now() / 1000);
            sessionStorage.setItem('sp_checkout_timer_expiry', (currentNow + totalSeconds).toString());
            
            setTimeout(updateTimer, 1000);
        }
        
        updateTimer();
    });
    </script>
    <?php
}
add_action('woocommerce_before_checkout_form', 'sp_checkout_urgency_timer');

// 2. Create Abandoned Carts DB Table on Theme Init
function sp_create_abandoned_cart_table() {
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'sp_abandoned_carts';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        phone varchar(50) DEFAULT '',
        name varchar(100) DEFAULT '',
        cart_contents longtext NOT NULL,
        coupon_code varchar(50) DEFAULT '',
        status varchar(20) DEFAULT 'abandoned',
        created_at datetime NOT NULL,
        updated_at datetime NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('init', 'sp_create_abandoned_cart_table');

// 3. JS Script to Capture Customer Email / Phone in Real-time on checkout blur

function sp_checkout_abandonment_js() {
    if (!function_exists('is_checkout') || !(function_exists('is_checkout') && is_checkout())) {
        return;
    }
}


// 4. AJAX Endpoint to Save Cart Details in DB
function sp_ajax_capture_cart() {
    
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $name = sanitize_text_field($_POST['name'] ?? '');
    
    if (empty($email)) {
        wp_send_json_error();
    }
    
    // Get current cart items
    if (null === WC()->cart) {
        wp_send_json_error();
    }
    
    $cart = WC()->cart->get_cart();
    if (empty($cart)) {
        wp_send_json_error();
    }
    
    $cart_data = [];
    foreach ($cart as $key => $item) {
        $cart_data[] = [
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'variation_id' => $item['variation_id'],
            'variation' => $item['variation']
        ];
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'sp_abandoned_carts';
    
    $exists = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table_name WHERE email = %s", $email));
    $now = current_time('mysql');
    
    if ($exists) {
        $wpdb->update(
            $table_name,
            [
                'phone' => $phone,
                'name' => $name,
                'cart_contents' => wp_json_encode($cart_data),
                'status' => 'abandoned',
                'updated_at' => $now
            ],
            ['id' => $exists->id]
        );
    } else {
        $wpdb->insert(
            $table_name,
            [
                'email' => $email,
                'phone' => $phone,
                'name' => $name,
                'cart_contents' => wp_json_encode($cart_data),
                'status' => 'abandoned',
                'created_at' => $now,
                'updated_at' => $now
            ]
        );
    }
    
    wp_send_json_success();
}
add_action('wp_ajax_sp_capture_cart', 'sp_ajax_capture_cart');
add_action('wp_ajax_nopriv_sp_capture_cart', 'sp_ajax_capture_cart');

// 5. Apply Coupon from URL Parameter (Frictionless checkout recovery link)
function sp_apply_coupon_from_url() {
    
    if (isset($_GET['apply_coupon'])) {
        $coupon_code = sanitize_text_field($_GET['apply_coupon']);
        if (null !== WC()->cart && !WC()->cart->has_discount($coupon_code)) {
            WC()->cart->apply_coupon($coupon_code);
        }
    }
}
add_action('wp_loaded', 'sp_apply_coupon_from_url');

// 6. Mark Cart as Completed on Successful Checkout
function sp_mark_cart_completed($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;
    
    $email = $order->get_billing_email();
    if ($email) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'sp_abandoned_carts';
        $wpdb->update(
            $table_name,
            ['status' => 'completed', 'updated_at' => current_time('mysql')],
            ['email' => $email]
        );
    }
}
add_action('woocommerce_thankyou', 'sp_mark_cart_completed');
add_action('woocommerce_payment_complete', 'sp_mark_cart_completed');

// 7. Dynamic Coupon and Recovery Email Cron
if (!wp_next_scheduled('sp_abandoned_cart_cron')) {
    wp_schedule_event(time(), 'hourly', 'sp_abandoned_cart_cron');
}

add_action('sp_abandoned_cart_cron', 'sp_process_abandoned_carts');
function sp_process_abandoned_carts() {
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'sp_abandoned_carts';
    
    // Find carts abandoned between 30 minutes and 24 hours ago
    $threshold_start = date('Y-m-d H:i:s', time() - 30 * 60);
    $threshold_end = date('Y-m-d H:i:s', time() - 24 * 60 * 60);
    
    $abandoned_carts = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name WHERE status = 'abandoned' AND updated_at < %s AND updated_at > %s LIMIT 10",
        $threshold_start,
        $threshold_end
    ));
    
    foreach ($abandoned_carts as $cart) {
        // Generate WooCommerce 5% discount Coupon
        $coupon_code = 'REC-' . strtoupper(wp_generate_password(6, false, false));
        
        $coupon = new WC_Coupon();
        $coupon->set_code($coupon_code);
        $coupon->set_discount_type('percent');
        $coupon->set_amount(5);
        $coupon->set_individual_use(true);
        $coupon->set_usage_limit(1);
        $coupon->set_expiry_date(time() + 48 * 60 * 60); // 48 hours expiry
        $coupon->save();
        
        // Draft recovery email content
        $to = $cart->email;
        $subject = 'Notamos que dejaste algunos productos de Swiss Peptides...';
        
        $recovery_link = add_query_arg([
            'apply_coupon' => $coupon_code
        ], home_url('/checkout/'));
        
        $name_display = !empty($cart->name) ? trim($cart->name) : 'Investigador';
        
        $message = '<html><body style="font-family: Arial, sans-serif; color: #1e293b; line-height: 1.6; background-color: #f8fafc; padding: 40px 20px;">';
        $message .= '<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">';
        $message .= '<div style="background-color: #0b1a30; padding: 24px; text-align: center; color: #ffffff; font-size: 20px; font-weight: bold; letter-spacing: 0.05em; border-bottom: 2px solid #3b82f6;">SWISS PEPTIDES</div>';
        $message .= '<div style="padding: 32px;">';
        $message .= '<h2 style="color: #0b1a30; margin-top: 0; font-size: 18px;">Estimado ' . esc_html($name_display) . ',</h2>';
        $message .= '<p>Notamos que dejaste algunos productos en tu carrito de compras durante tu reciente visita a nuestra tienda de péptidos de ultra-alta pureza.</p>';
        $message .= '<p>Para apoyarte con tus proyectos y facilitar la continuidad de tu investigación, hemos generado un cupón exclusivo del <strong>5% de descuento</strong> aplicable a tu pedido actual:</p>';
        $message .= '<div style="background-color: #f1f5f9; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 16px; text-align: center; font-size: 18px; font-weight: bold; color: #3b82f6; margin: 24px 0; letter-spacing: 0.1em;">' . esc_html($coupon_code) . '</div>';
        $message .= '<p style="text-align: center; margin: 32px 0;">';
        $message .= '<a href="' . esc_url($recovery_link) . '" style="background-color: #3b82f6; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 6px; font-weight: bold; display: inline-block; box-shadow: 0 4px 12px rgba(59,130,246,0.25);">Aplicar 5% OFF y Completar Pedido</a>';
        $message .= '</p>';
        $message .= '<p style="font-size: 12px; color: #64748b; text-align: center; margin-top: 32px;">* Este cupón es de un solo uso y expira en un plazo de 48 horas.</p>';
        $message .= '</div>';
        $message .= '<div style="background-color: #f8fafc; padding: 20px; text-align: center; font-size: 12px; color: #64748b; border-top: 1px solid #e2e8f0;">';
        $message .= 'Swiss Peptides Colombia • Pureza Certificada HPLC/MS • Envío Gratis a nivel nacional';
        $message .= '</div></div></body></html>';
        
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: Swiss Peptides <info@peptidossuizos.com>'
        ];
        
        $mail_sent = wp_mail($to, $subject, $message, $headers);
        
        if ($mail_sent) {
            $wpdb->update(
                $table_name,
                [
                    'status' => 'sent',
                    'coupon_code' => $coupon_code,
                    'updated_at' => current_time('mysql')
                ],
                ['id' => $cart->id]
            );
        }
    }
}




function sp_ajax_contact_form() {
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $city = sanitize_text_field($_POST['city'] ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? 'Consulta desde el Sitio Web');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    $to = 'pedidos@peptidossuizos.com';
    $email_subject = 'Nueva Consulta de Contacto: ' . $subject;
    
    $body = "Has recibido un nuevo mensaje desde el formulario de contacto de Swiss Peptides Labs:

";
    $body .= "Nombre: " . $name . "
";
    $body .= "Email: " . $email . "
";
    $body .= "Teléfono/WhatsApp: " . $phone . "
";
    $body .= "Ciudad: " . $city . "
";
    $body .= "Asunto: " . $subject . "

";
    $body .= "Mensaje:
" . $message . "

";
    $body .= "--- Enviado desde peptidossuizos.com ---";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: Swiss Peptides <pedidos@peptidossuizos.com>',
        'Reply-To: ' . $email
    ];

    @wp_mail($to, $email_subject, $body, $headers);

    wp_send_json_success('¡Mensaje enviado con éxito! Nos comunicaremos contigo a la brevedad.');
}
add_action('wp_ajax_sp_contact_form', 'sp_ajax_contact_form');
add_action('wp_ajax_nopriv_sp_contact_form', 'sp_ajax_contact_form');


// FORCE DEDICATED TIENDA TEMPLATE ON /tienda/ AND WOOCOMMERCE SHOP
add_filter('template_include', 'sp_master_shop_template_override', 99);
function sp_master_shop_template_override($template) {
    if (is_admin()) return $template;
    if ((function_exists('is_shop') && is_shop()) || is_page('tienda') || (isset($_SERVER['REQUEST_URI']) && (strpos($_SERVER['REQUEST_URI'], '/tienda') !== false || strpos($_SERVER['REQUEST_URI'], '/shop') !== false))) {
        $shop_template = get_template_directory() . '/page-tienda.php';
        if (file_exists($shop_template)) {
            return $shop_template;
        }
    }
    return $template;
}


// FORCE SINGLE PRODUCT REWRITE RULES & TEMPLATE LOADING (/producto/ & /product/)
add_action('init', 'sp_custom_product_rewrite_rules', 5);
function sp_custom_product_rewrite_rules() {
    add_rewrite_rule('^producto/([^/]+)/?$', 'index.php?product=$matches[1]', 'top');
    add_rewrite_rule('^product/([^/]+)/?$', 'index.php?product=$matches[1]', 'top');
}

add_filter('template_include', 'sp_single_product_template_override', 99);
function sp_single_product_template_override($template) {
    if (is_admin()) return $template;
    if (is_singular('product') || get_query_var('product') || (isset($_SERVER['REQUEST_URI']) && (strpos($_SERVER['REQUEST_URI'], '/producto/') !== false || strpos($_SERVER['REQUEST_URI'], '/product/') !== false))) {
        $single_prod_template = get_template_directory() . '/single-product.php';
        if (file_exists($single_prod_template)) {
            return $single_prod_template;
        }
    }
    return $template;
}

// MASTER SINGLE PRODUCT RESOLVER & CANONICAL REDIRECT OVERRIDE
add_filter('redirect_canonical', 'sp_disable_product_canonical_redirect', 10, 2);
function sp_disable_product_canonical_redirect($redirect_url, $requested_url) {
    if (strpos($requested_url, '/producto/') !== false || strpos($requested_url, '/product/') !== false) {
        return false;
    }
    return $redirect_url;
}

add_action('template_redirect', 'sp_resolve_single_product_page', 1);
function sp_resolve_single_product_page() {
    if (is_admin()) return;
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (preg_match('#/(?:producto|product)/([^/]+)/?#', $uri, $matches)) {
        $slug = sanitize_title($matches[1]);
        $prods = get_posts(array(
            'name'        => $slug,
            'post_type'   => 'product',
            'post_status' => 'publish',
            'numberposts' => 1
        ));
        if (!empty($prods)) {
            global $post, $wp_query;
            $post = $prods[0];
            setup_postdata($post);
            $wp_query->is_single = true;
            $wp_query->is_singular = true;
            $wp_query->is_404 = false;
            $wp_query->post = $post;
            $wp_query->posts = array($post);
            $wp_query->post_count = 1;
            $wp_query->queried_object = $post;
            $wp_query->queried_object_id = $post->ID;
            status_header(200);
            
            $template = get_template_directory() . '/single-product.php';
            if (file_exists($template)) {
                include $template;
                exit;
            }
        }
    }
}

