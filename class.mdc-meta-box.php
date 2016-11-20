<?php
/**
 * Adds custom meta box and meta fields
 * @author Nazmul Ahsan <n.mukto@gmail.com>
*/
if( ! class_exists( 'MDC_Meta_Box' )  ) :
class MDC_Meta_Box {

	/**
	 * @var string|array $post_type post types to add meta box to.
	 */
	public $post_type;

	/**
	 * @var string $context side|normal|advanced location of the meta box.
	 */
	public $context;

	/**
	 * @var string $priority high|low position of the meta box.
	 */
	public $priority;

	/**
	 * @var array $fields meta fields to be added.
	 */
	public $fields;

	/**
	 * @var string $meta_box_id meta box id.
	 */
	public $meta_box_id;

	/**
	 * @var string $label meta box label.
	 */
	public $label;

	function __construct( $args ){
		$this->meta_box_id = $args['meta_box_id'];
		$this->label = $args['label'];
		$this->post_type = $args['post_type'];
		$this->context = $args['context'];
		$this->priority = $args['priority'];
		$this->fields = $args['fields'];

		self::hooks();
	}

	function enqueue_scripts() {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_media();
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'jquery' );
    }

	public function hooks(){
		add_action( 'add_meta_boxes' , array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_fields' ), 1, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_head', array( $this, 'scripts' ) );
	}

	public function add_meta_box() {
		if( is_array( $this->post_type ) ){
			foreach ( $this->post_type as $post_type ) {
				add_meta_box( $this->meta_box_id, $this->label, array( $this, 'meta_fields_callback' ), $post_type, $this->context, $this->priority );
			}
		}
		else{
			add_meta_box( $this->meta_box_id, $this->label, array( $this, 'meta_fields_callback' ), $this->post_type, $this->context, $this->priority );
		}
	}

	public function meta_fields_callback() {
		global $post;
		
		echo '<input type="hidden" name="mdc_cmb_nonce" id="mdc_cmb_nonce" value="' . 
		wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';
		
		foreach ( $this->fields as $field ) {

			if ( $field['type'] == 'text' || $field['type'] == 'number' || $field['type'] == 'email' || $field['type'] == 'url' || $field['type'] == 'password' ) {
				echo $this->field_text( $field );
			}
			elseif( $field['type'] == 'textarea' ){
				echo $this->field_textarea( $field );
			}
			elseif( $field['type'] == 'radio' ){
				echo $this->field_radio( $field );
			}
			elseif( $field['type'] == 'select' ){
				echo $this->field_select( $field );
			}
			elseif( $field['type'] == 'checkbox' ){
				echo $this->field_checkbox( $field );
			}
			elseif( $field['type'] == 'color' ){
				echo $this->field_color( $field );
			}
			elseif( $field['type'] == 'file' ){
				echo $this->field_file( $field );
			}
			elseif( $field['type'] == 'wysiwyg' ){
				echo $this->field_wysiwyg( $field );
			}
		}
		

	}
	

	public function save_meta_fields( $post_id, $post ) {
		
		if ( ! wp_verify_nonce( $_POST['mdc_cmb_nonce'], plugin_basename( __FILE__ ) ) ) {
			return $post->ID;
		}

		if ( ! current_user_can( 'edit_post', $post->ID ) )
			return $post->ID;
		
		foreach ( $this->fields as $field ){
			$key = $field['name'];
			$meta_values[$key] = $_POST[$key];
		}

		foreach ( $meta_values as $key => $value ) {
			if( $post->post_type == 'revision' ) return;
			$value = implode( ',', (array) $value );
			if( get_post_meta( $post->ID, $key, FALSE )) {
				update_post_meta( $post->ID, $key, $value );
			} else {
				add_post_meta( $post->ID, $key, $value );
			}
			if( ! $value ) delete_post_meta( $post->ID, $key );
		}

	}

	public function field_text( $field ){
		global $post;
		$field['default'] = ( isset( $field['default'] ) ) ? $field['default'] : '';
		$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr ( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
		$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
		$readonly  = isset( $field['readonly'] ) && ( $field['readonly'] == true ) ? " readonly" : "";
		$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

		$html	= sprintf( '<label class="mdc-label" for="mdc_cmb_%1$s">%2$s</label><br />', $field['name'], $field['label']);

		$html  .= sprintf( '<input type="%1$s" class="%2$s" id="mdc_cmb_%3$s" name="%3$s[%4$s]" value="%5$s" %6$s %7$s/>', $field['type'], $class, $field['name'], $field['name'], $value, $readonly, $disabled );

		$html	.= $this->field_description( $field );

		return $html;
	}

	public function field_textarea( $field ){
		global $post;
		$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
		$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
		$cols  = isset( $field['columns'] ) ? $field['columns'] : 24;
		$rows  = isset( $field['rows'] ) ? $field['rows'] : 5;
		$readonly  = isset( $field['readonly'] ) && ( $field['readonly'] == true ) ? " readonly" : "";
		$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

		$html	= sprintf( '<label class="mdc-label" for="mdc_cmb_%1$s">%2$s</label><br />', $field['name'], $field['label']);

		$html  .= sprintf( '<textarea rows="' . $rows . '" cols="' . $cols . '" class="%1$s-text" id="mdc_cmb_%2$s" name="%3$s" %4$s %5$s >%6$s</textarea>', $class, $field['name'], $field['name'], $readonly, $disabled, $value );

		$html .= $this->field_description( $field );

		return $html;
	}

	public function field_radio( $field ){
		global $post;
		$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
		$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
		$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

        $html  = '<fieldset>';
        $html .= '<label class="mdc-label">'.$field['label'].'</label><br />';
        foreach ( $field['options'] as $key => $label ) {
            $html .= sprintf( '<label for="%1$s[%2$s]">', $field['name'], $key );

            $html .= sprintf( '<input type="radio" class="radio %1$s" id="%2$s[%3$s]" name="%2$s" value="%3$s" %4$s %5$s />', $class, $field['name'], $key, checked( $value, $key, false ), $disabled );

            $html .= sprintf( '%1$s</label><br />', $label );
        }

        $html .= $this->field_description( $field );
        $html .= '</fieldset>';

        return $html;
	}

	public function field_checkbox( $field ){
		global $post;
		$field['default'] = ( isset( $field['default'] ) ) ? $field['default'] : '';
		$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
		$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
		$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

		$html	= sprintf( '<label class="mdc-label" for="mdc_cmb_%1$s">%2$s</label><br />', $field['name'], $field['label']);

		$html  .= sprintf( '<input type="checkbox" class="checkbox" id="mdc_cmb_%1$s" name="%1$s" value="on" %2$s %3$s />', $field['name'], checked( $value, 'on', false ), $disabled );

		$html .= $this->field_description( $field, true ) . '<br />';

		return $html;
	}

	public function field_select( $field ){
		global $post;
		$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr ( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
		$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
		$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

        $html	= sprintf( '<label class="mdc-label" for="mdc_cmb_%1$s">%2$s</label><br />', $field['name'], $field['label']);
        $html  .= sprintf( '<select class="%1$s" name="%2$s" id="mdc_cmb_%2$s" %3$s>', $class, $field['name'], $disabled );

        foreach ( $field['options'] as $key => $label ) {
            $html .= sprintf( '<option value="%s"%s>%s</option>', $key, selected( $value, $key, false ), $label );
        }

        $html .= sprintf( '</select>' );
        $html .= $this->field_description( $field );

        return $html;
	}

	public function field_color( $field ){
		global $post;
		$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
		$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
		$html	= sprintf( '<label class="mdc-label" for="mdc_cmb_%1$s">%2$s</label><br />', $field['name'], $field['label']);

        $html  .= sprintf( '<input type="text" class="%1$s-text wp-color-picker-field" id="mdc_cmb_%2$s" name="%2$s" value="%4$s" data-default-color="%5$s" />', $class, $field['name'], $field['name'], $value, $field['default'] );

		$html	.= $this->field_description( $field );


        return $html;
	}

	public function field_file( $field ){
		global $post;
		$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
		$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
		$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

        $id    = $field['name']  . '[' . $field['name'] . ']';
        $button_text = isset( $field['button_text'] ) ? $field['button_text'] : __( 'Choose File' );
        $html	= sprintf( '<label class="mdc-label" for="mdc_cmb_%1$s">%2$s</label><br />', $field['name'], $field['label']);
        $html  .= sprintf( '<input type="text" class="%1$s-text mdc-url" id="mdc_cmb_%2$s" name="%2$s" value="%3$s" %4$s />', $class, $field['name'], $value, $disabled );
        $html  .= '<input type="button" class="button mdc-browse" value="' . $button_text . '" ' . $disabled . ' />';
        $html  .= $this->field_description( $field );

        return $html;
	}

	public function field_wysiwyg( $field ){
		global $post;
		$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? get_post_meta( $post->ID, $field['name'], true ) : $field['default'];
		$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
		$width  = isset( $field['width'] ) && ! is_null( $field['width'] ) ? $field['width'] : '500px';
		$teeny  = isset( $field['teeny'] ) && ( $field['teeny'] == true ) ? true : false;
		$text_mode  = isset( $field['text_mode'] ) && ( $field['text_mode'] == true ) ? true : false;
		$media_buttons  = isset( $field['media_buttons'] ) && ( $field['media_buttons'] == true ) ? true : false;
		$rows  = isset( $field['rows'] ) ? $field['rows'] : 10;

        $html = '<div style="max-width: ' . $width . ';">';

        $editor_settings = array(
            'teeny'         => $teeny,
            'textarea_name' => $field['name'] . '[' . $field['name'] . ']',
            'textarea_rows' => $rows,
            'quicktags'		=> $text_mode,
            'media_buttons'		=> $media_buttons,
        );

        if ( isset( $field['options'] ) && is_array( $field['options'] ) ) {
            $editor_settings = array_merge( $editor_settings, $field['options'] );
        }

        ob_start();
        wp_editor( $value, $field['name'] . '-' . $field['name'], $editor_settings );
		$html .= ob_get_contents();
		ob_end_clean();
        
        $html .= '</div>';

        return $html;
	}

	public function field_description( $args, $no_p = false ) {
        if ( ! empty( $args['desc'] ) ) {
        	if( ! $no_p ){
        		$desc = sprintf( '<p class="description">%s</p>', $args['desc'] );
        	} else{
        		$desc = sprintf( '%s', $args['desc'] );
        	}
        } else {
            $desc = '';
        }

        return $desc;
    }

    function scripts() {
        ?>
        <script>
            jQuery(document).ready(function($) {
                //color picker
                $('.wp-color-picker-field').wpColorPicker();

                // media uploader
                $('.mdc-browse').on('click', function (event) {
                    event.preventDefault();

                    var self = $(this);

                    var file_frame = wp.media.frames.file_frame = wp.media({
                        title: self.data('uploader_title'),
                        button: {
                            text: self.data('uploader_button_text'),
                        },
                        multiple: false
                    });

                    file_frame.on('select', function () {
                        attachment = file_frame.state().get('selection').first().toJSON();

                        self.prev('.mdc-url').val(attachment.url);
			$('.supports-drag-drop').hide()
                    });

                    file_frame.open();
                });
        });
        </script>

        <style type="text/css">
            /* version 3.8 fix */
            .form-table th { padding: 20px 10px; }
            .mdc-label {display: inline-block;vertical-align: top;width: 100x; font-weight: bold}
            .mdc-meta-field, .mdc-meta-field-text {width: 100%;}
            .regular-text-text.mdc-url {width: calc(100% - 67px);}
            #wpbody-content .metabox-holder { padding-top: 5px; }
        </style>
        <?php
    }
}
endif;

if ( ! function_exists( 'mdc_meta_box' ) ) {
	function mdc_meta_box( $args ){
		return new MDC_Meta_Box( $args );
	}
}
