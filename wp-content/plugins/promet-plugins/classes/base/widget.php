<?php

class Promet_Products_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('promet_products_widget', 'Promet Products', array(
            'description' => 'Widget pokazuje produkty firmy',
        ));

        Widget_Setup::getInstance()
            ->enqueue_style('bootstrap', plugins_url('/promet-plugins/public/css/vendor/bootstrap.min.css'))
            ->enqueue_style('owl.carousel.base', plugins_url('/promet-plugins/public/css/vendor/slick.css'))
            ->enqueue_style('owl.carousel.theme', plugins_url('/promet-plugins/public/css/vendor/slick-theme.css'))

            ->enqueue_style('owl.carousel.base', plugins_url('/promet-plugins/public/css/vendor/owl.carousel.min.css'))
            ->enqueue_style('owl.carousel.theme', plugins_url('/promet-plugins/public/css/vendor/owl.theme.default.min.css'))
            ->enqueue_style('slidebars', plugins_url('/promet-plugins/public/css/vendor/slidebars.min.css'))
            ->enqueue_style('simplelightbox', plugins_url('/promet-plugins/public/css/vendor/simplelightbox.min.css'))

            ->enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700,900&amp;subset=latin-ext')

            ->enqueue_style('fontawsome', plugins_url('/promet-plugins/public/css/vendor/fontawesome-all.css'))
            ->enqueue_style('animate', plugins_url('/promet-plugins/public/css/vendor/animate.css'))

            ->enqueue_style('css.custom', plugins_url('/promet-plugins/public/css/custom.css'))
            ->enqueue_style_admin('css.custom.admin', plugins_url('/promet-plugins/admin/css/custom.css'))

            ->enqueue_script('jQuery3', plugins_url('/promet-plugins/public/js/vendor/jquery-3.3.1.min.js'), '', '1.0.0', true)
            ->enqueue_script('owl.carousel', plugins_url('/promet-plugins/public/js/vendor/slick.min.js'), 'jQuery3', '1.0.0', true)
            ->enqueue_script('owl.carousel', plugins_url('/promet-plugins/public/js/vendor/owl.carousel.min.js'), 'jQuery3', '1.0.0', true)
            ->enqueue_script('bootstrap', plugins_url('/promet-plugins/public/js/vendor/bootstrap.min.js'), 'jQuery3', '1.0.0', true)
            ->enqueue_script('slidebars', plugins_url('/promet-plugins/public/js/vendor/slidebars.min.js'), 'jQuery3', '1.0.0', true)
            ->enqueue_script('simplelightbox', plugins_url('/promet-plugins/public/js/vendor/simple-lightbox.min.js'), 'jQuery3', '1.0.0', true)

            ->enqueue_script('app.01.init', plugins_url('/promet-plugins/public/js/app.01.init.js'), 'jQuery3', '1.0.0', true)
            ->enqueue_script('app.02.slider', plugins_url('/promet-plugins/public/js/app.02.slider.js'), 'jQuery3', '1.0.0', true)
            ->enqueue_script('app.04.forms', plugins_url('/promet-plugins/public/js/app.04.forms.js'), 'jQuery3', '1.0.0', true, [
                'name' => 'app04',
                'data' => [
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'sendingMessage' => __('Trwa wysyłanie wiadomości', 'promet-plugins'),
                    'successMessage' => __('Wiadomość została pomyślnie wysłana', 'promet-plugins'),
                    'errorMessage' => __('Nie udało się wysłać wiadomości', 'promet-plugins'),
                ]
            ])
            ->enqueue_script('app.03.others', plugins_url('/promet-plugins/public/js/app.03.others.js'), 'jQuery3', '1.0.0', true)

            ->enqueue_script_admin('core-admin.js', plugins_url('/promet-plugins/public/js/admin.js'), 'jQuery', '1.0', true)
            ->enqueue_script_admin('inputs-admin.js', plugins_url('/promet-plugins/admin/js/inputs.js'), 'jQuery', '1.0', true)
            ->enqueue_script_admin('inputs2-admin.js', plugins_url('/promet-plugins/admin/js/inputs2.js'), 'jQuery', '1.0', true)
            ->add_actions();

        // mailer object
        $this->mailer = new Ajax\Mailer();
        add_action('wp_ajax_nopriv_send_contact_message', array( $this->mailer, 'send_contact_message'));
        add_action('wp_ajax_send_contact_message', array($this->mailer, 'send_contact_message'));

        // rozmiar ikonek w galerii produktu
        add_image_size('thumbnail-products', 120, 120, array('center', 'center'));

        // add custom posts
        $products = Base\CPT\Products::getInstance();
        $research = Base\CPT\Research::getInstance();

        // add settings in admin area
        $settings = Base\Settings::getInstance();
    }
}

// globals

function promet_products_load_widget()
{
    register_widget('promet_products_widget');
}

add_action('widgets_init', 'promet_products_load_widget');

