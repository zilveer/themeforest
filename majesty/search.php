<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage majesty
 * @since majesty 1.2
 */
 
get_header(); ?>
<?php
	global $majesty_options;
	$blog_type 	= $majesty_options['blog_archive_type'];
	$sidebar	= $majesty_options['archive_with_sidebar'];
	// This used in sama_get_css_for_blog()
	$majesty_options['blog_type'] = $blog_type;
	$majesty_options['blog_with_sidebar'] = $sidebar;
	$custom_css = sama_get_css_for_blog('blog');
	$blog_forced_full_width = array('blog-gird-full-width', 'blog-masonry-2-col', 'blog-masonry-3-col', 'blog-masonry-4-col');
?>  

<section class="padding-100">
	<?php if( $blog_type == 'blog-gird-full-width' || $blog_type == 'blog-masonry-full-width' ) { ?>
		<div class="container-fluid">
	<?php } else { ?>
		<div class="container">
			<div class="row">
				<?php if( $sidebar && ! in_array( $blog_type, $blog_forced_full_width ) ) { ?>
					<div class="col-md-9">
				<?php } ?>
	<?php } ?>
				<main id="main" class="site-main <?php echo esc_attr( $custom_css ); ?>">
					<?php if ( have_posts() ) : ?>
						
							<?php if( $blog_type == 'blog-list-small-thumb' || $blog_type == 'blog-list-big-thumb' || $blog_type == 'wpdefault' ) { ?>
								<div class="blog-main-content">
							<?php } elseif ( $blog_type == 'blog-masonry-4-col' || $blog_type == 'blog-masonry-3-col' || $blog_type == 'blog-masonry-2-col' || $blog_type == 'blog-masonry-full-width' ) { 
								$css = '';
								if( $blog_type == 'blog-masonry-full-width' ) {
									$css = ' masonry_full_width';
								}
							?>
								<div id="menu-items" class="masonry-content menu-type dark text-center<?php echo esc_attr($css); ?>">
							<?php } else { ?>
								<div class="blog-content dark text-center">
							<?php } ?>
							
								<?php
									$majesty_options['loop_masonry'] = 0;
									
									while ( have_posts() ) : the_post();
										
										$majesty_options['loop_masonry']++;
										
										get_template_part( 'content', get_post_format() );
										
									endwhile;	
								?>
								
								</div>
							
						<?php sama_paging_nav(); ?>
					<?php 
						else :
						get_template_part( 'content', 'none' );
						endif;
					?>
				</main>
			
	<?php if( $blog_type == 'blog-gird-full-width' ) { ?>
		</div><!-- end container-fluid -->
	<?php } else { ?>
			<?php if( $sidebar && $blog_type != 'blog-gird-full-width' ) { ?>
				</div><!-- end column -->
			<?php } ?>
				
			<?php if ( $sidebar && $blog_type != 'blog-gird-full-width' ) { ?>
				<?php get_sidebar(); ?>
			<?php } ?>
			</div><!-- end row -->
		</div><!-- end container -->
	<?php } ?>			
</section>
<?php get_footer(); ?>