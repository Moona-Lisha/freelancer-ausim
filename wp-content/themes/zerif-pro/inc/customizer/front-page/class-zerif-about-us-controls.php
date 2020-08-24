<?php
/**
 * Customizer controls for About us section.
 *
 * @package zerif
 */

/**
 * Class Zerif_About_Us_Controls
 */
class Zerif_About_Us_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_tabs();
		$this->add_content_controls();
		$this->add_features_controls();
		$this->add_about_us_colors_section();
		$this->add_color_controls();
	}

	/**
	 * Add tabs inside this section.
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_about_us_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'sidebar-widgets-sidebar-aboutus',
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
							'zerif_aboutus_show'           => array(),
							'zerif_aboutus_title'          => array(),
							'zerif_aboutus_subtitle'       => array(),
							'zerif_aboutus_biglefttitle'   => array(),
							'zerif_aboutus_text'           => array(),
							'zerif_feature_one_heading'    => array(),
							'zerif_aboutus_feature1_title' => array(),
							'zerif_aboutus_feature1_text'  => array(),
							'zerif_aboutus_feature1_nr'    => array(),
							'zerif_feature_two_heading'    => array(),
							'zerif_aboutus_feature2_title' => array(),
							'zerif_aboutus_feature2_text'  => array(),
							'zerif_aboutus_feature2_nr'    => array(),
							'zerif_feature_three_heading'  => array(),
							'zerif_aboutus_feature3_title' => array(),
							'zerif_aboutus_feature3_text'  => array(),
							'zerif_aboutus_feature3_nr'    => array(),
							'zerif_feature_four_heading'   => array(),
							'zerif_aboutus_feature4_title' => array(),
							'zerif_aboutus_feature4_text'  => array(),
							'zerif_aboutus_feature4_nr'    => array(),
						),
						'extra'   => array(
							'zerif_aboutus_clients_title_text' => array(),
							'widgets' => array(),
						),
					),
				),
				'Zerif_Customize_Control_Tabs'
			)
		);
	}

	/**
	 * Add controls in content tab
	 */
	private function add_content_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide about us section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the About us section will disappear from homepage.', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-aboutus',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_title',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'About US', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Main title', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-aboutus',
					'priority' => 2,
				),
				null,
				array(
					'selector'        => '#aboutus .section-header h2',
					'settings'        => 'zerif_aboutus_title',
					'render_callback' => array( $this, 'aboutus_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_subtitle',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Add a subtitle in Customizer, "About us section"', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Subtitle', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-aboutus',
					'priority' => 3,
				),
				null,
				array(
					'selector'        => '#aboutus .section-header h6',
					'settings'        => 'zerif_aboutus_subtitle',
					'render_callback' => array( $this, 'aboutus_subtitle_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_biglefttitle',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Title', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Left side content', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-aboutus',
					'priority' => 4,
				),
				null,
				array(
					'selector'        => '#aboutus .big-intro',
					'settings'        => 'zerif_aboutus_biglefttitle',
					'render_callback' => array( $this, 'aboutus_biglefttitle_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_text',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'You can add here a large piece of text. For that, please go in the Admin Area, Customizer, "About us section"', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'     => 'textarea',
					'label'    => esc_html__( 'Middle content', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-aboutus',
					'priority' => 5,
				),
				null,
				array(
					'selector'        => '#aboutus .text_and_skills p',
					'settings'        => 'zerif_aboutus_text',
					'render_callback' => array( $this, 'aboutus_text_render_callback' ),
				)
			)
		);
	}

	/**
	 * Add controls for About section's features.
	 */
	private function add_features_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_clients_title_text',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'transport'         => $this->selective_refresh,
					'default'           => esc_html__( 'OUR HAPPY CLIENTS', 'zerif' ),
				),
				array(
					'label'       => esc_html__( 'Clients area title', 'zerif' ),
					'description' => esc_html__( 'This title appears only if you have widgets in the About us sidebar.', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-aboutus',
					'priority'    => -1,
				)
			)
		);

		$headings_controls = array(
			'zerif_feature_one_heading'   => array(
				'priority' => 6,
				'label'    => esc_html__( 'Feature no#1', 'zerif' ),
			),
			'zerif_feature_two_heading'   => array(
				'priority' => 11,
				'label'    => esc_html__( 'Feature no#2', 'zerif' ),
			),
			'zerif_feature_three_heading' => array(
				'priority' => 15,
				'label'    => esc_html__( 'Feature no#3', 'zerif' ),
			),
			'zerif_feature_four_heading'  => array(
				'priority' => 19,
				'label'    => esc_html__( 'Feature no#4', 'zerif' ),
			),
		);

		foreach ( $headings_controls as $control_id => $settings ) {
			$this->add_control(
				new Zerif_Customizer_Control(
					$control_id,
					array(
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $this->selective_refresh,
					),
					array(
						'label'            => $settings['label'],
						'section'          => 'sidebar-widgets-sidebar-aboutus',
						'priority'         => $settings['priority'],
						'class'            => 'advanced-sidebar-accordion',
						'accordion'        => true,
						'controls_to_wrap' => 3,
						'expanded'         => false,
					),
					'Zerif_Customize_Control_Heading'
				)
			);
		}

		$title_controls = array(
			'zerif_aboutus_feature1_title' => 7,
			'zerif_aboutus_feature2_title' => 12,
			'zerif_aboutus_feature3_title' => 16,
			'zerif_aboutus_feature4_title' => 20,
		);

		$title_index = 1;
		foreach ( $title_controls as $control_id => $priority ) {
			$this->add_control(
				new Zerif_Customizer_Control(
					$control_id,
					array(
						'sanitize_callback' => 'zerif_sanitize_input',
						'default'           => esc_html__( 'Feature', 'zerif' ),
						'transport'         => $this->selective_refresh,
					),
					array(
						'label'    => esc_html__( 'Title', 'zerif' ),
						'section'  => 'sidebar-widgets-sidebar-aboutus',
						'priority' => $priority,
					),
					null,
					array(
						'selector'        => '#aboutus .skill_' . $title_index . ' label',
						'settings'        => 'zerif_aboutus_feature' . $title_index . '_title',
						'render_callback' => array(
							$this,
							'aboutus_feature' . $title_index . '_title_render_callback',
						),
					)
				)
			);
			$title_index += 1;
		}

		$text_controls = array(
			'zerif_aboutus_feature1_text' => 8,
			'zerif_aboutus_feature2_text' => 13,
			'zerif_aboutus_feature3_text' => 17,
			'zerif_aboutus_feature4_text' => 21,
		);
		foreach ( $text_controls as $control_id => $priority ) {
			$this->add_control(
				new Zerif_Customizer_Control(
					$control_id,
					array(
						'sanitize_callback' => 'zerif_sanitize_input',
						'transport'         => $this->selective_refresh,
					),
					array(
						'label'    => esc_html__( 'Text', 'zerif' ),
						'section'  => 'sidebar-widgets-sidebar-aboutus',
						'priority' => $priority,
					)
				)
			);
		}

		$nr_controls = array(
			'zerif_aboutus_feature1_nr' => array(
				'priority' => 9,
				'default'  => 50,
			),
			'zerif_aboutus_feature2_nr' => array(
				'priority' => 14,
				'default'  => 70,
			),
			'zerif_aboutus_feature3_nr' => array(
				'priority' => 18,
				'default'  => 100,
			),
			'zerif_aboutus_feature4_nr' => array(
				'priority' => 22,
				'default'  => 10,
			),
		);

		foreach ( $nr_controls as $control_id => $settings ) {
			$this->add_control(
				new Zerif_Customizer_Control(
					$control_id,
					array(
						'sanitize_callback' => 'absint',
						'default'           => $settings['default'],
					),
					array(
						'type'     => 'number',
						'label'    => esc_html__( 'Percentage', 'zerif' ),
						'section'  => 'sidebar-widgets-sidebar-aboutus',
						'priority' => $settings['priority'],
					)
				)
			);
		}
	}


	/**
	 * Add colors section for About us.
	 */
	private function add_about_us_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_aboutus_colors_section',
				array(
					'title'    => esc_html__( 'About us', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 50,
				)
			)
		);
	}

	/**
	 * Add color controls for About us.
	 */
	private function add_color_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_aboutus_background_filter', 'rgba(39, 39, 39, 1)' ),
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'section'  => 'zerif_aboutus_colors_section',
					'palette'  => true,
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_title_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_aboutus_title_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Titles color', 'zerif' ),
					'section'  => 'zerif_aboutus_colors_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_number_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_aboutus_number_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Numbers color', 'zerif' ),
					'section'  => 'zerif_aboutus_colors_section',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_clients_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_aboutus_clients_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Clients title color', 'zerif' ),
					'section'  => 'zerif_aboutus_colors_section',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_feature1_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_aboutus_feature1_color_filter', '#E96656' ),
				),
				array(
					'label'    => esc_html__( 'First Knob Color', 'zerif' ),
					'section'  => 'zerif_aboutus_colors_section',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_feature2_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_aboutus_feature2_color_filter', '#34D293' ),
				),
				array(
					'label'    => esc_html__( 'Second Knob Color', 'zerif' ),
					'section'  => 'zerif_aboutus_colors_section',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_feature3_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_aboutus_feature3_color_filter', '#3AB0E2' ),
				),
				array(
					'label'    => esc_html__( 'Third Knob Color', 'zerif' ),
					'section'  => 'zerif_aboutus_colors_section',
					'priority' => 7,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_aboutus_feature4_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_aboutus_feature4_color_filter', '#E7AC44' ),
				),
				array(
					'label'    => esc_html__( 'Fourth Knob Color', 'zerif' ),
					'section'  => 'zerif_aboutus_colors_section',
					'priority' => 8,
				),
				'WP_Customize_Color_Control'
			)
		);
	}

	/**
	 * Render callback for zerif_aboutus_text
	 *
	 * @return mixed
	 */
	public function aboutus_text_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_aboutus_text' ) );
	}


	/**
	 * Render callback for zerif_aboutus_title
	 *
	 * @return mixed
	 */
	public function aboutus_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_aboutus_title' ) );
	}

	/**
	 * Render callback for zerif_aboutus_subtitle
	 *
	 * @return mixed
	 */
	public function aboutus_subtitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_aboutus_subtitle' ) );
	}

	/**
	 * Render callback for zerif_aboutus_biglefttitle
	 *
	 * @return mixed
	 */
	public function aboutus_biglefttitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_aboutus_biglefttitle' ) );
	}

	/**
	 * Render callback for zerif_aboutus_feature1_title
	 *
	 * @return mixed
	 */
	public function aboutus_feature1_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_aboutus_feature1_title' ) );
	}

	/**
	 * Render callback for zerif_aboutus_feature2_title
	 *
	 * @return mixed
	 */
	public function aboutus_feature2_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_aboutus_feature2_title' ) );
	}

	/**
	 * Render callback for zerif_aboutus_feature3_title
	 *
	 * @return mixed
	 */
	public function aboutus_feature3_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_aboutus_feature3_title' ) );
	}

	/**
	 * Render callback for zerif_aboutus_feature4_title
	 *
	 * @return mixed
	 */
	public function aboutus_feature4_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_aboutus_feature4_title' ) );
	}

}
