<?php
	$date_format = 'd';
	$month_format = 'M';
?>
<div class="qodef-blog-standard-post-date">
	<span class="date"><?php echo esc_html(the_time($date_format)); ?></span>
	<span class="month"><?php echo esc_html(the_time($month_format)); ?></span>
</div>