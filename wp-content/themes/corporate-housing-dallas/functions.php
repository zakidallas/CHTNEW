<?php
/**
 * Corporate Housing Dallas Theme Functions
 * 
 * @package CorporateHousingDallas
 */

// Security: Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('CHT_THEME_VERSION', '1.0.0');
define('CHT_THEME_DIR', get_template_directory());
define('CHT_THEME_URI', get_template_directory_uri());

// Load environment variables
if (file_exists(ABSPATH . '../.env')) {
    $env = parse_ini_file(ABSPATH . '../.env');
    foreach ($env as $key => $value) {
        if (!defined($key)) {
            define($key, $value);
        }
    }
}

// Include required files
require_once CHT_THEME_DIR . '/inc/core/class-theme-setup.php';
require_once CHT_THEME_DIR . '/inc/core/class-virtual-pages.php';
require_once CHT_THEME_DIR . '/inc/core/class-rewrite-rules.php';
require_once CHT_THEME_DIR . '/inc/core/class-homepage-builder.php';
require_once CHT_THEME_DIR . '/inc/api/class-openai-integration.php';
require_once CHT_THEME_DIR . '/inc/api/class-pixabay-integration.php';
require_once CHT_THEME_DIR . '/inc/api/class-google-maps.php';
require_once CHT_THEME_DIR . '/inc/generators/class-content-generator.php';
require_once CHT_THEME_DIR . '/inc/generators/class-meta-generator.php';
require_once CHT_THEME_DIR . '/inc/generators/class-schema-generator.php';
require_once CHT_THEME_DIR . '/inc/seo/class-seo-optimizer.php';
require_once CHT_THEME_DIR . '/inc/seo/class-schema-markup.php';
require_once CHT_THEME_DIR . '/inc/optimization/class-image-optimizer.php';
require_once CHT_THEME_DIR . '/inc/forms/class-lead-capture.php';
require_once CHT_THEME_DIR . '/inc/forms/class-form-handler.php';

// Initialize theme
new CHT_Theme_Setup();
new CHT_Virtual_Pages();
new CHT_Rewrite_Rules();
new CHT_Homepage_Builder();
new CHT_Lead_Capture();
new CHT_SEO_Optimizer();

// Theme support
add_action('after_setup_theme', function() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'cht-dallas'),
        'footer' => __('Footer Menu', 'cht-dallas'),
    ));
    
    // Add image sizes
    add_image_size('property-hero', 1920, 1080, true);
    add_image_size('property-featured', 1200, 800, true);
    add_image_size('property-thumbnail', 400, 300, true);
});

// Enqueue scripts and styles
add_action('wp_enqueue_scripts', function() {
    // Styles
    wp_enqueue_style('cht-main', CHT_THEME_URI . '/style.css', array(), CHT_THEME_VERSION);
    wp_enqueue_style('cht-modern', CHT_THEME_URI . '/assets/css/style.css', array(), CHT_THEME_VERSION);
    wp_enqueue_style('cht-header', CHT_THEME_URI . '/assets/css/header.css', array(), CHT_THEME_VERSION);
    wp_enqueue_style('cht-footer', CHT_THEME_URI . '/assets/css/footer.css', array(), CHT_THEME_VERSION);
    
    // Scripts
    wp_enqueue_script('cht-main', CHT_THEME_URI . '/assets/js/main.js', array('jquery'), CHT_THEME_VERSION, true);
    wp_enqueue_script('cht-lead-form', CHT_THEME_URI . '/assets/js/lead-form.js', array('jquery'), CHT_THEME_VERSION, true);
    
    // Localize script for AJAX
    wp_localize_script('cht-lead-form', 'cht_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('cht_ajax_nonce')
    ));
});

// Custom functions for SEO
function cht_get_meta_title($location = '', $service = '') {
    $templates = array(
        'neighborhood' => '%s in %s Dallas | Up to 50% Off Hotels | Corporate Housing Travelers',
        'zipcode' => '%s %s Dallas TX | Corporate & Short-Term Rentals',
        'service' => '%s Dallas | Premium Furnished Apartments & Housing',
        'default' => 'Corporate Housing Dallas | Furnished Apartments & Short-Term Rentals'
    );
    
    if ($location && $service) {
        return sprintf($templates['neighborhood'], ucwords($service), ucwords($location));
    } elseif ($service) {
        return sprintf($templates['service'], ucwords($service));
    }
    
    return $templates['default'];
}

function cht_get_meta_description($location = '', $service = '') {
    $templates = array(
        'neighborhood' => 'Premium %s in %s Dallas. Fully furnished, flexible terms, all-inclusive pricing. Pet-friendly options available. Book today!',
        'zipcode' => 'Find %s in Dallas %s. Perfect for business travelers, relocations, and extended stays. All utilities included. 24/7 support.',
        'service' => 'Looking for %s in Dallas? We offer fully furnished apartments with flexible lease terms, premium amenities, and locations throughout DFW.',
        'default' => 'Corporate housing and furnished apartments in Dallas. Flexible lease terms, all-inclusive pricing, premium locations. Perfect for business travelers and relocations.'
    );
    
    if ($location && $service) {
        return sprintf($templates['neighborhood'], $service, ucwords($location));
    } elseif ($service) {
        return sprintf($templates['service'], $service);
    }
    
    return $templates['default'];
}

// Helper function to get Dallas neighborhoods
function cht_get_dallas_neighborhoods() {
    return array(
        'uptown' => 'Uptown',
        'downtown' => 'Downtown',
        'medical-district' => 'Medical District',
        'deep-ellum' => 'Deep Ellum',
        'bishop-arts' => 'Bishop Arts',
        'oak-lawn' => 'Oak Lawn',
        'knox-henderson' => 'Knox-Henderson',
        'lower-greenville' => 'Lower Greenville',
        'victory-park' => 'Victory Park',
        'design-district' => 'Design District',
        'trinity-groves' => 'Trinity Groves',
        'lakewood' => 'Lakewood',
        'm-streets' => 'M Streets',
        'preston-hollow' => 'Preston Hollow',
        'highland-park' => 'Highland Park',
        'university-park' => 'University Park',
        'oak-cliff' => 'Oak Cliff',
        'east-dallas' => 'East Dallas',
        'west-end' => 'West End',
        'arts-district' => 'Arts District',
        'cedars' => 'Cedars',
        'exposition-park' => 'Exposition Park',
        'kessler-park' => 'Kessler Park',
        'lake-highlands' => 'Lake Highlands',
        'far-north-dallas' => 'Far North Dallas',
        'pleasant-grove' => 'Pleasant Grove',
        'south-dallas' => 'South Dallas',
        'vickery-meadow' => 'Vickery Meadow',
        'casa-linda' => 'Casa Linda',
        'white-rock' => 'White Rock'
    );
}

// Helper function to get Dallas ZIP codes
function cht_get_dallas_zipcodes() {
    $zipcodes = array();
    for ($i = 75201; $i <= 75250; $i++) {
        $zipcodes[] = $i;
    }
    return $zipcodes;
}

// Helper function to get services
function cht_get_services() {
    return array(
        'corporate-housing' => 'Corporate Housing',
        'furnished-apartments' => 'Furnished Apartments',
        'short-term-rentals' => 'Short-Term Rentals',
        'extended-stay-suites' => 'Extended-Stay Suites',
        'luxury-furnished-housing' => 'Luxury Furnished Housing',
        'monthly-furnished-rentals' => 'Monthly Furnished Rentals',
        'pet-friendly-corporate-rentals' => 'Pet-Friendly Corporate Rentals',
        'utilities-included-apartments' => 'Utilities-Included Apartments',
        'temporary-housing-relocation' => 'Temporary Housing for Relocation',
        'executive-rentals' => 'Executive Rentals',
        'medical-stay-housing' => 'Medical Stay Housing',
        'insurance-claim-housing' => 'Insurance Claim Housing',
        'long-term-furnished-rentals' => 'Long-Term Furnished Rentals',
        'remote-work-friendly-housing' => 'Remote Work-Friendly Housing',
        'serviced-apartments' => 'Serviced Apartments'
    );
}

// Security headers
add_action('send_headers', function() {
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: no-referrer-when-downgrade');
    
    // Cache headers for static content
    if (is_singular() || is_page()) {
        header('Cache-Control: public, max-age=3600');
    }
});