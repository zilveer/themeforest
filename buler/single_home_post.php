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
	

<div class="mainwrap home-ajax">
	<div class="main clearfix post home">
	
	<?php if ($pc -> have_posts()) : while ($pc -> have_posts()) : $pc -> the_post();  $postmeta = get_post_custom(get_the_id());  ?>
	<div class="main clearfix">	
	<div class="content singledefult ">
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
								<?php pmc_getImage('blog'); ?>
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
							<?php if(has_post_format( 'video' , get_the_id())){ ?>
								<div class = "meta videoGallery">
							<?php } 
							
							else {?>
								<div class = "meta">
							<?php } ?>		
									<h1><?php the_title();?></h1>
									<?php the_time('F j, Y') ?> <?php echo pmc_translation('translation_by','By: ') ?> <?php echo get_the_author_link() ?> - <a href="#commentform"><?php comments_number(); ?></a>
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
							<div class = "meta videoGallery">
								<h1><?php the_title();?></h1>
								<?php the_time('F j, Y') ?> <?php echo pmc_translation('translation_by','By: ') ?> <?php echo get_the_author_link() ?> - <a href="#commentform"><?php comments_number(); ?></a>
								</div>	
					<?php }  ?>
					<div class="sentry">
						<?php if ( has_post_format( 'video' , get_the_id())) {?>
							<div><?php the_content(''); ?></div>
						<?php
						}
					    if ( has_post_format( 'audio' , get_the_id())) { ?>
							<div><?php the_content(''); ?></div>
						<?php
						}						
						if(has_post_format( 'gallery' , get_the_id())){?>
							<div class="gallery-content"><?php the_content(''); 	?></div>
						<?php } 
						if( !get_post_format()){?> 
						    <?php add_filter('the_content', 'pmc_addlightbox'); ?>
							<div><?php the_content(''); ?></div>		
						<?php } ?>
						<div class="singleBorder"></div>
					</div>
				</div>
				

				
			</div>						
			<div class="read-more"><a href="<?php echo get_permalink(get_the_id()) ?>"><?php echo pmc_translation('translation_morelinkport','Read more about this...') ?> <?php the_title() ?></a></div>
		</div>		

	<?php comments_template(); ?>
					
	<?php endwhile; else: ?>
					
		<?php get_template_part('404'); ?>

	<?php endif; ?>

	
					

	<div class="sidebar">
		<?php dynamic_sidebar('homepost'); ?>
	</div>	
	</div>

</div>
	
<script type="text/javascript" charset="utf-8">
 jQuery(document).ready(function(){
    jQuery("a[rel^='lightbox']").prettyPhoto({theme:'light_rounded',overlay_gallery: false,show_title: false});
  });
</script>