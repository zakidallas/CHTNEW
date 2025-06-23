<?php
/**
 * Theme Setup Class
 * 
 * @package CorporateHousingDallas
 */

class CHT_Theme_Setup {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_head', array($this, 'add_meta_tags'), 1);
        add_action('wp_head', array($this, 'add_schema_markup'), 10);
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_filter('upload_mimes', array($this, 'allow_webp_uploads'));
        add_action('after_switch_theme', array($this, 'theme_activation'));
    }
    
    /**
     * Initialize theme
     */
    public function init() {
        // Create database tables if not exists
        $this->create_database_tables();
        
        // Schedule cron jobs
        if (!wp_next_scheduled('cht_generate_content')) {
            wp_schedule_event(time(), 'hourly', 'cht_generate_content');
        }
        
        if (!wp_next_scheduled('cht_cleanup_cache')) {
            wp_schedule_event(time(), 'daily', 'cht_cleanup_cache');
        }
    }
    
    /**
     * Create custom database tables
     */
    private function create_database_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        
        // Leads table
        $table_leads = $wpdb->prefix . 'cht_leads';
        $sql_leads = "CREATE TABLE IF NOT EXISTS $table_leads (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            email VARCHAR(255) NOT NULL,
            moving_date DATE,
            duration_of_stay VARCHAR(50),
            price_range VARCHAR(50),
            source_page VARCHAR(255),
            ip_address VARCHAR(45),
            user_agent TEXT,
            utm_source VARCHAR(100),
            utm_medium VARCHAR(100),
            utm_campaign VARCHAR(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_email (email),
            INDEX idx_created (created_at),
            INDEX idx_source (source_page)
        ) $charset_collate;";
        
        dbDelta($sql_leads);
        
        // Content cache table
        $table_cache = $wpdb->prefix . 'cht_content_cache';
        $sql_cache = "CREATE TABLE IF NOT EXISTS $table_cache (
            id INT AUTO_INCREMENT PRIMARY KEY,
            page_type VARCHAR(50),
            location VARCHAR(100),
            service VARCHAR(100),
            content LONGTEXT,
            meta_title VARCHAR(255),
            meta_description TEXT,
            schema_markup TEXT,
            generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            expires_at TIMESTAMP NULL,
            INDEX idx_lookup (page_type, location, service),
            INDEX idx_expires (expires_at)
        ) $charset_collate;";
        
        dbDelta($sql_cache);
        
        // Images cache table
        $table_images = $wpdb->prefix . 'cht_images';
        $sql_images = "CREATE TABLE IF NOT EXISTS $table_images (
            id INT AUTO_INCREMENT PRIMARY KEY,
            location VARCHAR(100),
            image_url VARCHAR(500),
            alt_text VARCHAR(255),
            pixabay_id VARCHAR(50),
            image_type VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_location (location)
        ) $charset_collate;";
        
        dbDelta($sql_images);
        
        // Generation queue table
        $table_queue = $wpdb->prefix . 'cht_generation_queue';
        $sql_queue = "CREATE TABLE IF NOT EXISTS $table_queue (
            id INT AUTO_INCREMENT PRIMARY KEY,
            page_type VARCHAR(50),
            location VARCHAR(100),
            service VARCHAR(100),
            status ENUM('pending', 'processing', 'completed', 'failed') DEFAULT 'pending',
            error_message TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            processed_at TIMESTAMP NULL,
            INDEX idx_status (status),
            INDEX idx_created (created_at)
        ) $charset_collate;";
        
        dbDelta($sql_queue);
    }
    
    /**
     * Add meta tags
     */
    public function add_meta_tags() {
        global $cht_page_data;
        
        // Get current page data
        $location = isset($cht_page_data['location']) ? $cht_page_data['location'] : '';
        $service = isset($cht_page_data['service']) ? $cht_page_data['service'] : '';
        
        // Meta title and description
        $meta_title = cht_get_meta_title($location, $service);
        $meta_description = cht_get_meta_description($location, $service);
        
        // Output meta tags
        echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
        
        // Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr($meta_title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($meta_description) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        echo '<meta property="og:site_name" content="Corporate Housing Travelers">' . "\n";
        
        // Twitter Card
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($meta_title) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($meta_description) . '">' . "\n";
        
        // Canonical URL
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '">' . "\n";
        
        // Preconnect to external domains
        echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
        echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
        echo '<link rel="dns-prefetch" href="//ajax.googleapis.com">' . "\n";
    }
    
    /**
     * Add schema markup
     */
    public function add_schema_markup() {
        global $cht_page_data;
        
        if (empty($cht_page_data['schema'])) {
            return;
        }
        
        echo '<script type="application/ld+json">';
        echo wp_json_encode($cht_page_data['schema'], JSON_UNESCAPED_SLASHES);
        echo '</script>' . "\n";
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            'CHT Dashboard',
            'CHT Dashboard',
            'manage_options',
            'cht-dashboard',
            array($this, 'render_dashboard'),
            'dashicons-building',
            30
        );
        
        add_submenu_page(
            'cht-dashboard',
            'Content Generation',
            'Content Generation',
            'manage_options',
            'cht-generation',
            array($this, 'render_generation_page')
        );
        
        add_submenu_page(
            'cht-dashboard',
            'Lead Management',
            'Leads',
            'manage_options',
            'cht-leads',
            array($this, 'render_leads_page')
        );
        
        add_submenu_page(
            'cht-dashboard',
            'Settings',
            'Settings',
            'manage_options',
            'cht-settings',
            array($this, 'render_settings_page')
        );
    }
    
    /**
     * Render dashboard page
     */
    public function render_dashboard() {
        global $wpdb;
        
        // Get statistics
        $leads_table = $wpdb->prefix . 'cht_leads';
        $cache_table = $wpdb->prefix . 'cht_content_cache';
        
        $total_leads = $wpdb->get_var("SELECT COUNT(*) FROM $leads_table");
        $today_leads = $wpdb->get_var("SELECT COUNT(*) FROM $leads_table WHERE DATE(created_at) = CURDATE()");
        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM $cache_table");
        
        ?>
        <div class="wrap">
            <h1>Corporate Housing Dallas Dashboard</h1>
            
            <div class="cht-stats">
                <div class="stat-box">
                    <h3>Total Leads</h3>
                    <p class="stat-number"><?php echo number_format($total_leads); ?></p>
                </div>
                
                <div class="stat-box">
                    <h3>Today's Leads</h3>
                    <p class="stat-number"><?php echo number_format($today_leads); ?></p>
                </div>
                
                <div class="stat-box">
                    <h3>Generated Pages</h3>
                    <p class="stat-number"><?php echo number_format($total_pages); ?></p>
                </div>
            </div>
            
            <style>
                .cht-stats {
                    display: flex;
                    gap: 20px;
                    margin-top: 20px;
                }
                .stat-box {
                    background: #fff;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    flex: 1;
                }
                .stat-number {
                    font-size: 32px;
                    font-weight: bold;
                    color: #0066cc;
                    margin: 10px 0;
                }
            </style>
        </div>
        <?php
    }
    
    /**
     * Render content generation page
     */
    public function render_generation_page() {
        ?>
        <div class="wrap">
            <h1>Content Generation</h1>
            <p>Manage automated content generation for neighborhoods, ZIP codes, and service pages.</p>
            
            <form method="post" action="">
                <?php wp_nonce_field('cht_generate_content', 'cht_nonce'); ?>
                
                <h2>Generate New Pages</h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">Page Type</th>
                        <td>
                            <select name="page_type">
                                <option value="neighborhood">Neighborhood</option>
                                <option value="zipcode">ZIP Code</option>
                                <option value="service">Service</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Location/Service</th>
                        <td>
                            <input type="text" name="location" class="regular-text" />
                            <p class="description">Enter neighborhood name, ZIP code, or service type</p>
                        </td>
                    </tr>
                </table>
                
                <p class="submit">
                    <input type="submit" name="generate_content" class="button-primary" value="Generate Content" />
                </p>
            </form>
        </div>
        <?php
    }
    
    /**
     * Render leads page
     */
    public function render_leads_page() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cht_leads';
        
        // Get leads
        $leads = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC LIMIT 50");
        
        ?>
        <div class="wrap">
            <h1>Lead Management</h1>
            
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Moving Date</th>
                        <th>Duration</th>
                        <th>Price Range</th>
                        <th>Source</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $lead): ?>
                    <tr>
                        <td><?php echo esc_html($lead->full_name); ?></td>
                        <td><?php echo esc_html($lead->email); ?></td>
                        <td><?php echo esc_html($lead->phone); ?></td>
                        <td><?php echo esc_html($lead->moving_date); ?></td>
                        <td><?php echo esc_html($lead->duration_of_stay); ?></td>
                        <td><?php echo esc_html($lead->price_range); ?></td>
                        <td><?php echo esc_html($lead->source_page); ?></td>
                        <td><?php echo esc_html($lead->created_at); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    
    /**
     * Render settings page
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>CHT Settings</h1>
            
            <form method="post" action="options.php">
                <?php settings_fields('cht_settings'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">API Keys Status</th>
                        <td>
                            <p>✅ OpenAI API Key: <?php echo defined('OPENAI_API_KEY') ? 'Configured' : 'Not configured'; ?></p>
                            <p>✅ Pixabay API Key: <?php echo defined('PIXABAY_API_KEY') ? 'Configured' : 'Not configured'; ?></p>
                            <p>✅ Google Maps API Key: <?php echo defined('GOOGLE_MAPS_API_KEY') ? 'Configured' : 'Not configured'; ?></p>
                        </td>
                    </tr>
                </table>
                
                <p class="description">API keys are securely stored in the .env file.</p>
            </form>
        </div>
        <?php
    }
    
    /**
     * Allow WebP uploads
     */
    public function allow_webp_uploads($mimes) {
        $mimes['webp'] = 'image/webp';
        return $mimes;
    }
    
    /**
     * Theme activation
     */
    public function theme_activation() {
        // Create database tables
        $this->create_database_tables();
        
        // Flush rewrite rules
        flush_rewrite_rules();
        
        // Create backup directory
        $backup_dir = CHT_THEME_DIR . '/backup';
        if (!file_exists($backup_dir)) {
            wp_mkdir_p($backup_dir);
        }
    }
}