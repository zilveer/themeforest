<?php if ( !defined( 'ABSPATH' ) ) exit;

	if ( !function_exists( 'st_comment' ) ) {
	
		function st_comment( $comment, $args, $depth ) {
	
			$GLOBALS['comment'] = $comment;
	
			switch ( $comment->comment_type ) :

				case 'comment' :
		
					global
						$st_Settings ?>

						<li id="comment-<?php comment_ID(); ?>" class="comment">
	
							<?php
					
								$avatar_size = '0' != $comment->comment_parent ? 50 : 75;
								$comment_level = '0' == $comment->comment_parent ? ' class="comment-holder comment-top-level"' : ' class="comment-holder comment-low-level"';
	
	
								$out = '<div' . $comment_level . '>';
	
	
									// Gravatar
									$out .= '<div class="avatar-box">' . get_avatar( $comment, $avatar_size ) . '</div>';
	
					
									$out .= '<div class="comment-box">';
	

										// Author name
										$out .= '<div class="comment-author" id="author-' . get_comment_ID() . '">' . get_comment_author_link() . '</div>';
	
					
										// Date
										$out .= '<div class="comment-date">';
	
											if ( !empty( $st_Settings['nice_time'] ) && $st_Settings['nice_time'] == 'yes' && function_exists( 'st_niceTime' ) ) {
												$out .= st_niceTime( get_comment_date( 'c', get_comment_ID() ) );
											}
											else {
												$out .= get_comment_date() . ' ' . __( 'at', 'strictthemes' ) . ' ' . get_comment_time();
											}
	
										$out .= '</div>';
	
	
										// Comment
										$out .= wpautop( get_comment_text() );
	
	
										if ( comments_open() ) {
			
											// Reply/Cancel links
											$out .=
												'<span class="reply non-selectable">' .
			
													'<a title="' . get_comment_ID() . '" class="quick-reply" href="' . get_permalink() . '?replytocom=' . get_comment_ID() . '#respond">' . __( 'Reply', 'strictthemes' ) . '</a>' .

													'<a class="quick-reply-cancel none" href="#">' . __( 'Cancel', 'strictthemes' ) . '</a>' .
			
												'</span>';
			
										}
			
			
										// Edit link
										if ( current_user_can('manage_options') ) {
											$out .= ' - <a href="' . get_edit_comment_link() . '">' . __( 'Edit', 'strictthemes' ) . '</a>'; }
			
			
										// Pre-moderation
										if ( $comment->comment_approved == '0' ) {
											$out .= '<p><em class="comment-awaiting-moderation">' . __( 'Your comment is awaiting moderation.', 'strictthemes' ) . '</em></p>'; }
	
	
									$out .= '<div class="quick-holder" id="quick-holder-' . get_comment_ID() . '"></div></div><div class="clear"><!-- --></div>'; // .comment-box
	
	
								$out .= '</div>'; // .$comment_level
	
	
								$out .= '<div class="clear"><!-- --></div>';
	
	
								echo $out;


				break;
		
			endswitch;
		
		}
	
	}

?>