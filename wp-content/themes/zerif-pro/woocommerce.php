<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package zerif
 */

get_header();

$shop_sidebar_layout = apply_filters( 'zerif_shop_sidebar_layout', get_theme_mod( 'zerif_shop_sidebar_alignment', 'full-width' ) );
$wrapper_class       = 'content-left-wrap col-md-9 ' . esc_attr( $shop_sidebar_layout );

if ( 'full-width' === $shop_sidebar_layout ||
	( class_exists( 'WooCommerce' ) && ! is_shop() && ! is_product_category() ) ||
	( ! is_active_sidebar( 'sidebar-shop' ) && ! is_customize_preview() ) ) {
	$wrapper_class = 'content-left-wrap col-md-12';
} ?>

	<div class="clear"></div>
</header> <!-- / END HOME SECTION  -->
<?php zerif_after_header_trigger(); ?>
<div id="content" class="site-content">
	<div class="container">
		<?php
		if ( $shop_sidebar_layout === 'sidebar-left' && ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_category() ) ) ) {
			get_sidebar( 'woocommerce' );
		}

		?>
		<div class="<?php echo esc_attr( $wrapper_class ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">
					<?php woocommerce_content(); ?>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .content-left-wrap -->

		<?php

		if ( $shop_sidebar_layout === 'sidebar-right' && ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_category() ) ) ) {
			get_sidebar( 'woocommerce' );
		}
		?>
	</div><!-- .container -->
</div><!-- .site-content -->
<?php get_footer(); ?>
