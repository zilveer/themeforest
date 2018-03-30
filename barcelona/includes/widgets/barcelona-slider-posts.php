<?php
/*
 * Slider Posts Widget
 */

if ( ! class_exists( 'Barcelona_Widget_Slider_Posts' ) ) {
	class Barcelona_Widget_Slider_Posts extends WP_Widget {

		public function __construct() {

			$widget_ops = array(
				'classname'   => 'barcelona-widget-slider-posts',
				'description' => esc_html_x( 'Displays the specified posts as a slider', 'Slider Posts widget description', 'barcelona' )
			);

			parent::__construct( 'barcelona-slider-posts', sprintf( esc_html_x( '%s Slider Posts', 'Slider Posts widget name', 'barcelona' ), BARCELONA_THEME_NAME ), $widget_ops );

			add_action( 'save_post', array($this, 'flush_widget_cache') );
			add_action( 'deleted_post', array($this, 'flush_widget_cache') );
			add_action( 'switch_theme', array($this, 'flush_widget_cache') );

		}

		public function widget( $args, $instance ) {

			$barcelona_cache = array();
			if ( ! $this->is_preview() ) {
				$barcelona_cache = wp_cache_get( 'barcelona-slider-posts', 'widget' );
			}

			if ( ! is_array( $barcelona_cache ) ) {
				$barcelona_cache = array();
			}

			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}

			if ( isset( $barcelona_cache[ $args['widget_id'] ] ) ) {
				echo wp_kses_post( $barcelona_cache[ $args['widget_id'] ] );
				return;
			}

			ob_start();

			$barcelona_post_meta_choices = is_array( $instance['post_meta_choices'] ) ? $instance['post_meta_choices'] : array();

			$barcelona_params = array(
				'no_found_rows'         => true,
				'post_status'           => 'publish',
				'ignore_sticky_posts'   => false
			);

			if ( empty( $instance['offset'] ) || ! $barcelona_params['offset'] = absint( $instance['offset'] ) ) {
				$barcelona_params['offset'] = 0;
			}

			if ( empty( $instance['number'] ) || ! $barcelona_params['posts_per_page'] = absint( $instance['number'] ) ) {
				$barcelona_params['posts_per_page'] = 5;
			}

			/*
			 * Filter Posts by Category
			 */
			if ( ! empty( $instance['category'] ) ) {
				$barcelona_params['cat'] = $instance['category'];
			}

			/*
			 * Filter Posts by Post IDs
			 */
			if ( ! empty( $instance['filter_posts'] )  ) {

				$barcelona_params['post__in'] = array_values( array_filter( array_map( function ( $v ) {

					$v = trim( $v );
					if ( ! is_numeric( $v ) || $v <= 0 ) {
						$v = false;
					}

					return $v;

				}, explode( ',', $instance['filter_posts'] ) ), function( $v ) { return is_numeric( $v ); } ) );

				if ( empty( $barcelona_params['post__in'] ) ) {
					unset( $barcelona_params['post__in'] );
				}

			}

			/*
			 * Posts Ordering
			 */
			switch ( $instance['orderby'] ) {
				case 'views':
					$barcelona_params['orderby'] = 'meta_value_num';
					$barcelona_params['meta_key'] = '_barcelona_views';
					break;
				case 'comments':
					$barcelona_params['orderby'] = 'comment_count';
					break;
				case 'votes':
					$barcelona_params['orderby'] = 'meta_value_num';
					$barcelona_params['meta_key'] = '_barcelona_vote_up';
					break;
				case 'random':
					$barcelona_params['orderby'] = 'rand';
					break;
				case 'posts':
					$barcelona_params['orderby'] = 'post__in';
					break;
				default:
					$barcelona_params['orderby'] = 'date';
			}

			$barcelona_params['order'] = ( $instance['order'] != 'asc' ) ? 'DESC' : 'ASC';

			if ( array_key_exists( 'duplication', $instance ) && $instance['duplication'] == 'on' && isset( $GLOBALS['barcelona_duplication_prevented_posts'] )  )
				$barcelona_params['post__not_in'] = $GLOBALS['barcelona_duplication_prevented_posts'];


			$barcelona_query = new WP_Query( $barcelona_params );

			$barcelona_show_title = $instance['show_title'] == 'on' ? 'on' : 'off';

			if ( $barcelona_query->have_posts() ):

				echo wp_kses_post( $args['before_widget'] );

				if ( ! empty( $instance['title'] ) ) {
					echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['title'] ) . wp_kses_post( $args['after_title'] );
				}

				$barcelona_owl_data = array(
					'controls' => '.nav-dir',
					'items' => 1,
					'autoplay' => isset( $instance['is_autoplay'] ) && $instance['is_autoplay'] ? 'true' : 'false',
					'rtl' => is_rtl() ? 'true' : 'false'
				);

				?>
				<div class="posts-box-carousel">

					<div class="owl-carousel owl-theme"<?php echo implode( array_map( function( $v, $k ) { return ' data-'. sanitize_key( $k ) .'="'. esc_attr( $v ) .'"'; }, $barcelona_owl_data, array_keys( $barcelona_owl_data ) ) ); ?>>

						<?php while ( $barcelona_query->have_posts() ) : $barcelona_query->the_post(); $barcelona_post_cat = get_the_category();

							$GLOBALS['barcelona_duplication_prevented_posts'][] = get_the_ID();
							?>
						<div class="item">

							<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
								<?php barcelona_thumbnail( 'barcelona-md-vertical' ); ?>
							</a>

							<div class="item-overlay clearfix<?php echo ( $barcelona_show_title == 'on' ) ? ' show-always' : ''; ?>">

								<div class="inner">

									<div class="post-summary post-format-<?php echo sanitize_html_class( barcelona_get_post_format() ); ?>">

										<?php if ( ! empty( $barcelona_post_cat[0] ) ): ?>
										<div class="post-cat">
											<a href="<?php echo esc_url( get_category_link( $barcelona_post_cat[0] ) ); ?>" class="label label-default">
												<?php echo esc_html( $barcelona_post_cat[0]->name ); ?>
											</a>
										</div>
										<?php endif; ?>

										<h2 class="post-title">
											<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
										</h2>

										<?php barcelona_post_meta( $barcelona_post_meta_choices ); ?>

									</div>

									<ul class="nav-dir">
										<li><button class="btn"><span class="fa fa-caret-right"></span></button></li>
										<li><button class="btn"><span class="fa fa-caret-left"></span></button></li>
									</ul>

								</div>

							</div>

						</div>
						<?php endwhile; ?>

					</div><!-- .owl-carousel -->

				</div><!-- .image-slider -->
				<?php

				echo wp_kses_post( $args['after_widget'] );

				wp_reset_postdata();

			endif;

			if ( ! $this->is_preview() ) {

				$barcelona_cache[ $args['widget_id'] ] = ob_get_flush();
				wp_cache_set( 'barcelona-slider-posts', $barcelona_cache, 'widget' );

			} else {

				ob_end_flush();

			}

		}

		public function flush_widget_cache() {

			wp_cache_delete( 'barcelona-slider-posts', 'widget' );

		}

		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title']              = strip_tags( $new_instance['title'] );
			$instance['show_title']         = $new_instance['show_title'] == 'on' ? 'on' : 'off';
			$instance['is_autoplay']        = isset( $new_instance['is_autoplay'] ) ? (bool) $new_instance['is_autoplay'] : false;
			$instance['number']             = absint( $new_instance['number'] );
			$instance['offset']             = absint( $new_instance['offset'] );
			$instance['filter_posts']       = strip_tags( $new_instance['filter_posts'] );
			$instance['category']           = $new_instance['category'];
			$instance['orderby']            = sanitize_key( $new_instance['orderby'] );
			$instance['duplication']            = sanitize_key( $new_instance['duplication'] );
			$instance['order']              = sanitize_key( $new_instance['order'] );
			$instance['post_meta_choices']  = $new_instance['post_meta_choices'];

			$this->flush_widget_cache();

			$alloptions = wp_cache_get( 'alloptions', 'options' );
			if ( isset( $alloptions['barcelona-slider-posts'] ) ) {
				delete_option( 'barcelona-slider-posts' );
			}

			return $instance;

		}

		public function form( $instance ) {

			$barcelona_title             = isset( $instance['title'] ) ? $instance['title'] : '';
			$barcelona_show_title        = ( array_key_exists( 'show_title', $instance ) && $instance['show_title'] == 'on' ) ? 'on' : 'off';
			$barcelona_is_autoplay       = isset( $instance['is_autoplay'] ) ? (bool) $instance['is_autoplay'] : false;
			$barcelona_number            = isset( $instance['number'] ) ? $instance['number'] : 5;
			$barcelona_offset            = isset( $instance['offset'] ) ? $instance['offset'] : 0;
			$barcelona_filter_posts      = isset( $instance['filter_posts'] ) ? $instance['filter_posts'] : '';
			$barcelona_category          = isset( $instance['category'] ) ? intval( $instance['category'] ) : '';
			$barcelona_orderby           = isset( $instance['orderby'] ) ? sanitize_key( $instance['orderby'] ) : 'date';
			$barcelona_duplication       = isset( $instance['duplication'] ) ? sanitize_key( $instance['duplication'] ) : 'off';
			$barcelona_order             = isset( $instance['order'] ) ? sanitize_key( $instance['order'] ) : 'desc';
			$barcelona_post_meta_choices = ( array_key_exists( 'post_meta_choices', $instance ) && is_array( $instance['post_meta_choices'] ) ) ? $instance['post_meta_choices'] : array();

			$barcelona_categories = get_categories();

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'barcelona' ); ?></label><br />
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $barcelona_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>"><?php esc_html_e( 'Display Title:', 'barcelona' ); ?></label><br />
				<select id="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_title' ) ); ?>">
					<option value="off"><?php esc_html_e( 'On Mouseover', 'barcelona' ); ?></option>
					<option value="on"<?php echo ( $barcelona_show_title == 'on' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Always', 'barcelona' ); ?></option>
				</select>
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $barcelona_is_autoplay ); ?> id="<?php echo esc_attr( $this->get_field_id( 'is_autoplay' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'is_autoplay' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'is_autoplay' ) ); ?>"><?php esc_html_e( 'Enable Autoplay', 'barcelona' ); ?></label>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'barcelona' ); ?></label><br />
				<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo absint( $barcelona_number ); ?>" size="3" class="widefat" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Posts Offset:', 'barcelona' ); ?></label><br />
				<input id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo absint( $barcelona_offset ); ?>" size="3" class="widefat" />
			</p>

			<p class="barcelona-post-duplication">
				<label for="<?php echo esc_attr( $this->get_field_id( 'duplication' ) ); ?>"><?php esc_html_e( 'Do not duplicate:', 'barcelona' ) ?></label><br />
				<select id="<?php echo esc_attr( $this->get_field_id( 'duplication' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'duplication' ) ); ?>">
					<option value="on"<?php echo ( $barcelona_duplication == 'on' ) ? ' selected' : ''; ?>><?php esc_html_e( 'On', 'barcelona' ) ?></option>
					<option value="off"<?php echo ( $barcelona_duplication == 'off' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Off', 'barcelona' ) ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Choose category:', 'barcelona' ); ?></label><br />
				<select id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
					<option value=""><?php esc_html_e( '- All -', 'barcelona' ); ?></option>
					<?php foreach ( $barcelona_categories as $barcelona_cat ): ?>
					<option value="<?php echo intval( $barcelona_cat->term_id ); ?>"<?php echo ( $barcelona_category == $barcelona_cat->term_id ) ? ' selected' : ''; ?>><?php echo esc_html( $barcelona_cat->name ) .' ('. intval( $barcelona_cat->count ) .')'; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'filter_posts' ) ); ?>"><?php esc_html_e( 'Filter by Post Manually:', 'barcelona' ); ?></label><br />
				<input id="<?php echo esc_attr( $this->get_field_id( 'filter_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'filter_posts' ) ); ?>" class="widefat" type="text" value="<?php echo esc_attr( $barcelona_filter_posts ); ?>" />
				<span class="barcelona-widget-description"><?php esc_html_e( 'Specify post ids separated by comma. i.e. 45,73,132,19', 'barcelona' ); ?></span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order Posts by', 'barcelona' ) ?></label><br />
				<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" class="barcelona-select-post-orderby">
					<option value="date"<?php echo ( $barcelona_orderby == 'date' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Date', 'barcelona' ) ?></option>
					<option value="views"<?php echo ( $barcelona_orderby == 'views' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Views', 'barcelona' ) ?></option>
					<option value="comments"<?php echo ( $barcelona_orderby == 'comments' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Comments', 'barcelona' ) ?></option>
					<option value="votes"<?php echo ( $barcelona_orderby == 'votes' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Votes', 'barcelona' ) ?></option>
					<option value="random"<?php echo ( $barcelona_orderby == 'random' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Random', 'barcelona' ) ?></option>
					<option value="posts"<?php echo ( $barcelona_orderby == 'posts' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Manual Post IDs', 'barcelona' ) ?></option>
				</select>
			</p>

			<p class="barcelona-post-order-type"<?php echo ( $barcelona_orderby == 'random' ) ? ' style="display: none;' : ''; ?>>
				<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order Type', 'barcelona' ) ?></label><br />
				<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
					<option value="desc"<?php echo ( $barcelona_order == 'desc' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Descending', 'barcelona' ) ?></option>
					<option value="asc"<?php echo ( $barcelona_order == 'asc' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Ascending', 'barcelona' ) ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_meta_choices' ) ); ?>"><?php esc_html_e( 'Post Meta Data', 'barcelona' ) ?></label><br />
				<label><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta_choices' ) ); ?>[]" value="date"<?php echo in_array( 'date', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Date', 'barcelona' ); ?></label><br />
				<label><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta_choices' ) ); ?>[]" value="views"<?php echo in_array( 'views', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Views', 'barcelona' ); ?></label><br />
				<label><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta_choices' ) ); ?>[]" value="likes"<?php echo in_array( 'likes', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Votes', 'barcelona' ); ?></label><br />
				<label><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta_choices' ) ); ?>[]" value="comments"<?php echo in_array( 'comments', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Comments', 'barcelona' ); ?></label><br />
				<span class="barcelona-widget-description"><?php esc_html_e( 'Check which meta data to show for the posts.', 'barcelona' ); ?></span>
			</p>
			<?php

		}

	}
}