<?php
/**
 * Functions used for WooCommerce compatibility.
 *
 * @package zerif
 */

/**
 * Enqueue WooCommerce script.
 */
function zerif_enqueue_woo_scripts() {
	if ( ! class_exists( 'WooCommerce' ) || ! is_woocommerce() ) {
		return;
	}
	wp_enqueue_script( 'zerif-woocommerce-script', get_template_directory_uri() . '/inc/compatibility/woocommerce/script.js', array( 'jquery' ), ZERIF_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'zerif_enqueue_woo_scripts' );

/**
 * Add toggle button for sidebar.
 */
function zerif_woocommerce_before_main_content() {

	$shop_sidebar_layout = apply_filters( 'zerif_shop_sidebar_layout', get_theme_mod( 'zerif_shop_sidebar_alignment', 'full-width' ) );
	if ( $shop_sidebar_layout === 'full-width' ) {
		return;
	}

	if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
		return;
	}

	echo '<div class="sidebar-toggle-wrapper">';
		echo '<span class="zerif-sidebar-open">';
		echo '<i class="fa fa-filter" aria-hidden="true"></i>';
		echo '</span>';
	echo '</div>';

}
