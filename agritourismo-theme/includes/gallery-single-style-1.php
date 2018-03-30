<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
	wp_reset_query();
	$g = get_the_ID();
	global $query_string;
	$query_vars = explode('&',$query_string);
									
	foreach($query_vars as $key) {
		if(strpos($key,'page=') !== false) {
			$i = substr($key,8,12);
			break;
		}
	}
	
	if(!isset($i)) {
		$i = 1;
	}	
	
	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $g, 'order'=> 'ASC', 'orderby'=> 'menu_order' ); 
	$attachments = get_posts($args);
	
	// similar posts
	$similarPosts = get_option(THEME_NAME."_similar_posts_gallery");
	$similarPostsSingle = get_post_meta( $post->ID, THEME_NAME."_similar_posts", true ); 				
?>
<?php get_template_part(THEME_LOOP."loop","start"); ?>

	<!-- BEGIN .content-main -->
	<div class="content-main alternate full-width">
		<?php 
			if ($attachments) {
				$file = wp_get_attachment_url($attachments[$i-1]->ID);
				$count = count($attachments);
		?>


		<?php if (have_posts()): ?>

			<div class="big-photo-block ot-slide-item" id="<?php echo $post->ID;?>">
				<span class="next-image" data-next="<?php echo $i+1;?>"></span>
				<?php 
					$image = get_post_thumb(false, 1200, 0, false, $file);
				?>
				<span class="gal-current-image">
					<div class="the-image loading waiter">
						<a href="#gal-prev" class="prev icon-text" rel="<?php if($i>1) { echo $i-1; } else { echo $i-1; } ?>">&#59233;</a>
						<a href="#gal-next" class="next icon-text" rel="<?php if($i<$count) { echo $i+1; } else { echo $i; } ?>">&#59234;</a>
						<img class="image-big-gallery ot-gallery-image" data-id="<?php echo $i;?>" style="display:none;" src="<?php echo $image['src'];?>" alt="<?php the_title();?>" />
					</div>
				</span>
				<div class="the-thumbs">
					<?php
						$c=1;

						foreach($attachments as $attachment) {
							$file = wp_get_attachment_url($attachment->ID);
							$image = get_post_thumb(false, 95, 70, false, $file);
							
					?>

						<a href="javascript:;" rel="<?php echo $c;?>" class="gal-thumbs<?php if($c==$i) { ?> active<?php } ?>" data-nr="<?php echo $c;?>">
							<img src="<?php echo $image['src'];?>" alt="<?php the_title();?>"/>
						</a>
					<?php
						$c++;
						}
					?>
				</div>
			</div>
			<div class="split-line-1"></div>

			<h2><?php the_title();?></h2>

			<?php 
				if (get_the_content() != "") { 				
					add_filter('the_content','remove_images');
					add_filter('the_content','remove_objects');
					the_content();
				} 
			?>

			<div class="split-line-1"></div>
		<?php endif;?>
		<?php } else {
			_e( 'This gallery has no pictures!' , THEME_NAME );
		} ?>

		<?php if($similarPosts == "show" || ($similarPosts=="custom" && $similarPostsSingle=="show")) { ?>

			<div class="main-title">
				<h2><?php _e("Similar Galleries", THEME_NAME);?></h2>
				<span><?php _e("More galleries like this", THEME_NAME);?></span>
			</div>

			<!-- BEGIN .photo-gallery-grid -->
			<div class="photo-gallery-grid">
				<?php
					$categories = get_terms( 'gallery-cat', 'orderby=count&hide_empty=0' );
					$counter=1;
					$my_query = new WP_Query( 
						array( 
							'post_type' => 'gallery', 
							'showposts' => 3, 
							'tax_query' => array(
								array(
									'taxonomy' => 'gallery-cat',
									'field' => 'id',
									'terms' => $categories[0]->term_id,
								)
							),
						)
					);
					
					if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); 
						$src = get_post_thumb($post->ID,208,152); 
						$gallery_style = get_post_meta ( $post->ID, THEME_NAME."_gallery_style", true );
				?>
					<div class="main-thumb-gallery">
						<div class="gallery-photos">
							<a href="#gal-prev" class="icon-text">&#59233;</a>
							<a href="#gal-next" class="icon-text">&#59234;</a>
							<ul>
								<li>
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
															<img src="<?php echo $image['src'];?>" data-id="<?php echo $c;?>" data-url="<?php the_permalink();?><?php echo $c;?>" alt="<?php the_title();?>" />
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
					<?php $counter++; ?>
					<?php endwhile;?>
					<?php else: ?>
						<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
					<?php endif; ?>
				<div class="clear-float"></div>
			<!-- END .photo-gallery-grid -->
			</div>
		<?php } ?>
	<!-- END .content-main -->
	</div>
<?php get_template_part(THEME_LOOP."loop","end"); ?>
<?php get_footer(); ?>