    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Popular Neighborhoods</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-uptown/')); ?>">Uptown Dallas</a></li>
                        <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-downtown/')); ?>">Downtown Dallas</a></li>
                        <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-medical-district/')); ?>">Medical District</a></li>
                        <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-deep-ellum/')); ?>">Deep Ellum</a></li>
                        <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-bishop-arts/')); ?>">Bishop Arts</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/corporate-housing-dallas/')); ?>">Corporate Housing</a></li>
                        <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas/')); ?>">Furnished Apartments</a></li>
                        <li><a href="<?php echo esc_url(home_url('/short-term-rentals-dallas/')); ?>">Short-Term Rentals</a></li>
                        <li><a href="<?php echo esc_url(home_url('/executive-housing-dallas/')); ?>">Executive Housing</a></li>
                        <li><a href="<?php echo esc_url(home_url('/pet-friendly-corporate-housing-dallas/')); ?>">Pet-Friendly Options</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Popular ZIP Codes</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/corporate-housing-dallas-75201/')); ?>">75201 - Downtown</a></li>
                        <li><a href="<?php echo esc_url(home_url('/corporate-housing-dallas-75204/')); ?>">75204 - Uptown</a></li>
                        <li><a href="<?php echo esc_url(home_url('/corporate-housing-dallas-75219/')); ?>">75219 - Oak Lawn</a></li>
                        <li><a href="<?php echo esc_url(home_url('/corporate-housing-dallas-75206/')); ?>">75206 - East Dallas</a></li>
                        <li><a href="<?php echo esc_url(home_url('/corporate-housing-dallas-75230/')); ?>">75230 - North Dallas</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Contact Information</h4>
                    <p>Corporate Housing Travelers<br>
                    Dallas, TX<br>
                    <a href="tel:+1234567890">Call: (123) 456-7890</a><br>
                    <a href="mailto:info@corporatehousingtravelers.com">Email Us</a></p>
                    
                    <p class="footer-cta">
                        <strong>24/7 Support Available</strong><br>
                        All-Inclusive Pricing • Pet-Friendly Options
                    </p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Corporate Housing Travelers. All rights reserved.</p>
                <p><a href="<?php echo esc_url(home_url('/sitemap.xml')); ?>">Sitemap</a> | <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a></p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Lead form success tracking -->
<script>
jQuery(document).ready(function($) {
    $('#lead-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: cht_ajax.ajax_url,
            type: 'POST',
            data: formData + '&action=submit_lead&nonce=' + cht_ajax.nonce,
            success: function(response) {
                if (response.success) {
                    $('#lead-form')[0].reset();
                    alert('Thank you! We will contact you shortly.');
                    
                    // Track conversion
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'generate_lead', {
                            'event_category': 'engagement',
                            'event_label': window.location.pathname
                        });
                    }
                } else {
                    alert('There was an error. Please try again.');
                }
            }
        });
    });
});
</script>

</body>
</html>