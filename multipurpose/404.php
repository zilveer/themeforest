<?php get_header(); ?>
<section class="columns e404">
	<article class="col col2">
		<p class="e404"><?php esc_attr_e('404', 'multipurpose');?></p>
		<p><?php esc_attr_e('Ooops, This Page Could Not Be Found!', 'multipurpose'); ?></p>
	</article><article class="col col2">
		<p><?php esc_attr_e("Can't find what you need?", 'multipurpose');?><br>
		<?php esc_attr_e('Take a moment and do a search below!', 'multipurpose');?></p>
		<?php get_search_form(); ?>
		<p><span><?php esc_attr_e('or', 'multipurpose'); ?></span></p>
		<p><a href="<?php echo home_url(); ?>" class="button large"><?php esc_attr_e('Back to Homepage', 'multipurpose'); ?></a></p>
	</article>
</section>
<?php get_footer(); ?>