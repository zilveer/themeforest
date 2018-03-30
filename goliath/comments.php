<!-- Comments -->
<div class="comments" id="comments">
    
    <?php if ( comments_open() ) : ?>
    
        <?php if ( have_comments() ) : ?>
            
            <div class="title-default">
                <a href="#" class="active"><?php _e('Comments', 'goliath'); ?></a>
            </div>
    
            <ul>
                <?php wp_list_comments( array( 'callback' => 'plsh_comments' ) ); ?>
            </ul>
            
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <!-- BEGIN .pages -->	
                <div class="pages clearfix">
                    <div class="nav-previous"><?php previous_comments_link( '<span></span>' .  __('Previous', 'goliath')); ?></div>
                    <div class="nav-next"><?php next_comments_link(__('Next', 'goliath') . '<span></span>'); ?></div>
                </div>
            <?php endif; ?>
                
        <?php endif; ?>
            
        <div class="add-comment">
            <div class="title-default">
                <a href="#" class="active"><?php _e('Add a comment', 'goliath'); ?></a>
            </div>

            <?php if ( !have_comments() ) : ?>
                <div class="no-comments">
                    <p><?php _e('No comments so far.', 'goliath'); ?></p>
                    <p><?php _e('Be first to leave comment below.', 'goliath'); ?></p>
                </div>
            <?php endif; ?>
            
            <?php 
                $avatar = get_avatar( $GLOBALS['comment'], $size='30' );
                $post_id = get_the_ID();
                $commenter = wp_get_current_commenter();
                $req = get_option( 'require_name_email' );
                $aria_req = ( $req ? " aria-required='true'" : '' );
                
                $args = array(
                    'fields' => apply_filters( 'comment_form_default_fields', array(
                         'author' =>
                            '<p class="comment-fields">' .
                            '<input id="author" name="author" class="form-control" type="text" placeholder="' . __( 'Your name', 'goliath' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' .
                             $aria_req . ' />',

                          'email' =>
                            '<input id="email" name="email" class="form-control" type="text" placeholder="' . __( 'E-mail address', 'goliath' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' .
                             $aria_req . ' />',

                          'url' =>
                            '<input id="url" name="url" class="form-control" type="text" placeholder="' . __( 'Website', 'goliath' ) .  '" value="' . esc_attr( $commenter['comment_author_url'] ) . '"/></p>',
                        )
                    ),
                    'comment_field' =>  '<p>' .
                                        '<textarea id="comment" name="comment" placeholder="' . __( 'Your comment', 'goliath' ) . '" class="form-control" aria-required="true"></textarea>' .
                                        '</p>',
                    'logged_in_as' => '<p><div class="logged_in_inner">' . $avatar . ' <a class="user" href="' . get_edit_user_link() . '">' . $user_identity . '</a>' . ' <a class="logout" href="' . wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) . '">' . __('Log out', 'goliath') . '</a>' . '</div></p>',
                    'comment_notes_after' => '<p class="comment-submit-button"><button type="button" id="comment-submit" class="btn btn-default"><span>' . __('Post comment', 'goliath') . '</span></button></p>',
                    'id_submit' => 'hidden-submit',
                    'title_reply' => ''
                );
                comment_form($args);
            ?>
        </div>
    <?php endif; ?>

<!-- END .comments -->
</div>
