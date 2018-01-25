<?php
    class Settings {

        private static $instance;

        private function __construct() {
            
            add_action('admin_menu', function() {
                add_menu_page('Ustawienia', 'Ustawienia podstawowe', 'manage_options', 'ustawienia', array($this, 'pageContent'));
            });
        }

        public function pageContent() {
            if (!current_user_can('manage_options')) {
                wp_die(__('Nie posiadasz wystarczających uprawnień.'));
            }

            if($_REQUEST['action'] == 'save') {
 
                update_option('promet_main_phone', $_REQUEST['promet_main_phone']);
           
                ?>
                  <div class="notice updated">
                    <p>Zmiany zostały zapisane.</p>
                  </div>
                <?php
           
           }

?>
            <div class="admin-options-wrapper">
                <form class="wrap" method="post">
                    <h2>Podstawowe dane prezentowane na stronie</h2>

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Pokaz slajdów</a></li>
                            <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Kontakt</a></li>
                        </ul>


                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home"><?php echo $this->getTabContentHome(); ?></div>
                            <div role="tabpanel" class="tab-pane" id="contact"><?php echo $this->getTabContentContact(); ?></div>
                        </div>
                        
                    <input type="hidden" name="action" value="save">
                    <input type="submit" class="button button-primary" value="Zapisz zmiany">
                </form>

            </div>
<?php
        }

        private function getTabContentHome() {
            return '<table>
                <tbody>
                    <th scope="row">
                        <label for="promet_main_phone">Numer telefonu</label>
                    </th>
                    <td>
                        <input type="text" name="promet_main_phone" value="'.get_option("promet_main_phone").'">
                    </td>
                </tbody>
            </table>';
        }

        private function getTabContentContact() {
            return "to jest kontakt";
        }



        public static function getInstance() {
            if (!isset(self::$instance)) {
                self::$instance = new Settings();
            }
            return self::$instance;
        }
    }