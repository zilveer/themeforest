<?php

class Team_Widget extends WP_Widget {
	function Team_Widget() {
		$widget_ops = array('classname' => 'team_widget', 'description' => __('Show your team on your site.','smartbox'));
		parent::__construct(false, 'DESIGNARE _ Team', $widget_ops);
	}
function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";		
		
		if (isset($instance['scroller'])){
			$scroller = esc_attr($instance['scroller']); 	
		} else $scroller = "";
		
		if (isset($instance['members_per_row'])){
			$members_per_row = esc_attr($instance['members_per_row']); 	
		} else $members_per_row = "";
		
		if (isset($instance['categories'])){
			$categories = esc_attr($instance['categories']); 	
		} else $categories = "";
		
		if (isset($instance['nshow'])){
			$nshow = esc_attr($instance['nshow']);  	
		} else $nshow = "";
		
?>  
        
       <p><label for="<?php echo $this->get_field_id('title'); ?>">&#8212; <?php _e('Title','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p> 
       
       <p><label for="<?php echo $this->get_field_id('nshow'); ?>">&#8212; <?php _e('Number Team to show','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('nshow'); ?>" name="<?php echo $this->get_field_name('nshow'); ?>" type="text" value="<?php echo $nshow; ?>" /><br><span class="flickr-stuff">If 0 will show all your team members.</span></label></p>
       <p class="team_scroller_select"><label for="<?php echo $this->get_field_id('scroller'); ?>">&#8212; <?php _e('Scroller','smartbox'); ?> &nbsp;<input id="<?php echo $this->get_field_id('scroller'); ?>" name="<?php echo $this->get_field_name('scroller'); ?>" type="checkbox" value="scroller" <?php if($scroller == "scroller") echo 'checked'; ?> onchange="if (!jQuery(this).is(':checked')) jQuery(this).closest('p').next().show(); else jQuery(this).closest('p').next().hide();"/></label></p>
       
       <!-- NEW -->
       <p><label>&#8212; <?php _e('Team per Row','smartbox'); ?> &#8212;</label><br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('members_per_row'); ?>" value="1" <?php if($members_per_row == '1') echo 'checked'; ?>>&nbsp;&nbsp;1<br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('members_per_row'); ?>" value="2" <?php if($members_per_row == '2') echo 'checked'; ?>>&nbsp;&nbsp;2<br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('members_per_row'); ?>" value="3" <?php if($members_per_row == '3') echo 'checked'; ?>>&nbsp;&nbsp;3<br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('members_per_row'); ?>" value="4" <?php if($members_per_row == '4') echo 'checked'; ?>>&nbsp;&nbsp;4<br>
	   </p>

       
       <p><label for="<?php echo $this->get_field_id('categories'); ?>">&#8212; <?php _e('Categories','smartbox'); ?> &#8212;<input style="display:none;" class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" type="text" value="<?php echo $categories; ?>" /></label></p>
       <div class="widget-team-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'team_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		
		$categories = get_categories($args);
		if (count($categories) > 0){
			foreach($categories as $cats){
				?>
				<label><input type="checkbox" name="<?php echo $cats->slug; ?>" value="<?php echo $cats->slug; ?>"><?php echo $cats->cat_name; ?></label>
				<?php
			}
		}
		else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php _e("No Categories defined.", "smartbox"); ?></i> <?php }
	       
       ?>
       </div>   
        
       <script type="text/javascript">
	        jQuery(document).ready(function($){
	        
	        	$('.team_scroller_select').each(function(e){
	        		if (!$(this).find('input').is(':checked')) $(this).parents('.scroller_select').next('p').hide();
	        		else $(this).parents('.scroller_select').next('p').show();
	        	});
	        	
	        	$('.team_scroller_select').find('input').trigger('change');
	        	
	        	$('.widget-team-categories').each(function(){
		        	var $el = $(this);
		        	var savedVal = $el.prev().find('input').val().split("|*|");
		        	for (var i=0; i<savedVal.length; i++){
			        	if (savedVal[i] != ""){
				        	$el.find('input[value='+savedVal[i]+']').attr('checked','true');
			        	}
		        	}
		        
			        $el.find('input').change(function(){
				       var newVal = "";
				       var first = true;
				       $el.find('input').each(function(){
					       if ($(this).is(':checked')){
						       if (first){
							   		newVal += $(this).val();
							   		first = false;
						       } else newVal += "|*|" + $(this).val();
					       }
				       });
				       $el.prev().find('input').val(newVal);
			        });	
		        	
	        	});
	        	
	        });
       </script>
	<?php
	}
	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['nshow'] = $new_instance['nshow'];
	    $instance['scroller'] = $new_instance['scroller'];
	    $instance['members_per_row'] = $new_instance['members_per_row'];
	    $instance['categories'] = $new_instance['categories'];
		return $instance;
	}
	
	function widget($args, $instance) {
		
		extract($instance);	
		$title = apply_filters('widget_title', $instance['title'], $instance);
	    $scroller = (isset($instance['scroller'])) ? "yes" : "no";
		if(empty($nshow) || $nshow == 0 )
	    	$nshow = -1;
	    $team_class = 'team_titles';
		
		$randID = rand();
	
		$titles_html = '';
	
		$output = '<section id="team-' . $randID . '" class="shortcode-team' . $css . '">';
	
		if ($scroller == "yes"){
			wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
			$output .= '<div class="team_header smartboxtitle"><hr><span>' . esc_html( $title ) . '</span><div class="pag-proj_team">
				<div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div>
				<div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div>
			</div></div>';
		} else {
			$output .= '<h2 class="team_header smartboxtitle sixteen columns" style="min-height:20px;"><hr><span>' . esc_html( $title ) . '</span></h2>';
		}
		
		if ($scroller == "yes")
			$output .= "<div class='team-carousel deswidget'><ul class='team-items'>";
		
		switch($members_per_row){
			case "2": 
				$columnslayout = "eight columns";
				break;
			case "3": 
				$columnslayout = "one-third column";
				break;
			case "4": 
				$columnslayout = "four columns";
				break;
		}
		
		if (!function_exists('icl_object_id')){
		
			if ($categories != "all"){
		    	$cats = explode("|*|",$categories);
		    	$thecats = array();
		    	foreach($cats as $c){
		    		if ($c != ""){
		    			array_push($thecats, $c);
		    		}
		    	}
		    }
		
			$args = array(
				'numberposts' => $nshow,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'team',
				'post_status' => 'publish' 
			);
				
			$team = get_posts( $args );
			$filteredteam = array();
			
			if ($categories != "all"){
				foreach ($team as $t){
					$teamcats = get_the_terms($t->ID, 'team_category');
					$found = false;
					foreach ($teamcats as $ttcats){
						foreach ($thecats as $tc){
							if ($ttcats->slug == $tc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredteam, $t);
						$team = $filteredteam;
					}
				}			
			}
	
		} else {
			if ($categories != "all"){
		    	$cats = explode("|*|",$categories);
		    	$thecats = array();
		    	foreach($cats as $c){
		    		if ($c != ""){
		    			array_push($thecats, $c);
		    		}
		    	}
		    }
			global $wpdb, $table_prefix;
			if ($nshow != -1)
				$query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_team' LIMIT 0,".$nshow;
			else
				$query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_team'"; 
			$results = $wpdb->get_results($query, ARRAY_A);
			$team = array();
			foreach($results as $res){
				array_push($team, get_post( $res['element_id'] ));
			}
			$filteredteam = array();
			if ($categories != "all"){
				foreach ($team as $t){
					$teamcats = get_the_terms($t->ID, 'team_category');
					$found = false;
					if (!empty($teamcats)){
						foreach ($teamcats as $ttcats){
							foreach ($thecats as $tc){
								if ($ttcats->slug == $tc) $found = true;	
							}
						}
						if ($found) {
							array_push($filteredteam, $t);
							$team = $filteredteam;
						}	
					}
				}	
			}
		}
	
		
		if ($scroller == "no") {
			$rows = ceil(count($team)/$members_per_row);
			$el = 0;
			foreach ($team as $t){
				if ($el == 0) {
					$output .= "<div class='team-row ".$members_per_row."'>";
				}
				$html = wpautop(do_shortcode($t->post_content), true);
				$output .= "<div class='team-member ".$columnslayout."'><div class='teamimg'><img class='scale-with-grid' alt='".$t->post_title."' title='".$t->post_title."' src='".wp_get_attachment_url( get_post_thumbnail_id($t->ID))."'></div><div class='team_content'><h4 class='member_name'>".$t->post_title."</h4>".$html."</div></div>";
				$el++;
				if ($el == $members_per_row){
					$output .= "</div>";
					$el = 0;
				}
			}
		}
		
		foreach($team as $t){
			if ($scroller == "yes"){
				$html = wpautop(do_shortcode($t->post_content), true);
				$output .= "<li class='team-member' style='margin:0 17px 0 0;'><div class='teamimg'><img class='scale-with-grid' alt='".$t->post_title."' title='".$t->post_title."' src='".wp_get_attachment_url( get_post_thumbnail_id($t->ID))."'></div><div class='team_content'><h4 class='member_name'>".$t->post_title."</h4><p>".$html."</p></div></li>";
			}
		}
		
		if ($scroller == "yes") {
			$output .= "</ul></div>";
			$output .= "
				<script type='text/javascript'>
					jQuery(window).load(function(){
						jQuery('#team-".$randID."').find('.team-carousel').carousel({dispItems:1});
					});
				</script>
			";
		}
		
		$output .= "<div class='clear'></div></section>";
		
		echo $output;
		//echo $after_widget;
	}
}
register_widget('Team_Widget');

?>
