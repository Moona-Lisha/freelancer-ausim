<?php
/**
 * Elementor compatibility class.
 *
 * @package zerif
 */

/**
 * Class Elementor_Compatibility
 */
class Elementor_Compatibility {

	/**
	 * Match parameters of filter with theme location.
	 *
	 * @var array
	 */
	public $filters = array(
		'header'  => 'header',
		'footer'  => 'footer',
		'single'  => 'single',
		'404'     => 'single',
		'archive' => 'archive',
		'index'   => 'archive',
		'search'  => 'archive',

	);

	/**
	 * Elementor_Compatibility constructor.
	 */
	function __construct() {
		add_action( 'elementor/theme/register_locations', array( $this, 'register_theme_locations' ) );
		add_filter( 'zerif_display_area_filter', array( $this, 'elementor_display_location' ), 10, 2 );
	}

	/**
	 * Register Theme Location for Elementor
	 * see https://developers.elementor.com/theme-locations-api/
	 *
	 * @param object $elementor_theme_manager Elementor object.
	 */
	public function register_theme_locations( $elementor_theme_manager ) {
		$elementor_theme_manager->register_all_core_location();
	}

	/**
	 * Hook to display elementor theme location.
	 *
	 * @param bool   $display_or_not Hook value.
	 * @param string $zerif_page     Zerif page name where the filter is called.
	 */
	public function elementor_display_location( $display_or_not, $zerif_page ) {
		$elementor_location = $this->filters[ $zerif_page ];
		if ( empty( $elementor_location ) ) {
			return false;
		}
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( $this->filters[ $elementor_location ] ) ) {
			return true;
		}
		return false;
	}
}
new Elementor_Compatibility();
