<?php if(! defined('ABSPATH')){ return; }

/**
 * Perform an action where we can hook before the footer content
 */
do_action('zn_before_footer');

$style = "";
$show_footer = zget_option( 'footer_show', 'general_options', false, 'yes' );
if( is_singular() && get_post_meta( get_the_ID() , 'show_footer', true ) === 'zn_dummy_value') {
	$show_footer = 'no';
	if ( ZNPB()->is_active_editor ){
		$show_footer = 'yes';
		$style = ' style="display:none" ';
	}
}

/* Should we display a template ? */
$config = zn_get_pb_template_config( 'footer' );
if( $config['template'] !== 'no_template' ){
	// We have a subheader template... let's get it's possition
	$pb_data = get_post_meta( $config['template'], 'zn_page_builder_els', true );

	if( $config['location'] === 'before' ){
		echo '<div class="znpb-footer-smart-area" '. $style .'>';
			ZNPB()->zn_render_uneditable_content( $pb_data, $config['template'] );
		echo '</div>';
	}
	elseif( $config['location'] === 'replace' && $show_footer == 'yes' ){
		echo '<div class="znpb-footer-smart-area" '. $style .'>';
			ZNPB()->zn_render_uneditable_content( $pb_data, $config['template'] );
		echo '</div>';
		$show_footer = 'no';
	}

}

if ( $show_footer == 'yes' ) { ?>
	<footer id="footer" class="site-footer" <?php echo $style;?> <?php echo WpkPageHelper::zn_schema_markup('footer'); ?>>
		<div class="container">
			<?php

				if ( zget_option( 'footer_row1_show', 'general_options', false, 'yes' ) == 'yes' ) {

					echo '<div class="row">';

					$footer_row1_widget_positions = zget_option( 'footer_row1_widget_positions', 'general_options', false, '{"3":[["4","4","4"]]}' );
					$columns_array = json_decode( stripslashes( $footer_row1_widget_positions ), true );
					$number_of_columns = is_array( $columns_array ) ? key( $columns_array ) : 1;

					for ( $i = 1; $i <= $number_of_columns; $i ++ ) {
						echo '<div class="col-sm-' . $columns_array[ $number_of_columns ][0][ $i - 1 ] . '">';
						if ( ! dynamic_sidebar( 'Footer row 1 - widget ' . $i . '' ) ) : endif;
						echo '</div>';
					}

					echo '</div><!-- end row -->';
				}


				if ( zget_option( 'footer_row2_show', 'general_options', false, 'yes' ) == 'yes' ) {

					echo '<div class="row">';

					$footer_row2_widget_positions = zget_option( 'footer_row2_widget_positions', 'general_options', false, '{"3":[["4","4","4"]]}' );
					$columns_array = json_decode( stripslashes( $footer_row2_widget_positions ), true );
					$number_of_columns = is_array( $columns_array ) ? key( $columns_array ) : 1;

					for ( $i = 1; $i <= $number_of_columns; $i ++ ) {
						echo '<div class="col-sm-' . $columns_array[ $number_of_columns ][0][ $i - 1 ] . '">';
						if ( ! dynamic_sidebar( 'Footer row 2 - widget ' . $i . '' ) ) : endif;
						echo '</div>';
					}

					echo '</div><!-- end row -->';
				}

			?>

			<div class="row">
				<div class="col-sm-12">
					<div class="bottom site-footer-bottom clearfix">

						<?php
						// Footer menu
						if ( has_nav_menu( 'footer_navigation' ) ) {
							echo '<div class="zn_footer_nav-wrapper">';
								zn_show_nav( 'footer_navigation', 'footer_nav', array( 'depth' => '2' ) );
							echo '</div>';
						}
						?>

						<?php

						if ( zget_option( 'footer_social_icons_enable', 'general_options', false, 'yes' ) == 'yes' )
						{
							$footer_social_icons = zget_option( 'footer_social_icons', 'general_options', false, array() );
							if ( ! empty ( $footer_social_icons ) ) {

								$icon_class = zget_option( 'footer_which_icons_set', 'general_options', false, 'normal' );

								echo '<ul class="social-icons sc--' . $icon_class . ' clearfix">';
									echo '<li class="social-icons-li title">' . __( 'GET SOCIAL', 'zn_framework' ) . '</li>'; // Translate

									foreach ( $footer_social_icons as $key => $icon ) {

										$link   = '';
										$target = '';

										if ( isset ( $icon['footer_social_link'] ) && is_array( $icon['footer_social_link'] ) ) {
											$link   = $icon['footer_social_link']['url'];
											$target = 'target="' . $icon['footer_social_link']['target'] . '"';
										}
										$icon_color = '';
										if($icon_class != 'normal' && $icon_class != 'clean'){
											$icon_color = isset($icon['footer_social_color']) && !empty($icon['footer_social_color']) ? $icon['footer_social_icon']['unicode'] : 'nocolor';
										}
										$social_icon = !empty( $icon['footer_social_icon'] )  ? '<a '.zn_generate_icon( $icon['footer_social_icon'] ).' href="' . $link . '" ' . $target . ' title="' . $icon['footer_social_title'] . '" class="social-icons-item scfooter-icon-'.$icon_color.'"></a>' : '';
										echo '<li class="social-icons-li">'.$social_icon.'</li>';
										//echo '<li><a class="sc-icon-' . str_replace('social-', '', $icon['footer_social_icon']) . '" href="' . $link . '" ' . $target . ' title="' . $icon['footer_social_title'] . '"></a></li>';
									}

								echo '</ul>';
							}
						}
						?>

						<?php
						$copyright_text = zget_option( 'copyright_text', 'general_options' );
						$footer_logo = zget_option( 'footer_logo', 'general_options' );
						if ( !empty( $copyright_text ) || !empty( $footer_logo ) ) { ?>

							<div class="copyright footer-copyright">
								<?php
									if ( !empty( $footer_logo ) ) {
										echo '<a href="' . home_url() . '" class="footer-copyright-link"><img class="footer-copyright-img" src="' . $footer_logo . '" '.ZngetImageSizesFromUrl($footer_logo, true).' alt="' . get_bloginfo( 'name' ) . '" /></a>';
									}

									if ( !empty( $copyright_text ) ) {
										echo '<p class="footer-copyright-text">' . do_shortcode(stripslashes( $copyright_text )) . '</p>';
									}
								?>
							</div><!-- end copyright -->
						<?php } ?>
					</div>
					<!-- end bottom -->
				</div>
			</div>
			<!-- end row -->
		</div>
	</footer>
<?php
}

if( $config['template'] !== 'no_template' && $config['location'] === 'after' ){
	echo '<div class="znpb-footer-smart-area" '. $style .'>';
		ZNPB()->zn_render_uneditable_content( $pb_data, $config['template'], 'znpb-footer-smart-area' );
	echo '</div>';
}

?>
</div><!-- end page_wrapper -->

<a href="#" id="totop" class="u-trans-all-2s js-scroll-event" data-forch="300" data-visibleclass="on--totop"><?php echo __( 'TOP', 'zn_framework' ); ?></a>
<!-- <a href="#" id="totop" class="u-trans-all-2s " ><?php echo __( 'TOP', 'zn_framework' ); ?></a> -->
<?php zn_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>
