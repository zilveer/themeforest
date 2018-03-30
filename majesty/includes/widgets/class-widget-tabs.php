<?php
/*
 * Tabs Widget
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Widget_Tabs::register_this_widget');

class Sama_Widget_Tabs extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget_blog_tab',
				'description' => esc_html__( 'A tabbed Widgets that display popular posts by comments, recent posts, recent comments and tags.', 'theme-majesty')
		);
		
		parent::__construct('widget_blog_tab', 'SAMA :: '. esc_html__('Tabs', 'theme-majesty'), $widget_ops);
		
	}
	
	static function register_this_widget () {
		register_widget(__class__);
	}
	
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget ($args, $instance) {
	
		extract($args);
		
		$title_popular      = apply_filters( 'widget_title', $instance['title_popular'] );
		$title_recent       = apply_filters( 'widget_title', $instance['title_recent'] );		
		echo $before_widget;
		$id = rand(1,9999);
		?>
		<div id="tabs-widget-<?php echo absint($id); ?>" class="theme-tabs majesty_tab" role="tablist">
			<ul class="nav nav-tabs" id="myTab">
				<li class="active">
					<a href="#tab1" title="<?php echo esc_attr( $title_popular ); ?>" role="tab" data-toggle="tab" aria-expanded="true"><?php echo esc_attr( $title_popular ); ?></a>
                </li>
                <li>                           
                    <a href="#tab2" title="<?php echo esc_attr( $title_recent ); ?>" role="tab"><?php echo esc_attr( $title_recent ); ?></a>
                </li>
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab1" role="tabpanel">
					<div class="text-content blog-img">
						<?php
							$query_popular 	= new WP_Query( array( 'orderby' => 'comment_count', 'posts_per_page' => 4, 'ignore_sticky_posts' => -1 ) );
							while ( $query_popular->have_posts() ) : $query_popular->the_post();
						?>
							<div class="media">
								<a href="<?php the_permalink(); ?>" class="post-title" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail('majesty-thumb-60'); ?>
								</a>
								<div class="media-body">
									<p class="media-heading">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										<span class="post-date"><?php sama_output_html5_time_format(); ?></span>
									</p>
								</div>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					
					</div>
				</div>
				<div class="tab-pane fade recent-post" id="tab2" role="tabpanel">
					<div class="text-content blog-img">
					<?php
						$query_recent 	= new WP_Query( array( 'orderby' => 'date', 'posts_per_page' => 4, 'ignore_sticky_posts' => -1 ) );
						while ( $query_recent->have_posts() ) : $query_recent->the_post();
					?>
						<div class="media">
							<a href="<?php the_permalink(); ?>" class="post-title" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail('majesty-thumb-60'); ?>
							</a>
							<div class="media-body">
								<p class="media-heading">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									<span class="post-date"><?php sama_output_html5_time_format(); ?></span>
								</p>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
		
	<?php 
	
		echo $after_widget;
	}
	
	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update ($new_instance, $old_instance) {
		
		$instance 	= $old_instance;
		
		$instance['title_popular']     = esc_attr($new_instance['title_popular']);
		$instance['title_recent']      = esc_attr($new_instance['title_recent']);

		return $instance;		
	}
	
	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form ($instance) {
	
		$defaults = array(  
						'title_popular'  => esc_html__('Popular', 'theme-majesty'), 
						'title_recent' 	 => esc_html__('Recent', 'theme-majesty'),
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id('title_popular'); ?>"><?php esc_html_e( 'Tab 1 Title:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('title_popular'); ?>" id="<?php echo $this->get_field_id('title_popular'); ?>" value="<?php echo esc_attr($instance['title_popular']); ?>" size="20" /></p>
		
		<p><label for="<?php echo $this->get_field_id('title_recent'); ?>"><?php esc_html_e( 'Tab 2 Title:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('title_recent'); ?>" id="<?php echo $this->get_field_id('title_recent'); ?>" value="<?php echo esc_attr($instance['title_recent']); ?>" size="20" /></p>		
						
	<?php
	}

} // End of class