<?php
/**
 * Zerif Theme customizer using panels
 *
 * All controls within this file assumes that class WP_Customize_Panel exists
 *
 * @package zerif
 */

/**
 * Register Customizer settings
 *
 * @param object $wp_customize Customizer settings.
 */
function zerif_customize_register_with_panels( $wp_customize ) {

	/**
	 * ==============
	 * COLORS OPTIONS
	 * ==============
	 */

	/* COLORS FOOTER */

	$wp_customize->add_section(
		'zerif_footer_color_section',
		array(
			'title'    => __( 'Footer colors', 'zerif' ),
			'priority' => 130,
			'panel'    => 'zerif_colors',
		)
	);

	/* zerif_footer_background */
	$wp_customize->add_setting(
		'zerif_footer_background',
		array(
			'default'           => apply_filters( 'zerif_footer_background_filter', '#272727' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_footer_background',
			array(
				'label'    => __( 'Footer background color', 'zerif' ),
				'section'  => 'zerif_footer_color_section',
				'priority' => 1,
			)
		)
	);

	/* zerif_footer_socials_background */
	$wp_customize->add_setting(
		'zerif_footer_socials_background',
		array(
			'default'           => apply_filters( 'zerif_footer_socials_background_filter', '#171717' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_footer_socials_background',
			array(
				'label'    => __( 'Footer socials background color', 'zerif' ),
				'section'  => 'zerif_footer_color_section',
				'priority' => 2,
			)
		)
	);

	/* zerif_footer_text_color */
	$wp_customize->add_setting(
		'zerif_footer_text_color',
		array(
			'default'           => apply_filters( 'zerif_footer_text_color_filter', '#939393' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_footer_text_color',
			array(
				'label'    => __( 'Footer text color', 'zerif' ),
				'section'  => 'zerif_footer_color_section',
				'priority' => 3,
			)
		)
	);

	/* zerif_footer_text_color_hover */
	$wp_customize->add_setting(
		'zerif_footer_text_color_hover',
		array(
			'default'           => apply_filters( 'zerif_footer_text_color_hover_filter', '#e96656' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_footer_text_color_hover',
			array(
				'label'    => __( 'Footer text color - hover', 'zerif' ),
				'section'  => 'zerif_footer_color_section',
				'priority' => 4,
			)
		)
	);

	/* zerif_footer_socials */
	$wp_customize->add_setting(
		'zerif_footer_socials',
		array(
			'default'           => apply_filters( 'zerif_footer_socials_filter', '#939393' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_footer_socials',
			array(
				'label'    => __( 'Footer social icons color', 'zerif' ),
				'section'  => 'zerif_footer_color_section',
				'priority' => 5,
			)
		)
	);

	/* zerif_footer_socials_hover */
	$wp_customize->add_setting(
		'zerif_footer_socials_hover',
		array(
			'default'           => apply_filters( 'zerif_footer_socials_hover_filter', '#e96656' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_footer_socials_hover',
			array(
				'label'    => __( 'Footer socials icons color - hover', 'zerif' ),
				'section'  => 'zerif_footer_color_section',
				'priority' => 6,
			)
		)
	);

	/* zerif_footer_widgets_title */
	$wp_customize->add_setting(
		'zerif_footer_widgets_title',
		array(
			'default'           => apply_filters( 'zerif_footer_widgets_title_filter', '#fff' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_footer_widgets_title',
			array(
				'label'    => __( 'Footer widgets title color', 'zerif' ),
				'section'  => 'zerif_footer_color_section',
				'priority' => 7,
			)
		)
	);

	/* zerif_footer_widgets_title_border_bottom */
	$wp_customize->add_setting(
		'zerif_footer_widgets_title_border_bottom',
		array(
			'default'           => apply_filters( 'zerif_footer_widgets_title_border_bottom_filter', '#e96656' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_footer_widgets_title_border_bottom',
			array(
				'label'    => __( 'Footer widgets title bottom border color', 'zerif' ),
				'section'  => 'zerif_footer_color_section',
				'priority' => 8,
			)
		)
	);

	/* COLORS FOOTER */

	$wp_customize->add_section(
		'zerif_general_color_section',
		array(
			'title'    => __( 'General colors', 'zerif' ),
			'priority' => 0,
			'panel'    => 'zerif_colors',
		)
	);

	$wp_customize->add_setting(
		'zerif_menu_item_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_menu_item_color',
			array(
				'label'    => __( 'Menu item color', 'zerif' ),
				'section'  => 'zerif_general_color_section',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting(
		'zerif_menu_item_hover_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_menu_item_hover_color',
			array(
				'label'    => __( 'Menu item color hover', 'zerif' ),
				'section'  => 'zerif_general_color_section',
				'priority' => 2,
			)
		)
	);

	/* zerif_background_color */
	$wp_customize->add_setting(
		'zerif_background_color',
		array(
			'default'           => apply_filters( 'zerif_background_color_filter', '#fff' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_background_color',
			array(
				'label'    => __( 'Background color', 'zerif' ),
				'section'  => 'zerif_general_color_section',
				'priority' => 3,
			)
		)
	);

	/* zerif_navbar_color */
	$wp_customize->add_setting(
		'zerif_navbar_color',
		array(
			'default'           => apply_filters( 'zerif_navbar_color_filter', '#fff' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_navbar_color',
			array(
				'label'    => __( 'Navbar background color', 'zerif' ),
				'section'  => 'zerif_general_color_section',
				'priority' => 4,
			)
		)
	);

	/* zerif_titles_color */
	$wp_customize->add_setting(
		'zerif_titles_color',
		array(
			'default'           => apply_filters( 'zerif_titles_color_filter', '#404040' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_titles_color',
			array(
				'label'    => __( 'Titles color', 'zerif' ),
				'section'  => 'zerif_general_color_section',
				'priority' => 5,
			)
		)
	);

	/* zerif_titles_bottomborder_color */
	$wp_customize->add_setting(
		'zerif_titles_bottomborder_color',
		array(
			'default'           => apply_filters( 'zerif_titles_bottomborder_color_filter', '#e96656' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_titles_bottomborder_color',
			array(
				'label'    => __( 'Titles bottom border color', 'zerif' ),
				'section'  => 'zerif_general_color_section',
				'priority' => 6,
			)
		)
	);

	/* zerif_texts_color */
	$wp_customize->add_setting(
		'zerif_texts_color',
		array(
			'default'           => apply_filters( 'zerif_texts_color_filter', '#404040' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_texts_color',
			array(
				'label'    => __( 'Text color', 'zerif' ),
				'section'  => 'zerif_general_color_section',
				'priority' => 7,
			)
		)
	);

	/* zerif_links_color */
	$wp_customize->add_setting(
		'zerif_links_color',
		array(
			'default'           => apply_filters( 'zerif_links_color_filter', '#808080' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_links_color',
			array(
				'label'    => __( 'Links color', 'zerif' ),
				'section'  => 'zerif_general_color_section',
				'priority' => 8,
			)
		)
	);

	/* zerif_links_color_hover */
	$wp_customize->add_setting(
		'zerif_links_color_hover',
		array(
			'default'           => apply_filters( 'zerif_links_color_hover_filter', '#e96656' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_links_color_hover',
			array(
				'label'    => __( 'Links color hover', 'zerif' ),
				'section'  => 'zerif_general_color_section',
				'priority' => 9,
			)
		)
	);

	/* COLORS BUTTONS */

	$wp_customize->add_section(
		'zerif_buttons_color_section',
		array(
			'title'    => __( 'Buttons colors', 'zerif' ),
			'priority' => 10,
			'panel'    => 'zerif_colors',
		)
	);

	/* zerif_buttons_background_color */
	$wp_customize->add_setting(
		'zerif_buttons_background_color',
		array(
			'default'           => apply_filters( 'zerif_buttons_background_color_filter', '#e96656' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_buttons_background_color',
			array(
				'label'    => __( 'Buttons background color', 'zerif' ),
				'section'  => 'zerif_buttons_color_section',
				'priority' => 1,
			)
		)
	);

	/* zerif_buttons_background_color_hover */
	$wp_customize->add_setting(
		'zerif_buttons_background_color_hover',
		array(
			'default'           => apply_filters( 'zerif_buttons_background_color_hover_filter', '#cb4332' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_buttons_background_color_hover',
			array(
				'label'    => __( 'Buttons background color - hover', 'zerif' ),
				'section'  => 'zerif_buttons_color_section',
				'priority' => 2,
			)
		)
	);

	/* zerif_buttons_text_color */
	$wp_customize->add_setting(
		'zerif_buttons_text_color',
		array(
			'default'           => apply_filters( 'zerif_buttons_text_color_filter', '#fff' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'zerif_buttons_text_color',
			array(
				'label'    => __( 'Buttons text color', 'zerif' ),
				'section'  => 'zerif_buttons_color_section',
				'priority' => 3,
			)
		)
	);

	/**
	 * ===============
	 * GENERAL OPTIONS
	 * ===============
	 */
	$wp_customize->add_section(
		'zerif_general_section',
		array(
			'title'    => esc_html__( 'General Options', 'zerif' ),
			'priority' => 20,
		)
	);

	/* safe font */
	$wp_customize->add_setting(
		'zerif_use_safe_font',
		array(
			'sanitize_callback' => 'zerif_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zerif_use_safe_font',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Use safe font?', 'zerif' ),
			'section'  => 'zerif_general_section',
			'priority' => 1,
		)
	);

	/* zerif_disable_preloader */
	$wp_customize->add_setting(
		'zerif_disable_preloader',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'zerif_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zerif_disable_preloader',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable preloader?', 'zerif' ),
			'section'  => 'zerif_general_section',
			'priority' => 2,
		)
	);

	/* Disable smooth scroll */
	$wp_customize->add_setting(
		'zerif_disable_smooth_scroll',
		array(
			'sanitize_callback' => 'zerif_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zerif_disable_smooth_scroll',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable smooth scroll?', 'zerif' ),
			'section'  => 'zerif_general_section',
			'priority' => 3,
		)
	);

	$wp_customize->add_setting(
		'zerif_accessibility',
		array(
			'sanitize_callback' => 'zerif_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zerif_accessibility',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable accessibility?', 'zerif' ),
			'section'  => 'zerif_general_section',
			'priority' => 4,
		)
	);

	/* zerif_copyright */
	$wp_customize->add_setting(
		'zerif_copyright',
		array(
			'sanitize_callback' => 'zerif_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'zerif_copyright',
		array(
			'label'    => __( 'Footer Copyright', 'zerif' ),
			'section'  => 'zerif_footer_section',
			'priority' => 0,
		)
	);

	/* zerif_google_anaytics */
	$wp_customize->add_setting(
		'zerif_google_anaytics',
		array(
			'sanitize_callback' => 'force_balance_tags',
		)
	);

	$wp_customize->add_control(
		new Zerif_Customize_Textarea_Control(
			$wp_customize,
			'zerif_google_anaytics',
			array(
				'label'    => __( 'Google analytics code', 'zerif' ),
				'section'  => 'zerif_general_section',
				'priority' => 7,
			)
		)
	);

	/* Change the template to full width for page.php */
	$wp_customize->add_setting(
		'zerif_change_to_full_width',
		array(
			'sanitize_callback' => 'zerif_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zerif_change_to_full_width',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Change the template to Full width for all the pages?', 'zerif' ),
			'section'  => 'zerif_general_section',
			'priority' => 8,
		)
	);

	/* Display thumbnail on single.php */
	$wp_customize->add_setting(
		'zerif_add_thumbnail_posts',
		array(
			'sanitize_callback' => 'zerif_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zerif_add_thumbnail_posts',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Display Featured Image in posts?', 'zerif' ),
			'section'  => 'zerif_general_section',
			'priority' => 9,
		)
	);

	/* Display thumbnail on page.php */
	$wp_customize->add_setting(
		'zerif_add_thumbnail_pages',
		array(
			'sanitize_callback' => 'zerif_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zerif_add_thumbnail_pages',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Display Featured Image in pages?', 'zerif' ),
			'section'  => 'zerif_general_section',
			'priority' => 10,
		)
	);

	$wp_customize->add_section(
		'zerif_top_bar',
		array(
			'title'    => esc_html__( 'Very Top Bar', 'zerif' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'zerif_top_bar_hide',
		array(
			'sanitize_callback' => 'zerif_sanitize_checkbox',
			'default'           => false,
		)
	);

	$wp_customize->add_control(
		'zerif_top_bar_hide',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Display Very Top Bar?', 'zerif' ),
			'section'  => 'zerif_top_bar',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'zerif_top_bar_alignment',
		array(
			'sanitize_callback' => 'sanitize_key',
			'default'           => 'right',
		)
	);

	$wp_customize->add_control(
		new Zerif_Radio_Image_Control(
			$wp_customize,
			'zerif_top_bar_alignment',
			array(
				'label'    => __( 'Layout', 'zerif' ),
				'section'  => 'zerif_top_bar',
				'choices'  => array(
					'left'  => array(
						'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAM1BMVEX///8Ahbojjr5mqMzU5O/f6/Pq8vf1+fs9l8NToMiGuNWjyN681ueVwNp3sNGwz+LI3evMEc51AAABPUlEQVR4Ae3RuYojSxhE4Ti5L1nL+z/tVdISNFwYY5hWy4jPCPjLOlTKzMzMzMzMzMzMzMzMzP61WvSJAllbjvETsxLof464fvUR8ysr6ylVSZGph5L1B3z3F/dL41KFuSdD0mq0A6QjECJR9QSOfba4Socwfz5r0rXYQxOkDDRAN7QAUZ12wvzKGpzjHVkFygmUwRSkSSgaoMEpBWKGlQZdkandeJX681nqXCGMx1AEaRClBF8VkXizvT7cAcJ6Q9YicN4Eup5/q+oATVq+IWa4UrqSIkPKZXX6G7IqsBT2CFKG0AHlwBbVCbFx64C2Qhsn4w1ZOqFq7BEkrQAdpHzEIzJUI3BWlQZzAL3oDUrKz1FKVVKuNSXpPNIFSw9J2nJ5zi+62XrVh0kzjktmZmZmZmZmZmZmZmZm9s1/51AJDRsfaTQAAAAASUVORK5CYII=',
						'label' => esc_html__( 'Left Sidebar', 'zerif' ),
					),
					'right' => array(
						'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAM1BMVEX///8Ahbojjr5mqMzU5O/f6/Pq8vf1+fs9l8NToMiGuNWjyN681ueVwNp3sNGwz+LI3evMEc51AAABO0lEQVR4Ae3RuWodQRhE4Tq9Lz3L+z+tb6MrMFZm0EhBfUHBP9FhWmZmZmZmZmZmZmZmZmb2Uot+o0DWlmP8jVkJ9MUR148+Yv7MynpLVVJk6qVkPaBxqcLckyFpNdoB0hEIkah6Asc+W1ylQ5j6B3/7j/urSddiD02QMtAA3dACRHXaCfMja3COJ7IKlBMogylIk1A0QINTCsQMKw26IlO78Sr1+7PUuUIYr6EI0iBKCT4qIvFm+/xwBwjrgaxF4LwJdL3/VtUBmrR8Q8xwpXQlRYaUy+r0B7IqsBT2CFKG0AHlwBbVCbFx64C2Qhsn44EsnVA19giSVoAOUj7iERmqETirSoM5gF6eyCopv0cpVUm51pSk80gXLL0kacvlPT/oZutVv0yacVwyMzMzMzMzMzMzMzMzs+/yB9eOCQ0dpl58AAAAAElFTkSuQmCC',
						'label' => esc_html__( 'Right Sidebar', 'zerif' ),
					),
				),
				'priority' => 20,
			)
		)
	);

	$wp_customize->add_setting(
		'zerif_top_text',
		array(
			'sanitize_callback' => 'zerif_sanitize_input',
			'default'           => '',
		)
	);

	$wp_customize->add_control(
		new Zerif_Customize_Textarea_Control(
			$wp_customize,
			'zerif_top_text',
			array(
				'label'    => __( 'Top Bar Content', 'zerif' ),
				'section'  => 'zerif_top_bar',
				'priority' => 40,
			)
		)
	);

	$wp_customize->add_setting(
		'zerif_top_bar_background_color',
		array(
			'default'           => '#363537',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'zerif_sanitize_rgba',
		)
	);

	$wp_customize->add_control(
		new Zerif_Customize_Alpha_Color_Control(
			$wp_customize,
			'zerif_top_bar_background_color',
			array(
				'label'    => __( 'Background color', 'zerif' ),
				'palette'  => true,
				'section'  => 'zerif_top_bar',
				'priority' => 50,
			)
		)
	);

	$wp_customize->add_setting(
		'zerif_top_bar_text_color',
		array(
			'default'           => '#ffffff',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'zerif_sanitize_rgba',
		)
	);

	$wp_customize->add_control(
		new Zerif_Customize_Alpha_Color_Control(
			$wp_customize,
			'zerif_top_bar_text_color',
			array(
				'label'    => __( 'Text color', 'zerif' ),
				'palette'  => true,
				'section'  => 'zerif_top_bar',
				'priority' => 60,
			)
		)
	);

	$wp_customize->add_setting(
		'zerif_top_bar_link_color',
		array(
			'default'           => '#ffffff',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'zerif_sanitize_rgba',
		)
	);

	$wp_customize->add_control(
		new Zerif_Customize_Alpha_Color_Control(
			$wp_customize,
			'zerif_top_bar_link_color',
			array(
				'label'    => __( 'Link color', 'zerif' ),
				'palette'  => true,
				'section'  => 'zerif_top_bar',
				'priority' => 70,
			)
		)
	);

	$wp_customize->add_setting(
		'zerif_top_bar_link_color_hover',
		array(
			'default'           => '#eeeeee',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'zerif_sanitize_rgba',
		)
	);

	$wp_customize->add_control(
		new Zerif_Customize_Alpha_Color_Control(
			$wp_customize,
			'zerif_top_bar_link_color_hover',
			array(
				'label'    => __( 'Link color on hover', 'zerif' ),
				'palette'  => true,
				'section'  => 'zerif_top_bar',
				'priority' => 80,
			)
		)
	);

	$wp_customize->add_section(
		'zerif_footer_section',
		array(
			'title'       => __( 'Footer sections', 'zerif' ),
			'description' => __( 'You can insert any HTML code in here, to create links, google maps or anything else.', 'zerif' ),
			'priority'    => 0,
			'panel'       => 'zerif_footer',
		)
	);

	/* email - ICON */
	$wp_customize->add_setting(
		'zerif_email_icon',
		array(
			'default'           => get_template_directory_uri() . '/images/envelope4-green.png',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'zerif_email_icon',
			array(
				'label'    => __( 'Email section - icon', 'zerif' ),
				'section'  => 'zerif_footer_section',
				'priority' => 2,
			)
		)
	);

	/* email */
	$wp_customize->add_setting(
		'zerif_email',
		array(
			'default'           => '<a href="mailto:contact@site.com">contact@site.com</a>',
			'sanitize_callback' => 'zerif_sanitize_input',
		)
	);

	$wp_customize->add_control(
		new Zerif_Customize_Textarea_Control(
			$wp_customize,
			'zerif_email',
			array(
				'label'    => __( 'Email', 'zerif' ),
				'section'  => 'zerif_footer_section',
				'priority' => 3,
			)
		)
	);

	/* phone number - ICON */
	$wp_customize->add_setting(
		'zerif_phone_icon',
		array(
			'default'           => get_template_directory_uri() . '/images/telephone65-blue.png',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'zerif_phone_icon',
			array(
				'label'    => __( 'Phone number section - icon', 'zerif' ),
				'section'  => 'zerif_footer_section',
				'priority' => 4,
			)
		)
	);

	/* phone number */
	$wp_customize->add_setting(
		'zerif_phone',
		array(
			'default'           => '<a href="tel:0 332 548 954">0 332 548 954</a>',
			'sanitize_callback' => 'zerif_sanitize_input',
		)
	);

	$wp_customize->add_control(
		new Zerif_Customize_Textarea_Control(
			$wp_customize,
			'zerif_phone',
			array(
				'label'    => __( 'Phone number', 'zerif' ),
				'section'  => 'zerif_footer_section',
				'priority' => 5,
			)
		)
	);

	/* address - ICON */
	$wp_customize->add_setting(
		'zerif_address_icon',
		array(
			'default'           => get_template_directory_uri() . '/images/map25-redish.png',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'zerif_address_icon',
			array(
				'label'    => __( 'Address section - icon', 'zerif' ),
				'section'  => 'zerif_footer_section',
				'priority' => 6,
			)
		)
	);

	/* address */
	$wp_customize->add_setting(
		'zerif_address',
		array(
			'default'           => __( 'Company address', 'zerif' ),
			'sanitize_callback' => 'zerif_sanitize_input',
		)
	);
	$wp_customize->add_control(
		new Zerif_Customize_Textarea_Control(
			$wp_customize,
			'zerif_address',
			array(
				'label'    => __( 'Address', 'zerif' ),
				'section'  => 'zerif_footer_section',
				'priority' => 7,
			)
		)
	);

	$wp_customize->add_section(
		'zerif_general_socials_section',
		array(
			'title'    => __( 'Socials options', 'zerif' ),
			'priority' => 10,
			'panel'    => 'zerif_footer',
		)
	);

	/* facebook */
	$wp_customize->add_setting(
		'zerif_socials_facebook',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '#',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_facebook',
		array(
			'label'    => __( 'Facebook link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 1,
		)
	);

	/* twitter */
	$wp_customize->add_setting(
		'zerif_socials_twitter',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '#',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_twitter',
		array(
			'label'    => __( 'Twitter link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 2,
		)
	);

	/* linkedin */
	$wp_customize->add_setting(
		'zerif_socials_linkedin',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '#',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_linkedin',
		array(
			'label'    => __( 'Linkedin link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 3,
		)
	);

	/* behance */
	$wp_customize->add_setting(
		'zerif_socials_behance',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '#',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_behance',
		array(
			'label'    => __( 'Behance link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 4,
		)
	);

	/* dribbble */
	$wp_customize->add_setting(
		'zerif_socials_dribbble',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '#',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_dribbble',
		array(
			'label'    => __( 'Dribbble link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 5,
		)
	);

	/* Google+ */
	$wp_customize->add_setting(
		'zerif_socials_googleplus',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_googleplus',
		array(
			'label'    => __( 'Google+ link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 6,
		)
	);

	/* Pinterest */
	$wp_customize->add_setting(
		'zerif_socials_pinterest',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_pinterest',
		array(
			'label'    => __( 'Pinterest link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 7,
		)
	);

	/* Tumblr */
	$wp_customize->add_setting(
		'zerif_socials_tumblr',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_tumblr',
		array(
			'label'    => __( 'Tumblr link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 8,
		)
	);

	/* Reddit */
	$wp_customize->add_setting(
		'zerif_socials_reddit',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_reddit',
		array(
			'label'    => __( 'Reddit link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 9,
		)
	);

	/* YouTube */
	$wp_customize->add_setting(
		'zerif_socials_youtube',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_youtube',
		array(
			'label'    => __( 'YouTube link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 10,
		)
	);

	/* Instagram */
	$wp_customize->add_setting(
		'zerif_socials_instagram',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zerif_socials_instagram',
		array(
			'label'    => __( 'Instagram link', 'zerif' ),
			'section'  => 'zerif_general_socials_section',
			'priority' => 11,
		)
	);

	/**
	 * ==========
	 * BACKGROUND
	 * ==========
	 */

	$wp_customize->add_panel(
		'panel_background',
		array(
			'priority'       => 40,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Background', 'zerif' ),
		)
	);

	/* Background settings */
	$wp_customize->add_section(
		'zerif_background_settings_section',
		array(
			'title'    => __( 'Background settings', 'zerif' ),
			'priority' => 1,
			'panel'    => 'panel_background',
		)
	);

	$wp_customize->add_setting(
		'zerif_background_settings',
		array(
			'sanitize_callback' => 'zerif_sanitize_background_type',
			'default'           => 'zerif-background-image',
		)
	);

	$wp_customize->add_control(
		'zerif_background_settings',
		array(
			'type'        => 'radio',
			'label'       => __( 'Type of background', 'zerif' ),
			'description' => __( 'Select the type of background you want. <b>Make sure you also set up the images/video in their corresponding places, down below.</b>', 'zerif' ),
			'section'     => 'zerif_background_settings_section',
			'choices'     => array(
				'zerif-background-image'  => __( 'Background image', 'zerif' ),
				'zerif-background-slider' => __( 'Background slider', 'zerif' ),
				'zerif-background-video'  => __( 'Background video', 'zerif' ),
			),
			'priority'    => 1,
		)
	);

	/* Background image */
	$wp_customize->get_section( 'background_image' )->panel    = 'panel_background';
	$wp_customize->get_section( 'background_image' )->priority = 2;

	/* Background slider */
	$wp_customize->add_section(
		'zerif_background_slider_section',
		array(
			'title'    => __( 'Background slider', 'zerif' ),
			'priority' => 3,
			'panel'    => 'panel_background',
		)
	);

	/* slider image 1 */
	$wp_customize->add_setting(
		'zerif_bgslider_1',
		array(
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'zerif_bgslider_1',
			array(
				'label'    => __( 'Image 1', 'zerif' ),
				'section'  => 'zerif_background_slider_section',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting(
		'zerif_vposition_bgslider_1',
		array(
			'default'           => 'top',
			'sanitize_callback' => 'zerif_sanitize_position',
		)
	);

	$wp_customize->add_control(
		'zerif_vposition_bgslider_1',
		array(
			'type'     => 'select',
			'label'    => 'Image Vertical align',
			'section'  => 'zerif_background_slider_section',
			'choices'  => array(
				'top'    => __( 'Top', 'zerif' ),
				'center' => __( 'Center', 'zerif' ),
				'bottom' => __( 'Bottom', 'zerif' ),
			),
			'priority' => 2,
		)
	);

	$wp_customize->add_setting(
		'zerif_hposition_bgslider_1',
		array(
			'default'           => 'left',
			'sanitize_callback' => 'zerif_sanitize_horizontal',
		)
	);

	$wp_customize->add_control(
		'zerif_hposition_bgslider_1',
		array(
			'type'     => 'select',
			'label'    => 'Image Horizontal align',
			'section'  => 'zerif_background_slider_section',
			'choices'  => array(
				'left'   => __( 'Left', 'zerif' ),
				'center' => __( 'Center', 'zerif' ),
				'right'  => __( 'Right', 'zerif' ),
			),
			'priority' => 3,
		)
	);

	$wp_customize->add_setting(
		'zerif_bgsize_bgslider_1',
		array(
			'default'           => 'cover',
			'sanitize_callback' => 'zerif_sanitize_background_size',
		)
	);

	$wp_customize->add_control(
		'zerif_bgsize_bgslider_1',
		array(
			'type'     => 'select',
			'label'    => 'Background size',
			'section'  => 'zerif_background_slider_section',
			'choices'  => array(
				'cover'  => __( 'Cover', 'zerif' ),
				'width'  => __( 'width 100%', 'zerif' ),
				'height' => __( 'Height 100%', 'zerif' ),
			),
			'priority' => 4,
		)
	);

	/* slider image 2 */
	$wp_customize->add_setting(
		'zerif_bgslider_2',
		array(
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'zerif_bgslider_2',
			array(
				'label'    => __( 'Image 2', 'zerif' ),
				'section'  => 'zerif_background_slider_section',
				'priority' => 5,
			)
		)
	);

	$wp_customize->add_setting(
		'zerif_vposition_bgslider_2',
		array(
			'default'           => 'top',
			'sanitize_callback' => 'zerif_sanitize_position',
		)
	);

	$wp_customize->add_control(
		'zerif_vposition_bgslider_2',
		array(
			'type'     => 'select',
			'label'    => 'Image Vertical align',
			'section'  => 'zerif_background_slider_section',
			'choices'  => array(
				'top'    => __( 'Top', 'zerif' ),
				'center' => __( 'Center', 'zerif' ),
				'bottom' => __( 'Bottom', 'zerif' ),
			),
			'priority' => 6,
		)
	);

	$wp_customize->add_setting(
		'zerif_hposition_bgslider_2',
		array(
			'default'           => 'left',
			'sanitize_callback' => 'zerif_sanitize_horizontal',
		)
	);

	$wp_customize->add_control(
		'zerif_hposition_bgslider_2',
		array(
			'type'     => 'select',
			'label'    => 'Image Horizontal align',
			'section'  => 'zerif_background_slider_section',
			'choices'  => array(
				'left'   => __( 'Left', 'zerif' ),
				'center' => __( 'Center', 'zerif' ),
				'right'  => __( 'Right', 'zerif' ),
			),
			'priority' => 7,
		)
	);

	$wp_customize->add_setting(
		'zerif_bgsize_bgslider_2',
		array(
			'default'           => 'cover',
			'sanitize_callback' => 'zerif_sanitize_background_size',
		)
	);

	$wp_customize->add_control(
		'zerif_bgsize_bgslider_2',
		array(
			'type'     => 'select',
			'label'    => 'Background size',
			'section'  => 'zerif_background_slider_section',
			'choices'  => array(
				'cover'  => __( 'Cover', 'zerif' ),
				'width'  => __( 'width 100%', 'zerif' ),
				'height' => __( 'Height 100%', 'zerif' ),
			),
			'priority' => 8,
		)
	);

	/* slider image 3 */
	$wp_customize->add_setting(
		'zerif_bgslider_3',
		array(
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'zerif_bgslider_3',
			array(
				'label'    => __( 'Image 3', 'zerif' ),
				'section'  => 'zerif_background_slider_section',
				'priority' => 9,
			)
		)
	);

	$wp_customize->add_setting(
		'zerif_vposition_bgslider_3',
		array(
			'sanitize_callback' => 'zerif_sanitize_position',
			'default'           => 'top',
		)
	);

	$wp_customize->add_control(
		'zerif_vposition_bgslider_3',
		array(
			'type'     => 'select',
			'label'    => 'Image Vertical align',
			'section'  => 'zerif_background_slider_section',
			'choices'  => array(
				'top'    => __( 'Top', 'zerif' ),
				'center' => __( 'Center', 'zerif' ),
				'bottom' => __( 'Bottom', 'zerif' ),
			),
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'zerif_hposition_bgslider_3',
		array(
			'sanitize_callback' => 'zerif_sanitize_horizontal',
			'default'           => 'left',
		)
	);

	$wp_customize->add_control(
		'zerif_hposition_bgslider_3',
		array(
			'type'     => 'select',
			'label'    => 'Image Horizontal align',
			'section'  => 'zerif_background_slider_section',
			'choices'  => array(
				'left'   => __( 'Left', 'zerif' ),
				'center' => __( 'Center', 'zerif' ),
				'right'  => __( 'Right', 'zerif' ),
			),
			'priority' => 11,
		)
	);

	$wp_customize->add_setting(
		'zerif_bgsize_bgslider_3',
		array(
			'default'           => 'cover',
			'sanitize_callback' => 'zerif_sanitize_background_size',
		)
	);

	$wp_customize->add_control(
		'zerif_bgsize_bgslider_3',
		array(
			'type'     => 'select',
			'label'    => 'Background size',
			'section'  => 'zerif_background_slider_section',
			'choices'  => array(
				'cover'  => __( 'Cover', 'zerif' ),
				'width'  => __( 'width 100%', 'zerif' ),
				'height' => __( 'Height 100%', 'zerif' ),
			),
			'priority' => 12,
		)
	);

	/* Video Background */
	$wp_customize->add_section(
		'zerif_background_video_section',
		array(
			'title'    => __( 'Background Video', 'zerif' ),
			'priority' => 4,
			'panel'    => 'panel_background',
		)
	);

	/* Video */
	$wp_customize->add_setting(
		'zerif_background_video',
		array(
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Upload_Control(
			$wp_customize,
			'zerif_background_video',
			array(
				'label'       => __( 'Video file', 'zerif' ),
				'description' => __( 'mp4 format file <br/> Note: Video background doesn\'t work on mobile devices.', 'zerif' ),
				'section'     => 'zerif_background_video_section',
				'priority'    => 1,
			)
		)
	);

	/* Thumbnail */
	$wp_customize->add_setting(
		'zerif_background_video_thumbnail',
		array(
			'sanitize_callback' => 'esc_url',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'zerif_background_video_thumbnail',
			array(
				'label'       => __( 'Video thumbnail', 'zerif' ),
				'description' => __( 'This image will appear while the video is downloading. If this is not included, the first frame of the video will be used instead.', 'zerif' ),
				'section'     => 'zerif_background_video_section',
				'priority'    => 2,
			)
		)
	);

	/* zerif_enable_video_sound_title */
	$wp_customize->add_setting(
		'zerif_enable_video_sound_title',
		array(
			'sanitize_callback' => 'zerif_sanitize_pro_version',
		)
	);
	$wp_customize->add_control(
		new Zerif_Video_Sound(
			$wp_customize,
			'zerif_enable_video_sound_title',
			array(
				'section'  => 'zerif_background_video_section',
				'priority' => 3,
			)
		)
	);

	/* zerif_enable_video_sound */
	$wp_customize->add_setting(
		'zerif_enable_video_sound',
		array(
			'sanitize_callback' => 'zerif_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zerif_enable_video_sound',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable sound', 'zerif' ),
			'section'  => 'zerif_background_video_section',
			'priority' => 4,
		)
	);
}

add_action( 'customize_register', 'zerif_customize_register_with_panels' );
