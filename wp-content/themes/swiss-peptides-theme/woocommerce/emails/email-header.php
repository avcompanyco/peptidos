<?php
/**
 * Email Header - Swiss Peptides Branded Premium Dark Theme
 */
if (!defined('ABSPATH')) exit;

$email_heading = isset($email_heading) ? $email_heading : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo get_bloginfo('name', 'display'); ?></title>
  <style>
    /* Clean Premium Light Theme with Dark Blue Accents */
    body, #wrapper, .wrapper-table {
      background-color: #f0f4f8 !important;
      color: #334155 !important;
    }
    #body_content h1, #body_content h2, #body_content h3, #body_content h4, #body_content h5, #body_content h6 {
      color: #0f1c3f !important;
    }
    .header-title {
      color: #ffffff !important;
      text-align: center !important;
    }
    p, span, li, dt, dd {
      color: #334155 !important;
    }
    strong, b {
      color: #0f1c3f !important;
    }
    a, .link {
      color: #0ea5e9 !important;
      text-decoration: none !important;
    }
    table {
      border-color: #e2e8f0 !important;
    }
    th {
      color: #0f1c3f !important;
      font-weight: bold !important;
      border-bottom: 2px solid #e2e8f0 !important;
    }
    td {
      color: #334155 !important;
    }
    .td {
      color: #334155 !important;
      border: 1px solid #e2e8f0 !important;
    }
    .order_item td {
      border-bottom: 1px solid #e2e8f0 !important;
    }
    /* WooCommerce address cards */
    .address {
      border: 1px solid #cbd5e1 !important;
      background-color: #f8fafc !important;
      color: #334155 !important;
    }
    #body_content_inner {
      color: #334155 !important;
      font-family: 'Manrope', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
    }
    /* Reset default table styles to match light theme */
    table.td {
      border: 1px solid #e2e8f0 !important;
    }
    table.td td {
      border: 1px solid #e2e8f0 !important;
    }
  </style>
</head>
<body style="margin:0;padding:0;background-color:#f0f4f8;font-family:'Manrope', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;color:#334155;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;">
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" class="wrapper-table" style="background-color:#f0f4f8;padding:40px 20px;">
    <tr>
      <td align="center">
        <table role="presentation" cellpadding="0" cellspacing="0" width="600" style="max-width:600px;width:100%;background-color:#ffffff;border-radius:24px;border:1px solid #cbd5e1;overflow:hidden;box-shadow:0 20px 40px rgba(15,28,63,0.08);">
          <!-- Header -->
          <tr>
            <td style="background:linear-gradient(135deg, #0f1c3f 0%, #060e22 100%);padding:48px 40px;text-align:center;">
              <img src="<?php echo get_template_directory_uri(); ?>/img/logo/logo_swiss.png" alt="Swiss Peptides Logo" width="238" height="28" style="display:inline-block;filter:drop-shadow(0 4px 10px rgba(6,182,212,0.4));margin-bottom:16px;">
              <?php if ($email_heading) : ?>
                <h1 class="header-title" style="margin:0;text-align:center !important;font-size:24px;font-weight:800;color:#ffffff;letter-spacing:1px;text-transform:uppercase;"><?php echo $email_heading; ?></h1>
              <?php endif; ?>
            </td>
          </tr>
          <!-- Accent Line -->
          <tr>
            <td style="height:4px;background:linear-gradient(90deg, #0ea5e9 0%, #06b6d4 100%);"></td>
          </tr>
          <!-- Body Content Area -->
          <tr>
            <td id="body_content" style="padding:48px 40px;color:#334155;background-color:#ffffff;">
