<?php
/**
 * @package berg-wp
 */

$categories = '';

foreach (get_the_terms(get_the_id(), 'berg_portfolio_categories') as $category) {
	$categories .= '<li><a href="'.esc_url(get_category_link($category->term_id)).'" title="'.$category->name.'">'.$category->name.'</a><span class="dot-separator"></span></li>';
}
$get_categories = '<ul class="portfolio-categories">'.$categories.'</ul>';
$class = '';
if (YSettings::g('berg_single_portfolio_desc') == 0) {
	$class = 'lightbox-hide-desc';
} 
?>

<div class="berg-overlay-container berg-portfolio-lightbox <?php echo $class ;?>">

	<div class="berg-overlay-gallery-wrapper">
		<div class="berg-overlay-gallery">
	<?php if(YSettings::g('berg_single_portfolio_desc') == 0 ) {
	    echo '<h3 class="gallery-title header-font-family">';
	    echo the_title();
	    echo '</h3>';
	} ;?>
			<div class="swiper-container berg-overlay-carousel">
				<div class="swiper-wrapper">
				<?php
				
				$slides = get_post_meta(get_the_id(), 'portfolio_single', true);

				if (has_post_thumbnail()) {
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
					$large_img = get_post_thumbnail_id($post->ID);
					// $small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
					echo '<div class="swiper-slide"><figure><img src="'.$large_image_url[0].'" alt=""/>';
					$caption = wp_get_attachment($large_img);
					echo '<div class="img-caption">'.$caption.'</div>';
					echo '</figure></div>';
				}

				if (!empty($slides)) {
					$slides = explode(',', $slides);

					if (is_array($slides)) {
						foreach ($slides as $slide) {
							echo '<div class="swiper-slide"><figure>';
							$image = wp_get_attachment_image_src($slide, 'full');
							echo '<img src="'.$image[0].'" alt=""/>';
							$caption = wp_get_attachment($slide);
							echo '<div class="img-caption">'.$caption.'</div>';
							echo '</figure></div>';
						}
					}
				} 

				?>
				</div>
			</div>
		</div>

		<div class="berg-overlay-close"></div>
		<div class="berg-arrow-left"><i class="arrow-left-open"></i></div>
		<div class="berg-arrow-right"><i class="arrow-right-open"></i></div>
	</div>

	<div class="berg-overlay-content <?php if (YSettings::g('berg_single_portfolio_desc') == 0) : ?> hidden <?php endif ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<header class="berg-overlay-header">
						<div class="single-portfolio-header-wrapper">
							<div class="single-portfolio-header">
								<h2 class=""><?php the_title();?></h2>
								<?php echo $get_categories ?>
							</div>
								<?php echo get_template_part('social', 'share'); ?>
						</div>
					
						<?php if ($post->post_content != ''): ?>
							<div class="berg-overlay-to-bottom hidden-xs"><span><i class="arrow-down-open"></i></span></div>
						<?php endif; ?>

					</header>
				</div>
			</div>
			<?php if ($post->post_content != ''): ?>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<article>
						<?php the_content(); ?>
					</article>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>

</div>