<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Related Thumbs Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show Related thumbs by tags or category ).
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'ct_related_thumbs_widget' );

function ct_related_thumbs_widget() {
	register_widget( 'CT_Related_Thumbs' );
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Related_Thumbs extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function  CT_Related_Thumbs() {
		/* Widget settings. */
		$widget_ops = array(	'classname'		=> 'ct-related-thumbs-widget',
								'description'	=> __( 'A widget that show related thumbs by tags or category' , 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 255,
								'height'	=> 350,
								'id_base'	=> 'ct-related-thumbs-widget'
							);

		/* Create the widget. */
		parent::__construct( 'ct-related-thumbs-widget', __('CT: Related Thumbs Widget', 'color-theme-framework'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		global $post;

		/* Our variables from the widget settings. */
		$title = apply_filters ('widget_title', $instance ['title']);
		$num_posts = $instance['num_posts'];
		$num_query_posts = $instance['num_query_posts'];
		$show_random = isset($instance['show_random']) ? 'true' : 'false';
		$posts_by = $instance['posts_by'];
		$background_title = $instance['background_title'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ){
			echo "\n<!-- START RELATED THUMBS WIDGET -->\n";
			echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
		} else {
			echo "\n<!-- START RELATED THUMBS WIDGET -->\n";
		}
		?>

		<?php 
		$orderby = 'date';
		if ( $show_random == 'true' ) { $orderby = 'rand'; }

		// show related posts by tags
		if ( $posts_by == 'tags') :
			$tags = get_the_tags();

			if( $tags):
   				$related_posts = ct_get_related_posts( $post->ID, $tags, $num_query_posts, $orderby); ?>

				<ul class="clearfix">
					<?php $num_post = 0; ?>
					<?php while($related_posts->have_posts()): $related_posts->the_post(); ?>
			    		<?php if(has_post_thumbnail()): $num_post++; ?>
			      			<li>
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>"><?php echo get_the_post_thumbnail($post->ID, 'thumbnail', array('title' => the_title('','',false))); ?></a>
	  	  		  	  		</li>
						<?php endif; ?>
						<?php if ( $num_post == $num_posts ) : break; endif; ?>
				  	<?php endwhile; ?>
				</ul>

				<?php if ($related_posts->have_posts()) echo ''; else echo __('No related posts were found','color-theme-framework');
			else : echo __('No related posts were found','color-theme-framework');
			endif;

		// else, show related posts by category
		else :
			if ( is_category() ) :
				$current_category = single_cat_title('', false);
				$related_category_id = get_cat_ID($current_category);
			else :
				$related_category = get_the_category($post->ID);
				$related_category_id = get_cat_ID( $related_category[0]->cat_name );			
			endif;
	  		$related_posts = new WP_Query(array(	'orderby'				=> $orderby,
	  												'showposts'				=> $num_query_posts,
	  												'post_type'				=> 'post',
	  												'cat'					=> $related_category_id,
	  												'ignore_sticky_posts'	=> 1,
	  												'post__not_in'			=> array( $post->ID )
	  											));

			if ($related_posts->have_posts()) : ?>

				<ul class="clearfix">
					<?php $num_post = 0; ?>
					<?php while($related_posts->have_posts()): $related_posts->the_post(); ?>
			    		<?php if(has_post_thumbnail()): $num_post++; ?>
			      			<li>
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>"><?php echo get_the_post_thumbnail($post->ID, 'thumbnail', array('title' => the_title('','',false))); ?></a>
	  	  		  	  		</li>
						<?php endif; ?>
						<?php if ( $num_post == $num_posts ) : break; endif; ?>
				  	<?php endwhile; ?>
				</ul>	
			<?php
			else : echo __('No related posts were found','color-theme-framework');
			endif;
		endif; ?>

		<?php
		/* After widget (defined by themes). */
		echo "\n<!-- END RELATED THUMBS WIDGET -->\n";
		echo $after_widget;

	 	// Restor original Query & Post Data
		wp_reset_postdata();
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['num_query_posts'] = $new_instance['num_query_posts'];
		$instance['show_random'] = $new_instance['show_random'];
		$instance['posts_by'] = $new_instance['posts_by'];
		$instance['background_title'] = strip_tags($new_instance['background_title']);
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array(	'title'				=> __( 'Related Thumbs' , 'color-theme-framework' ),
							'num_posts'			=> '4',
							'num_query_posts'	=> '10',
							'show_random'		=> 'off',
							'posts_by'			=> 'tags',
							'background_title'	=> '#ff0000'
					);
		
		$instance = wp_parse_args((array) $instance, $defaults);
		$background_title = esc_attr($instance['background_title']); ?>

		<script type="text/javascript">
		//<![CDATA[
			jQuery(document).ready(function($) {  
				$('.ct-color-picker').wpColorPicker();
			});
		//]]>   
		</script>	

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts to display:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
			<i style=" font-size: 11px; color: #777; ">Will display only posts with Featured images</i>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_query_posts'); ?>"><?php _e( 'Number of posts in query:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_query_posts'); ?>" name="<?php echo $this->get_field_name('num_query_posts'); ?>" value="<?php echo $instance['num_query_posts']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_random'], 'on'); ?> id="<?php echo $this->get_field_id('show_random'); ?>" name="<?php echo $this->get_field_name('show_random'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_random'); ?>"><?php _e( 'Random order' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'posts_by' ); ?>"><?php _e('Show related posts by:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'posts_by' ); ?>" name="<?php echo $this->get_field_name( 'posts_by' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'tags' == $instance['posts_by'] ) echo 'selected="selected"'; ?>>tags</option>
				<option <?php if ( 'category' == $instance['posts_by'] ) echo 'selected="selected"'; ?>>category</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" />
		</p>
		
	<?php 
	}
}
?>