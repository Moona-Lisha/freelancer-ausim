<?php
/**
 * Class Zerif_Widget_Form_Tools
 *
 * @package zerif
 */

/**
 * Class Zerif_Widget_Form_Tools
 */
class Zerif_Widget_Form_Tools {

	/**
	 * Widget object
	 *
	 * @var object
	 */
	private $obj;

	/**
	 * Zerif_Widget_Form_Tools constructor
	 *
	 * @param object $obj Object.
	 */
	public function __construct( $obj ) {
		$this->obj = $obj;
	}

	/**
	 * Form image control
	 */
	public function image_control( $instance ) {
		$obj                 = $this->obj;
		$image_in_customizer = '';
		$display             = 'none';
		if ( ! empty( $instance['image_in_customizer'] ) ) {
			$image_in_customizer = esc_url( $instance['image_in_customizer'] );
			$display             = 'inline-block';
		} else {
			if ( ! empty( $instance['image_uri'] ) ) {
				$image_in_customizer = esc_url( $instance['image_uri'] );
				$display             = 'inline-block';
			}
		} ?>
		<p>
			<label for="<?php echo $obj->get_field_id( 'image_uri' ); ?>"><?php _e( 'Image', 'zerif' ); ?></label><br/>

			<?php
			$zerif_image_in_customizer = $obj->get_field_name( 'image_in_customizer' );

			echo '<input type="hidden" class="custom_media_display_in_customizer" name="';
			if ( ! empty( $zerif_image_in_customizer ) ) {
				echo $zerif_image_in_customizer;
			}
			echo '" value="';
			if ( ! empty( $image_in_customizer ) ) {
				echo $image_in_customizer;
			}
			echo '">';

			echo '<img class="custom_media_image" src="' . $image_in_customizer . '" style="margin:0;padding:0;max-width:100px;float:left;display:' . $display . '" alt="' . __( 'Uploaded image', 'zerif' ) . '" /><br />';

			echo '<input type="text" class="widefat custom_media_url" name="' . $obj->get_field_name( 'image_uri' ) . '" id="' . $obj->get_field_id( 'image_uri' ) . '" value="';
			if ( ! empty( $instance['image_uri'] ) ) {
				echo $instance['image_uri'];
			}
			echo '" style="margin-top:5px;">';
			?>
			<input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $obj->get_field_name( 'image_uri' ); ?>" value="<?php _e( 'Upload Image', 'zerif' ); ?>" style="margin-top:5px;">
		</p>
		<?php
	}

	/**
	 * Input text
	 *
	 * @param object $instance Instance.
	 *
	 * @param array  $options Options.
	 */
	public function input_text( $instance, $options ) {
		$obj               = $this->obj;
		$type              = 'text';
		$instance_name     = '';
		$label             = '';
		$sanitize_function = 'esc_attr';
		if ( ! empty( $options['sanitize'] ) ) {
			$sanitize_function = $options['sanitize'];
		}
		if ( ! empty( $options['label'] ) ) {
			$label = $options['label'];
		}
		if ( ! empty( $options['instance_name'] ) ) {
			$instance_name = $options['instance_name'];
		}
		if ( ! empty( $options['type'] ) ) {
			$type = $options['type'];
		}
		?>
		<p>
			<?php
			if ( ! empty( $label ) ) {
				?>
				<label for="<?php echo esc_attr( $obj->get_field_id( $instance_name ) ); ?>"><?php echo esc_html( $label ); ?></label><br/>
				<?php
			}

			switch ( $type ) {
				case 'textarea':
					echo '<textarea class="widefat" rows="8" cols="20" name="' . esc_attr( $obj->get_field_name( $instance_name ) ) . '" id="' . esc_attr( $obj->get_field_id( $instance_name ) ) . '">';
					if ( ! empty( $instance[ $instance_name ] ) ) {
						echo htmlspecialchars_decode( $instance[ $instance_name ] );
					}
					echo '</textarea>';
					break;
				case 'checkbox':
					echo '<input type="hidden" name="' . esc_attr( $obj->get_field_name( $instance_name ) ) . '" value="0" />';
					echo '<input type="checkbox" name="' . esc_attr( $obj->get_field_name( $instance_name ) ) . '" id="' . esc_attr( $obj->get_field_id( $instance_name ) ) . '"';
					if ( ! empty( $instance[ $instance_name ] ) ) {
						checked( (bool) $instance[ $instance_name ], true );
					}
					echo '>' . __( 'Open link in new window?', 'zerif' ) . '<br>';
					break;
				case 'color':
					echo '<input type="text" name="' . esc_attr( $obj->get_field_name( $instance_name ) ) . '" id="' . esc_attr( $obj->get_field_id( $instance_name ) ) . '" value="';
					if ( ! empty( $instance[ $instance_name ] ) ) {
						echo call_user_func_array( $sanitize_function, array( $instance[ $instance_name ] ) );
					}
					echo '" class="color-picker" />';
					break;
				case 'number':
					echo '<input type="text" name="' . esc_attr( $obj->get_field_name( $instance_name ) ) . '" id="' . esc_attr( $obj->get_field_id( $instance_name ) ) . '" value="';
					if ( isset( $instance[ $instance_name ] ) && $instance[ $instance_name ] != '' ) {
						echo call_user_func_array( $sanitize_function, array( $instance[ $instance_name ] ) );
					}
					echo '" class="widefat" />';
					break;
				default:
					echo '<input type="text" name="' . esc_attr( $obj->get_field_name( $instance_name ) ) . '" id="' . esc_attr( $obj->get_field_id( $instance_name ) ) . '" value="';
					if ( ! empty( $instance[ $instance_name ] ) ) {
						echo call_user_func_array( $sanitize_function, array( $instance[ $instance_name ] ) );
					}
					echo '" class="widefat" />';
					break;
			}
			?>

		</p>
		<?php
	}
}
