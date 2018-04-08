<?php
    $settings = Base\Settings::getInstance();
?>

<section id="slider">
    
    <div class="container custom-nav-wrapper">
            <div class='custom-nav'></div>
        </div>

    <div class="slick-slider">
        <?php
            $slides = $settings->getOption('slider2');

            $slides = [
                [
                    'background' => 143,
                    'actor' => '',
                    'txtDesc01' => 'Trwałe i funkcjonalne pojemniki do betonu',
                    'txtDesc02' => 'sobet dolar amet...'
                ],
                [
                    'background' => 144,
                    'actor' => '',
                    'txtDesc01' => 'Zaprojektowane przez fachowców i dla fachowców',
                    'txtDesc02' => 'sobet dolar amet...'
                ],
                [
                    'background' => 142,
                    'actor' => '',
                    'txtDesc01' => 'Pojemne zbiorniki na gruz i inne materiały',
                    'txtDesc02' => 'sobet dolar amet...'
                ],
                [
                    'background' => 145,
                    'actor' => '',
                    'txtDesc01' => 'Sprawdzone rozwiązania i lata doświadczeń',
                    'txtDesc02' => 'sobet dolar amet...'
                ],
                [
                    'background' => 146,
                    'actor' => '',
                    'txtDesc01' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    'txtDesc02' => 'sobet dolar amet...'
                ]
            ];
            foreach($slides as $slide):

                $background = wp_get_attachment_image_src($slide['background'], 'full');
                $actor = wp_get_attachment_image_src($slide['actor'], 'full');
        ?>
                <div class="imgWrapper" style="background-image: url('<?php echo empty($background) ? '' : $background[0]; ?>');">
                    <div class="container">
                        <div class="slideContent">
                            <!-- div class="actor"></div> -->
                            <div class="dialogue">
                                <h1><?php echo $slide['txtDesc01']; ?></h1>
                                <!-- <p class="lead"><?php // echo $slide['txtDesc02']; ?></p> -->
                            </div>
                        </div>
                    </div> 
                </div>
        <?php
            endforeach;
        ?>

    </div>
    
    
</section>
