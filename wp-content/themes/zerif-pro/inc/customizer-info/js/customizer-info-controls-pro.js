/**
 * JS File for Jetpack notification in customizer
 *
 * @package zerif
 */
( function( api ) {

	// Extends our custom "zerif_info_jetpack" section.
	api.sectionConstructor.zerif_info_jetpack = api.Section.extend(
		{

				// No events for this type of section.
			attachEvents: function () {},

				// Always make the section active.
			isContextuallyActive: function () {
				return true;
			}
		}
	);

} )( wp.customize );
