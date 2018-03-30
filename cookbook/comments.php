 <?php 

/**************************************
COMMENTS CALLBACK
***************************************/

	function canon_comments_callback ($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		
		?>

		<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>

			<div class="clearfix">

				<!-- AVATAR -->
				<?php 

					if (get_option('show_avatars') === '1' && get_avatar($comment,$args['avatar_size'],'', 'comment-avatar')) {
						echo '<div class="left stay">';
						echo get_avatar($comment,$args['avatar_size'],'', 'comment-avatar');
						echo '</div>';	
					}

				?>
				

				<!-- META -->
				<h6 class="meta">
					<?php comment_author_link(); ?>
					<span><?php echo mb_localize_datetime(get_comment_date(get_option('date_format') . ' (' . get_option('time_format') .')')); ?></span>
				</h6> 

				<!-- REPLY AND EDIT LINKS -->
				<div class="more right">
					<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'loc_canon'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
					<?php edit_comment_link(__('Edit', 'loc_canon')); ?>
				</div>

				<!-- THE COMMENT -->
				<?php if ($comment->comment_approved == '0') { printf('<span class="approval_pending_notice">%s</span>', __('Comment awaiting approval', 'loc_canon')); } ?>

				<?php comment_text(); ?>


			</div>



	<?php 
	}

?>
        	                       		


					<!-- ANCHOR TAG -->
					<a name="comments"></a>

						
					<!-- DISPLAY COMMENTS -->
					<?php 
						echo "<h2>";
						comments_number(__('No Replies','loc_canon'), __('1 Reply','loc_canon'), '% ' . __('Replies','loc_canon') );
						printf(" %s \"%s\"",__('to', 'loc_canon'), esc_attr($post->post_title));
						echo "</h2>";

						echo "<ul class='comments'>";
						
							wp_list_comments(array(
								'avatar_size'	=> 65,
								'max_depth'		=> 5,
								'style'			=> 'ul',
								'callback'		=> 'canon_comments_callback',
								'type'			=> 'all'
							));

					 	echo "</ul>";

						echo "<div id='comments_pagination'>";
						paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;'));
						echo "</div>";

						// COMMENTS FORM
						$custom_comment_field = '<textarea class="full" placeholder="'.__('Comment', 'loc_canon').'" id="comment" name="comment" cols="20" rows="5" aria-required="true"></textarea>';  //label removed for cleaner layout

						//vars for fields
						$commenter = wp_get_current_commenter();
						$req = get_option( 'require_name_email' );
						$aria_req = ( $req ? " aria-required='true'" : '' );

						comment_form(array(
							'fields' => apply_filters( 'comment_form_default_fields', array(
										'author' 	=> sprintf('<div class="clearfix"><div class="col-1-3"><input placeholder="%s" id="author" name="author" type="text" value="%s" %s/></div>'
														, esc_attr(__('Name', 'loc_canon'))
														, esc_attr( $commenter['comment_author'] )
														, esc_attr($aria_req)
													),
										'email' 	=> sprintf('<div class="col-1-3"><input placeholder="%s" id="email" name="email" type="text" value="%s" %s/></div>'
														, esc_attr(__('Email', 'loc_canon'))
														, esc_attr(  $commenter['comment_author_email'] )
														, esc_attr($aria_req)
													),
										'url' 		=> sprintf('<div class="col-1-3 last"><input placeholder="%s" id="url" name="url" type="text" value="%s"/></div></div>'
														, esc_attr(__('Website', 'loc_canon'))
														, esc_attr(  $commenter['comment_author_url'] )
													), 
									)),
							'comment_field'			=> $custom_comment_field,
							'comment_notes_before' 	=> '',
							'comment_notes_after'	=> '<em class="comment-notes-after right hide-480">' . __('Your email address will not be published.', 'loc_canon') . '</em>',
							'logged_in_as' 			=> '',
							'title_reply'			=> __('Leave a reply', 'loc_canon'),
							'cancel_reply_link'		=> __('<em class="fa fa-times"></em> Cancel reply', 'loc_canon'),
							'label_submit'			=> __('Send Message', 'loc_canon')
						));
					 ?>