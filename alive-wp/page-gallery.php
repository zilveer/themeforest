<?php

/*
Template Name: Gallery

*/

get_header();

$gallery_id = (get_post_meta($post->ID, THEME_METABOX . 'gallery_id', true) == "") ? null : get_post_meta($post->ID, THEME_METABOX . 'gallery_id', true);
$gallery_columns = (get_post_meta($post->ID, THEME_METABOX . 'gallery_columns', true) == "") ? 3 : get_post_meta($post->ID, THEME_METABOX . 'gallery_columns', true);
$gallery_items = (get_post_meta($post->ID, THEME_METABOX . 'gallery_items', true) == "") ? (int) of_get_option("gallery_items_per_page") : get_post_meta($post->ID, THEME_METABOX . 'gallery_items', true);


$heading_text = (get_post_meta($post->ID, THEME_METABOX . "heading_text", true) == "") ? get_the_title() : get_post_meta($post->ID, THEME_METABOX . "heading_text", true);
$heading_size = (get_post_meta($post->ID, THEME_METABOX . "heading_size", true) == "") ? "80" : get_post_meta($post->ID, THEME_METABOX . "heading_size", true);

?>		

	<!-- start contentWrapper -->
    <div id="contentWrapper">

		<!-- start content -->
		<div id="content">
	
			<h1 class="pageHeading" style="font-size: <?php echo $heading_size; ?>px;"><?php echo $heading_text;?></h1>
			
			<?php the_content();?>

			<!-- start galleryContainer -->    				
			<div id="galleryContainer" class="container">
				<ul class="contentPaginate">
					<?php 
					if($gallery_id != ''):
					$args = array( 'post_type' => 'gallery', 'posts_per_page' => -1, 'p' => $gallery_id);
					query_posts($args);
					
					$item_count = 1;
					$items_per_page = $gallery_items + 1;
					 					
					
					if (have_posts()) : while (have_posts()) : the_post();
																																
					$attachments = get_children(array('post_parent' => $post->ID,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order',
					'numberposts' => -1));
					
					
					foreach($attachments as $att_id => $attachment) :
					
					if ($item_count == 1) {
						echo '<li>';
					}
					
					switch($gallery_columns) {
						case 1:
							$media_width = 500;
							$media_height = 500;
							$media_class = "oneCol";
							$image_url_small = wp_get_attachment_image_src($attachment->ID, "gallery_thumb_one");
							break;
						case 2:
							$media_width = 245;
							$media_height = 245;
							$media_class = "twoCol";
							$image_url_small = wp_get_attachment_image_src($attachment->ID, "gallery_thumb_two");
							break;
						default:
							$media_width = 160;
							$media_height = 160;
							$media_class = "threeCol";
							$image_url_small = wp_get_attachment_image_src($attachment->ID, "gallery_thumb");

					}
					
					$image_url_big = wp_get_attachment_image_src($attachment->ID, "full");
					$item_description = ($attachment->post_content == "") ? "" : '<p>'.$attachment->post_content.'</p>';
					
					switch (get_post_meta($attachment->ID, "theme_item_type", true)) : 
					
					case "youtube" : ?>
							<div class="mediaContainer gallery <?php echo $media_class;?> <?php if ($item_count % $gallery_columns == 0) {echo "last"; }?>">
								<a class="_video __gallery<?php echo $gallery_id;?>"  href="http://www.youtube.com/watch?v=<?php echo get_post_meta($attachment->ID, 'theme_video_link', true) ?>?autohide=2&disablekb=0&fs=0&hd=0&loop=0&rel=0&showinfo=0&showsearch=0&wmode=transparent">
									<div class="_rollover">
										<span class="mediaCaption"><?php echo $item_description; ?></span>
									</div>
									<img src="<?php echo $image_url_small[0] ?>" width="<?php echo $media_width; ?>"  height="<?php echo $media_height; ?>" alt=""/>
								</a>  
		                     </div>                      					
		
						<?php break; 
						
					case "vimeo" : ?>
						
							<div class="mediaContainer gallery <?php echo $media_class;?> <?php if ($item_count % $gallery_columns == 0) {echo "last"; }?>">
								<a class="_video __gallery<?php echo $gallery_id;?>"  href="http://player.vimeo.com/video/<?php echo get_post_meta($attachment->ID, 'theme_video_link', true) ?>?title=0&byline=0&portrait=0&autoplay=0&loop=0">
									<div class="_rollover">
										<span class="mediaCaption"><?php echo $item_description; ?></span>
									</div>
									<img src="<?php echo $image_url_small[0] ?>" width="<?php echo $media_width; ?>"  height="<?php echo $media_height; ?>" alt=""/>
								</a>    
		                 	</div>      				                    					
		
						<?php break; 
					
					default : ?>
						<div class="mediaContainer gallery <?php echo $media_class;?> <?php if ($item_count % $gallery_columns == 0) {echo "last"; }?>">
							<a class="_image __gallery<?php echo $gallery_id;?>" title="<?php echo $attachment->post_title ?>" href="<?php echo $image_url_big[0] ?>"> 
								<div class="_rollover">
										<span class="mediaCaption"><?php echo $item_description; ?></span>
								</div>
								<img src="<?php echo $image_url_small[0] ?>" width="<?php echo $media_width; ?>"  height="<?php echo $media_height; ?>" alt=""/>
							</a>	
						</div>                      
					
						<?php 
						endswitch; ?> 
						
						<?php 
						$item_count++;
						if ($item_count == $items_per_page) {
							echo '</li>';
							$item_count = 1;		
						}
						
						endforeach; 
												
						endwhile; endif; endif;
						
						wp_reset_query(); 					
					
					?>
													
				</ul>	
				
				<div class="page_navigation"></div>
		
			</div>		
			<!-- end gallery container -->   
			<div class="clear"></div>

<?php get_footer(); ?>