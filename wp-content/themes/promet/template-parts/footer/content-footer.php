<?php
    $settings = Settings::getInstance();
?>

<footer id="footer">
    <div class="container">

        <div class="row history">
            <div class="col-md-3">
                <img src="<?php echo $settings->getOption('logoGeneral'); ?>" class="img-responsive" alt="PROMET logo">
            </div>

            <div class="col-md-9">
                <p>Działamy na rynku już od 1990 roku i ipsum dolor sit amet consectetur adipisicing elit. Iste, laudantium accusantium? Aliquam necessitatibus commodi laudantium nostrum quia alias fugiat placeat adipisci vitae recusandae, quos doloribus tempora iusto officiis asperiores assumenda a libero voluptate veniam consectetur non? Modi amet eveniet tenetur in voluptates rerum, a aliquid iusto beatae odio vitae error.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">


                <h5>Kontakt</h5>
                
                <div class="tile">
                    <div class="icon">
                        <div class="valign">
                            <div class="valingContent">
                                <i class="fas fa-phone-volume"></i>
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

            </div>


            <div class="col-md-4">
                <h5>Menu</h5>

                    <nav>
                        <?php wp_nav_menu( array(
                            'theme_location' => 'menu-1',
                            'container_class' => 'menuBar'
                        ) ); ?>
                    </nav>
                
            </div>
            <div class="col-md-4"><h5>Newsletter</h5></div>
        </div>
    </div>
</footer>