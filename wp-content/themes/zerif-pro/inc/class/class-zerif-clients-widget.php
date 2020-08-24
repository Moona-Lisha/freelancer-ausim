<?php
/**
 * Zerif Clients widget
 *
 * @package zerif
 */

if ( ! class_exists( 'zerif_clients_widget' ) ) {

	/**
	 * Class zerif_clients_widget
	 */
	class zerif_clients_widget extends WP_Widget {

		/**
		 * Form tools
		 *
		 * @var array
		 */
		private $form_tools;

		/**
		 * Zerif_clients_widget constructor.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'                   => 'zerif_clients',
				'customize_selective_refresh' => true,
				'description'                 => 'Zerif - Clients widget',
			);

			parent::__construct( 'zerif_clients-widget', 'Zerif - Clients widget', $widget_ops );
			$this->form_tools = new Zerif_Widget_Form_Tools( $this );
			add_action( 'admin_enqueue_scripts', array( $this, 'upload_scripts' ) );
			add_action( 'admin_enqueue_styles', array( $this, 'upload_styles' ) );
		}

		/**
		 * Upload the Javascripts for the media uploader
		 */
		public function upload_scripts( $hook ) {
			if ( $hook != 'widgets.php' ) {
				return;
			}
			wp_enqueue_media();
			wp_enqueue_script( 'zerif_widget_media_script', get_template_directory_uri() . '/js/widget-media.js', false, ZERIF_VERSION, true );

		}

		/**
		 * Add the styles for the upload media box
		 */
		public function upload_styles( $hook ) {
			if ( $hook != 'widgets.php' ) {
				return;
			}
			wp_enqueue_style( 'thickbox' );
		}

		/**
		 * Build the widget
		 */
		public function widget( $args, $instance ) {

			$zerif_accessibility = get_theme_mod( 'zerif_accessibility' );

			$new_tab = '';
			if ( isset( $instance['new_tab'] ) && ( $instance['new_tab'] == 'on' ) ) {
				$new_tab = 'target="_blank"';
			}

			if ( ! empty( $args['before_widget'] ) ) {
				echo $args['before_widget'];
			}

			$zerif_widget_image = '';

			if ( ! empty( $instance['image_uri'] ) && ( preg_match( '/(\.jpg|\.png|\.jpeg|\.gif|\.bmp)$/', $instance['image_uri'] ) ) ) {

				$zerif_widget_image = apply_filters( 'wpml_translate_single_string', $instance['image_uri'], 'Widgets', $instance['image_uri'] );

			} elseif ( ! empty( $instance['image_in_customizer'] ) ) {

				$zerif_widget_image = apply_filters( 'wpml_translate_single_string', $instance['image_in_customizer'], 'Widgets', $instance['image_in_customizer'] );

			}

			if ( ! empty( $zerif_widget_image ) ) {
				if ( ! empty( $instance['link'] ) ) { ?>
					<a href="<?php echo apply_filters( 'widget_title', $instance['link'] ); ?>" <?php echo $new_tab; ?>>
						<?php
						if ( isset( $zerif_accessibility ) && $zerif_accessibility == 1 ) {
							?>
							<span class="screen-reader-text"><?php _e( 'Go to', 'zerif' ); ?><?php echo apply_filters( 'widget_title', $instance['title'] ); ?></span>
							<?php
						}
						?>
						<img src="<?php echo esc_url( $zerif_widget_image ); ?>" alt="
												<?php
												if ( ! empty( $instance['title'] ) ) :
													echo esc_html( $instance['title'] );
endif;
												?>
">
					</a>
					<?php
				} else {
					?>
					<img src="<?php echo esc_url( $zerif_widget_image ); ?>" alt="
											<?php
											if ( ! empty( $instance['title'] ) ) :
												echo esc_html( $instance['title'] );
endif;
											?>
"/>
					<?php
				}
			}

			if ( ! empty( $args['after_widget'] ) ) {
				echo $args['after_widget'];
			}

		}

		/**
		 * Update widget
		 *
		 * @param array $new_instance New instance.
		 * @param array $old_instance Old instance.
		 *
		 * @return mixed
		 */
		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title'] = strip_tags( $new_instance['title'] );

			$instance['link'] = strip_tags( $new_instance['link'] );

			$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );

			$instance['new_tab'] = strip_tags( $new_instance['new_tab'] );

			$instance['image_in_customizer'] = strip_tags( $new_instance['image_in_customizer'] );

			return $instance;

		}

		/**
		 * Form the widget
		 *
		 * @param object $instance Instance.
		 */
		public function form( $instance ) {
			$form_tools = $this->form_tools;

			$form_tools->input_text(
				$instance,
				array(
					'sanitize'      => 'wp_kses_post',
					'instance_name' => 'title',
					'label'         => __( 'Alt Title', 'zerif' ),
				)
			);

			$form_tools->input_text(
				$instance,
				array(
					'sanitize'      => 'esc_url',
					'instance_name' => 'link',
					'label'         => __( 'Link', 'zerif' ),
				)
			);

			$form_tools->input_text(
				$instance,
				array(
					'type'          => 'checkbox',
					'instance_name' => 'new_tab',
				)
			);

			$form_tools->image_control( $instance );

		}
	}
}// End if().
