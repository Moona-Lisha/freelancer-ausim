<?php
/**
 * Our focus section's customizer controls.
 *
 * @package zerif
 */

/**
 * Class Zerif_Our_Focus_Controls
 */
class Zerif_Our_Focus_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_tabs();
		$this->add_content_controls();
		$this->add_our_focus_colors_section();
		$this->add_color_controls();
	}

	/**
	 * Add tabs in Our Focus section.
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_our_focus_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'sidebar-widgets-sidebar-ourfocus',
					'priority' => -1,
					'tabs'     => array(
						'content' => array(
							'label' => esc_html__( 'Content', 'zerif' ),
						),
						'extra'   => array(
							'label' => esc_html__( 'Extra', 'zerif' ),
						),
					),
					'controls' => array(
						'content' => array(
							'zerif_ourfocus_show'     => array(),
							'zerif_ourfocus_title'    => array(),
							'zerif_ourfocus_subtitle' => array(),
						),
						'extra'   => array(
							'widgets' => array(),
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
	private function add_content_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide our focus section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Our focus section will disappear from homepage.', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-ourfocus',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_title',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Our Focus', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Main title', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-ourfocus',
					'priority' => 2,
				),
				null,
				array(
					'selector'        => '#focus .section-header h2',
					'settings'        => 'zerif_ourfocus_title',
					'render_callback' => array( $this, 'ourfocus_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_subtitle',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Add a subtitle in Customizer, "Our focus section"', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Subtitle', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-ourfocus',
					'priority' => 2,
				),
				null,
				array(
					'selector'        => '#focus .section-header h6',
					'settings'        => 'zerif_ourfocus_subtitle',
					'render_callback' => array( $this, 'ourfocus_subtitle_render_callback' ),
				)
			)
		);

	}

	/**
	 * Add colors section for Our focus.
	 */
	private function add_our_focus_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_ourfocus_colors_section',
				array(
					'title'    => esc_html__( 'Our focus', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 30,
				)
			)
		);
	}

	/**
	 * Add color controls.
	 */
	private function add_color_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourfocus_background_filter', 'rgba(255, 255, 255, 1)' ),
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'palette'  => true,
					'section'  => 'zerif_ourfocus_colors_section',
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_header',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourfocus_header_filter', '#404040' ),
				),
				array(
					'label'    => esc_html__( 'Main title and subtitle colors', 'zerif' ),
					'section'  => 'zerif_ourfocus_colors_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_box_title_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourfocus_box_title_color_filter', '#404040' ),
				),
				array(
					'label'    => esc_html__( 'Box title color', 'zerif' ),
					'section'  => 'zerif_ourfocus_colors_section',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_box_text_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourfocus_box_text_color_filter', '#404040' ),
				),
				array(
					'label'    => esc_html__( 'Box text color', 'zerif' ),
					'section'  => 'zerif_ourfocus_colors_section',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_1box',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourfocus_1box_filter', '#e96656' ),
				),
				array(
					'label'    => esc_html__( 'First box border color hover', 'zerif' ),
					'section'  => 'zerif_ourfocus_colors_section',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_2box',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourfocus_2box_filter', '#34d293' ),
				),
				array(
					'label'    => esc_html__( 'Second box border color hover', 'zerif' ),
					'section'  => 'zerif_ourfocus_colors_section',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_3box',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourfocus_3box_filter', '#3ab0e2' ),
				),
				array(
					'label'    => esc_html__( 'Third box border color hover', 'zerif' ),
					'section'  => 'zerif_ourfocus_colors_section',
					'priority' => 7,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourfocus_4box',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourfocus_4box_filter', '#f7d861' ),
				),
				array(
					'label'    => esc_html__( 'Fourth box border color hover', 'zerif' ),
					'section'  => 'zerif_ourfocus_colors_section',
					'priority' => 8,
				),
				'WP_Customize_Color_Control'
			)
		);
	}


	/**
	 * Render callback for zerif_ourfocus_title
	 *
	 * @return mixed
	 */
	public function ourfocus_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_ourfocus_title' ) );
	}
	/**
	 * Render callback for zerif_ourfocus_subtitle
	 *
	 * @return mixed
	 */
	public function ourfocus_subtitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_ourfocus_subtitle' ) );
	}

}
