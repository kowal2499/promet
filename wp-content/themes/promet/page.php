<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<h2>Numer telefonu do nas: <?php echo get_option('phoneNumber01'); ?></h2>

	<table>
		<?php 
			$opt = get_option(slideshow01);
			var_dump(json_decode(urldecode($opt), true));
		?>

	</table>
<?php
	ini_set('xdebug.var_display_max_depth', 5);
	ini_set('xdebug.var_display_max_children', 256);
	ini_set('xdebug.var_display_max_data', 1024);
?>

<?php
	$research = Research::getInstance();
	var_dump($research->getAll());
?>


<?php wp_footer(); ?>
</body>
</html>