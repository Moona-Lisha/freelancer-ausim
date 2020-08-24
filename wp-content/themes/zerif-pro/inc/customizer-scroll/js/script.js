/**
 * Script for the customizer auto scrolling.
 *
 * Sends the section name to the preview.
 *
 * @since    1.8.8.7
 * @package zerif
 *
 * @author    ThemeIsle
 */

/* global wp */

var zerif_customize_scroller = function ( $ ) {
	'use strict';

	$(
		function () {
			var customize = wp.customize;

			$( '#sub-accordion-panel-zerif_frontpage_sections > li, #sub-accordion-panel-zerif_colors > li' ).not('.customize-info').each(
				function () {
					$( this ).on(
						'click', function() {
							var section = $( this ).attr( 'aria-owns' );
							customize.previewer.send( 'clicked-customizer-section', section );
						}
					);
				}
			);
		}
	);
};
jQuery(document).ready( function () {
	zerif_customize_scroller( jQuery );
});
