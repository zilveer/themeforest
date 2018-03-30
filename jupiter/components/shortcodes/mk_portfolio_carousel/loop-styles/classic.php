<li>
	<div class="item-thumb">
		<?php echo mk_get_shortcode_view('mk_portfolio_carousel', 'components/thumbnail', true, ['width' => 260, 'height' => 180, 'image_size' => $view_params['image_size']]); ?>
		<div class="item-overlay accent-bg-color transition-all-2"></div>
		
		<a class="hover-icon item-lightbox mk-lightbox" alt="<?php the_title_attribute(); ?>" data-fancybox-group="carousel-<?php echo $view_params['id']; ?>" title="<?php the_title_attribute(); ?>" href="<?php echo mk_get_portfolio_lightbox_url($view_params['post_type']); ?>">
			<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-plus-circle', 32); ?>
		</a>

		<a class="hover-icon item-permalink" href="<?php echo mk_get_super_link(get_post_meta(get_the_ID(), '_portfolio_permalink', true)); ?>">
			<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-circle', 32); ?>
		</a>
	</div>


	<div class="item-content">
		<a class="item-title" href="<?php echo mk_get_super_link(get_post_meta(get_the_ID(), '_portfolio_permalink', true)); ?>"><?php the_title(); ?></a>
		<div class="clearboth"></div>
		<div class="item-cats"><?php echo implode(' ', mk_get_custom_tax(get_the_id(), 'portfolio', false, false)); ?></div>
	</div>
</li>



