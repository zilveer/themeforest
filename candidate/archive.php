<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header(); 



$sidebar_position = get_option('sense_settings_sidebar_category');
$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
$type = 'post-full';
	if( $sidebar_position == 'left' ) { 
	$type = 'post-blog';
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4';
	 }
	if( $sidebar_position == 'right' ) { 
	$type = 'post-blog';
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8';
	 }
	if( $sidebar_position == 'full' ) { 
	$type = 'post-full';
	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	 } 
	 





?>


<section id="content">	
			
			<!-- Page Heading -->
			<section class="section page-heading ">
				<h1 class="entry-title" >
				 <?php if (is_category() || is_archive()) { ?>
			<?php _e( 'Archive ', 'candidate' ); ?><?php single_cat_title(); ?> 
			<?php  } elseif( is_tag() ) { ?>
			<?php _e( 'Posts Tagged &#8216;', 'candidate' ); ?><?php single_tag_title(); ?>&#8217;
			<?php  } elseif (is_day()) { ?>
			<?php _e( 'Archive for', 'candidate' ); ?> <?php the_time('F jS, Y'); ?>
			<?php  } elseif (is_month()) { ?>
			<?php _e( 'Archive for', 'candidate' ); ?> <?php the_time('F, Y'); ?>
			<?php  } elseif (is_year()) { ?>
			<?php _e( 'Archive for', 'candidate' ); ?><?php the_time('Y'); ?>
			<?php  } elseif (is_author()) { ?>
			<?php _e( 'Author Archive', 'candidate' ); ?>
			<?php  } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<?php _e( 'Blog Archives', 'candidate' ); ?>
			<?php } ?>
				</h1>
				
				<?php if(get_option('sense_show_breadcrumb') == 'show') { ?>
				<?php candidat_the_breadcrumbs(); ?>
				<?php } ?>
				
			</section>
			<!-- Page Heading -->
			

			
			
			
		<!-- Section -->
		<section class="section full-width-bg gray-bg">
			
			<div class="row">
			
				<div class="main-content-page <?php echo esc_attr($sidebar_class); ?>">


				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
						$category = get_the_category();
						$num_comments = get_comments_number();
						$format = 'standard';
						if(get_post_meta($post->ID,'meta_blogposttype',true) && get_post_meta($post->ID,'meta_blogposttype',true) !=''){
						$format = get_post_meta($post->ID,'meta_blogposttype',true); 
						}

						$title1 = get_the_title();
						if($title1 == '') {
						$title1 = 'No Title';
						}
				
				?>
					
					
					
					<!-- Blog Post -->
					<div <?php post_class('blog-post animate-onscroll '); ?> >

						
						<?php 
						$type = 'post-full';
						$post_id = $post->ID;
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
						
						if(has_post_thumbnail() || 
									$format == 'video' || 
									$format == 'audio' || 
									$format == 'slideshow' ){?>
									<div class="post-image">
										
										<?php if(has_post_thumbnail() && $format == 'standard') { ?>
										<?php the_post_thumbnail($type); ?>
										<?php } ?>
										
										<?php if(has_post_thumbnail() && $format == 'standard') { ?>
										<div class="media-hover">
											<div class="media-icons">
												<a href="<?php echo esc_url($large_image_url[0]); ?>" data-group="media-jackbox" class="jackbox media-icon"><i class="icons icon-zoom-in"></i></a>
												<a href="<?php echo esc_url(get_permalink()); ?>" class="media-icon"><i class="icons icon-link"></i></a>
											</div>
										</div>
										<?php } ?>
										
										<?php if($format == 'video') {
												 if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'html5' && ! post_password_required() ) { ?>

												<video width="100%" height="450"  id="home_video" class="entry-video video-js vjs-default-skin" poster="<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "post-full" ); echo esc_url($url[0]); ?>" data-aspect-ratio='2.41' data-setup="{}" controls>
													<source src="<?php echo esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)); ?>" type="video/mp4"/>
													<source src="<?php echo esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)); ?>" type="video/webm"/>
													<source src="<?php echo esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)); ?>" type="video/ogg"/>
												</video>

												<?php } ?>


												<?php if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'vimeo' && ! post_password_required() ) { ?>
													<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>?js_api=1&amp;js_onLoad=player<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>_1798970533.player.moogaloopLoaded" width="100%" height="450"  allowFullScreen></iframe>
												<?php } ?>


												<?php if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'youtube' && ! post_password_required() ) { ?>
													<iframe width="100%" height="450" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>" allowfullscreen></iframe>
												<?php } ?>
										<?php } ?>
										
										<?php if($format == 'audio') { ?>
										<audio>
											<source src="<?php echo esc_url(get_meta_option('custom_audio_meta_box', $post_id)); ?>" type="audio/mpeg">
											<source src="<?php echo esc_url(get_meta_option('custom_audio_meta_box', $post_id)); ?>" type="audio/ogg">
										</audio>
										<?php } ?>
										
										
										<?php if($format == 'slideshow') { 
										$type = 'post-blog';
										
										$slider_image_gallery = get_meta_option('slider_image_gallery', $post_id);
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
												echo candidat_get_featured_image($attachment, $type, 'post-image', $alt);
												echo '</li>'."\n";
												}
												?>
												
											</ul>
											
										</div>
										<!-- /Portfolio Slideshow -->
										<?php } ?>
									
									</div>
									<?php } ?>
									
									
			
						<div class="post-content">
							
							<div class="post-side-meta">
							
								<div class="date">
									<span class="day"><?php  the_time('d'); ?></span>
									<span class="month"><?php  the_time('M'); ?></span>
								</div>
								
								<a href="<?php echo esc_url(get_permalink()); ?>"><div class="post-format">
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
								</div></a>
								
								<div class="post-comments">
									<a href="<?php echo esc_url(get_permalink()).'#comments';?>"><i class="icons icon-chat-empty"></i> <?php echo absint($num_comments); ?></a>
								</div>
								
							</div>
							
							<div class="post-header">
								<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($title1);?></a></h2>
								<div class="post-meta">
									<span class="vcard author"><?php echo __('by', 'candidate'); ?> <?php the_author_posts_link(); ?></span>
									<span><?php echo __('in', 'candidate'); ?> <?php echo get_the_category_list( ', ', 'multiple', $post->ID ); ?></span>
								</div>
							</div>
							
							<div class="post-exceprt">
								
								<?php if($format != 'blockquote' && $format != 'link') {?>
								<p><?php candidat_the_excerpt_max_charlength(40); ?></p>
								<?php } ?>
								
								<?php if($format == 'blockquote'){ ?>
								<blockquote class="iconic-quote"><?php candidat_the_excerpt_max_charlength(40); ?></blockquote>
								<?php } ?>
								
								<?php if($format == 'link'){ ?>
								<blockquote class="iconic-quote link-quote"><a href="<?php echo esc_url(get_meta_option('custom_link_meta_box', $post_id)); ?>"><?php candidat_the_excerpt_max_charlength(40); ?></a></blockquote>
								<?php } ?>
								
								<a href="<?php echo esc_url(get_permalink()); ?>" class="button read-more-button big button-arrow"><?php $read_more = get_option('sense_more_text');  echo $read_more; ?></a>
								
							</div>
							
						</div>
						
					</div>
					<!-- /Blog Post -->
					
					
					
				<?php
						//rewind_posts();
				?>
						
				<?php endwhile; ?>	
		
				</div>
				
				
				
				<!-- Sidebar -->
			    <?php 
				if( $sidebar_position != 'full' ) {
					if( $sidebar_position == 'left' ) { ?>
					<div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8 sidebar animate-onscroll">
					<?php } if( $sidebar_position == 'right' ) { ?>
					<div class="col-lg-3 col-md-3 col-sm-4 sidebar animate-onscroll">
					<?php } ?>
					
					<?php 
					  dynamic_sidebar( 'blog_default' ); 
					?>

					</div>
				<?php } ?>
				
				
				
				
				
				
			</div>

			<div class="animate-onscroll">
					
						<div class="divider"></div>

						<?php if ( $wp_query->max_num_pages > 1 ) { ?>
							<div class="numeric-pagination">
							<?php candidat_pagenavi(); ?> 
							</div>
						<?php } ?>

					
			</div>

		</section>
		<!-- /Section -->
		
</section>


<?php get_footer(); ?>