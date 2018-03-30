<?php if(is_page()): ?>
	
	<?php if(has_post_thumbnail()): ?>
		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-page-title'); ?>	
		<script type='text/javascript'>jQuery(document).ready(function($) {  'use strict';  $("#page-title-background").backstretch([ "<?php echo $image[0]; ?>" ],{ fade: 750, }); }); </script>
	<?php else: ?>
	<?php if (get_header_image() != '') {?>
		<script type='text/javascript'>jQuery(document).ready(function($) {  'use strict';  $("#page-title-background").backstretch([ "<?php header_image(); ?>" ],{ fade: 750, }); }); </script>
	<?php } ?>
	<?php endif; ?>
	
<?php else: ?>
	
	<?php if (get_header_image() != '') {?>
		<script type='text/javascript'>jQuery(document).ready(function($) {  'use strict';  $("#page-title-background").backstretch([ "<?php header_image(); ?>" ],{ fade: 750, }); }); </script>
	<?php } ?>
	
<?php endif; ?>