<?php
// Template Name: MediaClassicSortable Column4
?>



<?php
get_header();
 
 
 
$cat_type = get_meta_option('cat_page_portfolio_meta_box');
$termchildren = get_term_children( $cat_type, 'portfolio-category' );
 
$args_cat = array(
	'orderby'       => 'id', 
	'order'         => 'ASC',
	'hide_empty'    => true, 
	'child_of'       => $cat_type
	
);  
$portfolio_category = get_terms('portfolio-category', $args_cat );
$term1 = get_term_by( 'id', $cat_type, 'portfolio-category');
$term_name1 = $term1->slug;


 
$sidebar_id = get_meta_option('custom_sidebar');
$sidebar_position = get_meta_option('sidebar_position_meta_box');
$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
$type = 'portfolio3';
$style_media = 'col-lg-3 col-md-4 col-sm-6 ';

	if( $sidebar_position == 'left' ) { 
	$style_media = 'col-lg-3 col-md-6 col-sm-12 ';
	$type = 'portfolio3';
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4';
	 }
	if( $sidebar_position == 'right' ) { 
	$style_media = 'col-lg-3 col-md-6 col-sm-12 ';
	$type = 'portfolio3';
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8';
	 }
	if( $sidebar_position == 'full' ) {
	$style_media = 'col-lg-3 col-md-4 col-sm-6 ';
	$type = 'portfolio3';	
	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
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
			
				<div class="<?php echo esc_attr($sidebar_class); ?>">

				<!-- Media Filters -->
				<div class="media-filters animate-onscroll">
					
					<div class="filter-filtering">
					
						<label><?php echo __('Show','candidate');?>:</label>
						<ul class="filter-dropdown">
							<li><span><?php echo __('All','candidate');?></span>
							<?php 
							if($portfolio_category): ?>
								<ul>
									<li class="filter" data-filter="all"><?php echo __('All','candidate');?></li>
									<?php foreach($portfolio_category as $portfolio_cat): ?>
									<li class="filter" data-filter=".<?php echo esc_attr($portfolio_cat->slug); ?>"><?php echo $portfolio_cat->name; ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							
							</li>
						</ul>
					
					</div>
					
					<label><?php esc_html_e( 'Sort by', 'candidate' ); ?>:</label>
					<div class="filter-sorting">
						
						<div class="order-group active-sort ascending-sort">
							<button class="small sort sorting-asc" data-sort="nameorder:asc"><?php esc_html_e( 'Name', 'candidate' ); ?></button>
							<button class="small sort sorting-desc" data-sort="nameorder:desc"><?php esc_html_e( 'Name', 'candidate' ); ?></button>
						</div>
						
						<div class="order-group">
							<button class="small sort sorting-asc" data-sort="dateorder:asc"><?php esc_html_e( 'Date', 'candidate' ); ?></button>
							<button class="small sort sorting-desc" data-sort="dateorder:desc"><?php esc_html_e( 'Date', 'candidate' ); ?></button>
						</div>
						
					</div>
					
				</div>
				<!-- /Media Filters -->	
			
			
			
					
				<div class="media-items row">

					<?php
					$pp = get_option('posts_per_page');
					
					
					$query = array(
						'posts_per_page' => -1,
						'post_type'=>'portfolio_post',
						'portfolio-category'     => $term_name1,
						'orderby' => 'post_date',
						'order'    => 'DESC',
						'post_status'     => 'publish'
					  );
					query_posts($query);
					
					?>
 
 
 
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
						$category = candidat_theme_get_portfolio_category($post->ID);
						$num_comments = get_comments_number();
						$format = 'image';
						if(get_meta_option('portfolio_post_type', $post->ID) && get_meta_option('portfolio_post_type', $post->ID) !=''){
						$format = get_meta_option('portfolio_post_type', $post->ID); 
						}

						$title1 = get_the_title();
						if($title1 == '') {
						$title1 = 'No Title';
						}
					
					?>

					<!-- media Post -->
					<div class="<?php echo esc_attr($style_media); ?> mix <?php echo esc_attr($category); ?>" data-nameorder="<?php echo esc_attr($title1); ?>" data-dateorder="<?php  echo esc_attr($post->post_date); ?>" >

						<?php 
						$post_id = $post->ID;
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
						$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $type); 
						$project_link = get_meta_option('portfolio_link_meta_box', $post_id); 
						$post_link = get_permalink(); 
						$des = candidat_get_the_excerpt_max_charlength(30); 
						$cur_terms = get_the_terms($post_id, 'portfolio-category' );
						
						$cat = '';
						$count_terms = count($cur_terms);
						$it=0;
						if($cur_terms) {
							foreach($cur_terms as $cur_term) {
								$it++;
								
								if($it == $count_terms) {
								$cat .= '<a href="'. esc_url(get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy )) .'">'. $cur_term->name .'</a> ';
								} else {
								$cat .= '<a href="'. esc_url(get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy )) .'">'. $cur_term->name .'</a>, ';	
								}
								
							}
						}
						$tags_list = get_the_tag_list( 'portfolio-category', ', ' );
						

						if($format == 'video') {
												
							
								if( get_meta_option('portfolio_video_type', $post->ID) == 'html5') {
								$jackbox_link = get_meta_option('portfolio_post_video', $post_id); 
								}
							
								if( get_meta_option('portfolio_video_type', $post->ID) == 'vimeo') {
								$jackbox_link = 'http://vimeo.com/'. get_meta_option('portfolio_post_video', $post_id); 
								}
							
								if( get_meta_option('portfolio_video_type', $post->ID) == 'youtube') {
								$jackbox_link = 'http://www.youtube.com/watch?v='. get_meta_option('portfolio_post_video', $post_id); 
								}
								
						} else {
						$jackbox_link = $large_image_url[0];
						}

						
						if( $thumb_image_url[0] == NULL ) {
						$thumb_image_url[0] = get_template_directory_uri().'/img/media/media1-medium.jpg';
						}
						
						$media = array(
							'thumb' => $thumb_image_url[0],
							'format' => $format,
							'type-image' => $type,
							'jackbox-link' => $jackbox_link,
							'post-link' => $post_link
						);
						
						/* Media item */
						include('includes/media/media-item-classic.php');
							
						?>
									
					</div>
						
				<?php endwhile; 
				?>		
				
				</div>			

				</div>

				
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