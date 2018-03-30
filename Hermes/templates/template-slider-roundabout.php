		<?php
				$pp_slider_items = get_option('pp_slider_items');
				
				if(empty($pp_slider_items))
				{
					$pp_slider_items = 5;
				}

				$pp_slider_sort = get_option('pp_slider_sort'); 
				if(empty($pp_slider_sort))
				{
					$pp_slider_sort = 'ASC';
				}
			
				$slider_arr = get_posts('numberposts='.$pp_slider_items.'&order='.$pp_slider_sort.'&orderby=date&post_type=slides');

				if(!empty($slider_arr))
				{
		?>
		
				<div id="roundabout">
					<div id="roundabout_header" class="roundabout_header">
						<h1 class="cufon"><?php echo $slider_arr[0]->post_title; ?></h1>
						<p><?php echo strip_tags(strip_shortcodes($slider_arr[0]->post_content)); ?></p>
					</div>
					<ul>
							<?php
								foreach($slider_arr as $key => $gallery_item)
								{
									$image_url = '';
								
									if(has_post_thumbnail($gallery_item->ID, 'large'))
									{
										$image_id = get_post_thumbnail_id($gallery_item->ID);
										$image_url = wp_get_attachment_image_src($image_id, 'full', true);
									}
													
									$hyperlink_url = get_post_meta($gallery_item->ID, 'gallery_link_url', true);
							?>
							<li>
								<a href="<?php echo $hyperlink_url;?>">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_url[0]; ?>&h=280&w=350&zc=1" alt="" title="<?php echo $gallery_item->post_title; ?>" longdesc="<?php echo strip_tags(strip_shortcodes($gallery_item->post_content)); ?>"/>
								</a>
							</li>
							
							<?php
								}
							?>
						</ul>
						
						<br class="clear"/><br/>
				</div>
		
		<?php 
				}
		?>
		
<script type="text/javascript"> 
// <[CDATA[
$j(document).ready(function() {
    var interval;
    
    $j('#roundabout ul')
    	.roundabout({reflect: true})
    	.hover(
    		function() {
    			// oh no, it's the cops!
    			clearInterval(interval);
    		},
    		function() {
    			// false alarm: PARTY!
    			interval = startAutoPlay();
    		}
    	);
    
    // let's get this party started
    interval = startAutoPlay();
});

function startAutoPlay() {
    return setInterval(function() {
    	$j('#roundabout ul').roundabout_animateToNextChild();
    }, parseInt($j('#slider_timer').val() * 1000));
}
// ]]>
</script> 