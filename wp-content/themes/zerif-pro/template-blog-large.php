<?php
/**
 * Template Name: Blog template with large images
 *
 * @package zerif
 */

get_header();
global $wp_query;
global $paged;

$sidebar_layout = apply_filters( 'zerif_sidebar_layout', get_theme_mod( 'zerif_blog_sidebar_layout', 'sidebar-right' ) );
$wrapper_class  = 'content-left-wrap col-md-9';

if ( 'full-width' === $sidebar_layout ) {
	$wrapper_class = 'content-left-wrap col-md-12';
}

$pid   = get_the_ID();
$thumb = get_the_post_thumbnail_url( $pid, 'full' );
$style = '';
if ( ! empty( $thumb ) ) {
	$style = 'style="background:url(' . esc_url( $thumb ) . '); background-attachment:fixed; background-position:bottom;"';
}
$zerif_enable_blog_header = get_theme_mod( 'zerif_enable_blog_header', false );
if ( $zerif_enable_blog_header === true ) {
	$blog_header_title = get_the_title(); ?>
	<div class="blog-header-wrap" <?php echo $style; ?>>
		<div class="blog-header-content-wrap">
			<?php if ( ! empty( $blog_header_title ) ) { ?>
				<h1 class="intro-text"><?php echo esc_html( $blog_header_title ); ?></h1>
				<?php
}
?>
		</div>
	</div>
	<?php
}

?>

	<div class="clear"></div>
</header> <!-- / END HOME SECTION  -->
<?php zerif_after_header_trigger(); ?>
<div id="content" class="site-content">
	<div class="container">
		<?php

		if ( $sidebar_layout === 'sidebar-left' ) {
			zerif_sidebar_trigger();
		}

		?>
		<div class="<?php echo $wrapper_class; ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" itemscope itemtype="http://schema.org/Blog">
					<?php
					// Define custom query parameters
					$zerif_posts_per_page    = ( get_option( 'posts_per_page' ) ) ? get_option( 'posts_per_page' ) : '6';
					$zerif_custom_query_args = array(
						/* Parameters go here */
						'post_type'      => 'post',
						'posts_per_page' => $zerif_posts_per_page,
					);

					// Get current page and append to custom query parameters array
					$zerif_custom_query_args['paged'] = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 ) );
					$paged                            = $zerif_custom_query_args['paged'];

					// Instantiate custom query
					$zerif_custom_query = new WP_Query( apply_filters( 'zerif_template_blog_large_parameters', $zerif_custom_query_args ) );

					// Pagination fix
					$zerif_temp_query = $wp_query;
					$wp_query         = null;
					$wp_query         = $zerif_custom_query;

					// Output custom query loop
					if ( $zerif_custom_query->have_posts() ) {
						while ( $zerif_custom_query->have_posts() ) {
							$zerif_custom_query->the_post();
							// Loop output goes here
							get_template_part( 'content-large' );
						}
					} else {
						get_template_part( 'content', 'none' );
					}
					// Reset postdata
					wp_reset_postdata();

					// Custom query loop pagination
					zerif_paging_nav( $zerif_custom_query->max_num_pages );

					// Reset main query object
					$wp_query = null;
					$wp_query = $zerif_temp_query;
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
<?php get_footer(); ?>
