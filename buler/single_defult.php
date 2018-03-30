<?php global $pmc_data, $sitepress; ?>

<!-- top bar with breadcrumb and post navigation -->
<div class = "outerpagewrap">
	<div class="pagewrap">
		<div class="pagecontent">
			<div class="pagecontentContent">
				<p><?php echo pmc_breadcrumb(); ?></p>
			</div>
			<div class = "portnavigation">
					<span><?php previous_post_link('%link', '<div class="portprev"><i class="fa fa-angle-right"></i><div class="link-title-previous">%title</div></div>' ,false,''); ?> </span>				
					<span><?php next_post_link('%link','<div class="portnext"><i class="fa fa-angle-left"></i><div class="link-title-next">%title</div></div>',false,''); ?> </span>
			</div>
		</div>

	</div>
</div>
<!-- main content start -->
<div class="mainwrap single-default">
	<?php if (have_posts()) : while (have_posts()) : the_post();  $postmeta = get_post_custom(get_the_id());  ?>
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
						    <?php add_filter('the_content', 'pmc_addlightbox'); ?>
							<div><?php the_content(); ?></div>		
						<?php } ?>
						<div class="singleBorder"></div>
					</div>
				</div>
				
				<?php if(has_tag()) { ?>
					<div class="tags"><i class="fa fa-tags"></i><?php the_tags('',', ',''); ?></div>	
				<?php } ?>
				<div class="share-post">
					<div class="share-post-title">
						<h3><?php echo pmc_translation('translation_share_post','Share this post') ?></h3>
					</div>
					<div class="share-post-icon">
						<div class="socialsingle"><?php pmc_socialLinkSingle() ?></div>	
					</div>
				</div>
				
			</div>						
			
		</div>		
		<?php
		$posttags = wp_get_post_tags(get_the_id(), array( 'fields' => 'ids' ));
		$query_custom = new WP_Query(
			array( "tag__in" => $posttags,
				   "orderby" => 'rand',
				   "showposts" => 4,
				   "post__not_in" => array(get_the_id())
			) );
		if ($query_custom->have_posts()) : ?>
			<div class="titleborderOut">
				<div class="titleborder"></div>
			</div>
			<div class="relatedtitle">
				<h3><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['translation_relatedpost']); } else {  _e('Related post','buler'); } ?></h3>
			</div>
			<div class="related">	
			
			<?php
			$count = 0;
			while ($query_custom->have_posts()) : $query_custom->the_post(); 

					
				if($count != 3){ ?>
					<div class="one_fourth">
				<?php } else { ?>
					<div class="one_fourth last">
				<?php } ?>
						<div class="image"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php pmc_getImage('related'); ?></a></div>
						<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h4>			
					</div>
						
				<?php 
				$count++;
			endwhile; ?>
			</div>
		<?php endif;
		wp_reset_postdata(); 
		
		?>	
	
	
	<?php comments_template(); ?>
					
	<?php endwhile; else: ?>
					
		<?php get_template_part('404'); ?>

	<?php endif; ?>
	</div>

	<!-- main sidebar -->
	<?php get_sidebar(); ?>
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