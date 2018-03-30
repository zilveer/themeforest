<!-- # Sidebar # -->
<div id="secondary" class="col-md-3 col-sm-12 sidebar widget-area span3" role="complementary">
	<?php
		if ( is_active_sidebar('sidebar') ) {
			dynamic_sidebar('sidebar');
		} else {
			the_widget('WP_Widget_Meta','', array(
				'before_widget' => '<aside id="%1$s" class="widget widget_meta %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3><span class="sidebar_divider"></span>',
			));
		}
	?>
</div><!-- #secondary -->