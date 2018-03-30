<?php
 	if($pp_home_display_slide)
 	{
 		$featured_posts_arr = get_posts('numberposts=7&order=DESC&orderby=date&category='.$pp_featured_cat);
 	}
 
 	if(!empty($featured_posts_arr))
 	{
 ?>
 
 <div id="slider_wrapper">
 
  <div id="home_slider" class="flexslider">
		<ul class="slides">
		    <?php
		    	$slide_count = count($featured_posts_arr);
		    
		    	foreach($featured_posts_arr as $key => $featured_post)
		        {
		        	$image_url = '';
		        
		        	if(has_post_thumbnail($featured_post->ID, 'home_full_ft'))
		        	{
		        		$image_id = get_post_thumbnail_id($featured_post->ID);
		        		$image_url = wp_get_attachment_image_src($image_id, 'home_full_ft', true);
		        	}
		        					
		        	$hyperlink_url = get_permalink($featured_post->ID);
		        	
		        	$post_categories = wp_get_post_categories( $featured_post->ID );
    				$cats = array();
    					
    				foreach($post_categories as $c){
    					$cat = get_category( $c );
    					
    					if($pp_featured_cat != $cat->term_id)
    					{
    						$cats[0] = array( 'name' => $cat->name );
    						break;
    					}
    				}
		    ?>
		    <li>
		    	<a href="<?php echo $hyperlink_url;?>">
		    		<img src="<?php echo $image_url[0]; ?>" alt="<?php echo $featured_post->post_title; ?>"/>
		    		
		    		<div id="caption<?php echo $key; ?>" class="flexslider_caption" <?php if($key == 0) { echo 'style="display:block"'; } ?>>
    					<?php
    						if(isset($cats[0]))
    						{
    					?>
    					
    					<div class="caption_cat"><?php echo $cats[0]['name']; ?></div>
    					
    					<?php
    						} else {
    					?>
    					
    					<div class="caption_cat" style="display:none">None</div>
    					
    					<?php
    						}
    					?>
    					<h4><?php echo $featured_post->post_title; ?></h4>
    					<div class="flexslider_excerpt">
    						<?php echo pp_substr(strip_tags(strip_shortcodes($featured_post->post_content)), 120); ?>
    					</div>
    				</div>
		    	</a>
		    </li>
		    
		    <?php
		        }
		    ?>
		</ul>
	</div>
	
<script type="text/javascript"> 
$j(window).load(function() {
    $j('#slider_wrapper .flexslider').flexslider({
    	animation: "slide",
    	slideDirection: 'horizontal',
    	slideshowSpeed: 5000,
    	slideshow: true,
    	start: function(slider) {
       		var slide_control_width = 100/<?php echo $slide_count; ?>;
    		$j('#slider_wrapper .flex-control-nav li').css('width', slide_control_width+'%');
      	}
    });
});
</script>
 
 <?php
 	} 
 ?>
 </div>