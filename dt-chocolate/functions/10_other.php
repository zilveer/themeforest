<?php
function dt_parent_where_query( $str = null ) {
	static $query = '';
	if( $str ) {
		$query = strip_tags( $str );
	}
	return $query;
}

// read more link
function new_excerpt_more($more) {
       global $post;
   
   if (isset($GLOBALS['is_portfolio']))
   if ($GLOBALS['is_portfolio'])       
      return '';

	return '
	<a href="'. get_permalink($post->ID) . '" class="go_more"><span><i></i>'.__("read more", LANGUAGE_ZONE).'</span></a>';
}

function the_content_more($c)
{
   $link = new_excerpt_more(1);
   //$c = preg_replace('/<a[^>]+class="more-link"><\/a>/');
   $c = preg_replace('/(<a[^>]+class="more-link">.*?<\/a>)/', '<br style="clear: both;" />\\1', $c);
   $c = str_replace('more-link', 'go_more', $c);
   return $c;
}

add_filter('excerpt_more', 'new_excerpt_more');
add_filter('the_content', 'the_content_more');

function default_attachment($att) {
   if ($att[0]) return $att;
   $file = "/images/noimage.jpg";
   $att[0] = get_template_directory_uri().$file;
   $fname = dirname(__FILE__)."/../".$file;
   $size = @getimagesize($fname);
   $att[1] = $size[0];
   $att[2] = $size[1];
   return $att;
}

function dt_add_click_emulator( $handle ) {
	if( 'post.php' != $handle )
		return;

	global $post;
	if( $post && isset($post->post_type) && ( 'dt_gallery_plus' == $post->post_type || 'main_slider' == $post->post_type ) )
		wp_enqueue_script( 'dt_admin_script', get_template_directory_uri() . '/js/admin_update_saveas.js' );
}
add_action('admin_enqueue_scripts', 'dt_add_click_emulator');

// content or excerpt - this is the question
function dt_content_question( $content ) {
    if( false !== strpos($content, '<!--more-->')) {
        return true;
    }
    return false;
}

function dt_the_content( $more_link_text = '', $stripteaser = '', $opts = array() ) {
    global $post, $more;
    $more = 0;
	if( is_search() || is_archive() || !dt_content_question($post->post_content) ){
		the_excerpt();
    }else {
    	the_content( $more_link_text, $stripteaser );
    } 
}

// function return array of thumbnail images for home_slider posts and count images in thous posts
function dt_get_sliders_info () {
	global $wpdb;
	$parents = $counts = array();
	
	$query = new Wp_Query( 'post_type=main_slider&posts_per_page=-1&post_status=publish' );
	$posts = $query->posts;
	
	foreach( $posts as &$p ) {
		$parents[] = $p->ID;
		
		if( has_post_thumbnail($p->ID) ) {
			$img = wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'thumbnail' );
		}else {
			$attachments = get_posts( array(
				'post_type' 		=> 'attachment',
				'posts_per_page' 	=> 1,
				'post_status' 		=> 'inherit',
				'post_parent' 		=> $p->ID,
				'post_mime_type'	=> 'image',
				'orderby'			=> 'menu_order',
				'order'				=> 'ASC'
			) );
			if( $attachments )
				$img = wp_get_attachment_image_src( $attachments[0]->ID, 'thumbnail' );
		}
		
		if( !isset($img) ) {
			// noimage
			$img[0] = get_template_directory_uri().'/images/noimage_thumbnail.jpg';
		}
		
		$p->dt_thumbnail = $img[0];
		// post info
		$p->dt_info = '';
	}
	unset($p);
	
	if ( !empty($parents) ) {
		$res = $wpdb->get_results(
			"
				SELECT po.post_parent AS pp, COUNT(po.ID) AS count
				FROM {$wpdb->posts} po
				WHERE po.post_parent IN (". implode(', ', $parents). ")
				GROUP BY po.post_parent						
			",
			ARRAY_A
		);
	} else {
		$res = array();
	}

	// how many images there is
	foreach( $res as $r ) {
		$counts[$r['pp']] = sprintf('There is %d image%s', $r['count'], (($r['count'] > 1)?'s':''));
	}
	
	return array( 'posts' => $posts, 'counts' => $counts );
}

function dt_clean_thumb_url ( $src ) {
	static $current_blog_id = null;
	static $is_multisite = null;
	static $upload_path = null;
	static $blog_path = '';
	
	if ( null === $current_blog_id ) {
		$current_blog_id = get_current_blog_id();
	}

	if ( null == $is_multisite && function_exists('is_subdomain_install') ) {
		$is_multisite = (!is_subdomain_install() && is_multisite() && $current_blog_id > 1);
	}

	// HTTP_HOST replaced with SERVER_NAME upon the recommendation of Miltiadis Koutsokeras
	$src_arr = explode( $_SERVER['HTTP_HOST'], $src );	

    if ( isset( $src_arr[1] ) ) {
		if ( $is_multisite ) {

			if ( null === $upload_path ) {
				$upload_path = wp_upload_dir();
			}

			if ( '' === $blog_path ) {
				$blog_path = get_blog_details( $current_blog_id )->path;
			}
			
			// some dirty ugly stupid trick
			if ( '/' == $blog_path ) {
				$blog_path = '%%';
				$src_arr[1] = '%%' . $src_arr[1];
			}
			
			// if this is not a theme image
			if ( false !== strpos( $src, $upload_path['baseurl'] ) ) {
				$src_arr[1] = str_replace( $upload_path['baseurl'], '/' . UPLOADS, $src );
			// else - strip off blog path
			} else {
				$src_arr[1] = str_replace( $blog_path, '', $src_arr[1] );
			}
		}
        $src = $src_arr[1];
    }
	return $src;
}
