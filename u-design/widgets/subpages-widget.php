<?php
/**
 * Widget Name: U-Design: Subpages Widget
 * Description: A widget that allows a Subpages to be added to a sidebar.
 * Version: 0.1
 *
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'subpages_load_widgets' );

/**
 * Register our widget.
 * 'Subpages_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function subpages_load_widgets() {
	register_widget( 'Subpages_Widget' );
}

/**
 * Subpages Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Subpages_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	public function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_subpages', 'description' => esc_html__('Display subpages if present page only.', 'udesign') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'subpages-widget' );

		/* Create the widget. */
		parent::__construct( 'subpages-widget', esc_html__('U-Design: Subpages', 'udesign'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	public function widget( $args, $instance ) {
		extract( $args );

                global $post;
                // get the page id outside the loop (check if WPML plugin is installed and use the WPML way of getting the page ID in the current language)
                $page_id = ( function_exists('icl_object_id') && function_exists('icl_get_default_language') ) ? icl_object_id($post->ID, 'page', true, ICL_LANGUAGE_CODE) : $post->ID;
		$curr_page_parent = $post->post_parent;

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );

		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

		if ( $sortby == 'menu_order' ) {
			$sortby = 'menu_order, post_title';
                }


		/* Display the subpages: */
		$child_of = ( $curr_page_parent ) ? $curr_page_parent : $page_id;
                
		/**
		 * Filter the arguments for the 'U-Design: Subpages' widget.
		 *
		 * @since 2.7.5
		 *
		 * @see wp_list_pages()
		 *
		 * @param array $args An array of arguments to retrieve the pages list.
		 */
		$children = wp_list_pages( apply_filters( 'udesign_get_subpages_widget_args', array(
			'title_li'    => '',
			'echo'        => 0,
			'sort_column' => $sortby,
			'exclude'     => $exclude,
			'child_of'    => $child_of
		) ) );
                
                
                
		if ( $children ) :

		    echo $before_widget;
		    /* Display the widget title if one was input, if not display the parent page title instead. */
		    if ( $title ) :
			    echo $before_title . $title . $after_title;
		    else : ?>
			    <h3><?php $parent = get_post($post->post_parent); echo $parent->post_title; ?></h3>
<?php		    endif; ?>
		    <ul>
<?php			echo $children; ?>
		    </ul>

<?php		    /* After widget (defined by themes). */
		    echo $after_widget;
		endif; 



	}

	/**
	 * Update the widget settings.
         * 
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'sortby' => 'menu_order', 'title' => '', 'exclude' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$exclude = esc_attr( $instance['exclude'] ); ?>

		<!-- Widget Title: Text Input -->
		<p>
		    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'udesign'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		    <br />
		    <?php esc_html_e('Leave the Title field blank if you would like to display the parent page Title instead.', 'udesign'); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Sort by:', 'udesign' ); ?></label>
			<select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php _e('Page title', 'udesign'); ?></option>
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php _e('Page order', 'udesign'); ?></option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Page ID', 'udesign' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude:', 'udesign' ); ?></label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" class="widefat" />
			<br />
			<small><?php _e( 'Page IDs, separated by commas.', 'udesign' ); ?></small>
		</p>
<?php
	}
}

