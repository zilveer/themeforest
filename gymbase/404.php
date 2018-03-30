<?php
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
get_header();
?>
<div class="theme_page relative">
	<div class="page_layout clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1><?php _e("Error 404 - Not Found", 'gymbase'); ?></h1>
				<h4><?php _e("Sorry, but you are looking for something that isn't here", 'gymbase'); ?></h4>
			</div>
		</div>
	</div>
</div>
<?php
get_footer(); 
?>
