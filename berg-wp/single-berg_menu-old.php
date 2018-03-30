<?php
/**
 * @package berg-wp
 */

get_template_part('header');
the_post();
$slides = get_post_meta(get_the_id(), 'menu_single', true);

if (has_post_thumbnail(get_the_id()) || !empty($slides)): ?>
	<section class="section-scroll main-section menu single-product">
		<div class="container-fluid menu-content">
			<div class="row">
				<div class="product-gallery menu-item" itemscope="" itemtype="http://schema.org/Product" id="product-<?php echo get_the_id(); ?>">
					<div class="berg-product-carousel-wrapper">
						<div class="owl-carousel berg-product-carousel" id="product-carousel">
							<?php
							
							if ( has_post_thumbnail()) {
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog_thumb');
								echo '<div class="item"><figure><img src="'.$large_image_url[0].'" alt=""/></figure></div>';
							}

							$slides = explode(',', $slides);

							if (!empty($slides)) {
								foreach ($slides as $slide) {
									echo '<div class="item"><figure>';
									$image = wp_get_attachment_image_src($slide, 'blog_thumb');
									echo '<img src="'.$image[0].'" alt=""/>';
									echo '</figure></div>';
								}
							}
							?>
						</div>
					</div>
					<div class="product item-description">
						<div class="">
							<div class="">
								<?php the_title( sprintf( '<h4 class="entry-title">', esc_url( get_permalink() ) ), '</h4>' ); ?>
								<?php if (YSettings::g('berg_food_menu_categories') == 1): ?>
								<div class="product-category"><?php echo __('Category', 'BERG');?>:
									<?php
										$categories_link = get_the_terms(get_the_id(), 'berg_menu_categories');

										if (!empty($categories_link)) {
											foreach ($categories_link as $category) {
												echo '<a href="' . esc_url(get_term_link($category, 'berg_menu_categories')) . '">' . $category->name . '</a> ';
											}
										}
									?>
								</div>
								<?php endif; ?>
								<p><?php the_excerpt(); ?></p>

								<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								<?php echo apply_filters('the_content', get_post_meta(get_the_id(), 'menu_details', true )); ?>
								</div>
								<link itemprop="availability" href="http://schema.org/InStock" />
								<?php
								$post_meta = get_post_meta(get_the_ID());

								if (isset($post_meta['social_share_menu'][0])) {
									$social_sharer = $post_meta['social_share_menu'][0];

									if ($social_sharer != 'default') {
										if ($social_sharer == 'enabled') {
											get_template_part('social', 'share');
										}
									} else {
										if (YSettings::g('berg_sharer_menu', 1) == 1) {
											get_template_part('social', 'share'); 
										}
									} 
								} else {
									if (YSettings::g('berg_sharer_menu', 1) == 1) {
										get_template_part('social', 'share'); 
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php if (!empty($slides)) : ?>
				<div class="product-photos">
					<div class="owl-carousel berg-product-carousel2" id="product-carousel2">
						<?php
						$slides = get_post_meta(get_the_id(), 'menu_single', true);

						if (has_post_thumbnail()) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'menu_thumb');
							echo '<div class="item"><figure><img src="'.$large_image_url[0].'" alt=""/></figure></div>';
						}

						if (!empty($slides)) {
							$slides = explode(',', $slides);

							if (is_array($slides)) {
								foreach ($slides as $slide) {
									echo '<div class="item"><figure>';
									$image = wp_get_attachment_image_src($slide, 'menu_thumb');
									echo '<img src="'.$image[0].'" alt=""/>';
									echo '</figure></div>';
								}
							}		
						}
						?>
					</div>
				</div>
			<?php endif;?>
				<div class="product-description">
					<div class="description">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php else: ?>
		<?php get_template_part('product', 'content'); ?>
	<?php endif; ?>
<?php get_template_part('footer'); ?>