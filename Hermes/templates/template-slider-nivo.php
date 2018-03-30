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
					$pp_homepage_button_title = get_option('pp_homepage_button_title');
					if(empty($pp_homepage_button_title))
					{
						$pp_homepage_button_title = 'Learn More';
					}
		?>
		
				<div id="nivo_slider" class="nivoSlider">
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
									
									$caption_align = get_post_meta($gallery_item->ID, 'caption_align', true);
									$caption_style = '';
						
									if($caption_align != 'No Caption')
									{
										$caption_style = '#caption'.$key;
									}
							?>
							<a href="<?php echo $hyperlink_url;?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_url[0]; ?>&amp;h=340&amp;w=960&amp;zc=1" alt="" <?php if(!empty($caption_style)) { echo 'title="'.$caption_style.'"'; } ?>/>
							</a>
							
							<?php
								}
							?>
				</div>
		
		<?php 
				}
		?>

<?php
	$pp_homepage_slider_nav = 'false';
	if(get_option('pp_homepage_slider_nav'))
	{
		$pp_homepage_slider_nav = 'true';
	}
	
	$pp_advance_enable_switcher = get_option('pp_advance_enable_switcher');
					
	if(!empty($pp_advance_enable_switcher) && isset($_SESSION['pp_slider_effect']))
	{
	    $pp_slider_effect = $_SESSION['pp_slider_effect'];
	}
	else
	{
	    $pp_slider_effect = get_option('pp_slider_effect');
	}
?>
		
<script type="text/javascript"> 
$j(window).load(function() {
	$j('#nivo_slider').nivoSlider({ pauseTime: parseInt($j('#slider_timer').val() * 1000), pauseOnHover: true, effect: '<?php echo $pp_slider_effect; ?>', controlNav: true, captionOpacity: 1, directionNavHide: <?php echo $pp_homepage_slider_nav; ?>, controlNavThumbs:false, controlNavThumbsFromRel:false, boxCols:8, boxRows:4, afterLoad: function(){ 
		$j('#slider_loading').css('display', 'none');
		$j('#slider_wrapper').css('visibility', 'visible');
	} });
});
</script> 