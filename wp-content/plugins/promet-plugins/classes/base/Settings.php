<?php

// include_once( plugin_dir_path( __FILE__ ) . '../inputs/SlideshowConfig.php');

    class Settings {

        private static $instance;

        private function __construct() {
            
            $this->tabs = array(
                array(
                    'title'         => 'Pokaz slajdów',
                    'url'           => 'pokaz_slajdow',
                    'inputs'        => array(
                        array(
                            'class' => 'TextInput',
                            'id'    => 'phoneNumber01',
                            'title' => 'Numer Telefonu',
                            'desc'  => 'Główny numer telefonu. Widoczny na stronie tytułowej w nagłówku i w stopce.'
                        ),
                        array(
                            'class' => 'Repeatable',
                            'id'    => 'slideshow01',
                            'title' => 'Przewijak',
                            'desc'  => 'Jakś tam opis',
                            'recordDefinition' => array(
                                array(
                                    "type"  => "text",
                                    "desc"  => "Obrazek",
                                    "name"  => "image"
                                ),
                                array(
                                    "type"  => "text",
                                    "desc"  => "Opis numer 1",
                                    "name"  => "desc01"
                                ),
                                array(
                                    "type"  => "text",
                                    "desc"  => "Opis numer 2",
                                    "name"  => "desc02"
                                )
                            )
                        ),

                        array(
                            'class' => 'Repeatable',
                            'id'    => 'slideshow02',
                            'title' => 'Przewijak numer dwa',
                            'desc'  => 'Jakś tam opis 2',
                            'recordDefinition' => array(
                                array(
                                    "type"  => "text",
                                    "desc"  => "Niesamowity opis numer 1",
                                    "name"  => "txt01"
                                ),
                                array(
                                    "type"  => "text",
                                    "desc"  => "Niesamowity opis numer 2",
                                    "name"  => "txt02"
                                )
                            )
                        ),


                    )   // end inputs
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

                                        switch ($input['class']) {
                                            case 'Repeatable':
                                                $item = new $input['class']($input['id'], $input['title'], $input['desc'], $input['recordDefinition']); // generate the Repeatable object
                                                break;
                                            
                                            default:
                                                $item = new $input['class']($input['id'], $input['title'], $input['desc']); // generate general object
                                                break;
                                        }

                                        $val = (get_option($input['id']) !== false ? get_option($input['id']) : '');
                                        $item->setValue($val);
                                        $item->render();
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

        public static function getInstance() {
            if (!isset(self::$instance)) {
                self::$instance = new Settings();
            }
            return self::$instance;
        }
    }