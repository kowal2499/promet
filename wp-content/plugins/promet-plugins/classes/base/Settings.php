<?php

// include_once( plugin_dir_path( __FILE__ ) . '../inputs/SlideshowConfig.php');

    class Settings {

        private static $instance;
        private $cache = array();

        private function __construct() {
            
            $this->tabs = array(
                array(
                    'title'         => 'Pokaz slajdów',
                    'url'           => 'pokaz_slajdow',
                    'inputs'        => array(
                        
                        array(
                            'class' => 'Repeatable',
                            'id'    => 'slideshowPrimary',
                            'title' => 'Pokaz slajdów na stronie głównej',
                            'desc'  => 'Jakś tam opis',
                            'recordDefinition' => array(
                                array(
                                    "type"  => "text",
                                    "desc"  => "Tło slajdu. Zalecana rozdzielczość: 1200x400px",
                                    "name"  => "backgroundImage"
                                ),

                                array(
                                    "type"  => "text",
                                    "desc"  => "Aktor obrazek",
                                    "name"  => "slideInImage"
                                ),

                                array(
                                    "type"  => "text",
                                    "desc"  => "Opis główny",
                                    "name"  => "txt01"
                                ),
                                array(
                                    "type"  => "text",
                                    "desc"  => "Opis dodatkowy",
                                    "name"  => "txt2"
                                )
                            )
                        ),

                    )   // end inputs
                ),
                array(
                    'title'         => 'Dane ogólne',
                    'url'           => 'general',
                    'inputs'        => array(
                        array(
                            'class' => 'TextInput',
                            'id'    => 'logoGeneral',
                            'title' => 'Logo',
                            'desc'  => 'Scieżka dostępu do pliku z logiem. Logo widoczne w nagłówku.'
                        ),
                        array(
                            'class' => 'TextInput',
                            'id'    => 'phoneGeneral',
                            'title' => 'Główny numer telefonu',
                            'desc'  => 'Główny numer telefonu. Widoczny na stronie tytułowej w nagłówku i w stopce.'
                        ),
                        array(
                            'class' => 'TextInput',
                            'id'    => 'emailGeneral',
                            'title' => 'Główny adres email',
                            'desc'  => 'Główny adres email. Widoczny na stronie tytułowej w nagłówku i w stopce.'
                        ),
                        array(
                            'class' => 'TextInput',
                            'id'    => 'addressPostalColde',
                            'title' => 'Kod pocztowy',
                        ),
                        array(
                            'class' => 'TextInput',
                            'id'    => 'addressCity',
                            'title' => 'Miejscowość',
                        ),
                        array(
                            'class' => 'TextInput',
                            'id'    => 'addressStreet',
                            'title' => 'Ulica',
                        ),
                        array(
                            'class' => 'TextInput',
                            'id'    => 'addressVoivodeship',
                            'title' => 'Województwo',
                        ),
                        array(
                            'class' => 'TextInput',
                            'id'    => 'addressCountry',
                            'title' => 'Kraj',
                        ),
                        array(
                            'class' => 'TextInput',
                            'id'    => 'workingDays',
                            'title' => 'Dni otwarcia firmy',
                            'desc'  => 'Tekst opisujący dni w jakich firma jest otwarta'
                        ),
                        array(
                            'class' => 'TextInput',
                            'id'    => 'workingHours',
                            'title' => 'Godziny otwarcia firmy',
                            'desc'  => 'Tekst opisujący godziny w jakich firma jest otwarta'
                        ),





                    ) // end inputs
                ),
                array(
                    'title'         => 'Kontakt',
                    'url'           => 'kontakt',
                    'inputs'        => array()
                )
            );

            add_action('admin_menu', function() {
                add_menu_page('Ustawienia', 'Ustawienia podstawowe', 'manage_options', 'ustawienia', array($this, 'pageContent'));
            });

            $this->cacheKeys();
        }

        public function pageContent() {
            if (!current_user_can('manage_options')) {
                wp_die(__('Nie posiadasz wystarczających uprawnień.'));
            }

            // save
            if($_REQUEST['action'] == 'save') {
                foreach ($_REQUEST['options'] as $key => $value) {
                    update_option($key, $value);
                }
                ?>
                  <div class="notice updated">
                    <p>Zmiany zostały zapisane.</p>
                  </div>
                <?php
           }
           // display
?>
            <div class="admin-options-wrapper">
                <form class="wrap" method="post">
                    <h2>Podstawowe dane prezentowane na stronie</h2>

                        <?php
                            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'pokaz_slajdow'; 
                        ?>
                        <h2 class="nav-tab-wrapper">
                            <?php 
                            // generate tabs
                                foreach ($this->tabs as $tab) {
                                   ?> <a href="?page=ustawienia&tab=<?php echo $tab['url']; ?>" class="nav-tab <?php echo $active_tab == $tab['url'] ? 'nav-tab-active' : ''; ?>"><?php echo $tab['title']; ?></a><?php
                                }    
                            ?>
                        </h2>

                        <?php
                            // generate inputs
                            foreach ($this->tabs as $tab) {
                                if ($tab['url'] === $active_tab) {
                                    foreach ($tab['inputs'] as $input) {
                                        $object = $this->factory($input);
                                        $val = $object->getValue();//(get_option($input['id']) !== false ? get_option($input['id']) : '');
                                        $object->setValue($val);
                                        $object->render();
                                    }
                                } else {
                                    continue;
                                }
                            }
                        ?>
                    <br>
                    <input type="hidden" name="action" value="save">
                    <input type="submit" class="button button-primary" value="Zapisz zmiany">
                </form>

            </div>
<?php
        }

        private function factory(array $args) {
            switch ($args['class']) {
                case 'Repeatable':
                    $item = new $args['class']($args['id'], $args['title'], $args['desc'], $args['recordDefinition']); // generate the Repeatable object
                    break;
                
                default:
                    $item = new $args['class']($args['id'], $args['title'], $args['desc']); // generate general object
                    break;
            }
            return $item;
        }

        private function cacheKeys() {
            foreach ($this->tabs as $tab) {
                foreach ($tab["inputs"] as $input) {
                    $this->cache[$input['id']] = $input;
                }
            }
        }

        public function getOption(string $id) {
            if (isset($this->cache[$id]) && !empty($this->cache[$id])) {

                // czy jest już utworzony objekt?
                if (!isset($this->cache[$id]["object"]) or (empty($this->cache[$id]["object"]))) {
                    $this->cache[$id]["object"] = $this->factory($this->cache[$id]);
                }

                if ($this->cache[$id]["object"]) {
                    return $this->cache[$id]["object"]->getValue();
                }
            }
        }

        public static function getInstance() {
            if (!isset(self::$instance)) {
                self::$instance = new Settings();
            }
            return self::$instance;
        }
    }