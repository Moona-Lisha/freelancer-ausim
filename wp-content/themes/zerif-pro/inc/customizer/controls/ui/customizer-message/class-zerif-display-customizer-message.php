<?php
/**
 * Display message customizer control
 *
 * @package zerif
 */
/**
 * Class Zerif_Display_Customizer_Message
 */
class Zerif_Display_Customizer_Message extends WP_Customize_Control {

	/**
	 * The message to display in the controler
	 *
	 * @var string $message The message to display in the controler
	 */
	private $message = '';

	/**
	 * Parallax_One_Message constructor.
	 *
	 * @param WP_Customize_Manager $manager Manager.
	 * @param integer              $id Id.
	 * @param array                $args Array of arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! array_key_exists( 'message', $args ) ) {
			return;
		}
		$this->message = $args['message'];
	}

	/**
	 * The render function for the controler
	 */
	public function render_content() {
		if ( ! empty( $this->label ) ) {
			echo '<span class="customize-control-title">' . $this->label . '</span>';
		}
		echo '<div class="customizer-message">' . $this->message . '</div>';
	}
}
