<?php

/*************************************************************************************
 *	Favicon
 *************************************************************************************/

if ( !function_exists( 'om_favicon' ) ) {
	function om_favicon() {
		if ($tmp = get_option(OM_THEME_PREFIX . 'favicon')) {
			echo '<link rel="shortcut icon" href="'. $tmp .'"/>';
		}
	}
	add_action('wp_head', 'om_favicon');
}

/*************************************************************************************
 *	Audio Player
 *************************************************************************************/

if ( !function_exists( 'om_audio_player' ) ) {
	function om_audio_player($post_id, $trysize='456x300') {
	 
		$mp3 = get_post_meta($post_id, OM_THEME_SHORT_PREFIX.'audio_mp3', true);
		$ogg = get_post_meta($post_id, OM_THEME_SHORT_PREFIX.'audio_ogg', true);
		$poster = get_post_meta($post_id, OM_THEME_SHORT_PREFIX.'audio_poster', true);
		if($poster && $trysize) {
			$uploads = wp_upload_dir();
			
			if(strpos($poster,$uploads['baseurl']) === 0) {
				$name=basename($poster);
				$name_new=explode('.',$name);
				if(count($name_new > 1))
					$name_new[count($name_new)-2].='-'.$trysize;
				$name_new=implode('.',$name_new);
				$poster_new=str_replace($name,$name_new,$poster);
				if(file_exists(str_replace($uploads['baseurl'],$uploads['basedir'],$poster_new)))
					$poster=$poster_new;
			}
		} elseif(!$poster && $trysize=='456x300') {
			$poster=TEMPLATE_DIR_URI.'/img/audio.png';
		}
		
		$supplied=array();
		if($mp3)
			$supplied[]='mp3';
		if($ogg)
			$supplied[]='ogg';
		if(empty($supplied))
			return;
		$supplied=implode(',',$supplied);	
		
		$setmedia=array();
		if($poster)
			$setmedia[]='poster: "'.$poster.'"';
		if($mp3)
			$setmedia[]='mp3: "'.$mp3.'"';
		if($ogg)
			$setmedia[]='oga: "'.$ogg.'"';
		$setmedia=implode(',',$setmedia);
		
    ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){

				if(jQuery().jPlayer) {
					jQuery("#jquery_jplayer_<?php echo $post_id; ?>").jPlayer({
						ready: function () {
							jQuery(this).jPlayer("setMedia", {
						    <?php echo $setmedia; ?>
							});
						},
						<?php if( !empty($poster) ) { ?>
							size: {
        				width: "auto",
        				height: "auto"
        			},
     				<?php } ?>
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_container_<?php echo $post_id; ?>",
						supplied: "<?php echo $supplied ?>"
					});
			
				}
			});
		</script>

		<div id="jquery_jplayer_<?php echo $post_id; ?>" class="jp-jplayer"></div>

		<div id="jp_container_<?php echo $post_id; ?>" class="jp-container jp-audio">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<div class="jp-controls">
						<a href="javascript:;" class="jp-play" tabindex="1" title="<?php _e('Play', 'om_theme') ?>"></a>
						<a href="javascript:;" class="jp-pause" tabindex="1" title="<?php _e('Pause', 'om_theme') ?>"></a>
						<div class="jp-play-pause-divider"></div>
						<div class="jp-mute-unmute-divider"></div>
						<a href="javascript:;" class="jp-mute" tabindex="1" title="<?php _e('Mute', 'om_theme') ?>"></a>
						<a href="javascript:;" class="jp-unmute" tabindex="1" title="<?php _e('Unmute', 'om_theme') ?>"></a>
					</div>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>

    <?php 
  }
}

/*************************************************************************************
 *	Video Player
 *************************************************************************************/

if ( !function_exists( 'om_video_player' ) ) {
	function om_video_player($post_id, $trysize='456x300') {
	 
		$m4v = get_post_meta($post_id, OM_THEME_SHORT_PREFIX.'video_m4v', true);
		$ogv = get_post_meta($post_id, OM_THEME_SHORT_PREFIX.'video_ogv', true);
		$poster = get_post_meta($post_id, OM_THEME_SHORT_PREFIX.'video_poster', true);

		if($poster && $trysize) {
			$uploads = wp_upload_dir();
			
			if(strpos($poster,$uploads['baseurl']) === 0) {
				$name=basename($poster);
				$name_new=explode('.',$name);
				if(count($name_new > 1))
					$name_new[count($name_new)-2].='-'.$trysize;
				$name_new=implode('.',$name_new);
				$poster_new=str_replace($name,$name_new,$poster);
				if(file_exists(str_replace($uploads['baseurl'],$uploads['basedir'],$poster_new)))
					$poster=$poster_new;
			}
		} elseif(!$poster && $trysize=='456x300') {
			$poster=TEMPLATE_DIR_URI.'/img/video.png';
		}
		
		$supplied=array();
		if($m4v)
			$supplied[]='m4v';
		if($ogv)
			$supplied[]='ogv';
		if(empty($supplied))
			return;
		$supplied=implode(',',$supplied);	
		
		$setmedia=array();
		if($poster)
			$setmedia[]='poster: "'.$poster.'"';
		if($m4v)
			$setmedia[]='m4v: "'.$m4v.'"';
		if($ogv)
			$setmedia[]='ogv: "'.$ogv.'"';
		$setmedia=implode(',',$setmedia);
		
    ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){

				if(jQuery().jPlayer) {
					jQuery("#jquery_jplayer_<?php echo $post_id; ?>").jPlayer({
						ready: function () {
							jQuery(this).jPlayer("setMedia", {
						    <?php echo $setmedia; ?>
							});
						},
						<?php if( !empty($poster) ) { ?>
							size: {
        				width: "100%",
        				height: "100%"
        			},
     				<?php } ?>
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_container_<?php echo $post_id; ?>",
						supplied: "<?php echo $supplied ?>"
					});
			
				}
			});
		</script>

		<div class="video-embed<?php if($poster) echo '-ni';?>"><div id="jquery_jplayer_<?php echo $post_id; ?>" class="jp-jplayer"></div></div>

		<div id="jp_container_<?php echo $post_id; ?>" class="jp-container jp-video">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<div class="jp-controls">
						<a href="javascript:;" class="jp-play" tabindex="1" title="<?php _e('Play', 'om_theme') ?>"></a>
						<a href="javascript:;" class="jp-pause" tabindex="1" title="<?php _e('Pause', 'om_theme') ?>"></a>
						<div class="jp-play-pause-divider"></div>
						<div class="jp-mute-unmute-divider"></div>
						<a href="javascript:;" class="jp-mute" tabindex="1" title="<?php _e('Mute', 'om_theme') ?>"></a>
						<a href="javascript:;" class="jp-unmute" tabindex="1" title="<?php _e('Unmute', 'om_theme') ?>"></a>
					</div>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>

    <?php 
  }
}

/*************************************************************************************
 * Select menu
 *************************************************************************************/
 
function om_select_menu($id, $select_id='primary-menu-select') {
	$out='';
	$out.='<select id="'.$select_id.'" onchange="if(this.value!=\'\'){document.location.href=this.value}"><option value="">'.__('Menu:','om_theme').'</option>';
	
 	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $id ] ) ) {
 		
		$menu = wp_get_nav_menu_object( $locations[ $id ] );
	
		$sel_menu=wp_get_nav_menu_items($menu->term_id);

		if(is_array($sel_menu)) {
			
			$items=array();
		
			foreach($sel_menu as $item)
				$items[$item->ID]=array('parent'=>$item->menu_item_parent);
				
			foreach($items as $k=>$v) {
				$items[$k]['depth']=0;
				if($v['parent']) {
					$tmp=$v;
					while($tmp['parent']) {
						$items[$k]['depth']++;
						$tmp=$items[$tmp['parent']];
					}
				}
			}
			foreach($sel_menu as $item)
				$out.= '<option value="'.($item->url).'"'.((strcasecmp('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],$item->url)==0)?' selected="selected"':'').'>'.str_repeat('- ',$items[$item->ID]['depth']).($item->title).'</option>';
		}
	}
	
	$out.= '</select>';
	
	echo $out;
	
	return true;
}

/*************************************************************************************
 * Archive Page Title
 *************************************************************************************/
 
function om_get_archive_page_title() {
	
	$out='';
	
	if (is_category()) { 
		$out = sprintf(__('All posts in %s', 'om_theme'), single_cat_title('',false));
	} elseif( is_tag() ) {
		$out = sprintf(__('All posts tagged %s', 'om_theme'), single_tag_title('',false));
	} elseif (is_day()) { 
		$out = __('Archive for', 'om_theme'); $out .= ' '.get_the_time('F jS, Y'); 
	} elseif (is_month()) { 
		$out = __('Archive for', 'om_theme'); $out .= ' '.get_the_time('F, Y'); 
	} elseif (is_year()) { 
		$out = __('Archive for', 'om_theme'); $out .= ' '.get_the_time('Y');
	} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		$out = __('Blog Archives', 'om_theme');
	} else { 
		$blog = get_post(get_option('page_for_posts'));
		$out = $blog->post_title;
	}
 	
 	return $out;
}

/*************************************************************************************
 * Wrap paginate_links
 *************************************************************************************/
 
function om_wrap_paginate_links($links) {

	if(!is_array($links))
		return '';

	$out='';
	$out.= '<div class="navigation-pages navigation-prev-next">';
		foreach($links as $v) {
			$v=str_replace(' current',' item current',$v);
			$v=preg_replace('#(<a[^>]*>)([0-9]+)(</a>)#','$1<span class="item">$2</span>$3',$v);
			$v=preg_replace('#(<a[^>]*class="[^"]*prev[^"]*"[^>]*>)([\s\S]*?)(</a>)#','<span class="navigation-prev" style="float:none;display:inline-block;margin-right:6px">$1$2$3</span>',$v);
			$v=preg_replace('#(<a[^>]*class="[^"]*next[^"]*"[^>]*>)([\s\S]*?)(</a>)#','<span class="navigation-next" style="float:none;display:inline-block">$1$2$3</span>',$v);
			$out.= $v;
		}
	$out.= '</div>';

	return $out;
}

/*************************************************************************************
 * Social Icons
 *************************************************************************************/
 
function om_get_social_icons_list() {
	return array('twitter', 'facebook', 'instagram', 'linkedin', 'behance', 'rss', 'blogger', 'deviantart', 'dribble', 'flickr', 'lastfm', 'google', 'myspace', 'pinterest', 'skype', 'vimeo', 'youtube');
}

function om_get_social_icons_html() {

	$icons_html='';

	$icons=om_get_social_icons_list();
	$color=get_option(OM_THEME_PREFIX.'social_icons_color');
	if(!$color)
		$color='light';
	foreach($icons as $v) {
		if( $icon = get_option(OM_THEME_PREFIX.'social_'.$v) )
			$icons_html.= '<a href="'.$icon.'" class="social color-'.$color.' '.$v.'" target="_blank"></a>';
	}

	return $icons_html;
}
 
/*************************************************************************************
 * Adjacent Custom Post
 *************************************************************************************/

function om_get_previous_post($in_same_cat = false, $excluded_categories = '', $taxonomy='category', $orderby='post_date') {
	if((!$in_same_cat || $taxonomy=='category')  && $orderby == 'post_date')
		// use standard function for standard parameters - safer
		return get_previous_post($in_same_cat, $excluded_categories);
	else
		return om_get_adjacent_post($in_same_cat, $excluded_categories, true, $taxonomy, $orderby);
}

function om_get_next_post($in_same_cat = false, $excluded_categories = '', $taxonomy='category', $orderby='post_date') {
	if((!$in_same_cat || $taxonomy=='category') && $orderby == 'post_date')
		// use standard function for standard parameters - safer
		return get_next_post($in_same_cat, $excluded_categories);
	else
		return om_get_adjacent_post($in_same_cat, $excluded_categories, false, $taxonomy, $orderby);
}

function om_get_adjacent_post( $in_same_cat = false, $excluded_categories = '', $previous = true, $taxonomy='category', $orderby='post_date' ) {
	global $wpdb, $post;

	if ( ! $post )
		return null;

	$current_post_order_val = $post->$orderby;

	$join = '';
	$posts_in_ex_cats_sql = '';
	if ( $in_same_cat || ! empty( $excluded_categories ) ) {
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

		if ( $in_same_cat ) {
			if ( ! is_object_in_taxonomy( $post->post_type, $taxonomy ) )
				return '';
			$cat_array = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
			if ( ! $cat_array || is_wp_error( $cat_array ) )
				return '';
			$join .= " AND tt.taxonomy = '".$taxonomy."' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
		}

		$posts_in_ex_cats_sql = "AND tt.taxonomy = '".$taxonomy."'";
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
				$posts_in_ex_cats_sql = " AND tt.taxonomy = '".$taxonomy."' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
			}
		}
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	$join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
	$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.".$orderby." $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_order_val, $post->post_type), $in_same_cat, $excluded_categories );
	$sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.".$orderby." $order LIMIT 1" );

	$query = "SELECT p.id FROM $wpdb->posts AS p $join $where $sort";
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

/*************************************************************************************
 * Adjacent Custom Post Link
 *************************************************************************************/

function om_previous_post_link($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '', $taxonomy='category', $orderby='post_date') {
	if((!$in_same_cat || $taxonomy=='category') && $orderby == 'post_date')
		// use standard function for standard parameters - safer
		previous_post_link($format, $link, $in_same_cat, $excluded_categories);
	else
		om_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, true, $taxonomy, $orderby);
}

function om_next_post_link($format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories = '', $taxonomy='category', $orderby='post_date') {
	if((!$in_same_cat || $taxonomy=='category') && $orderby == 'post_date')
		// use standard function for standard parameters - safer
		next_post_link($format, $link, $in_same_cat, $excluded_categories);
	else
		om_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, false, $taxonomy, $orderby);
}

function om_adjacent_post_link( $format, $link, $in_same_cat = false, $excluded_categories = '', $previous = true, $taxonomy='category', $orderby='post_date' ) {
	
	if(!isset($GLOBALS['post']))
		return null;
		
	$g_post=$GLOBALS['post'];	

	if ( $previous && is_attachment() )
		$post = get_post( $g_post->post_parent );
	else
		$post = om_get_adjacent_post( $in_same_cat, $excluded_categories, $previous, $taxonomy, $orderby );

	if ( ! $post ) {
		$output = '';
	} else {
		$title = $post->post_title;

		if ( empty( $post->post_title ) )
			$title = $previous ? __( 'Previous Post' ) : __( 'Next Post' );

		$title = apply_filters( 'the_title', $title, $post->ID );
		$date = mysql2date( get_option( 'date_format' ), $post->post_date );
		$rel = $previous ? 'prev' : 'next';

		$string = '<a href="' . get_permalink( $post ) . '" rel="'.$rel.'">';
		$inlink = str_replace( '%title', $title, $link );
		$inlink = str_replace( '%date', $date, $inlink );
		$inlink = $string . $inlink . '</a>';

		$output = str_replace( '%link', $inlink, $format );
	}

	$adjacent = $previous ? 'previous' : 'next';

	echo apply_filters( "{$adjacent}_post_link", $output, $format, $link, $post );
}

/*************************************************************************************
 * Admin Browse Button
 *************************************************************************************/

if( !function_exists( 'om_enqueue_admin_browse_button' ) ) {  
	function om_enqueue_admin_browse_button() {

		wp_enqueue_script('om-admin-browse-button', TEMPLATE_DIR_URI . '/admin/js/browse-button.js', array('jquery'), OM_THEME_VERSION);
		if(function_exists( 'wp_enqueue_media' ))
			wp_enqueue_media();
			
	}
}

/*************************************************************************************
 * HTTP to local address // check if given URL could be converted to local address
 *************************************************************************************/

function om_http2local ($url) {

	if($_SERVER['DOCUMENT_ROOT']) {
		if(stripos($url, 'http://'.$_SERVER['HTTP_HOST']) === 0) {
			$url_=$_SERVER['DOCUMENT_ROOT'].substr($url,strlen('http://'.$_SERVER['HTTP_HOST']));
			if(file_exists($url_))
				$url=$url_;
		} elseif(stripos($url, 'https://'.$_SERVER['HTTP_HOST']) === 0) {
			$url_=$_SERVER['DOCUMENT_ROOT'].substr($url,strlen('https://'.$_SERVER['HTTP_HOST']));
			if(file_exists($url_))
				$url=$url_;
		} elseif(substr($url,0,1) == '/') {
			$url_=$_SERVER['DOCUMENT_ROOT'].$url;
			if(file_exists($url_))
				$url=$url_;
		}
	}
	
	return $url;

}