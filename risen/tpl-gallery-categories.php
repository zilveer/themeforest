<?php
/* Template Name: Gallery - Categories */

// Header
get_template_part( 'header', 'page' ); // this makes $content_title available

?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'gallery' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<section>
		
			<?php if ( $content_title ) : // this comes from header-page.php; empty if no title should show at top of content ?>	
			<header>
				<h1 class="page-title"><?php echo $content_title; ?></h1>
			</header>
			<?php endif; ?>
	
			<?php if ( trim( strip_tags( $post->post_content ) ) ) : // has content ?>
				<div class="post-content"> <!-- confines heading font to this content -->
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
			
			<?php
			$order_option = risen_option( 'gallery_categories_order' );
			$order_map = array(
				'alphabetical'	=> array( 'name', 'ASC' ),
				'new_to_old'	=> array( 'id', 'DESC' ),
				'old_to_new'	=> array( 'id', 'ASC' ),
				'count'			=> array( 'count', 'DESC' )
			);
			$categories = get_terms( 'risen_gallery_category', array(
				'orderby' 		=> isset( $order_map[$order_option][0] ) ? $order_map[$order_option][0] : 'name',
				'order' 		=> isset( $order_map[$order_option][1] ) ? $order_map[$order_option][1] : 'ASC',
				'hierarchical'	=> false
			) );
			if ( $categories) :
			?>
			
			<div id="gallery-categories">
			
				<?php foreach ( $categories as $category ) : ?>
					
					<?php
					
					// determine image and video counts for this category
					$video_query = new WP_Query( array(
						'post_type'			=> 'risen_gallery',
						'risen_gallery_category' => $category->slug,
						'nopaging'			=> true,
						'posts_per_page'	=> -1,
						'meta_query' 		=> array(
							array(
								'key'				=> '_risen_gallery_type',
								'value'				=> 'video',
								'compare'			=> '='
							)
						)
					) );
					$video_count = $video_query->post_count;
					$image_count = $category->count - $video_count;
					
					// get some items from this category
					$gallery_posts = get_posts( array(
						'numberposts'		=> 6,
						'risen_gallery_category' => $category->slug,
						'post_type' 		=> 'risen_gallery',
						'orderby' 			=> 'post_date',
						'order' 			=> 'DESC', // show X newest
						'suppress_filters'	=> false // help multilingual
					) );
					
					?>
					
					<article>
						
						<header>

							<h1 class="gallery-categories-title"><a href="<?php echo get_term_link( $category, 'risen_gallery_category' ); ?>"><?php echo $category->name; ?></a></h1>
					
							<?php if ( ! empty( $image_count ) || ! empty( $video_count ) ) : ?>
							<div class="gallery-categories-count">
								<?php
								$count_parts = array();
								if ( ! empty( $image_count ) ) { // Image count
									$count_parts[] = sprintf( _n( '<b>1</b> photo', '<b>%d</b> photos', $image_count, 'risen' ), $image_count );
								}
								if ( ! empty( $video_count ) ) { // Video count
									$count_parts[] = sprintf( _n( '<b>1</b> video', '<b>%d</b> videos', $video_count, 'risen' ), $video_count );
								}
								echo implode( _x( ', ', 'count separator', 'risen' ) , $count_parts ); // Output image and video count separated by comma
								?>		
							</div>
							<?php endif; ?>
							
							<a href="<?php echo get_term_link( $category, 'risen_gallery_category' ); ?>" class="button button-small"><?php printf( _x( 'Browse %s', 'gallery', 'risen' ), $category->name ); ?></a>
							
						</header>
						
						<?php if ( $category->description ) : ?>
						<?php echo wpautop( $category->description ); ?>
						<?php endif; ?>
						
						<?php if ( ! empty( $gallery_posts ) ) : ?>
						<ul class="gallery-categories-items">

							<?php foreach( $gallery_posts as $gallery_post ) : ?>
							
								<?php if ( has_post_thumbnail( $gallery_post->ID ) ) : ?>							
								<li>
									<div class="image-frame">
										<a href="<?php echo get_permalink( $gallery_post->ID ); ?>">
											<?php echo get_the_post_thumbnail( $gallery_post->ID, 'risen-square-thumb', array( 'title' => $gallery_post->post_title ) ); ?> 
										</a>
									</div>
								</li>
								<?php endif; ?>
							
							<?php endforeach; ?>
						
						</ul>
						<?php endif; ?>
						
					</article>

				<?php endforeach; ?>
				
			</div>
			
			<?php endif; ?>
			
		</section>
		
	</div>

</div>

<?php risen_show_sidebar( 'gallery' ); ?>
			
<?php endwhile; ?>

<?php get_footer(); ?>