<?php
/**
 * Image Optimization Class
 * Handles lazy loading, WebP support, and responsive images
 *
 * @package CorporateHousingDallas
 */

class CHT_Image_Optimizer {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_filter('wp_get_attachment_image_attributes', array($this, 'add_lazy_loading'), 10, 3);
        add_filter('the_content', array($this, 'add_lazy_loading_to_content_images'));
        add_action('wp_head', array($this, 'add_lazy_loading_script'));
        add_filter('wp_calculate_image_srcset', array($this, 'optimize_srcset'), 10, 5);
        add_filter('jpeg_quality', array($this, 'set_jpeg_quality'));
        add_filter('wp_editor_set_quality', array($this, 'set_image_quality'));
    }
    
    /**
     * Add lazy loading attributes to images
     */
    public function add_lazy_loading($attributes, $attachment, $size) {
        // Skip if already has loading attribute
        if (isset($attributes['loading'])) {
            return $attributes;
        }
        
        // Add native lazy loading
        $attributes['loading'] = 'lazy';
        
        // Add data-src for JavaScript fallback
        if (isset($attributes['src'])) {
            $attributes['data-src'] = $attributes['src'];
            $attributes['src'] = $this->get_placeholder_image();
            $attributes['class'] = isset($attributes['class']) ? $attributes['class'] . ' lazy-load' : 'lazy-load';
        }
        
        return $attributes;
    }
    
    /**
     * Add lazy loading to content images
     */
    public function add_lazy_loading_to_content_images($content) {
        // Skip if in admin
        if (is_admin()) {
            return $content;
        }
        
        // Add loading="lazy" to all images
        $content = preg_replace('/<img(.*?)>/i', '<img$1 loading="lazy">', $content);
        
        // Add lazy-load class
        $content = str_replace('<img', '<img class="lazy-load"', $content);
        
        return $content;
    }
    
    /**
     * Add lazy loading JavaScript
     */
    public function add_lazy_loading_script() {
        ?>
        <script>
        // Native lazy loading with IntersectionObserver fallback
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                }
            });
        } else {
            // Fallback for browsers that don't support native lazy loading
            const script = document.createElement('script');
            script.src = '<?php echo get_template_directory_uri(); ?>/assets/js/lazyload.min.js';
            document.head.appendChild(script);
        }
        </script>
        <?php
    }
    
    /**
     * Get placeholder image
     */
    private function get_placeholder_image() {
        // Return a small base64 transparent image
        return 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 1"%3E%3C/svg%3E';
    }
    
    /**
     * Optimize srcset for responsive images
     */
    public function optimize_srcset($sources, $size_array, $image_src, $image_meta, $attachment_id) {
        // Add WebP versions if available
        foreach ($sources as $width => $source) {
            $webp_url = $this->get_webp_url($source['url']);
            if ($webp_url && $this->webp_exists($webp_url)) {
                $sources[$width]['url'] = $webp_url;
            }
        }
        
        return $sources;
    }
    
    /**
     * Get WebP URL from image URL
     */
    private function get_webp_url($url) {
        return preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $url);
    }
    
    /**
     * Check if WebP version exists
     */
    private function webp_exists($url) {
        $upload_dir = wp_upload_dir();
        $file_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $url);
        return file_exists($file_path);
    }
    
    /**
     * Set JPEG quality
     */
    public function set_jpeg_quality($quality) {
        return 85; // Optimal quality for web
    }
    
    /**
     * Set image quality for all formats
     */
    public function set_image_quality($quality) {
        return 85;
    }
    
    /**
     * Generate responsive image HTML
     */
    public static function get_responsive_image($image_url, $alt_text = '', $sizes = array()) {
        $default_sizes = array(
            '(max-width: 640px) 100vw',
            '(max-width: 1024px) 50vw',
            '33vw'
        );
        
        $sizes = !empty($sizes) ? $sizes : $default_sizes;
        $sizes_attr = implode(', ', $sizes);
        
        // Generate srcset
        $srcset = array();
        $widths = array(320, 640, 1024, 1280, 1920);
        
        foreach ($widths as $width) {
            $srcset[] = esc_url($image_url) . ' ' . $width . 'w';
        }
        
        $srcset_attr = implode(', ', $srcset);
        
        return sprintf(
            '<img src="%s" alt="%s" srcset="%s" sizes="%s" loading="lazy" class="responsive-image">',
            esc_url($image_url),
            esc_attr($alt_text),
            $srcset_attr,
            $sizes_attr
        );
    }
    
    /**
     * Preload critical images
     */
    public static function preload_hero_image($image_url) {
        echo '<link rel="preload" as="image" href="' . esc_url($image_url) . '">';
    }
}

// Initialize
new CHT_Image_Optimizer();