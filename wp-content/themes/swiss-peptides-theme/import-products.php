<?php
/**
 * Swiss Peptides — Product Importer
 * Run once from browser: https://peptidossuizos.com/wp-content/themes/swiss-peptides/import-products.php
 * Delete after import!
 */

// Load WordPress
require_once dirname(__FILE__) . '/../../../wp-load.php';

if (!current_user_can('manage_options')) {
    die('Unauthorized');
}

echo '<h1>Swiss Peptides — Product Import</h1><pre>';

// Category mapping
$categories = [
    'weight-loss' => 'Pérdida de Peso',
    'dermatology' => 'Dermatología',
    'performance' => 'Rendimiento',
    'regeneration' => 'Regeneración',
    'anti-aging' => 'Anti-Aging',
    'sexual-health' => 'Salud Sexual',
    'immunology' => 'Inmunología',
    'neurology' => 'Neurología',
    'sleep' => 'Sueño',
    'accessories' => 'Accesorios',
];

// Create categories
$cat_ids = [];
foreach ($categories as $slug => $name) {
    $existing = get_term_by('slug', $slug, 'product_cat');
    if ($existing) {
        $cat_ids[$slug] = $existing->term_id;
        echo "Category exists: $name (ID: {$existing->term_id})\n";
    } else {
        $result = wp_insert_term($name, 'product_cat', ['slug' => $slug]);
        if (!is_wp_error($result)) {
            $cat_ids[$slug] = $result['term_id'];
            echo "Created category: $name (ID: {$result['term_id']})\n";
        } else {
            echo "ERROR creating $name: " . $result->get_error_message() . "\n";
        }
    }
}

// Products data
$products_json = '[
  {"id":1,"slug":"aicaburn","name":"AicaBurn","subtitle":"AICAR 50mg","price":1260000,"originalPrice":1470000,"category":"weight-loss","badge":"Popular","image":"aicaburn.webp","purity":"99%","content":"50mg por vial","molecular":"C₉H₁₄N₄O₅","weight":"258.2 g/mol","overview":"AICAR es un compuesto metabólico reconocido por su capacidad para activar la proteína quinasa activada por AMP (AMPK).","benefits":"Activa AMPK\nMejora la captación de glucosa\nPromueve la oxidación de ácidos grasos\nApoya la biogénesis mitocondrial","storage":"Almacenar polvo liofilizado a 20°C.","featured":true,"stock":15},
  {"id":2,"slug":"aod-9604","name":"AOD-9604","subtitle":"10mg","price":890000,"originalPrice":1050000,"category":"weight-loss","badge":"","image":"aod9604.webp","purity":"≥98%","content":"10mg por vial","molecular":"C₇₈H₁₂₃N₂₁O₂₃S₁","weight":"1815.1 g/mol","overview":"AOD-9604 es un péptido que corresponde a una región modificada de la hormona de crecimiento humana.","benefits":"Estimula la lipólisis\nNo afecta glucosa\nReducción adiposa\nMínimos efectos secundarios","storage":"Almacenar a -20°C.","featured":false,"stock":22},
  {"id":3,"slug":"appetitex","name":"Appetitex","subtitle":"Control de Apetito","price":1260000,"originalPrice":1470000,"category":"weight-loss","badge":"Best Seller","image":"appetitex.webp","purity":"≥98%","content":"1 vial","molecular":"","weight":"","overview":"Appetitex es un péptido avanzado diseñado para la regulación del apetito y el control de peso.","benefits":"Suprime el apetito\nRegulación del peso corporal\nActúa sobre mecanismos de saciedad\nControl de ingesta calórica","storage":"Almacenar a -20°C.","featured":true,"stock":8},
  {"id":4,"slug":"bacteriostatic-water","name":"Agua Bacteriostática","subtitle":"3ml","price":45000,"originalPrice":55000,"category":"accessories","badge":"","image":"bacteriostatic-water.webp","purity":"USP","content":"3ml","molecular":"","weight":"","overview":"Agua bacteriostática de grado farmacéutico para reconstitución de péptidos.","benefits":"Grado farmacéutico\nEstéril\nIdeal para reconstitución","storage":"Temperatura ambiente.","featured":false,"stock":50},
  {"id":5,"slug":"botulift","name":"Botulift","subtitle":"Péptido Antiarrugas","price":1260000,"originalPrice":1470000,"category":"dermatology","badge":"","image":"botulift.webp","purity":"≥98%","content":"1 vial","molecular":"","weight":"","overview":"Botulift es un péptido desarrollado para la investigación en reducción de líneas de expresión.","benefits":"Reduce líneas de expresión\nEstudiado para rejuvenecimiento\nAlta biocompatibilidad","storage":"Almacenar a -20°C.","featured":true,"stock":12},
  {"id":6,"slug":"bpc-157-tb-500","name":"BPC-157 + TB-500","subtitle":"Blend Regenerativo","price":1430000,"originalPrice":1680000,"category":"regeneration","badge":"","image":"bpc157-tb500.webp","purity":"≥98%","content":"1 vial","molecular":"","weight":"","overview":"Blend sinérgico de dos péptidos regenerativos de alta investigación.","benefits":"Sinergia regenerativa\nRecuperación tisular\nAntiinflamatorio\nCicatrización","storage":"Almacenar a -20°C.","featured":false,"stock":18},
  {"id":7,"slug":"bpc-healix","name":"BPC-Healix","subtitle":"BPC-157","price":1260000,"originalPrice":1470000,"category":"regeneration","badge":"Popular","image":"bpc-healix.webp","purity":"≥98%","content":"1 vial","molecular":"","weight":"","overview":"BPC-Healix contiene BPC-157, estudiado por sus propiedades regenerativas.","benefits":"Regeneración tisular\nProtección gástrica\nAntiinflamatorio","storage":"Almacenar a -20°C.","featured":true,"stock":10},
  {"id":8,"slug":"bronzex","name":"BronzeX","subtitle":"Melanotan II","price":1050000,"originalPrice":1260000,"category":"dermatology","badge":"","image":"bronzex.webp","purity":"≥98%","content":"10mg por vial","molecular":"","weight":"","overview":"BronzeX basado en Melanotan II, investigado por su efecto en la melanogénesis.","benefits":"Estimula melanogénesis\nProtección UV investigada","storage":"Almacenar a -20°C.","featured":false,"stock":20},
  {"id":9,"slug":"dermacooper","name":"DermaCooper","subtitle":"GHK-Cu","price":1050000,"originalPrice":1260000,"category":"dermatology","badge":"","image":"dermacooper.webp","purity":"≥98%","content":"50mg por vial","molecular":"","weight":"","overview":"DermaCooper contiene el péptido de cobre GHK-Cu, investigado por sus propiedades regenerativas en piel.","benefits":"Estimula colágeno\nReparación celular\nAntioxidante","storage":"Almacenar a -20°C.","featured":false,"stock":15},
  {"id":10,"slug":"dermakpv","name":"DermaKPV","subtitle":"KPV Péptido","price":1470000,"originalPrice":1680000,"category":"dermatology","badge":"","image":"dermakpv.webp","purity":"≥98%","content":"10mg por vial","molecular":"","weight":"","overview":"DermaKPV basado en KPV, un tripéptido antiinflamatorio derivado de la hormona alfa-MSH.","benefits":"Antiinflamatorio\nInvestigado en dermatitis\nInmunomodulador","storage":"Almacenar a -20°C.","featured":false,"stock":14},
  {"id":11,"slug":"epitalon","name":"Epitalon","subtitle":"10mg","price":1090000,"originalPrice":1260000,"category":"anti-aging","badge":"","image":"epitalon.webp","purity":"≥98%","content":"10mg por vial","molecular":"","weight":"","overview":"Epitalon es un tetrapéptido investigado por su capacidad de activar la telomerasa.","benefits":"Activación de telomerasa\nAnti-envejecimiento celular\nRegulación circadiana","storage":"Almacenar a -20°C.","featured":true,"stock":11},
  {"id":12,"slug":"erosense","name":"Erosense","subtitle":"PT-141","price":840000,"originalPrice":1050000,"category":"sexual-health","badge":"","image":"erosense.webp","purity":"≥98%","content":"10mg por vial","molecular":"","weight":"","overview":"Erosense basado en PT-141, investigado por sus efectos en la función sexual.","benefits":"Función sexual\nActúa vía SNC\nNo vasodilator","storage":"Almacenar a -20°C.","featured":false,"stock":20},
  {"id":13,"slug":"fertinova","name":"FertiNova","subtitle":"Kisspeptina","price":840000,"originalPrice":1050000,"category":"sexual-health","badge":"","image":"fertinova.webp","purity":"≥98%","content":"5mg por vial","molecular":"","weight":"","overview":"FertiNova basado en Kisspeptina, péptido estudiado en regulación reproductiva.","benefits":"Regulación hormonal\nFertilidad investigada","storage":"Almacenar a -20°C.","featured":false,"stock":16},
  {"id":14,"slug":"ghr-prime","name":"GHR-Prime","subtitle":"GHRP-6","price":1260000,"originalPrice":1470000,"category":"performance","badge":"","image":"ghr-prime.webp","purity":"≥98%","content":"10mg por vial","molecular":"","weight":"","overview":"GHR-Prime contiene GHRP-6, un hexapéptido secretagogo de hormona de crecimiento.","benefits":"Estimula GH\nRecuperación muscular\nApetito","storage":"Almacenar a -20°C.","featured":false,"stock":18},
  {"id":15,"slug":"glutapurex","name":"GlutaPureX","subtitle":"Glutatión","price":1050000,"originalPrice":1260000,"category":"dermatology","badge":"","image":"glutapurex.webp","purity":"≥98%","content":"200mg por vial","molecular":"","weight":"","overview":"GlutaPureX contiene glutatión de alta pureza, el principal antioxidante celular.","benefits":"Antioxidante master\nDetoxificación\nLuminosidad cutánea","storage":"Almacenar a -20°C.","featured":false,"stock":25},
  {"id":16,"slug":"gonodomax","name":"GonodoMax","subtitle":"Gonadorelina","price":1260000,"originalPrice":1470000,"category":"sexual-health","badge":"","image":"gonodomax.webp","purity":"≥98%","content":"2mg por vial","molecular":"","weight":"","overview":"GonodoMax basado en Gonadorelina, péptido idéntico a GnRH natural.","benefits":"Regulación gonadal\nEstimulación LH/FSH","storage":"Almacenar a -20°C.","featured":false,"stock":13},
  {"id":17,"slug":"growthprime","name":"GrowthPrime","subtitle":"CJC-1295 + Ipamorelin","price":1400000,"originalPrice":1680000,"category":"performance","badge":"Popular","image":"growthprime.webp","purity":"≥98%","content":"Blend","molecular":"","weight":"","overview":"GrowthPrime es un blend de CJC-1295 e Ipamorelin, investigado para estimulación de GH.","benefits":"Estimulación sinérgica de GH\nRecuperación\nComposición corporal","storage":"Almacenar a -20°C.","featured":true,"stock":9},
  {"id":18,"slug":"igf-novax","name":"IGF-Novax","subtitle":"IGF-1 LR3","price":1010000,"originalPrice":1260000,"category":"performance","badge":"","image":"igf-novax.webp","purity":"≥98%","content":"1mg por vial","molecular":"","weight":"","overview":"IGF-Novax contiene IGF-1 LR3, factor de crecimiento insulínico modificado.","benefits":"Crecimiento celular\nRecuperación muscular\nAnabólico","storage":"Almacenar a -20°C.","featured":false,"stock":14},
  {"id":19,"slug":"immunothyx","name":"ImmunoThyx","subtitle":"Thymosin Alpha-1","price":970000,"originalPrice":1150000,"category":"immunology","badge":"","image":"immunothyx.webp","purity":"≥98%","content":"5mg por vial","molecular":"","weight":"","overview":"ImmunoThyx contiene Timosina Alfa-1, péptido inmunomodulador investigado ampliamente.","benefits":"Inmunomodulación\nActivación de células T\nAntiviral investigado","storage":"Almacenar a -20°C.","featured":false,"stock":17},
  {"id":20,"slug":"ipagrow","name":"IpaGrow","subtitle":"Ipamorelin","price":1050000,"originalPrice":1260000,"category":"performance","badge":"","image":"ipagrow.webp","purity":"≥98%","content":"5mg por vial","molecular":"","weight":"","overview":"IpaGrow basado en Ipamorelin, secretagogo selectivo de hormona de crecimiento.","benefits":"Selectivo para GH\nSin efecto en cortisol\nRecuperación","storage":"Almacenar a -20°C.","featured":false,"stock":21},
  {"id":21,"slug":"klowxtreme","name":"KlowXtreme","subtitle":"LL-37","price":1050000,"originalPrice":1260000,"category":"immunology","badge":"","image":"klowxtreme.webp","purity":"≥98%","content":"5mg por vial","molecular":"","weight":"","overview":"KlowXtreme contiene LL-37, un péptido antimicrobiano humano de la familia catelicidina.","benefits":"Antimicrobiano\nAntiinflamatorio\nInmunodefensa","storage":"Almacenar a -20°C.","featured":false,"stock":16},
  {"id":22,"slug":"ll-guard","name":"LL-Guard","subtitle":"BPC-157 + LL-37","price":1050000,"originalPrice":1260000,"category":"regeneration","badge":"","image":"ll-guard.webp","purity":"≥98%","content":"Blend","molecular":"","weight":"","overview":"LL-Guard combina BPC-157 y LL-37 para una acción regenerativa y antimicrobiana sinérgica.","benefits":"Regeneración + antimicrobiano\nSinergia dual\nCicatrización","storage":"Almacenar a -20°C.","featured":false,"stock":11},
  {"id":23,"slug":"luminax","name":"Luminax","subtitle":"Glutatión + GHK-Cu","price":1050000,"originalPrice":1260000,"category":"dermatology","badge":"","image":"luminax.webp","purity":"≥98%","content":"Blend","molecular":"","weight":"","overview":"Luminax es un blend dermatológico de Glutatión y GHK-Cu para luminosidad cutánea.","benefits":"Luminosidad\nAntioxidante\nRegeneración cutánea","storage":"Almacenar a -20°C.","featured":false,"stock":19},
  {"id":24,"slug":"mitocorex","name":"MitoCoreX","subtitle":"NAD+ Premium","price":2100000,"originalPrice":2520000,"category":"anti-aging","badge":"Premium","image":"mitocorex.webp","purity":"≥99%","content":"500mg","molecular":"","weight":"","overview":"MitoCoreX contiene NAD+ de grado premium para investigación en longevidad celular.","benefits":"Energía mitocondrial\nReparación ADN\nLongevidad celular\nMetabolismo","storage":"Almacenar a -20°C.","featured":true,"stock":6},
  {"id":25,"slug":"mitoshield","name":"MitoShield","subtitle":"SS-31","price":1470000,"originalPrice":1680000,"category":"anti-aging","badge":"","image":"mitoshield.webp","purity":"≥98%","content":"10mg","molecular":"","weight":"","overview":"MitoShield basado en SS-31, un péptido antioxidante mitocondrial selectivo.","benefits":"Protección mitocondrial\nAntioxidante selectivo\nEnergía celular","storage":"Almacenar a -20°C.","featured":false,"stock":10},
  {"id":26,"slug":"nad-plus","name":"NAD+","subtitle":"250mg","price":1300000,"originalPrice":1530000,"category":"anti-aging","badge":"","image":"nad-plus.webp","purity":"≥98%","content":"250mg por vial","molecular":"","weight":"","overview":"NAD+ (nicotinamida adenina dinucleótido) para investigación en metabolismo energético celular.","benefits":"Metabolismo energético\nReparación ADN\nEnvejecimiento celular","storage":"Almacenar a -20°C.","featured":false,"stock":13},
  {"id":27,"slug":"neuromaxide","name":"NeuroMaxide","subtitle":"Semax","price":1260000,"originalPrice":1470000,"category":"neurology","badge":"","image":"neuromaxide.webp","purity":"≥98%","content":"30mg","molecular":"","weight":"","overview":"NeuroMaxide contiene Semax, un péptido nootrópico regulador de BDNF.","benefits":"Nootrópico\nBDNF\nEnfoque cognitivo","storage":"Almacenar a -20°C.","featured":false,"stock":15},
  {"id":28,"slug":"neurovascx","name":"NeuroVascX","subtitle":"Cerebrolysin","price":1400000,"originalPrice":1680000,"category":"neurology","badge":"","image":"neurovascx.webp","purity":"≥98%","content":"10ml","molecular":"","weight":"","overview":"NeuroVascX para investigación en neuroprotección y plasticidad neuronal.","benefits":"Neuroprotección\nPlasticidad neuronal\nRecuperación cognitiva","storage":"Almacenar a 2-8°C.","featured":false,"stock":8},
  {"id":29,"slug":"nocturnax","name":"Nocturnax","subtitle":"DSIP","price":1260000,"originalPrice":1470000,"category":"sleep","badge":"","image":"nocturnax.webp","purity":"≥98%","content":"5mg por vial","molecular":"","weight":"","overview":"Nocturnax basado en DSIP, péptido inductor del sueño delta investigado desde los 70s.","benefits":"Regulación del sueño\nSueño delta profundo\nRitmo circadiano","storage":"Almacenar a -20°C.","featured":false,"stock":14},
  {"id":30,"slug":"noctyline","name":"Noctyline","subtitle":"Epitalon + DSIP","price":1050000,"originalPrice":1260000,"category":"sleep","badge":"","image":"noctyline.webp","purity":"≥98%","content":"Blend","molecular":"","weight":"","overview":"Noctyline combina Epitalon y DSIP para investigación en regulación del sueño y longevidad.","benefits":"Sueño + Anti-aging\nMelatonina natural\nRitmo circadiano","storage":"Almacenar a -20°C.","featured":false,"stock":16},
  {"id":31,"slug":"oxyluxe","name":"Oxyluxe","subtitle":"TB-500","price":1260000,"originalPrice":1470000,"category":"performance","badge":"","image":"oxyluxe.webp","purity":"≥98%","content":"5mg por vial","molecular":"","weight":"","overview":"Oxyluxe contiene TB-500, péptido regenerativo investigado por su capacidad de recuperación tisular.","benefits":"Regeneración tisular\nFlexibilidad\nAntiinflamatorio","storage":"Almacenar a -20°C.","featured":false,"stock":17},
  {"id":32,"slug":"retatrutide","name":"Retatrutide","subtitle":"Triple Agonista GIP/GLP-1/Glucagón","price":1530000,"originalPrice":1800000,"category":"weight-loss","badge":"Nuevo","image":"retatrutide.webp","purity":"≥98%","content":"10mg","molecular":"","weight":"","overview":"Retatrutide es un triple agonista de receptores GIP, GLP-1 y glucagón, de última generación.","benefits":"Triple agonista\nControl de peso avanzado\nRegulación metabólica","storage":"Almacenar a -20°C.","featured":true,"stock":5},
  {"id":33,"slug":"selenyx","name":"Selenyx","subtitle":"Thymulin","price":1260000,"originalPrice":1470000,"category":"immunology","badge":"","image":"selenyx.webp","purity":"≥98%","content":"10mg","molecular":"","weight":"","overview":"Selenyx contiene Timulina, péptido tímico investigado para regulación inmunológica.","benefits":"Regulación inmune\nMaduración de células T\nInmunosenescencia","storage":"Almacenar a -20°C.","featured":false,"stock":12},
  {"id":34,"slug":"semaglutide","name":"Semaglutide","subtitle":"GLP-1 Agonista","price":1320000,"originalPrice":1530000,"category":"weight-loss","badge":"Popular","image":"semaglutide.webp","purity":"≥98%","content":"5mg por vial","molecular":"","weight":"","overview":"Semaglutide, agonista del receptor GLP-1, investigado para control metabólico y de peso.","benefits":"Agonista GLP-1\nControl de apetito\nRegulación glucémica","storage":"Almacenar a 2-8°C.","featured":true,"stock":7},
  {"id":35,"slug":"somatonova","name":"SomatoNova","subtitle":"Fragment 176-191","price":1260000,"originalPrice":1470000,"category":"performance","badge":"","image":"somatonova.webp","purity":"≥98%","content":"5mg por vial","molecular":"","weight":"","overview":"SomatoNova basado en HGH Fragment 176-191, la porción lipolítica de la hormona de crecimiento.","benefits":"Lipólisis selectiva\nSin efecto en glucosa\nComposición corporal","storage":"Almacenar a -20°C.","featured":false,"stock":19},
  {"id":36,"slug":"tesalean","name":"TesaLean","subtitle":"Tesofensine","price":1260000,"originalPrice":1470000,"category":"weight-loss","badge":"","image":"tesalean.webp","purity":"≥98%","content":"500mcg cápsulas","molecular":"","weight":"","overview":"TesaLean basado en Tesofensine, compuesto investigado para control de peso corporal.","benefits":"Control de peso\nInhibidor triple recaptación\nSaciedad","storage":"Almacenar a temperatura ambiente.","featured":false,"stock":15},
  {"id":37,"slug":"thymaregen","name":"ThymaRegen","subtitle":"Thymosin Beta-4","price":1050000,"originalPrice":1260000,"category":"immunology","badge":"","image":"thymaregen.webp","purity":"≥98%","content":"5mg por vial","molecular":"","weight":"","overview":"ThymaRegen contiene Timosina Beta-4, péptido investigado por sus propiedades regenerativas.","benefits":"Regeneración tisular\nAngiogénesis\nAntiinflamatorio","storage":"Almacenar a -20°C.","featured":false,"stock":13},
  {"id":38,"slug":"tirzepatide","name":"Tirzepatide","subtitle":"Dual GIP/GLP-1","price":1320000,"originalPrice":1530000,"category":"weight-loss","badge":"Nuevo","image":"tirzepatide.webp","purity":"≥98%","content":"10mg","molecular":"","weight":"","overview":"Tirzepatide, agonista dual de receptores GIP y GLP-1, última innovación en investigación metabólica.","benefits":"Dual agonista GIP/GLP-1\nControl metabólico\nRegulación de peso","storage":"Almacenar a 2-8°C.","featured":true,"stock":4},
  {"id":39,"slug":"vip-neurox","name":"Vip-NeuroX","subtitle":"VIP Péptido","price":1130000,"originalPrice":1320000,"category":"neurology","badge":"","image":"vip-neurox.webp","purity":"≥98%","content":"2mg por vial","molecular":"","weight":"","overview":"Vip-NeuroX basado en el Péptido Intestinal Vasoactivo (VIP), neuropéptido con múltiples funciones.","benefits":"Neuroprotección\nAntiinflamatorio\nVasodilatador","storage":"Almacenar a -20°C.","featured":false,"stock":11}
]';

$products = json_decode($products_json, true);
$theme_dir = get_template_directory();
$upload_dir = wp_upload_dir();
$imported = 0;

foreach ($products as $p) {
    // Check if product already exists
    $existing = get_page_by_path($p['slug'], OBJECT, 'product');
    if ($existing) {
        echo "SKIP: {$p['name']} already exists\n";
        continue;
    }

    // Create product
    $product = new WC_Product_Simple();
    $product->set_name($p['name']);
    $product->set_slug($p['slug']);
    $product->set_regular_price($p['originalPrice']);
    $product->set_sale_price($p['price']);
    $product->set_short_description($p['subtitle']);
    $product->set_description($p['overview']);
    $product->set_status('publish');
    $product->set_catalog_visibility('visible');
    $product->set_manage_stock(true);
    $product->set_stock_quantity($p['stock']);
    $product->set_stock_status('instock');

    if ($p['featured']) {
        $product->set_featured(true);
    }

    // Category
    if (isset($cat_ids[$p['category']])) {
        $product->set_category_ids([$cat_ids[$p['category']]]);
    }

    $product_id = $product->save();

    // Custom meta
    update_post_meta($product_id, 'sp_purity', $p['purity']);
    update_post_meta($product_id, 'sp_content', $p['content']);
    update_post_meta($product_id, 'sp_molecular', $p['molecular'] ?? '');
    update_post_meta($product_id, 'sp_mol_weight', $p['weight'] ?? '');
    update_post_meta($product_id, 'sp_storage', $p['storage'] ?? '');
    update_post_meta($product_id, 'sp_benefits', $p['benefits'] ?? '');

    // Upload image
    $img_path = $theme_dir . '/img/products/' . $p['image'];
    if (file_exists($img_path)) {
        $img_data = file_get_contents($img_path);
        $filename = basename($p['image']);
        $upload = wp_upload_bits($filename, null, $img_data);
        if (!$upload['error']) {
            $filetype = wp_check_filetype($filename);
            $attachment = [
                'post_mime_type' => $filetype['type'],
                'post_title' => $p['name'],
                'post_content' => '',
                'post_status' => 'inherit',
            ];
            $attach_id = wp_insert_attachment($attachment, $upload['file'], $product_id);
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
            wp_update_attachment_metadata($attach_id, $attach_data);
            $product->set_image_id($attach_id);
            $product->save();
            echo "OK: {$p['name']} (ID: $product_id) with image\n";
        } else {
            echo "OK: {$p['name']} (ID: $product_id) NO IMAGE: {$upload['error']}\n";
        }
    } else {
        echo "OK: {$p['name']} (ID: $product_id) image not found: $img_path\n";
    }

    $imported++;
}

echo "\n\nDone! Imported $imported products.\n";
echo '</pre>';
echo '<p><strong>DELETE THIS FILE NOW!</strong></p>';
echo '<p><a href="' . admin_url('edit.php?post_type=product') . '">Go to Products →</a></p>';
