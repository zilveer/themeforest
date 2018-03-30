<?php

class Artbees_Widget_Social extends WP_Widget {

	var $sites = array(
			'px',
            'aim',
            'amazon',
            'apple',
            'bebo',
            'behance',
            'blogger', 
            'delicious', 
            'deviantart', 
            'digg', 
            'dribbble', 
            'dropbox', 
            'envato', 
            'facebook', 
            'flickr', 
            'github', 
            'google', 
            'googleplus', 
            'lastfm', 
            'linkedin',
            'instagram', 
            'myspace', 
            'path', 
            'pinterest', 
            'reddit', 
            'rss', 
            'skype', 
            'stumbleupon', 
            'tumblr', 
            'twitter', 
            'vimeo', 
            'wordpress', 
            'yahoo', 
            'yelp', 
            'youtube',
            'xing',
            'imdb',
            'qzone',
            'renren',
            'vk',
            'wechat',
            'weibo',
            'whatsapp',
            'soundcloud',


	);
	var $size = array(

		'large' => array(
			'name'=>'Large',
			'path'=>'large',
		),

		'medium' => array(
			'name'=>'Medium',
			'path'=>'medium',
		),

		'small' => array(
			'name'=>'Small',
			'path'=>'small',
		),

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

	}


	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$alt = isset( $instance['alt'] )?$instance['alt']:'';
		$size = $instance['size'];
		$style = isset($instance['style']) ? $instance['style'] : 'simple';
		$skin = $instance['skin'];
		$align = isset($instance['align']) ? $instance['align'] : 'left'; 
		$icon_color = isset($instance['icon_color']) ? $instance['icon_color'] : '';
		$icon_hover_color = isset($instance['icon_hover_color']) ? $instance['icon_hover_color'] : '';
		$icon_border_color = isset($instance['icon_border_color']) ? $instance['icon_border_color'] : '';
		$icon_bg_main_color = isset($instance['icon_bg_main_color']) ? $instance['icon_bg_main_color'] : '';
		$icon_bg_color = isset($instance['icon_bg_color']) ? $instance['icon_bg_color'] : '';
		$icons_margin = isset($instance['icons_margin']) ? $instance['icons_margin'] : '';
		$custom_count = isset($instance['custom_count']) ? $instance['custom_count'] : '';
		$icon_style_css = '';
		$uniqueID = 'social-'.uniqid();

		switch ($size) {
			case 'small':
				if($style == 'simple-circle' || $style == 'square-pointed' || $style == 'square-rounded') {
					$icon_height = 10;
				} else {
					$icon_height = 16;
				}
				break;
			case 'medium':
				if($style == 'simple-circle' || $style == 'square-pointed' || $style == 'square-rounded') {
					$icon_height = 12;
				} else {
					$icon_height = 24;
				}
				break;
			case 'large':
				if($style == 'simple-circle' || $style == 'square-pointed' || $style == 'square-rounded') {
					$icon_height = 16;
				} else {
					$icon_height = 32;
				}
				break;		
			
			default:
				$icon_height = 16;
				break;
		}

	

		switch($style) {
        	case 'rounded' :
            $icon_style = 'mk-jupiter-icon-square-';
            break;
            case 'simple' :
            $icon_style = 'mk-jupiter-icon-simple-';
            break;
            case 'simple-circle' :
            $icon_style = 'mk-jupiter-icon-simple-';
            $icon_style_css = 'mk-circle-frame ';
            break;
            case 'circle' :
            $icon_style = 'mk-jupiter-icon-';
            break;
            case 'square-pointed' :
            $icon_style = 'mk-jupiter-icon-simple-';
            $icon_style_css = 'mk-square-pointed ';
            break;
            case 'square-rounded' :
            $icon_style = 'mk-jupiter-icon-simple-';
            $icon_style_css = 'mk-square-rounded ';
            break;
            default : 
            $icon_style = 'mk-jupiter-icon-simple-';
        }

		$output ='';

		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {

                // redirect Xing to use other families 
                if($site == 'xing') {
                    switch ($style) {
                        case 'rounded': $icon_name = 'mk-moon-xing';   break; // icomoon
                        case 'circle' : $icon_name = 'mk-moon-xing-2'; break; // icomoon
                        case 'simple' : $icon_name = 'mk-icon-xing';   break; // font-awesome
                        default:        $icon_name = 'mk-icon-xing';
                    } 
                } else { 
                    $icon_name = $icon_style . $site; 
                }

				$path = $this->size[$size]['path'];
				$link = isset( $instance[strtolower( $site )] )?$instance[strtolower( $site )]:'#';
					$output .= '<a href="'.$link.'" rel="nofollow" class="builtin-icons '.$icon_style_css.$skin.' '.$path.' '.$site.'-hover" target="_blank" alt="'.$alt.' '.$site.'" title="'.$alt.' '.$site.'">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon_name, $icon_height).'</a>';
	
			}
			if($skin == 'custom' || !empty($icons_margin) ) {
				if ( !empty($icon_color) || !empty($icon_hover_color) || !empty($icon_bg_color) || !empty($icon_bg_main_color) || !empty($icon_border_color) || !empty($icons_margin) ) {
					$output .= '
					<style>
						#'.$uniqueID.' a { 
							opacity: 1 !important;';
					if ( !empty($icons_margin) ) {
						$output .= 'margin: '.$icons_margin.'px;';
					}
					if ( !empty($icon_color) ) { 
						$output .= 'color: '.$icon_color.' !important;';
					}
					if ( !empty($icon_border_color) ) { 
						$output .= 'border-color: '.$icon_border_color.' !important;';
					}
					if ( !empty($icon_bg_main_color) && ($style == 'square-pointed' || $style == 'square-rounded' || $style == 'simple-circle')) { 
						$output .= 'background-color: '.$icon_bg_main_color.' !important;';
					}
					$output .= '}';
					$output .= '
						#'.$uniqueID.' a:hover { ';
					if ( !empty($icon_hover_color) ) { 
						$output .= 'color: '.$icon_hover_color.' !important;';
					}
					if ( !empty($icon_bg_color) && ($style == 'square-pointed' || $style == 'square-rounded' || $style == 'simple-circle')) { 
						$output .= 'background-color: '.$icon_bg_color.' !important;';
					}
					$output .= '}';

					$output .= '
						#'.$uniqueID.' a:hover .mk-svg-icon { ';
					if ( !empty($icon_hover_color) ) { 
						$output .= 'fill: '.$icon_hover_color.' !important;';
					}
					$output .= '}';

					$output .='</style>';
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



		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
				echo '<div id="'.$uniqueID.'" class="align-'.$align.'">';
				echo $output;
				echo '</div>';
				echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['alt'] = strip_tags( $new_instance['alt'] );
		$instance['size'] = $new_instance['size'];
		$instance['align'] = $new_instance['align'];
		$instance['skin'] = $new_instance['skin'];
		$instance['icon_color'] = $new_instance['icon_color'];
		$instance['icon_hover_color'] = $new_instance['icon_hover_color'];
		$instance['icon_border_color'] = $new_instance['icon_border_color'];
		$instance['icon_bg_main_color'] = $new_instance['icon_bg_main_color'];
		$instance['icon_bg_color'] = $new_instance['icon_bg_color'];
		$instance['icons_margin'] = $new_instance['icons_margin'];
		$instance['style'] = $new_instance['style'];
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
		$size = isset( $instance['size'] ) ? $instance['size'] : 'medium';
		$align = isset( $instance['align'] ) ? $instance['align'] : 'left';
		$skin = isset( $instance['skin'] ) ? $instance['skin'] : 'dark';
		$icon_color = isset( $instance['icon_color'] ) ? $instance['icon_color'] : '';
		$icon_hover_color = isset( $instance['icon_hover_color'] ) ? $instance['icon_hover_color'] : '';
		$icon_border_color = isset( $instance['icon_border_color'] ) ? $instance['icon_border_color'] : '';
		$icon_bg_main_color = isset( $instance['icon_bg_main_color'] ) ? $instance['icon_bg_main_color'] : '';
		$icon_bg_color = isset( $instance['icon_bg_color'] ) ? $instance['icon_bg_color'] : '';
		$icons_margin = isset( $instance['icons_margin'] ) ? $instance['icons_margin'] : '';
		$style = isset( $instance['style'] ) ? $instance['style'] : 'circle';
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

		$uniqid = uniqid();
		
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'alt' ); ?>"><?php _e('Icon Alt Title:', 'mk_framework'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id( 'alt' ); ?>" name="<?php echo $this->get_field_name( 'alt' ); ?>" type="text" value="<?php echo $alt; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e('Size:', 'mk_framework'); ?></label>
			<select name="<?php echo $this->get_field_name( 'size' ); ?>" id="<?php echo $this->get_field_id( 'size' ); ?>" class="widefat">
				<?php foreach ( $this->size as $name => $value ):?>
				<option value="<?php echo $name;?>"<?php selected( $size, $name );?>><?php echo $value['name'];?></option>
				<?php endforeach;?>
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
		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e('Style:', 'mk_framework'); ?></label>
			<select name="<?php echo $this->get_field_name( 'style' ); ?>" id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat">
				<option value="circle"<?php selected( $style, 'circle');?>><?php _e('Circle', 'mk_framework'); ?></option>
				<option value="rounded"<?php selected( $style, 'rounded');?>><?php _e('Rounded', 'mk_framework'); ?></option>
				<option value="simple"<?php selected( $style, 'simple');?>><?php _e('Simple', 'mk_framework'); ?></option>
				<option value="simple-circle"<?php selected( $style, 'simple-circle');?>><?php _e('Simple Outline', 'mk_framework'); ?></option>
				<option value="square-pointed"<?php selected( $style, 'square-pointed');?>><?php _e('Square Pointed', 'mk_framework'); ?></option>
				<option value="square-rounded"<?php selected( $style, 'square-rounded');?>><?php _e('Square Rounded', 'mk_framework'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'skin' ); ?>"><?php _e('Color:', 'mk_framework'); ?></label>
			<select name="<?php echo $this->get_field_name( 'skin' ); ?>" id="<?php echo $this->get_field_id( 'skin' ); ?>" class="widefat social-network-select-skin">
				<option value="dark"<?php selected( $skin, 'dark');?>><?php _e('Dark', 'mk_framework'); ?></option>
				<option value="light"<?php selected( $skin, 'light');?>><?php _e('Light', 'mk_framework'); ?></option>
				<option value="custom"<?php selected( $skin, 'custom');?>><?php _e('Custom', 'mk_framework'); ?></option>
			</select>
		</p>

		<div id="mk-social-custom-skin">

		<p>
			<label for="<?php echo $this->get_field_id( 'icon_color' ); ?>"><?php _e('Icon Color:', 'mk_framework'); ?></label>
			<div class="color-picker-holder"><input data-default-color="<?php $value['default']; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_color' ); ?>" type="text" value="<?php echo $icon_color; ?>" /></div>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_hover_color' ); ?>"><?php _e('Icon Hover Color:', 'mk_framework'); ?></label>
			<div class="color-picker-holder"><input data-default-color="<?php $value['default']; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_hover_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_hover_color' ); ?>" type="text" value="<?php echo $icon_hover_color; ?>" /></div>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_border_color' ); ?>"><?php _e('Icon Border Color:', 'mk_framework'); ?></label>
			<div class="color-picker-holder"><input data-default-color="<?php $value['default']; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_border_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_border_color' ); ?>" type="text" value="<?php echo $icon_border_color; ?>" /></div>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_bg_main_color' ); ?>"><?php _e('Icon Background Color:', 'mk_framework'); ?></label>
			<div class="color-picker-holder"><input data-default-color="<?php $value['default']; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_bg_main_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_bg_main_color' ); ?>" type="text" value="<?php echo $icon_bg_main_color; ?>" /></div>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_bg_color' ); ?>"><?php _e('Icon Hover Background Color:', 'mk_framework'); ?></label>
			<div class="color-picker-holder"><input data-default-color="<?php $value['default']; ?>" class="color-picker" id="<?php echo $this->get_field_id( 'icon_bg_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_bg_color' ); ?>" type="text" value="<?php echo $icon_bg_color; ?>" /></div>
		</p>

		</div>

		<p><label for="<?php echo $this->get_field_id( 'icons_margin' ); ?>"><?php _e('Icons Margin (px):', 'mk_framework'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id( 'icons_margin' ); ?>" name="<?php echo $this->get_field_name( 'icons_margin' ); ?>" type="text" value="<?php echo $icons_margin; ?>" /></p>
		
		<p class="mk-choose-social-networks">
			<label for="<?php echo $this->get_field_id( 'enable_sites' ); ?>"><?php _e('Choose Sites:', 'mk_framework'); ?></label>
			<select name="<?php echo $this->get_field_name( 'enable_sites' ); ?>[]" id="<?php echo $this->get_field_id( 'enable_sites' ); ?>" style="width:100%" class="social_icon_select_sites select2-<?php echo $uniqid; ?> widefat" multiple="multiple">
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

		<p><label for="<?php echo $this->get_field_id( 'custom_count' ); ?>"><?php _e('How many custom icons to add?', 'mk_framework'); ?></label>
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
		    	jQuery(".select2-<?php echo $uniqid; ?>").select2({
         			placeholder: "Select Options"
    			});

			});
		</script>

<?php

	}
}

register_widget("Artbees_Widget_Social");
