<?php
/**
 * Compatibility functions for Dokan Multivendor functions
 *
 * @package zerif
 */

/**
 * Enqueue style for dokan plugin.
 */
function zerif_enqueue_dokan_style() {
	wp_enqueue_style( 'zerif-dokan-style', get_template_directory_uri() . '/inc/plugins-compatibility/dokan/css/style.css', false, ZERIF_VERSION );
}
add_action( 'wp_enqueue_scripts', 'zerif_enqueue_dokan_style' );

/**
 * Add wraper for new-product-single for Dokan
 */
function zerif_dokan_before_wrap() {
	?>
	<div class="clear"></header><div id="content" class="site-content"><div class="container"><div class="content-left-wrap col-md-12">
	<?php
}
add_action( 'dokan_dashboard_wrap_before', 'zerif_dokan_before_wrap' );

/**
 * Close wrapper for new-product-single for Dokan
 */
function zerif_dokan_after_wrap() {

	?>
	</div></div></div>
	<?php
}
add_action( 'dokan_dashboard_wrap_after', 'zerif_dokan_after_wrap' );
