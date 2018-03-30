		<?php

				$pp_slider_sort = get_option('pp_slider_sort'); 
				if(empty($pp_slider_sort))
				{
					$pp_slider_sort = 'ASC';
				}
			
				$slider_arr = get_posts('numberposts=6&order='.$pp_slider_sort.'&orderby=date&post_type=slides');

				if(!empty($slider_arr))
				{
		?>
		
						<ul id="kwicks_slider">
							<?php
								$slider_size = count($slider_arr);
								$initial_width = intval(960/$slider_size);
							
								foreach($slider_arr as $key => $gallery_item)
								{
									$image_url = '';
								
									if(has_post_thumbnail($gallery_item->ID, 'large'))
									{
										$image_id = get_post_thumbnail_id($gallery_item->ID);
										$image_url = wp_get_attachment_image_src($image_id, 'large', true);
									}
													
									$hyperlink_url = get_post_meta($gallery_item->ID, 'gallery_link_url', true);
									
									$caption_align = get_post_meta($gallery_item->ID, 'caption_align', true);
									$caption_style = '';
						
									if($caption_align != 'No Caption')
									{
										$caption_style = '#caption'.$key;
									}
							?>
							<li style="width:<?php echo $initial_width; ?>px">
							<div>
								<div class="kwicks_shadow"></div>
								<a href="<?php echo $hyperlink_url;?>">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_url[0]; ?>&amp;h=360&amp;w=900&amp;zc=1" alt="" style="display:block"/>
								</a>
								<div class="kwicks_title" style="display:block">
									<h6 class="cufon"><?php echo pp_substr($gallery_item->post_title, 16); ?></h6>
								</div>
								<div class="kwicks_title_large" style="display:none">
									<h4 class="cufon"><?php echo $gallery_item->post_title; ?></h4>
									<?php echo $gallery_item->post_content; ?>
								</div>
							</div>
							</li>
							
							<?php
								}
							?>
						</ul>
				
				<?php
				if(false)
				{
					foreach($slider_arr as $key => $gallery_item)
					{
						$caption_align = get_post_meta($gallery_item->ID, 'caption_align', true);
						$caption_style = '';
						
						if($caption_align != 'No Caption')
						{
						
							switch($caption_align)
							{
								case 'Align Right':
									$caption_style = 'left:560px;';
								break;
								case 'Bottom':
									$caption_style = 'left:0px;bottom:0;width:100%;';
								break;
							}
				?>
				
						<div id="caption<?php echo $key; ?>" class="nivo-html-caption" style="<?php echo $caption_style; ?>">
							<h4><?php echo $gallery_item->post_title; ?></h4>
							<?php echo pp_substr(strip_tags(strip_shortcodes($gallery_item->post_content)), 200); ?>
						</div>
				
				<?php
						}
					}
				}
				?>
		
		<?php 
				}
		?>
		
<script type="text/javascript"> 
$j(document).ready(function() {
	$j('#kwicks_slider').kwicks({
		max : 900,
		spacing : 0,
		duration : 500
	});
	
	$j('#slider_loading').css('display', 'none');
	$j('#slider_wrapper').css('visibility', 'visible');
});
</script> 