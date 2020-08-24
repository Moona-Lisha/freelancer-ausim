<?php
/**
 * Selective refresh functions
 *
 * Partials and callback functions
 *
 * @package zerif
 */

/**
 * Selective refresh
 *
 * @param object $wp_customize Customizer settings.
 */
function zerif_selective_refresh( $wp_customize ) {

	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial(
			'custom_logo',
			array(
				'selector' => '.navbar-brand',
				'settings' => 'custom_logo',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'zerif_bigtitle_title_2',
			array(
				'selector'        => '.home-header-wrap .intro-text',
				'settings'        => 'zerif_bigtitle_title_2',
				'render_callback' => 'zerif_bigtitle_title_2_render_callback',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'zerif_bigtitle_redbutton_label_2',
			array(
				'selector'        => '.buttons a.red-btn',
				'settings'        => 'zerif_bigtitle_redbutton_label_2',
				'render_callback' => 'zerif_bigtitle_redbutton_label_2_render_callback',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'zerif_ourfocus_title_2',
			array(
				'selector'        => '#focus .section-header h2',
				'settings'        => 'zerif_ourfocus_title_2',
				'render_callback' => 'zerif_ourfocus_title_2_render_callback',
			)
		);

		$socials_array = array(
			'facebook',
			'twitter',
			'linkedin',
			'behance',
			'dribbble',
			'pinterest',
			'tumblr',
			'reddit',
			'youtube',
			'instagram',
		);
		foreach ( $socials_array as $social ) {
			$wp_customize->selective_refresh->add_partial(
				'zerif_socials_' . $social,
				array(
					'selector'        => '#footer .social #' . $social,
					'settings'        => 'zerif_socials_' . $social,
					'render_callback' => 'zerif_socials_' . $social . '_render_callback',
				)
			);
		}

		$wp_customize->selective_refresh->add_partial(
			'zerif_socials_googleplus',
			array(
				'selector'        => '#footer .social #google',
				'settings'        => 'zerif_socials_googleplus',
				'render_callback' => 'zerif_socials_googleplus_render_callback',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'zerif_address',
			array(
				'selector'        => '.zerif-footer-address',
				'settings'        => 'zerif_address',
				'render_callback' => 'zerif_address_render_callback',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'zerif_email',
			array(
				'selector'        => '.zerif-footer-email',
				'settings'        => 'zerif_email',
				'render_callback' => 'zerif_email_render_callback',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'zerif_phone',
			array(
				'selector'        => '.zerif-footer-phone',
				'settings'        => 'zerif_phone',
				'render_callback' => 'zerif_phone_render_callback',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'zerif_address_icon',
			array(
				'selector'        => '.company-details .icon-top.red-text',
				'settings'        => 'zerif_address_icon',
				'render_callback' => 'zerif_address_icon_render_callback',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'zerif_email_icon',
			array(
				'selector'        => '.company-details .icon-top.green-text',
				'settings'        => 'zerif_email_icon',
				'render_callback' => 'zerif_email_icon_render_callback',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'zerif_phone_icon',
			array(
				'selector'        => '.company-details .icon-top.blue-text',
				'settings'        => 'zerif_phone_icon',
				'render_callback' => 'zerif_phone_icon_render_callback',
			)
		);
	}

}
add_action( 'customize_register', 'zerif_selective_refresh' );


/**
 * Render callback for zerif_bigtitle_title_2
 *
 * @return mixed
 */
function zerif_bigtitle_title_2_render_callback() {
	return wp_kses_post( get_theme_mod( 'zerif_bigtitle_title_2' ) );
}

/**
 * Render callback for zerif_bigtitle_redbutton_label_2
 *
 * @return mixed
 */
function zerif_bigtitle_redbutton_label_2_render_callback() {
	return wp_kses_post( get_theme_mod( 'zerif_bigtitle_redbutton_label_2' ) );
}

/**
 * Render callback for zerif_ourfocus_title_2
 *
 * @return mixed
 */
function zerif_ourfocus_title_2_render_callback() {
	return wp_kses_post( get_theme_mod( 'zerif_ourfocus_title_2' ) );
}

/**
 * Render callback for zerif_socials_facebook
 *
 * @return mixed
 */
function zerif_socials_facebook_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_socials_facebook' ) ) . '"><span class="sr-only">' . __( 'Facebook link', 'zerif' ) . '</span> <i class="fa fa-facebook"></i></a>';
}
/**
 * Render callback for zerif_socials_twitter
 *
 * @return mixed
 */
function zerif_socials_twitter_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_socials_twitter' ) ) . '"><span class="sr-only">' . __( 'Twitter link', 'zerif' ) . '</span> <i class="fa fa-twitter"></i></a>';
}
/**
 * Render callback for zerif_socials_linkedin
 *
 * @return mixed
 */
function zerif_socials_linkedin_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_socials_linkedin' ) ) . '"><span class="sr-only">' . __( 'Linkedin link', 'zerif' ) . '</span> <i class="fa fa-linkedin"></i></a>';
}
/**
 * Render callback for zerif_socials_behance
 *
 * @return mixed
 */
function zerif_socials_behance_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_socials_behance' ) ) . '"><span class="sr-only">' . __( 'Behance link', 'zerif' ) . '</span> <i class="fa fa-behance"></i></a>';
}
/**
 * Render callback for zerif_socials_dribbble
 *
 * @return mixed
 */
function zerif_socials_dribbble_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_socials_dribbble' ) ) . '"><span class="sr-only">' . __( 'Dribble link', 'zerif' ) . '</span> <i class="fa fa-dribbble"></i></a>';
}
/**
 * Render callback for zerif_socials_googleplus
 *
 * @return mixed
 */
function zerif_socials_googleplus_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_socials_googleplus' ) ) . '"><span class="sr-only">' . __( 'Google Plus link', 'zerif' ) . '</span> <i class="fa fa-google"></i></a>';
}
/**
 * Render callback for zerif_socials_pinterest
 *
 * @return mixed
 */
function zerif_socials_pinterest_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_socials_pinterest' ) ) . '"><span class="sr-only">' . __( 'Pinterest link', 'zerif' ) . '</span> <i class="fa fa-pinterest"></i></a>';
}
/**
 * Render callback for zerif_socials_tumblr
 *
 * @return mixed
 */
function zerif_socials_tumblr_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_socials_tumblr' ) ) . '"><span class="sr-only">' . __( 'Tumblr link', 'zerif' ) . '</span> <i class="fa fa-tumblr"></i></a>';
}
/**
 * Render callback for zerif_socials_reedit
 *
 * @return mixed
 */
function zerif_socials_reddit_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_reddit_tumblr' ) ) . '"><span class="sr-only">' . __( 'Reddit link', 'zerif' ) . '</span> <i class="fa fa-reddit"></i></a>';
}
/**
 * Render callback for zerif_socials_youtube
 *
 * @return mixed
 */
function zerif_socials_youtube_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_youtube_tumblr' ) ) . '"><span class="sr-only">' . __( 'Youtube link', 'zerif' ) . '</span> <i class="fa fa-youtube"></i></a>';
}
/**
 * Render callback for zerif_socials_instagram
 *
 * @return mixed
 */
function zerif_socials_instagram_render_callback() {
	return '<a href="' . esc_url( get_theme_mod( 'zerif_socials_instagram' ) ) . '"><span class="sr-only">' . __( 'Instagram link', 'zerif' ) . '</span> <i class="fa fa-instagram"></i></a>';
}
/**
 * Render callback for zerif_address
 *
 * @return mixed
 */
function zerif_address_render_callback() {
	return wp_kses_post( get_theme_mod( 'zerif_address' ) );
}
/**
 * Render callback for zerif_email
 *
 * @return mixed
 */
function zerif_email_render_callback() {
	return wp_kses_post( get_theme_mod( 'zerif_email' ) );
}
/**
 * Render callback for zerif_phone
 *
 * @return mixed
 */
function zerif_phone_render_callback() {
	return wp_kses_post( get_theme_mod( 'zerif_phone' ) );
}
/**
 * Render callback for zerif_address_icon
 *
 * @return mixed
 */
function zerif_address_icon_render_callback() {
	return '<img src="' . esc_url( get_theme_mod( 'zerif_address_icon' ) ) . '">';
}
/**
 * Render callback for zerif_email_icon
 *
 * @return mixed
 */
function zerif_email_icon_render_callback() {
	return '<img src="' . esc_url( get_theme_mod( 'zerif_email_icon' ) ) . '">';
}
/**
 * Render callback for zerif_phone_icon
 *
 * @return mixed
 */
function zerif_phone_icon_render_callback() {
	return '<img src="' . esc_url( get_theme_mod( 'zerif_phone_icon' ) ) . '">';
}
