<?php get_header(); ?>

<div class="bottom-spacer"></div>
	
<div id="page-post" class="shell clearfix">
	<article class="full page-content">
				
		<h1 class="page-title"><span><?php _e('Page Not Found','espresso'); ?></span></h1>
				
		<?php echo (ot_get_option('js_404_content') ? ot_get_option('js_404_content') : '<p>'.__('Sorry, this page cannot be found.','espresso').'</p>'); ?>
							
	</article>
</div>

<div class="bottom-spacer"></div>

<?php get_footer(); ?>