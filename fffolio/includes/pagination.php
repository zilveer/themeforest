<?php
if(function_exists('wp_pagenavi')) 
	wp_pagenavi(); 
else { ?>
	<div class="pagination">
		<div class="leftpag"><?php next_posts_link(esc_attr__('&laquo; Older Entries', 'SCRN')); ?></div>
		<div class="rightpag"><?php previous_posts_link(esc_attr__('Newer Entries &raquo;', 'SCRN')); ?></div>
	</div>
<?php } ?>