<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header(); 

$args_topics = array(
	'orderby'       => 'id', 
	'order'         => 'ASC',
	'hide_empty'    => true
);  
$topics_category = get_terms('ctc_sermon_topic', $args_topics );

$args_series = array(
	'orderby'       => 'id', 
	'order'         => 'ASC',
	'hide_empty'    => true
);  
$series_category = get_terms('ctc_sermon_series', $args_series );


$args_book = array(
	'orderby'       => 'id', 
	'order'         => 'ASC',
	'hide_empty'    => true
);  
$book_category = get_terms('ctc_sermon_book', $args_book );


$args_speaker = array(
	'orderby'       => 'id', 
	'order'         => 'ASC',
	'hide_empty'    => true
);  
$speaker_category = get_terms('ctc_sermon_speaker', $args_speaker );












$sidebar_position = get_option('sense_settings_sidebar_category');
$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
$type = 'post-full';
$style_media = 'col-lg-4 col-md-4 col-sm-6 ';

	if( $sidebar_position == 'left' ) { 
	$style_media = 'col-lg-4 col-md-6 col-sm-12 ';
	$type = 'post-blog';
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4';
	 }
	if( $sidebar_position == 'right' ) { 
	$style_media = 'col-lg-4 col-md-6 col-sm-12 ';
	$type = 'post-blog';
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8';
	 }
	if( $sidebar_position == 'full' ) {
	$style_media = 'col-lg-4 col-md-4 col-sm-6 ';	
	$type = 'post-full';
	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	 } 

	 
	 if(get_option('sense_sermon_title')  && get_option('sense_sermon_title') != '') {
		$sermon_title =  get_option('sense_sermon_title');
	 } else {
		$sermon_title =  __( 'Sermon Archive', 'candidate' );
	 } 
	 
	 
?>


<section id="content">	
			
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll ">
				<h1><?php echo $sermon_title; ?> <?php single_cat_title(); ?></h1>
				
				<?php if(get_option('sense_show_breadcrumb') == 'show') { ?>
				<?php candidat_the_breadcrumbs(); ?>
				<?php } ?>
				
			</section>
			<!-- Page Heading -->
			

			
			
			
		<!-- Section -->
		<section class="section full-width-bg gray-bg">
			
			<div class="row no-margin-bottom">
			
				<div class="main-content-page <?php echo esc_attr($sidebar_class); ?>">

				
				<!-- Media Filters -->
				<div class="media-filters animate-onscroll">
					
					<div class="filter-filtering">
					
						<label><?php echo __('Sermons','candidate');?>:</label>
						<ul class="filter-dropdown">
							<li><span><?php echo __('Topics','candidate');?></span>
							<?php 
							if($topics_category): ?>
								<ul>
									<?php foreach($topics_category as $topics_cat): 
									$term_link = get_term_link($topics_cat->term_id, 'ctc_sermon_topic');
									?>
									<li class="filter"><a href="<?php echo esc_url($term_link); ?>" class="sermon-link"> <?php echo $topics_cat->name; ?> </a>  </li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							
							</li>
						</ul>
					
					</div>
					
					
					<div class="filter-filtering">
						<ul class="filter-dropdown">
							<li><span><?php echo __('Series','candidate');?></span>
							<?php 
							if($series_category): ?>
								<ul>
									<?php foreach($series_category as $series_cat): 
									$term_link = get_term_link($series_cat->term_id, 'ctc_sermon_series');
									?>
									<li class="filter"><a href="<?php echo esc_url($term_link); ?>" class="sermon-link"> <?php echo $series_cat->name; ?> </a>  </li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							
							</li>
						</ul>
					
					</div>
					
					
					<div class="filter-filtering">
						<ul class="filter-dropdown">
							<li><span><?php echo __('Books','candidate');?></span>
							<?php 
							if($book_category): ?>
								<ul>
									<?php foreach($book_category as $book_cat): 
									$term_link = get_term_link($book_cat->term_id, 'ctc_sermon_book');
									?>
									<li class="filter"><a href="<?php echo esc_url($term_link); ?>" class="sermon-link"> <?php echo $book_cat->name; ?> </a>  </li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							
							</li>
						</ul>
					
					</div>
					
					<div class="filter-filtering">
						<ul class="filter-dropdown">
							<li><span><?php echo __('Speakers','candidate');?></span>
							<?php 
							if($speaker_category): ?>
								<ul>
									<?php foreach($speaker_category as $speaker_cat): 
									$term_link = get_term_link($speaker_cat->term_id, 'ctc_sermon_speaker');
									?>
									<li class="filter"><a href="<?php echo esc_url($term_link); ?>" class="sermon-link"> <?php echo $speaker_cat->name; ?> </a>  </li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							
							</li>
						</ul>
					
					</div>
					
					<div class="filter-filtering">
						<ul class="filter-dropdown">
							<li><span><?php echo __('Months','candidate');?></span>
							<?php 
							//if($month_category): ?>
								<ul>
									<?php wp_get_archives( 'type=monthly&format=html&show_post_count=1&post_type=ctc_sermon' ); ?>
								</ul>
							<?php //endif; ?>
							
							</li>
						</ul>
					
					</div>
					
					
					
					
					
				</div>
				<!-- /Media Filters -->	
				
				
				
				
				
				
			<div class="sermon-items row">	
				

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
				$num_comments = get_comments_number();
				$format = 'standard';
				$type = 'post-blog';
				$post_id = $post->ID;
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
				$sermonvideo = get_post_meta( $post_id, '_ctc_sermon_video', true );
				$audio_value = get_post_meta( $post_id, '_ctc_sermon_audio', true );
				$pdf_value = get_post_meta( $post_id, '_ctc_sermon_pdf', true );
				$title1 = get_the_title();
				if($title1 == '') {
				$title1 = 'No Title';
				}
			
			?>
					
					
					
					<!-- Blog Post -->
					<div class="<?php echo esc_attr($style_media); ?> sermon-item "  >

						
						<?php 
						
						
						if( has_post_thumbnail() ){?>
									<div class="post-image">
										
										<?php if(has_post_thumbnail()) { ?>
										<?php the_post_thumbnail($type); ?>
										<?php } ?>
										
									</div>
									<?php } ?>
									
									
			
						<div class="sermon-item-content latest_sermons_box">
		
							<h3 class="no-margin-top"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($title1);?></a></h3>
							<div class="post-meta m_bottom_25">
							
								<span><?php echo get_the_time('F j, Y g:i a', $post_id); echo ' ·';?></span>
								<span><?php echo get_the_term_list( $post_id, 'ctc_sermon_speaker', __('speaker ', 'candidate'), ',','' ); echo ' ·';?></span>
								<span><?php echo get_the_term_list( $post_id, 'ctc_sermon_topic', __('topic ', 'candidate'), ',','' ); echo ' ·';?></span>
								<span><?php echo get_the_term_list( $post_id, 'ctc_sermon_series', __('series ', 'candidate'), ',','' ); echo ' ·';?></span>
								<span><?php echo get_the_term_list( $post_id, 'ctc_sermon_book', __('book ', 'candidate'), ',','' ); ?></span>
							</div>
							
							
							<div class="post-action">
								<?php 
									if($sermonvideo != '') {
									echo '<div class="action-icon">
										<a href="'. $sermonvideo .'" target="_blank" > <span><i class="icon-videocam"></i></span> </a>
									</div>';
									}
									if($audio_value != '') {
									echo '<div class="action-icon">
										<a href="'. $audio_value .'"  target="_blank"  > <span><i class="icon-headphones"></i></span> </a>
									</div>';
									}
									if($pdf_value != '') {
									echo '<div class="action-icon">
										<a href="'. $pdf_value .'" target="_blank" > <span><i class="icon-download"></i></span> </a>
									</div>';
									}
									
									echo '<div class="action-icon">
										<a href="'. get_permalink($post_id) .'"> <span><i class="icon-book"></i></span> </a>
									</div>';
								 ?>
							</div>
							
						</div>
						
					</div>
					<!-- /Blog Post -->
					
					
					
				
						
				<?php endwhile; ?>	
		
		
				</div>	
		
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