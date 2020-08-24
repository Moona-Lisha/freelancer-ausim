<?php
/**
 * Controls for blog.
 *
 * @package zerif
 */

/**
 * Class Zerif_Blog_Controls
 */
class Zerif_Blog_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add customizer controls.
	 */
	public function add_controls() {
		$this->add_blog_section();
		$this->add_blog_layout_controls();
	}

	/**
	 * Add blog section.
	 */
	private function add_blog_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_blog_options',
				array(
					'title'    => esc_html__( 'Blog Options', 'zerif' ),
					'priority' => 70,
				)
			)
		);
	}

	/**
	 * Add blog layout controls.
	 */
	private function add_blog_layout_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_enable_blog_header',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'default'           => false,
				),
				array(
					'type'     => 'checkbox',
					'label'    => __( 'Enable Blog Header', 'zerif' ),
					'section'  => 'zerif_blog_options',
					'priority' => 10,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_blog_sidebar_layout',
				array(
					'sanitize_callback' => 'sanitize_key',
					'default'           => 'sidebar-right',
				),
				array(
					'label'    => esc_html__( 'Blog Sidebar Layout', 'zerif' ),
					'section'  => 'zerif_blog_options',
					'priority' => 20,
					'choices'  => array(
						'full-width'    => array(
							'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAQMAAABknzrDAAAABlBMVEX////V1dXUdjOkAAAAPUlEQVRIx2NgGAUkAcb////Y/+d/+P8AdcQoc8vhH/X/5P+j2kG+GA3CCgrwi43aMWrHqB2jdowEO4YpAACyKSE0IzIuBgAAAABJRU5ErkJggg==',
							'label' => esc_html__( 'Full Width', 'zerif' ),
						),
						'sidebar-left'  => array(
							'url'   => apply_filters( 'zerif_layout_control_image_left', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAgMAAAAjP0ATAAAACVBMVEX///8+yP/V1dXG9YqxAAAAWElEQVR42mNgGAXDE4RCQMDAKONaBQINWqtWrWBatQDIaxg8ygYqQIAOYwC6bwHUmYNH2eBPSMhgBQXKRr0w6oVRL4x6YdQLo14Y9cKoF0a9QCO3jYLhBADvmFlNY69qsQAAAABJRU5ErkJggg==' ),
							'label' => esc_html__( 'Left Sidebar', 'zerif' ),
						),
						'sidebar-right' => array(
							'url'   => apply_filters( 'zerif_layout_control_image_right', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAgMAAAAjP0ATAAAACVBMVEX///8+yP/V1dXG9YqxAAAAWUlEQVR42mNgGAUjB4iGgkEIzZStAoEVTECiQWsVkLdiECkboAABOmwBF9BtUGcOImUDEiCkJCQU0ECBslEvjHph1AujXhj1wqgXRr0w6oVRLwyEF0bBUAUAz/FTNXm+R/MAAAAASUVORK5CYII=' ),
							'label' => esc_html__( 'Right Sidebar', 'zerif' ),
						),
					),
				),
				'Zerif_Radio_Image_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_blog_grid_layout',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => '1',
				),
				array(
					'type'     => 'select',
					'label'    => esc_html__( 'Grid Layout', 'zerif' ),
					'section'  => 'zerif_blog_options',
					'choices'  => array(
						'1' => esc_html__( '1 Column', 'zerif' ),
						'2' => esc_html__( '2 Columns', 'zerif' ),
						'3' => esc_html__( '3 Columns', 'zerif' ),
						'4' => esc_html__( '4 Columns', 'zerif' ),
					),
					'priority' => 30,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_enable_masonry',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => false,
				),
				array(
					'type'     => 'checkbox',
					'label'    => __( 'Enable Masonry', 'zerif' ),
					'section'  => 'zerif_blog_options',
					'priority' => 40,
				)
			)
		);
	}
}
