<?php
/**
 * Plugin name: MDC Meta Box Example
 */
require dirname( __FILE__ ) . '/class.mdc-metaboxer.php';

$args = array(
    'meta_box_id'   =>  'mdc-settings',
    'label'     =>  'MDC MetaBoxer',
    'post_type' =>  array( 'post' ),
    'context'   =>  'normal',
    'priority'  =>  'high',
    'fields'    =>  array(
        array(
            'name'      =>  'text',
            'label'     =>  __( 'Text Field' ),
            'desc'      =>  __( 'This is a text field.' ),
            'class'      =>  'custom-class',
            'type'      =>  'text',
            'default'   =>  'Hello World!',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'number',
            'label'     =>  __( 'Number Field' ),
            'desc'      =>  __( 'This is a number field.' ),
            'class'      =>  'custom-class',
            'type'      =>  'number',
            'default'   =>  10,
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'email',
            'label'     =>  __( 'Email Field' ),
            'desc'      =>  __( 'This is a email field.' ),
            'class'      =>  'custom-class',
            'type'      =>  'email',
            'default'   =>  'john@doe.com',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'url',
            'label'     =>  __( 'URL Field' ),
            'desc'      =>  __( 'This is a url field.' ),
            'class'      =>  'custom-class',
            'type'      =>  'url',
            'default'   =>  'http://johndoe.com',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'password',
            'label'     =>  __( 'Password Field' ),
            'desc'      =>  __( 'This is a password field.' ),
            'class'      =>  'custom-class',
            'type'      =>  'password',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'textarea',
            'label'     =>  __( 'Textarea Field' ),
            'desc'      =>  __( 'This is a textarea field.' ),
            'class'      =>  'custom-class',
            'type'      =>  'textarea',
            'columns'   =>  24,
            'rows'       =>  5,
            'default'   =>  'lorem ipsum dolor sit amet',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'radio',
            'label'     =>  __( 'Radio Field' ),
            'desc'      =>  __( 'This is a radio field.' ),
            'class'      =>  'custom-class',
            'type'      =>  'radio',
            'options'   => array(
                'item_1'  => 'Item One',
                'item_2'  => 'Item Two',
                'item_3'  => 'Item Three',
                ),
            'default'   =>  'item_2',
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'select',
            'label'     =>  __( 'Select Field' ),
            'desc'      =>  __( 'This is a select field.' ),
            'class'      =>  'custom-class',
            'type'      =>  'select',
            'options'   => array(
                'option_1'  => 'Option One',
                'option_2'  => 'Option Two',
                'option_3'  => 'Option Three',
                ),
            'default'   =>  'option_2',
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'checkbox',
            'label'     =>  __( 'Checkbox Field' ),
            'desc'      =>  __( 'This is a checkbox field.' ),
            'class'      =>  'custom-class',
            'type'      =>  'checkbox',
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'color',
            'label'     =>  __( 'Color Field' ),
            'desc'      =>  __( 'This is a color field.' ),
            'class'      =>  'regular-text',
            'type'      =>  'color',
            'default'   =>  '#f00'
        ),
        array(
            'name'      =>  'wysiwyg',
            'label'     =>  __( 'WYSIWYG' ),
            'desc'      =>  __( 'This is a wysiwyg field.' ),
            'class'     =>  'regular-text',
            'type'      =>  'wysiwyg',
            'width'     =>  '100%',
            'rows'      =>  5,
            'teeny'     =>  true,
            'text_mode'     =>  false,
            'media_buttons' =>  false,
            'default'       =>  'Hello World'
        ),
        array(
            'name'      =>  'file',
            'label'     =>  __( 'File Field' ),
            'button_text'     =>  __( 'Upload' ),
            'desc'      =>  __( 'This is a file field.' ),
            'class'      =>  'regular-text',
            'type'      =>  'file',
            'disabled'  =>  false,
            'default'   =>  '//s.w.org/style/images/wp-header-logo.png'
        ),
    )
);

mdc_meta_box( $args );