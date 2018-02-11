<?php
    $settings = Settings::getInstance();
?>

<header id="headerMobile">
    <div class="container">
        <button class="btn btn-default" id="sidebarToggle" type="button">
            <i class="fas fa-bars"></i>&nbsp;<?php echo 'Menu'; ?>
        </button>
        <img src="<?php echo $settings->getOption('logoGeneral'); ?>" alt="PROMET logo" class="logo pull-right">
    </div>
</header>
