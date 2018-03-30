<?php get_header(); ?>

		<div id="page-title">
			<div class="width-container paged-title">
				<h1><?php the_title(); ?></h1>	
			</div>
		<div id="page-title-divider"></div>
		</div><!-- #page-title -->
		<div class="clearfix"></div>
		<?php $page_for_posts = get_option('page_for_posts'); ?>
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

<?php
while(have_posts()): the_post();
?>

<?php if(of_get_option('portfolio_sidebar_single', '0')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>
	<div class="portfolio-single-container">
		
		
		
		<?php if(get_post_meta($post->ID, 'portfoliooptions_videoembed', true)): ?>
		<div class="item-portfolio-image"><?php echo get_post_meta($post->ID, 'portfoliooptions_videoembed', true) ?></div>
			
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
						<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
						
						<?php if(of_get_option('portfolio_single_uncrop', '1')): ?>
							<?php $attachment_image2 = wp_get_attachment_image_src($attachment->ID, 'progression-single-portfolio'); ?>
						<?php else: ?>
							<?php $attachment_image2 = wp_get_attachment_image_src($attachment->ID, 'progression-single-portfolio-uncropped'); ?>
						<?php endif; ?>
						<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[portfolio-gallery]" class="hover-icon"><img src="<?php echo $attachment_image2[0]; ?>" alt="slider"></a></li>
						<?php endforeach; endif; ?>
					</ul>
					</div>
				</div>
			<?php else: ?>
				

					<?php if(has_post_thumbnail()): ?>
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
					<div class="blog-post-image">
					<a href="<?php echo $image[0]; ?>" rel="prettyPhoto">
						<?php if(of_get_option('portfolio_single_uncrop', '1')): ?>
							<?php the_post_thumbnail('progression-single-portfolio'); ?>
						<?php else: ?>
							<?php the_post_thumbnail('progression-single-portfolio-uncropped'); ?>
							<?php $attachment_image2 = wp_get_attachment_image_src($attachment->ID, 'progression-single-portfolio-uncropped'); ?>
						<?php endif; ?>
					</a>
					</div>
					<?php endif; ?>

				
				<?php endif; ?>
			<?php endif; ?>
			
			

	<?php $cc = get_the_content(); if($cc != '') { ?>
	<div class="portfolio-post-background">
		<?php the_content(); ?>
		<div class="clearfix"></div>
	</div><!-- close .portfolio-post-background -->
	<?php } ?>
	
</div><!-- close .portfolio-single-container -->

<?php endwhile; ?>

<?php if(of_get_option('portfolio_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>


<div class="clearfix"></div>
<?php if(of_get_option('portfolio_sidebar_single', '0')): ?></div><!-- close #container-sidebar -->
<?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>