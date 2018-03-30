<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	/*	
	*	---------------------------------------------------------------------
	*	Compatibility mode
	*	Set to TRUE to enable compatibility mode - [v_icon]
	*	--------------------------------------------------------------------- 
	*/

	define( 'VI_SAFE_MODE', apply_filters( 'vi_safe_mode', FALSE ) );
	
	
	/* Setup perfix */
	function crum_i_compatibility_mode() {
		$prefix = ( VI_SAFE_MODE == true ) ? 'v_' : '';
		return $prefix;
	}

	

	/*	
	*	---------------------------------------------------------------------
	*	Setup plugin
	*	--------------------------------------------------------------------- 
	*/
	add_action('after_setup_theme', 'dfd_kadabra_i_plugin_init');
	
	if (!function_exists('dfd_kadabra_i_plugin_init')) {
		function dfd_kadabra_i_plugin_init() {
			// Enqueue scripts and styles
			add_action('wp_enqueue_scripts', 'dfd_font_icons_styles', 1);
			// Enqueue admin scripts and styles
			add_action('admin_enqueue_scripts', 'dfd_kadabra_i_plugin_admin_scripts');
		}
	}
	
	if (!function_exists('dfd_kadabra_i_plugin_scripts')) {
		function dfd_kadabra_i_plugin_scripts() {
			wp_register_style('icon-font-style', get_template_directory_uri() . '/inc/icons/css/icon-font-style.css', false, '', 'all' );
			wp_enqueue_style('icon-font-style');
		}
	}
	
	if (!function_exists('dfd_kadabra_i_plugin_admin_scripts')) {
		function dfd_kadabra_i_plugin_admin_scripts() {
			$fonts = get_option('dfd_ronneby_fonts');
			$uploads_dir = wp_upload_dir();
			if(is_array($fonts))
			{
				foreach($fonts as $font => $info)
				{
					if(strpos($info['style'], 'http://' ) !== false) {
						wp_enqueue_style('bsf-'.$font,$info['style']);
					} else {
						wp_enqueue_style('bsf-'.$font,trailingslashit($uploads_dir['baseurl']).'/dfd_ronneby_fonts/'.$info['style']);
					}
				}
			}
			//wp_register_style( 'icon-font-style', get_template_directory_uri() . '/inc/icons/css/icon-font-style.css', false, '', 'all' );
			wp_register_style( 'mnky-icon-generator', get_template_directory_uri() . '/inc/icons/css/generator.css', false, '', 'all' );
			wp_register_script( 'mnky-icon-generator', get_template_directory_uri() . '/inc/icons/js/generator.js', array( 'jquery' ), '', false );
			
			//wp_enqueue_style( 'icon-font-style' );
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_style( 'farbtastic' );
			wp_enqueue_style( 'mnky-icon-generator' );

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_script( 'farbtastic' );		
			wp_enqueue_script( 'mnky-icon-generator' );
		}
	}
	
	if(!function_exists('dfd_font_icons_styles')) {
		function dfd_font_icons_styles() {
			$fonts = get_option('dfd_ronneby_fonts');
			$uploads_dir = wp_upload_dir();
			if(is_array($fonts))
			{
				foreach($fonts as $font => $info)
				{
					if(strpos($info['style'], 'http://' ) !== false) {
						wp_enqueue_style('bsf-'.$font,$info['style']);
					} else {
						wp_enqueue_style('bsf-'.$font,trailingslashit($uploads_dir['baseurl']).'/dfd_ronneby_fonts/'.$info['style']);
					}
				}
			}
		}
	}
	
	/*	
	*	---------------------------------------------------------------------
	*	Plugin URL
	*	--------------------------------------------------------------------- 
	*/
	
	function crum_i_plugin_url() {
		return locate_template('/inc/icons/icons.php');
    }

	/*
	*	---------------------------------------------------------------------
	*	Icon generator box
	*	---------------------------------------------------------------------
	*/

	function crum_i_generator() {

		//include_once 'inc/list.php';
		?>
		<div id="mnky-generator-overlay" class="mnky-overlay-bg" style="display:none"></div>
		<div id="mnky-generator-wrap" style="display:none">
			<div id="mnky-generator">
				<a href="#" id="mnky-generator-close"><span class="mnky-close-icon"></span></a>
				<div id="mnky-generator-shell">
					<?php /*
					<table border="0">
						<tr>
							<td class="generator-title">
								<span>Icon pack:</span>
							</td>
							<td>
								<select name="icon-pack" id="mnky-generator-select-pack">
									<?php foreach($dfd_i_icon_list as $pack_name=>$icons_list): ?>
									<option value="<?php echo esc_attr($pack_name); ?>-icon-list"><?php echo ucfirst($pack_name);?> icons</option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
					</table>
					*/ ?>
					<div class="mnky-generator-icon-select">
						<?php /*$i=0; foreach($dfd_i_icon_list as $pack_name=>$icons_list): ?>
						<ul class="<?php echo esc_attr($pack_name); ?>-icon-list ul-icon-list" <?php if ($i>0): ?>style="display:none"<?php endif; ?>>
							<?php
                            foreach ( $icons_list as $icon_class ) {
                                $selected_icon = ( 'linecons-adjust' == $icon_class ) ? ' checked' : '';
                                echo '<li><input name="name" type="radio" value="' . esc_attr($icon_class) . '" id="' . esc_attr($icon_class) . '" '. esc_attr($selected_icon) .' ><label for="' . esc_attr($icon_class) . '"><i class="' . esc_attr($icon_class) . '"></i></label></li>';
                            }
                            ?>
						</ul>
						<?php $i++; endforeach; */
						if(class_exists('Dfd_Icon_Manager')) {
							echo Dfd_Icon_Manager::get_font_manager();
						} elseif(class_exists('AIO_Icon_Manager')) {
							echo AIO_Icon_Manager::get_font_manager();
						} else {
							_e('Icon manages is inactive. Please get in touch with theme developers', 'dfd');
						}
						/* ?>
                        <ul class="linecons-icon-list">
                            <?php
                            foreach ( $dfd_i_icon_list['linecons'] as $linecons_icon ) {
                                $selected_icon = ( 'linecons-adjust' == $linecons_icon ) ? ' checked' : '';
                                echo '<li><input name="name" type="radio" value="' . esc_attr($linecons_icon) . '" id="' . esc_attr($linecons_icon) . '" '. esc_attr($selected_icon) .' ><label for="' . esc_attr($linecons_icon) . '"><i class="' . esc_attr($linecons_icon) . '"></i></label></li>';
                            }
                            ?>
                        </ul>
						<ul class="moon-icon-list" style="display:none">
						<?php 
						foreach ( $dfd_i_icon_list['moon'] as $moon_icon ) {
							echo '<li><input name="name" type="radio" value="' . esc_attr($moon_icon) . '" id="' . esc_attr($moon_icon) . '"><label for="' . esc_attr($moon_icon) . '"><i class="' . esc_attr($moon_icon) . '"></i></label></li>';
						} 
						?>
						</ul>
						<?php */ ?>
					</div>

					<input name="mnky-generator-insert" type="submit" class="button button-primary button-large" id="mnky-generator-insert" value="Insert Icon">
				</div>
			</div>
		</div>
		
	<?php
	}

	add_action( 'admin_footer', 'crum_i_generator' );

?>