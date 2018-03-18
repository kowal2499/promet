<?php
    $settings = Base\Settings::getInstance();
    $productsData = Base\CPT\Products::getInstance()->getProducts();
?>

<section id="archive-products">
    <?php
        foreach ($productsData as $id => $category):
    ?>
        <article>
            <div class="container">
                <div class="menu">
                    <ul>
                        <li class="active"><div class="valign"><div class="valingContent"><?php echo $category['name']; ?></div></div></li>
                    </ul>
                </div><!-- menu -->

                <div class="showcase">
                <?php
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
                ?>
                </div><!-- showcase -->
            </div>
        </article>   

    <?php
        endforeach;
    ?>

</section>