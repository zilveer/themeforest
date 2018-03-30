<?php
/*
 * @package by Theme Record
 * @auther: MattMao
*/

class theme_widget_search extends WP_Widget 
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
		$this->widget_cssclass      = 'widget-search';
		$this->widget_description   = __('This widget will display a search section.', 'TR');
		$this->widget_id            = THEME_SLUG. '_search';
		$this->widget_name          = sprintf( __( '%1$s %2$s', 'TR' ), THEME_NAME, __( '&raquo; Search', 'TR' ) );

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
			'title' => 'Search'
		));
		$title = strip_tags($instance['title']);
		?>
		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
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
	?>
	<?php echo $before_widget; ?>
	<?php if($title) { echo $before_title . $title . $after_title; } ?>
	<div class="searchbox">
		<form action="<?php echo home_url('/'); ?>" method="get">
		<input type="text" class="text-file" name="s" size="24" value="" placeholder="<?php _e('Enter your keywords...', 'TR'); ?>" />
		</form>
	</div>
	<?php echo $after_widget; ?>
	<?php
	}
}

register_widget( 'theme_widget_search' );
?>