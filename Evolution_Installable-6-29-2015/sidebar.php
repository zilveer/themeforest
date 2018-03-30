<aside class="large-3 right">
                        <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('main_sidebar')){ }else { ?>
		<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'Evolution'); ?></p>
	 <?php } ?>
</aside>
