<?php
    $settings = Settings::getInstance();
    
    // generowanie listy produktów
    $productData = [];
    $custom_query = new WP_Query(array(
        'post_type' => 'products'
    ));
    while($custom_query->have_posts()) : $custom_query->the_post(); 
        
        // category
        $category = get_the_category();
        $category_id = (isset($category[0]) && !empty($category[0])) ? ($category[0]->cat_ID) : 0;

        // photoMain
        $photoMain = get_post_meta(get_the_ID(), 'photoMain');
        $photoMain = (isset($photoMain[0]) && !empty($photoMain[0])) ? $photoMain[0] : '';

        $productsData[$category_id]['products'][get_the_ID()] = array(
            'title' => get_the_title(),
            'link'  => get_the_permalink(),
            'photoMain' => $photoMain,
            'excerpt'   => get_the_excerpt()
        );
        $productsData[$category_id]['name'] = (isset($category[0]) && !empty($category[0])) ? ($category[0]->cat_name) : 0;;
    endwhile;
    wp_reset_postdata();
    
    // posortuj proszę
    ksort($productsData);
?>

<section id="home-products">

    <div class="container">
        <div class="menu">
            <ul>
                <?php
                    $active = '';
                    foreach ($productsData as $cat_id => $category) {
                        echo '<li class="' . $active. '" data-category="' . $cat_id . '"><div class="valign"><div class="valingContent">' . $category['name'] . '</div></div></li>';
                        $active = '';
                    }
                ?>
            </ul>
        </div><!-- menu -->

        <div class="showcase">
        <?php
            foreach ($productsData as $cat_id => $category):
                foreach ($category['products'] as $product):
                    echo '<div class="specimen" data-category="'. $cat_id .'">';
                    echo '<a href="'. $product['link'] .'">';
                    echo '<div class="wrapper"><img src="'. $product['photoMain'] .'">';
                    echo '<div class="courtain">';
                    echo '<div class="valign"><div class="valingContent">';
                    echo $product['excerpt'];
                    echo '</div></div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<hr>';
                    echo '<h3>'. $product[title] .'</h3>';
                    echo '</a>';
                    echo '</div>';
                endforeach;
            endforeach;
        ?>
        </div><!-- showcase -->

    <div>
</section>