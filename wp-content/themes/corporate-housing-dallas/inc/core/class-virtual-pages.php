<?php
/**
 * Virtual Pages Class
 * Handles dynamic page generation for SEO
 * 
 * @package CorporateHousingDallas
 */

class CHT_Virtual_Pages {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_filter('query_vars', array($this, 'add_query_vars'));
        add_action('template_redirect', array($this, 'handle_virtual_pages'));
        add_filter('the_posts', array($this, 'create_virtual_page'), -10);
        add_filter('wp_title', array($this, 'virtual_page_title'), 10, 2);
        add_filter('document_title_parts', array($this, 'virtual_page_title_parts'));
    }
    
    /**
     * Add custom query variables
     */
    public function add_query_vars($vars) {
        $vars[] = 'cht_service';
        $vars[] = 'cht_location';
        $vars[] = 'cht_zipcode';
        $vars[] = 'cht_page_type';
        return $vars;
    }
    
    /**
     * Handle virtual pages
     */
    public function handle_virtual_pages() {
        global $wp_query, $cht_page_data;
        
        // Get query variables
        $service = get_query_var('cht_service');
        $location = get_query_var('cht_location');
        $zipcode = get_query_var('cht_zipcode');
        
        // Determine page type
        if ($service && $location) {
            $cht_page_data = array(
                'service' => $service,
                'location' => $location,
                'page_type' => 'service-location'
            );
        } elseif ($location) {
            $cht_page_data = array(
                'location' => $location,
                'page_type' => 'location',
                'service' => 'furnished apartments'
            );
        } elseif ($zipcode) {
            $cht_page_data = array(
                'zipcode' => $zipcode,
                'page_type' => 'zipcode',
                'service' => 'corporate housing'
            );
        } else {
            return;
        }
        
        // Check if this is a valid virtual page
        if ($this->is_valid_virtual_page($cht_page_data)) {
            // Set up query
            $wp_query->is_page = true;
            $wp_query->is_singular = true;
            $wp_query->is_single = false;
            $wp_query->is_404 = false;
            $wp_query->is_home = false;
            $wp_query->is_archive = false;
            $wp_query->is_category = false;
            
            // Generate or retrieve content
            $this->generate_page_content($cht_page_data);
        }
    }
    
    /**
     * Check if virtual page is valid
     */
    private function is_valid_virtual_page($page_data) {
        // Check neighborhoods
        if (isset($page_data['location'])) {
            $neighborhoods = cht_get_dallas_neighborhoods();
            if (array_key_exists($page_data['location'], $neighborhoods)) {
                return true;
            }
        }
        
        // Check ZIP codes
        if (isset($page_data['zipcode'])) {
            $zipcodes = cht_get_dallas_zipcodes();
            if (in_array($page_data['zipcode'], $zipcodes)) {
                return true;
            }
        }
        
        // Check services
        if (isset($page_data['service'])) {
            $services = cht_get_services();
            if (array_key_exists($page_data['service'], $services)) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Generate page content
     */
    private function generate_page_content(&$page_data) {
        global $wpdb;
        
        // Check cache first
        $cache_table = $wpdb->prefix . 'cht_content_cache';
        
        $cache_key = md5(serialize($page_data));
        $cached_content = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $cache_table WHERE 
            page_type = %s AND 
            location = %s AND 
            service = %s AND 
            expires_at > NOW()",
            $page_data['page_type'],
            isset($page_data['location']) ? $page_data['location'] : '',
            isset($page_data['service']) ? $page_data['service'] : ''
        ));
        
        if ($cached_content) {
            // Use cached content
            $page_data['content'] = $cached_content->content;
            $page_data['meta_title'] = $cached_content->meta_title;
            $page_data['meta_description'] = $cached_content->meta_description;
            $page_data['schema'] = json_decode($cached_content->schema_markup, true);
        } else {
            // Generate new content
            $content_generator = new CHT_Content_Generator();
            $generated = $content_generator->generate_page_content($page_data);
            
            if ($generated) {
                $page_data = array_merge($page_data, $generated);
                
                // Cache the content
                $wpdb->insert($cache_table, array(
                    'page_type' => $page_data['page_type'],
                    'location' => isset($page_data['location']) ? $page_data['location'] : '',
                    'service' => isset($page_data['service']) ? $page_data['service'] : '',
                    'content' => $page_data['content'],
                    'meta_title' => $page_data['meta_title'],
                    'meta_description' => $page_data['meta_description'],
                    'schema_markup' => json_encode($page_data['schema']),
                    'expires_at' => date('Y-m-d H:i:s', strtotime('+6 months'))
                ));
            }
        }
    }
    
    /**
     * Create virtual page post object
     */
    public function create_virtual_page($posts) {
        global $wp_query, $cht_page_data;
        
        if (!$wp_query->is_page || !empty($posts) || empty($cht_page_data)) {
            return $posts;
        }
        
        // Create virtual post
        $post = new stdClass();
        $post->ID = -1;
        $post->post_author = 1;
        $post->post_date = current_time('mysql');
        $post->post_date_gmt = current_time('mysql', 1);
        $post->post_title = $this->get_page_title($cht_page_data);
        $post->post_content = isset($cht_page_data['content']) ? $cht_page_data['content'] : '';
        $post->post_status = 'publish';
        $post->comment_status = 'closed';
        $post->ping_status = 'closed';
        $post->post_name = $this->get_page_slug($cht_page_data);
        $post->post_type = 'page';
        $post->filter = 'raw';
        
        // Convert to WP_Post
        $wp_post = new WP_Post($post);
        
        return array($wp_post);
    }
    
    /**
     * Get page title
     */
    private function get_page_title($page_data) {
        if ($page_data['page_type'] == 'service-location') {
            $services = cht_get_services();
            $neighborhoods = cht_get_dallas_neighborhoods();
            
            $service_name = isset($services[$page_data['service']]) ? $services[$page_data['service']] : ucwords(str_replace('-', ' ', $page_data['service']));
            $location_name = isset($neighborhoods[$page_data['location']]) ? $neighborhoods[$page_data['location']] : ucwords(str_replace('-', ' ', $page_data['location']));
            
            return sprintf('%s in %s Dallas', $service_name, $location_name);
        } elseif ($page_data['page_type'] == 'location') {
            $neighborhoods = cht_get_dallas_neighborhoods();
            $location_name = isset($neighborhoods[$page_data['location']]) ? $neighborhoods[$page_data['location']] : ucwords(str_replace('-', ' ', $page_data['location']));
            
            return sprintf('Furnished Apartments in %s Dallas', $location_name);
        } elseif ($page_data['page_type'] == 'zipcode') {
            return sprintf('Corporate Housing in Dallas %s', $page_data['zipcode']);
        }
        
        return 'Corporate Housing Dallas';
    }
    
    /**
     * Get page slug
     */
    private function get_page_slug($page_data) {
        if ($page_data['page_type'] == 'service-location') {
            return $page_data['service'] . '-' . $page_data['location'] . '-dallas';
        } elseif ($page_data['page_type'] == 'location') {
            return 'furnished-apartments-' . $page_data['location'] . '-dallas';
        } elseif ($page_data['page_type'] == 'zipcode') {
            return 'corporate-housing-dallas-' . $page_data['zipcode'];
        }
        
        return 'corporate-housing-dallas';
    }
    
    /**
     * Virtual page title
     */
    public function virtual_page_title($title, $sep = '|') {
        global $cht_page_data;
        
        if (!empty($cht_page_data['meta_title'])) {
            return $cht_page_data['meta_title'];
        }
        
        return $title;
    }
    
    /**
     * Virtual page title parts
     */
    public function virtual_page_title_parts($title) {
        global $cht_page_data;
        
        if (!empty($cht_page_data['meta_title'])) {
            $title['title'] = $cht_page_data['meta_title'];
        }
        
        return $title;
    }
}