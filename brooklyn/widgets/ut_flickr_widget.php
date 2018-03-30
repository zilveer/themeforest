<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class WP_Widget_Flickr extends WP_Widget {
	
	protected $slug = 'ut_flickr';
	
	function __construct() {
		$widget_ops = array('classname' => 'ut_widget_flickr', 'description' => __( 'Displays Flickr images by user or tags.', 'unitedthemes') );
		parent::__construct('ut_flickr', __('United Themes - Flickrstream', 'unitedthemes'), $widget_ops);
		$this->alt_option_name = 'ut_widget_flickr';
	}

    function form($instance) {
	
	if ( $instance ) {
	    
		$title = esc_attr( $instance['title'] );
	    
		$flickr_public_values = !empty($instance['ut_flickr_public_values']) ? esc_attr( $instance['ut_flickr_public_values'] ) : '';
	    $flickr_limit = !empty($instance['ut_flickr_limit']) ? esc_attr( $instance['ut_flickr_limit'] ) : '';
		
	    if( !$flickr_limit ) $flickr_limit = 8;
	} ?>

	<p>
	    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'unitedthemes'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo isset($title) ? $title : ''; ?>" />
	    </label>
	</p>
	<p>
	    <label for="<?php echo $this->get_field_id('ut_flickr_public_values'); ?>"><?php _e('Flickr ID:', 'unitedthemes'); ?></label>
	    <input id="<?php echo $this->get_field_id('ut_flickr_public_values'); ?>" name="<?php echo $this->get_field_name('ut_flickr_public_values'); ?>" type="text" value="<?php echo isset($flickr_public_values) ? $flickr_public_values : ''; ?>" />
	</p>
	<p>
	    <label for="<?php echo $this->get_field_id('ut_flickr_limit'); ?>"><?php _e('Limit:', 'unitedthemes'); ?></label>
	    <input id="<?php echo $this->get_field_id('ut_flickr_limit'); ?>" name="<?php echo $this->get_field_name('ut_flickr_limit'); ?>" size="1" type="text" value="<?php echo isset($flickr_limit) ? $flickr_limit : ''; ?>" />
	</p>

	<?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ) {

	extract( $args ); extract( $instance );
	$title = apply_filters( $this->slug, $title );

	if($title) { $title = $before_title.do_shortcode($title).$after_title; }
	
	/* fallback values */ 
	$ut_flickr_limit = empty($ut_flickr_limit) ? 5 : $ut_flickr_limit;
	$ut_flickr_public_values = empty($ut_flickr_public_values) ? '60616902@N03' : $ut_flickr_public_values; 
	
	$var = rand();
	
	echo $before_widget;
	echo $title.'
	
		<script type="text/javascript">
		(function($){
				
				$(document).ready(function($) {
					  
					 function add_flickr_item( data , itemID ) {
								 
						 var pic 		= data.items[itemID];
						 var smallpic 	= pic.media.m.replace(\'_m.jpg\', \'_s.jpg\');	
						 
						 setTimeout(function () { 
							
							var item = $("<a title=\'" + pic.title + "\' href=\'" + pic.link + "\' target=\'_blank\'><img width=\"75px\" height=\"75px\" src=\'" + smallpic + "\' /></a>").hide().fadeIn(600 , "easeInOutExpo", function() {
								$(this).parent().addClass("loaded");
							});
														
							$(".flickr_'.$var.'").find(".ut-flickr-item-"+itemID).append(item);
							
						 }, 100 * itemID )
						 
						 
					  }	  
					   
					  $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id='.$ut_flickr_public_values.'&format=json&jsoncallback=?", function(data) {
							  
							for (i=1; i <= '.$ut_flickr_limit.'; i++) {
								add_flickr_item(data , i);							
						    }
							  
					  });
					   
				});
				
		})(jQuery);	
		</script>
	    
		
		<ul class="flickr_items flickr_'.$var.' clearfix">';
	    	
			for($i=1; $i<=$ut_flickr_limit; $i++ ) {
				
				echo '<li class="ut-flickr-item ut-flickr-item-'.$i.'"></li>';
			
			}
			
		echo '</ul>';
	
	echo $after_widget;

    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("WP_Widget_Flickr");' ) );
?>
