<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 */




/* ========================= Blog utils section ============================== */


/* PRE_QUERY - add filter to main query */
add_filter('posts_where', 'filter_where');  
function filter_where($where = '') { 
	global $wpdb; 
	if (is_admin()) return $where;
	// Disable posts with future date
	$where .= " AND ({$wpdb->posts}.post_date <= '" . date('Y-m-d 23:59:59') . "' OR {$wpdb->posts}.post_date_gmt <= '" . date('Y-m-d 23:59:59') . "')";
	return $where;  
}  


// Return template page id
function getTemplatePageId($type) {
	if (!in_array($type, array('video', 'gallery'))) $type = 'blog';
	$posts = getPostsByMetaValue('_wp_page_template', 'template-' . $type . '.php', ARRAY_A);
	return count($posts)>0 ? $posts[0]['post_id'] : 0;
}


// Return any type categories objects by post id
function getCategoriesByPostId($post_id = 0, $cat_types = false) {
	global $theme_post_types;
	if (!$cat_types) {
		$cat_types = array();
		foreach ($theme_post_types as $type)
			$cat_types[] = $type['category'];
	}
	return getTaxonomiesByPostId($post_id, $cat_types);
}


// Return tags objects by post id
function getTagsByPostId($post_id = 0) {
	return getTaxonomiesByPostId($post_id, array('post_tag'));
}


// Return taxonomies objects by post id
function getTaxonomiesByPostId($post_id = 0, $tax_types = array('post_format')) {
	global $wpdb, $wp_query;
	if (!$post_id) $post_id = $wp_query->current_post>=0 ? get_the_ID() : $wp_query->post->ID;
	$sql = "SELECT terms.*, tax.taxonomy, tax.parent, tax.count"
			. " FROM $wpdb->term_relationships AS rel"
			. " LEFT JOIN {$wpdb->term_taxonomy} AS tax ON rel.term_taxonomy_id=tax.term_taxonomy_id"
			. " LEFT JOIN {$wpdb->terms} AS terms ON tax.term_id=terms.term_id"
			. " WHERE rel.object_id = {$post_id}"
				. " AND tax.taxonomy IN ('" . join("','", $tax_types) . "')";
	$taxes = $wpdb->get_results($sql, ARRAY_A);
	for ($i=0; $i<count($taxes); $i++) {
		$taxes[$i]['link'] = get_term_link($taxes[$i]['slug'], $taxes[$i]['taxonomy']);
	}
	return $taxes;
}


// Return taxonomies objects by post type
function getTaxonomiesByPostType($post_types = array('post'), $tax_types = array('post_format')) {
	global $wpdb, $wp_query;
	if (!$post_types) $post_types = array('post');
	$sql = "SELECT terms.*, tax.taxonomy, tax.parent, tax.count, posts.post_type"
			. " FROM $wpdb->term_relationships AS rel"
			. " LEFT JOIN {$wpdb->term_taxonomy} AS tax ON rel.term_taxonomy_id=tax.term_taxonomy_id"
			. " LEFT JOIN {$wpdb->terms} AS terms ON tax.term_id=terms.term_id"
			. " LEFT JOIN {$wpdb->posts} AS posts ON rel.object_id=posts.id"
			. " WHERE posts.post_type IN ('" . join("','", $post_types) . "')"
				. " AND tax.taxonomy IN ('" . join("','", $tax_types) . "')"
			. " ORDER BY terms.name";
	$taxes = $wpdb->get_results($sql, ARRAY_A);
	$result = array();
	$used = array();
	$res_count = 0;
	for ($i=0; $i<count($taxes); $i++) {
		$link = get_term_link($taxes[$i]['slug'], $taxes[$i]['taxonomy']);
		$k = $taxes[$i]['post_type'].$taxes[$i]['slug'];
		$idx = isset($used[$k]) ? $used[$k] : -1;
		if ($idx == -1) {
			$used[$k] = $res_count;
			$result[$res_count] = $taxes[$i];
			$result[$res_count]['link'] = $link;
			$result[$res_count]['count'] = 1;
			$res_count++;
		} else
			$result[$idx]['count']++;
	}
	return $result;
}



// Return breadcrumbs path
function showBreadcrumbs($args=array()) {
	global $wp_query;
	
	$args = array_merge(array(
		'home' => '',							// Home page title (if empty - not showed)
		'home_url' => '',						// Home page url
		'show_all_photo_video' => false,		// Add "All photos" (All videos) before categories list
		'show_all_posts' => false,				// Add "All posts" at start 
		'truncate_title' => 0,					// Truncate all titles to this length (if 0 - no truncate)
		'truncate_add' => '...',				// Append truncated title with this string
		'echo' => true							// If true - show on page, else - only return value
		), is_array($args) ? $args : array( 'home' => $args ));

	$rez = '';
	$rez2 = '';
	$all_link = $all_format =  '';
	$type = getBlogType();
	$title = getShortString(getBlogTitle(), $args['truncate_title'], $args['truncate_add']);
	$cat = '';
	$parentTax = '';
	if ( !in_array($type, array('home', 'frontpage')) ) {
		$need_reset = true;
		$parent = 0;
		$post_id = 0;
		if ($type == 'page' || $type == 'attachment') {
			$pageParentID = isset($wp_query->post->post_parent) ? $wp_query->post->post_parent : 0;
			$post_id = $type == 'page' ? (isset($wp_query->post->ID) ? $wp_query->post->ID : 0) : $pageParentID;
			while ($pageParentID > 0) {
				$pageParent = get_post($pageParentID);
				$rez2 = '<li class="cat_post"><a href="' . get_permalink($pageParent->ID) . '">' . getShortString($pageParent->post_title, $args['truncate_title'], $args['truncate_add']) . '</a></li>' . $rez2;
				if (($pageParentID = $pageParent->post_parent) > 0) $page_id = $pageParentID;
			}
		} else if ($type=='single')
			$post_id =  isset($wp_query->post->ID) ? $wp_query->post->ID : 0;
		
		$depth = 0;
		do {
			if ($depth++ == 0) {
				if (in_array($type, array('single', 'attachment'))) {
					if ($args['show_all_photo_video']) {
						$post_format = get_post_format($post_id);
						if ($post_format == 'video' && ($video_id = getTemplatePageId($post_format)) > 0) {
							$all_link = get_permalink($video_id);
							$all_format = __('Videos', 'wpspace');
						} else if ($post_format == 'gallery' && ($gallery_id = getTemplatePageId($post_format)) > 0) {
							$all_link = get_permalink($gallery_id);
							$all_format = __('Galleries', 'wpspace');
						}
					}
					$cats = getCategoriesByPostId( $post_id );
					$cat = $cats ? $cats[0] : false;
					if ($cat) {
						$cat_link = get_term_link($cat['slug'], $cat['taxonomy']);
						$rez2 = '<li class="cat_post"><a href="' . $cat_link . '">' . getShortString($cat['name'], $args['truncate_title'], $args['truncate_add']) . '</a></li>' . $rez2;
					} else {
						$post_type = get_post_type($post_id);
						$parentTax = 'category' . ($post_type == 'post' ? '' : '_' . $post_type);
					}
				} else if ( $type == 'category' ) {
					$cat = get_term_by( 'id', get_query_var( 'cat' ), 'category', ARRAY_A);
				} else if ( $type == 'resume' &&  get_query_var( 'category_resume' ) != '' ) {
					$cat = get_term_by( 'slug', get_query_var( 'category_resume' ), 'category_resume', ARRAY_A);
				} else if ( $type == 'portfolio' &&  get_query_var( 'category_portfolio' ) != '' ) {
					$cat = get_term_by( 'slug', get_query_var( 'category_portfolio' ), 'category_portfolio', ARRAY_A);
				}
				if ($cat) {
					$parent = $cat['parent'];
					$parentTax = $cat['taxonomy'];
				}
			}
			if ($parent) {
				$cat = get_term_by( 'id', $parent, $parentTax, ARRAY_A);
				if ($cat) {
					$cat_link = get_term_link($cat['slug'], $cat['taxonomy']);
					$rez2 = '<li class="cat_parent"><a href="' . $cat_link . '">' . getShortString($cat['name'], $args['truncate_title'], $args['truncate_add']) . '</a></li>' . $rez2;
					$parent = $cat['parent'];
				}
			}
			if (!$all_link && $args['show_all_posts'] && ($blog_id = getTemplatePageId($type)) > 0) {
				$all_link = get_permalink($blog_id);
				if ($type == 'resume' || $parentTax == 'category_resume') {
					$all_format = __( 'Resume', 'wpspace');
					$all_link .= (my_strpos($all_link, '?')===false ? '?' : '&').'rsm=1';
				} else if ($type == 'portfolio' || $parentTax == 'category_portfolio') {
					$all_format = __( 'Portfolio', 'wpspace');
					$all_link .= (my_strpos($all_link, '?')===false ? '?' : '&').'prt=1';
				} else {
					$all_format = __( 'Posts', 'wpspace');
				}
			}
		} while ($parent);
	}

	$rez .= '<ul class="breadcrumbs">'
		. (isset($args['home']) && $args['home']!='' ? '<li class="home"><a href="' . ($args['home_url'] ? $args['home_url'] : home_url()) . '">' . $args['home'] . '</a></li>' : '') 
		. ($all_link && !in_array(my_strtolower($title), array('text', 'all portfolio', 'all resume')) ? '<li class="all"><a href="' . $all_link . '">' . sprintf( __( 'All %s', 'wpspace' ), $all_format ) . '</a></li>' : '' )
		. $rez2 
		. ($title ? '<li class="current">' . $title . '</li>' : '')
		. '</ul>';
	
	if ($args['echo']) echo $rez;
	return $rez;
}



// Return blog records type
function getBlogType($query=null) {
global $wp_query;
	if ( $query===null ) $query = $wp_query;

	$is_resume = isset($query->query_vars['category_resume']) || isset($_REQUEST['rsm']);
	$is_portfolio = isset($query->query_vars['category_portfolio']) || isset($_REQUEST['prt']);

	$page = '';
	if (isset($query->queried_object) && isset($query->queried_object->post_type) && $query->queried_object->post_type=='page')
		$page = get_post_meta($query->queried_object_id, '_wp_page_template', true);
	else if (isset($query->query_vars['page_id']))
		$page = get_post_meta($query->query_vars['page_id'], '_wp_page_template', true);
	else if (isset($query->queried_object) && isset($query->queried_object->taxonomy))
		$page = $query->queried_object->taxonomy;

	if ( $is_resume || $page == 'category_resume' || $page == 'template-resume.php')	// || is_page_template( 'template-resume.php' ) )
		return 'resume';
	else if ( $is_portfolio || $page == 'category_portfolio' || $page == 'template-portfolio.php')	// || is_page_template( 'template-portfolio.php' ) )
		return 'portfolio';
	else if (  $page == 'template-video.php')	// || is_page_template( 'template-video.php' ) )
		return 'video';
	else if (  $page == 'template-gallery.php')	// || is_page_template( 'template-gallery.php' ) )
		return 'gallery';
	else if (  $page == 'template-blog.php')	// || is_page_template( 'template-blog.php' ) )
		return 'blog';
	else if ( $query && $query->is_404())		// || is_404() ) 					// -------------- 404 error page
		return 'error';
	else if ( $query && $query->is_search())	// || is_search() ) 				// -------------- Search results
		return 'search';
	else if ( $query && $query->is_day())		// || is_day() )					// -------------- Archives daily
		return 'archives';
	else if ( $query && $query->is_month())		// || is_month() ) 				// -------------- Archives monthly
		return 'archives';
	else if ( $query && $query->is_year())		// || is_year() )  				// -------------- Archives year
		return 'archives';
	else if ( $query && $query->is_category())	// || is_category() )  		// -------------- Category
		return 'category';
	else if ( $query && $query->is_tag())		// || is_tag() ) 	 				// -------------- Tag posts
		return 'tag';
	else if ( $query && $query->is_author())	// || is_author() )				// -------------- Author page
		return 'author';
	else if ( $query && $query->is_attachment())	// || is_attachment() )
		return 'attachment';
	else if ( $query && $query->is_single())	// || is_single() )				// -------------- Single post
		return 'single';
	else if ( $query && $query->is_page())		// || is_page() )
		return 'page';
	else										// -------------- Home page
		return 'home';
}

// Return blog title
function getBlogTitle() {
	global $wp_query;

	$is_resume = isset($wp_query->query_vars['category_resume']) || isset($_REQUEST['rsm']);
	$is_portfolio = isset($wp_query->query_vars['category_portfolio']) || isset($_REQUEST['prt']);

	$page = $slug = '';
	if (isset($wp_query->queried_object) && isset($wp_query->queried_object->post_type) && $wp_query->queried_object->post_type=='page')
		$page = get_post_meta($wp_query->queried_object_id, '_wp_page_template', true);
	else if (isset($wp_query->query_vars['page_id']))
		$page = get_post_meta($wp_query->query_vars['page_id'], '_wp_page_template', true);
	else if (isset($wp_query->queried_object) && isset($wp_query->queried_object->taxonomy))
		$page = $slug = $wp_query->queried_object->taxonomy;

	if ( $is_resume || $page == 'category_resume' || $page == 'template-resume.php' || is_page_template( 'template-resume.php' ) )
		return sprintf( __( '%s', 'wpspace' ), $slug!='' || isset($wp_query->query_vars['category_resume']) ? single_term_title('', false) : __('All Resume', 'wpspace') );
	else if ( $is_portfolio || $page == 'category_portfolio' || $page == 'template-portfolio.php' || is_page_template( 'template-portfolio.php' ) )
		return sprintf( __( '%s', 'wpspace' ), $slug!='' || isset($wp_query->query_vars['category_portfolio']) ? single_term_title('', false) : __('All Portfolio', 'wpspace') );
	else if (  $page == 'template-video.php' || is_page_template( 'template-video.php' ) )
		return __( 'All Videos', 'wpspace' );
	else if (  $page == 'template-gallery.php' || is_page_template( 'template-gallery.php' ) )
		return __( 'All Photos', 'wpspace' );
	else if (  $page == 'template-blog.php' || is_page_template( 'template-blog.php' ) )
		return __( 'any text', 'wpspace' );
	else if ( is_author() )			// -------------- Author page
		return __('Author page', 'wpspace');
	else if ( is_404() ) 			// -------------- 404 error page
		return __('URL not found', 'wpspace');
	else if ( is_search() ) 		// -------------- Search results
		return sprintf( __( 'Search Results for: %s', 'wpspace' ), get_search_query() );
	else if ( is_day() )			// -------------- Archives daily
		return sprintf( __( 'Daily Archives: %s', 'wpspace' ), get_the_date() );
	else if ( is_month() ) 			// -------------- Archives monthly
		return sprintf( __( 'Monthly Archives: %s', 'wpspace' ), get_the_date( 'F Y' ) );
	else if ( is_year() )  			// -------------- Archives year
		return sprintf( __( 'Yearly Archives: %s', 'wpspace' ), get_the_date( 'Y' ) );
	else if ( is_category() )  		// -------------- Category
		return sprintf( __( '%s', 'wpspace' ), single_cat_title( '', false ) );
	else if ( is_tag() )  			// -------------- Tag page
		return sprintf( __( 'Tag: %s', 'wpspace' ), single_tag_title( '', false ) );
	else if ( is_attachment() )		// -------------- Attachment page
		return sprintf( __( 'Attachment: %s', 'wpspace' ), getPostTitle());
	else if ( is_single() )			// -------------- Single post
		return getPostTitle();
	else if ( is_page() )
		//return $wp_query->post->post_title;
		return getPostTitle();
	else							// -------------- Unknown pages - as homepage
		return get_bloginfo('name', 'raw');
}


// Show pages links below list or single page
function showPagination($args=array()) {
	$args = array_merge(array(
		'offset' => 0,				// Offset to first showed record
		'id' => 'nav_pages',		// Name of 'id' attribute
		'class' => 'nav_pages'		// Name of 'class' attribute
		),  is_array($args) ? $args 
			: (is_int($args) ? array( 'offset' => $args ) 		// If send number parameter - use it as offset
				: array( 'id' => $args, 'class' => $args )));	// If send string parameter - use it as 'id' and 'class' name
	global $wp_query;
	echo "<div id=\"{$args['id']}\" class=\"{$args['class']}\">";
	if (function_exists('wp_pagenavi') && !is_single()) {
		echo wp_pagenavi('', '', $args['offset']);
		$pageNumber = get_query_var('paged') ? get_query_var('paged') : 1;
		$maxNumPages = ceil(($wp_query->found_posts - $args['offset']) / get_query_var('posts_per_page'));				//$wp_query->max_num_pages;
		if ($maxNumPages > 1) {
			?>
			<div class="page_x_of_y"><?php printf(__('Page <span>%s</span> of <span>%s</span>', 'wpspace'), $pageNumber, $maxNumPages); ?></div>
			<?php
		}
	} else {
		showSinglePageNav( 'nav-below' );
	}
	echo "</div>";
}


// Single page nav or used if no pagenavi
function showSinglePageNav( $nav_id ) {
	global $wp_query, $post;
	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );
		if ( ! $next && ! $previous )
			return;
	}
	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;
	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';
	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'wpspace' ); ?></h1>
		<?php if ( is_single() ) : // navigation links for single posts ?>
			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'wpspace' ) . '</span> %title' ); ?>
			<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'wpspace' ) . '</span>' ); ?>
		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'wpspace' ) ); ?></div>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wpspace' ) ); ?></div>
			<?php endif; ?>
	<?php endif; ?>
	</nav>
	<?php
}


// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
add_filter( 'wp_page_menu_args', '_wp_utils_page_menu_args' );
function _wp_utils_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}


// Adds custom classes to the array of body classes.
add_filter( 'body_class', '_wp_utils_body_classes' );
function _wp_utils_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}


// Filters wp_title to print a neat <title> tag based on what is being viewed.
add_filter( 'wp_title', '_wp_utils_wp_title', 10, 2 );
function _wp_utils_wp_title( $title, $sep ) {
	global $page, $paged;
	if ( is_feed() ) return $title;
	// Add the blog name
	$title .= get_bloginfo( 'name' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'wpspace' ), max( $paged, $page ) );
	return $title;
}










/* ========================= Post utilities section ============================== */

// Return custom_page_heading (if set), else - post title
function getPostTitle($id = 0, $maxlength = 0, $add='...') {
	global $wp_query;
	if (!$id) $id = $wp_query->current_post>=0 ? get_the_ID() : $wp_query->post->ID;
	$title = get_post_meta($id, 'custom_page_heading', true);
	if (!$title)
		$title = get_the_title($id);
	if ($maxlength > 0) $title = getShortString($title, $maxlength, $add);
	return $title;
}

// Return custom_page_description (if set), else - post excerpt (if set), else - trimmed content
function getPostDescription($maxlength = 0, $add='...') {
	global $wp_query;
	$id = $wp_query->current_post>=0 ? get_the_ID() : $wp_query->post->ID;
	if (post_password_required($id)) {
		$descr = __('This post is password protected. To view it please enter your password inside the post.', 'wpspace');
	} else {
		$descr = get_post_meta($id, 'custom_page_description', true);
		if (!$descr) {
			$descr = get_the_excerpt();
			$descr = trim(str_replace('[...]', '', $descr));
		}
		if (!$descr) {
			$descr = get_the_content('', true);
		}
		if ($maxlength > 0) $descr = getShortString($descr, $maxlength, $add);
	}
	return $descr;
}

//Return Post Views Count on Posts Without Any Plugin in WordPress
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 ";
    }
    return $count;
}

//Set Post Views Count
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Return posts by meta_value
function getPostsByMetaValue($meta_key, $meta_value, $return_format=OBJECT) {
	global $wpdb;
	$where = array();
	if ($meta_key) $where[] = 'meta_key="' . $meta_key . '"';
	if ($meta_value) $where[] = 'meta_value="' . $meta_value . '"';
	$whereStr = count($where) ? 'WHERE '.join(' AND ', $where) : '';
	$posts = $wpdb->get_results("SELECT * FROM {$wpdb->postmeta} {$whereStr}", $return_format);
	return $posts;
}










/* ========================= User profile section ============================== */

$user_social_list = array(
	'twitter' => 'Twitter',
	'facebook' => 'Facebook',
	'dribbble' => 'Dribbble',
	'pinterest' => 'Pinterest',
	'linkedin' => 'LinkedIn',
	'rss' => 'Feed RSS',
	'gplus' => 'Google+',
	'tumblr' => 'Tumblr',
	'behance' => 'Behance'
	);

$share_social_list = array(
	'twitter' => "https://twitter.com/share?text={title}&counturl={link}&url={link}",
	'facebook' => "http://www.facebook.com/share.php?u={link}",
	'pinterest' => "javascript:void((function(d){var%20e=d.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);d.body.appendChild(e)})(document));",
	'gplus' => "https://plusone.google.com/_/+1/confirm?url={link}"
	);

// Return (and show) user profiles links
function showUserSocialLinks($args) {
	$args = array_merge(array(
		'id' => 'author_social_profile',		// ul tag's id
		'class' => 'author_social_profile',		// ul tag's class
		'author_id' => 0,						// author's ID
		'icon_size' => '',						// icon size (if not empty - append after icon part: icon-big-twitter)
		'allowed' => array(),					// list of allowed social
		'echo' => true							// if true - show on page, else - only return as string
		), is_array($args) ? $args 
			: array('author_id' => $args));		// If send one number parameter - use it as author's ID
	global $user_social_list;
	$tpl_dir = get_template_directory_uri();
	$output = '';
	if (count($args['allowed'])==0) $args['allowed'] = array_keys($user_social_list);
	foreach ($args['allowed'] as $s) {
		if (array_key_exists($s, $user_social_list)) {
			$link = get_the_author_meta('user_' . $s, $args['author_id']);
			if ($link) {
				$icon = $tpl_dir . '/images/icon-' . ($args['icon_size'] ? $args['icon_size'] . '-' : '') . $s . '.png';
				$output .= '<li><a href="' . $link . '" class="link_' . $s . '"><img src="' . $icon . '" class="icon_' . $s . '" alt="' . $s . '" /></a></li>';
			}
		}
	}
	if ($output) $output = '<ul id="' . $args['id'] . '" class="' . $args['class'] . '">' . $output . '</ul>';
	if ($args['echo']) echo $output;
	return $output;
}


// Return (and show) share social links
function showShareSocialLinks($args) {
	$args = array_merge(array(
		'id' => 'post_social_share',		// ul tag's id
		'class' => 'post_social_share',		// ul tag's class
		'post_id' => 0,						// post ID
		'post_link' => '',					// post link
		'post_title' => '',					// post title
		'icon_size' => '',					// icon size (if not empty - append to end of icon name: icon-big-twitter
		'allowed' => array(),				// list of allowed social
		'echo' => true						// if true - show on page, else - only return as string
		), $args);
	global $share_social_list;
	$tpl_dir = get_template_directory_uri();
	$output = '';
	if (count($args['allowed'])==0) $args['allowed'] = array_keys($share_social_list);
	foreach ($args['allowed'] as $s) {
		if (array_key_exists($s, $share_social_list)) {
			$link = str_replace(array('{id}', '{link}', '{title}'), array($args['post_id'], $args['post_link'], $args['post_title']), $share_social_list[$s]);
			$icon = $tpl_dir . '/images/icon-' . ($args['icon_size'] ? $args['icon_size'] . '-' : '') . $s . '.png';
			$output .= '<li><a href="' . $link . '" class="link-' . $s . '" target="_black"><img src="' . $icon . '" class="icon_' . $s . '" alt="' . $s . '" /></a></li>';
		}
	}
	if ($output) $output = '<ul id="' . $args['id'] . '" class="' . $args['class'] . '">' . $output . '</ul>';
	if ($args['echo']) echo $output;
	return $output;
}


// show additional fields
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { 
	global $user_social_list;
?>
	<h3>Social links</h3>
	<table class="form-table">
	<?php
	foreach ($user_social_list as $name=>$title) {
	?>
        <tr>
            <th><label for="<?php echo $name; ?>"><?php echo $title; ?>:</label></th>
            <td><input type="text" name="user_<?php echo $name; ?>" id="user_<?php echo $name; ?>" size="55" value="<?php echo esc_attr(get_the_author_meta('user_'.$name, $user->ID)); ?>" />
                <span class="description">Please, enter your <?php echo $title; ?> link</span>
            </td>
        </tr>
	<?php
	}
	?>
    </table>
<?php
}

// Save / update additional fields
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	global $user_social_list;
	foreach ($user_social_list as $name=>$title)
		update_user_meta( $user_id, 'user_'.$name, $_POST['user_'.$name] );
}


/*
function twitter_followers($account) {
	$tw = get_transient("twitterfollowers");
	if ($tw !== false) return $tw;
	$tw = '?';
	$url = 'https://twitter.com/users/show/'.$account;
	$headers = get_headers($url);
	if (my_strpos($headers[0], '200')) {
		$xml = file_get_contents($url);
		preg_match('/followers_count>(.*)</', $xml, $match);
		if ($match[1] !=0 ) {
			$tw = $match[1];
			set_transient("twitterfollowers", $tw, 60*60);
		}
	}
	return $tw;
}

function facebook_likes($account) {
	$fb = get_transient("facebooklikes");
	if ($fb !== false) return $fb;
	$fb = '?';
	$url = 'http://graph.facebook.com/'.$account;
	$headers = get_headers($url);
	if (my_strpos($headers[0], '200')) {
		$json = file_get_contents($url);
		$rez = json_decode($json, true);
		if (isset($rez['likes']) ) {
			$fb = $rez['likes'];
			set_transient("facebooklikes", $fb, 60*60);
		}
	}
	return $fb;
}

function feedburner_counter($account) {
	$rss = get_transient("feedburnercounter");
	if ($rss !== false) return $rss;
	$rss = '?';
	$url = 'http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='.$account;
	$headers = get_headers($url);
	if (my_strpos($headers[0], '200')) {
		$xml = file_get_contents($url);
		preg_match('/circulation="(\d+)"/', $xml, $match);
		if ($match[1] != 0) {
			$rss = $match[1];
			set_transient("feedburnercounter", $rss, 60*60);
		}
	}
	return $rss;
}
*/











/* ========================= Admin section ============================== */

// Add categories (taxonomies) filter for custom posts types
add_action( 'restrict_manage_posts', 'admin_taxonomy_filter' );
function admin_taxonomy_filter() {
	global $typenow;
	if ($typenow == 'post') 			$taxes = array();
	else if ($typenow == 'resume') 		$taxes = array('category_resume');
	else if ($typenow == 'portfolio') 	$taxes = array('category_portfolio');
	else								return;
	if (get_theme_option('admin_add_filters')=='1') {
		$taxes[] = 'post_format';
		$taxes[] = 'post_tag';
	}
	$i = 0;
	foreach ($taxes as $tax) {
		$i++;
		$tax_obj = get_taxonomy($tax);
		$terms = getTaxonomiesByPostType(array($typenow), array($tax)); 	//$i==1 ?  get_terms($tax) : getTaxonomiesByPostType(array($typenow), array($tax));
		if (count($terms) > 0) {
			$tax_name = my_strtolower($tax_obj->labels->name);
			$tax = str_replace(array('post_tag'), array('tag'), $tax);
			echo "<select name='$tax' id='$tax' class='postform'>";
			echo "<option value=''>All $tax_name</option>";
			foreach ($terms as $term) {
				$slug = is_object($term) ? $term->slug : $term['slug'];
				$name = is_object($term) ? $term->name : $term['name'];
				$count = is_object($term) ? $term->count : $term['count'];
				echo '<option value='. $slug . ($_GET[$tax] == $slug ? ' selected="selected"' : '') . '>' . str_replace(array('post-format-'), array(''), $name) . ' (' . $count .')</option>'; 
			}
			echo "</select>";
		}
	}
}









/* ========================= Other functions section ============================== */



// Return calendar with allowed posts types
function get_theme_calendar($initial = true, $echo = true, $allowed_types = array('post', 'news', 'reviews')) {
	global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

	$cache = array();
	$key = md5( $m . $monthnum . $year );
	if ( $cache = wp_cache_get( 'get_calendar', 'calendar' ) ) {
		if ( is_array($cache) && isset( $cache[ $key ] ) ) {
			if ( $echo ) {
				echo apply_filters( 'get_calendar',  $cache[$key] );
				return;
			} else {
				return apply_filters( 'get_calendar',  $cache[$key] );
			}
		}
	}

	if ( !is_array($cache) )
		$cache = array();

	// Quick check. If we have no posts at all, abort!
	if ( !$posts ) {
		$gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish' LIMIT 1");
		if ( !$gotsome ) {
			$cache[ $key ] = '';
			wp_cache_set( 'get_calendar', $cache, 'calendar' );
			return;
		}
	}

	if ( isset($_GET['w']) )
		$w = ''.intval($_GET['w']);

	// week_begins = 0 stands for Sunday
	$week_begins = intval(get_option('start_of_week'));

	// Let's figure out when we are
	if ( !empty($monthnum) && !empty($year) ) {
		$thismonth = ''.zeroise(intval($monthnum), 2);
		$thisyear = ''.intval($year);
	} elseif ( !empty($w) ) {
		// We need to get the month from MySQL
		$thisyear = ''.intval(my_substr($m, 0, 4));
		$d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
		$thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
	} elseif ( !empty($m) ) {
		$thisyear = ''.intval(my_substr($m, 0, 4));
		if ( my_strlen($m) < 6 )
				$thismonth = '01';
		else
				$thismonth = ''.zeroise(intval(my_substr($m, 4, 2)), 2);
	} else {
		$thisyear = gmdate('Y', current_time('timestamp'));
		$thismonth = gmdate('m', current_time('timestamp'));
	}

	$unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);
	$last_day = date('t', $unixmonth);

	// Get the next and previous month and year with at least one post
	$previous = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1");
	$next = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59' AND post_date_gmt > '$thisyear-$thismonth-{$last_day} 23:59:59'
		AND post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish'
			ORDER BY post_date ASC
			LIMIT 1");

	/* translators: Calendar caption: 1: month name, 2: 4-digit year */
	$calendar_caption = _x('%1$s %2$s', 'calendar caption', 'wpspace');
	$calendar_output = '<table id="wp-calendar">
	<caption>' . sprintf($calendar_caption, $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</caption>
	<thead>
	<tr>';

	$myweek = array();

	for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
	}

	foreach ( $myweek as $wd ) {
		$day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
		$wd = esc_attr($wd);
		$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
	}

	$calendar_output .= '
	</tr>
	</thead>

	<tfoot>
	<tr>';

	if ( $previous ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . get_month_link($previous->year, $previous->month) . '" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s', 'wpspace'), $wp_locale->get_month($previous->month), date('Y', mktime(0, 0 , 0, $previous->month, 1, $previous->year)))) . '">&laquo; ' . $wp_locale->get_month_abbrev($wp_locale->get_month($previous->month)) . '</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
	}

	$calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';

	if ( $next && ($next->year.'-'.$next->month <= date('Y-m'))) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . get_month_link($next->year, $next->month) . '" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s', 'wpspace'), $wp_locale->get_month($next->month), date('Y', mktime(0, 0 , 0, $next->month, 1, $next->year))) ) . '">' . $wp_locale->get_month_abbrev($wp_locale->get_month($next->month)) . ' &raquo;</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
	}

	$calendar_output .= '
	</tr>
	</tfoot>

	<tbody>
	<tr>';

	// Get days with posts
	$dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
		FROM $wpdb->posts WHERE (post_date >= '{$thisyear}-{$thismonth}-01 00:00:00' OR post_date_gmt >= '{$thisyear}-{$thismonth}-01 00:00:00')
		AND post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish'
		AND (post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59' OR post_date_gmt <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59')", ARRAY_N);
	if ( $dayswithposts ) {
		foreach ( (array) $dayswithposts as $daywith ) {
			$daywithpost[] = $daywith[0];
		}
	} else {
		$daywithpost = array();
	}

	if (my_strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'camino') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false)
		$ak_title_separator = "\n";
	else
		$ak_title_separator = ', ';

	$ak_titles_for_day = array();
	$ak_post_titles = $wpdb->get_results("SELECT ID, post_title, DAYOFMONTH(post_date) as dom "
		."FROM $wpdb->posts "
		."WHERE (post_date >= '{$thisyear}-{$thismonth}-01 00:00:00' OR post_date_gmt >= '{$thisyear}-{$thismonth}-01 00:00:00') "
		."AND (post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59' OR post_date_gmt <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59') "
		."AND post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish'"
	);
	if ( $ak_post_titles ) {
		foreach ( (array) $ak_post_titles as $ak_post_title ) {

				$post_title = esc_attr( apply_filters( 'the_title', $ak_post_title->post_title, $ak_post_title->ID ) );

				if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
					$ak_titles_for_day['day_'.$ak_post_title->dom] = '';
				if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
					$ak_titles_for_day["$ak_post_title->dom"] = $post_title;
				else
					$ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
		}
	}

	// See how much we should pad in the beginning
	$pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
	if ( 0 != $pad )
		$calendar_output .= "\n\t\t".'<td colspan="'. esc_attr($pad) .'" class="pad">&nbsp;</td>';

	$daysinmonth = intval(date('t', $unixmonth));
	for ( $day = 1; $day <= $daysinmonth; ++$day ) {
		if ( isset($newrow) && $newrow )
			$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
		$newrow = false;

		if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) )
			$calendar_output .= '<td id="today">';
		else
			$calendar_output .= '<td>';

		if ( in_array($day, $daywithpost) ) // any posts today?
				$calendar_output .= '<a href="' . get_day_link( $thisyear, $thismonth, $day ) . '" title="' . esc_attr( $ak_titles_for_day[ $day ] ) . "\">$day</a>";
		else
			$calendar_output .= $day;
		$calendar_output .= '</td>';

		if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
			$newrow = true;
	}

	$pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
	if ( $pad != 0 && $pad != 7 )
		$calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr($pad) .'">&nbsp;</td>';

	$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";

	$cache[ $key ] = $calendar_output;
	wp_cache_set( 'get_calendar', $cache, 'calendar' );

	if ( $echo )
		echo apply_filters( 'get_calendar',  $calendar_output );
	else
		return apply_filters( 'get_calendar',  $calendar_output );

}


// Decorate 'read more...' link
function decorateMoreLink($text, $tag_start='<div class="readmore">', $tag_end='</div>') {
	//return preg_replace('/(<a[^>]+class="more-link"[^>]*>[^<]*<\\/a>)/', "{$tag_start}\${1}{$tag_end}", $text);
	$rez = $text;
	if (($pos = my_strpos($text, ' class="more-link"><span class="readmore">'))!==false) {
		$i = $pos-1;
		while ($i > 0) {
			if (my_substr($text, $i, 3) == '<a ') {
				if (($pos = my_strpos($text, '</span></a>', $pos))!== false) {
					$pos += 11;
					$start = my_substr($text, $i-4, 4) == '<p> ' ? $i-4 : (my_substr($text, $i-3, 3) == '<p>' ? $i-3 : $i);
					$end   = my_substr($text, $pos, 4) == '</p>' ? $pos+4 : $pos;
					$rez = my_substr($text, 0, $start) . $tag_start . my_substr($text, $i, $pos-$i) . $tag_end . my_substr($text, $end);
					break;
				}
			}
			$i--;
		}
	}
	return $rez;
}








/* ========================= Aqua resizer wrapper ============================== */


function getResizedImageTag( $url, $w=null, $h=null, $c=null, $u=true ) {
    if (is_object($url))		$alt = getPostTitle( $url->ID );
    else if ((int) $url > 0) 	$alt = getPostTitle( $url );
	else						$alt = basename($url);
	$url = getResizedImageURL($url, $w, $h, $c, $u);
	if ($url != '') {
		if (($url_dir = getUploadsDirFromURL($url)) !== false)
			$size = @getimagesize($url_dir);
		else
			$size = false;
		return '<img class="wp-post-image" ' . ($size!==false && isset($size[3]) ? $size[3] : '') . ' alt="' . $alt . '" src="' . $url . '">';
	} else
		return '';
	//return $url!='' ? ('<img class="wp-post-image"' . ($w ? ' width="'.$w.'"' : '') . ($h ? ' height="' . $h . '"' : '') . ' alt="' . $alt . '" src="' . $url . '">') : '';
}



function getResizedImageURL( $url, $w=null, $h=null, $c=null, $u=true ) {
    if (is_object($url))		$url = wp_get_attachment_url( get_post_thumbnail_id( $url->ID ));
    else if ((int) $url > 0) 	$url = wp_get_attachment_url( get_post_thumbnail_id( $url ));
    else 						$url = trim(chop($url));
	if ($url != '') {
	    if ($c === null) $c = true;	//$c = get_option('thumbnail_crop')==1;
		if ( ! ($new_url = aq_resize( $url, $w, $h, $c, true, $u)) ) {
			if (false)
				$new_url = get_the_post_thumbnail($url, array($w, $h));
			else
				$new_url = $url;
		}
	} else $new_url = '';
	return $new_url;
}

function getUploadsDirFromURL($url) {
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	$http_prefix = "http://";
	$https_prefix = "https://";
	
	if (!strncmp($url,$https_prefix,my_strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
		$upload_url = str_replace($http_prefix, $https_prefix, $upload_url);
	} else if (!strncmp($url,$http_prefix,my_strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
		$upload_url = str_replace($https_prefix, $http_prefix, $upload_url);		
	}

	// Check if $img_url is local.
	if ( false === my_strpos( $url, $upload_url ) ) return false;

	// Define path of image.
	$rel_path = str_replace( $upload_url, '', $url );
	$img_path = $upload_dir . $rel_path;
	
	return $img_path;
}




// Return custom sidebars list, prepended default and main sidebars item (if need)
function getSidebarsList($sidebars = array("As in Site Options|default", "Main sidebar|sidebar-blog")) {
	$cnt = get_theme_option('sidebars_count');
	for ($i=1; $i<=$cnt; $i++) {
		$sidebars[] = 'Custom sidebar '.$i.'|sidebar-custom-'.$i;
	}
	return $sidebars;
}

// Prepare minth names in date for translation
function prepareDateForTranslation($dt) {
 return str_replace(
  array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
     'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
  array(
   __('January', 'themerex'),
   __('February', 'themerex'),
   __('March', 'themerex'),
   __('April', 'themerex'),
   __('May', 'themerex'),
   __('June', 'themerex'),
   __('July', 'themerex'),
   __('August', 'themerex'),
   __('September', 'themerex'),
   __('October', 'themerex'),
   __('November', 'themerex'),
   __('December', 'themerex'),
   __('Jan', 'themerex'),
   __('Feb', 'themerex'),
   __('Mar', 'themerex'),
   __('Apr', 'themerex'),
   __('May', 'themerex'),
   __('Jun', 'themerex'),
   __('Jul', 'themerex'),
   __('Aug', 'themerex'),
   __('Sep', 'themerex'),
   __('Oct', 'themerex'),
   __('Nov', 'themerex'),
   __('Dec', 'themerex'),
  ),
  $dt);
} 

?>