<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_one_feature_post_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_one_feature_post_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "One Feature Post", 'crazyblog' ),
				"base" => "crazyblog_one_feature_post",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/one-features-post.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "dropdown",
						
						"class" => "",
						"heading" => esc_html__( 'Feature Post', 'crazyblog' ),
						"param_name" => "feature_post",
						"value" => crazyblog_get_posts_array( 'post', true ),
						"description" => esc_html__( 'Choose one feature post to show', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						
						"class" => "",
						"heading" => esc_html__( "Show Content", 'crazyblog' ),
						"param_name" => "content",
						"value" => array_flip( array( 'true' => esc_html__( 'True', 'crazyblog' ), 'false' => esc_html__( 'False', 'crazyblog' ) ) ),
						"description" => esc_html__( "Hide/Show Post Content", 'crazyblog' )
					),
					array(
						"type" => "textfield",
						
						"class" => "",
						"heading" => esc_html__( 'Content Limit', 'crazyblog' ),
						"param_name" => "limit",
						"description" => esc_html__( 'Enter character limit for post description.', 'crazyblog' ),
						'dependency' => array(
							'element' => 'content',
							'value' => array( 'true' )
						),
					),
				)
			);
		}
	}

	public static function crazyblog_one_feature_post( $atts, $contents = null ) {

		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';

		ob_start();

		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'p' => $feature_post,
		);



		$query = new WP_Query( $args );

		$year = get_the_time( 'Y' );

		$month = get_the_time( 'm' );

		$day = get_the_time( 'd' );

		$counter = 0;

		$size = '';
		?>



		<div class="row">

			<div class="texty-style ">

				<?php
				if ( $query->have_posts() ) : while ( $query->have_posts() ): $query->the_post();

						$post_cols = "col-md-12";

						$size = 'crazyblog_1170x590';

						$show_conents = $content;

						$format = get_post_format( get_the_ID() );

						if ( $format == "gallery" ) {

							include crazyblog_ROOT . "core/application/library/formats/uneven_posts_list/gallery.php";
						} else {

							include crazyblog_ROOT . "core/application/library/formats/uneven_posts_list/image.php";
						}
						?>

						<?php
						$counter++;
					endwhile;
					wp_reset_postdata();
				endif;
				?>

			</div>

		</div>



		<?php
		$output = ob_get_contents();

		ob_clean();

		return $output;
	}

}
