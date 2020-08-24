<?php
/**
 * The Template for displaying all single posts.
 *
 * @package zerif
 */

	get_header();

	$sidebar_layout = apply_filters( 'zerif_sidebar_layout', get_theme_mod( 'zerif_blog_sidebar_layout', 'sidebar-right' ) );
	$wrapper_class  = 'content-left-wrap col-md-9';

if ( 'full-width' === $sidebar_layout ) {
	$wrapper_class = 'content-left-wrap col-md-12';
}
?>
	<div class="clear"></div>
</header> <!-- / END HOME SECTION  -->
<?php
zerif_after_header_trigger();

if ( apply_filters( 'zerif_display_area_filter', true, 'single' ) ) {
	$zerif_change_to_full_width = get_theme_mod( 'zerif_change_to_full_width' );
	?>
	<div id="content" class="site-content">
		<div class="container">
			<?php
			zerif_before_single_post_trigger();

			if ( $sidebar_layout === 'sidebar-left' && empty( $zerif_change_to_full_width ) ) {
				zerif_sidebar_trigger();
			}

			if ( ! empty( $zerif_change_to_full_width ) || 'full-width' === $wrapper_class ) {
				echo '<div class="content-left-wrap col-md-12">';
			} else {
				echo '<div class="content-left-wrap col-md-9">';
			}

			?>
			<?php zerif_top_single_post_trigger(); ?>
			<div id="primary" class="content-area">
				<main itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage" id="main" class="site-main">
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'content', 'single' );
						zerif_post_nav();
						/* If comments are open or we have at least one comment, load up the comment template */
						if ( comments_open() || '0' != get_comments_number() ) {
							comments_template( '' );
						}
					}
					?>
				</main><!-- #main -->
			</div><!-- #primary -->
			<?php zerif_bottom_single_post_trigger(); ?>
		</div><!-- .content-left-wrap -->
		<?php
		zerif_after_single_post_trigger();

		if ( $sidebar_layout === 'sidebar-right' && empty( $zerif_change_to_full_width ) ) {
			zerif_sidebar_trigger();
		}
		?>
	</div><!-- .container -->
	</div>
	<?php
}
get_footer(); ?>
