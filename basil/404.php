<?php

get_header(); $content_width = 940; ?>

<section class="basilHPBlock basilFullContent">
	<div class="basilShell">
		<article class="basilPageContent">
		
			<h1 class="title"><?php _e('Page Not Found','basil'); ?></h1>
			<?php
				echo (ot_get_option('to_basil_404_content') ? ot_get_option('to_basil_404_content') : '<p>'.__('Sorry, this page cannot be found.','basil').'</p>');
			?>
			
		</article>
	</div>
</section>	
			
<?php get_footer();