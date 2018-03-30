<?php
/**
 * @package sellya Sport
 * @subpackage sellya_sport
 */
?>
<?php if ( is_active_sidebar('page-left-sidebar')) : ?>
<div class="hidden-phone">
<aside id="column-left" class="span3">
		
	<?php dynamic_sidebar( 'page-left-sidebar' );?>
	
  </aside>
</div>
 <!--sidebar end-->
<?php  endif; // end sidebar widget area ?>	
