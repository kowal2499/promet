<?php
    $settings = Settings::getInstance();
?>

<div off-canvas="mobileSidebar left reveal">
	<div class="menu">
		<div class="logo">
			<img src="<?php echo $settings->getOption('logoGeneral'); ?>" alt="PROMET logo">
		</div>
		<nav>
            <?php wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'container_class' => 'menuBar'
            ) ); ?>
        </nav>
	</div>

	<div class="contacts">

		<div class="tile">
			<?php get_template_part( 'template-parts/content-langswitch', get_post_format() ); ?>
		</div>

		<div class="tile">
			<div class="icon">
				<i class="fas fa-phone-volume fa-2x"></i>
			</div>
			<div class="desc">
				<ul>
					<li class="rowTop"><strong><?php echo $settings->getOption('phoneGeneral'); ?></strong></li>
					<li class="rowBottom"><?php echo $settings->getOption('emailGeneral'); ?></li>
				</ul>
			</div>
		</div>

		<div class="tile">
			<div class="icon">
				<i class="fas fa-globe fa-2x"></i>
			</div>
			<div class="desc">
				<ul>
					<li class="rowTop"><strong><?php echo $settings->getOption('addressPostalColde') . ' ' . $settings->getOption('addressCity'); ?></strong></li>
					<li class="rowBottom"><?php echo $settings->getOption('addressStreet'); ?></li>
				</ul>
			</div>
		</div>

		<div class="tile">
			<div class="icon">
				<i class="fas fa-clock fa-2x"></i>
			</div>
			<div class="desc">
				<ul>
					<li class="rowTop"><strong><?php echo $settings->getOption('workingDays'); ?></strong></li>
					<li class="rowBottom"><?php echo $settings->getOption('workingHours'); ?></li>
				</ul>
			</div>
		</div>

	</div>
</div>