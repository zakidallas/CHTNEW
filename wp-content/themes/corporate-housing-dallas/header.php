<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="theme-color" content="#007AFF">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.pexels.com">
    
    <!-- Modern Font Stack -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
    
    <header id="masthead" class="site-header modern-header">
        <div class="header-glass-effect">
            <div class="header-wrapper container">
                <div class="site-branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                        <svg width="32" height="32" viewBox="0 0 32 32" class="logo-icon">
                            <rect x="4" y="8" width="10" height="16" rx="2" fill="#007AFF"/>
                            <rect x="18" y="4" width="10" height="20" rx="2" fill="#5856D6"/>
                            <circle cx="21" cy="21" r="3" fill="#FF2D55"/>
                        </svg>
                        <span class="logo-text">
                            <span class="logo-primary">Corporate Housing</span>
                            <span class="logo-secondary">Dallas</span>
                        </span>
                    </a>
                </div>
                
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle modern-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-bar"></span>
                        <span class="menu-bar"></span>
                        <span class="menu-bar"></span>
                    </button>
                    
                    <ul class="primary-menu modern-menu">
                        <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas/')); ?>" class="menu-link">
                            <span class="menu-text">Furnished Apartments</span>
                        </a></li>
                        <li><a href="<?php echo esc_url(home_url('/corporate-housing-dallas/')); ?>" class="menu-link">
                            <span class="menu-text">Corporate Housing</span>
                        </a></li>
                        <li class="menu-item-has-children">
                            <a href="#" class="menu-link">
                                <span class="menu-text">Neighborhoods</span>
                                <svg class="menu-arrow" width="12" height="8" viewBox="0 0 12 8">
                                    <path d="M6 8L0 0h12z" fill="currentColor"/>
                                </svg>
                            </a>
                            <ul class="sub-menu modern-dropdown">
                                <li><a href="<?php echo esc_url(home_url('/neighborhood/uptown')); ?>">Uptown</a></li>
                                <li><a href="<?php echo esc_url(home_url('/neighborhood/downtown')); ?>">Downtown</a></li>
                                <li><a href="<?php echo esc_url(home_url('/neighborhood/medical-district')); ?>">Medical District</a></li>
                                <li><a href="<?php echo esc_url(home_url('/neighborhood/deep-ellum')); ?>">Deep Ellum</a></li>
                                <li><a href="<?php echo esc_url(home_url('/neighborhood/bishop-arts')); ?>">Bishop Arts</a></li>
                                <li><a href="<?php echo esc_url(home_url('/neighborhoods')); ?>" class="view-all">View All Neighborhoods →</a></li>
                            </ul>
                        </li>
                        <li><a href="#contact" class="menu-link">
                            <span class="menu-text">Contact</span>
                        </a></li>
                        <li class="menu-cta">
                            <a href="tel:+12144567890" class="btn btn-primary btn-small">
                                <svg width="16" height="16" viewBox="0 0 16 16" class="phone-icon">
                                    <path fill="currentColor" d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                                (214) 456-7890
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>