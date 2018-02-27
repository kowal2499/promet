<?php
    $settings = Settings::getInstance();
    $products = Products::getInstance()->getProducts();
    

    foreach ($products as $id => $category) {
        echo '<div class="panel panel-default" id="accordion"> ';
        echo '<div class="panel-heading" role="tab" id="heading-' . $id . '">';
        echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $id . '" aria-expanded="true" aria-controls="collapse' . $id . '">';
        echo '<h4 class="panel-title">'.$category['name'].'</h4>';
        echo '</a>';
        echo '</div>';
        // body
        echo '<div id="collapse' . $id . '" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading' . $id . '">';
        echo '<div class="panel-body">';
        echo 'body comes here';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } 

    var_dump($products);
?>

