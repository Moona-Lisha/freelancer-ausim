<?php
/**
 * Packages section's customizer controls.
 *
 * @package zerif
 */

/**
 * Class Zerif_Packages_Controls
 */
class Zerif_Packages_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_tabs();
		$this->add_content_controls();
		$this->add_packages_colors_section();
		$this->add_color_controls();
	}

	/**
	 * Add tabs in Packages section.
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_packages_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'sidebar-widgets-sidebar-packages',
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
							'zerif_packages_show'     => array(),
							'zerif_packages_title'    => array(),
							'zerif_packages_subtitle' => array(),
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
				'zerif_packages_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Show packages section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Packages section will appear on homepage.', 'zerif' ),
					'section'     => 'sidebar-widgets-sidebar-packages',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_packages_title',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'PACKAGES', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Main title', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-packages',
					'priority' => 2,
				),
				null,
				array(
					'selector'        => '#pricingtable h2',
					'settings'        => 'zerif_packages_title',
					'render_callback' => array( $this, 'packages_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_packages_subtitle',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'We have 4 friendly packages for you. Check all the packages and choose the right one for you.', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Subtitle', 'zerif' ),
					'section'  => 'sidebar-widgets-sidebar-packages',
					'priority' => 3,
				),
				null,
				array(
					'selector'        => '#pricingtable h6',
					'settings'        => 'zerif_packages_subtitle',
					'render_callback' => array( $this, 'packages_subtitle_render_callback' ),
				)
			)
		);
	}

	/**
	 * Add colors section for Packages.
	 */
	private function add_packages_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_packages_colors_section',
				array(
					'title'    => esc_html__( 'Packages', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 100,
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
				'zerif_packages_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'default'           => apply_filters( 'zerif_packages_background_filter', 'rgba(0, 0, 0, 0.5)' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'section'  => 'zerif_packages_colors_section',
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_packages_header',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => apply_filters( 'zerif_packages_header_filter', '#fff' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Title and subtitle colors', 'zerif' ),
					'section'  => 'zerif_packages_colors_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_package_title_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => apply_filters( 'zerif_package_title_color_filter', '#ffffff' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Package title color', 'zerif' ),
					'section'  => 'zerif_packages_colors_section',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_package_text_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => apply_filters( 'zerif_package_text_color_filter', '#808080' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Package text color', 'zerif' ),
					'section'  => 'zerif_packages_colors_section',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_package_button_text_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => apply_filters( 'zerif_package_button_text_color_filter', '#fff' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Package button text color', 'zerif' ),
					'section'  => 'zerif_packages_colors_section',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_package_price_background_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => apply_filters( 'zerif_package_price_background_color_filter', '#404040' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Package price background color', 'zerif' ),
					'section'  => 'zerif_packages_colors_section',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_package_price_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => apply_filters( 'zerif_package_price_color_filter', '#fff' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Package price color', 'zerif' ),
					'section'  => 'zerif_packages_colors_section',
					'priority' => 7,
				),
				'WP_Customize_Color_Control'
			)
		);
	}

	/**
	 * Render callback for zerif_packages_title
	 *
	 * @return mixed
	 */
	public function packages_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_packages_title' ) );
	}

	/**
	 * Render callback for zerif_packages_subtitle
	 *
	 * @return mixed
	 */
	public function packages_subtitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_packages_subtitle' ) );
	}

}
