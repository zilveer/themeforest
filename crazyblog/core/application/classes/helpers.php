<?php
if ( !function_exists( 'crazyblog_opt' ) ) {

	function crazyblog_opt() {
		return get_option( 'wp_crazyblog_theme_options' );
	}

}

if ( !function_exists( 'crazyblog_set' ) ) {

	function crazyblog_set( $var, $key, $def = '' ) {
		if ( !$var )
			return false;
		if ( is_object( $var ) && isset( $var->$key ) )
			return $var->$key;
		elseif ( is_array( $var ) && isset( $var[$key] ) )
			return $var[$key];
		elseif ( $def )
			return $def;
		else
			return false;
	}

}

if ( !function_exists( 'printr' ) ) {

	function printr( $data ) {
		echo '<pre>';
		print_r( $data );
		exit;
	}

}

function crazyblog_get_registered_authors() {
	global $wpdb;
	$authors = $wpdb->get_results( "SELECT ID, user_nicename from $wpdb->users ORDER BY display_name" );
	$author_array = array();
	if ( !empty( $authors ) ) {
		foreach ( $authors as $author ) { //printr($author);
			$author_array[crazyblog_set( $author, 'ID' )] = crazyblog_set( $author, 'user_nicename' );
		}
	}
	return $author_array;
}

function vp_get_crazyblog_icons() {
// scrape list of icons from fontawesome css
	if ( false === ( $icons = get_transient( 'vp_get_crazyblog_icons' ) ) ) {
		$pattern = '/\.(ti-(?:\w+(?:-)?)+):before\s*{\s*content/';
		$subject = wp_remote_get( VP_URL . '/public/css/themify-icons.css' );
		preg_match_all( $pattern, crazyblog_set( $subject, 'body' ), $matches, PREG_SET_ORDER );
		$icons = array();
		foreach ( $matches as $match ) {
			$icons[] = array( 'value' => $match[1], 'label' => $match[1] );
		}
		set_transient( 'vp_crazyblog_icons', $icons, 60 * 60 * 24 );
	}
	return $icons;
}

// Get Registered Sidebar
function crazyblog_get_sidebars( $multi = false ) {
//global $wp_registered_sidebars;
//printr($wp_registered_sidebars);
	$sidebars = get_option( 'wp_registered_sidebars' );
//printr($sidebars);
	if ( $multi )
		$data[] = array( 'value' => '', 'label' => esc_html__( 'No Sidebar', 'crazyblog' ) );
	else
		$data = array( '' => esc_html__( 'No Sidebar', 'crazyblog' ) );
	foreach ( (array) $sidebars as $k => $v ) {
		if ( $multi )
			$data[] = array( 'value' => $k, 'label' => $v );
		else
			$data[$k] = $v;
	}
	return $data;
}

function crazyblog_get_posts_array( $post_type = 'post', $flip = false ) {
	global $wpdb;
	$res = $wpdb->get_results( $wpdb->prepare( "SELECT `ID`, `post_title` FROM `" . $wpdb->prefix . "posts` WHERE `post_type` = '%s' AND `post_status` = 'publish' ", $post_type ), ARRAY_A );
	$return = array();
	foreach ( $res as $k => $r ) {
		if ( $flip ) {
			if ( isset( $return[crazyblog_set( $r, 'post_title' )] ) )
				$return[crazyblog_set( $r, 'post_title' ) . $k] = crazyblog_set( $r, 'ID' );
			else
				$return[crazyblog_set( $r, 'post_title' )] = crazyblog_set( $r, 'ID' );
		} else
			$return[crazyblog_set( $r, 'ID' )] = crazyblog_set( $r, 'post_title' );
	}
	return $return;
}

function character_limiter( $str, $n = 500, $end_char = '&#8230;', $allowed_tags = false, $dots = true ) {
	if ( $allowed_tags )
		$str = strip_tags( $str, $allowed_tags );
	if ( strlen( $str ) < $n )
		return $str;
	$str = preg_replace( "/\s+/", ' ', str_replace( array( "\r\n", "\r", "\n" ), ' ', $str ) );
	if ( strlen( $str ) <= $n )
		return $str;
	$out = "";
	foreach ( explode( ' ', trim( $str ) ) as $val ) {
		$out .= $val . ' ';
		if ( strlen( $out ) >= $n ) {
			$out = trim( $out );
			return (strlen( $out ) == strlen( $str )) ? $out : $out;
		}
	}
}

function crazyblog_get_breadcrumbs() {
	global $wp_query;
	$queried_object = get_queried_object();
	$breadcrumb = '';
	$delimiter = ' / ';
	$before = '';
	$after = '';
	if ( !is_home() || $wp_query->is_posts_page ) {
		$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( home_url( '/' ) ) . '"><span itemprop="title">' . esc_html__( 'Home', 'crazyblog' ) . '</span></a></li>';
		/** If category or single post */
		if ( is_category() ) {
			$cat_obj = $wp_query->get_queried_object();
			$this_category = get_category( $cat_obj->term_id );
			if ( $this_category->parent != 0 ) {
				$parent_category = get_category( $this_category->parent );
				$breadcrumb .= get_category_parents( $parent_category, TRUE, $delimiter );
			}
			$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( get_category_link( get_query_var( 'cat' ) ) ) . '"><span itemprop="title">' . single_cat_title( '', FALSE ) . '</span></a></li>';
		} elseif ( is_tax() ) {
			$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( get_term_link( $queried_object ) ) . '"><span itemprop="title">' . $queried_object->name . '</span></a></li>';
		} elseif ( is_page() ) {
			global $post;
			if ( $post->post_parent ) {
				$anc = get_post_ancestors( $post->ID );
				foreach ( $anc as $ancestor ) {
					$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( get_permalink( $ancestor ) ) . '"><span itemprop="title">' . get_the_title( $ancestor ) . ' / </span></a></li>';
				}
				$breadcrumb .= '<li><a itemprop="url"  href="javascript:void(0)"><span itemprop="title">' . get_the_title( $post->ID ) . '</span></a></li>';
			} else
				$breadcrumb .= '<li><a itemprop="url"  href="javascript:void(0)"><span itemprop="title">' . get_the_title() . '</span></a></li>';
		}
		elseif ( is_singular() ) {

			if ( $category = wp_get_object_terms( get_the_ID(), array( 'category', 'category' ) ) ) {
				if ( !is_wp_error( $category ) ) {
					$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( get_term_link( crazyblog_set( $category, '0' ) ) ) . '"><span itemprop="title">' . crazyblog_set( crazyblog_set( $category, '0' ), 'name' ) . ' </span></a></li>';
					$breadcrumb .= '<li><a itemprop="url"  href="javascript:void(0)"><span itemprop="title"><span itemprop="title">' . get_the_title() . '</span></a></li>';
				}
			} else {
				$breadcrumb .= '<li><a itemprop="url"  href="javascript:void(0)"><span itemprop="title"><span itemprop="title">' . get_the_title() . '</span></a></li>';
			}
		} elseif ( is_tag() )
			$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( get_term_link( $queried_object ) ) . '"><span itemprop="title">' . single_tag_title( '', FALSE ) . '</span></a></li>'; /*			 * If tag template */
		elseif ( is_day() )
			$breadcrumb .= '<li><a itemprop="url"  href="javascript:void(0)"><span itemprop="title">' . esc_html__( 'Archive for ', 'crazyblog' ) . get_the_time( 'F jS, Y' ) . '</span></a></li>';/** If daily Archives */
		elseif ( is_month() )
			$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '"><span itemprop="title">' . esc_html__( 'Archive for ', 'crazyblog' ) . get_the_time( 'F, Y' ) . '</span></a></li>';/** If montly Archives */
		elseif ( is_year() )
			$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '"><span itemprop="title">' . esc_html__( 'Archive for ', 'crazyblog' ) . get_the_time( 'Y' ) . '</span></a></li>';/** If year Archives */
		elseif ( is_author() )
			$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '"><span itemprop="title">' . esc_html__( 'Archive for ', 'crazyblog' ) . get_the_author() . '</span></a></li>';/** If author Archives */
		elseif ( is_search() )
			$breadcrumb .= '<li><span>' . esc_html__( 'Search Results for ', 'crazyblog' ) . '"' . get_search_query() . '"</span></li>';/** if search template */
		elseif ( is_404() )
			$breadcrumb .= '<li><a itemprop="url"  href="javascript:void(0)"><span itemprop="title">' . esc_html__( '404 - Not Found', 'crazyblog' ) . '</span></a></li>';/** if search template */
		elseif ( is_post_type_archive( 'product' ) ) {
			$shop_page_id = woocommerce_get_page_id( 'shop' );
			if ( get_option( 'page_on_front' ) !== $shop_page_id ) {
				$shop_page = get_post( $shop_page_id );
				$_name = woocommerce_get_page_id( 'shop' ) ? get_the_title( woocommerce_get_page_id( 'shop' ) ) : '';
				if ( !$_name ) {
					$product_post_type = get_post_type_object( 'product' );
					$_name = $product_post_type->labels->singular_name;
				}
				if ( is_search() ) {
					$breadcrumb .= $before . '<li><a itemprop="url"  href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '"><span itemprop="title">' . $_name . '</span></a></li>' . $delimiter . esc_html__( 'Search results for &ldquo;', 'crazyblog' ) . get_search_query() . '&rdquo;' . $after;
				} elseif ( is_paged() ) {
					$breadcrumb .= $before . '<li><a itemprop="url"  href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '"><span itemprop="title">' . $_name . '</span></a></li>' . $after;
				} else {
					$breadcrumb .= $before . '<li><a itemprop="url"  href="javascript:void(0);"><span itemprop="title">' . $_name . '</span></a></li>' . $after;
				}
			}
		} elseif ( $wp_query->is_posts_page ) {
			$query_obj = $wp_query->get_queried_object();
			$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( $query_obj->guid ) . '"><span itemprop="title">' . $query_obj->post_title . '</a></li>';
		} else
			$breadcrumb .= '<li><a itemprop="url"  href="' . esc_url( get_permalink() ) . '"><span itemprop="title">' . get_the_title() . '</span></a></li>';/** Default value */
	}
	return '<ul class="breadcrumbs" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">' . $breadcrumb . '</ul>';
}

function crazyblog_comments_count( $postid ) {
	$comments = wp_count_comments( $postid );
	return $comments->approved;
}

function _the_pagination( $args = array(), $echo = 1, $custom_qurey = false ) {
	global $wp_query, $wp_rewrite;
	$current = max( 1, get_query_var( 'paged' ) );
	$default = array( 'base' => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ), 'format' => '?paged=%#%', 'current' => $current, 'total' => crazyblog_set( $args, 'total' ), 'show_all' => false, 'end_size' => 2, 'mid_size' => 2, 'total' => crazyblog_set( $args, 'total' ), 'next_text' => esc_html__( 'Next', 'crazyblog' ), 'prev_text' => esc_html__( 'Previous', 'crazyblog' ), 'type' => 'array' );
	$pagination = wp_parse_args( $args, $default );

	if ( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	if ( !empty( $wp_query->query_vars['s'] ) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	$pages = paginate_links( $pagination );

	if ( !empty( $pages ) ) {
		echo '<div class="custom-pagi"><ul class="pagination">';
		if ( $current == 1 )
			echo '<li><a href="javascript:void(0)" class="prev page-numbers">' . esc_html__( 'Previous', 'crazyblog' ) . '</a></li>';
		$counter = 0;
		foreach ( $pages as $page ) :
			if ( $current > 1 && $counter == 0 ) {
				echo '<li>' . $page . '</li>';
			} else {
				echo '<li>' . $page . '</li>';
			}
			$counter++;
		endforeach;

		if ( $current == crazyblog_set( $args, 'total' ) )
			echo '<li><a href="javascript:void(0)" class="next page-numbers">' . esc_html__( 'Next', 'crazyblog' ) . '</a></li>';
		echo '</ul></div>';
	}
}

function crazyblog_the_pagination( $pages = '', $range = 1 ) {
	$showitems = ($range * 2) + 1;
	global $paged;
	if ( empty( $paged ) )
		$paged = 1;
	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( !$pages ) {
			$pages = 1;
		}
	}
	if ( 1 != $pages ) {
		echo '<ul class="pagination">';
		$pre_class = ($paged > 1 && $showitems < $pages) ? '' : ' class="disabled"';
		echo "<li" . $pre_class . "><a  href='" . esc_url( get_pagenum_link( $paged - 1 ) ) . "'><span>" . esc_html__( 'Previous', 'crazyblog' ) . "</span></a></li>";
		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) ) {
				echo wp_kses_post( ($paged == $i) ? "<li class='active'><a  href='javascript:voic(0)'>" . $i . "</a></li>" : "<li><a  href='" . get_pagenum_link( $i ) . "'>" . $i . "</a></li>"  );
			}
		}
		$next_class = ($paged < $pages && $showitems < $pages) ? '' : ' class="disabled"';
		echo "<li" . $next_class . "><a   href='" . esc_url( get_pagenum_link( $paged + 1 ) ) . "'>" . esc_html__( 'Next', 'crazyblog' ) . "</a></li>";
		echo '</ul>';
	}
}

function crazyblog_db_like_table() {
	global $wpdb;
	$table_name = $wpdb->prefix . "like_dislike";
	$query = "CREATE TABLE IF NOT EXISTS $table_name (
			  `id` INT(11) NOT NULL AUTO_INCREMENT,
			  `id_item` INT(11) NOT NULL,
			  `ip` VARCHAR(25) NOT NULL,
			  `rate` INT(1) NOT NULL,
			  `dt_rated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$wpdb->query( $query );
}

function crazyblog_check_post_like( $pageID ) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$user_ip = crazyblog_set( $_SERVER, 'REMOTE_ADDR' );
	$table = $prefix . 'like_dislike';
	$pageID = $pageID;
	$like_sql = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) FROM  ' . $table . ' WHERE ip = %s and id_item = %d and rate = 1 ', $user_ip, $pageID ) );
	$like_sql = crazyblog_set( crazyblog_set( $like_sql, '0' ), 'COUNT(*)' );
	if ( $like_sql > 0 ) {
		return 'liked';
	}
}

function crazyblog_post_counter( $pageID ) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$table = $prefix . 'like_dislike';
	$pageID = $pageID;
	$like_sql = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) FROM  ' . $table . ' WHERE id_item = %d and rate = 1', $pageID ) );
	$like_sql = crazyblog_set( crazyblog_set( $like_sql, '0' ), 'COUNT(*)' );
	if ( $like_sql ) {
		return $like_sql;
	} else {
		return $like_sql;
	}
}

function crazyblog_like_system_( $_post ) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$table = $prefix . 'like_dislike';
	$user_ip = crazyblog_set( $_SERVER, 'REMOTE_ADDR' );
	$pageID = crazyblog_set( $_post, 'postid' );
	$dislike_sql = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) FROM  ' . $table . ' WHERE ip = %s and id_item = %d and rate = 2 ', $user_ip, $pageID ) );
	$dislike_count = crazyblog_set( crazyblog_set( $dislike_sql, '0' ), 'COUNT(*)' );
	$like_sql = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) FROM  ' . $table . ' WHERE ip = %s and id_item = %d and rate = 1 ', $user_ip, $pageID ) );
	$like_sql = crazyblog_set( crazyblog_set( $like_sql, '0' ), 'COUNT(*)' );
	if ( crazyblog_set( $_post, 'action' ) == 'crazyblog_like' ):
		if ( ( $like_sql == 0 ) && ( $dislike_count == 0 ) ) {
			$wpdb->query( $wpdb->prepare( 'INSERT INTO ' . $table . ' (id_item, ip, rate )VALUES(%d, %s, "1")', $pageID, $user_ip ) );
			echo crazyblog_post_counter( $pageID );
		}
		if ( $dislike_count == 1 ) {
			$wpdb->query( $wpdb->prepare( 'UPDATE ' . $table . ' SET rate = 1 WHERE id_item = %d and ip = %s', $pageID, $user_ip ) );
			echo crazyblog_post_counter( $pageID );
		}
	endif;
	exit;
}

function crazyblog_dis_like_system_( $_post ) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$table = $prefix . 'like_dislike';
	$user_ip = crazyblog_set( $_SERVER, 'REMOTE_ADDR' );
	$pageID = crazyblog_set( $_post, 'postid' );
	$dislike_sql = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) FROM  ' . $table . ' WHERE ip = %s and id_item = %d and rate = 2 ', $user_ip, $pageID ) );
	$dislike_count = crazyblog_set( crazyblog_set( $dislike_sql, '0' ), 'COUNT(*)' );
	$like_sql = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) FROM  ' . $table . ' WHERE ip = %s and id_item = %d and rate = 1 ', $user_ip, $pageID ) );
	$like_sql = crazyblog_set( crazyblog_set( $like_sql, '0' ), 'COUNT(*)' );
	if ( crazyblog_set( $_post, 'action' ) == 'crazyblog_dis_like' ):
		if ( ($like_sql == 0) && ($dislike_count == 0) ) {
			$wpdb->query( $wpdb->prepare( 'INSERT INTO ' . $table . ' (id_item, ip, rate )VALUES(%d, %s, "2")', $pageID, $user_ip ) );
			echo crazyblog_post_counter( $pageID );
		}
		if ( $like_sql == 1 ) {
			$wpdb->query( $wpdb->prepare( 'UPDATE ' . $table . ' SET rate = 2 WHERE id_item = %d and ip = %s', $pageID, $user_ip ) );
			echo crazyblog_post_counter( $pageID );
		}
	endif;
	exit;
}

function crazyblog_get_tags() {
	$tags = get_the_tags();
	if ( $tags ):
		foreach ( $tags as $tag ):
			echo '<a  href="' . get_tag_link( crazyblog_set( $tag, 'term_id' ) ) . '" title="' . crazyblog_set( $tag, 'slug' ) . '">' . crazyblog_set( $tag, 'name' ) . '</a>';
		endforeach;
	endif;
}

function crazyblog_related_post( $show_posts = 3 ) {
	ob_start();
	$opt = crazyblog_opt();
	$type = crazyblog_set( $opt, 'single_post_related_type' );
	$year = get_the_time( 'Y' );
	$month = get_the_time( 'm' );
	$day = get_the_time( 'd' );
	$args = array();
	if ( $type == 'tag' ) {
		$tags = wp_get_post_tags( get_the_ID() );
		$first_tag = $tags[0]->term_id;
		$args = array(
			'tag__in' => array( $first_tag ),
			'post__not_in' => array( get_the_ID() ),
			'posts_per_page' => $show_posts,
			'ignore_sticky_posts' => 1,
			'orderby' => 'rand',
		);
	} else if ( $type == 'cat' ) {
		$args = array(
			'category__in' => wp_get_post_categories( get_the_ID() ),
			'showposts' => $show_posts,
			'orderby' => 'rand',
			'post__not_in' => array( get_the_ID() )
		);
	}
	$my_query = new WP_Query( $args );
	if ( $my_query->have_posts() ) {
		while ( $my_query->have_posts() ) : $my_query->the_post();
			?>
			<div class="related-post">
				<div class="post-thumb">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'crazyblog_376x350' ); ?></a>
				</div>
				<div class="related-post-name">
					<h4><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h4>
					<ul class="meta">
						<li><a href="<?php get_day_link( $year, $month, $day ); ?>" title=""><?php echo get_the_date( get_option( 'date_format' ) ); ?></a></li>
						<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title=""><?php echo ucwords( get_the_author_meta( 'display_name' ) ); ?></a></li>
					</ul>
				</div>
			</div><!-- Related Post -->
			<?php
		endwhile;
	}
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

function crazyblog_social_share_icons_array() {
	$icons = array(
		'facebook' => esc_html__( 'Facebook', 'crazyblog' ),
		'twitter' => esc_html__( 'Twitter', 'crazyblog' ),
		'google-plus' => esc_html__( 'Google Plus', 'crazyblog' ),
		'reddit' => esc_html__( 'Reddit', 'crazyblog' ),
		'linkedin' => esc_html__( 'Linkedin', 'crazyblog' ),
		'pinterest' => esc_html__( 'Pinterest', 'crazyblog' ),
		'tumblr' => esc_html__( 'Tumblr', 'crazyblog' ),
		'envelope' => esc_html__( 'Email', 'crazyblog' )
	);
	$data = array();
	foreach ( $icons as $k => $v ) {
		$data[] = array( 'value' => $k, 'label' => $v );
	}
	return $data;
}

function crazyblog_social_share_output( $shares = array(), $color = false, $show_title = false, $list = false ) {
	$permalink = get_permalink( get_the_ID() );
	$titleget = get_the_title();
	if ( in_array( 'facebook', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>', 'Facebook', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
		                return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" class="facebook" style="transition-delay: 0ms;">
			<i class="fa fa-facebook"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Facebook', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'twitter', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo str_replace( " ", "%20", $titleget ); ?>', 'Twitter share', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
		                return false;" href="http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo str_replace( " ", "%20", $titleget ); ?>" class="twitter" style="transition-delay: 50ms;">
			<i class="fa fa-twitter"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Twitter', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'google-plus', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('https://plus.google.com/share?url=<?php echo esc_url( $permalink ); ?>', 'Google plus', 'width=585,height=666,left=' + (screen.availWidth / 2 - 292) + ',top=' + (screen.availHeight / 2 - 333) + '');
		                return false;" href="https://plus.google.com/share?url=<?php echo esc_url( $permalink ); ?>" class="google-plus">
			<i class="fa fa-google-plus"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Google Plus', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'reddit', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo str_replace( " ", "%20", $titleget ); ?>', 'Reddit', 'width=617,height=514,left=' + (screen.availWidth / 2 - 308) + ',top=' + (screen.availHeight / 2 - 257) + '');
		                return false;" href="http://reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo str_replace( " ", "%20", $titleget ); ?>" class="reddit">
			<i class="fa fa-reddit"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Reddit', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'linkedin', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>', 'Linkedin', 'width=863,height=500,left=' + (screen.availWidth / 2 - 431) + ',top=' + (screen.availHeight / 2 - 250) + '');
		                return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>" class="linkedin">
			<i class="ti-linkedin"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Linkedin', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'pinterest', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
		<a  href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());' class="pinterest" style="transition-delay: 100ms;">
			<i class="fa fa-pinterest"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Pinterest', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>

	<?php
	if ( in_array( 'tumblr', $shares ) ) {
		$str = $permalink;
		$str = preg_replace( '#^https?://#', '', $str );
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://www.tumblr.com/share/link?url=<?php echo esc_attr( $str ); ?>&amp;name=<?php echo str_replace( " ", "%20", $titleget ); ?>', 'Tumblr', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
		                return false;" href="http://www.tumblr.com/share/link?url=<?php echo esc_attr( $str ); ?>&amp;name=<?php echo str_replace( " ", "%20", $titleget ); ?>" class="tumbler">
			<i class="ti-tumblr"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Tumblr', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'envelope-o', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
		<a  href="mailto:?Subject=<?php echo str_replace( " ", "%20", $titleget ); ?>&amp;Body=<?php echo esc_url( $permalink ); ?>"><i class="ti-envelope"></i></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
}

function crazyblog_social_share_output2( $shares = array(), $color = false, $show_title = false, $list = false ) {
	$permalink = get_permalink( get_the_ID() );
	$titleget = get_the_title();
	if ( in_array( 'facebook', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>', 'Facebook', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
		                return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" style="transition-delay: 0ms;">
			<i class="fa fa-facebook"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Facebook', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'twitter', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo str_replace( " ", "%20", $titleget ); ?>', 'Twitter share', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
		                return false;" href="http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo str_replace( " ", "%20", $titleget ); ?>" style="transition-delay: 50ms;">
			<i class="fa fa-twitter"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Twitter', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'google-plus', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('https://plus.google.com/share?url=<?php echo esc_url( $permalink ); ?>', 'Google plus', 'width=585,height=666,left=' + (screen.availWidth / 2 - 292) + ',top=' + (screen.availHeight / 2 - 333) + '');
		                return false;" href="https://plus.google.com/share?url=<?php echo esc_url( $permalink ); ?>">
			<i class="fa fa-google-plus"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Google Plus', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'reddit', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo str_replace( " ", "%20", $titleget ); ?>', 'Reddit', 'width=617,height=514,left=' + (screen.availWidth / 2 - 308) + ',top=' + (screen.availHeight / 2 - 257) + '');
		                return false;" href="http://reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo str_replace( " ", "%20", $titleget ); ?>" >
			<i class="fa fa-reddit"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Reddit', 'crazyblog' ) . "Reddit</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'linkedin', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>', 'Linkedin', 'width=863,height=500,left=' + (screen.availWidth / 2 - 431) + ',top=' + (screen.availHeight / 2 - 250) + '');
		                return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>" class="linkedin">
			<i class="ti-linkedin"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Linkedin', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'pinterest', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
		<a  href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());' class="pinterest" style="transition-delay: 100ms;">
			<i class="fa fa-pinterest"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Pinterest', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>

	<?php
	if ( in_array( 'tumblr', $shares ) ) {
		$str = $permalink;
		$str = preg_replace( '#^https?://#', '', $str );
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
			<a  onClick="window.open('http://www.tumblr.com/share/link?url=<?php echo esc_html( $str ); ?>&amp;name=<?php echo str_replace( " ", "%20", $titleget ); ?>', 'Tumblr', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
		                return false;" href="http://www.tumblr.com/share/link?url=<?php echo esc_html( $str ); ?>&amp;name=<?php echo str_replace( " ", "%20", $titleget ); ?>" class="tumbler">
			<i class="ti-tumblr"></i><?php echo wp_kses_post( ($show_title) ? "<span>" . esc_html__( 'Tumblr', 'crazyblog' ) . "</span>" : ""  ); ?></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
	?>
	<?php
	if ( in_array( 'envelope-o', $shares ) ) {
		echo wp_kses_post( ($list === true) ? '<li>' : ''  );
		?>
		<a  href="mailto:?Subject=<?php echo str_replace( " ", "%20", $titleget ); ?>&amp;Body=<?php echo esc_url( $permalink ); ?>"><i class="ti-envelope"></i></a>
		<?php
		echo wp_kses_post( ($list === true) ? '</li>' : ''  );
	}
}

function crazyblog_comments_listing( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li>
		<div id="comment-<?php echo comment_ID(); ?>" itemprop="name" class="comment">
			<?php echo get_avatar( $comment, 145 ); ?>
			<div class="comment-detail">
				<h4 itemtype="http://schema.org/Person" itemscope="" itemprop="creator"><?php echo get_comment_author_link(); ?></h4>
				<?php comment_text(); ?>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
			</div>
		</div>
		<?php
	}

	function crazyblog_comment_form( $args = array(), $post_id = null, $review = false ) {
		$settings = crazyblog_opt();
		if ( null === $post_id )
			$post_id = get_the_ID();
		else
			$id = $post_id;
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		$args = wp_parse_args( $args );
		if ( !isset( $args['format'] ) )
			$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$html5 = 'html5' === $args['format'];
		$fields = array(
			'author' => '<div class="col-md-12"><div class="field"><label>' . esc_html__( 'Name', 'crazyblog' ) . '</label><input id="author" placeholder="' . esc_html__( 'Enter Your Name', 'crazyblog' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',
			'email' => '<div class="col-md-12"><div class="field"><label>' . esc_html__( 'Email', 'crazyblog' ) . '</label><input id="email" placeholder="' . esc_html__( 'Enter Your Email', 'crazyblog' ) . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
			'url' => '<div class="col-md-12"><div class="field"><label>' . esc_html__( 'Website', 'crazyblog' ) . '</label><input id="url" placeholder="' . esc_html__( 'Enter Your Website', 'crazyblog' ) . '" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
		);
		$required_text = sprintf( ' ' . esc_html__( 'Your email address will not be published. Required fields are marked %s', 'crazyblog' ), '<span class="required">*</span>' );
		$fields = apply_filters( 'comment_form_default_fields', $fields );
		$defaults = array(
			'fields' => $fields,
			'comment_field' => '<div class="field"><label>' . esc_html__( 'Comment', 'crazyblog' ) . '</label><textarea id="comment" placeholder="' . esc_html__( 'Your Comment', 'crazyblog' ) . '" class="input-style" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
			'must_log_in' => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a comment.', 'crazyblog' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as' => '<div class="col-md-12"><p class="logged-in-as">' . sprintf( esc_html__( 'Logged in as ', 'crazyblog' ) . '<a href="%1$s">%2$s</a>. <a href="%3$s" title="' . esc_html__( 'Log out of this account', 'crazyblog' ) . '">' . esc_html__( 'Log out', 'crazyblog' ) . '?</a>', get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p></div>',
			'comment_notes_before' => '<div class="col-md-12"><p class="comment-notes">' . crazyblog_set( $settings, 'single_post_comment_description' ) . ( $req ? $required_text : '' ) . '</p></div>',
			'comment_notes_after' => '<p class="form-allowed-tags">' . sprintf( esc_html__( 'You may use these', 'crazyblog' ) . ' <abbr title="' . esc_html__( 'HyperText Markup Language', 'crazyblog' ) . '">' . esc_html__( 'HTML', 'crazyblog' ) . '</abbr> ' . esc_html__( 'tags and attributes', 'crazyblog' ) . ': %s', ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form' => 'commentform',
			'id_submit' => 'submit',
			'title_reply' => crazyblog_set( $settings, 'single_post_comment_form_title', esc_html__( 'Leave Reply', 'crazyblog' ) ),
			'title_reply_to' => esc_html__( 'Leave a Reply to %s', 'crazyblog' ),
			'cancel_reply_link' => esc_html__( 'Cancel reply', 'crazyblog' ),
			'label_submit' => crazyblog_set( $settings, 'single_post_comment_form_button_label', esc_html__( 'Submit Now', 'crazyblog' ) ),
			'format' => 'xhtml',
		);
		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
		?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?>
			<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
				<?php echo wp_kses( $args['must_log_in'], true ); ?>
				<?php do_action( 'comment_form_must_log_in_after' ); ?>
			<?php else : ?>
				<div class="comment-form">
					<h4 class="simple-heading"><?php esc_html_e( 'LEAVE A COMMENT', 'crazyblog' ); ?></h4>
					<form action="<?php echo esc_url( site_url( '/wp-comments-post.php' ) ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" <?php echo esc_html( $html5 ? ' novalidate' : ''  ); ?>>
						<div class="row">
							<?php do_action( 'comment_form_top' ); ?>
							<?php if ( is_user_logged_in() ) : ?>
								<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
								<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
							<?php else : ?>
								<?php echo wp_kses( $args['comment_notes_before'], true ); ?>
								<?php
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								do_action( 'comment_form_after_fields' );
								?>
							<?php endif; ?>
							<div class="col-md-12">
								<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
								<?php echo wp_kses( $args['comment_notes_after'], true ); ?>
							</div>
							<div class="col-md-12">
								<button name="submit" type="submit" class="book-now" id="<?php echo esc_attr( $args['id_submit'] ); ?>"><?php echo esc_attr( $args['label_submit'] ); ?></button>
								<?php comment_id_fields( $post_id ); ?>
							</div>
							<?php do_action( 'comment_form', $post_id ); ?>
						</div>
					</form>
				</div>
			<?php endif; ?>
			<?php
			do_action( 'comment_form_after' );
		else :
			do_action( 'comment_form_comments_closed' );
		endif;
	}

	function crazyblog_posts_array( $post_type = 'post', $vp = false ) {
		global $wpdb;
		$res = $wpdb->get_results( $wpdb->prepare( "SELECT `ID`, `post_title` FROM `" . $wpdb->prefix . "posts` WHERE `post_type` = '%s' AND `post_status` = 'publish' ", $post_type ), ARRAY_A );
		$return = array();
		if ( $vp )
			foreach ( $res as $r )
				$return[] = array( 'value' => crazyblog_set( $r, 'ID' ), 'label' => crazyblog_set( $r, 'post_title' ) );
		else
			foreach ( $res as $r )
				$return[crazyblog_set( $r, 'ID' )] = crazyblog_set( $r, 'post_title' );
		return $return;
	}

	function crazyblog_posts( $post_type, $slug = false ) {
		$result = array();
		$args = array(
			'post_type' => $post_type,
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);
		$posts = get_posts( $args );
		if ( $posts ) {
			foreach ( $posts as $post ) {
				if ( $slug == true ) {
					$result[$post->post_name] = $post->post_title;
				} else {
					$result[$post->ID] = $post->post_title;
				}
			}
		}

		return $result;
	}

	function crazyblog_get_product_price( $productid ) {
		$args = array(
			'post_status' => 'publish',
			'post_type' => 'product',
			'post__in' => array( $productid )
		);
		query_posts( $args );
		$output = '';
		while ( have_posts() ):the_post();
			global $product;
			$output = $product->get_price_html();
		endwhile;
		wp_reset_query();
		return $output;
	}

	function crazyblog_set_posts_views( $postid ) {
		$post_view = get_post_meta( $postid, 'crazyblog_post_views', true );
		if ( $post_view == '' ) {
			delete_post_meta( $postid, 'crazyblog_post_views' );
			add_post_meta( $postid, 'crazyblog_post_views', '0' );
		} else {
			$post_view++;
			update_post_meta( $postid, 'crazyblog_post_views', $post_view );
		}
	}

	function crazyblog_post_views_format( $number ) {
		$prefixes = 'kMGTPEZY';
		if ( $number >= 1000 ) {
			for ( $i = -1; $number >= 1000; ++$i ) {
				$number /= 1000;
			}
			return floor( $number ) . $prefixes[$i];
		}
		return $number;
	}

	function crazyblog_get_categories( $arg = false, $slug = false, $vp = false, $all = false ) {
		global $wp_taxonomies;
		$categories = get_categories( $arg );
		$cats = array();
		if ( crazyblog_set( $arg, 'show_all' ) && $vp )
			$cats[] = array( 'value' => 'all', 'label' => esc_html__( 'All Categories', 'crazyblog' ) );
		elseif ( crazyblog_set( $arg, 'show_all' ) )
			$cats['all'] = esc_html__( 'All Categories', 'crazyblog' );
		if ( !crazyblog_set( $categories, 'errors' ) ) {
			foreach ( $categories as $category ) {
				if ( $vp ) {
					$key = ($slug ) ? $category->slug : $category->term_id;
					$cats[] = array( 'value' => $key, 'label' => $category->name );
				} else {
					$key = ($slug ) ? $category->slug : $category->term_id;
					$cats[$key] = $category->name;
				}
			}
		}
		return $cats;
	}

	function crazyblog_heading_style( $title, $subtitle, $style ) {
		$output = '';
		if ( ($title || $subtitle) && $style == 1 ) {
			$output .= '<div class="simple-title">';
			$output .= ($title) ? '<h2>' . $title . '</h2>' : '';
			$output .= ($subtitle) ? '<span>' . $subtitle . '</span>' : '';
			$output .= '</div>';
		} elseif ( ($title || $subtitle) && $style == 2 ) {
			$output .= '<div class="side-title">';
			$output .= '<span><i class="fa fa-codepen"></i></span>';
			$output .= '<div class="side-title-inner">';
			$output .= ($title) ? '<h2>' . $title . '</h2>' : '';
			$output .= ($subtitle) ? '<p>' . $subtitle . '</p>' : '';
			$output .= '</div>';
			$output .= '</div>';
		} elseif ( ($title || $subtitle) && $style == 3 ) {
			$output .= '<div class="center-heading">';
			$output .= ($subtitle) ? '<span>' . $subtitle . '</span>' : '';
			$output .= ($title) ? '<h2>' . $title . '</h2>' : '';
			$output .='</div>';
		} elseif ( ($title || $subtitle) && $style == 4 ) {
			$output .= '<div class="fancy-title">';
			$output .= '<div class="fancy-title-center">';
			$output .= ($subtitle) ? '<span>' . $subtitle . '</span>' : '';
			$output .= ($title) ? '<h2>' . $title . '</h2>' : '';
			$output .= '</div>';
			$output .= '</div>';
		}
		return $output;
	}

	function crazyblog_row_section_title( $title = '', $subtitle = '', $style = '' ) {
		$output = '';
		if ( $style == '1' ) {
			$output .= '<div class="simple-title">';
			$output .= ($title) ? '<h2>' . $title . '</h2>' : '';
			$output .= ($subtitle) ? '<span>' . $subtitle . '</span>' : '';
			$output .= '</div>';
		} elseif ( $style == '2' ) {
			$output .= '<div class="side-title">';
			$output .= '<span><i class="fa fa-codepen"></i></span>';
			$output .= '<div class="side-title-inner">';
			$output .= ($title) ? '<h2>' . $title . '</h2>' : '';
			$output .= ($subtitle) ? '<p>' . $subtitle . '</p>' : '';
			$output .= '</div>';
			$output .= '</div>';
		} elseif ( $style == '3' ) {
			$output .= '<div class="center-heading">';
			$output .= ($subtitle) ? '<span>' . $subtitle . '</span>' : '';
			$output .= ($title) ? '<h2>' . $title . '</h2>' : '';
			$output .='</div>';
		} elseif ( $style == '4' ) {
			$output .= '<div class="fancy-title">';
			$output .= '<div class="fancy-title-center">';
			$output .= ($subtitle) ? '<span>' . $subtitle . '</span>' : '';
			$output .= ($title) ? '<h2>' . $title . '</h2>' : '';
			$output .= '</div>';
			$output .= '</div>';
		}
		return $output;
	}

	function crazyblog_get_icons() {
		$pattern = '/\.(ti-(?:\w+(?:-)?)+):before\s*{\s*content/';
		$subject = wp_remote_get( crazyblog_URI . 'core/duffers_panel/panel/public/css/themify-icons.css' );
		preg_match_all( $pattern, crazyblog_set( $subject, 'body' ), $matches, PREG_SET_ORDER );
		$icons = array();
		foreach ( $matches as $match ) {
			$icons[$match[1]] = $match[1];
		}
		return $icons;
	}

	function crazyblog_social_icons( $icons = array(), $class = "" ) {
		$output = '';
		if ( $icons ) {
			$output .='<ul class="' . $class . '">';
			foreach ( $icons as $icon ) {
				if ( crazyblog_set( $icon, 'tocopy' ) )
					continue;
				$output .='<li><a target="_blank" href="' . crazyblog_set( $icon, 'link' ) . '"  title="' . crazyblog_set( $icon, 'title' ) . '"><i class="' . crazyblog_set( $icon, 'icon' ) . '"></i></a></li>';
			}
			$output .='</ul>';
		}
		return $output;
	}

	function crazyblog_get_child_categories( $cat_id, $taxonomy = '' ) {
		$terms = get_categories( array( 'child_of' => $cat_id, 'taxonomy' => 'product_cat', 'hide_empty' => false ) );
		$output = '';
		if ( $terms ) {
			$output .='<ul>';
			foreach ( $terms as $term ) {
				$output .='<li>' . $term->name . '</li>';
			}
			$output .='</ul>';
		}
		return $output;
	}

	function crazyblog_login_form_init() {
		$crazyblog_view_obj = new crazyblog_View;
		$crazyblog_view_obj->crazyblog_enqueue_scripts( array( 'wpshop-script-login' ) );
		wp_localize_script( 'crazyblog_outlet-script-login', 'crazyblog_login_form_object', array(
			'loadingmessage' => esc_html__( 'Sending user info, please wait...', 'crazyblog' )
		) );
	}

	if ( !is_user_logged_in() ) {
		add_action( 'wp_head', 'crazyblog_login_form_init' );
	}

	function crazyblog_product_cart_quantity( $product_id ) {
		global $woocommerce;
		$pro_data = array();
		foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
			$_product = $values['data'];
			if ( $product_id == $_product->id ) {
				$pro_data['quantity'] = crazyblog_set( $values, 'quantity' );
				$pro_data['price'] = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $values, $cart_item_key );
			}
		}
		return $pro_data;
	}

	function crazyblog_add_to_cart_ajax_btn( $fragments ) {
		global $woocommerce;
		$settings = crazyblog_opt();
		ob_start();
		?>
		<?php if ( crazyblog_set( $settings, 'header5_cart_popup' ) || crazyblog_set( $settings, 'header4_cart_popup' ) || crazyblog_set( $settings, 'header3_cart_popup' ) || crazyblog_set( $settings, 'header2_cart_popup' ) || crazyblog_set( $settings, 'header1_cart_popup' ) ): ?>
			<a  title=""><i class="ti-shopping-cart"></i><span><?php echo WC()->cart->cart_contents_count; ?></span></a>
		<?php elseif ( (crazyblog_set( $settings, 'header5_cart' ) || crazyblog_set( $settings, 'header4_cart' )) && is_object( $woocommerce ) ): ?>
			<a href="<?php echo WC()->cart->get_cart_url(); ?>"  title=""><i class="ti-shopping-cart"></i><span><?php echo WC()->cart->cart_count; ?></span></a>
		<?php endif; ?>                  
		<?php
		$fragments['div.cart-dropdown-sec > a'] = ob_get_clean();
		return $fragments;
	}

	add_filter( 'add_to_cart_fragments', 'crazyblog_add_to_cart_ajax_btn' );

	function crazyblog_add_to_cart_ajax_btn2( $fragments ) {
		global $woocommerce;
		ob_start();
		?>
		<a href="<?php echo WC()->cart->get_cart_url(); ?>"  title=""><i class="ti-shopping-cart"></i><span><?php echo WC()->cart->cart_count; ?></span></a>    
		<?php
		$fragments['div.no-dropdown-sec > a'] = ob_get_clean();
		return $fragments;
	}

	add_filter( 'add_to_cart_fragments', 'crazyblog_add_to_cart_ajax_btn2' );

	function crazyblog_add_to_cart_ajax( $fragments ) {
		global $woocommerce;
		$settings = crazyblog_opt();
		ob_start();
		?>
		<?php //crazyblog_Header::crazyblog_cart( $settings ); ?> 
		<?php
		$fragments['div.all-cart-sec'] = ob_get_clean();
		return $fragments;
	}

	add_filter( 'add_to_cart_fragments', 'crazyblog_add_to_cart_ajax' );

	function crazyblog_page_template( $tpl ) {
		$page = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => $tpl ) );
		if ( $page )
			return current( (array) $page );
		else
			return false;
	}

	function crazyblog_get_post_date_archive_url() {
		$archive_year = get_the_time( 'Y' );
		$archive_month = get_the_time( 'm' );
		$archive_day = get_the_time( 'd' );
		return get_day_link( $archive_year, $archive_month, $archive_day );
	}

	function crazyblog_add_to_cart_button( $class = '', $label = '' ) {
		global $product;
		$output = apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="' . $class . ' %s product_type_%s">' . $label . '</a>', esc_url( $product->add_to_cart_url() ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), $product->is_purchasable() ? 'add_to_cart_button' : '', esc_attr( $product->product_type ), esc_html( $product->add_to_cart_text() )
				), $product );
		return $output;
	}

	function crazyblog_get_post_categories( $postid, $separator = '' ) {
		$categories = get_the_category( $postid );
		$output = '';
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$output .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'crazyblog' ), $category->name ) ) . '">' . $category->cat_name . '</a>' . $separator;
			}
			return trim( $output, $separator );
		}
	}

	function crazyblog_get_terms( $taxonomy, $number = 3, $format = '', $anchor = true, $seprator = ',' ) {
		global $post;
		$counter = 1;
		$terms = get_the_terms( $post->ID, $taxonomy );
		$count = count( $terms );
		if ( $terms ) {
			foreach ( $terms as $term ) {
				if ( $count > 1 && $counter != $count ) {
					$sep = $seprator;
				} else {
					$sep = '';
				}
				if ( $counter == $number )
					break;

				if ( $anchor == 1 ) {
					if ( $format != '' ):
						echo '<' . $format . '  href="' . get_term_link( $term->term_id, $taxonomy ) . '" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'crazyblog' ), $term->slug ) ) . '">' . $term->name . $sep . ' </' . $format . '>';
					else:
						echo '<a  href="' . get_term_link( $term->term_id, $taxonomy ) . '" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'crazyblog' ), $term->slug ) ) . '">' . $term->name . ' </a>' . $sep . ' ';
					endif;
				}else {
					echo wp_kses( $term->name . $sep . ' ', true );
				}
				$counter++;
			}
		}
	}

	function crazyblog_get_product_rating() {
		global $product;
		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average = $product->get_average_rating();
		$output = '<div class="star-rating">';
		$output .= '<span style="width:' . ( ( $average / 5 ) * 100 ) . '%">';
		$output .= '</div>';
		return $output;
	}

	function crazyblog_get_layer_sliders() {
		global $wpdb;
		$return = array();
		if ( function_exists( 'layerslider' ) ) {
			$sliders = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "layerslider", ARRAY_A );
			if ( $sliders ) {
				foreach ( $sliders as $r ) {
					$return[] = array( 'value' => crazyblog_set( $r, 'id' ), 'label' => crazyblog_set( $r, 'name' ) );
				}
			}
		}
		return $return;
	}

	function crazyblog_get_next_prev_post() {
		?>
		<?php
		echo '<div class="other-post">';
		$prevPost = get_previous_post( true );
		if ( $prevPost ) {
			$args = array(
				'posts_per_page' => 1,
				'include' => crazyblog_set( $prevPost, 'ID' )
			);
			$prevPost = get_posts( $args );
			$previous = crazyblog_set( $prevPost, '0' );
			echo get_the_post_thumbnail( crazyblog_set( $previous, 'ID' ), 'thumbnail' );
			?>
			<div class="other-post-name">
				<span><?php esc_html_e( 'PREVIOUS ARTICLE', 'crazyblog' ); ?></span>
				<h5><a   href="<?php echo get_permalink( crazyblog_set( $previous, 'ID' ) ); ?>" title=""><?php echo get_the_title( crazyblog_set( $previous, 'ID' ) ); ?></a></h5>
			</div>
			<?php
			wp_reset_postdata();
		} // end if
		echo '</div>';
		echo '<div class="other-post next-post">';
		$nextPost = get_next_post( true );
		if ( $nextPost ) {
			$args = array(
				'posts_per_page' => 1,
				'include' => crazyblog_set( $nextPost, 'ID' )
			);
			$nextPost = get_posts( $args );
			$next = crazyblog_set( $nextPost, '0' );
			echo get_the_post_thumbnail( crazyblog_set( $next, 'ID' ), 'thumbnail' );
			?>
			<div class="other-post-name">
				<span><?php esc_html_e( 'NEXT ARTICLE', 'crazyblog' ); ?></span>
				<h5><a href="<?php echo get_permalink( crazyblog_set( $next, 'ID' ) ); ?>" title=""><?php echo get_the_title( crazyblog_set( $next, 'ID' ) ); ?></a></h5>
			</div><!-- Other Post -->
			<?php
			wp_reset_postdata();
		}
		echo '</div>';
	}

	posts_nav_link();
	paginate_comments_links();

	function crazyblog_next_prev_products_links() {
		?>
		<ul class="post-arrows">
			<?php previous_post_link( '<li>%link</li>', 'PREV' ); ?>
			<?php next_post_link( '<li>%link</li>', 'NEXT' ); ?>
		</ul>
		<?php
	}

	add_action( 'woocommerce_single_product_summary', 'crazyblog_stock_availabilty', 6 );

	function crazyblog_stock_availabilty() {
		global $product;
		$availability = $product->get_availability();
		$availability_html = empty( $availability['availability'] ) ? '<span class="stock">' . esc_html__( 'In Stock', 'crazyblog' ) . '</span>' : '<span class="stock out-of-stock">' . crazyblog_set( $availability, 'availability' ) . '</span>';
		echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
	}

	function crazyblog_item_number() {
		echo '<i class="id">' . esc_html__( 'Item', 'crazyblog' ) . ' #' . get_the_ID() . ' </i>';
	}

	function crazyblog_custom_single_product_info() {
		?>
		<div class="cart-coupons-sec">
			<a class="cart-wishlist-btn add_to_wishlist" data-id="<?php echo get_the_ID(); ?>" title="" href="#"><i class="ti-heart"></i> <?php esc_html_e( 'Wishlist', 'crazyblog' ); ?></a>
		</div>
		<?php
	}

	function crazyblog_product_orderby( $orderby ) {
		global $woocommerce;
		$args = array();
		switch ( $orderby ) {
			case 'popular':
			case 'best_seller':
				$args['meta_key'] = 'total_sales';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				break;
			case 'by_price':
				$args['meta_key'] = '_price';
				$args['orderby'] = 'meta_value_num';
				break;
			case 'onsale':
				$args['meta_query'][] = array(
					'relation' => 'OR',
					array(
						'key' => '_sale_price',
						'value' => 0,
						'compare' => '>',
						'type' => 'numeric'
					),
					array(
						'key' => '_min_variation_sale_price',
						'value' => 0,
						'compare' => '>',
						'type' => 'numeric'
					)
				);
				break;
			case 'featued':
				$args['meta_query'][] = array(
					'key' => '_featured',
					'value' => 'yes'
				);
				break;
			case 'date':
				$args['orderby'] = 'date';
				break;
			case 'name':
				$args['orderby'] = 'name';
				break;
			case 'ID':
				$args['orderby'] = 'ID';
				break;
			default :
				$args['orderby'] = 'rand';
		}
		$args['meta_query'][] = $woocommerce->query->visibility_meta_query();
		return $args;
	}

	function crazyblog_get_nav_menus() {
		$nav_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		$custom_menus = array();
		if ( !empty( $nav_menus ) ) {
			foreach ( $nav_menus as $nav_item ) {
				$custom_menus[] = array( 'value' => $nav_item->term_id, 'label' => $nav_item->name );
			}
		}
		return $custom_menus;
	}

	add_filter( 'woocommerce_catalog_orderby', 'crazyblog_woocommerce_catalog_orderby' );

//add new options to $sortby var passed into filter
	function crazyblog_woocommerce_catalog_orderby( $sortby ) {
		$sortby['best_seller'] = esc_html__( "Best Seller", 'crazyblog' );
		$sortby['featured'] = esc_html__( "Featured", 'crazyblog' );
		$sortby['onsale'] = esc_html__( "On Sale", 'crazyblog' );
		return $sortby;
	}

	add_filter( 'woocommerce_get_catalog_ordering_args', 'crazyblog_catalog_ordering_args' );

//Function to handle choices
	function crazyblog_catalog_ordering_args( $args ) {
		global $wp_query;
		// Changed the $_SESSION to $_GET
		if ( crazyblog_set( $_GET, 'orderby' ) == "best_seller" ) {
			$args['meta_key'] = 'total_sales';
			$args['orderby'] = 'meta_value_num';
			$args['order'] = 'DESC';
		} else if ( crazyblog_set( $_GET, 'orderby' ) == "featured" ) {
			$args['meta_key'] = '_featured';
			$args['orderby'] = 'meta_value title';
			$args['order'] = 'DESC';
		} else if ( crazyblog_set( $_GET, 'orderby' ) == "onsale" ) {
			$args['orderby'] = 'meta_value_num';
			$args['order'] = 'DESC';
			$args['meta_key'] = '_sale_price';
		}
		//printr($args);
		return $args;
	}

	add_filter( 'woocommerce_output_related_products_args', 'crazyblog_related_products_args' );

	function crazyblog_related_products_args( $args ) {
		$settings = crazyblog_opt();
		$args['posts_per_page'] = crazyblog_set( $settings, 'related_product_section_number', 3 );
		return $args;
	}

	function crazyblog_heading_styles() {
		$opt = crazyblog_opt();
		$heading_array = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'body' );
		$params = array( 'font_face', 'font_style', 'font_weight', 'font_color', 'font_size', 'line_height' );
		$style = array();
		$main_style = array();
		foreach ( $heading_array as $h ):
			if ( crazyblog_set( $opt, 'use_custom_heading_style_' . $h ) == 1 || crazyblog_set( $opt, $h . '_custom_fonts' ) == 1 ):
				if ( !empty( $style ) )
					unset( $style );

				foreach ( $params as $p ):
					//if (crazyblog_set($opt, $h . '_' . $p) != ''):
					$style[$p] = crazyblog_set( $opt, $h . '_' . $p );
					//endif;
				endforeach;
				if ( crazyblog_set( $opt, $h . '_' . $p ) != '' ):
					$main_style[$h] = $style;
				endif;
			endif;
		endforeach;
		return $main_style;
	}

	function crazyblog_restyle_text( $n, $precision = 1 ) {
		if ( $n < 900 ) {
			$n_format = number_format( $n, $precision );
			$suffix = '';
		} else if ( $n < 900000 ) {
			$n_format = number_format( $n / 1000, $precision );
			$suffix = esc_html__( 'K', 'crazyblog' );
		} else if ( $n < 900000000 ) {
			$n_format = number_format( $n / 1000000, $precision );
			$suffix = esc_html__( 'M', 'crazyblog' );
		} else if ( $n < 900000000000 ) {
			$n_format = number_format( $n / 1000000000, $precision );
			$suffix = esc_html__( 'B', 'crazyblog' );
		} else {
			$n_format = number_format( $n / 1000000000000, $precision );
			$suffix = esc_html__( 'T', 'crazyblog' );
		}
		if ( $precision > 0 ) {
			$dotzero = '.' . str_repeat( '0', $precision );
			$n_format = str_replace( $dotzero, '', $n_format );
		}
		return ' ' . $n_format . $suffix;
	}

	function crazyblog_rules() {
		$settings = crazyblog_opt();
		$rules = crazyblog_set( crazyblog_set( $settings, 'crazyblog_blog_rules' ), 'crazyblog_blog_rules' );
		$result = array();
		if ( !empty( $rules ) && count( $rules ) > 0 ) {
			array_pop( $rules );
			$result['all'] = esc_html__( 'Show All', 'crazyblog' );
			foreach ( $rules as $key => $val ) {
				$result[$key] = crazyblog_set( $val, 'title' );
			}
		}
		return $result;
	}

	function crazyblog_adCode( $type, $prefix, $class = '', $pos = '', $echo = true ) {
		$opt = crazyblog_opt();
		$adCode = crazyblog_set( $opt, $prefix . 'AdCode' );
		$default_ad_sizes = array(
			'header' => array(
				'd_w' => '728', // big monitor - width
				'd_h' => '90', // big monitor - height
				'tl_w' => '468', // tablet_landscape width
				'tl_h' => '60', // tablet_landscape height
				'tp_w' => '468', // tablet_portrait width
				'tp_h' => '60', // tablet_portrait height
				'p_w' => '320', // phone width
				'p_h' => '50'   // phone height
			),
			'footer' => array(
				'd_w' => '728', // big monitor - width
				'd_h' => '90', // big monitor - height
				'tl_w' => '728', // tablet_landscape width
				'tl_h' => '90', // tablet_landscape height
				'tp_w' => '728', // tablet_portrait width
				'tp_h' => '90', // tablet_portrait height
				'p_w' => '300', // phone width
				'p_h' => '250'   // phone height
			),
			'at_top' => array(
				'd_w' => '300', // big monitor - width
				'd_h' => '250', // big monitor - height
				'tl_w' => '300', // tablet_landscape width
				'tl_h' => '250', // tablet_landscape height
				'tp_w' => '200', // tablet_portrait width
				'tp_h' => '200', // tablet_portrait height
				'p_w' => '300', // phone width
				'p_h' => '250'   // phone height
			),
			'at_bottom' => array(
				'd_w' => '300', // big monitor - width
				'd_h' => '250', // big monitor - height
				'tl_w' => '300', // tablet_landscape width
				'tl_h' => '250', // tablet_landscape height
				'tp_w' => '320', // tablet_portrait width
				'tp_h' => '50', // tablet_portrait height
				'p_w' => '300', // phone width
				'p_h' => '250'   // phone height
			),
			'at_inline' => array(
				'd_w' => '300', // big monitor - width
				'd_h' => '250', // big monitor - height
				'tl_w' => '300', // tablet_landscape width
				'tl_h' => '250', // tablet_landscape height
				'tp_w' => '320', // tablet_portrait width
				'tp_h' => '50', // tablet_portrait height
				'p_w' => '300', // phone width
				'p_h' => '250'   // phone height
			),
		);

		// desktop size
		if ( crazyblog_set( $opt, $prefix . 'd_size' ) ) {
			$ad_size_parts = explode( 'x', crazyblog_set( $opt, $prefix . 'd_size' ) );
			$default_ad_sizes[$type]['d_w'] = $ad_size_parts[0];
			$default_ad_sizes[$type]['d_h'] = $ad_size_parts[1];
		}

		//tablet landscape
		if ( crazyblog_set( $opt, $prefix . 'tl_size' ) ) {
			$ad_size_parts = explode( 'x', crazyblog_set( $opt, $prefix . 'tl_size' ) );
			$default_ad_sizes[$type]['tl_w'] = $ad_size_parts[0];
			$default_ad_sizes[$type]['tl_h'] = $ad_size_parts[1];
		}
		//tablet portrait
		if ( crazyblog_set( $opt, $prefix . 'tp_size' ) ) {
			$ad_size_parts = explode( 'x', crazyblog_set( $opt, $prefix . 'tp_size' ) );
			$default_ad_sizes[$type]['tp_w'] = $ad_size_parts[0];
			$default_ad_sizes[$type]['tp_h'] = $ad_size_parts[1];
		}
		//phone

		if ( crazyblog_set( $opt, $prefix . 'p_size' ) ) {
			$ad_size_parts = explode( 'x', crazyblog_set( $opt, $prefix . 'p_size' ) );
			$default_ad_sizes[$type]['p_w'] = $ad_size_parts[0];
			$default_ad_sizes[$type]['p_h'] = $ad_size_parts[1];
		}

		// check desktop disable
		if ( crazyblog_set( $opt, $prefix . 'enable_d' ) == '1' ) {
			$default_ad_sizes[$type]['enable_d'] = true;
		} else {
			$default_ad_sizes[$type]['enable_d'] = false;
		}

		// check tablet landscape disable
		if ( crazyblog_set( $opt, $prefix . 'enable_tl' ) == '1' ) {
			$default_ad_sizes[$type]['enable_tl'] = true;
		} else {
			$default_ad_sizes[$type]['enable_tl'] = false;
		}

		// check tablet portrait disable
		if ( crazyblog_set( $opt, $prefix . 'enable_tp' ) == '1' ) {
			$default_ad_sizes[$type]['enable_tp'] = true;
		} else {
			$default_ad_sizes[$type]['enable_tp'] = false;
		}

		// check phone disable
		if ( crazyblog_set( $opt, $prefix . 'enable_p' ) == '1' ) {
			$default_ad_sizes[$type]['enable_p'] = true;
		} else {
			$default_ad_sizes[$type]['enable_p'] = false;
		}

		$render = '';
		if ( !empty( $adCode ) ) {
			//get add code and clone
			$doc = new DOMDocument();
			$doc->loadHTML( $adCode );
			$ins = $doc->getElementsByTagName( 'ins' );
			foreach ( $ins as $i ) {
				$clientId = $i->getAttribute( 'data-ad-client' );
				$adSlot = $i->getAttribute( 'data-ad-slot' );
			}
			if ( !empty( $class ) ) {
				$render .='<div class="' . $class . ' ' . $pos . '">';
			}
			$render .= "\n <!-- A generated by theme --> \n\n";
			//google async script
			$render .= '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
			$render .= '<script type="text/javascript">' . "\n";
			$render .= 'var c_screen_width = document.body.clientWidth;' . "\n";

			// show add on desktop
			if ( $default_ad_sizes[$type]['enable_d'] == true && !empty( $default_ad_sizes[$type]['d_w'] ) && !empty( $default_ad_sizes[$type]['d_h'] ) ) {
				$render .= '
                    if ( c_screen_width >= 1140 ) {
						console.log(c_screen_width);
                        /* large monitors */
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$type]['d_w'] . 'px;height:' . $default_ad_sizes[$type]['d_h'] . 'px" data-ad-client="' . $clientId . '" data-ad-slot="' . $adSlot . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
            ';
			}

			// show add on tablet landscape
			if ( $default_ad_sizes[$type]['enable_tl'] == true && !empty( $default_ad_sizes[$type]['tl_w'] ) && !empty( $default_ad_sizes[$type]['tl_h'] ) ) {
				$render .= '
                    if ( c_screen_width >= 1019  && c_screen_width < 1140 ) {
                        /* landscape tablets */
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$type]['tl_w'] . 'px;height:' . $default_ad_sizes[$type]['tl_h'] . 'px" data-ad-client="' . $clientId . '" data-ad-slot="' . $adSlot . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
            ';
			}

			// show add on tablet portrait
			if ( $default_ad_sizes[$type]['enable_tp'] == true && !empty( $default_ad_sizes[$type]['tp_w'] ) && !empty( $default_ad_sizes[$type]['tp_h'] ) ) {
				$render .= '
                    if ( c_screen_width >= 768  && c_screen_width < 1019 ) {
                        /* portrait tablets */
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$type]['tp_w'] . 'px;height:' . $default_ad_sizes[$type]['tp_h'] . 'px" data-ad-client="' . $clientId . '" data-ad-slot="' . $adSlot . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
            ';
			}

			// show add on phone
			if ( $default_ad_sizes[$type]['enable_p'] == true && !empty( $default_ad_sizes[$type]['p_w'] ) && !empty( $default_ad_sizes[$type]['p_h'] ) ) {
				$render .= '
                    if ( c_screen_width < 768 ) {
                       /* Phones */
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$type]['p_w'] . 'px;height:' . $default_ad_sizes[$type]['p_h'] . 'px" data-ad-client="' . $clientId . '" data-ad-slot="' . $adSlot . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
            ';
			}
			$render .= '</script>' . "\n";
			if ( !empty( $class ) ) {
				$render .='</div>';
			}
			if ( $echo === false ) {
				return $render;
			} else {
				echo $render;
			}
		}
	}

	function crazyblog_getContent() {
		$opt = crazyblog_opt();
		$inline_ad_paragraph = crazyblog_set( $opt, 'aiparagraph' );
		$inline_ad_align = crazyblog_set( $opt, 'aipos' );
		$content = get_the_content();
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		if ( is_single() ) {
			$cnt = 0;
			$content_buffer = '';
			$content_parts = preg_split( '/(<p.*>)/U', $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );
			$p_open_tag_count = 0;
			foreach ( $content_parts as $content_part_index => $content_part_value ) {
				if ( !empty( $content_part_value ) ) {
					if ( preg_match( '/(<p.*>)/U', $content_part_value ) === 1 ) {
						if ( $inline_ad_paragraph == $p_open_tag_count ) {
							$content_buffer .= crazyblog_adCode( 'at_inline', 'ai', 'ads-setting', $inline_ad_align, false );
						}
						$p_open_tag_count++;
					}
					$content_buffer .= $content_part_value;
					$cnt++;
				}
			}
			$content = $content_buffer;
		}
		echo $content;
	}
	