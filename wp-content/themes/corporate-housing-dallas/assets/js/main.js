/**
 * Main JavaScript File
 * Corporate Housing Dallas Theme
 */

(function($) {
    'use strict';
    
    // DOM Ready
    $(document).ready(function() {
        initHeader();
        initMobileMenu();
        initSmoothScroll();
        initScrollEffects();
    });
    
    // Initialize Header
    function initHeader() {
        const header = $('#masthead');
        const scrollThreshold = 50;
        
        // Header scroll effect
        function updateHeader() {
            if ($(window).scrollTop() > scrollThreshold) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
        }
        
        // Initial check
        updateHeader();
        
        // On scroll
        $(window).on('scroll', function() {
            updateHeader();
        });
    }
    
    // Mobile Menu
    function initMobileMenu() {
        const toggle = $('.menu-toggle');
        const menu = $('.primary-menu');
        const body = $('body');
        
        toggle.on('click', function() {
            const isActive = $(this).hasClass('active');
            
            if (isActive) {
                $(this).removeClass('active');
                menu.removeClass('active');
                body.removeClass('menu-open');
            } else {
                $(this).addClass('active');
                menu.addClass('active');
                body.addClass('menu-open');
            }
        });
        
        // Close menu on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation').length && menu.hasClass('active')) {
                toggle.removeClass('active');
                menu.removeClass('active');
                body.removeClass('menu-open');
            }
        });
        
        // Close menu on escape key
        $(document).on('keyup', function(e) {
            if (e.keyCode === 27 && menu.hasClass('active')) {
                toggle.removeClass('active');
                menu.removeClass('active');
                body.removeClass('menu-open');
            }
        });
    }
    
    // Smooth Scroll
    function initSmoothScroll() {
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 800, 'swing');
                    return false;
                }
            }
        });
    }
    
    // Scroll Effects
    function initScrollEffects() {
        const elements = $('.fade-in, .slide-up, .slide-in');
        
        function checkVisibility() {
            const windowHeight = $(window).height();
            const scrollTop = $(window).scrollTop();
            
            elements.each(function() {
                const $this = $(this);
                const elementTop = $this.offset().top;
                const elementHeight = $this.outerHeight();
                
                if (scrollTop + windowHeight > elementTop + 50 && scrollTop < elementTop + elementHeight) {
                    $this.addClass('visible');
                }
            });
        }
        
        // Initial check
        checkVisibility();
        
        // On scroll
        $(window).on('scroll', function() {
            checkVisibility();
        });
    }
    
})(jQuery);