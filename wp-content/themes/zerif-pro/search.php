<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package zerif
 */

get_header();
?>
	<div class="clear"></div>
</header> <!-- / END HOME SECTION  -->
<?php
zerif_after_header_trigger();
if ( apply_filters( 'zerif_display_area_filter', true, 'search' ) ) {
	?>
	<div id="content" class="site-content">
		<div class="container">
			<div class="content-left-wrap col-md-9">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">
						<?php zerif_before_search_trigger(); ?>
						<?php
						if ( have_posts() ) {
							?>
							<header class="page-header">
								<h1 class="page-title">
									<?php
									/* translators: Search query */
									printf( __( 'Search Results for: %s', 'zerif' ), '<span>' . get_search_query() . '</span>' );
									?>
								</h1>
							</header><!-- .page-header -->
							<?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'content', get_post_format() );
							endwhile;
							zerif_paging_nav();
						} else {
							get_template_part( 'content', 'none' );
						}
						?>
						<?php zerif_after_search_trigger(); ?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- .content-left-wrap -->
			<?php zerif_sidebar_trigger(); ?>
		</div><!-- .container -->
	</div><!-- .site-content -->
	<?php
}
get_footer();
