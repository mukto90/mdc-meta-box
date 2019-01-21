# MDC Meta Box

A PHP class to create custom meta boxes for WordPress' posts, pages or custom post types.

# Usage

## How to use

### How to add metabox(es)

#### Option 1 (using Composer)

- Add the following to your `composer.json` file-
```json
{
    "require": {
        "mukto90/mdc-meta-box": "dev-master"
    }
}
```
- Run `composer install` command.
- Include your autoloader file (if not already) with `/vendor/autoload.php;`
- Instantiate the class and pass your arguments like this-
```php
$first_meta_field = new MDC_Meta_Box( $args ); // see below for sample $args
```
#### Option 2

- Include ```class.mdc-meta-box.php``` in your theme or plugin.
- Define meta box(es) and fields in your theme's ```functions.php``` file or in your plugin, like this-
```php
$second_meta_field = new MDC_Meta_Box( $args ); // see below for sample $args
```

#### Option 3

- Simply [download the zip](https://github.com/mukto90/mdc-meta-box/archive/master.zip) and use it as a standalone plugin.
- Edit `mdc-meta-box/plugin.php` under your `wp-content/plugins` directory.

### How to get custom fields' values

- Use ```get_post_meta( $post_id, 'your_field_name', true )``` to get the field value.

## Basic Example
```php
// include library file
// require dirname( __FILE__ ) . '/src/class.mdc-meta-box.php'; // un-comment this if needed

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
```

## Full Working Example
```php
// include library file
// require dirname( __FILE__ ) . '/src/class.mdc-meta-box.php'; // un-comment this if needed

add_action( 'admin_init', 'my_meta_fields' );

function my_meta_fields() {
    $args = array(
        'meta_box_id'   =>  'sample_meta_id',
        'label'         =>  __( 'Sample Meta Box' ),
        'post_type'     =>  array( 'post', 'page' ),
        'context'       =>  'normal', // side|normal|advanced
        'priority'      =>  'high', // high|low
        'hook_priority'  =>  10,
        'fields'        =>  array(
            /**
             * PLEASE NOTE
             * desc, desc_nop, class, default, readonly, disabled, cols, rows, text_mode, teeny and media_buttons are optional.
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
                'desc_nop'  =>  false, // true|false
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
                'multiple'  =>  true, // true|false
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
                'label'     =>  __( 'WYSIWYG Field' ),
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
                'name'      =>  'sample_fise',
                'label'     =>  __( 'File Field' ),
                'type'      =>  'file',
                'upload_button'     =>  __( 'Choose File' ),
                'select_button'     =>  __( 'Select File' ),
                'desc'      =>  __( 'This is a file field.' ),
                'class'     =>  'mdc-meta-field',
                'disabled'  =>  false, // true|false
                'default'   =>  'http://example.com/sample/file.txt'
            ),
        )
    );

    mdc_meta_box( $args );
}
```

## Screenshot
![MDC Meta Box](https://box.everhelper.me/attachment/1725999/oqmfbhrulxkg4glmleln/792856-KILfRby62GNUnC36/screen.png "MDC Meta Box")

## Requirement (minimum)
 - PHP 5.3.0
 - WordPress 3.0+

## Author
[Nazmul Ahsan](https://nazmulahsan.me)

## Discussion
[Link](https://nazmulahsan.me/?p=530)
