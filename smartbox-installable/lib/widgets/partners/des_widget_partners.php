<?php

class Partners_Widget extends WP_Widget {
	function Partners_Widget() {
		$widget_ops = array('classname' => 'partners_widget', 'description' => __('Show your partners on your site.','smartbox'));
		parent::__construct(false, 'DESIGNARE _ Partners', $widget_ops);
	}
function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";

		if (isset($instance['effect'])){
			$effect = esc_attr($instance['effect']); 	
		} else $effect = "";		
		
		if (isset($instance['scroller'])){
			$scroller = esc_attr($instance['scroller']); 	
		} else $scroller = "";
		
		if (isset($instance['partners_per_row'])){
			$partners_per_row = esc_attr($instance['partners_per_row']); 	
		} else $partners_per_row = "";
		
		if (isset($instance['categories'])){
			$categories = esc_attr($instance['categories']); 	
		} else $categories = "";
		
		if (isset($instance['nshow'])){
			$nshow = esc_attr($instance['nshow']);  	
		} else $nshow = "";
		
?>  
        
       <p><label for="<?php echo $this->get_field_id('title'); ?>">&#8212; <?php _e('Title','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p> 
       
       <p>
	        <label>&#8212; <?php _e('Partners Effect','smartbox'); ?> &#8212;<br>
	        <select id="<?php echo $this->get_field_id('effect'); ?>" name="<?php echo $this->get_field_name('effect'); ?>" style="margin-left:15px;">
		        <option value='opacity' <?php if ($effect == "opacity") echo "selected"; ?>>Opacity</option>
		        <option value='greyscale' <?php if ($effect == "greyscale") echo "selected"; ?>>Greyscale</option>
	        </select>
	        </label>
	    </p>
       
       <p><label for="<?php echo $this->get_field_id('nshow'); ?>">&#8212; <?php _e('Number Partners to show','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('nshow'); ?>" name="<?php echo $this->get_field_name('nshow'); ?>" type="text" value="<?php echo $nshow; ?>" /><br><span class="flickr-stuff">If 0 will show all partners.</span></label></p>
       <p class="partners_scroller_select"><label for="<?php echo $this->get_field_id('scroller'); ?>">&#8212; <?php _e('Scroller','smartbox'); ?> &nbsp;<input id="<?php echo $this->get_field_id('scroller'); ?>" name="<?php echo $this->get_field_name('scroller'); ?>" type="checkbox" value="scroller" <?php if($scroller == "scroller") echo 'checked'; ?> onchange="if (!jQuery(this).is(':checked')) jQuery(this).closest('p').next().show(); else jQuery(this).closest('p').next().hide();"/></label></p>
       
       <!-- NEW -->
       <p><label>&#8212; <?php _e('Partners per Row','smartbox'); ?> &#8212;</label><br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('partners_per_row'); ?>" value="1" <?php if($partners_per_row == '1') echo 'checked'; ?>>&nbsp;&nbsp;1<br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('partners_per_row'); ?>" value="2" <?php if($partners_per_row == '2') echo 'checked'; ?>>&nbsp;&nbsp;2<br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('partners_per_row'); ?>" value="3" <?php if($partners_per_row == '3') echo 'checked'; ?>>&nbsp;&nbsp;3<br>
    		<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('partners_per_row'); ?>" value="4" <?php if($partners_per_row == '4') echo 'checked'; ?>>&nbsp;&nbsp;4<br>
	   </p>

       
       <p><label for="<?php echo $this->get_field_id('categories'); ?>">&#8212; <?php _e('Categories','smartbox'); ?> &#8212;<input style="display:none;" class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" type="text" value="<?php echo $categories; ?>" /></label></p>
       <div class="widget-partners-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'partners_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		
		$categories = get_categories($args);
		if (count($categories) > 0){
			foreach($categories as $cats){
				?>
				<label></label><input type="checkbox" name="<?php echo $cats->slug; ?>" value="<?php echo $cats->slug; ?>"><?php echo $cats->cat_name; ?>
				<?php
			}
		}
		else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php _e("No Categories defined.", "smartbox"); ?></i> <?php }
	       
       ?>
       </div>   
        
       <script type="text/javascript">
	        jQuery(document).ready(function($){
	        
	        	$('.partners_scroller_select').each(function(e){
	        		if (!$(this).find('input').is(':checked')) $(this).parents('.scroller_select').next('p').hide();
	        		else $(this).parents('.scroller_select').next('p').show();
	        	});
	        	
	        	$('.partners_scroller_select').find('input').trigger('change');
	        	
	        	$('.widget-partners-categories').each(function(){
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
	    $instance['effect'] = $new_instance['effect'];
	    $instance['nshow'] = $new_instance['nshow'];
	    $instance['scroller'] = $new_instance['scroller'];
	    $instance['partners_per_row'] = $new_instance['partners_per_row'];
	    $instance['categories'] = $new_instance['categories'];
		return $instance;
	}
	
	function widget($args, $instance) {
		
		extract($instance);	
		$title = apply_filters('widget_title', $instance['title'], $instance);
	    $scroller = (isset($instance['scroller'])) ? "yes" : "no";
		if(empty($nshow) || $nshow == 0 )
	    	$nshow = -1;
	    $titles_html = '';
	
		$rid = rand(1, 100);
	
		$pag = "";
		if ($scroller == "yes"){
			wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
			$pag = "<div class='pag-proj_partners'>
				<div class='nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal'></div>
				<div class='prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal'></div>
			</div>";
		}
	
		if (esc_html($title) != "" && esc_html($title) != " "){ $titles_html .= '<div class="smartboxtitle"><hr><span>'.esc_html($title).'</span>'.$pag.'</div>'; }
		else { $titles_html .= '<div class="smartboxtitle">'.$pag.'</div>'; }
	
		$output = "<section id='partners-".$rid."' class='shortcode-partners sixteen columns". $css . "'>" . $titles_html . "<div class='partners-carousel deswidget'><ul class='partners-items'>";
		
		$columnslayout = "";
		$height = "300px";
		switch($partners_per_row){
			case "1":
				$columnslayout = "sixteen columns";
				$height = "270px";		
				break;
			case "2": 
				$columnslayout = "eight columns";
				$height = "250px";		
				break;
			case "3": 
				$columnslayout = "one-third column";
				$height = "200px";
				break;
			case "4": 
				$columnslayout = "four columns";
				$height = "180px";
				break;
		}
		
	   	$thecats = array();
		if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
	
		if ($scroller == "yes"){
		
			$args = array(
				'numberposts' => -1,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'partners',
				'post_status' => 'publish' 
			);
				
			$partners = get_posts( $args );	
			$filteredpartners = array();
			if ($categories != "all"){
				foreach ($partners as $p){
					$partnerscats = get_the_terms($p->ID, 'partners_category');
					$found = false;
					if (!empty($partnerscats)){
						foreach ($partnerscats as $pcats){
							foreach ($thecats as $pc){
								if ($pcats->slug == $pc) $found = true;	
							}
						}
						if ($found) {
							array_push($filteredpartners, $p);
							$partners = $filteredpartners;
						}
					}
				}			
			}
			
			foreach ($partners as $p){
				if ($scroller == "no")
					$output .= "<li class='".$columnslayout." partner-item no-flicker'>";
				else
					$output .= "<li class='withscroller partner-item no-flicker' style='margin-right:15px !important;'>";
				$output .= "<a target='_blank' href='";
				if (get_post_meta($p->ID, 'link_value', true) != ""){
					$output .= get_post_meta($p->ID, 'link_value', true);
				} else $output .= "javascript:;";
				$output .= "' title='".$p->post_title."'><img class='logopartner' src='".wp_get_attachment_url( get_post_thumbnail_id($p->ID))."' alt='".$p->post_title."' title='".$p->post_title."'/></a>";
				$output .= "</li>";
			}
			
			$output .= "</ul></div><div class='clear'></div></section>";
		
			if ($effect == "grayscale"){
				$output .= "
					<script type='text/javascript'>
						jQuery(document).ready(function($){
							jQuery('#partners-".$rid." .partners-items li').css({'margin':'0px 10px 0px 0px', 'float':'left', 'max-height':'130px'});
							jQuery('#partners-".$rid."').find('.partners-carousel').carousel({dispItems:1});
							jQuery('#partners-".$rid."').find('.logopartner').hide().fadeIn(1000);
						});
						jQuery(window).load(function(){
							jQuery('#partners-".$rid." .partners-items li').each(function(e){
								jQuery(this).css('min-height','').css('max-height',jQuery(this).children('a').height());
							});
							jQuery('#partners-".$rid."').find('.logopartner').each(function(){
								jQuery(this).greyScale({
						          fadeTime: 500,
						          reverse: false
						        });
							});
						});
						jQuery(window).resize(function(){
							jQuery('#partners-".$rid." .partners-items li').each(function(e){
								jQuery(this).css('min-height','').css('max-height',jQuery(this).children('a').height());
							});
						});
					</script>
				";
			} else {
				$output .= "
					<script type='text/javascript'>
						jQuery(document).ready(function($){
							jQuery('#partners-".$rid." .partners-items br').remove();
							jQuery('#partners-".$rid." .partners-items li').css({'margin':'0px 10px 0px 0px', 'max-height': '130px', 'float':'left'});
							jQuery('#partners-".$rid."').find('.partners-carousel').carousel({dispItems:1});
							jQuery('#partners-".$rid."').find('.partners-carousel').find('li').each(function(){
								jQuery(this).hover(function(){ jQuery(this).siblings().addClass('highlight'); }, function(){ jQuery(this).siblings().removeClass('highlight'); });
							});
						});
						jQuery(window).load(function(){
							jQuery('#partners-".$rid." .partners-items li').each(function(e){
								jQuery(this).css('min-height','').css('max-height',jQuery(this).children('a').height());
							});
						});
						jQuery(window).resize(function(){
							jQuery('#partners-".$rid." .partners-items li').each(function(e){
								jQuery(this).css('min-height','').css('max-height',jQuery(this).children('a').height());
							});
						});
					</script>
				";
			}
		} else {
		
			$args = array(
				'numberposts' => $nshow,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'partners',
				'post_status' => 'publish' 
			);
				
			$partners = get_posts( $args );	
			$partners = get_posts( $args );	
			$filteredpartners = array();
			if ($categories != "all"){
				foreach ($partners as $p){
					$partnerscats = get_the_terms($p->ID, 'partners_category');
					$found = false;
					if (is_array($partnerscats)){
						foreach ($partnerscats as $pcats){
							foreach ($thecats as $pc){
								if ($pcats->slug == $pc) $found = true;	
							}
						}	
					}
					if ($found) {
						array_push($filteredpartners, $p);
						$partners = $filteredpartners;
					}
				}			
			}
			
					
			foreach ($partners as $p){
				if ($scroller == "no")
					$output .= "<li class='".$columnslayout." partner-item no-flicker'>";
				else
					$output .= "<li class='withscroller partner-item no-flicker'>";
				$output .= "<a target='_blank' href='";
				if (get_post_meta($p->ID, 'link_value', true) != ""){
					$output .= get_post_meta($p->ID, 'link_value', true);
				} else $output .= "javascript:;";
				$output .= "' title='".$p->post_title."'><img class='logopartner' src='".wp_get_attachment_url( get_post_thumbnail_id($p->ID))."' alt='".$p->post_title."' title='".$p->post_title."' /></a>";
				$output .= "</li>";
			}
		
			$output .= "</ul></div><div class='clear'></div></section>";
			
			if ($effect == "grayscale"){
				$output .= "
					<script type='text/javascript'>
						jQuery(document).ready(function($){
							jQuery('#partners-".$rid." .partners-items li').css({'max-height':'130px', 'float':'left'});
							jQuery('#partners-".$rid."').find('.logopartner').hide().fadeIn(1000);
						});
						jQuery(window).load(function(){
							jQuery('#partners-".$rid."').find('.logopartner').each(function(){
								jQuery(this).greyScale({
						          fadeTime: 500,
						          reverse: false
						        });
							});
						});
					</script>
				";
			} else {
				$output .= "
					<script type='text/javascript'>
						jQuery(document).ready(function($){
							jQuery('#partners-".$rid." .partners-items br').remove();
							jQuery('#partners-".$rid." .partners-items li').css({'max-height':'130px', 'float':'left'});
							jQuery('#partners-".$rid."').find('.partners-carousel').find('li').each(function(){
								jQuery(this).hover(function(){ jQuery(this).siblings().addClass('highlight'); }, function(){ jQuery(this).siblings().removeClass('highlight'); });
							});
						});
					</script>
				";
			}
		}
		
		echo $output;
		//echo $after_widget;
	}
}
register_widget('Partners_Widget');

?>
