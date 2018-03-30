	<?php $bottom_widget_layout = ot_get_option('js_footer_widget_layout');
	
	if ($bottom_widget_layout != 'none'){
		
		if (is_active_sidebar('bottom-footer-1') || is_active_sidebar('bottom-footer-2') || is_active_sidebar('bottom-footer-3')){
			
			?><section id="footer-widgets">
				<div class="overlay">
					<div class="shell clearfix">
					
						<?php if (is_active_sidebar('bottom-footer-1') || is_active_sidebar('bottom-footer-2') || is_active_sidebar('bottom-footer-3')){
							
							switch ($bottom_widget_layout) {
						
								case '1' :
								
									if (is_active_sidebar('bottom-footer-1')){
										
										dynamic_sidebar('bottom-footer-1');
										
									}
								
								break;
								
								case '2' :
								
									if (is_active_sidebar('bottom-footer-1') || is_active_sidebar('bottom-footer-2')){
										
										echo '<div class="one_half">';
											dynamic_sidebar('bottom-footer-1');
										echo '</div>';
										
										echo '<div class="one_half last">';
											dynamic_sidebar('bottom-footer-2');
										echo '</div>';
										
									}
								
								break;
								
								case '3' :
								
									if (is_active_sidebar('bottom-footer-1') || is_active_sidebar('bottom-footer-2') || is_active_sidebar('bottom-footer-3')){
										
										echo '<div class="one_third">';
											dynamic_sidebar('bottom-footer-1');
										echo '</div>';
										
										echo '<div class="one_third">';
											dynamic_sidebar('bottom-footer-2');
										echo '</div>';
										
										echo '<div class="one_third last">';
											dynamic_sidebar('bottom-footer-3');
										echo '</div>';
										
									}
								
								break;
								
							}
						
						} ?>
					</div>
				</div>
			</section><?php
		}
	}
	
	$hide_espresso_footer = ot_get_option('hide_espresso_footer');
	if (!$hide_espresso_footer){
	
		$footer_left_content = ot_get_option('footer_left_content');
		$footer_right_content = ot_get_option('footer_right_content');
		$footer_left_text = ot_get_option('footer_left_text');
		$footer_right_text = ot_get_option('footer_right_text');
	
		?><footer class="clearfix">
			<div class="shell">
			
				<?php if ($footer_left_content == 'address_phone'):
				
					$location = array();
					if (ot_get_option('address')): $location['address'] = ot_get_option('address'); endif;
					if (ot_get_option('phone')): $location['phone'] = ot_get_option('phone'); endif;
					
					if (!empty($location)):
					
						?><section class="left location"><?php	
							foreach($location as $type => $text){
								echo '<span class="iconed-'.$type.'">'.$text.'</span>';
							}
						?></section><?php
					 
					endif;
				else : ?>
					<section class="left">
						<?php echo str_replace('[year]',date('Y'),$footer_left_text); ?>
					</section>
				<?php endif; ?>
				
				<?php if ($footer_right_content == 'socials_search'):
					
					es_social_search();
					
				else : ?>
					<section class="right">
						<?php echo str_replace('[year]',date('Y'),$footer_right_text); ?>
					</section>
				<?php endif; ?>
				
			</div>
		</footer><?php

	}
	
	global $boxed_style;
	if ($boxed_style): echo '</div>'; endif;
	
	$disable_responsive = ot_get_option('disable_responsive',false);
	$sticky_navigation = ot_get_option('sticky_navigation');
	$sticky_navigation = is_array($sticky_navigation) ? $sticky_navigation[0] : false; 
	if ($sticky_navigation && !$disable_responsive) :
		echo '<script>var sticky_nav = true;</script>';
	else :
		echo '<script>var sticky_nav = false;</script>';
	endif;
	
	?><script type="text/javascript">var templateDir = "<?php echo get_template_directory_uri(); ?>"; blurSliderStyle = "<?php echo ot_get_option('blur_slider_style','blur'); ?>";</script><?php
	
	wp_footer(); ?>

</body>
</html>