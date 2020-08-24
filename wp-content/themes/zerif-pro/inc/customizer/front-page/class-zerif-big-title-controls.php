<?php
/**
 * Big title customizer controls.
 *
 * @package zerif
 */

/**
 * Class Zerif_Customizer_Main
 */
class Zerif_Big_Title_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_big_title_colors_section();
		$this->add_tabs();
		$this->add_content_controls();
		$this->add_extra_controls();
		$this->add_parallax_controls();
		$this->add_color_controls();
	}


	/**
	 * Add the section for Big Title colors.
	 */
	private function add_big_title_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_bigtitle_colors_section',
				array(
					'title'    => esc_html__( 'Big title', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 20,
				)
			)
		);
	}

	/**
	 * Add tabs control
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_big_title_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'sidebar-widgets-sidebar-big-title',
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
							'zerif_bigtitle_show'          => array(),
							'zerif_bigtitle_title'         => array(),
							'zerif_bigtitle_redbutton_label' => array(),
							'zerif_bigtitle_redbutton_url' => array(),
							'zerif_bigtitle_greenbutton_label' => array(),
							'zerif_bigtitle_greenbutton_url' => array(),
						),
						'extra'   => array(
							'zerif_bigtitle_alignment' => array(
								'left'   => array(
									'widgets',
								),
								'center' => array(),
								'right'  => array(
									'widgets',
								),
							),
							'zerif_bigtitle_slider_shortcode' => array(),
							'zerif_parallax_headings'  => array(),
							'zerif_parallax_show'      => array(),
							'zerif_parallax_img1'      => array(),
							'zerif_parallax_img2'      => array(),
						),
					),
				),
				'Zerif_Customize_Control_Tabs'
			)
		);
	}

	/**
	 * Add about section content editor control.
	 */
	private function add_content_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide big title section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Big title section will disappear from homepage.', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-big-title',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_title',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'To add a title here please go to Customizer, "Big title section"', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Big title', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-big-title',
					'priority' => 2,
				),
				null,
				array(
					'selector'        => '.home-header-wrap .intro-text',
					'settings'        => 'zerif_bigtitle_title',
					'render_callback' => array( $this, 'bigtitle_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_redbutton_label',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'One button', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'       => esc_html__( 'First button label', 'zerif' ),
					'description' => esc_html__( 'This is the text that will appear on the first button', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-big-title',
					'priority'    => 3,
				),
				null,
				array(
					'selector'        => '.buttons a.red-btn',
					'settings'        => 'zerif_bigtitle_redbutton_label',
					'render_callback' => array( $this, 'bigtitle_redbutton_label_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_redbutton_url',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => '#',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'       => esc_html__( 'First button link', 'zerif' ),
					'description' => esc_html__( 'The first button is linked to this URL', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-big-title',
					'priority'    => 4,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_greenbutton_label',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Another button', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'       => esc_html__( 'Second button label', 'zerif' ),
					'description' => esc_html__( 'This is the text that will appear on the second button', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-big-title',
					'priority'    => 5,
				),
				null,
				array(
					'selector'        => '.buttons a.green-btn',
					'settings'        => 'zerif_bigtitle_greenbutton_label',
					'render_callback' => array( $this, 'bigtitle_greenbutton_label_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_greenbutton_url',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => '#',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'       => esc_html__( 'Second button link', 'zerif' ),
					'description' => esc_html__( 'The second button is linked to this URL', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-big-title',
					'priority'    => 6,
				)
			)
		);
	}

	/**
	 * Extra controls
	 */
	private function add_extra_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_alignment',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => 'center',
				),
				array(
					'label'       => esc_html__( 'Layout', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-big-title',
					'priority'    => -1,
					'choices'     => array(
						'left'   => array(
							'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAD1BMVEX////V1dUAhbo+yP/u9/pRM+FMAAAAZElEQVR42u3WsQ2AIBRFUd0AV3AFV3D/mSwsBI2BRIofPKchobjVK/7EQJZSit+az5/aq/WjVs99AQAjWxs8L4ZL0hqutTcoWt0OSa2orfdVaWl9b/XcqpbWvbXltLQCtwCA3AHhDKjAJvDMEwAAAABJRU5ErkJggg==',
						),
						'center' => array(
							'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAD1BMVEX///8AhbrV1dU+yP/u9/q7NurVAAAAV0lEQVR42u3SsQ2AMAxFwYBYgA0QK7AC+89EQQOiIIoogn3XWHLxql8IZL1b+m+N5+ftaiVqfbkvACC8YW6iFbg17U0KCVQNTUvr0YK+bFdaWklaAPAXB4dWiADE72glAAAAAElFTkSuQmCC',
						),
						'right'  => array(
							'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAD1BMVEX////V1dUAhbo+yP/u9/pRM+FMAAAAYElEQVR42u3SuQ2AMBBFQaAC3AIt0AL910RAAkICS1xrPJOstMGLfsOPpK0+fqtdPmdXq6LWnfsCAKJJe4+0hhxaVbWmHB9sVStCq7u8Ly2td7aqpXVsXNPSKrAFAOWbASNgr0b3Lh1kAAAAAElFTkSuQmCC',
						),
					),
					'subcontrols' => array(
						'left'   => array(
							'widgets',
						),
						'center' => array(),
						'right'  => array(
							'widgets',
						),
					),
				),
				'Zerif_Radio_Image_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_slider_shortcode',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
				),
				array(
					'label'       => esc_html__( 'Slider shortcode', 'zerif' ),
					/* translators: %s is Plugin name */
					'description' => function_exists( 'nivo_slider' ) ? '' : sprintf( __( 'You can replace the homepage slider with any plugin you like, just copy the shortcode generated and paste it here. We recommend you to use %s .', 'zerif' ), sprintf( '<a href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=nivo-slider-lite' ), 'install-plugin_nivo-slider-lite' ) ) . '" rel="nofollow">%s</a>', esc_html__( 'Nivo Slider', 'zerif' ) ) ),
					'section'     => 'sidebar-widgets-sidebar-big-title',
					'priority'    => 10,
				)
			)
		);

	}

	/**
	 * Add parallax controls
	 */
	private function add_parallax_controls() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_parallax_headings',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'            => esc_html__( 'Parallax settings', 'zerif' ),
					'section'          => 'sidebar-widgets-sidebar-big-title',
					'priority'         => 300,
					'class'            => 'advanced-sidebar-accordion',
					'accordion'        => true,
					'controls_to_wrap' => 3,
					'expanded'         => false,
				),
				'Zerif_Customize_Control_Heading'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_parallax_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
				),
				array(
					'type'     => 'checkbox',
					'label'    => esc_html__( 'Use parallax effect?', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-big-title',
					'priority' => 310,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_parallax_img1',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => get_template_directory_uri() . '/images/background1.jpg',
				),
				array(
					'label'    => esc_html__( 'Image 1', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-big-title',
					'priority' => 320,
				),
				'WP_Customize_Image_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_parallax_img2',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => get_template_directory_uri() . '/images/background2.png',
				),
				array(
					'label'    => esc_html__( 'Image 2', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-big-title',
					'priority' => 330,
				),
				'WP_Customize_Image_Control'
			)
		);
	}

	/**
	 * Add big title color controls
	 */
	private function add_color_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_background_filter', 'rgba(0, 0, 0, 0.5)' ),
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'palette'  => true,
					'section'  => 'zerif_bigtitle_colors_section',
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_header_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_header_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Big title color', 'zerif' ),
					'section'  => 'zerif_bigtitle_colors_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_1button_background_color',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_1button_background_color_filter', '#e96656' ),
				),
				array(
					'label'    => esc_html__( 'First button background color', 'zerif' ),
					'palette'  => true,
					'section'  => 'zerif_bigtitle_colors_section',
					'priority' => 3,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_1button_background_color_hover',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_1button_background_color_hover_filter', '#cb4332' ),
				),
				array(
					'label'    => esc_html__( 'First button background color - hover', 'zerif' ),
					'palette'  => true,
					'section'  => 'zerif_bigtitle_colors_section',
					'priority' => 4,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_1button_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_1button_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'First button text color', 'zerif' ),
					'section'  => 'zerif_bigtitle_colors_section',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_1button_color_hover',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_1button_color_hover_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'First button text color - hover', 'zerif' ),
					'section'  => 'zerif_bigtitle_colors_section',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_2button_background_color',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_2button_background_color_filter', '#20AA73' ),
				),
				array(
					'label'    => esc_html__( 'Second button background color', 'zerif' ),
					'section'  => 'zerif_bigtitle_colors_section',
					'palette'  => true,
					'priority' => 7,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_2button_background_color_hover',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_2button_background_color_hover_filter', '#069059' ),
				),
				array(
					'label'    => esc_html__( 'Second button background color - hover', 'zerif' ),
					'section'  => 'zerif_bigtitle_colors_section',
					'palette'  => true,
					'priority' => 8,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_2button_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_2button_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Second button text color', 'zerif' ),
					'section'  => 'zerif_bigtitle_colors_section',
					'priority' => 9,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_bigtitle_2button_color_hover',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_bigtitle_2button_color_hover_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Second button text color - hover', 'zerif' ),
					'section'  => 'zerif_bigtitle_colors_section',
					'priority' => 10,
				),
				'WP_Customize_Color_Control'
			)
		);
	}

	/**
	 * Render callback for zerif_bigtitle_title
	 *
	 * @return mixed
	 */
	public function bigtitle_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_bigtitle_title' ) );
	}

	/**
	 * Render callback for zerif_bigtitle_redbutton_label
	 *
	 * @return mixed
	 */
	public function bigtitle_redbutton_label_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_bigtitle_redbutton_label' ) );
	}

	/**
	 * Render callback for zerif_bigtitle_greenbutton_label
	 *
	 * @return mixed
	 */
	public function bigtitle_greenbutton_label_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_bigtitle_greenbutton_label' ) );
	}
}
