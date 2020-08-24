/* global Color */
jQuery( document ).ready(
	function($) {

		Color.prototype.toString = function(remove_alpha) {
			if (remove_alpha === 'no-alpha') {
				return this.toCSS( 'rgba', '1' ).replace( /\s+/g, '' );
			}
			if (this._alpha < 1) {
				return this.toCSS( 'rgba', this._alpha ).replace( /\s+/g, '' );
			}
			var hex = parseInt( this._color, 10 ).toString( 16 );
			if (this.error) {
				return ''; }
			if (hex.length < 6) {
				for (var i = 6 - hex.length - 1; i >= 0; i--) {
					hex = '0' + hex;
				}
			}
			return '#' + hex;
		};

		$( '.pluto-color-control' ).each(
			function() {
				var $control = $( this ),
				value        = $control.val().replace( /\s+/g, '' ),
				palette;
				// Manage Palettes
				var palette_input = $control.attr( 'data-palette' );
				if (palette_input === 'false' || palette_input === false) {
					palette = false;
				} else if (palette_input === 'true' || palette_input === true) {
					palette = true;
				} else {
					palette = $control.attr( 'data-palette' ).split( ',' );
				}
				$control.wpColorPicker(
					{ // change some things with the color picker
						change: function(event, ui) {
							// send ajax request to wp.customizer to enable Save & Publish button
							var _new_value;
							if ( typeof ui.color !== 'undefined' ) {
								_new_value = ui.color.toString();
							} else {
								_new_value = $control.val();
							}
							var key = $control.attr( 'data-customize-setting-link' );
							wp.customize(
								key, function(obj) {
									obj.set( _new_value );
								}
							);
							// change the background color of our transparency container whenever a color is updated
							var $transparency = $control.parents( '.wp-picker-container:first' ).find( '.transparency' );
							// we only want to show the color at 100% alpha
							$transparency.css( 'backgroundColor', ui.color.toString( 'no-alpha' ) );
						},
						palettes: palette // remove the color palettes
					}
				);
				$( '<div class="pluto-alpha-container"><div class="slider-alpha"></div><div class="transparency"></div></div>' ).appendTo( $control.parents( '.wp-picker-container' ) );
				var $alpha_slider = $control.parents( '.wp-picker-container:first' ).find( '.slider-alpha' ),
				alpha_val;
				// if in format RGBA - grab A channel value
				if (value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ )) {
					alpha_val = parseFloat( value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ )[1] ) * 100;
					alpha_val = parseInt( alpha_val );
				} else {
					alpha_val = 100;
				}
				$alpha_slider.slider(
					{
						slide: function(event, ui) {
							$( this ).find( '.ui-slider-handle' ).text( ui.value ); // show value on slider handle
							// send ajax request to wp.customizer to enable Save & Publish button
							var _new_value = $control.val();
							var key        = $control.attr( 'data-customize-setting-link' );
							wp.customize(
								key, function(obj) {
									obj.set( _new_value );
								}
							);
						},
						create: function() {
							var v = $( this ).slider( 'value' );
							$( this ).find( '.ui-slider-handle' ).text( v );
						},
						value: alpha_val,
						range: 'max',
						step: 1,
						min: 1,
						max: 100
					}
				); // slider
				$alpha_slider.slider().on(
					'slidechange', function(event, ui) {
						var new_alpha_val  = parseFloat( ui.value ),
						iris               = $control.data( 'a8cIris' ),
						color_picker       = $control.data( 'wpWpColorPicker' );
						iris._color._alpha = new_alpha_val / 100.0;
						$control.val( iris._color.toString() );
						color_picker.toggler.css(
							{
								backgroundColor: $control.val()
							}
						);
						// fix relationship between alpha slider and the 'side slider not updating.
						var get_val = $control.val();
						$( $control ).wpColorPicker( 'color', get_val );
					}
				);
			}
		);

		/* Move Footer widgets in the footer panel */
		wp.customize.section( 'sidebar-widgets-zerif-sidebar-footer' ).panel( 'zerif_footer' );
		wp.customize.section( 'sidebar-widgets-zerif-sidebar-footer' ).priority( '20' );

		wp.customize.section( 'sidebar-widgets-zerif-sidebar-footer-2' ).panel( 'zerif_footer' );
		wp.customize.section( 'sidebar-widgets-zerif-sidebar-footer-2' ).priority( '30' );

		wp.customize.section( 'sidebar-widgets-zerif-sidebar-footer-3' ).panel( 'zerif_footer' );
		wp.customize.section( 'sidebar-widgets-zerif-sidebar-footer-3' ).priority( '40' );

		/* Tooltips for General Options */
		jQuery( '#customize-control-zerif_use_safe_font label' ).append( '<span class="dashicons dashicons-info zerif-moreinfo-icon"></span><div class="zerif-moreinfo-content">Zerif PRO main font is Montserrat, which only supports the Latin script. <br><br> If you are using other scripts like Cyrillic or Greek , you need to check this box to enable the safe fonts for better compatibility.</div>' );

		jQuery( '#customize-control-zerif_disable_smooth_scroll label' ).append( '<span class="dashicons dashicons-info zerif-moreinfo-icon"></span><div class="zerif-moreinfo-content">Smooth scrolling can be very useful if you read a lot of long pages. Normally, when you press Page Down, the view jumps directly down one page. <br><br>With smooth scrolling, it slides down smoothly, so you can see how much it scrolls. This makes it easier to resume reading from where you were before.<br><br>By checking this box, the smooth scroll will be disabled.</div>' );

		jQuery( '#customize-control-zerif_disable_preloader label' ).append( '<span class="dashicons dashicons-info zerif-moreinfo-icon"></span><div class="zerif-moreinfo-content">The preloader is the circular progress element that first appears on the site. When the loader finishes its progress animation, the whole page elements are revealed. <br><br>The preloader is used as a creative way to make waiting a bit less boring for the visitor.<br><br>By checking this box, the preloader will be disabled.</div>' );

		jQuery( '#customize-control-zerif_accessibility label' ).append( '<div class="dashicons dashicons-info zerif-moreinfo-icon"></div><div class="zerif-moreinfo-content">Web accessibility means that people with disabilities can use the Web. More specifically, Web accessibility means that people with disabilities can perceive, understand, navigate, and interact with the Web, and that they can contribute to the Web. <br><br>Web accessibility also benefits others, including older people with changing abilities due to aging.<br><br>By checking this box, you will enable this option on the site.</div>' );

		jQuery( '.zerif-moreinfo-icon' ).hover(
			function() {
				jQuery( this ).next( '.zerif-moreinfo-content' ).show();
			},function(){
				jQuery( this ).next( '.zerif-moreinfo-content' ).hide();
			}
		);

		function handleGridLayoutMasonryVisibility(  ) {
			var selector = jQuery('#_customize-input-zerif_blog_grid_layout');

			var toShow = ['2', '3', '4'];

			if( toShow.includes( selector.val() ) ) {
				jQuery('#customize-control-zerif_enable_masonry').show();
			} else {
				jQuery('#customize-control-zerif_enable_masonry').hide();
			}
		}

		jQuery( '#_customize-input-zerif_blog_grid_layout' ).on('change', handleGridLayoutMasonryVisibility );

		handleGridLayoutMasonryVisibility();
	}
);
