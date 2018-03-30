<?php

class wpgrade_popular_posts extends WP_Widget {

	protected $defaults;
	protected $popular_days = 0;
	private static $_days = 0;
	private static $_stats_enabled = false;
	private static $current_instance = null;
	const _tablename = 'popularpostsdata';

	function __construct(){

		/**
		 * Check if Jetpack is connected to WordPress.com and Stats module is enabled
		 */
		// Currently, this widget depends on the Stats Module
		if (
			( !defined( 'IS_WPCOM' ) || !IS_WPCOM )
			&&
			!function_exists( 'stats_get_csv' )
		) {
			self::$_stats_enabled = false;
		} else {
			self::$_stats_enabled = true;
		}

		/* Set up some default widget settings. */
		$this->defaults = array(
			'number' => 5,
			'thumb_size' => 45,
			'order' =>'pop',
			'days' => '60',
			'show_views' => '',
			'show_date' => '',
			'pop' => 'on',
			'popular_range' => 'all',
		);

		/* Widget settings. */
		$widget_ops = array(
			'classname' => 'wpgrade_popular_posts',
			'description' => __( 'This widget is the Tabs that classically goes into the sidebar. It contains the Popular posts, Latest Posts and Recent comments.', 'bucket' )
		);

		/* Widget control settings. */
		$control_ops = array(
			'width' => 240,
			'height' => 300,
			'id_base' => 'wpgrade_popular_posts'
		);

		/* Create the widget. */
		parent::__construct( 'wpgrade_popular_posts', wpgrade::themename().' '.__('Popular Posts', 'bucket' ), $widget_ops, $control_ops );

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function update ( $new_instance, $old_instance ) {

		$defaults = $this->defaults;
		$instance = $old_instance;
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['number'] = intval( $new_instance['number'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['wpgrade_popular_posts']) )
			delete_option('wpgrade_popular_posts');

		return $instance;

	} // End update()

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults );
		$title = isset( $instance['title'] ) ?esc_attr($instance['title']) : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', wpgradE::textdomain()); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts:', 'bucket' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo isset( $instance['number'] ) ? $instance['number'] : ''; ?>" />
			</label>
		</p>

		<?php if( !self::$_stats_enabled ) : ?>
			<div class="pptwj-require-error" style="background: #FFEBE8; border: 1px solid #c00; color: #333; margin: 1em 0; padding: 3px 5px; "><?php _e('Popular Posts tab requires the <a href="http://wordpress.org/extend/plugins/jetpack/" target="_blank">Jetpack plugin</a> to be activated and connected. It also requires the Jetpack Stats module to be enabled.', 'bucket' ); ?></div>
		<?php endif; ?>

	<?php
	} // End form()

	function widget($args, $instance) {
		//CACHING MAN
		$cache = wp_cache_get('wpgrade_popular_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$instance = wp_parse_args( (array) $instance, $this->defaults );
		self::$current_instance = $instance;

		extract( $args );

		$number = isset( $instance['number'] ) ? $instance['number'] : 5;

		$filter_links = array(
			'daily' => __('Today', 'bucket'),
			'weekly' => __('Week', 'bucket'),
			'monthly' => __('Month', 'bucket'),
			'all' => __('All', 'bucket')
		);
		$thumb_size = 72;
		$data = array(
			'time' => '',
			'tab' => '',
			'numberposts' => $number,
			'thumb' => $thumb_size
		);

		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		echo $before_widget;

		/* If a title was input by the user, display it. */
		if ( !empty( $title ) ){
			echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title;
		} ?>

		<ul class="tabs__nav  popular-posts__time">
			<?php
			$index = 0;
			foreach( $filter_links as $key => $val ): ?>
				<li><a class="<?php echo $index++ == 0 ? 'current' : '' ?>" href="#<?php echo $key; ?>" data-time="<?php echo $key; ?>" data-numberposts="<?php echo $number; ?>" data-thumb="<?php echo $thumb_size; ?>" data-tab="popular"><?php echo $val; ?></a></li>
			<?php endforeach; ?>
		</ul>

		<div class="tabs__content">
			<?php
			$index = 0;
			foreach( $filter_links as $key => $val ) {
				if ($index++ == 0) {
					$hidden = '';
				} else {
					$hidden = 'hide';
				}
				echo '<div class="tabs__pane '. $hidden .'" id="'. $key .'">';
				echo self::showMostViewed( $number, $thumb_size, $key );
				echo '</div>';
			} ?>
		</div>

		<?php echo $after_widget;

		// Cache the widget
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('wpgrade_popular_posts', $cache, 'widget');

	}

	/**
	 * Display most viewed
	 */
	static function showMostViewed( $posts = 5, $size = 45, $days = 'all' ) {
		global $post;

		$args = array(
			'limit' => $posts,
			'range' => $days
		);

		$popular = self::get_posts_by_wp_com( $args );

		ob_start();

		if( !$popular ):
			$message = !self::$_stats_enabled ? __('<a href="http://wordpress.org/extend/plugins/jetpack/" target="_blank">Jetpack plugin</a> with Stats module needs to be enabled.', 'bucket') : __('Sorry. No data yet.', 'bucket');
			?>
			<span><?php echo $message; ?></span>
			<?php
			$contents = ob_get_contents();
			ob_end_clean();
			return $contents;
		endif;

		$count = $i = 1;
		foreach($popular as $key => $p) :

			if ($size <> 0){
				$imageArgs = array(
					'size' => 'post-tiny',
					'image_class' => 'thumbnail',
					'format' => 'array',
					'default_image' => 'http://placehold.it/72x54'
				);

				$postImage = wpgrade_get_the_image($imageArgs, $p['id']);
			} ?>
			<article class="article  article--list">
				<a href="<?php echo $p['permalink']; ?>" title="<?php echo $p['title']; ?>" class="article--list__link">
					<?php if ( !empty( $postImage['src'] ) ){ ?>
						<div class="media__img  push-half--right">
							<?php bucket::the_img_tag($postImage['src'], $postImage['alt'], false, false, 'popular-posts-widget__img') ?>
						</div>
					<?php } ?>
					<div class="media__body">
						<div class="article__title  article--list__title">
							<h5 class="hN"><?php echo $p['title']; ?></h5>
						</div>
					</div>
					<div class="badge  badge--article  badge--article--list"><?php echo $i; ?></div>
				</a>
			</article>
			<?php $i++; endforeach;

		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}


	/**
	 * Uses data gathered by Jetpack stats and stored in WordPress.com servers
	 */
	static function get_posts_by_wp_com( $args ){

		if( !self::$_stats_enabled || !function_exists('stats_get_csv'))
			return array();

		$defaults = array(
			'limit' => 5,
			'range' => 'all', //daily|weekly|monthly|all
			'post_type' => 'post',
			'date_format' => get_option('date_format')
		);
		$args = wp_parse_args( (array) $args, $defaults );

		$limit = intval( $args['limit'] );

		/** TODO: limit $limit to 100? **/

		$days = 2;
		switch( $args['range'] ){
			case 'weekly':  $days = 7; break;
			case 'monthly': $days = 30; break;
			case 'daily' :  $days = 2; break; //make this 2 days to account for timezone differences
			case 'all':
			default:        $days = -1; break; //get all
		}

		/** we only limit to 50 posts. but change this if you want **/
		$top_posts = stats_get_csv( 'postviews', array( 'days' => $days, 'limit' => 50 ) );

		if( !$top_posts ){
			return array();
		}

		/** Store post_id into array **/
		$post_view_ids = array_filter( wp_list_pluck( $top_posts, 'post_id' ) );
		if ( !$post_view_ids ) {
			return array();
		}

		// cache
		get_posts( array( 'include' => join( ',', array_unique( $post_view_ids ) ) ) );

		// return posts list
		$posts = array();
		$counter = 0;
		foreach( $top_posts as $top_post ){

			//should only trigger for homepage
			if(empty($top_post['post_id']))
				continue;

			$post = get_post( $top_post['post_id'] );

			if ( !$post )
				continue;

			if( $args['post_type'] != $post->post_type )
				continue;

			$permalink = get_permalink( $post->ID );
			$postdate = date_i18n( $args['date_format'], strtotime( $post->post_date ) );
			$views = number_format_i18n( $top_post['views'] );

			if ( empty( $post->post_title ) ) {
				$title_source = $post->post_content;
				$title = wp_html_excerpt( $title_source, 50 );
				$title .= '&hellip;';
			} else {
				$title = $post->post_title;
			}

			$data = array(
				'title' => $title,
				'permalink' => $permalink,
				'views' => $views,
				'id' => $post->ID,
				'postdate' => $postdate
			);

			$posts[] = $data;
			$counter++;

			if( $counter == $limit )
				break;

		}

		return $posts;

	}

	function flush_widget_cache() {
		wp_cache_delete('wpgrade_popular_posts', 'widget');
	}

} // End Class

add_action('widgets_init', create_function('', 'return register_widget("wpgrade_popular_posts");'));
