 <?php 

/**************************************
COMMENTS CALLBACK
***************************************/

	function canon_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		
		?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

			<div>
				<!-- META -->
				<h5><?php comment_author_link(); ?></h5> 
				<h6><?php echo mb_localize_datetime(get_comment_date(get_option('date_format') . ' (' . get_option('time_format') .')')); ?></h6>

				<!-- REPLY AND EDIT LINKS -->
				<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'loc_canon'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
				<?php edit_comment_link(__('Edit', 'loc_canon')); ?>

				<!-- THE COMMENT -->
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Comment awaiting approval', 'loc_canon'); ?></em>
					<br />
				<?php endif; ?>

				<?php comment_text(); ?>
			</div>

		</li>

	<?php 
	}

?>
        	                       		

					<!-- ANCHOR TAG -->
					<a name="comments"></a>

						
					<!-- DISPLAY COMMENTS -->
					<?php 
						echo "<h4>";
						comments_number(__('No Replies','loc_canon'), __('1 Reply','loc_canon'), '% ' . __('Replies','loc_canon') );
						printf(" %s \"%s\"",__('to', 'loc_canon'), esc_attr($post->post_title));
						echo "</h4>";

						echo "<ul class='comments'>";
						
							wp_list_comments(array(
								'max_depth'		=> 5,
								'style'			=> 'ul',
								'callback'		=> 'canon_comments',
								'type'			=> 'all'
							));

					 	echo "</ul>";

						echo "<div id='comments_pagination'>";
							paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;'));
						echo "</div>";

						echo "<hr/>";

						$custom_comment_field = '<textarea class="full" placeholder="'.__('Comment', 'loc_canon').'" id="comment" name="comment" cols="20" rows="5" aria-required="true"></textarea>';  //label removed for cleaner layout

						//vars for fields
						$commenter = wp_get_current_commenter();
						$req = get_option( 'require_name_email' );
						$aria_req = ( $req ? " aria-required='true'" : '' );

						comment_form(array(
							'fields' => apply_filters( 'comment_form_default_fields', array(
										'author' => '<div class="clearfix"><input class="third" placeholder="'.__('Name', 'loc_canon').'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />',
										'email' => '<input class="third" placeholder="'.__('Email', 'loc_canon').'" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />',
										'url' => '<input class="third field-last" placeholder="'.__('Website', 'loc_canon').'" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"/></div>' 
									)),
							'comment_field'			=> $custom_comment_field,
							'comment_notes_before' 	=> '',
							'comment_notes_after'	=> '<em class="comment-notes-after right hide-480">' . __('Some html is OK', 'loc_canon') . '</em>',
							'logged_in_as' 			=> '',
							'title_reply'			=> __('Got something to say?', 'loc_canon'),
							'cancel_reply_link'		=> __('Cancel reply', 'loc_canon'),
							'label_submit'			=> __('Send Message', 'loc_canon')
						));
					 ?>