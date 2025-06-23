<?php
/**
 * Template Name: Landing Page
 * 
 * @package CorporateHousingDallas
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="hero-section" style="background: linear-gradient(135deg, #0066CC 0%, #34C759 100%); color: white; padding: 80px 0;">
        <div class="container">
            <h1 style="font-size: 3rem; margin-bottom: 1rem;">Corporate Housing & Furnished Apartments in Dallas</h1>
            <p style="font-size: 1.25rem; margin-bottom: 2rem;">Premium furnished accommodations with flexible terms throughout the Dallas-Fort Worth metroplex</p>
            <a href="#lead-form" class="btn btn-secondary">Get Your Quote</a>
        </div>
    </div>
    
    <div class="container">
        <div class="content-section">
            <h2>Why Choose Corporate Housing Travelers?</h2>
            <div class="features-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin: 2rem 0;">
                <div class="feature-card card">
                    <h3>All-Inclusive Pricing</h3>
                    <p>One monthly payment covers everything - rent, furniture, utilities, internet, and housekeeping.</p>
                </div>
                <div class="feature-card card">
                    <h3>Flexible Terms</h3>
                    <p>Stay for 30 days or 12 months. Month-to-month options available with no long-term commitment.</p>
                </div>
                <div class="feature-card card">
                    <h3>Prime Locations</h3>
                    <p>Properties in 30+ Dallas neighborhoods including Uptown, Downtown, Medical District, and more.</p>
                </div>
                <div class="feature-card card">
                    <h3>Pet-Friendly Options</h3>
                    <p>We understand pets are family. Many of our properties welcome your furry friends.</p>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2>Popular Dallas Neighborhoods</h2>
            <div class="neighborhood-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <?php
                $neighborhoods = array(
                    'uptown' => 'Uptown',
                    'downtown' => 'Downtown',
                    'medical-district' => 'Medical District',
                    'deep-ellum' => 'Deep Ellum',
                    'bishop-arts' => 'Bishop Arts',
                    'oak-lawn' => 'Oak Lawn'
                );
                
                foreach ($neighborhoods as $slug => $name) {
                    echo '<a href="' . home_url('/furnished-apartments-dallas-' . $slug . '/') . '" class="neighborhood-link card">';
                    echo '<h4>' . $name . '</h4>';
                    echo '</a>';
                }
                ?>
            </div>
        </div>
        
        <div class="content-section">
            <h2>Our Services</h2>
            <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div class="service-item">
                    <h3>Corporate Housing</h3>
                    <p>Ideal for business travelers and corporate relocations with all business amenities.</p>
                </div>
                <div class="service-item">
                    <h3>Medical Stay Housing</h3>
                    <p>Convenient accommodations near Dallas medical facilities for patients and professionals.</p>
                </div>
                <div class="service-item">
                    <h3>Insurance Housing</h3>
                    <p>Temporary housing solutions for insurance claims and displaced families.</p>
                </div>
                <div class="service-item">
                    <h3>Executive Rentals</h3>
                    <p>Luxury furnished apartments for executives and VIP guests.</p>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <div class="lead-form-wrapper" id="lead-form">
                <?php get_template_part('template-parts/lead-form'); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>