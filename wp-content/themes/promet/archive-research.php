<?php get_header(); ?>
    <?php get_template_part( 'template-parts/regular-page/content-title', get_post_format() ); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the page content template.
                    get_template_part( 'template-parts/content', 'page' );

                    // End of the loop.
                endwhile;
                ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>