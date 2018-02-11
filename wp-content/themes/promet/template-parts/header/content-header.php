<?php
    $settings = Settings::getInstance();
?>
<header id="header">
    <div class="container">

        <div class="infoBar">
            <div class="sideLeft">
                <div class="tile">
                    <img src="<?php echo $settings->getOption('logoGeneral'); ?>" alt="PROMET logo">	
                </div>
            </div>

            <div class="sideRight">

                <div class="tile">
                    <div class="icon">
                        <div class="valign">
                            <div class="valingContent">
                                <i class="fas fa-phone-volume fa-1x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="desc">
                        <div class="valign">
                            <div class="valingContent">
                                <div class="rowTop"><strong><?php echo $settings->getOption('phoneGeneral'); ?></strong></div>
                                <div class="rowBottom"><?php echo $settings->getOption('emailGeneral'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tile">
                    <div class="icon">
                        <div class="valign">
                            <div class="valingContent">
                                <i class="fas fa-globe fa-1x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="desc">
                        <div class="valign">
                            <div class="valingContent">
                                <div class="rowTop"><strong><?php echo $settings->getOption('addressPostalColde') . ' ' . $settings->getOption('addressCity'); ?></strong></div>
                                <div class="rowBottom"><?php echo $settings->getOption('addressStreet'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tile">
                    <div class="icon">
                        <div class="valign">
                            <div class="valingContent">
                                <i class="fas fa-clock fa-1x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="desc">
                        <div class="valign">
                            <div class="valingContent">
                                <div class="rowTop"><strong><?php echo $settings->getOption('workingDays'); ?></strong></div>
                                <div class="rowBottom"><?php echo $settings->getOption('workingHours'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tile">
                    <div class="desc">
                        <div class="valign">
                            <div class="valingContent">
                                <?php get_template_part( 'template-parts/content-langswitch', get_post_format() ); ?> 
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        
        <nav>
            <?php wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'container_class' => 'menuBar'
            ) ); ?>
        </nav>

    </div>
</header>
