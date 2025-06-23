<?php
/**
 * Lead Capture Class
 * Handles form submissions and lead management
 * 
 * @package CorporateHousingDallas
 */

class CHT_Lead_Capture {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('wp_ajax_submit_lead', array($this, 'handle_lead_submission'));
        add_action('wp_ajax_nopriv_submit_lead', array($this, 'handle_lead_submission'));
        add_action('init', array($this, 'register_lead_post_type'));
        add_shortcode('cht_lead_form', array($this, 'lead_form_shortcode'));
    }
    
    /**
     * Handle lead form submission
     */
    public function handle_lead_submission() {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'cht_ajax_nonce')) {
            wp_send_json_error('Security check failed');
            return;
        }
        
        // Sanitize and validate data
        $full_name = sanitize_text_field($_POST['full_name']);
        $phone = sanitize_text_field($_POST['phone']);
        $email = sanitize_email($_POST['email']);
        $moving_date = sanitize_text_field($_POST['moving_date']);
        $duration_of_stay = sanitize_text_field($_POST['duration_of_stay']);
        $price_range = sanitize_text_field($_POST['price_range']);
        $source_page = esc_url_raw($_POST['source_page']);
        
        // Validate required fields
        if (empty($full_name) || empty($phone) || empty($email)) {
            wp_send_json_error('Please fill in all required fields');
            return;
        }
        
        // Validate email
        if (!is_email($email)) {
            wp_send_json_error('Please enter a valid email address');
            return;
        }
        
        // Get user data
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        // Get UTM parameters if available
        $utm_source = isset($_POST['utm_source']) ? sanitize_text_field($_POST['utm_source']) : '';
        $utm_medium = isset($_POST['utm_medium']) ? sanitize_text_field($_POST['utm_medium']) : '';
        $utm_campaign = isset($_POST['utm_campaign']) ? sanitize_text_field($_POST['utm_campaign']) : '';
        
        // Store in database
        global $wpdb;
        $table_name = $wpdb->prefix . 'cht_leads';
        
        $result = $wpdb->insert(
            $table_name,
            array(
                'full_name' => $full_name,
                'phone' => $phone,
                'email' => $email,
                'moving_date' => !empty($moving_date) ? $moving_date : null,
                'duration_of_stay' => $duration_of_stay,
                'price_range' => $price_range,
                'source_page' => $source_page,
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
                'utm_source' => $utm_source,
                'utm_medium' => $utm_medium,
                'utm_campaign' => $utm_campaign,
                'created_at' => current_time('mysql')
            ),
            array(
                '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
            )
        );
        
        if ($result === false) {
            wp_send_json_error('There was an error saving your information. Please try again.');
            return;
        }
        
        // Send email notification
        $this->send_lead_notification($full_name, $email, $phone, $moving_date, $duration_of_stay, $price_range, $source_page);
        
        // Return success
        wp_send_json_success(array(
            'message' => 'Thank you! We will contact you within 24 hours.',
            'lead_id' => $wpdb->insert_id
        ));
    }
    
    /**
     * Send email notification for new lead
     */
    private function send_lead_notification($name, $email, $phone, $moving_date, $duration, $price_range, $source) {
        $to = get_option('admin_email');
        $subject = 'New Lead: ' . $name . ' - Corporate Housing Dallas';
        
        $message = "You have received a new lead from Corporate Housing Dallas:\n\n";
        $message .= "Name: " . $name . "\n";
        $message .= "Email: " . $email . "\n";
        $message .= "Phone: " . $phone . "\n";
        $message .= "Moving Date: " . ($moving_date ? $moving_date : 'Not specified') . "\n";
        $message .= "Duration: " . ($duration ? $duration : 'Not specified') . "\n";
        $message .= "Price Range: " . ($price_range ? $price_range : 'Not specified') . "\n";
        $message .= "Source Page: " . $source . "\n\n";
        $message .= "Time: " . current_time('mysql') . "\n";
        
        $headers = array(
            'From: Corporate Housing Dallas <noreply@corporatehousingtravelers.com>',
            'Reply-To: ' . $name . ' <' . $email . '>'
        );
        
        wp_mail($to, $subject, $message, $headers);
        
        // Also send confirmation to lead
        $lead_subject = 'Thank you for your inquiry - Corporate Housing Dallas';
        $lead_message = "Dear " . $name . ",\n\n";
        $lead_message .= "Thank you for your interest in Corporate Housing Dallas. We have received your inquiry and will contact you within 24 hours.\n\n";
        $lead_message .= "Your Requirements:\n";
        $lead_message .= "Moving Date: " . ($moving_date ? $moving_date : 'Flexible') . "\n";
        $lead_message .= "Duration: " . ($duration ? $duration : 'To be discussed') . "\n";
        $lead_message .= "Price Range: " . ($price_range ? $price_range : 'To be discussed') . "\n\n";
        $lead_message .= "If you have any immediate questions, please don't hesitate to call us at (123) 456-7890.\n\n";
        $lead_message .= "Best regards,\n";
        $lead_message .= "Corporate Housing Dallas Team";
        
        wp_mail($email, $lead_subject, $lead_message);
    }
    
    /**
     * Register lead post type (optional for admin interface)
     */
    public function register_lead_post_type() {
        register_post_type('cht_lead', array(
            'labels' => array(
                'name' => 'Leads',
                'singular_name' => 'Lead',
                'add_new' => 'Add New Lead',
                'add_new_item' => 'Add New Lead',
                'edit_item' => 'Edit Lead',
                'new_item' => 'New Lead',
                'view_item' => 'View Lead',
                'search_items' => 'Search Leads',
                'not_found' => 'No leads found',
                'not_found_in_trash' => 'No leads found in trash'
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'cht-dashboard',
            'capability_type' => 'post',
            'supports' => array('title', 'custom-fields'),
            'rewrite' => false
        ));
    }
    
    /**
     * Lead form shortcode
     */
    public function lead_form_shortcode($atts) {
        ob_start();
        get_template_part('template-parts/lead-form');
        return ob_get_clean();
    }
    
    /**
     * Get lead statistics
     */
    public static function get_lead_stats() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cht_leads';
        
        $stats = array(
            'total' => $wpdb->get_var("SELECT COUNT(*) FROM $table_name"),
            'today' => $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE DATE(created_at) = CURDATE()"),
            'week' => $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)"),
            'month' => $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)")
        );
        
        return $stats;
    }
    
    /**
     * Export leads to CSV
     */
    public static function export_leads_csv() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cht_leads';
        
        $leads = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");
        
        if (empty($leads)) {
            return false;
        }
        
        // Set headers for CSV download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=leads-' . date('Y-m-d') . '.csv');
        
        // Create output stream
        $output = fopen('php://output', 'w');
        
        // Add CSV headers
        fputcsv($output, array(
            'ID', 'Name', 'Email', 'Phone', 'Moving Date', 'Duration', 
            'Price Range', 'Source Page', 'IP Address', 'UTM Source', 
            'UTM Medium', 'UTM Campaign', 'Created At'
        ));
        
        // Add data rows
        foreach ($leads as $lead) {
            fputcsv($output, array(
                $lead->id,
                $lead->full_name,
                $lead->email,
                $lead->phone,
                $lead->moving_date,
                $lead->duration_of_stay,
                $lead->price_range,
                $lead->source_page,
                $lead->ip_address,
                $lead->utm_source,
                $lead->utm_medium,
                $lead->utm_campaign,
                $lead->created_at
            ));
        }
        
        fclose($output);
        exit;
    }
}