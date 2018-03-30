<?php
/**
* @KingSize 2013
* The PHP code for setup Theme widget Contact info.
* Begin creating widget Contact info
* Contact Us
*/
class kingsize_contactinfo_widget extends WP_Widget {
	function kingsize_contactinfo_widget() {
		$widget_ops = array('classname' => 'widget_kingsize_contactinfo', 'description' => 'Sidebar contact info widget' );
		//$this->WP_Widget('', 'KingSize Contact Info', $widget_ops);
		parent::__construct('', 'KingSize Contact Info', $widget_ops); 
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;		
		
		if ($instance['title'] == ''){
			$instance['title'] = 'Contact Info';
		}

		echo '<h3 class="widget-title">'. $instance['title'] .'</h3>';
		echo '<div id="recent_posts" class="blog_section">';
		echo '<ul class="side-nav contact-widget">';

		if ($instance['contactinfo_phone'] != ''){
			echo '<li class="phone"><i class="fa fa-phone"></i> '. $instance['contactinfo_phone'] .'</li>';
		}
		
		if ($instance['contactinfo_fax'] != ''){
			echo '<li class="fax"><i class="fa fa-fax"></i> '. $instance['contactinfo_fax'] .'</li>';
		}
		
		if ($instance['contactinfo_email'] != ''){
			if($instance['contactinfo_email_link']==1)
				echo '<li class="email"><i class="fa fa-envelope"></i> <a href="mailto:'.$instance['contactinfo_email'].'">' .$instance['contactinfo_email']. '</a></li>';
			else
				echo '<li class="email"><i class="fa fa-envelope"></i> ' .$instance['contactinfo_email']. '</li>';
		}
			
		if ($instance['contactinfo_address'] != ''){
			echo '<li class="house"><i class="fa fa-home"></i> '. $instance['contactinfo_address'] .', '. $instance['contactinfo_city'] .'</li>';
		}

		echo '</ul>';
		
		echo '</div>';
		
		// The map generation
		if ($instance['contactinfo_address'] != '' && $instance['contactinfo_city']!= ''){
			 
		   ##### adding the class #######
		   if ( is_active_widget(false, false, $this->id_base, true) ){
			   if($instance['contactinfo_showmap'] != "0"  || $instance['contactinfo_showmap'] == "" ) 
		    	   $this->contact_widget_scripts();
            }

			 ///fixing the width and height
			 global $wp_query;
			 $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
			 $map_width = "180";
			 $map_height = "180";

			 if($template_name == "template-contact.php") :			 
				 $map_width = "240";
				 $map_height = "233";
			 endif;

			if( $instance['contactinfo_showmap'] != "0" || $instance['contactinfo_showmap'] == "" ) :
				echo '<div class="gmap">';
				echo '<h3><a href="#?custom=true&width=400&height=300" class="mapclick"  rel="MapPhoto" title="'.$instance['contactinfo_address'] .','. $instance['contactinfo_city'].'"><img src="http://maps.google.com/maps/api/staticmap?center='.$instance['contactinfo_address'] .','. $instance['contactinfo_city'].'&amp;zoom=15&amp;markers='.$instance['contactinfo_address'] .','. $instance['contactinfo_city'].'&amp;size='.$map_width.'x'.$map_height.'&amp;sensor=false" alt="map" class="map" width="'.$map_width.'"/></a></h3>';	
				echo '</div>';
			endif;
		}	

		
		
		echo $after_widget;
	}
	
	function contact_widget_scripts()
	{
		global $data;

		###### PrettyPhoto JS & STYLE ######
		//registering prettyphoto style and script
		wp_register_style( 'prettyphoto-css', get_template_directory_uri().'/css/prettyPhoto.css');
		wp_register_script('prettyphoto-js', get_template_directory_uri() . "/js/jquery.prettyPhoto.js");
		
		wp_enqueue_style( 'prettyphoto-css');
		wp_enqueue_script('prettyphoto-js');   

		###### Google Map ######
		wp_enqueue_script('google-map');   
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {  
		var geocoder;
		var map;
		
		function codeAddress(address) {
			console.log('address: '+address);
			geocoder = new google.maps.Geocoder();
			  
			geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var myOptions = {
						zoom: 8,
						center: results[0].geometry.location,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);				
					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
					});
				} else {
					alert('Geocode was not successful for the following reason: ' + status);
				}	
			});
		}

		$("a[rel^='MapPhoto']").each(function(index, elm){
			var $elm = $(elm);
			$elm.prettyPhoto({    
			<?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false,'; }?>	
			custom_markup: '<div id="map_canvas" style="width:400px; height:300px"></div>',
				changepicturecallback: function(){ 				
					codeAddress($elm.attr("title"));
				}
			})
		});
	});
	</script>
	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['contactinfo_phone'] = strip_tags($new_instance['contactinfo_phone']);
		$instance['contactinfo_fax'] = strip_tags($new_instance['contactinfo_fax']);
		$instance['contactinfo_email'] = strip_tags($new_instance['contactinfo_email']);
		$instance['contactinfo_email_link'] = strip_tags($new_instance['contactinfo_email_link']);
		$instance['contactinfo_address'] = strip_tags($new_instance['contactinfo_address']);
		$instance['contactinfo_city'] = strip_tags($new_instance['contactinfo_city']);
		$instance['contactinfo_showmap'] = strip_tags($new_instance['contactinfo_showmap']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'contactinfo_phone' => '', 'contactinfo_fax' => '', 'contactinfo_email' => '', 'contactinfo_email_link' => '', 'contactinfo_address' => '', 'contactinfo_city' => '', 'contactinfo_showmap' => ''  ) );
		$title = strip_tags($instance['title']);
		$contactinfo_phone = strip_tags($instance['contactinfo_phone']);		
		$contactinfo_fax = strip_tags($instance['contactinfo_fax']);		
		$contactinfo_email = strip_tags($instance['contactinfo_email']);	
		$contactinfo_email_link = strip_tags($instance['contactinfo_email_link']);	
		$contactinfo_address = strip_tags($instance['contactinfo_address']);	
		$contactinfo_city = strip_tags($instance['contactinfo_city']);
		$contactinfo_showmap = $instance['contactinfo_showmap'];

		echo '<p><label for="'. $this->get_field_id('title').'">Title: <input class="widefat" id="'. $this->get_field_id('title').'" name="'. $this->get_field_name('title').'" type="text" value="'. esc_attr($title).'" /></label></p>';

		echo '<p><label for="'. $this->get_field_id('contactinfo_phone').'">Phone: <input class="widefat" id="'.$this->get_field_id('contactinfo_phone').'" name="'. $this->get_field_name('contactinfo_phone').'" type="text" value="'. esc_attr($contactinfo_phone).'" /></label></p>';			

		echo '<p><label for="'. $this->get_field_id('contactinfo_fax').'">Fax: <input class="widefat" id="'.$this->get_field_id('contactinfo_fax').'" name="'. $this->get_field_name('contactinfo_fax').'" type="text" value="'. esc_attr($contactinfo_fax).'" /></label></p>';			

		echo '<p><label for="'. $this->get_field_id('contactinfo_email').'">Email: <input class="widefat" id="'.$this->get_field_id('contactinfo_email').'" name="'. $this->get_field_name('contactinfo_email').'" type="text" value="'. esc_attr($contactinfo_email).'" /></label></p>';			
		
		if($contactinfo_email_link == 1){
			echo '<p><label for="'. $this->get_field_id('contactinfo_email_link').'">Check to enable "mailto:" Link: <input class="" style="margin-top: -1px; margin-left: 5px;" id="'.$this->get_field_id('contactinfo_email_link').'" name="'. $this->get_field_name('contactinfo_email_link').'" type="checkbox" value="1" checked/></label></p>';
		} else {
			echo '<p><label for="'. $this->get_field_id('contactinfo_email_link').'">Check to enable "mailto:" Link: <input class="" style="margin-top: -1px; margin-left: 5px;" id="'.$this->get_field_id('contactinfo_email_link').'" name="'. $this->get_field_name('contactinfo_email_link').'" type="checkbox" value="1" /></label></p>';
		}

		
		echo '<p><label for="'. $this->get_field_id('contactinfo_address').'">Address: <input class="widefat" id="'.$this->get_field_id('contactinfo_address').'" name="'. $this->get_field_name('contactinfo_address').'" type="text" value="'. esc_attr($contactinfo_address).'" /></label></p>';
		
		echo '<p><label for="'. $this->get_field_id('contactinfo_city').'">City: <input class="widefat" id="'.$this->get_field_id('contactinfo_city').'" name="'. $this->get_field_name('contactinfo_city').'" type="text" value="'. esc_attr($contactinfo_city).'" /></label></p>';	
		
		if($contactinfo_showmap == '0')
			echo '<p><label for="'. $this->get_field_id('contactinfo_showmap').'">Show Google Map: </label><select  class="widefat" id="'.$this->get_field_id('contactinfo_showmap').'" name="'. $this->get_field_name('contactinfo_showmap').'"><option value="1">Show Google Map</option><option value="0" selected>Hide Google Map</option></select></p>';	
		else
			echo '<p><label for="'. $this->get_field_id('contactinfo_showmap').'">Show Google Map: </label><select  class="widefat" id="'.$this->get_field_id('contactinfo_showmap').'" name="'. $this->get_field_name('contactinfo_showmap').'"><option value="1">Show Google Map</option><option value="0">Hide Google Map</option></select></p>';	


	}
}	

register_widget('kingsize_contactinfo_widget');
?>
