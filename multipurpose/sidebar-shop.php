<aside class="sidebar">  
    <?php 
    if (!dynamic_sidebar('shop') ) :  ?>
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
    <?php endif; ?>    
</aside> 