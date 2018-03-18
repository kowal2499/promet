<?php
	$settings = Base\Settings::getInstance();
?>

<section id="slider">
		
    <div class="slick-slider">

        <?php
            $option = $settings->getOption('slideshowPrimary');
            if (empty($option)) {
                $slides = array();
            } else {
                $slides = json_decode(rawurldecode($option), $assoc=true);
            }

            foreach($slides as $slide):
        ?>
                <div class="imgWrapper" style="background-image: url('<?php echo $slide['backgroundImage']; ?>');">
                    <div class="container">
                        <div class="slideContent">
                            <div class="actor">
                                <img src="<?php echo $slide['slideInImage']; ?>" alt="">
                            </div>
                            <div class="dialogue">
                                <h1><?php echo $slide['txt01']; ?></h1>
                                <p class="lead"><?php echo $slide['txt2']; ?></p>
                            </div>
                        </div>
                    </div> 
                </div>
        <?php
            endforeach;
        ?>

    </div>
</section>
