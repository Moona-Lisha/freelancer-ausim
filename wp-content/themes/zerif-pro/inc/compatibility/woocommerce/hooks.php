<?php
/**
 * Hooks and filters for WooCommerce pages.
 *
 * @package zerif.
 */

/**
 * Require functions file
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/compatibility/woocommerce/functions.php' );

/**
 * Hook toggle sidebar button before shop loop.
 */
add_action( 'woocommerce_before_shop_loop', 'zerif_woocommerce_before_main_content', 25 );
