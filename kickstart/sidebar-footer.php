<?php
/**
* The Footer widget areas.
*
*/

if (   ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
		&& ! is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area' )
		)
return; 
?>

<div id="footer-wrapper">
	<div id="footer-widget-area" class="columns-<?php echo ot_get_option('footer_columns'); ?> size-wrap" >
	
		<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
		<div class="widget-area">
			<ul class="xoxo">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
			</ul>
		</div><!-- #first .widget-area -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
		<div class="widget-area">
			<ul class="xoxo">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
			</ul>
		</div><!-- #second .widget-area -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'third-footer-widget-area' ) && (ot_get_option('footer_columns') == '3' || ot_get_option('footer_columns') == '4')) : ?>
		<div class="widget-area">
			<ul class="xoxo">
			<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
			</ul>
		</div><!-- #third .widget-area -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) && ot_get_option('footer_columns') == '4' ) : ?>
		<div class="widget-area">
			<ul class="xoxo">
			<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
			</ul>
		</div><!-- #fourth .widget-area -->
		<?php endif; ?>
		
	</div><!-- #footer-widget-area -->
</div><!-- #footer-widget-area-background -->