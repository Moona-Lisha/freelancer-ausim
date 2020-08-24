<?php
/**
 * Shortcodes section's customizer controls.
 *
 * @package zerif
 */

/**
 * Class Zerif_Shortcodes_Controls
 */
class Zerif_Shortcodes_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_shortcodes_section();
		$this->add_content_controls();
	}

	/**
	 * Add Shortcodes section in Frontpage sections panel.
	 */
	private function add_shortcodes_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_shortcodes_section',
				array(
					'title'    => esc_html__( 'Shortcodes section', 'zerif' ),
					'panel'    => 'zerif_frontpage_sections',
					'priority' => 45,
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
				'zerif_shortcodes_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide shortcodes section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Shortcodes section will disappear from homepage.', 'zerif' ),
					'section'     => 'zerif_shortcodes_section',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_shortcodes_settings',
				array(
					'sanitize_callback' => 'zerif_sanitize_repeater',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'                    => esc_html__( 'Edit the shortcode options', 'zerif' ),
					'section'                  => 'zerif_shortcodes_section',
					'priority'                 => 2,
					'zerif_title_control'      => true,
					'zerif_subtitle_control'   => true,
					'zerif_shortcode_control'  => true,
					'zerif_color_control'      => true,
					'zerif_opacity_control'    => true,
					'zerif_text_color_control' => true,
				),
				'Zerif_General_Repeater',
				array(
					'selector'            => '.zerif_shortcodes',
					'settings'            => 'zerif_shortcodes_settings',
					'container_inclusive' => true,
					'render_callback'     => 'shortcodes_callback',
				)
			)
		);
	}

	/**
	 * Render callback for zerif_shortcodes_settings
	 */
	public function shortcodes_callback() {
		get_template_part( 'sections/shortcodes' );
	}
}
