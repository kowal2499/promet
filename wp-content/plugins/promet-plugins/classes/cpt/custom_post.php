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
                if (isset($metabox["name"]) && isset($metabox["fields"])) {
                    $this->add_meta_box($metabox["name"], $metabox["fields"]);
                }
            }
        }
        $this->save();
    }

    protected function register() {
        if (!post_type_exists($this->name)) {
            add_action('init', function() {
                $args = array_merge(
                    array('labels' => $this->names),
                    $this->args
                );
                register_post_type($this->name, $args);
            });
        }
    }

    
    private function add_meta_box($title, $fields = array(), $context = 'normal', $priority = 'default') {
        add_action('add_meta_boxes', function() use( $title, $fields, $context, $priority ) {
            $id = strtolower(str_replace(' ', '_', $title));
            add_meta_box(
                $id,
                ucwords(str_replace('_', ' ', $title)), // title;
                
                function() use ($fields, $id) {
                    global $post;
                    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
                    echo '<table class="form-table">';

                    foreach ($fields as $field) {
                        $meta = get_post_meta($post->ID, $field['id'], true);
                        echo '<tr>';
                        echo '<th><label for="'.$field['label'].'">'.$field['label'].'</label></th>';
                        echo '<td>';
                        switch ($field['type']) {
                            case 'text':
                                echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />';
                                if (!empty($field['desc'])) {
                                    echo '<br /><span class="description">'.$field['desc'].'</span>';
                                }
                                break;
                            case 'textarea':
                                echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
                                <br /><span class="description">'.$field['desc'].'</span>';
                                break;
                            case 'checkbox':
                                echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ', $meta ? ' checked="checked"' : '','/>
                                    <label for="'.$field['id'].'">'.$field['desc'].'</label>';
                                break;
                            case 'select':
                                echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
                                foreach ($field['options'] as $option) {
                                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                                }
                                echo '</select><br /><span class="description">'.$field['desc'].'</span>';
                                break;
                            case 'repeatable':
                                echo '<a class="repeatable-add button" href="#">+</a>
                                    <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
                                $i = 0;
                                if ($meta) {
                                    foreach($meta as $row) {
                                        echo '<li><span class="sort hndle">|||</span>
                                                    <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />
                                                    <a class="repeatable-remove button" href="#">-</a></li>';
                                        $i++;
                                    }
                                } else {
                                    echo '<li><span class="sort hndle">|||</span>
                                                <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" />
                                                <a class="repeatable-remove button" href="#">-</a></li>';
                                }
                                echo '</ul>
                                    <span class="description">'.$field['desc'].'</span>';
                                break;
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                },
                
                $this->name, // post type name
                $context,
                $priority
            );
        });
    }

    private function save() {

        add_action('save_post', function() use ($post_id) {
            global $post;
            // verify nonce
            if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
                return $post->ID;

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $post->ID;

            foreach ($this->metaboxes as $metabox) {
                foreach ($metabox['fields'] as $field) {
                    update_post_meta($post->ID, $field['id'], $_POST[$field['id']]);
               }
            }
            
        });
        
    }


    public function getAll(): array {
        $items = array();

        $loop = new WP_Query( array( 'post_type' => $this->name, 'posts_per_page' => -1 ) );
        while ($loop->have_posts()): $loop->the_post();
            $item = [];
            $item["general"] = get_post(null, ARRAY_A);
            $item["meta"] = get_post_meta(get_the_ID());
            $items[] = $item;
        endwhile;
        wp_reset_query();

        return $items;
    }

    

    
}
