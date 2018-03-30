<?php
/**
 * The template for displaying all single portfolio.
 *
 * @package berg-wp
 */
$thumbnail = has_post_thumbnail(); 
get_header();

$categories = '';

foreach (get_the_terms(get_the_id(), 'berg_portfolio_categories') as $category) {
	$categories .= '<li><a href="'.esc_url(get_category_link($category->term_id)).'" title="'.$category->name.'">'.$category->name.'</a><span class="dot-separator"></span></li>';
}

$img_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog_thumb_small');
$img_width = $img_url[1];
$img_height = $img_url[2];
$img_url = $img_url[0];

if (has_post_thumbnail()) {
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
}

$get_categories = '<ul class="portfolio-categories">'.$categories.'</ul>';

?>

<section id="single-portfolio" class="section-scroll main-section">
	<div id="single-portfolio-carousel" class="swiper-container single-portfolio-carousel">

		<div class="swiper-wrapper single-portfolio-gallery">
			<?php
			$slides = get_post_meta(get_the_id(), 'portfolio_single', true);

			if (has_post_thumbnail()) {
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog_thumb');
				echo '<div class="swiper-slide"><figure style="background-image: url('.$large_image_url[0].')"><img src="'.$large_image_url[0].'" alt=""/></figure></div>';
			}

			if (!empty($slides)) {
				$slides = explode(',', $slides);

				if (is_array($slides)) {
					foreach ($slides as $slide) {
						$image = wp_get_attachment_image_src($slide, 'blog_thumb');
						echo '<div class="swiper-slide"><figure style="background-image: url('.$image[0].')">';
						
						echo '<img src="'.$image[0].'" alt=""/>';
						echo '</figure></div>';
					}
				}
			} 
			?>
		</div>
	 	<div class="button-next">
	 		<i class="arrow-right-open"></i>
	 	</div>
		 	<div class="button-prev">
		 		<i class="arrow-left-open"></i>
		 	</div>
	</div>
	<div class="berg-overlay-content">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<header class="berg-overlay-header">
						<div class="single-portfolio-header">
							<h2><?php the_title();?></h2>
							<?php echo $get_categories ?>
						</div>
						<?php echo get_template_part('social', 'share'); ?>
					</header>
					<div class="prev-next-post">
						<?php 
							$previousPost = get_previous_post();
							$nextPost = get_next_post();
						?>
						<div class="prev-post-portfolio">
						<?php if ($previousPost != '') : ?>						
							<?php $previousPostCategories = get_the_terms($previousPost->ID, 'berg_portfolio_categories'); ?>
							<a class="prev-link" href="<?php echo get_permalink($previousPost->ID);?>"><span><i class="arrow-left-open-mini"></i><?php _e( 'Previous', 'BERG'); ?></span><span class="prev-title"><?php echo get_the_title($previousPost->ID);?></span></a>
						<?php endif;?>	
						</div>
						<?php if ($post->post_content != ''): ?>
							<div class="berg-overlay-to-bottom hidden-xs <?php if (YSettings::g('berg_single_portfolio_desc') == 0) : ?> hidden <?php endif ?>"><span><i class="arrow-down-open"></i></span></div>
						<?php endif; ?>
						<div class="next-post-portfolio">
						<?php if ($nextPost != '') : ?>						
							<?php $nextPostCategories = get_the_terms($nextPost->ID, 'berg_portfolio_categories'); ?>
							
								<a class="next-link" href="<?php echo get_permalink($nextPost->ID);?>"><span class=""><?php _e( 'Next', 'BERG'); ?><i class="arrow-right-open-mini"></i></span><span class="next-title"><?php echo get_the_title($nextPost->ID);?></span></a>
						<?php endif;?>	
						</div>
					</div>
					<?php if ($post->post_content != ''): ?>
					<article class="<?php if (YSettings::g('berg_single_portfolio_desc') == 0) : ?> hidden <?php endif ?>">
						<?php echo apply_filters('the_content', $post->post_content);?>
					</article>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	berg_getFooter();
	get_template_part('footer'); 
?>