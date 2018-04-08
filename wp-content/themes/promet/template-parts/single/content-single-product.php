<?php
            $meta = get_post_meta(get_the_ID());

            if (isset($meta['productsPhotoGallery'][0])) {
                $gallery = unserialize($meta['productsPhotoGallery'][0]);
                $images = [];
                $id = 1;
                foreach ($gallery as $key => $image) {
                    $img = [
                        'id' => $id++,
                        'thumbnail' => wp_get_attachment_image_src($image['productPhoto'], 'thumbnail-products')[0],
                        'full'  =>  wp_get_attachment_image_src($image['productPhoto'], '')[0]
                    ];
                    $images[] = $img;
                }
            }
        ?>

<section id="single-product">

    <div class="row">

       <div class="heading">
            <h2><?php the_title(); ?></h2>
            <p><?php the_excerpt(); ?></p>
        </div>

        <?php if (!empty($images)): ?>
        <div class="row gallery">
            <div class="col-xs-10">
                <div class="scene">
                    <?php foreach ($images as $image): ?>
                    <a href="<?php echo $image['full']; ?>">
                        <img src="<?php echo $image['full']; ?>" data-id="<?php echo $image['id']; ?>">
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-xs-2">
                <div class="thumbnails">
                    <?php foreach ($images as $image): ?>
                        <div class="tile">
                        <img src="<?php echo $image['thumbnail']; ?>">
                        <div class="blend" data-id="<?php echo $image['id']; ?>"></div>
                        </div>
                        
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="well">
                    <?php the_content(); ?> 
                </div>
            </div>
        </div>

    </div>
</section>
