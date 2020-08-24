<?php
/**
 * Subscribe section
 *
 * @package zerif
 */

$zerif_subscribe_show = get_theme_mod( 'zerif_subscribe_show' );

zerif_before_subscribe_trigger();

if ( ! empty( $zerif_subscribe_show ) ) {

	echo '<section class="newsletter" id="subscribe">';

} elseif ( is_customize_preview() ) {

	echo '<section class="newsletter zerif_hidden_if_not_customizer" id="subscribe">';

}

zerif_top_subscribe_trigger();

if ( ! empty( $zerif_subscribe_show ) || is_customize_preview() ) {

	echo '<div class="container">';

	/* Title */
	zerif_subscribe_header_title_trigger();

	/* Subtitle */
	zerif_subscribe_header_subtitle_trigger();

	if ( is_active_sidebar( 'sidebar-subscribe' ) ) {
		dynamic_sidebar( 'sidebar-subscribe' );
	}

	echo '</div> <!-- / END CONTAINER -->';

	zerif_bottom_subscribe_trigger();

	echo '</section> <!-- / END NEWSLETTER SECTION -->';

}

zerif_after_subscribe_trigger();
