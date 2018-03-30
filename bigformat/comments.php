<?php // Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename
($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>

<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'framework'); ?></p>
    <?php
		return;
	}
?>
<?php $content = get_the_content(); if($content  != '' && comments_open()) : // if there is content AND Comments are open ?>
<?php comments_number( '', '<div class="divider full commentsdivider"> <h4><span>&nbsp;' .__('One Response', 'framework').'&nbsp;</span></h4></div>', '<div class="divider full commentsdivider"> <h4><span>&nbsp;'.__('% Responses', 'framework') .'&nbsp;</span></h4></div>' ); ?><div class="clear"></div>
<?php endif; ?>
<div id="comments">
<div class="contentwrap pagebg comments-upper">
        <?php if ( have_comments() ) : ?> 
<ol class="listcomments">
    <?php wp_list_comments('type=comment&callback=ag_comment'); ?>
</ol>
<?php if(page_has_comments_nav()) : ?>
<div class="navigation-comments">
    <div class="alignleft">
        <p>
            <?php previous_comments_link() ?>
        </p>
    </div>
    <div class="alignright">
        <p>
            <?php next_comments_link() ?>
        </p>
    </div>
</div>
<?php endif; ?>
<div class="clear"></div>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<?php else : // comments are closed ?>
<?php endif; ?>
<?php endif; ?>

</div>

<?php

/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

if ( comments_open() ) : ?>
<div class="divider full commentsdivider"> <h4><span>&nbsp;<?php _e('Submit a Comment', 'framework'); ?>&nbsp;</span></h4></div><div class="clear"></div>

<div class="pagebg contentwrap">


<?php

$comments_args = array( 'fields' => apply_filters( 'comment_form_default_fields', 
			   array(
					'author' => '<div class="grid_4 alpha">
									 <label for="author">'. __('Name', 'framework') .( $req ? '<span class="required">*</span>' : '' ) . '</label>
									 <input type="text" name="author"  id="author" value="'.$comment_author.'" size="22" tabindex="1"'. ( $req ? 'class="required"' : '' ).'/>
								</div>',
					'email'  => '<div class="grid_4 alpha">
									 <label for="email">'. __('Mail', 'framework') .( $req ? '<span class="required">*</span>' : '' ) . '</label>
									 <input type="text" name="email"  id="email" value="'.$comment_author_email.'" size="22" tabindex="2"'. ( $req ? 'class="required email"' : '' ).'/>
								</div>',
					'url'    => '<label for="url">'. __('Website', 'framework') .( $req ? '<span class="required">*</span>' : '' ) . '</label>
								<input type="text" name="url" id="url" value="'. $comment_author_url .'" size="44" tabindex="3" '. ( $req ? 'class="required"' : '' ).'/>',
					
					)),	
					'comment_field' => '<label for="comment">'.__('Message', 'framework').'<span>*</span></label>'.
										'<textarea name="comment" id="comment" cols="58" rows="8" tabindex="4"'. ( $req ? 'class="required"' : '' ).'></textarea>',
				
								
				'must_log_in' => '',
				'logged_in_as' => '<p>'. __("Logged in as", "framework").' <a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>. <a href="'.get_option('siteurl').'/wp-login.php?action=logout" title="Log out of this account">'.__("Logout.", "framework").' &raquo;</a></p>',
				'id_form' => 'commentsubmit',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'id_submit' => 'submit',
				'title_reply'          => '',
				'title_reply_to'       => '',
				'cancel_reply_link'    => __( 'Cancel reply', 'framework' ),
				'label_submit'         => __( 'Post Comment', 'framework' )
				);
comment_form($comments_args); ?>
</div>
<?php endif; ?>
</div>