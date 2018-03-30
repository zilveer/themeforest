<?php
/*
Template Name: Portfolio 3 Columns
*/
?>
<?php get_header(); ?>

	<?php		
		$count = 0;
		$id_suffix = 1;
		$items_per_row = 3;
		$quality = 90;			   	   		
		$my_query = new WP_Query( array( 'posts_per_page' => '-1', 'post_type' => 'portfolio' ) );
		$grid_class = 'grid_4';
		$image_width = 306;
		$image_height = 210;
	?>
	
	<!-- START #filter -->
	<ul id="filter" class="grid_12 alpha omega">
		
		<li><strong><?php _e( 'Filter: ', 'onioneye' ); ?></strong></li>
		<li class="active"><a href="#" class="all" title="<?php _e( 'View all items', 'onioneye' ); ?>"><?php _e( 'All', 'onioneye' ); ?></a></li>
		<?php $terms = get_terms( 'portfolio_categories' ); ?>
		<?php $count_terms = count( $terms ); ?>
			
		<?php if ( $count_terms > 0 ) { ?>
				
			<?php foreach ( $terms as $term ) { ?>
					
				<li><a class="<?php echo $term->slug; ?>" href="#" title="<?php printf ( __( 'View all items filed under %s', 'onioneye' ), $term->name ); ?>"><?php echo $term->name; ?></a></li>
				
			<?php } ?>
				
		<?php } ?>
		
	</ul>
	<!-- END #filter -->
		
	<!-- START .portfolio-gallery -->			
	<ul id="filterable-gallery" class="portfolio-gallery three-items-per-row grid_12 alpha omega">
		
	<?php while ( $my_query -> have_posts()) : $my_query -> the_post(); //query the "portfolio" custom post type for portfolio items ?>
			
		<?php $preview_img_url = eq_get_the_preview_img_url(); ?>
		<?php $count++; ?>
				
		<!-- START .portfolio-item -->
		<li data-id="id-<?php echo $id_suffix; ?>" <?php $terms = get_the_terms( $post -> ID, 'portfolio_categories' ); if ( !empty( $terms ) ) { echo 'data-group="'; foreach( $terms as $term ) { echo $term -> slug . ' '; } echo '"'; } ?> class="portfolio-item <?php echo $grid_class; ?> <?php if( $count === 1 ) { echo 'alpha'; } elseif( $count === $items_per_row ) { echo 'omega'; } ?>">
				
			<?php if ( $preview_img_url ) { ?>
					
				<?php $img_meta = wp_get_attachment_image_src( eq_get_attachment_id_from_src( $preview_img_url ), 'full'); ?>
				    
			    <a class="project-link" href="<?php the_permalink(); ?>" title="<?php _e( 'Have a closer look at this portfolio item', 'onioneye' ); ?>">
					<img width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $img_meta[0]; ?>&amp;h=<?php echo $image_height; ?>&amp;w=<?php echo $image_width; ?>&amp;q=<?php echo $quality; ?>" alt="<?php _e( 'Portfolio Item', 'onioneye' ); ?>" /> 
			    	<span>view project</span>
			    </a>
				
			<?php } ?>
				
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</li>  
		<!-- END .portfolio-item -->
						    
		<?php if( $count === $items_per_row ) { // if the current row is filled out with columns, reset the count variable ?>
			<?php $count = 0; ?>  
		<?php } ?>
		<?php $id_suffix++; ?>
			
	<?php endwhile; ?>
			
	</ul>
	<!-- END .portfolio-gallery -->

<?php get_footer(); ?>