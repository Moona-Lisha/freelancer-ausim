<?php
/**
 * The main customizer manager.
 *
 * @package zerif
 */

/**
 * Require necessary files.
 */
require_once ZERIF_PHP_INCLUDE . 'core/abstract/class-zerif-register-customizer-controls.php';
/**
 * Class Zerif_Customizer_Main
 */
class Zerif_Customizer_Main extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->register_types();
		$this->add_main_panels();
		add_action( 'zerif_after_footer', array( $this, 'hidden_sidebars' ) );
	}

	/**
	 * Register customizer controls type.
	 */
	private function register_types() {
		require_once ZERIF_PHP_INCLUDE . 'customizer/controls/custom-controls/repeater/class-zerif-general-repeater.php';
		require_once ZERIF_PHP_INCLUDE . 'customizer/controls/custom-controls/radio-image/class-zerif-radio-image-control.php';
		require_once ZERIF_PHP_INCLUDE . 'customizer/controls/ui/customizer-tabs/class-zerif-customize-control-tabs.php';
		require_once ZERIF_PHP_INCLUDE . 'customizer/controls/ui/customizer-heading/class-zerif-customize-control-heading.php';
		require_once ZERIF_PHP_INCLUDE . 'customizer/controls/ui/customizer-plugin-install/class-zerif-plugin-install.php';
		$this->register_type( 'Zerif_Radio_Image_Control', 'control' );
		$this->register_type( 'Zerif_Customize_Control_Tabs', 'control' );
		$this->register_type( 'Zerif_Customize_Control_Heading', 'control' );
		$this->register_type( 'Zerif_Plugin_Install', 'control' );
	}

	/**
	 * Add main panels.
	 */
	private function add_main_panels() {

		$this->add_panel(
			new Zerif_Customizer_Panel(
				'zerif_frontpage_sections',
				array(
					'priority' => 50,
					'title'    => esc_html__( 'Frontpage Sections', 'zerif' ),
				)
			)
		);

		$this->add_panel(
			new Zerif_Customizer_Panel(
				'zerif_footer',
				array(
					'priority' => 80,
					'title'    => esc_html__( 'Footer Options', 'zerif' ),
				)
			)
		);

		$this->add_panel(
			new Zerif_Customizer_Panel(
				'zerif_colors',
				array(
					'priority' => 100,
					'title'    => esc_html__( 'Colors', 'zerif' ),
				)
			)
		);
	}

	/**
	 * Change docs section.
	 */
	public function change_controls() {
		$settings = array(
			'sidebar-widgets-sidebar-ourfocus'     => array(
				'panel'    => 'zerif_frontpage_sections',
				'priority' => 15,
				'title'    => esc_html__( 'Our focus section', 'zerif' ),
			),
			'sidebar-widgets-sidebar-aboutus'      => array(
				'panel'    => 'zerif_frontpage_sections',
				'priority' => 25,
				'title'    => esc_html__( 'About us section', 'zerif' ),
			),
			'sidebar-widgets-sidebar-ourteam'      => array(
				'panel'    => 'zerif_frontpage_sections',
				'priority' => 30,
				'title'    => esc_html__( 'Our team section', 'zerif' ),
			),
			'sidebar-widgets-sidebar-testimonials' => array(
				'panel'    => 'zerif_frontpage_sections',
				'priority' => 35,
				'title'    => esc_html__( 'Testimonials section', 'zerif' ),
			),
			'sidebar-widgets-sidebar-packages'     => array(
				'panel'    => 'zerif_frontpage_sections',
				'priority' => 55,
				'title'    => esc_html__( 'Packages section', 'zerif' ),
			),
			'sidebar-widgets-sidebar-subscribe'    => array(
				'panel'    => 'zerif_frontpage_sections',
				'priority' => 70,
				'title'    => esc_html__( 'Subscribe section', 'zerif' ),
			),
			'sidebar-widgets-sidebar-shop'         => array(
				'panel'    => 'woocommerce',
				'priority' => 90,
			),
			'sidebar-widgets-sidebar-big-title'    => array(
				'panel'    => 'zerif_frontpage_sections',
				'priority' => 0,
				'title'    => esc_html__( 'Big title section', 'zerif' ),
			),
		);

		$this->change_sidebars_properties( $settings );
	}

	/**
	 * Change sidebar properties.
	 *
	 * @param array $settings Settings array.
	 */
	private function change_sidebars_properties( $settings ) {
		foreach ( $settings as $section_id => $section_data ) {
			foreach ( $section_data as $option_name => $option_value ) {
				$this->change_customizer_object( 'section', $section_id, $option_name, $option_value );
			}
		}
	}

	/**
	 * Display the hidden sidebars to enable the customizer panels.
	 */
	public function hidden_sidebars() {
		echo '<div style="display: none">';
		if ( is_customize_preview() ) {
			dynamic_sidebar( 'sidebar-ourfocus' );
			dynamic_sidebar( 'sidebar-aboutus' );
			dynamic_sidebar( 'sidebar-ourteam' );
			dynamic_sidebar( 'sidebar-testimonials' );
			dynamic_sidebar( 'sidebar-packages' );
			dynamic_sidebar( 'sidebar-subscribe' );
			dynamic_sidebar( 'sidebar-big-title' );
		}
		echo '</div>';
	}

}
