<?php
/**
 * This class allows developers to implement scrolling to sections.
 *
 * @package    Zerif
 * @since      1.8.8.7
 * @author     Andrei Baicus <andrei@themeisle.com>
 * @copyright  Copyright (c) 2017, Themeisle
 * @link       http://themeisle.com/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Scroll to section.
 *
 * @since  1.8.8.7
 * @access public
 */
class Zerif_Customize_Control_Scroll {

	/**
	 * Zerif_Customize_Control_Scroll constructor.
	 */
	public function __construct() {
		add_action( 'customize_controls_init', array( $this, 'enqueue' ) );
		add_action( 'customize_preview_init', array( $this, 'helper_script_enqueue' ) );
	}

	/**
	 * The priority of the control.
	 *
	 * @since 1.8.8.7
	 * @var   string
	 */
	public $priority = 0;

	/**
	 * Loads the customizer script.
	 *
	 * @since  1.8.8.7
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'zerif-scroller-script', get_template_directory_uri() . '/inc/customizer-scroll/js/script.js', array( 'jquery' ), ZERIF_VERSION, true );
	}

	/**
	 * Enqueue the partials handler script that works synchronously with the zerif-scroller-script
	 */
	public function helper_script_enqueue() {
		wp_enqueue_script( 'zerif-scroller-addon-script', get_template_directory_uri() . '/inc/customizer-scroll/js/customizer-addon-script.js', array( 'jquery' ), ZERIF_VERSION, true );
	}
}
