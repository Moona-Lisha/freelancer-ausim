<?php
/**
 * Testimonials section's customizer controls.
 *
 * @package zerif
 */

/**
 * Class Zerif_Testimonials_Controls
 */
class Zerif_Testimonials_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_tabs();
		$this->add_content_controls();
		$this->add_extra_controls();
		$this->add_testimonials_colors_section();
		$this->add_color_controls();
	}

	/**
	 * Add tabs in Testimonials section.
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_testimonials_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'sidebar-widgets-sidebar-testimonials',
					'priority' => - 1,
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
							'zerif_testimonials_show'     => array(),
							'zerif_testimonials_title'    => array(),
							'zerif_testimonials_subtitle' => array(),
						),
						'extra'   => array(
							'zerif_testimonials_pinterest_style' => array(),
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
				'zerif_testimonials_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide testimonials section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Testimonials section will disappear from homepage.', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-testimonials',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_testimonials_title',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Testimonials', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Main title', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-testimonials',
					'priority' => 3,
				),
				null,
				array(
					'selector'        => '#testimonials .section-header h2',
					'settings'        => 'zerif_testimonials_title',
					'render_callback' => array( $this, 'testimonials_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_testimonials_subtitle',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Subtitle', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-testimonials',
					'priority' => 3,
				),
				null,
				array(
					'selector'        => '#testimonials .section-header h6',
					'settings'        => 'zerif_testimonials_subtitle',
					'render_callback' => array( $this, 'testimonials_subtitle_render_callback' ),
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
				'zerif_testimonials_pinterest_style',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Use pinterest layout?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Testimonials section will use pinterest-style layout.', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-testimonials',
					'priority'    => - 1,
				)
			)
		);
	}

	/**
	 * Add Testimonials colors section.
	 */
	private function add_testimonials_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_testimonials_colors_section',
				array(
					'title'    => esc_html__( 'Testimonials', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 70,
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
				'zerif_testimonials_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_testimonials_background_filter', 'rgba(219, 191, 86, 1)' ),
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'section'  => 'zerif_testimonials_colors_section',
					'palette'  => true,
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_testimonials_header',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_testimonials_header_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Title and subtitle colors', 'zerif' ),
					'section'  => 'zerif_testimonials_colors_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_testimonials_text',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_testimonials_text_filter', '#909090' ),
				),
				array(
					'label'    => esc_html__( 'Testimonial text color', 'zerif' ),
					'section'  => 'zerif_testimonials_colors_section',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_testimonials_author',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_testimonials_author_filter', '#909090' ),
				),
				array(
					'label'    => esc_html__( 'Testimonial author name color', 'zerif' ),
					'section'  => 'zerif_testimonials_colors_section',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_testimonials_quote',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_testimonials_quote_filter', '#e96656' ),
				),
				array(
					'label'    => esc_html__( 'Testimonial quote color', 'zerif' ),
					'section'  => 'zerif_testimonials_colors_section',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_testimonials_quote',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_testimonials_box_color_filter', '#FFFFFF' ),
				),
				array(
					'label'    => esc_html__( 'Testimonial box background color', 'zerif' ),
					'section'  => 'zerif_testimonials_colors_section',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);
	}

	/**
	 * Render callback for zerif_testimonials_title
	 *
	 * @return mixed
	 */
	public function testimonials_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_testimonials_title' ) );
	}

	/**
	 * Render callback for zerif_testimonials_subtitle
	 *
	 * @return mixed
	 */
	public function testimonials_subtitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_testimonials_subtitle' ) );
	}
}
