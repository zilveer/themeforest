<?php
if(!function_exists ('wp_comment_form')){
	function wp_comment_form( $args = array(), $post_id = null ) {
		global $user_identity, $id;

		if ( null === $post_id )
			$post_id = $id;
		else
			$id = $post_id;

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$defaut = array(
			'comment_author'		=>	__('Name*','wpdance'),
			'comment_author_email'	=>	__('Email*','wpdance'),
			'comment_author_url'	=>	__('Website','wpdance')	
		);
		extract($defaut,EXTR_OVERWRITE);
		extract(array_filter(array(
			'comment_author'		=>	esc_attr($commenter['comment_author']),
			'comment_author_email'	=>	esc_attr($commenter['comment_author_email']),
			'comment_author_url'	=>	esc_attr($commenter['comment_author_url'])
		)),EXTR_OVERWRITE);
		
		$fields =  array(
			'author' => '<span class="label">'.__('Your name','wpdance').'</span><p class="comment-form-author">' . '<input id="author" class="input-text" name="author" type="text" value="' .$comment_author. '" data-default="'.$defaut['comment_author'].'" size="30"' . $aria_req . ' />' .
						'</p>',
			'email'  => '<span class="label">'.__('Your email','wpdance').'</span><p class="comment-form-email"><input id="email" class="input-text" name="email" type="text" value="' . $comment_author_email . '" size="30"' . $aria_req . ' data-default="'.$defaut['comment_author_email'].'"/>'.
						'</p>',
			'url'    => '<span class="label">'.__('Website','wpdance').'</span><p class="comment-form-url"><input id="url" class="input-text" name="url" type="text" value="' . $comment_author_url . '" size="30" data-default="'.$defaut['comment_author_url'].'"/>' .
							'</p>',
		);
		
		if( !is_user_logged_in() ){
			$fields['author'] = '<div class="comment-author-wrapper">'.$fields['author'];
			$fields['url'] = $fields['url'].'</div>';
		}

		$required_text = sprintf( ' ' . __('Required fields are marked %s','wpdance'), '<span class="required">*</span>' );
		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<span class="label">'.__('Your message', 'wpdance').'</span><p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.','wpdance' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','wpdance' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Be first to comment','wpdance' ),
			'title_reply_to'       => __( 'Leave a Reply to %s','wpdance'),
			'cancel_reply_link'    => __( 'Cancel reply','wpdance' ),
			'label_submit'         => __( 'Sent','wpdance' ),
			//'label_infomation'	   => __('Please note comments must be approved before they are published','wpdance')
		);
		
		if( !is_user_logged_in() ){
			$defaults['comment_field'] = '<div class="comment-message-wrapper">'.$defaults['comment_field'].'</div>';
		}

		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

		?>
			<?php if ( comments_open() ) : ?>
				<?php do_action( 'comment_form_before' ); ?>
				<div id="respond">
					<div class="wd_title_respond"><h3 id="reply-title" class="heading-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3></div>
					
					<!--<p class="info"><?php //echo esc_attr( $args['label_infomation'] ); ?></p>-->
					
					<?php  ?>
					<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
						<?php echo $args['must_log_in']; ?>
						<?php do_action( 'comment_form_must_log_in_after' ); ?>
					<?php else : ?>
						<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
							<?php do_action( 'comment_form_top' ); ?>
							<?php if ( is_user_logged_in() ) : ?>
								<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
								<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
							<?php else : ?>
								<?php echo $args['comment_notes_before']; ?>
								<?php
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								
								?>
							<?php endif; ?>
							<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
							<?php echo $args['comment_notes_after']; ?>
							<?php if ( !is_user_logged_in() ) do_action( 'comment_form_after_fields' );?>
							<p class="form-submit">
								<button class="button" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>"><span><span><?php echo esc_attr( $args['label_submit'] ); ?></span></span></button>

								<?php comment_id_fields( $post_id ); ?>
							</p>
							<?php do_action( 'comment_form', $post_id ); ?>
						</form>
					<?php endif; ?>
				</div><!-- #respond -->
				<?php do_action( 'comment_form_after' ); ?>
				<script type="text/javascript">
				//<![CDATA[
					jQuery('#commentform').find('input').focus(function() {
						if(jQuery(this).val() == jQuery(this).attr('data-default'))
							jQuery(this).val('');
					}).blur(function() {
						if(jQuery(this).val() == '')
							jQuery(this).val(jQuery(this).attr('data-default'));
					});
					jQuery('#commentform').submit(function() {
						jQuery(this).find('input').each(function(input){
							if(jQuery(this).val() == jQuery(this).attr('data-default'))
								jQuery(this).val('');
						});	
						return true;
					});
				//]]>	
				</script>
			<?php else : ?>
				<?php do_action( 'comment_form_comments_closed' ); ?>
			<?php endif; ?>
		<?php
	}
}
?>