<?php
/* General theme functions */



if ( ! function_exists( 'kleo_icons_array' ) ) {
	function kleo_icons_array( $prefix = '', $before = array( '' ) ) {

		// Get any existing copy of our transient data
		$transient_name = 'kleo_font_icons' . $prefix . implode( '', $before );

		// It wasn't there, so regenerate the data and save the transient
		if ( false === ( $icons = get_transient( $transient_name ) ) ) {

			$icons = $before;

			/* Icons json path */
			$icons_json_uri = THEME_URI . '/assets/fonts/selection.json';
			$icons_json_dir = THEME_DIR . '/assets/fonts/selection.json';

			if ( is_child_theme() && file_exists( CHILD_THEME_DIR . '/assets/fonts/style.css' )) {
				$icons_json_uri = CHILD_THEME_URI . '/assets/fonts/selection.json';
				$icons_json_dir = CHILD_THEME_DIR . '/assets/fonts/selection.json';
			}

			/* Retrieve icons json data */
			if( $icons_json = sq_fs_get_contents( $icons_json_dir ) ) {
				//do nothing
			} else {
				$icons_json_data = wp_remote_get( $icons_json_uri );
				$icons_json = wp_remote_retrieve_body($icons_json_data);
			}

			if ( $icons_json ) {
				$arr = json_decode( $icons_json, true );
				foreach( $arr['icons'] as $icon ) {
					if (isset($icon['properties']) && isset($icon['properties']['name'])) {
						$icons[$prefix . $icon['properties']['name']] = $icon['properties']['name'];
						asort($icons);
					}
				}
			}

			// set transient for one day
			set_transient( $transient_name, $icons, 86400 );
		}

		return $icons;
	}
}

if ( ! function_exists( 'kleo_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @since Kleo 1.0
	 *
	 * @return void
	 */
	function kleo_post_nav($same_cat = false)
	{
		// Don't print empty markup if there's nowhere to navigate.
		$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post($same_cat, '', true);
		$next = get_adjacent_post($same_cat, '', false);

		if (!$next && !$previous) {
			return;
		}
		?>

		<nav class="pagination-sticky" role="navigation">
			<?php
			if (is_attachment()) :
				previous_post_link( '%link', wp_kses_data( __( '<span id="older-nav">Go to article</span>', 'buddyapp' ) ) );
			else :
				previous_post_link('%link', '<span id="older-nav"><span class="outter-title"><span class="entry-title">' . esc_html__('Previous Post', 'buddyapp') . '</span></span></span>', $same_cat);
				next_post_link('%link', '<span id="newer-nav"><span class="outter-title"><span class="entry-title">' . esc_html__('Next Post', 'buddyapp') . '</span>', $same_cat);
			endif;
			?>
		</nav><!-- .navigation -->

		<?php
	}
}



/***************************************************
:: oEmbed manipulation for youtube/vimeo video
***************************************************/

if ( ! function_exists( 'kleo_add_video_wmode_transparent' ) ) :
	/**
	 * Automatically add wmode=transparent to embeded media
	 * Automatically add showinfo=0 for youtube
	 * @param type $html
	 * @param type $url
	 * @param type $attr
	 * @return type
	 */
	function kleo_add_video_wmode_transparent($html, $url, $attr)
	{
		if (strpos($html, "youtube.com") !== NULL || strpos($html, "youtu.be") !== NULL) {
			$info = "&amp;showinfo=0";
		}
		else {
			$info = "";
		}

		if ( strpos( $html, "<embed src=" ) !== false ) {
			return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); 
		}
		elseif ( strpos ( $html, 'feature=oembed' ) !== false ) { 
			return str_replace( 'feature=oembed', 'feature=oembed&amp;wmode=opaque'.$info, $html ); 
		}
		else {
			return $html;
		}
	}
endif;

add_filter( 'oembed_result', 'kleo_add_video_wmode_transparent', 10, 3);

if (!function_exists('kleo_oembed_filter')):
	function kleo_oembed_filter( $return, $data, $url ) {
		$return = str_replace('frameborder="0"', 'style="border: none"', $return);
		return $return;
	}
endif;

add_filter('oembed_dataparse', 'kleo_oembed_filter', 90, 3 );



/***************************************************
:: Apply oEmbed for post video format
***************************************************/
add_filter( 'kleo_oembed_video', array( $wp_embed, 'autoembed'), 8 );



/***************************************************
:: Add mp4, webm and ogv mimes for uploads
 ***************************************************/

add_filter('upload_mimes','kleo_add_upload_mimes');
if(!function_exists('kleo_add_upload_mimes'))
{
	function kleo_add_upload_mimes( $mimes ) {
		return array_merge(
			$mimes,
			array (
				'mp4' => 'video/mp4',
				'ogv' => 'video/ogg',
				'webm' => 'video/webm'
			)
		);
	}
}


/***************************************************
:: rtMedia small compatibility
***************************************************/

if ( class_exists( 'RTMedia' ) ) {
	add_action('wp_enqueue_scripts', 'kleo_rtmedia_scripts', 999);

	function kleo_rtmedia_scripts() {
		//wp_dequeue_style('rtmedia-font-awesome');
		wp_dequeue_style('rtmedia-magnific');
		wp_dequeue_script('rtmedia-magnific');
	}
}


/***************************************************
:: WP Multisite Sign-up page
 ***************************************************/
add_action( 'before_signup_form', 'kleo_mu_before_page' );
function kleo_mu_before_page() {
    get_template_part('page-parts/general-before-wrap');
}

add_action( 'after_signup_form', 'kleo_mu_after_page' );
function kleo_mu_after_page() {
    get_template_part('page-parts/general-after-wrap');
    echo '<style>'
        . '.mu_register input[type="submit"], .mu_register #blog_title, .mu_register #user_email, .mu_register #blogname, .mu_register #user_name {font-size: inherit;}'
        . '.mu_register input[type="submit"] {width: auto;}'
        .'</style>'
        . '<script>jQuery(document).ready(function() {  jQuery(\'.mu_register input[type="submit"]\').addClass("btn btn-default"); });</script>';

}


if ( ! function_exists( 'kleo_comment_nav' ) ) :
	/**
	 * Display navigation to next/previous comments when applicable.
	 *
	 * @since Twenty Fifteen 1.0
	 */
	function kleo_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
			<nav class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'buddyapp' ); ?></h2>
				<div class="nav-links">
					<?php
					if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'buddyapp' ) ) ) :
						printf( '<div class="nav-previous">%s</div>', $prev_link );
					endif;

					if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'buddyapp' ) ) ) :
						printf( '<div class="nav-next">%s</div>', $next_link );
					endif;
					?>
				</div><!-- .nav-links -->
			</nav><!-- .comment-navigation -->
			<?php
		endif;
	}
endif;



/***************************************************
:: Generate list with all BuddyPress links
 ***************************************************/

if ( ! function_exists( 'kleo_bp_menu' ) ) {
	/**
	 * Outputs the full BuddyPress menu
	 * @return bool
	 */
	function kleo_bp_menu()
	{
		/* TODO  bp-nav-menu with sub-menu */
		//return bp_nav_menu( array('container' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s submenu">%3$s</ul>') );

		if ( ! is_user_logged_in() ) {
			return false;
		}

		$counter = 0;

		$rtmedia_link = '';
		if ( class_exists( 'RTMedia' ) ) {
			$default_icons = Kleo::get_config( 'bp_default_icons' );
			$rtmedia_label = RTMEDIA_MEDIA_LABEL;

			$rtmedia_link = '<li><a href="'. trailingslashit ( get_rtmedia_user_link ( get_current_user_id () ) ) . RTMEDIA_MEDIA_SLUG . '/' .'">' .
				'<i class="icon-' . sq_option( 'bp_nav_media', $default_icons['media'] ) . '"></i>' .
	                $rtmedia_label .
				'</a></li>';
		}

		if ( sq_option('header_right_logic', 'default', true ) == 'default' ) {
			echo '<ul class="submenu">';
		} else {
			echo '<ul class="basic-menu header-menu">';
		}

		if ( function_exists( 'bp_is_active' ) ) {
			$bp = buddypress();
			if (version_compare(BP_VERSION, '2.6', '>=')) {
				$nav = $bp->members->nav->get_primary();
			} else {
				$nav = $bp->bp_nav;
			}
			
			if (empty( $nav )) {
				return false;
			}

			// Loop through each navigation item
			foreach ($nav as $nav_item) {
				$alt = (0 == $counter % 2) ? ' class="alt"' : '';

				if (isset($nav_item['position']) && -1 == $nav_item['position']) {
					continue;
				}

				if ( $nav_item['slug'] == 'settings' && ! bp_is_user() ) {
					echo $rtmedia_link;
				}

				echo '<li' . $alt . '>';
				echo '<a href="' . $nav_item['link'] . '">' . $nav_item['name'] . '</a>';

				echo '</li>';

				$counter++;
			}
		} else {
			echo $rtmedia_link;
		}

		$alt = (0 == $counter % 2) ? ' class="alt"' : '';
		//echo '<li class="separator"></li>';
		echo '<li' . $alt . '><a id="kleo-menu-logout" href="' . wp_logout_url(home_url()) . '">'
			. '<i class="icon-logout"></i> '
			. esc_html__('Log Out', 'buddyapp') . '</a></li>';

		echo '</ul>';

	}
}

if ( ! function_exists( 'kleo_get_avatar' )) {
	function kleo_get_avatar() {
		if ( function_exists( 'bp_is_active' ) ) {
			return bp_get_loggedin_user_avatar();
		} else {
			return get_avatar( get_current_user_id() );
		}
	}
}


function kleo_header_icons_menu() {

	if ( ! is_user_logged_in() ) {
		return;
	}
?>

	<ul class="basic-menu header-icons kleo-nav-menu">

		<?php if ( class_exists('ClevernessToDoList')) : ?>
			<li class="has-submenu kleo-tasks-nav">
				<?php  echo kleo_menu_tasks();?>
			</li>
		<?php endif; ?>

		<?php if ( function_exists('bp_is_active') && bp_is_active( 'messages' ) ) : ?>
			<li class="has-submenu kleo-messages-nav">
				<?php echo kleo_menu_messages();?>
			</li>
		<?php endif; ?>

		<?php if ( function_exists('bp_is_active') && bp_is_active('notifications') ) : ?>
			<li class="has-submenu kleo-notifications-nav">
				<?php echo kleo_menu_notifications();?>
			</li>
		<?php endif; ?>

	</ul>
<?php
}



/***************************************************
:: AJAX SEARCH
 ***************************************************/

add_shortcode( 'kleo_search_form', 'kleo_search_form' );
function kleo_search_form( $atts = array(), $content = null ) {

	$form_style = $type = $placeholder = $context = $hidden = $el_class = '';
	extract(shortcode_atts(array(
		'form_style' => 'default',
		'type' => 'both',
		'context' => '',
		'action' => home_url( '/' ),
		'el_id' => 'searchform',
		'el_class' => 'search-form',
		'input_id' => 'main-search',
		'input_class' => 'header-search',
		'input_name' => 's',
		'input_placeholder' => __( 'Search', 'buddyapp' ),
		'button_class' => 'header-search-button',
		'hidden' => '',
	), $atts));

	$el_class .= ' kleo-search-wrap kleo-search-form ';

	if ( is_array( $context ) ) {
		$context = implode( ',', $context );
	}

	$ajax_results = 'yes';
	$search_page = 'yes';

	if ( $type == 'ajax' ) {
		$search_page = 'no';
	} elseif ( $type == 'form_submit' ) {
		$ajax_results = 'no';
	}

	if ( function_exists('bp_is_active') && $context == 'members' ) {
		//Buddypress members form link
		$action = bp_get_members_directory_permalink();

	} elseif ( function_exists( 'bp_is_active' ) && bp_is_active( 'groups' ) && $context == 'groups' ) {
		//Buddypress group directory link
		$action = bp_get_groups_directory_permalink();

	} elseif ( class_exists('bbPress') && $context == 'forum' ) {
		$action = bbp_get_search_url();
		$input_name = 'bbp_search';

	} elseif ( $context == 'product' ) {
		$hidden .= '<input type="hidden" name="post_type" value="product">';
	}

	$output = '<form id="' . $el_id . '" class="' . $el_class . '" method="get" ' . ( $search_page == 'no' ? ' onsubmit="return false;"' : '' ) . ' action="' . $action . '" data-context="' . $context  .'">';
	$output .= '<input id="' . $input_id . '" class="' . $input_class . ' ajax_s" autocomplete="off" type="text" name="' . $input_name . '" value="" placeholder="' . $input_placeholder . '">';
	$output .= '<button type="submit" class="' . $button_class . '"></button>';
	if ( $ajax_results == 'yes' ) {
		$output .= '<div class="kleo_ajax_results search-style-' . $form_style . '"></div>';
	}
	$output .= $hidden;
	$output .= '</form>';

	return $output;
}



//Catch ajax requests
add_action( 'wp_ajax_kleo_ajax_search', 'kleo_ajax_search' );
add_action( 'wp_ajax_nopriv_kleo_ajax_search', 'kleo_ajax_search' );

if(!function_exists('kleo_ajax_search'))
{
	function kleo_ajax_search()
	{
		//if "s" input is missing exit
		if( empty( $_REQUEST['s'] ) && empty( $_REQUEST['bbp_search'] ) ) die();

		if( ! empty( $_REQUEST['bbp_search'] ) ) {
			$search_string = esc_html($_REQUEST['bbp_search']);
		} else {
			$search_string = esc_html($_REQUEST['s']);
		}

		$output = "";
		$context = "any";
		$defaults = array(
			'numberposts' => 4,
			'posts_per_page' => 20,
			'post_type' => 'any',
			'post_status' => 'publish',
			'post_password' => '',
			'suppress_filters' => false,
			's' => $_REQUEST['s']
		);

		if ( isset( $_REQUEST['context'] ) && $_REQUEST['context'] != '' ) {
			$context = explode( ",", $_REQUEST['context'] );
			$defaults['post_type'] = $context;
		}

		$defaults =  apply_filters( 'kleo_ajax_query_args', $defaults);

		$the_query = new WP_Query( $defaults );
		$posts = $the_query->get_posts();

		$members = array();
		$members['total'] = 0;
		$groups = array();
		$groups['total'] = 0;
		$forums = FALSE;


		if ( function_exists( 'bp_is_active' ) && ( $context == "any" || in_array( "members", $context ) ) ) {
			$members = bp_core_get_users(array('search_terms' => $search_string, 'per_page' => $defaults['numberposts'], 'populate_extras' => false));
		}

		if ( function_exists( 'bp_is_active' ) && bp_is_active("groups") && ( $context == "any" || in_array( "groups", $context ) ) ) {
			$groups = groups_get_groups(array('search_terms' => $search_string, 'per_page' => $defaults['numberposts'], 'populate_extras' => false));
		}

		if ( class_exists( 'bbPress' ) && ( $context == "any" || in_array( "forum", $context ) ) ) {
			$forums = kleo_bbp_get_replies( $search_string );
		}


		//if there are no posts, groups nor members
		if( empty( $posts ) && $members['total'] == 0 && $groups['total'] == 0 && ! $forums  ) {
			$output  = "<div class='kleo_ajax_entry ajax_not_found'>";
			$output .= "<div class='ajax_search_content'>";
			$output .= "<i class='icon icon-info-outline'></i> ";
			$output .= esc_html__("Sorry, we haven't found anything based on your criteria.", 'buddyapp');
			$output .= "<br>";
			$output .= esc_html__("Please try searching by different terms.", 'buddyapp');
			$output .= "</div>";
			$output .= "</div>";
			echo $output;
			die();
		}

		//if there are members
		if ( $members['total'] != 0 ) {

			$output .= '<div class="kleo-ajax-part kleo-ajax-type-members">';
			$output .= '<h4><span>' . esc_html__("Members", 'buddyapp') . '</span></h4>';
			foreach ( (array) $members['users'] as $member ) {
				$image = '<img src="' . bp_core_fetch_avatar(array('item_id' => $member-> ID, 'width' => 25, 'height' => 25, 'html' => false)) . '" class="kleo-rounded" alt="">';
				if ( $update = bp_get_user_meta( $member-> ID, 'bp_latest_update', true ) ) {
					$latest_activity = char_trim( trim( strip_tags( bp_create_excerpt( $update['content'], 50,"..." ) ) ) );
				} else {
					$latest_activity = '';
				}
				$output .= "<div class ='kleo_ajax_entry'>";
				$output .= "<div class='ajax_search_image'>$image</div>";
				$output .= "<div class='ajax_search_content'>";
				$output .= "<a href='" . esc_url( bp_core_get_user_domain( $member->ID ) ) . "' class='search_title'>";
				$output .= esc_html( $member->display_name) ;
				$output .= "</a>";
				$output .= "<span class='search_excerpt'>";
				$output .= $latest_activity;
				$output .= "</span>";
				$output .= "</div>";
				$output .= "</div>";
			}
			$output .= "<a class='ajax_view_all' href='" . esc_url(bp_get_members_directory_permalink()) . "?s=" . $search_string . "'>" . esc_html__('View member results','buddyapp') . "</a>";
			$output .= "</div>";
		}

		//if there are groups
		if ( $groups['total'] != 0 ) {

			$output .= '<div class="kleo-ajax-part kleo-ajax-type-groups">';
			$output .= '<h4><span>' . esc_html__("Groups", 'buddyapp') . '</span></h4>';
			foreach ( (array) $groups['groups'] as $group ) {
				$image = '<img src="' . bp_core_fetch_avatar(array('item_id' => $group->id, 'object'=>'group', 'width' => 25, 'height' => 25, 'html' => false)) . '" class="kleo-rounded" alt="">';
				$output .= "<div class ='kleo_ajax_entry'>";
				$output .= "<div class='ajax_search_image'>$image</div>";
				$output .= "<div class='ajax_search_content'>";
				$output .= "<a href='" . esc_url(bp_get_group_permalink( $group )) . "' class='search_title'>";
				$output .= $group->name;
				$output .= "</a>";
				$output .= "</div>";
				$output .= "</div>";
			}
			$output .= "<a class='ajax_view_all' href='" . esc_url(bp_get_groups_directory_permalink()) . "?s=" . $search_string . "'>" . esc_html__('View group results','buddyapp') . "</a>";
			$output .= "</div>";
		}

		//if there are posts
		if( ! empty( $posts ) ) {
			$post_types = array();
			$post_type_obj = array();
			foreach ( $posts as $post ) {
				$post_types[$post->post_type][] = $post;
				if (empty($post_type_obj[$post->post_type])) {
					$post_type_obj[$post->post_type] = get_post_type_object($post->post_type);
				}
			}

			foreach ($post_types as $ptype => $post_type) {
				$output .= '<div class="kleo-ajax-part kleo-ajax-type-' . esc_attr( $post_type_obj[$ptype]->name ) . '">';
				if (isset($post_type_obj[$ptype]->labels->name)) {
					$output .= "<h4><span>" . esc_html( $post_type_obj[$ptype]->labels->name ) . "</span></h4>";
				} else {
					$output .= "<hr>";
				}
				$count = 0;
				foreach ($post_type as $post) {

					$count++;
					if ($count > 4) {
						continue;
					}
					$format = get_post_format( $post->ID );
					if ( $img_url = kleo_get_post_thumbnail_url( $post->ID ) ) {
						$image = aq_resize( $img_url, 44, 44, true, true, true );
						if( ! $image ) {
							$image = $img_url;
						}
						$image = '<img src="'. $image .'" class="kleo-rounded">';
					} else {
						if ($format == 'video') {
							$image = "<i class='icon icon-video'></i>";
						} elseif ($format == 'image' || $format == 'gallery') {
							$image = "<i class='icon icon-picture'></i>";
						} else {
							$image = "<i class='icon icon-link'></i>";
						}
					}

					$excerpt = "";

					if ( ! empty($post->post_content) ) {
						$excerpt = char_trim( trim( strip_tags( strip_shortcodes( wp_kses_post( $post->post_content ) ) ) ), 40, "..." );
					}
					$link = apply_filters('kleo_custom_url', get_permalink($post->ID));
					$classes = "format-" . $format;
					$output .= "<div class ='kleo_ajax_entry $classes'>";
					$output .= "<div class='ajax_search_image'>$image</div>";
					$output .= "<div class='ajax_search_content'>";
					$output .= "<a href='$link' class='search_title'>";
					$output .= get_the_title($post->ID);
					$output .= "</a>";
					$output .= "<span class='search_excerpt'>";
					$output .= $excerpt;
					$output .= "</span>";
					$output .= "</div>";
					$output .= "</div>";
				}
				$output .= '</div>';
			}

			$output .= "<a class='ajax_view_all' href='" . home_url( '/' ) . '?s=' . $search_string . "'>" . esc_html__('View all results', 'buddyapp') . "</a>";
		}

		/* Forums topics search */
		if( ! empty( $forums ) ) {
			$output .= '<div class="kleo-ajax-part kleo-ajax-type-forums">';
			$output .= '<h4><span>' . esc_html__("Forums", 'buddyapp') . '</span></h4>';

			$i = 0;
			foreach ( $forums as $fk => $forum ) {

				$i++;
				if ($i <= 4 ) {
					$image = "<i class='icon icon-chat-1'></i>";

					$output .= "<div class ='kleo_ajax_entry'>";
					$output .= "<div class='ajax_search_image'>$image</div>";
					$output .= "<div class='ajax_search_content'>";
					$output .= "<a href='" . esc_url( $forum['url'] ) . "' class='search_title'>";
					$output .= $forum['name'];
					$output .= "</a>";
					$output .= "</div>";
					$output .= "</div>";
				}
			}
			$output .= "<a class='ajax_view_all' href='" . bbp_get_search_url() . "?bbp_search=" . $search_string . "'>" . esc_html__('View forum results','buddyapp') . "</a>";
			$output .= "</div>";
		}


		echo $output;
		die();
	}
}
function kleo_bbp_get_replies( $title = '' )
{
	global $wpdb;
	$topic_matches = array();

	/* First do a title search */
	$topics = $wpdb->get_results('SELECT * FROM ' . $wpdb->posts . ' WHERE post_title LIKE "%' . esc_sql( trim( $title ) ) .'%" AND post_type="topic" AND post_status="publish"' );

	/* do a tag search if title search doesn't have results */
	if ( ! $topics )
	{
		$topic_tags = get_terms( 'topic-tag' );

		if ( empty($topic_tags) ) {
			return $topic_matches;
		}

		foreach ( $topic_tags as $tid => $tag ) {
			$tags[$tag->term_id] = $tag->name;
		}

		$tag_matches = kleo_bbp_stristr_array( $title , $tags );

		$args = array(
			'post_type' => 'topic' ,
			'showposts' => -1 ,
			'tax_query' => array(
				array(
					'taxonomy' => 'topic-tag',
					'field' => 'term_id',
					'terms' => $tag_matches
				)
			)
		);

		$topics = get_posts( $args );
	}

	/* Compile results into array*/
	foreach ($topics as  $topic) {
		$topic_matches[$topic->ID]['name'] = $topic->post_title;
		$topic_matches[$topic->ID]['url'] = get_post_permalink( $topic->ID );
	}


	return $topic_matches;

}
function kleo_bbp_stristr_array( $haystack, $needles ) {

	$elements = array();


	foreach ( $needles as $id => $needle )
	{
		if ( stristr( $haystack, $needle ) )
		{
			$elements[] = $id;
		}
	}

	return $elements;
}



/***************************************************
:: BP LIKE COMPATIBILITY
 ***************************************************/

/**
 *
 * Includes JavaScript variables needed in the <head>.
 *
 */
if (defined('BP_LIKE_VERSION')) {

	remove_action('get_header', 'bp_like_insert_head');

	function kleo_bp_like_insert_head()
	{
		?>
		<script type="text/javascript">
			/* <![CDATA[ */
			var bp_like_terms_like = '<?php echo bp_like_get_text( 'like' ); ?>';
			var bp_like_terms_like_message = '<?php echo bp_like_get_text( 'like_this_item' ); ?>';
			var bp_like_terms_unlike_message = '<?php echo bp_like_get_text( 'unlike_this_item' ); ?>';
			var bp_like_terms_view_likes = '<?php echo bp_like_get_text( 'view_likes' ); ?>';
			var bp_like_terms_hide_likes = '<?php echo bp_like_get_text( 'hide_likes' ); ?>';
			var bp_like_terms_unlike_1 = '<?php echo bp_like_get_text( 'unlike' ); ?> (1)';
			/* ]]> */


			<?php if ( bp_like_get_settings( 'remove_fav_button' ) == 1 ) { ?>
			jQuery(document).ready(function ($) {

				jQuery(".fav").remove();
				jQuery(".unfav").remove();
			});
			<?php } ?>
		</script>
		<?php
	}

	add_action('wp_head', 'kleo_bp_like_insert_head');
}

function kleo_get_thumbnail() {
	if ( post_password_required() || is_attachment() ) {
		return;
	}

	if ( ( is_singular() && sq_option( 'post_media_status', 1, true ) ) || ! is_singular() ) {

		if (kleo_get_post_thumbnail_url() != '') {
			echo '<div class="post-image">';
			$img_url = kleo_get_post_thumbnail_url();
			$image = aq_resize( $img_url, Kleo::get_config('post_gallery_img_width'), Kleo::get_config('post_gallery_img_height'));
			if ( $image ) {
				echo '<a href="' . get_permalink() . '" class="element-wrap">'
					. '<img src="' . $image . '" alt="' . get_the_title() . '">'
					. '</a>';
			}
			echo '</div><!--end post-image-->';
		}

	}
}


if ( ! function_exists( 'kleo_entry_meta' ) ) {
	function kleo_entry_meta( $args = array() )
	{

		/**
		 * Parse incoming $args into an array and merge it with $defaults
		 */
		$defaults = array(
				'container' => 'ul',
				'entry_tag' => 'li',
				'class' => 'entry-meta clearfix',
				'echo' => TRUE
		);
		$args = wp_parse_args($args, $defaults);

		$output = '<' . $args['container'] . ' class="' . esc_attr($args['class']) . '">';

		$author_id = get_the_author_meta('ID');
		$author_link = get_author_posts_url($author_id);
		$author_title = esc_attr(sprintf(esc_html__('View all POSTS by %s', 'buddyapp'), get_the_author()));

		if (function_exists('bp_is_active')) {
			$author_link = bp_core_get_user_domain($author_id);
			$author_title = esc_attr(sprintf(esc_html__('View %s\'s profile', 'buddyapp'), get_the_author()));
		}

		$cat_tag = array();
		$categories_list = get_the_category_list(esc_html__(', ', 'buddyapp'));
		$tags_list = get_the_tag_list('', esc_html__(', ', 'buddyapp'));


		if (isset($categories_list) && $categories_list) {
			$cat_tag[] = $categories_list;
		}

		if (isset($tag_list) && $tag_list) {
			$cat_tag[] = $tag_list;
		}


		$output .= '<' . $args['entry_tag'] . '><i class="icon-calendar"></i> ' . get_the_date() . '</' . $args['entry_tag'] . '>';
		$output .= '<' . $args['entry_tag'] . ' class="meta-author author vcard">';
		$output .= sprintf(wp_kses_data(__('<a class="url fn n" href="%s" title="%s" rel="author"><i class="icon-user"></i> %s</a>', 'buddyapp')),
				$author_link,
				$author_title,
				get_the_author());

		$output .= '</' . $args['entry_tag'] . '>';

		if (!empty($categories_list)) {
			$output .= '<' . $args['entry_tag'] . '><i class="icon-folder-open"></i> ' . $categories_list . '</' . $args['entry_tag'] . '>';
		}

		if (!empty($tags_list)) {
			$output .= '<' . $args['entry_tag'] . '><i class="icon-tag"></i> ' . $tags_list . '</' . $args['entry_tag'] . '>';
		}

		if (comments_open() || get_comments_number()) {
			$output .= '<' . $args['entry_tag'] . '><a href="' . get_permalink() . '#comments"><i class="icon-comment"></i> ' . get_comments_number() . '</a></' . $args['entry_tag'] . '>';
		}
		$output .= '</' . $args['container'] . '>';

		if ( $args['echo'] ) {
			echo $output;
		} else {
			return $output;
		}
	}
}


/* Small shortcode to style elements */
add_shortcode( 'kleo_dashboard', 'sq_dashboard_func' );

function sq_dashboard_func( $atts, $content = null )
{
	$output = $title = $title_stroke = $el_class = '';
	extract(shortcode_atts(array(
		'title' => '',
		'title_stroke' => 'yes',
		'el_class' => ''
	), $atts));


	$classes = '';

	if ($el_class != '') {
		$classes .=  ' ' . $el_class;
	}

	if ( $title_stroke == 'yes' ) {
		$classes .= ' has-title-stroke';
	}

	$output .= '<div class="dashboard-container' . $classes .'">';

	if( $title != '' ) {
		$output .= '<div class="dashboard-title">' . $title . '</div>';
	}
	$output .= '<div class="dashboard-content">';
	$output .= do_shortcode( $content );
	$output .= '</div>';

	$output .= '</div>';

	return $output;

}



/* Simple theme specific login form */
add_shortcode( 'sq_login_form', 'sq_login_form_func' );

/**
 * Return login form for shortcode
 * @param $atts
 * @param null $content
 * @return string
 */
function sq_login_form_func( $atts, $content = null ) {

	$output = $style = $disable_modal = '';

	extract( shortcode_atts( array(
			'style' => 'white',
			'before_input' => '',
			'disable_modal' => ''
	), $atts) );

	$output .= '<div class="login-page-wrap">';
	ob_start();
	kleo_get_template_part( 'page-parts/login-form', null, compact( 'style', 'before_input' ) );
	$output .= ob_get_clean();
	$output .= '</div>';

	if ( $disable_modal == '' ) {
		add_filter( "get_template_part_page-parts/login-form", '__return_false');
	}

	return $output;
}

add_action( 'wp', 'sq_check_page_template' );

function sq_check_page_template() {
	if ( is_page_template( 'page-templates/blank.php' ) ) {
		/* remove admin bar */
		remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
		add_filter( 'show_admin_bar', '__return_false' );

		if ( kleo_has_shortcode( 'sq_login_form' ) && is_user_logged_in() && ! is_super_admin()) {
			wp_redirect( home_url() );
		}
	}
}

if (! function_exists( 'buddyapp_sad_search_svg' )) {
	function buddyapp_sad_search_svg()
	{
		?>
		<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
			 x="0px" y="0px"
			 viewBox="171 42.4 768 768" enable-background="new 171 42.4 768 768" xml:space="preserve">
					<g id="icomoon-ignore" display="none">

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="187" y1="42.4" x2="187" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="203" y1="42.4" x2="203" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="219" y1="42.4" x2="219" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="235" y1="42.4" x2="235" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="251" y1="42.4" x2="251" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="267" y1="42.4" x2="267" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="283" y1="42.4" x2="283" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="299" y1="42.4" x2="299" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="315" y1="42.4" x2="315" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="331" y1="42.4" x2="331" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="347" y1="42.4" x2="347" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="363" y1="42.4" x2="363" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="379" y1="42.4" x2="379" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="395" y1="42.4" x2="395" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="411" y1="42.4" x2="411" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="427" y1="42.4" x2="427" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="443" y1="42.4" x2="443" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="459" y1="42.4" x2="459" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="475" y1="42.4" x2="475" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="491" y1="42.4" x2="491" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="507" y1="42.4" x2="507" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="523" y1="42.4" x2="523" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="539" y1="42.4" x2="539" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="555" y1="42.4" x2="555" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="571" y1="42.4" x2="571" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="587" y1="42.4" x2="587" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="603" y1="42.4" x2="603" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="619" y1="42.4" x2="619" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="635" y1="42.4" x2="635" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="651" y1="42.4" x2="651" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="667" y1="42.4" x2="667" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="683" y1="42.4" x2="683" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="699" y1="42.4" x2="699" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="715" y1="42.4" x2="715" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="731" y1="42.4" x2="731" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="747" y1="42.4" x2="747" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="763" y1="42.4" x2="763" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="779" y1="42.4" x2="779" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="795" y1="42.4" x2="795" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="811" y1="42.4" x2="811" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="827" y1="42.4" x2="827" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="843" y1="42.4" x2="843" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="859" y1="42.4" x2="859" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="875" y1="42.4" x2="875" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="891" y1="42.4" x2="891" y2="810.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="907" y1="42.4" x2="907" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="923" y1="42.4" x2="923" y2="810.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="58.4" x2="939" y2="58.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="74.4" x2="939" y2="74.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="90.4" x2="939" y2="90.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="106.4" x2="939" y2="106.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="122.4" x2="939" y2="122.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="138.4" x2="939" y2="138.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="154.4" x2="939" y2="154.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="170.4" x2="939" y2="170.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="186.4" x2="939" y2="186.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="202.4" x2="939" y2="202.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="218.4" x2="939" y2="218.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="234.4" x2="939" y2="234.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="250.4" x2="939" y2="250.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="266.4" x2="939" y2="266.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="282.4" x2="939" y2="282.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="298.4" x2="939" y2="298.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="314.4" x2="939" y2="314.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="330.4" x2="939" y2="330.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="346.4" x2="939" y2="346.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="362.4" x2="939" y2="362.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="378.4" x2="939" y2="378.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="394.4" x2="939" y2="394.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="410.4" x2="939" y2="410.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="426.4" x2="939" y2="426.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="442.4" x2="939" y2="442.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="458.4" x2="939" y2="458.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="474.4" x2="939" y2="474.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="490.4" x2="939" y2="490.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="506.4" x2="939" y2="506.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="522.4" x2="939" y2="522.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="538.4" x2="939" y2="538.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="554.4" x2="939" y2="554.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="570.4" x2="939" y2="570.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="586.4" x2="939" y2="586.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="602.4" x2="939" y2="602.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="618.4" x2="939" y2="618.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="634.4" x2="939" y2="634.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="650.4" x2="939" y2="650.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="666.4" x2="939" y2="666.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="682.4" x2="939" y2="682.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="698.4" x2="939" y2="698.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="714.4" x2="939" y2="714.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="730.4" x2="939" y2="730.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="746.4" x2="939" y2="746.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="762.4" x2="939" y2="762.4"/>
						<line display="inline" fill="none" stroke="#449FDB" x1="171" y1="778.4" x2="939" y2="778.4"/>

						<line display="inline" opacity="0.3" fill="none" stroke="#449FDB" enable-background="new    "
							  x1="171" y1="794.4" x2="939" y2="794.4"/>
					</g>
			<g id="color">
				<path fill="#231F20" fill-opacity="0.1" d="M708.7,272.3c-2.6,27.6-12,53.2-26.5,75.2l11.1,0c17.9-23.7,29.7-52.2,32.8-83.4
					C719.5,265.3,713.5,268.2,708.7,272.3z"/>
				<path fill="#231F20" fill-opacity="6.000000e-002" d="M669.7,251.9c-21-24.2-48.9-42.1-80.5-51.1c3.3,0.9,6.5,1.9,9.7,3
					c13.1,13.7,21.2,32.2,21.2,52.7c0,42.1-34.2,76.3-76.3,76.3s-76.3-34.2-76.3-76.3c0-20.4,8.1-39,21.2-52.7c3.2-1.1,6.5-2,9.7-3
					c-31.6,9-59.5,26.9-80.5,51.1c-0.1,1.5-0.2,3-0.2,4.6c0,69.7,56.5,126.2,126.2,126.2s126.2-56.5,126.2-126.2
					C669.9,254.9,669.8,253.4,669.7,251.9z"/>
				<path fill="#231F20" fill-opacity="0.1" d="M563.3,368.1c-69.7,0-126.2-56.5-126.2-126.2c0-1.5,0.2-3,0.2-4.6
					c1.2-34.6,16.4-65.5,40-87.6c-34.1,21.6-57.2,59.1-58.8,102.1c-0.1,1.5-0.2,3-0.2,4.6c0,69.7,56.5,126.2,126.2,126.2
					c33.3,0,63.5-13,86.1-34.1C611.1,360.8,588.1,368.1,563.3,368.1z"/>
				<path fill="#231F20" fill-opacity="0.1" d="M536.5,557.8c-16.6,0-30-13.4-30-30c0-12.5,17.2-45.7,25.5-61c-3.8-7-6.4-11.7-6.4-11.7
					s-33.7,59-33.7,77.6c0,18.6,15.1,33.7,33.7,33.7c10.9,0,20.5-5.3,26.6-13.3C547.6,556.1,542.3,557.8,536.5,557.8z"/>
				<path fill="#231F20" fill-opacity="0.1" d="M378,256.8c-3.6-1.5-7.6-2.3-11.8-2.3c-11.8,0-21.8,6.3-26.5,15.3
					c-1.4-0.4-2.9-0.7-4.4-0.7c-8.1,0-14.6,5.9-14.6,13.2c0,1.4,0.3,2.8,0.8,4.1c-6.3,3.3-10.6,9.4-10.6,16.4c0,9,7,16.5,16.3,18.5
					c10.4-9.3,24.7-14.9,40.1-14.9c6.9,0,13.4,1.1,19.5,3.1C381.3,292.9,378.1,275.2,378,256.8z"/>
				<ellipse opacity="7.000000e-002" fill="#231F20" cx="548.1" cy="739" rx="202" ry="25.4"/>
			</g>
			<path d="M755.3,314.4c-1.3,0-2.4-1-2.5-2.3l-2-19.1c-0.8-7.1-8.4-12.5-17.7-12.5c-1.4,0-2.6-1.1-2.6-2.6s1.1-2.6,2.6-2.6
				c12,0,21.8,7.3,22.8,17l2,19.1c0.1,1.4-0.9,2.7-2.3,2.8C755.5,314.4,755.4,314.4,755.3,314.4z"/>
			<path d="M642,153.2c-0.6,0-1.3-0.2-1.7-0.7c-21.6-20-48.3-32.7-77.3-36.6c-1.4-0.2-2.4-1.5-2.2-2.9c0.2-1.4,1.5-2.4,2.9-2.2
				c30.1,4.1,57.8,17.2,80.1,37.9c1,1,1.1,2.6,0.1,3.6C643.3,152.9,642.7,153.2,642,153.2z"/>
			<path fill="#231F20" fill-opacity="0.1"
				  d="M520.4,196.1c2.3-0.3,4.6-0.7,7-0.9C525,195.4,522.7,195.8,520.4,196.1z"/>
			<path fill="#231F20" fill-opacity="0.1"
				  d="M567.2,196.1c-2.3-0.3-4.6-0.7-7-0.9C562.5,195.4,564.8,195.8,567.2,196.1z"/>
			<path fill="#231F20" fill-opacity="0.1"
				  d="M503.1,199.4c3-0.8,6-1.4,9-2C509.1,198.1,506.1,198.7,503.1,199.4z"/>
			<path fill="#231F20" fill-opacity="0.1"
				  d="M584.4,199.4c-3-0.7-5.9-1.4-8.9-2C578.5,198.1,581.5,198.7,584.4,199.4z"/>
			<path fill="#231F20" d="M552.9,276.8c0-6.2,5-11.2,11.2-11.2c4.5,0,8.4,2.7,10.1,6.6c2.4-4.7,4-10,4-15.7c0-19-15.4-34.4-34.4-34.4
				c-19,0-34.4,15.4-34.4,34.4c0,19,15.4,34.4,34.4,34.4c5.7,0,11-1.5,15.7-4C555.6,285.1,552.9,281.3,552.9,276.8z"/>
			<path d="M525.6,570.4c-20.7,0-37.5-16.8-37.5-37.5c0-19.1,30.7-73.4,34.2-79.5c0.7-1.2,2-1.9,3.3-1.9s2.7,0.7,3.3,1.9
				c3.5,6.1,34.2,60.5,34.2,79.5C563.1,553.5,546.3,570.4,525.6,570.4z M525.6,463.1c-10.6,19.3-29.9,56.9-29.9,69.8
				c0,16.5,13.4,29.9,29.9,29.9s29.9-13.4,29.9-29.9C555.5,519.9,536.2,482.4,525.6,463.1z"/>
			<path d="M544.3,525.6c-1.4,0-2.6-1.1-2.6-2.6c0-7.9-13.3-32.9-18.4-41.9c-0.7-1.2-0.3-2.8,1-3.5c1.2-0.7,2.8-0.3,3.5,1
				c2,3.4,19.1,33.7,19.1,44.4C546.9,524.5,545.7,525.6,544.3,525.6z"/>
			<path d="M602.1,506c-10.4,0-18.9-8.5-18.9-18.9c0-8.9,13-32.1,15.6-36.6c0.7-1.2,2-1.9,3.3-1.9s2.7,0.7,3.3,1.9
				c2.6,4.6,15.6,27.8,15.6,36.6C621,497.5,612.5,506,602.1,506z M602.1,460.3c-5.4,10.2-11.2,22.6-11.2,26.8c0,6.2,5,11.2,11.2,11.2
				s11.2-5,11.2-11.2C613.3,482.9,607.5,470.5,602.1,460.3z"/>
			<path d="M434.7,386.2c-0.1,0-0.3,0-0.4,0l-26-4.5c-1.1-0.2-2-1.1-2.1-2.3l-2.8-26.2c-1.6-15.3-17.1-26.8-36-26.8
				c-9.7,0-18.9,3.1-25.7,8.8c-1.1,0.9-2.7,0.7-3.6-0.4c-0.9-1.1-0.7-2.7,0.4-3.6c7.8-6.4,18.1-9.9,29-9.9c21.6,0,39.2,13.5,41.1,31.4
				l2.6,24.3l24.1,4.1c1.4,0.2,2.3,1.6,2.1,3C437,385.3,435.9,386.2,434.7,386.2z"/>
			<path d="M673.6,253.5c0-0.5-0.1-1.1-0.1-1.6c0-0.1,0-0.1,0-0.1c0-0.2,0-0.2,0-0.4c-1.3-33.6-15.3-65-39.5-88.4
				c-24.3-23.6-56.4-36.6-90.3-36.6s-66,13-90.3,36.6c-24.3,23.5-38.3,55-39.5,88.8c0,0,0,0,0,0c0,0,0,0,0,0c0,0.6-0.1,1.2-0.1,1.7
				c-0.1,0.9-0.1,1.9-0.1,3c0,71.7,58.3,130,130,130s130-58.3,130-130C673.8,255.4,673.7,254.4,673.6,253.5z M599.1,209.7
				c0.4,0.4,0.7,0.8,1,1.3c0.4,0.5,0.8,0.9,1.1,1.4c0.3,0.4,0.6,0.8,0.9,1.2c0.4,0.5,0.8,1,1.1,1.5c0.3,0.4,0.5,0.8,0.8,1.2
				c0.4,0.5,0.7,1.1,1.1,1.7c0.2,0.4,0.4,0.7,0.7,1.1c0.4,0.6,0.7,1.2,1.1,1.8c0.2,0.3,0.4,0.7,0.5,1c0.4,0.7,0.7,1.3,1.1,2
				c0.2,0.3,0.3,0.6,0.4,0.9c0.3,0.7,0.7,1.4,1,2.1c0.1,0.3,0.2,0.6,0.3,0.8c0.3,0.8,0.7,1.5,1,2.3c0.1,0.3,0.2,0.5,0.3,0.8
				c0.3,0.8,0.6,1.6,0.9,2.4c0.1,0.2,0.2,0.5,0.2,0.8c0.3,0.8,0.5,1.6,0.8,2.5c0.1,0.2,0.1,0.5,0.2,0.7c0.2,0.8,0.5,1.7,0.7,2.5
				c0.1,0.3,0.1,0.5,0.2,0.8c0.2,0.8,0.4,1.7,0.5,2.5c0.1,0.3,0.1,0.6,0.1,0.9c0.1,0.8,0.3,1.6,0.4,2.4c0.1,0.4,0.1,0.8,0.1,1.2
				c0.1,0.7,0.2,1.4,0.3,2.1c0.1,0.6,0.1,1.1,0.1,1.7c0,0.6,0.1,1.1,0.1,1.7c0.1,1.1,0.1,2.3,0.1,3.4c0,1.2,0,2.5-0.1,3.7
				c-1.9,38.2-33.7,68.7-72.4,68.7c-39.9,0-72.5-32.5-72.5-72.5c0-3.4,0.2-6.8,0.7-10.1c0,0,0-0.1,0-0.1c0.1-1.1,0.3-2.1,0.5-3.2
				c0-0.1,0-0.1,0-0.2c0.2-1,0.4-2.1,0.7-3.1c0-0.1,0-0.2,0-0.2c0.2-1,0.5-2,0.8-3c0-0.1,0-0.2,0.1-0.3c0.3-0.9,0.6-1.8,0.9-2.8
				c0-0.1,0.1-0.3,0.1-0.4c0.3-0.9,0.6-1.7,1-2.6c0.1-0.2,0.1-0.4,0.2-0.5c0.3-0.8,0.7-1.6,1-2.4c0.1-0.2,0.2-0.4,0.3-0.7
				c0.3-0.8,0.7-1.5,1.1-2.2c0.1-0.3,0.2-0.5,0.4-0.8c0.4-0.7,0.7-1.4,1.1-2.1c0.2-0.3,0.3-0.6,0.5-0.9c0.4-0.6,0.7-1.2,1.1-1.9
				c0.2-0.3,0.4-0.7,0.6-1c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.4,0.5-0.8,0.8-1.1c0.4-0.5,0.7-1,1.1-1.5c0.3-0.4,0.6-0.8,0.9-1.2
				c0.4-0.5,0.8-0.9,1.1-1.4c0.3-0.4,0.7-0.8,1-1.3c0.4-0.4,0.8-0.9,1.2-1.3c0.4-0.4,0.7-0.8,1.1-1.2c2.7-0.9,5.4-1.8,8.2-2.6
				c0,0,0,0,0,0l0.6-0.2c0.3-0.1,0.5-0.2,0.8-0.3c28.7-8,58.5-8,87.2,0c0.2,0.1,0.5,0.2,0.8,0.3l0.6,0.2c2.7,0.8,5.4,1.6,8.1,2.6
				c0.4,0.4,0.7,0.8,1.1,1.2C598.3,208.9,598.7,209.3,599.1,209.7z M543.8,134.1c62.4,0,113.7,46.2,121.2,107
				c-32-32.4-75.6-50.7-121.2-50.7c-45.6,0-89.2,18.4-121.2,50.7C430,180.3,481.3,134.1,543.8,134.1z M543.8,378.8
				c-67.4,0-122.3-54.9-122.3-122.3c0-0.8,0.1-1.6,0.1-2.4c0-0.2,0-0.4,0-0.6c15.2-17.2,34-31.1,55-40.6c0,0.1-0.1,0.1-0.1,0.2
				c-0.2,0.2-0.3,0.5-0.4,0.7c-0.5,0.7-0.9,1.5-1.4,2.2c-0.2,0.3-0.4,0.7-0.6,1c-0.4,0.7-0.8,1.4-1.2,2.1c-0.2,0.3-0.3,0.6-0.5,0.9
				c-0.5,1-1,2-1.5,3c-0.1,0.3-0.2,0.5-0.3,0.8c-0.4,0.8-0.7,1.6-1,2.4c-0.2,0.4-0.3,0.8-0.5,1.1c-0.3,0.7-0.6,1.4-0.8,2.2
				c-0.1,0.4-0.3,0.7-0.4,1.1c-0.4,1-0.7,2.1-1,3.1c-0.1,0.2-0.1,0.5-0.2,0.7c-0.2,0.9-0.5,1.7-0.7,2.6c-0.1,0.4-0.2,0.8-0.3,1.2
				c-0.2,0.8-0.3,1.5-0.5,2.3c-0.1,0.4-0.2,0.7-0.2,1.1c-0.2,1.1-0.4,2.2-0.6,3.3c0,0.1,0,0.3-0.1,0.4c-0.1,1-0.3,2-0.4,3
				c0,0.4-0.1,0.7-0.1,1.1c-0.1,0.8-0.1,1.6-0.2,2.5c0,0.4,0,0.7-0.1,1.1c0,1.1-0.1,2.3-0.1,3.4c0,0,0,0.1,0,0.1
				c0,44.2,36,80.1,80.1,80.1c40,0,73.3-29.5,79.2-68c0.6-4,0.9-8,0.9-12.2c0-1.2,0-2.3-0.1-3.5c0-0.3,0-0.7-0.1-1
				c0-0.8-0.1-1.7-0.2-2.5c0-0.4-0.1-0.7-0.1-1.1c-0.1-1-0.2-2.1-0.4-3.1c0-0.1,0-0.2,0-0.3c-0.2-1.1-0.4-2.2-0.6-3.4
				c-0.1-0.3-0.1-0.7-0.2-1c-0.2-0.8-0.3-1.6-0.5-2.4c-0.1-0.4-0.2-0.7-0.3-1.1c-0.2-0.9-0.5-1.8-0.7-2.7c-0.1-0.2-0.1-0.4-0.2-0.6
				c-0.3-1.1-0.7-2.1-1-3.2c-0.1-0.3-0.2-0.7-0.4-1c-0.3-0.7-0.5-1.5-0.8-2.2c-0.1-0.4-0.3-0.7-0.4-1.1c-0.3-0.8-0.7-1.6-1-2.4
				c-0.1-0.2-0.2-0.5-0.3-0.7c-0.5-1-1-2-1.5-3c-0.2-0.3-0.3-0.6-0.5-0.9c-0.4-0.7-0.8-1.4-1.2-2.1c-0.2-0.3-0.4-0.7-0.6-1
				c-0.4-0.7-0.9-1.5-1.4-2.2c-0.2-0.2-0.3-0.5-0.5-0.7c0-0.1-0.1-0.1-0.1-0.2c21,9.5,39.8,23.3,55,40.6c0,0.2,0,0.4,0,0.6
				c0.1,0.8,0.1,1.7,0.1,2.4C666.1,323.9,611.2,378.8,543.8,378.8z"/>
			<path d="M852.4,529.4l-130.8-135c-8.6-8.9-21.5-16.2-29.4-16.6c-0.7,0-1.4-0.1-2.1-0.1c-4.8,0-11,1-15.3,3.3l-8-8
				c6.3-6.7,12.2-13.9,17.4-21.6l87.1,0c17.2,0,31.3-12.3,31.3-27.5c0-13.1-10.6-24.4-25.2-26.9l-5.2-0.9l-0.6-5.2
				c-1.9-17.8-18.5-31.2-38.5-31.2c-7.1,0-13.9,1.7-19.9,5c0.1-2.7,0.2-5.5,0.2-8.2c0-93.5-76.1-169.6-169.6-169.6
				c-91.9,0-166.9,73.4-169.5,164.7c-2.6-0.6-5.3-0.9-8-0.9c-11.7,0-22.5,5.7-28.4,14.8c-0.8-0.1-1.7-0.2-2.5-0.2
				c-10.2,0-18.5,7.6-18.5,17c0,0.8,0.1,1.5,0.2,2.3c-6.2,4.3-10,11-10,18.2c0,8.6,5.1,16.1,13,20.1c-3,3.4-5.6,7-7.6,11l-5.1,9.9
				l-10.7-3.1c-2.8-0.8-5.1-1.2-7.4-1.2c-12.9,0-23.4,8.8-23.4,19.7c0,1.7,0.4,3.5,1.2,5.7l4.1,11.2l-10.5,5.5
				c-12.1,6.4-19.4,17.4-19.4,29.4c0,19,17.9,34.5,39.8,34.5c0,0,0,0,0,0l147.9,0c23.3,0,42.8-14.6,47.1-33.9
				c21.6,9.4,44.3,14.2,67.6,14.2c45.7,0,87.2-18.1,117.7-47.6l8,8c-2.5,4.8-3.6,11.9-3.2,17.4c0.5,7.9,7.8,20.8,16.6,29.4l135,130.8
				c4.6,4.5,10.7,6.9,17.2,6.9c6.6,0,12.7-2.5,17.2-7.1C861.7,554.4,861.8,539,852.4,529.4z M733.1,267.3c16.1,0,29.4,10.4,30.9,24.3
				l0.9,8.1c0.2,1.7,1.5,3.1,3.2,3.4l8.1,1.4c10.9,1.9,18.9,10,18.9,19.3c0,10.9-10.6,19.8-23.6,19.8l-82.2,0
				c12.5-20.7,20.6-44.2,23.3-69.4C718.2,269.8,725.4,267.3,733.1,267.3z M314.8,302.8c0-5.3,3.2-10.2,8.5-13c1.7-0.9,2.5-2.9,1.8-4.7
				c-0.4-1-0.6-1.9-0.6-2.8c0-5.1,4.8-9.3,10.8-9.3c1,0,2.1,0.2,3.3,0.5c1.8,0.5,3.6-0.3,4.5-1.9c4.1-8,13.2-13.2,23.1-13.2
				c2.7,0,5.3,0.4,8,1.2c0.2,11.1,1.5,22.3,4,33.3c0,0.1,0,0.2,0.1,0.3c0.4,1.7,0.8,3.4,1.2,5.1c0.1,0.2,0.1,0.4,0.2,0.6
				c0.4,1.7,0.9,3.4,1.4,5.1c-2.2-0.4-4.4-0.8-6.7-1c-0.1,0-0.1,0-0.2,0c-1-0.1-2-0.2-3-0.2c-0.2,0-0.4,0-0.6,0
				c-1.1-0.1-2.2-0.1-3.3-0.1c-0.9,0-1.7,0-2.6,0.1c-0.3,0-0.5,0-0.8,0c-0.6,0-1.2,0.1-1.8,0.1c-0.3,0-0.6,0-0.8,0.1
				c-0.7,0.1-1.3,0.1-2,0.2c-0.2,0-0.4,0-0.5,0.1c-0.8,0.1-1.7,0.2-2.5,0.4c-0.2,0-0.4,0.1-0.5,0.1c-0.7,0.1-1.4,0.3-2.1,0.4
				c-0.2,0-0.3,0.1-0.5,0.1c-10.1,2.2-19.4,6.7-26.9,12.9C319.4,314.9,314.8,309.2,314.8,302.8z M469.3,404.5c-0.1,0.4-0.1,0.9-0.2,1.3
				c0,0.4,0,0.8,0.1,1.1c-1.9,17.4-19.2,31-40.2,31L281,438c-17.7,0-32.1-12-32.1-26.9c0-9.1,5.7-17.5,15.3-22.6l13.5-7.1
				c1.7-0.9,2.5-2.9,1.8-4.7l-5.2-14.3c-0.6-1.6-0.7-2.6-0.7-3.1c0-6.6,7-12,15.7-12c1.5,0,3.2,0.3,5.3,0.9l13.8,3.9
				c1.8,0.5,3.6-0.3,4.5-1.9l6.5-12.7c2.5-4.8,5.8-9,9.8-12.7c0.3-0.1,0.5-0.3,0.8-0.5c9.3-8.3,21.8-13.2,34.7-13.9c0.1,0,0.2,0,0.3,0
				c0.8,0,1.6-0.1,2.5-0.1c0.2,0,0.4,0,0.6,0c0.6,0,1.2,0,1.7,0c5.4,0.2,10.8,1.2,15.9,2.8c0,0,0,0,0.1,0c9.8,3.2,18,8.6,23.9,15.6
				c0.2,0.2,0.4,0.5,0.6,0.7c0.2,0.2,0.3,0.4,0.5,0.7c0.3,0.3,0.5,0.7,0.8,1c0.1,0.2,0.2,0.3,0.4,0.5c0.8,1.1,1.5,2.2,2.2,3.3
				c0.1,0.1,0.1,0.2,0.2,0.3c0.3,0.5,0.6,1,0.8,1.5c0.1,0.1,0.1,0.2,0.2,0.3c0.6,1.2,1.2,2.4,1.7,3.7c0,0.1,0.1,0.3,0.1,0.4
				c0.2,0.5,0.4,1,0.5,1.5c0.1,0.1,0.1,0.3,0.1,0.4c0.4,1.2,0.8,2.5,1,3.8c0,0.2,0.1,0.4,0.1,0.6c0.1,0.5,0.2,1,0.3,1.4
				c0,0.2,0.1,0.4,0.1,0.6c0.1,0.6,0.2,1.3,0.3,1.9c0,0,0,0,0,0.1l1.4,13.1c0.2,1.7,1.5,3.1,3.2,3.4l13,2.2
				c18.7,3.2,32.3,17.3,32.3,33.5C469.4,403.9,469.3,404.2,469.3,404.5z M543.8,418.3c-23,0-45.5-4.9-66.7-14.6c0,0,0,0,0,0
				c0,0,0,0,0,0c0-19.9-16.3-37.2-38.7-41.1l-10.1-1.7l-1.1-10.2c0,0,0,0,0-0.1c-0.1-0.7-0.2-1.5-0.3-2.2c0-0.2-0.1-0.4-0.1-0.6
				c-0.1-0.6-0.2-1.2-0.3-1.8c0-0.2-0.1-0.3-0.1-0.5c-0.3-1.6-0.8-3.1-1.3-4.6c0-0.1,0-0.1-0.1-0.2c-2.8-8.6-7.9-16.2-14.9-22.4
				c-0.3-0.3-0.6-0.5-0.9-0.8c-0.2-0.2-0.4-0.3-0.6-0.5c-5.4-4.5-11.7-8.1-18.7-10.6c-0.1-0.2-0.1-0.4-0.2-0.6
				c-0.2-0.5-0.3-0.9-0.4-1.4c-0.2-0.6-0.4-1.2-0.5-1.8c-0.1-0.4-0.3-0.9-0.4-1.3c-0.2-0.6-0.4-1.3-0.5-1.9c-0.1-0.4-0.2-0.8-0.3-1.2
				c-0.2-0.7-0.4-1.4-0.6-2.1c-0.1-0.3-0.2-0.6-0.2-1c-0.2-0.8-0.4-1.6-0.6-2.3c-0.1-0.2-0.1-0.5-0.2-0.7c-0.2-0.9-0.4-1.7-0.6-2.6
				c0-0.2-0.1-0.3-0.1-0.5c-0.2-1-0.4-1.9-0.6-2.9c0-0.1,0-0.1,0-0.2c-1.8-9.6-2.7-19.4-2.8-29.1c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2
				c0-89.3,72.6-161.9,161.9-161.9c89.3,0,161.9,72.6,161.9,161.9c0,5.1-0.2,10.2-0.7,15.2c0,0.1-0.1,0.2-0.1,0.3
				c-2.5,26.1-11.4,51.5-25.9,73.4c0,0,0,0,0,0C649.9,389.3,600.2,418.3,543.8,418.3z M846.9,558.4c-3.1,3.1-7.3,4.8-11.8,4.8
				c-4.5,0-8.7-1.7-11.9-4.8l-135-130.8c-8-7.8-14-19.1-14.3-24.3c-0.4-6.6,1.7-13.1,3.2-14.7c1.3-1.3,6.8-3.3,13.1-3.3
				c0.5,0,1.1,0,1.6,0c5.2,0.3,16.5,6.3,24.3,14.3l130.8,135C853.3,541.3,853.3,552,846.9,558.4z"/>
	</svg>
		<?php
	}
}





/* Add wrapping tag to last element */
function sq_add_wrapping_tag( $content, $delimiter = ' ', $tag = 'span', $echo = true ) {

	$output = $content;
	$comment_span_array = explode($delimiter, $content);

	if ( count($comment_span_array) > 1 ) {
		end($comment_span_array);
		$key = key($comment_span_array);
		reset($comment_span_array);
		$comment_span_array[$key] = '<'. $tag .'>' . $comment_span_array[$key] . '</'. $tag .'>';

		$output = implode(" ", $comment_span_array);
	}
	if ($echo == true) {
		echo $output;
	} else {
		return $output;
	}
}