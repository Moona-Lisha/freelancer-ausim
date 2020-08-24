<?php
/**
 * WordPress editor compatibility.
 *
 * @package zerif
 */

/**
 * Class WP_Editor
 */
class Zerif_WP_Editor extends Zerif_Abstract_Main {

	/**
	 * Init WordPress Editor integration.
	 */
	public function init() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue() {
		$this->enqueue_scripts();
		$this->enqueue_styles();
	}

	/**
	 * Enqueue js scripts.
	 */
	private function enqueue_scripts() {
		wp_enqueue_script( 'wp-editor-integration', ZERIF_PHP_INCLUDE_URI . '/compatibility/wordpress-editor/wp-editor-scripts.js', array( 'jquery' ), ZERIF_VERSION, true );
		$editor_params = $this->get_wp_editor_params();
		if ( ! empty( $editor_params ) ) {
			wp_localize_script( 'wp-editor-integration', 'wpEditor', $editor_params );
		}
	}

	/**
	 * Get editor params.
	 */
	private function get_wp_editor_params() {
		$sidebar_layout = apply_filters( 'zerif_sidebar_layout', get_theme_mod( 'zerif_blog_sidebar_layout', 'sidebar-right' ) );
		$strings        = array(
			'sidebar' => __( 'Sidebar', 'zerif' ),
		);

		$has_header         = get_theme_mod( 'zerif_enable_blog_header', false );
		$full_width         = get_theme_mod( 'zerif_change_to_full_width' );
		$display_thumb_post = get_theme_mod( 'zerif_add_thumbnail_posts', false );
		$display_thumb_page = get_theme_mod( 'zerif_add_thumbnail_pages', false );
		$header_image       = get_background_image();
		$pid                = get_the_ID();
		$page_template      = get_page_template_slug( $pid );

		return array(
			'has_header'       => $has_header,
			'sidebar_position' => $sidebar_layout,
			'strings'          => $strings,
			'all_page_full'    => $full_width,
			'thumb_page'       => $display_thumb_page,
			'thumb_post'       => $display_thumb_post,
			'header_image'     => $header_image,
			'initial_template' => $page_template,
		);
	}

	/**
	 * Enqueue styles.
	 */
	private function enqueue_styles() {
		wp_enqueue_style( 'zelle-editor-style', ZERIF_PHP_INCLUDE_URI . '/compatibility/wordpress-editor/wp-editor-style.css', array(), ZERIF_VERSION );
		$this->add_editor_inline_style();
	}

	/**
	 * Add inline style for editor.
	 */
	private function add_editor_inline_style() {
		$style = '';

		$zerif_titles_color = get_theme_mod( 'zerif_titles_color', apply_filters( 'zerif_titles_color_filter', '#404040' ) );
		if ( ! empty( $zerif_titles_color ) ) {
			$style .= '
			body .editor-post-title__block .editor-post-title__input{
				color: ' . $zerif_titles_color . ';
			}
			';
		}
		$zerif_titles_bottomborder_color = get_theme_mod( 'zerif_titles_bottomborder_color', apply_filters( 'zerif_titles_bottomborder_color_filter', '#e96656' ) );
		if ( ! empty( $zerif_titles_bottomborder_color ) ) {
			$style .= '
			body .editor-post-title__block:after{
				background: ' . $zerif_titles_bottomborder_color . ';
			}
			';
		}
		$zerif_texts_color = get_theme_mod( 'zerif_texts_color', apply_filters( 'zerif_texts_color_filter', '#404040' ) );
		if ( ! empty( $zerif_texts_color ) ) {
			$style .= '
			.editor-writing-flow,
			.editor-writing-flow h1, 
			.editor-writing-flow h2, 
			.editor-writing-flow h3, 
			.editor-writing-flow h4, 
			.editor-writing-flow h5, 
			.editor-writing-flow h6{
				color: ' . $zerif_texts_color . ';
			}
			';
		}
		$zerif_links_color = get_theme_mod( 'zerif_links_color', apply_filters( 'zerif_links_color_filter', '#808080' ) );
		if ( ! empty( $zerif_links_color ) ) {
			$style .= '
			.wp-block-freeform.block-library-rich-text__tinymce a, 
			.editor-writing-flow a{
				color: ' . $zerif_links_color . ';
			}';
		}
		$zerif_links_color_hover = get_theme_mod( 'zerif_links_color_hover', apply_filters( 'zerif_links_color_hover_filter', '#e96656' ) );
		if ( ! empty( $zerif_links_color_hover ) ) {
			$style .= '
			.wp-block-freeform.block-library-rich-text__tinymce a:hover, 
			.editor-writing-flow a:hover{
				color: ' . $zerif_links_color_hover . ';
			}
			';
		}

		$background_image = get_background_image();
		if ( ! empty( $background_image ) ) {
			$style .= 'body.zelle-header-template .editor-writing-flow > div > div > div:not(.editor-block-list__layout):not(.zelle-editor-wrapper){
				background-image: url(' . $background_image . ');
				background-size: cover;
				background-repeat: no-repeat;
				background-position: initial;
                background-attachment: fixed;
			}';
		}
		wp_add_inline_style( 'zelle-editor-style', $style );
	}
}
