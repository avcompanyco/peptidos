<?php
require_once('/www/wwwroot/peptidossuizos.com/wp-load.php');

global $ts_mail_err;
add_action('wp_mail_failed', function($e) {
    global $ts_mail_err;
    $ts_mail_err = $e->get_error_message();
});

$to = 'antoniovarona@avcompany.co';
$subject = '[Swiss Peptides] Test Sales System Email';
$message = '<h1>Swiss Peptides Labs</h1><p>Prueba del sistema de cotizaciones y correo de ventas.</p>';
$headers = array('Content-Type: text/html; charset=UTF-8');

$res = wp_mail($to, $subject, $message, $headers);

echo "RESULT: " . ($res ? "SUCCESS (TRUE)" : "FAILED (FALSE)") . "
";
if (!empty($ts_mail_err)) {
    echo "ERROR: " . $ts_mail_err . "
";
}
?>