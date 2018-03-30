<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="blog-top-block mobile-hide">
	<div class="title"><?php echo esc_html__('Filter by:','dfd') ?></div>
	<?php
	$categories = get_terms('gallery_category');
	if(!empty($categories) && is_array($categories)) : ?>
		<div class="click-dropdown">
			<a href="#"><?php _e('Categories','dfd') ?><span></span></a>
			<div>
				<ul class="category-filer">
						<?php
						foreach($categories as $category) :
							$cat_url = get_term_link($category->slug, 'gallery_category');
							if(!is_wp_error($cat_url)) {
								$t_id = $category->term_id;
								$icon = get_option("taxonomy_$t_id");
								?>
								<li>
									<div class="icon-wrap"><i class="<?php echo !empty($icon['custom_term_meta']) ? $icon['custom_term_meta'] : 'none'; ?>"></i></div>
									<a href="<?php echo esc_url($cat_url); ?>"><?php echo $category->name; ?></a>
								</li>
							<?php
							}
						endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<?php
	$tags = get_tags();
	if(!empty($tags) && is_array($tags)) : ?>
		<div class="click-dropdown">
			<a href="#"><?php _e('Tags','dfd') ?><span></span></a>
			<div>
				<ul class="filter-tags">
					<?php
					foreach($tags as $tag) :
						$t_id = $tag->term_id;
						?>
						<li>
							<a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<div class="click-dropdown">
		<a href="#"><?php _e('Authors','dfd') ?><span></span></a>
		<div>
			<ul class="filter-authors">
				<?php wp_list_authors(); ?>
			</ul>
		</div>
	</div>
	<?php get_template_part('templates/entry-meta/gallery-top-link'); ?>
</div>