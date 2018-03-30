<?php
/*
 * @package by Theme Record
 * @auther: MattMao
*/

class theme_widget_tweets extends WP_Widget 
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
		$this->widget_cssclass      = 'widget-post widget-tweets';
		$this->widget_description   = __('This widget will display a tweets section.', 'TR');
		$this->widget_id            = THEME_SLUG. '_tweets';
		$this->widget_name          = sprintf( __( '%1$s %2$s', 'TR' ), THEME_NAME, __( '&raquo; Tweets', 'TR' ) );

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
			'title' => 'Tweets',
			'username' => '',
			'limit' => '2'
		));
		$title = strip_tags($instance['title']);
		$username = strip_tags($instance['username']);
		$limit = strip_tags($instance['limit']);
		?>
		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php esc_html_e('ID:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php esc_html_e('Limit:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
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

		// Refresh Cache
		if($old_instance['username'] != $new_instance['username']){
			delete_option(THEME_SLUG.'_tweet_cache_'.$this->id_base.'-'.$this->number);
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
		$username = $instance['username'];
		$tweet_count = $instance['limit'];
	?>
	<?php echo $before_widget; ?>
	<?php echo $before_title . $title . $after_title; ?>
	<?php
		echo '<ul class="tweets-feed clearfix">'."\n";
		echo theme_latest_tweet_posts($username, $tweet_count, $widget_id, $cache_time = 12); 
		echo '</ul>'."\n";
	?>
	<?php echo $after_widget; ?>
	<?php
	}
}

register_widget( 'theme_widget_tweets' );
?>