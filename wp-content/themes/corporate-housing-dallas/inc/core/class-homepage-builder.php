<?php
/**
 * Homepage Builder Class
 * Generates dynamic homepage content
 *
 * @package CorporateHousingDallas
 */

class CHT_Homepage_Builder {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_homepage_assets'));
    }
    
    /**
     * Enqueue homepage specific assets
     */
    public function enqueue_homepage_assets() {
        if (is_front_page()) {
            wp_enqueue_style('cht-homepage', get_template_directory_uri() . '/assets/css/homepage.css', array(), '1.0.0');
            wp_enqueue_script('cht-homepage', get_template_directory_uri() . '/assets/js/homepage.js', array('jquery'), '1.0.0', true);
        }
    }
    
    /**
     * Get featured properties
     */
    public static function get_featured_properties() {
        return array(
            array(
                'id' => 1,
                'title' => 'Luxury Apartment in Uptown Dallas',
                'location' => 'Uptown',
                'price' => '$3,500/mo',
                'beds' => '2',
                'baths' => '2',
                'sqft' => '1,200',
                'image' => 'https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?w=800',
                'features' => array('Pool', 'Gym', 'Parking'),
                'badge' => 'Premium'
            ),
            array(
                'id' => 2,
                'title' => 'Modern Studio Downtown',
                'location' => 'Downtown',
                'price' => '$2,500/mo',
                'beds' => 'Studio',
                'baths' => '1',
                'sqft' => '650',
                'image' => 'https://images.pexels.com/photos/1457842/pexels-photo-1457842.jpeg?w=800',
                'features' => array('Doorman', 'Rooftop'),
                'badge' => 'Best Value'
            ),
            array(
                'id' => 3,
                'title' => 'Executive Suite Medical District',
                'location' => 'Medical District',
                'price' => '$4,200/mo',
                'beds' => '3',
                'baths' => '2',
                'sqft' => '1,800',
                'image' => 'https://images.pexels.com/photos/1643383/pexels-photo-1643383.jpeg?w=800',
                'features' => array('Furnished', 'Bills Included'),
                'badge' => 'Executive'
            ),
            array(
                'id' => 4,
                'title' => 'Pet-Friendly in Deep Ellum',
                'location' => 'Deep Ellum',
                'price' => '$2,800/mo',
                'beds' => '1',
                'baths' => '1',
                'sqft' => '850',
                'image' => 'https://images.pexels.com/photos/276724/pexels-photo-276724.jpeg?w=800',
                'features' => array('Pet Park', 'Art District'),
                'badge' => 'Pet Friendly'
            )
        );
    }
    
    /**
     * Get neighborhood data
     */
    public static function get_neighborhoods() {
        return array(
            array(
                'name' => 'Uptown',
                'description' => 'Trendy area with restaurants and nightlife',
                'properties' => 156,
                'avg_price' => '$3,200',
                'image' => 'https://images.pexels.com/photos/302769/pexels-photo-302769.jpeg?w=400'
            ),
            array(
                'name' => 'Downtown',
                'description' => 'Business district with modern high-rises',
                'properties' => 89,
                'avg_price' => '$2,800',
                'image' => 'https://images.pexels.com/photos/313782/pexels-photo-313782.jpeg?w=400'
            ),
            array(
                'name' => 'Medical District',
                'description' => 'Near major hospitals and medical facilities',
                'properties' => 67,
                'avg_price' => '$2,600',
                'image' => 'https://images.pexels.com/photos/263402/pexels-photo-263402.jpeg?w=400'
            ),
            array(
                'name' => 'Deep Ellum',
                'description' => 'Arts and entertainment district',
                'properties' => 45,
                'avg_price' => '$2,400',
                'image' => 'https://images.pexels.com/photos/1134176/pexels-photo-1134176.jpeg?w=400'
            ),
            array(
                'name' => 'Bishop Arts',
                'description' => 'Historic neighborhood with local shops',
                'properties' => 38,
                'avg_price' => '$2,200',
                'image' => 'https://images.pexels.com/photos/1370704/pexels-photo-1370704.jpeg?w=400'
            ),
            array(
                'name' => 'Oak Lawn',
                'description' => 'Upscale residential area',
                'properties' => 72,
                'avg_price' => '$3,000',
                'image' => 'https://images.pexels.com/photos/280222/pexels-photo-280222.jpeg?w=400'
            )
        );
    }
    
    /**
     * Get testimonials
     */
    public static function get_testimonials() {
        return array(
            array(
                'name' => 'Sarah Johnson',
                'role' => 'Tech Executive',
                'company' => 'Microsoft',
                'content' => 'Corporate Housing Travelers made my relocation to Dallas seamless. The apartment in Uptown was perfectly furnished and the team was incredibly responsive.',
                'rating' => 5,
                'avatar' => 'https://i.pravatar.cc/100?img=1'
            ),
            array(
                'name' => 'Dr. Michael Chen',
                'role' => 'Visiting Physician',
                'company' => 'UT Southwestern',
                'content' => 'As a traveling medical professional, I needed housing near the Medical District. CHT provided exactly what I needed with all utilities included.',
                'rating' => 5,
                'avatar' => 'https://i.pravatar.cc/100?img=3'
            ),
            array(
                'name' => 'Jennifer Martinez',
                'role' => 'HR Director',
                'company' => 'American Airlines',
                'content' => 'We\'ve used CHT for all our corporate relocations. Their properties are top-notch and the booking process is incredibly smooth.',
                'rating' => 5,
                'avatar' => 'https://i.pravatar.cc/100?img=5'
            )
        );
    }
    
    /**
     * Get stats
     */
    public static function get_stats() {
        return array(
            array(
                'number' => '500+',
                'label' => 'Furnished Properties',
                'icon' => '🏠'
            ),
            array(
                'number' => '4.8',
                'label' => 'Average Rating',
                'icon' => '⭐'
            ),
            array(
                'number' => '24/7',
                'label' => 'Customer Support',
                'icon' => '💬'
            ),
            array(
                'number' => '30+',
                'label' => 'Dallas Neighborhoods',
                'icon' => '📍'
            )
        );
    }
}