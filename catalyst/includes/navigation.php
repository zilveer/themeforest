<div class="clearfix"></div>

<!-- ADD Custom Numbered Pagination code. -->
<?php
if (function_exists("pagination")) {
	if (isset($additional_loop)){
		pagination($additional_loop->max_num_pages);
    } else {
	    pagination();
    }
} else {
	next_posts_link('&laquo;&laquo; Older Posts');
    previous_posts_link('Newer Posts &raquo;&raquo;');
}
?>