<?php
/**
 * @package berg-wp
 */

get_template_part('header');
the_post();
$slides = get_post_meta(get_the_id(), 'menu_single', true);



$icon = YSettings::g('icon_food');
$icon_output = '';
if(isset($icon)) {
	$attachments = array_filter( explode( ',', $icon ) );
	if ( $attachments )
	foreach ( $attachments as $attachment_id ) {
		$icon_output .= '<span class="icon-food">'.wp_get_attachment_image( $attachment_id, 'thumbnail' ).'</span>';

	}
}

if (has_post_thumbnail(get_the_id()) || !empty($slides)): ?>
	<section class="section-scroll main-section menu single-product">
		<div class="container-fluid menu-content">
			<div class="row">
				<div class="product-gallery menu-item" itemscope="" itemtype="http://schema.org/Product" id="product-<?php echo get_the_id(); ?>">
					<div class="berg-product-carousel-wrapper gallery-top swiper-container">
						<div class="swiper-wrapper berg-product-carousel" id="product-carousel">
							<?php
							
							if ( has_post_thumbnail()) {
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog_thumb');
								echo '<div class="swiper-slide"><figure><img src="'.$large_image_url[0].'" alt=""/></figure></div>';
							}

							$slides = explode(',', $slides);

							if (!empty($slides)) {
								foreach ($slides as $slide) {
									echo '<div class="swiper-slide"><figure>';
									$image = wp_get_attachment_image_src($slide, 'blog_thumb');
									echo '<img src="'.$image[0].'" alt=""/>';
									echo '</figure></div>';
								}
							}
							?>
						</div>
				      	<div class="swiper-next"><i class="arrow-right-open"></i></div>
       					<div class="swiper-prev"><i class="arrow-left-open"></i></div>
					</div>
					<div class="product item-description">
						<div class="">
							<div class="">
								<div class="item-badge"><?php echo apply_filters('the_content', get_post_meta(get_the_id(),'menu_badge', true )); ?></div>
								<?php the_title( sprintf( '<h3 class="entry-title">', esc_url( get_permalink() ) ), ''.$icon_output.'</h3>' ); ?>
							
								<p class="item-excerpt"><?php the_excerpt(); ?></p>

								<div class="item-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								<?php echo apply_filters('the_content', get_post_meta(get_the_id(), 'menu_details', true )); ?>
								</div>
								<link itemprop="availability" href="http://schema.org/InStock" />
								<?php 

								if (YSettings::g('berg_food_menu_socials') == 1) {
									get_template_part('social', 'share'); 
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row"> 
				<?php if (!empty($slides)) : ?>
				<div class="product-photos swiper-container gallery-thumbs">
					<div class="swiper-wrapper berg-product-carousel2" id="product-carousel2">
						<?php
						$slides = get_post_meta(get_the_id(), 'menu_single', true);

						if (has_post_thumbnail()) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'menu_thumb');
							echo '<div class="swiper-slide"><figure><img src="'.$large_image_url[0].'" alt=""/></figure></div>';
						}

						if (!empty($slides)) {
							$slides = explode(',', $slides);

							if (is_array($slides)) {
								foreach ($slides as $slide) {
									echo '<div class="swiper-slide"><figure>';
									$image = wp_get_attachment_image_src($slide, 'menu_thumb');
									echo '<img src="'.$image[0].'" alt=""/>';
									echo '</figure></div>';
								}
							}		
						}
						?>
					</div>
					<div class="swiper-next"><i class="arrow-right-open-mini"></i></div>
   					<div class="swiper-prev"><i class="arrow-left-open-mini"></i></div>
				</div>
			<?php endif;?>
			<?php //if(the_content() != '') :?>
				<div class="product-description">
					<div class="description">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
			<?php //endif;?>
		</div>
	</section>
	<?php else: ?>
		<?php get_template_part('product', 'content'); ?>
	<?php endif; ?>
<?php 
berg_getFooter();
get_template_part('footer'); ?>