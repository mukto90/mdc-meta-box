<?php
/**
 * Plugin name: MDC Meta Box Example
 */
require dirname( __FILE__ ) . '/class.mdc-meta-box.php';

$args = array(
    'meta_box_id'   =>  'sample_meta_id',
    'label'     =>  'Sample Meta Box',
    'post_type' =>  array( 'post', 'page' ),
    'context'   =>  'advanced', // side|normal|advanced
    'priority'  =>  'high', // high|low
    'fields'    =>  array(
        /**
         * PLEASE NOTE
         * desc, class, default, readonly, disabled, cols, rows, text_mode, teeny and media_buttons are optional.
         */
        array(
            'name'      =>  'sample_text',
            'label'     =>  __( 'Text Field' ),
            'type'      =>  'text',
            'desc'      =>  __( 'This is a text field.' ),
            'class'     =>  'mdc-meta-field',
            'default'   =>  'Hello World!',
            'readonly'  =>  false, // true|false
            'disabled'  =>  false, // true|false
        ),
        array(
            'name'      =>  'sample_number',
            'label'     =>  __( 'Number Field' ),
            'type'      =>  'number',
            'desc'      =>  __( 'This is a number field.' ),
            'class'     =>  'mdc-meta-field',
            'default'   =>  10,
            'readonly'  =>  false, // true|false
            'disabled'  =>  false, // true|false
        ),
        array(
            'name'      =>  'sample_email',
            'label'     =>  __( 'Email Field' ),
            'type'      =>  'email',
            'desc'      =>  __( 'This is an email field.' ),
            'class'     =>  'mdc-meta-field',
            'default'   =>  'john@doe.com',
            'readonly'  =>  false, // true|false
            'disabled'  =>  false, // true|false
        ),
        array(
            'name'      =>  'sample_url',
            'label'     =>  __( 'URL Field' ),
            'type'      =>  'url',
            'desc'      =>  __( 'This is a url field.' ),
            'class'     =>  'mdc-meta-field',
            'default'   =>  'http://johndoe.com',
            'readonly'  =>  false, // true|false
            'disabled'  =>  false, // true|false
        ),
        array(
            'name'      =>  'sample_password',
            'label'     =>  __( 'Password Field' ),
            'type'      =>  'password',
            'desc'      =>  __( 'This is a password field.' ),
            'class'     =>  'mdc-meta-field',
            'readonly'  =>  false, // true|false
            'disabled'  =>  false, // true|false
        ),
        array(
            'name'      =>  'sample_textarea',
            'label'     =>  __( 'Textarea Field' ),
            'type'      =>  'textarea',
            'desc'      =>  __( 'This is a textarea field.' ),
            'class'     =>  'mdc-meta-field',
            'columns'   =>  24,
            'rows'      =>  5,
            'default'   =>  'lorem ipsum dolor sit amet',
            'readonly'  =>  false, // true|false
            'disabled'  =>  false, // true|false
        ),
        array(
            'name'      =>  'sample_radio',
            'label'     =>  __( 'Radio Field' ),
            'type'      =>  'radio',
            'desc'      =>  __( 'This is a radio field.' ),
            'class'     =>  'mdc-meta-field',
            'options'   => array(
                'item_1'  => 'Item One',
                'item_2'  => 'Item Two',
                'item_3'  => 'Item Three',
                ),
            'default'   =>  'item_2',
            'disabled'  =>  false, // true|false
        ),
        array(
            'name'      =>  'sample_select',
            'label'     =>  __( 'Select Field' ),
            'type'      =>  'select',
            'desc'      =>  __( 'This is a select field.' ),
            'class'     =>  'mdc-meta-field',
            'options'   => array(
                'option_1'  => 'Option One',
                'option_2'  => 'Option Two',
                'option_3'  => 'Option Three',
                ),
            'default'   =>  'option_2',
            'disabled'  =>  false, // true|false
        ),
        array(
            'name'      =>  'sample_checkbox',
            'label'     =>  __( 'Checkbox Field' ),
            'type'      =>  'checkbox',
            'desc'      =>  __( 'This is a checkbox field.' ),
            'class'     =>  'mdc-meta-field',
            'disabled'  =>  false, // true|false
        ),
        array(
            'name'      =>  'sample_color',
            'label'     =>  __( 'Color Field' ),
            'type'      =>  'color',
            'desc'      =>  __( 'This is a color field.' ),
            'class'     =>  'mdc-meta-field',
            'default'   =>  '#f00'
        ),
        array(
            'name'      =>  'sample_wysiwyg',
            'label'     =>  __( 'WYSIWYG' ),
            'type'      =>  'wysiwyg',
            'desc'      =>  __( 'This is a wysiwyg field.' ),
            'class'     =>  'mdc-meta-field',
            'width'     =>  '100%',
            'rows'      =>  5,
            'teeny'     =>  true,
            'text_mode'     =>  false, // true|false
            'media_buttons' =>  false, // true|false
            'default'       =>  'Hello World'
        ),
        array(
            'name'      =>  'sample_file',
            'label'     =>  __( 'File Field' ),
            'type'      =>  'file',
            'button_text'     =>  __( 'Upload' ),
            'desc'      =>  __( 'This is a file field.' ),
            'class'     =>  'mdc-meta-field',
            'disabled'  =>  false, // true|false
            'default'   =>  'http://example.com/sample/file.txt'
        ),
    )
);

mdc_meta_box( $args );
