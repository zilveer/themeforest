<?php
	/*
	  Plugin Name: MNKY Vector Icons
	  Plugin URI: http://www.mnkystudio.com/plugins/
	  Author: MNKY Studio
	  Author URI: http://www.mnkystudio.com/
	*/

	

	/*	
	*	---------------------------------------------------------------------
	*	Setup plugin
	*	--------------------------------------------------------------------- 
	*/
	if ( !function_exists( 'mnky_plugin_init' ) ) {
	
		function mnky_plugin_init() {
		
			wp_register_style( 'vector-icons-style', MNKY_CSS . '/vector-icons.css', false, '', 'all' );
			wp_register_style( 'vector-icon-generator-css', MNKY_CSS . '/vector-icons-generator.css', false, '', 'all' );
			wp_register_script( 'vector-icon-generator-js', MNKY_JS . '/vector-icons-generator.js', array( 'jquery' ), '', false );

			if ( !is_admin() ) {
			
				wp_enqueue_style( 'vector-icons-style' );
				
			} elseif ( is_admin() ) {
			
				wp_enqueue_style( 'vector-icons-style' );
			
				global $pagenow;
				$mnky_generator_includes_pages = array( 'post.php', 'edit.php', 'post-new.php', 'index.php', 'edit-tags.php');
				
				if ( in_array( $pagenow, $mnky_generator_includes_pages ) ) {
					wp_enqueue_style( 'wp-color-picker' );
					wp_enqueue_style( 'vector-icon-generator-css' );	
					

					wp_enqueue_script( 'jquery' );
					wp_enqueue_script( 'wp-color-picker' );		
					wp_enqueue_script( 'vector-icon-generator-js' );		
					
				}
			}
		}
		
		add_action( 'init', 'mnky_plugin_init' );
		
		
		
		/*	
		*	---------------------------------------------------------------------
		*	IE7 compatibility
		*	--------------------------------------------------------------------- 
		*/

		function mnky_ie7() { ?>
			<!--[if lte IE 7]>
				<link href="<?php echo MNKY_CSS ?>/vector-icons-ie7.css" media="screen" rel="stylesheet" type="text/css">
			<![endif]-->
		<?php }
		
		add_action('wp_head', 'mnky_ie7');


		
		/*	
		*	---------------------------------------------------------------------
		*	Icon generator button
		*	--------------------------------------------------------------------- 
		*/
		
		function mnky_generator_button( $page = null, $target = null ) {
			echo '<a href="#" class="button" title="Add Icon" id="mnky-generator-button"><span class="mnky-button-icon"></span>Add Icon</a>';
		}

		add_action( 'media_buttons', 'mnky_generator_button', 101 );
			
		

		/*	
		*	---------------------------------------------------------------------
		*	Icon generator box
		*	--------------------------------------------------------------------- 
		*/

		function mnky_generator() {
			
			include_once 'vector-icons/icon-list.php'; ?>
			<div id="mnky-generator-overlay" class="mnky-overlay-bg" style="display:none"></div>
			<div id="mnky-generator-wrap" style="display:none">
				<div id="mnky-generator">
					<a href="#" id="mnky-generator-close"><span class="mnky-close-icon"></span></a>
					<div id="mnky-generator-shell">
						
						<table border="0">
							<tr>
								<td class="generator-title">
									<span>Icon color:</span>
								</td>					
								<td>
									<span class="mnky-generator-select-color"><input type="text" name="color" value="#444444" id="mnky-generator-attr-icon" class="mnky-generator-attr mnky-generator-select-color-value" /></span>
								</td>
								<td class="size-info">
									<!-- dummy space -->
								</td>	
								<td class="generator-title">
									<span>Icon style:</span>
								</td>							
								<td>
									<select name="style" class="mnky-generator-attr mnky-generator-select-style">
									   <option value="">None</option>
									   <option value="icon-background">With background</option>
									   <option value="metro-background">With background (METRO)</option>
									   <option value="icon-spin">Spin icon</option>
									   <option value="pull-right">Align right</option>
									   <option value="pull-left">Align left</option>
									</select>
								</td>
								<td class="size-info">
									<!-- dummy space -->
								</td>
								<td class="generator-title icon-url">
									<span>URL:</span>
								</td>					
								<td>
									<div id="mnky-generator-url"><input type="text" name="url" value="" id="mnky-generator-icon-url" class="mnky-generator-attr mnky-generator-icon-url-value" /></div>
								</td>							
							</tr>
							<tr>
								<td class="generator-title">
									<span>Icon size:</span>
								</td>
								<td>
									<div id="mnky-generator-size"><input type="text" name="size" value="18px" id="mnky-generator-icon-size" class="mnky-generator-attr mnky-generator-icon-size-value" /></div>
								</td>
								<td class="size-info">
									<!-- dummy space -->
								</td>	
								<td class="generator-title">
									<span>On hover:</span>
								</td>					
								<td>
									<select name="hover" class="mnky-generator-attr mnky-generator-select-hover">
									   <option value="">No effect</option>
									   <option value="fade">Fade</option>
									   <option value="show-color">Show color</option>
									</select>
								</td>
								<td class="size-info">
									<!-- dummy space -->
								</td>	
								<td class="generator-title icon-url">
									<span>Target:</span>
								</td>					
								<td>
									<select name="target" class="mnky-generator-attr mnky-generator-select-target">
									   <option value="_blank">_blank</option>
									   <option value="_self">_self</option>
									</select>
								</td>
							</tr>
						</table>
						
						<div class="mnky-generator-icon-select">
							<ul class="moon-icon-list">
							<?php 
							foreach ( $vector_icon_list['moon-icons'] as $moon_icon ) {
								$selected_icon = ( 'moon-home' == $moon_icon ) ? ' checked' : '';
								echo '<li><input name="name" type="radio" value="' . $moon_icon . '" id="' . $moon_icon . '" '. $selected_icon .' ><label for="' . $moon_icon . '"><i class="' . $moon_icon . '"></i></label></li>';
							} 
							?>
							</ul>
						</div>
						
						<div id="mnky-shortcode-html" style="display:none">
							<span class="generator-title">HTML code:</span>
							<a href="#" id="mnky-generator-close-html"><span class="mnky-close-icon"></span></a>
							<textarea></textarea>
							<span class="mnky-generator-note">Use this html code to place icon where shortcodes are not supported. For example, into slider or into another shortcode. Or to add some customization.</span>
						</div>
						
						<input name="mnky-generator-insert" type="submit" class="button button-primary button-large" id="mnky-generator-insert" value="Insert Icon">
						<input name="mnky-generator-show-html" type="submit" class="button" id="mnky-generator-show-html" value="Get HTML code">
						<div class="mnky-clear"></div>
						
						<input type="hidden" name="mnky-generator-result" id="mnky-generator-result" value="" />
					</div>
				</div>
			</div>
			
		<?php
		}

		add_action( 'admin_footer', 'mnky_generator' );
			
		
		
		/*	
		*	---------------------------------------------------------------------
		*	Execute shortcode
		*	--------------------------------------------------------------------- 
		*/

		function mnky_icon_shortcode( $atts, $content = null ) {
			extract( shortcode_atts( array(
					'color' => '#444444',
					'size' => '25px',
					'style' => '',
					'hover' => '',
					'url' => '',
					'target' => '_blank',
					'name' => 'icon-ok'
					), $atts ) );
					
			if ($style == 'icon-background' || $style == 'metro-background') { $element_style = 'color:#fff; background-color:' . $color; } else { $element_style = 'color:' . $color; }
			if ($style) { $style = ' ' . $style; } else { $style = ''; }
			
			$return = '';
			if ($url != '') { $return .= '<a href="' . $url . '" target="' . $target . '">'; }
			if ($hover == 'show-color') { 
				if ($style == ' icon-background') {
					$return .= '<span style="color:' . $color . '"><i style="font-size:' . $size . '; background-color:#fff;" class="' . $name . ' icon-background hover-show-color-bg"></i></span>';
				} elseif ($style == ' metro-background') {
					$return .= '<span style="background-color:' . $color . '"><i style="font-size:' . $size . ';" class="' . $name . ' metro-background hover-show-color-metro-bg"></i></span>';
				} else {
					$return .= '<span style="color:' . $color . '"><i style="' . $element_style . '; font-size:' . $size . '" class="' . $name . $style . ' hover-show-color"></i></span>';
				}
			} else {
				if ($hover) { $hover = ' hover-' . $hover; } else { $hover = ''; }
				$return .= '<i style="' . $element_style . '; font-size:' . $size . '" class="' . $name . $style . $hover . '"></i>';
			}
			if ($url != '') { $return .= '</a>'; }
			
			return $return;
		}
		
		add_shortcode( 'v_icon', 'mnky_icon_shortcode' );
	}	
?>