<?php
/**
 * Functions used in the theme.
 */

function ot_get_option( $option_id, $default = '' ) {

	global $dd_sn;
	global $dd_lang_curr;

	if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
		$option_id_lang = str_replace( $dd_sn, $dd_sn . $dd_lang_curr, $option_id );
	}

	/* get the saved options */ 
	$options = get_option( 'option_tree' );

	/* look for the saved value */
	if ( isset( $option_id_lang ) && isset( $options[$option_id_lang] ) && '' != $options[$option_id_lang] ) {
		return $options[$option_id_lang];
	} else if ( isset( $options[$option_id] ) && '' != $options[$option_id] ) {
		return $options[$option_id];
	} else {
		return $default;
	}

}

function dd_get_image_id( $image_url ) {

	global $wpdb;
	$prefix = $wpdb->prefix;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 
	if ( $attachment )
    	return $attachment[0]; 
    else
    	return 0;

}

if ( ! function_exists( 'dd_theme_pagination' ) ) :

	/**
	 * Template for pagination
	 *
	 * Used everywhere where there is pagination (template-blog.php, archives.php, search.php...)
	 */
	
	function dd_theme_pagination( $pages = '', $range = 2, $force_number = false ) {
			
		global $dd_sn;
		global $paged;

		$pagination_type = ot_get_option( $dd_sn . 'pagination_type', 'prevnext' );

		if ( $pagination_type == 'prevnext' && !$force_number ) {

			?>
				<div id="prevnext-pagination" class="clearfix">
					<div class="fl clearfix"><?php previous_posts_link( __( 'Newer', 'dd_string' ), $pages ); ?></div>
					<div class="fr clearfix"><?php next_posts_link( __( 'Older', 'dd_string' ), $pages ); ?></div>
				</div>
			<?php

		} else {

			$showitems = ($range * 2)+1;  

			global $paged;
			if ( empty ( $paged ) ) { $paged = 1; }

			if ( $pages == '' ) {
				global $wp_query;
				$pages = $wp_query->max_num_pages;
				if( ! $pages ) {
					$pages = 1;
				}
			}

			if( 1 != $pages ) {

				?>
				<div id="pagination">
					<ul class="col-clear">
						<?php

							if($paged > 2 && $paged > $range+1 && $showitems < $pages) { echo "<li><a class='dd-button' href='".get_pagenum_link(1)."'>&laquo;</a></li>"; }
							if($paged > 1 && $showitems < $pages) { echo "<li><a class='dd-button' href='".get_pagenum_link($paged - 1)."' >&lsaquo;</a></li>"; }

							for ($i=1; $i <= $pages; $i++){
								if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)){
									echo ($paged == $i)? "<li class='current'><a class='dd-button inactive' href='".get_pagenum_link($i)."'>".$i."</a></li>":"<li><a class='dd-button inactive' href='".get_pagenum_link($i)."'>".$i."</a></li>";
								}
							}

							if ($paged < $pages && $showitems < $pages) { echo "<li><a class='dd-button' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>"; } 
							if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) { echo "<li><a class='dd-button' href='".get_pagenum_link($pages)."'>&raquo;</a></li>"; }
							
						?>
					</ul>
				</div><!-- #pagination --><?php
			}

		}

	}

endif;

if ( ! function_exists( 'dd_theme_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function dd_theme_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		
		switch ( $comment->comment_type ) :
			
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
					<p><?php _e( 'Pingback:', 'dd_string' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'dd_string' ), ' ' ); ?></p>
				<?php
			break;
			default :
				?>

				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

					<div class="comment-inner">

						<div class="comment-info clearfix">

							<ul class="comment-meta clearfix">
								<li class="comment-author"><span class="comment-author-avatar"><?php echo get_avatar( $comment, 33 ); ?></span><?php echo get_comment_author_link(); ?></li>
								<li class="comment-date"><span class="icon-calendar"></span><?php echo get_comment_date(); ?></li>
							</ul>

							<span class="comment-reply">
								<span class="icon-reply"></span><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</span>

						</div><!-- .comment-info -->

						<div class="comment-main">
							
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<p><em><?php _e( 'Your comment is awaiting moderation.', 'dd_string' ); ?></em></p>
							<?php endif; ?>
							<?php comment_text(); ?>

						</div><!-- .comment-main -->

					</div><!-- .comment-inner -->

				<?php

				break;
		endswitch;

	}

endif;

if ( ! function_exists( 'dd_dribbble_shots' ) ) :

	/**
	 * Show Dribbble shots
	 *
	 * Original code from ThemeZilla
	 * http://www.themezilla.com/plugins/zilladribbbler/
	 */
	function dd_dribbble_shots( $player, $shots ) {

		global $dd_sn;
		
		$key = $dd_sn . 'dribbble_' . $player;
		$shots_cache = get_transient($key);

		if( $shots_cache === false ) {
			$url 		= 'http://api.dribbble.com/players/' . $player . '/shots/?per_page=15';
			$response 	= wp_remote_get( $url );

			if( is_wp_error( $response ) ) {
				return;
			}

			$xml = wp_remote_retrieve_body( $response );

			if( is_wp_error( $xml ) ) {
				return;
			}

			if( $response['headers']['status'] == 200 ) {

				$json = json_decode( $xml );
				$dribbble_shots = $json->shots;

				set_transient($key, $dribbble_shots, 60*5);
			}
		} else {
			$dribbble_shots = $shots_cache;
		}

		if( $dribbble_shots ) {
			$i = 0;
			$output = '<ul class="dribbble-feed">';

			foreach( $dribbble_shots as $dribbble_shot ) {
				
				if( $i == $shots ) {
					break;
				}

				$output .= '<li>';
				$output .= '<a href="' . $dribbble_shot->url . '">';
				$output .= '<img height="' . $dribbble_shot->height . '" width="' . $dribbble_shots[$i]->width . '" src="' . $dribbble_shot->image_url . '" alt="' . $dribbble_shot->title . '" />';
				$output .= '</a>';
				$output .= '</li>';
				
				$i++;
			}

			$output .= '</ul>';
		} else {
			$output = '<em>' . __('Error retrieving Dribbble shots', 'zilla') . '</em>';
		}

		return $output;
	}

endif;

/**
 * dd_get_calendar
 *
 * Get calendar for custom post types.
 * Original code from http://bajada.net/2010/07/15/adding-custom-post-types-to-get_calendar-and-the-calendar-widget
 */
function dd_get_calendar( $post_types = '' , $initial = true , $echo = true, $dd_month = false, $dd_year = false ) {

	global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

	$not_this_month = false;

	if ( $dd_month !== false && $dd_year !== false ) {

		$monthnum = $dd_month;
		$year = $dd_year;
		$not_this_month = true;

	}

	$dd_events_page = get_permalink( dd_get_post_id( 'template', 'template-dd_events.php' ) );

	/**
	 * Which post types to look for?
	 */

	// None supplied, get them all
	if ( empty( $post_types ) || !is_array( $post_types ) ) {

		$args = array(
		'public' => true ,
		'_builtin' => false
		);

		$output = 'names';
		$operator = 'and';

		$post_types = get_post_types( $args , $output , $operator );
		$post_types = array_merge( $post_types , array( 'post' ) );

	// Post types supplied, check if real
	} else {

		$my_post_types = array();
		foreach ( $post_types as $post_type ) {
			if ( post_type_exists( $post_type ) ) {
				$my_post_types[] = $post_type;
			}
		}
		$post_types = $my_post_types;

	}

	/**
	 * Array to string
	 */

	$post_types_key = implode( '' , $post_types );
	$post_types = "'" . implode( "' , '" , $post_types ) . "'";

	/**
	 * Check cache
	 */

	$cache = array();
	$key = md5( $m . $monthnum . $year . $post_types_key );

	if ( $cache = wp_cache_get( 'get_calendar' , 'calendar' ) ) {
		
		if ( is_array( $cache ) && isset( $cache[$key] ) ) {
			
			remove_filter( 'get_calendar' , 'ucc_get_calendar_filter' );
			$output = apply_filters( 'get_calendar',  $cache[$key] );
			add_filter( 'get_calendar' , 'ucc_get_calendar_filter' );
			
			if ( $echo ) {
				echo $output;
				return;
			} else {
				return $output;
			}

		}

	}

	if ( !is_array( $cache ) ) {
		$cache = array();
	}

	/**
	 * Check if there are any posts at all (bye bye if not)
	 */

	if ( !$posts ) {
		
		$sql = "SELECT 1 as test FROM $wpdb->posts WHERE post_type IN ( $post_types ) AND ( post_status = 'publish' OR post_status = 'future' ) LIMIT 1";
		$gotsome = $wpdb->get_var( $sql );
		if ( !$gotsome ) {
			$cache[$key] = '';
			wp_cache_set( 'get_calendar' , $cache , 'calendar' );
			return;
		}

	}

	/**
	 * Not sure if relevant here
	 */

	if ( isset( $_GET['w'] ) ) {
		$w = '' . intval( $_GET['w'] );
	}

	// week_begins = 0 stands for Sunday
	$week_begins = intval( get_option( 'start_of_week' ) );

	
	/**
	 * Current day, month and year
	 */

	if ( !empty( $monthnum ) && !empty( $year ) ) {
		$thismonth = '' . zeroise( intval( $monthnum ) , 2 );
		$thisyear = ''.intval($year);
	} elseif ( !empty( $w ) ) {
		// We need to get the month from MySQL
		$thisyear = '' . intval( substr( $m , 0 , 4 ) );
		$d = ( ( $w - 1 ) * 7 ) + 6; //it seems MySQL's weeks disagree with PHP's
		$thismonth = $wpdb->get_var( "SELECT DATE_FORMAT( ( DATE_ADD( '${thisyear}0101' , INTERVAL $d DAY ) ) , '%m' ) " );
	} elseif ( !empty( $m ) ) {
		$thisyear = '' . intval( substr( $m , 0 , 4 ) );
		if ( strlen( $m ) < 6 )
		$thismonth = '01';
		else
		$thismonth = '' . zeroise( intval( substr( $m , 4 , 2 ) ) , 2 );
	} else {
		$thisyear = gmdate( 'Y' , current_time( 'timestamp' ) );
		$thismonth = gmdate( 'm' , current_time( 'timestamp' ) );
	}

	$unixmonth = mktime( 0 , 0 , 0 , $thismonth , 1 , $thisyear);

	
	/**
	 * Get previous and next months that have posts
	 */

	$previous = $wpdb->get_row( "SELECT DISTINCT MONTH( post_date ) AS month , YEAR( post_date ) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type IN ( $post_types ) AND ( post_status = 'publish' OR post_status = 'future' )
		ORDER BY post_date DESC
		LIMIT 1" );

	$next = $wpdb->get_row( "SELECT DISTINCT MONTH( post_date ) AS month, YEAR( post_date ) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-01'
		AND MONTH( post_date ) != MONTH( '$thisyear-$thismonth-01' )
		AND post_type IN ( $post_types ) AND ( post_status = 'publish' OR post_status = 'future' )
		ORDER  BY post_date ASC
		LIMIT 1"
	);

	/**
	 * Start the table
	 */

	if ( $previous ) {
		$previous_month_link = '<a class="events-prev-month" href="#" data-month="' . $previous->month . '" data-year="' . $previous->year . '"><span class="icon-chevron-left"></span></a>';
	} else {
		$previous_month_link = '';
	}

	if ( $next ) {
		$next_month_link = '<a class="events-next-month" href="#" data-month="' . $next->month . '" data-year="' . $next->year . '"><span class="icon-chevron-right"></span></a>';
	} else {
		$next_month_link = '';
	}

	$calendar_caption = _x( '%1$s %2$s' , 'calendar caption', 'dd_string' );
	$calendar_output = '<div class="events-calendar">
		<div class="events-calendar-caption">
			' . sprintf( $calendar_caption , $wp_locale->get_month( $thismonth ) , date( 'Y' , $unixmonth ) ) . $previous_month_link . $next_month_link . '
		</div>
		<table id="wp-calendar">
			<thead>
				<tr>';

	/**
	 * Get days of the week
	 */

	$myweek = array();

	for ( $wdcount = 0 ; $wdcount <= 6 ; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday( ( $wdcount + $week_begins ) % 7 );
	}

	/**
	 * Generate columns for each day of the week
	 */

	foreach ( $myweek as $wd ) {
		$day_name = ( true == $initial ) ? $wp_locale->get_weekday_initial( $wd ) : $wp_locale->get_weekday_abbrev( $wd );
		$wd = esc_attr( $wd );
		$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
	}

	/**
	 * Close table head and start table foot
	 */

	$calendar_output .= '
	</tr>
	</thead>

	<tfoot>
	<tr>';

	/**
	 * Links to previous and next month with posts
	 */

	if ( $previous ) {
		$calendar_output .= "\n\t\t" . '<td colspan="3" class="prev-month"><a href="#" data-month="' . $previous->month . '" data-year="' . $previous->year . '" title="' . sprintf( __( 'View posts for %1$s %2$s', 'dd_string' ) , $wp_locale->get_month( $previous->month ) , date( 'Y' , mktime( 0 , 0 , 0 , $previous->month , 1 , $previous->year ) ) ) . '">&laquo; ' . $wp_locale->get_month_abbrev( $wp_locale->get_month( $previous->month ) ) . '</a></td>';
	} else {
		$calendar_output .= "\n\t\t" . '<td colspan="3" class="prev-month pad">&nbsp;</td>';
	}

	$calendar_output .= "\n\t\t" . '<td class="pad">&nbsp;</td>';

	if ( $next ) {
		$calendar_output .= "\n\t\t" . '<td colspan="3" class="next-month"><a href="#" data-month="' . $next->month . '" data-year="' . $next->year . '" title="' . esc_attr( sprintf( __( 'View posts for %1$s %2$s', 'dd_string' ) , $wp_locale->get_month( $next->month ) , date( 'Y' , mktime( 0 , 0 , 0 , $next->month , 1 , $next->year ) ) ) ) . '">' . $wp_locale->get_month_abbrev( $wp_locale->get_month( $next->month ) ) . ' &raquo;</a></td>';
	} else {
		$calendar_output .= "\n\t\t" . '<td colspan="3" class="next-month" class="pad">&nbsp;</td>';
	}

	/**
	 * Close table foot and start table body
	 */

	$calendar_output .= '
		</tr>
		</tfoot>

		<tbody>
		<tr>';

	/**
	 * The MySQL date (31 days from today)
	 */

	if ( $not_this_month ) {
		$date_before = gmdate( 'Y-m-d H:i:s', mktime(23, 59, 59, $thismonth, 31, $thisyear) );
	} else {
		$date_before = gmdate( 'Y-m-d H:i:s', ( time() + 31 * 24 * 60 * 60 ) );
	}

	/**
	 * Get days that have a post (look in next 31 days)
	 */

	$dayswithposts = $wpdb->get_results( "SELECT DISTINCT DAYOFMONTH( post_date )
		FROM $wpdb->posts WHERE MONTH( post_date ) = '$thismonth'
		AND YEAR( post_date ) = '$thisyear'
		AND post_type IN ( $post_types ) AND ( post_status = 'publish' OR post_status = 'future' )
		AND post_date <= '" . $date_before . '\'', ARRAY_N 
	);	



	/**
	 * Make a simple array of dates with posts
	 */

	if ( $dayswithposts ) {
		foreach ( (array) $dayswithposts as $daywith ) $daywithpost[] = $daywith[0];
	} else {
		$daywithpost = array();
	}

	/**
	 * Browser stuff
	 */

	if ( strpos( $_SERVER['HTTP_USER_AGENT'] , 'MSIE' ) !== false || stripos( $_SERVER['HTTP_USER_AGENT'] , 'camino' ) !== false || stripos( $_SERVER['HTTP_USER_AGENT'] , 'safari' ) !== false ) {
		$ak_title_separator = "\n";
	} else {
		$ak_title_separator = ', ';
	}

	/**
	 * Get titles of the posts
	 */

	$ak_post_titles = $wpdb->get_results( "SELECT ID, post_title, DAYOFMONTH( post_date ) as dom "
		. "FROM $wpdb->posts "
		. "WHERE YEAR( post_date ) = '$thisyear' "
		. "AND MONTH( post_date ) = '$thismonth' "
		. "AND post_date < '" . $date_before . "' "
		. "AND post_type IN ( $post_types ) AND ( post_status = 'publish' || post_status = 'future' )"
	);

	/**
	 * Make a simpler array of the post titles
	 */

	$ak_titles_for_day = array();

	if ( $ak_post_titles ) {
		
		foreach ( (array) $ak_post_titles as $ak_post_title ) {

			$post_title = esc_attr( apply_filters( 'the_title' , $ak_post_title->post_title , $ak_post_title->ID ) );

			if ( empty( $ak_titles_for_day['day_' . $ak_post_title->dom] ) ) {
				$ak_titles_for_day['day_'.$ak_post_title->dom] = '';
			}

			if ( empty( $ak_titles_for_day["$ak_post_title->dom"] ) ) {
				$ak_titles_for_day["$ak_post_title->dom"] = $post_title;
			} else {
				$ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
			}
			
		}
	}

	
	/**
	 * Days of the week that are in the previous month
	 */

	$pad = calendar_week_mod( date( 'w' , $unixmonth ) - $week_begins );
	
	if ( 0 != $pad ) {
		$calendar_output .= "\n\t\t" . '<td colspan="' . esc_attr( $pad ) . '" class="pad">&nbsp;</td>';
	}

	/**
	 * Go through each day of the current month
	 */

	$daysinmonth = intval( date( 't' , $unixmonth ) );

	$dd_in_past = false;

	if ( $thisyear < gmdate( 'Y' ) || ( $thismonth < gmdate( 'm' ) && $thisyear == gmdate( 'Y' ) ) ) {
		$dd_in_past = true;
	}

	if ( $dd_in_past ) {
		if ( $thisyear == gmdate( 'Y' ) ) {
			$dd_events_page_link = add_query_arg( array( 'dd_get' => 'past', 'dd_month' => $thismonth ), $dd_events_page );
		} else {
			$dd_events_page_link = add_query_arg( array( 'dd_get' => 'past', 'dd_month' => $thismonth, 'dd_year' => $thisyear ), $dd_events_page );
		}
	} else {
		$dd_events_page_link = add_query_arg( array( 'dd_month' => $thismonth, 'dd_year' => $thisyear ), $dd_events_page );
	}


	for ( $day = 1 ; $day <= $daysinmonth ; ++$day ) {

		// Add a new row
		if ( isset( $newrow ) && $newrow ) {
			$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
		}

		$newrow = false;

		/**
		 * Column
		 */

		// Today
		if ( $day == gmdate( 'j' , current_time( 'timestamp' ) ) && $thismonth == gmdate( 'm' , current_time( 'timestamp' ) ) && $thisyear == gmdate( 'Y' , current_time( 'timestamp' ) ) ) {
			if ( in_array( $day , $daywithpost ) ) {
				$calendar_output .= '<td class="current"><a href="' . $dd_events_page_link . '" data-day="' . $day . ' ' . $thismonth . ' ' . $thisyear . '">' . $day . '</a></td>';
			} else {
				$calendar_output .= '<td class="current">' . $day . '</td>';
			}
		// Not today but has a post
		} elseif ( in_array( $day , $daywithpost ) ) {
			$calendar_output .= '<td class="has-posts"><a href="' . $dd_events_page_link . '" data-day="' . $day . ' ' . $thismonth . ' ' . $thisyear . '" title="' . esc_attr( $ak_titles_for_day[$day] ) . '">' . $day . '</a></td>';

		// Not today and does not have a post
		} else {
			$calendar_output .= '<td>' . $day . '</td>';
		}

		// Close row and open up a new one in the next turn
		if ( 6 == calendar_week_mod( date( 'w' , mktime( 0 , 0 , 0 , $thismonth , $day , $thisyear ) ) - $week_begins ) ) {
			$newrow = true;
		}

	}

	/**
	 * Days of the week in the next month
	 */

	$pad = 7 - calendar_week_mod( date( 'w' , mktime( 0 , 0 , 0 , $thismonth , $day , $thisyear ) ) - $week_begins );
	
	if ( $pad != 0 && $pad != 7 ) {
		$calendar_output .= "\n\t\t" . '<td class="pad" colspan="' . esc_attr( $pad ) . '">&nbsp;</td>';
	}

	/**
	 * Close up the table body
	 */

	$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table></div>";

	/**
	 * Cache stuff
	 */

	$cache[$key] = $calendar_output;
	wp_cache_set( 'get_calendar' , $cache, 'calendar' );

	/**
	 * Filtering
	 */

	remove_filter( 'get_calendar' , 'ucc_get_calendar_filter' );
	$output = apply_filters( 'get_calendar',  $calendar_output );
	add_filter( 'get_calendar' , 'ucc_get_calendar_filter' );

	/**
	 * Echo/Return the generated output
	 */

	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}

}

function dd_twitter_api( $args ) {

	global $dd_sn;

	add_filter( 'https_ssl_verify', '__return_false' );
	add_filter( 'https_local_ssl_verify', '__return_false' );

	// Include Twitter API Client
	require_once( get_template_directory() . '/inc/class-wp-twitter-api.php' );

	// Set your personal data retrieved at https://dev.twitter.com/apps
	$credentials = array(
	  'consumer_key'    =>  ot_get_option( $dd_sn . 'footer_twitter_key' ),
	  'consumer_secret' =>  ot_get_option( $dd_sn . 'footer_twitter_secret' )
	);

	// Let's instantiate our class with our credentials
	$twitter_api = new Wp_Twitter_Api( $credentials );

	if ( $args['position'] == 'footer' ) :

		$query = 'count=10&include_entities=true&include_rts=true&screen_name=' . ot_get_option( $dd_sn . 'footer_twitter_profile' );
		$result = $twitter_api->query( $query );	

		?>
			<div class="footer-twitter-profile"><span class="icon-social-twitter"></span>@<?php echo $result[0]->user->screen_name; ?></div>
			<div class="footer-twitter-tweets">
				<div class="flexslider">
					<ul class="slides">
						<?php foreach ( $result as $key => $value) : ?>
							<li>
								<span class="footer-twitter-tweet">&quot;<?php echo $value->text; ?>&quot;</span>
								<span class="footer-twitter-date"><?php echo date('M d', strtotime( $value->created_at )); ?></span>
							</li>
						<?php endforeach; ?>
					</ul><!-- .slides -->
				</div><!-- .flexslider -->
			</div><!-- .footer-twitter-tweets -->
			<div class="footer-twitter-nav">
				<a href="#" class="footer-twitter-nav-prev"><span class="icon-chevron-left"></span></a>
				<a href="#" class="footer-twitter-nav-next"><span class="icon-chevron-right"></span></a>
			</div><!-- .footer-twitter-nav -->
		<?php

	endif;


}

function dd_months_with_events() {

	global $wpdb;

	if ( isset( $_GET['dd_year'] ) && is_numeric( $_GET['dd_year'] ) ) {
		$year = $_GET['dd_year'];
	} else {
		$year = gmdate( 'Y' , current_time( 'timestamp' ) );
	}

	$month = gmdate( 'm' , current_time( 'timestamp' ) );

	$day = gmdate( 'd', current_time( 'timestamp' ) );

	if ( $year > gmdate( 'Y', current_time( 'timestamp' ) ) ) {
		$month = 01;
		$day = 01;
	}

	$results = $wpdb->get_results( "SELECT MONTH( post_date ) AS month
		FROM $wpdb->posts 
		WHERE YEAR( post_date ) = '$year'
		AND MONTH ( post_date ) >= '$month'
		AND ( DAY ( post_date ) >= '$day' OR MONTH ( post_date ) > '$month' )
		AND post_type IN ( 'dd_events' ) AND ( post_status = 'publish' OR post_status = 'future' )" );

	$response = array();

	foreach ( $results as $result ) {
		$response[] = $result->month;
	}

	return $response;

}

function dd_years_with_events() {

	global $wpdb;

	$results = $wpdb->get_results( "SELECT DISTINCT YEAR( post_date ) AS year
		FROM $wpdb->posts 
		WHERE post_type IN ( 'dd_events' ) AND ( post_status = 'publish' OR post_status = 'future' )" );

	$response = array();

	sort( $results );

	foreach ( $results as $result ) {
		$response[] = $result->year;
	}

	return $response;

}

function dd_is_subpage() {
	
	global $post;

	if ( is_page() && $post->post_parent ) {
		return $post->post_parent;
	} else {
		return false;
	}
}

// logs a member in after submitting a form
function dd_login_init() {

	// If a login action is NOT going on stop the script
	if ( ! isset( $_POST['dd_login_user'] ) ) {
 		return;
	}

	// Did not come from the login form, shut it down
	if ( ! wp_verify_nonce( $_POST['dd_login_nonce'], 'dd_login_nonce') ) {
		exit( 'Uhmm... You should not be here.' );
	}

	$redirect = $_POST['dd_login_redirect'];
	$redirect = remove_query_arg( array( 'dslc_login_u_error', 'dslc_login_p_error' ), $redirect );
	$success = true;	

	// If username NOT set or empty
	if ( ! isset( $_POST['dd_login_user'] ) || $_POST['dd_login_user'] == '' ) {
		
		$success = false;
		$redirect = add_query_arg( 'dslc_login_u_error', 'notset', $redirect );

	// If username set
	} else {

		// Get user info
		$user = get_user_by( 'login', sanitize_text_field( $_POST['dd_login_user'] ) );

		// If user does NOT exist
		if ( ! $user ) {

			$success = false;
			$redirect = add_query_arg( 'dslc_login_u_error', 'wrong', $redirect );

		}

	}

	// Password not set or empty
	if ( !isset( $_POST['dd_login_pass'] ) || $_POST['dd_login_pass'] == '' ) {
		
		$success = false;
		$redirect = add_query_arg( 'dslc_login_p_error', 'notset', $redirect );

	}

	// If all went fine, check password
	if ( $success ) {

		// If password wrong
		if ( ! wp_check_password( $_POST['dd_login_pass'], $user->user_pass, $user->ID ) ) {
			
			$success = false;
			$redirect = add_query_arg( 'dslc_login_p_error', 'wrong', $redirect );

		}

	}

	// Log in the user
	if ( $success ) {

		wp_set_auth_cookie( $user->ID );
		wp_set_current_user( $user->ID, $_POST['dd_login_user'] );

		do_action( 'wp_login', $_POST['dd_login_user'] );

		wp_redirect( $redirect ); exit;

	} else {

		wp_redirect( $redirect ); exit;		

	}

}
add_action( 'init', 'dd_login_init' );

function dd_revslider_get_slides() {

	if ( shortcode_exists( 'rev_slider' ) ) {

		global $wpdb;

		$table_name = $wpdb->prefix . 'revslider_sliders';

		$results = $wpdb->get_results( "SELECT id, title, alias FROM $table_name" );

		return $results;

	} else {

		return array();

	}

}

function dd_get_adjacent_post( $in_same_cat = false, $excluded_categories = '', $previous = true ) {
	global $wpdb;

	if ( ! $post = get_post() )
		return null;

	$current_post_date = $post->post_date;

	$join = '';
	$posts_in_ex_cats_sql = '';
	if ( $in_same_cat || ! empty( $excluded_categories ) ) {
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

		if ( $in_same_cat ) {
			if ( ! is_object_in_taxonomy( $post->post_type, 'category' ) )
				return '';
			$cat_array = wp_get_object_terms($post->ID, 'category', array('fields' => 'ids'));
			if ( ! $cat_array || is_wp_error( $cat_array ) )
				return '';
			$join .= " AND tt.taxonomy = 'category' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
		}

		$posts_in_ex_cats_sql = "AND tt.taxonomy = 'category'";
		if ( ! empty( $excluded_categories ) ) {
			if ( ! is_array( $excluded_categories ) ) {
				// back-compat, $excluded_categories used to be IDs separated by " and "
				if ( strpos( $excluded_categories, ' and ' ) !== false ) {
					_deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded categories.' ), "'and'" ) );
					$excluded_categories = explode( ' and ', $excluded_categories );
				} else {
					$excluded_categories = explode( ',', $excluded_categories );
				}
			}

			$excluded_categories = array_map( 'intval', $excluded_categories );

			if ( ! empty( $cat_array ) ) {
				$excluded_categories = array_diff($excluded_categories, $cat_array);
				$posts_in_ex_cats_sql = '';
			}

			if ( !empty($excluded_categories) ) {
				$posts_in_ex_cats_sql = " AND tt.taxonomy = 'category' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
			}
		}
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	$join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
	$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND ( p.post_status = 'publish' || p.post_status = 'future' ) $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_cat, $excluded_categories );
	$sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.ID FROM $wpdb->posts AS p $join $where $sort";
	$query_key = 'adjacent_post_' . md5($query);
	$result = wp_cache_get($query_key, 'counts');
	if ( false !== $result ) {
		if ( $result )
			$result = get_post( $result );
		return $result;
	}

	$result = $wpdb->get_var( $query );
	if ( null === $result )
		$result = '';

	wp_cache_set($query_key, $result, 'counts');

	if ( $result )
		$result = get_post( $result );

	return $result;
}

/**
 * Add commas to donation amount
 */

function dd_add_commas( $amount ) {

	global $dd_sn;

	if ( ot_get_option( $dd_sn . 'causes_donation_amount_commas', 'disabled' ) == 'enabled' )
		return number_format( $amount );
	else
		return $amount;

}