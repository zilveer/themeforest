<?php 

add_action('widgets_init','mom_widget_social_icons');

function mom_widget_social_icons() {
	register_widget('mom_widget_social_icons');
	
	}

class mom_widget_social_icons extends WP_Widget {
		var $networks = array(
			'Facebook',
			'Twitter',
			'GooglePlus',
			'RSS',
			'Youtube',
			'Dribbble',
			'Vimeo',
			'Pinterest',
			'Instagram',
			'Tumblr',
			'Linkedin',
			'SoundCloud',
		);
	
	
	function mom_widget_social_icons() {
			
		$widget_ops = array('classname' => 'momizat-social-icons','description' => __('Widget display social networks icons','theme'));
		parent::__construct('momizatsocialIcons',__('Effective - Social Icons','theme'),$widget_ops);
		if ('widgets.php' == basename($_SERVER['PHP_SELF'])) {
			add_action( 'admin_print_scripts', array(&$this, 'add_admin_script') );
		}
	}

	function add_admin_script(){
		wp_enqueue_script( 'social-icons-widget', get_template_directory_uri() . '/framework/widgets/js/social-icons.js', array('jquery'));
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$icons = isset($instance['icons']) ? $instance['icons'] : array();

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
       <div class="mom-socials-icons mom-socials-widget">
		<ul>
			<?php
				foreach( $icons as $icon ) {
					$url = isset($instance[$icon]) ? $instance[$icon]:'';
					switch ($icon) {
						case 'Facebook':
							echo '<li class="facebook"><a href="'.$url.'"><i class="fa-icon-facebook "></i></a></li>';
						break;
						case 'Twitter':
							echo '<li class="twitter"><a href="'.$url.'"><i class="fa-icon-twitter "></i></a></li>';
						break;
						case 'GooglePlus':
							echo '<li class="googleplus"><a href="'.$url.'"><i class="fa-icon-google-plus "></i></a></li>';
						break;
						case 'RSS':
							echo '<li class="rss"><a href="'.$url.'"><i class="fa-icon-rss "></i></a></li>';
						break;
						case 'Youtube':
							echo '<li class="youtube"><a href="'.$url.'"><i class="fa-icon-youtube "></i></a></li>';
						break;
						case 'Dribbble':
							echo '<li class="dribbble"><a href="'.$url.'"><i class="fa-icon-dribbble "></i></a></li>';
						break;
						case 'Vimeo':
							echo '<li class="vimeo"><a href="'.$url.'"><i class="momizat-icon-vimeo "></i></a></li>';
						break;
						case 'Pinterest':
							echo '<li class="pinterest"><a href="'.$url.'"><i class="fa-icon-pinterest "></i></a></li>';
						break;
						case 'Instagram':
							echo '<li class="instgram"><a href="'.$url.'"><i class="fa-icon-instagram "></i></a></li>';
						break;
						case 'Tumblr':
							echo '<li class="tumblr"><a href="'.$url.'"><i class="fa-icon-tumblr "></i></a></li>';
						break;
						case 'Linkedin':
							echo '<li class="linkedin"><a href="'.$url.'"><i class="fa-icon-linkedin "></i></a></li>';
						break;
						case 'SoundCloud':
							echo '<li class="soundcloud"><a href="'.$url.'"><i class="momizat-icon-soundcloud "></i></a></li>';
						break;

					}
				}
			?>
		</ul>
	</div>
<?php
/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icons'] = $new_instance['icons'];
		if(!empty($instance['icons'])){
			foreach($instance['icons'] as $icon){
			$instance[$icon] = isset($new_instance[$icon])?strip_tags($new_instance[$icon]):'';
			}
		}
		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
				  'title' => __('Follow Us','theme'), 
 			);

		$instance = wp_parse_args( (array) $instance, $defaults );
		$icons = isset($instance['icons']) ? $instance['icons'] : array();
		foreach($this->networks as $icon){
			$$icon = isset($instance[$icon]) ? esc_attr($instance[$icon]) : '';
		}
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'icons' ); ?>"><?php _e('icons', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'icons' ); ?>" name="<?php echo $this->get_field_name( 'icons' ); ?>[]" class="widefat social_select_icons" multiple="multiple">
				<?php foreach($this->networks as $icon):?>
				<option value="<?php echo $icon;?>"<?php echo in_array($icon, $icons)? 'selected="selected"':'';?>><?php echo $icon;?></option>
				<?php endforeach;?>
		</select>
		</p>
		
		<div class="social-icons">
		<?php foreach($this->networks as $icon):?>
		<p class="social_icon_<?php echo $icon;?>" <?php if(!in_array($icon, $icons)):?>style="display:none"<?php endif;?>>
			<label for="<?php echo $this->get_field_id( $icon ); ?>"><?php echo $icon.' '.__('URL:', 'theme')?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( $icon ); ?>" name="<?php echo $this->get_field_name( $icon ); ?>" type="text" value="<?php echo $$icon; ?>" />
		</p>
		<?php endforeach;?>
		</div>


   <?php 
}
	} //end class