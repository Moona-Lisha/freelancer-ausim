<?php
/**
 * WooCommerce sidebar on shop.
 *
 * @package zerif
 */

$shop_sidebar_layout = apply_filters( 'zerif_shop_sidebar_layout', get_theme_mod( 'zerif_shop_sidebar_alignment', 'full-width' ) );

if ( is_active_sidebar( 'sidebar-shop' ) ) {
	echo '<div class="col-xs-12 col-md-3 shop-sidebar-wrapper ' . esc_attr( $shop_sidebar_layout ) . '">';
	echo '<div class="sidebar-toggle-wrapper right-side">';
	echo '<span class="zerif-sidebar-close">';
	echo '<i class="fa fa-times" aria-hidden="true"></i>';
	echo '</span>';
	echo '</div>';
	echo '<aside id="secondary" class="shop-sidebar" role="complementary">';
	dynamic_sidebar( 'sidebar-shop' );
	echo '</aside>';
	echo '</div>';
} elseif ( is_customize_preview() ) {
	echo '<div class="col-md-3 empty-shop-sidebar">';
	echo esc_html__( 'This sidebar is active but empty. In order to use this layout, please add widgets in the sidebar', 'zerif' );
	echo '</div>';
}
