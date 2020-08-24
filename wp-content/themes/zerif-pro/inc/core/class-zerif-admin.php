<?php
/**
 * The admin class that handles all the dashboard integration.
 *
 * @package Zerif
 */
/**
 * Class Zerif_Admin
 */
class Zerif_Admin {
	/**
	 * Add the about page.
	 */
	public function do_about_page() {
		$config = array(
			'getting_started'     => array(
				'type'    => 'columns-3',
				'title'   => esc_html__( 'Getting Started', 'zerif' ),
				'content' => array(
					array(
						'title'  => esc_html__( 'Recommended actions', 'zerif' ),
						'text'   => esc_html__( 'We have compiled a list of steps for you to take so we can ensure that the experience you have using one of our products is very easy to follow.', 'zerif' ),
						'button' => array(
							'label'     => esc_html__( 'Recommended actions', 'zerif' ),
							'link'      => esc_url( '#recommended_actions' ),
							'is_button' => false,
							'blank'     => false,
						),
					),
					array(
						'title'  => esc_html__( 'Read full documentation', 'zerif' ),
						'text'   => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Zelle Pro.', 'zerif' ),
						'button' => array(
							'label'     => esc_html__( 'Documentation', 'zerif' ),
							'link'      => 'https://docs.themeisle.com/article/87-zerif-pro-documentation',
							'is_button' => false,
							'blank'     => true,
						),
					),
					array(
						'title'  => esc_html__( 'Go to the Customizer', 'zerif' ),
						'text'   => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'zerif' ),
						'button' => array(
							'label'     => esc_html__( 'Go to the Customizer', 'zerif' ),
							'link'      => esc_url( admin_url( 'customize.php' ) ),
							'is_button' => true,
							'blank'     => true,
						),
					),
				),
			),
			'recommended_actions' => array(
				'type'    => 'recommended_actions',
				'title'   => esc_html__( 'Recommended Actions', 'zerif' ),
				'plugins' => array(
					'wpforms-lite' => array(
						'name'        => 'WPForms',
						'slug'        => 'wpforms-lite',
						'description' => esc_html__( 'Makes your Contact section more engaging by creating a good-looking contact form. Interaction with your visitors has never been easier.', 'zerif' ),
					),
				),
			),
			'recommended_plugins' => array(
				'type'    => 'plugins',
				'title'   => esc_html__( 'Useful Plugins', 'zerif' ),
				'plugins' => array(
					'otter-blocks',
					'optimole-wp',
					'themeisle-companion',
					'beaver-builder-lite-version',
					'wp-product-review',
					'intergeo-maps',
					'visualizer',
					'adblock-notify-by-bweb',
					'nivo-slider-lite',
					'elementor',
					'wpforms-lite',
				),
			),
			'support'             => array(
				'type'    => 'columns-3',
				'title'   => esc_html__( 'Support', 'zerif' ),
				'content' => array(
					array(
						'icon'   => 'dashicons dashicons-sos',
						'title'  => esc_html__( 'Contact Support', 'zerif' ),
						'text'   => esc_html__( 'We want to make sure you have the best experience using Zelle Pro, and that is why we have gathered all the necessary information here for you. We hope you will enjoy using Zelle Pro as much as we enjoy creating great products.', 'zerif' ),
						'button' => array(
							'label'     => esc_html__( 'Contact Support', 'zerif' ),
							'link'      => esc_url( 'https://themeisle.com/contact/' ),
							'is_button' => true,
							'blank'     => true,
						),
					),
					array(
						'icon'   => 'dashicons dashicons-book-alt',
						'title'  => esc_html__( 'Documentation', 'zerif' ),
						'text'   => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Zelle Pro.', 'zerif' ),
						'button' => array(
							'label'     => esc_html__( 'Read full documentation', 'zerif' ),
							'link'      => 'https://docs.themeisle.com/article/87-zerif-pro-documentation',
							'is_button' => false,
							'blank'     => true,
						),
					),
					array(
						'icon'   => 'dashicons dashicons-portfolio',
						'title'  => esc_html__( 'Changelog', 'zerif' ),
						'text'   => esc_html__( 'Want to get the gist on the latest theme changes? Just consult our changelog below to get a taste of the recent fixes and features implemented.', 'zerif' ),
						'button' => array(
							'label'     => esc_html__( 'Changelog', 'zerif' ),
							'link'      => esc_url( '#changelog' ),
							'is_button' => false,
							'blank'     => false,
						),
					),
					array(
						'icon'   => 'dashicons dashicons-admin-customizer',
						'title'  => esc_html__( 'Create a child theme', 'zerif' ),
						'text'   => esc_html__( "If you want to make changes to the theme's files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.", 'zerif' ),
						'button' => array(
							'label'     => esc_html__( 'View how to do this', 'zerif' ),
							'link'      => 'https://docs.themeisle.com/article/14-how-to-create-a-child-theme',
							'is_button' => false,
							'blank'     => true,
						),
					),
					array(
						'icon'   => 'dashicons dashicons-controls-skipforward',
						'title'  => esc_html__( 'Speed up your site', 'zerif' ),
						'text'   => esc_html__( 'If you find yourself in a situation where everything on your site is running very slowly, you might consider having a look at the documentation below where you will find the most common issues causing this and possible solutions for each of the issues.', 'zerif' ),
						'button' => array(
							'label'     => esc_html__( 'View how to do this', 'zerif' ),
							'link'      => 'https://docs.themeisle.com/article/63-speed-up-your-wordpress-site',
							'is_button' => false,
							'blank'     => true,
						),
					),
					array(
						'icon'   => 'dashicons dashicons-images-alt2',
						'title'  => esc_html__( 'Build a landing page with a drag-and-drop content builder', 'zerif' ),
						'text'   => esc_html__( 'In the documentation below you will find an easy way to build a great looking landing page using a drag-and-drop content builder plugin.', 'zerif' ),
						'button' => array(
							'label'     => esc_html__( 'View how to do this', 'zerif' ),
							'link'      => 'https://docs.themeisle.com/article/219-how-to-build-a-landing-page-with-a-drag-and-drop-content-builder',
							'is_button' => false,
							'blank'     => true,
						),
					),
				),
			),
			'changelog'           => array(
				'type'  => 'changelog',
				'title' => esc_html__( 'Changelog', 'zerif' ),
			),
			'welcome_notice'      => array(
				'type'            => 'custom',
				'render_callback' => array( $this, 'zerif_admin_notice' ),
				'dismiss_option'  => 'zelle_notice_dismissed',
			),
		);
		if ( class_exists( 'TI_About_Page' ) ) {
			TI_About_Page::init( apply_filters( 'zerif_about_page_array', $config ) );
		}
	}


	/**
	 * Admin notice for Zelle.
	 */
	function zerif_admin_notice() {

		echo '<h2>' . esc_html__( 'Zerif PRO is now Zelle PRO', 'zerif' ) . '</h2>';
		echo '<p class="about-description">' . esc_html__( 'Meet the new, modern version of the theme you already use and love.', 'zerif' ) . '</p>';
		echo '<hr>';

		echo '<div class="zelle-panel-column-container">';

		echo '<div class="zelle-panel-column zelle-image-col" style="padding-right: 30px">';
		echo '<img src="' . get_template_directory_uri() . '/screenshot.png" alt="Screenshot" style="max-width: 100%;"/>';
		echo '</div>';

		echo '<div class="zelle-panel-column" style="padding-right: 30px">';
		echo '<h2>' . esc_html__( 'Meet Zelle PRO', 'zerif' ) . '</h2>';
		echo '<p>' . esc_html__( 'We\'re committed to providing you the best WordPress experience through our themes and plugins. Zerif has always been our flagship theme and we know how much you love it. That\'s why we decided it was time for a makeover. You\'ve asked, we listened.', 'zerif' ) . '</p>';
		echo '<p>' . esc_html__( 'Zelle PRO is the new, better version of Zerif PRO. Same theme, new name, better code, and some great, highly requested new features:', 'zerif' ) . '</p>';
		echo '<ul>';
		echo '<li>' . esc_html__( 'Very Top Bar section', 'zerif' ) . '</li>';
		echo '<li>' . esc_html__( 'Newly added layout options for the Blog page', 'zerif' ) . '</li>';
		echo '<li>' . esc_html__( 'Introduced layout options for the Shop page, including a new Sidebar', 'zerif' ) . '</li>';
		echo '<li>' . esc_html__( 'Video/Gallery in the Big Title section', 'zerif' ) . '</li>';
		echo '<li>' . esc_html__( 'Introduced flexible customization for the Big Title section\'s layout', 'zerif' ) . '</li>';
		echo '<li>' . esc_html__( 'Compatibility with WPForms', 'zerif' ) . '</li>';
		echo '</ul>';
		echo '<a class="button button-primary button-hero" href="' . esc_url( admin_url( 'themes.php?page=zerif-pro-welcome&tab=getting_started' ) ) . '">';
		echo esc_html__( 'Get started with Zelle PRO', 'zerif' );
		echo '</a>';
		echo '</div>';

		echo '</div>';

	}
}
