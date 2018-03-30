<?php
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'widgets_init', 'gorilla_recent_post_with_thumbs' );

function gorilla_recent_post_with_thumbs() {
	register_widget( 'gorilla_recent_post_with_thumbs_widget' );
}

class gorilla_recent_post_with_thumbs_widget extends WP_Widget {

	//parameters
	function __construct() {
		parent::__construct(
			'gorilla_recent_post_with_thumbs_widget', // Base ID
			__( 'Alison - Latest Post w/ Thumbs', 'alison' ), // Name
			array(
				'description' => __( 'Allows you to display recent posts with featured image', 'alison' ), 
				'classname' => 'gorilla_recent_post_with_thumbs_widget',
				'width' => 250,
		    	'height' => 250
			) 
		);
	}


	//widget main
	public function widget ($args,$instance) {
	  extract($args);

	  if(empty($instance)){
		$instance = array( 'title' => 'Latest Posts');
	  }

	  $title = $instance['title'];
	  $numberposts = $instance['numberposts'];
	  $showdate = $instance['showdate'];

	  // retrieve posts information from database
	  $query = array(
		  'posts_per_page' => $numberposts,
		  'nopaging' => 0,
		  'post_status' => 'publish',
		  'ignore_sticky_posts' => 1,
		  'tax_query' => array(
		    array(
		      'taxonomy' => 'post_format',
		      'field' => 'slug',
		      'terms' => array('post-format-link', 'post-format-quote' ),
		      'operator' => 'NOT IN'
		    )
		  )
		);
	  $posts = new WP_Query($query);

	   $out = '<ul>';

	  while ($posts->have_posts()) : $posts->the_post();

	  	if(has_post_thumbnail()) {
	  		$thumb = '<div class="thumb size_50_50"><a href="'.get_permalink().'">'. get_the_post_thumbnail($posts->ID, 'thumbnail') . '</a></div>' ;
	  	}
	  	else { 
	  		$thumb = '<div class="thumb size_50_50"><a href="'.get_permalink().'"><img src="'. get_template_directory_uri() .'/assets/img/thumb-placeholder.png"/></a></div>'; 
	  	}

		$out .= '<li><div class="clearfix">'. $thumb . '<div class="recent_post_text"><a href="'.get_permalink().'" class="recent_post_widget_header">'.get_the_title().'</a>';
		if ($showdate) { $out .= '<span class="post-date">'.get_the_date().'</span>'; }
		$out .= '</div></div></li>';

	  endwhile;
	  $out .= '</ul>';
	  
	  //print the widget for the sidebar
	  echo wp_kses($before_widget, wp_kses_allowed_html( 'post' ));
	  echo wp_kses($before_title, wp_kses_allowed_html( 'post' )).wp_kses($title, wp_kses_allowed_html( 'post' )).wp_kses($after_title, wp_kses_allowed_html( 'post' ));
	  echo wp_kses($out, wp_kses_allowed_html( 'post' ));
	  echo wp_kses($after_widget, wp_kses_allowed_html( 'post' ));
	  wp_reset_postdata();
	 }

	 //update
	public function update ($new_instance, $old_instance) {
	  $instance = $old_instance;

	  $instance['numberposts'] = $new_instance['numberposts'];
	  $instance['title'] = $new_instance['title'];
	  $instance['showdate'] = $new_instance['showdate'];

	  return $instance;
	}

	//form in widget update area
	public function form ($instance) {
		/* Set up some default widget settings. */
		$defaults = array('numberposts' => '5', 'title'=>'','showdate'=>''); // cat id'yi sildim
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
			<input class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?> " value="<?php echo esc_attr($instance['title']); ?>" size="20">
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('numberposts')); ?>">Number of posts:</label>
			<select id="<?php echo esc_attr($this->get_field_id('numberposts')); ?>" name="<?php echo esc_attr($this->get_field_name('numberposts')); ?>">
			<?php for ($i=1;$i<=20;$i++) {
			     echo '<option value="'.$i.'"';
			     if ($i==$instance['numberposts']) echo ' selected="selected"';
			     echo '>'.$i.'</option>';
			    } ?>
			</select>
		</p>

		<p>
		<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('showdate')); ?>" name="<?php echo esc_attr($this->get_field_name('showdate')); ?>" <?php if ($instance['showdate']) echo 'checked="checked"' ?> />
		<label for="<?php echo esc_attr($this->get_field_id('showdate')); ?>">Show Date?</label>
		</p>

	<?php
	}
}
?>