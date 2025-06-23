<?php
/**
 * Front Page Template
 * 
 * @package CorporateHousingDallas
 */

get_header(); ?>

<!-- Hero Section with iOS/Android-inspired gradient -->
<section class="hero-section" style="background: linear-gradient(135deg, #007AFF 0%, #34C759 100%); position: relative; overflow: hidden; min-height: 700px;">
    <div class="hero-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.2);"></div>
    <div class="container" style="position: relative; z-index: 2; padding: 100px 20px;">
        <div class="hero-content" style="text-align: center; color: white; max-width: 800px; margin: 0 auto;">
            <h1 style="font-size: 3.5rem; font-weight: 700; margin-bottom: 1.5rem; animation: fadeInUp 0.8s ease;">
                Premium Corporate Housing & Furnished Apartments in Dallas
            </h1>
            <p style="font-size: 1.5rem; margin-bottom: 2rem; opacity: 0.95; animation: fadeInUp 0.8s ease 0.2s; animation-fill-mode: both;">
                Fully furnished, all-inclusive accommodations with flexible terms. Perfect for business travelers, medical professionals, and relocations.
            </p>
            <div class="hero-cta" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; animation: fadeInUp 0.8s ease 0.4s; animation-fill-mode: both;">
                <a href="#properties" class="btn" style="background: white; color: #007AFF; padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 50px; text-decoration: none; transition: all 0.3s ease;">Browse Properties</a>
                <a href="#lead-form" class="btn" style="background: transparent; color: white; padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border: 2px solid white; border-radius: 50px; text-decoration: none; transition: all 0.3s ease;">Get Quote</a>
            </div>
        </div>
    </div>
    
    <!-- Animated background shapes -->
    <div style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
    <div style="position: absolute; bottom: -150px; left: -150px; width: 400px; height: 400px; background: rgba(255,255,255,0.05); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>
</section>

<!-- Trust Bar -->
<section class="trust-bar" style="background: #f8f9fa; padding: 30px 0; border-bottom: 1px solid #e9ecef;">
    <div class="container">
        <div style="display: flex; justify-content: space-around; align-items: center; flex-wrap: wrap; gap: 2rem;">
            <div style="text-align: center;">
                <div style="font-size: 2.5rem; font-weight: 700; color: #007AFF;">1,500+</div>
                <div style="color: #6c757d;">Properties Available</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2.5rem; font-weight: 700; color: #34C759;">4.8★</div>
                <div style="color: #6c757d;">Average Rating</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2.5rem; font-weight: 700; color: #FF9500;">24/7</div>
                <div style="color: #6c757d;">Support Available</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2.5rem; font-weight: 700; color: #5856D6;">30+</div>
                <div style="color: #6c757d;">Dallas Neighborhoods</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section with Material Design Cards -->
<section class="features-section" style="padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 2.5rem; font-weight: 600; margin-bottom: 1rem;">Why Choose Corporate Housing Travelers?</h2>
            <p style="font-size: 1.25rem; color: #6c757d; max-width: 600px; margin: 0 auto;">Experience the perfect blend of comfort, convenience, and flexibility in Dallas's premier neighborhoods.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <!-- Feature Card 1 -->
            <div class="feature-card" style="background: white; border-radius: 16px; padding: 40px 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; text-align: center;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #007AFF, #0051D5); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">🏠</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 15px;">All-Inclusive Living</h3>
                <p style="color: #6c757d; line-height: 1.6;">One monthly payment covers everything - furniture, utilities, internet, cable TV, and weekly housekeeping services.</p>
            </div>
            
            <!-- Feature Card 2 -->
            <div class="feature-card" style="background: white; border-radius: 16px; padding: 40px 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; text-align: center;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #34C759, #30B351); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">📅</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Flexible Terms</h3>
                <p style="color: #6c757d; line-height: 1.6;">Stay for 30 days or 12 months. Month-to-month options with no long-term commitment required.</p>
            </div>
            
            <!-- Feature Card 3 -->
            <div class="feature-card" style="background: white; border-radius: 16px; padding: 40px 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; text-align: center;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #FF9500, #FF7A00); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">📍</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Prime Locations</h3>
                <p style="color: #6c757d; line-height: 1.6;">Properties in 30+ Dallas neighborhoods near business districts, medical centers, and entertainment.</p>
            </div>
            
            <!-- Feature Card 4 -->
            <div class="feature-card" style="background: white; border-radius: 16px; padding: 40px 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; text-align: center;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #5856D6, #4A48C4); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">🐾</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Pet-Friendly Options</h3>
                <p style="color: #6c757d; line-height: 1.6;">We welcome your furry family members. Many properties offer pet-friendly accommodations.</p>
            </div>
            
            <!-- Feature Card 5 -->
            <div class="feature-card" style="background: white; border-radius: 16px; padding: 40px 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; text-align: center;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #FF3B30, #FF1744); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">🛡️</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 15px;">24/7 Support</h3>
                <p style="color: #6c757d; line-height: 1.6;">Round-the-clock customer service ensures you're never alone when you need assistance.</p>
            </div>
            
            <!-- Feature Card 6 -->
            <div class="feature-card" style="background: white; border-radius: 16px; padding: 40px 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; text-align: center;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #00C7BE, #00A99D); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">✨</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Move-In Ready</h3>
                <p style="color: #6c757d; line-height: 1.6;">Just bring your suitcase. Everything else is ready for your comfortable stay from day one.</p>
            </div>
        </div>
    </div>
</section>

<!-- Property Showcase Section -->
<section id="properties" class="properties-section" style="background: #f8f9fa; padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 2.5rem; font-weight: 600; margin-bottom: 1rem;">Featured Properties in Dallas</h2>
            <p style="font-size: 1.25rem; color: #6c757d; max-width: 600px; margin: 0 auto;">Discover our premium furnished apartments in Dallas's most sought-after neighborhoods.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px;">
            <!-- Property Card 1 -->
            <div class="property-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                <div style="position: relative; height: 250px; background: linear-gradient(45deg, #e0e0e0, #f5f5f5);">
                    <img src="https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Luxury furnished apartment in Uptown Dallas" style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; top: 20px; left: 20px; background: rgba(0,122,255,0.9); color: white; padding: 8px 16px; border-radius: 8px; font-weight: 600;">Uptown Dallas</div>
                </div>
                <div style="padding: 30px;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 10px;">Luxury High-Rise Apartment</h3>
                    <p style="color: #6c757d; margin-bottom: 20px;">Stunning 2-bedroom furnished apartment with skyline views in the heart of Uptown.</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <div style="font-size: 1.5rem; font-weight: 700; color: #007AFF;">$3,500/mo</div>
                            <div style="font-size: 0.9rem; color: #6c757d;">All inclusive</div>
                        </div>
                        <a href="/furnished-apartments-dallas-uptown/" class="btn" style="background: #007AFF; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Property Card 2 -->
            <div class="property-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                <div style="position: relative; height: 250px; background: linear-gradient(45deg, #e0e0e0, #f5f5f5);">
                    <img src="https://images.pexels.com/photos/1571468/pexels-photo-1571468.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Modern furnished apartment Downtown Dallas" style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; top: 20px; left: 20px; background: rgba(52,199,89,0.9); color: white; padding: 8px 16px; border-radius: 8px; font-weight: 600;">Downtown Dallas</div>
                </div>
                <div style="padding: 30px;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 10px;">Modern Downtown Loft</h3>
                    <p style="color: #6c757d; margin-bottom: 20px;">Spacious 1-bedroom loft with exposed brick and city views, walk to offices.</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <div style="font-size: 1.5rem; font-weight: 700; color: #007AFF;">$2,800/mo</div>
                            <div style="font-size: 0.9rem; color: #6c757d;">All inclusive</div>
                        </div>
                        <a href="/furnished-apartments-dallas-downtown/" class="btn" style="background: #007AFF; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Property Card 3 -->
            <div class="property-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                <div style="position: relative; height: 250px; background: linear-gradient(45deg, #e0e0e0, #f5f5f5);">
                    <img src="https://images.pexels.com/photos/271624/pexels-photo-271624.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Corporate housing Medical District Dallas" style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; top: 20px; left: 20px; background: rgba(255,59,48,0.9); color: white; padding: 8px 16px; border-radius: 8px; font-weight: 600;">Medical District</div>
                </div>
                <div style="padding: 30px;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 10px;">Medical District Suite</h3>
                    <p style="color: #6c757d; margin-bottom: 20px;">Convenient studio near UT Southwestern and Parkland, perfect for medical professionals.</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <div style="font-size: 1.5rem; font-weight: 700; color: #007AFF;">$2,500/mo</div>
                            <div style="font-size: 0.9rem; color: #6c757d;">All inclusive</div>
                        </div>
                        <a href="/furnished-apartments-dallas-medical-district/" class="btn" style="background: #007AFF; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 50px;">
            <a href="/furnished-apartments-dallas/" class="btn" style="background: transparent; color: #007AFF; padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border: 2px solid #007AFF; border-radius: 50px; text-decoration: none; transition: all 0.3s ease;">View All Properties</a>
        </div>
    </div>
</section>

<!-- Neighborhoods Section -->
<section class="neighborhoods-section" style="padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 2.5rem; font-weight: 600; margin-bottom: 1rem;">Explore Dallas Neighborhoods</h2>
            <p style="font-size: 1.25rem; color: #6c757d; max-width: 600px; margin: 0 auto;">Find the perfect neighborhood for your lifestyle and needs.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <?php
            $neighborhoods = array(
                'uptown' => array('name' => 'Uptown', 'color' => '#007AFF'),
                'downtown' => array('name' => 'Downtown', 'color' => '#34C759'),
                'medical-district' => array('name' => 'Medical District', 'color' => '#FF3B30'),
                'deep-ellum' => array('name' => 'Deep Ellum', 'color' => '#5856D6'),
                'bishop-arts' => array('name' => 'Bishop Arts', 'color' => '#FF9500'),
                'oak-lawn' => array('name' => 'Oak Lawn', 'color' => '#00C7BE'),
                'knox-henderson' => array('name' => 'Knox-Henderson', 'color' => '#FF2D55'),
                'victory-park' => array('name' => 'Victory Park', 'color' => '#5AC8FA'),
                'design-district' => array('name' => 'Design District', 'color' => '#4CD964'),
                'trinity-groves' => array('name' => 'Trinity Groves', 'color' => '#FFCC00')
            );
            
            foreach ($neighborhoods as $slug => $data): ?>
                <a href="<?php echo home_url('/furnished-apartments-dallas-' . $slug . '/'); ?>" 
                   class="neighborhood-card" 
                   style="background: white; border: 2px solid <?php echo $data['color']; ?>; border-radius: 12px; padding: 25px; text-align: center; text-decoration: none; transition: all 0.3s ease; display: block;">
                    <h4 style="color: <?php echo $data['color']; ?>; font-size: 1.25rem; margin: 0;"><?php echo $data['name']; ?></h4>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section" style="background: #f8f9fa; padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 2.5rem; font-weight: 600; margin-bottom: 1rem;">What Our Residents Say</h2>
            <p style="font-size: 1.25rem; color: #6c757d; max-width: 600px; margin: 0 auto;">Real experiences from real people who've made Dallas their temporary home.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px;">
            <!-- Testimonial 1 -->
            <div style="background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <span style="color: #FFD700;">★★★★★</span>
                </div>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #495057; margin-bottom: 20px;">"The apartment in Uptown was perfect for my 3-month project. Everything was included, and the support team was incredibly responsive. Highly recommend!"</p>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 50px; height: 50px; background: #007AFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">JD</div>
                    <div>
                        <div style="font-weight: 600;">John Davidson</div>
                        <div style="color: #6c757d; font-size: 0.9rem;">Business Consultant</div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div style="background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <span style="color: #FFD700;">★★★★★</span>
                </div>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #495057; margin-bottom: 20px;">"As a travel nurse, finding quality short-term housing is crucial. CHT made it easy with their Medical District location. Clean, comfortable, and convenient!"</p>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 50px; height: 50px; background: #34C759; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">SM</div>
                    <div>
                        <div style="font-weight: 600;">Sarah Mitchell</div>
                        <div style="color: #6c757d; font-size: 0.9rem;">Travel Nurse</div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div style="background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <span style="color: #FFD700;">★★★★★</span>
                </div>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #495057; margin-bottom: 20px;">"Our company uses CHT for all employee relocations to Dallas. The process is seamless, and our team members always have positive experiences."</p>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 50px; height: 50px; background: #FF9500; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">RG</div>
                    <div>
                        <div style="font-weight: 600;">Robert Garcia</div>
                        <div style="color: #6c757d; font-size: 0.9rem;">HR Director</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section" style="padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 2.5rem; font-weight: 600; margin-bottom: 1rem;">Frequently Asked Questions</h2>
            <p style="font-size: 1.25rem; color: #6c757d; max-width: 600px; margin: 0 auto;">Everything you need to know about corporate housing in Dallas.</p>
        </div>
        
        <div style="max-width: 800px; margin: 0 auto;">
            <?php
            $faqs = array(
                array(
                    'question' => 'What is included in the rental price?',
                    'answer' => 'Our all-inclusive pricing covers furniture, all utilities (electricity, water, gas), high-speed internet, cable TV, weekly housekeeping, kitchen essentials, linens, and towels. Just bring your personal items!'
                ),
                array(
                    'question' => 'What is the minimum lease term?',
                    'answer' => 'We offer flexible terms starting from just 30 days. Whether you need housing for a month or a year, we can accommodate your schedule with month-to-month options available.'
                ),
                array(
                    'question' => 'Are pets allowed?',
                    'answer' => 'Yes! Many of our properties are pet-friendly. We understand pets are family. Pet policies and fees vary by property, so please inquire about specific pet-friendly options.'
                ),
                array(
                    'question' => 'How quickly can I move in?',
                    'answer' => 'Most units are move-in ready within 24-48 hours of approval. Our streamlined application process means you can be settled in your new home quickly.'
                ),
                array(
                    'question' => 'Which Dallas neighborhoods do you serve?',
                    'answer' => 'We have properties in 30+ Dallas neighborhoods including Uptown, Downtown, Medical District, Deep Ellum, Bishop Arts, Oak Lawn, Victory Park, and many more.'
                ),
                array(
                    'question' => 'Is parking included?',
                    'answer' => 'Most properties include parking options - either covered parking, garage spaces, or designated spots. Parking details are provided for each specific property.'
                )
            );
            
            foreach ($faqs as $index => $faq): ?>
                <div style="background: white; border-radius: 12px; margin-bottom: 20px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <button onclick="toggleFAQ(<?php echo $index; ?>)" style="width: 100%; padding: 25px 30px; background: white; border: none; text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="font-size: 1.25rem; margin: 0; color: #212529;"><?php echo esc_html($faq['question']); ?></h3>
                        <span id="faq-icon-<?php echo $index; ?>" style="font-size: 1.5rem; color: #007AFF; transition: transform 0.3s ease;">+</span>
                    </button>
                    <div id="faq-answer-<?php echo $index; ?>" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        <div style="padding: 0 30px 25px; color: #6c757d; line-height: 1.8;">
                            <?php echo esc_html($faq['answer']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" style="background: linear-gradient(135deg, #007AFF 0%, #0051D5 100%); padding: 80px 0; position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 2;">
        <div style="text-align: center; color: white; max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: 3rem; font-weight: 600; margin-bottom: 1.5rem;">Ready to Find Your Perfect Dallas Home?</h2>
            <p style="font-size: 1.5rem; margin-bottom: 2.5rem; opacity: 0.95;">Join thousands of satisfied residents who've made Corporate Housing Travelers their home away from home.</p>
            <div id="lead-form" style="background: white; border-radius: 16px; padding: 40px; max-width: 600px; margin: 0 auto; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
                <?php get_template_part('template-parts/lead-form'); ?>
            </div>
        </div>
    </div>
    
    <!-- Background decoration -->
    <div style="position: absolute; top: -200px; right: -200px; width: 400px; height: 400px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -100px; left: -100px; width: 300px; height: 300px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
</section>

<!-- Contact & Map Section -->
<section class="contact-section" style="padding: 80px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div>
                <h2 style="font-size: 2.5rem; font-weight: 600; margin-bottom: 2rem;">Get in Touch</h2>
                <div style="margin-bottom: 30px;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 10px; color: #007AFF;">📍 Service Area</h3>
                    <p style="color: #6c757d; line-height: 1.8;">We serve the entire Dallas-Fort Worth metroplex including Dallas, Plano, Frisco, Irving, Richardson, and 25+ other cities.</p>
                </div>
                <div style="margin-bottom: 30px;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 10px; color: #007AFF;">📞 Contact Us</h3>
                    <p style="color: #6c757d; line-height: 1.8;">
                        Phone: <a href="tel:+12345678900" style="color: #007AFF; text-decoration: none;">(123) 456-7890</a><br>
                        Email: <a href="mailto:info@corporatehousingtravelers.com" style="color: #007AFF; text-decoration: none;">info@corporatehousingtravelers.com</a>
                    </p>
                </div>
                <div style="margin-bottom: 30px;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 10px; color: #007AFF;">🕐 Available 24/7</h3>
                    <p style="color: #6c757d; line-height: 1.8;">Our support team is always ready to assist you, day or night.</p>
                </div>
            </div>
            <div style="background: #f8f9fa; border-radius: 16px; height: 400px; display: flex; align-items: center; justify-content: center;">
                <div style="text-align: center; color: #6c757d;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">🗺️</div>
                    <p>Interactive Map Coming Soon</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0% { transform: translate(0, 0); }
    50% { transform: translate(-20px, -20px); }
    100% { transform: translate(0, 0); }
}

/* Hover Effects */
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.2) !important;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12) !important;
}

.property-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12) !important;
}

.neighborhood-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content h1 { font-size: 2rem !important; }
    .hero-content p { font-size: 1.1rem !important; }
    section { padding: 40px 0 !important; }
    h2 { font-size: 1.8rem !important; }
    .contact-section > div > div { grid-template-columns: 1fr !important; }
}
</style>

<script>
// FAQ Toggle Function
function toggleFAQ(index) {
    const answer = document.getElementById('faq-answer-' + index);
    const icon = document.getElementById('faq-icon-' + index);
    
    if (answer.style.maxHeight && answer.style.maxHeight !== '0px') {
        answer.style.maxHeight = '0';
        icon.style.transform = 'rotate(0deg)';
    } else {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.style.transform = 'rotate(45deg)';
    }
}

// Smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>

<?php
// Add Schema Markup for Homepage
$schema = array(
    '@context' => 'https://schema.org',
    '@graph' => array(
        array(
            '@type' => 'Organization',
            '@id' => home_url() . '#organization',
            'name' => 'Corporate Housing Travelers',
            'url' => home_url(),
            'telephone' => '+1-123-456-7890',
            'email' => 'info@corporatehousingtravelers.com',
            'address' => array(
                '@type' => 'PostalAddress',
                'addressLocality' => 'Dallas',
                'addressRegion' => 'TX',
                'addressCountry' => 'US'
            ),
            'areaServed' => array(
                '@type' => 'GeoCircle',
                'geoMidpoint' => array(
                    '@type' => 'GeoCoordinates',
                    'latitude' => '32.7767',
                    'longitude' => '-96.7970'
                ),
                'geoRadius' => '50000'
            )
        ),
        array(
            '@type' => 'WebSite',
            '@id' => home_url() . '#website',
            'url' => home_url(),
            'name' => 'Corporate Housing Travelers',
            'publisher' => array(
                '@id' => home_url() . '#organization'
            )
        ),
        array(
            '@type' => 'WebPage',
            '@id' => home_url() . '#webpage',
            'url' => home_url(),
            'name' => 'Corporate Housing Dallas | Furnished Apartments & Short-Term Rentals',
            'isPartOf' => array(
                '@id' => home_url() . '#website'
            ),
            'about' => array(
                '@id' => home_url() . '#organization'
            ),
            'description' => 'Premium corporate housing and furnished apartments in Dallas with flexible terms, all-inclusive pricing, and 30+ neighborhood locations.'
        ),
        array(
            '@type' => 'FAQPage',
            'mainEntity' => array_map(function($faq) {
                return array(
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text' => $faq['answer']
                    )
                );
            }, $faqs)
        )
    )
);

echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
?>

<?php get_footer(); ?>