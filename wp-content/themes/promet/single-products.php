<?php
	$settings = Settings::getInstance();
?>

<?php get_header(); ?>
    <?php get_template_part('template-parts/regular-page/content-title', get_post_format()); ?>
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <p>
                <?php
                    var_dump(Products::getInstance()->getProducts());
                ?>
                </p>
            </div>

            <div class="col-md-8">
                <?php get_template_part('template-parts\single\conent-single-product', get_post_format()); ?>
            </div>

            
        </div>
        
    </div>
<?php get_footer(); ?>