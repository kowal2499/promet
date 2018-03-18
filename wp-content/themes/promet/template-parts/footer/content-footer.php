<?php
    $settings = Base\Settings::getInstance();
?>

<footer id="footer">
    <div class="container">

        <div class="row history">
            <div class="col-sm-3">
                <img src="<?php echo $settings->getOption('logoGeneral'); ?>" class="" alt="PROMET logo">
            </div>

            <div class="col-sm-9">
                <p>Działamy na rynku już od 1990 roku i ipsum dolor sit amet consectetur adipisicing elit. Iste, laudantium accusantium? Aliquam necessitatibus commodi laudantium nostrum quia alias fugiat placeat adipisci vitae recusandae, quos doloribus tempora iusto officiis asperiores assumenda a libero voluptate veniam consectetur non? Modi amet eveniet tenetur in voluptates rerum, a aliquid iusto beatae odio vitae error.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">


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

            <div class="col-sm-4">
                <div class="footer-menu">
                    <h5>Menu</h5>

                    <nav>
                        <?php wp_nav_menu( array(
                            'theme_location' => 'menu-1',
                            'container_class' => 'menuBar'
                        ) ); ?>
                    </nav>
                </div>
            </div>
            
            <div class="col-sm-4">
                <h5>Newsletter</h5>
                <p class="notify">Zapisz się, aby otrzymywać na bieżąco informacje o naszej działaności.</p>

                <div class="form-inline">
                    <div class="form-group">
                        <input type="email" placeholder="Podaj e-mail">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Zapisz się</button>
                    </div>
                </div>

                <br>
                <h5><a href="#">Polityka cookies</a></h5>
                
                
            </div>
        
        </div>
    </div>

    <div class="container-fluid black-footer">
        <p>&copy; <?php echo date("Y"); ?> PROMET</p>
    </div>

</footer>