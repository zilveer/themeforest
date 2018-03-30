<?php // Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options(); ?>

<?php if ( have_posts() ) : 

	// Get grid width setting
	if ( 
		isset( $experience_theme_array['blog-grid-width'] )
		&& $experience_theme_array['blog-grid-width'] == 'narrow-width'
	){
		$grid_width = 'narrow-width';
	} elseif (
		isset( $experience_theme_array['blog-grid-width'] )
		&& $experience_theme_array['blog-grid-width'] == 'site-width'
	){
		$grid_width = 'site-width';
	} else {
		$grid_width = '';
	} ?>
	
	<!-- BEGIN .post-grid -->
	<div class="post-grid post-container clearfix <?php echo esc_attr( $grid_width ); ?>">
		
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php // Get grid width alt colour
			if (
				isset( $experience_theme_array['blog-alt-color'] )
			){
				$alt_color = 'color-alt-'. $experience_theme_array['blog-alt-color'];
			} else {
				$alt_color = 'color-alt-dark';
			} ?>			
			
			<!-- BEGIN .post-grid-item -->
			<article class="post-grid-item post-item <?php echo esc_attr( $alt_color ); ?>">
				
				<!-- BEGIN .post-grid-item-image -->
				<div class="post-grid-item-image">
					
					<?php $background_image = false;
			
					if( has_post_thumbnail() ) {					
						$background_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'experience-post-grid' );						
					} else if (
						isset( $experience_theme_array['blog-default-post-image']['id'] ) 
						&& $experience_theme_array['blog-default-post-image']['id'] != ''
					) {
						$background_image = wp_get_attachment_image_src( esc_html( $experience_theme_array['blog-default-post-image']['id'] ), 'post-grid' );
					}
					
					if ( $background_image != false ) {
						experience_get_background( $background_image[0] );
					} ?>
				
				<!-- END .post-grid-item-image -->
				</div>
				
				<!-- BEGIN .post-grid-item-content -->
				<div class="post-grid-item-content">
				
					<!-- BEGIN .holder -->
					<div class="holder">
						
						<!-- BEGIN .cont -->
						<div class="cont">
							
							<h2><?php the_title(); ?></h2>
							
							<?php if (
								(
									!isset( $experience_theme_array['post-archive-meta-date'] )
									|| $experience_theme_array['post-archive-meta-date'] == "1"
								)
								|| (
									!isset( $experience_theme_array['post-archive-meta-author'] )
									|| $experience_theme_array['post-archive-meta-author'] == "1"
								)
								|| (
									!isset( $experience_theme_array['post-archive-meta-category'] )
									|| $experience_theme_array['post-archive-meta-category'] == "1"
								)
							) { ?>
							
								<!-- BEGIN .post-meta -->
								<div class="post-meta">
								
									<?php if (
										!isset( $experience_theme_array['post-archive-meta-author'] )
										|| $experience_theme_array['post-archive-meta-author'] == "1"						
									) { ?>
										<span class="post-author">
											<?php printf( esc_html__( 'By %1$s', 'experience' ), get_the_author_meta( 'display_name' ) ); ?>
										</span>
									<?php } ?>
									
									<?php if (
										!isset( $experience_theme_array['post-archive-meta-date'] )
										|| $experience_theme_array['post-archive-meta-date'] == "1"
									) { ?>
										<span class="post-date">
											
											<time class="published" datetime="<?php the_time( 'c' ); ?>">
											
												<?php if (
													!isset( $experience_theme_array['post-archive-meta-author'] )
													|| $experience_theme_array['post-archive-meta-author'] == "1"
												) { 
													printf( esc_html__( 'on %1$s', 'experience' ), get_the_time( get_option( 'date_format' ) ) );
												} else {
													echo ucfirst( sprintf( esc_html__( 'on %1$s', 'experience' ), get_the_time( get_option( 'date_format' ) ) ) );
												} ?>
											
											</time>
											
											<time class="updated" datetime="<?php the_modified_date( 'c' ); ?>"><?php the_modified_date( get_option( 'date_format' ) ); ?></time>
											
										</span>
									<?php } ?>							
									
									<?php $category = get_the_category();
									if (
										$category
										&& (
											!isset( $experience_theme_array['post-archive-meta-category'] )
											|| $experience_theme_array['post-archive-meta-category'] == "1"
										)
									) { ?>
										<span class="post-category">
											
											<?php $category_link = '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
										
											if (
												(
													!isset( $experience_theme_array['post-archive-meta-author'] )
													|| $experience_theme_array['post-archive-meta-author'] == "1"
												)
												|| (
													!isset( $experience_theme_array['post-archive-meta-date'] )
													|| $experience_theme_array['post-archive-meta-date'] == "1"
												)
											) {
												printf( esc_html__( 'in %1$s' ,'experience' ), $category_link );
											} else {
												echo ucfirst( sprintf( esc_html__( 'in %1$s' ,'experience' ), $category_link ) );																
											} ?>
										
										</span>
										
									<?php } ?>					

								</div>
								<!-- END .post-meta -->
								
							<?php } ?>					
							
						</div>
						<!-- END .cont -->
					
					</div>
					<!-- END .holder -->
				</div>
				<!-- END .post-grid-item-content -->
				
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				
			</article>
			<!-- END .post-grid-item -->
			
		<?php endwhile; ?>
		
	</div>
	<!-- END .post-grid -->
	
<?php else: ?>
	
	<!-- BEGIN .section-content -->
	<div class="section-content padding-v padding-h site-width">

		<!-- BEGIN .post-content -->
		<div class="post-content clearfix">
		
			<p><?php esc_html_e( 'No posts to show.', 'experience' ); ?></p>
		
		</div>
		<!-- END .section-content -->
		
	</div>
	<!-- END .section-content -->

<?php endif; ?>