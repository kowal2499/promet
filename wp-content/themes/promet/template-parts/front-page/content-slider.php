<?php
	$settings = Settings::getInstance();
?>

<section id="slider">
		
    <div class="owl-carousel">

        <?php 
            foreach($settings->getOption('slideshowPrimary') as $slide):
        ?>
                <div class="imgWrapper" style="background-image: url('<?php echo $slide['backgroundImage']; ?>');">
                    <div class="container">
                        <div class="slideContent left">
                            <h1><?php echo $slide['txt01']; ?></h1>
                            <p class="lead"><?php echo $slide['txt2']; ?></p>
                        </div>
                    </div> 
                </div>
        <?php
            endforeach;
        ?>

    </div>
</section>
