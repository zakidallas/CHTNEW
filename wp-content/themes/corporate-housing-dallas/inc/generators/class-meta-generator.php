<?php
/**
 * Meta Generator Class
 * Generates meta titles and descriptions
 * 
 * @package CorporateHousingDallas
 */

class CHT_Meta_Generator {
    
    /**
     * Generate meta title
     */
    public function generate_title($page_data) {
        $templates = array(
            'service-location' => '%s in %s Dallas | Up to 50% Off Hotels | CHT',
            'location' => 'Furnished Apartments in %s Dallas | Flexible Terms | CHT',
            'zipcode' => 'Corporate Housing Dallas %s | Short-Term Rentals',
            'service' => '%s Dallas | Premium Furnished Housing Solutions',
            'default' => 'Corporate Housing Dallas | Furnished Apartments & Rentals'
        );
        
        if ($page_data['page_type'] == 'service-location') {
            $service = $this->format_service($page_data['service']);
            $location = $this->format_location($page_data['location']);
            return sprintf($templates['service-location'], $service, $location);
        } elseif ($page_data['page_type'] == 'location') {
            $location = $this->format_location($page_data['location']);
            return sprintf($templates['location'], $location);
        } elseif ($page_data['page_type'] == 'zipcode') {
            return sprintf($templates['zipcode'], $page_data['zipcode']);
        } elseif (isset($page_data['service'])) {
            $service = $this->format_service($page_data['service']);
            return sprintf($templates['service'], $service);
        }
        
        return $templates['default'];
    }
    
    /**
     * Generate meta description
     */
    public function generate_description($page_data) {
        $templates = array(
            'service-location' => 'Premium %s in %s Dallas. Fully furnished, flexible terms, all-inclusive pricing. Pet-friendly options available. Book today!',
            'location' => 'Furnished apartments in %s Dallas with flexible lease terms. All utilities included, pet-friendly options, 24/7 support. Perfect for business travelers.',
            'zipcode' => 'Find corporate housing in Dallas %s. Fully furnished apartments for business travelers and relocations. All-inclusive pricing, flexible terms.',
            'service' => 'Looking for %s in Dallas? We offer premium furnished accommodations with flexible terms throughout DFW. All utilities included.',
            'default' => 'Corporate housing and furnished apartments in Dallas. Flexible lease terms, all-inclusive pricing, premium locations. Perfect for business travelers and relocations.'
        );
        
        if ($page_data['page_type'] == 'service-location') {
            $service = strtolower($this->format_service($page_data['service']));
            $location = $this->format_location($page_data['location']);
            return sprintf($templates['service-location'], $service, $location);
        } elseif ($page_data['page_type'] == 'location') {
            $location = $this->format_location($page_data['location']);
            return sprintf($templates['location'], $location);
        } elseif ($page_data['page_type'] == 'zipcode') {
            return sprintf($templates['zipcode'], $page_data['zipcode']);
        } elseif (isset($page_data['service'])) {
            $service = strtolower($this->format_service($page_data['service']));
            return sprintf($templates['service'], $service);
        }
        
        return $templates['default'];
    }
    
    /**
     * Format service name
     */
    private function format_service($service) {
        $services = cht_get_services();
        
        if (isset($services[$service])) {
            return $services[$service];
        }
        
        return ucwords(str_replace('-', ' ', $service));
    }
    
    /**
     * Format location name
     */
    private function format_location($location) {
        $neighborhoods = cht_get_dallas_neighborhoods();
        
        if (isset($neighborhoods[$location])) {
            return $neighborhoods[$location];
        }
        
        return ucwords(str_replace('-', ' ', $location));
    }
}