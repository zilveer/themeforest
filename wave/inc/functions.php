<?php
/**
 * Functions used in the theme.
 */

if ( ! function_exists( 'dd_theme_pagination' ) ) :

	/**
	 * Template for pagination
	 *
	 * Used everywhere where there is pagination (template-blog.php, archives.php, search.php...)
	 */
	
	function dd_theme_pagination( $pages = '', $range = 2 ) {
		 
		 $showitems = ($range * 2)+1;  

		global $paged;
		if ( empty ( $paged ) ) $paged = 1;

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

						if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='button' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
						if($paged > 1 && $showitems < $pages) echo "<li><a class='button' href='".get_pagenum_link($paged - 1)."' >&lsaquo;</a></li>";

						for ($i=1; $i <= $pages; $i++){
							if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)){
							echo ($paged == $i)? "<li class='current'><a class='button' href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>":"<li><a class='button' href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
							}
						}

						if ($paged < $pages && $showitems < $pages) echo "<li><a class='button' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
						if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a class='button' href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
						
					?>
				</ul>
			</div><!-- #pagination --><?php
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

			if( is_wp_error( $response ) ) 
				return;

			$xml = wp_remote_retrieve_body( $response );

			if( is_wp_error( $xml ) )
				return;

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
				if( $i == $shots )
					break;

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