<?php
/**
 * The template for displaying Archive pages.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
if ( apply_filters( 'zerif_display_area_filter', true, 'archive' ) ) {
	?>
	<div id="content" class="site-content">
		<div class="container">
			<?php
			zerif_before_archive_content_trigger();

			if ( $sidebar_layout === 'sidebar-left' ) {
				zerif_sidebar_trigger();
			}
			?>
			<div class="<?php echo $wrapper_class; ?>">
				<?php zerif_top_archive_content_trigger(); ?>
				<div id="primary" class="content-area">
					<main id="main" class="site-main">
						<?php if ( have_posts() ) : ?>
							<header class="page-header">

								<?php
								/* Title */
								zerif_page_header_title_archive_trigger();

								/* Optional term description */
								zerif_page_term_description_archive_trigger();
								?>

							</header><!-- .page-header -->
							<?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'content', get_post_format() );
							endwhile;
							zerif_paging_nav();
						else :
							get_template_part( 'content', 'none' );
						endif;
						?>
					</main><!-- #main -->
				</div><!-- #primary -->
				<?php zerif_bottom_archive_content_trigger(); ?>
			</div><!-- .content-left-wrap -->
			<?php
			zerif_after_archive_content_trigger();

			if ( $sidebar_layout === 'sidebar-right' ) {
				zerif_sidebar_trigger();
			}

			?>
		</div><!-- .container -->
	</div><!-- .site-content -->

	<?php
}
get_footer(); ?>
