<?php

/*-----------------------------------------------------------------------------------*/
/* Post Type Registering
/*-----------------------------------------------------------------------------------*/

$iron_post_types = array();
$iron_query = (object) array();
$use_dashicons = floatval($wp_version) >= 3.8;

function iron_register_post_types() {
	global $iron_post_types, $use_dashicons;

	$iron_post_types = array( 'event', 'video', 'photo-album', 'album', 'iosslider');

	$default_args = array(
		  'public'              => true
		, 'show_ui'             => true
		, 'show_in_menu'        => true
		, 'has_archive'         => true
		, 'query_var'           => true
		, 'exclude_from_search' => false
	);

/* Event Post Type (event)
   ========================================================================== */

	$event_args = $default_args;

	$event_args['labels'] = array(
		  'name'               => __('Events', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Event', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Event', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Events', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Events', IRON_TEXT_DOMAIN)
		, 'add_new'            => __('Add New', 'event', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Event', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Event', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Event', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Event', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Event', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No events found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No events found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Event:', IRON_TEXT_DOMAIN)
	);

	$event_args['supports'] = array(
		  'title'
		, 'editor'
		, 'excerpt'
		, 'thumbnail'
		, 'comments'
		, 'custom-fields'
		, 'revisions'
	);

	if($use_dashicons)
		$event_args['menu_icon'] = 'dashicons-calendar';

	$logo_args['rewrite'] = array('slug'=>__('_events', IRON_TEXT_DOMAIN));
	register_post_type('event', $event_args);



/* Video Post Type (video)
   ========================================================================== */

	$video_args = $default_args;

	$video_args['labels'] = array(
		  'name'               => __('Videos', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Video', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Video', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Videos', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Videos', IRON_TEXT_DOMAIN)
		, 'add_new'            => __('Add New', 'video', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Video', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Video', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Video', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Video', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Video', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No videos found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No videos found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Video:', IRON_TEXT_DOMAIN)
	);

	$video_args['supports'] = array(
		  'title'
		, 'editor'
		, 'excerpt'
		, 'thumbnail'
		, 'comments'
		, 'custom-fields'
		, 'revisions'
	);
	
	if($use_dashicons)
		$video_args['menu_icon'] = 'dashicons-format-video';
	
	$video_args['rewrite'] = array('slug'=>__('_videos', IRON_TEXT_DOMAIN));
	register_post_type('video', $video_args);



/* Photo Album Post Type (photo-album)
   ========================================================================== */


	$photo_args = $default_args;

	$photo_args['labels'] = array(
		  'name'               => __('Photo Albums', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Photo Album', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Photo Album', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Photo Albums', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Photo Albums', IRON_TEXT_DOMAIN)
		, 'add_new'            => __('Add New', 'photo', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Photo Album', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Photo Album', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Photo Album', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Photo Album', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Photo Album', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No photo albums found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No photo albums found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Photo Album:', IRON_TEXT_DOMAIN)
	);

	$photo_args['supports'] = array(
		  'title'
		, 'editor'
		, 'excerpt'
		, 'thumbnail'
		, 'custom-fields'
		, 'revisions'
	);

	if($use_dashicons)
		$photo_args['menu_icon'] = 'dashicons-format-image';
	
	$photo_args['rewrite'] = array('slug'=>__('_photos', IRON_TEXT_DOMAIN));
	register_post_type('photo-album', $photo_args);



/* Album Post Type (album)
   ========================================================================== */

	$album_args = $default_args;

	$album_args['labels'] = array(
		  'name'               => __('Discographies', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Discography', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Discography', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Discographies', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Discographies', IRON_TEXT_DOMAIN)
		, 'add_new'            => __('Add New', 'album', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Discography', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Discography', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Discography', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Discography', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Discography', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No discographies found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No discographies found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Discography:', IRON_TEXT_DOMAIN)
	);

	$album_args['supports'] = array(
		  'title'
		, 'editor'
		, 'excerpt'
		, 'thumbnail'
		, 'custom-fields'
		, 'revisions'
	);

	if($use_dashicons)
		$album_args['menu_icon'] = 'dashicons-format-audio';

	$album_args['rewrite'] = array('slug'=>__('_albums', IRON_TEXT_DOMAIN));
	register_post_type('album', $album_args);


/* Portfolio Post Type (portfolio)
   ========================================================================== */

	$portfolio_args = $default_args;

	$portfolio_args['labels'] = array(
		  'name'               => __('Portfolio', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Portfolio', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Portfolio', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Portfolio', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Projects', IRON_TEXT_DOMAIN)
		, 'add_new'            => __('Add Project', 'video', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Project', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Project', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Project', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Project', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Video', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No projects found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No projects found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Project:', IRON_TEXT_DOMAIN)
	);

	$portfolio_args['supports'] = array(
		  'title'
		, 'editor'
		, 'excerpt'
		, 'thumbnail'
		, 'comments'
		, 'custom-fields'
		, 'revisions'
	);
	
	if($use_dashicons)
		$portfolio_args['menu_icon'] = 'dashicons-format-aside';
	
	$portfolio_args['rewrite'] = array('slug'=>__('_portfolio', IRON_TEXT_DOMAIN));
	register_post_type('portfolio', $portfolio_args);



	/* Logos (logo)
	========================================================================== */

	$logo_args = $default_args;

	$logo_args['labels'] = array(
		'name'               => __('Logos Slider', IRON_TEXT_DOMAIN),
		'singular_name'      => __('Logo', IRON_TEXT_DOMAIN),
		'name_admin_bar'     => _x('Logo', 'add new on admin bar', IRON_TEXT_DOMAIN),
		'menu_name'          => __('Logos Slider', IRON_TEXT_DOMAIN),
		'all_items'          => __('All Logos', IRON_TEXT_DOMAIN),
		'add_new'            => __('Add New', 'event', IRON_TEXT_DOMAIN),
		'add_new_item'       => __('Add New Logo', IRON_TEXT_DOMAIN),
		'edit_item'          => __('Edit Logo', IRON_TEXT_DOMAIN),
		'new_item'           => __('New Logo', IRON_TEXT_DOMAIN),
		'view_item'          => __('View Logo', IRON_TEXT_DOMAIN),
		'search_items'       => __('Search Logo', IRON_TEXT_DOMAIN),
		'not_found'          => __('No Logos found.', IRON_TEXT_DOMAIN),
		'not_found_in_trash' => __('No Logos found in the Trash.', IRON_TEXT_DOMAIN),
		'parent'             => __('Parent Logo:', IRON_TEXT_DOMAIN),
	);

	$logo_args['supports'] = array(
		'title',
//		'editor',
//		'author',
		'thumbnail',
	);

	if($use_dashicons)
		$logo_args['menu_icon'] = 'dashicons-images-alt';

	$logo_args['rewrite'] = array('slug'=>__('_logos', IRON_TEXT_DOMAIN));
	register_post_type('logo', $logo_args);


/* ========================================================================== */



	if ( get_transient(IRON_TEXT_DOMAIN . '_flush_rules') ) {
		flush_rewrite_rules( false );
		delete_transient(IRON_TEXT_DOMAIN . '_flush_rules');
	}
}

add_action('init', 'iron_register_post_types', 1);



/*-----------------------------------------------------------------------------------*/
/* Post Type Sorting & Filtering
/*-----------------------------------------------------------------------------------*/

function iron_pre_get_post_types ( $query )
{
	global $iron_post_types, $iron_query, $post;

	$post_type = $query->get('post_type');
	$posts_per_page = $query->get('posts_per_page');

	$iron_query->post_type = $post_type;

	if ( in_array($post_type, $iron_post_types) )
	{
		if ( empty($posts_per_page) || $posts_per_page == 0 ) {
			$posts_per_page = get_iron_option($post_type . 's_per_page');
			$query->set( 'posts_per_page',  $posts_per_page);
		}
	}


	if ( 'event' == $post_type )
	{
		$order = $query->get('order');
		$orderby = $query->get('orderby');
		


		if ( is_admin() && ! $query->get('ajax') ) {

			// Furthest to Oldest
			if ( empty( $order ) )
				$query->set('order', 'ASC');
				
			if ( empty( $orderby ) )
				$query->set('orderby', 'date');	

		} else {

			if(empty($query->query_vars['filter'])) {
				$filter = get_field('events_filter', $post->ID);
				if(empty($filter)) {
					$filter  = ( empty( $_POST['eventsfilter'] ) ? 'upcoming' : sanitize_key($_POST['eventsfilter']) );
				}
		
				$query->query_vars['filter'] = $filter;
			}	
			
			$filter = $query->query_vars['filter'];
			$iron_query->query_vars['filter'] = $filter;
					
			// reset Post Status
			$query->set('post_status', array(''));
			
		}


	}else if ( 'album' == $post_type ) {
	
		if ( !is_admin() ) {
			$query->set( 'posts_per_page', -1 );
		}	
	}

}

add_action('pre_get_posts', 'iron_pre_get_post_types');


function iron_events_where ( $where = '' )
{
	if(is_single())
		return $where;
	
	global $wpdb, $iron_query, $wp_query;
	
	$post_type = $iron_query->post_type;

	if ( (!is_admin() || ( defined('DOING_AJAX') && DOING_AJAX ) ) && ( $post_type == 'event' )) {
		
		
		$filter = $iron_query->query_vars['filter'];

		if($filter == 'past') {
			
			$where .= " AND ($wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_status != 'future') AND DATE ($wpdb->posts.post_date) < '" . date_i18n('Y-m-d 00:00:00') . "'";
			
		}else{
		
			$where .= " AND ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_status = 'future') AND DATE ($wpdb->posts.post_date) >= '" . date_i18n('Y-m-d 00:00:00') . "'";
			
		}


	}

	return $where;
}

add_filter('posts_where', 'iron_events_where');


function iron_events_orderby($orderby) {
	global $iron_query, $wpdb;

	if(is_single())
		return $orderby;
			
	$post_type = $iron_query->post_type;
	
	if ( (!is_admin() || ( defined('DOING_AJAX') && DOING_AJAX ) ) && ( $post_type == 'event' )) {

		$filter = sanitize_text_field($iron_query->query_vars['filter']);

		if($filter == 'past') {
			
			$orderby = $wpdb->prefix."posts.post_date DESC";
			
		}else{
			
			$orderby = $wpdb->prefix."posts.post_date ASC";
			
		}
		
	}

	return $orderby;
}
add_filter('posts_orderby', 'iron_events_orderby');



function iron_posts_selection ()
{
	$iron_query = (object) array();
}

add_action('posts_selection', 'iron_posts_selection');


function setup_future_hook() {
// Replace native future_post function with replacement
    remove_action('future_event','_future_post_hook');
    add_action('future_event','publish_future_post_now');
}

function publish_future_post_now($id) {
// Set new post's post_status to "publish" rather than "future."
	if(!empty($_POST["post_type"]) && $_POST["post_type"] == "event")
	    wp_publish_post($id);
}

add_action('init', 'setup_future_hook');


/*-----------------------------------------------------------------------------------*/
/* Page Management
/*-----------------------------------------------------------------------------------*/

// Register Custom Columns & Unregister Default Columns
if ( ! function_exists('iron_manage_pages_columns') )
{
	function iron_manage_pages_columns ( $columns )
	{
		$iron_cols = array(
			'template' => __('Page Template')
		);

		if ( function_exists('array_insert') )
			$columns = array_insert($columns, $iron_cols, 'title', 'after');
		else
			$columns = array_merge($columns, $iron_cols);

		return $columns;
	}
}

add_filter('manage_pages_columns', 'iron_manage_pages_columns');



// Display Custom Columns
if ( ! function_exists('iron_manage_pages_custom_column') )
{
	function iron_manage_pages_custom_column ( $column, $post_id )
	{
		switch ($column)
		{
			case 'template':
				$output = ''; // __('Default')
				$tpl = get_post_meta( $post_id, '_wp_page_template', true);
				$templates = get_page_templates();
				ksort($templates);
				foreach ( array_keys($templates) as $template )
				{
					if ( $tpl == $templates[$template] ) {
						$output = $template;
						break;
					}
				}
				echo esc_html($output);
			break;

		}
	}
}

add_action('manage_pages_custom_column', 'iron_manage_pages_custom_column', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Discography Management
/*-----------------------------------------------------------------------------------*/

// Album: Icon

add_filter('manage_album_posts_columns', 'iron_manage_video_columns');

function iron_manage_album_columns ($columns)
{
	$iron_cols = array(
		  'alb_release_date' => __('Release Date', IRON_TEXT_DOMAIN)
		, 'alb_tracklist'    => __('# Tracks', IRON_TEXT_DOMAIN)
		, 'alb_store_list'   => __('# Stores', IRON_TEXT_DOMAIN)
	);

	if ( function_exists('array_insert') )
		$columns = array_insert($columns, $iron_cols, 'date', 'before');
	else
		$columns = array_merge($columns, $iron_cols);

	return $columns;
}

add_filter('manage_album_posts_columns', 'iron_manage_album_columns');


// Discography: Display Custom Columns

function iron_manage_album_custom_column ($column, $post_id)
{
	switch ($column)
	{
		case 'alb_release_date':
			if ( get_field('alb_release_date', $post_id) )
				the_field('alb_release_date', $post_id);
			else
				echo __('N/A');
			break;

		case 'alb_tracklist':
			if ( $list = get_field('alb_tracklist', $post_id) )
				echo count($list);
			else
				echo __('N/A');
			break;

		case 'alb_store_list':
			if ( $list = get_field('alb_store_list', $post_id) )
				echo count($list);
			else
				echo __('N/A');
			break;
	}
}

add_action('manage_album_posts_custom_column', 'iron_manage_album_custom_column', 10, 2);

add_action('manage_album_posts_custom_column', 'iron_manage_video_custom_column', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Event Management
/*-----------------------------------------------------------------------------------*/

function iron_manage_event_columns ($columns)
{
	unset( $columns['date'] );

	$iron_cols = array(
		  'event_date'    => __('Date', IRON_TEXT_DOMAIN)
		, 'event_city'    => __('City', IRON_TEXT_DOMAIN)
		, 'event_venue'   => __('Venue', IRON_TEXT_DOMAIN)
	);

	/*if ( function_exists('array_insert') )
		$columns = array_insert($columns, $iron_cols, 'date', 'after');
	else*/
		$columns = array_merge($columns, $iron_cols);

	$columns['title'] = __('Event');	// Renamed first column

	return $columns;
}

add_filter('manage_event_posts_columns', 'iron_manage_event_columns');


// Events: Display Custom Columns

function iron_manage_event_custom_column ($column, $post_id)
{
	switch ($column)
	{
		case 'event_date':
			global $mode;

			$post = get_post( $post_id );
			setup_postdata( $post );

			if ( '0000-00-00 00:00:00' == $post->post_date ) {
				$t_time = $h_time = __('Unpublished');
			} else {
				$t_time = get_the_time( __( 'Y/m/d g:i:s A' ) );
				$h_time = date_i18n( get_option('date_format') . ' ' . get_option('time_format'), get_post_time('U', false, $post_id) );
			}

			echo '<abbr title="' . $t_time . '">' . apply_filters( 'post_date_column_time', $h_time, $post, 'event_date', $mode ) . '</abbr>';
		break;

		case 'event_city':
			if ( get_field('event_city', $post_id) )
				the_field('event_city', $post_id);
			else
				echo __('N/A');
			break;

		case 'event_venue':
			if ( get_field('event_venue', $post_id) )
				the_field('event_venue', $post_id);
			else
				echo __('N/A');
			break;

	}
}

add_action('manage_event_posts_custom_column', 'iron_manage_event_custom_column', 10, 2);


// Events: Register Custom Columns as Sortable

function iron_manage_event_sortable_columns ($columns)
{
	$columns['event_date']  = 'date';
	// $columns['event_city']  = 'event_city';
	// $columns['event_venue'] = 'event_venue';

	return $columns;
}

add_filter('manage_edit-event_sortable_columns', 'iron_manage_event_sortable_columns');



/*-----------------------------------------------------------------------------------*/
/* Video Management
/*-----------------------------------------------------------------------------------*/

function iron_manage_video_columns ($columns)
{
	$iron_cols = array(
		'icon' => ''
	);

	if ( function_exists('array_insert') )
		$columns = array_insert($columns, $iron_cols, 'title', 'before');
	else
		$columns = array_merge($columns, $iron_cols);

	$columns['date'] = __('Published');	// Renamed date column

	return $columns;
}

add_filter('manage_video_posts_columns', 'iron_manage_video_columns');


// Videos: Display Custom Columns

function iron_manage_video_custom_column ($column, $post_id)
{
	switch ($column)
	{
		case 'icon':
			$att_title = _draft_or_post_title();
?>
				<a href="<?php echo esc_url(get_edit_post_link( $post_id, true )); ?>" title="<?php echo esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $att_title ) ); ?>"><?php
					if ( $thumb = get_the_post_thumbnail( $post_id, array(80, 60) ) )
						echo $thumb;
					else
						echo '<img width="46" height="60" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
				?></a>
<?php
			break;
	}
}

add_action('manage_video_posts_custom_column', 'iron_manage_video_custom_column', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Photo Album Management
/*-----------------------------------------------------------------------------------*/

// Photo Albums: Icon

function iron_manage_photo_album_columns ($columns)
{

	unset($columns['date']);
	unset($columns['title']);
	
	$columns['icon'] = '';
	$columns['title'] = __('Title');
	$columns['count'] = __('Count');
	$columns['date'] = __('Published');	// Renamed date column

	return $columns;
}

add_filter('manage_photo-album_posts_columns', 'iron_manage_photo_album_columns');


// Photo Albums: Display Custom Columns

function iron_manage_photo_album_custom_column ($column, $post_id)
{
	switch ($column)
	{
		case 'icon':
			$att_title = _draft_or_post_title();
?>
				<a href="<?php echo get_edit_post_link( $post_id, true ); ?>" title="<?php echo esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $att_title ) ); ?>"><?php
					if ( $thumb = get_the_post_thumbnail( $post_id, array(80, 60) ) )
						echo $thumb;
					else
						echo '<img width="46" height="60" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
				?></a>
<?php
			break;
			
		case 'count':
		
			$photos = get_field('album_photos', $post_id);
			echo '<a href="'.esc_url(get_edit_post_link( $post_id, true )).'"><b>'.count($photos).'</b></a>';
			break;
						
	}
}

add_action('manage_photo-album_posts_custom_column', 'iron_manage_photo_album_custom_column', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* IOS Sliders Management
/*-----------------------------------------------------------------------------------*/

function iron_manage_iosslider_columns ($columns)
{
	unset($columns['date']);
	unset($columns['title']);
	
	$columns['title'] = __('Title');
	$columns['count'] = __('Count');
	$columns['shortcode'] = __('Shortcode');
	$columns['date'] = __('Published');	// Renamed date column

	return $columns;
}

add_filter('manage_iosslider_posts_columns', 'iron_manage_iosslider_columns');


// Events: Display Custom Columns

function iron_manage_iosslider_custom_column ($column, $post_id)
{
	switch ($column)
	{
			
		case 'count':
		
			$photos = get_field('slider_photos', $post_id);
			echo '<a href="'.get_edit_post_link( $post_id, true ).'"><b>'.count($photos).'</b></a>';
			break;

		case 'shortcode':
		
			$photos = get_field('album_photos', $post_id);
			echo '<input type="text" readonly value="[iron_iosslider id='.$post_id.']" />';
			break;						
	}

}

add_action('manage_iosslider_posts_custom_column', 'iron_manage_iosslider_custom_column', 10, 2);

?>