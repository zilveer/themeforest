<?php
/**
 * The single post template
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/ 

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

get_header(); ?>

<!-- BEGIN .section-wrapper -->
<div class="section-wrapper">
	
	<?php while ( have_posts() ) : the_post(); ?>
	
		<!-- Section Header -->
		<?php get_template_part( 'templates/post-header' ); ?>
		
		<?php if (
			isset( $experience_theme_array['post-content-color-scheme'] )
			&& $experience_theme_array['post-content-color-scheme'] != ""
		) {		
			$color_scheme = 'color-scheme-'. $experience_theme_array['post-content-color-scheme'];
		} else {
			$color_scheme = '';
		} ?>

		<!-- BEGIN .section-content-wrapper -->
		<div class="section-content-wrapper <?php echo esc_attr( $color_scheme ); ?>">
			
			<?php // Set page content padding and width if not using VC
			$the_content = get_the_content();	
			
			if ( 
				!function_exists( 'vc_asset_url' )
				|| strpos( $the_content, '[vc_row' ) === false
			) {
				$content_before = '<div class="row-container padding-h padding-v narrow-width"><div class="col-padding-adjustment">';
				$content_after = '</div></div>';
			} else {
				$content_before = '';
				$content_after = '';				
			} ?>
			
			<!-- BEGIN .section-content -->
			<div class="section-content">
				
				<?php echo $content_before; ?>
				
				<?php if ( get_post_meta( $post->ID, 'experience_header_bg_type', true ) == 'none' ) { ?>
					
					<h1 class="heading-title"><?php the_title(); ?></h1>
					
					<?php if (
						(
							!isset( $experience_theme_array['post-meta-date'] )
							|| $experience_theme_array['post-meta-date'] == "1"
						)
						|| (
							!isset( $experience_theme_array['post-meta-author'] )
							|| $experience_theme_array['post-meta-author'] == "1"
						)
						|| (
							!isset( $experience_theme_array['post-meta-category'] )
							|| $experience_theme_array['post-meta-category'] == "1"
						)
					) { ?>
						
						<!-- BEGIN .post-meta -->
						<div class="post-meta">
					
							<?php if (
								!isset( $experience_theme_array['post-meta-author'] )
								|| $experience_theme_array['post-meta-author'] == "1"
							) { ?>
								<span class="post-author">
									<?php printf( esc_html__( 'By %1$s', 'experience' ), get_the_author_meta( 'display_name' ) ); ?>
								</span>
							<?php } ?>
							
							<?php if (
								!isset( $experience_theme_array['post-meta-date'] )
								|| $experience_theme_array['post-meta-date'] == "1"					
							) { ?>
								<span class="post-date">
									
									<time class="published" datetime="<?php the_time( 'c' ); ?>">
									
										<?php if (
											!isset( $experience_theme_array['post-meta-author'] )
											|| $experience_theme_array['post-meta-author'] == "1"					
										) {
											printf( esc_html__( 'on %1$s', 'experience' ), get_the_time( get_option( 'date_format' ) ) );
										} else { 
											echo ucfirst( sprintf( esc_html__( 'on %1$s', 'experience' ), get_the_time( get_option( 'date_format' ) ) ) );
										} ?>
									
									</time>
									
									<time class="updated" datetime="<?php the_modified_date( 'c' ); ?>"><?php the_modified_date( get_option( 'date_format' ) ); ?></time>
									
								</span>
							<?php } ?>							
							
							<?php if (
								!isset( $experience_theme_array['post-meta-category'] )
								|| $experience_theme_array['post-meta-category'] == "1"					
							) { ?>
								<span class="post-category">
									
									<?php if (
										(
											!isset( $experience_theme_array['post-meta-author'] )
											|| $experience_theme_array['post-meta-author'] == "1"
										)
										|| (
											!isset( $experience_theme_array['post-meta-date'] )
											|| $experience_theme_array['post-meta-date'] == "1"
										)
									) {
										printf( esc_html__( 'in %1$s' ,'experience' ), get_the_category_list( ", " ) );
									} else {
										echo ucfirst( sprintf( esc_html__( 'in %1$s' ,'experience' ), get_the_category_list( ", " ) ) );																
									} ?>
									
								</span>
							<?php } ?>					

						</div>
						<!-- END .post-meta -->
						
					<?php } ?>						
				
				<?php } ?>
			
				<!-- BEGIN .post-content -->
				<div class="post-content">					
					
					<?php the_content(); ?>
					
					<?php wp_link_pages( array(
						'before'		=> '<div class="wp-link-pages">',
						'after'			=> '</div>',
						'separator'     => '<span class="pagination-separator"></span>',
						'link_before'   => '<span class="pagination-button">',
						'link_after'    => '</span>',
					) ); ?>				
					
				</div>
				<!-- END .post-content -->			
				
				<?php echo $content_after; ?>
				
			</div>
			<!-- END .section-content -->		
			
			<?php if (
				has_tag()
				&& (
					!isset( $experience_theme_array['post-meta-tags'] )
					|| $experience_theme_array['post-meta-tags'] == "1"
				)
			) { ?>
		
				<div class="padding-v no-padding-top padding-h narrow-width">
					
					<!-- post tags -->					
					<div class="tagcloud">
						<h3 class="post-tags-title"><?php esc_html_e( "Tags", 'experience' ); ?></h3>
						<?php the_tags( "", " " ); ?>
					</div>								
				
				</div>								
			
			<?php } ?>	
			
		</div>
		<!-- END .section-content-wrapper -->		
		
		<!-- comments -->
		<?php comments_template(); ?>		
		
		<?php if (
			isset( $experience_theme_array['post-navigation-color-scheme'] )
			&& $experience_theme_array['post-navigation-color-scheme'] != ""
		) {		
			$post_nav_color_scheme = 'color-scheme-'. esc_attr( $experience_theme_array['post-navigation-color-scheme'] );
		} else {
			$post_nav_color_scheme = 'color-scheme-2';
		} ?>
		
		<div class="section-content-wrapper single-post-navigation <?php echo esc_attr( $post_nav_color_scheme ); ?>">
			
			<div class="nav-next"><?php next_post_link( '%link', '<span class="funky-icon-arrow-left"></span>' ); ?></div>
			
			<?php if( get_option( 'show_on_front' ) == 'page' ) {	
				$blog_permalink = get_permalink( get_option( 'page_for_posts' ) );		 
			} else {		 
				$blog_permalink = get_home_url();
			} ?>
			
			<div class="blog-link"><a href="<?php echo esc_url( $blog_permalink ); ?>"><span class="funky-icon-menu"></span></a></div>
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="funky-icon-arrow-right"></span>' ); ?></div>
			
		</div>

	<?php endwhile; ?>
	
</div>
<!-- END .section-wrapper -->

<?php get_footer(); ?>