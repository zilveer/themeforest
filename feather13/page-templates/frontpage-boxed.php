<?php
/*
Template Name: Frontpage Boxed
*/

global $meta;
$meta = get_post_custom(); // Custom fields
?>
<?php get_header(); ?>
<?php while(have_posts()): the_post(); ?>

<div class="container fix front-boxed">
			
	<div id="content">
		<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>

			<div id="page-title">
				<h1><?php echo wpb_page_title(); ?></h1>
			</div><!--/page-title-->
			
			<?php if(isset($meta['_front_slider_enable'])) : ?>
				
				<script type="text/javascript">
					jQuery(window).load(function() {
						jQuery('.flexslider').flexslider({
							animation: "fade",
							slideshow: true,
							directionNav: true,
							controlNav: true,
							pauseOnHover: true,
							slideshowSpeed: 7000,
							animationDuration: 600,
							smoothHeight: true
						});
						jQuery('.slides').addClass('loaded');
					}); 
				</script>

				<?php $images = wpb_post_images(); ?>

				<div class="flexslider">
					<ul class="slides">
						<?php foreach($images as $image): ?>
						<?php $img = wpb_vt_resize($image->ID,'','960','460',TRUE); ?>
						<?php $imagelink=($image->post_content!='')?$image->post_content:NULL; ?>
						<li>
							<?php if($imagelink): ?>
								<a href="<?php echo $imagelink; ?>"><img src="<?php echo $img['url']; ?>" alt="<?php echo $image->post_title; ?>" /></a>
							<?php else: ?>
								<img src="<?php echo $img['url']; ?>" alt="<?php echo $image->post_title; ?>" />
							<?php endif; ?>

							<?php if($image->post_excerpt): ?>
							<span class="caption-bar"><i><?php echo $image->post_excerpt; ?></i></span>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ul>
				</div><!--/flexslider-->
			
			<?php endif; ?>
			
			<div class="pad">
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>			
			</div>
			
			<?php if(isset($meta['_front_portfolio_enable'])): ?>
				<div id="front-portfolio" class="pad fix">
					<?php get_template_part('_front-portfolio'); ?>
				</div><!--/front-portfolio-->
			<?php endif; ?>
			
			<?php if(isset($meta['_front_blog_enable'])): ?>
				<div id="front-blog" class="pad fix">
					<?php get_template_part('_front-blog'); ?>
				</div><!--/front-blog-->
			<?php endif; ?>		
			
		</article>
	</div>
		
</div><!--/container-->

<?php endwhile;?>
<?php get_footer(); ?>