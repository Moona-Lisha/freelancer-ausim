<?php
/**
 * Testimonials section
 *
 * @package zerif
 */

$zerif_testimonials_show = get_theme_mod( 'zerif_testimonials_show' );

zerif_before_testimonials_trigger();

if ( isset( $zerif_testimonials_show ) && $zerif_testimonials_show != 1 ) {

	echo '<section class="testimonial" id="testimonials">';

} elseif ( is_customize_preview() ) {

	echo '<section class="testimonial zerif_hidden_if_not_customizer" id="testimonials">';

}

zerif_top_testimonials_trigger();

if ( ( isset( $zerif_testimonials_show ) && $zerif_testimonials_show != 1 ) || is_customize_preview() ) {

	echo '<div class="container">';

	echo '<div class="section-header">';

	/* Title */
	zerif_testimonials_header_title_trigger();

	/* Subtitle */
	zerif_testimonials_header_subtitle_trigger();

	echo '</div>';


	echo '<div class="row" data-scrollreveal="enter right after 0s over 1s">';


	echo '<div class="col-md-12">';

	$pinterest_style                    = '';
	$zerif_testimonials_pinterest_style = get_theme_mod( 'zerif_testimonials_pinterest_style' );

	if ( isset( $zerif_testimonials_pinterest_style ) && $zerif_testimonials_pinterest_style != 0 ) {
		$pinterest_style = 'testimonial-masonry';
	}

	echo '<div id="client-feedbacks" class="' . esc_html( $pinterest_style ) . ' owl-theme">';

	if ( is_active_sidebar( 'sidebar-testimonials' ) ) {
		dynamic_sidebar( 'sidebar-testimonials' );
	} else {

		the_widget(
			'zerif_testimonial_widget',
			'title=John Dow&text=Add a testimonial widget in the "Widgets: Testimonials section" in Customizer',
			array(
				'before_widget' => '<div class="widget feedback-box">',
				'after_widget'  => '</div>',
			)
		);
		the_widget(
			'zerif_testimonial_widget',
			'title=John Dow&text=Add a testimonial widget in the "Widgets: Testimonials section" in Customizer',
			array(
				'before_widget' => '<div class="widget feedback-box">',
				'after_widget'  => '</div>',
			)
		);
		the_widget(
			'zerif_testimonial_widget',
			'title=John Dow&text=Add a testimonial widget in the "Widgets: Testimonials section" in Customizer',
			array(
				'before_widget' => '<div class="widget feedback-box"> ',
				'after_widget'  => '</div>',
			)
		);

	}

	echo '</div>';


	echo '</div>';


	echo '</div>';


	echo '</div>';

	zerif_bottom_testimonials_trigger();

	echo '</section>';

} // End if().

zerif_after_testimonials_trigger();
