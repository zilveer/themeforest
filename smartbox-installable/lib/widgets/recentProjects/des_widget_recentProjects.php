<?php

class Projects_Widget extends WP_Widget {
	function Projects_Widget() {
		$widget_ops = array('classname' => 'projects_widget', 'description' => __('Show your Projects on your site.','smartbox'));
		parent::__construct(false, 'DESIGNARE _ Projects', $widget_ops);
	}
	function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";
		
		if (isset($instance['style'])){
			$style = esc_attr($instance['style']); 	
		} else $style = "";

		if (isset($instance['portfolio'])){
			$portfolio = esc_attr($instance['portfolio']); 	
		} else $portfolio = "";
		
		if (isset($instance['nshow'])){
			$nshow = esc_attr($instance['nshow']);  	
		} else $nshow = "";
		
		if (isset($instance['scroller'])){
			$scroller = esc_attr($instance['scroller']); 	
		} else $scroller = "";
		
		if (isset($instance['proj_per_view'])){
			$proj_per_view = esc_attr($instance['proj_per_view']); 	
		} else $proj_per_view = "";
		
		if (isset($instance['categories'])){
			$categories = esc_attr($instance['categories']);  
		} else $categories = "";
		
		if (isset($instance['orderby'])){
			$orderby = esc_attr($instance['orderby']);	
		} else $orderby = "";
		
		if (isset($instance['order'])){
			$order = esc_attr($instance['order']);  	
		} else $order = "";
		
		if (isset($instance['link_to_projects'])){
			$link_to_projects = esc_attr($instance['link_to_projects']); 	
		} else $link_to_projects = "";
		
		if (isset($instance['title_to_projects_link'])){
			$title_to_projects_link = esc_attr($instance['title_to_projects_link']); 	
		} else $title_to_projects_link = "";
		
		?>  
                
       <p><label for="<?php echo $this->get_field_id('title'); ?>">&#8212; <?php _e('Title','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p> 
       
       <!-- NEW -->
       <p>
	        <label>&#8212; <?php _e('Projects Style','smartbox'); ?> &#8212;<br>
	        <select id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" style="margin-left:15px;">
        		<?php 
        			for ($i=1; $i < 3; $i++){
        				$s = "";
	        			if ($i == $style) $s = "selected";
	        			echo "<option value='" . $i . "' ".$s.">Style " . $i . "</option>";	
        			}
        		?>
	        </select>
	        </label>
	    </p>
       <!-- NEW -->
       
       <p><label for="<?php echo $this->get_field_id('portfolio'); ?>">&#8212; <?php _e('Portfolios','smartbox'); ?> &#8212;<input style="display:none;" class="widefat" id="<?php echo $this->get_field_id('portfolio'); ?>" name="<?php echo $this->get_field_name('portfolio'); ?>" type="text" value="<?php echo $portfolio; ?>" ></label></p>
       <div class="widget-portfolio-categories">
	       <?php
		    // GET Categories	
			$args = array(
				'type' => 'post',
				'orderby' => 'id',
				'order' => 'ASC',
				'taxonomy' => 'portfolio_type',
				'hide_empty' => 0,
				'pad_counts' => false
			);
			
			$portfolios = get_categories( $args );
			if (count($portfolios) > 0){
				foreach($portfolios as $cats){
					?><label style="position:relative;float:left;width:100%;margin: 0 0 5px 15px;"><input type="checkbox" name="<?php echo $cats->slug; ?>" value="<?php echo $cats->slug; ?>">&nbsp;<?php echo $cats->cat_name; ?></label><?php
				}			
			} else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php _e("No Portfolios defined.", "smartbox"); ?></i> <?php }
	       ?>
       </div>
       
       <p><label for="<?php echo $this->get_field_id('nshow'); ?>">&#8212; <?php _e('Number Projects to show','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('nshow'); ?>" name="<?php echo $this->get_field_name('nshow'); ?>" type="text" value="<?php echo $nshow; ?>" /><br><span class="flickr-stuff">If 0 will show all projects.</span></label></p>
       <p class="scroller_select"><label for="<?php echo $this->get_field_id('scroller'); ?>">&#8212; <?php _e('Scroller','smartbox'); ?> &nbsp;<input id="<?php echo $this->get_field_id('scroller'); ?>" name="<?php echo $this->get_field_name('scroller'); ?>" type="checkbox" value="scroller" <?php if($scroller == "scroller") echo 'checked'; ?> onchange="if (!jQuery(this).is(':checked')) jQuery(this).closest('p').next().show(); else jQuery(this).closest('p').next().hide();" /></label></p>
       
       <!-- NEW -->
       <p><label>&#8212; <?php _e('Project per Row','smartbox'); ?> &#8212;</label><br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('proj_per_view'); ?>" value="1" <?php if($proj_per_view == '1') echo 'checked'; ?>>&nbsp;&nbsp;1<br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('proj_per_view'); ?>" value="2" <?php if($proj_per_view == '2') echo 'checked'; ?>>&nbsp;&nbsp;2<br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('proj_per_view'); ?>" value="3" <?php if($proj_per_view == '3') echo 'checked'; ?>>&nbsp;&nbsp;3<br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('proj_per_view'); ?>" value="4" <?php if($proj_per_view == '4') echo 'checked'; ?>>&nbsp;&nbsp;4<br>
	   </p>
       
       <!-- NEW -->
       <p><label for="<?php echo $this->get_field_id('categories'); ?>">&#8212; <?php _e('Categories','smartbox'); ?> &#8212;</label><input style="display:none;" class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" type="text" value="<?php echo $categories; ?>" ></p>
       <div class="widget-projects-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'portfolio_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		
		$categories = get_categories( $args );
		if (isset($categories)){
			foreach($categories as $cats){
				?>
				<label style="position:relative;float:left;width:100%;margin: 0 0 5px 15px;"><input type="checkbox" name="<?php echo $cats->slug; ?>" value="<?php echo $cats->slug; ?>">&nbsp;<?php echo $cats->cat_name; ?></label>
				<?php
			}
		} else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php _e("No Categories defined.", "smartbox"); ?></i> <?php }
	       
       ?>
       </div>
        
	   <p><label>&#8212; <?php _e('Order by','smartbox'); ?> &#8212;</label><br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="title" <?php if($orderby == 'title') echo 'checked'; ?>> <?php _e('Title','smartbox'); ?><br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="date" <?php if($orderby == 'date') echo 'checked'; ?>> <?php _e('Date','smartbox'); ?><br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="author" <?php if($orderby == 'author') echo 'checked'; ?>> <?php _e('Author','smartbox'); ?><br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="comment_count" <?php if($orderby == 'comment_count') echo 'checked'; ?>> <?php _e('Number Comments','smartbox'); ?><br>
	    </p>
	    <p><label>&#8212; <?php _e('Order','smartbox'); ?> &#8212;</label><br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('order'); ?>" value="asc" <?php if($order == 'asc') echo 'checked'; ?>> <?php _e('Ascending','smartbox'); ?><br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('order'); ?>" value="desc" <?php if($order == 'desc') echo 'checked'; ?>> <?php _e('Descending','smartbox'); ?><br>
	    </p>
		    
		<script type="text/javascript">
	        jQuery(document).ready(function($){
	        
	        	$('#<?php echo $this->get_field_id('style'); ?>').change(function(){
		        	$(this).find('option[selected]').removeAttr('selected');
	        	});

	        	$('.scroller_select').each(function(e){
	        		if (!$(this).find('input').is(':checked')) $(this).parents('.scroller_select').next('p').hide();
	        		else $(this).parents('.scroller_select').next('p').show();
	        	});
	        	
	        	$('.scroller_select').find('input').trigger('change');
	        	
	        	$('.widget-projects-categories').each(function(){
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
	        	
	        	jQuery('.widget-portfolio-categories').each(function(){
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
	    $instance['style'] = $new_instance['style'];
	    $instance['portfolio'] = $new_instance['portfolio'];
	    $instance['nshow'] = $new_instance['nshow'];
	    $instance['scroller'] = $new_instance['scroller'];
	    $instance['proj_per_view'] = $new_instance['proj_per_view'];
	    $instance['categories'] = $new_instance['categories'];
	    $instance['orderby'] = $new_instance['orderby'];
	    $instance['order'] = $new_instance['order'];
	    $instance['link_to_projects'] = $new_instance['link_to_projects'];
	    $instance['title_to_projects_link'] = $new_instance['title_to_projects_link'];
		return $instance;
	}
	
	function widget($args, $instance) {
		extract($instance);
		$title = apply_filters('widget_title', $instance['title'], $instance);
		$portfolioStyle = $instance['style'];
		$portfolio = $instance['portfolio'];
	    $nshow = $instance['nshow'];
	    $scroller = (isset($instance['scroller'])) ? "yes" : "no";
	    $proj_per_view = $instance['proj_per_view'];
	    $categories = $instance['categories'];
	    $orderby = $instance['orderby'];
	    $order = $instance['order'];
	    $link_to_projects = $instance['link_to_projects'];
	    $title_to_projects_link = $instance['title_to_projects_link'];
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
	    } else $thecats = "all";
	    
	    $theportfolios = array();
	    if (strlen($portfolio) > 0 ){
	    	$ports = explode("|*|",$portfolio);
	    	foreach($ports as $p){
	    		if ($p != ""){
	    			array_push($theportfolios, $p);
	    		}
	    	}
	    } else $theportfolios = "all";

		$randID = rand();
		
		if(!empty($title))
			$t = "$title";
			
		if(!isset($nshow) || $nshow == 0)
  			$nshow = -1;
		
		$layout = "";
  		$thumbHeight = "";
  		switch($proj_per_view){
	  		case '4': $layout = " four columns"; $thumbHeight = "170px"; break;
	  		case '3': $layout = " one-third column"; $thumbHeight = "232px"; break;
	  		case '2': $layout = " eight columns"; $thumbHeight = "355px"; break;
	  		case '1': $layout = " sixteen columns"; break;
  		}
			
		$projects_ids = array();
 		
		$projs = array();
		
	    if (is_array($theportfolios)){
	    	foreach($theportfolios as $p){
    			$args = array(
				     'posts_per_page' => -1, 
					 'post_type' => DESIGNARE_PORTFOLIO_POST_TYPE,
					 'orderby' => $orderby,
					 'order' => $order,
					 'portfolio_type' => $p
				);
				$aux = get_posts($args);
				if (!empty($aux)) array_push($projs, $aux);
	    	}
	    } else {
		    $args = array(
			     'posts_per_page' => -1, 
				 'post_type' => DESIGNARE_PORTFOLIO_POST_TYPE,
				 'orderby' => $orderby,
				 'order' => $order
			);
			$aux = get_posts($args);
			if (!empty($aux)) array_push($projs, $aux);
	    }
		
		$theprojs = array();
		foreach($projs as $port){
			foreach($port as $p){
				if (!in_array($p, $theprojs))
					array_push($theprojs, $p);
			}
		}
		
		$filteredprojs = array();
		if ($categories != "all"){
			foreach ($theprojs as $p){
				$projscats = get_the_terms($p->ID, 'portfolio_category');
				$found = false;
				foreach ($projscats as $pcats){
					if (is_array($thecats)){
						foreach ($thecats as $tc){
							if ($pcats->slug == $tc) $found = true;	
						}	
					}
				}
				if ($found) {
					array_push($filteredprojs, $p);
					$theprojs = $filteredprojs;
				}
			}
	
		}
		
		foreach($theprojs as $p){
			array_push($projects_ids, $p->ID);
		}
		
		if ($scroller == "no"){
			$rows = ceil(count($projects_ids)/$proj_per_view);
			$el = 0;
		} else {
			wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
		}
		
		if ($style == "1"){
			//INDIVIDUAL PROJECTS
			$individual_project = "";
			
			for($i=0; $i < count($projects_ids); $i++){
			
				if ($scroller == "no" && $el == 0){
				 	$individual_project .= '<div class="projs_row" style="position:relative;float:left;width:100%;margin-bottom:10px;">';
			 	}
			
				$this_project = get_post($projects_ids[$i]);
				
				$p_type = get_post_meta($this_project->ID, 'portfolioType_value', true);
				
				$rel = "";
				$hoverType = get_post_meta($this_project->ID, "thumbnailHoverOption_value", true);
				if ($hoverType != "default"){
					$rel = " data-rel='".$hoverType."' ";
				}
				
				if ($scroller == "no")
				 	$individual_project .= '<div '.$rel.' class="indproj1 '.$layout.'">';
			 	else
			 		$individual_project .= '<li '.$rel.'class="indproj1" style="margin-right:20px;">';
	
				$individual_project .= '<div class="slides_item post-thumb"><ul class="ch-grid"><li><div class="ch-item"> '; 
							
				if ($p_type != "image")
					$img = wp_get_attachment_url( get_post_thumbnail_id($this_project->ID));
				else{
					$img = wp_get_attachment_url( get_post_thumbnail_id($this_project->ID));
					if ($img == ""){
						$sliderData = get_post_meta($this_project->ID, "sliderImages_value", true);
						$slide = explode("|*|",$sliderData);
		
				    	if ($slide[0] != ""){
				    		$url = explode("|!|",$slide[0]);
				    		$img = $url[1];	
				    	}	
					}
				} 
					
				$cat_name = "";				 	
							
				$terms = get_the_terms($this_project->ID, 'portfolio_category');
	
				if ( $terms && ! is_wp_error( $terms ) ) {
					$xuts = 0;
					foreach ( $terms as $x ) {
						if ($xuts == 0){
							$cat_name .= $x->name;
						}
						else $cat_name .= ", ".$x->name; 
						$xuts++;
					}
				}						
							
				$individual_project .= '<a href="'.$this_project->guid.'"><img class="img_thumb" alt="" src="'.$img.'" /></a><a class="flex_this_thumb" href="'.$img.'"></a><div class="mask" onclick="$(this).siblings(\'a\').trigger(\'click\');"><div class="more" onclick="$(this).parents(\'.ch-item\').find(\'.flex_this_thumb\').click();"></div><div class="link" onclick="window.location = $(this).parents(\'.ch-item\').children(\'a\').eq(0).attr(\'href\');"></div></div>'; 
				$individual_project .= '</div></li></ul>';
				$individual_project .= '<div class="no-flicker"><div class="proj-title-tags"><div class="p_title no-flicker"><a href="'.$this_project->guid.'">'.$this_project->post_title.'</a></div>';
					
				$individual_project .= '</div></div></div>'; 
				
				
				if ($scroller == "yes")
					$individual_project .= '</li>';
				else 
					$individual_project .= '</div>';
					
				if ($scroller == "no"){
					$el++;
					if ($el == $proj_per_view){
						$individual_project .= "</div>";
						$el = 0;
					}
				}
				
			}
			$output = "";
			
			if ($scroller == "yes"){
				if ($link_to_projects != ""){
					$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj"><div class="smartboxtitle page_title_s3"><span class="page_info_title_s3">'. $title . '</span><div class="pag-proj2_s3"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="goto_projects"  onclick="window.location = \''.$link_to_projects.'\';" title="'.$title_to_projects_link.'"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><hr><div class="project_list_s3 deswidget" ><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script>jQuery(document).ready(function(){ if (jQuery(\'#lastprojects3-'.$randID.' .slides_container\').parents(\'#toppanel\').length){ jQuery(window).load(function(){ jQuery(\'#lastprojects3-'.$randID.' .slides_container\').parent().carousel({dispItems: 1}); } else jQuery(\'#lastprojects3-'.$randID.' .slides_container\').parent().carousel({dispItems: 1});});</script><div class="clear"></div></section>';	
				} else {
					$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj"><div class="smartboxtitle page_title_s3"><span class="page_info_title_s3">'. $title . '</span><div class="pag-proj2_s3"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal" ></div></div></div><hr><div class="project_list_s3 deswidget"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script>jQuery(document).ready(function(){jQuery(\'#lastprojects3-'.$randID.' .slides_container\').parent().carousel({dispItems: 1});});</script><div class="clear"></div></section>';
				}
			} else {
				if ($link_to_projects != ""){
					$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj"><div class="smartboxtitle page_title_s3"><span class="page_info_title_s3">'. $title . '</span><div class="pag-proj2_s3"><div class="goto_projects"  onclick="window.location = \''.$link_to_projects.'\';" title="'.$title_to_projects_link.'"></div></div></div><hr><div class="project_list_s3"><div class="slides_container jcarousel-skin-tango">'.$individual_project.'</div></div></div><div class="clear"></div></section>';	
				} else {
					if ($title != ""){
						$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj"><div class="smartboxtitle page_title_s3"><span class="page_info_title_s3">'. $title . '</span></div><hr><div class="project_list_s3"><div class="slides_container jcarousel-skin-tango">'.$individual_project.'</div></div></div><div class="clear"></div></section>';
					} else {
						$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj sixteen columns"><div class="project_list_s3"><div class="slides_container jcarousel-skin-tango">'.$individual_project.'</div></div></div><div class="clear"></div></section>';
					}
				}	
			}
		} else {
			$individual_project = "";
		
			for($i=0; $i < count($projects_ids); $i++){
			
				if ($scroller == "no" && $el == 0){
				 	$individual_project .= '<div class="projs_row">';
			 	}
			 	
			 	if ($scroller == "no")
				 	$individual_project .= '<div class="indproj2 '.$layout.'">';
			 	else
			 		$individual_project .= '<li style="margin-right:20px;">';
			
				$individual_project .= '<ul class="da-thumbs da-recent-projs">';
						
				$this_project = get_post($projects_ids[$i]);
				
				if ($scroller == "no")
					$individual_project .= '<li><a class="noscroll" href="'.get_permalink($this_project->ID).'">';
				else
					$individual_project .= '<li><a href="'.get_permalink($this_project->ID).'">';
	
				
				$p_type = get_post_meta($this_project->ID, 'portfolioType_value', true);
				
				$individual_project .= '<div class="slides_item post-thumb">';
							
				$individual_project .= '<img class="img_thumb" alt="" src="';
							
				if ($p_type != "image")
					$img = wp_get_attachment_url( get_post_thumbnail_id($this_project->ID));
				else{
					$img = wp_get_attachment_url( get_post_thumbnail_id($this_project->ID));
					if ($img == ""){
						$sliderData = get_post_meta($this_project->ID, "sliderImages_value", true);
						$slide = explode("|*|",$sliderData);
		
				    	if ($slide[0] != ""){
				    		$url = explode("|!|",$slide[0]);
				    		$img = $url[1];	
				    	}	
					}
				} 
				$individual_project .= $img;
				
				$cat_name = "";				 	
				
				$terms = get_the_terms($this_project->ID, 'portfolio_category');
	
				$s_categories = "<span class='overlay_categories'>";
	
				if ( $terms && ! is_wp_error( $terms ) ) {
					$xuts = 0;
					foreach ( $terms as $x ) {
						if ($xuts == 0){
							$cat_name .= $x->name;
						}
						else $cat_name .= " / ".$x->name; 
						$xuts++;
					}
				}	
				$s_categories .= "<span>".$cat_name."</span>";
				$s_categories .= "</span>";					
		
				$individual_project .= '" />';
				
				$individual_project .= '<div class="dahover"><span class="da-title">'. $this_project->post_title. '</span>'.$s_categories .'</div>';
						
				$individual_project .= '</div></a><a class="pp-link" style="display:none;" href="'.$img.'"></a></li></ul>';
				
				if ($scroller == "yes")
					$individual_project .= '</li>';
				else 
					$individual_project .= '</div>';
					
				if ($scroller == "no"){
					$el++;
					if ($el == $proj_per_row){
						$individual_project .= "</div>";
						$el = 0;
					}
				}
			
			}
			
			if ($scroller == "yes"){
				if ($link_to_projects != ""){
					$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><div class="smartboxtitle page_title_s4"><span class="page_info_title_s4">'.$title.'</span><hr><div class="pag-proj2_s4"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="goto_projects" onclick="window.location = \''.$link_to_projects.'\';" title="'.$title_to_projects_link.'"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s4 deswidget"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); $(\'#lastprojects4-'.$randID.' .project_list_s4\').carousel({dispItems:1}); });</script><div class="clear"></div></section>';
				} else {
					$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><div class="smartboxtitle page_title_s4"><span class="page_info_title_s4">'.$title.'</span><hr><div class="pag-proj2_s4"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s4 deswidget"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); $(\'#lastprojects4-'.$randID.' .project_list_s4\').carousel({dispItems: 1}); });</script><div class="clear"></div></section>';
				}	
			} else {
				if ($link_to_projects != ""){
					$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><div class="smartboxtitle page_title_s4"><span class="page_info_title_s4">'.$title.'</span><hr><div class="pag-proj2_s4"><div class="goto_projects" onclick="window.location = \''.$link_to_projects.'\';" title="'.$title_to_projects_link.'"></div></div></div><div class="project_list_s4"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); });</script><div class="clear"></div></section>';
				} else {
					if ($title == ""){
						$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><hr><div class="project_list_s4"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); });</script><div class="clear"></div></section>';
					} else {
						$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><div class="page_title_s4 a-left"><span class="page_info_title_s4">'.$t.'</span><hr></div><div class="project_list_s4"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); });</script><div class="clear"></div></section>';	
					}
				}
			}
		}
		

		echo $output;
	}
}
register_widget('Projects_Widget');

?>
