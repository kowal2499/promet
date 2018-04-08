<?php
    $settings = Base\Settings::getInstance();
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
                <label for="contact[name]">Imię & Nazwisko</label>
                <input type="text" class="form-control required" placeholder="Podaj imię i nazwisko" name="contact[name]">
            </div>

            <div class="form-group col-sm-6">
                <label for="contact[email]">Email</label>
                <input type="text" class="form-control required" placeholder="Podaj email" name="contact[email]">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-12">
                <label for="contact[nip]">NIP</label>
                <input type="text" class="form-control required" placeholder="NIP Twojej firmy" name="contact[nip]">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-12">
                <label for="contact[subject]">Temat wiadomości</label>
                <input type="text" class="form-control required" placeholder="Temat" name="contact[subject]">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-12">
                <label for="contact[body]">Treść wiadomości</label>
                <textarea type="text" rows="5" class="form-control required" placeholder="Treść" name="contact[body]"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <button class="btn btn-primary" name="contact[submit]">Wyślij wiadomość</button>
            </div>
            <div class="form-group col-md-8">
                <div class="notify-area"></div>
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