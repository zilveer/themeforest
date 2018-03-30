<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Two Columns Categories Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget thats displays two columns categories
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'ct_categories_widget');

function ct_categories_widget()
{
	register_widget('CT_Categories_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class CT_Categories_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CT_Categories_Widget() {
		
		/* Widget settings. */
		$widget_ops = array(	'classname'		=> 'ct-categories-widget',
								'description'	=> __( 'Two columns categories widget', 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 255,
								'height'	=> 350,
								'id_base'	=> 'ct_categories_widget'
							);

		/* Create the widget. */		
		parent::__construct( 'ct_categories_widget', __( 'CT: Categories Widget' , 'color-theme-framework' ), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters ('widget_title', $instance ['title']);
		$background_title = $instance['background_title'];
		
		/* Before widget (defined by themes). */
		echo "\n<!-- START CATEGORIES WIDGET -->\n";
		echo $before_widget;

		if ( $title ) :
			echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
		endif;
		?>

		<?php
	  		$cat_left = '';
	  		$cat_right = '';
	  		$cats = explode("<br />",wp_list_categories('title_li=&echo=0&style=none'));
 	  		$cat_n = count($cats) - 1;
 	  		for ($i=0;$i<$cat_n;$i++):
	    		if ($i<$cat_n/2):
		  		$cat_left = $cat_left.'<li class="ct-google-font">'.$cats[$i].'</li>';
				elseif ($i>=$cat_n/2):
		  		$cat_right = $cat_right.'<li class="ct-google-font">'.$cats[$i].'</li>';
				endif;
	  		endfor;
		?>
	
		<div class="row">
	  		<div class="col-lg-6">
				<ul class="left-col">
	  	  			<?php echo $cat_left;?>
				</ul><!-- left-col -->
	  		</div><!-- col-lg-6 -->
	  		
	  		<div class="col-lg-6">
				<ul class="right-col">
	  	  			<?php echo $cat_right;?>
				</ul><!-- right-col -->
	  		</div><!-- col-lg-6 -->
		</div><!-- row -->
	
		<?php

		// After widget (defined by theme functions file)
		echo $after_widget;
		echo "\n<!-- END CATEGORIES WIDGET -->\n";
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['background_title'] = strip_tags($new_instance['background_title']);

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array(	'title'				=> __( 'Categories' , 'color-theme-framework'),
							'background_title'	=> '#ff0000'
						);

		$instance = wp_parse_args((array) $instance, $defaults); 
		$background_title = esc_attr($instance['background_title']); ?>

		<script type="text/javascript">
		//<![CDATA[
			jQuery(document).ready(function($) {  
				$('.ct-color-picker').wpColorPicker();
			});
		//]]>   
		</script>
		  
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" data-default-color="#2b373f" />
		</p>
        
	<?php
	}
}
?>