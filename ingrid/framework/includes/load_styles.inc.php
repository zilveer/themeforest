<?php	
		// load all necessary fonts first
			$tp_fontface_font_family = get_option('tp_fontface_font_family');
			$tp_txt_body_font = get_option('tp_txt_body_font');
			$tp_txt_menu_font = get_option('tp_txt_menu_font');
			$tp_txt_link_font = get_option('tp_txt_link_font');
			$tp_txt_footer_link_font = get_option('tp_txt_footer_link_font');
			$tp_txt_h1_font = get_option('tp_txt_h1_font');
			$tp_txt_h2_font = get_option('tp_txt_h2_font');
			$tp_txt_h3_font = get_option('tp_txt_h3_font');
			$tp_txt_h4_font = get_option('tp_txt_h4_font');
			$tp_txt_h5_font = get_option('tp_txt_h5_font');
			$tp_txt_h6_font = get_option('tp_txt_h6_font');
						
			if($tp_fontface_font_family != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_fontface_font_family.');'; }
			if($tp_txt_body_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_body_font.');'; }
			if($tp_txt_menu_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_menu_font.');'; }
			if($tp_txt_link_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_link_font.');'; }
			if($tp_txt_footer_link_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_footer_link_font.');'; }
			if($tp_txt_h1_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_h1_font.');'; }
			if($tp_txt_h2_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_h2_font.');'; }
			if($tp_txt_h3_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_h3_font.');'; }
			if($tp_txt_h4_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_h4_font.');'; }
			if($tp_txt_h5_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_h5_font.');'; }
			if($tp_txt_h6_font != ''){ print '
			@import url(http://fonts.googleapis.com/css?family='.$tp_txt_h6_font.');'; }
			
			$tp_typography_custom_fonts = get_option('tp_typography_custom_fonts');
			if($tp_typography_custom_fonts != ''){
				$tp_typography_custom_fonts = maybe_unserialize($tp_typography_custom_fonts);
				if(is_array($tp_typography_custom_fonts)){
				foreach($tp_typography_custom_fonts as $cf){
					print '					
			@import url(http://fonts.googleapis.com/css?family='.$cf.');'; 					
				}
				}
			}
			
			
		// set fonts
			//body
			$tp_txt_body_color = get_option('tp_txt_body_color');	$tp_txt_body_size = get_option('tp_txt_body_size');	$tp_txt_body_style = get_option('tp_txt_body_style');
			if($tp_txt_body_font != '' || $tp_txt_body_color != '' || $tp_txt_body_size != '' || $tp_txt_body_style != ''){
				print '
				
			body{';
								
				if($tp_fontface_font_family != '' && $tp_txt_body_font == ''){
					print ' font-family: \''.str_replace('+',' ',$tp_fontface_font_family).'\';';				
				}elseif($tp_txt_body_font != ''){
					print ' font-family: \''.str_replace('+',' ',$tp_txt_body_font).'\';';
				}
				
				if($tp_txt_body_color != '' && $tp_txt_body_color != '#'){
					print ' color: '.$tp_txt_body_color.';';
				}
				
				if($tp_txt_body_size != ''){
					print ' font-size: '.$tp_txt_body_size.';';
				}
				
				if($tp_txt_body_style == 'italic'){
					print ' font-style: '.$tp_txt_body_style.';';
				}elseif($tp_txt_body_style == 'bold'){
					print ' font-weight: '.$tp_txt_body_style.';';
				}
				
				print ' }';		
			}
			
			
			
			//link
			$tp_txt_link_color = get_option('tp_txt_link_color');	$tp_txt_link_hover_color = get_option('tp_txt_link_hover_color');	$tp_txt_link_size = get_option('tp_txt_link_size');	$tp_txt_link_style = get_option('tp_txt_link_style');
			if($tp_txt_link_font != '' || $tp_txt_link_color != '' || $tp_txt_link_hover_color != '' || $tp_txt_link_size != '' || $tp_txt_link_style != ''){
				print '
			#page a{';
				
				if($tp_txt_link_font != ''){
					print ' font-family: \''.str_replace('+',' ',$tp_txt_link_font).'\';';
				}
				
				if($tp_txt_link_color != '' && $tp_txt_link_color != '#'){
					print ' color: '.$tp_txt_link_color.';';
				}
				
				if($tp_txt_link_size != ''){
					print ' font-size: '.$tp_txt_link_size.';';
				}
				
				if($tp_txt_link_style == 'italic'){
					print ' font-style: '.$tp_txt_link_style.';';
				}elseif($tp_txt_link_style == 'bold'){
					print ' font-weight: '.$tp_txt_link_style.';';
				}
				
				print ' }';		
				
				if($tp_txt_link_hover_color != '' && $tp_txt_link_hover_color != '#'){
					print '
			#page a:hover,#page #page_control a:hover{ color: '.$tp_txt_link_hover_color.'; }';
				}
			}		
			
			
			//footer link
			$tp_txt_footer_link_color = get_option('tp_txt_footer_link_color');	$tp_txt_footer_link_hover_color = get_option('tp_txt_footer_link_hover_color');	$tp_txt_footer_link_size = get_option('tp_txt_footer_link_size');	$tp_txt_footer_link_style = get_option('tp_txt_footer_link_style');
			if($tp_txt_footer_link_font != '' || $tp_txt_footer_link_color != '' || $tp_txt_footer_link_hover_color != '' || $tp_txt_footer_link_size != '' || $tp_txt_footer_link_style != ''){
				print '
			footer a{';
				
				if($tp_txt_footer_link_font != ''){
					print ' font-family: \''.str_replace('+',' ',$tp_txt_footer_link_font).'\';';
				}
				
				if($tp_txt_footer_link_color != '' && $tp_txt_footer_link_color != '#'){
					print ' color: '.$tp_txt_footer_link_color.';';
				}
				
				if($tp_txt_footer_link_size != ''){
					print ' font-size: '.$tp_txt_footer_link_size.';';
				}
				
				if($tp_txt_footer_link_style == 'italic'){
					print ' font-style: '.$tp_txt_footer_link_style.';';
				}elseif($tp_txt_footer_link_style == 'bold'){
					print ' font-weight: '.$tp_txt_footer_link_style.';';
				}
				
				print ' }';		
				
				if($tp_txt_footer_link_hover_color != '' && $tp_txt_footer_link_hover_color != '#'){
					print '
			footer a:hover{ color: '.$tp_txt_footer_link_hover_color.'; }';
				}
			}		
			
			
			//menu
			$tp_txt_menu_color = get_option('tp_txt_menu_color');	$tp_txt_menu_hover_color = get_option('tp_txt_menu_hover_color');	$tp_txt_menu_size = get_option('tp_txt_menu_size');	$tp_txt_menu_style = get_option('tp_txt_menu_style');
			if($tp_txt_menu_font != '' || $tp_txt_menu_color != '' || $tp_txt_menu_hover_color != '' || $tp_txt_menu_size != '' || $tp_txt_menu_style != ''){
				print '
			header nav ul.menu li a strong{';
				
				if($tp_txt_menu_font != ''){
					print ' font-family: \''.str_replace('+',' ',$tp_txt_menu_font).'\';';
				}
				
				if($tp_txt_menu_color != '' && $tp_txt_menu_color != '#'){
					print ' color: '.$tp_txt_menu_color.';';
				}
				
				if($tp_txt_menu_size != ''){
					print ' font-size: '.$tp_txt_menu_size.';';
				}
				
				if($tp_txt_menu_style == 'italic'){
					print ' font-style: '.$tp_txt_menu_style.';';
				}elseif($tp_txt_menu_style == 'bold'){
					print ' font-weight: '.$tp_txt_menu_style.';';
				}
				
				print ' }';		
				
				if($tp_txt_menu_hover_color != '' && $tp_txt_menu_hover_color != '#'){
					print '
			header nav ul.menu li a:hover strong, header nav ul.menu .sub-menu a:hover{ color: '.$tp_txt_menu_hover_color.'; }';
				}
			}			
			
			

			//h1
			$tp_txt_h1_color = get_option('tp_txt_h1_color');	$tp_txt_h1_size = get_option('tp_txt_h1_size');	$tp_txt_h1_style = get_option('tp_txt_h1_style');
			if($tp_txt_h1_font != '' || $tp_txt_h1_color != '' || $tp_txt_h1_size != '' || $tp_txt_h1_style != ''){
				print '
			h1{';
				
				if($tp_txt_h1_font != ''){
					print '	font-family: \''.str_replace('+',' ',$tp_txt_h1_font).'\';';
				}
				
				if($tp_txt_h1_color != '' && $tp_txt_h1_color != '#'){
					print ' color: '.$tp_txt_h1_color.';';
				}
				
				if($tp_txt_h1_size != ''){
					print ' font-size: '.$tp_txt_h1_size.';';
				}
				
				if($tp_txt_h1_style == 'italic'){
					print ' font-style: '.$tp_txt_h1_style.';';
				}elseif($tp_txt_h1_style == 'bold'){
					print ' font-weight: '.$tp_txt_h1_style.';';
				}
				
				print ' }';		
			}		
			
			
			
			//h2
			$tp_txt_h2_color = get_option('tp_txt_h2_color');	$tp_txt_h2_size = get_option('tp_txt_h2_size');	$tp_txt_h2_style = get_option('tp_txt_h2_style');
			if($tp_txt_h2_font != '' || $tp_txt_h2_color != '' || $tp_txt_h2_size != '' || $tp_txt_h2_style != ''){
				print '
			h2{';
				
				if($tp_txt_h2_font != ''){
					print ' font-family: \''.str_replace('+',' ',$tp_txt_h2_font).'\';';
				}
				
				if($tp_txt_h2_color != '' && $tp_txt_h2_color != '#'){
					print ' color: '.$tp_txt_h2_color.';';
				}
				
				if($tp_txt_h2_size != ''){
					print ' font-size: '.$tp_txt_h2_size.';';
				}
				
				if($tp_txt_h2_style == 'italic'){
					print ' font-style: '.$tp_txt_h2_style.';';
				}elseif($tp_txt_h2_style == 'bold'){
					print ' font-weight: '.$tp_txt_h2_style.';';
				}
				
				print ' }';		
			}		
			
			
			
			//h3
			$tp_txt_h3_color = get_option('tp_txt_h3_color');	$tp_txt_h3_size = get_option('tp_txt_h3_size');	$tp_txt_h3_style = get_option('tp_txt_h3_style');
			if($tp_txt_h3_font != '' || $tp_txt_h3_color != '' || $tp_txt_h3_size != '' || $tp_txt_h3_style != ''){
				print '
			h3{';
				
				if($tp_txt_h3_font != ''){
					print ' font-family: \''.str_replace('+',' ',$tp_txt_h3_font).'\';';
				}
				
				if($tp_txt_h3_color != '' && $tp_txt_h3_color != '#'){
					print ' color: '.$tp_txt_h3_color.';';
				}
				
				if($tp_txt_h3_size != ''){
					print ' font-size: '.$tp_txt_h3_size.';';
				}
				
				if($tp_txt_h3_style == 'italic'){
					print ' font-style: '.$tp_txt_h3_style.';';
				}elseif($tp_txt_h3_style == 'bold'){
					print ' font-weight: '.$tp_txt_h3_style.';';
				}
				
				print ' }';		
			}		
			
			
			
			//h4
			$tp_txt_h4_color = get_option('tp_txt_h4_color');	$tp_txt_h4_size = get_option('tp_txt_h4_size');	$tp_txt_h4_style = get_option('tp_txt_h4_style');
			if($tp_txt_h4_font != '' || $tp_txt_h4_color != '' || $tp_txt_h4_size != '' || $tp_txt_h4_style != ''){
				print '
			h4{';
				
				if($tp_txt_h4_font != ''){
					print '	font-family: \''.str_replace('+',' ',$tp_txt_h4_font).'\';';
				}
				
				if($tp_txt_h4_color != '' && $tp_txt_h4_color != '#'){
					print ' color: '.$tp_txt_h4_color.';';
				}
				
				if($tp_txt_h4_size != ''){
					print ' font-size: '.$tp_txt_h4_size.';';
				}
				
				if($tp_txt_h4_style == 'italic'){
					print ' font-style: '.$tp_txt_h4_style.';';
				}elseif($tp_txt_h4_style == 'bold'){
					print ' font-weight: '.$tp_txt_h4_style.';';
				}
				
				print ' }';		
			}		
			
			
			
			//h5
			$tp_txt_h5_color = get_option('tp_txt_h5_color');	$tp_txt_h5_size = get_option('tp_txt_h5_size');	$tp_txt_h5_style = get_option('tp_txt_h5_style');
			if($tp_txt_h5_font != '' || $tp_txt_h5_color != '' || $tp_txt_h5_size != '' || $tp_txt_h5_style != ''){
				print '
			h5{';
				
				if($tp_txt_h5_font != ''){
					print '	font-family: \''.str_replace('+',' ',$tp_txt_h5_font).'\';';
				}
				
				if($tp_txt_h5_color != '' && $tp_txt_h5_color != '#'){
					print ' color: '.$tp_txt_h5_color.';';
				}
				
				if($tp_txt_h5_size != ''){
					print ' font-size: '.$tp_txt_h5_size.';';
				}
				
				if($tp_txt_h5_style == 'italic'){
					print ' font-style: '.$tp_txt_h5_style.';';
				}elseif($tp_txt_h5_style == 'bold'){
					print ' font-weight: '.$tp_txt_h5_style.';';
				}
				
				print ' }';		
			}		
			
			
			
			//h6
			$tp_txt_h6_color = get_option('tp_txt_h6_color');	$tp_txt_h6_size = get_option('tp_txt_h6_size');	$tp_txt_h6_style = get_option('tp_txt_h6_style');
			if($tp_txt_h6_font != '' || $tp_txt_h6_color != '' || $tp_txt_h6_size != '' || $tp_txt_h6_style != ''){
				print '
			h6{';
				
				if($tp_txt_h6_font != ''){
					print '	font-family: \''.str_replace('+',' ',$tp_txt_h6_font).'\';';
				}
				
				if($tp_txt_h6_color != '' && $tp_txt_h6_color != '#'){
					print ' color: '.$tp_txt_h6_color.';';
				}
				
				if($tp_txt_h6_size != ''){
					print ' font-size: '.$tp_txt_h6_size.';';
				}
				
				if($tp_txt_h6_style == 'italic'){
					print ' font-style: '.$tp_txt_h6_style.';';
				}elseif($tp_txt_h6_style == 'bold'){
					print ' font-weight: '.$tp_txt_h6_style.';';
				}
				
				print ' }';		
			}		
		
		
		// if no advanced setting is set, use selected
			if($tp_fontface_font_family != '' && $tp_txt_body_font == ''){
				print '
			body{ font-family: \''.str_replace('+',' ',$tp_fontface_font_family).'\'; }';
			}
		
		
			
		// set background image, background color, top panel texture, top panel bg color	
			$tp_custom_page_bg = get_option('tp_custom_page_bg');	
			$tp_page_background = get_option('tp_page_background');	
			$tp_site_bg_color = get_option('tp_site_bg_color');	
			print '
			body,html{';

			
			if($tp_site_bg_color != ''){	
				print ' background-color: '.$tp_site_bg_color.';';
			}
			
			if($tp_page_background == 'silk'){
				print ' background-image: url(\''.get_bloginfo('template_url').'/images/background-silk.jpg\'); background-attachment:fixed;';
			}
			elseif($tp_page_background == 'white'){
				print ' background-image: url(\''.get_bloginfo('template_url').'/images/background-white.jpg\'); background-attachment:fixed;';
			}
			elseif($tp_page_background == 'custom'){
				print ' background-image: url(\''.$tp_custom_page_bg.'\'); background-attachment:fixed;';
			}
			elseif($tp_page_background == 'none'){
				print ' background-image: none;';
			}
			
			print ' }';
				
			
			$tp_panel_texture = get_option('tp_panel_texture');				
			
			
			
			//submenu
			if($tp_panel_texture == 'wood' || $tp_panel_texture == 'red_leather' || $tp_panel_texture == 'brown_leather'){
				print '
			nav ul.menu .sub-menu{ background-image: url(\''.get_bloginfo('template_url').'/images/submenu_bg-red.png\'); }';
			}
			
			
		// top panel padding
			$tp_logo_padding = get_option('tp_logo_padding');
			if($tp_logo_padding != ''){
			//calc
			$a = '-50';
			$b = $a + $tp_logo_padding;
			$c = '170' + $tp_logo_padding;			
			$d = '80' + $tp_logo_padding;			
			
			print '
			#top_panel,	#top_panel_line{ margin-top: '.$b.'px; }
			#top_panel_stars{ margin-top: '.$c.'px;	}
			#page{ margin-top: '.$d.'px; }';
			}
		
	?>