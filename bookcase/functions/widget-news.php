<?php

/*******************************************************
*
*	Custom News Widget
*	By: Andre Gagnon
*	http://www.designcirc.us
*
*******************************************************/

// Initialize widget
add_action( 'widgets_init', 'ag_news_widgets' );

// Register widget
function ag_news_widgets() {
	register_widget( 'AG_News_Widget' );
}

// Widget class
class ag_news_widget extends WP_Widget {

/*----------------------------------------------------------*/
/*	Set up the Widget
/*----------------------------------------------------------*/
	
	function AG_News_Widget() {
	
		/* General widget settings */
		$widget_ops = array( 'classname' => 'ag_news_widget', 'description' => __('A widget that displays the latest post(s) from a category.', 'framework') );

		/* Widget control settings */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ag_news_widget' );

		/* Create widget */
		$this->WP_Widget( 'ag_news_widget', __('Custom News Widget', 'framework'), $widget_ops, $control_ops );
	}

/*----------------------------------------------------------*/
/*	Display The Widget 
/*----------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Variables from settings. */
		$postnum = $instance['postnum'] ;
		$category = $instance['category'] ;
		
		/* Before widget (defined in functions.php). */
		echo $before_widget;

		/* Display The Widget */
		?>
        <?php 
/* Display the widget title & subtitle if one was input (before and after defined by themes). */
if ( $title ) echo ' 
            <h3>'.$title.'</h3>'
?>
 <?php $the_query = new WP_Query('cat='.$category.'&showposts='.$postnum); //or category_name=
    while ($the_query->have_posts()) : $the_query->the_post();?>
<div class="news-widget-item">
        <h4 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><!--Post Title-->
        <h5><a href="<?php the_permalink(); ?>"><?php the_time('jS F Y') ?></a> by <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></h5><!--Misc Info-->
        <?php 
global $more;    // Declare global $more (before the loop).
$more = 0;       // Set (inside the loop) to display content above the more tag.
the_content("Read More...", 'framework');
?>
</div>

<?php endwhile;?>

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
		$instance['category'] = strip_tags( $new_instance['category'] );
	
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
		'category' => '',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('News Title (Optional):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'postnum' ); ?>">
        <?php _e('Number of Posts:', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'postnum' ); ?>" name="<?php echo $this->get_field_name( 'postnum' ); ?>" value="<?php echo $instance['postnum']; ?>" />
</p>
<?php if ($displaycatname = $instance['category']) { echo '<p>Current Category: '.get_cat_name( $displaycatname ).'</p>'; }?> 
<p>
    <label for="<?php echo $this->get_field_id( 'category' ); ?>">
        <?php _e('Choose a Category:', 'framework'); ?>
    </label>
   <?php wp_dropdown_categories( 'name='.$this->get_field_name( 'category' ).'&id='.$this->get_field_id( 'category' ).'&show_count=1');?>                             
    <!--<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo $instance['category']; ?>" /> -->
</p>
<hr>
<?php
	}
}
?>