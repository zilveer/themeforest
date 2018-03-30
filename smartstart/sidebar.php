<aside id="sidebar">

	<?php if( is_home() || is_archive() || is_category() || is_tag() || is_single() || is_search() || is_404() ): ?>

		<?php if ( is_active_sidebar('blog-widget-area') ) dynamic_sidebar('blog-widget-area'); ?>

	<?php endif; ?>

	<?php if ( is_active_sidebar('general-widget-area') ) dynamic_sidebar('general-widget-area'); ?>

	<?php if ( !is_active_sidebar('blog-widget-area') && !is_active_sidebar('general-widget-area') ): ?>

		<div class="widget">
			<h6><?php _e('Archives', 'ss_framework'); ?></h6>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</div><!-- end .widget -->

		<div class="widget">
			<h6><?php _e('Meta', 'ss_framework'); ?></h6>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</div><!-- end .widget -->

	<?php endif; ?>
		
</aside><!-- end #sidebar -->