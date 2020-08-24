<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package zerif
 */

if ( ! function_exists( 'zerif_paging_nav' ) ) {

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function zerif_paging_nav( $max_num_pages = 0 ) {
		echo '<div class="clear"></div>';
		?>
		<nav class="navigation paging-navigation">
			<h3 class="screen-reader-text"><?php _e( 'Posts navigation', 'zerif' ); ?></h3>
			<div class="nav-links">
				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'zerif' ), $max_num_pages ); ?></div>
				<?php endif; ?>
				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'zerif' ) ); ?></div>
				<?php endif; ?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'zerif_post_nav' ) ) {

	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function zerif_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'zerif' ); ?></h1>
			<div class="nav-links">
				<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'zerif' ) );
				next_post_link( '<div class="nav-next">%link</div>', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'zerif' ) );
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'zerif_posted_on' ) ) {

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function zerif_posted_on() {
		$time_string = '<time class="entry-date published" itemprop="datePublished" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		printf(
			/* translators: 1 - Publish date, 2 - Author name */
			__( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'zerif' ),
			/* translators: Publish date */
			sprintf(
				'<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( get_day_link( get_the_date( 'Y' ), get_the_date( 'm' ), get_the_date( 'd' ) ) ),
				$time_string
			),
			/* translators: 1 - Author link, 2 - Author name */
			sprintf(
				'<span class="author vcard" itemprop="name"><a href="%1$s" class="url fn n author-link" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
	}
}

if ( ! function_exists( 'zerif_categorized_blog' ) ) {
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function zerif_categorized_blog() {
		$all_the_cool_cats = get_transient( 'zerif_categories' );
		if ( false === $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'zerif_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so zerif_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so zerif_categorized_blog should return false.
			return false;
		}
	}
}

if ( ! function_exists( 'zerif_category_transient_flusher' ) ) {
	/**
	 * Flush out the transients used in zerif_categorized_blog.
	 */
	function zerif_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'zerif_categories' );
	}
}

add_action( 'edit_category', 'zerif_category_transient_flusher' );

add_action( 'save_post', 'zerif_category_transient_flusher' );

if ( ! function_exists( 'wp_themeisle_page_menu_args' ) ) {
	/**
	 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	 *
	 * @param array $args Configuration arguments.
	 * @return array
	 */
	function wp_themeisle_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
}

add_filter( 'wp_page_menu_args', 'wp_themeisle_page_menu_args' );

if ( ! function_exists( 'wp_themeisle_body_classes' ) ) {

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function wp_themeisle_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		return $classes;
	}
}

add_filter( 'body_class', 'wp_themeisle_body_classes' );

if ( ! function_exists( 'wp_themeisle_wp_title' ) ) {

	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function wp_themeisle_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}
		global $page, $paged;
		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 ) {
			/* translators: Page number */
			$title .= " $sep " . sprintf( __( 'Page %s', 'zerif' ), max( $paged, $page ) );
		}
		return $title;
	}
}

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	add_filter( 'wp_title', 'wp_themeisle_wp_title', 10, 2 );
}

if ( ! function_exists( 'wp_themeisle_setup_author' ) ) {
	/**
	 * Sets the authordata global when viewing an author archive.
	 *
	 * This provides backwards compatibility with
	 * http://core.trac.wordpress.org/changeset/25574
	 *
	 * It removes the need to call the_post() and rewind_posts() in an author
	 * template to print information about the author.
	 *
	 * @global WP_Query $wp_query WordPress Query object.
	 * @return void
	 */
	function wp_themeisle_setup_author() {
		global $wp_query;
		if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
			$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
		}
	}
}

add_action( 'wp', 'wp_themeisle_setup_author' );

/**
 * HOOKS
 */

if ( ! function_exists( 'zerif_404_title_function' ) ) {
	/**
	 * Hook in 404 page title
	 */
	function zerif_404_title_function() {
		echo '<h1 class="entry-title">';
		_e( 'Oops! That page can&rsquo;t be found.', 'zerif' );
		echo '</h1>';
	}
}

if ( ! function_exists( 'zerif_404_content_function' ) ) {
	/**
	 * Hook in 404 page content
	 */
	function zerif_404_content_function() {
		echo '<p>';
		_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'zerif' );
		echo '</p>';
	}
}

if ( ! function_exists( 'zerif_page_header_function' ) ) {
	/**
	 * Hook in page header title
	 */
	function zerif_page_header_function() {
		echo '<h1 class="entry-title" itemprop="headline">';
		the_title();
		echo '</h1>';
	}
}

if ( ! function_exists( 'zerif_portfolio_header_function' ) ) {
	/**
	 * Hook in portfolio page title
	 */
	function zerif_portfolio_header_function() {
		echo '<h1 class="entry-title" itemprop="headline">';
		the_title();
		echo '</h1>';
	}
}

if ( ! function_exists( 'zerif_page_header_title_archive_function' ) ) {
	/**
	 * Hook in archive page title
	 */
	function zerif_page_header_title_archive_function() {
		the_archive_title( '<h1 class="page-title">', '</h1>' );
	}
}

if ( ! function_exists( 'zerif_page_term_description_archive_function' ) ) {
	/**
	 * Hook in archive page term
	 */
	function zerif_page_term_description_archive_function() {
		$term_description = term_description();
		if ( ! empty( $term_description ) ) {
			printf( '<div class="taxonomy-description">%s</div>', $term_description );
		}
	}
}

if ( ! function_exists( 'zerif_footer_widgets_function' ) ) {
	/**
	 * Hook in footer widgets
	 */
	function zerif_footer_widgets_function() {
		if ( is_active_sidebar( 'zerif-sidebar-footer' ) || is_active_sidebar( 'zerif-sidebar-footer-2' ) || is_active_sidebar( 'zerif-sidebar-footer-3' ) ) {
			echo '<div class="footer-widget-wrap"><div class="container">';

			if ( is_active_sidebar( 'zerif-sidebar-footer' ) ) {
				echo '<div class="footer-widget col-xs-12 col-sm-4">';
				dynamic_sidebar( 'zerif-sidebar-footer' );
				echo '</div>';
			}

			if ( is_active_sidebar( 'zerif-sidebar-footer-2' ) ) {
				echo '<div class="footer-widget col-xs-12 col-sm-4">';
				dynamic_sidebar( 'zerif-sidebar-footer-2' );
				echo '</div>';
			}

			if ( is_active_sidebar( 'zerif-sidebar-footer-3' ) ) {
				echo '<div class="footer-widget col-xs-12 col-sm-4">';
				dynamic_sidebar( 'zerif-sidebar-footer-3' );
				echo '</div>';
			}

			echo '</div></div>';
		}
	}
}

if ( ! function_exists( 'zerif_our_focus_header_title_function' ) ) {
	/**
	 * Hook in Our Focus section title
	 */
	function zerif_our_focus_header_title_function() {

		$zerif_ourfocus_title = get_theme_mod( 'zerif_ourfocus_title', __( 'Our focus', 'zerif' ) );

		if ( ! empty( $zerif_ourfocus_title ) ) {

			echo '<h2 class="dark-text">' . wp_kses_post( $zerif_ourfocus_title ) . '</h2>';

		} elseif ( is_customize_preview() ) {

			echo '<h2 class="dark-text zerif_hidden_if_not_customizer"></h2>';

		}
	}
}

if ( ! function_exists( 'zerif_our_focus_header_subtitle_function' ) ) {
	/**
	 * Hook in Our Focus section subtitle
	 */
	function zerif_our_focus_header_subtitle_function() {

		$zerif_ourfocus_subtitle = get_theme_mod( 'zerif_ourfocus_subtitle', __( 'Add a subtitle in Customizer, "Our focus section"', 'zerif' ) );

		if ( ! empty( $zerif_ourfocus_subtitle ) ) {

			echo '<h6>' . wp_kses_post( $zerif_ourfocus_subtitle ) . '</h6>';

		} elseif ( is_customize_preview() ) {

			echo '<h6 class="zerif_hidden_if_not_customizer"></h6>';

		}
	}
}

if ( ! function_exists( 'zerif_our_team_header_title_function' ) ) {
	/**
	 * Hook in Our Team section title
	 */
	function zerif_our_team_header_title_function() {

		$zerif_ourteam_title = get_theme_mod( 'zerif_ourteam_title', 'Our Team' );

		if ( ! empty( $zerif_ourteam_title ) ) {

			echo '<h2 class="dark-text">' . wp_kses_post( $zerif_ourteam_title ) . '</h2>';

		} elseif ( is_customize_preview() ) {

			echo '<h2 class="dark-text zerif_hidden_if_not_customizer"></h2>';

		}
	}
}

if ( ! function_exists( 'zerif_our_team_header_subtitle_function' ) ) {
	/**
	 * Hook in Our Team section subtitle
	 */
	function zerif_our_team_header_subtitle_function() {

		$zerif_ourteam_subtitle = get_theme_mod( 'zerif_ourteam_subtitle', 'Add a subtitle in Customizer, "Our team section"' );

		if ( ! empty( $zerif_ourteam_subtitle ) ) {

			echo '<h6>' . wp_kses_post( $zerif_ourteam_subtitle ) . '</h6>';

		} elseif ( is_customize_preview() ) {

			echo '<h6 class="zerif_hidden_if_not_customizer"></h6>';

		}
	}
}

if ( ! function_exists( 'zerif_testimonials_header_title_function' ) ) {
	/**
	 * Hook in Testimonials section title
	 */
	function zerif_testimonials_header_title_function() {

		$zerif_testimonials_title = get_theme_mod( 'zerif_testimonials_title', 'Testimonials' );

		if ( ! empty( $zerif_testimonials_title ) ) {

			echo '<h2 class="white-text">' . wp_kses_post( $zerif_testimonials_title ) . '</h2>';

		} elseif ( is_customize_preview() ) {

			echo '<h2 class="white-text zerif_hidden_if_not_customizer"></h2>';

		}
	}
}


if ( ! function_exists( 'zerif_testimonials_header_subtitle_function' ) ) {
	/**
	 * Hook in Testimonilas section subtitle
	 */
	function zerif_testimonials_header_subtitle_function() {

		$zerif_testimonials_subtitle = get_theme_mod( 'zerif_testimonials_subtitle' );

		if ( ! empty( $zerif_testimonials_subtitle ) ) {

			echo '<h6 class="white-text">' . wp_kses_post( $zerif_testimonials_subtitle ) . '</h6>';

		} elseif ( is_customize_preview() ) {

			echo '<h6 class="white-text zerif_hidden_if_not_customizer"></h6>';

		}
	}
}

if ( ! function_exists( 'zerif_latest_news_header_title_function' ) ) {
	/**
	 * Hook in Latest news section title
	 */
	function zerif_latest_news_header_title_function() {

		$zerif_latestnews_title = get_theme_mod( 'zerif_latestnews_title', __( 'LATEST NEWS', 'zerif' ) );

		if ( ! empty( $zerif_latestnews_title ) ) {

			echo '<h2 class="dark-text">' . wp_kses_post( $zerif_latestnews_title ) . '</h2>';

		} elseif ( is_customize_preview() ) {

			echo '<h2 class="dark-text zerif_hidden_if_not_customizer"></h2>';

		}
	}
}

if ( ! function_exists( 'zerif_latest_news_header_subtitle_function' ) ) {
	/**
	 * Hook in Latest news section subtitle
	 */
	function zerif_latest_news_header_subtitle_function() {

		$zerif_latestnews_subtitle = get_theme_mod( 'zerif_latestnews_subtitle', __( 'Add a subtitle in Customizer, "Latest news section"', 'zerif' ) );

		if ( ! empty( $zerif_latestnews_subtitle ) ) {

			echo '<h6 class="dark-text">' . wp_kses_post( $zerif_latestnews_subtitle ) . '</h6>';

		} elseif ( is_customize_preview() ) {

			echo '<h6 class="dark-text zerif_hidden_if_not_customizer"></h6>';

		}
	}
}


if ( ! function_exists( 'zerif_big_title_text_function' ) ) {
	/**
	 * Hook in Big title section title
	 */
	function zerif_big_title_text_function() {

		$zerif_bigtitle_title = get_theme_mod( 'zerif_bigtitle_title', __( 'To add a title here please go to Customizer, "Big title section"', 'zerif' ) );

		if ( ! empty( $zerif_bigtitle_title ) ) {

			echo '<h1 class="intro-text">' . wp_kses_post( $zerif_bigtitle_title ) . '</h1>';

		} elseif ( is_customize_preview() ) {

			echo '<h1 class="intro-text zerif_hidden_if_not_customizer"></h1>';

		}
	}
}

if ( ! function_exists( 'zerif_about_us_header_title_function' ) ) {
	/**
	 * Hook in About us section title
	 */
	function zerif_about_us_header_title_function() {

		$zerif_aboutus_title = get_theme_mod( 'zerif_aboutus_title', __( 'About US', 'zerif' ) );

		if ( ! empty( $zerif_aboutus_title ) ) {

			echo '<h2 class="white-text">' . wp_kses_post( $zerif_aboutus_title ) . '</h2>';

		} elseif ( is_customize_preview() ) {

			echo '<h2 class="white-text zerif_hidden_if_not_customizer"></h2>';

		}
	}
}

if ( ! function_exists( 'zerif_about_us_header_subtitle_function' ) ) {
	/**
	 * Hook in About us section subtitle
	 */
	function zerif_about_us_header_subtitle_function() {

		$zerif_aboutus_subtitle = get_theme_mod( 'zerif_aboutus_subtitle', __( 'Add a subtitle in Customizer, "About us section"', 'zerif' ) );

		if ( ! empty( $zerif_aboutus_subtitle ) ) {

			echo '<h6 class="white-text">' . wp_kses_post( $zerif_aboutus_subtitle ) . '</h6>';

		} elseif ( is_customize_preview() ) {

			echo '<h6 class="white-text zerif_hidden_if_not_customizer">' . wp_kses_post( $zerif_aboutus_subtitle ) . '</h6>';

		}
	}
}

if ( ! function_exists( 'zerif_subscribe_header_title_function' ) ) {
	/**
	 * Hook in Subscribe section title
	 */
	function zerif_subscribe_header_title_function() {

		$zerif_subscribe_title = get_theme_mod( 'zerif_subscribe_title', 'STAY IN TOUCH' );

		if ( ! empty( $zerif_subscribe_title ) ) {

			echo '<h3 class="white-text" data-scrollreveal="enter left after 0s over 1s">' . wp_kses_post( $zerif_subscribe_title ) . '</h3>';

		} elseif ( is_customize_preview() ) {

			echo '<h3 class="white-text zerif_hidden_if_not_customizer" data-scrollreveal="enter left after 0s over 1s"></h3>';

		}
	}
}

if ( ! function_exists( 'zerif_subscribe_header_subtitle_function' ) ) {
	/**
	 * Hook in Subscribe section subtitle
	 */
	function zerif_subscribe_header_subtitle_function() {

		$zerif_subscribe_subtitle = get_theme_mod( 'zerif_subscribe_subtitle', 'Sign Up for Email Updates on on News & Offers' );

		if ( ! empty( $zerif_subscribe_subtitle ) ) {

			echo '<div class="sub-heading white-text" data-scrollreveal="enter right after 0s over 1s">' . wp_kses_post( $zerif_subscribe_subtitle ) . '</div>';

		} elseif ( is_customize_preview() ) {

			echo '<div class="sub-heading white-text zerif_hidden_if_not_customizer" data-scrollreveal="enter right after 0s over 1s"></div>';

		}
	}
}

if ( ! function_exists( 'zerif_sidebar_function' ) ) {
	/**
	 * Hook in sidebar
	 */
	function zerif_sidebar_function() {
		$sidebar_layout    = apply_filters( 'zerif_sidebar_layout', get_theme_mod( 'zerif_blog_sidebar_layout', 'sidebar-right' ) );
		$sidebar_direction = '';

		$pid      = get_the_ID();
		$template = get_page_template_slug( $pid );

		if ( 'sidebar-left' === $sidebar_layout ) {
			$sidebar_direction = 'pull-left';
		}
		if ( is_page() && $template !== 'template-blog.php' && $template !== 'template-blog-large.php' ) {
			$sidebar_direction = 'pull-right';
		}
		?>
		<div class="sidebar-wrap col-md-3 content-left-wrap <?php echo $sidebar_direction; ?>">
			<?php get_sidebar(); ?>
		</div><!-- .sidebar-wrap -->
		<?php
	}
}

if ( ! function_exists( 'zerif_primary_navigation_function' ) ) {
	/**
	 * Hook in primary navigation menu
	 */
	function zerif_primary_navigation_function() {
		?>

		<?php if ( function_exists( 'max_mega_menu_is_enabled' ) && max_mega_menu_is_enabled( 'primary' ) ) : ?>

				<?php
					wp_nav_menu( array( 'theme_location' => 'primary' ) );
					echo '<style>.navbar-toggle {display: none;}</style>';
				?>

		<?php else : ?>

		<nav class="navbar-collapse bs-navbar-collapse collapse" id="site-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'nav navbar-nav navbar-right responsive-nav main-nav-list',
					'fallback_cb'    => 'zerif_wp_page_menu',
				)
			);
			?>
		</nav>
		<?php
		endif;
	}
}

if ( ! function_exists( 'zerif_primary_navigation_accessibility_function' ) ) {
	/**
	 * Hook in primary navigation menu for accessibility
	 */
	function zerif_primary_navigation_accessibility_function() {
		?>
		<nav aria-label='<?php _e( 'Primary Menu ', 'zerif' ); ?>'>
			<h3 class="screen-reader-text"><?php _e( 'Primary Menu', 'zerif' ); ?></h3>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'fallback_cb'    => 'zerif_wp_page_menu',
				)
			);
			?>
		</nav>
		<?php
	}
}
