<?php

/**
  * Tabs Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_widget_tabs_init' );

function van_widget_tabs_init(){

	register_widget( 'van_widget_tabs' );

}
class van_widget_tabs extends WP_Widget {

	function van_widget_tabs() {
		$options = array( 'classname' => 'tabs-widget','description' => 'tabs widget'  );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'tabs-widget' );
		$this->WP_Widget( 'tabs-widget','( '.THEME_NAME .' ) - tabs  ', $options,$control );
	}
	
	function widget( $args, $instance ) {
		
		?>
		<div class="tabs-widget widget">
			<ul class="tabs-nav clearfix">
				<li class="tabs"><a href="#"><?php _e( 'Recent' , 'van' ) ?></a></li>
				<li class="tabs"><a href="#"><?php _e( 'Popular' , 'van' ) ?></a></li>
				<li class="tabs"><a href="#"><?php _e( 'Comments' , 'van' ) ?></a></li>
			</ul>
			<div class="pane content widget-container">
				<div class="tab-inner">
					<?php van_posts_query( 3 , true, 'date', '', 'list' ); ?>	
				</div>
				<div class="tab-inner">
					<?php van_posts_query( 3 , true, 'comment_count', '', 'list' ); ?>	
				</div>
				<div class="tab-inner">
					<?php van_comments(); ?>
				</div>
			</div>
		</div>
<?php
	}
}