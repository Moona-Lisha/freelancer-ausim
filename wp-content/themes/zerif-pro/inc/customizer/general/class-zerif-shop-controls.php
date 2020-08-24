<?php
/**
 * Controls for shop page.
 *
 * @package zerif
 */

/**
 * Class Zerif_Shop_Controls
 */
class Zerif_Shop_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls
	 */
	public function add_controls() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}
		$this->add_layout_controls();
	}

	/**
	 * Add Layout controls.
	 */
	private function add_layout_controls() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_shop_sidebar_alignment',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => 'full-width',
				),
				array(
					'label'    => esc_html__( 'Layout', 'zerif' ),
					'section'  => 'woocommerce_product_catalog',
					'priority' => 1,
					'choices'  => array(
						'full-width'    => array(
							'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAQMAAABknzrDAAAABlBMVEX////V1dXUdjOkAAAAPUlEQVRIx2NgGAUkAcb////Y/+d/+P8AdcQoc8vhH/X/5P+j2kG+GA3CCgrwi43aMWrHqB2jdowEO4YpAACyKSE0IzIuBgAAAABJRU5ErkJggg==',
							'label' => esc_html__( 'Full Width', 'zerif' ),
						),
						'sidebar-left'  => array(
							'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAgMAAAAjP0ATAAAACVBMVEX///8+yP/V1dXG9YqxAAAAWElEQVR42mNgGAXDE4RCQMDAKONaBQINWqtWrWBatQDIaxg8ygYqQIAOYwC6bwHUmYNH2eBPSMhgBQXKRr0w6oVRL4x6YdQLo14Y9cKoF0a9QCO3jYLhBADvmFlNY69qsQAAAABJRU5ErkJggg==',
							'label' => esc_html__( 'Left Sidebar', 'zerif' ),
						),
						'sidebar-right' => array(
							'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAgMAAAAjP0ATAAAACVBMVEX///8+yP/V1dXG9YqxAAAAWUlEQVR42mNgGAUjB4iGgkEIzZStAoEVTECiQWsVkLdiECkboAABOmwBF9BtUGcOImUDEiCkJCQU0ECBslEvjHph1AujXhj1wqgXRr0w6oVRLwyEF0bBUAUAz/FTNXm+R/MAAAAASUVORK5CYII=',
							'label' => esc_html__( 'Right Sidebar', 'zerif' ),
						),
					),
				),
				'Zerif_Radio_Image_Control'
			)
		);
	}


}
