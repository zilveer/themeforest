<?php
/**
 * Reviews Tab
 */
 
global $post;

if ( comments_open() ) : ?>
	
	<?php comments_template(); ?>
	
<?php endif; ?>