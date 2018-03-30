<?php
/**
 * @package berg-wp
 */

?>
<section class="section-scroll main-section menu single-product2">
	<div class="container-fluid menu-content">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="product dish-desc col-md-8 col-md-offset-2">
						<?php the_title( sprintf('<h3 class="entry-title">', esc_url(get_permalink())), '</h3>'); ?>
						<p><?php the_excerpt(); ?></p>
						<?php echo apply_filters('the_content', get_post_meta(get_the_id(), 'menu_details', true )); ?>
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
				<div class="product-description row">
					<div class="description col-md-8 col-md-offset-2">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>