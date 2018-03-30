<?php
// Template Name: MediaPagination Column2
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
$type = 'post-blog';
$style_media = 'col-lg-6 col-md-6 col-sm-6 ';

	if( $sidebar_position == 'left' ) { 
	$style_media = 'col-lg-6 col-md-6 col-sm-6 ';
	$type = 'post-blog';
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4';
	 }
	if( $sidebar_position == 'right' ) { 
	$style_media = 'col-lg-6 col-md-6 col-sm-6 ';
	$type = 'post-blog';
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8';
	 }
	if( $sidebar_position == 'full' ) {
	$style_media = 'col-lg-6 col-md-6 col-sm-6 ';
	$type = 'post-blog';	
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
				
			
					
				<div class="row">
				<div id="container-items-portfolio" >
				
					<?php
					$pp = get_option('posts_per_page');
					
					if(get_option('sense_projects_num') && get_option('sense_projects_num') != '') {
					$pp = get_option('sense_projects_num');
					}
					
					$query = array(
						'posts_per_page' => $pp,
						'post_type'=>'portfolio_post',
						'portfolio-category'     => $term_name1,
						'orderby' => 'post_date',
						'order'    => 'DESC',
						'paged' => ( get_query_var('paged') ? get_query_var('paged') : true ),
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
					<div class="item <?php echo esc_attr($style_media); ?> " >

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

						
						$media = array(
							
							'thumb' => $thumb_image_url[0],
							'format' => $format,
							'type-image' => $type,
							'jackbox-link' => $jackbox_link,
							'project-link' => $project_link,
							'post-link' => $post_link,
							'name' => $title1,
							'tags' => $tags_list,
							'category' => $cat,
							'description' => $des
							
						);
						
						/* Media item */
						include('includes/media/media-item.php');
							
						?>
									
					</div>
						
				<?php endwhile; 
				?>		
				
				</div>			
				</div>			
		
		
			
				<div class="animate-onscroll">
						
					<div class="divider"></div>

					<?php if ( $wp_query->max_num_pages > 1 ) { ?>
						<div class="numeric-pagination">
						<?php candidat_pagenavi(); ?> 
						</div>
					<?php } 
					wp_reset_query();
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