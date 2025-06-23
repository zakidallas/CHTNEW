<?php
/**
 * Google Maps Integration Class
 * Handles map embeds and location data
 * 
 * @package CorporateHousingDallas
 */

class CHT_Google_Maps {
    
    private $api_key;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->api_key = defined('GOOGLE_MAPS_API_KEY') ? GOOGLE_MAPS_API_KEY : '';
    }
    
    /**
     * Get map embed HTML
     */
    public function get_map_embed($location, $width = '100%', $height = '400') {
        if (empty($this->api_key)) {
            return '';
        }
        
        $address = $location . ', Dallas, TX';
        $encoded_address = urlencode($address);
        
        $embed_url = "https://www.google.com/maps/embed/v1/place?key={$this->api_key}&q={$encoded_address}&zoom=14";
        
        $html = '<div class="map-container">';
        $html .= '<iframe ';
        $html .= 'width="' . esc_attr($width) . '" ';
        $html .= 'height="' . esc_attr($height) . '" ';
        $html .= 'frameborder="0" style="border:0" ';
        $html .= 'src="' . esc_url($embed_url) . '" ';
        $html .= 'allowfullscreen>';
        $html .= '</iframe>';
        $html .= '</div>';
        
        return $html;
    }
    
    /**
     * Get location coordinates
     */
    public function get_coordinates($location) {
        if (empty($this->api_key)) {
            return false;
        }
        
        $address = $location . ', Dallas, TX';
        $encoded_address = urlencode($address);
        
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encoded_address}&key={$this->api_key}";
        
        $response = wp_remote_get($url);
        
        if (is_wp_error($response)) {
            return false;
        }
        
        $body = json_decode(wp_remote_retrieve_body($response), true);
        
        if (isset($body['results'][0]['geometry']['location'])) {
            return array(
                'lat' => $body['results'][0]['geometry']['location']['lat'],
                'lng' => $body['results'][0]['geometry']['location']['lng']
            );
        }
        
        return false;
    }
    
    /**
     * Get nearby places
     */
    public function get_nearby_places($location, $type = 'restaurant', $radius = 1000) {
        $coords = $this->get_coordinates($location);
        
        if (!$coords) {
            return array();
        }
        
        $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json";
        $url .= "?location={$coords['lat']},{$coords['lng']}";
        $url .= "&radius={$radius}";
        $url .= "&type={$type}";
        $url .= "&key={$this->api_key}";
        
        $response = wp_remote_get($url);
        
        if (is_wp_error($response)) {
            return array();
        }
        
        $body = json_decode(wp_remote_retrieve_body($response), true);
        
        if (isset($body['results'])) {
            $places = array();
            
            foreach ($body['results'] as $place) {
                $places[] = array(
                    'name' => $place['name'],
                    'address' => isset($place['vicinity']) ? $place['vicinity'] : '',
                    'rating' => isset($place['rating']) ? $place['rating'] : 0,
                    'type' => $type
                );
            }
            
            return array_slice($places, 0, 5); // Return top 5
        }
        
        return array();
    }
}