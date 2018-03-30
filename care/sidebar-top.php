<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Top bar sidebar
*	--------------------------------------------------------------------- 
*/
?>
<div id="top-bar-wrapper" class="clearfix">
	<div id="top-bar">
	
		<?php if ( is_active_sidebar( 'top-left-widget-area' ) ) : ?>
			<div id="topleft-widget-area">
				<ul>
					<?php dynamic_sidebar( 'top-left-widget-area' ); ?>
				</ul>
			</div>
		<?php endif; ?>	
		
		<?php if ( is_active_sidebar( 'top-right-widget-area' ) ) : ?>
			<div id="topright-widget-area">
				<ul>
					<?php dynamic_sidebar( 'top-right-widget-area' ); ?>
				</ul>
			</div>
		<?php endif; ?>	

	</div>
</div>