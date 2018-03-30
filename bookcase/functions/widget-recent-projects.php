<?php

/*******************************************************
*
*	Custom Recent Project Widget
*	By: Andre Gagnon
*	http://www.designcirc.us
*
*******************************************************/

// Initialize widget
add_action( 'widgets_init', 'ag_recentprojects_widgets' );

// Register widget
function ag_recentprojects_widgets() {
	register_widget( 'AG_Recentprojects_Widget' );
}

// Widget class
class ag_recentprojects_widget extends WP_Widget {

/*----------------------------------------------------------*/
/*	Set up the Widget
/*----------------------------------------------------------*/
	
	function AG_Recentprojects_Widget() {
	
		/* General widget settings */
		$widget_ops = array( 'classname' => 'ag_recentprojects_widget', 'description' => __('A widget that displays small project thumbnails from recent projects.', 'framework') );

		/* Widget control settings */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ag_recentprojects_widget' );

		/* Create widget */
		$this->WP_Widget( 'ag_recentprojects_widget', __('Custom Recent Projects Widget', 'framework'), $widget_ops, $control_ops );
	}

/*----------------------------------------------------------*/
/*	Display The Widget 
/*----------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Variables from settings. */
		$postnum = $instance['postnum'];
		
		/* Before widget (defined in functions.php). */
		echo $before_widget;

		/* Display The Widget */
		?>
        <?php 
/* Display the widget title & subtitle if one was input (before and after defined by themes). */
if ( $title ) echo ' 
            <h3>'.$title.'</h3>'
?>
  <?php $loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $postnum ) ); ?>
	 <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
     
<div class="recent-project">
        <a href="<?php the_permalink(); ?>" class="hover"><?php the_post_thumbnail('portfoliowidget'); ?></a>
</div>

<?php endwhile;?>
<div class="clear"></div>
<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

/*----------------------------------------------------------*/
/*	Update the Widget
/*----------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Remove HTML: */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['postnum'] = strip_tags( $new_instance['postnum'] );
	
		return $instance;
	}
	

/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Default widget settings */
		$defaults = array(
		'title' => '',
		'postnum' => '',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('Projects Title (Optional):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'postnum' ); ?>">
        <?php _e('Number of Posts:', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'postnum' ); ?>" name="<?php echo $this->get_field_name( 'postnum' ); ?>" value="<?php echo $instance['postnum']; ?>" />
</p>
<?php
	}
}
?>