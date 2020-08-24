<?php
/**
 * Map section's customizer controls.
 *
 * @package zerif
 */
/**
 * Class Zerif_Map_Controls
 */
class Zerif_Map_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_map_section();
		$this->add_content_controls();
	}

	/**
	 * Add Map section in Frontpage sections panel.
	 */
	private function add_map_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_googlemap_section',
				array(
					'title'    => esc_html__( 'Google map section', 'zerif' ),
					'panel'    => 'zerif_frontpage_sections',
					'priority' => 60,
				)
			)
		);
	}

	/**
	 * Add content controls.
	 */
	private function add_content_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_googlemap_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Show google map section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Google map section will appear on homepage.', 'zerif' ),
					'section'     => 'zerif_googlemap_section',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_googlemap_address',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'New York, Leroy Street', 'zerif' ),
				),
				array(
					'label'    => esc_html__( 'Google map address', 'zerif' ),
					'section'  => 'zerif_googlemap_section',
					'priority' => 2,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_googlemap_static',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Show STATIC google map ?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Google map section will display as a static google map.', 'zerif' ),
					'section'     => 'zerif_googlemap_section',
					'priority'    => 3,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_googlemap_shortcode',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
				),
				array(
					'label'    => esc_html__( 'Intergeo Shortcode', 'zerif' ),
					'section'  => 'zerif_googlemap_section',
					'priority' => 4,
					'message'  => __( 'You can install <a href="https://wordpress.org/plugins/intergeo-maps/" target="_blank">WordPress Google Maps Plugin</a> to get more advanced maps option.', 'zerif' ),
				),
				defined( 'INTERGEO_PLUGIN_NAME' ) ? null : 'Zerif_Display_Customizer_Message'
			)
		);
	}
}
