<?php
/**
 * Subscribe section's customizer controls.
 *
 * @package zerif
 */

/**
 * Class Zerif_Subscribe_Controls
 */
class Zerif_Subscribe_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_tabs();
		$this->add_content_controls();
		$this->add_subscribe_colors_section();
		$this->add_color_controls();
	}

	/**
	 * Add tabs in Subscribe section.
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_subscribe_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'sidebar-widgets-sidebar-subscribe',
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
							'zerif_subscribe_show'     => array(),
							'zerif_sib_plugin_install' => array(),
							'zerif_subscribe_title'    => array(),
							'zerif_subscribe_subtitle' => array(),
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
				'zerif_subscribe_show',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'zerif_sanitize_checkbox',
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Show subscribe section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Subscribe section will appear on homepage.', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-subscribe',
					'priority'    => 1,
				)
			)
		);

		$sib_first_step_description =
			sprintf(
				/* translators: %s is path to subscribe widgets */
				esc_html__( 'The main content of this section is customizable in: %s. There you must add the "SendinBlue Newsletter" widget. But first you will need to install SendinBlue plugin.', 'zerif' ),
				sprintf(
					'<b>%s</b>',
					esc_html__( 'Customize > Subscribe section > Subscribe section widgets', 'zerif' )
				)
			);
		$sib_second_step_description =
			sprintf(
				/* translators: %s is path to subscribe widgets */
				esc_html__( 'The main content of this section is customizable in: %s section widgets. There you must add the "SendinBlue Newsletter" widget.', 'zerif' ),
				sprintf(
					'<b>%s</b>',
					esc_html__( 'Customize > Subscribe section > Subscribe section widgets', 'zerif' )
				)
			);

		$query['autofocus[control]'] = 'zerif_sib_plugin_install';
		$control_link                = add_query_arg( $query, admin_url( 'customize.php' ) );

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_sib_plugin_install',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'                => 'sidebar-widgets-sidebar-subscribe',
					'priority'               => 2,
					'description'            => $sib_first_step_description,
					'plugin'                 => 'mailin',
					'path'                   => 'mailin/sendinblue.php',
					'redirect_after_install' => $control_link,
					'details'                => array(
						'description' => $sib_second_step_description,
						'link'        => 'http://bit.ly/sibcwp',
						'label'       => esc_html__( 'Create SendinBlue Account', 'zerif' ),
						'check'       => class_exists( 'SIB_Manager' ) && method_exists( 'SIB_Manager', 'is_done_validation' ) ? SIB_Manager::is_done_validation() : false,
					),
				),
				'Zerif_Plugin_Install'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_subscribe_title',
				array(
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'STAY IN TOUCH', 'zerif' ),
				),
				array(
					'label'    => esc_html__( 'Main title', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-subscribe',
					'priority' => 3,
				),
				null,
				array(
					'selector'        => '#subscribe h3',
					'settings'        => 'zerif_subscribe_title',
					'render_callback' => array( $this, 'subscribe_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_subscribe_subtitle',
				array(
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Sign Up for Email Updates on on News & Offers', 'zerif' ),
				),
				array(
					'label'    => esc_html__( 'Subtitle', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-subscribe',
					'priority' => 4,
				),
				null,
				array(
					'selector'        => '#subscribe div.sub-heading',
					'settings'        => 'zerif_subscribe_subtitle',
					'render_callback' => array( $this, 'subscribe_subtitle_render_callback' ),
				)
			)
		);
	}

	/**
	 * Add Subscribe colors section.
	 */
	private function add_subscribe_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_subscribe_color_section',
				array(
					'title'    => esc_html__( 'Subscribe', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 120,
				)
			)
		);
	}

	/**
	 * Add color controls
	 */
	private function add_color_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_subscribe_background',
				array(
					'default'           => apply_filters( 'zerif_subscribe_background_filter', 'rgba(0, 0, 0, 0.5)' ),
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'zerif_sanitize_rgba',
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'section'  => 'zerif_subscribe_color_section',
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_subscribe_header_color',
				array(
					'default'           => apply_filters( 'zerif_subscribe_header_color_filter', '#fff' ),
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Title and subtitle colors', 'zerif' ),
					'section'  => 'zerif_subscribe_color_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_subscribe_button_background_color',
				array(
					'default'           => apply_filters( 'zerif_subscribe_button_background_color_filter', '#e96656' ),
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Button background color', 'zerif' ),
					'section'  => 'zerif_subscribe_color_section',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_subscribe_button_background_color_hover',
				array(
					'default'           => apply_filters( 'zerif_subscribe_button_background_color_hover_filter', '#cb4332' ),
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Button background color - hover', 'zerif' ),
					'section'  => 'zerif_subscribe_color_section',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_subscribe_button_color',
				array(
					'default'           => apply_filters( 'zerif_subscribe_button_color_filter', '#fff' ),
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Button text color', 'zerif' ),
					'section'  => 'zerif_subscribe_color_section',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);
	}

	/**
	 * Render callback for zerif_subscribe_title
	 *
	 * @return mixed
	 */
	public function subscribe_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_subscribe_title' ) );
	}

	/**
	 * Render callback for zerif_subscribe_subtitle
	 *
	 * @return mixed
	 */
	public function subscribe_subtitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_subscribe_subtitle' ) );
	}


}
