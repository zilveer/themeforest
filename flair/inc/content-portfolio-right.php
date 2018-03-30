<div class="col-sm-12 col-md-8">
	<?php
		the_content();
		wp_link_pages();
	?>
</div>

<div class="col-sm-12 col-md-4">
	<?php get_template_part('loop/content','meta-portfolio'); ?>
</div>