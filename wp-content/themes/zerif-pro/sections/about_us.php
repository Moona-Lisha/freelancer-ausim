<?php
/**
 * About us section
 *
 * @package zerif
 */

$zerif_aboutus_show = get_theme_mod( 'zerif_aboutus_show' );

zerif_before_about_us_trigger();

if ( isset( $zerif_aboutus_show ) && $zerif_aboutus_show != 1 ) {

	echo '<section class="about-us" id="aboutus">';

} elseif ( is_customize_preview() ) {

	echo '<section class="about-us zerif_hidden_if_not_customizer" id="aboutus">';

}

zerif_top_about_us_trigger();

if ( ( isset( $zerif_aboutus_show ) && $zerif_aboutus_show != 1 ) || is_customize_preview() ) {

	echo '<div class="container">';

	/* SECTION HEADER */

	echo '<div class="section-header">';

	/* Title */
	zerif_about_us_header_title_trigger();

	/* Subtitle */
	zerif_about_us_header_subtitle_trigger();

	echo '</div>';

	/* 3 COLUMNS OF ABOUT US */

	echo '<div class="row">';

	/* COLUMN 1 - BIG MESSAGE ABOUT THE COMPANY */
	$zerif_aboutus_biglefttitle = get_theme_mod( 'zerif_aboutus_biglefttitle', __( 'Title', 'zerif' ) );

	$zerif_aboutus_text = get_theme_mod( 'zerif_aboutus_text', __( 'You can add here a large piece of text. For that, please go in the Admin Area, Customizer, "About us section"', 'zerif' ) );

	$zerif_aboutus_feature1_nr    = get_theme_mod( 'zerif_aboutus_feature1_nr', '50' );
	$zerif_aboutus_feature1_title = get_theme_mod( 'zerif_aboutus_feature1_title', __( 'Feature', 'zerif' ) );
	$zerif_aboutus_feature1_text  = get_theme_mod( 'zerif_aboutus_feature1_text' );

	$zerif_aboutus_feature2_nr    = get_theme_mod( 'zerif_aboutus_feature2_nr', '70' );
	$zerif_aboutus_feature2_title = get_theme_mod( 'zerif_aboutus_feature2_title', __( 'Feature', 'zerif' ) );
	$zerif_aboutus_feature2_text  = get_theme_mod( 'zerif_aboutus_feature2_text' );

	$zerif_aboutus_feature3_nr    = get_theme_mod( 'zerif_aboutus_feature3_nr', '100' );
	$zerif_aboutus_feature3_title = get_theme_mod( 'zerif_aboutus_feature3_title', __( 'Feature', 'zerif' ) );
	$zerif_aboutus_feature3_text  = get_theme_mod( 'zerif_aboutus_feature3_text' );

	$zerif_aboutus_feature4_nr    = get_theme_mod( 'zerif_aboutus_feature4_nr', '10' );
	$zerif_aboutus_feature4_title = get_theme_mod( 'zerif_aboutus_feature4_title', __( 'Feature', 'zerif' ) );
	$zerif_aboutus_feature4_text  = get_theme_mod( 'zerif_aboutus_feature4_text' );

	$text_and_skills = '';
	switch (
		( empty( $zerif_aboutus_biglefttitle ) ? 0 : 1 )
		+ ( empty( $zerif_aboutus_text ) ? 0 : 1 )
		+
		( empty( $zerif_aboutus_feature1_title ) && empty( $zerif_aboutus_feature1_text ) && empty( $zerif_aboutus_feature1_nr ) ?
			( empty( $zerif_aboutus_feature2_title ) && empty( $zerif_aboutus_feature2_text ) && empty( $zerif_aboutus_feature2_nr ) ?
				( empty( $zerif_aboutus_feature3_title ) && empty( $zerif_aboutus_feature3_text ) && empty( $zerif_aboutus_feature3_nr ) ?
					( empty( $zerif_aboutus_feature4_title ) && empty( $zerif_aboutus_feature4_text ) && empty( $zerif_aboutus_feature4_nr ) ?
						0 : 1 )
					: 1 )
				: 1 )
			: 1 )
	) {
		case 3:
			$colCount        = 4;
			$text_and_skills = 'text_and_skills';
			break;
		case 2:
			$colCount        = 6;
			$text_and_skills = 'text_and_skills';
			break;
		default:
			$colCount = 12;
	}

	if ( ! empty( $zerif_aboutus_biglefttitle ) ) {
		echo '<div class="col-lg-' . absint( $colCount ) . ' col-md-' . absint( $colCount ) . ' column zerif-rtl-big-title">';
		echo '<div class="big-intro" data-scrollreveal="enter left after 0s over 1s">' . wp_kses_post( $zerif_aboutus_biglefttitle ) . '</div>';
		echo '</div>';
	}

	if ( ! empty( $zerif_aboutus_text ) ) {

		echo '<div class="col-lg-' . absint( $colCount ) . ' col-md-' . absint( $colCount ) . ' column zerif_about_us_center ' . esc_html( $text_and_skills ) . '" data-scrollreveal="enter bottom after 0s over 1s">';

		echo '<p>';

		echo wp_kses_post( $zerif_aboutus_text );

		echo '</p>';

		echo '</div>';

	}

	$there_is_skills = '';
	(
	! empty( $zerif_aboutus_feature1_nr ) || ! empty( $zerif_aboutus_feature1_title ) || ! empty( $zerif_aboutus_feature1_text ) ? $there_is_skills             = 'yes' :
		! empty( $zerif_aboutus_feature2_nr ) || ! empty( $zerif_aboutus_feature2_title ) || ! empty( $zerif_aboutus_feature2_text ) ? $there_is_skills         = 'yes' :
			! empty( $zerif_aboutus_feature3_nr ) || ! empty( $zerif_aboutus_feature3_title ) || ! empty( $zerif_aboutus_feature3_text ) ? $there_is_skills     = 'yes' :
				! empty( $zerif_aboutus_feature4_nr ) || ! empty( $zerif_aboutus_feature4_title ) || ! empty( $zerif_aboutus_feature4_text ) ? $there_is_skills = 'yes' :
					$there_is_skills = '' );


	/* COLUMN 1 - SKILSS */

	if ( $there_is_skills != '' ) :

		echo '<div class="col-lg-' . absint( $colCount ) . ' col-md-' . absint( $colCount ) . ' column zerif-rtl-skills">';

		echo '<ul class="skills" data-scrollreveal="enter right after 0s over 1s">';

		/* SKILL ONE */

		if ( ! empty( $zerif_aboutus_feature1_nr ) || ! empty( $zerif_aboutus_feature1_title ) || ! empty( $zerif_aboutus_feature1_text ) ) {

			echo '<li class="skill skill_1">';

			if ( ! empty( $zerif_aboutus_feature1_nr ) ) {

				echo '<div class="skill-count">';

				echo '<input role="presentation" ' . ( ! empty( $zerif_aboutus_feature1_title ) ? 'id="zerif-about-feature-' . sanitize_title( $zerif_aboutus_feature1_title ) . '"' : '' ) . ' type="text" value="' . absint( $zerif_aboutus_feature1_nr ) . '" data-thickness=".2" class="skill1">';

				echo '</div>';

			}

			if ( ! empty( $zerif_aboutus_feature1_title ) ) {

				echo '<h6>' . wp_kses_post( $zerif_aboutus_feature1_title ) . '</h6>';

			} elseif ( is_customize_preview() ) {

				echo '<h6 class="zerif_hidden_if_not_customizer"></h6>';

			}

			if ( ! empty( $zerif_aboutus_feature1_text ) ) {

				echo '<p>' . wp_kses_post( $zerif_aboutus_feature1_text ) . '</p>';

			} elseif ( is_customize_preview() ) {

				echo '<p class="zerif_hidden_if_not_customizer"></p>';

			}

			echo '</li>';

		}


		/* SKILL TWO */

		if ( ! empty( $zerif_aboutus_feature2_nr ) || ! empty( $zerif_aboutus_feature2_title ) || ! empty( $zerif_aboutus_feature2_text ) ) {

			echo '<li class="skill skill_2">';

			if ( ! empty( $zerif_aboutus_feature2_nr ) ) {

				echo '<div class="skill-count">';

				echo '<input role="presentation" ' . ( ! empty( $zerif_aboutus_feature2_title ) ? 'id="zerif-about-feature-' . sanitize_title( $zerif_aboutus_feature2_title ) . '"' : '' ) . ' type="text" value="' . absint( $zerif_aboutus_feature2_nr ) . '" data-thickness=".2" class="skill2">';

				echo '</div>';

			}

			if ( ! empty( $zerif_aboutus_feature2_title ) ) {

				echo '<h6>' . wp_kses_post( $zerif_aboutus_feature2_title ) . '</h6>';

			} elseif ( is_customize_preview() ) {

				echo '<h6 class="zerif_hidden_if_not_customizer"></h6>';

			}

			if ( ! empty( $zerif_aboutus_feature2_text ) ) {

				echo '<p>' . wp_kses_post( $zerif_aboutus_feature2_text ) . '</p>';

			} elseif ( is_customize_preview() ) {

				echo '<p class="zerif_hidden_if_not_customizer"></p>';

			}

			echo '</li>';

		}


		/* SKILL THREE */

		if ( ! empty( $zerif_aboutus_feature3_nr ) || ! empty( $zerif_aboutus_feature3_title ) || ! empty( $zerif_aboutus_feature3_text ) ) {

			echo '<li class="skill skill_3">';

			if ( ! empty( $zerif_aboutus_feature3_nr ) ) {

				echo '<div class="skill-count">';

				echo '<input role="presentation" ' . ( ! empty( $zerif_aboutus_feature3_title ) ? 'id="zerif-about-feature-' . sanitize_title( $zerif_aboutus_feature3_title ) . '"' : '' ) . '  type="text" value="' . absint( $zerif_aboutus_feature3_nr ) . '" data-thickness=".2" class="skill3">';

				echo '</div>';

			}

			if ( ! empty( $zerif_aboutus_feature3_title ) ) {

				echo '<h6>' . wp_kses_post( $zerif_aboutus_feature3_title ) . '</h6>';

			} elseif ( is_customize_preview() ) {

				echo '<h6 class="zerif_hidden_if_not_customizer"></h6>';

			}

			if ( ! empty( $zerif_aboutus_feature3_text ) ) {

				echo '<p>' . wp_kses_post( $zerif_aboutus_feature3_text ) . '</p>';

			} elseif ( is_customize_preview() ) {

				echo '<p class="zerif_hidden_if_not_customizer"></p>';

			}

			echo '</li>';

		}


		/* SKILL FOUR */

		if ( ! empty( $zerif_aboutus_feature4_nr ) || ! empty( $zerif_aboutus_feature4_title ) || ! empty( $zerif_aboutus_feature4_text ) ) {

			echo '<li class="skill skill_4">';

			if ( ! empty( $zerif_aboutus_feature4_nr ) ) {

				echo '<div class="skill-count">';

				echo '<input role="presentation" ' . ( ! empty( $zerif_aboutus_feature4_title ) ? 'id="zerif-about-feature-' . sanitize_title( $zerif_aboutus_feature4_title ) . '"' : '' ) . ' type="text" value="' . absint( $zerif_aboutus_feature4_nr ) . '" data-thickness=".2" class="skill4">';

				echo '</div>';

			}

			if ( ! empty( $zerif_aboutus_feature4_title ) ) {

				echo '<h6>' . wp_kses_post( $zerif_aboutus_feature4_title ) . '</h6>';

			} elseif ( is_customize_preview() ) {

				echo '<h6 class="zerif_hidden_if_not_customizer"></h6>';

			}

			if ( ! empty( $zerif_aboutus_feature4_text ) ) {

				echo '<p>' . wp_kses_post( $zerif_aboutus_feature4_text ) . '</p>';

			} elseif ( is_customize_preview() ) {

				echo '<p class="zerif_hidden_if_not_customizer"></p>';

			}

			echo '</li>';

		}

		echo '</ul>';


		echo '</div> <!-- / END SKILLS COLUMN-->';


		echo '</div> <!-- / END 3 COLUMNS OF ABOUT US-->';

	endif;

	/* CLIENTS */

	if ( is_active_sidebar( 'sidebar-aboutus' ) ) {

		$zerif_aboutus_clients_title_text = get_theme_mod( 'zerif_aboutus_clients_title_text', __( 'OUR HAPPY CLIENTS', 'zerif' ) );

		echo '<div class="our-clients">';

		if ( ! empty( $zerif_aboutus_clients_title_text ) ) {

			echo '<h5><span class="section-footer-title">' . wp_kses_post( $zerif_aboutus_clients_title_text ) . '</span></h5>';

		} else {

			echo '<h5><span class="section-footer-title">' . __( 'OUR HAPPY CLIENTS', 'zerif' ) . '</span></h5>';

		}

		echo '</div>';

		echo '<div class="client-list">';
		echo '<div data-scrollreveal="enter right move 60px after 0.00s over 2.5s">';
		dynamic_sidebar( 'sidebar-aboutus' );
		echo '</div>';
		echo '</div> ';
	}

	echo '</div> <!-- / END CONTAINER -->';

	zerif_bottom_about_us_trigger();

	echo '</section> <!-- END ABOUT US SECTION -->';

}

zerif_after_about_us_trigger();
