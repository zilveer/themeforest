<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_big_search_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_big_search_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Big Search", 'crazyblog' ),
				"base" => "crazyblog_big_search_outpupt",
				"icon" => crazyblog_URI . '',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "attach_image",
						"heading" => esc_html__( 'Backgroun Image', 'crazyblog' ),
						"param_name" => "bg",
						"description" => esc_html__( 'Upload background Image for this section', 'crazyblog' )
					),
					array(
						"type" => "attach_image",
						"heading" => esc_html__( 'Upload Icon', 'crazyblog' ),
						"param_name" => "icon",
						"description" => esc_html__( 'Upload Icon images for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Title', 'crazyblog' ),
						"param_name" => "title",
						"description" => esc_html__( 'Enter the title for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Sub Title', 'crazyblog' ),
						"param_name" => "sub_title",
						"description" => esc_html__( 'Enter the sub title for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Button Text', 'crazyblog' ),
						"param_name" => "btn_txt",
						"value" => esc_html__( 'Search', 'crazyblog' ),
						"description" => esc_html__( 'Enter the search button text', 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_big_search_outpupt( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		?>
		<div class="big-search">
			<?php
			if ( !empty( $bg ) ) {
				$bg_src = wp_get_attachment_image_src( $bg, 'full' );
				echo '<img src="' . crazyblog_set( $bg_src, '0' ) . '" alt="" />';
			}
			?>
			<div class="big-search-text">
				<?php
				if ( !empty( $icon ) ) {
					$icon_src = wp_get_attachment_image_src( $icon, 'full' );
					echo '<img src="' . esc_url(crazyblog_set( $icon_src, '0' ) ). '" alt="" />';
				}
				?>
				<span><?php echo wp_kses_post( $title ) ?></span>
				<strong><?php echo wp_kses_post( $sub_title ) ?></strong>
				<div class="big-search-form">
					<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
						<input name="s" type="text" placeholder="<?php esc_html_e( 'Search Here Post', 'crazyblog' ) ?>" />
						<button><?php echo esc_html( $btn_txt ) ?></button>
					</form>
				</div>
			</div>
		</div>
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
