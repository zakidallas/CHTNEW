<?php
/**
 * Page template
 * 
 * @package CorporateHousingDallas
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-wrapper">
            <div class="primary-content">
                <?php
                while (have_posts()) : the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header>
                        
                        <div class="entry-content">
                            <?php 
                            the_content();
                            
                            // Add FAQs if this is a virtual page
                            global $cht_page_data;
                            if (!empty($cht_page_data['faqs'])) {
                                echo '<div class="faq-section">';
                                echo '<h2>Frequently Asked Questions</h2>';
                                
                                foreach ($cht_page_data['faqs'] as $faq) {
                                    echo '<div class="faq-item">';
                                    echo '<h3 class="faq-question">' . esc_html($faq['question']) . '</h3>';
                                    echo '<div class="faq-answer">' . esc_html($faq['answer']) . '</div>';
                                    echo '</div>';
                                }
                                
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>
            
            <aside class="sidebar">
                <?php get_template_part('template-parts/lead-form'); ?>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>