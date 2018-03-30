<?php

class Flickr_Widget extends WP_Widget {
	function Flickr_Widget() {
		$widget_ops = array('classname' => 'flickr_widget', 'description' => __('Show your flickr photos on your site.','smartbox'));
		parent::__construct(false, 'DESIGNARE _ Flickr Photos', $widget_ops);
	}
function form($instance) {

	if (isset($instance['title'])){
		$title = esc_attr($instance['title']); 
	} else $title = "";
		
	if (isset($instance['flickrid'])){
		$flickrid = esc_attr($instance['flickrid']);  		
	} else $flickrid = "";
	
	if (isset($instance['nphotos'])){
		$nphotos = esc_attr($instance['nphotos']); 
	} else $nphotos = "";

	if (isset($instance['linkprofile'])){
		$linkprofile = esc_attr($instance['linkprofile']); 
	} else $linkprofile = "";
		
?>  
        
       <p><label for="<?php echo $this->get_field_id('title'); ?>">&#8212; <?php _e('Title','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p> 
       <p><label for="<?php echo $this->get_field_id('flickrid'); ?>">&#8212; <?php _e('Flickr ID','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('flickrid'); ?>" name="<?php echo $this->get_field_name('flickrid'); ?>" type="text" value="<?php echo $flickrid; ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('nphotos'); ?>">&#8212; <?php _e('Number Photos to show','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('nphotos'); ?>" name="<?php echo $this->get_field_name('nphotos'); ?>" type="text" value="<?php echo $nphotos; ?>" /><br><span class="flickr-stuff">If 0 will show 20 photos.</span></label></p>
       <p><label for="<?php echo $this->get_field_id('linkprofile'); ?>">&#8212; <?php _e('Link to Profile','smartbox'); ?> &nbsp;<input id="<?php echo $this->get_field_id('linkprofile'); ?>" name="<?php echo $this->get_field_name('linkprofile'); ?>" type="checkbox" value="yes" <?php if($linkprofile == "yes") echo 'checked'; ?>/><br><span class="flickr-stuff">Title with link to your profile.</span></label></p> 
        
<?php
	}
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['flickrid'] = $new_instance['flickrid'];
    $instance['nphotos'] = $new_instance['nphotos'];
    $instance['linkprofile'] = $new_instance['linkprofile'];
		return $instance;
	}
	
function widget($args, $instance) {
		
	extract($args);
    $title = apply_filters('widget_title', $instance['title'], $instance);
    $flickrid = $instance['flickrid'];
    $nphotos = $instance['nphotos'];
    $linkprofile = $instance['linkprofile'];
    
    if(empty($nphotos) || $nphotos == 0 )
    	$nphotos = 20;
    
    echo $before_widget;
    wp_enqueue_script('flickr', DESIGNARE_JS_PATH .'jflickrfeed.js', array(), '2.5.2',$in_footer = true);
    ?>
    
    <div class="flickr_container">
    		<?php if (!empty($title)) { ?>
				<div class="title"><h4><?php 
	  			
	  				if($linkprofile == 'yes') echo "<a href='http://www.flickr.com/photos/" . $flickrid . "/' target='_blank'>" . $title . "</a>";
	  				else echo $title;
	  			
	  		?></h4><hr></div><?php } ?>
				<ul id="flickr" class="thumbs"></ul>
			</div>
    
    <script>
    	jQuery(document).ready(function($){
    		//flicker gadget
				$('#flickr').jflickrfeed({
						limit: <?php echo $nphotos; ?>,
						qstrings: {
							id: '<?php echo $flickrid; ?>'
						},
						itemTemplate: '<li>'+
										'<a rel="prettyPhoto[gallery1]" href="{{image}}" title="{{title}}">' +
											'<img src="{{image_s}}" alt="{{title}}" />' +
										'</a>' +
									  '</li>'
					}, function(data) {
						$('#flickr a').prettyPhoto({autoplay_slideshow:false, deeplinking: false, show_title: false, social_tools: ''});
				});
			});
    </script>
    
    <?php
  
    echo $after_widget;
	}
}
register_widget('Flickr_Widget');

?>
