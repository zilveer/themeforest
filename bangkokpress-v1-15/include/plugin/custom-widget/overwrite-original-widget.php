<?php 
	add_action('widgets_init', 'register_bkp_widget', 1);
	function register_bkp_widget(){
		if( class_exists('WP_Widget_Calendar') && class_exists('New_calendar_widget') ){
			unregister_widget( 'WP_Widget_Calendar' );
			register_widget('New_calendar_widget');
		}
		
		if( class_exists('WP_Widget_Search') && class_exists('New_search_widget') ){
			unregister_widget( 'WP_Widget_Search' );
			register_widget( 'New_search_widget' );
		}
		
		if( class_exists('WP_Widget_Text') && class_exists('New_text_widget') ){
			unregister_widget( 'WP_Widget_Text' );
			register_widget( 'New_text_widget' );	
		}
		
		if( class_exists('WP_Nav_Menu_Widget') && class_exists('New_menu_widget') ){
			unregister_widget( 'WP_Nav_Menu_Widget' );
			register_widget( 'New_menu_widget' );		
		}
		
	}

	// Calendar Widget
	if( class_exists('WP_Widget_Calendar') ){
		Class New_calendar_widget extends WP_Widget_Calendar{
			function widget( $args, $instance ) {
				extract($args);
				$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
				echo $before_widget;
				
				if ( $title ){ 
					echo $before_title . $title . $after_title; 
				}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
					echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
				}

				echo '<div id="calendar_wrap">';
				get_calendar();
				echo '</div>';
				echo $after_widget;
			}
		}
	}
	
	// Search Widget
	if( class_exists('WP_Widget_Search') ){
		Class New_search_widget extends WP_Widget_Search{
			function widget( $args, $instance ) {
				extract($args);
				$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

				echo $before_widget;
				
				if ( $title ){ 
					echo $before_title . $title . $after_title; 
				}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
					echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
				}

				// Use current theme search form if it exists
				get_search_form();

				echo $after_widget;
			}
		}
	}

	// Text Widget
	if( class_exists('WP_Widget_Text') ){
		Class New_text_widget extends WP_Widget_Text{
			function widget( $args, $instance ) {
				extract($args);
				$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
				$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
				echo $before_widget;
				
				if ( $title ){ 
					echo $before_title . $title . $after_title; 
				}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
					echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
				}
				
				?>
					<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
				<?php
				echo $after_widget;
			}
		}
	}

	// Menu Widget
	if( class_exists('WP_Nav_Menu_Widget') ){
		Class New_menu_widget extends WP_Nav_Menu_Widget{
			function widget($args, $instance) {
				// Get menu
				$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

				if ( !$nav_menu )
					return;

				$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

				echo $args['before_widget'];
				
				if ( !empty($instance['title']) ){ 
					echo $args['before_title'] . $instance['title'] . $args['after_title'];
				}else if( strrpos($args['after_title'], 'bkp-frame') > 0 ) {
					echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
				}				

				wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu ) );

				echo $args['after_widget'];
			}
		}
	}
	
?>