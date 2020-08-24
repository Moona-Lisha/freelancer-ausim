<?php
/**
 * Latest News section's customizer controls.
 *
 * @package zerif
 */

/**
 * Class Zerif_Latest_News_Controls
 */
class Zerif_Latest_News_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_latest_news_section();
		$this->add_tabs();
		$this->add_content_controls();
		$this->add_extra_controls();
		$this->add_latest_news_colors_section();
		$this->add_color_controls();
	}

	/**
	 * Add Latest news section in Frontpage sections panel.
	 */
	private function add_latest_news_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_latest_news_section',
				array(
					'title'    => esc_html__( 'Latest news section', 'zerif' ),
					'panel'    => 'zerif_frontpage_sections',
					'priority' => 65,
				)
			)
		);
	}

	/**
	 * Add tabs in Latest news section.
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latest_news_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'zerif_latest_news_section',
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
							'zerif_latest_news_show'    => array(),
							'zerif_latestnews_title'    => array(),
							'zerif_latestnews_subtitle' => array(),
						),
						'extra'   => array(
							'zerif_latest_news_content' => array(),
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
				'zerif_latest_news_show',
				array(
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'zerif_sanitize_checkbox',
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Show latest news section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Latest news section will appear on homepage.', 'zerif' ),
					'section'     => 'zerif_latest_news_section',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_title',
				array(
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'LATEST NEWS', 'zerif' ),
				),
				array(
					'label'    => esc_html__( 'Main title', 'zerif' ),
					'section'  => 'zerif_latest_news_section',
					'priority' => 2,
				),
				null,
				array(
					'selector'        => '#latestnews h2',
					'settings'        => 'zerif_latestnews_title',
					'render_callback' => array( $this, 'latestnews_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_subtitle',
				array(
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Add a subtitle in Customizer, "Latest news section"', 'zerif' ),
				),
				array(
					'label'    => esc_html__( 'Subtitle', 'zerif' ),
					'section'  => 'zerif_latest_news_section',
					'priority' => 3,
				),
				null,
				array(
					'selector'        => '#latestnews h6',
					'settings'        => 'zerif_latestnews_subtitle',
					'render_callback' => array( $this, 'latestnews_subtitle_render_callback' ),
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
				'zerif_latest_news_content',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
				),
				array(
					'type'        => 'hidden',
					'description' => __( 'The main content of this section consists of blog posts.', 'zerif' ),
					'section'     => 'zerif_latest_news_section',
					'priority'    => 1,
				)
			)
		);
	}

	/**
	 * Add Latest news colors section.
	 */
	private function add_latest_news_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_latest_news_colors_section',
				array(
					'title'    => esc_html__( 'Latest news', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 110,
				)
			)
		);
	}

	/**
	 * Add colors.
	 */
	private function add_color_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_background',
				array(
					'default'           => apply_filters( 'zerif_latestnews_background_filter', 'rgba(255, 255, 255, 1)' ),
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'zerif_sanitize_rgba',
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'palette'  => true,
					'section'  => 'zerif_latest_news_colors_section',
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_header_title_color',
				array(
					'default'           => apply_filters( 'zerif_latestnews_header_title_color_filter', '#404040' ),
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Title color', 'zerif' ),
					'section'  => 'zerif_latest_news_colors_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_header_subtitle_color',
				array(
					'default'           => apply_filters( 'zerif_latestnews_header_subtitle_color_filter', '#808080' ),
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Subtitle color', 'zerif' ),
					'section'  => 'zerif_latest_news_colors_section',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_post_title_color',
				array(
					'default'           => apply_filters( 'zerif_latestnews_post_title_color_filter', '#404040' ),
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Post title color', 'zerif' ),
					'section'  => 'zerif_latest_news_colors_section',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_post_underline_color1',
				array(
					'default'           => apply_filters( 'zerif_latestnews_post_underline_color1_filter', '#e96656' ),
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Post title underline color - first box', 'zerif' ),
					'section'  => 'zerif_latest_news_colors_section',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_post_underline_color2',
				array(
					'default'           => apply_filters( 'zerif_latestnews_post_underline_color2_filter', '#34d293' ),
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Post title underline color - second box', 'zerif' ),
					'section'  => 'zerif_latest_news_colors_section',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_post_underline_color3',
				array(
					'default'           => apply_filters( 'zerif_latestnews_post_underline_color3_filter', '#3ab0e2' ),
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Post title underline color - third box', 'zerif' ),
					'section'  => 'zerif_latest_news_colors_section',
					'priority' => 7,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_post_underline_color4',
				array(
					'default'           => apply_filters( 'zerif_latestnews_post_underline_color4_filter', '#f7d861' ),
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Post title underline color - fourth box', 'zerif' ),
					'section'  => 'zerif_latest_news_colors_section',
					'priority' => 8,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_latestnews_post_text_color',
				array(
					'default'           => apply_filters( 'zerif_latestnews_post_text_color_filter', '#909090' ),
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'sanitize_hex_color',
				),
				array(
					'label'    => esc_html__( 'Post content color', 'zerif' ),
					'section'  => 'zerif_latest_news_colors_section',
					'priority' => 9,
				),
				'WP_Customize_Color_Control'
			)
		);
	}

	/**
	 * Render callback for zerif_latestnews_title
	 *
	 * @return mixed
	 */
	public function latestnews_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_latestnews_title' ) );
	}

	/**
	 * Render callback for zerif_latestnews_subtitle
	 *
	 * @return mixed
	 */
	public function latestnews_subtitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_latestnews_subtitle' ) );
	}


}
