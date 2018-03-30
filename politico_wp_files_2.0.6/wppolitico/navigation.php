<?php if (in_array('wp-pagenavi/wp-pagenavi.php', apply_filters('active_plugins', get_option('active_plugins')))) { 
	wp_pagenavi(); 
} else { ?>
	<div class="navigation">
	<div id="nextpage" class="pagenav alignright"><?php next_posts_link(__('Next Page &raquo;','themolitor')); ?></div>
	<div id="backpage" class="pagenav alignleft"><?php previous_posts_link(__('&laquo; Previous Page','themolitor')); ?></div>
	</div>
<?php } ?>