<?php
/*
Template Name: Frontpage Wide
*/

global $meta;
$meta = get_post_custom(); // Custom fields
?>
<?php get_header(); ?>
<?php while(have_posts()): the_post(); ?>

<?php if(isset($meta['_front_slider_enable'])) : ?>
<div id="front-wide" class="front">

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
			<?php $img = wpb_vt_resize($image->ID,'','1600','500',TRUE); ?>
			<?php $imagelink=($image->post_content!='')?$image->post_content:NULL; ?>
			<li>
				<?php if($imagelink): ?>
					<a href="<?php echo $imagelink; ?>"><img src="<?php echo $img['url']; ?>" alt="<?php echo $image->post_title; ?>" /></a>
				<?php else: ?>
					<img src="<?php echo $img['url']; ?>" alt="<?php echo $image->post_title; ?>" />
				<?php endif; ?>

				<?php if($image->post_excerpt): ?>
				<div id="caption-wrap">
					<div id="slidecaption">
						<?php echo $image->post_excerpt; ?>
					</div>
				</div>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div><!--/flexslider-->
</div>
<?php endif; ?>

<div class="container fix front-wide">
			
	<div id="content">
		<article id="entry-<?php the_ID(); ?>" <?php post_class('nobox fix'); ?>>

			<div id="page-title">
				<h1><?php echo wpb_page_title(); ?></h1>
				<div class="hr"></div>
			</div><!--/page-title-->
			
			<div class="text">
				<?php the_content(); ?>
				<div class="clear"></div>
			</div>
			
			<?php if(isset($meta['_front_portfolio_enable'])): ?>
				<div class="hr"></div>
				<div id="front-portfolio" class="fix">
					<?php get_template_part('_front-portfolio'); ?>
				</div><!--/front-portfolio-->
			<?php endif; ?>
			
			<?php if(isset($meta['_front_blog_enable'])): ?>
				<div class="hr"></div>
				<div id="front-blog" class="fix">
					<?php get_template_part('_front-blog'); ?>
				</div><!--/front-blog-->
			<?php endif; ?>
			
		</article>
	</div>
		
</div><!--/container-->

<?php endwhile;?>
<?php get_footer(); ?>