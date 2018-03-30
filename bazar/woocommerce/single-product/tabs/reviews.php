<?php
/**
 * Reviews Tab
 * @version 2.1.0 
 */
 
global $woocommerce, $post; 

if ( comments_open() ) : ?>
	
		<?php comments_template(); ?>
	
<?php endif; ?>