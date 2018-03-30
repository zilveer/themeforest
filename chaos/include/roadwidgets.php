<?php

class road_widgets extends WP_Widget {

	function __construct() {
		parent::__construct(
			'road_widgets', 
			__('Road Widgets', 'roadthemes'), 

			// Widget description
			array( 'description' => __( 'Display recent posts, comments, popular posts', 'roadthemes' ), ) 
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		global $post, $road_opt;
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
		switch ($instance['type']) {
			
			case 'recent_posts':
				$postargs = array( 'posts_per_page' => $instance['amount'], 'order'=> 'DESC', 'orderby' => 'post_date' );
				$postslist = get_posts( $postargs );
				?>
				<div class="recent-posts">
					<ul>
						<?php
						foreach ( $postslist as $post ) :
							setup_postdata( $post ); ?> 
							<li>
								<div class="post-wrapper">
									<div class="post-thumb">
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(50,50)); ?></a>
									</div>
									<div class="post-info">
										<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="post-date">
											<?php echo get_the_date(); ?>
										</div>
									</div>
								</div>
							</li>
						<?php
						endforeach;
						?>
					</ul>
				</div>
				<?php
				wp_reset_postdata();
			break;
			
			case 'popular_posts':
				$postargs = array( 'posts_per_page' => $instance['amount'], 'order'=> 'DESC', 'orderby' => 'comment_count' );
				$postslist = get_posts( $postargs );
				?>
				<div class="recent-posts">
					<ul>
						<?php
						foreach ( $postslist as $post ) :
							setup_postdata( $post ); ?> 
							<li>
								<div class="post-wrapper">
									<div class="post-thumb">
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(50,50)); ?></a>
									</div>
									<div class="post-info">
										<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="post-date">
											<?php echo get_the_date(); ?>
										</div>
									</div>
								</div>
							</li>
						<?php
						endforeach;
						?>
					</ul>
				</div>
				<?php
				wp_reset_postdata();
			break;
			
			case 'recent_comments':
				$commentargs = array(
					'status' => 'approve',
					'post_type' => 'post',
					'number' => $instance['amount']
				);
				$comments = get_comments($commentargs); ?>
				<ul>
					<?php foreach($comments as $comment) : ?>
					<li>
						<div class="post-wrapper">
							<div class="post-thumb">
								<?php echo get_avatar( $comment->comment_author_email, 50, '', '' ); ?>
							</div>
							<div class="post-info">
								<p><?php echo $comment->comment_author; ?> <?php _e('says', 'roadthemes');?>:</p>
								<a href="<?php echo get_comments_link( $comment->comment_post_ID ); ?>" title="<?php echo $comment->comment_author .' on '. get_the_title( $comment->comment_post_ID );?>"><?php echo roadlimitStringByWord($comment->comment_content, 30, '...'); ?></a>
							</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>	
				<?php	
			break;
		}
			
			
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		// Widget admin form

		if( $instance) {
			$title = $instance[ 'title' ];
			$amount = esc_attr($instance['amount']);
			$type = esc_attr($instance['type']);
		} else {
			$title = '';
			$amount = '12';
			$type = 'recent_posts';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'roadthemes' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><?php _e( 'Amount:', 'roadthemes' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" type="text" value="<?php echo esc_attr($amount); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Widget Type:', 'roadthemes' ); ?></label> 
		<select id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
			<option value="recent_posts" <?php if($type=='recent_posts') echo 'selected="selected"';?>><?php _e('Recent Posts', 'roadthemes');?></option>
			<option value="popular_posts" <?php if($type=='popular_posts') echo 'selected="selected"';?>><?php _e('Popular Posts', 'roadthemes');?></option>
			<option value="recent_comments" <?php if($type=='recent_comments') echo 'selected="selected"';?>><?php _e('Recent Comments', 'roadthemes');?></option>
		</select>
		</p>
	<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['amount'] = ( ! empty( $new_instance['amount'] ) ) ? strip_tags( $new_instance['amount'] ) : '3';
		$instance['type'] = ( ! empty( $new_instance['type'] ) ) ? strip_tags( $new_instance['type'] ) : 'recent_posts';
		return $instance;
	}
}
// Register and load the widget
function roadthemes_load_road_widgets() {
	register_widget( 'road_widgets' );
}
add_action( 'widgets_init', 'roadthemes_load_road_widgets' );