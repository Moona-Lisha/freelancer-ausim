<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

if ( apply_filters( 'zerif_display_area_filter', true, 'index' ) ) {
	?>
	<div id="content" class="site-content">
		<div class="container">
			<?php

			if ( $sidebar_layout === 'sidebar-left' ) {
				zerif_sidebar_trigger();
			}

			?>
			<div class="<?php echo $wrapper_class; ?>">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
						<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'content', get_post_format() );
							}
							zerif_paging_nav();
						} else {
							get_template_part( 'content', 'none' );
						}
						?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- .content-left-wrap -->
			<?php

			if ( $sidebar_layout === 'sidebar-right' ) {
				zerif_sidebar_trigger();
			}

			?>
		</div><!-- .container -->
	</div><!-- .site-content -->
	<?php
}
get_footer();
