<?php
define('ABSPATH', dirname(__FILE__) . '/../../../');
require_once ABSPATH . 'wp-load.php';
header('Content-Type: text/plain; charset=utf-8');

// Common English-to-Spanish translations for research benefits
$benefit_translations = [
    'Regulates central appetite and satiety signaling' => 'Regula la señalización central del apetito y la saciedad',
    'Slows gastric emptying in metabolic research models' => 'Ralentiza el vaciamiento gástrico en modelos metabólicos',
    'Influences energy intake and feeding behavior pathways' => 'Influye en las vías de ingesta energética y comportamiento alimentario',
    'Activates amylin receptor-mediated mechanisms' => 'Activa mecanismos mediados por receptores de amilina',
    'Supports research on body weight regulation' => 'Apoya la investigación en regulación del peso corporal',
    'Enhances understanding of brain-gut communication' => 'Mejora la comprensión de la comunicación cerebro-intestino',
    'Studied for synergistic metabolic pathway modulation' => 'Estudiado para modulación sinérgica de vías metabólicas',
    'Stimulates lipolysis' => 'Estimula la lipólisis',
    'Inhibits lipogenesis' => 'Inhibe la lipogénesis',
    'Promotes fat oxidation' => 'Promueve la oxidación de grasas',
    'Supports cartilage repair' => 'Apoya la reparación del cartílago',
    'No impact on blood glucose' => 'Sin impacto en la glucosa sanguínea',
    'Mimics exercise at cellular level' => 'Imita el ejercicio a nivel celular',
    'Activates AMPK pathway' => 'Activa la vía AMPK',
    'Promotes glucose uptake' => 'Promueve la captación de glucosa',
    'Enhances fatty acid oxidation' => 'Mejora la oxidación de ácidos grasos',
    'Increases mitochondrial biogenesis' => 'Aumenta la biogénesis mitocondrial',
    'Supports metabolic health' => 'Apoya la salud metabólica',
    'Modulates insulin sensitivity' => 'Modula la sensibilidad a la insulina',
    'Reduces inflammation' => 'Reduce la inflamación',
    'Supports tissue repair' => 'Apoya la reparación tisular',
    'Promotes wound healing' => 'Promueve la curación de heridas',
    'Enhances collagen synthesis' => 'Mejora la síntesis de colágeno',
    'Supports gut health' => 'Apoya la salud intestinal',
    'Neuroprotective properties' => 'Propiedades neuroprotectoras',
    'Antioxidant activity' => 'Actividad antioxidante',
    'Immune modulation' => 'Modulación inmunológica',
    'Anti-inflammatory effects' => 'Efectos antiinflamatorios',
    'Promotes melanogenesis' => 'Promueve la melanogénesis',
    'Telomerase activation' => 'Activación de la telomerasa',
    'Cellular longevity' => 'Longevidad celular',
    'Growth hormone release' => 'Liberación de hormona de crecimiento',
    'Muscle growth support' => 'Apoyo al crecimiento muscular',
    'Fat loss promotion' => 'Promoción de la pérdida de grasa',
    'Sleep quality improvement' => 'Mejora de la calidad del sueño',
    'Cognitive enhancement' => 'Mejora cognitiva',
    'Skin rejuvenation' => 'Rejuvenecimiento de la piel',
    'Hair growth support' => 'Apoyo al crecimiento capilar',
    'Sexual health support' => 'Apoyo a la salud sexual',
    'Bone density support' => 'Apoyo a la densidad ósea',
    'Joint health' => 'Salud articular',
    'Cardiovascular protection' => 'Protección cardiovascular',
    'Liver protection' => 'Protección hepática',
    'DNA repair' => 'Reparación del ADN',
    'Energy metabolism' => 'Metabolismo energético',
    'Stress reduction' => 'Reducción del estrés',
    'Anxiety reduction' => 'Reducción de la ansiedad',
    'Memory enhancement' => 'Mejora de la memoria',
];

// Get ALL products
$args = ['post_type' => 'product', 'posts_per_page' => -1, 'post_status' => 'publish'];
$q = new WP_Query($args);
$updated = 0;

while ($q->have_posts()) {
    $q->the_post();
    $id = get_the_ID();
    $benefits_raw = get_post_meta($id, 'sp_benefits', true);
    
    if (empty($benefits_raw)) continue;
    
    $lines = array_filter(explode("\n", $benefits_raw));
    $has_english = false;
    $new_lines = [];
    
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        
        // Check if line is in English (contains common English words)
        $is_english = preg_match('/\b(the|and|for|with|in|of|on|to|is|are|has|by|that|this|from|its|can|may|or|an|at|as)\b/i', $line);
        
        if ($is_english) {
            $has_english = true;
            // Check exact match first
            if (isset($benefit_translations[$line])) {
                $new_lines[] = $benefit_translations[$line];
            } else {
                // Fuzzy match: translate common patterns
                $translated = $line;
                $translated = preg_replace('/\bStudied for\b/i', 'Estudiado para', $translated);
                $translated = preg_replace('/\bSupports research on\b/i', 'Apoya la investigación en', $translated);
                $translated = preg_replace('/\bEnhances\b/i', 'Mejora', $translated);
                $translated = preg_replace('/\bPromotes\b/i', 'Promueve', $translated);
                $translated = preg_replace('/\bActivates\b/i', 'Activa', $translated);
                $translated = preg_replace('/\bReduces\b/i', 'Reduce', $translated);
                $translated = preg_replace('/\bSupports\b/i', 'Apoya', $translated);
                $translated = preg_replace('/\bStimulates\b/i', 'Estimula', $translated);
                $translated = preg_replace('/\bModulates\b/i', 'Modula', $translated);
                $translated = preg_replace('/\bInhibits\b/i', 'Inhibe', $translated);
                $translated = preg_replace('/\bRegulates\b/i', 'Regula', $translated);
                $translated = preg_replace('/\bInfluences\b/i', 'Influye en', $translated);
                $translated = preg_replace('/\bInvestigated for\b/i', 'Investigado para', $translated);
                $translated = preg_replace('/\bResearch\b/i', 'investigación', $translated);
                $translated = preg_replace('/\bresearch\b/', 'investigación', $translated);
                $translated = preg_replace('/\bpathway\b/i', 'vía', $translated);
                $translated = preg_replace('/\bpathways\b/i', 'vías', $translated);
                $translated = preg_replace('/\bmodels\b/i', 'modelos', $translated);
                $translated = preg_replace('/\bcellular\b/i', 'celular', $translated);
                $translated = preg_replace('/\bmetabolic\b/i', 'metabólico', $translated);
                $translated = preg_replace('/\bimmune\b/i', 'inmunológico', $translated);
                $translated = preg_replace('/\bbody weight\b/i', 'peso corporal', $translated);
                $translated = preg_replace('/\bweight loss\b/i', 'pérdida de peso', $translated);
                $translated = preg_replace('/\bgrowth hormone\b/i', 'hormona de crecimiento', $translated);
                $translated = preg_replace('/\bmuscle\b/i', 'muscular', $translated);
                $translated = preg_replace('/\bskin\b/i', 'piel', $translated);
                $translated = preg_replace('/\bhair\b/i', 'cabello', $translated);
                $translated = preg_replace('/\bbone\b/i', 'óseo', $translated);
                $translated = preg_replace('/\bbrain\b/i', 'cerebral', $translated);
                $translated = preg_replace('/\bheart\b/i', 'cardíaco', $translated);
                $translated = preg_replace('/\bliver\b/i', 'hepático', $translated);
                $translated = preg_replace('/\bkidney\b/i', 'renal', $translated);
                $translated = preg_replace('/\bgut\b/i', 'intestinal', $translated);
                $translated = preg_replace('/\bjoint\b/i', 'articular', $translated);
                $translated = preg_replace('/\bblood\b/i', 'sanguíneo', $translated);
                $translated = preg_replace('/\bfat\b/i', 'grasa', $translated);
                $translated = preg_replace('/\bsleep\b/i', 'sueño', $translated);
                $translated = preg_replace('/\bcognitive\b/i', 'cognitivo', $translated);
                $translated = preg_replace('/\bfunction\b/i', 'función', $translated);
                $translated = preg_replace('/\bsignaling\b/i', 'señalización', $translated);
                $translated = preg_replace('/\bexpression\b/i', 'expresión', $translated);
                $translated = preg_replace('/\bactivity\b/i', 'actividad', $translated);
                $translated = preg_replace('/\brepair\b/i', 'reparación', $translated);
                $translated = preg_replace('/\bprotection\b/i', 'protección', $translated);
                $translated = preg_replace('/\bresponse\b/i', 'respuesta', $translated);
                $translated = preg_replace('/\bsystem\b/i', 'sistema', $translated);
                $new_lines[] = $translated;
            }
        } else {
            $new_lines[] = $line; // Already in Spanish
        }
    }
    
    if ($has_english) {
        $new_benefits = implode("\n", $new_lines);
        update_post_meta($id, 'sp_benefits', $new_benefits);
        $updated++;
        echo "OK: ID $id (" . get_the_title() . ")\n";
        echo "  BEFORE: " . substr(str_replace("\n", " | ", $benefits_raw), 0, 100) . "\n";
        echo "  AFTER:  " . substr(str_replace("\n", " | ", $new_benefits), 0, 100) . "\n\n";
    }
}
wp_reset_postdata();
echo "\nTotal updated: $updated\n";
