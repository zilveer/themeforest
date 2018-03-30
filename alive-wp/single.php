<?php 

get_header(); 

$gallery_id = (get_post_meta($post->ID, THEME_METABOX . 'gallery_id', true) == "") ? null : get_post_meta($post->ID, THEME_METABOX . 'gallery_id', true);
$gallery_columns = (get_post_meta($post->ID, THEME_METABOX . 'gallery_columns', true) == "") ? 3 : get_post_meta($post->ID, THEME_METABOX . 'gallery_columns', true);

$heading_text = (get_post_meta($post->ID, THEME_METABOX . "heading_text", true) == "") ? get_the_title() : get_post_meta($post->ID, THEME_METABOX . "heading_text", true);
$heading_size = (get_post_meta($post->ID, THEME_METABOX . "heading_size", true) == "") ? "80" : get_post_meta($post->ID, THEME_METABOX . "heading_size", true);
?>

	<!-- start contentWrapper -->
	<div id="contentWrapper">
	
		<!-- start content -->
		<div id="content">
			
			
			<h1 class="pageHeading" style="font-size: <?php echo $heading_size; ?>px;"><?php echo $heading_text;?></h1>
			<!-- START single post -->
			<div id="singlePost" >
			
			<?php if (get_post_meta($post->ID, THEME_METABOX . "subheading_text", true) != "") echo '<h2>'.get_post_meta($post->ID, THEME_METABOX . "subheading_text", true).'</h2>'; ?>
			<!-- start post -->
			<div <?php post_class("last"); ?>>			
			<?php 
			
			if (have_posts()) : while (have_posts()) : the_post();
			
			$image_url_big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
			$image_url_small = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog_image_thumb');
			
			?>
			<?php if (has_post_thumbnail()) : ?>
		
				<div class="mediaContainer blog">
					<a class="_image" title="<?php echo $post->post_title ?>" href="<?php echo $image_url_big[0]; ?>">
						<div class="_rollover"></div>
						<img src="<?php echo $image_url_small[0] ?>" width="500"  height="200" alt="<?php echo $post->post_title ?>"/>
					</a>  
				</div>	
			
			<?php endif; ?>
			<div class="postContent">
				
				<ul class="entryMeta">
					<li class="author"><?php the_author_posts_link() ?></li>
					<?php if(has_category()) : ?><li class="category"><?php the_category(" &middot; ") ?></li><?php endif;?>
					<li class="date"><?php the_time("F j, Y") ?></li>
					<li class="comments"><?php comments_number();?></li>
					<?php if(has_tag()) : ?><li class="tags"><?php the_tags("") ?></li><?php endif;?>
					<?php edit_post_link(__('Edit this', 'alive'), '<li>','</li>'); ?>
				</ul> 
			
			
				<?php the_content(); ?>   
				
				
				<?php 
					if($gallery_id != ''):
					$args = array( 'post_type' => 'gallery', 'posts_per_page' => -1, 'p' => $gallery_id);
					query_posts($args);
					
					$item_count = 1;
					
					if (have_posts()) : while (have_posts()) : the_post();
																																
					$attachments = get_children(array('post_parent' => $post->ID,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order',
					'numberposts' => -1));
					
					
					foreach($attachments as $att_id => $attachment) :
					
					
					
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
								<a class="_video __gallery<?php echo $gallery_id;?>"  href="http://www.youtube.com/v/<?php echo get_post_meta($attachment->ID, 'theme_video_link', true) ?>?autohide=2&amp;cc_load_policy=0&amp;controls=0&amp;disablekb=0&amp;fs=1&amp;hd=0&amp;loop=0&amp;rel=0&amp;showinfo=0&amp;showsearch=0&amp;wmode=transparent">
									<div class="_rollover">
										<span class="mediaCaption"><?php echo $item_description; ?></span>
									</div>
									<img src="<?php echo $image_url_small[0] ?>" width="<?php echo $media_width; ?>"  height="<?php echo $media_height; ?>" alt=""/>
								</a>  
		                     </div>                      					
		
						<?php break; 
						
					case "vimeo" : ?>
						
							<div class="mediaContainer gallery <?php echo $media_class;?> <?php if ($item_count % $gallery_columns == 0) {echo "last"; }?>">
								<a class="_video __gallery<?php echo $gallery_id;?>"  href="http://vimeo.com/moogaloop.swf?clip_id=<?php echo get_post_meta($attachment->ID, 'theme_video_link', true) ?>&amp;title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0&amp;loop=0">
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
						
						endforeach; 
												
						endwhile; endif; 
						endif;
						wp_reset_query(); 					
					
					?>
					
			</div>
			
			<?php 
			
			endwhile; endif; 
			?>
			
			<?php
				
			comments_template();
				
			wp_reset_query(); 
			
			?>
			</div>
			<!-- end post -->
		</div>
		<!-- end single post -->
		<div class="clear"></div>
		<?php get_sidebar(); ?> 
<?php get_footer(); ?>