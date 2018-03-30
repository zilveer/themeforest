<?php

function heap_is_all_multibyte($string)
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

function heap_contains_any_multibyte($string)
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
   $char_count = mb_strlen($text);
   $text = ( $char_count > $limit ) ? mb_substr($text,0,$cut_length).heap_option('blog_excerpt_more_text') : $text;
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
        if (mb_strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }
        $totalLength = mb_strlen(strip_tags($ending));
        $openTags = array();
        $truncate = '';

        preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
        foreach ($tags as $tag) {
            if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|blockquote|param/s', $tag[2])) {
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

            $contentLength = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));
            if ($contentLength + $totalLength > $length) {
                $left = $length - $totalLength;
                $entitiesLength = 0;
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
                    foreach ($entities[0] as $entity) {
                        if ($entity[1] + 1 - $entitiesLength <= $left) {
                            $left--;
                            $entitiesLength += mb_strlen($entity[0]);
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
        if (mb_strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = mb_substr($text, 0, $length - mb_strlen($ending));
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


/*
 * COMMENT LAYOUT
 */
function heap_comments($comment, $args, $depth) {
	static $comment_number;

//	if ($depth == 1) {
//		//we need to clean the deeper depths
//		for ($i = 1;$i<10; $i++) {
//			if (isset($comment_number[$i])) {
//				empty($comment_number[$i]);
//			}
//		}
//	}
//
//	if (!isset($comment_number[$depth])) {
//		if ($depth == 1) {
//			$comment_number[$depth] = $args['per_page'] * ($args['page'] - 1) + 1;
//		} else {
//			$comment_number[$depth] = 1;
//		}
//	} else {
//		$comment_number[$depth]++;
//	}

	if (!isset($comment_number))
		$comment_number = $args['per_page'] * ($args['page'] - 1) + 1;
	else
		$comment_number++;

	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
	<article id="comment-<?php $comment->comment_ID; ?>" class="comment-article  media">
		<?php if (heap_option('comments_show_numbering')): ?>
		<span class="comment-number"><?php echo $comment_number ?></span>
		<?php endif; ?>
		<?php if (heap_option('comments_show_avatar') && get_comment_type($comment->comment_ID) == 'comment'): ?>
		<aside class="comment__avatar  media__img">
			<!-- custom gravatar call -->
			<?php
			$bgauthemail = md5( strtolower( trim( get_comment_author_email() ) ) );

			if ( is_ssl() ) {
			$host = 'https://secure.gravatar.com';
			} else {
			$host = sprintf( "http://%d.gravatar.com", ( hexdec( $bgauthemail[0] ) % 2 ) );
			}
			?>
			<img src="<?php echo $host; ?>/avatar/<?php echo $bgauthemail; ?>?s=60" class="comment__avatar-image" height="60" width="60" style="background-image: <?php echo get_template_directory_uri(). '/library/images/nothing.gif'; ?>; background-size: 100% 100%" />
		</aside>
		<?php endif; ?>
		<div class="media__body">
			<header class="comment__meta comment-author">
				<?php printf('<span class="comment__author-name">%s</span>', get_comment_author_link()) ?>
				<time class="comment__time" datetime="<?php comment_time('c'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment__timestamp"><?php printf(__('on %s at %s', 'heap'),get_comment_date(),get_comment_time()); ?> </a></time>
				<div class="comment__links">
					<?php
					edit_comment_link(__('Edit', 'heap'),'  ','');
					comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
					?>
				</div>
			</header><!-- .comment-meta -->
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert info">
					<p><?php _e('Your comment is awaiting moderation.', 'heap') ?></p>
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
	if (heap_option('blog_excerpt_length'))	{
		return absint(heap_option('blog_excerpt_length'));
	} else {
		return 55;
	}
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Replace the [...] wordpress puts in when using the the_excerpt() method.
 */
function new_excerpt_more($excerpt) {
	return heap_option('blog_excerpt_more_text');
}
add_filter('excerpt_more', 'new_excerpt_more');

function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

//fix the canonical url of YOAST because on the front page it ignores the pagination
add_filter( 'wpseo_canonical', 'heap_get_current_canonical_url' );
//fix the canonical url of AIOSEOP because on the front page it breaks the pagination
add_filter( 'aioseop_canonical_url', 'heap_get_current_canonical_url' );

/**
 * Filter the page title so that plugins can unhook this
 *
 */
function heap_wp_title( $title, $sep ) {

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
		$title = "$title $sep " . sprintf( __( 'Page %s', 'heap' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'heap_wp_title', 10, 2 );


function heap_fix_yoast_page_number( $title ) {

	global $paged, $page, $sep;

	if ( is_home() || is_front_page() ) {
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'heap' ), max( $paged, $page ) );
	}
	return $title;
}
//filter the YOAST title so we can correct the page number missing on frontpage
add_filter('wpseo_title', 'heap_fix_yoast_page_number');

//get the first image in a gallery or portfolio
function heap_get_first_gallery_image_src($post_ID,$image_size) {

	$gallery_ids = array();

	if ( !empty($gallery_ids[0]) ) {
		return wp_get_attachment_image_src($gallery_ids[0], $image_size);
	} else {
		return null;
	}
}

//fix the sticky posts logic by preventing them to appear again
function heap_pre_get_posts_sticky_posts( $query ) {

	// Do nothing if not home or not main query.
	if ( ! $query->is_home() || ! $query->is_main_query() ) {
		return;
	}

	$page_on_front = get_option( 'page_on_front' );

	// Do nothing if the blog page is not the front page
	if ( ! empty( $page_on_front ) ) {
		return;
	}

	$sticky = get_option( 'sticky_posts');

	// Do nothing if no sticky posts
	if ( empty($sticky) ) {
		return;
	}

	// We need to respect post ids already in the blacklist of hell
	$post__not_in = $query->get( 'post__not_in' );

	if ( ! empty( $post__not_in ) ) {
		$sticky = array_merge( (array) $post__not_in, $sticky );
		$sticky = array_unique( $sticky );
	}

	$query->set( 'post__not_in', $sticky );

}

add_action( 'pre_get_posts', 'heap_pre_get_posts_sticky_posts');