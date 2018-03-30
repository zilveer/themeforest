<?php
/* Template Name: Photo Gallery */
?>
<?php get_header(); ?>
<?php get_template_part(THEME_INCLUDES.'top'); ?>

<?php
	wp_reset_query();
	$paged = get_query_string_paged();
	$posts_per_page = get_option(THEME_NAME.'_gallery_items');

	if($posts_per_page == "") {
		$posts_per_page = get_option('posts_per_page');
	}
	
	$my_query = new WP_Query(array('post_type' => 'gallery', 'posts_per_page' => $posts_per_page, 'paged'=>$paged));  
	$categories = get_terms( 'gallery-cat', 'orderby=name&hide_empty=0' );

	//page title
	$titleShow = get_post_meta ( $post->ID, THEME_NAME."_title_show", true );
	$subTitle = get_post_meta ( OT_page_id(), THEME_NAME."_subtitle", true ); 
?>
<?php get_template_part(THEME_LOOP."loop","start"); ?>
	<!-- BEGIN .content-main -->
	<div class="content-main alternate full-width">
		<?php get_template_part(THEME_SINGLE."page","title"); ?>

		<div class="filter-thing" id="gallery-categories">
			<a href="#filter" class="active" data-option="*"><?php _e('All', THEME_NAME); ?></a>
			<?php foreach ($categories as $category) { ?>
				<a href="#filter" data-option=".<?php echo $category->slug;?>"><?php echo $category->name;?></a>
			<?php } ?>
		</div>

		<!-- BEGIN .photo-gallery-grid -->
		<div class="photo-gallery-grid" id="gallery-full" style="display:none;">
			<?php 
															
				$args = array(
					'post_type'     	=> 'gallery',
					'post_status'  	 	=> 'publish',
					'showposts' 		=> -1
				);

				$myposts = get_posts( $args );	
				$count_total = count($myposts);

				$counter=1;	
			?>

			<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<?php 
					$src = get_post_thumb($post->ID,208,152); 
				?>
				<?php $term_list = wp_get_post_terms($post->ID, 'gallery-cat'); ?>
				<?php $gallery_style = get_post_meta ( $post->ID, THEME_NAME."_gallery_style", true ); ?>

				<div class="main-thumb-gallery gallery-image<?php foreach ($term_list as $term) { echo " ".$term->slug; } ?>" data-id="gallery-<?php the_ID(); ?>">
					<div class="gallery-photos">
						<a href="#gal-prev" class="icon-text">&#59233;</a>
						<a href="#gal-next" class="icon-text">&#59234;</a>
						<ul>
							<li class="active">
								<a href="<?php the_permalink();?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>photo-border-3" data-id="gallery-<?php the_ID(); ?>">
									<img src="<?php echo $src["src"]; ?>" alt="<?php the_title();?>" />
								</a>
							</li>
							<?php
								$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_parent' => $my_query->post->ID, 'post_status' => null, 'order'=> 'ASC', 'orderby'=> 'menu_order'  ); 
								$attachments = get_posts($args);
								$c=1;
								if ($attachments) {
									foreach($attachments as $attachment) {
									$file = wp_get_attachment_url($attachment->ID);
									$image = get_post_thumb(false, 208, 152, false, $file);
										if($src["src"]!=$image['src']){
											?>
												<li>
													<a href="<?php the_permalink();?>?page=<?php echo $c;?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>photo-border-3" data-id="gallery-<?php the_ID(); ?>">
														<img src="<?php echo $image['src'];?>" data-id="<?php echo $c;?>" class="setborder" data-url="<?php the_permalink();?><?php echo $c;?>" alt="<?php the_title();?>" />
													</a>
												</li>
											<?php 
											
										}	
										$c++;
									} 
								} 
							?>
						</ul>
					</div>
					<h3><a href="<?php the_permalink();?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>"><?php the_title();?></a></h3>
					<?php 
						add_filter('excerpt_length', 'new_excerpt_length_20');
						the_excerpt();
						remove_filter('excerpt_length', 'new_excerpt_length_20');
					?>
					<a href="<?php the_permalink();?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>button-link"><?php _e("View Gallery", THEME_NAME);?><span class="icon-text">&#9656;</span></a>
				</div>
				
			<?php 
				if ( $paged != 0 ) {
					$a = ($paged-1)*$posts_per_page;
				} else {		
					$a = 1;
				}
			?>
						
			<?php $counter++; ?>
			<?php endwhile; ?>
			<?php else : ?>
				<h2 class="title"><?php _e( 'No galleries were found' , THEME_NAME );?></h2>
			<?php endif; ?>
			<div class="clear-float"></div>
		<!-- END .photo-gallery-grid -->
		</div>
			<?php gallery_nav_btns($paged, $my_query->max_num_pages); ?>
	<!-- END .content-main -->
	</div>
<?php get_template_part(THEME_LOOP."loop","end"); ?>
<?php get_footer(); ?>