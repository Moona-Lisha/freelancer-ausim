<?php
/**
 * Ribbon sections customizer controls.
 *
 * @package zerif
 */

/**
 * Class Zerif_Ribbon_Controls
 */
class Zerif_Ribbon_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_ribbon_section();
		$this->add_ribbon_colors_section();
		$this->add_tabs();
		$this->add_bottom_button_ribbon_controls();
		$this->add_right_button_ribbon_controls();
		$this->add_color_tabs();
		$this->add_color_controls();
	}

	/**
	 * Add Ribbon section in Frontpage sections panel.
	 */
	private function add_ribbon_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_ribbon_sections',
				array(
					'title'    => esc_html__( 'Ribbon sections', 'zerif' ),
					'panel'    => 'zerif_frontpage_sections',
					'priority' => 40,
				)
			)
		);

	}

	/**
	 * Add Ribbon section in Colors panel.
	 */
	private function add_ribbon_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_ribbons_colors',
				array(
					'title'    => esc_html__( 'Ribbons', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 80,
				)
			)
		);
	}

	/**
	 * Add Ribbon tabs.
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbons_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'zerif_ribbon_sections',
					'priority' => 1,
					'tabs'     => array(
						'bottom_button' => array(
							'label' => esc_html__( 'BottomButton Ribbon', 'zerif' ),
						),
						'right_button'  => array(
							'label' => esc_html__( 'RightButton Ribbon', 'zerif' ),
						),
					),
					'controls' => array(
						'bottom_button' => array(
							'zerif_bottomribbon_text' => array(),
							'zerif_bottomribbon_buttonlabel' => array(),
							'zerif_bottomribbon_buttonlink' => array(),
						),
						'right_button'  => array(
							'zerif_ribbonright_text'       => array(),
							'zerif_ribbonright_buttonlabel' => array(),
							'zerif_ribbonright_buttonlink' => array(),
						),
					),
				),
				'Zerif_Customize_Control_Tabs'
			)
		);
	}

	/**
	 * Add controls from first tab.
	 */
	private function add_bottom_button_ribbon_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bottomribbon_text',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Main text', 'zerif' ),
					'section'  => 'zerif_ribbon_sections',
					'priority' => 1,
				),
				null,
				array(
					'selector'        => '#ribbon_bottom h3',
					'settings'        => 'zerif_bottomribbon_text',
					'render_callback' => array( $this, 'bottomribbon_text_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bottomribbon_buttonlabel',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'       => esc_html__( 'Button label', 'zerif' ),
					'description' => esc_html__( 'The button link must be filled too, for the button to show up.', 'zerif' ),
					'section'     => 'zerif_ribbon_sections',
					'priority'    => 2,
				),
				null,
				array(
					'selector'        => '#ribbon_bottom a.btn',
					'settings'        => 'zerif_bottomribbon_buttonlabel',
					'render_callback' => array( $this, 'bottomribbon_buttonlabel_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bottomribbon_buttonlink',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'       => esc_html__( 'Button link', 'zerif' ),
					'description' => esc_html__( 'The button label must be filled too, for the button to show up.', 'zerif' ),
					'section'     => 'zerif_ribbon_sections',
					'priority'    => 3,
				)
			)
		);
	}

	/**
	 * Add controls from second tab.
	 */
	private function add_right_button_ribbon_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbonright_text',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Main text', 'zerif' ),
					'section'  => 'zerif_ribbon_sections',
					'priority' => 1,
				),
				null,
				array(
					'selector'        => '#ribbon_right h3',
					'settings'        => 'zerif_ribbonright_text',
					'render_callback' => array( $this, 'ribbonright_text_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbonright_buttonlabel',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'       => esc_html__( 'Button label', 'zerif' ),
					'description' => esc_html__( 'The button link must be filled too, for the button to show up.', 'zerif' ),
					'section'     => 'zerif_ribbon_sections',
					'priority'    => 2,
				),
				null,
				array(
					'selector'        => '#ribbon_right a.btn',
					'settings'        => 'zerif_ribbonright_buttonlabel',
					'render_callback' => array( $this, 'ribbonright_buttonlabel_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbonright_buttonlink',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'       => esc_html__( 'Button link', 'zerif' ),
					'description' => esc_html__( 'The button label must be filled too, for the button to show up.', 'zerif' ),
					'section'     => 'zerif_ribbon_sections',
					'priority'    => 3,
				)
			)
		);
	}

	/**
	 * Add colors tabs for Ribbon sections.
	 */
	private function add_color_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbons_colors_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'zerif_ribbons_colors',
					'priority' => 1,
					'tabs'     => array(
						'bottom_button' => array(
							'label' => esc_html__( 'BottomButton Ribbon', 'zerif' ),
						),
						'right_button'  => array(
							'label' => esc_html__( 'RightButton Ribbon', 'zerif' ),
						),
					),
					'controls' => array(
						'bottom_button' => array(
							'zerif_ribbon_background' => array(),
							'zerif_ribbon_text_color' => array(),
							'zerif_ribbon_button_background' => array(),
							'zerif_ribbon_button_background_hover' => array(),
							'zerif_ribbon_button_button_color' => array(),
							'zerif_ribbon_button_button_color_hover' => array(),
						),
						'right_button'  => array(
							'zerif_ribbonright_background' => array(),
							'zerif_ribbonright_text_color' => array(),
							'zerif_ribbonright_button_background' => array(),
							'zerif_ribbonright_button_background_hover' => array(),
							'zerif_ribbonright_button_button_color' => array(),
							'zerif_ribbonright_button_button_color_hover' => array(),
						),
					),
				),
				'Zerif_Customize_Control_Tabs'
			)
		);
	}

	/**
	 * Add ribbon colors.
	 */
	private function add_color_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbon_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbon_background_filter', 'rgba(52, 210, 147, 0.8)' ),
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'palette'  => true,
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbon_text_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbon_text_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Text color', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbon_button_background',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbon_button_background_filter', '#20AA73' ),
				),
				array(
					'label'    => esc_html__( 'Button background color', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbon_button_background_hover',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbon_button_background_hover_filter', '#14a168' ),
				),
				array(
					'label'    => esc_html__( 'Button background color hover', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbon_button_button_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbon_button_button_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Button text color', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbon_button_button_color_hover',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbon_button_button_color_hover_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Button text color hover', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbonright_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbonright_background_filter', 'rgba(233, 102, 86, 1)' ),
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'palette'  => true,
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbonright_text_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbonright_text_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Text color', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbonright_button_background',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbonright_button_background_filter', '#db5a4a' ),
				),
				array(
					'label'    => esc_html__( 'Button background color', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbonright_button_background_hover',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbonright_button_background_hover_filter', '#bf3928' ),
				),
				array(
					'label'    => esc_html__( 'Button background color hover', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbonright_button_button_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbonright_button_button_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Button text color', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ribbonright_button_button_color_hover',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ribbonright_button_button_color_hover_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Button text color hover', 'zerif' ),
					'section'  => 'zerif_ribbons_colors',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);
	}

	/**
	 * Render callback for zerif_bottomribbon_text
	 *
	 * @return mixed
	 */
	public function bottomribbon_text_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_bottomribbon_text' ) );
	}

	/**
	 * Render callback for zerif_bottomribbon_buttonlabel
	 *
	 * @return mixed
	 */
	public function bottomribbon_buttonlabel_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_bottomribbon_buttonlabel' ) );
	}

	/**
	 * Render callback for zerif_ribbonright_text
	 *
	 * @return mixed
	 */
	public function ribbonright_text_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_ribbonright_text' ) );
	}

	/**
	 * Render callback for zerif_ribbonright_buttonlabel
	 *
	 * @return mixed
	 */
	public function ribbonright_buttonlabel_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_ribbonright_buttonlabel' ) );
	}

}
