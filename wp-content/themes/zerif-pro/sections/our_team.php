<?php
/**
 * Our team section
 *
 * @package zerif
 */

$zerif_ourteam_show = get_theme_mod( 'zerif_ourteam_show' );

zerif_before_our_team_trigger();

if ( isset( $zerif_ourteam_show ) && $zerif_ourteam_show != 1 ) {

	echo '<section class="our-team" id="team">';

} elseif ( is_customize_preview() ) {

	echo '<section class="our-team zerif_hidden_if_not_customizer" id="team">';

}

zerif_top_our_team_trigger();

if ( ( isset( $zerif_ourteam_show ) && $zerif_ourteam_show != 1 ) || is_customize_preview() ) {

	echo '<div class="container">';

		echo '<div class="section-header">';

			/* Title */
			zerif_our_team_header_title_trigger();

			/* Subtitle */
			zerif_our_team_header_subtitle_trigger();

		echo '</div>';

	if ( is_active_sidebar( 'sidebar-ourteam' ) ) {
		echo '<div class="row" data-scrollreveal="enter left after 0s over 2s">';
		dynamic_sidebar( 'sidebar-ourteam' );
		echo '</div> ';
	} else {
		echo '<div class="row" data-scrollreveal="enter left after 0s over 2s">';
		the_widget(
			'zerif_team_widget',
			'name=Member 1&position=CEO&description=text about this member&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri=' . get_template_directory_uri() . '/images/product-bg.png',
			array(
				'before_widget' => '<span>',
				'after_widget'  => '</span>',
			)
		);
		the_widget(
			'zerif_team_widget',
			'name=Member 2&position=dev&description=text about this member&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri=' . get_template_directory_uri() . '/images/product-bg.png',
			array(
				'before_widget' => '<span>',
				'after_widget'  => '</span>',
			)
		);
		the_widget(
			'zerif_team_widget',
			'name=Member 3&position=hr&description=text about this member&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri=' . get_template_directory_uri() . '/images/product-bg.png',
			array(
				'before_widget' => '<span>',
				'after_widget'  => '</span>',
			)
		);
		the_widget(
			'zerif_team_widget',
			'name=Member 4&position=CEO&description=text about this member&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri=' . get_template_directory_uri() . '/images/product-bg.png',
			array(
				'before_widget' => '<span>',
				'after_widget'  => '</span>',
			)
		);
		echo '</div>';
	}

	echo '</div>';

	zerif_bottom_our_team_trigger();

	echo '</section>';

}

zerif_after_our_team_trigger();
