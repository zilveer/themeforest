<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_blog_rules_toggle_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_blog_rules_toggle_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Blog Rules Toggle", 'crazyblog' ),
				"base" => "crazyblog_blog_rules_toggle",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/About-Us-Custom-Contents.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "multiselect",
						"class" => "",
						"heading" => esc_html__( 'Select Rules To show', 'crazyblog' ),
						"param_name" => "rules",
						"value" => crazyblog_rules(),
					),
				)
			);
		}
	}

	public static function crazyblog_blog_rules_toggle( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$settings = crazyblog_opt();
		$rulesToShow = crazyblog_set( crazyblog_set( $settings, 'crazyblog_blog_rules' ), 'crazyblog_blog_rules' );
		array_pop( $rulesToShow );
		$siplit = explode( ',', $rules );
		$siplit2 = explode( ',', $rules );
		$checkAll = array_shift( $siplit );
		if ( $checkAll == 'all' ) {
			$show = $rulesToShow;
		} else {
			$show = array_intersect_key( $siplit2, $rulesToShow );
		}
		if ( !empty( $show ) && count( $show ) > 0 ):
			?>
			<div class="toggle">
				<?php
				foreach ( $rulesToShow as $key => $val ):
					if ( $checkAll != 'all' ) {
						foreach ( $show as $v ) {
							if ( $key == $v ) {
								$title = crazyblog_set( $val, 'title' );
								$desc = crazyblog_set( $val, 'desc' );
								?>
								<div class="toggle-item">
									<h3><?php echo wp_kses_post( $title ) ?></h3>
									<div class="content">
										<p><?php echo wp_kses_post( $desc ) ?></p>
									</div>
								</div>
								<?php
							}
						}
					} else {
						$title = crazyblog_set( $val, 'title' );
						$desc = crazyblog_set( $val, 'desc' );
						?>
						<div class="toggle-item">
							<h3><?php echo wp_kses_post( $title ) ?></h3>
							<div class="content">
								<p><?php echo wp_kses_post( $desc ) ?></p>
							</div>
						</div>
						<?php
					}
					?>
				<?php endforeach; ?>
			</div>
			<?php
		endif;
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
