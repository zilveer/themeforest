<?php
	if ( post_password_required() ) { ?>
		<h4><?php _e('This post is password protected. Enter the password to view comments.', THEME_LANGUAGE_DOMAIN); ?></h4>
	<?php
		return;
	}
        
?>



	
<!--Blog Comments-->
<div id="comments" class="post-comments clearfix">

<h4><?php comments_number(__('No Comments', THEME_LANGUAGE_DOMAIN), __('One Comment', THEME_LANGUAGE_DOMAIN), __('% Comments', THEME_LANGUAGE_DOMAIN));?></h4>
        
<?php if ( have_comments() ) { ?>

    <div class="comments-navigation">
		<div class="alignleft"><?php previous_comments_link(); ?></div>
	    <div class="alignright"><?php next_comments_link(); ?></div>
	</div>

	<?php wp_list_comments('callback=clapat_bg_comment&style=div'); ?>
			
	<div class="comments-navigation">
	    <div class="alignleft"><?php previous_comments_link(); ?></div>
	    <div class="alignright"><?php next_comments_link(); ?></div>
	</div>

<?php } // if have comments ?>

</div>
<!--Blog Comments-->




<?php if ( comments_open() ) { ?>

<!-- Comment form -->
<div class="post_formular">


<?php  

        $class_message_area = '';
        if( is_user_logged_in() ){

            $class_message_area = 'comment_area_loggedin';
        }

        $comment_id = "comment";
                            
        $args = array(
                        'id_form'           => 'commentsform',
                        'id_submit'         => 'submit',
                        'title_reply'       => __( '<h4>Leave a comment</h4>', THEME_LANGUAGE_DOMAIN ),
                        'title_reply_to'    => __( '<h4>Leave a comment to %s </h4>', THEME_LANGUAGE_DOMAIN ),
                        'cancel_reply_link' => __( '<h6>Cancel Reply</h6>', THEME_LANGUAGE_DOMAIN ),
                        'label_submit'      => __( 'Post Comment', THEME_LANGUAGE_DOMAIN ),

                        'comment_field' =>  '<div class="one_half last ' . $class_message_area . '"><textarea id="' . $comment_id . '" name="comment" cols="40" rows="3" onfocus="if(this.value == \'Comment...\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'Comment...\'; }" >Comment...</textarea></div>',

                        'must_log_in' => '<p class="must-log-in">' .
                                         sprintf(
                                        __( '<h4>You must be <a href="%s">logged in</a> to post a comment.</h4>', THEME_LANGUAGE_DOMAIN ),
                                        wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                                        ) . '</p>',
            
                        'comment_notes_before' => '',

                        'comment_notes_after' => '',
            
                        'fields' => apply_filters( 'comment_form_default_fields', array(

                                                    'author' => '<div class="one_half">'.
                                                                '<input name="author" type="text" id="author" size="30"  onfocus="if(this.value == \'Name\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'Name\'; }" value=\'Name\' >',

                                                    'email' =>  '<input name="email" type="text" id="email" size="30"  onfocus="if(this.value == \'E-mail\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'E-mail\'; }" value=\'E-mail\' >'.
                                                                '</div>',

                                                    'url' => ''
                                                    )
                                                )
                    );
                
        comment_form( $args );

?>
        
        <!-- /Comments formular. -->
        </div>

<?php

} else {
// comments are closed
?>

    <!-- If comments are closed. -->
    <h4><?php _e('Comments are closed.', THEME_LANGUAGE_DOMAIN); ?></h4>

<?php

} 

?>

