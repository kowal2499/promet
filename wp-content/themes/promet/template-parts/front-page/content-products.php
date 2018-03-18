<?php
    $settings = Base\Settings::getInstance();
    
    $productsData = Base\CPT\Products::getInstance()->getProducts();
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