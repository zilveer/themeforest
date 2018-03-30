<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_lightbox_gallery_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_lightbox_gallery_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Lightbox Gallery", 'crazyblog' ),
				"base" => "crazyblog_lightbox_gallery_output",
				"icon" => crazyblog_URI . '',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "attach_images",
						"class" => "",
						"heading" => esc_html__( 'Upload Images', 'crazyblog' ),
						"param_name" => "images",
						"description" => esc_html__( 'Upload images for gallery', 'crazyblog' )
					),
				),
			);
		}
	}

	public static function crazyblog_lightbox_gallery_output( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$image = explode( ',', $images );
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-poptrox' ) );
		$counter = 0;
		$counter2 = 0;
		$total = count( $image );
		?>
		<div class="famous-images lightbox">
			<ul class="img-row">
				<?php
				if ( !empty( $image ) && count( $image ) > 0 ) {
					foreach ( $image as $i ) {
						$src = wp_get_attachment_image_src( $i, 'crazyblog_376x350' );
						$full = wp_get_attachment_image_src( $i, 'full' );
						echo '<li><a href="' . esc_url(crazyblog_set( $full, '0' ) ). '" title=""><i class="fa fa-search"></i></a><img title="' . get_the_title( $i ) . '" src="' . esc_url(crazyblog_set( $src, '0' )) . '" alt="" /></li>';
						$counter++;
						$counter2++;
						if ( $counter == 5 && $counter2 != $total ) {
							echo '</ul><ul class="img-row">';
							$counter = 0;
						}
					}
				}
				?>
			</ul>
		</div>
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
