<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 *
 * and the comment form.
 *
 * @package zerif
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {

	return;

}

?>



<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title">

			<?php

			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'zerif' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'zerif'
					),
					number_format_i18n( $comments_number ),
					'<span>' . get_the_title() . '</span>'
				);
			}

			?>

		</h2>



		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : /* are there comments to navigate through */ ?>

		<nav id="comment-nav-above" class="comment-navigation">

			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'zerif' ); ?></h1>

			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'zerif' ) ); ?></div>

			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'zerif' ) ); ?></div>

		</nav><!-- #comment-nav-above -->

		<?php endif; ?>



		<ul class="comment-list">

			<?php

				wp_list_comments(
					array(

						'style'      => 'ul',

						'short_ping' => true,

					)
				);

			?>

		</ul><!-- .comment-list -->



		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : /* are there comments to navigate through */ ?>

		<nav id="comment-nav-below" class="comment-navigation">

			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'zerif' ); ?></h1>

			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'zerif' ) ); ?></div>

			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'zerif' ) ); ?></div>

		</nav><!-- #comment-nav-below -->

		<?php endif; ?>

	<?php endif; ?>

	<?php
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

	<p class="no-comments"><?php _e( 'Comments are closed.', 'zerif' ); ?></p>

	<?php endif; ?>



	<?php
	comment_form(
		array(
			'comment_notes_after' => '',
		)
	);
	?>

</div><!-- #comments -->