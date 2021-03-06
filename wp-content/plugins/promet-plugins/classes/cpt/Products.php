<?php
namespace Base\CPT;

include_once(plugin_dir_path(__FILE__) . '../base/InputsManager.php');
class Products extends CustomPost
{
    private static $instance;

    protected function __construct()
    {
        $this->name = 'products';

        $this->names = array(
            'name'              => __('Produkty', 'promet-plugins'),
            'singular_name'     => 'Produkt',
            'add_new'           => 'Dodaj nowy produkt',
            'all_items'         => 'Wszystkie produkty'
        );

        $this->args = array(
            'public'            => true,
            'has_archive'       => true,
            'rewrite'           => array('slug' => 'produkty'),
            'supports'          => array('title', 'editor', 'excerpt', 'thumbnail', 'custom_fields'),
            'menu_position'     => 5,
            'taxonomies'        => array('category')
        );

        $this->metaboxes = array(
            array(
                'name' =>  'Obrazki',
                'manager' => new \Base\InputsManager(plugin_dir_path(__DIR__)
                    . '../conf/inputs_products.json')
            )
        );

        parent::__construct();
    }

    /**
     *  Zwraca kategorie
     */
    public function promet_categories_shortcode() {

        // policz jakie mamy kategorie w produktach
        $products = $this->getProducts();
        $categories = array();
        $images = array(104, 105, 106);

        foreach ($products as $product) {
            $id = $product['ID'];

            $name = get_the_category($id)[0]->name;
            if (empty($name)) continue;

            if (in_array($name, array_keys($categories))) {
                $categories[$name]["count"] += 1;
            } else {
                $categories[$name] = array("count" => 1, "name" => $name);
            }
        }

        // narysuj jako karuzelę

        echo "<div class=\"owl-carousel\" id=\"owl-categories\">";
        foreach($categories as $name => $value) {
            $imgId = array_shift($images);
            array_push($images, $imgId);

            echo "<div class=\"carousel-item\">";
            echo "<a href=\"" . get_post_type_archive_link("products") . "#" . str_replace(' ', '_', $name) . "\">";
            echo "<h3>".$name."</h3>";
            echo wp_get_attachment_image( $imgId, array('700', '600'), "", array( "class" => "img-responsive" ) );
            echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    }

    /**
     * Zwraca produkty
     */

    public function promet_products_shortcode() {
        $products = $this->getProducts();

        // narysuj jako karuzelę

        echo "<div class=\"owl-carousel\" id=\"owl-products\">";
        foreach($products as $product) {

            $id = $product['ID'];
            echo "<div class=\"carousel-item\">";
            echo "<h3 style='min-height: 60px; text-align: center'>".get_the_title($id)."</h3>";
            echo "<a href=\"" . get_post_permalink($id) . "\">";
            echo get_the_post_thumbnail($id, array('300', '200'), "");
            echo "<p>".get_the_excerpt($id)."</p>";
            echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    }

    /**
     * Zwraca załączniki z produktów w formie listy
     */

    public function promet_products_attachment_shortcode() {
        $products = $this->getProducts();

        if (empty($products)) return;

        echo "<ul>";
        foreach ($products as $product) {
            $id = $product['ID'];
            $v = get_post_meta($id, 'promet_products_specification', true);
            if (!empty($v)) {
                echo "<li>".get_the_post_thumbnail($id, array('75', '50')).get_the_title($id)."<a href='#' class='button' style='margin-left: 20px;'>Specyfikacja techniczna</a></li>";
            }
        }
        echo "</ul>";
    }

    /**
     * Zwraca tabelę wszystkich produktów posortowaną rosnąco wg kategorii
     */

    public function getProducts() {
        // generowanie listy produktów
        $productData = [];
        $custom_query = new \WP_Query(array(
            'post_type' => $this->name
        ));
        while($custom_query->have_posts()) : $custom_query->the_post(); 
            
            // category
            $category = get_the_category();
            $category_id = (isset($category[0]) && !empty($category[0])) ? ($category[0]->cat_ID) : 0;

            // photoMain
            $photoMain = get_post_meta(get_the_ID(), 'photoMain');
            $photoMain = (isset($photoMain[0]) && !empty($photoMain[0])) ? $photoMain[0] : '';

            $productsData[$category_id][$this->name][get_the_ID()] = array(
                'title' => get_the_title(),
                'link'  => get_the_permalink(),
                'photoMain' => wp_get_attachment_image_src($photoMain, '')[0],
                'excerpt'   => get_the_excerpt(),
                'thumbnail' => wp_get_attachment_image_src($photoMain, 'thumbnail-products')[0],
            );
            $productsData[$category_id]['name'] = (isset($category[0]) && !empty($category[0])) ? ($category[0]->cat_name) : 0;;
        endwhile;
        wp_reset_postdata();
        
        // posortuj proszę

        ksort($productsData); // kategorie
        foreach ($productsData as $id => $category) {
            ksort($productsData[$id]['products']); // produkty
        }

        return $productsData;
    }

    /**
     * Zwraca dane pojedyńczego produktu
     */
    public function getSingle($id) {

        $custom_query = new WP_Query(array(
            'post_type' => $this->name
        ));

    }
    
    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}