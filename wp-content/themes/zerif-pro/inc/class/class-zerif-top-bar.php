<?php
/**
 * Top Bar
 *
 * @package Zerif
 */

/**
 * Class Zerif_Top_Bar
 */
class Zerif_Top_Bar {
	/**
	 * Add hooks for the front end.
	 */
	public function init() {
		add_action( 'zerif_top_body', array( $this, 'top_bar_content' ), 8 );
		add_action( 'wp_enqueue_scripts', array( $this, 'top_bar_style' ) );
	}

	/**
	 * The top bar markup.
	 */
	public function top_bar_content() {
		$top_bar_is_hidden = get_theme_mod( 'zerif_top_bar_hide', false );

		if ( (bool) $top_bar_is_hidden !== true ) {
			return;
		}
		$top_bar_class = $this->get_top_bar_wrapper_class();
		echo '<div class="' . esc_attr( $top_bar_class ) . '">';
		$this->header_top_bar();
		echo '</div>';
	}

	/**
	 * Get top bar wrapper classes.
	 */
	private function get_top_bar_wrapper_class() {
		$top_bar_class   = array( 'zerif-top-bar' );
		$has_placeholder = $this->top_bar_has_placeholder();

		if ( $has_placeholder ) {
			array_push( $top_bar_class, 'placeholder' );
		}

		return implode( ' ', $top_bar_class );
	}

	/**
	 * Check if placeholder should be visible.
	 *
	 * @return bool
	 */
	private function top_bar_has_placeholder() {
		return is_customize_preview() && current_user_can( 'edit_theme_options' ) && ! has_nav_menu( 'top-bar-menu' ) && ! is_active_sidebar( 'sidebar-top-bar' );
	}

	/**
	 * Function to display header top bar.
	 *
	 * @since  1.8.11
	 *
	 * @access public
	 */
	public function header_top_bar() {
		?>
		<div class="container">
			<div class="row">
				<?php

				$zerif_top_text = get_theme_mod( 'zerif_top_text' );

				if ( ! empty( $zerif_top_text ) ) {
					?>
					<div class="<?php echo esc_attr( $this->top_bar_sidebar_class( $zerif_top_text ) ); ?>">
						<?php echo do_shortcode( $zerif_top_text ); ?>
					</div>
					<?php
				}
				?>
				<div class="<?php echo esc_attr( $this->top_bar_menu_class( $zerif_top_text ) ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'top-bar-menu',
							'depth'          => 1,
							'container'      => 'div',
							'container_id'   => 'top-bar-navigation',
							'menu_class'     => 'nav top-bar-nav',
							'fallback_cb'    => false,
						)
					);
					?>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
		<?php
	}

	/**
	 * Get the top bar sidebar class.
	 *
	 * @return string top bar sidebar class.
	 */
	private function top_bar_sidebar_class( $content ) {
		$top_bar_alignment = get_theme_mod( 'zerif_top_bar_alignment', apply_filters( 'zerif_top_bar_alignment_default', 'right' ) );
		$sidebar_class     = 'pull-left';
		if ( ! empty( $top_bar_alignment ) && $top_bar_alignment === 'left' ) {
			$sidebar_class = 'pull-right';
		}
		$sidebar_class .= ' col-md-6';
		if ( empty( $content ) && ! current_user_can( 'edit_theme_options' ) ) {
			$sidebar_class .= ' col-md-12';
		}

		return $sidebar_class;
	}

	/**
	 * Get the top bar menu class.
	 *
	 * @return string top bar menu class.
	 */
	private function top_bar_menu_class( $content ) {
		$top_bar_alignment = get_theme_mod( 'zerif_top_bar_alignment', apply_filters( 'zerif_top_bar_alignment_default', 'right' ) );
		$menu_class        = 'pull-right';
		if ( ! empty( $top_bar_alignment ) && $top_bar_alignment === 'left' ) {
			$menu_class = 'pull-left';
		}
		if ( ! empty( $content ) || $this->top_bar_has_placeholder() ) {
			$menu_class .= ' col-md-6 top-widgets-placeholder';
		} else {
			$menu_class .= ' col-md-12';
		}

		return $menu_class;
	}

	/**
	 * Get top bar style from customizer controls.
	 *
	 * @since 1.8.11
	 */
	private function top_bar_css() {
		$custom_css = '';

		$zerif_top_bar_background = get_theme_mod( 'zerif_top_bar_background_color', '#363537' );
		if ( ! empty( $zerif_top_bar_background ) ) {
			$custom_css .= '.zerif-top-bar, .zerif-top-bar .widget.widget_shopping_cart .cart_list {
			background-color: ' . esc_html( $zerif_top_bar_background ) . '
		}
		.zerif-top-bar .widget .label-floating input[type=search]:-webkit-autofill {
			-webkit-box-shadow: inset 0 0 0px 9999px ' . esc_html( $zerif_top_bar_background ) . '
		}';
		}

		$zerif_top_bar_text_color = get_theme_mod( 'zerif_top_bar_text_color', '#ffffff' );
		if ( ! empty( $zerif_top_bar_background ) ) {
			$custom_css .= '.zerif-top-bar, .zerif-top-bar .widget .label-floating input[type=search], .zerif-top-bar .widget.widget_search form.form-group:before, .zerif-top-bar .widget.widget_product_search form.form-group:before, .zerif-top-bar .widget.widget_shopping_cart:before {
			color: ' . esc_html( $zerif_top_bar_text_color ) . '
		} 
		.zerif-top-bar .widget .label-floating input[type=search]{
			-webkit-text-fill-color:' . esc_html( $zerif_top_bar_text_color ) . ' !important 
		}';
		}

		$zerif_top_bar_link_color = get_theme_mod( 'zerif_top_bar_link_color', '#ffffff' );
		if ( ! empty( $zerif_top_bar_link_color ) ) {
			$custom_css .= '.zerif-top-bar a, .zerif-top-bar .top-bar-nav li a {
			color: ' . esc_html( $zerif_top_bar_link_color ) . '
		}';
		}

		$zerif_top_bar_link_color_hover = get_theme_mod( 'zerif_top_bar_link_color_hover', '#eeeeee' );
		if ( ! empty( $zerif_top_bar_link_color_hover ) ) {
			$custom_css .= '.zerif-top-bar a:hover, .zerif-top-bar .top-bar-nav li a:hover {
			color: ' . esc_html( $zerif_top_bar_link_color_hover ) . '
		}';
		}

		return $custom_css;
	}

	/**
	 * Add top bar style.
	 */
	public function top_bar_style() {
		wp_add_inline_style( 'zerif_style', $this->top_bar_css() );
	}
}
