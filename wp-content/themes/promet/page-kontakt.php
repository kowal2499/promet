<?php get_header(); ?>
    <?php get_template_part('template-parts/regular-page/content-title', get_post_format()); ?>
    <div class="container">
        <div class="row">
            <?php
                get_template_part('template-parts/contact-page/content-contact', get_post_format());
            ?>
        </div>
    </div>
<?php get_footer(); ?>