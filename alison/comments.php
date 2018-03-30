<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
	
	<?php if ( comments_open() || have_comments() ) : ?>
		<div class="post-comments" id="comments">
	<?php 
		echo '<div class="box-title-area"><h4 class="title">';
		comments_number(__('No Comment','alison'), __('1 Comment','alison'), '% ' . __('Comments','alison') );
		echo '</h4></div>';

		echo "<div class='comments'>";
		
			wp_list_comments(array(
				'avatar_size'	=> 50,
				'max_depth'		=> 5,
				'style'			=> 'ul',
				'callback'		=> 'gorilla_comments',
				'type'			=> 'all'
			));

		echo "</div>";

		echo "<div id='comments_pagination'>";
			paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;'));
		echo "</div>";

		echo "<div class='commment-form-wrapper' data-required-text='".__('Please fill the required field.', 'alison')."' data-email-check-text='".__('Please enter a valid email address.', 'alison')."'>";
		comment_form(array(
			'logged_in_as' 			=> '',
			'title_reply'			=> __('Leave a Reply', 'alison'),
			'cancel_reply_link'		=> __('Cancel Reply', 'alison'),
			'label_submit'			=> __('Post Comment', 'alison')
		));
		echo "</div>";
	
		?>

		</div>

	<?php endif; ?>
