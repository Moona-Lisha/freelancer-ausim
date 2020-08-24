/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	// Site title and description.
	wp.customize(
		'blogname', function( value ) {
			value.bind(
				function( to ) {
					$( '.site-title a' ).text( to );
				}
			);
		}
	);
	wp.customize(
		'blogdescription', function( value ) {
			value.bind(
				function( to ) {
					$( '.site-description' ).text( to );
				}
			);
		}
	);

	/*****************************************************/
	/**************	BIG TITLE SECTION *******************/
	/****************************************************/

	/* zerif_bigtitle_show */
	wp.customize(
		'zerif_bigtitle_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== true ) {
						$( '.header-content-wrap' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '.header-content-wrap' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
				}
			);
		}
	);

	/* zerif_bigtitle_title */
	wp.customize(
		'zerif_bigtitle_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '.big-title-container h1.intro-text' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '.big-title-container h1.intro-text' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '.big-title-container h1.intro-text' ).html( to );
				}
			);
		}
	);

	/* zerif_bigtitle_redbutton_label */
	wp.customize(
		'zerif_bigtitle_redbutton_label', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '.big-title-container .buttons .red-btn' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '.big-title-container .buttons .red-btn' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					var accesibility = wp.customize._value.zerif_accessibility();
					if ( accesibility === true ) {
						$( '.big-title-container .buttons .red-btn' ).html( '<span class="screen-reader-text">' + to + '</span>' + to );
					} else {
						$( '.big-title-container .buttons .red-btn' ).html( to );
					}

				}
			);
		}
	);

	/* zerif_bigtitle_redbutton_url */
	wp.customize(
		'zerif_bigtitle_redbutton_url', function( value ) {
			value.bind(
				function( to ) {
					var accesibility = wp.customize._value.zerif_accessibility();
					if ( accesibility === true ) {
						$( '.big-title-container .buttons .red-btn' ).attr( 'onclick', 'window.location=\'' + to + '\';' );
					} else {
						$( '.big-title-container .buttons .red-btn' ).attr( 'href', to );
					}
				}
			);
		}
	);

	/* zerif_bigtitle_greenbutton_label */
	wp.customize(
		'zerif_bigtitle_greenbutton_label', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '.big-title-container .buttons .green-btn' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '.big-title-container .buttons .green-btn' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					var accesibility = wp.customize._value.zerif_accessibility();
					if ( accesibility === true ) {
						$( '.big-title-container .buttons .green-btn' ).html( '<span class="screen-reader-text">' + to + '</span>' + to );
					} else {
						$( '.big-title-container .buttons .green-btn' ).html( to );
					}
				}
			);
		}
	);

	/* zerif_bigtitle_greenbutton_url */
	wp.customize(
		'zerif_bigtitle_greenbutton_url', function( value ) {
			value.bind(
				function( to ) {
					var accesibility = wp.customize._value.zerif_accessibility();
					if ( accesibility === true ) {
						$( '.big-title-container .buttons .green-btn' ).attr( 'onclick', 'window.location=\'' + to + '\';' );
					} else {
						$( '.big-title-container .buttons .green-btn' ).attr( 'href', to );
					}
				}
			);
		}
	);

	/* zerif_bigtitle_background */
	wp.customize(
		'zerif_bigtitle_background', function( value ) {
			value.bind(
				function( to ) {
					$( '.header-content-wrap' ).css( { 'background': to } );
				}
			);
		}
	);

	/* zerif_bigtitle_header_color */
	wp.customize(
		'zerif_bigtitle_header_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.intro-text' ).css( { 'color': to } );
				}
			);
		}
	);

	/* zerif_bigtitle_1button_background_color */
	wp.customize(
		'zerif_bigtitle_1button_background_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.big-title-container .buttons .red-btn' ).css( { 'background': to } );
				}
			);
		}
	);

	/* zerif_bigtitle_1button_color */
	wp.customize(
		'zerif_bigtitle_1button_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.big-title-container .buttons .red-btn' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_bigtitle_2button_background_color */
	wp.customize(
		'zerif_bigtitle_2button_background_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.big-title-container .buttons .green-btn' ).css( { 'background': to } );
				}
			);
		}
	);

	/* zerif_bigtitle_2button_color */
	wp.customize(
		'zerif_bigtitle_2button_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.big-title-container .buttons .green-btn' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/********************************************************************/
	/*************  OUR FOCUS SECTION **********************************/
	/********************************************************************/

	/* zerif_ourfocus_show */
	wp.customize(
		'zerif_ourfocus_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== true ) {
						$( 'section.focus' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.focus' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
				}
			);
		}
	);

	/* title */
	wp.customize(
		'zerif_ourfocus_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#focus .section-header h2' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#focus .section-header h2' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#focus .section-header h2' ).html( to );
				}
			);
		}
	);

	/* subtitle */
	wp.customize(
		'zerif_ourfocus_subtitle', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#focus .section-header h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#focus .section-header h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#focus .section-header h6' ).html( to );
				}
			);
		}
	);

	/* colors */
	wp.customize(
		'zerif_ourfocus_background', function( value ) {
			value.bind(
				function( to ) {
					$( '.focus' ).css( { 'background': to } );
				}
			);
		}
	);
	wp.customize(
		'zerif_ourfocus_header', function( value ) {
			value.bind(
				function( to ) {
					$( '.focus .section-header h2, .focus .section-header h6' ).css( { 'color': to } );
				}
			);
		}
	);
	wp.customize(
		'zerif_ourfocus_box_title_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.focus .focus-box h5' ).css( { 'color': to } );
				}
			);
		}
	);
	wp.customize(
		'zerif_ourfocus_box_text_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.focus .focus-box p' ).css( { 'color': to } );
				}
			);
		}
	);

	/************************************/
	/******** PORTFOLIO SECTION ********/
	/***********************************/

	/* zerif_portofolio_show */
	wp.customize(
		'zerif_portofolio_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== true ) {
						$( 'section.works' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.works' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
				}
			);
		}
	);

	/* title */
	wp.customize(
		'zerif_portofolio_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#works .section-header h2' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#works .section-header h2' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#works .section-header h2' ).html( to );
				}
			);
		}
	);

	/* subtitle */
	wp.customize(
		'zerif_portofolio_subtitle', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#works .section-header h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#works .section-header h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#works .section-header h6' ).html( to );
				}
			);
		}
	);

	/* colors */
	wp.customize(
		'zerif_portofolio_background', function( value ) {
			value.bind(
				function( to ) {
					$( '.works' ).css( { 'background': to } );
				}
			);
		}
	);

	wp.customize(
		'zerif_portofolio_header', function( value ) {
			value.bind(
				function( to ) {
					$( '.works .section-header h2, .works .section-header h6' ).css( { 'color': to } );
				}
			);
		}
	);
	wp.customize(
		'zerif_portofolio_text', function( value ) {
			value.bind(
				function( to ) {
					$( '.works .white-text' ).css( { 'color': to } );
				}
			);
		}
	);

	/************************************/
	/******* ABOUT US SECTION ***********/
	/************************************/

	/* show/hide */
	wp.customize(
		'zerif_aboutus_show', function( value ) {
			value.bind(
				function( to ) {

					if ( to !== true ) {
						$( 'section.about-us' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.about-us' ).addClass( 'zerif_hidden_if_not_customizer' );
					}

				}
			);
		}
	);
	/* title */
	wp.customize(
		'zerif_aboutus_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .section-header h2' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .section-header h2' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .section-header h2' ).html( to );
				}
			);
		}
	);

	/* subtitle */
	wp.customize(
		'zerif_aboutus_subtitle', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .section-header h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .section-header h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .section-header h6' ).html( to );
				}
			);
		}
	);

	/* feature 1 */
	wp.customize(
		'zerif_aboutus_feature1_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .skill_1 h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .skill_1 h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .skill_1 h6' ).html( to );
				}
			);
		}
	);
	wp.customize(
		'zerif_aboutus_feature1_text', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .skill_1 p' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .skill_1 p' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .skill_1 p' ).html( to );
				}
			);
		}
	);

	/* feature 2 */
	wp.customize(
		'zerif_aboutus_feature2_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .skill_2 h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .skill_2 h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .skill_2 h6' ).html( to );
				}
			);
		}
	);
	wp.customize(
		'zerif_aboutus_feature2_text', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .skill_2 p' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .skill_2 p' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .skill_2 p' ).html( to );
				}
			);
		}
	);

	/* feature 3 */
	wp.customize(
		'zerif_aboutus_feature3_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .skill_3 h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .skill_3 h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .skill_3 h6' ).html( to );
				}
			);
		}
	);
	wp.customize(
		'zerif_aboutus_feature3_text', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .skill_3 p' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .skill_3 p' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .skill_3 p' ).html( to );
				}
			);
		}
	);

	/* feature 4 */
	wp.customize(
		'zerif_aboutus_feature4_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .skill_4 h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .skill_4 h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .skill_4 h6' ).html( to );
				}
			);
		}
	);
	wp.customize(
		'zerif_aboutus_feature4_text', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#aboutus .skill_4 p' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#aboutus .skill_4 p' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#aboutus .skill_4 p' ).html( to );
				}
			);
		}
	);
	/* colors */
	wp.customize(
		'zerif_aboutus_background', function( value ) {
			value.bind(
				function( to ) {
					$( '#aboutus' ).css( { 'background': to } );
				}
			);
		}
	);

	wp.customize(
		'zerif_aboutus_title_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.about-us p, .about-us, .about-us h2, .about-us h6' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	wp.customize(
		'zerif_aboutus_clients_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.about-us .our-clients .section-footer-title' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	wp.customize(
		'zerif_aboutus_clients_title_text', function( value ) {
			value.bind(
				function( to ) {
					$( '.our-clients .section-footer-title' ).html( to );
				}
			);
		}
	);

	/******************************************/
	/**********	OUR TEAM SECTION **************/
	/******************************************/

	/* show/hide */
	wp.customize(
		'zerif_ourteam_show', function( value ) {
			value.bind(
				function( to ) {

					if ( to !== true ) {
						$( 'section.our-team' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.our-team' ).addClass( 'zerif_hidden_if_not_customizer' );
					}

				}
			);
		}
	);
	/* title */
	wp.customize(
		'zerif_ourteam_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#team .section-header h2' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#team .section-header h2' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#team .section-header h2' ).html( to );
				}
			);
		}
	);

	/* subtitle */
	wp.customize(
		'zerif_ourteam_subtitle', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#team .section-header h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#team .section-header h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#team .section-header h6' ).html( to );
				}
			);
		}
	);

	/* colors */
	wp.customize(
		'zerif_ourteam_background', function( value ) {
			value.bind(
				function( to ) {
					$( '#team' ).css( { 'background': to } );
				}
			);
		}
	);

	wp.customize(
		'zerif_ourteam_header', function( value ) {
			value.bind(
				function( to ) {
					$( '#team .section-header h2, #team .section-header h6, #team .member-details h5, #team .member-details h5 a, #team .member-details div.position' ).css( { 'color': to } );
				}
			);
		}
	);

	wp.customize(
		'zerif_ourteam_text', function( value ) {
			value.bind(
				function( to ) {
					$( '.team-member .details' ).css( { 'color': to } );
				}
			);
		}
	);

	wp.customize(
		'zerif_ourteam_socials', function( value ) {
			value.bind(
				function( to ) {
					$( '.team-member .social-icons li a' ).css( { 'color': to } );
				}
			);
		}
	);

	/**********************************************/
	/**********	TESTIMONIALS SECTION **************/
	/**********************************************/
	/* show/hide */
	wp.customize(
		'zerif_testimonials_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== true ) {
						$( 'section.testimonial' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.testimonial' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
				}
			);
		}
	);
	/* title */
	wp.customize(
		'zerif_testimonials_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#testimonials .section-header h2' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#testimonials .section-header h2' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#testimonials .section-header h2' ).html( to );
				}
			);
		}
	);
	/* subtitle */
	wp.customize(
		'zerif_testimonials_subtitle', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#testimonials .section-header h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#testimonials .section-header h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#testimonials .section-header h6' ).html( to );
				}
			);
		}
	);
	/* colors */
	wp.customize(
		'zerif_testimonials_background', function( value ) {
			value.bind(
				function( to ) {
					var background_color = 'background:' + to + '!important';
					$( '.testimonial' ).css( 'cssText', background_color );
				}
			);
		}
	);
	wp.customize(
		'zerif_testimonials_header', function( value ) {
			value.bind(
				function( to ) {
					$( '.testimonial .section-header h2, .testimonial .section-header h6' ).css( { 'color': to } );
				}
			);
		}
	);
	wp.customize(
		'zerif_testimonials_text', function( value ) {
			value.bind(
				function( to ) {
					$( '.testimonial .message' ).css( { 'color': to } );
				}
			);
		}
	);
	wp.customize(
		'zerif_testimonials_author', function( value ) {
			value.bind(
				function( to ) {
					$( '.testimonial .client .client-name' ).css( { 'color': to } );
				}
			);
		}
	);
	wp.customize(
		'zerif_testimonials_quote', function( value ) {
			value.bind(
				function( to ) {
					$( '.testimonial .client .fa-quote-left' ).css( { 'color': to } );
				}
			);
		}
	);
	wp.customize(
		'zerif_testimonials_box_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.testimonial .feedback-box' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);
	/***********************************************************/
	/********* SHORTCODES *************************************/
	/**********************************************************/
	wp.customize(
		'zerif_shortcodes_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== true ) {
						$( '.zerif_shortcodes' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '.zerif_shortcodes' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
				}
			);
		}
	);

	/***********************************************************/
	/********* RIBBONS ****************************************/
	/**********************************************************/

	/* zerif_bottomribbon_text */
	wp.customize(
		'zerif_bottomribbon_text', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#ribbon_bottom' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#ribbon_bottom' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#ribbon_bottom h3' ).html( to );
				}
			);
		}
	);

	/* zerif_bottomribbon_buttonlabel */
	wp.customize(
		'zerif_bottomribbon_buttonlabel', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#ribbon_bottom .green-btn' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#ribbon_bottom .green-btn' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					var accesibility = wp.customize._value.zerif_accessibility();
					if ( accesibility === true ) {
						$( '#ribbon_bottom .green-btn' ).html( '<span class="screen-reader-text">' + to + '</span>' + to );
					} else {
						$( '#ribbon_bottom .green-btn' ).html( to );
					}
				}
			);
		}
	);

	/* zerif_bottomribbon_buttonlink */
	wp.customize(
		'zerif_bottomribbon_buttonlink', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#ribbon_bottom .green-btn' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#ribbon_bottom .green-btn' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					var accesibility = wp.customize._value.zerif_accessibility();
					if ( accesibility === true ) {
						$( '#ribbon_bottom .green-btn' ).attr( 'onclick', 'window.location=\'' + to + '\';' );
					} else {
						$( '#ribbon_bottom .green-btn' ).attr( 'href', to );
					}
				}
			);
		}
	);

	/* zerif_ribbon_background */
	wp.customize(
		'zerif_ribbon_background', function( value ) {
			value.bind(
				function( to ) {
					$( '#ribbon_bottom' ).css( { 'background': to } );
				}
			);
		}
	);

	/* zerif_ribbon_text_color */
	wp.customize(
		'zerif_ribbon_text_color', function( value ) {
			value.bind(
				function( to ) {
					$( '#ribbon_bottom h3.html' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_ribbon_button_background */
	wp.customize(
		'zerif_ribbon_button_background', function( value ) {
			value.bind(
				function( to ) {
					$( '#ribbon_bottom a.green-btn' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_ribbon_button_button_color */
	wp.customize(
		'zerif_ribbon_button_button_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.separator-one#ribbon_bottom .green-btn' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_ribbonright_text */
	wp.customize(
		'zerif_ribbonright_text', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#ribbon_right' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#ribbon_right' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '#ribbon_right h3' ).html( to );
				}
			);
		}
	);

	/* zerif_ribbonright_buttonlabel */
	wp.customize(
		'zerif_ribbonright_buttonlabel', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#ribbon_right .red-btn' ).removeClass( 'zerif_ribbon_btn_label_blank' );
						if ( ! $( '#ribbon_right .red-btn' ).hasClass( 'zerif_ribbon_btn_label_blank' ) && ! $( '#ribbon_right a.red-btn' ).hasClass( 'zerif_ribbon_btn_link_blank' )  ) {
							$( '#ribbon_right .red-btn' ).removeClass( 'zerif_hidden_if_not_customizer' );
							$( '#ribbon_right' ).removeClass( 'ribbon-without-button' );
						}
					} else {
						$( '#ribbon_right .red-btn' ).addClass( 'zerif_hidden_if_not_customizer' );
						$( '#ribbon_right .red-btn' ).addClass( 'zerif_ribbon_btn_label_blank' );
						$( '#ribbon_right' ).addClass( 'ribbon-without-button' );
					}

					var accesibility = wp.customize._value.zerif_accessibility();
					if ( accesibility === true ) {
						$( '#ribbon_right .red-btn' ).html( '<span class="screen-reader-text">' + to + '</span>' + to );
					} else {
						$( '#ribbon_right .red-btn' ).html( to );
					}

				}
			);
		}
	);

	/* zerif_ribbonright_buttonlink */
	wp.customize(
		'zerif_ribbonright_buttonlink', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#ribbon_right .red-btn' ).removeClass( 'zerif_ribbon_btn_link_blank' );
						if ( ! $( '#ribbon_right .red-btn' ).hasClass( 'zerif_ribbon_btn_label_blank' ) && ! $( '#ribbon_right a.red-btn' ).hasClass( 'zerif_ribbon_btn_link_blank' ) ) {
							$( '#ribbon_right .red-btn' ).removeClass( 'zerif_hidden_if_not_customizer' );
							$( '#ribbon_right' ).removeClass( 'ribbon-without-button' );
						}
					} else {
						$( '#ribbon_right .red-btn' ).addClass( 'zerif_hidden_if_not_customizer' );
						$( '#ribbon_right .red-btn' ).addClass( 'zerif_ribbon_btn_link_blank' );
						$( '#ribbon_right' ).addClass( 'ribbon-without-button' );
					}

					var accesibility = wp.customize._value.zerif_accessibility();
					if ( accesibility === true ) {
						$( '#ribbon_right .red-btn' ).attr( 'onclick', 'window.location=\'' + to + '\';' );
					} else {
						$( '#ribbon_right .red-btn' ).attr( 'href', to );
					}

				}
			);
		}
	);

	/* zerif_ribbonright_background */
	wp.customize(
		'zerif_ribbonright_background', function( value ) {
			value.bind(
				function( to ) {
					$( '#ribbon_right' ).css( { 'background': to } );
				}
			);
		}
	);

	/* zerif_ribbonright_text_color */
	wp.customize(
		'zerif_ribbonright_text_color', function( value ) {
			value.bind(
				function( to ) {
					$( '#ribbon_right h3.white-text' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_ribbonright_button_background */
	wp.customize(
		'zerif_ribbonright_button_background', function( value ) {
			value.bind(
				function( to ) {
					$( '#ribbon_right a.red-btn' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_ribbonright_button_button_color */
	wp.customize(
		'zerif_ribbonright_button_button_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.purchase-now .red-btn' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/*******************************************************/
	/************	CONTACT US SECTION *********************/
	/*******************************************************/

	/* show/hide */
	wp.customize(
		'zerif_contactus_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== true ) {
						$( 'section#contact' ).css(
							{
								'display': 'block'
							}
						);
					} else {
						$( 'section#contact' ).css(
							{
								'display': 'none'
							}
						);
					}
				}
			);
		}
	);
	/* title */
	wp.customize(
		'zerif_contactus_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section#contact .section-header h2' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section#contact .section-header h2' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'section#contact .section-header h2' ).html( to );
				}
			);
		}
	);

	/* subtitle */
	wp.customize(
		'zerif_contactus_subtitle', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section#contact .section-header h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section#contact .section-header h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'section#contact .section-header h6' ).html( to );
				}
			);
		}
	);

	/* zerif_contactus_name_placeholder */
	wp.customize(
		'zerif_contactus_name_placeholder', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#contact form input[name="myname"]' ).attr( 'placeholder', to );
				}
			);
		}
	);

	/* zerif_contactus_email_placeholder */
	wp.customize(
		'zerif_contactus_email_placeholder', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#contact form input[name="myemail"]' ).attr( 'placeholder', to );
				}
			);
		}
	);

	/* zerif_contactus_subject_placeholder */
	wp.customize(
		'zerif_contactus_subject_placeholder', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#contact form input[name="mysubject"]' ).attr( 'placeholder', to );
				}
			);
		}
	);

	/* zerif_contactus_message_placeholder */
	wp.customize(
		'zerif_contactus_message_placeholder', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#contact form textarea[name="mymessage"]' ).attr( 'placeholder', to );
				}
			);
		}
	);

	/* zerif_contactus_button_label */
	wp.customize(
		'zerif_contactus_button_label', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section#contact form button' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section#contact form button' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'section#contact form button' ).html( to );
				}
			);
		}
	);

	/* zerif_contacus_background */
	wp.customize(
		'zerif_contacus_background', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#contact' ).css( { 'background': to } );
				}
			);
		}
	);

	/* zerif_contacus_header */
	wp.customize(
		'zerif_contacus_header', function( value ) {
			value.bind(
				function( to ) {
					$( 'form.wpcf7-form p label, form.wpcf7-form .wpcf7-list-item-label, section#contact h2, section#contact h6' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_contacus_button_background */
	wp.customize(
		'zerif_contacus_button_background', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#contact button' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_contacus_button_color */
	wp.customize(
		'zerif_contacus_button_color', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#contact button' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/*******************************************************/
	/************	PACKAGES SECTION ***********************/
	/*******************************************************/

	/* show/hide */
	wp.customize(
		'zerif_packages_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section.packages' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.packages' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
				}
			);
		}
	);
	/* title */
	wp.customize(
		'zerif_packages_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section.packages .section-header h2' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.packages .section-header h2' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'section.packages .section-header h2' ).html( to );
				}
			);
		}
	);

	/* subtitle */
	wp.customize(
		'zerif_packages_subtitle', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section.packages .section-header h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.packages .section-header h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'section.packages .section-header h6' ).html( to );
				}
			);
		}
	);

	/* zerif_packages_header */
	wp.customize(
		'zerif_packages_header', function( value ) {
			value.bind(
				function( to ) {
					$( 'section.packages .section-header h6, section.packages .section-header h2' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_packages_background */
	wp.customize(
		'zerif_packages_background', function( value ) {
			value.bind(
				function( to ) {
					$( 'section.packages' ).css( { 'background': to } );
				}
			);
		}
	);

	/* zerif_package_title_color */
	wp.customize(
		'zerif_package_title_color', function( value ) {
			value.bind(
				function( to ) {
					$( 'section.packages .package-header h5,section.packages .package-header .meta-text, section.packages .package-header h4' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_package_text_color */
	wp.customize(
		'zerif_package_text_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.packages .package ul li, .packages .price .price-meta' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_package_button_text_color */
	wp.customize(
		'zerif_package_button_text_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.packages .package .custom-button' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_package_price_background_color */
	wp.customize(
		'zerif_package_price_background_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.packages .dark-bg' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_package_price_color */
	wp.customize(
		'zerif_package_price_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.packages .price h4' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/*******************************************************/
	/************	GOOGLE MAP SECTION *********************/
	/*******************************************************/

	/* show/hide */
	wp.customize(
		'zerif_googlemap_show', function( value ) {
			value.bind(
				function( to ) {

					if ( to !== true ) {
						$( '#map' ).css(
							{
								'display': 'none'
							}
						);
					} else {
						$( '#map' ).css(
							{
								'display': 'block'
							}
						);
					}
				}
			);
		}
	);

	/********************************************************/
	/************	LATEST NEWS SECTION *********************/
	/********************************************************/

	/* zerif_latest_news_show */
	wp.customize(
		'zerif_latest_news_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== true ) {
						$( 'section.latest-news' ).addClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.latest-news' ).removeClass( 'zerif_hidden_if_not_customizer' );
					}
				}
			);
		}
	);

	/* zerif_latestnews_title */
	wp.customize(
		'zerif_latestnews_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section.latest-news .section-header h2' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.latest-news .section-header h2' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'section.latest-news .section-header h2' ).html( to );
				}
			);
		}
	);

	/* zerif_latestnews_subtitle */
	wp.customize(
		'zerif_latestnews_subtitle', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section.latest-news .section-header h6' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section.latest-news .section-header h6' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'section.latest-news .section-header h6' ).html( to );
				}
			);
		}
	);

	/* zerif_latestnews_background */
	wp.customize(
		'zerif_latestnews_background', function( value ) {
			value.bind(
				function( to ) {
					$( 'section.latest-news' ).css( { 'background': to } );
				}
			);
		}
	);

	/* zerif_latestnews_header_title_color */
	wp.customize(
		'zerif_latestnews_header_title_color', function( value ) {
			value.bind(
				function( to ) {
					$( 'section.latest-news .section-header h2' ).css( { 'color': to } );
				}
			);
		}
	);

	/* zerif_latestnews_header_subtitle_color */
	wp.customize(
		'zerif_latestnews_header_subtitle_color', function( value ) {
			value.bind(
				function( to ) {
					$( 'section.latest-news .section-header h6' ).css( { 'color': to } );
				}
			);
		}
	);

	/* zerif_latestnews_post_title_color */
	wp.customize(
		'zerif_latestnews_post_title_color', function( value ) {
			value.bind(
				function( to ) {
					$( '#carousel-homepage-latestnews .carousel-inner .item .latestnews-title a' ).css( { 'color': to } );
				}
			);
		}
	);

	/* zerif_latestnews_post_text_color */
	wp.customize(
		'zerif_latestnews_post_text_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.latesnews-content p, .latesnews-content' ).css( { 'color': to } );
				}
			);
		}
	);

	/*******************************************************/
	/************	SUBSCRIBE SECTION **********************/
	/*******************************************************/

	/* show/hide */
	wp.customize(
		'zerif_subscribe_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section#subscribe' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section#subscribe' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
				}
			);
		}
	);

	/* title */
	wp.customize(
		'zerif_subscribe_title', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section#subscribe h3' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section#subscribe h3' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'section#subscribe h3' ).html( to );
				}
			);
		}
	);

	/* subtitle */
	wp.customize(
		'zerif_subscribe_subtitle', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'section#subscribe div.sub-heading' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'section#subscribe div.sub-heading' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'section#subscribe div.sub-heading' ).html( to );
				}
			);
		}
	);

	/* zerif_subscribe_background */
	wp.customize(
		'zerif_subscribe_background', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#subscribe' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_subscribe_header_color */
	wp.customize(
		'zerif_subscribe_header_color', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#subscribe div.sub-heading, section#subscribe h3' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_subscribe_button_background_color */
	wp.customize(
		'zerif_subscribe_button_background_color', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#subscribe form input[type=submit]' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_subscribe_button_color */
	wp.customize(
		'zerif_subscribe_button_color', function( value ) {
			value.bind(
				function( to ) {
					$( 'section#subscribe form input[type=submit]' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/***********************************************/
	/************** COLORS OPTIONS  ***************/
	/***********************************************/

	/* zerif_footer_background */
	wp.customize(
		'zerif_footer_background', function( value ) {
			value.bind(
				function( to ) {
					$( '#footer' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_footer_socials_background */
	wp.customize(
		'zerif_footer_socials_background', function( value ) {
			value.bind(
				function( to ) {
					$( '.copyright' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_footer_text_color */
	wp.customize(
		'zerif_footer_text_color', function( value ) {
			value.bind(
				function( to ) {
					$( '#footer .company-details, #footer .company-details a, #footer .footer-widget p, #footer .footer-widget a' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_footer_socials */
	wp.customize(
		'zerif_footer_socials', function( value ) {
			value.bind(
				function( to ) {
					$( '#footer .social li a' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_footer_widgets_title */
	wp.customize(
		'zerif_footer_widgets_title', function( value ) {
			value.bind(
				function( to ) {
					$( '#footer .footer-widget h1' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_background_color */
	wp.customize(
		'zerif_background_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.site-content' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_navbar_color */
	wp.customize(
		'zerif_navbar_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.navbar, .navbar-inverse .navbar-nav ul.sub-menu' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_titles_color */
	wp.customize(
		'zerif_titles_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.entry-title, .entry-title a, .widget-title, .widget-title a, .page-header .page-title, .comments-title, h1.page-title' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_texts_color */
	wp.customize(
		'zerif_texts_color', function( value ) {
			value.bind(
				function( to ) {
					$( 'body, button, input, select, textarea, .widget p, .widget .textwidget, .woocommerce .product h3, .woocommerce .product span.amount, .woocommerce-page .woocommerce .product-name a' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	wp.customize(
		'zerif_menu_item_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.navbar-inverse .navbar-nav>li>a' ).css( 'color', to ? to : '' );
				}
			);
		}
	);

	wp.customize(
		'zerif_menu_item_hover_color', function ( value ) {
			value.bind(
				function( to ) {
					var style, el;
					el = $( '.hover-styles-2' );
					if (to !== '') {
						style = '<style class="hover-styles-2">.navbar-inverse .navbar-nav>li>a:hover{ color:' + to + '!important}</style>';
					}
					if (style !== '') {
						if (el.length) {
							el.replaceWith( style );
						} else {
							$( 'head' ).append( style );
						}
					}
				}
			);
		}
	);

	/* zerif_links_color */
	wp.customize(
		'zerif_links_color', function( value ) {
			value.bind(
				function( to ) {
					var zerif_menu_color;
					zerif_menu_color = wp.customize._value.zerif_menu_item_color();

					if (to !== '') {
						if ( zerif_menu_color !== '' ) {
                            $( '.widget li a, .widget a, article .entry-meta a, .entry-footer a, .site-content a' ).css( 'color', to ? to : '' );
						} else {
                            $( '.widget li a, .widget a, article .entry-meta a, .entry-footer a, .navbar-inverse .navbar-nav>li>a, .site-content a' ).css( 'color', to ? to : '' );
						}
					}
				}
			);
		}
	);

	wp.customize(
		'zerif_links_color_hover', function( value ) {
			value.bind(
				function( to ) {
					var style, zerif_menu_item_hover_color, el;
					el                          = $( '.hover-styles' );
					zerif_menu_item_hover_color = wp.customize._value.zerif_menu_item_hover_color();

					if (to !== '') {
						if ( zerif_menu_item_hover_color !== '' ) {
                            style = '<style class="hover-styles">.widget li a:hover, .widget a:hover, article .entry-meta a:hover, .entry-footer a:hover, .site-content a:hover { color:' + to + '!important};</style>';
						} else {
                            style = '<style class="hover-styles">.widget li a:hover, .widget a:hover, article .entry-meta a:hover, .entry-footer a:hover, .navbar-inverse .navbar-nav>li>a:hover, .site-content a:hover { color:' + to + '!important}</style>';
						}
					}

					if ( style !== '' ) {
						if (el.length) {
							el.replaceWith( style );
						} else {
							$( 'head' ).append( style );
						}
					}
				}
			);
		}
	);

	/* zerif_buttons_background_color */
	wp.customize(
		'zerif_buttons_background_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.comment-form #submit, .comment-reply-link,.woocommerce .add_to_cart_button, .woocommerce .checkout-button, .woocommerce .single_add_to_cart_button, .woocommerce #place_order, .edd-submit.button, .page button, .post button, .woocommerce-page .woocommerce input[type="submit"], .woocommerce-page #content input.button, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page input.button.alt' ).attr( 'style', 'background: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_buttons_text_color */
	wp.customize(
		'zerif_buttons_text_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.comment-form #submit, .comment-reply-link, .woocommerce .add_to_cart_button, .woocommerce .checkout-button, .woocommerce .single_add_to_cart_button, .woocommerce #place_order, .edd-submit.button span, .page button, .post button, .woocommerce-page .woocommerce input[type="submit"], .woocommerce-page #content input.button, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page input.button.alt, .woocommerce .button, .woocommerce-page .products .added_to_cart' ).attr( 'style', 'color: ' + to + ' !important' );
				}
			);
		}
	);

	/* zerif_top_bar_background_color */
	wp.customize(
		'zerif_top_bar_background_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.zerif-top-bar' ).eq( 0 ).css('backgroundColor', to );
				}
			);
		}
	);

	/* zerif_top_bar_text_color */
	wp.customize(
		'zerif_top_bar_text_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.zerif-top-bar' ).eq( 0 ).css( 'color', to);
				}
			);
		}
	);

	/* zerif_top_bar_link_color */
	wp.customize(
		'zerif_top_bar_link_color', function( value ) {
			value.bind(
				function( to ) {
					$( '.zerif-top-bar a' ).attr( 'style', 'color: ' + to );
				}
			);
		}
	);

	/* zerif_top_bar_link_color_hover */
	wp.customize(
		'zerif_top_bar_link_color_hover', function ( value ) {
			value.bind(
				function( to ) {
					var style, el;
					el = $( '.top-bar-hover-styles' );
					if (to !== '') {
						style = '<style class="top-bar-hover-styles">.zerif-top-bar li>a:hover{ color:' + to + '!important}</style>';
					}
					if (style !== '') {
						if (el.length) {
							el.replaceWith( style );
						} else {
							$( 'head' ).append( style );
						}
					}
				}
			);
		}
	);

	/***********************************************/
	/************** GENERAL OPTIONS  ***************/
	/***********************************************/
	wp.customize(
		'zerif_logo', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '.navbar-brand img' ).removeClass( 'zerif_hidden_if_not_customizer' );
						$( '.zerif_header_title' ).addClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '.navbar-brand img' ).addClass( 'zerif_hidden_if_not_customizer' );
						$( '.zerif_header_title' ).removeClass( 'zerif_hidden_if_not_customizer' );
					}
					$( '.navbar-brand img' ).attr( 'src', to );
				}
			);
		}
	);
	wp.customize(
		'zerif_copyright', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( '#zerif-copyright' ).removeClass( 'zerif_hidden_if_not_customizer' );
						$( '.copyright' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( '#zerif-copyright' ).addClass( 'zerif_hidden_if_not_customizer' );
						if ( $( '.social' ).hasClass( 'zerif_hidden_if_not_customizer' ) ) {
							$( '.copyright' ).addClass( 'zerif_hidden_if_not_customizer' );
						}
					}
					$( '#zerif-copyright' ).html( to );
				}
			);
		}
	);

	/* zerif_email */
	wp.customize(
		'zerif_email', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'footer .zerif-footer-email' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'footer .zerif-footer-email' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'footer .zerif-footer-email' ).html( to );
				}
			);
		}
	);

	/* zerif_phone */
	wp.customize(
		'zerif_phone', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'footer .zerif-footer-phone' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'footer .zerif-footer-phone' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'footer .zerif-footer-phone' ).html( to );
				}
			);
		}
	);

	/* zerif_address */
	wp.customize(
		'zerif_address', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== '' ) {
						$( 'footer .zerif-footer-address' ).removeClass( 'zerif_hidden_if_not_customizer' );
					} else {
						$( 'footer .zerif-footer-address' ).addClass( 'zerif_hidden_if_not_customizer' );
					}
					$( 'footer .zerif-footer-address' ).html( to );
				}
			);
		}
	);

	// Header text color.
	wp.customize(
		'header_textcolor', function( value ) {
			value.bind(
				function( to ) {
					if ( 'blank' === to ) {
						$( '.site-title, .site-description' ).css(
							{
								'clip': 'rect(1px, 1px, 1px, 1px)',
								'position': 'absolute'
							}
						);
					} else {
						$( '.site-title, .site-description' ).css(
							{
								'clip': 'auto',
								'color': to,
								'position': 'relative'
							}
						);
					}
				}
			);
		}
	);

} )( jQuery );
