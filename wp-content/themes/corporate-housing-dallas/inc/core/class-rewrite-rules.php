<?php
/**
 * Rewrite Rules Class
 * Handles URL structure for SEO-friendly URLs
 * 
 * @package CorporateHousingDallas
 */

class CHT_Rewrite_Rules {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'add_rewrite_rules'));
        add_filter('rewrite_rules_array', array($this, 'filter_rewrite_rules'));
        add_action('after_switch_theme', array($this, 'flush_rules'));
        add_filter('robots_txt', array($this, 'customize_robots_txt'), 10, 2);
        add_action('init', array($this, 'add_sitemap_rewrite_rules'));
    }
    
    /**
     * Add custom rewrite rules
     */
    public function add_rewrite_rules() {
        // Main service pages
        add_rewrite_rule(
            '^furnished-apartments-dallas/?$',
            'index.php?pagename=furnished-apartments-dallas',
            'top'
        );
        
        add_rewrite_rule(
            '^corporate-housing-dallas/?$',
            'index.php?pagename=corporate-housing-dallas',
            'top'
        );
        
        // Service + Location pages (e.g., furnished-apartments-uptown-dallas)
        add_rewrite_rule(
            '^(furnished-apartments|corporate-housing|short-term-rentals|extended-stay|luxury-furnished|monthly-furnished|pet-friendly|executive-housing|medical-housing|serviced-apartments)-(uptown|downtown|medical-district|deep-ellum|bishop-arts|oak-lawn|knox-henderson|lower-greenville|victory-park|design-district|trinity-groves|lakewood|m-streets|preston-hollow|highland-park|university-park|oak-cliff|east-dallas|west-end|arts-district|cedars|exposition-park|kessler-park|lake-highlands|far-north-dallas|pleasant-grove|south-dallas|vickery-meadow|casa-linda|white-rock)-dallas/?$',
            'index.php?cht_service=$matches[1]&cht_location=$matches[2]',
            'top'
        );
        
        // Location only pages (e.g., furnished-apartments-dallas-downtown)
        add_rewrite_rule(
            '^furnished-apartments-dallas-(uptown|downtown|medical-district|deep-ellum|bishop-arts|oak-lawn|knox-henderson|lower-greenville|victory-park|design-district|trinity-groves|lakewood|m-streets|preston-hollow|highland-park|university-park|oak-cliff|east-dallas|west-end|arts-district|cedars|exposition-park|kessler-park|lake-highlands|far-north-dallas|pleasant-grove|south-dallas|vickery-meadow|casa-linda|white-rock)/?$',
            'index.php?cht_location=$matches[1]&cht_page_type=location',
            'top'
        );
        
        // ZIP code pages (e.g., corporate-housing-dallas-75201)
        add_rewrite_rule(
            '^corporate-housing-dallas-(7520[1-9]|752[1-4][0-9]|75250)/?$',
            'index.php?cht_zipcode=$matches[1]&cht_page_type=zipcode',
            'top'
        );
        
        add_rewrite_rule(
            '^furnished-apartments-dallas-(7520[1-9]|752[1-4][0-9]|75250)/?$',
            'index.php?cht_zipcode=$matches[1]&cht_page_type=zipcode&cht_service=furnished-apartments',
            'top'
        );
        
        // Long-tail service pages
        add_rewrite_rule(
            '^(cheap|affordable|luxury|pet-friendly|short-term|long-term|monthly|weekly)-(furnished-apartments|corporate-housing)-dallas/?$',
            'index.php?cht_modifier=$matches[1]&cht_service=$matches[2]&cht_page_type=service-modifier',
            'top'
        );
        
        // Special pages
        add_rewrite_rule(
            '^furnished-apartments-near-([a-z0-9-]+)-dallas/?$',
            'index.php?cht_near=$matches[1]&cht_page_type=near-location',
            'top'
        );
        
        // Sitemap
        add_rewrite_rule(
            '^sitemap\.xml$',
            'index.php?cht_sitemap=1',
            'top'
        );
    }
    
    /**
     * Filter rewrite rules
     */
    public function filter_rewrite_rules($rules) {
        // Ensure our custom rules take priority
        $new_rules = array();
        
        foreach ($rules as $rule => $rewrite) {
            if (strpos($rule, 'furnished-apartments') !== false || 
                strpos($rule, 'corporate-housing') !== false) {
                unset($rules[$rule]);
                $new_rules[$rule] = $rewrite;
            }
        }
        
        return array_merge($new_rules, $rules);
    }
    
    /**
     * Flush rewrite rules
     */
    public function flush_rules() {
        $this->add_rewrite_rules();
        flush_rewrite_rules();
    }
    
    /**
     * Add sitemap rewrite rules
     */
    public function add_sitemap_rewrite_rules() {
        add_filter('query_vars', function($vars) {
            $vars[] = 'cht_sitemap';
            $vars[] = 'cht_modifier';
            $vars[] = 'cht_near';
            return $vars;
        });
        
        add_action('template_redirect', array($this, 'handle_sitemap'));
    }
    
    /**
     * Handle sitemap generation
     */
    public function handle_sitemap() {
        if (!get_query_var('cht_sitemap')) {
            return;
        }
        
        header('Content-Type: application/xml; charset=utf-8');
        
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Homepage
        $this->sitemap_url(home_url('/'), '1.0', 'daily');
        
        // Main service pages
        $this->sitemap_url(home_url('/furnished-apartments-dallas/'), '0.9', 'weekly');
        $this->sitemap_url(home_url('/corporate-housing-dallas/'), '0.9', 'weekly');
        
        // Neighborhood pages
        $neighborhoods = cht_get_dallas_neighborhoods();
        foreach ($neighborhoods as $slug => $name) {
            $this->sitemap_url(home_url('/furnished-apartments-dallas-' . $slug . '/'), '0.8', 'weekly');
            $this->sitemap_url(home_url('/corporate-housing-' . $slug . '-dallas/'), '0.8', 'weekly');
        }
        
        // ZIP code pages
        $zipcodes = cht_get_dallas_zipcodes();
        foreach ($zipcodes as $zip) {
            $this->sitemap_url(home_url('/corporate-housing-dallas-' . $zip . '/'), '0.7', 'monthly');
            $this->sitemap_url(home_url('/furnished-apartments-dallas-' . $zip . '/'), '0.7', 'monthly');
        }
        
        // Service combination pages
        $services = array('furnished-apartments', 'corporate-housing', 'short-term-rentals', 'extended-stay');
        $modifiers = array('cheap', 'luxury', 'pet-friendly', 'monthly');
        
        foreach ($modifiers as $modifier) {
            foreach ($services as $service) {
                $this->sitemap_url(home_url('/' . $modifier . '-' . $service . '-dallas/'), '0.6', 'monthly');
            }
        }
        
        echo '</urlset>';
        exit;
    }
    
    /**
     * Output sitemap URL
     */
    private function sitemap_url($loc, $priority = '0.5', $changefreq = 'weekly') {
        echo '<url>';
        echo '<loc>' . esc_url($loc) . '</loc>';
        echo '<lastmod>' . date('Y-m-d') . '</lastmod>';
        echo '<changefreq>' . $changefreq . '</changefreq>';
        echo '<priority>' . $priority . '</priority>';
        echo '</url>';
    }
    
    /**
     * Customize robots.txt
     */
    public function customize_robots_txt($output, $public) {
        if (!$public) {
            return $output;
        }
        
        $output = "User-agent: *\n";
        $output .= "Allow: /\n";
        $output .= "Disallow: /wp-admin/\n";
        $output .= "Disallow: /wp-includes/\n";
        $output .= "Disallow: /?s=\n";
        $output .= "Disallow: /search/\n";
        $output .= "Disallow: /*?*\n";
        $output .= "Allow: /wp-admin/admin-ajax.php\n";
        $output .= "\n";
        $output .= "# Sitemap\n";
        $output .= "Sitemap: " . home_url('/sitemap.xml') . "\n";
        $output .= "\n";
        $output .= "# Crawl-delay\n";
        $output .= "Crawl-delay: 1\n";
        
        return $output;
    }
}