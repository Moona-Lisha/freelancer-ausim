<?php
/**
 * Zerif functions and definitions
 *
 * @package zerif
 */
define( 'ZERIF_VERSION', '2.1.5' );
define( 'ZERIF_PHP_INCLUDE', trailingslashit( get_template_directory() ) . 'inc/' );
define( 'ZERIF_PHP_INCLUDE_URI', trailingslashit( get_template_directory_uri() ) . 'inc/' );
define( 'ZERIF_CORE_DIR', ZERIF_PHP_INCLUDE . 'core/' );

if ( ! defined( 'WPFORMS_SHAREASALE_ID' ) ) {
	define( 'WPFORMS_SHAREASALE_ID', '848264' );
}
update_option('zerif_pro_license','valid');
update_option('zerif_pro_license_status','valid');
apply_filters( 'zerif_pro_hide_license_notices', true );
/**
 * Begins execution of the theme core.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function zerif_run() {
	require_once ZERIF_PHP_INCLUDE . 'core/class-zerif-core.php';
	new Zerif_Core();
	$vendor_file = trailingslashit( get_template_directory() ) . 'vendor/autoload.php';
	if ( is_readable( $vendor_file ) ) {
		require_once $vendor_file;
	}
}

/**
 * The start of the app.
 *
 * @since   1.0.0
 */
zerif_run();


$vendor_file = trailingslashit( get_template_directory() ) . 'vendor/autoload.php';
if ( is_readable( $vendor_file ) ) {
	require_once $vendor_file;
}
add_filter( 'themeisle_sdk_products', 'zerif_load_sdk' );
/**
 * Loads products array.
 *
 * @param array $products All products.
 *
 * @return array Products array.
 */
function zerif_load_sdk( $products ) {
	$products[] = get_template_directory() . '/style.css';

	return $products;
}
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {

	$content_width = 640; /* pixels */

}


if ( ! function_exists( 'zerif_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function zerif_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'zerif', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/* Set the image size by cropping the image */

		add_image_size( 'zerif-testimonial', 73, 73, true );
		add_image_size( 'zerif-clients', 130, 50, true );
		add_image_size( 'zerif-our-focus', 150, 150, true );
		add_image_size( 'zerif_our_team_photo', 174, 174, true );
		add_image_size( 'zerif_project_photo', 285, 214, true );
		add_image_size( 'post-thumbnail', 250, 250, true );
		add_image_size( 'post-thumbnail-large', 750, 500, true ); /* blog thumbnail */
		add_image_size( 'post-thumbnail-large-table', 600, 300, true ); /* blog thumbnail for table */
		add_image_size( 'post-thumbnail-large-mobile', 400, 200, true ); /* blog thumbnail for mobile */

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'      => __( 'Primary Menu', 'zerif' ),
				'top-bar-menu' => __( 'Very Top Bar Menu', 'zerif' ),
			)
		);

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		// Setup the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'wp_themeisle_custom_background_args',
				array(

					'default-color' => 'ffffff',

				)
			)
		);

		// Enable support for HTML5 markup.
		add_theme_support(
			'html5',
			array(

				'comment-list',

				'search-form',

				'comment-form',

				'gallery',

			)
		);

		/* woocommerce support */
		$woocommerce_settings = apply_filters(
			'zerif_woocommerce_args',
			array(
				'single_image_width'            => 1600,
				'thumbnail_image_width'         => 300,
				'gallery_thumbnail_image_width' => 165,
				'product_grid'                  => array(
					'min_columns' => 1,
					'max_columns' => 6,
				),
			)
		);
		add_theme_support( 'woocommerce', $woocommerce_settings );

		if ( class_exists( 'WooCommerce' ) ) {
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}

			/* selective widget refresh */
			add_theme_support( 'customize-selective-refresh-widgets' );

			/* Enable support for title-tag */
			add_theme_support( 'title-tag' );

			/* Enable support for custom logo */
			add_theme_support(
				'custom-logo',
				array(
					'flex-width' => true,
				)
			);

			/* HOOKS */

			require get_template_directory() . '/inc/hooks.php'; // Enables user customization via WordPress plugin API

			add_action( 'zerif_404_title', 'zerif_404_title_function' ); // Outputs the title on 404 pages
			add_action( 'zerif_404_content', 'zerif_404_content_function' ); // Outputs a helpful message on 404 pages

			add_action( 'zerif_page_header', 'zerif_page_header_function' );
			add_action( 'zerif_portfolio_header', 'zerif_portfolio_header_function' );

			add_action( 'zerif_page_header_title_archive', 'zerif_page_header_title_archive_function' ); // Outputs the title on archive pages
			add_action( 'zerif_page_term_description_archive', 'zerif_page_term_description_archive_function' ); // Outputs the term description

			add_action( 'zerif_footer_widgets', 'zerif_footer_widgets_function' ); // Outputs the 3 sidebars in footer

			add_action( 'zerif_our_focus_header_title', 'zerif_our_focus_header_title_function' ); // Outputs the title in Our focus section
			add_action( 'zerif_our_focus_header_subtitle', 'zerif_our_focus_header_subtitle_function' ); // Outputs the subtitle in Our focus section

			add_action( 'zerif_our_team_header_title', 'zerif_our_team_header_title_function' ); // Outputs the title in Our team section
			add_action( 'zerif_our_team_header_subtitle', 'zerif_our_team_header_subtitle_function' ); // Outputs the subtitle in Our team section

			add_action( 'zerif_testimonials_header_title', 'zerif_testimonials_header_title_function' ); // Outputs the title in Testimonials section
			add_action( 'zerif_testimonials_header_subtitle', 'zerif_testimonials_header_subtitle_function' ); // Outputs the subtitle in Testimonials section

			add_action( 'zerif_latest_news_header_title', 'zerif_latest_news_header_title_function' ); // Outputs the title in Latest news section
			add_action( 'zerif_latest_news_header_subtitle', 'zerif_latest_news_header_subtitle_function' ); // Outputs the subtitle in Latest news section

			add_action( 'zerif_big_title_text', 'zerif_big_title_text_function' ); // Outputs the text in Big title section

			add_action( 'zerif_about_us_header_title', 'zerif_about_us_header_title_function' ); // Outputs the title in About us section
			add_action( 'zerif_about_us_header_subtitle', 'zerif_about_us_header_subtitle_function' ); // Outputs the subtitle in About us section

			add_action( 'zerif_subscribe_header_title', 'zerif_subscribe_header_title_function' ); // Outputs the title in Subscribe section
			add_action( 'zerif_subscribe_header_subtitle', 'zerif_subscribe_header_subtitle_function' ); // Outputs the subtitle in Subscribe section

			add_action( 'zerif_sidebar', 'zerif_sidebar_function' ); // Outputs the sidebar

			add_action( 'zerif_primary_navigation', 'zerif_primary_navigation_function' ); // Outputs the navigation menu
			add_action( 'zerif_primary_navigation_accessibility', 'zerif_primary_navigation_accessibility_function' ); // Outputs the navigation menu - when accessibility option is set

			// Enable shortcodes in text widgets
			add_filter( 'widget_text', 'do_shortcode' );

			require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-info/class/class-zerif-customizer-info-singleton.php' );

	}

endif;

add_action( 'after_setup_theme', 'zerif_setup' );

/**
 * Add compatibility with WooCommerce Product Images customizer controls.
 */
function zerif_set_woo_image_sizes() {
	$execute = get_option( 'zerif_update_woocommerce_customizer_controls', false );
	if ( $execute !== false ) {
		return;
	}
	if ( ! class_exists( 'WC_Regenerate_Images' ) ) {
		return;
	}

	update_option( 'woocommerce_thumbnail_cropping', '1:1' );
	$regenerate_obj = new WC_Regenerate_Images();
	$regenerate_obj::init();
	if ( method_exists( $regenerate_obj, 'maybe_regenerate_images' ) ) {
		$regenerate_obj::maybe_regenerate_images();
	} elseif ( method_exists( $regenerate_obj, 'maybe_regenerate_images_option_update' ) ) {
		// Force woocommerce 3.3.1 to regenerate images
		$regenerate_obj::maybe_regenerate_images_option_update( 1, 2, '' );
	}

	update_option( 'zerif_update_woocommerce_customizer_controls', true );
}
add_action( 'after_setup_theme', 'zerif_set_woo_image_sizes', 10 );


/**
 * Migrate logo from theme to core
 */
function zerif_migrate_logo() {

	$zerif_old_logo = get_theme_mod( 'zerif_logo' );

	if ( ! empty( $zerif_old_logo ) ) {

		$zerif_old_logo_id = attachment_url_to_postid( $zerif_old_logo );
		if ( is_int( $zerif_old_logo_id ) ) {
			set_theme_mod( 'custom_logo', $zerif_old_logo_id );
		}
		remove_theme_mod( 'zerif_logo' );

	}
}

add_action( 'after_setup_theme', 'zerif_migrate_logo' );

if ( ! function_exists( '_wp_render_title_tag' ) ) {

	/**
	 * Add backwards compatibility for titles
	 */
	function zerif_pro_old_render_title() {
		echo '<title>';
			wp_title( '-', true, 'right' );
		echo '</title>';
	}

	add_action( 'wp_head', 'zerif_pro_old_render_title' );
}

/**
 * Check if Latest posts option is selected
 */
function zerif_lite_is_not_latest_posts() {
	return ( 'posts' == get_option( 'show_on_front' ) ? true : false );
}

add_filter( 'image_size_names_choose', 'zerif_image_sizes' );

/**
 * Define custom image sizes
 *
 * @param array $sizes Current image sizes.
 */
function zerif_image_sizes( $sizes ) {

	$zerif_addsizes = array(
		'zerif-our-focus'      => esc_html__( 'Our focus', 'zerif' ),
		'zerif_our_team_photo' => esc_html__( 'Our team', 'zerif' ),
		'zerif-testimonial'    => esc_html__( 'Testimonial', 'zerif' ),
		'zerif-clients'        => esc_html__( 'Client logo', 'zerif' ),
	);
	$zerif_newsizes = array_merge( $sizes, $zerif_addsizes );
	return $zerif_newsizes;

}

add_action( 'init', 'zerif_create_post_type' );

/**
 * Define Portfolio custom post type
 */
function zerif_create_post_type() {

	/* portfolio */
	register_post_type(
		'portofolio',
		array(

			'labels'       => array(

				'name'          => __( 'Portfolio', 'zerif' ),

				'singular_name' => __( 'Portfolio', 'zerif' ),

			),

			'public'       => true,

			'has_archive'  => true,

			'taxonomies'   => array( 'category' ),

			'supports'     => array( 'title', 'editor', 'thumbnail', 'revisions' ),

			'show_ui'      => true,

			'menu_icon'    => 'dashicons-format-gallery',

			'rewrite'      => array(
				'slug' => 'portfolio',
			),
			'show_in_rest' => true,

		)
	);
}

add_action( 'init', 'zerif_flush' );

/**
 * Flush used after registering CPT
 */
function zerif_flush() {
	if ( ! get_option( 'zerif_flush_rewrite_rules_flag' ) ) {
		flush_rewrite_rules();
		add_option( 'zerif_flush_rewrite_rules_flag', true );
	}
}

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function zerif_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'zerif' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Big Title Widgets', 'zerif' ),
			'id'            => 'sidebar-big-title',
			'before_widget' => '<div id="%1$s" class="big-title-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="big-title-widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Our focus section widgets', 'zerif' ),
			'id'            => 'sidebar-ourfocus',
			'before_widget' => '<span id="%1$s">',
			'after_widget'  => '</span>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Testimonials section widgets', 'zerif' ),
			'id'            => 'sidebar-testimonials',
			'before_widget' => '<div id="%1$s" class="widget feedback-box">',
			'after_widget'  => '</div>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'About us section widgets', 'zerif' ),
			'id'            => 'sidebar-aboutus',
			'before_widget' => '<span id="%1$s">',
			'after_widget'  => '</span>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Our team section widgets', 'zerif' ),
			'id'            => 'sidebar-ourteam',
			'before_widget' => '<span id="%1$s">',
			'after_widget'  => '</span>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Packages section widgets', 'zerif' ),
			'id'            => 'sidebar-packages',
			'before_widget' => '<span id="%1$s">',
			'after_widget'  => '</span>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Subscribe section widgets', 'zerif' ),
			'id'            => 'sidebar-subscribe',
			'before_widget' => '<span id="%1$s">',
			'after_widget'  => '</span>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop Sidebar', 'zerif' ),
			'id'            => 'sidebar-shop',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="shop-widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebars(
		3,
		array(
			/* translators: Footer area number */
			'name'          => __( 'Footer area %d', 'zerif' ),
			'id'            => 'zerif-sidebar-footer',
			'before_widget' => '<aside id="%1$s" class="widget footer-widget-footer %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

}

add_action( 'widgets_init', 'zerif_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zerif_scripts() {

	/* STYLES */

	$zerif_use_safe_font = get_theme_mod( 'zerif_use_safe_font' );
	if ( isset( $zerif_use_safe_font ) && ( $zerif_use_safe_font != 1 ) ) :
		wp_enqueue_style( 'zerif_font', '//fonts.googleapis.com/css?family=Lato:300,400,700,400italic|Montserrat:700|Homemade+Apple', false, ZERIF_VERSION );
	endif;

	wp_enqueue_style( 'zerif_font_all', '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600italic,600,700,700italic,800,800italic', false, ZERIF_VERSION );

	/* Bootstrap style */

	wp_enqueue_style( 'zerif_bootstrap_style', get_template_directory_uri() . '/css/bootstrap.min.css', false, ZERIF_VERSION );

	/* Font awesome */

	wp_enqueue_style( 'zerif_font-awesome_style', get_template_directory_uri() . '/assets/css/font-awesome.min.css', false, ZERIF_VERSION );

	/* Main stylesheet */

	wp_enqueue_style( 'zerif_style', get_stylesheet_uri(), array( 'zerif_font-awesome_style', 'zerif_bootstrap_style' ), ZERIF_VERSION );

	/* WPForms Compatibility */

	if ( defined( 'WPFORMS_VERSION' ) ) {
		wp_enqueue_style( 'zerif_wpforms_style', get_template_directory_uri() . '/inc/compatibility/wpforms/style.css', false, ZERIF_VERSION );
	}
	/* IE9 stylesheet */

	wp_enqueue_style( 'zerif_ie_style', get_template_directory_uri() . '/css/ie.css', array( 'zerif_style' ), ZERIF_VERSION );
	wp_style_add_data( 'zerif_ie_style', 'conditional', 'lt IE 9' );

	if ( wp_is_mobile() ) {

		wp_enqueue_style( 'zerif_style_mobile', get_template_directory_uri() . '/css/style-mobile.css', array( 'zerif_font-awesome_style', 'zerif_bootstrap_style', 'zerif_style' ), ZERIF_VERSION );

	}

	/* SCRIPTS */

	/* Bootstrap script */

	wp_enqueue_script( 'zerif_bootstrap_script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), ZERIF_VERSION, true );

	if ( is_home() ) :

		/* Knob script */
		wp_enqueue_script( 'zerif_knob_nav', get_template_directory_uri() . '/js/jquery.knob.min.js', array( 'jquery' ), ZERIF_VERSION, true );
		wp_localize_script(
			'zerif_knob_nav',
			'zerif_knob_var',
			array(
				'zerif_aboutus_feature1_color' => get_theme_mod( 'zerif_aboutus_feature1_color', apply_filters( 'zerif_aboutus_feature1_color_filter', '#E96656' ) ),
				'zerif_aboutus_feature2_color' => get_theme_mod( 'zerif_aboutus_feature2_color', apply_filters( 'zerif_aboutus_feature2_color_filter', '#34D293' ) ),
				'zerif_aboutus_feature3_color' => get_theme_mod( 'zerif_aboutus_feature3_color', apply_filters( 'zerif_aboutus_feature3_color_filter', '#3AB0E2' ) ),
				'zerif_aboutus_feature4_color' => get_theme_mod( 'zerif_aboutus_feature4_color', apply_filters( 'zerif_aboutus_feature4_color_filter', '#E7AC44' ) ),
			)
		);
		/* Smootscroll script */
		$zerif_disable_smooth_scroll = get_theme_mod( 'zerif_disable_smooth_scroll' );
		if ( isset( $zerif_disable_smooth_scroll ) && ( $zerif_disable_smooth_scroll != 1 ) ) :
			wp_enqueue_script( 'zerif_smoothscroll', get_template_directory_uri() . '/js/smoothscroll.min.js', array( 'jquery' ), ZERIF_VERSION, true );
		endif;

	endif;

	/* scrollReveal script */
	if ( ! wp_is_mobile() ) {

		wp_enqueue_script( 'zerif_scrollReveal_script', get_template_directory_uri() . '/js/scrollReveal.min.js', array( 'jquery' ), ZERIF_VERSION, true );

	}

	/* HTML5Shiv*/
	wp_enqueue_script( 'zerif_html5', get_template_directory_uri() . '/js/html5.js', false, ZERIF_VERSION, true );
	wp_script_add_data( 'zerif_html5', 'conditional', 'lt IE 9' );

	/* zerif script */
	if ( ! wp_is_mobile() ) {

		$zerif_deps  = array();
		$blog_layout = get_theme_mod( 'zerif_blog_grid_layout', 1 );
		$is_masonry  = false;

		if ( $blog_layout > 1 ) {
			$is_masonry = get_theme_mod( 'zerif_enable_masonry', false );
		}

		if ( $is_masonry ) {
			$zerif_deps[] = 'masonry';
		}

		/* include parallax only if on frontpage and the parallax effect is activated */
		$zerif_parallax_use = get_theme_mod( 'zerif_parallax_show' );
		if ( ! empty( $zerif_parallax_use ) && ( $zerif_parallax_use == 1 ) && is_front_page() ) {
			$zerif_deps[] = 'zerif_parallax';
			wp_enqueue_script( 'zerif_parallax', get_template_directory_uri() . '/js/parallax.js', array( 'jquery' ), ZERIF_VERSION, true );
		}
		wp_enqueue_script( 'zerif_script', get_template_directory_uri() . '/js/zerif.js', $zerif_deps, ZERIF_VERSION, true );

		wp_localize_script(
			'zerif_script',
			'zerifSettings',
			array(
				'masonry' => $is_masonry ? true : false,
			)
		);

	} else {

		wp_enqueue_script( 'zerif_script', get_template_directory_uri() . '/js/zerif.js', false, ZERIF_VERSION, true );

	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

}

add_action( 'wp_enqueue_scripts', 'zerif_scripts' );

/**
 * Handle the post classes and properly set the number of columns.
 *
 * @param array $classes Post classes.
 *
 * @return array
 */
function zerif_filter_post_class( $classes ) {
	global $post;

	if ( 'post' !== $post->post_type ) {
		return $classes;
	}

	if ( is_search() || is_archive() ) {
		return $classes;
	}

	$blog_layout = get_theme_mod( 'zerif_blog_grid_layout', 1 );
	$classes[]   = 'col-sm-12 col-md-' . ( 12 / (int) $blog_layout );

	if ( $blog_layout > 1 ) {
		$is_masonry = get_theme_mod( 'zerif_enable_masonry', false );

		$to_unset = array( 'hentry', 'large-container' );
		foreach ( $to_unset as $class ) {
			$index = array_search( $class, $classes );
			if ( $index !== false ) {
				unset( $classes[ $index ] );
			}
		}

		$classes[] = 'card-style';

		if ( $is_masonry ) {
			$classes[] = 'masonry-card-style';
		}
	}

	return $classes;
}

/**
 * We need to decide at the root level if we load masonry classes or not.
 *
 * @param string $classes Masonry classes.
 *
 * @return mixed
 */
function zerif_add_masonry_classes( $classes ) {
	global $post;

	if ( empty( $post ) ) {
		return $classes;
	}

	// avoid doing this on a single post
	if ( ( 'post' === $post->post_type ) && is_single() ) {
		return $classes;
	}

	add_filter( 'post_class', 'zerif_filter_post_class' );

	return $classes;
}
add_filter( 'body_class', 'zerif_add_masonry_classes' );

/**
 * Custom template tags for this theme.
 */

get_template_part( 'inc/template-tags' );


/**
 * Customizer additions.
 */

get_template_part( 'inc/customizer' );


get_template_part( 'inc/category-dropdown-custom-control' );

/**
 * Remove Yoast rel="prev/next" link from header
 */
function zerif_remove_yoast_rel_link() {
	return false;
}
add_filter( 'wpseo_prev_rel_link', 'zerif_remove_yoast_rel_link' );
add_filter( 'wpseo_next_rel_link', 'zerif_remove_yoast_rel_link' );

/* tgm-plugin-activation */

require_once get_template_directory() . '/class-tgm-plugin-activation.php';

// Compatibility with Elementor theme locations api
$elementor_compatibility_path = get_template_directory() . '/inc/plugins-compatibility/elementor/class-elementor-compatibility.php';
if ( defined( 'ELEMENTOR_VERSION' ) && file_exists( $elementor_compatibility_path ) ) {
	require_once( $elementor_compatibility_path );
}

// Compatibility with WPML and PLL
$wpml_pll_compatibility_path = get_template_directory() . '/inc/plugins-compatibility/wpml-pll/functions.php';
require_once( $wpml_pll_compatibility_path );


add_action( 'tgmpa_register', 'zerif_register_required_plugins' );

/**
 * TGM required plugins
 */
function zerif_register_required_plugins() {

	$plugins = array(

		array(

			'name'     => 'Orbit Fox',

			'slug'     => 'themeisle-companion',

			'required' => false,

		),

		array(

			'name'     => 'WPForms',

			'slug'     => 'wpforms-lite',

			'required' => false,

		),

	);

	$config = array(

		'default_path' => '',

		'menu'         => 'tgmpa-install-plugins',

		'has_notices'  => true,

		'dismissable'  => true,

		'dismiss_msg'  => '',

		'is_automatic' => false,

		'message'      => '',

	);

	tgmpa( $plugins, $config );

}

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Dokan compatibility file.
 */
if ( class_exists( 'WeDevs_Dokan' ) ) {
	require get_template_directory() . '/inc/plugins-compatibility/dokan/functions.php';
}

/**
 * Used for wp_list_pages
 */
function zerif_wp_page_menu() {

	echo '<ul class="nav navbar-nav navbar-right responsive-nav main-nav-list zerif-nav-menu-callback">';

		wp_list_pages(
			array(
				'title_li' => '',
				'depth'    => 1,
			)
		);

	echo '</ul>';

}

/**
 * Editor style
 */
function zerif_add_editor_styles() {

	add_editor_style( '/css/custom-editor-style.css' );

}

add_action( 'init', 'zerif_add_editor_styles' );

add_filter( 'the_title', 'zerif_default_title' );

/**
 * Add a default title, for posts with no title
 *
 * @param string $title Post title.
 */
function zerif_default_title( $title ) {

	if ( $title == '' ) {

		$title = __( 'Default title', 'zerif' );

	}

	return $title;

}

add_action( 'widgets_init', 'zerif_register_widgets' );

/**
 * Register custom widgets
 */
function zerif_register_widgets() {

	if ( ! defined( 'THEMEISLE_COMPANION_VERSION' ) ) {

		register_widget( 'zerif_ourfocus' );
		register_widget( 'zerif_testimonial_widget' );
		register_widget( 'zerif_clients_widget' );
		register_widget( 'zerif_team_widget' );

	}
	register_widget( 'zerif_packages' );
}

require_once get_template_directory() . '/inc/class/class-zerif-widget-tools.php';
require_once get_template_directory() . '/inc/class/class-zerif-clients-widget.php';
require_once get_template_directory() . '/inc/class/class-zerif-ourfocus-widget.php';
require_once get_template_directory() . '/inc/class/class-zerif-packages-widget.php';
require_once get_template_directory() . '/inc/class/class-zerif-team-widget.php';
require_once get_template_directory() . '/inc/class/class-zerif-testimonial-widget.php';
require_once get_template_directory() . '/inc/class/class-zerif-top-bar.php';

// @TODO decide where this should go.
$top_bar = new Zerif_Top_Bar();
$top_bar->init();

/**
 * Enqueue CSS file to be used in Customizer
 */
function zerif_customizer_custom_css() {
	wp_enqueue_style( 'zerif_customizer_custom_css', get_template_directory_uri() . '/css/zerif_customizer_custom_css.css', false, ZERIF_VERSION );
}
add_action( 'customize_controls_print_styles', 'zerif_customizer_custom_css' );

/**
 * Enqueue CSS file to be used in the admin area
 */
function zerif_admin_custom_css() {
	wp_enqueue_style( 'zerif_admin_custom_css', get_template_directory_uri() . '/css/zerif_admin_custom_css.css', false, ZERIF_VERSION );
}
add_action( 'admin_enqueue_scripts', 'zerif_admin_custom_css' );

add_action( 'wp_footer', 'zerif_php_style', 1 );

/**
 * Add custom CSS
 */
function zerif_php_style() {

	echo '<style type="text/css">';

	/* General */

	$zerif_background_color = get_theme_mod( 'zerif_background_color', apply_filters( 'zerif_background_color_filter', '#fff' ) );
	if ( ! empty( $zerif_background_color ) ) {
		echo '	.site-content { background: ' . $zerif_background_color . ' }';
	}
	$zerif_navbar_color = get_theme_mod( 'zerif_navbar_color', apply_filters( 'zerif_navbar_color_filter', '#fff' ) );
	if ( ! empty( $zerif_navbar_color ) ) {
		echo ' .navbar, .navbar-inverse .navbar-nav ul.sub-menu { background: ' . $zerif_navbar_color . '; }';
	}
	$zerif_titles_color = get_theme_mod( 'zerif_titles_color', apply_filters( 'zerif_titles_color_filter', '#404040' ) );
	if ( ! empty( $zerif_titles_color ) ) {
		echo '	.entry-title, .entry-title a, .widget-title, .widget-title a, .page-header .page-title, .comments-title, h1.page-title { color: ' . $zerif_titles_color . ' !important}';
	}
	$zerif_titles_bottomborder_color = get_theme_mod( 'zerif_titles_bottomborder_color', apply_filters( 'zerif_titles_bottomborder_color_filter', '#e96656' ) );
	if ( ! empty( $zerif_titles_bottomborder_color ) ) {
		echo '	.widget .widget-title:before, .entry-title:before, .page-header .page-title:before, .entry-title:after, ul.nav > li.current_page_item > a:before, .nav > li.current-menu-item > a:before, h1.page-title:before, .navbar.navbar-inverse .primary-menu ul li.current-menu-item > a:before, ul.nav > li > a.nav-active:before, .navbar.navbar-inverse .primary-menu ul > li.current > a:before { background: ' . $zerif_titles_bottomborder_color . ' !important; }';
	}
	$zerif_texts_color = get_theme_mod( 'zerif_texts_color', apply_filters( 'zerif_texts_color_filter', '#404040' ) );
	if ( ! empty( $zerif_texts_color ) ) {
		echo '	body, button, input, select, textarea, .widget p, .widget .textwidget, .woocommerce .product h3, h2.woocommerce-loop-product__title, .woocommerce .product span.amount, .woocommerce-page .woocommerce .product-name a { color: ' . $zerif_texts_color . ' }';
	}
	$zerif_links_color = get_theme_mod( 'zerif_links_color', apply_filters( 'zerif_links_color_filter', '#808080' ) );
	if ( ! empty( $zerif_links_color ) ) {
		echo '	.widget li a, .widget a, article .entry-meta a, article .entry-content a, .entry-footer a, .site-content a { color: ' . $zerif_links_color . '; }';
	}
	$zerif_links_color_hover = get_theme_mod( 'zerif_links_color_hover', apply_filters( 'zerif_links_color_hover_filter', '#e96656' ) );
	if ( ! empty( $zerif_links_color_hover ) ) {
		echo '	.widget li a:hover, .widget a:hover, article .entry-meta a:hover, article .entry-content a:hover , .entry-footer a:hover, .site-content a:hover { color: ' . $zerif_links_color_hover . ' }';
	}

	/* Big title section */

	$zerif_bigtitle_background = get_theme_mod( 'zerif_bigtitle_background', apply_filters( 'zerif_bigtitle_background_filter', 'rgba(0, 0, 0, 0.5)' ) );
	if ( ! empty( $zerif_bigtitle_background ) ) {
		echo '	.header-content-wrap { background: ' . $zerif_bigtitle_background . '}';
	}
	$zerif_bigtitle_header_color = get_theme_mod( 'zerif_bigtitle_header_color', apply_filters( 'zerif_bigtitle_header_color_filter', '#fff' ) );
	if ( ! empty( $zerif_bigtitle_header_color ) ) {
		echo '	.big-title-container .intro-text { color: ' . $zerif_bigtitle_header_color . '}';
	}
	$zerif_bigtitle_1button_background_color = get_theme_mod( 'zerif_bigtitle_1button_background_color', apply_filters( 'zerif_bigtitle_1button_background_color_filter', '#e96656' ) );
	if ( ! empty( $zerif_bigtitle_1button_background_color ) ) {
		echo '	.big-title-container .red-btn { background: ' . $zerif_bigtitle_1button_background_color . '}';
	}
	$zerif_bigtitle_1button_background_color_hover = get_theme_mod( 'zerif_bigtitle_1button_background_color_hover', apply_filters( 'zerif_bigtitle_1button_background_color_hover_filter', '#cb4332' ) );
	if ( ! empty( $zerif_bigtitle_1button_background_color_hover ) ) {
		echo '	.big-title-container .red-btn:hover { background: ' . $zerif_bigtitle_1button_background_color_hover . '}';
	}
	$zerif_bigtitle_1button_color = get_theme_mod( 'zerif_bigtitle_1button_color', apply_filters( 'zerif_bigtitle_1button_color_filter', '#fff' ) );
	if ( ! empty( $zerif_bigtitle_1button_color ) ) {
		echo '	.big-title-container .buttons .red-btn { color: ' . $zerif_bigtitle_1button_color . ' !important }';
	}
	$zerif_bigtitle_2button_background_color = get_theme_mod( 'zerif_bigtitle_2button_background_color', apply_filters( 'zerif_bigtitle_2button_background_color_filter', '#20AA73' ) );
	if ( ! empty( $zerif_bigtitle_2button_background_color ) ) {
		echo '	.big-title-container .green-btn { background: ' . $zerif_bigtitle_2button_background_color . '}';
	}
	$zerif_bigtitle_2button_background_color_hover = get_theme_mod( 'zerif_bigtitle_2button_background_color_hover', apply_filters( 'zerif_bigtitle_2button_background_color_hover_filter', '#069059' ) );
	if ( ! empty( $zerif_bigtitle_2button_background_color_hover ) ) {
		echo '	.big-title-container .green-btn:hover { background: ' . $zerif_bigtitle_2button_background_color_hover . '}';
	}
	$zerif_bigtitle_2button_color = get_theme_mod( 'zerif_bigtitle_2button_color', apply_filters( 'zerif_bigtitle_2button_color_filter', '#fff' ) );
	if ( ! empty( $zerif_bigtitle_2button_color ) ) {
		echo '	.big-title-container .buttons .green-btn { color: ' . get_theme_mod( 'zerif_bigtitle_2button_color' ) . ' !important }';
	}
	$zerif_bigtitle_1button_color_hover = get_theme_mod( 'zerif_bigtitle_1button_color_hover', apply_filters( 'zerif_bigtitle_1button_color_hover_filter', '#fff' ) );
	if ( ! empty( $zerif_bigtitle_1button_color_hover ) ) {
		echo '	.big-title-container .red-btn:hover { color: ' . $zerif_bigtitle_1button_color_hover . ' !important }';
	}
	$zerif_bigtitle_2button_color_hover = get_theme_mod( 'zerif_bigtitle_2button_color_hover', apply_filters( 'zerif_bigtitle_2button_color_hover_filter', '#fff' ) );
	if ( ! empty( $zerif_bigtitle_2button_color_hover ) ) {
		echo '	.big-title-container .green-btn:hover { color: ' . $zerif_bigtitle_2button_color_hover . ' !important }';
	}

	/* END - Big title section */

	/* Our Focus section */

	$zerif_ourfocus_background = get_theme_mod( 'zerif_ourfocus_background', apply_filters( 'zerif_ourfocus_background_filter', 'rgba(255, 255, 255, 1)' ) );
	if ( ! empty( $zerif_ourfocus_background ) ) {
		echo '	.focus { background: ' . $zerif_ourfocus_background . ' }';
	}
	$zerif_ourfocus_header = get_theme_mod( 'zerif_ourfocus_header', apply_filters( 'zerif_ourfocus_header_filter', '#404040' ) );
	if ( ! empty( $zerif_ourfocus_header ) ) {
		echo '	.focus .section-header h2{ color: ' . $zerif_ourfocus_header . ' }';
		echo '	.focus .section-header h6{ color: ' . $zerif_ourfocus_header . ' }';
	}
	$zerif_ourfocus_box_title_color = get_theme_mod( 'zerif_ourfocus_box_title_color', apply_filters( 'zerif_ourfocus_box_title_color_filter', '#404040' ) );
	if ( ! empty( $zerif_ourfocus_box_title_color ) ) {
		echo '	.focus .focus-box h5{ color: ' . $zerif_ourfocus_box_title_color . ' }';
	}
	$zerif_ourfocus_box_text_color = get_theme_mod( 'zerif_ourfocus_box_text_color', apply_filters( 'zerif_ourfocus_box_text_color_filter', '#404040' ) );
	if ( ! empty( $zerif_ourfocus_box_text_color ) ) {
		echo '	.focus .focus-box p{ color: ' . $zerif_ourfocus_box_text_color . ' }';
	}
	$zerif_ourfocus_1box = get_theme_mod( 'zerif_ourfocus_1box', apply_filters( 'zerif_ourfocus_1box_filter', '#e96656' ) );
	if ( ! empty( $zerif_ourfocus_1box ) ) {
		echo '	#focus span:nth-child(4n+1) .focus-box .service-icon:hover { border: 10px solid ' . $zerif_ourfocus_1box . ' }';
		echo '	#focus span:nth-child(4n+1) .focus-box .red-border-bottom:before{ background: ' . $zerif_ourfocus_1box . ' }';
	}
	$zerif_ourfocus_2box = get_theme_mod( 'zerif_ourfocus_2box', apply_filters( 'zerif_ourfocus_2box_filter', '#34d293' ) );
	if ( ! empty( $zerif_ourfocus_2box ) ) {
		echo '	#focus span:nth-child(4n+2) .focus-box .service-icon:hover { border: 10px solid ' . $zerif_ourfocus_2box . ' }';
		echo '	#focus span:nth-child(4n+2) .focus-box .red-border-bottom:before { background: ' . $zerif_ourfocus_2box . ' }';
	}
	$zerif_ourfocus_3box = get_theme_mod( 'zerif_ourfocus_3box', apply_filters( 'zerif_ourfocus_3box_filter', '#3ab0e2' ) );
	if ( ! empty( $zerif_ourfocus_3box ) ) {
		echo '	#focus span:nth-child(4n+3) .focus-box .service-icon:hover { border: 10px solid ' . $zerif_ourfocus_3box . ' }';
		echo '	#focus span:nth-child(4n+3) .focus-box .red-border-bottom:before { background: ' . $zerif_ourfocus_3box . ' }';
	}
	$zerif_ourfocus_4box = get_theme_mod( 'zerif_ourfocus_4box', apply_filters( 'zerif_ourfocus_4box_filter', '#f7d861' ) );
	if ( ! empty( $zerif_ourfocus_4box ) ) {
		echo '	#focus span:nth-child(4n+4) .focus-box .service-icon:hover { border: 10px solid ' . $zerif_ourfocus_4box . ' }';
		echo '	#focus span:nth-child(4n+4) .focus-box .red-border-bottom:before { background: ' . $zerif_ourfocus_4box . ' }';
	}

	/*  END - Our Focus section */

	/* Portfolio section */

	$zerif_portofolio_background = get_theme_mod( 'zerif_portofolio_background', apply_filters( 'zerif_portofolio_background_filter', 'rgba(255, 255, 255, 1)' ) );
	if ( ! empty( $zerif_portofolio_background ) ) {
		echo '	.works { background: ' . $zerif_portofolio_background . ' }';
	}
	$zerif_portofolio_header = get_theme_mod( 'zerif_portofolio_header', apply_filters( 'zerif_portofolio_header_filter', '#404040' ) );
	if ( ! empty( $zerif_portofolio_header ) ) {
		echo '	.works .section-header h2 { color: ' . $zerif_portofolio_header . ' }';
		echo '	.works .section-header h6 { color: ' . $zerif_portofolio_header . ' }';
	}
	$zerif_portofolio_text = get_theme_mod( 'zerif_portofolio_text', apply_filters( 'zerif_portofolio_text_filter', '#fff' ) );
	if ( ! empty( $zerif_portofolio_text ) ) {
		echo '	.works .white-text { color: ' . $zerif_portofolio_text . ' }';
	}
	$zerif_portofolio_box_underline_color = get_theme_mod( 'zerif_portofolio_box_underline_color', apply_filters( 'zerif_portofolio_box_underline_color_filter', '#e96656' ) );
	if ( ! empty( $zerif_portofolio_box_underline_color ) ) {
		echo '.works .red-border-bottom:before { background: ' . $zerif_portofolio_box_underline_color . ' !important; }';
	}

	/* END - Portfolio section */

	/* About us section */

	$zerif_aboutus_background = get_theme_mod( 'zerif_aboutus_background', apply_filters( 'zerif_aboutus_background_filter', 'rgba(39, 39, 39, 1)' ) );
	if ( ! empty( $zerif_aboutus_background ) ) {
		echo '	.about-us, .about-us .our-clients .section-footer-title { background: ' . $zerif_aboutus_background . ' }';
	}
	$zerif_aboutus_title_color = get_theme_mod( 'zerif_aboutus_title_color', apply_filters( 'zerif_aboutus_title_color_filter', '#fff' ) );
	if ( ! empty( $zerif_aboutus_title_color ) ) {
		echo '	.about-us { color: ' . $zerif_aboutus_title_color . ' }';
		echo '	.about-us p{ color: ' . $zerif_aboutus_title_color . ' }';
		echo '	.about-us .section-header h2, .about-us .section-header h6 { color: ' . $zerif_aboutus_title_color . ' }';
	}

	$zerif_aboutus_number_color = get_theme_mod( 'zerif_aboutus_number_color', apply_filters( 'zerif_aboutus_number_color_filter', '#fff' ) );
	if ( ! empty( $zerif_aboutus_number_color ) ) {
		echo '.about-us	.skills input { color: ' . $zerif_aboutus_number_color . ' !important; }';
	}

	$zerif_aboutus_clients_color = get_theme_mod( 'zerif_aboutus_clients_color', apply_filters( 'zerif_aboutus_clients_color_filter', '#fff' ) );
	if ( ! empty( $zerif_aboutus_clients_color ) ) {
		echo '.about-us .our-clients .section-footer-title { color: ' . $zerif_aboutus_clients_color . ' !important; }';
	}

	/* END - About us section */

	/* Our team section */

	$zerif_ourteam_background = get_theme_mod( 'zerif_ourteam_background', apply_filters( 'zerif_ourteam_background_filter', 'rgba(255, 255, 255, 1)' ) );
	if ( ! empty( $zerif_ourteam_background ) ) {
		echo '	.our-team { background: ' . $zerif_ourteam_background . ' }';
	}
	$zerif_ourteam_header = get_theme_mod( 'zerif_ourteam_header', apply_filters( 'zerif_ourteam_header_filter', '#404040' ) );
	if ( ! empty( $zerif_ourteam_header ) ) {
		echo '	.our-team .section-header h2, .our-team .member-details h5, .our-team .member-details h5 a, .our-team .section-header h6, .our-team .member-details .position { color: ' . $zerif_ourteam_header . ' }';
	}
	$zerif_ourteam_text = get_theme_mod( 'zerif_ourteam_text', apply_filters( 'zerif_ourteam_text_filter', '#fff' ) );
	if ( ! empty( $zerif_ourteam_text ) ) {
		echo '	.our-team .team-member:hover .details { color: ' . $zerif_ourteam_text . ' }';
	}
	$zerif_ourteam_socials_hover = get_theme_mod( 'zerif_ourteam_socials_hover', apply_filters( 'zerif_ourteam_socials_hover_filter', '#e96656' ) );
	if ( ! empty( $zerif_ourteam_socials_hover ) ) {
		echo '	.our-team .team-member .social-icons ul li a:hover { color: ' . $zerif_ourteam_socials_hover . ' }';
	}
	$zerif_ourteam_socials = get_theme_mod( 'zerif_ourteam_socials', apply_filters( 'zerif_ourteam_socials_filter', '#808080' ) );
	if ( ! empty( $zerif_ourteam_socials ) ) {
		echo '	.our-team .team-member .social-icons ul li a { color: ' . $zerif_ourteam_socials . ' }';
	}
	$zerif_ourteam_hover_background = get_theme_mod( 'zerif_ourteam_hover_background', apply_filters( 'zerif_ourteam_hover_background_filter', '#333' ) );
	if ( ! empty( $zerif_ourteam_hover_background ) ) {
		echo '.team-member:hover .details { background: ' . $zerif_ourteam_hover_background . ' !important; }';
	}
	$zerif_ourteam_1box = get_theme_mod( 'zerif_ourteam_1box', apply_filters( 'zerif_ourteam_1box_filter', '#e96656' ) );
	if ( ! empty( $zerif_ourteam_1box ) ) {
		echo '	.our-team .row > span:nth-child(4n+1) .red-border-bottom:before { background: ' . $zerif_ourteam_1box . ' }';
	}
	$zerif_ourteam_2box = get_theme_mod( 'zerif_ourteam_2box', apply_filters( 'zerif_ourteam_2box_filter', '#34d293' ) );
	if ( ! empty( $zerif_ourteam_2box ) ) {
		echo '	.our-team .row > span:nth-child(4n+2) .red-border-bottom:before { background: ' . $zerif_ourteam_2box . ' }';
	}
	$zerif_ourteam_3box = get_theme_mod( 'zerif_ourteam_3box', apply_filters( 'zerif_ourteam_3box_filter', '#3ab0e2' ) );
	if ( ! empty( $zerif_ourteam_3box ) ) {
		echo '	.our-team .row > span:nth-child(4n+3) .red-border-bottom:before { background: ' . $zerif_ourteam_3box . ' }';
	}
	$zerif_ourteam_4box = get_theme_mod( 'zerif_ourteam_4box', apply_filters( 'zerif_ourteam_4box_filter', '#f7d861' ) );
	if ( ! empty( $zerif_ourteam_4box ) ) {
		echo '	.our-team .row > span:nth-child(4n+4) .red-border-bottom:before { background: ' . $zerif_ourteam_4box . ' }';
	}

	/* END - Our team section */

	/* Testimonials section */

	$zerif_testimonials_background = get_theme_mod( 'zerif_testimonials_background', apply_filters( 'zerif_testimonials_background_filter', 'rgba(219, 191, 86, 1)' ) );
	if ( ! empty( $zerif_testimonials_background ) ) {
		echo '	.testimonial { background: ' . $zerif_testimonials_background . ' }';
	}
	$zerif_testimonials_header = get_theme_mod( 'zerif_testimonials_header', apply_filters( 'zerif_testimonials_header_filter', '#fff' ) );
	if ( ! empty( $zerif_testimonials_header ) ) {
		echo '	.testimonial .section-header h2, .testimonial .section-header h6 { color: ' . $zerif_testimonials_header . ' }';
	}
	$zerif_testimonials_text = get_theme_mod( 'zerif_testimonials_text', apply_filters( 'zerif_testimonials_text_filter', '#909090' ) );
	if ( ! empty( $zerif_testimonials_text ) ) {
		echo '	.testimonial .feedback-box .message { color: ' . $zerif_testimonials_text . ' }';
	}
	$zerif_testimonials_author = get_theme_mod( 'zerif_testimonials_author', apply_filters( 'zerif_testimonials_author_filter', '#909090' ) );
	if ( ! empty( $zerif_testimonials_author ) ) {
		echo '	.testimonial .feedback-box .client-info .client-name { color: ' . $zerif_testimonials_author . ' }';
	}
	$zerif_testimonials_quote = get_theme_mod( 'zerif_testimonials_quote', apply_filters( 'zerif_testimonials_quote_filter', '#e96656' ) );
	if ( ! empty( $zerif_testimonials_quote ) ) {
		echo '	.testimonial .feedback-box .quote { color: ' . $zerif_testimonials_quote . ' }';
	}
	$zerif_testimonials_box_color = get_theme_mod( 'zerif_testimonials_box_color', apply_filters( 'zerif_testimonials_box_color_filter', '#FFFFFF' ) );
	if ( ! empty( $zerif_testimonials_box_color ) ) {
		echo '	#client-feedbacks .feedback-box { background: ' . $zerif_testimonials_box_color . '; }';
	}

	/* END - Testimonials section */

	/* Ribbon sections */

	/* Bottom ribbon */
	$zerif_ribbon_background = get_theme_mod( 'zerif_ribbon_background', apply_filters( 'zerif_ribbon_background_filter', 'rgba(52, 210, 147, 0.8)' ) );
	if ( ! empty( $zerif_ribbon_background ) ) {
		echo '	.separator-one { background: ' . $zerif_ribbon_background . ' }';
	}
	$zerif_ribbon_text_color = get_theme_mod( 'zerif_ribbon_text_color', apply_filters( 'zerif_ribbon_text_color_filter', '#fff' ) );
	if ( ! empty( $zerif_ribbon_text_color ) ) {
		echo '	.separator-one h3 { color: ' . $zerif_ribbon_text_color . ' !important; }';
	}
	$zerif_ribbon_button_background = get_theme_mod( 'zerif_ribbon_button_background', apply_filters( 'zerif_ribbon_button_background_filter', '#20AA73' ) );
	if ( ! empty( $zerif_ribbon_button_background ) ) {
		echo '	.separator-one .green-btn { background: ' . $zerif_ribbon_button_background . ' }';
	}
	$zerif_ribbon_button_background_hover = get_theme_mod( 'zerif_ribbon_button_background_hover', apply_filters( 'zerif_ribbon_button_background_hover_filter', '#14a168' ) );
	if ( ! empty( $zerif_ribbon_button_background_hover ) ) {
		echo '	.separator-one .green-btn:hover { background: ' . $zerif_ribbon_button_background_hover . ' }';
	}
	$zerif_ribbon_button_button_color = get_theme_mod( 'zerif_ribbon_button_button_color', apply_filters( 'zerif_ribbon_button_button_color_filter', '#fff' ) );
	if ( ! empty( $zerif_ribbon_button_button_color ) ) {
		echo '	.separator-one .green-btn { color: ' . $zerif_ribbon_button_button_color . ' !important; }';
	}
	$zerif_ribbon_button_button_color_hover = get_theme_mod( 'zerif_ribbon_button_button_color_hover', apply_filters( 'zerif_ribbon_button_button_color_hover_filter', '#fff' ) );
	if ( ! empty( $zerif_ribbon_button_button_color_hover ) ) {
		echo '	.separator-one .green-btn:hover { color: ' . $zerif_ribbon_button_button_color_hover . ' !important; }';
	}

	/* Right ribbon */
	$zerif_ribbonright_background = get_theme_mod( 'zerif_ribbonright_background', apply_filters( 'zerif_ribbonright_background_filter', 'rgba(233, 102, 86, 1)' ) );
	if ( ! empty( $zerif_ribbonright_background ) ) {
		echo '	.purchase-now { background: ' . $zerif_ribbonright_background . ' }';
	}
	$zerif_ribbonright_text_color = get_theme_mod( 'zerif_ribbonright_text_color', apply_filters( 'zerif_ribbonright_text_color_filter', '#fff' ) );
	if ( ! empty( $zerif_ribbonright_text_color ) ) {
		echo '	.purchase-now h3 { color: ' . $zerif_ribbonright_text_color . ' }';
	}
	$zerif_ribbonright_button_background = get_theme_mod( 'zerif_ribbonright_button_background', apply_filters( 'zerif_ribbonright_button_background_filter', '#db5a4a' ) );
	if ( ! empty( $zerif_ribbonright_button_background ) ) {
		echo '	.purchase-now .red-btn { background: ' . $zerif_ribbonright_button_background . ' !important }';
	}
	$zerif_ribbonright_button_background_hover = get_theme_mod( 'zerif_ribbonright_button_background_hover', apply_filters( 'zerif_ribbonright_button_background_hover_filter', '#bf3928' ) );
	if ( ! empty( $zerif_ribbonright_button_background_hover ) ) {
		echo '	.purchase-now .red-btn:hover { background: ' . $zerif_ribbonright_button_background_hover . ' !important }';
	}
	$zerif_ribbonright_button_button_color = get_theme_mod( 'zerif_ribbonright_button_button_color', apply_filters( 'zerif_ribbonright_button_button_color_filter', '#fff' ) );
	if ( ! empty( $zerif_ribbonright_button_button_color ) ) {
		echo '	.purchase-now .red-btn { color: ' . $zerif_ribbonright_button_button_color . ' !important; }';
	}
	$zerif_ribbonright_button_button_color_hover = get_theme_mod( 'zerif_ribbonright_button_button_color_hover', apply_filters( 'zerif_ribbonright_button_button_color_hover_filter', '#fff' ) );
	if ( ! empty( $zerif_ribbonright_button_button_color_hover ) ) {
		echo '	.purchase-now .red-btn:hover { color: ' . $zerif_ribbonright_button_button_color_hover . ' !important; }';
	}

	/* END - Ribbon sections */

	/* Contact us section */

	$zerif_contacus_background = get_theme_mod( 'zerif_contacus_background', apply_filters( 'zerif_contacus_background_filters', 'rgba(0, 0, 0, 0.5)' ) );
	if ( ! empty( $zerif_contacus_background ) ) {
		echo '	.contact-us { background: ' . $zerif_contacus_background . ' }';
	}
	$zerif_contacus_header = get_theme_mod( 'zerif_contacus_header', apply_filters( 'zerif_contacus_header_filter', '#fff' ) );
	if ( ! empty( $zerif_contacus_header ) ) {
		echo '	.contact-us form.wpcf7-form p label, .contact-us form.wpcf7-form .wpcf7-list-item-label, .contact-us .section-header h2, .contact-us .section-header h6 { color: ' . $zerif_contacus_header . ' }';
	}
	$zerif_contacus_button_background = get_theme_mod( 'zerif_contacus_button_background', apply_filters( 'zerif_contacus_button_background_filter', '#e96656' ) );
	if ( ! empty( $zerif_contacus_button_background ) ) {
		echo '	.contact-us button { background: ' . $zerif_contacus_button_background . ' }';
	}
	$zerif_contacus_button_background_hover = get_theme_mod( 'zerif_contacus_button_background_hover', apply_filters( 'zerif_contacus_button_background_hover_filter', '#cb4332' ) );
	if ( ! empty( $zerif_contacus_button_background_hover ) ) {
		echo '	.contact-us button:hover { background: ' . $zerif_contacus_button_background_hover . ' !important; box-shadow: none; }';
	}
	$zerif_contacus_button_color = get_theme_mod( 'zerif_contacus_button_color', apply_filters( 'zerif_contacus_button_color_filter', '#fff' ) );
	if ( ! empty( $zerif_contacus_button_color ) ) {
		echo '	.contact-us button, .pirate_forms .pirate-forms-submit-button { color: ' . $zerif_contacus_button_color . ' !important; }';
	}
	$zerif_contacus_button_color_hover = get_theme_mod( 'zerif_contacus_button_color_hover', apply_filters( 'zerif_contacus_button_color_hover_filter', '#fff' ) );
	if ( ! empty( $zerif_contacus_button_color_hover ) ) {
		echo '	.contact-us button:hover, .pirate_forms .pirate-forms-submit-button:hover { color: ' . $zerif_contacus_button_color_hover . ' !important; }';
	}

	/* END - Contact us section */

	/* Packages section */

	$zerif_packages_header = get_theme_mod( 'zerif_packages_header', apply_filters( 'zerif_packages_header_filter', '#fff' ) );
	if ( ! empty( $zerif_packages_header ) ) {
		echo '	.packages .section-header h2, .packages .section-header h6 { color: ' . $zerif_packages_header . '}';
	}
	$zerif_package_title_color = get_theme_mod( 'zerif_package_title_color', apply_filters( 'zerif_package_title_color_filter', '#ffffff' ) );
	if ( ! empty( $zerif_package_title_color ) ) {
		echo '	.packages .package-header h5,.best-value .package-header h4,.best-value .package-header .meta-text { color: ' . $zerif_package_title_color . '}';
	}
	$zerif_package_text_color = get_theme_mod( 'zerif_package_text_color', apply_filters( 'zerif_package_text_color_filter', '#808080' ) );
	if ( ! empty( $zerif_package_text_color ) ) {
		echo '	.packages .package ul li, .packages .price .price-meta { color: ' . $zerif_package_text_color . '}';
	}
	$zerif_package_button_text_color = get_theme_mod( 'zerif_package_button_text_color', apply_filters( 'zerif_package_button_text_color_filter', '#fff' ) );
	if ( ! empty( $zerif_package_button_text_color ) ) {
		echo '	.packages .package .custom-button { color: ' . $zerif_package_button_text_color . ' !important; }';
	}
	$zerif_package_price_background_color = get_theme_mod( 'zerif_package_price_background_color', apply_filters( 'zerif_package_price_background_color_filter', '#404040' ) );
	if ( ! empty( $zerif_package_price_background_color ) ) {
		echo '	.packages .dark-bg { background: ' . $zerif_package_price_background_color . '; }';
	}
	$zerif_package_price_color = get_theme_mod( 'zerif_package_price_color', apply_filters( 'zerif_package_price_color_filter', '#fff' ) );
	if ( ! empty( $zerif_package_price_color ) ) {
		echo '	.packages .price h4 { color: ' . $zerif_package_price_color . '; }';
	}
	$zerif_packages_background = get_theme_mod( 'zerif_packages_background', apply_filters( 'zerif_packages_background_filter', 'rgba(0, 0, 0, 0.5)' ) );
	if ( ! empty( $zerif_packages_background ) ) {
		echo '	.packages { background: ' . $zerif_packages_background . ' }';
	}

	/* END - Packages section */

	/* Latest news section */

	$zerif_latestnews_background = get_theme_mod( 'zerif_latestnews_background', apply_filters( 'zerif_latestnews_background_filter', 'rgba(255, 255, 255, 1)' ) );
	if ( ! empty( $zerif_latestnews_background ) ) {
		echo '	#latestnews { background: ' . $zerif_latestnews_background . ' }';
	}

	$zerif_latestnews_header_title_color = get_theme_mod( 'zerif_latestnews_header_title_color', apply_filters( 'zerif_latestnews_header_title_color_filter', '#404040' ) );
	if ( ! empty( $zerif_latestnews_header_title_color ) ) {
		echo '	#latestnews .section-header h2 { color: ' . $zerif_latestnews_header_title_color . ' }';
	}

	$zerif_latestnews_header_subtitle_color = get_theme_mod( 'zerif_latestnews_header_subtitle_color', apply_filters( 'zerif_latestnews_header_subtitle_color_filter', '#808080' ) );
	if ( ! empty( $zerif_latestnews_header_subtitle_color ) ) {
		echo '	#latestnews .section-header h6 { color: ' . $zerif_latestnews_header_subtitle_color . ' }';
	}

	$zerif_latestnews_post_title_color = get_theme_mod( 'zerif_latestnews_post_title_color', apply_filters( 'zerif_latestnews_post_title_color_filter', '#404040' ) );
	if ( ! empty( $zerif_latestnews_post_title_color ) ) {
		echo '	#latestnews #carousel-homepage-latestnews .carousel-inner .item .latestnews-title a { color: ' . $zerif_latestnews_post_title_color . '}';
	}

	$zerif_latestnews_post_underline_color1 = get_theme_mod( 'zerif_latestnews_post_underline_color1', apply_filters( 'zerif_latestnews_post_underline_color1_filter', '#e96656' ) );
	if ( ! empty( $zerif_latestnews_post_underline_color1 ) ) {
		echo '	#latestnews #carousel-homepage-latestnews .item .latestnews-box:nth-child(4n+1) .latestnews-title a:before { background: ' . $zerif_latestnews_post_underline_color1 . '}';
	}

	$zerif_latestnews_post_underline_color2 = get_theme_mod( 'zerif_latestnews_post_underline_color2', apply_filters( 'zerif_latestnews_post_underline_color2_filter', '#34d293' ) );
	if ( ! empty( $zerif_latestnews_post_underline_color2 ) ) {
		echo '	#latestnews #carousel-homepage-latestnews .item .latestnews-box:nth-child(4n+2) .latestnews-title a:before { background: ' . $zerif_latestnews_post_underline_color2 . '}';
	}

	$zerif_latestnews_post_underline_color3 = get_theme_mod( 'zerif_latestnews_post_underline_color3', apply_filters( 'zerif_latestnews_post_underline_color3_filter', '#3ab0e2' ) );
	if ( ! empty( $zerif_latestnews_post_underline_color3 ) ) {
		echo '	#latestnews #carousel-homepage-latestnews .item .latestnews-box:nth-child(4n+3) .latestnews-title a:before { background: ' . $zerif_latestnews_post_underline_color3 . '}';
	}

	$zerif_latestnews_post_underline_color4 = get_theme_mod( 'zerif_latestnews_post_underline_color4', apply_filters( 'zerif_latestnews_post_underline_color4_filter', '#f7d861' ) );
	if ( ! empty( $zerif_latestnews_post_underline_color4 ) ) {
		echo '	#latestnews #carousel-homepage-latestnews .item .latestnews-box:nth-child(4n+4) .latestnews-title a:before { background: ' . $zerif_latestnews_post_underline_color4 . '}';
	}

	$zerif_latestnews_post_text_color = get_theme_mod( 'zerif_latestnews_post_text_color', apply_filters( 'zerif_latestnews_post_text_color_filter', '#909090' ) );
	if ( ! empty( $zerif_latestnews_post_text_color ) ) {
		echo '	#latestnews .latesnews-content p, .latesnews-content { color: ' . $zerif_latestnews_post_text_color . '}';
	}

	/* END - Latest news section */

	/* Subscribe section */

	$zerif_subscribe_background = get_theme_mod( 'zerif_subscribe_background', apply_filters( 'zerif_subscribe_background_filter', 'rgba(0, 0, 0, 0.5)' ) );
	if ( ! empty( $zerif_subscribe_background ) ) {
		echo ' section#subscribe { background: ' . $zerif_subscribe_background . ' !important; }';
	}
	$zerif_subscribe_header_color = get_theme_mod( 'zerif_subscribe_header_color', apply_filters( 'zerif_subscribe_header_color_filter', '#fff' ) );
	if ( ! empty( $zerif_subscribe_header_color ) ) {
		echo ' section#subscribe h3, .newsletter .sub-heading, .newsletter label { color: ' . $zerif_subscribe_header_color . ' !important; }';
	}
	$zerif_subscribe_button_color = get_theme_mod( 'zerif_subscribe_button_color', apply_filters( 'zerif_subscribe_button_color_filter', '#fff' ) );
	if ( ! empty( $zerif_subscribe_button_color ) ) {
		echo ' section#subscribe input[type="submit"] { color: ' . $zerif_subscribe_button_color . ' !important; }';
	}
	$zerif_subscribe_button_background_color = get_theme_mod( 'zerif_subscribe_button_background_color', apply_filters( 'zerif_subscribe_button_background_color_filter', '#e96656' ) );
	if ( ! empty( $zerif_subscribe_button_background_color ) ) {
		echo ' section#subscribe input[type="submit"] { background: ' . $zerif_subscribe_button_background_color . ' !important; }';
	}
	$zerif_subscribe_button_background_color_hover = get_theme_mod( 'zerif_subscribe_button_background_color_hover', apply_filters( 'zerif_subscribe_button_background_color_hover_filter', '#cb4332' ) );
	if ( ! empty( $zerif_subscribe_button_background_color_hover ) ) {
		echo ' section#subscribe input[type="submit"]:hover { background: ' . $zerif_subscribe_button_background_color_hover . ' !important; }';
	}

	/* END - Subscribe section */

	/* Footer  */

	$zerif_footer_background = get_theme_mod( 'zerif_footer_background', apply_filters( 'zerif_footer_background_filter', '#272727' ) );
	if ( ! empty( $zerif_footer_background ) ) {
		echo '	#footer { background: ' . $zerif_footer_background . ' }';
	}
	$zerif_footer_socials_background = get_theme_mod( 'zerif_footer_socials_background', apply_filters( 'zerif_footer_socials_background_filter', '#171717' ) );
	if ( ! empty( $zerif_footer_socials_background ) ) {
		echo '	.copyright { background: ' . $zerif_footer_socials_background . ' }';
	}
	$zerif_footer_text_color = get_theme_mod( 'zerif_footer_text_color', apply_filters( 'zerif_footer_text_color_filter', '#939393' ) );
	if ( ! empty( $zerif_footer_text_color ) ) {
		echo '	#footer .company-details, #footer .company-details a, #footer .footer-widget p, #footer .footer-widget a { color: ' . $zerif_footer_text_color . ' !important; }';
	}
	$zerif_footer_socials = get_theme_mod( 'zerif_footer_socials', apply_filters( 'zerif_footer_socials_filter', '#939393' ) );
	if ( ! empty( $zerif_footer_socials ) ) {
		echo '	#footer .social li a { color: ' . $zerif_footer_socials . ' }';
	}
	$zerif_footer_socials_hover = get_theme_mod( 'zerif_footer_socials_hover', apply_filters( 'zerif_footer_socials_hover_filter', '#e96656' ) );
	if ( ! empty( $zerif_footer_socials_hover ) ) {
		echo '	#footer .social li a:hover { color: ' . $zerif_footer_socials_hover . ' }';
	}
	$zerif_footer_text_color_hover = get_theme_mod( 'zerif_footer_text_color_hover', apply_filters( 'zerif_footer_text_color_hover_filter', '#e96656' ) );
	if ( ! empty( $zerif_footer_text_color_hover ) ) {
		echo '	#footer .company-details a:hover, #footer .footer-widget a:hover { color: ' . $zerif_footer_text_color_hover . ' !important; }';
	}
	$zerif_footer_widgets_title = get_theme_mod( 'zerif_footer_widgets_title', apply_filters( 'zerif_footer_widgets_title_filter', '#fff' ) );
	if ( ! empty( $zerif_footer_widgets_title ) ) {
		echo '	#footer .footer-widget h1 { color: ' . $zerif_footer_widgets_title . ' !important; }';
	}
	$zerif_footer_widgets_title_border_bottom = get_theme_mod( 'zerif_footer_widgets_title_border_bottom', apply_filters( 'zerif_footer_widgets_title_border_bottom_filter', '#e96656' ) );
	if ( ! empty( $zerif_footer_widgets_title_border_bottom ) ) {
		echo '	#footer .footer-widget h1:before { background: ' . $zerif_footer_widgets_title_border_bottom . ' !important; }';
	}

	/* END - Footer  */

	/* Buttons  */

	$zerif_buttons_background_color = get_theme_mod( 'zerif_buttons_background_color', apply_filters( 'zerif_buttons_background_color_filter', '#e96656' ) );

	if ( ! empty( $zerif_buttons_background_color ) ) {
		echo '	.comment-form #submit, .comment-reply-link,.woocommerce .add_to_cart_button, .woocommerce .checkout-button, .woocommerce .single_add_to_cart_button, .woocommerce #place_order, .edd-submit.button, .page button, .post button, .woocommerce-page .woocommerce input[type="submit"], .woocommerce-page #content input.button, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page input.button.alt, .woocommerce-page .products a.button { background-color: ' . $zerif_buttons_background_color . ' !important; }';
	}

	$zerif_buttons_background_color_hover = get_theme_mod( 'zerif_buttons_background_color_hover', apply_filters( 'zerif_buttons_background_color_hover_filter', '#cb4332' ) );

	if ( ! empty( $zerif_buttons_background_color_hover ) ) {
		echo '	.comment-form #submit:hover, .comment-reply-link:hover, .woocommerce .add_to_cart_button:hover, .woocommerce .checkout-button:hover, .woocommerce  .single_add_to_cart_button:hover, .woocommerce #place_order:hover, .edd-submit.button:hover, .page button:hover, .post button:hover, .woocommerce-page .woocommerce input[type="submit"]:hover, .woocommerce-page #content input.button:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page .products a.button:hover { background-color: ' . $zerif_buttons_background_color_hover . ' !important; box-shadow: none; }';
	}

	$zerif_buttons_text_color = get_theme_mod( 'zerif_buttons_text_color', apply_filters( 'zerif_buttons_text_color_filter', '#fff' ) );

	if ( ! empty( $zerif_buttons_text_color ) ) {
		echo '	.comment-form #submit, .comment-reply-link, .woocommerce .add_to_cart_button, .woocommerce .checkout-button, .woocommerce .single_add_to_cart_button, .woocommerce #place_order, .edd-submit.button span, .page button, .post button, .woocommerce-page .woocommerce input[type="submit"], .woocommerce-page #content input.button, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page input.button.alt, .woocommerce .button { color: ' . $zerif_buttons_text_color . ' !important }';
	}

	/* END - Buttons  */

	echo '</style>';

}

/**
 * Custom excerpt
 *
 * @param string $more Current excerpt.
 */
function zerif_excerpt_more( $more ) {
	$zerif_accessibility = get_theme_mod( 'zerif_accessibility' );
	if ( isset( $zerif_accessibility ) && $zerif_accessibility == 1 ) {
		/* translators: 1 - br tag, 2 - Post title */
		$more = sprintf( __( '%1$s Continue reading%2$s', 'zerif' ), '<br/>->', '<span class="screen-reader-text">  ' . get_the_title() . '</span>' );
		return '<a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . $more . '</a>';
	} else {
		return '<a href="' . get_permalink() . '">[...]</a>';
	}
}
add_filter( 'excerpt_more', 'zerif_excerpt_more' );

add_action( 'wp_enqueue_scripts', 'recaptcha_scripts' );

/**
 * Enqueue Google reCAPTCHA scripts
 */
function recaptcha_scripts() {

	if ( is_home() ) {

		$zerif_contactus_sitekey        = get_theme_mod( 'zerif_contactus_sitekey' );
		$zerif_contactus_secretkey      = get_theme_mod( 'zerif_contactus_secretkey' );
		$zerif_contactus_recaptcha_show = get_theme_mod( 'zerif_contactus_recaptcha_show' );
		if ( defined( 'POLYLANG_VERSION' ) && function_exists( 'pll_current_language' ) ) {
			$zerif_contactus_language = pll_current_language();
		} else {
			$zerif_contactus_language = get_locale();
		}

		if ( isset( $zerif_contactus_recaptcha_show ) && $zerif_contactus_recaptcha_show != 1 && ! empty( $zerif_contactus_sitekey ) && ! empty( $zerif_contactus_secretkey ) ) {

			wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js?hl=' . $zerif_contactus_language . '', false, ZERIF_VERSION, true );

		}
	}

}
add_action( 'after_switch_theme', 'zerif_get_lite_options' );

/**
 * Import zerif lite options
 */
function zerif_get_lite_options() {

	$theme_slug   = 'zerif-lite';
	$old_theme    = get_option( 'theme_switched' );
	$old_theme    = strtolower( $old_theme );
	$theme_object = wp_get_theme( $old_theme );
	if ( ! empty( $theme_object ) && property_exists( $theme_object, 'template' ) ) {
		if ( $theme_object->template === 'zerif-lite' ) {
			$theme_slug = $old_theme;
		}
	}
	$zerif_mods = get_option( 'theme_mods_' . $theme_slug );

	if ( empty( $zerif_mods ) ) {
		return;
	}

	if ( ( array_key_exists( 'zerif_bigtitle_title_2', $zerif_mods ) ) && ( array_key_exists( 'zerif_bigtitle_title', $zerif_mods ) ) ) {
		unset( $zerif_mods['zerif_bigtitle_title'] );
	}

	if ( ( array_key_exists( 'zerif_ourfocus_title_2', $zerif_mods ) ) && ( array_key_exists( 'zerif_ourfocus_title', $zerif_mods ) ) ) {
		unset( $zerif_mods['zerif_ourfocus_title'] );
	}

	if ( ( array_key_exists( 'zerif_bigtitle_redbutton_label_2', $zerif_mods ) ) && ( array_key_exists( 'zerif_bigtitle_redbutton_label', $zerif_mods ) ) ) {
		unset( $zerif_mods['zerif_bigtitle_redbutton_label'] );
	}

	foreach ( $zerif_mods as $zerif_mod_k => $zerif_mod_v ) {

		if ( $zerif_mod_k == 'zerif_bigtitle_title_2' ) {

			set_theme_mod( 'zerif_bigtitle_title', $zerif_mod_v );

		} elseif ( $zerif_mod_k == 'zerif_ourfocus_title_2' ) {

			set_theme_mod( 'zerif_ourfocus_title', $zerif_mod_v );

		} elseif ( $zerif_mod_k == 'zerif_bigtitle_redbutton_label_2' ) {

			set_theme_mod( 'zerif_bigtitle_redbutton_label', $zerif_mod_v );

		} else {

			set_theme_mod( $zerif_mod_k, $zerif_mod_v );

		}
	}
}

add_filter( 'body_class', 'remove_class_function' );

/**
 * Remove custom-background from body_class()
 */
function remove_class_function( $classes ) {

	$zerif_background_settings = get_theme_mod( 'zerif_background_settings', 'zerif-background-image' );

	$pid                      = get_the_ID();
	$page_template            = get_page_template_slug( $pid );
	$zerif_enable_blog_header = get_theme_mod( 'zerif_enable_blog_header', false );
	if ( $page_template === 'template-blog-large.php' || $page_template === 'template-blog.php' || $zerif_enable_blog_header === false ) {
		return $classes;
	}

	if ( ! is_home() || ( ( ! empty( $zerif_background_settings ) ) && ( $zerif_background_settings != 'zerif-background-image' ) ) || ( empty( $zerif_background_settings ) && ( ! empty( $zerif_bgslider_1 ) || ! empty( $zerif_bgslider_2 ) || ! empty( $zerif_bgslider_3 ) ) ) ) {
		// index of custom-background
		$key = array_search( 'custom-background', $classes );
		// remove class
		unset( $classes[ $key ] );
	}
	return $classes;
}

add_filter( 'pre_get_posts', 'zerif_query_post_type' );

/**
 * Make archive pages work with the CPT
 */
function zerif_query_post_type( $query ) {

	if ( ( is_category() || is_tag() ) && ( $query->is_main_query() ) ) {
		$post_type = get_query_var( 'post_type' );
		if ( $post_type ) {
			$post_type = $post_type;
		} else {
			$post_type = array( 'nav_menu_item', 'post', 'portofolio' );
		}
		$query->set( 'post_type', $post_type );
		return $query;
	}
}

/**
 * Convert hexdec color string to rgb(a) string
 */
function zerif_hex2rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	// Return default if no color provided
	if ( empty( $color ) ) {
		return $default;
	}

	// Sanitize $color if "#" is provided
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	// Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	// Convert hexadec to rgb
	$rgb = array_map( 'hexdec', $hex );

	// Check if opacity is set(rgba or rgb)
	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
	} else {
		$output = 'rgb(' . implode( ',', $rgb ) . ')';
	}

	// Return rgb(a) color string
	return $output;
}


/**
 * Inline style
 */
function zerif_inline_style() {

	$zerif_menu_item_color       = get_theme_mod( 'zerif_menu_item_color' );
	$zerif_menu_item_hover_color = get_theme_mod( 'zerif_menu_item_hover_color' );
	$zerif_links_color           = get_theme_mod( 'zerif_links_color', apply_filters( 'zerif_links_color_filter', '#808080' ) );
	$zerif_links_color_hover     = get_theme_mod( 'zerif_links_color_hover', apply_filters( 'zerif_links_color_hover_filter', '#e96656' ) );

	$zerif_custom_css = '';
	if ( ! empty( $zerif_menu_item_color ) ) {
		$zerif_custom_css .= '
		.navbar-inverse .navbar-nav > li > a, 
		.nav.navbar-inverse .nav.navbar-nav ul.sub-menu li a,
		.navbar.navbar-inverse .primary-menu a, 
		.navbar.navbar-inverse .primary-menu > li > a, 
		.nav.navbar-inverse .primary-menu ul.sub-menu li a {
			color:' . $zerif_menu_item_color . ';
		}';
	} elseif ( ! empty( $zerif_links_color ) ) {
		$zerif_custom_css .= '
		.navbar-inverse .navbar-nav > li > a,
		.nav.navbar-inverse .nav.navbar-nav ul.sub-menu li a,
		.navbar.navbar-inverse .primary-menu a, 
		.navbar.navbar-inverse .primary-menu > li > a, 
		.nav.navbar-inverse .primary-menu ul.sub-menu li a {
			color:' . $zerif_links_color . ';
		}';
	}

	if ( ! empty( $zerif_menu_item_hover_color ) ) {
		$zerif_custom_css .= '
		.navbar-inverse .navbar-nav > li.current-menu-item > a:not(.page-anchor),
		.navbar.navbar-inverse .nav.navbar-nav>li.current>a,
		.navbar.navbar-inverse .nav.navbar-nav a:hover, 
		.navbar.navbar-inverse .nav.navbar-nav > li > a:hover, 
		.nav.navbar-inverse .nav.navbar-nav ul.sub-menu li a:hover,
		.navbar.navbar-inverse .primary-menu a:hover, 
		.navbar.navbar-inverse .primary-menu > li > a:hover, 
		.nav.navbar-inverse .primary-menu ul.sub-menu li a:hover {
			color:' . $zerif_menu_item_hover_color . ';
		}';
	} elseif ( ! empty( $zerif_links_color_hover ) ) {
		$zerif_custom_css .= '
		.navbar-inverse .navbar-nav > li.current-menu-item > a:not(.page-anchor),
		.navbar.navbar-inverse .nav.navbar-nav>li.current>a,
		.navbar.navbar-inverse .nav.navbar-nav a:hover, 
		.navbar.navbar-inverse .nav.navbar-nav > li > a:hover, 
		.nav.navbar-inverse .nav.navbar-nav ul.sub-menu li a:hover,
		.navbar.navbar-inverse .primary-menu a:hover, 
		.navbar.navbar-inverse .primary-menu > li > a:hover, 
		.nav.navbar-inverse .primary-menu ul.sub-menu li a:hover {
			color:' . $zerif_links_color_hover . ';
		}';
	}

	$zerif_accessibility = get_theme_mod( 'zerif_accessibility' );
	if ( isset( $zerif_accessibility ) && $zerif_accessibility == 1 ) {
		$zerif_custom_css .= '
		.screen-reader-text {
			clip: rect(1px, 1px, 1px, 1px);
			height: 1px;
			overflow: hidden;
			position: absolute !important;
			width: 1px;
		}


		.primary-menu nav{
			float:right;
		}
		.primary-menu ul{
			list-style:none;
			margin:0;
		}

		.primary-menu ul li {
			display: inline-block;
			position: relative;
			margin-right: 20px;
			margin-top: 20px;
			float: left;
		}

		.primary-menu ul li:last-child{
			margin-right:0;
		}

		.primary-menu ul li:hover > a, .primary-menu ul li a:focus {
			color: #e96656;
		}

		.primary-menu ul li a {
			text-decoration:none;
			display: block;
			color: #404040;;
			line-height: 35px;
		}

		.primary-menu ul li:hover > .sub-menu {
			left: 0;
			margin: 0;
		}

		.primary-menu ul ul li:hover > .sub-menu {
			left: 200px;
			top: 0;
		}

		.sub-menu{
			position: absolute;
			left: -9999px;
			top: 100%;
			background: #fff;
			width: 200px;
			box-shadow: 3px 3px 2px rgba(50, 50, 50, 0.08);
			z-index: 9999;
		}

		.primary-menu ul.sub-menu li{
			display:block;
			width: 100%;
			float: none;
			position: relative;
			list-style: none;
			padding: 10px;
			margin:0;
		}

		.primary-menu ul.sub-menu li a{
			display: block;
			line-height: initial;
		}



		.primary-menu .menu li.acc-focus > .sub-menu {
			left: 0;
			margin: 0;
		}

		@media (min-width: 768px){
			.primary-menu .menu ul li.acc-focus > .sub-menu {
				left: 200px;
				top: 0;
			}

			.children li.acc-focus .children{
				left: 200px;
				top: 0;
			}
		}

		.acc-focus > .children{
			left: 0;
			margin: 0;
		}

		.skip-link {
			display: inline-block;
			position: absolute;
			top: 1em;
			left: 0.5em;
			overflow: hidden;
			width: 1px;
			height: 1px;
			clip: rect(0, 0, 0, 0);
		}

		.skip-link:focus {
			width: auto;
			height: auto;
			clip: auto;
			z-index: 9999;
			padding: 10px;
			border: 1px solid;
			background-color:#EFEFEF;
			color:#176BA1;
			text-decoration:none;
			font-weight:bold;
		}

		@media (min-width: 768px){
			.primary-menu{
				display:block!important;
			}
		}
		@media (max-width: 767px) {
			.primary-menu{
				display:none;
			}

			.primary-menu ul li {
				width:100%;
				border-bottom: 1px solid #EDEDED;
				position: relative;
				margin: 8px 0 0 0;
				padding: 0 0 8px 0;
			}
			.navbar.navbar-inverse .primary-menu ul.sub-menu li a {
				width: 100%;
				float: left;
				padding: 8px 25px 8px 0;
			}

			.primary-menu nav {
				float:none;
				padding-right: 15px;
				padding-left: 15px;
			}

			.sub-menu {
				position: relative;
				display: none;
				width: 100%;
				box-shadow:none;
				z-index: initial;
				right:0;
			}

			.primary-menu ul.sub-menu li:last-child{
				border-bottom:none;
			}

			.dropdown-toggle:focus{
				background-color:#D44141;`
			}
		}
		';
	} else {
		$zerif_custom_css .= '
		.screen-reader-text {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute !important;
		}
		.screen-reader-text:hover,
		.screen-reader-text:active,
		.screen-reader-text:focus {
			background-color: #f1f1f1;
			border-radius: 3px;
			box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
			clip: auto !important;
			color: #21759b;
			display: block;
			font-size: 14px;
			font-weight: bold;
			height: auto;
			left: 5px;
			line-height: normal;
			padding: 15px 23px 14px;
			text-decoration: none;
			top: 5px;
			width: auto;
			z-index: 100000; !* Above WP toolbar *!
		}';
	}// End if().

	/* Fix for grid layout */
	$blog_layout = get_theme_mod( 'zerif_blog_grid_layout', 1 );
	if ( $blog_layout > 1 ) {
		$zerif_custom_css .= '.site-main article:nth-child(' . $blog_layout . 'n+1){
			clear:both;
		}';
	}

	wp_add_inline_style( 'zerif_style', $zerif_custom_css );
}
add_action( 'wp_enqueue_scripts', 'zerif_inline_style' );

/*Accesibility - skip links */
/**
 * Adds "inner" id to the site-inner content/sidebar wrap element on HTML5 child themes.
 * Using inner, since Genesis uses this id when HTML5 is disabled.
 *
 * @param  array $attributes Array of element attributes.
 *
 * @return array Same array of element attributes with the id added.
 */
function zerif_add_content_id( $attributes ) {
	$attributes['id'] = 'inner';
	return $attributes;
}

/**
 * Add a link first thing after the body element that will skip to the inner element.
 */
function zerif_add_skip_link() {
	echo '<a class="skip-link" href="#inner">' . __( 'Skip to content', 'zerif' ) . '</a>';
}

/**
 * Tabindex fix for specific browsers to fix skip link.
 * Read more:
 * http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
 */
function zerif_fix_skiplink() {
	wp_register_script(
		'theme_skiplink-fix',
		get_template_directory_uri() . '/js/skiplink-fix.js',
		array(),
		'',
		true
	);
	wp_enqueue_script( 'theme_skiplink-fix' );
}


$zerif_accessibility = get_theme_mod( 'zerif_accessibility' );
if ( isset( $zerif_accessibility ) && $zerif_accessibility == 1 ) {
	add_filter( 'genesis_attr_site-inner', 'zerif_add_content_id', 15 );
	add_action( 'genesis_before', 'zerif_add_skip_link', 1 );
	add_action( 'wp_enqueue_scripts', 'zerif_fix_skiplink' );
}

add_action( 'wp_ajax_nopriv_request_post', 'zerif_requestpost' );
add_action( 'wp_ajax_request_post', 'zerif_requestpost' );

/**
 * Used for Shortcodes section
 */
function zerif_requestpost() {

	if ( isset( $_POST['show'] ) ) {
		$zerif_shortcodes_show = $_POST['show'];
	}

	if ( isset( $_POST['shortcodes'] ) ) {
		$zerif_shortcodes_section_decoded = $_POST['shortcodes'];
	}

	if ( isset( $zerif_shortcodes_show ) && $zerif_shortcodes_show != 'true' ) {
		?>
		<div class="zerif_shortcodes">
			<?php
	} else {
		?>
		<div class="zerif_shortcodes zerif_hidden_if_not_customizer">
		<?php
	}

	if ( ! empty( $zerif_shortcodes_section_decoded ) ) {
		$zerif_custom_css = '';
		foreach ( $zerif_shortcodes_section_decoded as $zerif_shortcode_box ) {
			$zerif_bg_color    = zerif_hex2rgba( $zerif_shortcode_box['color'], $zerif_shortcode_box['opacity'] );
			$zerif_custom_css .= '#' . $zerif_shortcode_box['id'] . '{
				background-color:' . $zerif_bg_color . ';
			}
			#' . $zerif_shortcode_box['id'] . ' .section-header h2, #' . $zerif_shortcode_box['id'] . ' .section-header h6{
				color:' . $zerif_shortcode_box['text_color'] . ';
			}
			';
			?>
			<style>
				<?php
				echo $zerif_custom_css;
				?>
			</style>

			<section class="shortcodes" id="<?php echo ( ! empty( $zerif_shortcode_box['id'] ) ? esc_html( $zerif_shortcode_box['id'] ) : '' ); ?>">
				<div class="container">
					<div class="section-header">
						<h2 class="dark-text"><?php echo ( ! empty( $zerif_shortcode_box['title'] ) ? wp_kses_post( $zerif_shortcode_box['title'] ) : '' ); ?></h2>
						<h6><?php echo ( ! empty( $zerif_shortcode_box['subtitle'] ) ? wp_kses_post( $zerif_shortcode_box['subtitle'] ) : '' ); ?></h6>
					</div>

					<div class="row" data-scrollreveal="enter left after 0s over 2s">
						<?php
						if ( ! empty( $zerif_shortcode_box['shortcode'] ) ) {
							$scd = html_entity_decode( $zerif_shortcode_box['shortcode'] );
							echo do_shortcode( $scd );
						}
						?>
					</div>
				</div>
			</section>

			<?php
		}
		?>
		</div>
		<?php
	}// End if().
	die();
}

/**
 * Footer socials for accesibility
 *
 * @param string $link Link.
 * @param string $label Label.
 * @param bool   $accessibility Check for accessibility.
 * @param string $icon_class Icon class.
 * @param string $new_tab Check for opening link in new tab.
 */
function zerif_footer_social( $link, $label, $accessibility, $icon_class, $new_tab = '' ) {
	if ( empty( $new_tab ) ) {
		$zerif_new_tab = ( isset( $accessibility ) && ( $accessibility != 1 ) ? 'target="_blank"' : '' );
	} else {
		$zerif_new_tab = ( isset( $new_tab ) && ( $new_tab != 1 ) ? 'target="_blank"' : '' );
	}

	if ( ! empty( $link ) ) {

		switch ( $icon_class ) {
			case 'fa-envelope':
				$link = 'mailto:' . esc_attr( $link );
				break;
			case 'fa-phone':
				$link = 'tel:' . esc_attr( $link );
				break;
			default:
				$link = esc_url( $link );
		}

		$screen_reader_text = '';
		if ( isset( $accessibility ) && $accessibility == 1 ) {
			$screen_reader_text = '<span class="screen-reader-text">' . $label . '</span>';
		}
		?>
		<li
		<?php
		if ( ! empty( $icon_class ) ) {
			echo ' id="' . esc_attr( substr( $icon_class, 3 ) ) . '"'; }
		?>
>
			<a <?php echo $zerif_new_tab; ?> title="<?php echo esc_attr( $label ); ?>" href="<?php echo $link; ?>">
				<?php echo $screen_reader_text; ?>
				<i class="fa <?php echo $icon_class; ?>"></i>
			</a>
		</li>
		<?php
	}
}

/**
 * Check if socials are empty
 *
 * @param array $array Array of Socials.
 */
function zerif_empty_socials( $array ) {
	if ( empty( $array ) ) {
		return true;
	}
	foreach ( $array as $item ) {
		if ( ! empty( $item['link'] ) ) {
			return false;
		}
	}
	return true;
}

if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {

	/**
	 *  Fix for widgets with media uploads not working with SiteOrigin Page builder
	 */
	function zerif_widgets_siteorigin_enqueue_scripts() {

		wp_enqueue_script( 'zerif_widget_media_script', get_template_directory_uri() . '/js/widget-media.js', false, ZERIF_VERSION, true );

	}
	add_action( 'siteorigin_panel_enqueue_admin_scripts', 'zerif_widgets_siteorigin_enqueue_scripts' );

}

/**
 * Save activation time.
 *
 * @since 1.8.8.3
 * @access public
 */
function zerif_time_activated() {
	update_option( 'zerif_time_activated', time() );
}
add_action( 'after_switch_theme', 'zerif_time_activated' );
/**
 * Check if $no_seconds have passed since theme was activated.
 * Used to perform certain actions, like adding a new recommended action in About Zerif page.
 *
 * @since 1.8.8.3
 * @access public
 * @return bool
 */
function zerif_check_passed_time( $no_seconds ) {
	$activation_time = get_option( 'zerif_time_activated' );
	if ( ! empty( $activation_time ) ) {
		$current_time    = time();
		$time_difference = (int) $no_seconds;
		if ( $current_time >= $activation_time + $time_difference ) {
			return true;
		} else {
			return false;
		}
	}
	return true;
}

add_action( 'woocommerce_before_checkout_form', 'zerif_coupon_after_order_table_js' );
/**
 * Checkout page
 * Move the coupon fild and message info after the order table
 **/
function zerif_coupon_after_order_table_js() {
	wc_enqueue_js(
		'
		$( $( "div.woocommerce-info, .checkout_coupon" ).detach() ).appendTo( "#zerif-checkout-coupon" );
	'
	);
}
add_action( 'woocommerce_checkout_order_review', 'zerif_coupon_after_order_table' );
/**
 * Checkout page
 * Add the id zerif-checkout-coupon to be able to Move the coupon fild and message info after the order table
 **/
function zerif_coupon_after_order_table() {
	echo '<div id="zerif-checkout-coupon"></div><div style="clear:both"></div>';
}

/**
 * Max Mega Menu Zerif Theme
 **/
function megamenu_add_theme_zerif_pro_max_menu( $themes ) {
	$themes['zerif_pro_max_menu'] = array(
		'title'                                    => 'Zelle Pro',
		'menu_item_align'                          => 'right',
		'menu_item_link_height'                    => '70px',
		'container_background_from'                => 'rgb(255, 255, 255)',
		'container_background_to'                  => 'rgb(255, 255, 255)',
		'menu_item_background_hover_from'          => 'rgb(255, 255, 255)',
		'menu_item_background_hover_to'            => 'rgb(255, 255, 255)',
		'menu_item_link_font_size'                 => '15px',
		'menu_item_link_color'                     => 'rgb(49, 49, 49)',
		'menu_item_link_color_hover'               => 'rgb(233, 102, 86)',
		'menu_item_highlight_current'              => 'off',
		'panel_background_from'                    => 'rgb(255, 255, 255)',
		'panel_background_to'                      => 'rgb(255, 255, 255)',
		'panel_header_font_size'                   => '15px',
		'panel_header_font_weight'                 => 'normal',
		'panel_header_border_color'                => '#555',
		'panel_font_size'                          => '15px',
		'panel_font_color'                         => 'rgb(49, 49, 49)',
		'panel_font_color_hover'                   => 'rgb(233, 102, 86)',
		'panel_font_family'                        => 'inherit',
		'panel_second_level_font_color'            => 'rgb(49, 49, 49)',
		'panel_second_level_font_color_hover'      => 'rgb(233, 102, 86)',
		'panel_second_level_text_transform'        => 'none',
		'panel_second_level_font'                  => 'inherit',
		'panel_second_level_font_size'             => '15px',
		'panel_second_level_font_weight'           => 'normal',
		'panel_second_level_font_weight_hover'     => 'normal',
		'panel_second_level_text_decoration'       => 'none',
		'panel_second_level_text_decoration_hover' => 'none',
		'panel_second_level_padding_left'          => '20px',
		'panel_second_level_border_color'          => '#555',
		'panel_third_level_font_color'             => 'rgb(49, 49, 49)',
		'panel_third_level_font_color_hover'       => 'rgb(233, 102, 86)',
		'panel_third_level_font'                   => 'inherit',
		'panel_third_level_font_size'              => '15px',
		'panel_third_level_padding_left'           => '20px',
		'flyout_background_from'                   => 'rgb(255, 255, 255)',
		'flyout_background_to'                     => 'rgb(255, 255, 255)',
		'flyout_background_hover_from'             => 'rgb(255, 255, 255)',
		'flyout_background_hover_to'               => 'rgb(255, 255, 255)',
		'flyout_link_size'                         => '15px',
		'flyout_link_color'                        => 'rgb(49, 49, 49)',
		'flyout_link_color_hover'                  => 'rgb(233, 102, 86)',
		'flyout_link_family'                       => 'inherit',
		'responsive_breakpoint'                    => '768px',
		'resets'                                   => 'on',
		'toggle_background_from'                   => '#222',
		'toggle_background_to'                     => '#222',
		'toggle_font_color'                        => 'rgb(102, 102, 102)',
		'mobile_background_from'                   => 'rgb(255, 255, 255)',
		'mobile_background_to'                     => 'rgb(255, 255, 255)',
		'mobile_menu_item_link_font_size'          => '15px',
		'mobile_menu_item_link_color'              => 'rgb(102, 102, 102)',
		'mobile_menu_item_link_text_align'         => 'left',
	);
	return $themes;
}
add_filter( 'megamenu_themes', 'megamenu_add_theme_zerif_pro_max_menu' );


/**
 * WooCommerce compatibility
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/compatibility/woocommerce/hooks.php' );

/**
 * Enqueue notice scripts.
 */
function zerif_enqueue_notice_scripts() {
	if ( ! is_admin() ) {
		return;
	}
	wp_enqueue_script(
		'zerif-zelle-notice',
		get_template_directory_uri() . '/js/zerif-zelle-notice.js',
		false,
		ZERIF_VERSION,
		true
	);
	wp_localize_script(
		'zerif-zelle-notice',
		'zerifNotice',
		array(
			'ajaxurl'      => admin_url( 'admin-ajax.php' ),
			'dismissNonce' => wp_create_nonce( 'dismiss_zelle_notice' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'zerif_enqueue_notice_scripts' );
