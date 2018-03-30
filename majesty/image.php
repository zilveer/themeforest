<?php
/**
 * The template for displaying image attachments.
 *
 * @package WordPress
 * @subpackage majesty
 * @since majesty 1.0
 */
 
get_header(); ?>
<?php
	global $majesty_options;
	$blog_type 	= $majesty_options['blog_archive_type'];
	$sidebar	= $majesty_options['archive_with_sidebar'];
	$custom_css = sama_get_css_for_blog('blog');
	$blog_forced_full_width = array('blog-gird-full-width', 'blog-masonry-2-col', 'blog-masonry-3-col', 'blog-masonry-4-col');
?>  
<section class="padding-100">	
	<div class="container">
		<div class="row">
				<main id="main" class="site-main">
					<div class="blog-main-content">
					<?php if ( have_posts() ) : ?>
							<?php while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="blog_row">
									<figure class="blog-img">
										<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
									</figure>
									
									<header class="entery-header">
										<h1><?php the_title(); ?></h1>
									</header>
									
									<div class="post-meta">
										<ul>
											<li><i class="fa fa-calendar"></i> <?php sama_output_html5_time_format(); ?></li>
											<li><i class="fa fa-user"></i> <?php esc_html_e('By', 'theme-majesty'); ?>&#160;<?php the_author_posts_link(); ?></li>
											<li><i class="fa fa-comments"></i> <?php comments_popup_link('0', '1', '%'); ?></li>
										</ul>
									</div><!-- End links -->
									
									<div class="entery-content">
										<?php if ( has_excerpt() ) : ?>
											<div class="entry-caption">
												<?php the_excerpt(); ?>
											</div>
										<?php endif; ?>
										<?php 
											the_content();
											
											wp_link_pages( array(
												'before'      => '<div class="page-links"><strong class="page-links-title">' . esc_html__( 'Pages:', 'theme-majesty' ) . '</strong>',
												'after'       => '</div>',
												'link_before' => '<span>',
												'link_after'  => '</span>',
											));
										?>
										<footer class="entry-footer">
											<?php edit_post_link( esc_html__( 'Edit', 'theme-majesty' ), '<span class="edit-link">', '</span>' ); ?>
										</footer>
									</div>
								</div>
							</article>
							<?php if ( $majesty_options['single_display_share_icon'] ) { ?>
								<div class="post-tags-social">
									<?php get_template_part('tpl/post-share-icon'); ?>
								</div>
							<?php } ?>
							<div class="clearfix"></div>		
							<?php sama_post_nav(); ?>
							<?php 
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							?>
						<?php endwhile; ?>
					<?php endif; ?>	
					</div>
				</main>
		</div>
	</div>
</section>
	
<?php get_footer(); ?>