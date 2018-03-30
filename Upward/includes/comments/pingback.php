<?php if ( !defined( 'ABSPATH' ) ) exit;

	if ( !function_exists( 'st_pingback' ) ) {
	
		function st_pingback( $comment, $args, $depth ) {
	
			$GLOBALS['comment'] = $comment;
	
			switch ( $comment->comment_type ) :

				case 'pingback' :
		
					global
						$st_Settings ?>

						<li id="comment-<?php comment_ID(); ?>" class="pingback">
	
							<?php
					

								$out = '<div class="pingback-holder">';
	
	
									$out .= '<div class="pingback-box">';
	
	
										// Title
										$out .= '<div class="pingback-author" id="author-' . get_comment_ID() . '">' . get_comment_author_link();

											// Edit link
											if ( current_user_can('manage_options') ) {
												$out .= ' - <a href="' . get_edit_comment_link() . '"><small>' . __( 'Edit', 'strictthemes' ) . '</small></a>'; }

										$out .= '</div>';

					
										// Date
										$out .= '<div class="pingback-date">';
	
											if ( !empty( $st_Settings['nice_time'] ) && $st_Settings['nice_time'] == 'yes' && function_exists( 'st_niceTime' ) ) {
												$out .= st_niceTime( get_comment_date( 'c', get_comment_ID() ) );
											}
											else {
												$out .= get_comment_date() . ' ' . __( 'at', 'strictthemes' ) . ' ' . get_comment_time();
											}
	
										$out .= '</div>';
			
			
	
	
								$out .= '</div>';
	
	
								$out .= '<div class="clear"><!-- --></div>';
	
	
								echo $out;


				break;
		
			endswitch;
		
		}
	
	}

?>