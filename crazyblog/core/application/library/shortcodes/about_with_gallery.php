<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_about_with_gallery_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_about_with_gallery_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "About with Gallery", 'crazyblog' ),
				"base" => "crazyblog_about_with_gallery",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/About-Us-Custom-Contents.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Gallery Post', 'crazyblog' ),
						"param_name" => "feature_post",
						"value" => crazyblog_get_posts_array( 'crazyblog_gallery', true ),
						"description" => esc_html__( 'Choose one post to show your gallery', 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_about_with_gallery( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';

		$args = array(
			'post_type' => 'crazyblog_gallery',
			'post_status' => 'publish',
			'p' => $feature_post,
		);
		$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); ?>
				<div class="default-template">
					<?php the_content(); ?>
					<div class="image-grids">
						<div class="row">
							<?php
							$meta = get_post_meta( get_the_ID(), 'crazyblog_crazyblog_gallery_meta', true );
							$gallery = explode( ',', crazyblog_set( crazyblog_set( crazyblog_set( $meta, 'galleries_setting' ), '0' ), 'gallery_opt' ) );
							?>
							<?php
							if ( !empty( $gallery ) ):
								foreach ( $gallery as $g ):
									?>
									<div class="col-md-4"><div class="image-grid"><img alt="" src="<?php echo esc_url( wp_get_attachment_url( $g ) ); ?>"></div></div>
											<?php
										endforeach;
									endif;
									?>
						</div>
					</div><!-- Image Grids -->
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
		endif;
		?>
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
