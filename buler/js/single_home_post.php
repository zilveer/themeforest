<?php

	ob_start();

	define('AWP_AJAXED', true);

	define('AWP_ID', $id);



    $root = dirname(dirname(dirname(dirname(__FILE__))));

      if (file_exists($root.'/wp-load.php')) {

          // WP 2.6

          require_once($root.'/wp-load.php');




      } else {

          // Before 2.6

          require_once($root.'/wp-config.php');


				



      }





	ob_end_clean();

	global $wpdb;

	$pc = new WP_Query(array('p' => $_POST['id'])); 
	

	?>
	

<div class="mainwrap">
	<div class="main clearfix post home">
	
	<?php if ($pc -> have_posts()) : while ($pc ->have_posts()) : $pc ->the_post(); ?>
	<?php  $postmeta = get_post_custom($post->ID); ?>
	<div class="main clearfix">	
	<div class="content singledefult">
		<div class="postcontent singledefult" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
			<div class="blogpost">		
				<div class="posttext">
				<?php if( !get_post_format()){?> 
				
				<?php } ?>
					<?php if ( !has_post_format( 'gallery' , get_the_id())) { ?>
						<div class="overdefultlink"></div>
						<div class="blogsingleimage">			
							<?php	
							if ( !get_post_format() ) {
						
								
							?>
								<?php pmc_getImage('homepost'); ?>
							<?php } ?>
							<?php if ( has_post_format( 'video' , get_the_id())) {?>
							
								<?php  
								if(isset($postmeta["selectv"][0])){
									if ($postmeta["selectv"][0] == 'vimeo')  
									{  
										echo '<iframe src="http://player.vimeo.com/video/'.$postmeta["video_post_url"][0].'" width="580" height="280"  ></iframe>';  
									}  
									else if ($postmeta["selectv"][0] == 'youtube')  
									{  
										echo '<iframe width="580" height="280" src="http://www.youtube.com/embed/'.$postmeta["video_post_url"][0].'"  ></iframe>';  
									}  
									else  
									{  
										echo 'Please select a Video Site via the WordPress Admin';  
									}
								}
								?>
							<?php
							}
							?>	
							<?php if ( has_post_format( 'audio' , get_the_id())) {?>
							<div class="audioPlayer">
								<?php 
								if(isset($postmeta["audio_post_url"][0]))
									echo do_shortcode('[audio file="'. $postmeta["audio_post_url"][0] .'"]') ?>
							</div>
							<?php
							}
							?>	
							<div class="leftholder">
								<div class="blogAuthor">
									<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar( get_the_author_meta('ID'), 64); ?></a>
									<div class="authorBlogName">
										<strong><?php echo pmc_translation('translation_by','By: ') ?></strong> 	
										<?php the_author_posts_link(); ?> 
									</div>
								</div>
								<div class="blogComments">
									<a href="<?php the_permalink() ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a>
								</div>
								<div class="blogIcon">
								<?php if(has_post_format( 'audio' , get_the_id())) {?>
									<div class="blogIconAudio"></div>
								<?php } elseif(has_post_format( 'video' , get_the_id())){ ?>
									<div class="blogIconVideo"></div>
								<?php } elseif(has_post_format( 'gallery' , get_the_id())){ ?>
									<div class="blogIconGallery"></div>
								<?php } else {?>			
									<div class="blogIconDefault"></div>		
								<?php } ?>
								</div>
							</div>
							<?php if(has_post_format( 'video' , get_the_id())){ ?>
								<div class = "meta videoGallery">
							<?php } 
							
							else {?>
								<div class = "meta">
							<?php } ?>		
									<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<div class = "posted-date">
									<i class="fa fa-calendar"></i>	
										<a href="<?php 
										$arc_year = get_the_time('Y'); 
										$arc_month = get_the_time('m'); 
										$arc_day = get_the_time('d');
										echo get_day_link($arc_year, $arc_month, $arc_day); ?>"><?php the_time('F j, Y') ?></a>
									</div>
									<div class="categoryblog"><i class="fa fa-tasks"></i>							
										<?php   if(get_query_var('portfoliocategory')){ 
											echo get_the_term_list( get_the_id(), 'portfoliocategory', '', ', ', '' ); 
										} else {
											the_category(', '); 
										}?></div>
									

							</div>
							
						</div>
					<?php } else {?>
						<?php
						global $post;
						$post_subtitrare = get_post( get_the_id() );
						$content = $post_subtitrare->post_content;
						$pattern = get_shortcode_regex();
						preg_match( "/$pattern/s", $content, $match );
						if( isset( $match[2] ) && ( "gallery" == $match[2] ) ) {
							$atts = shortcode_parse_atts( $match[3] );
							$attachments = isset( $atts['ids'] ) ? explode( ',', $atts['ids'] ) : get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_id() .'&order=ASC&orderby=menu_order ID' );
						}

						if ($attachments) {?>
						<div class="gallery-single">
						<?php
							foreach ($attachments as $attachment) {
								$title = '';
								//echo apply_filters('the_title', $attachment->post_title);
								$image =  wp_get_attachment_image_src( $attachment, 'gallery' ); 	 
								$imagefull =  wp_get_attachment_image_src( $attachment, 'full' ); 	 ?>
									<div class="image-gallery">
										<a href="<?php echo $imagefull[0] ?>" rel="lightbox[single-gallery]" title="<?php the_title(); ?>"><div class = "over"></div>
											<img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>"/>			
										</a>	
									</div>			
									<?php } ?>
						</div>
						<div class="bottomborder"></div>
						<?php } ?>
							<div class="leftholder">
								<div class="blogAuthor">
									<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar( get_the_author_meta('ID'), 64); ?></a>
									<div class="authorBlogName">
										<strong><?php echo pmc_translation('translation_by','By: ') ?></strong> 	
										<?php the_author_posts_link(); ?> 
									</div>
								</div>
								<div class="blogComments">
									<a href="<?php the_permalink() ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a>
								</div>
								<div class="blogIcon">
								<?php if(has_post_format( 'audio' , get_the_id())) {?>
									<div class="blogIconAudio"></div>
								<?php } elseif(has_post_format( 'video' , get_the_id())){ ?>
									<div class="blogIconVideo"></div>
								<?php } elseif(has_post_format( 'gallery' , get_the_id())){ ?>
									<div class="blogIconGallery"></div>
								<?php } else {?>			
									<div class="blogIconDefault"></div>		
								<?php } ?>
								</div>
							</div>
							<div class = "meta videoGallery">
								<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<div class = "posted-date"><i class="fa fa-calendar"></i>	
									<a href="<?php 
									$arc_year = get_the_time('Y'); 
									$arc_month = get_the_time('m'); 
									$arc_day = get_the_time('d');
									echo get_day_link($arc_year, $arc_month, $arc_day); ?>"><?php the_time('F j, Y') ?></a>
								</div>
								<div class="categoryblog"><i class="fa fa-tasks"></i>							
										<?php   if(get_query_var('portfoliocategory')){ 
											echo get_the_term_list( get_the_id(), 'portfoliocategory', '', ', ', '' ); 
										} else {
											the_category(', '); 
										}?></div>
									

							</div>
					<?php }  ?>
					<div class="sentry">
						<?php if ( has_post_format( 'video' , get_the_id())) {?>
							<div><?php the_content(); ?></div>
						<?php
						}
					    if ( has_post_format( 'audio' , get_the_id())) { ?>
							<div><?php the_content(); ?></div>
						<?php
						}						
						if(has_post_format( 'gallery' , get_the_id())){?>
							<div class="gallery-content"><?php the_content(); 	?></div>
						<?php } 
						if( !get_post_format()){?> 
						    <?php add_filter('the_content', 'addlightboxrel_replace'); ?>
							<div><?php the_content(); ?></div>		
						<?php } ?>
						<div class="singleBorder"></div>
					</div>
				</div>
				
				<?php if(has_tag()) { ?>
					<div class="tags"><i class="fa fa-tags"></i><?php the_tags('',', ',''); ?></div>	
				<?php } ?>

				
			</div>						
			
		</div>		
	
	
	<?php comments_template(); ?>
					
	<?php endwhile; endif;?>

	
					

	

	</div>

</div>
	
<script type="text/javascript" charset="utf-8">
 jQuery(document).ready(function(){
    jQuery("a[rel^='lightbox']").prettyPhoto({theme:'light_rounded',overlay_gallery: false,show_title: false});
  });
</script>