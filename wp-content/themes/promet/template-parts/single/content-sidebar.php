<?php
    $settings = Base\Settings::getInstance();
    $products = Base\CPT\Products::getInstance()->getProducts();
    $this_product = get_the_ID();
?>

<aside>

<?php
    foreach ($products as $id => $category) {

        $collapse = in_array($this_product, array_keys($category['products'])) ? 'in' : '';
        echo '<div class="panel" id="accordion">';
        echo '<div class="panel-heading" role="tab" id="heading-' . $id . '">';
        echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $id . '" aria-expanded="true" aria-controls="collapse' . $id . '"' . ($collapse == '' ? 'class="collapsed"' : '') . '>';
        echo '<h4 class="panel-title">'.$category['name'].'</h4>';
        echo '</a>';
        echo '</div>';
        // body
        echo '<div id="collapse' . $id . '" class="panel-collapse collapse ' . $collapse  . '" role="tabpanel" aria-labelledby="heading' . $id . '">';
        echo '<div class="panel-body">';

        echo '<ul>';
        foreach ($category['products'] as $id => $product) {
            echo '<li>';
            echo '<a href="' . $product['link'] . '">';
            echo '<img src="' . $product['thumbnail'] . '">';
            echo '<h5>' . $product['title'] . '</h5>';
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } 

?>

</aside>