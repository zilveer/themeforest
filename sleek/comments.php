<!-- Comments -->
<?php if( have_comments() ): ?>

	<div class="comment__list">

		<h2 id="comments">
			<?php comments_number( __( '0 Comments', 'sleek' ), __( '1 Comment', 'sleek' ), __( '% Comments', 'sleek' ) ); ?>
		</h2>

		<ul class="comments">
			<?php
				$theme_settings = sleek_theme_settings();

				if( $theme_settings->advanced['display_pingbacks'] ){
					wp_list_comments('type=all&callback=sleek_comments');
				}else{
					wp_list_comments('type=comment&callback=sleek_comments');
				}
			?>
		</ul>

		<div class="comment__pager">
			<?php
				//paginate_comments_links();

				if( get_option('default_comments_page') == 'oldest' ){
					next_comments_link( __('Load More', 'sleek'), $wp_query->max_num_comment_pages );
				}else{
					previous_comments_link( __('Load More', 'sleek'), $wp_query->max_num_comment_pages );
				}
			?>

		</div>

	</div>

<?php endif; ?>



<!-- Comment Form -->
<?php

$commenter 	= wp_get_current_commenter();
$req 		= get_option( 'require_name_email' );
$aria_req 	= ( $req ? " aria-required='true'" : '' );


$comments_args = array(
	'label_submit'	=> __('Post comment', 'sleek'),
	'title_reply'	=> __('Leave A Comment', 'sleek'),
	'comment_notes_after' => '',
	//'comment_notes_after' => '<description>'.__('Your email address will not be published. Required fields are marked with', 'sleek').'<span class="required">*</span></description>',
	'comment_notes_before' => '',
	'fields' => apply_filters( 'comment_form_default_fields',
		array(
			'author' =>
				'<div class="form__item form__item--author"><input id="author" name="author" class="' . ($req ? 'required' : '') . '" type="text" placeholder="' . __('Name', 'sleek') . ($req ? ' *' : '') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></div>'
			,
			'email' =>
				'<div class="form__item form__item--email"><input id="email" name="email" type="text" class="' . ($req ? 'required' : '') . '" placeholder="' . __('Email', 'sleek') . ($req ? ' *' : '') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></div>'
			,
			'url' =>
					'<div class="form__item form__item--url"><input id="url" name="url" type="text" placeholder="' . __('Website', 'sleek').'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div>'
		)
 	),
 	'comment_field' =>
 		'<div class="form__item form__item--comment"><textarea id="comment" class="required" name="comment" aria-required="true" placeholder="'.__('Comment', 'sleek').' *" ></textarea></div>',
);

comment_form($comments_args);

?>
