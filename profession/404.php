<?php
	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");

	get_header();
	
	// Intro
	get_template_part('article', 'menu'); 
?>
<div class="wrap">
	<div class="container">
		<div class="notfound">:( <?php _e('Desol&#233; !', TEXTDOMAIN) ?></div>
		<div class="notfound_error"><?php _e('Erreur 404 <br /> La page &#224; laquelle vous souhaitez acc&#233;der est inexistante. <br /> Elle a &#233;t&#233; d&#233;plac&#233;e ou supprim&#233;e.', TEXTDOMAIN) ?></div>
	</div>
</div>

<?php get_footer();