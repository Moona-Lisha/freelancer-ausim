<?php
/**
 * Zerif Theme Customizer
 *
 * @package zerif
 */

/**
 * Register Customizer settings
 *
 * @param object $wp_customize Customizer settings.
 */
function wp_themeisle_customize_register( $wp_customize ) {

	/**
	 * Class Zerif_Video_Sound
	 */
	class Zerif_Video_Sound extends WP_Customize_Control {

		/**
		 * Function to render the controls content
		 */
		public function render_content() {
			echo '<label><span class="customize-control-title">' . __( 'Enable video sound?', 'zerif' ) . '</span></label>';
		}
	}

	/**
	 * Class Zerif_Customizer_Number_Control
	 */
	class Zerif_Customizer_Number_Control extends WP_Customize_Control {

		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'number';

		/**
		 * Function to render the controls content
		 */
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
			</label>
			<?php
		}
	}

	/**
	 * Class Zerif_Customize_Textarea_Control
	 */
	class Zerif_Customize_Textarea_Control extends WP_Customize_Control {

		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'textarea';

		/**
		 * Function to render the controls content
		 */
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" id="customize_textarea" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_section( 'colors' );

	require_once( 'class/zerif-pro-info.php' );

	$wp_customize->add_section(
		'zerif_pro_theme_info',
		array(
			'title'    => __( 'Theme info', 'zerif' ),
			'priority' => 0,
		)
	);
	$wp_customize->add_setting(
		'zerif_pro_theme_info',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'zerif_pro_sanitize_input',
		)
	);
	$wp_customize->add_control(
		new Zerif_Pro_Info(
			$wp_customize,
			'zerif_pro_theme_info',
			array(
				'section'  => 'zerif_pro_theme_info',
				'priority' => 10,
			)
		)
	);

	/**
	 * ORDER
	 */

	$wp_customize->add_section(
		'zerif_order_section',
		array(
			'title'       => esc_html__( 'Order the Frontpage Sections', 'zerif' ),
			'description' => esc_html__( 'Here is where you can rearrange the homepage sections.', 'zerif' ),
			'priority'    => 60,
		)
	);

	/* section 1 */
	$wp_customize->add_setting(
		'section1',
		array(
			'default'           => 'our_focus',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section1',
		array(
			'type'     => 'select',
			'label'    => '1st section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 1,
		)
	);

	/* section 2 */
	$wp_customize->add_setting(
		'section2',
		array(
			'default'           => 'bottom_ribbon',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section2',
		array(
			'type'     => 'select',
			'label'    => '2nd section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 2,
		)
	);

	/* section 3 */
	$wp_customize->add_setting(
		'section3',
		array(
			'default'           => 'portofolio',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section3',
		array(
			'type'     => 'select',
			'label'    => '3rd section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 3,
		)
	);

	/* section 4 */
	$wp_customize->add_setting(
		'section4',
		array(
			'default'           => 'about_us',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section4',
		array(
			'type'     => 'select',
			'label'    => '4rt section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 4,
		)
	);

	/* section 5 */
	$wp_customize->add_setting(
		'section5',
		array(
			'default'           => 'our_team',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section5',
		array(
			'type'     => 'select',
			'label'    => '5th section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 5,
		)
	);

	/* section 6 */
	$wp_customize->add_setting(
		'section6',
		array(
			'default'           => 'testimonials',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section6',
		array(
			'type'     => 'select',
			'label'    => '6th section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),

			),
			'priority' => 6,
		)
	);

	/* section 7 */
	$wp_customize->add_setting(
		'section7',
		array(
			'default'           => 'right_ribbon',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section7',
		array(
			'type'     => 'select',
			'label'    => '7th section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),

			),
			'priority' => 7,
		)
	);

	/* section 8 */
	$wp_customize->add_setting(
		'section8',
		array(
			'default'           => 'contact_us',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section8',
		array(
			'type'     => 'select',
			'label'    => '8th section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 8,
		)
	);

	/* section 9 */
	$wp_customize->add_setting(
		'section9',
		array(
			'default'           => 'map',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section9',
		array(
			'type'     => 'select',
			'label'    => '9th section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 9,
		)
	);

	/* section 10 */
	$wp_customize->add_setting(
		'section10',
		array(
			'default'           => 'packages',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section10',
		array(
			'type'     => 'select',
			'label'    => '10th section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 10,
		)
	);

	/* section 11 */
	$wp_customize->add_setting(
		'section11',
		array(
			'default'           => 'subscribe',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section11',
		array(
			'type'     => 'select',
			'label'    => '11th section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 11,
		)
	);

	/* section 12 */
	$wp_customize->add_setting(
		'section12',
		array(
			'default'           => 'latest_news',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section12',
		array(
			'type'     => 'select',
			'label'    => '12th section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),
			),
			'priority' => 12,
		)
	);

	/* section 13 */
	$wp_customize->add_setting(
		'section13',
		array(
			'default'           => 'shortcodes',
			'sanitize_callback' => 'zerif_sanitize_section_name',
		)
	);

	$wp_customize->add_control(
		'section13',
		array(
			'type'     => 'select',
			'label'    => '13th section',
			'section'  => 'zerif_order_section',
			'choices'  => array(
				'our_focus'     => __( 'Our focus', 'zerif' ),
				'portofolio'    => __( 'Portfolio', 'zerif' ),
				'about_us'      => __( 'About us', 'zerif' ),
				'our_team'      => __( 'Our team', 'zerif' ),
				'testimonials'  => __( 'Testimonials', 'zerif' ),
				'bottom_ribbon' => __( 'Bottom ribbon', 'zerif' ),
				'right_ribbon'  => __( 'Right ribbon', 'zerif' ),
				'contact_us'    => __( 'Contact us', 'zerif' ),
				'packages'      => __( ' Packages', 'zerif' ),
				'map'           => __( 'Google map', 'zerif' ),
				'subscribe'     => __( 'Subscribe', 'zerif' ),
				'latest_news'   => __( 'Latest news', 'zerif' ),
				'shortcodes'    => __( 'Shortcodes', 'zerif' ),

			),
			'priority' => 13,
		)
	);

	// Register JS sections type
	$wp_customize->register_section_type( 'Zerif_Customizer_Info' );

	/* Enqueue files for Scroll to top on front page sections */
	if ( file_exists( get_template_directory() . '/inc/customizer-scroll/class/class-zerif-customize-control-scroll.php' ) ) {
		require_once get_template_directory() . '/inc/customizer-scroll/class/class-zerif-customize-control-scroll.php';
	}
	if ( class_exists( 'Zerif_Customize_Control_Scroll' ) ) {
		$scroller = new Zerif_Customize_Control_Scroll;
	}
}

add_action( 'customize_register', 'wp_themeisle_customize_register' );

/* Require selective refresh */
if ( file_exists( get_template_directory() . '/inc/selective-refresh.php' ) ) {
	require_once get_template_directory() . '/inc/selective-refresh.php';
}

/* Require Customizer Controls */
require_once get_template_directory() . '/inc/customizer-controls-with-panels.php';


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_themeisle_customize_preview_js() {
	wp_enqueue_script( 'wp_themeisle_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), ZERIF_VERSION, true );
	wp_localize_script(
		'wp_themeisle_customizer',
		'requestpost',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		)
	);
}

add_action( 'customize_preview_init', 'wp_themeisle_customize_preview_js' );

/**
 * Sanitize section name
 *
 * @param string $input Input to be sanitized.
 */
function zerif_sanitize_section_name( $input ) {
	$zerif_posible_sections = array(
		'our_focus',
		'bottom_ribbon',
		'portofolio',
		'about_us',
		'our_team',
		'testimonials',
		'right_ribbon',
		'contact_us',
		'map',
		'packages',
		'subscribe',
		'latest_news',
		'shortcodes',
	);
	if ( in_array( $input, $zerif_posible_sections ) ) {
		return $input;
	}
	return $zerif_posible_sections[0];
}

/**
 * Sanitize repeater
 *
 * @param json $input Input to be sanitized.
 */
function zerif_sanitize_repeater( $input ) {
	$input_decoded = json_decode( $input, true );
	if ( ! empty( $input_decoded ) ) {
		foreach ( $input_decoded as $boxk => $box ) {
			foreach ( $box as $key => $value ) {
				if ( $key == 'text_color' || $key == 'color' ) {
					$value                          = html_entity_decode( $value );
					$input_decoded[ $boxk ][ $key ] = sanitize_hex_color( $value );
				} elseif ( $key == 'opacity' ) {
					$input_decoded[ $boxk ][ $key ] = ( is_numeric( $value ) ? $value : 1 );
				} else {
					$input_decoded[ $boxk ][ $key ] = wp_kses_post( force_balance_tags( $value ) );
				}
			}
		}
		return json_encode( $input_decoded );
	}
	return $input;
}

/**
 * Sanitize position
 *
 * @param string $input Input to be sanitized.
 */
function zerif_sanitize_position( $input ) {
	$zerif_posible_positions = array(
		'top',
		'center',
		'bottom',
	);
	if ( in_array( $input, $zerif_posible_positions ) ) {
		return $input;
	}
	return $zerif_posible_positions[0];
}

/**
 * Sanitize background size
 *
 * @param string $input Input to be sanitized.
 */
function zerif_sanitize_background_size( $input ) {
	$zerif_posible_sizes = array(
		'cover',
		'width',
		'height',
	);
	if ( in_array( $input, $zerif_posible_sizes ) ) {
		return $input;
	}
	return $zerif_posible_sizes[0];
}

/**
 * Sanitize horizontal alignment
 *
 * @param string $input Input to be sanitized.
 */
function zerif_sanitize_horizontal( $input ) {
	$zerif_posible_positions = array(
		'left',
		'center',
		'right',
	);
	if ( in_array( $input, $zerif_posible_positions ) ) {
		return $input;
	}
	return $zerif_posible_positions[0];
}

/**
 * Sanitize background type
 *
 * @param string $input Input to be sanitized.
 */
function zerif_sanitize_background_type( $input ) {
	$zerif_posible_types = array(
		'zerif-background-image',
		'zerif-background-slider',
		'zerif-background-video',
	);
	if ( in_array( $input, $zerif_posible_types ) ) {
		return $input;
	}
	return $zerif_posible_types[0];
}

/**
 * Sanitize checkboxes
 *
 * @param book $input Input to be sanitized.
 *
 * @return bool
 */
function zerif_sanitize_checkbox( $input ) {
	return ( isset( $input ) && true == $input ? true : false );
}

/**
 * Sanitize texts
 *
 * @param string $input Text to be sanitized.
 */
function zerif_sanitize_input( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize RGBA colors
 */
function zerif_sanitize_rgba( $value ) {

	// If empty or an array return transparent
	if ( empty( $value ) ) {
		return false;
	}
	$value = str_replace( ' ', '', $value );
	if ( substr( $value, 0, 4 ) == 'rgba' ) {
		sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
	}
	return sanitize_hex_color( $value );
}

/**
 * Enqueue customizer script
 */
function zerif_registers() {
	wp_enqueue_script( 'zerif_customizer_script', get_template_directory_uri() . '/js/zerif_customizer.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-draggable', 'wp-color-picker' ), ZERIF_VERSION, true );
}

add_action( 'customize_controls_enqueue_scripts', 'zerif_registers' );

/**
 * Filter to move the big title widgets section in proper panel.
 *
 * @param array  $section_args The section args.
 * @param int    $section_id The section id.
 * @param string $sidebar_id The sidebar id.
 *
 * @return array
 */
function zerif_customizer_move_big_title_panel( $section_args, $section_id, $sidebar_id ) {
	if ( $sidebar_id === 'sidebar-big-title' ) {
		unset( $section_args['panel'] );
		$section_args['panel'] = 'panel_3';
	}

	return $section_args;
}
add_filter( 'customizer_widgets_section_args', 'zerif_customizer_move_big_title_panel', 10, 3 );
