<?php

add_action( 'admin_init', 'my_meta_fields' );

function my_meta_fields() {
    $args = array(
        'meta_box_id'   =>  'your_unique_meta_box_id_here',
        'label'         =>  __( 'Meta Box Title Here' ),
        'post_type'     =>  array( 'post', 'page', 'cpt1', 'cpt2' ),
        'context'       =>  'context_of_meta_box', // side|normal|advanced
        'priority'      =>  'priority_of_meta_box', // high|low
        'hook_priority' =>  'priority_of_hook', // Default 10
        'fields'        =>  array(
            /* adds a field */
            array(
                'name'      =>  'sample_field_name',
                'label'     =>  __( 'Field Title' ),
                'type'      =>  'field_type_here', // define a field type from text, number, textarea, file, radio etc. see 'Full Working Example' for better understanding
            ),
            /* adds another field */
            array(
                'name'      =>  'another_sample_field_name',
                'label'     =>  __( 'Another Field Title' ),
                'type'      =>  'field_type_here',
            ),
        )
    );
    mdc_meta_box( $args );
}