# MDC Meta Box

A library class to create custom meta boxes for WordPress' posts, pages or custom post types.

# Examples

## Basic Example
```php
// include library file
require dirname( __FILE__ ) . '/class.mdc-metabox.php';

$args = array(
    'meta_box_id'   =>  'your_unique_meta_box_id_here',
    'label'     =>  'Meta Box Title Here',
    'post_type' =>  array( 'post', 'page', 'cpt1', 'cpt2' ),
    'context'   =>  'context_of_meta_box', // see '[Full Working Example](#full-working-example)' for better understanding
    'priority'  =>  'priority_of_meta_box', // see '[Full Working Example](#full-working-example)' for better understanding
    'fields'    =>  array(
        array(
            'name'      =>  'sample_field_name',
            'label'     =>  __( 'Field Title' ),
            'type'      =>  'field_type_here', // see '[Full Working Example](#full-working-example)' for better understanding
        ),
    )
);

mdc_meta_box( $args );
```

## [Full Working Example](#full-working-example)
```php
// include library file
require dirname( __FILE__ ) . '/class.mdc-metabox.php';

$args = array(
    'meta_box_id'   =>  'sample_meta_id',
    'label'     =>  'Sample Meta Box',
    'post_type' =>  array( 'post', 'page' ),
    'context'   =>  'advanced',
    'priority'  =>  'high',
    'fields'    =>  array(
        array(
            'name'      =>  'sample_text',
            'label'     =>  __( 'Text Field' ),
            'type'      =>  'text',
            'desc'      =>  __( 'This is a text field.' ),
            'class'     =>  'custom-class',
            'default'   =>  'Hello World!',
            'readonly'  =>  true,
        ),
        array(
            'name'      =>  'sample_number',
            'label'     =>  __( 'Number Field' ),
            'type'      =>  'number',
            'desc'      =>  __( 'This is a number field.' ),
            'class'     =>  'custom-class',
            'default'   =>  10,
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'sample_email',
            'label'     =>  __( 'Email Field' ),
            'type'      =>  'email',
            'desc'      =>  __( 'This is a email field.' ),
            'class'     =>  'custom-class',
            'default'   =>  'john@doe.com',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'sample_url',
            'label'     =>  __( 'URL Field' ),
            'type'      =>  'url',
            'desc'      =>  __( 'This is a url field.' ),
            'class'     =>  'custom-class',
            'default'   =>  'http://johndoe.com',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'sample_password',
            'label'     =>  __( 'Password Field' ),
            'type'      =>  'password',
            'desc'      =>  __( 'This is a password field.' ),
            'class'     =>  'custom-class',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'sample_textarea',
            'label'     =>  __( 'Textarea Field' ),
            'type'      =>  'textarea',
            'desc'      =>  __( 'This is a textarea field.' ),
            'class'     =>  'custom-class',
            'columns'   =>  24,
            'rows'      =>  5,
            'default'   =>  'lorem ipsum dolor sit amet',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'sample_radio',
            'label'     =>  __( 'Radio Field' ),
            'type'      =>  'radio',
            'desc'      =>  __( 'This is a radio field.' ),
            'class'     =>  'custom-class',
            'options'   => array(
                'item_1'  => 'Item One',
                'item_2'  => 'Item Two',
                'item_3'  => 'Item Three',
                ),
            'default'   =>  'item_2',
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'sample_select',
            'label'     =>  __( 'Select Field' ),
            'type'      =>  'select',
            'desc'      =>  __( 'This is a select field.' ),
            'class'     =>  'custom-class',
            'options'   => array(
                'option_1'  => 'Option One',
                'option_2'  => 'Option Two',
                'option_3'  => 'Option Three',
                ),
            'default'   =>  'option_2',
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'sample_checkbox',
            'label'     =>  __( 'Checkbox Field' ),
            'type'      =>  'checkbox',
            'desc'      =>  __( 'This is a checkbox field.' ),
            'class'     =>  'custom-class',
            'disabled'  =>  false,
        ),
        array(
            'name'      =>  'sample_color',
            'label'     =>  __( 'Color Field' ),
            'type'      =>  'color',
            'desc'      =>  __( 'This is a color field.' ),
            'class'     =>  'regular-text',
            'default'   =>  '#f00'
        ),
        array(
            'name'      =>  'sample_wysiwyg',
            'label'     =>  __( 'WYSIWYG' ),
            'type'      =>  'wysiwyg',
            'desc'      =>  __( 'This is a wysiwyg field.' ),
            'class'     =>  'regular-text',
            'width'     =>  '100%',
            'rows'      =>  5,
            'teeny'     =>  true,
            'text_mode'     =>  false,
            'media_buttons' =>  false,
            'default'       =>  'Hello World'
        ),
        array(
            'name'      =>  'sample_file',
            'label'     =>  __( 'File Field' ),
            'type'      =>  'file',
            'button_text'     =>  __( 'Upload' ),
            'desc'      =>  __( 'This is a file field.' ),
            'class'     =>  'regular-text',
            'disabled'  =>  false,
            'default'   =>  'http://example.com/sample/file.txt'
        ),
    )
);

mdc_meta_box( $args );
```

## Requirement (minimum)
 - PHP 5.3.0
 - WordPress 3.0+

## Author
[Nazmul Ahsan](http://nazmulahsan.me)