<?php
/**
 * @package sellya Sport
 * @subpackage sellya_sport
 */
?>
<?php if ( is_active_sidebar('page-right-sidebar')) : ?>
<div class="hidden-phone home_content_right">
<aside id="column-left" class="span3">
		
	<?php dynamic_sidebar( 'page-right-sidebar' );?>
	
  </aside>
</div>
 <!--sidebar end-->
<?php  endif; // end sidebar widget area ?>	
