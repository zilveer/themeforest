
<?php

	//</section><!-- #page .wrapper -->

	
	if(!empty($GLOBALS['indexblog_id'])){
		$get_the_id = $GLOBALS['indexblog_id'];
	}else{
		//$get_the_id = get_the_ID();
		$get_the_id = $GLOBALS['get_the_id'];
	}

	$ub_widget_area_f1 = get_post_meta($get_the_id,'ub_widget_area_f1',true);
	$ub_widget_area_f2 = get_post_meta($get_the_id,'ub_widget_area_f2',true);
	$ub_widget_area_f3 = get_post_meta($get_the_id,'ub_widget_area_f3',true);
	$ub_widget_area_f4 = get_post_meta($get_the_id,'ub_widget_area_f4',true);


	print '	
	<!-- footer -->
	<footer>
		<div id="footer-color">
		<div id="footer-texture"';
		
			$tp_panel_texture = get_option('tp_panel_texture');				
			if(!empty($tp_panel_texture)){
				print ' class="'.$tp_panel_texture.'"';
			}
					
		print '>
			<div class="wrapper">
	';
	
	// check active widget areas
	if(!empty($GLOBALS['indexblog_id'])){
		$tp_default_f4_widget_area = get_option('tp_pages_default_f4_widget_area');
		$tp_default_f3_widget_area = get_option('tp_pages_default_f3_widget_area');
	}else{
		if(is_page()){
			$tp_default_f4_widget_area = get_option('tp_pages_default_f4_widget_area');
			$tp_default_f3_widget_area = get_option('tp_pages_default_f3_widget_area');
		}elseif(is_single()){
			$tp_default_f4_widget_area = get_option('tp_posts_default_f4_widget_area');
			$tp_default_f3_widget_area = get_option('tp_posts_default_f3_widget_area');
		}		
	}
	
	
	if(!empty($ub_widget_area_f4) || !empty($tp_default_f4_widget_area)){
	// all 4 widget area is active	
		
		// first
			$curr_widget_area = get_post_meta($get_the_id,'ub_widget_area_f1',true);

			if($curr_widget_area != ''){
				//page override
				if($curr_widget_area != 'no-widget-area'){
					$wa_id = $curr_widget_area;
				}else{
					$wa_id = '';
				}
			}else{
				//use default settings
				if(!empty($GLOBALS['indexblog_id'])){
					$tp_default_f1_widget_area = get_option('tp_pages_default_f1_widget_area');
				}else{
					if(is_page()){
						$tp_default_f1_widget_area = get_option('tp_pages_default_f1_widget_area');
					}elseif(is_single()){
						$tp_default_f1_widget_area = get_option('tp_posts_default_f1_widget_area');
					}		
				}
				
				if($tp_default_f1_widget_area != '' && $tp_default_f1_widget_area != 'no-widget-area'){
					$wa_id = $tp_default_f1_widget_area;
				}else{
					$wa_id = '';
				}
			}
		
			if ( is_active_sidebar( $wa_id ) ) : 
					print '<div class="one_fourth">
					';
								dynamic_sidebar( $wa_id );
					print '
					</div><!-- first .widget-area -->';
			endif; 
			
			
		// second			
			$curr_widget_area = get_post_meta($get_the_id,'ub_widget_area_f2',true);

			if($curr_widget_area != ''){
				//page override
				if($curr_widget_area != 'no-widget-area'){
					$wa_id = $curr_widget_area;
				}else{
					$wa_id = '';
				}
			}else{
				//use default settings
				if(!empty($GLOBALS['indexblog_id'])){
					$tp_default_f2_widget_area = get_option('tp_pages_default_f2_widget_area');
				}else{
					if(is_page()){
						$tp_default_f2_widget_area = get_option('tp_pages_default_f2_widget_area');
					}elseif(is_single()){
						$tp_default_f2_widget_area = get_option('tp_posts_default_f2_widget_area');
					}		
				}
					
				if($tp_default_f2_widget_area != '' && $tp_default_f2_widget_area != 'no-widget-area'){
					$wa_id = $tp_default_f2_widget_area;
				}else{
					$wa_id = '';
				}
			}
		
			if ( is_active_sidebar( $wa_id ) ) : 
					print '<div class="one_fourth">
					';
								dynamic_sidebar( $wa_id );
					print '
					</div><!-- second .widget-area -->';
			endif; 
			
			
			
		// third		
			$curr_widget_area = get_post_meta($get_the_id,'ub_widget_area_f3',true);

			if($curr_widget_area != ''){
				//page override
				if($curr_widget_area != 'no-widget-area'){
					$wa_id = $curr_widget_area;
				}else{
					$wa_id = '';
				}
			}else{
				//use default settings
				if(is_page()){
					$tp_default_f3_widget_area = get_option('tp_pages_default_f3_widget_area');
				}elseif(is_single()){
					$tp_default_f3_widget_area = get_option('tp_posts_default_f3_widget_area');
				}		
					
				if($tp_default_f3_widget_area != '' && $tp_default_f3_widget_area != 'no-widget-area'){
					$wa_id = $tp_default_f3_widget_area;
				}else{
					$wa_id = '';
				}
			}
		
			if ( is_active_sidebar( $wa_id ) ) : 
					print '<div class="one_fourth">
					';
								dynamic_sidebar( $wa_id );
					print '
					</div><!-- third .widget-area -->';
			endif; 

			
			
		// fourth
			$curr_widget_area = get_post_meta($get_the_id,'ub_widget_area_f4',true);

			if($curr_widget_area != ''){
				//page override
				if($curr_widget_area != 'no-widget-area'){
					$wa_id = $curr_widget_area;
				}else{
					$wa_id = '';
				}
			}else{
				//use default settings
				if(is_page()){
					$tp_default_f4_widget_area = get_option('tp_pages_default_f4_widget_area');
				}elseif(is_single()){
					$tp_default_f4_widget_area = get_option('tp_posts_default_f4_widget_area');
				}		
					
				if($tp_default_f4_widget_area != '' && $tp_default_f4_widget_area != 'no-widget-area'){
					$wa_id = $tp_default_f4_widget_area;
				}else{
					$wa_id = '';
				}
			}
		
			if ( is_active_sidebar( $wa_id ) ) : 
					print '<div class="one_fourth last">
					';
								dynamic_sidebar( $wa_id );
					print '
					</div><!-- fourth .widget-area -->';
			endif; 
			

	}
	elseif(!empty($ub_widget_area_f3) || !empty($tp_default_f3_widget_area)){
	// display 3 widget areas only
		
			// first
			$curr_widget_area = get_post_meta($get_the_id,'ub_widget_area_f1',true);

			if($curr_widget_area != ''){
				//page override
				if($curr_widget_area != 'no-widget-area'){
					$wa_id = $curr_widget_area;
				}else{
					$wa_id = '';
				}
			}else{
				//use default settings
				if(is_page()){
					$tp_default_f1_widget_area = get_option('tp_pages_default_f1_widget_area');
				}elseif(is_single()){
					$tp_default_f1_widget_area = get_option('tp_posts_default_f1_widget_area');
				}		
					
				if($tp_default_f1_widget_area != '' && $tp_default_f1_widget_area != 'no-widget-area'){
					$wa_id = $tp_default_f1_widget_area;
				}else{
					$wa_id = '';
				}
			}
		
			if ( is_active_sidebar( $wa_id ) ) : 
					print '<div class="one_third">
					';
								dynamic_sidebar( $wa_id );
					print '
					</div><!-- first .widget-area -->';
			endif; 
			
			
		// second			
			$curr_widget_area = get_post_meta($get_the_id,'ub_widget_area_f2',true);

			if($curr_widget_area != ''){
				//page override
				if($curr_widget_area != 'no-widget-area'){
					$wa_id = $curr_widget_area;
				}else{
					$wa_id = '';
				}
			}else{
				//use default settings
				if(is_page()){
					$tp_default_f2_widget_area = get_option('tp_pages_default_f2_widget_area');
				}elseif(is_single()){
					$tp_default_f2_widget_area = get_option('tp_posts_default_f2_widget_area');
				}		
					
				if($tp_default_f2_widget_area != '' && $tp_default_f2_widget_area != 'no-widget-area'){
					$wa_id = $tp_default_f2_widget_area;
				}else{
					$wa_id = '';
				}
			}
		
			if ( is_active_sidebar( $wa_id ) ) : 
					print '<div class="one_third">
					';
								dynamic_sidebar( $wa_id );
					print '
					</div><!-- second .widget-area -->';
			endif; 
			
			
			
		// third		
			$curr_widget_area = get_post_meta($get_the_id,'ub_widget_area_f3',true);

			if($curr_widget_area != ''){
				//page override
				if($curr_widget_area != 'no-widget-area'){
					$wa_id = $curr_widget_area;
				}else{
					$wa_id = '';
				}
			}else{
				//use default settings
				if(is_page()){
					$tp_default_f3_widget_area = get_option('tp_pages_default_f3_widget_area');
				}elseif(is_single()){
					$tp_default_f3_widget_area = get_option('tp_posts_default_f3_widget_area');
				}		
					
				if($tp_default_f3_widget_area != '' && $tp_default_f3_widget_area != 'no-widget-area'){
					$wa_id = $tp_default_f3_widget_area;
				}else{
					$wa_id = '';
				}
			}
		
			if ( is_active_sidebar( $wa_id ) ) : 
					print '<div class="one_third last">
					';
								dynamic_sidebar( $wa_id );
					print '
					</div><!-- third .widget-area -->';
			endif; 
			
		
	}	
	
	
	
	// footer bottom text
		$tp_bottom_footer_text_left = get_option('tp_bottom_footer_text_left');
		$tp_bottom_footer_text_right = get_option('tp_bottom_footer_text_right');
		if($tp_bottom_footer_text_right != '' || $tp_bottom_footer_text_left != ''){
			print '<section id="bottom-text">';
		
			if($tp_bottom_footer_text_left != ''){
				print '<div class="one_half">'.do_shortcode($tp_bottom_footer_text_left).'</div>';
			}
			
			if($tp_bottom_footer_text_right != ''){
				print '<div class="one_half last">'.do_shortcode($tp_bottom_footer_text_right).'</div>';
			}
			
			print '</section>';
		}

	
	print '	<div class="clear"></div>
			</div>
		</div>
		</div>
	</footer>
	';
?>	
	
	

<?php wp_footer(); ?>


</body>
</html>