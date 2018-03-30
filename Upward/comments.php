<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - COMMENTS

		1.1 - Comments title
		1.2 - Comments
		1.3 - Pagination

	2 - COMMENT FORM

		2.1 - Form

*/

	global
		$st_Settings;

		$st_ = array();



		// If comments enabled on theme panel
		if (
			!isset( $st_Settings['post_comments'] ) ||
			is_single() && !empty( $st_Settings['post_comments'] ) && $st_Settings['post_comments'] == 'yes' ||
			is_page() && !empty( $st_Settings['page_comments'] ) && $st_Settings['page_comments'] == 'yes' ) : 



			// If password protected
			if ( post_password_required() ) {

				_e( 'This post is password protected. Enter the password to view any comments.', 'strictthemes' );

				return;

			}



			/*===============================================
			
				C O M M E N T S
				Display comments
			
			===============================================*/

			// If comments exists
			if ( have_comments() ) : 


				$st_['tb'] = array(); // trackbacks

				foreach ( $comments as $comment ) {

					$st_['comment_type'] = get_comment_type();

					if ( $st_['comment_type'] != 'comment' ) {
						$st_['tb'][] = $comment; }

				}

				$st_['total_tb'] = sizeof( $st_['tb'] );

				$st_['comments_number'] = get_comments_number() - $st_['total_tb'];


				/*-------------------------------------------
					1.1 - Comments title
				-------------------------------------------*/

				echo '<div class="comments-title">' . __( 'Comments', 'strictthemes' ) . ': ' . $st_['comments_number'] . '</div>';


				/*-------------------------------------------
					1.2 - Comments
				-------------------------------------------*/

				echo '<ol id="comments">';

						wp_list_comments( array('callback' => 'st_comment' ));

				echo '</ol>';


				/*-------------------------------------------
					1.2 - Pingbacks
				-------------------------------------------*/
	
				if (
					$st_['total_tb'] > 0 && !empty( $st_Settings['pingbacks'] ) && $st_Settings['pingbacks'] == 'yes' ||
					$st_['total_tb'] > 0 && !isset( $st_Settings['pingbacks'] ) ) {
	
					echo '<div class="comments-title pingback-title">' . __( 'Pingbacks', 'strictthemes' ) . ': ' . $st_['total_tb'] . '</div>';
		
					echo '<ol id="pingbacks">';
		
							wp_list_comments( array('callback' => 'st_pingback' ));
		
					echo '</ol>';
	
				}


				/*-------------------------------------------
					1.3 - Pagination
				-------------------------------------------*/

				if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
					<div class="nav-previous"><?php previous_comments_link( __( 'Older comments', 'strictthemes' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer comments', 'strictthemes' ) ); ?></div><?php
				endif;


			// If no comments yet
			else :


				echo '<div class="comments-title-dummy"><!-- --></div>';


			endif;



			/*===============================================
			
				C O M M E N T   F O R M
				Forms for leaving a comments
			
			===============================================*/

			// If comments open
			if ( comments_open() ) :



				if ( get_option('comment_registration') && !is_user_logged_in() ) : 


					echo '<p>' . __( 'You must be logged in to post a comment.', 'strictthemes' ) . ' - <a href="' . wp_login_url( get_permalink() ) . '">' . __( 'Log in', 'strictthemes' ) . '</a></p>';

	
				else :

	
					$st_['comments_args'] = array(
					
						'fields' => apply_filters( 'comment_form_default_fields', array(
					
							'author' => '
								<div class="input-text-box input-text-name">
									<div>
										<input
											type="text"
											name="author"
											id="author"
											value="' . esc_attr( $commenter['comment_author'] ? $commenter['comment_author'] : '' ) . '"
											placeholder="' . __( 'Name', 'strictthemes' ) . '"
											/>
									</div>
								</div>',
					
							'email' => '
								<div class="input-text-box input-text-email">
									<div>
										<input
											type="email"
											name="email"
											id="email"
											value="' . esc_attr( $commenter['comment_author_email'] ? $commenter['comment_author_email'] : '' ) . '"
											placeholder="' . __( 'Email', 'strictthemes' ) . '"
											/>
									</div>
								</div>
								<div class="clear"><!-- --></div>',
					
							'url' => !empty( $st_Settings['website_on_comments'] ) && $st_Settings['website_on_comments'] == 'yes' ? '
								<div class="input-text-box">
									<div>
										<input
											type="url"
											name="url"
											id="url"
											value="' . esc_attr( $commenter['comment_author_url'] ? $commenter['comment_author_url'] : '' ) . '"
											placeholder="' . __( 'Website', 'strictthemes' ) . '"
											/>
									</div>
								</div>' : '',
					
						)),
	
						'comment_notes_before' => '',
					
						'comment_field' => '
							<div class="textarea-box">
								<textarea
									name="comment"
									id="comment"
									cols="100"
									rows="10"
									placeholder="' . __( 'Type here', 'strictthemes' ) . '"></textarea>
								<div class="clear"><!-- --></div>
							</div>',
					
						'comment_notes_after' => '',
					
					);
					
					comment_form( $st_['comments_args'] );


				endif; // if ( get_option('comment_registration')



			endif; // If comments open


	
		endif; // If comments enabled on theme panel



?>