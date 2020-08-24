/**
 * Script fort the customizer sections scroll function.
 *
 * @since    1.8.8.7
 * @package zerif
 *
 * @author    ThemeIsle
 */

/* global wp */

var zerif_customizer_section_scroll = function ( $ ) {
	'use strict';

	var panels = {
		'sub-accordion-section-sidebar-widgets-sidebar-big-title':'#home',
		'sub-accordion-section-zerif_bigtitle_colors_section':'#home',
		'sub-accordion-section-sidebar-widgets-sidebar-ourfocus':'#focus',
		'sub-accordion-section-zerif_ourfocus_colors_section':'#focus',
		'sub-accordion-section-zerif_portfolio_section':'#works',
		'sub-accordion-section-zerif_portofolio_colors_section':'#works',
		'sub-accordion-section-sidebar-widgets-sidebar-aboutus':'#aboutus',
		'sub-accordion-section-zerif_aboutus_colors_section':'#aboutus',
		'sub-accordion-section-sidebar-widgets-sidebar-ourteam':'#team',
		'sub-accordion-section-zerif_ourteam_colors_section':'#team',
		'sub-accordion-section-sidebar-widgets-sidebar-testimonials':'#testimonials',
		'sub-accordion-section-zerif_testimonials_colors_section':'#testimonials',
		'sub-accordion-section-zerif_ribbon_sections':'#ribbon_bottom',
		'sub-accordion-section-zerif_ribbons_colors':'#ribbon_bottom',
		'sub-accordion-section-zerif_shortcodes_section':'#shortcodes-section',
		'sub-accordion-section-zerif_contact_us_section':'#contact',
		'sub-accordion-section-zerif_contactus_colors_section':'#contact',
		'sub-accordion-section-sidebar-widgets-sidebar-packages':'#pricingtable',
		'sub-accordion-section-zerif_packages_colors_section':'#pricingtable',
		'sub-accordion-section-zerif_googlemap_section':'#map',
		'sub-accordion-section-zerif_latest_news_section':'#latestnews',
		'sub-accordion-section-zerif_latest_news_colors_section':'#latestnews',
		'sub-accordion-section-sidebar-widgets-sidebar-subscribe':'#subscribe',
		'sub-accordion-section-zerif_subscribe_color_section':'#subscribe'
	};

	$(
		function () {
				var customize = wp.customize;

				customize.preview.bind(
					'clicked-customizer-section', function( data ) {
						var sectionId = panels[data];

						if ( $( sectionId ).length > 0 && typeof panels[data] !== 'undefined' ) {
							$( 'html, body' ).animate(
								{
									scrollTop: $( sectionId ).offset().top - 100
								}, 1000
							);
						}
					}
				);
		}
	);
};
jQuery(document).ready( function () {
    zerif_customizer_section_scroll(jQuery);
});
