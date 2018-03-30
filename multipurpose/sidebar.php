<aside class="sidebar">
	<?php
	if (!dynamic_sidebar('sidebar-widget-area') ) : ?>
	<section class="widget">
		<h3><span><?php esc_attr_e( 'Pages', 'multipurpose' ); ?></span></h3>
		<ul>
	        <?php wp_list_pages('title_li='); ?>
		</ul>
	</section>
	<section class="widget">
		<h3><span><?php esc_attr_e( 'Categories', 'multipurpose' ); ?></span></h3>
		<ul>
	        <?php wp_list_categories('title_li='); ?>
		</ul>
	</section>
	<section class="widget">
		<h3><span><?php esc_attr_e( 'Archives', 'multipurpose' ); ?></span></h3>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</section>
	<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
	<section class="widget">
		<h3><span><?php esc_attr_e( 'Meta', 'multipurpose' ); ?></span></h3>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</section>

	<?php } ?>
	<?php endif; ?>
	
</aside>