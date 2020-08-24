<?php
/**
 * The file that defines the core theme class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeisle.com
 * @package    Hestia
 * @subpackage Hestia/core
 */

/**
 * Require necessary files.
 */
require_once ZERIF_PHP_INCLUDE . 'core/class-zerif-feature-factory.php';
require_once ZERIF_PHP_INCLUDE . 'core/class-zerif-admin.php';

/**
 * The core theme class.
 *
 * This is used to define admin-specific hooks, and
 * public-facing site hooks.
 *
 * @package    Hestia
 * @author     Themeisle <friends@themeisle.com>
 */
class Zerif_Core {
	/**
	 * Features that will be loaded.
	 *
	 * @access   protected
	 * @var array $features_to_load Features that will be loaded.
	 */
	protected $features_to_load;
	/**
	 * Define the core functionality of the theme.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, addons, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @access public
	 */
	public function __construct() {
		$this->define_hooks();
		$this->define_features();
		$this->prepare_features();
	}

	/**
	 * Register all of the hooks related to the functionality
	 * of the theme setup.
	 *
	 * @access   private
	 */
	private function define_hooks() {
		$admin = new Zerif_Admin();
		add_filter( 'init', array( $admin, 'do_about_page' ) );
	}

	/**
	 * Define the features that will be loaded.
	 */
	private function define_features() {
		$this->features_to_load = apply_filters(
			'zerif_filter_main_features',
			array(
				'customizer-main'       => ZERIF_PHP_INCLUDE . 'customizer/class-zerif-customizer-main.php',
				'big-title-controls'    => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-big-title-controls.php',
				'our-focus-controls'    => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-our-focus-controls.php',
				'portfolio-controls'    => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-portfolio-controls.php',
				'about-us-controls'     => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-about-us-controls.php',
				'our-team-controls'     => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-our-team-controls.php',
				'testimonials-controls' => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-testimonials-controls.php',
				'ribbon-controls'       => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-ribbon-controls.php',
				'shortcodes-controls'   => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-shortcodes-controls.php',
				'contact-us-controls'   => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-contact-us-controls.php',
				'packages-controls'     => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-packages-controls.php',
				'map-controls'          => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-map-controls.php',
				'latest-news-controls'  => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-latest-news-controls.php',
				'subscribe-controls'    => ZERIF_PHP_INCLUDE . 'customizer/front-page/class-zerif-subscribe-controls.php',
				'shop-controls'         => ZERIF_PHP_INCLUDE . 'customizer/general/class-zerif-shop-controls.php',
				'blog-controls'         => ZERIF_PHP_INCLUDE . 'customizer/general/class-zerif-blog-controls.php',
				'wp-editor'             => ZERIF_PHP_INCLUDE . 'compatibility/wordpress-editor/class-zerif-wp-editor.php',
			)
		);
	}

	/**
	 * Check Features and register them.
	 *
	 * @access  private
	 */
	private function prepare_features() {
		$factory = new Zerif_Feature_Factory();
		foreach ( $this->features_to_load as $feature_name => $path ) {
			$feature = $factory::build( $feature_name, $path );
			if ( $feature !== null ) {
				$feature->init();
			}
		}
	}
}
