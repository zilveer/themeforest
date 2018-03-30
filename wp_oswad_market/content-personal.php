<?php
/**
 * The template for displaying Content.
 *
 * @package WordPress
 * @subpackage Oswad
 * @since WD_Responsive
 */
?>
<?php
	global $smof_data;
?>
<ul class="list-posts">
	<?php	
	$count=0;
	if(have_posts()) : while(have_posts()) : the_post(); global $post;$count++;global $wp_query;$_sub_class="";
			if($count == 1) 
				$_sub_class =  " first";
			if($count == $wp_query->post_count) 
				$_sub_class = " last" 
		?>
		<li <?php post_class("home-features-item".$_sub_class);?>>
			
			<div class="post-info-meta">
				
				<!-- time -->
				<?php if( $smof_data['wd_blog_time'] == 1 ) : ?>
					<span class="date-time"><?php echo get_the_date('M d, Y') ?></span>
				<?php endif;?>
				<!-- end time -->
				
				<?php if( $smof_data['wd_blog_comment_number'] == 1 ) : ?>
					<span class="comments-count"> <?php //if( $archive_page_config['show_comment_count_phone'] != 1 ) echo " hidden-phone";?>
						<span class="number"><?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo $comments_count->approved; ?></span><?php _e(' comment(s)','wpdance'); ?>
					</span>
				<?php endif;?>	
				
				<?php if( $smof_data['wd_blog_author'] == 1 ) : ?>
					<span class="author">	<?php // if( $archive_page_config['show_author_post_link_phone'] != 1 ) echo " hidden-phone";?>
						<?php _e("","wpdance"); ?>
						<?php the_author_posts_link(); ?> 
					</span>
				<?php endif;?>
				
				<?php if ( is_object_in_taxonomy( get_post_type(), 'category' ) && $smof_data['wd_blog_categories'] == 1 ) : // Hide category text when not supported ?>
				
				<!-- categories -->
				<?php
					if( $smof_data['wd_blog_categories'] == 1 );
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'wpdance' ) );
						if ( $categories_list ):
					?>
					<span class="cat-links"><?php _e("Categories:","wpdance"); ?>
						<?php printf( __( '<span class="%1$s"></span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );?>
					</span>
					<?php endif; // End if categories ?>
				<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'category' ) ?>
				<!-- end categories -->
				
			</div>		

			<div class="post-title">
			
					<h2 class="heading-title"><a class="post-title heading-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a></h2>
					<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>
					<div class="clear"></div>
						
			</div>
			
			<div class="post-content">
				<?php if( $smof_data['wd_blog_thumbnail'] == 1 ) : ?>
					<div class="thumbnail ">
						<?php 
							$video_url = esc_url(get_post_meta( $post->ID, '_video_url', true));
							if( $video_url!= ''){
								$video_width = get_post_meta($post->ID, '_video_width', true);
								$video_height = get_post_meta($post->ID, '_video_height', true);
								if( !$video_width ){
									$video_width = 700;
								}
								if( !$video_height ){
									$video_height = 400;
								}
								echo wd_get_embbed_video( $video_url, $video_width, $video_height );
							}
							else{
								$gallery_ids = get_post_meta($post->ID, THEME_SLUG.'post_gallery', true);
								if( $gallery_ids != '' ){
									$gallery_ids = explode(',', $gallery_ids);
								}
								if( is_array($gallery_ids) ){
									if( has_post_thumbnail() ){
										array_unshift($gallery_ids, get_post_thumbnail_id());
									}
									?>
									<div class="images blog-image-slider loading">
										<?php foreach( $gallery_ids as $id ): ?>
											<div class="image">
												<a class="thumb-image" href="<?php the_permalink() ; ?>">
													<?php echo wp_get_attachment_image( $id, 'blog_thumb' ); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<?php
								}
								else{
									?>
									<div class="image">
										<a class="thumb-image" href="<?php the_permalink() ; ?>">
										<?php 
											if ( has_post_thumbnail() ) {
												the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-blog'));
											} else { ?>
												<img alt="<?php the_title(); ?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri(); ?>/images/no-image-blog.gif"/>
										<?php	}										
										?>	
										<div class="thumbnail-effect"></div>									
										</a>
										
									</div>
									<?php
								}
							}
						?>	
					</div>
					
				<?php endif;?>
				<div class="post-content-info">
					<?php if( $smof_data['wd_blog_excerpt'] == 1 ) : ?>
						<div class="short-content"><?php echo do_shortcode(get_the_excerpt()); ?></div>
					<?php endif; ?>	
					<!-- read more -->
						<?php if( $smof_data['wd_blog_readmore'] == 1 ) : ?>
							<a title="Readmore" class="read-more"  href="<?php the_permalink() ; ?>"><?php _e('Continue Reading','wpdance'); ?></a>	
						<?php endif;?>	
					<!-- end read more -->
					
					<!-- SHARING -->
					<?php if($smof_data['wd_blog_sharing']==1) : ?>
					<div class="sharing_blog">
						<!-- WIDGET SOCIAL -->
						<?php wd_blog_personal_template_social_sharing(); ?>
					</div>
					<?php endif; ?>
					<!-- END SHARING -->
					
				</div>
				
			</div><!-- end post info -->	
			
			
		</li>
	<?php						
	endwhile;
	else : echo "<div class=\"alert alert-error alpha omega\">Sorry. There are no posts to display</div>";
	endif;	
	?>	
</ul>