<?php
/**
 * Created by Clapat
 * Date: 29/05/14
 * Time: 6:34 AM
 */

// pagination
if( !function_exists('clapat_bg_pagination') ){

    function clapat_bg_pagination( $current_query = null ){

        // pages represent the total number of pages
        global $wp_query;
        if( $current_query == null )
            $current_query = $wp_query;
			
		$pages = ($current_query->max_num_pages) ? $current_query->max_num_pages : 1;

		if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
		elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
		else { $paged = 1; }
		
        if( $pages > 1 )
        {
            echo '<!-- Blog Navigation -->';
			echo '<ul class="blog-nav">';
            			
			if ( get_previous_posts_link() ){
				echo '<li class="prev-posts">';
                previous_posts_link( __('Newer Posts', THEME_LANGUAGE_DOMAIN) );
				echo '</li>';
            }

         	if( get_next_posts_link( '', $current_query->max_num_pages ) ) {
				echo '<li class="next-posts">';
                next_posts_link( __('Older Posts', THEME_LANGUAGE_DOMAIN), $current_query->max_num_pages );
				echo '</li>';
            }
		
			echo '</ul>';
            echo '<!-- /Blog Navigation -->';
        }
    }

} // pagination function


// comments
if( !function_exists('clapat_bg_comment') ){

    function clapat_bg_comment($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;
        $add_below = '';
		if( $depth > 1 ){ //reply comment
			echo '<div class="user_comment_reply" ';
		}
		else{ //top comment
			echo '<div class="user_comment" ';
		}
        comment_class();
        echo ' id="div-comment-';
        comment_ID();
        echo '">';
        echo '<div class="user-image">'. get_avatar($comment, 54) . '</div>';
        echo '<h6 class="comment-name">'. get_comment_author_link() . ' ' . __('says:', THEME_LANGUAGE_DOMAIN) . '</h6>';
        echo '<p class="comment-date">' . get_comment_date() . ' ' . __('at', THEME_LANGUAGE_DOMAIN ) . ' ' . get_comment_time() . '</p>';

        echo '<div class="comment-text">';
        if ($comment->comment_approved == '0'){
            echo '<em>' . __("Your comment is awaiting moderation", THEME_LANGUAGE_DOMAIN) . '</em><br />';
        }
        comment_text();
        echo '</div>';

        comment_reply_link(array_merge( $args, array('reply_text' => '&nbsp;' . __('Reply', THEME_LANGUAGE_DOMAIN), 'before' => '', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));

    }
}


?>