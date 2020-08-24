<?php
/**
 * The default template used for displaying page content
 *
 * @package zerif
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/BlogPosting" itemtype="http://schema.org/BlogPosting">

	<?php if ( ! is_search() ) : ?>

		<?php if ( has_post_thumbnail() ) : ?>

		<div class="post-img-wrap" itemprop="image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail( 'post-thumbnail' ); ?>
			</a>
		</div>

		<div class="listpost-content-wrap">

		<?php else : ?>

		<div class="listpost-content-wrap-full">

		<?php endif; ?>

	<?php else : ?>

			<div class="listpost-content-wrap-full">

	<?php endif; ?>

	<div class="list-post-top">

	<header class="entry-header">

		<h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : ?>

		<div class="entry-meta">

			<?php zerif_posted_on(); ?>

		</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>

	<div class="entry-summary" itemprop="text">

		<?php the_excerpt(); ?>



	<?php else : ?>

	<div class="entry-content" itemprop="text">

		<?php

		$ismore = strpos( $post->post_content, '<!--more' );

		if ( $ismore ) {
			the_content( sprintf( esc_html__( '[...]', 'zerif' ), '<span class="screen-reader-text">' . esc_html__( 'about ', 'zerif' ) . get_the_title() . '</span>' ) );
		} else {
			the_excerpt();
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'zerif' ),
				'after'  => '</div>',
			)
		);

		?>


	<?php endif; ?>



	<footer class="entry-footer">

		<?php if ( 'post' == get_post_type() ) : ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'zerif' ) );
			if ( $categories_list && zerif_categorized_blog() ) :
				?>

			<span class="cat-links">

				<?php /* translators: Categories list */ printf( __( 'Posted in %1$s', 'zerif' ), $categories_list ); ?>

			</span>

			<?php endif; ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'zerif' ) );
			if ( $tags_list ) :
				?>

			<span class="tags-links">

				<?php /* translators: Tags list */ printf( __( 'Tagged %1$s', 'zerif' ), $tags_list ); ?>

			</span>

			<?php endif; ?>

		<?php endif; ?>



		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>

		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'zerif' ), __( '1 Comment', 'zerif' ), __( '% Comments', 'zerif' ) ); ?></span>

		<?php endif; ?>



		<?php edit_post_link( __( 'Edit', 'zerif' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->


	</div><!-- .entry-content --><!-- .entry-summary -->

	</div><!-- .list-post-top -->


</div><!-- .listpost-content-wrap -->

</article><!-- #post-## -->
