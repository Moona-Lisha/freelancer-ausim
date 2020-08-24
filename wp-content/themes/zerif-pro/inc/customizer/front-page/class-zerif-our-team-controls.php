<?php
/**
 * Our team section's customizer controls.
 *
 * @package zerif
 */
/**
 * Class Zerif_Our_Team_Controls
 */
class Zerif_Our_Team_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_tabs();
		$this->add_content_controls();
		$this->add_our_team_colors_section();
		$this->add_color_controls();
	}

	/**
	 * Add tabs in Our team section.
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_our_team_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'sidebar-widgets-sidebar-ourteam',
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
							'zerif_ourteam_show'     => array(),
							'zerif_ourteam_title'    => array(),
							'zerif_ourteam_subtitle' => array(),
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
				'zerif_ourteam_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide our team section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Our team section will disappear from homepage.', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-ourteam',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_title',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Our Team', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Main title', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-ourteam',
					'priority' => 2,
				),
				null,
				array(
					'selector'        => '#team .section-header h2',
					'settings'        => 'zerif_ourteam_title',
					'render_callback' => array( $this, 'ourteam_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_subtitle',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Add a subtitle in Customizer, "Our team section"', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Subtitle', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-ourteam',
					'priority' => 3,
				),
				null,
				array(
					'selector'        => '#team .section-header h6',
					'settings'        => 'zerif_ourteam_subtitle',
					'render_callback' => array( $this, 'ourteam_subtitle_render_callback' ),
				)
			)
		);
	}

	/**
	 * Add colors section for Our team.
	 */
	private function add_our_team_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_ourteam_colors_section',
				array(
					'title'    => esc_html__( 'Our team', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 60,
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
				'zerif_ourteam_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_background_filter', 'rgba(255, 255, 255, 1)' ),
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'palette'  => true,
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_header',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_header_filter', '#404040' ),
				),
				array(
					'label'    => esc_html__( 'Titles color', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_text',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_text_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Team member hover description color', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_hover_background',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_hover_background_filter', '#333' ),
				),
				array(
					'label'    => esc_html__( 'Team member hover description background color', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_socials',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_socials_filter', '#808080' ),
				),
				array(
					'label'    => esc_html__( 'Social icons colors', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_socials_hover',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_socials_hover_filter', '#e96656' ),
				),
				array(
					'label'    => esc_html__( 'Social icons colors - hover', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_1box',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_1box_filter', '#e96656' ),
				),
				array(
					'label'    => esc_html__( 'First box title underline color', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'priority' => 7,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_2box',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_2box_filter', '#34d293' ),
				),
				array(
					'label'    => esc_html__( 'Second box title underline color', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'priority' => 8,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_3box',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_3box_filter', '#3ab0e2' ),
				),
				array(
					'label'    => esc_html__( 'Third box title underline color', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'priority' => 9,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_ourteam_4box',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_ourteam_4box_filter', '#f7d861' ),
				),
				array(
					'label'    => esc_html__( 'Fourth box title underline color', 'zerif' ),
					'section'  => 'zerif_ourteam_colors_section',
					'priority' => 10,
				),
				'WP_Customize_Color_Control'
			)
		);
	}

	/**
	 * Render callback for zerif_ourteam_title
	 *
	 * @return mixed
	 */
	public function ourteam_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_ourteam_title' ) );
	}
	/**
	 * Render callback for zerif_ourteam_subtitle
	 *
	 * @return mixed
	 */
	public function ourteam_subtitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_ourteam_subtitle' ) );
	}
}
