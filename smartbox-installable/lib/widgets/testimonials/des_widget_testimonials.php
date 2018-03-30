<?php

class Testimonials_Widget extends WP_Widget {
	function Testimonials_Widget() {
		$widget_ops = array('classname' => 'testimonials_widget', 'description' => __('Show your testimonials on your site.','smartbox'));
		parent::__construct(false, 'DESIGNARE _ Testimonials', $widget_ops);
	}
function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";
		
		if (isset($instance['scroller'])){
			$scroller = esc_attr($instance['scroller']); 	
		} else $scroller = "";
		
		if (isset($instance['categories'])){
			$categories = esc_attr($instance['categories']); 	
		} else $categories = "";
		
		if (isset($instance['nshow'])){
			$nshow = esc_attr($instance['nshow']);  	
		} else $nshow = "";
		
		if (isset($instance['hideauthor'])){
			$hideauthor = esc_attr($instance['hideauthor']); 	
		} else $hideauthor = "";
		
		if (isset($instance['hidecompany'])){
			$hidecompany = esc_attr($instance['hidecompany']); 	
		} else $hidecompany = "";
		
?>  
        
       <p><label for="<?php echo $this->get_field_id('title'); ?>">&#8212; <?php _e('Title','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p> 
       <p><label for="<?php echo $this->get_field_id('nshow'); ?>">&#8212; <?php _e('Number Testimonials to show','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('nshow'); ?>" name="<?php echo $this->get_field_name('nshow'); ?>" type="text" value="<?php echo $nshow; ?>" /><br><span class="flickr-stuff">If 0 will show all testimonials.</span></label></p>
       <p><label for="<?php echo $this->get_field_id('scroller'); ?>">&#8212; <?php _e('Scroller','smartbox'); ?> &nbsp;<input id="<?php echo $this->get_field_id('scroller'); ?>" name="<?php echo $this->get_field_name('scroller'); ?>" type="checkbox" value="scroller" <?php if($scroller == "scroller") echo 'checked'; ?>/></label></p>
       
       
       <p><label for="<?php echo $this->get_field_id('categories'); ?>">&#8212; <?php _e('Categories','smartbox'); ?> &#8212;</label><input style="display:none;" class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" type="text" value="<?php echo $categories; ?>" /></p>
       <div class="widget-testimonials-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'testimonials_category',
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
		} else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php _e("No Categories defined.", "smartbox"); ?></i> <?php }
	       
       ?>
       </div>
       
       <p><label for="<?php echo $this->get_field_id('hideauthor'); ?>">&#8212; <?php _e('Hide Author','smartbox'); ?> &nbsp;<input id="<?php echo $this->get_field_id('hideauthor'); ?>" name="<?php echo $this->get_field_name('hideauthor'); ?>" type="checkbox" value="hideauthor" <?php if($hideauthor == "hideauthor") echo 'checked'; ?>/></p>
       <p><label for="<?php echo $this->get_field_id('hidecompany'); ?>">&#8212; <?php _e('Hide Company','smartbox'); ?> &nbsp;<input id="<?php echo $this->get_field_id('hidecompany'); ?>" name="<?php echo $this->get_field_name('hidecompany'); ?>" type="checkbox" value="hidecompany" <?php if($hidecompany == "hidecompany") echo 'checked'; ?>/></label></p>  
        
        
        <script type="text/javascript">
	        jQuery(document).ready(function($){
	        	
	        	$('.widget-testimonials-categories').each(function(){
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
	    $instance['categories'] = $new_instance['categories'];
	    $instance['hideauthor'] = $new_instance['hideauthor'];
	    $instance['hidecompany'] = $new_instance['hidecompany'];
		return $instance;
	}
	
function widget($args, $instance) {
	
	extract($instance);	
	if(empty($nshow) || $nshow == 0 )
    	$nshow = -1;
    $thecats = array();
    if (strlen($categories) > 0 ){
    	$cats = explode("|*|",$categories);
    	foreach($cats as $c){
    		if ($c != ""){
    			array_push($thecats, $c);
    		}
    	}
    }
    
    $qargs = array(
			'numberposts' => $nshow,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'testimonials',
			'post_status' => 'publish' );
		
	$testi = get_posts( $qargs );
	$filteredtestis = array();
	
	foreach ($testi as $t){
		$testcats = get_the_terms($t->ID, 'testimonials_category');
		$found = false;
		if (is_array($testcats)){
			foreach ($testcats as $ttcats){
				foreach ($thecats as $tc){
					if ($ttcats->slug == $tc) $found = true;	
				}
			}
			if ($found) {
				array_push($filteredtestis, $t);
				$testi = $filteredtestis;
			}	
		}
	}

	$randid = rand();
	
	if ($scroller == "scroller"){
		wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
		$aux = 1;
    
		if ($title != ""){
			 $r = '
		 	<section class="recent_projects recent_testimonials">
		 		<div class="smartboxtitle page_title_testimonials">
			 		<span class="page_info_title_testimonials">'.$title.'</span>
			 		<hr>
			 		<div class="pag-testimonials">
			 			<div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div>
			 			<div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div>
			 		</div>
			 	</div>';
		} else {
			 $r = '
		 	<section class="recent_projects recent_testimonials">
		 		<div class="pag-testimonials">
		 			<div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div>
		 			<div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div>
		 		</div>';
		}
	   
	   	$r .= '
		  	<div id="testimonials2" class="home_proj slideContent testimonis-'.$randid.'"><ul class="carousel">';
		  	
		  if (!function_exists('icl_object_id')){
			  foreach($testi as $t){
			  	if ($testimonials_delay != 0){
				  	$delay_style = ' style="-webkit-animation-delay: '.$testimonials_delay.'s;-moz-animation-delay: '.$testimonials_delay.'s;-ms-animation-delay: '.$testimonials_delay.'s;-o-animation-delay: '.$testimonials_delay.'s;"';
			  	}
			  	if (strtolower($seq) == "yes"){ $testimonials_delay = $testimonials_delay + .3; }
		  		$r .= '<li>
		      <div class="slide s' . $aux . '">';
		      	if (wp_get_attachment_url(get_post_thumbnail_id($t->ID)) != "")
			      	$r .= '<div class="featured_image '.$a_fffect.'" '.$delay_style.'><div class="rotate-bg"></div><img title="'.get_post_meta($t->ID, "author_value", true).'" alt="'.get_post_meta($t->ID, "author_value", true).'" src="'.wp_get_attachment_url(get_post_thumbnail_id($t->ID)).'" /></div>';
		      	$r .= '<div class="testi-text">
		      		<p> ' . $t->post_content . '</p>
		      	</div>
		      	<div class="testi-info">';
		      		
		      			if($hideauthor != "yes"){
		      				if (get_post_meta($t->ID, "author_link_value", true) != ""){
			      				$r .= "<span class='author'><a href='".get_post_meta($t->ID, "author_link_value", true)."'>".get_post_meta($t->ID, "author_value", true)."</a></span>";	
		      				}
		      				else {
			      				$r .= "<span class='author'>".get_post_meta($t->ID, "author_value", true)."</span>";		
		      				}
		      			}
		      			if($hideauthor != "yes" && $hidecompany != "yes") $r .= ", ";
		      			if($hidecompany != "yes"){
			      			if (get_post_meta($t->ID, "company_link_value", true) != ""){
				      			$r .= "<span class='company'><a href='".get_post_meta($t->ID, "company_link_value", true)."'>".get_post_meta($t->ID, "company_value", true)."</a></span>";
			      			} else {
				      			$r .= "<span class='company'>".get_post_meta($t->ID, "company_value", true)."</span>";
			      			}
		      			}
		      		
		      	$r .= '</div>
		      </div>
		      </li>';
		      
		      	$aux++;
		      }
		  } else {
			  global $wpdb, $table_prefix;
			  if ($nshow == -1)
				  $query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_testimonials'";
			  else $query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_testimonials' LIMIT 0,".$nshow; 
			  $results = $wpdb->get_results($query, ARRAY_A);
			  $testemunhos = array();
			  foreach($results as $res){
				  array_push($testemunhos, get_post( $res['element_id'] ));
			  }
			  
			  
		  	$filteredtestis = array();
			if ($categories != "all"){
				foreach ($testemunhos as $t){
					$testcats = get_the_terms($t->ID, 'testimonials_category');
					$found = false;
					foreach ($testcats as $ttcats){
						foreach ($thecats as $tc){
							if ($ttcats->slug == $tc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredtestis, $t);
						$testi = $filteredtestis;
					}
				}	
			}
			  
			  $testemunhos = $filteredtestis;
			  
			  foreach($testemunhos as $t){
			  	if ($testimonials_delay != 0){
				  	$delay_style = ' style="-webkit-animation-delay: '.$testimonials_delay.'s;-moz-animation-delay: '.$testimonials_delay.'s;-ms-animation-delay: '.$testimonials_delay.'s;-o-animation-delay: '.$testimonials_delay.'s;"';
			  	}
			  	if (strtolower($seq) == "yes"){ $testimonials_delay = $testimonials_delay + .3; }
		  		$r .= '<li>
		  		<div class="slide s' . $aux . '">';
		      	if (isset($t)){
			      	if (wp_get_attachment_url(get_post_thumbnail_id($t->ID)) != "")
			      		$r .= '<div class="featured_image '.$a_fffect.'"'.$delay_style.'><div class="rotate-bg"></div><img title="'.get_post_meta($t->ID, "author_value", true).'" alt="'.get_post_meta($t->ID, "author_value", true).'" src="'.wp_get_attachment_url(get_post_thumbnail_id($t->ID)).'" /></div>';
			      		$r .= '<div class="testi-text">
			   			   			<p>'.$t->post_content.'</p>
			      				</div>
			      				<div class="testi-info">';
		      		
		      			if($hideauthor != "yes"){
		      				if (get_post_meta($t->ID, "author_link_value", true) != ""){
			      				$r .= "<span class='author'><a href='".get_post_meta($t->ID, "author_link_value", true)."'>".get_post_meta($t->ID, "author_value", true)."</a></span>";	
		      				}
		      				else {
			      				$r .= "<span class='author'>".get_post_meta($t->ID, "author_value", true)."</span>";		
		      				}
		      			}
		      			if($hideauthor != "yes" && $hidecompany != "yes") $r .= ", ";
		      			if($hidecompany != "yes"){
			      			if (get_post_meta($t->ID, "company_link_value", true) != ""){
				      			$r .= "<span class='company'><a href='".get_post_meta($t->ID, "company_link_value", true)."'>".get_post_meta($t->ID, "company_value", true)."</a></span>";
			      			} else {
				      			$r .= "<span class='company'>".get_post_meta($t->ID, "company_value", true)."</span>";
			      			}
		      			}	      		
		      			$r .= '</div>
		      			</div>
			      </li>';
			      
			      	$aux++;
			      }
		      	}  
		  }
		  	
		  $r .= '</ul></div></section>';
		  ?>
		  	<script type="text/javascript">
			  	jQuery(document).ready(function($) {
				  	jQuery('.testimonis-<?php echo $randid; ?>').carousel({dispItems: 1});
			  	});
		  	</script>
		  <?php
	} else {
		
		$columns = "";
		if (isset($tests_per_row)){
			switch($tests_per_row){
				case "1": $columns = "sixteen columns"; break;
				case "2": $columns = "eight columns"; break;
				case "3": $columns = "one-third column"; break;
				case "4": $columns = "four columns"; break;
			}	
		}
		
		$aux = 1;
    
		if ($title != ""){
			$r = '
		 	<section class="recent_projects recent_testimonials"><div class="smartboxtitle page_title_testimonials"><hr><span class="page_info_title_testimonials">'.$title.'</span></div>';	
		} else {
			$r = '
		 	<section class="recent_projects recent_testimonials">';
		}
		  		 
	   	$r .= '
		  	<div id="testimonials2" class="home_proj slideContent">';
		  		  	
		$el = 0;
		if (!function_exists('icl_object_id')){
			foreach($testi as $t){
		  		if ($el == 0) {
					$r .= "<div class='tests_row'>";
				}
				if ($testimonials_delay != 0){
				  	$delay_style = ' style="-webkit-animation-delay: '.$testimonials_delay.'s;-moz-animation-delay: '.$testimonials_delay.'s;-ms-animation-delay: '.$testimonials_delay.'s;-o-animation-delay: '.$testimonials_delay.'s;"';
			  	}
			  	if (strtolower($seq) == "yes"){ $testimonials_delay = $testimonials_delay + .3; }
				$r .= '<div class="'.$columns.'">
			      <div class="slide s' . $aux . '">';
			      	if (wp_get_attachment_url(get_post_thumbnail_id($t->ID)) != "")
				      	$r .= '<div class="featured_image '.$a_fffect.'"'.$delay_style.'><div class="rotate-bg"></div><img title="'.get_post_meta($t->ID, "author_value", true).'" alt="'.get_post_meta($t->ID, "author_value", true).'" src="'.wp_get_attachment_url(get_post_thumbnail_id($t->ID)).'" /></div>';
			      	$r .= '<div class="testi-text">
			      		<p> ' . $t->post_content . '</p>
			      	</div>
			      	<div class="testi-info">';
			      		
			      			if($hideauthor != "yes"){
			      				if (get_post_meta($t->ID, "author_link_value", true) != ""){
				      				$r .= "<span class='author'><a href='".get_post_meta($t->ID, "author_link_value", true)."'>".get_post_meta($t->ID, "author_value", true)."</a></span>";	
			      				}
			      				else {
				      				$r .= "<span class='author'>".get_post_meta($t->ID, "author_value", true)."</span>";		
			      				}
			      			}
			      			if($hideauthor != "yes" && $hidecompany != "yes") $r .= ", ";
			      			if($hidecompany != "yes"){
				      			if (get_post_meta($t->ID, "company_link_value", true) != ""){
					      			$r .= "<span class='company'><a href='".get_post_meta($t->ID, "company_link_value", true)."'>".get_post_meta($t->ID, "company_value", true)."</a></span>";
				      			} else {
					      			$r .= "<span class='company'>".get_post_meta($t->ID, "company_value", true)."</span>";
				      			}
			      			}
			      		
			      	$r .= '</div>
			      </div>
			    </div>';
			      
			    $aux++;
			    $el++;
				if ($el == $tests_per_row){
					$r .= "</div>";
					$el = 0;
				}
			
			}
					  		
		} else {
			  global $wpdb, $table_prefix;
			  if ($nshow == -1)
				  $query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_testimonials'";
			  else $query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_testimonials' LIMIT 0,".$nshow;
			  $results = $wpdb->get_results($query, ARRAY_A);
			  $testemunhos = array();
			  foreach($results as $res){
				  array_push($testemunhos, get_post( $res['element_id'] ));
			  }
			  
			  $filteredtestis = array();
			if ($categories != "all"){
				foreach ($testemunhos as $t){
					$testcats = get_the_terms($t->ID, 'testimonials_category');
					$found = false;
					foreach ($testcats as $ttcats){
						foreach ($thecats as $tc){
							if ($ttcats->slug == $tc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredtestis, $t);
						$testi = $filteredtestis;
					}
				}	
			}
			  
			  $testemunhos = $filteredtestis;
			  
			  $aux = 0;
			  $el = 0;
			  foreach($testemunhos as $t){
			  			  
			  		if ($el == 0) {
						$r .= "<div class='tests_row'>";
					}
					if (isset($testimonials_delay) && $testimonials_delay != 0){
					  	$delay_style = ' style="-webkit-animation-delay: '.$testimonials_delay.'s;-moz-animation-delay: '.$testimonials_delay.'s;-ms-animation-delay: '.$testimonials_delay.'s;-o-animation-delay: '.$testimonials_delay.'s;"';
				  	}
				  	if (strtolower($seq) == "yes"){ $testimonials_delay = $testimonials_delay + .3; }
					if (isset($t)){
						$r .= '<div class="'.$columns.'">
				      <div class="slide s' . $aux . '">';
				      	if (wp_get_attachment_url(get_post_thumbnail_id($t->ID)) != "")
					      	$r .= '<div class="featured_image '.$a_fffect.'"'.$delay_style.'><div class="rotate-bg"></div><img title="'.get_post_meta($t->ID, "author_value", true).'" alt="'.get_post_meta($t->ID, "author_value", true).'" src="'.wp_get_attachment_url(get_post_thumbnail_id($t->ID)).'" /></div>';
				      	$r .= '<div class="testi-text">
				      		<p> ' . $t->post_content . '</p>
				      	</div>
				      	<div class="testi-info">';
				      		
			      			if($hideauthor != "yes"){
			      				if (get_post_meta($t->ID, "author_link_value", true) != ""){
				      				$r .= "<span class='author'><a href='".get_post_meta($t->ID, "author_link_value", true)."'>".get_post_meta($t->ID, "author_value", true)."</a></span>";	
			      				}
			      				else {
				      				$r .= "<span class='author'>".get_post_meta($t->ID, "author_value", true)."</span>";		
			      				}
			      			}
			      			if($hideauthor != "yes" && $hidecompany != "yes") $r .= ", ";
			      			if($hidecompany != "yes"){
				      			if (get_post_meta($t->ID, "company_link_value", true) != ""){
					      			$r .= "<span class='company'><a href='".get_post_meta($t->ID, "company_link_value", true)."'>".get_post_meta($t->ID, "company_value", true)."</a></span>";
				      			} else {
					      			$r .= "<span class='company'>".get_post_meta($t->ID, "company_value", true)."</span>";
				      			}
			      			}	      		
				      	$r .= '</div>
				      </div>
				      </div>';
				      
				      	$aux++;
				      	$el++;
				      	
				      	if (isset($tests_per_row) && $el == $tests_per_row){
							$r .= "</div>";
							$el = 0;
						}	
					}
		      }
		  
		}
			
		$r .= '</div>
		</section>
		';
	}

	echo $r;  
	  //echo $after_widget;
	}
}
register_widget('Testimonials_Widget');

?>
