<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Nevia
 * @since Nevia 1.0
 */
?>
<div class="four columns">
    <div class="blog-sidebar">
	<?php do_action( 'before_sidebar' );
        if (!dynamic_sidebar('shop')) :
    endif; ?>
    </div>
</div>