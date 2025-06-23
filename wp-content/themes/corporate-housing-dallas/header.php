<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
    
    <header id="masthead" class="site-header">
        <div class="header-wrapper container">
            <div class="site-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                    Corporate Housing Travelers
                </a>
            </div>
            
            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="menu-icon"></span>
                </button>
                
                <ul class="primary-menu">
                    <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas/')); ?>">Furnished Apartments</a></li>
                    <li><a href="<?php echo esc_url(home_url('/corporate-housing-dallas/')); ?>">Corporate Housing</a></li>
                    <li class="menu-item-has-children">
                        <a href="#">Neighborhoods</a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-uptown/')); ?>">Uptown</a></li>
                            <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-downtown/')); ?>">Downtown</a></li>
                            <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-medical-district/')); ?>">Medical District</a></li>
                            <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-deep-ellum/')); ?>">Deep Ellum</a></li>
                            <li><a href="<?php echo esc_url(home_url('/furnished-apartments-dallas-bishop-arts/')); ?>">Bishop Arts</a></li>
                        </ul>
                    </li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>