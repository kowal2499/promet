<!doctype html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div canvas="container">
            <?php get_template_part( 'template-parts/content-header', get_post_format() ); ?>
            <?php get_template_part( 'template-parts/content-header_mobile', get_post_format() ); ?>