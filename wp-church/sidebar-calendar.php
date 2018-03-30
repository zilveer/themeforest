<?php
/**
 * The Sidebar containing the calendar widget.
 *
 */
?>


<?php		if ( is_active_sidebar( 'calendar-widget-area' ) ) : ?>
		<div id="primary" class="widget-area grid4 caldr sider" role="complementary" >
				
			<ul class="xoxo">
			
				<h3><?php echo get_option('nets_sptnotmiss')?></h3>

				<?php dynamic_sidebar( 'calendar-widget-area' ); ?>
	
			</ul>
		</div><!-- #primary .widget-area -->
		
	<?php endif; // end primary widget area ?>
