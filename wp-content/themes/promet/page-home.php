<?php get_header(); ?>

	<?php get_template_part( 'template-parts/front-page/content-slider', get_post_format() ); ?>

	<?php get_template_part( 'template-parts/front-page/content-products', get_post_format() ); ?>

	<?php get_template_part( 'template-parts/front-page/content-section', get_post_format() ); ?>
	
<?php get_footer(); ?>