/**
 * Main JavaScript file
 * Corporate Housing Dallas Theme
 */

(function($) {
    'use strict';
    
    // Mobile menu toggle
    $('.menu-toggle').on('click', function() {
        $(this).toggleClass('active');
        $('.primary-menu').toggleClass('active');
    });
    
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
    
    // Lazy loading images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Form validation
    $('#lead-form').on('submit', function(e) {
        var isValid = true;
        var requiredFields = $(this).find('[required]');
        
        requiredFields.each(function() {
            if (!$(this).val()) {
                $(this).addClass('error');
                isValid = false;
            } else {
                $(this).removeClass('error');
            }
        });
        
        // Email validation
        var email = $('#email').val();
        if (email && !isValidEmail(email)) {
            $('#email').addClass('error');
            isValid = false;
        }
        
        // Phone validation
        var phone = $('#phone').val();
        if (phone && !isValidPhone(phone)) {
            $('#phone').addClass('error');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields correctly.');
        }
    });
    
    // Email validation helper
    function isValidEmail(email) {
        var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }
    
    // Phone validation helper
    function isValidPhone(phone) {
        var pattern = /^[\d\s\-\+\(\)]+$/;
        return pattern.test(phone) && phone.replace(/\D/g, '').length >= 10;
    }
    
    // Remove error class on input
    $('#lead-form input, #lead-form select').on('input change', function() {
        $(this).removeClass('error');
    });
    
    // Track form field interactions
    $('#lead-form input, #lead-form select').on('focus', function() {
        if (typeof gtag !== 'undefined') {
            gtag('event', 'form_interaction', {
                'event_category': 'engagement',
                'event_label': $(this).attr('name')
            });
        }
    });
    
})(jQuery);