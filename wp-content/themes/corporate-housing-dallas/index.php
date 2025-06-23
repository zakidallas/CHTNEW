<?php
/**
 * Main template file
 * 
 * @package CorporateHousingDallas
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-wrapper">
            <div class="primary-content">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                            </header>
                            
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </article>
                        <?php
                    endwhile;
                else :
                    ?>
                    <article class="no-results">
                        <header class="entry-header">
                            <h1 class="entry-title">Nothing Found</h1>
                        </header>
                        
                        <div class="entry-content">
                            <p>Sorry, but nothing matched your search criteria. Please try again with different keywords.</p>
                        </div>
                    </article>
                    <?php
                endif;
                ?>
            </div>
            
            <aside class="sidebar">
                <?php get_template_part('template-parts/lead-form'); ?>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>