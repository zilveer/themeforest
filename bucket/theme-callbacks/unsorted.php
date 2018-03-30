<?php
function wpgrade_is_all_multibyte($string)
{
	if (function_exists('mb_check_encoding')) {
		// check if the string doesn't contain invalid byte sequence
		if (mb_check_encoding($string, 'UTF-8') === false) return false;

		$length = mb_strlen($string, 'UTF-8');

		for ($i = 0; $i < $length; $i += 1) {
			$char = mb_substr($string, $i, 1, 'UTF-8');

			// check if the string doesn't contain single character
			if (mb_check_encoding($char, 'ASCII')) {
				return false;
			}
		}

		return true;
	} else {
    	return false;
    }

}

function wpgrade_contains_any_multibyte($string)
{
	if (function_exists('mb_check_encoding')) {
    	return !mb_check_encoding($string, 'ASCII') && mb_check_encoding($string, 'UTF-8');
    } else {
    	return false;
    }
}

/**
* Cutting the titles and adding '...' after
* @param  [string] $text       [description]
* @param  [int] $cut_length [description]
* @param  [int] $limit      [description]
* @return [type]             [description]
*/
function short_text($text, $cut_length, $limit, $echo = true){
   $char_count = mb_strlen($text,'UTF-8');
   $text = ( $char_count > $limit ) ? mb_substr($text,0,$cut_length).wpgrade::option('blog_excerpt_more_text') : $text;
   if ($echo) {
	   echo $text;
   } else {
	   return $text;
   }
}

/**
* Borrowed from CakePHP
*
* Truncates text.
*
* Cuts a string to the length of $length and replaces the last characters
* with the ending if the text is longer than length.
*
* ### Options:
*
* - `ending` Will be used as Ending and appended to the trimmed string
* - `exact` If false, $text will not be cut mid-word
* - `html` If true, HTML tags would be handled correctly
*
* @param string  $text String to truncate.
* @param integer $length Length of returned string, including ellipsis.
* @param array $options An array of html attributes and options.
* @return string Trimmed string.
* @access public
* @link http://book.cakephp.org/view/1469/Text#truncate-1625
*/

function truncate($text, $length = 100, $options = array()) {
    $default = array(
        'ending' => '...', 'exact' => true, 'html' => false
    );
    $options = array_merge($default, $options);
    extract($options);

    if ($html) {
        if (mb_strlen(preg_replace('/<.*?>/', '', $text),'UTF-8') <= $length) {
            return $text;
        }
        $totalLength = mb_strlen(strip_tags($ending),'UTF-8');
        $openTags = array();
        $truncate = '';

        preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
        foreach ($tags as $tag) {
            if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])) {
                if (preg_match('/<[\w]+[^>]*>/s', $tag[0])) {
                    array_unshift($openTags, $tag[2]);
                } else if (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
                    $pos = array_search($closeTag[1], $openTags);
                    if ($pos !== false) {
                        array_splice($openTags, $pos, 1);
                    }
                }
            }
            $truncate .= $tag[1];

            $contentLength = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]),'UTF-8');
            if ($contentLength + $totalLength > $length) {
                $left = $length - $totalLength;
                $entitiesLength = 0;
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
                    foreach ($entities[0] as $entity) {
                        if ($entity[1] + 1 - $entitiesLength <= $left) {
                            $left--;
                            $entitiesLength += mb_strlen($entity[0],'UTF-8');
                        } else {
                            break;
                        }
                    }
                }

                $truncate .= mb_substr($tag[3], 0 , $left + $entitiesLength);
                break;
            } else {
                $truncate .= $tag[3];
                $totalLength += $contentLength;
            }
            if ($totalLength >= $length) {
                break;
            }
        }
    } else {
        if (mb_strlen($text,'UTF-8') <= $length) {
            return $text;
        } else {
            $truncate = mb_substr($text, 0, $length - mb_strlen($ending,'UTF-8'));
        }
    }
    if (!$exact) {
        $spacepos = mb_strrpos($truncate, ' ');
        if (isset($spacepos)) {
            if ($html) {
                $bits = mb_substr($truncate, $spacepos);
                preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
                if (!empty($droppedTags)) {
                    foreach ($droppedTags as $closingTag) {
                        if (!in_array($closingTag[1], $openTags)) {
                            array_unshift($openTags, $closingTag[1]);
                        }
                    }
                }
            }
            $truncate = mb_substr($truncate, 0, $spacepos);
        }
    }
    $truncate .= $ending;

    if ($html) {
        foreach ($openTags as $tag) {
            $truncate .= '</'.$tag.'>';
        }
    }

    return $truncate;
}

//@todo CLEANUP refactor function
function wpgrade_better_excerpt($text = '') {
	global $post;
	$raw_excerpt = '';

	//if the post has a manual excerpt ignore the content given
	if ($text == '' && function_exists('has_excerpt') && has_excerpt()) {
		$text = get_the_excerpt();
		$raw_excerpt = $text;

		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);

		// Removes any JavaScript in posts (between <script> and </script> tags)
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);

		// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
		$allowed_tags = '<p><a><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol>';
		$text = strip_tags($text, $allowed_tags);
//		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
//		$text .= $excerpt_more;

	} else {

		if (empty($text)) {
			//need to grab the content
			$text = get_the_content();
		}

		$raw_excerpt = $text;
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);

		// Removes any JavaScript in posts (between <script> and </script> tags)
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);

		// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
		//$allowed_tags = '<p><a><em><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol>';
		$text = strip_tags($text, '');

		// Set custom excerpt length - number of words to be shown in excerpts
		if (wpgrade::option('blog_excerpt_length'))	{
			$excerpt_length = absint(wpgrade::option('blog_excerpt_length'));
		} else {
			$excerpt_length = 180;
		}

		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');

		//test if we are dealing with a utf8 text - like chinese
		if (wpgrade_is_all_multibyte($text)) {
			//then we simply split my mb characters rather than words
			$text = short_text($text,$excerpt_length,$excerpt_length);
		} else {
//			$options = array(
//				'ending' => $excerpt_more, 'exact' => false, 'html' => true
//			);
//			$text = truncate($text, $excerpt_length, $options);

			$words = preg_split("/[\n\r\t\s]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);

			//some further testing to ensure that we catch the mb languages like chinese
			//test for extra long average word length - means that each sentence is enterpreted as a word
			$temp_words = $words;
			if (count($temp_words) > 1) {
				array_pop($temp_words);
			}

			//we have taken a large average word length - 20
			if (count($temp_words) > 0 && mb_strlen(implode(' ', $temp_words),'UTF-8')/count($temp_words) > 20) {
				//we have a mb language
				//then we simply split my mb characters rather than words
				$text = short_text($text,$excerpt_length,$excerpt_length);
			} else {

				if ( count($words) > $excerpt_length ) {
					array_pop($words);
					$text = implode(' ', $words);
					//$text = force_balance_tags( $text );
					$text = $text . $excerpt_more;
				} else {
					$text = implode(' ', $words);
				}

			}

		}
	}

	// IMPORTANT! Prevents tags cutoff by excerpt (i.e. unclosed tags) from breaking formatting
	$text = force_balance_tags( $text );

	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

/*
 * COMMENT LAYOUT
 */
function wpgrade_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
	<article id="comment-<?php comment_ID(); ?>" class="comment-article  media">
		<aside class="comment__avatar  media__img">
			<img src="<?php echo util::get_avatar_url($comment->comment_author_email, '60') ?>" class="comment__avatar-image" height="60" width="60" style="background-image: <?php echo get_template_directory_uri(). '/library/images/nothing.gif'; ?>; background-size: 100% 100%" />
		</aside>
		<div class="media__body">
			<header class="comment__meta comment-author">
				<?php printf('<cite class="comment__author-name">%s</cite>', get_comment_author_link()) ?>
				<time class="comment__time" datetime="<?php comment_time('c'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment__timestamp">on <?php comment_time(__('j F, Y \a\t H:i', 'bucket')); ?> </a></time>
				<div class="comment__links">
					<?php
					edit_comment_link(__('Edit', 'bucket'),'  ','');
					comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
					?>
				</div>
			</header><!-- .comment-meta -->
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert info">
					<p><?php _e('Your comment is awaiting moderation.', 'bucket') ?></p>
				</div>
			<?php endif; ?>
			<section class="comment__content comment">
				<?php comment_text() ?>
			</section>
		</div>
	</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

function custom_excerpt_length( $length ) {
	// Set custom excerpt length - number of words to be shown in excerpts
	if (wpgrade::option('blog_excerpt_length'))	{
		return absint(wpgrade::option('blog_excerpt_length'));
	} else {
		return 55;
	}
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Replace the [...] wordpress puts in when using the the_excerpt() method.
 */
function new_excerpt_more($excerpt) {
	return wpgrade::option('blog_excerpt_more_text');
}
add_filter('excerpt_more', 'new_excerpt_more');

function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );


/** Add New Field To Category **/
function extra_category_fields( $tag ) {
	if (isset($tag->term_id)) {
		$t_id = $tag->term_id;
		$cat_meta = get_option( "category_$t_id" );
	} else {
		$cat_meta = array();
	}
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="meta-color"><?php _e('Category Custom Accent Color', 'bucket'); ?></label></th>
		<td>
			<div id="colorpicker">
				<input type="text" name="cat_meta[cat_custom_accent]" class="colorpicker" size="3" style="width:20%;" value="<?php echo (isset($cat_meta['cat_custom_accent'])) ? $cat_meta['cat_custom_accent'] : wpgrade::option('main_color'); ?>" />
			</div>
			<br />
			<span class="description"><?php _e('Set here a custom accent color for this category. We will change the main accent color with this one in the category archives and posts in that category. <b>Note:</b> You must apply the custom CSS <b>Inline</b> for this to work (Theme Options > Custom Code).', 'bucket'); ?></span>
			<br />
		</td>
	</tr>
<?php
}
add_action ( 'category_add_form_fields', 'extra_category_fields');
add_action('category_edit_form_fields','extra_category_fields');

/** Save Category Meta **/
function save_extra_category_fields( $term_id ) {

	if ( isset( $_POST['cat_meta'] ) ) {
		$t_id = $term_id;
		$cat_meta = get_option( "category_$t_id");
		$cat_keys = array_keys($_POST['cat_meta']);
		foreach ($cat_keys as $key){
			if (isset($_POST['cat_meta'][$key])){
				$cat_meta[$key] = $_POST['cat_meta'][$key];
			}
		}
		//save the option array
		update_option( "category_$t_id", $cat_meta );
	}
}
add_action ( 'edited_category', 'save_extra_category_fields');

function get_category_color($cat_id) {
	$cat_data = get_option("category_$cat_id");

	if (!empty($cat_data['cat_custom_accent']) && ($cat_data['cat_custom_accent'] != wpgrade::option('main_color'))) {
		return $cat_data['cat_custom_accent'];
	} else {
		return false;
	}
}

/** Enqueue Color Picker **/
function colorpicker_enqueue() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'colorpicker-js', wpgrade::resourceuri('js/admin/color-picker.js'), array( 'wp-color-picker' ) );
}
add_action( 'admin_enqueue_scripts', 'colorpicker_enqueue' );

/**
 * Filter the page title so that plugins can unhook this
 *
 */
function wpgrade_wp_title( $title, $sep ) {

	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'bucket' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wpgrade_wp_title', 10, 2 );


function wpgrade_fix_yoast_page_number( $title ) {

	global $paged, $page, $sep;

	if ( is_home() || is_front_page() ) {
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'bucket' ), max( $paged, $page ) );
	}
	return $title;
}
//filter the YOAST title so we can correct the page number missing on frontpage
add_filter('wpseo_title', 'wpgrade_fix_yoast_page_number');