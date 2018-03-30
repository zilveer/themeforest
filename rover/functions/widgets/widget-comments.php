<?php
/*
 * @package by Theme Record
 * @auther: MattMao
*/

class theme_widget_comments extends WP_Widget 
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
		$this->widget_cssclass      = 'widget-comments widget-post';
		$this->widget_description   = __('This widget will display a comments section.', 'TR');
		$this->widget_id            = THEME_SLUG. '_comments';
		$this->widget_name          = sprintf( __( '%1$s %2$s', 'TR' ), THEME_NAME, __( '&raquo; Comments', 'TR' ) );

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
			'title' => 'Comments',
			'showposts' => 3,
			'avatar' => 'true'
		));
		$title = strip_tags($instance['title']);
		$showposts = strip_tags($instance['showposts']);
		$avatar = strip_tags($instance['avatar']);
		?>
		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</div>

		<div class="theme-widget-wrap">
		<label for="<?php echo $this->get_field_id( 'showposts' ); ?>"><?php esc_html_e('Showposts:','TR'); ?></label>
		<input  id="<?php echo $this->get_field_id( 'showposts' ); ?>" name="<?php echo $this->get_field_name( 'showposts' ); ?>" type="text" value="<?php echo esc_attr( $showposts ); ?>" />
		</div>

		<div class="theme-widget-wrap">
		<label for="<?php echo $this->get_field_id('avatar'); ?>">
		<input type="checkbox" name="<?php echo $this->get_field_name('avatar'); ?>" <?php checked('true', $avatar); ?> value="true" />
		<em><?php esc_html_e('Display with avatar.','TR'); ?></em>
		</label>
		</div>
		<?php
	}	


	#
	#Update & save the widget
	#
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;	
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['showposts'] = strip_tags($new_instance['showposts']);
		$instance['avatar'] = strip_tags($new_instance['avatar']);
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
		$avatar = $instance['avatar'];	
		$my_email = get_option('admin_email'); 

		$args = array(
			'status' => 'approve',
			'type' => 'comment',
			//'post_type' => array('post', 'page', 'portfolio', 'product'),
			'number' => $showposts
		);

		$comments = get_comments($args);
	?>
	<?php echo $before_widget; ?>
	<?php echo $before_title . $title . $after_title; ?>
	<ul>
	<?php foreach ($comments as $comment) : ?>
		<?php if ($comment->comment_author_email != $my_email) : ?>
		<li class="clearfix">
		<?php if($avatar == 'true') : ?>
		<div class="alignleft post-thumb">
			<a href="<?php echo get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID; ?>">
			<?php echo get_avatar($comment->comment_author_email,45); ?>
			</a>
		</div>
		<?php endif; ?>
		<div class="post-entry">
			<h1 class="title"><?php echo $comment->comment_author; ?>:
			<a href="<?php echo get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID; ?>"><?php echo theme_max_char($comment->comment_content, 36,' '); ?></a>
			</h1>
			<p class="meta"><?php echo $comment->comment_date; ?></p>
		</div>
		</li>
		<?php endif; ?>
	<?php endforeach; wp_reset_postdata(); ?>
	</ul>
	<?php echo $after_widget; ?>
	<?php
	}
}

register_widget( 'theme_widget_comments' );
?>