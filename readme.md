# MDC Meta Box

A PHP class to create custom meta boxes for WordPress' posts, pages or custom post types.

# Usage

## How to use

### How to add fields

#### Way 1

- Include ```class.mdc-meta-box.php``` in your theme or plugin.
- Define meta box(es) and fields in your theme's ```functions.php``` file on in your plugin. See sample codes below.

#### Way 2

- Simply [download the zip](https://github.com/mukto90/mdc-meta-box/archive/master.zip) and use it as a standalone plugin.
- Edit `example.php` in your plugin directory.

### How to get custom fields' values

- Use ```get_post_meta( $post_id, 'your_field_name', true )``` to get the field value.

## Basic Example
```php
// include library file
require dirname( __FILE__ ) . '/class.mdc-meta-box.php';

$args = array(
    'meta_box_id'   =>  'your_unique_meta_box_id_here',
    'label'     =>  'Meta Box Title Here',
    'post_type' =>  array( 'post', 'page', 'cpt1', 'cpt2' ),
    'context'   =>  'context_of_meta_box', // side|normal|advanced
    'priority'  =>  'priority_of_meta_box', // high|low
    'fields'    =>  array(
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
```

## Full Working Example
```php
// include library file
require dirname( __FILE__ ) . '/class.mdc-meta-box.php';

$args = array(
    'meta_box_id'   =>  'sample_meta_id',
    'label'     =>  'Sample Meta Box',
    'post_type' =>  array( 'post', 'page' ),
    'context'   =>  'advanced',
    'priority'  =>  'high',
    'fields'    =>  array(
        /**
         * adds a text field
         */
        array(
            'name'      =>  'sample_text',
            'label'     =>  __( 'Text Field' ),
            'type'      =>  'text',
            'desc'      =>  __( 'This is a text field.' ),
            'class'     =>  'custom-class',
            'default'   =>  'Hello World!',
            'readonly'  =>  true,
        ),
        /**
         * adds a number field
         */
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
        /**
         * adds an email field
         */
        array(
            'name'      =>  'sample_email',
            'label'     =>  __( 'Email Field' ),
            'type'      =>  'email',
            'desc'      =>  __( 'This is an email field.' ),
            'class'     =>  'custom-class',
            'default'   =>  'john@doe.com',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        /**
         * adds a url field
         */
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
        /**
         * adds a password field
         */
        array(
            'name'      =>  'sample_password',
            'label'     =>  __( 'Password Field' ),
            'type'      =>  'password',
            'desc'      =>  __( 'This is a password field.' ),
            'class'     =>  'custom-class',
            'readonly'  =>  false,
            'disabled'  =>  false,
        ),
        /**
         * adds a textarea field
         */
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
        /**
         * adds a radio field
         */
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
        /**
         * adds a select field with options
         */
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
        /**
         * adds a checkbox field
         */
        array(
            'name'      =>  'sample_checkbox',
            'label'     =>  __( 'Checkbox Field' ),
            'type'      =>  'checkbox',
            'desc'      =>  __( 'This is a checkbox field.' ),
            'class'     =>  'custom-class',
            'disabled'  =>  false,
        ),
        /**
         * adds a color field
         */
        array(
            'name'      =>  'sample_color',
            'label'     =>  __( 'Color Field' ),
            'type'      =>  'color',
            'desc'      =>  __( 'This is a color field.' ),
            'class'     =>  'regular-text',
            'default'   =>  '#f00'
        ),
        /**
         * adds a WYSIWYG field
         */
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
        /**
         * adds a file upoloader field
         */
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

## Discussion
[Link](http://nazmulahsan.me/?p=530)
