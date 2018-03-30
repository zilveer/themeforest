<?php
/*
 * Recent Posts Widget
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Recent_Post::register_this_widget');

class Sama_Recent_Post extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget-recent-posts',
				'description' => esc_html__( 'Display Recent posts.', 'theme-majesty')
		);
		
		parent::__construct('widget-recent-posts', 'SAMA :: '. esc_html__('Recent Posts', 'theme-majesty'), $widget_ops);
		add_action( 'save_post', array( $this, 'sama_flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'sama_flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'sama_flush_widget_cache' ) );
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
		extract( $args );
		$title      	= apply_filters( 'widget_title', $instance['title'] );
		$num    		= absint( $instance['num'] );
		$excerpt		= absint( $instance['excerptnum'] );
		$catid   		= esc_attr( $instance['catid'] );
		$args = array(
			'post_type' 			=> 'post',
			'ignore_sticky_posts' 	=> 1,
			'posts_per_page'		=> $num,
			'order'					=> 'DESC', //ASC
			'orderby'				=> 'date', 	
		);
		
		if ( ! empty( $catid ) && $catid != -1 ) {
			$args['cat'] = absint( $catid );
		}
		echo $before_widget;
		if ($title) { 
			echo $before_title . $title . $after_title;
		}
		?>
			<div class="text-content blog-img">
					<?php
						if ( ! ( $query = get_transient( $this->id ) ) ) {
							$query = new WP_Query( $args );
							set_transient( $this->id, $query, 14000 );
						}
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
						?>
							<div class="media">
								
								<a href="<?php the_permalink(); ?>" class="post-title" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail('majesty-thumb-60'); ?>
								</a>
								<div class="media-body">
									<p class="media-heading">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</p>
								    <?php 
										if( $excerpt > 0 ) {
											echo wp_kses_post(sama_get_custom_excerpt($excerpt));
										}
									?>
								</div>
							</div>
						<?php
							}
						}
						wp_reset_postdata();
					?>
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
		
		$instance 					= $old_instance;
		$instance['title']      	= esc_attr( $new_instance['title'] );
		$instance['num']      		= absint( $new_instance['num'] );
		$instance['excerptnum']     = absint( $new_instance['excerptnum'] );
		$instance['catid']   		= esc_attr( $new_instance['catid'] );
		$this->sama_flush_widget_cache();
		
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
	function form( $instance ) {
	
		$defaults = array( 
			'title'			=> '', 
			'num' 			=> '5',
			'excerptnum'	=> '8',
			'catid'			=> -1,
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('num'); ?>"><?php esc_html_e( 'Number of posts to show:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('num');?>" id="<?php echo $this->get_field_id('num');?>" value="<?php echo absint($instance['num']);?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('catid'); ?>"><?php esc_html_e( 'Category:', 'theme-majesty'); ?> </label>
			<?php wp_dropdown_categories('echo=1&class=widefat&show_option_none='.esc_html__( 'all', 'theme-majesty' ) .'&hide_empty=0&hierarchical=1&id='.$this->get_field_id('catid').'&name='.$this->get_field_name('catid').'&selected='.esc_attr(strip_tags($instance['catid']))); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('excerptnum'); ?>"><?php esc_html_e( 'Excerpt Length:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('excerptnum');?>" id="<?php echo $this->get_field_id('excerptnum');?>" value="<?php echo absint($instance['excerptnum']);?>" />
		</p>
		
	<?php
	}
	
	/**
	 * Flush the cache
	 * @return [type]
	 */
	function sama_flush_widget_cache() {
		delete_transient( $this->id );
	}

} // End of class