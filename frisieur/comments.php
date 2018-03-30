<?php

   /**
    *
    * function for better display "edit" and "reply" links
    * under comment author name
    * 
    */                  

    function martanian_show_link( $type = '', $link = '' ) {
    
        if( $link != '' && $type != '' ) {
        
            switch( $type ) {
            
                case 'reply': echo $link; break;
                case 'edit': echo '<a href="'. $link .'" class="comment-reply-link">'. __( 'Edit', 'martanian' ) .'</a>'; break;
            }
        }
        
        return;
    }
    
   /**
    *
    * custom comment shape
    * 
    */          

    function martanian_shape_comment( $comment, $args, $depth ) {

        ?>
        <li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>

            <div class="comment-author-avatar"><?php echo get_avatar( $comment, 40 ); ?></div>
            <div class="comment-container">
            
                <div class="comment-author-info">
                
                    <div class="comment-author-name">
                    
                        <?php
                        
                            # show author link
                            echo '<span class="name">'. get_comment_author_link() .'</span>';
                            
                            # show reply link
                            $comment_reply_link = get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                            martanian_show_link( 'reply', $comment_reply_link );
                            
                            # show edit link
                            martanian_show_link( 'edit', get_edit_comment_link() );
                        
                        ?>
                    
                    </div>

                    <time datetime="<?php comment_time( 'c' ); ?>">
                    
                        <?php printf( __( '%1$s at %2$s', 'martanian' ), get_comment_date(), get_comment_time() ); ?>
                    
                    </time>
                        
                    <?php
                    
                        if( $comment -> comment_approved == '0' ) {
                            
                            _e( 'Your comment is awaiting moderation.', 'martanian' );
                        }
                    
                    ?>

                </div>

                <div class="comment-content">
                
                    <?php comment_text(); ?>
                    
                </div>

            </div>    

        </li>
        <?php                     
    }
    
   /**
    *
    * hide comments if post required password
    * 
    */                

    if( post_password_required() ) return;
    
   /**
    *
    * page settings end.
    * 
    */
    
    if( comments_open() ) {
    
        if( have_comments() ) {

?> 
<div class="blog-post-comments">

    <h2><i class="icon-comments-alt"></i> <?php _e( 'Comments', 'martanian' ); ?></h2>
    <div class="comments-box">
    
        <ol class="comments-list">
        
            <?php
            
                wp_list_comments(
                    array(
                        'callback' => 'martanian_shape_comment'
                    )
                );
            
            ?>
        
        </ol>
        
        <div class="paginate-comments-links"><?php paginate_comments_links(); ?></div>
   
    </div>

</div>
<?php } ?>
<div class="blog-post-comments-reply">

    <?php
    
       /**
        *
        * comments form
        * 
        */
                                        
        $comment_args = array(
            'title_reply' => '<h2><i class="icon-reply-all"></i> '. __( 'Leave a reply', 'martanian' ) .'</h2>',
            'title_reply_to' => '<h2><i class="icon-reply-all"></i> '. __( 'Leave a Reply to %s', 'martanian' ) .'</h2>',
            'fields' => apply_filters(
                'comment_form_default_fields',
                array(
                    'author' => '<div class="input"><div class="input-helper"><i class="icon-male"></i></div><input type="text" name="author" placeholder="'. __( 'Name...', 'martanian' ) .'" style="width: 662px;" aria-required="true" /><div class="clear"></div></div>',
                    'email' => '<div class="input"><div class="input-helper"><i class="icon-envelope"></i></div><input type="text" name="email" placeholder="'. __( 'Email...', 'martanian' ) .'" style="width: 662px;" aria-required="true" /><div class="clear"></div></div>',
                    'url' => '<div class="input"><div class="input-helper"><i class="icon-globe"></i></div><input type="text" name="url" placeholder="'. __( 'Website...', 'martanian' ) .'" style="width: 662px;" /><div class="clear"></div></div>'
                )
            ),
            'comment_field' => '<textarea placeholder="'. __( 'Comment...', 'martanian' ) .'" name="comment" style="width: 698px;" aria-required="true"></textarea>' . '</p>',
            'comment_notes_after' => '',
            'comment_notes_before' => '<div class="alert-box alert-yellow" style="margin-bottom: 20px"><i class="icon-remove"></i><p>'. __( 'Your email address will not be published, and your website url is not required.', 'martanian' ) .'</p></div>',
            'logged_in_as' => '<div class="alert-box alert-yellow" style="margin-bottom: 20px"><i class="icon-remove"></i><p>'. sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'martanian' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) .'</p></div>'
        );

        ob_start();
        comment_form( $comment_args );
        $comments_form = ob_get_clean();
        
        echo str_replace(
            '<input name="submit" type="submit" id="submit" value="Post Comment" />',
            '<button name="send" type="submit" class="button button-brown"><i class="icon-envelope-alt"></i>Post comment!</button>',
            $comments_form
        );
    
    ?>
    
    <div class="clear">
    </div>

</div>
<?php } ?>