<?php
/**
 * Portfolio section's customizer controls.
 *
 * @package zerif
 */

/**
 * Class Zerif_Portfolio_Controls
 */
class Zerif_Portfolio_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_portfolio_section();
		$this->add_portfolio_colors_section();
		$this->add_tabs();
		$this->add_content_controls();
		$this->add_extra_controls();
		$this->add_color_controls();
	}

	/**
	 * Add Portfolio section in Frontpage sections panel.
	 */
	private function add_portfolio_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_portfolio_section',
				array(
					'title'    => esc_html__( 'Portfolio section', 'zerif' ),
					'panel'    => 'zerif_frontpage_sections',
					'priority' => 20,
				)
			)
		);
	}

	/**
	 * Add colors section for Portfolio.
	 */
	private function add_portfolio_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_portofolio_colors_section',
				array(
					'title'    => esc_html__( 'Portfolio', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 40,
				)
			)
		);

	}

	/**
	 * Add tabs in Portfolio section.
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_portfolio_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'zerif_portfolio_section',
					'priority' => 1,
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
							'zerif_portofolio_show'     => array(),
							'zerif_portofolio_title'    => array(),
							'zerif_portofolio_subtitle' => array(),
						),
						'extra'   => array(
							'zerif_portofolio_show_modal'  => array(),
							'zerif_portofolio_single_full' => array(),
							'zerif_portofolio_number'      => array(),
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
				'zerif_portofolio_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide portfolio section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Portfolio section will disappear from homepage.', 'zerif' ),
					'section'     => 'zerif_portfolio_section',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_portofolio_title',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Portfolio', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Main title', 'zerif' ),
					'section'  => 'zerif_portfolio_section',
					'priority' => 2,
				),
				null,
				array(
					'selector'        => '#works h2',
					'settings'        => 'zerif_portofolio_title',
					'render_callback' => array( $this, 'portofolio_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_portofolio_subtitle',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Portfolio subtitle', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Subtitle', 'zerif' ),
					'section'  => 'zerif_portfolio_section',
					'priority' => 3,
				),
				null,
				array(
					'selector'        => '#works h6',
					'settings'        => 'zerif_portofolio_subtitle',
					'render_callback' => array( $this, 'portofolio_subtitle_render_callback' ),
				)
			)
		);
	}

	/**
	 * Add controls from second tab.
	 */
	private function add_extra_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_portofolio_show_modal',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
				),
				array(
					'type'     => 'checkbox',
					'label'    => esc_html__( 'Open portfolio in a lightbox?', 'zerif' ),
					'section'  => 'zerif_portfolio_section',
					'priority' => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_portofolio_single_full',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Full width page?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the single portfolio page will be full width, with no sidebar.', 'zerif' ),
					'section'     => 'zerif_portfolio_section',
					'priority'    => 2,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_portofolio_number',
				array(
					'sanitize_callback' => 'absint',
					'default'           => '8',
				),
				array(
					'label'    => esc_html__( 'Maximum number of portfolios to display on homepage', 'zerif' ),
					'section'  => 'zerif_portfolio_section',
					'priority' => 3,
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
				'zerif_portofolio_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_portofolio_background_filter', 'rgba(255, 255, 255, 1)' ),
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'palette'  => true,
					'section'  => 'zerif_portofolio_colors_section',
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_portofolio_header',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_portofolio_header_filter', '#404040' ),
				),
				array(
					'label'    => esc_html__( 'Main title and subtitle colors', 'zerif' ),
					'section'  => 'zerif_portofolio_colors_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_portofolio_text',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_portofolio_text_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Portfolio box texts', 'zerif' ),
					'section'  => 'zerif_portofolio_colors_section',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_portofolio_box_underline_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_portofolio_box_underline_color_filter', '#e96656' ),
				),
				array(
					'label'    => esc_html__( 'Portfolio box title undeline color', 'zerif' ),
					'section'  => 'zerif_portofolio_colors_section',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);
	}


	/**
	 * Render callback for zerif_portofolio_title
	 *
	 * @return mixed
	 */
	public function portofolio_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_portofolio_title' ) );
	}

	/**
	 * Render callback for zerif_portofolio_subtitle
	 *
	 * @return mixed
	 */
	public function portofolio_subtitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_portofolio_subtitle' ) );
	}

}
