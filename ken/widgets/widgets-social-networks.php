<?php

/*
	SOCIAL NETWORKS ICON
*/
class Artbees_Widget_Social extends WP_Widget {

	var $sites = array(
			'facebook',
			'twitter',
			'rss',
			'dribbble',
			'instagram',
			'pinterest',
			'google-plus',
			'linkedin',
			'youtube',
			'tumblr',
			'vimeo',
			'spotify',
	);

	var $align = array(

		'left' => array(
			'name'=>'Left',
			'path'=>'left',
		),

		'center' => array(
			'name'=>'Center',
			'path'=>'center',
		),

		'right' => array(
			'name'=>'Right',
			'path'=>'right',
		),

	);

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_social_networks', 'description' => 'Displays a list of Social Icon icons' );
		WP_Widget::__construct( 'social', THEME_SLUG.' - '.'Social Networks', $widget_ops );

		if ( 'widgets.php' == basename( $_SERVER['PHP_SELF'] ) ) {
			add_action( 'admin_print_scripts', array( &$this, 'add_admin_script' ) );
		}
	}

	function add_admin_script() {
		wp_enqueue_script( 'social-icon-widget', THEME_ADMIN_ASSETS_URI . '/js/social-icon-widget.js', array( 'jquery' ) );
	}


	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$alt = isset( $instance['alt'] )?$instance['alt']:'';
		$style = isset( $instance['style'] ) ? $instance['style'] : '';
		$skin = $instance['skin'];
		$align = isset( $instance['align'] ) ? $instance['align'] : '';
		$icon_color = isset( $instance['icon_color'] ) ? $instance['icon_color'] : '';
		$icon_hover_color = isset( $instance['icon_hover_color'] ) ? $instance['icon_hover_color'] : '';
		$icon_border_color = isset( $instance['icon_border_color'] ) ? $instance['icon_border_color'] : '';
		$icon_bg_main_color = isset( $instance['icon_bg_main_color'] ) ? $instance['icon_bg_main_color'] : '';
		$icon_bg_color = isset( $instance['icon_bg_color'] ) ? $instance['icon_bg_color'] : '';
		$custom_count = $instance['custom_count'];
		$uniqueID = 'social-'.uniqid();

		$output ='';
		$output .= '<div class="widget-social-container align-'.$align.' '.$style.'-style">';
		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {
				$link = isset( $instance[strtolower( $site )] )?$instance[strtolower( $site )]:'#';
					if($site == 'vimeo' || $site == 'spotify') {
						$site_class = 'mk-theme-icon-social-'.$site;
					} else {
						$site_class = 'mk-icon-'.$site;
					}
					$output .= '<a href="'.$link.'" rel="nofollow" class="builtin-icons '.$skin.' '.$site.'-hover" target="_blank" title="'.$alt.' '.$site.'"><i class="'.$site_class.'"></i></a>';
	
			}
			if($skin == 'custom' || !empty($icons_margin) ) {
				if ( !empty($icon_color) || !empty($icon_hover_color) || !empty($icon_bg_color) || !empty($icon_bg_main_color) || !empty($icon_border_color) || !empty($icons_margin) ) {
					//$output .= $icon_bg_color;


					$output .= '<style>';
					$output .= '
						#'.$uniqueID.' a { 
							opacity: 100 !important;';
					if ( !empty($icons_margin) ) {
						$output .= '
						margin: '.$icons_margin.'px;';
					}
					if ( !empty($icon_color) ) { 
						$output .= 'color: '.$icon_color.' !important;';
					}
					if ( !empty($icon_border_color) ) { 
						$output .= 'border-color: '.$icon_border_color.' !important;';
					}
					if ( $style == 'circle' && !empty($icon_bg_main_color)) { 
						$output .= 'background-color: '.$icon_bg_main_color.' !important;';
					}
					$output .= '}';
					$output .= '
						#'.$uniqueID.' a:hover { ';
					if ( !empty($icon_hover_color) ) { 
						$output .= 'color: '.$icon_hover_color.' !important;';
					}
					if ( $style == 'circle' && !empty($icon_bg_color)) { 
						$output .= 'border-color: '.$icon_bg_color.' !important;';
						$output .= 'background-color: '.$icon_bg_color.' !important;';
					}
					$output .= '}';
					$output .= '</style>';
				}
			} 
		}
		if ( $custom_count > 0 ) {
			for ( $i=1; $i<= $custom_count; $i++ ) {
				$name = isset( $instance['custom_'.$i.'_name'] )?$instance['custom_'.$i.'_name']:'';
				$icon = isset( $instance['custom_'.$i.'_icon'] )?$instance['custom_'.$i.'_icon']:'';
				$link = isset( $instance['custom_'.$i.'_url'] )?$instance['custom_'.$i.'_url']:'#';
				if ( !empty( $icon ) ) {
					$output .= '<a href="'.$link.'" rel="nofollow" target="_blank"><img src="'.$icon.'" alt="'.$alt.' '.$name.'" title="'.$alt.' '.$name.'"/></a>';
				}
			}
		}
		$output .= '</div>';



		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title ) {
				echo '<div class="social-title widgettitle '.$align.'">';
				echo $title;
				echo '</div>';
			}
				echo '<div id="'.$uniqueID.'">';
				echo $output;
				echo '</div>';
				echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['alt'] = strip_tags( $new_instance['alt'] );
		$instance['style'] = $new_instance['style'];
		$instance['skin'] = $new_instance['skin'];
		$instance['align'] = $new_instance['align'];
		$instance['icon_color'] = $new_instance['icon_color'];
		$instance['icon_hover_color'] = $new_instance['icon_hover_color'];
		$instance['icon_border_color'] = $new_instance['icon_border_color'];
		$instance['icon_bg_main_color'] = $new_instance['icon_bg_main_color'];
		$instance['icon_bg_color'] = $new_instance['icon_bg_color'];
		$instance['enable_sites'] = $new_instance['enable_sites'];
		$instance['custom_count'] = (int) $new_instance['custom_count'];
		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {
				$instance[strtolower( $site )] = isset( $new_instance[strtolower( $site )] )?strip_tags( $new_instance[strtolower( $site )] ):'';
			}
		}
		for ( $i=1;$i<=$instance['custom_count'];$i++ ) {
			$instance['custom_'.$i.'_name'] = strip_tags( $new_instance['custom_'.$i.'_name'] );
			$instance['custom_'.$i.'_url'] = strip_tags( $new_instance['custom_'.$i.'_url'] );
			$instance['custom_'.$i.'_icon'] = strip_tags( $new_instance['custom_'.$i.'_icon'] );
		}
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$alt = isset( $instance['alt'] ) ? esc_attr( $instance['alt'] ) : 'Follow Us on';
		$style = isset( $instance['style'] ) ? $instance['style'] : 'circle';
		$skin = isset( $instance['skin'] ) ? $instance['skin'] : 'dark';
		$align = isset( $instance['align'] ) ? $instance['align'] : 'left';
		$icon_color = isset( $instance['icon_color'] ) ? $instance['icon_color'] : '';
		$icon_hover_color = isset( $instance['icon_hover_color'] ) ? $instance['icon_hover_color'] : '';
		$icon_border_color = isset( $instance['icon_border_color'] ) ? $instance['icon_border_color'] : '';
		$icon_bg_main_color = isset( $instance['icon_bg_main_color'] ) ? $instance['icon_bg_main_color'] : '';
		$icon_bg_color = isset( $instance['icon_bg_color'] ) ? $instance['icon_bg_color'] : '';
		$enable_sites = isset( $instance['enable_sites'] ) ? $instance['enable_sites'] : array();
		foreach ( $this->sites as $site ) {
			$$site = isset( $instance[strtolower( $site )] ) ? esc_attr( $instance[strtolower( $site )] ) : '';
		}
		$custom_count = isset( $instance['custom_count'] ) ? absint( $instance['custom_count'] ) : 0;
		for ( $i=1;$i<=10;$i++ ) {
			$custom_name = 'custom_'.$i.'_name';
			$$custom_name = isset( $instance[$custom_name] ) ? $instance[$custom_name] : '';
			$custom_url = 'custom_'.$i.'_url';
			$$custom_url = isset( $instance[$custom_url] ) ? $instance[$custom_url] : '';
			$custom_icon = 'custom_'.$i.'_icon';
			$$custom_icon = isset( $instance[$custom_icon] ) ? $instance[$custom_icon] : '';
		}

		
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'alt' ); ?>">Icon Alt Title:</label> <input class="widefat" id="<?php echo $this->get_field_id( 'alt' ); ?>" name="<?php echo $this->get_field_name( 'alt' ); ?>" type="text" value="<?php echo $alt; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>">Style:</label>
			<select name="<?php echo $this->get_field_name( 'style' ); ?>" id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat">
				<option value="circle"<?php selected( $style, 'circle');?>>Circle</option>
				<option value="simple"<?php selected( $style, 'simple');?>>Simple</option>
			</select>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'skin' ); ?>">Color:</label>
			<select name="<?php echo $this->get_field_name( 'skin' ); ?>" id="<?php echo $this->get_field_id( 'skin' ); ?>" class="widefat social-network-select-skin">
				<option value="dark"<?php selected( $skin, 'dark');?>>Dark</option>
				<option value="light"<?php selected( $skin, 'light');?>>Light</option>
				<option value="custom"<?php selected( $skin, 'custom');?>>Custom</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'align' ); ?>"><?php _e('Align:', 'mk_framework'); ?></label>
			<select name="<?php echo $this->get_field_name( 'align' ); ?>" id="<?php echo $this->get_field_id( 'align' ); ?>" class="widefat">
				<?php foreach ( $this->align as $name => $value ):?>
				<option value="<?php echo $name;?>"<?php selected( $align, $name );?>><?php echo $value['name'];?></option>
				<?php endforeach;?>
			</select>
		</p>
		<div id="mk-social-custom-skin">

			<p>
				<label for="<?php echo $this->get_field_id( 'icon_color' ); ?>"><?php _e('Icon Color:', 'mk_framework'); ?></label>
				<div class="color-picker-holder"><input data-default-color="<?php $icon_color; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_color' ); ?>" type="text" value="<?php echo $icon_color; ?>" /></div>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'icon_hover_color' ); ?>"><?php _e('Icon Hover Color:', 'mk_framework'); ?></label>
				<div class="color-picker-holder"><input data-default-color="<?php $icon_hover_color; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_hover_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_hover_color' ); ?>" type="text" value="<?php echo $icon_hover_color; ?>" /></div>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'icon_border_color' ); ?>"><?php _e('Icon Border Color:', 'mk_framework'); ?></label>
				<div class="color-picker-holder"><input data-default-color="<?php $icon_border_color; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_border_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_border_color' ); ?>" type="text" value="<?php echo $icon_border_color; ?>" /></div>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'icon_bg_main_color' ); ?>"><?php _e('Icon Background Color:', 'mk_framework'); ?></label>
				<div class="color-picker-holder"><input data-default-color="<?php $icon_bg_main_color; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_bg_main_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_bg_main_color' ); ?>" type="text" value="<?php echo $icon_bg_main_color; ?>" /></div>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'icon_bg_color' ); ?>"><?php _e('Icon Hover Background Color:', 'mk_framework'); ?></label>
				<div class="color-picker-holder"><input data-default-color="<?php $icon_bg_color; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_bg_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_bg_color' ); ?>" type="text" value="<?php echo $icon_bg_color; ?>" /></div>
			</p>

		</div>

		<p>
			<label for="<?php echo $this->get_field_id( 'enable_sites' ); ?>">Enable Social Icon:</label>
			<select name="<?php echo $this->get_field_name( 'enable_sites' ); ?>[]" style="height:10em" id="<?php echo $this->get_field_id( 'enable_sites' ); ?>" class="social_icon_select_sites widefat" multiple="multiple">
				<?php foreach ( $this->sites as $site ):?>
				<option value="<?php echo strtolower( $site );?>"<?php echo in_array( strtolower( $site ), $enable_sites )? 'selected="selected"':'';?>><?php echo $site;?></option>
				<?php endforeach;?>
			</select>
		</p>

		<p>
			<em><?php "Note: Please input FULL URL <br/>(e.g. <code>http://www.facebook.com/username</code>)";?></em>
		</p>
		<div class="social_icon_wrap">
		<?php foreach ( $this->sites as $site ):?>
		<p class="social_icon_<?php echo strtolower( $site );?>" <?php if ( !in_array( strtolower( $site ), $enable_sites ) ):?>style="display:none"<?php endif;?>>
			<label for="<?php echo $this->get_field_id( strtolower( $site ) ); ?>"><?php echo $site.' '.'URL:'?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( strtolower( $site ) ); ?>" name="<?php echo $this->get_field_name( strtolower( $site ) ); ?>" type="text" value="<?php echo $$site; ?>" />
		</p>
		<?php endforeach;?>
		</div>

		<p><label for="<?php echo $this->get_field_id( 'custom_count' ); ?>">How many custom icons to add?</label>
		<input id="<?php echo $this->get_field_id( 'custom_count' ); ?>" class="social_icon_custom_count" name="<?php echo $this->get_field_name( 'custom_count' ); ?>" type="text" value="<?php echo $custom_count; ?>" size="3" /></p>

		<div class="social_custom_icon_wrap">
		<?php for ( $i=1;$i<=10;$i++ ): $custom_name='custom_'.$i.'_name';$custom_url='custom_'.$i.'_url'; $custom_icon='custom_'.$i.'_icon'; ?>
			<div class="social_icon_custom_<?php echo $i;?>" <?php if ( $i>$custom_count ):?>style="display:none"<?php endif;?>>
				<p><label for="<?php echo $this->get_field_id( $custom_name ); ?>"><?php printf( 'Custom %s Name:', $i );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_name ); ?>" name="<?php echo $this->get_field_name( $custom_name ); ?>" type="text" value="<?php echo $$custom_name; ?>" /></p>
				<p><label for="<?php echo $this->get_field_id( $custom_url ); ?>"><?php printf( 'Custom %s URL:', $i );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_url ); ?>" name="<?php echo $this->get_field_name( $custom_url ); ?>" type="text" value="<?php echo $$custom_url; ?>" /></p>
				<p><label for="<?php echo $this->get_field_id( $custom_icon ); ?>"><?php printf( 'Custom %s Icon:', $i );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_icon ); ?>" name="<?php echo $this->get_field_name( $custom_icon ); ?>" type="text" value="<?php echo $$custom_icon; ?>" /></p>
			</div>

		<?php endfor;?>
		</div>

		<script type="text/javascript">


			jQuery(document).ready(function() {
				mk_color_picker();
		    	mk_social_networks_custom_skin();
			});

		</script>

<?php

	}
}
/***************************************************/
