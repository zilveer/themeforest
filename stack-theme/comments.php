<section id="comments">
<div class="vspace-40"></div>
	
<?php if ( have_comments() ) : ?>
	<div class="stack-title"><?php
	printf( _n( 'One Response', '%1$s Responses', get_comments_number(), 'theme_front' ),
	number_format_i18n( get_comments_number() ) );
	?><span class="spot"></span></div>

	<ul class="comment-list">
		<?php wp_list_comments( array( 'callback' => 'theme_comments', 'max_depth' => 2, '' ) ); ?>
	</ul>
	<div class="clear"></div>

	<?php 
		$paginate_comment = paginate_comments_links( array('prev_text' => '', 'next_text' => '', 'echo' => false) ); 
		if( $paginate_comment ) {
			echo '<div class="page-link">'.__('Comment Page:', 'theme_front').$paginate_comment.'</div><div class="clear"></div>';
		}	
	?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>
	
	<?php 
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		
		$comment_fields =  array(
			'author' => '<div class="input-wrap"><input id="author" class="input-text '. ( $req ? '{required:true}' : '' ) .'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="'. __( 'Name', 'theme_front' ) . ( $req ? ' *' : '' ) .'" /></div>',
			
			'email' => '<div class="input-wrap"><input id="email" class="input-text '. ( $req ? '{required:true, email:true}' : '{email:true}' ) .'" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="'. __( 'Email', 'theme_front' ) . ( $req ? ' *' : '' ) . '" /></div>',
			
			'url' => '<div class="input-wrap"><input id="email" class="input-text" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'. __( 'Website', 'theme_front' ) .'" /></div>',
		);
	
		$comments_args = array(
		        // change the title of send button 
		        'fields'				=> $comment_fields,
		        'comment_notes_after'	=> '',
		        'id_submit'				=> 'comment-submit',
		        'comment_field'			=> '<div class="input-wrap"><textarea class="textarea {required:true}" name="comment" id="comment-comment" cols="70" rows="10" placeholder="'.__('Message *', 'theme_front').'"></textarea></div><div class="input-wrap"><div class="form-response"></div></div>'
		);

		comment_form($comments_args);
	
	?>

<?php endif; ?>

</section><!-- #comments -->

<?php
function theme_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
			<div class="comment-meta">
				<div class="gravatar"><?php echo get_avatar($comment,$size='160', $default=''); ?></div>
				<div class="comment-author-name"><?php echo get_comment_author_link(); ?></div>
				<div class="comment-date"><?php echo get_comment_date('M j, Y'); ?></div>
			</div>
			<div class='comment-content'>

				<div class='comment-text'>
					<?php comment_text() ?>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="box-wrap notice-box"><div class="box"><?php _e('Your comment is awaiting moderation.','theme_front') ?></div></div>
				<?php endif; ?>
				</div>

				<div class="comment-meta-compact">
					<span class="comment-author-name"><?php echo get_comment_author_link(); ?></span> 
					<span class="comment-date"><?php echo get_comment_date('M j, Y'); ?></span>
				</div>
				
				<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( __('Edit', 'theme_front' ) ) ?>

				<div class="clear"></div>
			</div>
		</div>
	</li>
<?php
}



?>