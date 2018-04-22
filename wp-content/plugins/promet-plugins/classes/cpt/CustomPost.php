<?php

namespace Base\CPT;

abstract class CustomPost
{
    protected $name;
    protected $names;
    protected $args;
    protected $metaboxes;
    
    protected function __construct()
    {
        $this->register();

        if (isset($this->metaboxes)) {
            foreach ($this->metaboxes as $metabox) {
                if (isset($metabox['name']) && isset($metabox['manager'])) {
                    $this->addMetaBox(
                        $metabox['name'],
                        $metabox['manager']
                    );
                }
            }
        }
        $this->save();
    }

    protected function register()
    {
        if (!post_type_exists($this->name)) {
            add_action('init', function () {
                $args = array_merge(
                    array('labels' => $this->names),
                    $this->args
                );
                register_post_type($this->name, $args);
            });
        }        
    }

    
    private function addMetaBox($title, $fieldsManager, $context = 'normal', $priority = 'default')
    {
        add_action('add_meta_boxes', function () use ($title, $fieldsManager, $context, $priority) {
            $id = strtolower(str_replace(' ', '_', $title));
            add_meta_box(
                $id,
                ucwords($title),
                function () use ($fieldsManager, $id) {
                    global $post;
                    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'">';

                    // echo '<table class="form-table">';
                    
                    foreach ($fieldsManager->getFields() as $fieldID => $fieldArgs) {
                        $meta = get_post_meta($post->ID, $fieldID, true);
                        // narysuj element formularza za pomocą managera
                        $object = $fieldsManager->factory($fieldID, $fieldArgs);
                        
                        $object->setValue($meta);
                        $object->render();
                    }
                },
                $this->name, // post type name
                $context,
                $priority
            );
        });
    }

    private function save()
    {
        add_action('save_post', function () use ($post_id) {
            global $post;
            // verify nonce
            if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
                return $post->ID;
            }

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return $post->ID;
            }

            foreach ($this->metaboxes as $metabox) {
                foreach ($metabox['manager']->getFields() as $id => $field) {
                    update_post_meta(
                        $post->ID,
                        $id,
                        $_POST[$metabox['manager']->getVarWrapper()][$id]
                    );
                }
            }
        });
    }

    /*
     * poniższe funkcje do sprawdzenia i ew. odstrzału
     */
    public function getAll(): array
    {
        $items = array();

        $loop = new WP_Query(array('post_type' => $this->name, 'posts_per_page' => -1));
        while ($loop->have_posts()) :
            $loop->the_post();
            $item = [];
            $item["general"] = get_post(null, ARRAY_A);
            $item["meta"] = get_post_meta(get_the_ID());
            $items[] = $item;
        endwhile;
        wp_reset_query();
        return $items;
    }
}
