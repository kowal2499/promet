<?php
namespace Base;

include_once(plugin_dir_path(__FILE__) . 'InputsManager.php');
class Settings
{
    private static $instance;
    // private $cache = array();

    private function __construct()
    {

        $this->tabs = [
            [
                'title' => 'Pokaz slajdów',
                'url' => 'slideshow',
                'manager' => new InputsManager(plugin_dir_path(__DIR__)
                    . '../conf/inputs_settings_slideshow.json')
            ],
            [
                'title' => 'Dane ogólne',
                'url' => 'general_data',
                'manager' => new InputsManager(plugin_dir_path(__DIR__)
                    . '../conf/inputs_settings_general.json')
            ],
            [
                'title' => 'Kontakt',
                'url' => 'kontakt',
                'manager' => new InputsManager(plugin_dir_path(__DIR__)
                    . '../conf/inputs_settings_contact.json')
            ]
        ];

        add_action('admin_menu', function () {
            add_menu_page('Ustawienia', 'Ustawienia podstawowe', 'manage_options', 'ustawienia', array($this, 'pageContent'));
        });

        // rejestruj stringi do tłumaczeń
        if (is_admin()) {
            foreach ($this->tabs as $tab) {
                $tab['manager']->polylangRegister();
            }
        }

        // $this->cacheKeys();

    }

    public function pageContent()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('Nie posiadasz wystarczających uprawnień.'));
        }

        // save
        if ($_REQUEST['action'] == 'save') {
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
                        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'slideshow';
                    ?>
                    <h2 class="nav-tab-wrapper">
                        <?php
                        // generate tabs
                        foreach ($this->tabs as $tab) {
                        ?> 
                            <a href="?page=ustawienia&tab=<?php echo $tab['url']; ?>"
                            class="nav-tab <?php echo $active_tab == $tab['url'] ? 'nav-tab-active' : ''; ?>">
                            <?php echo $tab['title']; ?>
                            </a>
                        <?php
                        }
                        ?>
                    </h2>

                    <?php
                    // generate inputs
                    foreach ($this->tabs as $tab) {
                        if ($tab['url'] === $active_tab) {
                            foreach ($tab['manager']->getFields() as $id => $input) {
                                $object = $tab['manager']->factory($id, $input);
                                $val = $object->getValue();
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

    /*
     * Tworzy tablicę id-ików i zarządzających nimi managerów.
     * W trakcie działania skryptu dopisywane też są referencje utworzonych obiektów.
     */
    // private function cacheKeys()
    // {
    //     foreach ($this->tabs as $tab) {
    //         foreach ($tab['manager']->getFields() as $id => $input) {
    //             $this->cache[$id] = [
    //                 'manager' => $tab['manager'],
    //                 'inputs' => $input
    //             ];
    //         }
    //     }
    // }

    /*
     * Zwraca wartość z danego obiektu formularza
     */
    // public function getOption(string $id)
    // {
    //     if (isset($this->cache[$id]) && !empty($this->cache[$id])) {
    //         // czy jest już utworzony objekt?
    //         if (!isset($this->cache[$id]['object']) or (empty($this->cache[$id]['object']))) {
    //             $manager = $this->cache[$id]['manager'];
    //             $inputs = $this->cache[$id]['inputs'];
    //             // utwórz obiekt formularza i zapisz w cache
    //             $object = $manager->factory($id, $inputs);
    //             $this->cache[$id]['object'] = $object;
    //         }

    //         if ($this->cache[$id]['object']) {
    //             return pll__($this->cache[$id]['object']->getValue());
    //         }
    //     }
    // }

    public function getOption2(string $id)
    {
        foreach($this->tabs as $tab) {
            if (in_array($id, $tab['manager']->getIds())) {
                $input = $tab['manager']->getInput($id);
                if ($input) {
                    return pll__($input->getValue());
                }
            }
        }

        return null;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Settings();
        }
        return self::$instance;
    }
}