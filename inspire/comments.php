					<a name="comments"></a>

					<div class="post-comments">
						
						<?php 
							echo "<h2>";
							comments_number(__('No comments','loc_inspire'), __('1 Comment','loc_inspire'), '% ' . __('Comments','loc_inspire') );
							echo "</h2>";

							echo "<div class='comments'>";
							
								wp_list_comments(array(
									'avatar_size'	=> 50,
									'max_depth'		=> 5,
									'style'			=> 'ul',
									'callback'		=> 'inspire_comments',
									'type'			=> 'all'
								));

						 	echo "</div>";

							echo "<div id='comments_pagination'>";
								paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;'));
							echo "</div>";

							$custom_comment_field = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';  //label removed for cleaner layout

							comment_form(array(
								'comment_field'			=> $custom_comment_field,
								'comment_notes_after'	=> '',
								'logged_in_as' 			=> '',
								'comment_notes_before' 	=> '',
								'title_reply'			=> __('Leave a reply', 'loc_inspire'),
								'cancel_reply_link'		=> __('Cancel reply', 'loc_inspire'),
								'label_submit'			=> __('Post comment', 'loc_inspire')
							));
						 ?>


					</div> <!-- end comments div -->
