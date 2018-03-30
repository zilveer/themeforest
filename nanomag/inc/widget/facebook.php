<?php
add_action('widgets_init','jellywp_fblikebox_load_widgets');

function jellywp_fblikebox_load_widgets(){
		register_widget("jellywp_fb_likebox_widget");
}

class jellywp_fb_likebox_widget extends WP_widget{

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function __construct(){	
		$widget_ops = array( 'classname' => 'fblikebox_widget', 'description' => esc_attr__( 'Facebook widget.', 'nanomag') );
		parent::__construct('jellywp_fb_likebox_widget', esc_attr__('jellywp: Facebook widget', 'nanomag'), $widget_ops);
			
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$page_url = $instance['page_url'];
		$lang = $instance['lang'];		
		$theme_color = $instance['theme_color'];
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$stream = isset($instance['stream']) ? 'true' : 'false';		
		$header = isset($instance['header']) ? 'true' : 'false';				
		
		echo $before_widget;
		?>
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>

<div class="widget_container">   
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $lang; ?>/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
			

					<div class="fb-like-box" data-href="<?php echo esc_attr($page_url); ?>"  data-show-faces="<?php echo esc_attr($show_faces); ?>" <?php if( $theme_color == 'dark' ) echo esc_attr('data-colorscheme="dark"'); ?> data-stream="<?php echo esc_attr($stream); ?>" data-header="<?php echo esc_attr($header); ?>"></div>
	
     <div class="clear"></div>
    </div>
    				

			<?php
			echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['page_url'] = $new_instance['page_url'];
		$instance['lang'] = $new_instance['lang'];
		$instance['theme_color'] = $new_instance['theme_color'];
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['stream'] = $new_instance['stream'];		
		$instance['header'] = $new_instance['header'];	
		
		
		return $instance;
	}



	function form($instance){
		?>
		<?php
			$defaults = array( 'title'=> esc_attr__( '', 'nanomag'), 'page_url' => 'https://web.facebook.com/envato', 'lang' => 'en_US', 'theme_color' => 'light', 'show_faces' => 'on', 'stream' => null, 'header' => 'on' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e( 'Title:', 'nanomag'  ); ?></label>
			<input class="widefat" width="100%" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('page_url')); ?>"><?php esc_attr_e( 'Facebook Page URL:', 'nanomag'  ); ?></label>
			<input class="widefat" width="100%" id="<?php echo esc_attr($this->get_field_id('page_url')); ?>" name="<?php echo esc_attr($this->get_field_name('page_url')); ?>" type="text" value="<?php echo esc_attr($instance['page_url']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('lang')); ?>"><?php esc_attr_e( 'Facebook Language:', 'nanomag'  ); ?></label>
			<input class="widefat" width="100%" id="<?php echo esc_attr($this->get_field_id('lang')); ?>" name="<?php echo esc_attr($this->get_field_name('lang')); ?>" type="text" value="<?php echo esc_attr($instance['lang']); ?>" />
		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_faces')); ?>" name="<?php echo esc_attr($this->get_field_name('show_faces')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('show_faces')); ?>"><?php esc_attr_e( 'Show Faces', 'nanomag'  ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['stream'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('stream')); ?>" name="<?php echo esc_attr($this->get_field_name('stream')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('stream')); ?>"><?php esc_attr_e( 'Show Stream', 'nanomag'  ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['header'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('header')); ?>" name="<?php echo esc_attr($this->get_field_name('header')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('header')); ?>"><?php esc_attr_e( 'Show Header', 'nanomag'  ); ?></label>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'theme_color' )); ?>"><?php esc_attr_e('Theme Color:', 'nanomag'); ?></label> 
			<select id="<?php echo esc_attr($this->get_field_id( 'theme_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'theme_color' )); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'dark' == $instance['theme_color'] ) echo esc_attr('selected="selected"'); ?>>dark</option>
				<option <?php if ( 'light' == $instance['theme_color'] ) echo esc_attr('selected="selected"'); ?>>light</option>
			</select>
		</p>
		
		
		<?php

	}
}
?>