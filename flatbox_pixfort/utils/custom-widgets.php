<?php

if (class_exists('WP_Widget')) {

	class flatbox_Flickr extends WP_Widget {
		public function __construct() {
			$widget_ops = array('description' => __( 'Display your latest Flickr photostream', 'flatbox') );
			parent::__construct(false, __('Wenak Flickr Widget', 'flatbox'),$widget_ops);
		}

		/**
		 * Displays the widget contents.
		 */
		public function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters( 'widget_title', $instance['title'] );

			echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];

			$photos = $this->get_photos( array(
				'userid' => $instance['userid'],
				'count' => $instance['count']
			) );

			if ( is_wp_error( $photos ) ) {
				echo $photos->get_error_message();
			} else {
				foreach ( $photos as $photo ) {
					$link = esc_url( $photo->link );
					$src = str_replace("_m.","_s.",esc_url( $photo->media->m ));
					$title = esc_attr( $photo->title );

					global $smof_data;
					$animation = $smof_data['css3_animation_attribs'];
					$item = sprintf( '<a href="%s" title="%s"%s><img src="%s" alt="%s" /></a>', $link, $title, $animation, $src, $title );
					$item = sprintf( '<div class="flickr-image">%s</div>', $item );
					echo $item;
				}
			}

			echo $args['after_widget'];
		}

		/**
		 * Returns an array of photos on a WP_Error.
		 */
		private function get_photos( $args = array() ) {
			$transient_key = md5( 'flatbox-flickr-cache-' . print_r( $args, true ) );
			$cached = get_transient( $transient_key );
			if ( $cached ) return $cached;

			$userid = isset( $args['userid'] ) ? $args['userid'] : '';
			$count = isset( $args['count'] ) ? absint( $args['count'] ) : 10;
			$query = array(
				'id' => $userid
			);

			$photos = $this->request_feed( 'photos_public', $query );

			if ( ! $photos )
				return new WP_Error( 'error', 'Could not fetch photos.' );

			$photos = array_slice( $photos, 0, $count );
			set_transient( $transient_key, $photos, apply_filters( 'flatbox_flickr_widget_cache_timeout', 3600 ) );
			return $photos;
		}

		/**
		 * Fetch items from the Flickr Feed API.
		 */
		private function request_feed( $feed = 'photos_public', $args = array() ) {
			$args['format'] = 'json';
			$args['nojsoncallback'] = 1;
			$url = sprintf( 'http://api.flickr.com/services/feeds/%s.gne', $feed );
			$url = esc_url_raw( add_query_arg( $args, $url ) );

			$response = wp_remote_get( $url, array('timeout' => 10) );
			if ( is_wp_error($response) || ! isset($response['body']) )
				return false;
			
			$body = wp_remote_retrieve_body( $response );
			$body = preg_replace( "#\\\\'#", "\\\\\\'", $body );
	 		$obj = json_decode( $body );

			return $obj ? $obj->items : false;

		}

		/**
		 * Validate and update widget options.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['userid'] = strip_tags( $new_instance['userid'] );
			$instance['count'] = absint( $new_instance['count'] );
			return $new_instance;
		}

		/**
		 * Render widget controls.
		 */
		public function form( $instance ) {
			$title = isset( $instance['title'] ) ? $instance['title'] : __( 'Photos from Flickr', 'flatbox');
			$userid = isset( $instance['userid'] ) ? $instance['userid'] : '';
			$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 6;
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'flatbox' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'userid' ); ?>"><?php _e( 'User ID:', 'flatbox' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'userid' ); ?>" name="<?php echo $this->get_field_name( 'userid' ); ?>" type="text" value="<?php echo esc_attr( $userid ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count:', 'flatbox' ); ?></label><br />
				<input type="number" min="1" max="20" value="<?php echo esc_attr( $count ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
			</p>

			<?php
		}
	}
	register_widget('flatbox_Flickr');

	class flatbox_Recent_Posts extends WP_Widget {

		function __construct() {
			$widget_ops = array('description' => __( 'Custom most recent posts on your site', 'flatbox' ) );
			parent::__construct(false, __( 'flatbox Recent Posts', 'flatbox' ),$widget_ops);

			add_action( 'save_post', array($this, 'flush_widget_cache') );
			add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		}

		function widget($args, $instance) {
			$cache = wp_cache_get('widget_recent_posts', 'widget');

			if ( !is_array($cache) )
				$cache = array();

			if ( ! isset( $args['widget_id'] ) )
				$args['widget_id'] = $this->id;

			if ( isset( $cache[ $args['widget_id'] ] ) ) {
				echo $cache[ $args['widget_id'] ];
				return;
			}

			ob_start();
			extract($args);

			$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Recent Posts', 'flatbox') : $instance['title'], $instance, $this->id_base);
			if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
	 			$number = 10;
			$show_meta = isset( $instance['show_meta'] ) ? $instance['show_meta'] : false;
			$show_thumb = isset( $instance['show_thumb'] ) ? $instance['show_thumb'] : false;

			$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
			if ($r->have_posts()) :
	?>
			<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<div class="post-item clearfix">
<?php if ( $show_thumb ) :
			global $smof_data;
			$animation = $smof_data['css3_animation_class'];
			if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) {
				if (function_exists('aq_resize')) {
					$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
					$thumb_image_url = aq_resize( $full_image_url, 120, 120, true );
				} else {
					$thumb_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
					$thumb_image_url = $thumb_image[0];
				}
			} else {
				$thumb_image_url = get_template_directory_uri().'/img/120x120.gif';
			} ?>
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ); ?>" class="left-image"><img src="<?php echo $thumb_image_url; ?>" class="scale<?php echo $animation; ?>" alt="" /></a>
<?php endif; ?>
				<h6 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h6>
<?php if ( $show_meta ) : ?>
				<em class="date"><span></span><?php echo get_the_date(); ?></em>
<?php 	if ( have_comments() ) : ?>
				<a href="<?php the_permalink() ?>#comments" class="comments"><?php _n( '1 comment', '%1$s comments', get_comments_number() ); ?></a>
<?php 	endif; ?>
<?php endif; ?>
			</div>
			<?php endwhile; ?>
			<?php echo $after_widget; ?>
	<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

			endif;

			$cache[$args['widget_id']] = ob_get_flush();
			wp_cache_set('widget_recent_posts', $cache, 'widget');
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = (int) $new_instance['number'];
			$instance['show_meta'] = (bool) $new_instance['show_meta'];
			$instance['show_thumb'] = (bool) $new_instance['show_thumb'];
			$this->flush_widget_cache();

			$alloptions = wp_cache_get( 'alloptions', 'options' );
			if ( isset($alloptions['widget_recent_entries']) )
				delete_option('widget_recent_entries');

			return $instance;
		}

		function flush_widget_cache() {
			wp_cache_delete('widget_recent_posts', 'widget');
		}

		function form( $instance ) {
			$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$number     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
			$show_meta  = isset( $instance['show_meta'] ) ? (bool) $instance['show_meta'] : true;
			$show_thumb = isset( $instance['show_thumb'] ) ? (bool) $instance['show_thumb'] : true;
	?>
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'flatbox' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'flatbox' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

			<p><input class="checkbox" type="checkbox" <?php checked( $show_thumb ); ?> id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Display featured thumb?', 'flatbox' ); ?></label></p>

			<p><input class="checkbox" type="checkbox" <?php checked( $show_meta ); ?> id="<?php echo $this->get_field_id( 'show_meta' ); ?>" name="<?php echo $this->get_field_name( 'show_meta' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_meta' ); ?>"><?php _e( 'Display post date and comment no?', 'flatbox' ); ?></label></p>

	<?php
		}
	}
	register_widget('flatbox_Recent_Posts');
}