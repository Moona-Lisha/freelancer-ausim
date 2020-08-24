<?php
/**
 * The factory logic for creating features.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    zerif
 */

/**
 * The class responsible for instantiating new Hestia classes.
 *
 * @package    zerif
 * @author     Themeisle <friends@themeisle.com>
 */
class Zerif_Feature_Factory {
	/**
	 * The build method for creating a new Zerif class.
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param   string $feature_name The name of the feature to instantiate.
	 *
	 * @return  mixed
	 */
	public static function build( $feature_name, $path ) {

		if ( ! file_exists( $path ) ) {
			return null;
		}

		require_once $path;
		$feature_words = explode( '-', $feature_name );
		$feature_words = array_map( 'ucfirst', $feature_words );
		$feature_name  = implode( '_', $feature_words );
		$class         = 'Zerif_' . $feature_name;
		if ( class_exists( $class ) ) {
			return new $class;
		}

		return null;
	}
}
