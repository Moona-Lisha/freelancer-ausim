<?php
/**
 * Main class for the plugin install control.
 *
 * @package    Zerif
 * @since      1.8.8.7
 * @author     Cristian Ungureanu <cristian@themeisle.com>
 * @copyright  Copyright (c) 2017, Themeisle
 * @link       http://themeisle.com/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Class Zerif_Plugin_Install
 *
 * @since  1.8.8.7
 * @access public
 */
class Zerif_Plugin_Install extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'plugin-install';

	/**
	 * WP.org plugin id.
	 *
	 * @access public
	 * @var    mixed
	 */
	public $plugin = false;

	/**
	 * Plugin path.
	 *
	 * @access public
	 * @var    string
	 */
	public $path = '';

	/**
	 * Plugin details
	 *
	 * This appears after the plugin is installed.
	 *
	 * @var string
	 */
	public $details = '';

	/**
	 * The link where the user should be redirected after plugin install.
	 *
	 * @var string
	 */
	public $redirect_after_install = '';

	/**
	 * State of plugin installation
	 *
	 * @var string
	 */
	private $state = '';

	/**
	 * Activate nonce.
	 *
	 * @var string
	 */
	private $activate_nonce = '';

	/**
	 * Zerif_Plugin_Install constructor.
	 *
	 * @param WP_Customize_Manager $manager Customize manager object.
	 * @param string               $id Control id.
	 * @param array                $args Control arguments.
	 */
	public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( empty( $this->path ) ) {
			return;
		}

		$this->state = $this->check_plugin_state();

		$this->activate_nonce = add_query_arg(
			array(
				'action'        => 'activate',
				'plugin'        => rawurlencode( $this->path ),
				'plugin_status' => 'all',
				'paged'         => '1',
				'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $this->path ),
			),
			network_admin_url( 'plugins.php' )
		);

	}

	/**
	 * Check plugin state.
	 *
	 * @return string
	 */
	private function check_plugin_state() {
		if ( file_exists( ABSPATH . 'wp-content/plugins/' . $this->path ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			return is_plugin_active( $this->path ) ? 'deactivate' : 'activate';
		} else {
			return 'install';
		}
	}

	/**
	 *  Loads the framework scripts/styles.
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		if ( ! empty( $this->plugin ) ) {
			wp_enqueue_script( 'zerif-customizer-install-plugin', get_template_directory_uri() . '/inc/customizer/controls/ui/customizer-plugin-install/script.js', array( 'jquery' ), ZERIF_VERSION, true );
			wp_localize_script(
				'zerif-customizer-install-plugin',
				'zerif_plugin_install',
				array(
					'install_message'  => esc_html__( 'Installing...', 'zerif' ),
					'activate_message' => esc_html__( 'Activating...', 'zerif' ),
					'activate_nonce'   => $this->activate_nonce,
					'redirect_link'    => $this->redirect_after_install,
				)
			);
		}
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @access public
	 * @return array
	 */
	public function json() {
		$json                 = parent::json();
		$json['plugin']       = $this->plugin;
		$json['state']        = $this->state;
		$json['details']      = $this->details;
		$json['button_label'] = ucfirst( $this->state );
		return $json;
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.1.40
	 * @access public
	 * @return void
	 */
	public function content_template() {
		?>
		<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
		</label>

		<# if ( data.state && !_(data.state).isEqual('deactivate')) { #>
			<# if ( data.description ) { #>
				<div class="plugin-install-main-description">
					{{{ data.description }}}
				</div>
			<# } #>
			<button data-slug="{{data.plugin}}" class="{{data.state}}-plugin button button-primary" style="margin-top: 8px" >{{data.button_label}}</button>
		<# } else { #>

			<# if ( data.details ) { #>
				<# if ( !data.details.check && data.details.link && data.details.label ) { #>
					<hr>
					<div class="plugin-install-main-details">
						{{{ data.details.description }}}
					</div>
					<a target="_blank" href="{{data.details.link}}" class="button" style="margin-top: 8px">{{data.details.label}}</a>
				<# } #>
			<# }
		}#>
		<?php
	}
}
