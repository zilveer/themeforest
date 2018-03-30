<?php
	wp_reset_query();

?>		
<?php get_template_part(THEME_LOOP."loop","start"); ?>
	<?php ot_get_sidebar($post->ID, 'left'); ?>	
	<div class="content-main alternate <?php OT_content_class($post->ID);?>">
		<?php if (have_posts()) :  ?>
			<?php 
				if(get_option('woocommerce_shop_page_id')==OT_page_id() || is_search() || is_category() || is_tag() || is_archive()) {
					get_template_part("woocommerce/archive-product");	
				} else {
					woocommerce_content();
				}
			 ?>
		<?php else: ?>
			<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
		<?php endif; ?>
	<!-- END .content-main -->
	</div>
	<?php ot_get_sidebar($post->ID, 'right'); ?>	
<?php get_template_part(THEME_LOOP."loop","end"); ?>