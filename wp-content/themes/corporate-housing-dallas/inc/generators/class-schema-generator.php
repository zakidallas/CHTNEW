<?php
/**
 * Schema Generator Class
 * Generates structured data markup
 * 
 * @package CorporateHousingDallas
 */

class CHT_Schema_Generator {
    
    /**
     * Generate schema markup
     */
    public function generate_schema($page_data) {
        $schemas = array();
        
        // Add organization schema
        $schemas[] = $this->generate_organization_schema();
        
        // Add local business schema
        $schemas[] = $this->generate_local_business_schema($page_data);
        
        // Add FAQ schema if FAQs exist
        if (!empty($page_data['faqs'])) {
            $schemas[] = $this->generate_faq_schema($page_data['faqs']);
        }
        
        // Add breadcrumb schema
        $schemas[] = $this->generate_breadcrumb_schema($page_data);
        
        return $schemas;
    }
    
    /**
     * Generate organization schema
     */
    private function generate_organization_schema() {
        return array(
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Corporate Housing Travelers',
            'url' => home_url(),
            'logo' => CHT_THEME_URI . '/assets/images/logo.png',
            'contactPoint' => array(
                '@type' => 'ContactPoint',
                'telephone' => '+1-123-456-7890',
                'contactType' => 'customer service',
                'availableLanguage' => array('English', 'Spanish')
            ),
            'sameAs' => array(
                'https://www.facebook.com/corporatehousingtravelers',
                'https://www.linkedin.com/company/corporate-housing-travelers'
            )
        );
    }
    
    /**
     * Generate local business schema
     */
    private function generate_local_business_schema($page_data) {
        $location = isset($page_data['location']) ? $this->format_location($page_data['location']) : 'Dallas';
        $service = isset($page_data['service']) ? $this->format_service($page_data['service']) : 'Corporate Housing';
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'ApartmentComplex',
            'name' => $service . ' in ' . $location . ' Dallas',
            'description' => 'Premium ' . strtolower($service) . ' offering fully furnished apartments with flexible lease terms in ' . $location . ' Dallas.',
            'address' => array(
                '@type' => 'PostalAddress',
                'addressLocality' => $location . ', Dallas',
                'addressRegion' => 'TX',
                'addressCountry' => 'US'
            ),
            'telephone' => '+1-123-456-7890',
            'url' => get_permalink(),
            'priceRange' => '$$$',
            'amenityFeature' => array(
                array('@type' => 'LocationFeatureSpecification', 'name' => 'Fully Furnished'),
                array('@type' => 'LocationFeatureSpecification', 'name' => 'High-Speed Internet'),
                array('@type' => 'LocationFeatureSpecification', 'name' => 'Utilities Included'),
                array('@type' => 'LocationFeatureSpecification', 'name' => 'Pet Friendly'),
                array('@type' => 'LocationFeatureSpecification', 'name' => 'Parking Available')
            ),
            'aggregateRating' => array(
                '@type' => 'AggregateRating',
                'ratingValue' => '4.8',
                'reviewCount' => '127',
                'bestRating' => '5'
            )
        );
        
        // Add geo coordinates if available
        if (isset($page_data['zipcode'])) {
            $schema['address']['postalCode'] = $page_data['zipcode'];
        }
        
        return $schema;
    }
    
    /**
     * Generate FAQ schema
     */
    private function generate_faq_schema($faqs) {
        $faq_items = array();
        
        foreach ($faqs as $faq) {
            $faq_items[] = array(
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                )
            );
        }
        
        return array(
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faq_items
        );
    }
    
    /**
     * Generate breadcrumb schema
     */
    private function generate_breadcrumb_schema($page_data) {
        $items = array(
            array(
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => home_url()
            )
        );
        
        if ($page_data['page_type'] == 'service-location') {
            $items[] = array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $this->format_service($page_data['service']),
                'item' => home_url('/' . $page_data['service'] . '-dallas/')
            );
            
            $items[] = array(
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $this->format_location($page_data['location'])
            );
        } elseif ($page_data['page_type'] == 'location') {
            $items[] = array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Furnished Apartments',
                'item' => home_url('/furnished-apartments-dallas/')
            );
            
            $items[] = array(
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $this->format_location($page_data['location'])
            );
        } elseif ($page_data['page_type'] == 'zipcode') {
            $items[] = array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Corporate Housing',
                'item' => home_url('/corporate-housing-dallas/')
            );
            
            $items[] = array(
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $page_data['zipcode']
            );
        }
        
        return array(
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items
        );
    }
    
    /**
     * Format service name
     */
    private function format_service($service) {
        $services = cht_get_services();
        return isset($services[$service]) ? $services[$service] : ucwords(str_replace('-', ' ', $service));
    }
    
    /**
     * Format location name
     */
    private function format_location($location) {
        $neighborhoods = cht_get_dallas_neighborhoods();
        return isset($neighborhoods[$location]) ? $neighborhoods[$location] : ucwords(str_replace('-', ' ', $location));
    }
}