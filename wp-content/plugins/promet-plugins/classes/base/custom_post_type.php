<?php

class Custom_Post_Type {

    public function __construct($name, $names=array(), $args=array(), $metaboxes=array()) {
        $this->name = strtolower(str_replace(' ', '_', $name));
        $this->names = $names;
        $this->args = $args;
        $this->metaboxes = array();

        if (!post_type_exists($this->name)) {
            add_action('init', array($this, 'register_post_type'));
        }

        foreach ($metaboxes as $metabox) {
            if (isset($metabox["name"]) && isset($metabox["fields"])) {
                $this->add_meta_box($metabox["name"], $metabox["fields"]);
                $this->metaboxes[] = $metabox["name"]; // keep name for further post saving handling
            }
        }

        $this->save();
    }

    public function register_post_type() {

        $args = array_merge(
                    array('labels' => $this->names),
                    $this->args
                );

        register_post_type($this->name, $args);
    }

    private function add_meta_box($title, $fields = array(), $context = 'normal', $priority = 'default') {
        if (!empty($title)) {
            // Meta variables
            $box_id = strtolower(str_replace(' ', '_', $title));
            $box_title = ucwords(str_replace('_', ' ', $title));
            $box_context = $context;
            $box_priority = $priority;
            $post_type_name = $this->name;

            global $custom_fields;
            $custom_fields[$title] = $fields;

            add_action('admin_init', function() use( $box_id, $box_title, $post_type_name, $box_context, $box_priority, $fields ) {
                add_meta_box(
                        $box_id, $box_title, function( $post, $data ) {
                    global $post;

                    // Nonce field for some validation
                    wp_nonce_field(plugin_basename(__FILE__), 'custom_post_type');

                    // Get all inputs from $data
                    $custom_fields = $data['args'][0];

                    // Get the saved values
                    $meta = get_post_custom($post->ID);

                    // Check the array and loop through it
                    if (!empty($custom_fields)) {
                        /* Loop through $custom_fields */
                        foreach ($custom_fields as $label => $type) {
                            $field_id_name = strtolower(str_replace(' ', '_', $data['id'])) . '_' . strtolower(str_replace(' ', '_', $label));

                            $value = isset($meta[$field_id_name]) ? $meta[$field_id_name][0] : '';
                            echo '<table class="form-table">';
                            echo '<tr>';
                            echo '<td><label for="' . $field_id_name . '">' . $label . '</label></td><td><input type="text" name="custom_meta[' . $field_id_name . ']" id="' . $field_id_name . '" value="' . $value . '" class="widefat"/></td>';
                            echo '</tr>';
                            echo '</table>';


                        }
                    }
                }, $post_type_name, $box_context, $box_priority, array($fields)
                );
            }
            );
        }
    }

    public function save() {

        if (isset($_POST['custom_post_type'])) {

            // Need the post type name again
            $post_type_name = $this->name;
            $meta_box_groups = $this->metaboxes;

            add_action('save_post', function() use( $post_type_name, $meta_box_groups ) {
                // Deny the WordPress autosave function
                if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                    return;

                if (!wp_verify_nonce($_POST['custom_post_type'], plugin_basename(__FILE__)))
                    return;

                global $post;

                if (isset($_POST) && isset($post->ID) && get_post_type($post->ID) == $post_type_name) {
                    global $custom_fields;

//                    echo "<pre>";
//                    var_dump($_POST);
//                    var_dump ($custom_fields);
//                    var_dump($meta_box_groups);
//                    die();

                    // Loop through each meta box
                    foreach ($custom_fields as $title => $fields) {
                        // Loop through all fields
                        if (in_array($title, $meta_box_groups)) {
                            foreach ($fields as $label => $type) {

                                $field_id_name = strtolower(str_replace(' ', '_', $title)) . '_' . strtolower(str_replace(' ', '_', $label));

                                update_post_meta($post->ID, $field_id_name, $_POST['custom_meta'][$field_id_name]);
                            }
                        }
                    }
                }
            }
            );
        }
    }

}
