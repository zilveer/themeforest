<?php
/**
 * The Template for displaying all single posts.
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>


		<div id="page-title">
			<div class="width-container paged-title">
				<?php $page_for_posts = get_option('page_for_posts'); ?>
				<h1 class="page-title"><?php echo get_the_title($page_for_posts); ?></h1>
			</div>
		<div id="page-title-divider"></div>
		</div><!-- #page-title -->
		<div class="clearfix"></div>
		<?php if(has_post_thumbnail($page_for_posts)): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_for_posts), 'progression-page-title'); ?>
			<script type='text/javascript'>
			
			jQuery(document).ready(function($) {  
			    $("#page-title").backstretch([
					"<?php echo $image[0]; ?>"
					<?php if( class_exists( 'kdMultipleFeaturedImages' ) ) {
						if( kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) != "" ) {
						    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) , '"';
						}

						if( kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) != "" ) {
						    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) , '"';
						}
					}
			 		?>
				],{
			            fade: 750,
			            duration: <?php echo of_get_option('slider_autoplay', 8000); ?>
			     });
			});
			
			</script>
		<?php endif; ?>
		
		<div id="main" class="site-main">
			<div class="width-container">


<?php if(of_get_option('blog_sidebar_single', '1')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>
	<?php while ( have_posts() ) : the_post(); ?>
		
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


			<?php if(get_post_meta($post->ID, 'videoembed_videoembed', true)): ?>
				<div class="blog-post-image video-post-image"><?php echo get_post_meta($post->ID, 'videoembed_videoembed', true) ?></div>
			<?php else: ?>
				
				<?php if( has_post_format( 'gallery' ) ): ?>
					<div class="blog-post-image">
						<div class="flexslider gallery-progression">
				      	<ul class="slides">
							<?php
							$args = array(
							    'post_type' => 'attachment',
							    'numberposts' => '-1',
							    'post_status' => null,
							    'post_parent' => $post->ID,
								'orderby' => 'menu_order',
								'order' => 'ASC'
							);
							$attachments = get_posts($args);
							?>
							<?php 
							if($attachments):
							    foreach($attachments as $attachment):
							?>
							<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-blog'); ?>
							<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
							<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-image" /></a></li>
							<?php endforeach; endif; ?>
						</ul>
						</div>
					</div>
				<?php else: ?>
					
				<?php if(has_post_thumbnail()): ?>
				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
				<div class="blog-post-image">
				<a href="<?php echo $image[0]; ?>" rel="prettyPhoto">
					<?php the_post_thumbnail('progression-blog'); ?>
				</a>
				</div>
				<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>

			<div class="blog-post-background">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<div class="post-details-meta"><?php progression_posted_on(); ?></div><!-- close .blog-post-details -->
				<div class="blog-post-excerpt">
					<?php the_content(); ?>
				</div><!-- close .blog-post-excerpt -->	
				<?php the_tags('<!--div class="tag-cloud">Tag Cloud: ', ', ', '</div></div-->'); ?>
			</div><!-- close .blog-post-background -->
		</div><!-- #post-<?php the_ID(); ?> -->
		

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template( '', true );
		?>

	<?php endwhile; // end of the loop. ?>


<div class="clearfix"></div>
<?php if(of_get_option('blog_sidebar_single', '1')): ?></div><!-- close #container-sidebar -->
<?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>