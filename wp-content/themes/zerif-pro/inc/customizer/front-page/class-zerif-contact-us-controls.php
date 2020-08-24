<?php
/**
 * Contact us section's customizer controls
 *
 * @package zerif
 */

/**
 * Class Zerif_Contact_Us_Controls
 */
class Zerif_Contact_Us_Controls extends Zerif_Register_Customizer_Controls {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_contact_us_section();
		$this->add_contact_us_colors_section();
		$this->add_tabs();
		$this->add_settings_controls();
		$this->add_content_controls();
		$this->add_color_controls();
	}

	/**
	 * Add Contact Us section in frontpage sections panel.
	 */
	private function add_contact_us_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_contact_us_section',
				array(
					'title'    => esc_html__( 'Contact us section', 'zerif' ),
					'panel'    => 'zerif_frontpage_sections',
					'priority' => 50,
				)
			)
		);
	}

	/**
	 * Add colors section for Contact us.
	 */
	private function add_contact_us_colors_section() {
		$this->add_section(
			new Zerif_Customizer_Section(
				'zerif_contactus_colors_section',
				array(
					'title'    => esc_html__( 'Contact us', 'zerif' ),
					'panel'    => 'zerif_colors',
					'priority' => 90,
				)
			)
		);
	}

	/**
	 * Add tabs in Contact us section,
	 */
	private function add_tabs() {
		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contact_us_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'zerif_contact_us_section',
					'priority' => 1,
					'tabs'     => array(
						'settings' => array(
							'label' => esc_html__( 'Settings', 'zerif' ),
						),
						'content'  => array(
							'label' => esc_html__( 'Content', 'zerif' ),
						),
					),
					'controls' => array(
						'settings' => array(
							'zerif_contactus_show'      => array(),
							'zerif_contact_shortcode'   => array(),
							'zerif_contactus_email'     => array(),
							'zerif_contactus_recaptcha_show' => array(),
							'zerif_contactus_sitekey'   => array(),
							'zerif_contactus_secretkey' => array(),
						),
						'content'  => array(
							'zerif_contactus_title'        => array(),
							'zerif_contactus_subtitle'     => array(),
							'zerif_contactus_name_placeholder' => array(),
							'zerif_contactus_email_placeholder' => array(),
							'zerif_contactus_subject_placeholder' => array(),
							'zerif_contactus_message_placeholder' => array(),
							'zerif_contactus_button_label' => array(),
						),
					),
				),
				'Zerif_Customize_Control_Tabs'
			)
		);
	}

	/**
	 * Add controls from first tab.
	 */
	private function add_settings_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
					'transport'         => $this->selective_refresh,
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide contact us section?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the Contact us section will disappear from homepage.', 'zerif' ),
					'section'     => 'zerif_contact_us_section',
					'priority'    => 1,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contact_shortcode',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
				),
				array(
					'label'       => esc_html__( 'Contact Form Shortcode', 'zerif' ),
					'description' => esc_html__( 'Or add the shortcode of your choice here.', 'zerif' ),
					'section'     => 'zerif_contact_us_section',
					'priority'    => 2,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_email',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
				),
				array(
					'label'       => esc_html__( 'Email address', 'zerif' ),
					'description' => esc_html__( 'The contact us form is submitted to this email address.', 'zerif' ),
					'section'     => 'zerif_contact_us_section',
					'priority'    => 3,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_recaptcha_show',
				array(
					'sanitize_callback' => 'zerif_sanitize_checkbox',
				),
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide reCaptcha?', 'zerif' ),
					'description' => esc_html__( 'If you check this box, the reCaptcha will not be enabled on the Contact us form.', 'zerif' ),
					'section'     => 'zerif_contact_us_section',
					'priority'    => 4,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_sitekey',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
				),
				array(
					'label'       => esc_html__( 'Site key', 'zerif' ),
					'description' => '<a href="https://www.google.com/recaptcha/admin#list" target="_blank">' . __( 'Create an account here', 'zerif' ) . '</a>' . __( ' to get the Site key and the Secret key for the reCaptcha.', 'zerif' ),
					'section'     => 'zerif_contact_us_section',
					'priority'    => 5,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_secretkey',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
				),
				array(
					'label'    => esc_html__( 'Secret key', 'zerif' ),
					'section'  => 'zerif_contact_us_section',
					'priority' => 6,
				)
			)
		);
	}

	/**
	 * Add controls from second tab.
	 */
	private function add_content_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_title',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Get in touch', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Main title', 'zerif' ),
					'section'  => 'zerif_contact_us_section',
					'priority' => 1,
				),
				null,
				array(
					'selector'        => '#contact .section-header h2',
					'render_callback' => array( $this, 'contactus_title_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_subtitle',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Subtitle', 'zerif' ),
					'section'  => 'zerif_contact_us_section',
					'priority' => 2,
				),
				null,
				array(
					'selector'        => '#contact .section-header h6',
					'render_callback' => array( $this, 'contactus_subtitle_render_callback' ),
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_name_placeholder',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Your Name', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Placeholder for "Your Name" input ', 'zerif' ),
					'section'  => 'zerif_contact_us_section',
					'priority' => 3,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_email_placeholder',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Your Email', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Placeholder for "Your Email" input ', 'zerif' ),
					'section'  => 'zerif_contact_us_section',
					'priority' => 4,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_subject_placeholder',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Subject', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Placeholder for "Subject" input ', 'zerif' ),
					'section'  => 'zerif_contact_us_section',
					'priority' => 5,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_message_placeholder',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Your Message', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Placeholder for "Message" input ', 'zerif' ),
					'section'  => 'zerif_contact_us_section',
					'priority' => 6,
				)
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contactus_button_label',
				array(
					'sanitize_callback' => 'zerif_sanitize_input',
					'default'           => esc_html__( 'Send Message', 'zerif' ),
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Send message button label', 'zerif' ),
					'section'  => 'zerif_contact_us_section',
					'priority' => 7,
				),
				null,
				array(
					'selector'        => '#contact .pirate_forms .contact_submit_wrap',
					'render_callback' => array( $this, 'contactus_button_label_render_callback' ),
				)
			)
		);
	}

	/**
	 * Add color controls.
	 */
	private function add_color_controls() {

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contacus_background',
				array(
					'sanitize_callback' => 'zerif_sanitize_rgba',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_contacus_background_filters', 'rgba(0, 0, 0, 0.5)' ),
				),
				array(
					'label'    => esc_html__( 'Background color', 'zerif' ),
					'palette'  => true,
					'section'  => 'zerif_contactus_colors_section',
					'priority' => 1,
				),
				'Zerif_Customize_Alpha_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contacus_header',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_contacus_header_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Title and subtitle color', 'zerif' ),
					'section'  => 'zerif_contactus_colors_section',
					'priority' => 2,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contacus_button_background',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_contacus_button_background_filter', '#e96656' ),
				),
				array(
					'label'    => esc_html__( 'Submit button background color', 'zerif' ),
					'section'  => 'zerif_contactus_colors_section',
					'priority' => 3,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contacus_button_background_hover',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_contacus_button_background_hover_filter', '#cb4332' ),
				),
				array(
					'label'    => esc_html__( 'Submit button background color - hover', 'zerif' ),
					'section'  => 'zerif_contactus_colors_section',
					'priority' => 4,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contacus_button_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => $this->selective_refresh,
					'default'           => apply_filters( 'zerif_contacus_button_color_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Submit button color', 'zerif' ),
					'section'  => 'zerif_contactus_colors_section',
					'priority' => 5,
				),
				'WP_Customize_Color_Control'
			)
		);

		$this->add_control(
			new Zerif_Customizer_Control(
				'zerif_contacus_button_color_hover',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => apply_filters( 'zerif_contacus_button_color_hover_filter', '#fff' ),
				),
				array(
					'label'    => esc_html__( 'Submit button color - hover', 'zerif' ),
					'section'  => 'zerif_contactus_colors_section',
					'priority' => 6,
				),
				'WP_Customize_Color_Control'
			)
		);
	}

	/**
	 * Render callback for zerif_contactus_title
	 *
	 * @return mixed
	 */
	public function contactus_title_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_contactus_title' ) );
	}

	/**
	 * Render callback for erif_contactus_subtitle
	 *
	 * @return string
	 */
	public function contactus_subtitle_render_callback() {
		return wp_kses_post( get_theme_mod( 'zerif_contactus_subtitle' ) );
	}

	/**
	 * Render callback for zerif_contactus_button_label
	 */
	public function contactus_button_label_render_callback() {
		echo '<button id="pirate-forms-contact-submit" name="pirate-forms-contact-submit" class="pirate-forms-submit-button" type="submit">';
		echo wp_kses_post( get_theme_mod( 'zerif_contactus_button_label' ) );
		echo '</button>';
	}

}
