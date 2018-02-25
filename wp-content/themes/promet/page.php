<?php
	$settings = Settings::getInstance();
?>

<?php get_header(); ?>
    <?php get_template_part( 'template-parts/regular-page/content-title', get_post_format() ); ?>
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
                <h1>Coś tam coś</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident repellendus praesentium architecto tempora recusandae molestiae ea quas obcaecati quisquam consequatur.</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora deleniti maxime adipisci odit at, quod cumque obcaecati facere nam veniam.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur deleniti maiores provident voluptates cum quae quia culpa, perspiciatis soluta assumenda.</p>
            </div>

            
        </div>
        
    </div>
<?php get_footer(); ?>