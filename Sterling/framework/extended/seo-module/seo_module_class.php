<?php
//mod by tt
//change from Class All_in_One_SEO_Pack to TT_SEO_MODULE
class TT_SEO_MODULE{
	
 	var $version = "1.6.13.3";
 	
 	/** Max numbers of chars in auto-generated description */
 	var $maximum_description_length = 160;
 	
 	/** Minimum number of chars an excerpt should be so that it can be used
 	 * as description. Touch only if you know what you're doing
 	 */
 	var $minimum_description_length = 1;
 	
 	var $ob_start_detected = false;
 	
 	var $title_start = -1;
 	
 	var $title_end = -1;
 	
 	/** The title before rewriting */
 	var $orig_title = '';
 	
 	/** Temp filename for the latest version. */
// 	var $upgrade_filename = 'temp.zip';
 	
 	/** Where to extract the downloaded newest version. */
// 	var $upgrade_folder;
 	
 	/** Any error in upgrading. */
// 	var $upgrade_error;
 	
 	/** Which zip to download in order to upgrade .*/
// 	var $upgrade_url = 'http://downloads.wordpress.org/plugin/all-in-one-seo-pack.zip';
 	
 	/** Filename of log file. */
 	var $log_file;
 	
 	/** Flag whether there should be logging. */
 	var $do_log;
 	
 	var $wp_version;
	
	var $aioseop_op;
 	//var $aioseop_options = get_option('aioseop_options');

//mod by tt
//change from function All_in_One_SEO_Pack to TT_SEO_MODULE
	function TT_SEO_MODULE() {
		global $wp_version;
		global $aioseop_options;
		$this->wp_version = $wp_version;
		
	//suppress by tt, prevent log?
	//	$this->log_file = dirname(__FILE__) . '/all_in_one_seo_pack.log';
	//	if ($aioseop_options['aiosp_do_log']) {
	//		$this->do_log = true;
	//	} else {
			$this->do_log = false;
	//	}

//		$this->upgrade_filename = dirname(__FILE__) . '/' . $this->upgrade_filename;
//		$this->upgrade_folder = dirname(__FILE__);
	}
	
	/**      
	 * Convert a string to lower case
	 * Compatible with mb_strtolower(), an UTF-8 friendly replacement for strtolower()
	 */
	function strtolower($str) {
		global $UTF8_TABLES;
		return strtr($str, $UTF8_TABLES['strtolower']);
	}
	
	/**      
	 * Convert a string to upper case
	 * Compatible with mb_strtoupper(), an UTF-8 friendly replacement for strtoupper()
	 */
	function strtoupper($str) {
		global $UTF8_TABLES;
		return strtr($str, $UTF8_TABLES['strtoupper']);
	}	
	
	
	function template_redirect() {
		global $wp_query;
		global $aioseop_options;

		$post = $wp_query->get_queried_object();

		if( $this->aioseop_mrt_exclude_this_page()){
			return;
		}

		if (is_feed()) {
			return;
		}

		if (is_single() || is_page()) {
		    $aiosp_disable = htmlspecialchars(stripcslashes(get_post_meta($post->ID, '_aioseop_disable', true)));
		    if ($aiosp_disable) {
		    	return;
		    }
		}



		if ($aioseop_options['aiosp_rewrite_titles']) {
			ob_start(array($this, 'output_callback_for_title'));
		}
	}
	
	function aioseop_mrt_exclude_this_page(){
			global $aioseop_options;
			$excludedstuff = array();
			$currenturl = trim($_SERVER['REQUEST_URI'],'/');
	/*		echo "<br /><br />";
			echo $aioseop_options['aiosp_ex_pages'];
			echo "<br /><br />";
*/
		    if(isset($aioseop_options['aiosp_ex_pages'])):
			$excludedstuff = explode(',',$aioseop_options['aiosp_ex_pages']);
			endif;
			foreach($excludedstuff as $exedd){
				//echo $exedd;
			    $exedd = trim($exedd);
			            if($exedd){
			                if(stristr($currenturl, $exedd)){
			                    return true;
				}
			}
		}
		return false;
	}
	
	function output_callback_for_title($content) {
		return $this->rewrite_title($content);
	}






//
//CHECK IF ARRAY EXISTS IN DB, IF SO, GET ARRAY, ADD EVERYTHING, CHECK FOR ISSET?
//
	function init() {
if (function_exists('load_plugin_textdomain')) {
	if ( !defined('WP_PLUGIN_DIR') ) {
	//suppress by TT
	//	load_plugin_textdomain('all_in_one_seo_pack', str_replace( ABSPATH, '', dirname(__FILE__)));
	} else {
	//suppress by TT
	//	load_plugin_textdomain('all_in_one_seo_pack', false, dirname(plugin_basename(__FILE__)));
	}
}


/*
		if (function_exists('load_plugin_textdomain')) {
			load_plugin_textdomain('all_in_one_seo_pack', WP_PLUGIN_DIR . '/all-in-one-seo-pack');
		}
*/

	}

	function is_static_front_page() {
		global $wp_query;
		global $aioseop_options;
		$post = $wp_query->get_queried_object();
		return get_option('show_on_front') == 'page' && is_page() && $post->ID == get_option('page_on_front');
	}
	
	function is_static_posts_page() {
		global $wp_query;
		$post = $wp_query->get_queried_object();
		return get_option('show_on_front') == 'page' && is_home() && $post->ID == get_option('page_for_posts');
	}
	
	function get_base() {
   		 return '/'.end(explode('/', str_replace(array('\\','/seo_module.php'),array('/',''),__FILE__)));
	}

	function seo_mrt_admin_head() {
	
		//suppress by tt, there is no admin stylesheet.
		//$home = get_settings('siteurl');
		//$stylesheet = WP_PLUGIN_URL . '/all-in-one-seo-pack/style.css';
		//echo '<link rel="stylesheet" href="' . $stylesheet . '" type="text/css" media="screen" />';
	}


	function wp_head() {
		if (is_feed()) {
			return;
		}
		
		global $wp_query;
		global $aioseop_options;
		$post = $wp_query->get_queried_object();
		$meta_string = null;
		if($this->is_static_posts_page()){
					$title = strip_tags( apply_filters( 'single_post_title', $post->post_title ) );

				}
		//echo("wp_head() " . wp_title('', false) . " is_home() => " . is_home() . ", is_page() => " . is_page() . ", is_single() => " . is_single() . ", is_static_front_page() => " . $this->is_static_front_page() . ", is_static_posts_page() => " . $this->is_static_posts_page());

		if (is_single() || is_page()) {
		    $aiosp_disable = htmlspecialchars(stripcslashes(get_post_meta($post->ID, '_aioseop_disable', true)));
		    if ($aiosp_disable) {
		    	return;
		    }
		}
		
			if( $this->aioseop_mrt_exclude_this_page()==TRUE ){
				return;
			}
		
		if ($aioseop_options['aiosp_rewrite_titles']) {
			// make the title rewrite as short as possible
			if (function_exists('ob_list_handlers')) {
				$active_handlers = ob_list_handlers();
			} else {
				$active_handlers = array();
			}
			if (sizeof($active_handlers) > 0 &&
				strtolower($active_handlers[sizeof($active_handlers) - 1]) ==
				strtolower('All_in_One_SEO_Pack::output_callback_for_title')) {
				ob_end_flush();
			} else {
				$this->log("another plugin interfering?");
				// if we get here there *could* be trouble with another plugin :(
				$this->ob_start_detected = true;
				if (function_exists('ob_list_handlers')) {
					foreach (ob_list_handlers() as $handler) {
						$this->log("detected output handler $handler");
					}
				}
			}
		}
		
		/*
		
		echo trim($_SERVER['REQUEST_URI'],'/');
		$currenturl = trim($_SERVER['REQUEST_URI'],'/');
		echo "<br /><br />";
		
		echo $aioseop_options['aiosp_ex_pages'];
		
		echo "<br /><br />";
		
		$excludedstuff = explode(',',$aioseop_options['aiosp_ex_pages']);
		foreach($excludedstuff as $exedd){
			echo $exedd;
			//echo "<br /><br />substring: ". stristr($currenturl,trim($exedd)) . "<br />";
			if(stristr($currenturl, trim($exedd))){
				echo "<br />match, should not display<br /><br />";
			}else{
				echo "<br />( " . $exedd . " was not found in " . $currenturl . " ) - no match<br /><br />";
			}
		}
		//print_r($excludedstuff);
		*/
	//	echo "\n<!-- All in One SEO Pack $this->version by Michael Torbert of Semper Fi Web Design";
		if ($this->ob_start_detected) {
	//		echo "ob_start_detected ";
		}
	//	echo "[$this->title_start,$this->title_end] ";
	//	echo "-->\n";
		if ((is_home() && $aioseop_options['aiosp_home_keywords'] && !$this->is_static_posts_page()) || $this->is_static_front_page()) {
			$keywords = trim($this->internationalize($aioseop_options['aiosp_home_keywords']));
		} elseif($this->is_static_posts_page() && !$aioseop_options['aiosp_dynamic_postspage_keywords']){  // and if option = use page set keywords instead of keywords from recent posts
				//$keywords = "posts keyyysss" . stripcslashes(get_post_meta($post->ID,'keywords',true));
				$keywords = stripcslashes($this->internationalize(get_post_meta($post->ID, "_aioseop_keywords", true)));
              
//			$keywords =	$this->get_unique_keywords($keywords);

			}	else {
				$keywords = $this->get_all_keywords();
			}
			if (is_single() || is_page() || $this->is_static_posts_page()) {
				if ($this->is_static_front_page()) {
					$description = trim(stripcslashes($this->internationalize($aioseop_options['aiosp_home_description'])));
				} else {
					$description = $this->get_post_description($post);
					$description = apply_filters('aioseop_description',$description);
				}
			} else if (is_home()) {
				$description = trim(stripcslashes($this->internationalize($aioseop_options['aiosp_home_description'])));
			} else if (is_category()) {
				$description = $this->internationalize(category_description());
			}
		
			if (isset($description) && (strlen($description) > $this->minimum_description_length) && !(is_home() && is_paged())) {
				$description = trim(strip_tags($description));
				$description = str_replace('"', '', $description);
			
				// replace newlines on mac / windows?
				$description = str_replace("\r\n", ' ', $description);
			
				// maybe linux uses this alone
				$description = str_replace("\n", ' ', $description);
			
				if (isset($meta_string)) {
					//$meta_string .= "\n";
				} else {
					$meta_string = '';
				}
			
				// description format
				$description_format = $aioseop_options['aiosp_description_format'];
				if (!isset($description_format) || empty($description_format)) {
					$description_format = "%description%";
				}
				$description = str_replace('%description%', apply_filters('aioseop_description_override', $description), $description_format);
				$description = str_replace('%blog_title%', get_bloginfo('name'), $description);
				$description = str_replace('%blog_description%', get_bloginfo('description'), $description);
				$description = str_replace('%wp_title%', $this->get_original_title(), $description);
				//$description = html_entity_decode($description, ENT_COMPAT, get_bloginfo('charset')); 
				if($aioseop_options['aiosp_can'] && is_attachment()){
					$url = $this->aiosp_mrt_get_url($wp_query);
					if ($url) {
						preg_match_all('/(\d+)/', $url, $matches);
						if (is_array($matches)){
							$uniqueDesc = join('',$matches[0]);
						}
					}
					$description .= ' ' . $uniqueDesc;
				}
				$meta_string .= sprintf("<meta name=\"description\" content=\"%s\" />", $description);
			}
			$keywords = apply_filters('aioseop_keywords',$keywords);		
			if (isset ($keywords) && !empty($keywords) && !(is_home() && is_paged())) {
				if (isset($meta_string)) {
					$meta_string .= "\n";
				}
				$keywords = str_replace('"','',$keywords);
				$meta_string .= sprintf("<meta name=\"keywords\" content=\"%s\" />", $keywords);
			}

			if (function_exists('is_tag')) {
				$is_tag = is_tag();
			}
		
			if ((is_category() && $aioseop_options['aiosp_category_noindex']) || (!is_category() && is_archive() &&!$is_tag && $aioseop_options['aiosp_archive_noindex']) || ($aioseop_options['aiosp_tags_noindex'] && $is_tag)) {
				if (isset($meta_string)) {
					$meta_string .= "\n";
				}
				$meta_string .= '<meta name="robots" content="noindex,follow" />';
			}
		
			$page_meta = stripcslashes($aioseop_options['aiosp_page_meta_tags']);
			$post_meta = stripcslashes($aioseop_options['aiosp_post_meta_tags']);
			$home_meta = stripcslashes($aioseop_options['aiosp_home_meta_tags']);
			if (is_page() && isset($page_meta) && !empty($page_meta) || $this->is_static_posts_page()) {
				if (isset($meta_string)) {
					$meta_string .= "\n";
				}
				echo "\n$page_meta";
			}
		
			if (is_single() && isset($post_meta) && !empty($post_meta)) {
				if (isset($meta_string)) {
					$meta_string .= "\n";
				}
				$meta_string .= "$post_meta";
			}
			
			//Modified by TT
			//added check for static front page set on wp-admin>settings>readings.
			global $post;
			if(isset($post)){
			$post_id = $post->ID;
			}else{
			$post_id = 0;
			}
			$page_on_front = get_option('page_on_front');
			if($post_id == $page_on_front){
				if (isset($meta_string)) {
					$meta_string .= "\n";
				}
				$meta_string .= "$home_meta";
			//	echo $meta_string;			
			
			}
		
			if (is_home() && !empty($home_meta)){
				if (isset($meta_string)) {
					$meta_string .= "\n";
				}
				$meta_string .= "$home_meta";
				echo $meta_string;
			}
		
			if ($meta_string != null) {
				echo "$meta_string\n";
			}
		
			if($aioseop_options['aiosp_can']){
				$url = $this->aiosp_mrt_get_url($wp_query);
				if ($url) {
					$url = apply_filters('aioseop_canonical_url',$url);
					
					echo "".'<link rel="canonical" href="'.$url.'" />'."\n";
				}
			}
		
			// echo "<!-- /all in one seo pack -->\n";
		}

		// Thank you, Yoast de Valk, for much of this code.	
	
		function aiosp_mrt_get_url($query) {
			global $aioseop_options;
			if ($query->is_404 || $query->is_search) {
				return false;
			}
			$haspost = count($query->posts) > 0;
			$has_ut = function_exists('user_trailingslashit');

			if (get_query_var('m')) {
				$m = preg_replace('/[^0-9]/', '', get_query_var('m'));
				switch (strlen($m)) {
					case 4: 
					$link = get_year_link($m);
					break;
            		case 6: 
                	$link = get_month_link(substr($m, 0, 4), substr($m, 4, 2));
                	break;
            		case 8: 
                	$link = get_day_link(substr($m, 0, 4), substr($m, 4, 2), substr($m, 6, 2));
	                break;
           			default:
           			return false;
				}
			} elseif (($query->is_single || $query->is_page) && $haspost) {
				$post = $query->posts[0];
				$link = get_permalink($post->ID);
     			$link = $this->yoast_get_paged($link); 
/*	        if ($page && $page > 1) {
	            $link = trailingslashit($link) . "page/". "$page";
	            if ($has_ut) {
	                $link = user_trailingslashit($link, 'paged');
	            } else {
	                $link .= '/';
	            }
	        }
	        if ($query->is_page && ('page' == get_option('show_on_front')) && 
	            $post->ID == get_option('page_on_front'))
	        {
	            $link = trailingslashit($link);
	        }*/
		} elseif ($query->is_author && $haspost) {
   			global $wp_version;
      		if ($wp_version >= '2') {
        		$author = get_userdata(get_query_var('author'));
     			if ($author === false)
        			return false;
       			

       			$link = get_author_posts_url($author->ID, $author->user_nicename);
   			} else {
        		global $cache_userdata;
	            $userid = get_query_var('author');
	            $link = get_author_posts_url($userid, $cache_userdata[$userid]->user_nicename);
      		}
  		} elseif ($query->is_category && $haspost) {
    		$link = get_category_link(get_query_var('cat'));
			$link = $this->yoast_get_paged($link);
		} else if ($query->is_tag  && $haspost) {
			$tag = get_term_by('slug',get_query_var('tag'),'post_tag');
       		if (!empty($tag->term_id)) {
				$link = get_tag_link($tag->term_id);
			} 
			$link = $this->yoast_get_paged($link);			
  		} elseif ($query->is_day && $haspost) {
  			$link = get_day_link(get_query_var('year'),
	                             get_query_var('monthnum'),
	                             get_query_var('day'));
	    } elseif ($query->is_month && $haspost) {
	        $link = get_month_link(get_query_var('year'),
	                               get_query_var('monthnum'));
	    } elseif ($query->is_year && $haspost) {
	        $link = get_year_link(get_query_var('year'));
	    } elseif ($query->is_home) {
	        if ((get_option('show_on_front') == 'page') &&
	            ($pageid = get_option('page_for_posts'))) 
	        {
	            $link = get_permalink($pageid);
				$link = $this->yoast_get_paged($link);
				$link = trailingslashit($link);
	        } else {
	            $link = home_url();
				$link = $this->yoast_get_paged($link);
				$link = trailingslashit($link);	        }
	    } else {
	        return false;
	    }
	
		return $link;
		
	}
	
	
	function yoast_get_paged($link) {
			$page = get_query_var('paged');
	        if ($page && $page > 1) {
	            $link = trailingslashit($link) ."page/". "$page";
	            if (isset($has_ut)) {
	                $link = user_trailingslashit($link, 'paged');
	            } else {
	                $link .= '/';
	            }
			}
			return $link;
	}	
	
	
	function get_post_description($post) {
		global $aioseop_options;
	    $description = trim(stripcslashes($this->internationalize(get_post_meta($post->ID, "_aioseop_description", true))));
		if (!$description) {
			$description = $this->trim_excerpt_without_filters_full_length($this->internationalize($post->post_excerpt));
			if (!$description && $aioseop_options["aiosp_generate_descriptions"]) {
				$description = $this->trim_excerpt_without_filters($this->internationalize($post->post_content));
			}				
		}
		
		// "internal whitespace trim"
		$description = preg_replace("/\s\s+/", " ", $description);
		
		return $description;
	}
	
	function replace_title($content, $title) {
		$title = trim(strip_tags($title));
		
		$title_tag_start = "<title>";
		$title_tag_end = "</title>";
		$len_start = strlen($title_tag_start);
		$len_end = strlen($title_tag_end);
		$title = stripcslashes(trim($title));
		$start = strpos($content, $title_tag_start);
		$end = strpos($content, $title_tag_end);
		
		$this->title_start = $start;
		$this->title_end = $end;
		$this->orig_title = $title;
		
		if ($start && $end) {
			$header = substr($content, 0, $start + $len_start) . $title .  substr($content, $end);
		} else {
			// this breaks some sitemap plugins (like wpg2)
			//$header = $content . "<title>$title</title>";
			
			$header = $content;
		}
		
		return $header;
	}
	
	function internationalize($in) {
		if (function_exists('langswitch_filter_langs_with_message')) {
			$in = langswitch_filter_langs_with_message($in);
		}
		if (function_exists('polyglot_filter')) {
			$in = polyglot_filter($in);
		}
		if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
			$in = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($in);
		}
		$in = apply_filters('localization', $in);
		return $in;
	}
	
	/** @return The original title as delivered by WP (well, in most cases) */
	function get_original_title() {
		global $wp_query;
		global $aioseop_options;
		if (!$wp_query) {
			return null;	
		}
		
		$post = $wp_query->get_queried_object();
		
		// the_search_query() is not suitable, it cannot just return
		global $s;
		
		$title = null;
		
		if (is_home()) {
			$title = get_option('blogname');
		} else if (is_single()) {
			$title = $this->internationalize(wp_title('', false));
		} else if (is_search() && isset($s) && !empty($s)) {
			$search = esc_html(stripcslashes($s), true);
			$search = $this->capitalize($search);
			$title = $search;
		} else if (is_category() && !is_feed()) {
			$category_description = $this->internationalize(category_description());
			$category_name = ucwords($this->internationalize(single_cat_title('', false)));
			$title = $category_name;
		} else if (is_page()) {
			$title = $this->internationalize(wp_title('', false));
		} else if (function_exists('is_tag') && is_tag()) {
			global $utw;
			if ($utw) {
				$tags = $utw->GetCurrentTagSet();
				$tag = $tags[0]->tag;
		        $tag = str_replace('-', ' ', $tag);
			} else {
				// wordpress > 2.3
				$tag = $this->internationalize(wp_title('', false));
			}
			if ($tag) {
				$title = $tag;
			}
		} else if (is_archive()) {
			$title = $this->internationalize(wp_title('', false));
		} else if (is_404()) {
		    $title_format = $aioseop_options['aiosp_404_title_format'];
		    $new_title = str_replace('%blog_title%', $this->internationalize(get_bloginfo('name')), $title_format);
		    $new_title = str_replace('%blog_description%', $this->internationalize(get_bloginfo('description')), $new_title);
		    $new_title = str_replace('%request_url%', $_SERVER['REQUEST_URI'], $new_title);
		    $new_title = str_replace('%request_words%', $this->request_as_words($_SERVER['REQUEST_URI']), $new_title);
				$title = $new_title;
			}
			
			return trim($title);
		}
	
	function paged_title($title) {
		// the page number if paged
		global $paged;
		global $aioseop_options;
		// simple tagging support
		global $STagging;

		if (is_paged() || (isset($STagging) && $STagging->is_tag_view() && $paged)) {
			$part = $this->internationalize($aioseop_options['aiosp_paged_format']);
			if (isset($part) || !empty($part)) {
				$part = " " . trim($part);
				$part = str_replace('%page%', $paged, $part);
				$this->log("paged_title() [$title] [$part]");
				$title .= $part;
			}
		}
		return $title;
	}

	function rewrite_title($header) {
		global $aioseop_options;
		global $wp_query;
		if (!$wp_query) {
			$header .= "<!-- no wp_query found! -->\n";
			return $header;	
		}
		
		$post = $wp_query->get_queried_object();
		
		// the_search_query() is not suitable, it cannot just return
		global $s;
		
		global $STagging;

		if (is_home() && !$this->is_static_posts_page()) {
			$title = $this->internationalize($aioseop_options['aiosp_home_title']);
			if (empty($title)) {
				$title = $this->internationalize(get_option('blogname'));
			}
			$title = $this->paged_title($title);
			$header = $this->replace_title($header, $title);
		} else if (is_attachment()) { 
	                        $title = get_the_title($post->post_parent).' '.$post->post_title.' – '.get_option('blogname');
	                        $header = $this->replace_title($header,$title);
		} else if (is_single()) {
			// we're not in the loop :(
			$authordata = get_userdata($post->post_author);
			$categories = get_the_category();
			$category = '';
			if (count($categories) > 0) {
				$category = $categories[0]->cat_name;
			}
			$title = $this->internationalize(get_post_meta($post->ID, "_aioseop_title", true));
			if (!$title) {
				$title = $this->internationalize(get_post_meta($post->ID, "title_tag", true));
				if (!$title) {
					$title = $this->internationalize(wp_title('', false));
				}
			}
            $title_format = $aioseop_options['aiosp_post_title_format'];
			/*
            $new_title = str_replace('%blog_title%', $this->internationalize(get_bloginfo('name')), $title_format);
            $new_title = str_replace('%blog_description%', $this->internationalize(get_bloginfo('description')), $new_title);
            $new_title = str_replace('%post_title%', $title, $new_title);
            $new_title = str_replace('%category%', $category, $new_title);
            $new_title = str_replace('%category_title%', $category, $new_title);
            $new_title = str_replace('%post_author_login%', $authordata->user_login, $new_title);
            $new_title = str_replace('%post_author_nicename%', $authordata->user_nicename, $new_title);
            $new_title = str_replace('%post_author_firstname%', ucwords($authordata->first_name), $new_title);
            $new_title = str_replace('%post_author_lastname%', ucwords($authordata->last_name), $new_title);
			*/
			$r_title = array('%blog_title%','%blog_description%','%post_title%','%category%','%category_title%','%post_author_login%','%post_author_nicename%','%post_author_firstname%','%post_author_lastname%');
			$d_title = array($this->internationalize(get_bloginfo('name')),$this->internationalize(get_bloginfo('description')),$title, $category, $category, $authordata->user_login, $authordata->user_nicename, ucwords($authordata->first_name), ucwords($authordata->last_name));
			$title = trim(str_replace($r_title, $d_title, $title_format));

	//		$title = $new_title;
	//		$title = trim($title);
			$title = apply_filters('aioseop_title_single',$title);
			$header = $this->replace_title($header, $title);
		} else if (is_search() && isset($s) && !empty($s)) {
		    $search = esc_html(stripcslashes($s), true);
			$search = $this->capitalize($search);
            $title_format = $aioseop_options['aiosp_search_title_format'];
            $title = str_replace('%blog_title%', $this->internationalize(get_bloginfo('name')), $title_format);
            $title = str_replace('%blog_description%', $this->internationalize(get_bloginfo('description')), $title);
            $title = str_replace('%search%', $search, $title);
			$header = $this->replace_title($header, $title);
		} else if (is_category() && !is_feed()) {
			$category_description = $this->internationalize(category_description());
				if($aioseop_options['aiosp_cap_cats']){
					$category_name = ucwords($this->internationalize(single_cat_title('', false)));
				}else{
						$category_name = $this->internationalize(single_cat_title('', false));
				}			
			//$category_name = ucwords($this->internationalize(single_cat_title('', false)));
            $title_format = $aioseop_options['aiosp_category_title_format'];
            $title = str_replace('%category_title%', $category_name, $title_format);
            $title = str_replace('%category_description%', $category_description, $title);
            $title = str_replace('%blog_title%', $this->internationalize(get_bloginfo('name')), $title);
            $title = str_replace('%blog_description%', $this->internationalize(get_bloginfo('description')), $title);
            $title = $this->paged_title($title);
			$header = $this->replace_title($header, $title);
		} else if (is_page() || $this->is_static_posts_page()) {
			// we're not in the loop :(
			$authordata = get_userdata($post->post_author);
			if ($this->is_static_front_page()) {
				if ($this->internationalize($aioseop_options['aiosp_home_title'])) {
							
							//home title filter
							$home_title = $this->internationalize($aioseop_options['aiosp_home_title']);
							$home_title = apply_filters('aioseop_home_page_title',$home_title);
							$header = $this->replace_title($header, $home_title);

				}
			} else {
				$title = $this->internationalize(get_post_meta($post->ID, "_aioseop_title", true));
				if (!$title) {
					$title = $this->internationalize(wp_title('', false));
				}
	            $title_format = $aioseop_options['aiosp_page_title_format'];
	            $new_title = str_replace('%blog_title%', $this->internationalize(get_bloginfo('name')), $title_format);
	            $new_title = str_replace('%blog_description%', $this->internationalize(get_bloginfo('description')), $new_title);
	            $new_title = str_replace('%page_title%', $title, $new_title);
	            $new_title = str_replace('%page_author_login%', $authordata->user_login, $new_title);
	            $new_title = str_replace('%page_author_nicename%', $authordata->user_nicename, $new_title);
	            $new_title = str_replace('%page_author_firstname%', ucwords($authordata->first_name), $new_title);
	            $new_title = str_replace('%page_author_lastname%', ucwords($authordata->last_name), $new_title);
				$title = trim($new_title);
                                $title = $this->paged_title($title);
				$title = apply_filters('aioseop_title_page',$title);
				$header = $this->replace_title($header, $title);
			}
		} else if (function_exists('is_tag') && is_tag()) {
			global $utw;
			if ($utw) {
				$tags = $utw->GetCurrentTagSet();
				$tag = $tags[0]->tag;
	            $tag = str_replace('-', ' ', $tag);
			} else {
				// wordpress > 2.3
				$tag = $this->internationalize(wp_title('', false));
			}
			if ($tag) {
	            $tag = $this->capitalize($tag);
	            $title_format = $aioseop_options['aiosp_tag_title_format'];
	            $title = str_replace('%blog_title%', $this->internationalize(get_bloginfo('name')), $title_format);
	            $title = str_replace('%blog_description%', $this->internationalize(get_bloginfo('description')), $title);
	            $title = str_replace('%tag%', $tag, $title);
	            $title = $this->paged_title($title);
				$header = $this->replace_title($header, $title);
			}
		} else if (isset($STagging) && $STagging->is_tag_view()) { // simple tagging support
			$tag = $STagging->search_tag;
			if ($tag) {
	            $tag = $this->capitalize($tag);
	            $title_format = $aioseop_options['aiosp_tag_title_format'];
	            $title = str_replace('%blog_title%', $this->internationalize(get_bloginfo('name')), $title_format);
	            $title = str_replace('%blog_description%', $this->internationalize(get_bloginfo('description')), $title);
	            $title = str_replace('%tag%', $tag, $title);
	            $title = $this->paged_title($title);
				$header = $this->replace_title($header, $title);
			}
		} else if (is_archive()) {
			$date = $this->internationalize(wp_title('', false));
            $title_format = $aioseop_options['aiosp_archive_title_format'];
            $new_title = str_replace('%blog_title%', $this->internationalize(get_bloginfo('name')), $title_format);
            $new_title = str_replace('%blog_description%', $this->internationalize(get_bloginfo('description')), $new_title);
            $new_title = str_replace('%date%', $date, $new_title);
			$title = trim($new_title);
            $title = $this->paged_title($title);
			$header = $this->replace_title($header, $title);
		} else if (is_404()) {
            $title_format = $aioseop_options['aiosp_404_title_format'];
            $new_title = str_replace('%blog_title%', $this->internationalize(get_bloginfo('name')), $title_format);
            $new_title = str_replace('%blog_description%', $this->internationalize(get_bloginfo('description')), $new_title);
            $new_title = str_replace('%request_url%', $_SERVER['REQUEST_URI'], $new_title);
            $new_title = str_replace('%request_words%', $this->request_as_words($_SERVER['REQUEST_URI']), $new_title);
			$new_title = str_replace('%404_title%', $this->internationalize(wp_title('', false)), $new_title);
			$header = $this->replace_title($header, $new_title);
		}
		
		return $header;

	}
	
	/**
	 * @return User-readable nice words for a given request.
	 */
	function request_as_words($request) {
		$request = htmlspecialchars($request);
		$request = str_replace('.html', ' ', $request);
		$request = str_replace('.htm', ' ', $request);
		$request = str_replace('.', ' ', $request);
		$request = str_replace('/', ' ', $request);
		$request_a = explode(' ', $request);
		$request_new = array();
		foreach ($request_a as $token) {
			$request_new[] = ucwords(trim($token));
		}
		$request = implode(' ', $request_new);
		return $request;
	}
	
	function capitalize($s) {
		$s = trim($s);
		$tokens = explode(' ', $s);
		while (list($key, $val) = each($tokens)) {
			$tokens[$key] = trim($tokens[$key]);
			$tokens[$key] = strtoupper(substr($tokens[$key], 0, 1)) . substr($tokens[$key], 1);
		}
		$s = implode(' ', $tokens);
		return $s;
	}
	
	function trim_excerpt_without_filters($text) {
		$text = str_replace(']]>', ']]&gt;', $text);
                $text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $text );
		$text = strip_tags($text);
		$max = $this->maximum_description_length;
		
		if ($max < strlen($text)) {
			while($text[$max] != ' ' && $max > $this->minimum_description_length) {
				$max--;
			}
		}
		$text = substr($text, 0, $max);
		return trim(stripcslashes($text));
	}
	
	function trim_excerpt_without_filters_full_length($text) {
		$text = str_replace(']]>', ']]&gt;', $text);
                $text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $text );
		$text = strip_tags($text);
		return trim(stripcslashes($text));
	}
	
	/**
	 * @return comma-separated list of unique keywords
	 */
	function get_all_keywords() {
		global $posts;
		global $aioseop_options;

		if (is_404()) {
			return null;
		}
		
		// if we are on synthetic pages
		if (!is_home() && !is_page() && !is_single() &&!$this->is_static_front_page() && !$this->is_static_posts_page()) {
			return null;
		}

	    $keywords = array();
	    if (is_array($posts)) {
	        foreach ($posts as $post) {
	            if ($post) {

	                // custom field keywords
	                $keywords_a = $keywords_i = null;
	                $description_a = $description_i = null;
           
                    $id = (is_attachment())?($post->post_parent):($post->ID); // if attachment then use parent post id
                    $keywords_i = stripcslashes($this->internationalize(get_post_meta($id, "_aioseop_keywords", true)));
       				//$id = $post->ID;
					//$keywords_i = stripcslashes($this->internationalize(get_post_meta($post->ID, "_aioseop_keywords", true)));
	                $keywords_i = str_replace('"', '', $keywords_i);
	                if (isset($keywords_i) && !empty($keywords_i)) {
	                	$traverse = explode(',', $keywords_i);
	                	foreach ($traverse as $keyword) {
	                		$keywords[] = $keyword;
	                	}
	                }
	                
	                // WP 2.3 tags
				if ($aioseop_options['aiosp_use_tags_as_keywords']){
	                if (function_exists('get_the_tags')) {
	                	//$tags = get_the_tags($post->ID);
						$tags = get_the_tags($id);
	                	if ($tags && is_array($tags)) {
		                	foreach ($tags as $tag) {
		                		$keywords[] = $this->internationalize($tag->name);
		                	}
	                	}
	                }
				}
	                // Ultimate Tag Warrior integration
	                global $utw;
	                if ($utw) {
	                	$tags = $utw->GetTagsForPost($post);
	                	if (is_array($tags)) {
		                	foreach ($tags as $tag) {
								$tag = $tag->tag;
								$tag = str_replace('_',' ', $tag);
								$tag = str_replace('-',' ',$tag);
								$tag = stripcslashes($tag);
		                		$keywords[] = $tag;
		                	}
	                	}
	                }
	                
	                // autometa
					$autometa = stripcslashes(get_post_meta($id, 'autometa', true));
	                //$autometa = stripcslashes(get_post_meta($post->ID, "autometa", true));
	                if (isset($autometa) && !empty($autometa)) {
	                	$autometa_array = explode(' ', $autometa);
	                	foreach ($autometa_array as $e) {
	                		$keywords[] = $e;
	                	}
	                }

	            	if ($aioseop_options['aiosp_use_categories'] && !is_page()) {
		                $categories = get_the_category($id); 
						//$categories = get_the_category($post->ID);
		                foreach ($categories as $category) {
		                	$keywords[] = $this->internationalize($category->cat_name);
		                }
	            	}

	            }
	        }
	    }
	    
	    return $this->get_unique_keywords($keywords);
	}
	
	function get_meta_keywords() {
		global $posts;

	    $keywords = array();
	    if (is_array($posts)) {
	        foreach ($posts as $post) {
	            if ($post) {
	                // custom field keywords
	                $keywords_a = $keywords_i = null;
	                $description_a = $description_i = null;
	                $id = $post->ID;
		            $keywords_i = stripcslashes(get_post_meta($post->ID, "_aioseop_keywords", true));
	                $keywords_i = str_replace('"', '', $keywords_i);
	                if (isset($keywords_i) && !empty($keywords_i)) {
	                    $keywords[] = $keywords_i;
	                }
	            }
	        }
	    }
	    
	    return $this->get_unique_keywords($keywords);
	}
	
	function get_unique_keywords($keywords) {
		$small_keywords = array();
		foreach ($keywords as $word) {
			if (function_exists('mb_strtolower'))			
				$small_keywords[] = mb_strtolower($word, get_bloginfo('charset'));
			else 
				$small_keywords[] = $this->strtolower($word);
		}
		$keywords_ar = array_unique($small_keywords);
		return implode(',', $keywords_ar);
	}
	
	function get_url($url)	{
/**	
		if (function_exists('file_get_contents')) {
			$file = file_get_contents($url);
		} else {
	        $curl = curl_init($url);
	        curl_setopt($curl, CURLOPT_HEADER, 0);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        $file = curl_exec($curl);
	        curl_close($curl);
	    }
	    return $file;
**/	    
	}
	
	function log($message) {
		if ($this->do_log) {
			error_log(date('Y-m-d H:i:s') . " " . $message . "\n", 3, $this->log_file);
		}
	}

	function download_newest_version() {
/**
		$success = true;
	    $file_content = $this->get_url($this->upgrade_url);
	    if ($file_content === false) {
	    	$this->upgrade_error = sprintf(__("Could not download distribution (%s)","truethemes"), $this->upgrade_url);
			$success = false;
	    } else if (strlen($file_content) < 100) {
	    	$this->upgrade_error = sprintf(__("Could not download distribution (%s): %s","truethemes"), $this->upgrade_url, $file_content);
			$success = false;
	    } else {
	    	$this->log(sprintf("filesize of download ZIP: %d", strlen($file_content)));
		    $fh = @fopen($this->upgrade_filename, 'w');
		    $this->log("fh is $fh");
		    if (!$fh) {
		    	$this->upgrade_error = sprintf(__("Could not open %s for writing","truethemes"), $this->upgrade_filename);
		    	$this->upgrade_error .= "<br />";
		    	$this->upgrade_error .= sprintf(__("Please make sure %s is writable","truethemes"), $this->upgrade_folder);
		    	$success = false;
		    } else {
		    	$bytes_written = @fwrite($fh, $file_content);
			    $this->log("wrote $bytes_written bytes");
		    	if (!$bytes_written) {
			    	$this->upgrade_error = sprintf(__("Could not write to %s","truethemes"), $this->upgrade_filename);
			    	$success = false;
		    	}
		    }
		    if ($success) {
		    	fclose($fh);
		    }
	    }
	    return $success;
**/
	}

	function install_newest_version() {
/**
		$success = $this->download_newest_version();
	    if ($success) {
		    $success = $this->extract_plugin();
		    unlink($this->upgrade_filename);
	    }
	    return $success;
**/

	}

	function extract_plugin() {
/**
	    if (!class_exists('PclZip')) {
	        require_once ('pclzip.lib.php');
	    }
	    $archive = new PclZip($this->upgrade_filename);
	    $files = $archive->extract(PCLZIP_OPT_STOP_ON_ERROR, PCLZIP_OPT_REPLACE_NEWER, PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_PATH, $this->upgrade_folder);
	    $this->log("files is $files");
	    if (is_array($files)) {
	    	$num_extracted = sizeof($files);
		    $this->log("extracted $num_extracted files to $this->upgrade_folder");
		    $this->log(print_r($files, true));
	    	return true;
	    } else {
	    	$this->upgrade_error = $archive->errorInfo();
	    	return false;

      }
**/
	}
	
	/** crude approximization of whether current user is an admin */
	function is_admin() {
		return current_user_can('administrator');
	}

	
	function is_directory_writable($directory) {
/**
		$filename = $directory . '/' . 'tmp_file_' . time();
		$fh = @fopen($filename, 'w');
		if (!$fh) {
			return false;
		}
		
		$written = fwrite($fh, "test");
		fclose($fh);
		unlink($filename);
		if ($written) {
			return true;
		} else {
			return false;
		}
**/
	}


	function is_upgrade_directory_writable() {
		//return $this->is_directory_writable($this->upgrade_folder);
		// let's assume it is
		return true;
	}


	function post_meta_tags($id) {
	    if(isset($_POST["aiosp_edit"])):
	    $awmp_edit = $_POST["aiosp_edit"];
	    endif;
	    if(isset($_POST['nonce-aioseop-edit'])):
		$nonce = $_POST['nonce-aioseop-edit'];
		endif;
//		if (!wp_verify_nonce($nonce, 'edit-aioseop-nonce')) die ( 'Security Check - If you receive this in error, log out and back in to WordPress');
	    if (isset($awmp_edit) && !empty($awmp_edit) && wp_verify_nonce($nonce, 'edit-aioseop-nonce')) {
	    
	    	if(isset($_POST["aiosp_keywords"])):
		    $keywords = $_POST["aiosp_keywords"];
		    endif;
		    
		    if(isset($_POST["aiosp_description"])):
		    $description = $_POST["aiosp_description"];
		    endif;
		    
		    if(isset($_POST["aiosp_title"])):
		    $title = $_POST["aiosp_title"];
		    endif;
		    
		    if(isset($_POST["aiosp_meta"])):
		    $aiosp_meta = $_POST["aiosp_meta"];
		    endif;
		    
		    if(isset($_POST["aiosp_disable"])):
		    $aiosp_disable = $_POST["aiosp_disable"];
		    endif;
		    
		    if(isset($_POST["aiosp_titleatr"])):
		    $aiosp_titleatr = $_POST["aiosp_titleatr"];
		    endif;
		    
		    if(isset($_POST["aiosp_menulabel"])):
		    $aiosp_menulabel = $_POST["aiosp_menulabel"];
		    endif;
				
		    delete_post_meta($id, '_aioseop_keywords');
		    delete_post_meta($id, '_aioseop_description');
		    delete_post_meta($id, '_aioseop_title');
		    delete_post_meta($id, '_aioseop_titleatr');
		    delete_post_meta($id, '_aioseop_menulabel');
		
		
		    if ($this->is_admin()) {
		    	delete_post_meta($id, '_aioseop_disable');
		    }
		    //delete_post_meta($id, 'aiosp_meta');

		    if (isset($keywords) && !empty($keywords)) {
			    add_post_meta($id, '_aioseop_keywords', $keywords);
		    }
		    if (isset($description) && !empty($description)) {
			    add_post_meta($id, '_aioseop_description', $description);
		    }
		    if (isset($title) && !empty($title)) {
			    add_post_meta($id, '_aioseop_title', $title);
		    }
		    if (isset($aiosp_titleatr) && !empty($aiosp_titleatr)) {
			    add_post_meta($id, '_aioseop_titleatr', $aiosp_titleatr);
		    }
		    if (isset($aiosp_menulabel) && !empty($aiosp_menulabel)) {
			    add_post_meta($id, '_aioseop_menulabel', $aiosp_menulabel);
		    }				
		    if (isset($aiosp_disable) && !empty($aiosp_disable) && $this->is_admin()) {
			    add_post_meta($id, '_aioseop_disable', $aiosp_disable);
		    }
		    /*
		    if (isset($aiosp_meta) && !empty($aiosp_meta)) {
			    add_post_meta($id, 'aiosp_meta', $aiosp_meta);
		    }
		    */
	    }
	}

	function edit_category($id) {
		global $wpdb;
		$id = $wpdb->escape($id);
	    $awmp_edit = $_POST["aiosp_edit"];
	    if (isset($awmp_edit) && !empty($awmp_edit)) {
		    $keywords = $wpdb->escape($_POST["aiosp_keywords"]);
		    $title = $wpdb->escape($_POST["aiosp_title"]);
		    $old_category = $wpdb->get_row("select * from $this->table_categories where category_id=$id", OBJECT);
		    if ($old_category) {
		    	$wpdb->query($wpdb->prepare("update $this->table_categories
		    			set meta_title='$title', meta_keywords='$keywords'
		    			where category_id=$id"));
		    } else {
		    	$wpdb->query($wpdb->prepare("insert into $this->table_categories(meta_title, meta_keywords, category_id)
		    			values ('$title', '$keywords', $id"));
		    }
		    //$wpdb->query($wpdb->prepare("insert into $this->table_categories"))
	    	/*
		    delete_post_meta($id, 'keywords');
		    delete_post_meta($id, 'description');
		    delete_post_meta($id, 'title');

		    if (isset($keywords) && !empty($keywords)) {
			    add_post_meta($id, 'keywords', $keywords);
		    }
		    if (isset($description) && !empty($description)) {
			    add_post_meta($id, 'description', $description);
		    }
		    if (isset($title) && !empty($title)) {
			    add_post_meta($id, 'title', $title);
		    }
		    */
	    }
	}

	/**
	 * @deprecated This was for the feature of dedicated meta tags for categories which never went mainstream.
	 */
	function edit_category_form() {
	    global $post;
	    $keywords = stripcslashes(get_post_meta($post->ID, '_aioseop_keywords', true));
	    $title = stripcslashes(get_post_meta($post->ID, '_aioseop_title', true));
	    $description = stripcslashes(get_post_meta($post->ID, '_aioseop_description', true));
		?>
		<input value="aiosp_edit" type="hidden" name="aiosp_edit" />
		<table class="editform" width="100%" cellspacing="2" cellpadding="5">
		<tr>
		<th width="33%" scope="row" valign="top">
		<?php _e('tt_theme_framework', 'tt_theme_framework') ?>
		</th>
		</tr>
		<tr>
		<th width="33%" scope="row" valign="top"><label for="aiosp_title"><?php _e('Title:', 'tt_theme_framework') ?></label></th>
		<td><input value="<?php echo $title ?>" type="text" name="aiosp_title" size="70"/></td>
		</tr>
		<tr>
		<th width="33%" scope="row" valign="top"><label for="aiosp_keywords"><?php _e('Keywords (comma separated):', 'tt_theme_framework') ?></label></th>
		<td><input value="<?php echo $keywords ?>" type="text" name="aiosp_keywords" size="70"/></td>
		</tr>
		</table>
		<?php
	}

	function add_meta_tags_textinput() {
	    global $post;
	    $post_id = $post;
	    if (is_object($post_id)) {
	    	$post_id = $post_id->ID;
	    }
	    $keywords = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_keywords', true)));
	    $title = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_title', true)));
	    $description = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_description', true)));
	    $aiosp_meta = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_meta', true)));
	    $aiosp_disable = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_disable', true)));
	    $aiosp_titleatr = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_titleatr', true)));
	    $aiosp_menulabel = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_menulabel', true)));		
	
		?>
		<SCRIPT LANGUAGE="JavaScript">
		<!-- Begin
		function countChars(field,cntfield) {
		cntfield.value = field.value.length;
		}
		//  End -->
		</script>

	 <?php if (substr($this->wp_version, 0, 3) >= '2.5') { ?>
                <div id="postaiosp" class="postbox closed">
                	<h3><?php _e('All in One SEO Pack', 'tt_theme_framework') ?></h3>
                	<div class="inside">
                		<div id="postaiosp">
                <?php } else { ?>
                			<div class="dbx-b-ox-wrapper">
                				<fieldset id="seodiv" class="dbx-box">
                					<div class="dbx-h-andle-wrapper">
                						<h3 class="dbx-handle"><?php _e('All in One SEO Pack', 'tt_theme_framework') ?></h3>
                					</div>
                					<div class="dbx-c-ontent-wrapper">
                						<div class="dbx-content">
                <?php } ?>
	
				<a target="__blank" href="http://semperfiwebdesign.com/portfolio/wordpress/wordpress-plugins/all-in-one-seo-pack/"><?php _e('Click here for Support', 'tt_theme_framework') ?></a>
				<input value="aiosp_edit" type="hidden" name="aiosp_edit" />
				<table style="margin-bottom:40px">
					<tr>
						<th style="text-align:left;" colspan="2">
						</th>
					</tr>
					<tr>
						<th scope="row" style="text-align:right;"><?php _e('Title:', 'tt_theme_framework') ?></th>
						<td><input value="<?php echo $title ?>" type="text" name="aiosp_title" size="62"/></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:right;"><?php _e('Description:', 'tt_theme_framework') ?></th>
						<td><textarea name="aiosp_description" rows="1" cols="60" onKeyDown="countChars(document.post.aiosp_description,document.post.length1)"	onKeyUp="countChars(document.post.aiosp_description,document.post.length1)"><?php echo $description ?>
							</textarea><br />
							<input readonly type="text" name="length1" size="3" maxlength="3" value="<?php echo strlen($description);?>" />
							<?php _e(' characters. Most search engines use a maximum of 160 chars for the description.', 'tt_theme_framework') ?>
						</td>
					</tr>
					<tr>
						<th scope="row" style="text-align:right;"><?php _e('Keywords (comma separated):', 'tt_theme_framework') ?></th>
						<td><input value="<?php echo $keywords ?>" type="text" name="aiosp_keywords" size="62"/></td>
					</tr>
					<input type="hidden" name="nonce-aioseop-edit" value="<?php echo wp_create_nonce('edit-aioseop-nonce'); ?>" />
					<?php if ($this->is_admin()) { ?>
						<tr>
							<th scope="row" style="text-align:right; vertical-align:top;">
								<?php _e('Disable on this page/post:', 'tt_theme_framework')?>
							</th>
							<td>
								<input type="checkbox" name="aiosp_disable" <?php if ($aiosp_disable) echo "checked=\"1\""; ?>/>
							</td>
						</tr>
		
						<tr>
							<th scope="row" style="text-align:right;"><?php _e('Title Attribute:', 'tt_theme_framework') ?></th>
							<td><input value="<?php echo $aiosp_titleatr ?>" type="text" name="aiosp_titleatr" size="62"/></td>
						</tr>
						<tr>
							<th scope="row" style="text-align:right;"><?php _e('Menu Label:', 'tt_theme_framework') ?></th>
							<td><input value="<?php echo $aiosp_menulabel ?>" type="text" name="aiosp_menulabel" size="62"/></td>
						</tr>
							<?php } ?>
						</table>
		
						<?php if (substr($this->wp_version, 0, 3) >= '2.5') { ?>
						</div>
					</div>
				</div>
			<?php } else { ?>
			</div>
		</fieldset>
	</div>
	<?php } ?>

	<?php
	}

	function admin_menu(){
		//mod by tt, change menu slug and menu position from settings to appearance.
		add_theme_page('SEO settings','SEO settings','manage_options','seo_settings', array($this, 'options_panel'));
	}
	
	function management_panel() {
		$message = null;
		$base_url = "edit.php?page=" . __FILE__;
		//echo($base_url);
		$type = $_REQUEST['type'];
		if (!isset($type)) {
			$type = "posts";
		}
?>

	<ul class="aiosp_menu">
		<li><a href="<?php echo $base_url ?>&type=posts">Posts</a>
		</li>
		<li><a href="<?php echo $base_url ?>&type=pages">Pages</a>
		</li>
	</ul>
  
<?php

	if ($type == "posts") {
		echo("posts");
		} elseif ($type == "pages") {
			echo("pages");
		}
	}

	function options_panel() {
		$message = null;
		//$message_updated = __("All in One SEO Options Updated.", 'tt_theme_framework');
		global $aioseop_options;
		
		if(!$aioseop_options['aiosp_cap_cats']) {
			$aioseop_options['aiosp_cap_cats'] = '1';
		}
				

			if (isset($_POST['action']) && $_POST['action'] == 'aiosp_update' && isset($_POST['Submit_Default'])) {
				$nonce = $_POST['nonce-aioseop'];
				if (!wp_verify_nonce($nonce, 'aioseop-nonce')) die ( 'Security Check - If you receive this in error, log out and back in to WordPress');
				$message = __("SEO Settings Reset.", 'tt_theme_framework');
				delete_option('aioseop_options');
				$res_aioseop_options = array(
					"aiosp_can"=>1,
					"aiosp_donate"=>1,
					"aiosp_home_title"=>null,
					"aiosp_home_description"=>'',
					"aiosp_home_keywords"=>null,
					"aiosp_max_words_excerpt"=>'something',
					"aiosp_rewrite_titles"=>1,
					"aiosp_post_title_format"=>'%post_title% | %blog_title%',
					"aiosp_page_title_format"=>'%page_title% | %blog_title%',
					"aiosp_category_title_format"=>'%category_title% | %blog_title%',
					"aiosp_archive_title_format"=>'%date% | %blog_title%',
					"aiosp_tag_title_format"=>'%tag% | %blog_title%',
					"aiosp_search_title_format"=>'%search% | %blog_title%',
					"aiosp_description_format"=>'%description%',
					"aiosp_404_title_format"=>'Nothing found for %request_words%',
					"aiosp_paged_format"=>' - Part %page%',
					"aiosp_use_categories"=>0,
					"aiosp_dynamic_postspage_keywords"=>1,
					"aiosp_category_noindex"=>1,
					"aiosp_archive_noindex"=>1,
					"aiosp_tags_noindex"=>0,
					"aiosp_cap_cats"=>1,
					"aiosp_generate_descriptions"=>1,
					"aiosp_debug_info"=>null,
					"aiosp_post_meta_tags"=>'',
					"aiosp_enablecpost"=>'0',
					"aiosp_page_meta_tags"=>'',
					"aiosp_home_meta_tags"=>'',
					"aiosp_enabled" =>1,
					"aiosp_use_tags_as_keywords" =>1,
					"aiosp_seopostcol" => 1,
					"aiosp_seocustptcol" => 0,
					"aiosp_posttypecolumns" => array('post','page'),
					"aiosp_do_log"=>null);
				update_option('aioseop_options', $res_aioseop_options);
			}

		
		// update options
		if(isset($_POST['action'])&&isset($_POST['Submit'])){
			if ($_POST['action'] && $_POST['action'] == 'aiosp_update' && $_POST['Submit']!='') {
				$nonce = $_POST['nonce-aioseop'];
				if (!wp_verify_nonce($nonce, 'aioseop-nonce')) die ( 'Security Check - If you receive this in error, log out and back in to WordPress');
				$message = __("SEO Settings Updated.", 'tt_theme_framework');

				$aioseop_options['aiosp_can'] = $_POST['aiosp_can'];
				$aioseop_options['aiosp_donate'] = $_POST['aiosp_donate'];
				$aioseop_options['aiosp_home_title'] = esc_attr($_POST['aiosp_home_title']);
				$aioseop_options['aiosp_home_description'] = esc_attr($_POST['aiosp_home_description']);
				$aioseop_options['aiosp_home_keywords'] = $_POST['aiosp_home_keywords'];
				$aioseop_options['aiosp_max_words_excerpt'] = $_POST['aiosp_max_words_excerpt'];
				$aioseop_options['aiosp_rewrite_titles'] = $_POST['aiosp_rewrite_titles'];
				$aioseop_options['aiosp_post_title_format'] = $_POST['aiosp_post_title_format'];
				$aioseop_options['aiosp_page_title_format'] = $_POST['aiosp_page_title_format'];
				$aioseop_options['aiosp_category_title_format'] = $_POST['aiosp_category_title_format'];
				$aioseop_options['aiosp_archive_title_format'] = $_POST['aiosp_archive_title_format'];
				$aioseop_options['aiosp_tag_title_format'] = $_POST['aiosp_tag_title_format'];
				$aioseop_options['aiosp_search_title_format'] = $_POST['aiosp_search_title_format'];
				$aioseop_options['aiosp_description_format'] = $_POST['aiosp_description_format'];
				$aioseop_options['aiosp_404_title_format'] = $_POST['aiosp_404_title_format'];
				$aioseop_options['aiosp_paged_format'] = $_POST['aiosp_paged_format'];
				$aioseop_options['aiosp_use_categories'] = $_POST['aiosp_use_categories'];
				$aioseop_options['aiosp_dynamic_postspage_keywords'] = $_POST['aiosp_dynamic_postspage_keywords'];
				$aioseop_options['aiosp_category_noindex'] = $_POST['aiosp_category_noindex'];
				$aioseop_options['aiosp_archive_noindex'] = $_POST['aiosp_archive_noindex'];
				$aioseop_options['aiosp_tags_noindex'] = $_POST['aiosp_tags_noindex'];
				$aioseop_options['aiosp_generate_descriptions'] = $_POST['aiosp_generate_descriptions'];
				$aioseop_options['aiosp_cap_cats'] = $_POST['aiosp_cap_cats'];
				$aioseop_options['aiosp_enablecpost'] = $_POST['aiosp_enablecpost'];
				$aioseop_options['aiosp_debug_info'] = $_POST['aiosp_debug_info'];
				$aioseop_options['aiosp_post_meta_tags'] = $_POST['aiosp_post_meta_tags'];
				$aioseop_options['aiosp_page_meta_tags'] = $_POST['aiosp_page_meta_tags'];
				$aioseop_options['aiosp_home_meta_tags'] = $_POST['aiosp_home_meta_tags'];
				$aioseop_options['aiosp_ex_pages'] = $_POST['aiosp_ex_pages'];
				$aioseop_options['aiosp_do_log'] = $_POST['aiosp_do_log'];
				$aioseop_options['aiosp_enabled'] = $_POST['aiosp_enabled'];
				$aioseop_options['aiosp_use_tags_as_keywords'] = $_POST['aiosp_use_tags_as_keywords'];		
				$aioseop_options['aiosp_seopostcol'] = $_POST['aiosp_seopostcol'];
				$aioseop_options['aiosp_seocustptcol'] = $_POST['aiosp_seocustptcol'];
				$aioseop_options['aiosp_posttypecolumns'] = $_POST['aiosp_posttypecolumns'];
			
				update_option('aioseop_options', $aioseop_options);
			
				if (function_exists('wp_cache_flush')) {
					wp_cache_flush();
					}
				}
			} /*elseif ($_POST['aiosp_upgrade']) {
			$message = __("Upgraded to newest version. Please revisit the options page to make sure you see the newest version.", 'tt_theme_framework');
			$success = $this->install_newest_version();
			if (!$success) {
				$message = __("Upgrade failed", 'tt_theme_framework');
				if (isset($this->upgrade_error) && !empty($this->upgrade_error)) {
					$message .= ": " . $this->upgrade_error;
				} else {
					$message .= ".";
				}
			}
		}*/

		
?>
<div id="dropmessage" class="updated" style="display:none;"></div>	
<!--deleted one big chunk of advertisements! and some modes to table structure! -->
<div class="wrap">
<!-- Mod by tt - changed setting page title-->
<div style='padding:8px 10px 15px 15px'>	
<div id="icon-options-general" class="icon32"></div>
<h2>SEO Settings</h2>
</div>

<?php
if ($message){
		echo "<div id=\"message\" class=\"updated fade\"style='width:765px!important;margin:10px 0px 0px 0px;'><p>$message</p></div>";
		}
?>

<?php
   If (is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')) {
      echo "<div id=\"message\" class=\"updated fade\"style='width:765px!important;margin:10px 0px 0px 0px;'><p>An SEO plugin is detected. If you choose to use our SEO Module, Please disable any SEO plugin, so as to prevent possible errors.</p></div>";
   }
?> 

<form name="dofollow" action="" method="post">
<table class="widefat" style="width:785px!important;margin:0px 0px 0px 15px;">
<thead>
<tr>
<th width="300px;" colspan="2">
<p><p>
</th>
</tr>
</thead>
<tbody>
<?php 
//get option valuve to populate form!
$aioseop_options = get_option('aioseop_options'); 
?>
<!--
<tr>
<th scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Plugin Status:', 'tt_theme_framework')?>
</a>
</td>
<td>
<input type="radio" name="aiosp_enabled" value="1" <?php if($aioseop_options['aiosp_enabled']) echo "checked"?> > <?php _e('Enabled', 'tt_theme_framework'); ?><br>
<input type="radio" name="aiosp_enabled" value="0" <?php if(!$aioseop_options['aiosp_enabled']) echo "checked"?>> <?php _e('Disabled', 'tt_theme_framework'); ?>
<div style="max-width:500px; text-align:left; display:none" id="aiosp_enabled_tip">
<?php
_e('All in One SEO Pack must be enabled for use.', 'tt_theme_framework');
 ?>
</div>
</td>
</tr>
-->

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Home Title:', 'tt_theme_framework')?>
</td>
<td>
<textarea cols="57" rows="2" name="aiosp_home_title"><?php echo stripcslashes($aioseop_options['aiosp_home_title']); ?></textarea>
<p></p>
<span class="description">
<?php
_e('The &lt;title&gt; of your homepage. This is independent of any other option. If not set, the default blog title will get used.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Home Description:', 'tt_theme_framework')?>
</td>
<td>
<textarea cols="57" rows="2" name="aiosp_home_description"><?php echo stripcslashes($aioseop_options['aiosp_home_description']); ?></textarea>
<p></p>
<span class="description">
<?php
_e('The &lt;meta&gt; description for your homepage. Independent of any other options, the default is no &lt;meta&gt; description at all if this is not set.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Home Keywords (comma separated):', 'tt_theme_framework')?>
</td>
<td>
<textarea cols="57" rows="2" name="aiosp_home_keywords"><?php echo stripcslashes($aioseop_options['aiosp_home_keywords']); ?></textarea>
<p></p>
<span class="description">
<?php
_e("A comma separated list of your most important keywords for your site that will be written as &lt;meta&gt; keywords on your homepage.", 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Canonical URLs:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_can" <?php if ($aioseop_options['aiosp_can']) echo "checked=\"1\""; ?>/>
<p></p>
<span class="description">
<?php
_e("This option will automatically generate Canonical URLS for your entire WordPress installation.  This will help to prevent duplicate content penalties by <a href='http://googlewebmastercentral.blogspot.com/2009/02/specify-your-canonical.html' target='_blank'>Google</a>.", 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Rewrite Titles:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_rewrite_titles" <?php if ($aioseop_options['aiosp_rewrite_titles']) echo "checked=\"1\""; ?>/>
<p></p>
<span class="description">
<?php
_e("This is about the &lt;title&gt; tag within your HTML &lt;head&gt; and not your WordPress Post Title or Page Title. <br/>This is what you see in your browser's window title bar. <br/>This is Not visible on a page, only in the window title bar and in the source. <br/>If set, all page, post, category, search and archive page titles get rewritten. <br/> You can specify the format for most of them.", 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Post Title Format:', 'tt_theme_framework')?>
</td>
<td>
<input size="59" name="aiosp_post_title_format" value="<?php echo stripcslashes($aioseop_options['aiosp_post_title_format']); ?>"/>
<p></p>
<span class="description">
<?php
_e('The following macros are supported:', 'tt_theme_framework');
echo('<ul>');
echo('<li>'); _e('%blog_title% - Your blog title', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%blog_description% - Your blog description', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%post_title% - The original title of the post', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%category_title% - The (main) category of the post', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%category% - Alias for %category_title%', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e("%post_author_login% - This post's author' login", 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e("%post_author_nicename% - This post's author' nicename", 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e("%post_author_firstname% - This post's author' first name (capitalized)", 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e("%post_author_lastname% - This post's author' last name (capitalized)", 'tt_theme_framework'); echo('</li>');
echo('</ul>');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Page Title Format:', 'tt_theme_framework')?>
</td>
<td>
<input size="59" name="aiosp_page_title_format" value="<?php echo stripcslashes($aioseop_options['aiosp_page_title_format']); ?>"/>
<p></p>
<span class="description">
<?php
_e('The following macros are supported:', 'tt_theme_framework');
echo('<ul>');
echo('<li>'); _e('%blog_title% - Your blog title', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%blog_description% - Your blog description', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%page_title% - The original title of the page', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e("%page_author_login% - This page's author' login", 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e("%page_author_nicename% - This page's author' nicename", 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e("%page_author_firstname% - This page's author' first name (capitalized)", 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e("%page_author_lastname% - This page's author' last name (capitalized)", 'tt_theme_framework'); echo('</li>');
echo('</ul>');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Category Title Format:', 'tt_theme_framework')?>
</td>
<td>
<input size="59" name="aiosp_category_title_format" value="<?php echo stripcslashes($aioseop_options['aiosp_category_title_format']); ?>"/>
<p></p>
<span class="description">
<?php
_e('The following macros are supported:', 'tt_theme_framework');
echo('<ul>');
echo('<li>'); _e('%blog_title% - Your blog title', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%blog_description% - Your blog description', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%category_title% - The original title of the category', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%category_description% - The description of the category', 'tt_theme_framework'); echo('</li>');
echo('</ul>');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Archive Title Format:', 'tt_theme_framework')?>
</td>
<td>
<input size="59" name="aiosp_archive_title_format" value="<?php echo stripcslashes($aioseop_options['aiosp_archive_title_format']); ?>"/>
<p></p>
<span class="description">
<?php
_e('The following macros are supported:', 'tt_theme_framework');
echo('<ul>');
echo('<li>'); _e('%blog_title% - Your blog title', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%blog_description% - Your blog description', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%date% - The original archive title given by wordpress, e.g. "2007" or "2007 August"', 'tt_theme_framework'); echo('</li>');
echo('</ul>');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Tag Title Format:', 'tt_theme_framework')?>
</td>
<td>
<input size="59" name="aiosp_tag_title_format" value="<?php echo stripcslashes($aioseop_options['aiosp_tag_title_format']); ?>"/>
<p></p>
<span class="description">
<?php
_e('The following macros are supported:', 'tt_theme_framework');
echo('<ul>');
echo('<li>'); _e('%blog_title% - Your blog title', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%blog_description% - Your blog description', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%tag% - The name of the tag', 'tt_theme_framework'); echo('</li>');
echo('</ul>');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Search Title Format:', 'tt_theme_framework')?>
</td>
<td>
<input size="59" name="aiosp_search_title_format" value="<?php echo stripcslashes($aioseop_options['aiosp_search_title_format']); ?>"/>
<p></p>
<span class="description">
<?php
_e('The following macros are supported:', 'tt_theme_framework');
echo('<ul>');
echo('<li>'); _e('%blog_title% - Your blog title', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%blog_description% - Your blog description', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%search% - What was searched for', 'tt_theme_framework'); echo('</li>');
echo('</ul>');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Description Format:', 'tt_theme_framework')?>
</td>
<td>
<input size="59" name="aiosp_description_format" value="<?php echo stripcslashes($aioseop_options['aiosp_description_format']); ?>"/>
<p></p>
<span class="description">
<?php
_e('The following macros are supported:', 'tt_theme_framework');
echo('<ul>');
echo('<li>'); _e('%blog_title% - Your blog title', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%blog_description% - Your blog description', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%description% - The original description as determined by the plugin, e.g. the excerpt if one is set or an auto-generated one if that option is set', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%wp_title% - The original wordpress title, e.g. post_title for posts', 'tt_theme_framework'); echo('</li>');
echo('</ul>');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('404 Title Format:', 'tt_theme_framework')?>
</td>
<td>
<input size="59" name="aiosp_404_title_format" value="<?php echo stripcslashes($aioseop_options['aiosp_404_title_format']); ?>"/>
<p></p>
<span class="description">
<?php
_e('The following macros are supported:', 'tt_theme_framework');
echo('<ul>');
echo('<li>'); _e('%blog_title% - Your blog title', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%blog_description% - Your blog description', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%request_url% - The original URL path, like "/url-that-does-not-exist/"', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%request_words% - The URL path in human readable form, like "Url That Does Not Exist"', 'tt_theme_framework'); echo('</li>');
echo('<li>'); _e('%404_title% - Additional 404 title input"', 'tt_theme_framework'); echo('</li>');
echo('</ul>');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Paged Format:', 'tt_theme_framework')?>
</td>
<td>
<input size="59" name="aiosp_paged_format" value="<?php echo stripcslashes($aioseop_options['aiosp_paged_format']); ?>"/>
<p></p>
<span  class="description">
<?php
_e('This string gets appended/prepended to titles when they are for paged index pages (like home or archive pages).', 'tt_theme_framework');
_e('The following macros are supported:', 'tt_theme_framework');
echo('<ul>');
echo('<li>'); _e('%page% - The page number', 'tt_theme_framework'); echo('</li>');
echo('</ul>');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('SEO for Custom Post Types:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_enablecpost" <?php if ($aioseop_options['aiosp_enablecpost']) echo "checked=\"1\""; ?>/>
<p></p>
<span class="description">
<?php
_e('Check this if you want your enable AIOSEOP support for Custom Post Types on this site.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>


</tr>
<?php if( function_exists('get_post_types')){		?>
<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Custom Post Types for SEO Column Support:', 'tt_theme_framework')?>
</td>
<td>
<select name="aiosp_posttypecolumns[]" MULTIPLE style="height:70px;width:300px;">
<?php
$typeswehave = array('post,revision'); //$aioseop_options['aiosp_posttypecolumns'];
$post_types=get_post_types('','names'); 
$rempost = array('attachment','revision','nav_menu_item');
$post_types = array_diff($post_types,$rempost);
foreach ($post_types as $post_type ) {
	echo "<option ";
	if(is_array($aioseop_options['aiosp_posttypecolumns']) && in_array($post_type,$aioseop_options['aiosp_posttypecolumns'])) echo "selected ";
	echo "name=\"aiosp_posttypecolumns\">$post_type";
}

?>
</select>
<p></p>
<span class="description">
<?php
_e('Choose which post types you want to have SEO columns on the edit.php screen. You can select as many as you like.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>
<?php } ?>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Use Categories for META keywords:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_use_categories" <?php if ($aioseop_options['aiosp_use_categories']) echo "checked=\"1\""; ?>/>
<p></p>
<span class="description">
<?php
_e('Check this if you want your categories for a given post used as the META keywords for this post (in addition to any keywords and tags you specify on the post edit page).', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Use Tags for META keywords:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_use_tags_as_keywords" <?php if ($aioseop_options['aiosp_use_tags_as_keywords']) echo "checked=\"1\""; ?>/>
<p></p>
<span class="description">
<?php
_e('Check this if you want your tags for a given post used as the META keywords for this post (in addition to any keywords you specify on the post edit page).', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>




<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Dynamically Generate Keywords for Posts Page:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_dynamic_postspage_keywords" <?php if ($aioseop_options['aiosp_dynamic_postspage_keywords']) echo "checked=\"1\""; ?>/>
<p></p>
<span class='description'>
<?php
_e('Check this if you want your keywords on a custom posts page (set it in options->reading) to be dynamically generated from the keywords of the posts showing on that page.  If unchecked, it will use the keywords set in the edit page screen for the posts page.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Use noindex for Categories:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_category_noindex" <?php if ($aioseop_options['aiosp_category_noindex']) echo "checked=\"1\""; ?>/>
<p></p>
<span class="description">
<?php
_e('Check this for excluding category pages from being crawled. Useful for avoiding duplicate content.', 'tt_theme_framework');
 ?>
</div>
</span>
<p></p>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Use noindex for Archives:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_archive_noindex" <?php if ($aioseop_options['aiosp_archive_noindex']) echo "checked=\"1\""; ?>/>
<p></p>
<span class="description">
<?php
_e('Check this for excluding archive pages from being crawled. Useful for avoiding duplicate content.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Use noindex for Tag Archives:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_tags_noindex" <?php if ($aioseop_options['aiosp_tags_noindex']) echo "checked=\"1\""; ?>/>
<p></p>
<span class="description">
<?php
_e('Check this for excluding tag pages from being crawled. Useful for avoiding duplicate content.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Autogenerate Descriptions:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_generate_descriptions" <?php if ($aioseop_options['aiosp_generate_descriptions']) echo "checked=\"1\""; ?>/>
<span class="">
<?php
_e("Check this and your META descriptions will get autogenerated if there's no excerpt.", 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Capitalize Category Titles:', 'tt_theme_framework')?>
</td>
<td>
<input type="checkbox" name="aiosp_cap_cats" <?php if ($aioseop_options['aiosp_cap_cats']) echo "checked=\"1\""; ?>/>
<p></p>
<span class="description">
<?php
_e("Check this and Category Titles will have the first letter of each word capitalized.", 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<!-- new crap start -->
<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Exclude Pages:', 'tt_theme_framework')?>
</td>
<td>
<textarea cols="57" rows="2" name="aiosp_ex_pages"><?php
if(isset($aioseop_options['aiosp_ex_pages'])): echo stripcslashes($aioseop_options['aiosp_ex_pages']); endif;?></textarea>
<p></p>
<span class="description">
<?php
_e("Enter any comma separated pages here to be excluded by SEO Module.  This is helpful when using plugins which generate their own non-WordPress dynamic pages.  Ex: <em>/forum/,/contact/</em>  For instance, if you want to exclude the virtual pages generated by a forum plugin, all you have to do is give forum or /forum or /forum/ or and any URL with the word \"forum\" in it, such as http://mysite.com/forum or http://mysite.com/forum/someforumpage will be excluded from SEO Module.", 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>
<!--  new crap end -->

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Additional Post Headers:', 'tt_theme_framework')?>
</td>
<td>
<textarea cols="57" rows="2" name="aiosp_post_meta_tags"><?php echo stripcslashes($aioseop_options['aiosp_post_meta_tags']); ?></textarea>
<p></p>
<span class="description">
<?php
_e('What you enter here will be copied verbatim to your header on post pages. You can enter whatever additional headers you want here, even references to stylesheets.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Additional Page Headers:', 'tt_theme_framework')?>
</td>
<td>
<textarea cols="57" rows="2" name="aiosp_page_meta_tags"><?php echo stripcslashes($aioseop_options['aiosp_page_meta_tags']); ?></textarea>
<p></p>
<span class="description">
<?php
_e('What you enter here will be copied verbatim to your header on pages. You can enter whatever additional headers you want here, even references to stylesheets.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>

<tr>
<td scope="row" style="text-align:right; vertical-align:top;">
<?php _e('Additional Home Headers:', 'tt_theme_framework')?>
</td>
<td>
<textarea cols="57" rows="2" name="aiosp_home_meta_tags"><?php echo stripcslashes($aioseop_options['aiosp_home_meta_tags']); ?></textarea>
<p></p>
<span class="description">
<?php
_e('What you enter here will be copied verbatim to your header on the home page. You can enter whatever additional headers you want here, even references to stylesheets.', 'tt_theme_framework');
 ?>
</span>
<p></p>
</td>
</tr>


</tbody>
<tfoot><tr><th width="300px"><p></p></th><th></th></tr></tfoot>
</table>

<p class="submit" style="margin:0px 0px 0px 15px">
	<?php if($aioseop_options) {  ?>
	
<input type="hidden" name="action" value="aiosp_update" /> 
<input type="hidden" name="nonce-aioseop" value="<?php echo wp_create_nonce('aioseop-nonce'); ?>" />
<input type="hidden" name="page_options" value="aiosp_home_description" /> 
<input type="submit" class='button-primary' name="Submit" value="<?php _e('Update Settings', 'tt_theme_framework')?>" /> 
<input type="submit" class='button-primary' name="Submit_Default" value="<?php _e('Reset Settings to Defaults', 'tt_theme_framework')?>" /> 
</p>
<?php } ?>
</form>
</div>
<?php
	
	} // options_panel

}

?>