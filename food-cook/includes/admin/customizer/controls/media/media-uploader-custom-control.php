<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom tags control
 */
class Media_Uploader_Custom_control extends WP_Customize_Control {

    public function __construct( $manager, $id, $args ) {
        parent::__construct( $manager, $id, $args );
    }

	public function enqueue() {
		wp_enqueue_style('media-upload');
		wp_enqueue_style('thickbox');
		wp_register_script( 'customize-media-uploader', get_template_directory_uri().'/includes/assets/js/admin/customizer-media-uploader.js', array('jquery', 'media-upload', 'thickbox', 'wp-plupload'), false, true);
		wp_localize_script('customize-media-uploader', '_uploader', array('id' => $this->id) );
		wp_enqueue_script( 'customize-media-uploader' );
	}

	public function render_content() {
			$src = $this->value();
			if( isset( $this->get_url ) )
				$src = $this->get_url;
			?>
    <div id="md-upload-wrap" class="customize-media-uploader">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

			<a class="button-secondary" id="media-uploader" href="#">Upload</a>
			<div class="md-upload-current-image">
	            <input <?php $this->link(); ?> type="hidden" value="<?php echo $src; ?>">
            	<div>
						<?php if ( empty( $src ) ):
							$style = "display:none;";
						else:
							$style = "display:inline-block;";
						?>
							<img src="<?php echo esc_url( set_url_scheme( $src ) ); ?>">
						<?php endif; ?>
                 </div>
            </div>
			<a href="#" class="btn-remove" style="<?php echo $style; ?>">Remove</a>
	</div>
            <?php
		}


}





