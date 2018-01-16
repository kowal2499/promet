<?php
include_once( plugin_dir_path( __FILE__ ) . 'custom_post_type.php');
include_once( plugin_dir_path( __FILE__ ) . 'widget_setup.php');

class Promet_Products_Widget extends WP_Widget {

    function __construct() {
		parent::__construct('promet_products_widget', 'Promet Products', array(
			'description' => 'Widget pokazuje produkty firmy'
        ));

        Widget_Setup::getInstance()
            ->enqueue_style('bootstrap', plugins_url('/promet-plugins/public/css/bootstrap.min.css'))
            ->enqueue_style('owl.carousel.base', plugins_url('/promet-plugins/public/css/owl.carousel.min.css'))
            ->enqueue_style('css.custom', plugins_url('/promet-plugins/public/css/custom.css'))
            ->enqueue_script('owl.carousel.js', plugins_url('/promet-plugins/public/js/owl.carousel.min.js'), 'jQuery', '1.0.0', true)
            ->enqueue_script('core.js', plugins_url('/promet-plugins/public/js/main.js'), 'jQuery', '1.0.0', true)
            // ->debug();
            ->add_actions();

  /*      new Widget_Setup(
            __CLASS__,
            $admin_styles,
            $admin_scripts,
            $front_styles,
            $front_scripts,
            array(
                // array("name" => "promet_product_categories", "function" => array($this, 'promet_categories_shortcode')),
                // array("name" => "promet_products", "function" => array($this, 'promet_products_shortcode')),
                // array("name" => "promet_products_attachments", "function" => array($this, 'promet_products_attachment_shortcode')),
                // array("name" => "promet_echo", "function" => array($this, 'promet_echo'))
            )
        );
*/
        $cpt = new Custom_Post_Type(
                'research',
                array(
                    'name'              => __('Badania i Rozwój'),
                    'singular_name'     => 'Element \'Badania i Rozwój\'',
                    'add_new'           => 'Dodaj nowy element B&R',
                    'add_new_item'      => 'Dodaj nowy element B&R',
                    'all_items'         => 'Wszystkie elementy B&R'
                ),
                array(
                    'public'            => true,
                    'has_archive'       => true,
                    'rewrite'           => array('slug' => 'badania'),
                    'supports'          => array('title', 'editor', 'excerpt', 'thumbnail', 'custom_fields'),
                    'menu_position'     => 6
                ),
                array(
                    array(
                        "name"      => "Promet Research Images",
                        "fields"    => array(
                                            'image01' => 'text',
                                            'image02' => 'text',
                                            'image03' => 'text'
                                        )
                    )
                )
        );

        $cpt2 = new Custom_Post_Type(
                'products',
                array(
                    'name'              => __('Produkty'),
                    'singular_name'     => 'Produkt',
                    'add_new'           => 'Dodaj nowy produkt',
                    'all_items'         => 'Wszystkie produkty'
                ),
                array(
                    'public'            => true,
                    'has_archive'       => true,
                    'rewrite'           => array('slug' => 'produkty'),
                    'supports'          => array('title', 'editor', 'excerpt', 'thumbnail', 'custom_fields'),
                    'menu_position'     => 5,
                    'taxonomies'        => array('category')
                ),
                array (
                    array (
                        "name"          => "Promet Products",
                        "fields"        => array(
                                                'image01' => 'text',
                                                'image02' => 'text',
                                                'image03' => 'text',
                                                'specification' => 'text'
                                            )
                    )
                )
        );

    }
    /**
     *  Zwraca tablicę produktów
     */
    public function getProducts(): array {
        $products = array();

        $loop = new WP_Query( array( 'post_type' => 'products', 'posts_per_page' => -1 ) );
        while ($loop->have_posts()): $loop->the_post();
            $products[] = get_post(null, ARRAY_A);
        endwhile;
        wp_reset_query();

        return $products;
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
            echo get_the_post_thumbnail($id, array('300', '200'), "" );
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

    public function promet_echo() {
        echo "Hello, I am just to do some echo here";
    }

    function widget($args, $instance) {
        echo $args['before_widget'];
		$title = apply_filters('widget_title', $instance['title'] ?? '');
        echo $args['before_title'] . $title . $args['after_title'];
        promet_products_widget_content();
		echo $args['after_widget'];
    }

    function form($instance) {
        $defaults = array(
			'title' => 'Produkty'
        );
        $instance = wp_parse_args((array)$instance, $defaults);
        ?>
             <p>
               <label for="title">Tytuł</label>
               <input type="text" id="<?php
                     echo $this->get_field_id('title'); ?>" name="<?php
                     echo $this->get_field_name('title'); ?>" value="<?php
                     echo $instance['title']; ?>"/>
             </p>
         <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
    }
}

// globals

function promet_products_load_widget() {
	register_widget('promet_products_widget');
}

add_action('widgets_init', 'promet_products_load_widget');