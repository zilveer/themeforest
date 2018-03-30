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
$num_comments = get_comments_number();
$format = 'standard';
$job = get_meta_option('team_job_meta_box');

$social = get_meta_option('team_social_show_meta_box');
$share = get_meta_option('team_share_show_meta_box');

$team_member = array(
							'facebook' => get_meta_option('team_facebook_meta_box'),
							'twitter' => get_meta_option('team_twitter_meta_box'),
							'google' => get_meta_option('team_google_meta_box'),
							'youtube' => get_meta_option('team_youtube_meta_box'),
							'flickr' => get_meta_option('team_flickr_meta_box'),
							'instagram' => get_meta_option('team_instagram_meta_box'),
							'linkedin' => get_meta_option('team_linkedin_meta_box'),
							'email' => get_meta_option('team_mail_meta_box'),
							'twitter-follow' => '#'
						);


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
	$full_class = '';
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


			




				<div class="post-meta animate-onscroll">
					<span><?php echo $job; ?></span>
				</div>


				<div class="post-content">
					<?php the_content(); 
					
				if($social != 'hide') {		
				
				echo '<div class="social-media">
												<span class="small-caption">Get connected:</span>
												<ul class="social-icons">';
													
													
													if(isset($team_member['facebook']) && $team_member['facebook'] !='' ) {
				echo '<li class="facebook"><a href="'.$team_member['facebook'].'" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>';
											}
											
													if(isset($team_member['twitter']) && $team_member['twitter'] !='' ) {
				echo '<li class="twitter"><a href="'.$team_member['twitter'].'" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>';
											}
											
													if(isset($team_member['google']) && $team_member['google'] !='' ) {
				echo '<li class="google"><a href="'.$team_member['google'].'" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>';
											}
											
													if(isset($team_member['youtube']) && $team_member['youtube'] !='' ) {
				echo '<li class="youtube"><a href="'.$team_member['youtube'].'" class="tooltip-ontop" title="Youtube"><i class="icons icon-youtube-1"></i></a></li>';
											}
											
													if(isset($team_member['flickr']) && $team_member['flickr'] != '') {
				echo '<li class="flickr"><a href="'.$team_member['flickr'].'" class="tooltip-ontop" title="Flickr"><i class="icons icon-flickr-4"></i></a></li>';
											}		
												





				if(isset($team_member['instagram']) && $team_member['instagram'] != '') {
				echo '<li class="instagram"><a href="'.$team_member['instagram'].'" class="tooltip-ontop" title="Instagram"><i class="icons icon-instagram-1"></i></a></li>';
											}		

				if(isset($team_member['linkedin']) && $team_member['linkedin'] != '') {
				echo '<li class="linkedin"><a href="'.$team_member['linkedin'].'" class="tooltip-ontop" title="LinkedIn"><i class="icons icon-linkedin-1"></i></a></li>';
											}		







												
													if(isset($team_member['email']) && $team_member['email'] !='' ) {
				echo '<li class="email"><a href="'.$team_member['email'].'" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>';
											}			
													
				echo '</ul></div>';
				
				}
				?>	
					
				</div>

				
				
				<div class="animate-onscroll">
					<div class="numeric-pagination">
					<?php echo candidate_link_pages(); ?>
					</div>
				</div>
				
				
				<?php if($share != 'hide') {	 ?>	
				<!-- Post Meta Track -->
				<div class="post-meta-track animate-onscroll">
					
					<table class="project-details">
						
						<tr>
							<td class="share-media">
								<ul class="social-share">	
									<li><?php esc_html_e( 'Share this', 'candidate' ); ?>:</li>
									<li class="facebook"><a href="#" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>
									<li class="twitter"><a href="#" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>
									<li class="google"><a href="#" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>
									<li class="pinterest"><a href="#" class="tooltip-ontop" title="Pinterest"><i class="icons icon-pinterest-3"></i></a></li>
									<li class="email"><a href="#" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>
								</ul>
							</td>
							
						</tr>
						
					</table>
					
				</div>
				<!-- /Post Meta Track -->
				<?php }	?>	



				<!-- Pagination -->
				<div class="row animate-onscroll">
					
					<div class="col-lg-6 col-md-6 col-sm-6 button-pagination align-left">
						<?php  previous_post_link( '%link', __( 'Prev', 'candidate' ) );  ?>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 button-pagination align-right">
						<?php  next_post_link( '%link', __( 'Next', 'candidate' ) ); ?>
					</div>
					
				</div>
				<!-- /Pagination -->





			</div>	
			<!-- /Single Blog Post -->	


			
			
			
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
		
	