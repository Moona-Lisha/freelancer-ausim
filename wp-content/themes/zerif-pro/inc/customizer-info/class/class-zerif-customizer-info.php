<?php
/**
 * Customizer info main class.
 *
 * @package zerif pro
 */

/**
 * Pro customizer section.
 *
 * @access public
 */
class Zerif_Customizer_Info extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'customizer-info';

	/**
	 * Label text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $section_text = '';

	/**
	 * Plugin slug for which to create install button.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $slug = '';

	/**
	 * Hide notice.
	 *
	 * @since  1.1.34
	 * @access public
	 * @var    string
	 */
	public $hide_notice = false;

	/**
	 * Screen reader text on dismiss button.
	 *
	 * @since  1.1.34
	 * @access public
	 * @var    string
	 */
	public $button_screenreader = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function json() {
		$json                        = parent::json();
		$json['section_text']        = $this->section_text;
		$json['hide_notice']         = $this->hide_notice;
		$json['button_screenreader'] = $this->button_screenreader;
		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() {
		?>
		<# if ( !data.hide_notice ) { #>
			<li id="accordion-section-{{ data.id }}" class="zerif-notice accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<button type="button" class="notice-dismiss" style="z-index: 1;">
						<span class="screen-reader-text">
							<# if ( data.section_text ) { #>
								{{data.$button_screenreader}}
							<# } #>
						</span>
				</button>
				<h4 class="accordion-section-title" style="padding-right: 36px">
					<# if ( data.section_text ) { #>
						{{{data.section_text}}}
					<# } #>
				</h4>

			</li>
		<# } #>
		<?php
	}

}
