<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */
?>
<?php global $road_opt; ?>
			<?php
			if ( !isset($road_opt['footer_layout']) || $road_opt['footer_layout']=='default' ) {
				get_footer('first');
			} else {
				get_footer($road_opt['footer_layout']);
			}
			?>
		</div><!-- .page -->
	</div><!-- .wrapper -->
	<!--<div class="road_loading"></div>-->
	<div id="back-top" class="hidden-xs hidden-sm hidden-md"></div>
	<?php
	if ( isset($road_opt['newsletter_form']) && $road_opt['newsletter_form']!="" ) {
		if(class_exists( 'WYSIJA_NL_Widget' )){ ?>
			<div class="popupshadow"></div>
			<div class="newsletterpopup">
				<span class="close-popup"></span>
				<div class="nl-bg">
					<?php
					the_widget('WYSIJA_NL_Widget', array(
						'title' => esc_html($road_opt['newsletter_title']),
						'form' => (int)$road_opt['newsletter_form'],
						'id_form' => 'newsletter1_popup',
						'success' => '',
					));
					?>
					<?php if(isset($road_opt['social_icons'])) { ?>
						<div class="nl-follow">
							<h3><?php _e('Follow Us', 'roadthemes'); ?></h3>
							<?php
								echo '<ul class="social-icons">';
								foreach($road_opt['social_icons'] as $key=>$value ) {
									if($value!=''){
										if($key=='vimeo'){
											echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';
										} else {
											echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-'.esc_attr($key).'"></i></a></li>';
										}
									}
								}
								echo '</ul>'; ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php }
	}
	?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie8.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_footer(); ?>
</body>
</html>