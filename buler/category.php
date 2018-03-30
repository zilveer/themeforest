<?php get_header(); 

?>
<?php global $pmc_data, $sitepress; 
wp_enqueue_script('pmc_any');


?>
<script type="text/javascript">
jQuery(document).ready(function($){
	    $('.slider').anythingSlider({
		hashTags : false,
		expand		: true,
		autoPlay	: true,
		resizeContents  : false,
		pauseOnHover    : true,
		buildArrows     : false,
		buildNavigation : false,
		delay		: 4000,
		resumeDelay	: 0,
		animationTime	: 800,
		delayBeforeAnimate:0,	
		easing : 'easeInOutQuint',
	    })


	});
	
</script>	

<!-- top bar with breadcrumb -->

<div class = "outerpagewrap">
	<div class="pagewrap">
		<div class="pagecontent">
			<div class="pagecontentContent">
				<p><?php echo pmc_breadcrumb(); ?></p>
			</div>
		</div>

	</div>
</div>   
<!-- main content start -->
<div class="mainwrap blog">
	<div class="main clearfix">
		<div class="pad"></div>			
		<div class="content blog">
					
			<?php if (have_posts()) : ?>
			
			<?php while (have_posts()) : the_post();
			$postmeta = get_post_custom(get_the_id()); 
			if ( has_post_format( 'gallery' , get_the_id())) { 
			?>
			<div class="slider-category">
			
				<div class="blogpostcategory">
				<?php
					global $post;
					$attachments = '';
					$post_subtitrare = get_post( get_the_id() );
					$content = $post_subtitrare->post_content;
					$pattern = get_shortcode_regex();
					preg_match( "/$pattern/s", $content, $match );
					if( isset( $match[2] ) && ( "gallery" == $match[2] ) ) {
						$atts = shortcode_parse_atts( $match[3] );
						$attachments = isset( $atts['ids'] ) ? explode( ',', $atts['ids'] ) : get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_id() .'&order=ASC&orderby=menu_order ID' );
					}

					if ($attachments) {?>
					<div id="slider-category" class="slider-category">
					<div class="loading"></div>
						<ul id="slider" class="slider">
							<?php
								foreach ($attachments as $attachment) {
									$image =  wp_get_attachment_image_src( $attachment, 'blog' ); ?>	
										<li>
										<div class="slider-item">
											<img src="<?php echo $image[0] ?>"/>					
												
										</div>			
										</li>
										<?php } ?>
						</ul>
						
					</div>
			  <?php } else { 
			  $image = get_template_directory_uri() .'/images/placeholder-580.png'; ?>
			  <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php pmc_getImage('blog'); ?></a>
			  <?php }?>
			  <div class="bottomborder"></div>
				<?php get_template_part('includes/boxes/loopBlog'); ?>
				</div>
			</div>
			<?php } 
			if ( has_post_format( 'video' , get_the_id())) { ?>
			<div class="slider-category">
			
				<div class="blogpostcategory">
				<div class="loading"></div>
				<?php
				
				if(!empty($postmeta["video_post_url"][0])) {?>
				<?php  
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
				else{ 
					  $image = get_template_directory_uri() .'/images/placeholder-580.png'; ?>
					  <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php pmc_getImage('blog'); ?></a>
					
				<?php } ?>	
				<div class="bottomborder"></div>
				<?php get_template_part('includes/boxes/loopBlog'); ?>
				</div>
			</div>
			<?php } 
			if ( has_post_format( 'link' , get_the_id())) {?>
			<div class="link-category">
				<div class="blogpostcategory">
				<?php get_template_part('includes/boxes/loopBlogLink'); ?>								
				</div>
			</div>
			
			<?php 
			} 	
			?>
			<?php if ( has_post_format( 'audio' , get_the_id())) {?>
			<div class="blogpostcategory">
				<div class="audioPlayerWrap">
					<div class="loading"></div>
					<div class="audioPlayer">
						<?php
						if(isset($postmeta["audio_post_url"][0]))
							echo do_shortcode('[audio file="'. $postmeta["audio_post_url"][0] .'"]') ?>
					</div>
				</div>
				<?php get_template_part('includes/boxes/loopBlog'); ?>		
			</div>	
			<?php
			}
			?>					
			
			
			<?php
			if ( !get_post_format() ) {?>
					
			<div class="blogpostcategory">
															
					<a class="overdefultlink" href="<?php the_permalink() ?>">
					<div class="overdefult">
					</div>
					</a>
					
					<div class="blogimage">	
						<div class="loading"></div>		
						
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php pmc_getImage('blog'); ?></a>
					</div>
					<div class="bottomborder"></div>
					<?php get_template_part('includes/boxes/loopBlog'); ?>
			</div>	
			<?php } ?>		
				<?php endwhile; ?>
				
					<?php
					
						get_template_part('includes/wp-pagenavi');
						if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
					?>
					
					<?php else : ?>
					
						<div class="postcontent">
							<h1><?php echo $pmc_data['errorpagetitle'] ?></h1>
							<div class="posttext">
								<?php echo $pmc_data['errorpage'] ?>
							</div>
						</div>
						
					<?php endif; ?>
				
		</div>
		<!-- sidebar -->
		<div class="sidebar">	
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div>
	</div>
	<!-- bottom quote -->		
	<div class="infotextwrap">
		<div class="infotext">
			<div class="infotext-title">
				<h2><?php echo pmc_translation('quote_big','CHECK OUR LATEST WORDPRESS THEME THAT IMPLEMENTS PAGE BUILDER') ?></h2>
				<div class="infotext-title-small"><?php echo pmc_translation('quote_small','- learn how to build Wordpress Themes with ease with a premium Page Builder which allows you to add new Pages in seconds.') ?></div>
			</div>
		</div>
	</div>
</div>											
<?php get_footer(); ?>