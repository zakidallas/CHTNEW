<?php
/**
 * OpenAI Integration Class
 * Handles content generation using OpenAI API
 * 
 * @package CorporateHousingDallas
 */

class CHT_OpenAI_Integration {
    
    private $api_key;
    private $api_url = 'https://api.openai.com/v1/chat/completions';
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->api_key = defined('OPENAI_API_KEY') ? OPENAI_API_KEY : '';
    }
    
    /**
     * Generate content using OpenAI
     */
    public function generate_content($prompt, $max_tokens = 1500) {
        if (empty($this->api_key)) {
            return false;
        }
        
        // Check rate limit
        if (!$this->check_rate_limit()) {
            return false;
        }
        
        $headers = array(
            'Authorization' => 'Bearer ' . $this->api_key,
            'Content-Type' => 'application/json'
        );
        
        $body = array(
            'model' => 'gpt-4',
            'messages' => array(
                array(
                    'role' => 'system',
                    'content' => 'You are a professional content writer specializing in corporate housing and furnished apartments in Dallas, Texas.'
                ),
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'max_tokens' => $max_tokens,
            'temperature' => 0.7
        );
        
        $response = wp_remote_post($this->api_url, array(
            'headers' => $headers,
            'body' => json_encode($body),
            'timeout' => 30
        ));
        
        if (is_wp_error($response)) {
            return false;
        }
        
        $body = json_decode(wp_remote_retrieve_body($response), true);
        
        if (isset($body['choices'][0]['message']['content'])) {
            $this->update_rate_limit();
            return $body['choices'][0]['message']['content'];
        }
        
        return false;
    }
    
    /**
     * Generate FAQ content
     */
    public function generate_faqs($topic, $location = '', $count = 10) {
        $prompt = "Generate {$count} frequently asked questions and comprehensive answers about {$topic}";
        
        if ($location) {
            $prompt .= " in {$location} Dallas";
        }
        
        $prompt .= ". Format as JSON array with 'question' and 'answer' keys. Each answer should be 100-150 words.";
        
        $content = $this->generate_content($prompt, 2000);
        
        if ($content) {
            // Try to parse as JSON
            $json_start = strpos($content, '[');
            $json_end = strrpos($content, ']');
            
            if ($json_start !== false && $json_end !== false) {
                $json_content = substr($content, $json_start, $json_end - $json_start + 1);
                $faqs = json_decode($json_content, true);
                
                if (is_array($faqs)) {
                    return $faqs;
                }
            }
        }
        
        return array();
    }
    
    /**
     * Check rate limit
     */
    private function check_rate_limit() {
        $transient_key = 'cht_openai_rate_limit';
        $current_count = get_transient($transient_key);
        
        if ($current_count === false) {
            set_transient($transient_key, 1, 60); // Reset every minute
            return true;
        }
        
        if ($current_count >= 100) { // 100 requests per minute limit
            return false;
        }
        
        return true;
    }
    
    /**
     * Update rate limit counter
     */
    private function update_rate_limit() {
        $transient_key = 'cht_openai_rate_limit';
        $current_count = get_transient($transient_key);
        
        if ($current_count === false) {
            set_transient($transient_key, 1, 60);
        } else {
            set_transient($transient_key, $current_count + 1, 60);
        }
    }
}