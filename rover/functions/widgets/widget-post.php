<?php
/*
 * @package by Theme Record
 * @auther: MattMao
*/

class theme_widget_post extends WP_Widget 
{
	public $widget_cssclass;
	public $widget_description;
	public $widget_id;
	public $widget_name;

	#
	#Constructor
	#
	public function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass      = 'widget-blog widget-post';
		$this->widget_description   = __('This widget will display a post section.', 'TR');
		$this->widget_id            = THEME_SLUG. '_post';
		$this->widget_name          = sprintf( __( '%1$s %2$s', 'TR' ), THEME_NAME, __( '&raquo; Posts', 'TR' ) );

		$widget_ops = array( 
			'classname'   => $this->widget_cssclass, 
			'description' => $this->widget_description 
		);
		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );
	}


	#
	#Form
	#
	function form($instance) 
	{
		$instance = wp_parse_args((array) $instance, array( 
			'title' => 'Posts',
			'showposts' => 3,
			'cat' => '',
			'orderby' => 'date'
		));
		$title = strip_tags($instance['title']);
		$showposts = strip_tags($instance['showposts']);
		$cat = strip_tags($instance['cat']);
		$orderby = strip_tags($instance['orderby']);
		?>
		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</div>

		<div class="theme-widget-wrap">
		<label for="<?php echo $this->get_field_id( 'showposts' ); ?>"><?php _e('Showposts:','TR'); ?></label>
		<input  id="<?php echo $this->get_field_id( 'showposts' ); ?>" name="<?php echo $this->get_field_name( 'showposts' ); ?>" type="text" value="<?php echo esc_attr( $showposts ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Cats:','HK'); ?></label>
			<textarea  id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>"  rows="3"><?php echo esc_attr( $cat ); ?></textarea>
			<p class="theme-description"><?php _e('Category IDs, separated by commas.', 'TR'); ?></p>
		</div>

		<div class="theme-widget-wrap">
		<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e('Orderby:','TR'); ?></label>
		<select name="<?php echo $this->get_field_name('orderby'); ?>">
			<option value="date" <?php selected('date', $orderby); ?>><?php _e('Date','TR'); ?></option>
			<option value="comment_count" <?php selected('comment_count', $orderby); ?>><?php _e('Comment','TR'); ?></option>
			<option value="rand" <?php selected('rand', $orderby); ?>><?php _e('Rand','TR'); ?></option>
		</select>
		</div>
		<?php
	}	


	#
	#Update & save the widget
	#
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;	
		foreach($new_instance as $key=>$value)
		{
			$instance[$key]	= strip_tags($new_instance[$key]);
		}
		return $instance;
	}


	#
	#Prints the widget
	#
	function widget($args, $instance) 
	{
		extract($args, EXTR_SKIP);
		$title = $instance['title'];
		$showposts = $instance['showposts'];
		$cat = $instance['cat'];
		$orderby = $instance['orderby'];
		$post_id = get_the_ID();

		if($cat)
		{
			$args = array( 
					'cat' => $cat,
					'posts_per_page' => $showposts,
					'orderby' => $orderby,
					'post_status' => 'publish', 
					'ignore_sticky_posts' => 1, 
					'post__not_in' => array($post_id)
			);
		}
		else
		{
			$args = array( 
					'post_type' => 'post',
					'posts_per_page' => $showposts,
					'orderby' => $orderby,
					'post_status' => 'publish', 
					'ignore_sticky_posts' => 1, 
					'post__not_in' => array($post_id)
			);
		}
		$query = new WP_Query( $args );
	?>
	<?php echo $before_widget; ?>
	<?php echo $before_title . $title . $after_title; ?>
	<ul>
	<?php while ($query->have_posts()) : $query->the_post(); ?>
	<li class="clearfix">
	<div class="alignleft date"><?php the_time('d'); ?><span><?php the_time('M'); ?></span></div>
	<div class="post-entry">
	<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'TR' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
	<p class="meta">
	<?php comments_popup_link(__('0 Comment', 'TR'), __('1 Comment', 'TR'), __('% Comments', 'TR')); ?>
	</p>
	</div>
	</li>
	<?php endwhile; wp_reset_postdata(); ?>
	</ul>
	<?php echo $after_widget; ?>
	<?php
	}
}

register_widget( 'theme_widget_post' );
?>