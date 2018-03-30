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

$project_link = get_post_meta( $post_id, '_ctc_sermon_video', true );
$audio_value = get_post_meta( $post_id, '_ctc_sermon_audio', true );
$pdf_value = get_post_meta( $post_id, '_ctc_sermon_pdf', true );



$comm = $post->comment_status;
$num_comments = get_comments_number();



$cur_terms = get_the_terms($post_id, 'ctc_sermon_topic' );
$cat = '';
$cat_count1 = 0;
if($cur_terms) {
foreach($cur_terms as $cur_term) {
	$cat_count1++;
	$cat .= '<a href="'. esc_url(get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy )) .'">'. esc_attr($cur_term->name) .'</a>';
	if( count($cur_terms) != $cat_count1 ) {
	$cat .= ', ';
	}
}
}


$cur_terms_tags = get_the_terms($post_id, 'ctc_sermon_tag' );
$cat_tags = '';
$cat_count2 = 0;
if($cur_terms_tags) {
foreach($cur_terms_tags as $cur_term) {
	$cat_count2++;
	$cat_tags .= '<a href="'. esc_url(get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy )) .'">'. esc_attr($cur_term->name) .'</a>';
	if( count($cur_terms_tags) != $cat_count2 ) {
	$cat_tags .= ', ';
	}
}
}

$cur_terms_book = get_the_terms($post_id, 'ctc_sermon_book' );
$cat_book = '';
$cat_count3 = 0;
if($cur_terms_book) {
foreach($cur_terms_book as $cur_term) {
	$cat_count3++;
	$cat_book .= '<a href="'. esc_url(get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy )) .'">'. esc_attr($cur_term->name) .'</a>';
	if( count($cur_terms_book) != $cat_count3 ) {
	$cat_book .= ', ';
	}
}
}


$cur_terms_series = get_the_terms($post_id, 'ctc_sermon_series' );
$cat_series = '';
$cat_count4 = 0;
if($cur_terms_series) {
foreach($cur_terms_series as $cur_term) {
	$cat_count4++;
	$cat_series .= '<a href="'. esc_url(get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy )) .'">'. esc_attr($cur_term->name) .'</a>';
	if( count($cur_terms_series) != $cat_count4 ) {
	$cat_series .= ', ';
	}
}
}


$cur_terms_speaker = get_the_terms($post_id, 'ctc_sermon_speaker' );
$cat_speaker = '';
$cat_count5 = 0;
if($cur_terms_speaker) {
foreach($cur_terms_speaker as $cur_term) {
	$cat_count5++;
	$cat_speaker .= '<a href="'. esc_url(get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy )) .'">'. esc_attr($cur_term->name) .'</a>';
	if( count($cur_terms_speaker) != $cat_count5 ) {
	$cat_speaker .= ', ';
	}
}
}

    $format = 'image';

    $sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	$full_class = 'fullwidth-post';
	$type = 'post-full';
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
	$type = 'post-full';
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

	
	
	<?php if ( $extended == 'true' && $sidebar_position == 'full') {
	$type_extended = 'extended-portfolio';
		?>
	
	<!-- Section -->
	<section class="section portfolio-slideshow-section full-width animate-onscroll">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
		global $post;
		?>

				<?php if(has_post_thumbnail() && $format == 'image') { ?>
				<?php the_post_thumbnail('extended-portfolio'); ?>
				<?php } ?>



				<?php if($format == 'video') {
						 if( get_meta_option('portfolio_video_type', $post->ID) == 'html5' && ! post_password_required() ) { ?>

						<video width="100%" height="600"  id="home_video" class="entry-video video-js vjs-default-skin" poster="<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "post-full" ); echo esc_url($url[0]); ?>" data-aspect-ratio='2.41' data-setup="{}" controls>
							<source src="<?php echo esc_url(get_meta_option('portfolio_post_video', $post->ID)); ?>" type="video/mp4"/>
							<source src="<?php echo esc_url(get_meta_option('portfolio_post_video', $post->ID)); ?>" type="video/webm"/>
							<source src="<?php echo esc_url(get_meta_option('portfolio_post_video', $post->ID)); ?>" type="video/ogg"/>
						</video>

						<?php } ?>


						<?php if( get_meta_option('portfolio_video_type', $post->ID) == 'vimeo' && ! post_password_required() ) { ?>
							<iframe src="http://player.vimeo.com/video/<?php echo get_meta_option('portfolio_post_video', $post->ID); ?>?js_api=1&amp;js_onLoad=player<?php echo get_meta_option('portfolio_post_video', $post->ID); ?>_1798970533.player.moogaloopLoaded" width="100%" height="600"  allowFullScreen></iframe>
						<?php } ?>


						<?php if( get_meta_option('portfolio_video_type', $post->ID) == 'youtube' && ! post_password_required() ) { ?>
							<iframe width="100%" height="600" src="http://www.youtube.com/embed/<?php echo get_meta_option('portfolio_post_video', $post->ID); ?>" allowfullscreen></iframe>
						<?php } ?>
				<?php } ?>


			
				<?php if($format == 'gallery') { 
					$slider_image_gallery = get_meta_option('portfolio_post_gallery', $post->ID);
					$attachments = array_filter( explode( ',', $slider_image_gallery ) );
					?>
					<!-- Portfolio Slideshow -->
					<div class="portfolio-slideshow flexslider ">
						
						<ul class="slides">
						
							<?php 
							foreach ($attachments as $attachment) 
							{
							$attachment_id = get_post( $attachment );
							$caption = trim(strip_tags($attachment_id->post_excerpt));
							$alt = trim(strip_tags(get_post_meta($attachment, '_wp_attachment_image_alt', true)));
							echo '<li>';
							echo candidat_get_featured_image($attachment, $type_extended, 'portfolio-image', $alt);
							echo '</li>'."\n";
							}
							?>
							
						</ul>
						
					</div>
				<!-- /Portfolio Slideshow -->
				<?php } ?>

	</section>
	<!-- /Portfolio -->	
				
				
				
	<section class="section full-width-bg gray-bg">
		<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
						
						<!-- Portfolio Single -->
			<div class="portfolio-single">
							
					<div class="row">			
								<div class="col-lg-4 col-md-4 col-sm-6 animate-onscroll">
									
									<h6><?php esc_html_e( 'Sermon Details', 'candidate' ); ?></h6>
									
									<table class="project-details">
										
										<tr>
											<td><?php esc_html_e( 'Date', 'candidate' ); ?>:</td>
											<td><?php  the_time('M d Y'); ?></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Topics', 'candidate' ); ?>:</td>
											<td><?php echo  $cat;  ?></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Pastor', 'candidate' ); ?>:</td>
											<td><?php the_author_posts_link(); ?></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Books', 'candidate' ); ?>:</td>
											<td><?php echo  $cat_book;  ?></td>
										</tr>
										<tr>
											<td><?php esc_html_e( 'Series', 'candidate' ); ?>:</td>
											<td><?php echo  $cat_series;  ?></td>
										</tr>
										<tr>
											<td><?php esc_html_e( 'Speakers', 'candidate' ); ?>:</td>
											<td><?php echo  $cat_speaker;  ?></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Comments', 'candidate' ); ?>:</td>
											<td><a href="#comment-form"><?php echo $num_comments; ?></a></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Tags', 'candidate' ); ?>:</td>
											<td><?php echo  $cat_tags;  ?></td>
										</tr>
										
										<?php if($project_link != '') { ?>
										<tr>
											<td><?php esc_html_e( 'Video', 'candidate' ); ?>:</td>
											<td><a href="<?php echo  $project_link ; ?> " class="jackbox button transparent button-arrow" data-group="video" data-autoplay="true" ><?php esc_html_e( 'View Sermon', 'candidate' ); ?></a></td>
										</tr>
										<?php } ?>
										
										<?php if($audio_value != '') { ?>
										<tr>
											<td><?php esc_html_e( 'Audio', 'candidate' ); ?>:</td>
											<td><a href="<?php echo  $audio_value ; ?> " class="jackbox button transparent button-arrow" data-group="audio" data-autoplay="true"  ><?php esc_html_e( 'Listen Sermon', 'candidate' ); ?></a></td>
										</tr>
										<?php } ?>
										
										<?php if($pdf_value != '') { ?>
										<tr>
											<td><?php esc_html_e( 'Download', 'candidate' ); ?>:</td>
											<td><a href="<?php echo  $pdf_value ; ?> " class="button transparent button-arrow" target="_blank"><?php esc_html_e( 'PDF', 'candidate' ); ?></a></td>
										</tr>
										<?php } ?>
										
										<tr>
											<td><?php esc_html_e( 'Share this', 'candidate' ); ?>:</td>
											<td>
												<ul class="social-share">
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
								
								<div class="col-lg-8 col-md-8 col-sm-6 animate-onscroll">
									
									<h6><?php esc_html_e( 'Description', 'candidate' ); ?></h6>
									
									<?php the_content(); ?>
								</div>
							
					</div>
				
				
			</div>
			<!-- /Portfolio Single -->
				
				
				
				
				
				
				
			<div class="row portfolio-pagination">
							
				<div class="col-lg-4 col-md-4 col-sm-4 button-pagination align-left animate-onscroll">
				<?php  previous_post_link( '%link', __('Prev project', 'candidate' ) );  ?>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4 align-center animate-onscroll">
					
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4 button-pagination align-right animate-onscroll">
					<?php  next_post_link( '%link', __('Next project', 'candidate' ) ); ?>
				</div>
				
			</div>	

				
			<h3 class="animate-onscroll row-separator-caption"><?php esc_html_e( 'Related Projects', 'candidate' ); ?></h3>
			<div class="related-media-items row">
			<!-- Related Articles -->
					<?php 
					$category = candidat_theme_get_portfolio_category2($post_id);
					$esclude_post = $post_id;
					if( $sidebar_position == 'full' ) { 
					candidat_theme_the_related_portfolio(4, $category, $esclude_post, 'col-lg-3 col-md-3 col-sm-6'); 
					} else {
					candidat_theme_the_related_portfolio(3, $category, $esclude_post, 'col-lg-4 col-md-4 col-sm-4'); 
					}
					?>
			<!-- /Related Articles -->
			</div>
			
			
			<?php if (  comments_open() ) { ?>
			<!-- Post Comments -->
			<div class="post-comments">
				<h3 class="animate-onscroll"><?php _e( 'Comments', 'candidate' ); ?></h3>
				<ul>
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
		
		</div>
				
	</section>
	<!-- /Section -->
		
		
	<?php } else {
		?>	
		
		
		
	<!-- Section -->
	<section class="section full-width-bg gray-bg">
		
		<div class="row">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
		global $post;
		?>
		<div class="<?php echo esc_attr($sidebar_class); ?>">
				
			<!-- Portfolio Single -->
			<div class="portfolio-single">
	
				<?php 
				if(has_post_thumbnail() && $format == 'image') { ?>
				<?php the_post_thumbnail($type); ?>
				<?php } ?>



				<?php if($format == 'video') {
						 if( get_meta_option('portfolio_video_type', $post->ID) == 'html5' && ! post_password_required() ) { ?>

						<video width="100%" height="600"  id="home_video" class="entry-video video-js vjs-default-skin" poster="<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "post-full" ); echo esc_url($url[0]); ?>" data-aspect-ratio='2.41' data-setup="{}" controls>
							<source src="<?php echo esc_url(get_meta_option('portfolio_post_video', $post->ID)); ?>" type="video/mp4"/>
							<source src="<?php echo esc_url(get_meta_option('portfolio_post_video', $post->ID)); ?>" type="video/webm"/>
							<source src="<?php echo esc_url(get_meta_option('portfolio_post_video', $post->ID)); ?>" type="video/ogg"/>
						</video>

						<?php } ?>


						<?php if( get_meta_option('portfolio_video_type', $post->ID) == 'vimeo' && ! post_password_required() ) { ?>
							<iframe src="http://player.vimeo.com/video/<?php echo get_meta_option('portfolio_post_video', $post->ID); ?>?js_api=1&amp;js_onLoad=player<?php echo get_meta_option('portfolio_post_video', $post->ID); ?>_1798970533.player.moogaloopLoaded" width="100%" height="600"  allowFullScreen></iframe>
						<?php } ?>


						<?php if( get_meta_option('portfolio_video_type', $post->ID) == 'youtube' && ! post_password_required() ) { ?>
							<iframe width="100%" height="600" src="http://www.youtube.com/embed/<?php echo get_meta_option('portfolio_post_video', $post->ID); ?>" allowfullscreen></iframe>
						<?php } ?>
				<?php } ?>


			
				<?php if($format == 'gallery') { 
					$slider_image_gallery = get_meta_option('portfolio_post_gallery', $post->ID);
					$attachments = array_filter( explode( ',', $slider_image_gallery ) );
					?>
					<!-- Portfolio Slideshow -->
					<div class="portfolio-slideshow flexslider">
						
						<ul class="slides">
						
							<?php 
							foreach ($attachments as $attachment) 
							{
							$attachment_id = get_post( $attachment );
							$caption = trim(strip_tags($attachment_id->post_excerpt));
							$alt = trim(strip_tags(get_post_meta($attachment, '_wp_attachment_image_alt', true)));
							echo '<li>';
							echo candidat_get_featured_image($attachment, $type, 'portfolio-image', $alt);
							echo '</li>'."\n";
							}
							?>
							
						</ul>
						
					</div>
				<!-- /Portfolio Slideshow -->
				<?php } ?>


					<div class="row">
								
								<div class="col-lg-5 col-md-5 col-sm-12 animate-onscroll">
									
									<h6><?php esc_html_e( 'Sermon Details', 'candidate' ); ?></h6>
									
									<table class="project-details">
										
										<tr>
											<td><?php esc_html_e( 'Date', 'candidate' ); ?>:</td>
											<td><?php  the_time('M d Y'); ?></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Topics', 'candidate' ); ?>:</td>
											<td><?php echo  $cat;  ?></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Pastor', 'candidate' ); ?>:</td>
											<td><?php the_author_posts_link(); ?></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Books', 'candidate' ); ?>:</td>
											<td><?php echo  $cat_book;  ?></td>
										</tr>
										<tr>
											<td><?php esc_html_e( 'Series', 'candidate' ); ?>:</td>
											<td><?php echo  $cat_series;  ?></td>
										</tr>
										<tr>
											<td><?php esc_html_e( 'Speakers', 'candidate' ); ?>:</td>
											<td><?php echo  $cat_speaker;  ?></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Comments', 'candidate' ); ?>:</td>
											<td><a href="#comment-form"><?php echo $num_comments; ?></a></td>
										</tr>
										
										<tr>
											<td><?php esc_html_e( 'Tags', 'candidate' ); ?>:</td>
											<td><?php echo  $cat_tags;  ?></td>
										</tr>
										
										<?php if($project_link != '') { ?>
										<tr>
											<td><?php esc_html_e( 'Video', 'candidate' ); ?>:</td>
											<td><a href="<?php echo  $project_link; ?> " class="jackbox button transparent button-arrow" data-group="video" data-autoplay="true" ><?php esc_html_e( 'View Sermon', 'candidate' ); ?></a></td>
										</tr>
										<?php } ?>
										
										<?php if($audio_value != '') { ?>
										<tr>
											<td><?php esc_html_e( 'Audio', 'candidate' ); ?>:</td>
											<td><a href="<?php echo  $audio_value; ?> " class="jackbox button transparent button-arrow" data-group="audio" data-autoplay="true" ><?php esc_html_e( 'Listen Sermon', 'candidate' ); ?></a></td>
										</tr>
										<?php } ?>
										
										<?php if($pdf_value != '') { ?>
										<tr>
											<td><?php esc_html_e( 'Download', 'candidate' ); ?>:</td>
											<td><a href="<?php echo  $pdf_value; ?> " class="button transparent button-arrow" target="_blank"><?php esc_html_e( 'PDF', 'candidate' ); ?></a></td>
										</tr>
										<?php } ?>
										
										<tr>
											<td><?php esc_html_e( 'Share this', 'candidate' ); ?>:</td>
											<td>
												<ul class="social-share">
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
								
								<div class="col-lg-7 col-md-7 col-sm-12 animate-onscroll">
									
									<h6><?php esc_html_e( 'Description', 'candidate' ); ?></h6>
									
									<?php the_content(); ?>
								</div>
							
					</div>
				
				
			</div>
			<!-- /Portfolio Single -->
				
				
				
				
				
				
				
			<div class="row portfolio-pagination">
							
				<div class="col-lg-4 col-md-4 col-sm-4 button-pagination align-left animate-onscroll">
				<?php  previous_post_link( '%link', __('Prev sermon', 'candidate' ) );  ?>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4 align-center animate-onscroll">
					
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4 button-pagination align-right animate-onscroll">
					<?php  next_post_link( '%link', __('Next sermon', 'candidate' ) ); ?>
				</div>
				
			</div>	

				
			
			
			
			<?php if (  comments_open() ) { ?>
			<!-- Post Comments -->
			<div class="post-comments">
				<h3 class="animate-onscroll"><?php _e( 'Comments', 'candidate' ); ?></h3>
				<ul>
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
						'comment_notes_after'=>'<input type="submit" name="submit" value="Post Comment">'
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
		
		
		
	<?php }
		?>	
		
		
		
		
</section>		

<?php 
get_footer(); ?>