<?php if(! defined('ABSPATH')){ return; }

/**
 * Tag cloud widget class
 *
 * @since 2.8.0
 */
class ZN_Widget_Tag_Cloud extends WP_Widget
{

	function __construct()
	{
		$widget_ops = array ( 'description' => __( "Your most used tags in cloud format", 'zn_framework' ) );
		parent::__construct( 'tag_cloud', __( 'Tag Cloud', 'zn_framework' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		$before_widget = $before_title = $after_title =  $after_widget = '';

		extract( $args );
		$current_taxonomy = $this->_get_current_taxonomy( $instance );
		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __( 'Tags', 'zn_framework' );
			}
			else {
				$tax   = get_taxonomy( $current_taxonomy );
				$title = $tax->labels->name;
			}
		}
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		echo '<div class="tagcloud">';
		wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', array (
			'taxonomy' => $current_taxonomy,
			'smallest' => '75',
			'largest'  => '200',
			'unit'     => '%'
		) ) );
		echo "</div>\n";
		echo $after_widget;
	}

	function update( $new_instance, $old_instance )
	{
		$instance['title']    = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['taxonomy'] = stripslashes( $new_instance['taxonomy'] );
		return $instance;
	}

	function form( $instance )
	{
		$current_taxonomy = $this->_get_current_taxonomy( $instance );
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'zn_framework' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				   name="<?php echo $this->get_field_name( 'title' ); ?>"
				   value="<?php if ( isset ( $instance['title'] ) ) {
					   echo esc_attr( $instance['title'] );
				   } ?>"/></p>
		<p><label
			for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e( 'Taxonomy:', 'zn_framework' ) ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>"
				name="<?php echo $this->get_field_name( 'taxonomy' ); ?>">
			<?php foreach ( get_taxonomies() as $taxonomy ) :
				$tax = get_taxonomy( $taxonomy );
				if ( ! $tax->show_tagcloud || empty( $tax->labels->name ) ) {
					continue;
				}
				?>
				<option
					value="<?php echo esc_attr( $taxonomy ) ?>" <?php selected( $taxonomy, $current_taxonomy ) ?>><?php echo $tax->labels->name; ?></option>
			<?php endforeach; ?>
		</select></p><?php
	}

	function _get_current_taxonomy( $instance )
	{
		if ( ! empty( $instance['taxonomy'] ) && taxonomy_exists( $instance['taxonomy'] ) ) {
			return $instance['taxonomy'];
		}

		return 'post_tag';
	}
}
function register_widget_ZN_Widget_Tag_Cloud(){
	register_widget( "ZN_Widget_Tag_Cloud" );
}
add_action( 'widgets_init', 'register_widget_ZN_Widget_Tag_Cloud' );
