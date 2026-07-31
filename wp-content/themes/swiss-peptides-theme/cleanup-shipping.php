<?php
if(!isset($_GET['key'])||$_GET['key']!=='sp2026secure')die('Unauthorized');
require_once(dirname(__FILE__).'/../../../wp-load.php');
header('Content-Type: text/plain; charset=utf-8');

// 1. Clean up product descriptions - remove leading "> markers
$products = get_posts(['post_type'=>'product','posts_per_page'=>-1,'post_status'=>'publish']);
$cleaned = 0;
foreach($products as $post){
    $product = wc_get_product($post->ID);
    if(!$product) continue;
    
    $desc = $product->get_description();
    $short = $product->get_short_description();
    $changed = false;
    
    // Clean leading garbage
    if(strpos($desc, '">') === 0 || strpos($desc, '"&gt;') === 0) {
        $desc = preg_replace('/^[""]?\s*(&gt;|>)\s*/', '', $desc);
        $product->set_description($desc);
        $changed = true;
    }
    if(strpos($short, '">') === 0 || strpos($short, '"&gt;') === 0) {
        $short = preg_replace('/^[""]?\s*(&gt;|>)\s*/', '', $short);
        $product->set_short_description($short);
        $changed = true;
    }
    
    if($changed) {
        $product->save();
        $cleaned++;
        echo "CLEANED: {$post->post_name}\n";
    }
}
echo "\nCleaned $cleaned product descriptions\n";

// 2. Set up FREE shipping for all orders
// Delete any existing shipping zones and create a simple free shipping zone
$zones = WC_Shipping_Zones::get_zones();
echo "\nExisting shipping zones: " . count($zones) . "\n";

// Add free shipping to zone 0 (default / rest of world)
$zone_0 = new WC_Shipping_Zone(0);
$methods = $zone_0->get_shipping_methods();
echo "Zone 0 methods: " . count($methods) . "\n";

// Remove flat rate if exists, add free shipping
foreach($methods as $method) {
    if($method->id === 'flat_rate') {
        $zone_0->delete_shipping_method($method->instance_id);
        echo "Removed flat_rate from zone 0\n";
    }
}

// Check if free_shipping already exists
$has_free = false;
foreach($methods as $method) {
    if($method->id === 'free_shipping') $has_free = true;
}
if(!$has_free) {
    $zone_0->add_shipping_method('free_shipping');
    echo "Added free_shipping to zone 0\n";
}

// Also check other zones
foreach($zones as $zone_data) {
    $zone = new WC_Shipping_Zone($zone_data['zone_id']);
    $methods = $zone->get_shipping_methods();
    foreach($methods as $method) {
        if($method->id === 'flat_rate') {
            $zone->delete_shipping_method($method->instance_id);
            echo "Removed flat_rate from zone: {$zone_data['zone_name']}\n";
        }
    }
    // Add free shipping if not present
    $has_free = false;
    $methods = $zone->get_shipping_methods();
    foreach($methods as $method) {
        if($method->id === 'free_shipping') $has_free = true;
    }
    if(!$has_free) {
        $zone->add_shipping_method('free_shipping');
        echo "Added free_shipping to zone: {$zone_data['zone_name']}\n";
    }
}

echo "\nDONE - Free shipping configured for all zones\n";
