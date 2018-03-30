<?php
/**
 * Blog Functions
 */

/**********************************
 * CONTENT OUTPUT
 **********************************/

/*
 * Output featured image for archives or single post
 * If single post, uses featured image for that post
 * If no featured image or if is archive, uses featured image from page using Blog template
 */
 
if ( ! function_exists( 'risen_blog_header_image' ) ) {

	function risen_blog_header_image( $return = false ) {
		
		global $post;
		
		$use_template_image = false;
	
		// Single post
		if ( is_singular( 'post' ) ) {
		
			// Has its own featured image
			if ( ! empty( $post->ID ) && has_post_thumbnail() ) {
				$use_post_id = $post->ID;
			}
			
			// Use image from Multimedia template if Theme Options allows
			else if ( risen_option( 'blog_header_image_single' ) ) {
				$use_template_image = true;
			}
		
		}
		
		// Archive
		else if ( risen_option( 'blog_header_image_archives' ) ) {
			$use_template_image = true;
		}
		
		// Image from Multimedia template
		if ( $use_template_image ) {
		
			// get (newest) page using Multimedia template
			$page = risen_get_page_by_template( 'tpl-blog.php' );
			
			// show featured image from that page
			if ( ! empty( $page->ID ) ) {
				$use_post_id = $page->ID;
			}
		
		}
		
		// Return image HTML
		if ( ! empty( $use_post_id ) ) {
		
			$thumbnail = get_the_post_thumbnail( $use_post_id, 'risen-header', array ( 'class' => 'page-header-image', 'title' => '' ) );
			
			if ( $return ) {
				return $thumbnail;
			} else {
				echo $thumbnail;
			}
			
		}
		
	}
	
}

/**********************************
 * WIDGETS
 **********************************/

/**
 * Recent Posts
 *
 * This replaced the default Standard Posts widget, adding options to show author, date, excerpt and thumbnail
 */

if ( ! class_exists( 'Risen_Posts_Widget' ) ) {

	class Risen_Posts_Widget extends WP_Widget {

		// Register widget with WordPress
		public function __construct() {
		
			parent::__construct(
				'risen-posts',
				_x( 'Recent Posts (Enhanced)', 'posts widget', 'risen' ),
				array(
					'description' => _x( 'Shows recent blog posts with enhanced display options.', 'posts widget', 'risen' )
				)			
			);

		}

		// Back-end widget form
		public function form( $instance ) {

			// Set defaults
			$instance = wp_parse_args( (array) $instance, array(
				'title' => _x( 'Recent Posts', 'posts widget', 'risen' ),
				'limit' => '5', // also change in update(),
				'author' => '',
				'date' => '',
				'excerpt' => '',
				'image' => ''
			) );

			?>
			
			<?php $field = 'title'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Title:', 'risen' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $instance[$field] ); ?>" />
			</p>
			
			<?php $field = 'limit'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Number of items to show:', 'risen' ); ?></label> 
				<input style="width:40px;" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $instance[$field] ); ?>" />
			</p>
			
			<p>
				
				<?php $field = 'author'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show author', 'risen' ); ?>
				</label>
				
				<br />
				
				<?php $field = 'date'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show date', 'risen' ); ?>
				</label>
				
				<br />
			
				<?php $field = 'excerpt'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show excerpt', 'risen' ); ?>
				</label>
				
				<br />
				
				<?php $field = 'image'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show image (homepage only)', 'risen' ); ?>
				</label>
				
			</p>
			
			<?php
			
		}

		// Sanitize widget form values as they are saved
		public function update( $new_instance, $old_instance ) {

			$instance = array();
			
			$instance['title'] = trim( strip_tags( $new_instance['title'] ) );
			$instance['limit'] = isset( $new_instance['limit'] ) && (int) $new_instance['limit'] > 0 ? (int) $new_instance['limit'] : 5; // default if not positive number
			$instance['author'] = ! empty( $new_instance['author'] ) ? '1' : '';
			$instance['date'] = ! empty( $new_instance['date'] ) ? '1' : '';
			$instance['excerpt'] = ! empty( $new_instance['excerpt'] ) ? '1' : '';
			$instance['image'] = ! empty( $new_instance['image'] ) ? '1' : '';

			return $instance;
			
		}
		
		// Front-end display of widget
		public function widget( $args, $instance ) {
		
			global $post;

			// HTML Before
			echo $args['before_widget'];
			
			// Title
			$title = apply_filters( 'widget_title', $instance['title'] );
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			
			// Get Posts
			$posts = get_posts( array(
				'numberposts'     	=> $instance['limit'],
				'orderby'         	=> 'post_date', // newest first
				'order'           	=> 'DESC',
				'suppress_filters'	=> false // help multilingual
			) );
			
			// Loop Posts
			$i = 0;
			foreach( $posts as $post ) : setup_postdata( $post ); $i++;
			?>
			
			<article class="blog-widget-post<?php if ( 1 == $i ) : ?> blog-widget-post-first<?php endif; ?>">
			
				<?php if ( is_home() && ! empty( $instance['image'] ) && has_post_thumbnail() ) : ?>
				<div class="image-frame blog-widget-post-thumb widget-thumb">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'risen-tiny-thumb', array( 'title' => '' ) ); ?></a>
				</div>
				<?php endif; ?>
				
				<header>

					<h1 class="blog-widget-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

					<?php if ( ! empty( $instance['author'] ) ) : ?>
					<div class="blog-widget-post-author">
					<?php
					printf(
						_x( 'by <a href="%1$s">%2$s</a>', 'blog widget author', 'risen'),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), // author URL
						get_the_author() // author name
					);
					?>
					</div>
					<?php endif; ?>
				
					<div>
					
						<?php if ( ! empty( $instance['date'] ) ) : ?>
						<time class="blog-widget-post-date" datetime="<?php the_time( 'c' ); ?>"><?php echo risen_date_ago( get_the_time( 'U' ), 5 ); // show up to "5 days ago" but actual date if older ?></time>
						<?php endif; ?>
						
					</div>
					
				</header>
				
				<?php if ( get_the_excerpt() && ! empty( $instance['excerpt'] )): ?>
				<div class="blog-widget-post-excerpt">
					<?php the_excerpt(); ?>
				</div>
				<?php endif; ?>
				
				<div class="clear"></div>
				
			</article>
			
			<?php
			
			// End Loop
			endforeach;
			
			// HTML After
			echo $args['after_widget'];

		}

	}
	
}
