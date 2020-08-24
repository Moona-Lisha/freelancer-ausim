<?php
/**
 * Our focus section
 *
 * @package zerif
 */

$zerif_ourfocus_show = get_theme_mod( 'zerif_ourfocus_show' );

zerif_before_our_focus_trigger();

if ( isset( $zerif_ourfocus_show ) && $zerif_ourfocus_show != 1 ) {

	echo '<section class="focus" id="focus">';

} elseif ( is_customize_preview() ) {

	echo '<section class="focus zerif_hidden_if_not_customizer" id="focus">';

}

zerif_top_our_focus_trigger();

if ( ( isset( $zerif_ourfocus_show ) && $zerif_ourfocus_show != 1 ) || is_customize_preview() ) {

	echo '<div class="container">';

	/* SECTION HEADER */

	echo '<div class="section-header">';

	/* Title */
	zerif_our_focus_header_title_trigger();

	/* Subtitle */
	zerif_our_focus_header_subtitle_trigger();

	echo '</div><!-- .section-header -->';

	echo '<div class="row">';

	if ( is_active_sidebar( 'sidebar-ourfocus' ) ) {

		dynamic_sidebar( 'sidebar-ourfocus' );

	} else {

		the_widget(
			'zerif_ourfocus',
			'title=Box 1&text=text&link=#&image_uri=' . get_template_directory_uri() . '/images/focus.png',
			array(
				'before_widget' => '<span>',
				'after_widget'  => '</span>',
			)
		);

		the_widget(
			'zerif_ourfocus',
			'title=Box 2&text=text&link=#&image_uri=' . get_template_directory_uri() . '/images/focus.png',
			array(
				'before_widget' => '<span>',
				'after_widget'  => '</span>',
			)
		);

		the_widget(
			'zerif_ourfocus',
			'title=Box 3&text=text&link=#&image_uri=' . get_template_directory_uri() . '/images/focus.png',
			array(
				'before_widget' => '<span>',
				'after_widget'  => '</span>',
			)
		);

		the_widget(
			'zerif_ourfocus',
			'title=Box 4&text=text&link=#&image_uri=' . get_template_directory_uri() . '/images/focus.png',
			array(
				'before_widget' => '<span>',
				'after_widget'  => '</span>',
			)
		);

	}

	echo '</div>';

	echo '</div> <!-- / END CONTAINER -->';

	zerif_bottom_our_focus_trigger();

	echo '</section>  <!-- / END FOCUS SECTION -->';

}

zerif_after_our_focus_trigger();
