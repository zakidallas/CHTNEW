<?php
/**
 * Pixabay Integration Class
 * Handles image fetching from Pixabay API
 * 
 * @package CorporateHousingDallas
 */

class CHT_Pixabay_Integration {
    
    private $api_key;
    private $api_url = 'https://pixabay.com/api/';
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->api_key = defined('PIXABAY_API_KEY') ? PIXABAY_API_KEY : '';
    }
    
    /**
     * Search images by location
     */
    public function get_location_images($location, $count = 5) {
        if (empty($this->api_key)) {
            return array();
        }
        
        // Check cache first
        $cache_key = 'cht_pixabay_' . md5($location);
        $cached_images = get_transient($cache_key);
        
        if ($cached_images !== false) {
            return $cached_images;
        }
        
        $params = array(
            'key' => $this->api_key,
            'q' => urlencode($location . ' Dallas apartment building'),
            'image_type' => 'photo',
            'orientation' => 'horizontal',
            'min_width' => 1200,
            'per_page' => $count,
            'safesearch' => 'true'
        );
        
        $url = $this->api_url . '?' . http_build_query($params);
        
        $response = wp_remote_get($url, array(
            'timeout' => 10
        ));
        
        if (is_wp_error($response)) {
            return array();
        }
        
        $body = json_decode(wp_remote_retrieve_body($response), true);
        
        if (!isset($body['hits']) || empty($body['hits'])) {
            // Try alternative search
            return $this->get_fallback_images($location, $count);
        }
        
        $images = array();
        foreach ($body['hits'] as $hit) {
            $images[] = array(
                'url' => $hit['webformatURL'],
                'large_url' => $hit['largeImageURL'],
                'alt' => $this->generate_alt_text($location, $hit['tags']),
                'pixabay_id' => $hit['id'],
                'width' => $hit['webformatWidth'],
                'height' => $hit['webformatHeight']
            );
        }
        
        // Cache for 30 days
        set_transient($cache_key, $images, 30 * DAY_IN_SECONDS);
        
        return $images;
    }
    
    /**
     * Get fallback images with different search terms
     */
    private function get_fallback_images($location, $count) {
        $fallback_queries = array(
            'Dallas luxury apartment',
            'Dallas skyline',
            'modern apartment interior',
            'furnished apartment living room',
            'Dallas Texas cityscape'
        );
        
        foreach ($fallback_queries as $query) {
            $params = array(
                'key' => $this->api_key,
                'q' => urlencode($query),
                'image_type' => 'photo',
                'orientation' => 'horizontal',
                'min_width' => 1200,
                'per_page' => $count,
                'safesearch' => 'true'
            );
            
            $url = $this->api_url . '?' . http_build_query($params);
            
            $response = wp_remote_get($url, array(
                'timeout' => 10
            ));
            
            if (!is_wp_error($response)) {
                $body = json_decode(wp_remote_retrieve_body($response), true);
                
                if (isset($body['hits']) && !empty($body['hits'])) {
                    $images = array();
                    foreach ($body['hits'] as $hit) {
                        $images[] = array(
                            'url' => $hit['webformatURL'],
                            'large_url' => $hit['largeImageURL'],
                            'alt' => $this->generate_alt_text($location, $hit['tags']),
                            'pixabay_id' => $hit['id'],
                            'width' => $hit['webformatWidth'],
                            'height' => $hit['webformatHeight']
                        );
                    }
                    
                    return $images;
                }
            }
        }
        
        return array();
    }
    
    /**
     * Generate alt text for images
     */
    private function generate_alt_text($location, $tags) {
        $location_name = ucwords(str_replace('-', ' ', $location));
        return sprintf('Furnished apartment in %s Dallas - %s', $location_name, $tags);
    }
    
    /**
     * Download and save image locally
     */
    public function save_image_locally($image_url, $location) {
        $upload_dir = wp_upload_dir();
        $filename = 'cht-' . $location . '-' . uniqid() . '.jpg';
        $filepath = $upload_dir['path'] . '/' . $filename;
        
        $image_data = wp_remote_get($image_url, array(
            'timeout' => 20
        ));
        
        if (is_wp_error($image_data)) {
            return false;
        }
        
        $image_content = wp_remote_retrieve_body($image_data);
        
        if (empty($image_content)) {
            return false;
        }
        
        // Save image
        $saved = file_put_contents($filepath, $image_content);
        
        if ($saved === false) {
            return false;
        }
        
        // Create attachment
        $attachment = array(
            'post_mime_type' => 'image/jpeg',
            'post_title' => 'Corporate Housing ' . ucwords($location) . ' Dallas',
            'post_content' => '',
            'post_status' => 'inherit'
        );
        
        $attach_id = wp_insert_attachment($attachment, $filepath);
        
        if (!is_wp_error($attach_id)) {
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attach_data = wp_generate_attachment_metadata($attach_id, $filepath);
            wp_update_attachment_metadata($attach_id, $attach_data);
            
            return array(
                'id' => $attach_id,
                'url' => wp_get_attachment_url($attach_id)
            );
        }
        
        return false;
    }
}