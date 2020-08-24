<?php
/**
 * Customizer info singleton class file.
 *
 * @package Zerif Pro
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Zerif_Customizer_Info_Singleton {

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {
	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @modified 1.1.40
	 * @access public
	 * @param  object $manager WordPress customizer object.
	 * @return void
	 */
	public function sections( $manager ) {

		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-info/class/class-zerif-customizer-info.php' );

		if ( ! class_exists( 'Zerif_Customizer_Info' ) ) {
			return;
		}

		$manager->add_section(
			new Zerif_Customizer_Info(
				$manager,
				'zerif_info_woocommerce',
				array(
					'section_text'        => __( 'To have full control over the colors on homepage sections please visit each section options in Customizer.', 'zerif' ),
					'slug'                => 'woocommerce',
					'panel'               => 'panel_1',
					'priority'            => 451,
					'capability'          => 'install_plugins',
					'hide_notice'         => (bool) get_option( 'dismissed-zerif_info_woocommerce', false ),
					'button_screenreader' => '',
				)
			)
		);

	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'zerif_customizer-info-js', trailingslashit( get_template_directory_uri() ) . 'inc/customizer-info/js/customizer-info-controls.js', array( 'customize-controls' ), ZERIF_VERSION, true );
		wp_localize_script(
			'zerif_customizer-info-js',
			'requestpost',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);
	}
}

Zerif_Customizer_Info_Singleton::get_instance();
