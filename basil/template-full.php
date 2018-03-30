<?php

/*
Template Name: Full-Width Recipe Template
*/

get_header(); ?>

<section class="basilHPBlock basilFullContent">
	<div class="basilShell">
		<article class="basilPageContent">
		
			<?php
				get_template_part('loop');
			?>
			
		</article>
	</div>
</section>	
			
<?php get_footer(); ?>