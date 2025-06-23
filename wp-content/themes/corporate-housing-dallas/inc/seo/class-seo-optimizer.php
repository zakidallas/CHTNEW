<?php
/**
 * SEO Optimizer Class
 * Handles SEO optimizations
 * 
 * @package CorporateHousingDallas
 */

class CHT_SEO_Optimizer {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('wp_head', array($this, 'add_seo_meta_tags'), 1);
        add_filter('wp_title', array($this, 'optimize_title'), 10, 2);
        add_filter('the_content', array($this, 'add_internal_links'));
        add_action('wp', array($this, 'set_canonical_url'));
        add_filter('language_attributes', array($this, 'add_og_prefix'));
    }
    
    /**
     * Add SEO meta tags
     */
    public function add_seo_meta_tags() {
        global $cht_page_data;
        
        // Robots meta
        echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
        
        // Verification tags (add your own)
        // echo '<meta name="google-site-verification" content="YOUR_VERIFICATION_CODE">' . "\n";
        
        // Additional meta tags
        echo '<meta name="author" content="Corporate Housing Travelers">' . "\n";
        echo '<meta name="copyright" content="Corporate Housing Travelers">' . "\n";
        
        // Geo tags for local SEO
        echo '<meta name="geo.region" content="US-TX">' . "\n";
        echo '<meta name="geo.placename" content="Dallas">' . "\n";
        echo '<meta name="geo.position" content="32.7767;-96.7970">' . "\n";
        echo '<meta name="ICBM" content="32.7767, -96.7970">' . "\n";
    }
    
    /**
     * Optimize title tag
     */
    public function optimize_title($title, $sep) {
        global $cht_page_data;
        
        if (!empty($cht_page_data['meta_title'])) {
            return $cht_page_data['meta_title'];
        }
        
        return $title;
    }
    
    /**
     * Add internal links to content
     */
    public function add_internal_links($content) {
        if (!is_singular() && !is_page()) {
            return $content;
        }
        
        // Define internal link opportunities
        $links = array(
            'corporate housing dallas' => home_url('/corporate-housing-dallas/'),
            'furnished apartments dallas' => home_url('/furnished-apartments-dallas/'),
            'uptown dallas' => home_url('/furnished-apartments-dallas-uptown/'),
            'downtown dallas' => home_url('/furnished-apartments-dallas-downtown/'),
            'medical district' => home_url('/furnished-apartments-dallas-medical-district/'),
            'short-term rentals' => home_url('/short-term-rentals-dallas/'),
            'pet-friendly' => home_url('/pet-friendly-corporate-housing-dallas/')
        );
        
        // Add links (maximum 3 per page to avoid over-optimization)
        $links_added = 0;
        foreach ($links as $keyword => $url) {
            if ($links_added >= 3) break;
            
            if (stripos($content, $keyword) !== false && stripos($content, $url) === false) {
                $pattern = '/\b(' . preg_quote($keyword, '/') . ')\b/i';
                $replacement = '<a href="' . $url . '">$1</a>';
                $content = preg_replace($pattern, $replacement, $content, 1);
                $links_added++;
            }
        }
        
        return $content;
    }
    
    /**
     * Set canonical URL
     */
    public function set_canonical_url() {
        if (is_singular() || is_page()) {
            echo '<link rel="canonical" href="' . get_permalink() . '">' . "\n";
        }
    }
    
    /**
     * Add Open Graph prefix
     */
    public function add_og_prefix($output) {
        return $output . ' prefix="og: http://ogp.me/ns#"';
    }
}