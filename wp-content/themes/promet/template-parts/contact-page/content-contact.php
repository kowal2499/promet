<?php
    $settings = Settings::getInstance();
?>
<section id="contact">
<div class="col-md-6">
    <h3>
        <?php echo $settings->getOption('contactFormHeader'); ?>
    </h3>

    <p><?php echo $settings->getOption('contactFormDescription'); ?></p>

    <form action="">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name">Imię & Nazwisko</label>
                <input type="text" class="form-control required name" placeholder="Podaj imię i nazwisko">
            </div>

            <div class="form-group col-sm-6">
                <label for="email">Email</label>
                <input type="text" class="form-control required email" placeholder="Podaj email">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-12">
                <label for="subject">Temat wiadomości</label>
                <input type="text" class="form-control required subject" placeholder="Temat">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-12">
                <label for="body">Treść wiadomości</label>
                <textarea type="text" rows="5" class="form-control required body" placeholder="Treść"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <button class="btn btn-primary">Wyślij wiadomość</button>
            </div>
        </div>

    </form>
</div>



<div class="col-md-6">
    
    <?php
        $map_data = [
            'apiKey' => $settings->getOption('mapAPIKey'),
            'coordX' => $settings->getOption('mapCoordinateX'),
            'coordY' => $settings->getOption('mapCoordinateY'),
            'zoom' => $settings->getOption('mapZoom')
        ];
    ?>

    <h3>
        <?php echo $settings->getOption('addressDataHeader'); ?>
    </h3>
    <p>
        <strong><?php echo $settings->getOption('addressLegalName'); ?></strong><br>
        <?php echo $settings->getOption('addressStreet'); ?><br>
        <?php echo $settings->getOption('addressPostalColde') . ' ' . $settings->getOption('addressCity'); ?><br><br>
        <?php echo $settings->getOption('addressVoivodeship') . ', ' . $settings->getOption('addressCountry'); ?><br>
        <?php echo 'NIP: ' . $settings->getOption('companyNIP'); ?>
    </p>

    <input type="hidden" id="googleMapData" data-settings="<?php echo urlencode(json_encode($map_data)); ?>">
    <div id="map"></div>

</div>

</section>