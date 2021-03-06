<?php
/**
 * Portfolio section
 *
 * @package zerif
 */

$zerif_portofolio_number = get_theme_mod( 'zerif_portofolio_number', '8' );

if ( ! empty( $zerif_portofolio_number ) ) {

	$args = array(
		'post_type'      => 'portofolio',
		'posts_per_page' => $zerif_portofolio_number,
	);

} else {

	$args = array(
		'post_type'      => 'portofolio',
		'posts_per_page' => - 1,
	);

}

$zerif_portofolio_show = get_theme_mod( 'zerif_portofolio_show' );

$zerif_query = new WP_Query( apply_filters( 'zerif_portfolio_parameters', $args ) );

zerif_before_portfolio_trigger();

if ( $zerif_query->have_posts() && ( isset( $zerif_portofolio_show ) && $zerif_portofolio_show != 1 ) ) {

	echo '<section class="works" id="works">';

} elseif ( is_customize_preview() && $zerif_query->have_posts() ) {

	echo '<section class="works zerif_hidden_if_not_customizer" id="works">';

}

zerif_top_portfolio_trigger();

if ( ( $zerif_query->have_posts() && ( isset( $zerif_portofolio_show ) && $zerif_portofolio_show != 1 ) ) || ( is_customize_preview() && $zerif_query->have_posts() ) ) {

	echo '<div class="container">';
	echo '<div class="section-header">';

	/* title */

	$zerif_portofolio_title = get_theme_mod( 'zerif_portofolio_title', __( 'Portfolio', 'zerif' ) );

	if ( ! empty( $zerif_portofolio_title ) ) {

		echo '<h2 class="dark-text">' . wp_kses_post( $zerif_portofolio_title ) . '</h2>';

	} elseif ( is_customize_preview() ) {

		echo '<h2 class="dark-text zerif_hidden_if_not_customizer"></h2>';

	}

	/* subtitle */

	$zerif_portofolio_subtitle = get_theme_mod( 'zerif_portofolio_subtitle', __( 'Portfolio subtitle', 'zerif' ) );

	if ( ! empty( $zerif_portofolio_subtitle ) ) {

		echo '<h6>' . wp_kses_post( $zerif_portofolio_subtitle ) . '</h6>';

	} elseif ( is_customize_preview() ) {

		echo '<h6 class="zerif_hidden_if_not_customizer"></h6>';

	}
	echo '</div>';

	echo '<div class="row projects">';

	echo '<div id="loader">';

	echo '<div class="loader-icon"></div>';

	echo '</div>';


	echo '<div class="col-md-12" id="portfolio-list">';


	echo '<ul class="cbp-rfgrid">';


	while ( $zerif_query->have_posts() ) {


		$zerif_query->the_post();


		?>


		<!-- PROJECT -->


		<li data-scrollreveal="enter left after 0s over 1s">

			<?php

			$zerif_portofolio_show_modal = get_theme_mod( 'zerif_portofolio_show_modal' );

			if ( isset( $zerif_portofolio_show_modal ) && $zerif_portofolio_show_modal != 1 ) :

				?>

			<a href="<?php the_permalink(); ?>" class="more">

				<?php
				else :
					?>


				<div id="zerifModal" class="zerif-modal-wrap">

					<button class="zerif-close-modal zerif-close-button"><span>+</span></button>

					<div class="zerif-modal-title-wrap">
						<h3 class="zerif-modal-title"><?php the_title(); ?></h3>
					</div>

					<div class="zerif-modal-content">

						<?php

						if ( has_post_thumbnail( $post->ID ) ) {

							echo get_the_post_thumbnail( $post->ID, 'large' );

						}

						?>

						<div class="zerif-modal-content-text">

							<?php the_content( $post->ID ); ?>

						</div>

					</div>

					<div class="close-button-wrap">
						<button class="zerif-close-modal-button zerif-close-button-big">
							<span>+</span> <?php echo __( 'Close', 'zerif' ); ?></button>
					</div>

				</div>

				<a class="more zerif-with-modal">

					<?php endif; ?>

					<?php


					if ( has_post_thumbnail( $post->ID ) ) {


						echo get_the_post_thumbnail( $post->ID, 'zerif_project_photo' );


					}


					?>


					<div class="project-info">


						<div class="project-details">


							<h5 class="white-text red-border-bottom">


								<?php the_title(); ?>


							</h5>


							<div class="details white-text">

								<?php

								$categories = get_the_category();

								$separator = ' ';

								if ( $categories ) {

									foreach ( $categories as $category ) {
										echo esc_html( $category->cat_name . $separator );
									}
								}
								?>

							</div>


						</div>


					</div>


				</a>


		</li>


		<!-- / PROJECT -->


		<?php


	} // End while().


	echo '</ul>';


	echo '</div>';

	echo '</div>';

	echo '<div id="loaded-content"></div>';

	echo '<a id="back-button" class="red-btn" href="#"><i class="icon-fontawesome-webfont-27"></i>' . __( 'Go Back', 'zerif' ) . '</a>';

	echo '</div>';

	zerif_bottom_portfolio_trigger();

	echo '</section>';

} // End if().


wp_reset_postdata();

zerif_after_portfolio_trigger();
