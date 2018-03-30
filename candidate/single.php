<?php
/**
 * The Template for displaying all single posts.
 *
 */
get_header();


global $post_id; 
$post_id = $post->ID;
$sidebar_id = get_meta_option('custom_sidebar');
$sidebar_position = 'full';

if(get_meta_option('sidebar_position_meta_box') && get_meta_option('sidebar_position_meta_box') != '') {
$sidebar_position = get_meta_option('sidebar_position_meta_box');
}

$comm = $post->comment_status;
$category = get_the_category();
$tags_list = get_the_tag_list( '', ', ' );
$num_comments = get_comments_number();
$format = 'standard';
if(get_post_meta($post->ID,'meta_blogposttype',true) && get_post_meta($post->ID,'meta_blogposttype',true) !=''){
$format = get_post_meta($post->ID,'meta_blogposttype',true); 
}

	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	$full_class = 'fullwidth-post';
	$type = 'post-blog';
	if( $sidebar_position == 'left' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4';
	$full_class = '';
	$type = 'post-blog';
	 }
	if( $sidebar_position == 'right' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8';
	$full_class = '';
	$type = 'post-blog';
	 }
	if( $sidebar_position == 'full' ) { 
	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	$full_class = 'fullwidth-post';
	$type = 'post-blog';
	} 
?>



<section id="content">
			
	<!-- Page Heading -->
	<section class="section page-heading animate-onscroll">
		
		<h1 class="entry-title" ><?php echo esc_html(get_the_title()); ?></h1>
		
				<?php if(get_option('sense_show_breadcrumb') == 'show') { ?>
				<?php candidat_the_breadcrumbs(); ?>
				<?php } ?>
				
		
	</section>
	<!-- Page Heading -->

	<!-- Section -->
	<section class="section full-width-bg gray-bg">
		
		<div class="row">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
		global $post;
		?>
		<div class="<?php echo esc_attr($sidebar_class); ?>">
				
			<!-- Single Blog Post -->
			<div class="blog-post-single <?php echo esc_attr($full_class); ?>">
					
					<?php if( $sidebar_position == 'full' ) {  ?>
					<div class="post-side-meta animate-onscroll">
								
						<div class="date">
							<span class="day"><?php  the_time('d'); ?></span>
							<span class="month"><?php  the_time('M'); ?></span>
						</div>
						
						<div class="post-format">
							<i class="icons <?php
										
										switch($format){
											
											case 'standard':
												echo 'icon-doc-text-inv';
											break;
											
											case 'video':
												echo 'icon-video';
											break;
											
											case 'audio':
												echo 'icon-music';
											break;
											
											case 'slideshow':
												echo 'icon-picture';
											break;
											
											case 'blockquote':
												echo 'icon-quote-left';
											break;
											
											case 'link':
												echo 'icon-link';
											break;
											
											default:
												echo 'icon-doc-text-inv';
											break;
											
										}
									
									?>"></i>
						</div>
						
						<div class="post-comments">
							<a href="#comments"><i class="icons icon-chat-empty"></i> <?php echo absint($num_comments); ?></a>
						</div>
						
					</div>
					<?php }  ?>


				<?php if(has_post_thumbnail() && $format == 'standard') { 
				?>
				<?php the_post_thumbnail($type); ?>
				<?php } ?>
				
				<?php if(has_post_thumbnail() && $format == 'standard1') { 
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
				?>
				<div class="media-hover">
					<div class="media-icons">
						<a href="<?php echo esc_url($large_image_url[0]); ?>" data-group="media-jackbox" class="jackbox media-icon"><i class="icons icon-zoom-in"></i></a>
						<a href="<?php echo esc_url(get_permalink());?>" class="media-icon"><i class="icons icon-link"></i></a>
					</div>
				</div>
				<?php } ?>


				<?php if($format == 'video') {
						 if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'html5' && ! post_password_required() ) { ?>

						<video width="100%" height="600"  id="home_video" class="entry-video video-js vjs-default-skin" poster="<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "post-full" ); echo esc_url($url[0]); ?>" data-aspect-ratio='2.41' data-setup="{}" controls>
							<source src="<?php echo esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)); ?>" type="video/mp4"/>
							<source src="<?php echo esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)); ?>" type="video/webm"/>
							<source src="<?php echo esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)); ?>" type="video/ogg"/>
						</video>

						<?php } ?>


						<?php if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'vimeo' && ! post_password_required() ) { ?>
							<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>?js_api=1&amp;js_onLoad=player<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>_1798970533.player.moogaloopLoaded" width="100%" height="600"  allowFullScreen></iframe>
						<?php } ?>


						<?php if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'youtube' && ! post_password_required() ) { ?>
							<iframe width="100%" height="600" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>" allowfullscreen></iframe>
						<?php } ?>
				<?php } ?>


				<?php if($format == 'audio') { ?>
				<audio class="custom_audio">
					<source src="<?php echo esc_url(get_meta_option('custom_audio_meta_box', $post_id)); ?>" type="audio/mpeg">
					<source src="<?php echo esc_url(get_meta_option('custom_audio_meta_box', $post_id)); ?>" type="audio/ogg">
					Your browser does not support the audio element.
				</audio>
				<?php } ?>



				<?php if($format == 'slideshow') { 
				$slider_image_gallery = get_meta_option('slider_image_gallery', $post_id);
				$attachments = array_filter( explode( ',', $slider_image_gallery ) );
				?>
				<!-- Portfolio Slideshow -->
				<div class="portfolio-slideshow flexslider animate-onscroll">
					
					<ul class="slides">
					
						<?php 
						foreach ($attachments as $attachment) 
						{
						$attachment_id = get_post( $attachment );
						$caption = trim(strip_tags($attachment_id->post_excerpt));
						$alt = trim(strip_tags(get_post_meta($attachment, '_wp_attachment_image_alt', true)));
						echo '<li>';
						echo candidat_get_featured_image($attachment, $type, 'single-slideshow-image', $alt);
						echo '</li>'."\n";
						}
						?>
						
					</ul>
					
				</div>
				<!-- /Portfolio Slideshow -->
				<?php } ?>



				
				<?php if(get_option('sense_show_author_single') != '_hide') { ?>
					<div class="post-meta animate-onscroll">
						<span class="vcard author"><?php _e( 'by', 'candidate' ); ?> <?php the_author_posts_link(); ?></span>
						<span><?php _e( 'in', 'candidate' ); ?> <?php echo get_the_category_list( ', ', 'multiple', $post_id ); ?></span>
					</div>
				<?php } ?>
				
				

				<div class="post-content">
					<?php the_content(); ?>
				</div>

				
				
				<div class="animate-onscroll">
					<div class="numeric-pagination">
					<?php echo candidate_link_pages(); ?>
					</div>
				</div>
				
				
				
				<!-- Post Meta Track -->
				<div class="post-meta-track animate-onscroll">
					
					<table class="project-details">
						
						<tr>
							<td class="share-media">
								<?php if(get_option('sense_show_share_single') != '_hide') { ?>
								<ul class="social-share">	
									
									<li><?php _e( 'Share this', 'candidate' ); ?>:</li>
									
									<?php if(get_option('sense_show_share_facebook_single') != '_hide') { ?>
									<li class="facebook"><a href="#" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>
									<?php } ?>
									
									
									<?php if(get_option('sense_show_share_twitter_single') != '_hide') { ?>
									<li class="twitter"><a href="#" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_show_share_google_single') != '_hide') { ?>
									<li class="google"><a href="#" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_show_share_pinterest_single') != '_hide') { ?>
									<li class="pinterest"><a href="#" class="tooltip-ontop" title="Pinterest"><i class="icons icon-pinterest-3"></i></a></li>
									<?php } ?>
									
									
									<?php if(get_option('sense_show_share_linkedin_single') != '_hide') { ?>
									<li class="linkedin"><a href="#" class="tooltip-ontop" title="LinkedIn"><i class="icons icon-linkedin-1"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_show_share_reddit_single') != '_hide') { ?>
									<li class="reddit"><a href="#" class="tooltip-ontop" title="Reddit"><i class="icons icon-reddit-1"></i></a></li>
									<?php } ?>
									
									
									
									<?php if(get_option('sense_show_share_email_single') != '_hide') { ?>
									<li class="email"><a href="#" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>
									<?php } ?>
									
								</ul>
								<?php } ?>
							</td>
							<td class="tags"><?php _e( 'Tags', 'candidate' ); ?>: <?php echo get_the_tag_list( '', ', ' ); ?></td>
						</tr>
						
					</table>
					
				</div>
				<!-- /Post Meta Track -->




				<!-- Pagination -->
				<div class="row animate-onscroll">
					
					<div class="col-lg-6 col-md-6 col-sm-6 button-pagination align-left">
						<?php  previous_post_link( '%link', __( 'Prev post', 'candidate' ) );  ?>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 button-pagination align-right">
						<?php  next_post_link( '%link', __( 'Next post', 'candidate' ) ); ?>
					</div>
					
				</div>
				<!-- /Pagination -->




				<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
				<!-- Post Author -->
				<div class="post-author animate-onscroll">
					
					<h4><?php printf( esc_attr__( 'About %s', 'candidate' ), get_the_author() ); ?></h4>
					
					<div class="author-info">
						<div class="author-img">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
						</div>
						<div class="author-description">
							<p><?php the_author_meta( 'description' ); ?></p>
						</div>
					</div>
					
				</div>
				<!-- /Post Author -->
				<?php endif; ?>


			</div>	
			<!-- /Single Blog Post -->	



			<?php if(get_option('sense_show_single_related') != '_hide') { ?>
			<!-- Related Articles -->
			<div class="related-articles">
				
				<h3 class="animate-onscroll"><?php _e( 'Related Articles', 'candidate' ); ?></h3>
				
				<div class="row">
					<?php 
					$category = candidat_theme_get_post_category($post_id);
					$esclude_post = $post_id;
					
					if( $sidebar_position == 'full' ) { 
					candidat_theme_the_related_post(4, $category, $esclude_post, 'col-lg-3 col-md-3 col-sm-6'); 
					} else {
					candidat_theme_the_related_post(3, $category, $esclude_post, 'col-lg-4 col-md-4 col-sm-4'); 
					}
					?>
				</div>
							
			</div>
			<!-- /Related Articles -->
			<?php } ?>
			
			
			
			<?php if (  comments_open() ) { ?>
			<!-- Post Comments -->
			<div class="post-comments">
				<h3 class="animate-onscroll"><?php _e( 'Comments', 'candidate' ); ?></h3>
				<ul id="comments">
				<?php comments_template( '', true ); ?>	
				</ul>			
			</div>
			<!-- /Post Comments -->
			
			
			
			<h3 class="animate-onscroll"><?php _e( 'Leave a reply', 'candidate' ); ?></h3>
			<p class="animate-onscroll"><?php _e( 'Your email address will not be published. Fields marked * are mandatory.', 'candidate' ); ?></p>
			
			<?php
				$comment_field = '<div class="col-lg-12 col-md-12 col-sm-12"><label>'. __( 'Comment*', 'candidate' ) .'</label>
								<textarea  rows="10" name="comment" ></textarea>
								</div>';
				$fields =  array(
				'author' => '<div class="col-lg-4 col-md-4 col-sm-4"><label>'. __( 'Name*', 'candidate' ) .'</label>
							<input type="text" name="author" value="" >
							</div>',  
				'email'  => '<div class="col-lg-4 col-md-4 col-sm-4"><label>'. __( 'E-mail*', 'candidate' ) .'</label>
							<input type="email" name="email" value="" >
							</div>',  
				'url'    => '<div class="col-lg-4 col-md-4 col-sm-4"><label>'. __( 'Website', 'candidate' ) .'</label>
							<input type="text" name="url" value="" >
							</div>'  
				);   
				
			
				
				$comments_args = array(
						'fields' => (apply_filters( 'comment_form_default_fields', $fields )),
						'id_form'=>'comment-form',
						'id_submit' => 'submit_none',
						'label_submit' => '',
						'title_reply' => '',  
						'title_reply_to' => __( '<h4 style="margin-top:0; margin-bottom:10px;" >Leave a Reply to %s</h4>', 'candidate' ),   
						'cancel_reply_link' => __( '<h4 style="margin-top:0; margin-bottom:5px;" >Cancel reply</h4>', 'candidate' ),  					
						'comment_field' => $comment_field,
						'comment_notes_before' => '',
						'comment_notes_after'=>'<input type="submit" name="submit" value="'. __( 'Post Comment', 'candidate' ) .'">'
						);
						
				comment_form($comments_args);
			?>
			<?php } ?>
			
		</div>	
		
		<?php endwhile; // end of the loop. ?>
			
			
			
		<!-- Sidebar -->
		<?php 
		if( $sidebar_position != 'full' ) {
			if( $sidebar_position == 'left' ) { ?>
			<div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8 sidebar">
			<?php } if( $sidebar_position == 'right' ) { ?>
			<div class="col-lg-3 col-md-3 col-sm-4 sidebar">
			<?php } ?>
			
			<?php candidat_mm_sidebar('blog',$sidebar_id);?>
			</div>
		<?php } ?>	
			

				
		</div>
				
	</section>
	<!-- /Section -->
		
</section>		
				

<?php get_footer(); ?>
		
	