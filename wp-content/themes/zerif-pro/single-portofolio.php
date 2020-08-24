<?php
/**
 * The Template for displaying all single posts.
 *
 * @package zerif
 */

get_header(); ?>

	<div class="clear"></div>
</header> <!-- / END HOME SECTION  -->
<?php zerif_after_header_trigger(); ?>
<div id="content" class="site-content">
	<div class="container">
		<?php
		$zerif_portofolio_single_full = get_theme_mod( 'zerif_portofolio_single_full' );

		if ( isset( $zerif_portofolio_single_full ) && $zerif_portofolio_single_full == 1 ) {
			echo '<div class="content-left-wrap col-md-12">';
		} else {
			echo '<div class="content-left-wrap col-md-9">';
		}
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'content', 'portfolio' );
					zerif_post_nav();
					/* If comments are open or we have at least one comment, load up the comment template */
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template( '' );
					}
				}
				?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
		if ( isset( $zerif_portofolio_single_full ) && $zerif_portofolio_single_full == 1 ) {
			echo '</div>';
		} else {
			echo '</div>';
			zerif_sidebar_trigger();
		}
		?>
	</div><!-- .container -->
</div><!-- .site-content -->
<?php get_footer(); ?>
