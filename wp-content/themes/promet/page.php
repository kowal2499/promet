<?php
	$settings = Settings::getInstance();
?>

<?php get_header(); ?>

	<?php get_template_part( 'template-parts/front-page/content-slider', get_post_format() ); ?>


	<section>
		<heading></heading>
		<article></article>

		<heading></heading>
		<article></article>

		<heading></heading>
		<article></article>
	</section>

	<footer></footer>
<?php get_footer(); ?>