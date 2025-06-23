<?php
/**
 * Content Generator Class
 * Generates dynamic content for virtual pages
 * 
 * @package CorporateHousingDallas
 */

class CHT_Content_Generator {
    
    private $openai;
    private $pixabay;
    private $schema_generator;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->openai = new CHT_OpenAI_Integration();
        $this->pixabay = new CHT_Pixabay_Integration();
        $this->schema_generator = new CHT_Schema_Generator();
    }
    
    /**
     * Generate page content
     */
    public function generate_page_content($page_data) {
        $content = array();
        
        // Generate meta data
        $meta_generator = new CHT_Meta_Generator();
        $content['meta_title'] = $meta_generator->generate_title($page_data);
        $content['meta_description'] = $meta_generator->generate_description($page_data);
        
        // Generate main content
        if ($page_data['page_type'] == 'service-location') {
            $content['content'] = $this->generate_service_location_content($page_data);
        } elseif ($page_data['page_type'] == 'location') {
            $content['content'] = $this->generate_location_content($page_data);
        } elseif ($page_data['page_type'] == 'zipcode') {
            $content['content'] = $this->generate_zipcode_content($page_data);
        }
        
        // Generate FAQs
        $content['faqs'] = $this->generate_faqs($page_data);
        
        // Generate schema
        $content['schema'] = $this->schema_generator->generate_schema($page_data);
        
        // Get images
        $content['images'] = $this->get_page_images($page_data);
        
        return $content;
    }
    
    /**
     * Generate service location content
     */
    private function generate_service_location_content($page_data) {
        $service = ucwords(str_replace('-', ' ', $page_data['service']));
        $location = ucwords(str_replace('-', ' ', $page_data['location']));
        
        // Build content sections
        $content = '';
        
        // Hero section
        $content .= $this->generate_hero_section($service, $location);
        
        // Features section
        $content .= $this->generate_features_section($service, $location);
        
        // Neighborhood info
        $content .= $this->generate_neighborhood_section($location);
        
        // Pricing section
        $content .= $this->generate_pricing_section($service, $location);
        
        // CTA section
        $content .= $this->generate_cta_section($service, $location);
        
        return $content;
    }
    
    /**
     * Generate hero section
     */
    private function generate_hero_section($service, $location) {
        $content = '<div class="hero-section">';
        $content .= '<h1>' . esc_html($service . ' in ' . $location . ' Dallas') . '</h1>';
        $content .= '<p class="hero-subtitle">Experience premium ' . strtolower($service) . ' with flexible lease terms, all-inclusive pricing, and exceptional locations in ' . $location . ' Dallas.</p>';
        $content .= '</div>';
        
        return $content;
    }
    
    /**
     * Generate features section
     */
    private function generate_features_section($service, $location) {
        $features = array(
            'Fully furnished with modern furniture and appliances',
            'All utilities included - electricity, water, internet, cable',
            'Flexible lease terms from 30 days to 12+ months',
            'Pet-friendly options available',
            '24/7 customer support',
            'Professional cleaning services',
            'Prime location in ' . $location,
            'Secure parking available'
        );
        
        $content = '<div class="features-section">';
        $content .= '<h2>Why Choose Our ' . $service . ' in ' . $location . '?</h2>';
        $content .= '<div class="features-grid">';
        
        foreach ($features as $feature) {
            $content .= '<div class="feature-item">';
            $content .= '<span class="feature-icon">✓</span>';
            $content .= '<p>' . esc_html($feature) . '</p>';
            $content .= '</div>';
        }
        
        $content .= '</div>';
        $content .= '</div>';
        
        return $content;
    }
    
    /**
     * Generate neighborhood section
     */
    private function generate_neighborhood_section($location) {
        $content = '<div class="neighborhood-section">';
        $content .= '<h2>About ' . $location . ' Dallas</h2>';
        
        // Get neighborhood description from OpenAI
        $prompt = "Write a 200-word description of the {$location} neighborhood in Dallas, Texas. Include information about its character, demographics, attractions, and why it's great for corporate housing.";
        
        $description = $this->openai->generate_content($prompt, 300);
        
        if ($description) {
            $content .= '<p>' . esc_html($description) . '</p>';
        } else {
            // Fallback content
            $content .= '<p>' . $location . ' is one of Dallas\'s most sought-after neighborhoods, offering a perfect blend of urban convenience and residential comfort. Known for its vibrant atmosphere, excellent dining options, and proximity to major business districts, ' . $location . ' is ideal for business travelers and relocating professionals.</p>';
        }
        
        $content .= '</div>';
        
        return $content;
    }
    
    /**
     * Generate pricing section
     */
    private function generate_pricing_section($service, $location) {
        $content = '<div class="pricing-section">';
        $content .= '<h2>' . $service . ' Pricing in ' . $location . '</h2>';
        $content .= '<p>Our ' . strtolower($service) . ' in ' . $location . ' Dallas offers competitive, all-inclusive pricing:</p>';
        
        $content .= '<div class="pricing-grid">';
        $content .= '<div class="pricing-item">';
        $content .= '<h3>Studio</h3>';
        $content .= '<p class="price">Starting at $2,500/month</p>';
        $content .= '</div>';
        
        $content .= '<div class="pricing-item">';
        $content .= '<h3>1 Bedroom</h3>';
        $content .= '<p class="price">Starting at $3,200/month</p>';
        $content .= '</div>';
        
        $content .= '<div class="pricing-item">';
        $content .= '<h3>2 Bedroom</h3>';
        $content .= '<p class="price">Starting at $4,500/month</p>';
        $content .= '</div>';
        $content .= '</div>';
        
        $content .= '<p class="pricing-note">*All prices include furniture, utilities, internet, and housekeeping services.</p>';
        $content .= '</div>';
        
        return $content;
    }
    
    /**
     * Generate CTA section
     */
    private function generate_cta_section($service, $location) {
        $content = '<div class="cta-section">';
        $content .= '<h2>Ready to Book Your ' . $service . ' in ' . $location . '?</h2>';
        $content .= '<p>Contact us today for availability and personalized recommendations.</p>';
        $content .= '<a href="#lead-form" class="btn btn-primary">Get Your Quote Now</a>';
        $content .= '</div>';
        
        return $content;
    }
    
    /**
     * Generate location content
     */
    private function generate_location_content($page_data) {
        $location = ucwords(str_replace('-', ' ', $page_data['location']));
        return $this->generate_service_location_content(array(
            'service' => 'Furnished Apartments',
            'location' => $page_data['location'],
            'page_type' => 'service-location'
        ));
    }
    
    /**
     * Generate ZIP code content
     */
    private function generate_zipcode_content($page_data) {
        $zipcode = $page_data['zipcode'];
        
        $content = '<div class="zipcode-content">';
        $content .= '<h1>Corporate Housing in Dallas ' . $zipcode . '</h1>';
        $content .= '<p>Find premium furnished apartments and corporate housing solutions in the ' . $zipcode . ' area of Dallas.</p>';
        
        // Add neighborhood information based on ZIP
        $neighborhoods = $this->get_neighborhoods_by_zip($zipcode);
        if (!empty($neighborhoods)) {
            $content .= '<h2>Neighborhoods in ' . $zipcode . '</h2>';
            $content .= '<p>The ' . $zipcode . ' ZIP code includes these popular Dallas neighborhoods: ' . implode(', ', $neighborhoods) . '.</p>';
        }
        
        $content .= $this->generate_features_section('Corporate Housing', $zipcode);
        $content .= $this->generate_pricing_section('Corporate Housing', $zipcode);
        $content .= $this->generate_cta_section('Corporate Housing', $zipcode);
        
        $content .= '</div>';
        
        return $content;
    }
    
    /**
     * Get neighborhoods by ZIP code
     */
    private function get_neighborhoods_by_zip($zip) {
        $zip_neighborhoods = array(
            '75201' => array('Downtown', 'Main Street District'),
            '75204' => array('Uptown', 'State Thomas'),
            '75219' => array('Oak Lawn', 'Turtle Creek'),
            '75206' => array('M Streets', 'Lower Greenville'),
            '75214' => array('Lakewood', 'East Dallas'),
            '75230' => array('North Dallas', 'Preston Hollow')
        );
        
        return isset($zip_neighborhoods[$zip]) ? $zip_neighborhoods[$zip] : array();
    }
    
    /**
     * Generate FAQs
     */
    private function generate_faqs($page_data) {
        $location = isset($page_data['location']) ? ucwords(str_replace('-', ' ', $page_data['location'])) : '';
        $service = isset($page_data['service']) ? ucwords(str_replace('-', ' ', $page_data['service'])) : 'Corporate Housing';
        
        // Get FAQs from OpenAI
        $faqs = $this->openai->generate_faqs($service, $location, 8);
        
        if (empty($faqs)) {
            // Fallback FAQs
            $faqs = array(
                array(
                    'question' => 'What is included in the ' . $service . ' rental price?',
                    'answer' => 'Our ' . strtolower($service) . ' includes all furniture, kitchen appliances, cookware, linens, towels, utilities (electricity, water, gas), high-speed internet, cable TV, and weekly housekeeping services. Everything you need for a comfortable stay is provided.'
                ),
                array(
                    'question' => 'What is the minimum lease term for ' . $service . ' in ' . ($location ? $location : 'Dallas') . '?',
                    'answer' => 'We offer flexible lease terms starting from just 30 days. Whether you need accommodation for a month or a year, we can customize the lease duration to meet your specific needs.'
                ),
                array(
                    'question' => 'Are pets allowed in your ' . strtolower($service) . '?',
                    'answer' => 'Yes, many of our properties are pet-friendly. We understand that pets are part of the family. Pet policies and fees vary by property, so please inquire about specific pet-friendly options when booking.'
                ),
                array(
                    'question' => 'Is parking available?',
                    'answer' => 'Yes, most of our properties include parking options. This may be covered parking, garage spaces, or designated parking areas. Parking availability and any associated fees will be clearly communicated for each property.'
                )
            );
        }
        
        return $faqs;
    }
    
    /**
     * Get page images
     */
    private function get_page_images($page_data) {
        $location = isset($page_data['location']) ? $page_data['location'] : 'dallas';
        return $this->pixabay->get_location_images($location, 3);
    }
}