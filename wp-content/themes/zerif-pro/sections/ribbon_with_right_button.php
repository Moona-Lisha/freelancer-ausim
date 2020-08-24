<?php
/**
 * Ribbon with right button section
 *
 * @package zerif
 */

global $wp_customize;

$zerif_ribbonright_text = get_theme_mod( 'zerif_ribbonright_text' );

if ( ! empty( $zerif_ribbonright_text ) ) {

	$zerif_ribbonright_buttonlabel = get_theme_mod( 'zerif_ribbonright_buttonlabel' );

	$zerif_ribbonright_buttonlink = get_theme_mod( 'zerif_ribbonright_buttonlink' );

	$zerif_accessibility = get_theme_mod( 'zerif_accessibility' );

	if ( ! empty( $zerif_ribbonright_buttonlabel ) && ! empty( $zerif_ribbonright_buttonlink ) ) {

		echo '<section class="purchase-now" id="ribbon_right">';

	} else {

		echo '<section class="purchase-now ribbon-without-button" id="ribbon_right">';

	}

	echo '<div class="container">';

	echo '<div class="row">';

	echo '<div class="col-md-9 zerif-rtl-ribbon-text" data-scrollreveal="enter left after 0s over 1s">';

	echo '<h3 class="white-text">' . wp_kses_post( $zerif_ribbonright_text ) . '</h3>';

	echo '</div>';

	if ( ! empty( $zerif_ribbonright_buttonlabel ) && ! empty( $zerif_ribbonright_buttonlink ) ) {


		echo '<div class="col-md-3 zerif-rtl-ribbon-btn" data-scrollreveal="enter right after 0s over 1s">';

		if ( isset( $zerif_accessibility ) && $zerif_accessibility == 1 ) {
			echo '<button class="btn btn-primary custom-button red-btn" onclick="window.location=\'' . esc_url( $zerif_ribbonright_buttonlink ) . '\';"><span class="screen-reader-text">' . wp_kses_post( $zerif_ribbonright_buttonlabel ) . '</span>' . wp_kses_post( $zerif_ribbonright_buttonlabel ) . '</button>';
		} else {
			echo '<a href="' . esc_url( $zerif_ribbonright_buttonlink ) . '" class="btn btn-primary custom-button red-btn">' . wp_kses_post( $zerif_ribbonright_buttonlabel ) . '</a>';
		}

		echo '</div>';

	} elseif ( isset( $wp_customize ) ) {

		echo '<div class="col-md-3" data-scrollreveal="enter right after 0s over 1s">';

		if ( isset( $zerif_accessibility ) && $zerif_accessibility == 1 ) {
			echo '<button class="btn btn-primary custom-button red-btn zerif_hidden_if_not_customizer"><span class="screen-reader-text"></span></button>';
		} else {
			echo '<a href="" class="btn btn-primary custom-button red-btn zerif_hidden_if_not_customizer"></a>';
		}

		echo '</div>';

	}

	echo '</div>';


	echo '</div>';


	echo '</section>';

} elseif ( isset( $wp_customize ) ) {

	$zerif_ribbonright_buttonlabel = get_theme_mod( 'zerif_ribbonright_buttonlabel' );

	$zerif_ribbonright_buttonlink = get_theme_mod( 'zerif_ribbonright_buttonlink' );

	if ( ! empty( $zerif_ribbonright_buttonlabel ) && ! empty( $zerif_ribbonright_buttonlink ) ) {

		echo '<section class="purchase-now zerif_hidden_if_not_customizer" id="ribbon_right">';

	} else {

		echo '<section class="purchase-now ribbon-without-button zerif_hidden_if_not_customizer" id="ribbon_right">';

	}

	echo '<div class="container">';

	echo '<div class="row">';

	echo '<div class="col-md-9" data-scrollreveal="enter left after 0s over 1s">';

	echo '<h3 class="white-text"></h3>';

	echo '</div>';

	if ( ! empty( $zerif_ribbonright_buttonlabel ) && ! empty( $zerif_ribbonright_buttonlink ) ) {


		echo '<div class="col-md-3" data-scrollreveal="enter right after 0s over 1s">';


		echo '<a href="' . esc_url( $zerif_ribbonright_buttonlink ) . '" class="btn btn-primary custom-button red-btn">' . wp_kses_post( $zerif_ribbonright_buttonlabel ) . '</a>';


		echo '</div>';


	} elseif ( isset( $wp_customize ) ) {

		echo '<div class="col-md-3" data-scrollreveal="enter right after 0s over 1s">';


		echo '<a href="" class="btn btn-primary custom-button red-btn zerif_hidden_if_not_customizer"></a>';


		echo '</div>';

	}


	echo '</div>';


	echo '</div>';


	echo '</section>';

} // End if().
