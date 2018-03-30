<?php
    /**
    * The template for displaying Comments.
    *
    * The area of the page that contains both current comments
    * and the comment form.  The actual display of comments is
    * handled by a callback to de_comment which is
    * located in the functions.php file.
    *
    */
   

?>
<div id="comments">
<?php
    if ( post_password_required() ) {
?>
            <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'cosmotheme' ); ?></p>
        </div><!-- #comments -->
<?php
        /* Stop the rest of comments.php from being processed,
         * but don't kill the script entirely -- we still have
         * to fully load the template.
         */
        return;
    }
?>

<?php
    // You can start editing here -- including this comment!
?>

<?php 
    if ( have_comments() && comments_open()) { 
        $pgn = paginate_comments_links( array('prev_text' => '&laquo; Prev', 'next_text' => 'Next &raquo;' , 'format' => 'array' , 'echo' => false) );
?>
        <h3 class="comments-title" id="comments-title"><span><?php echo get_comments_number().' '; if(get_comments_number() == 1) {_e('Comment','cosmotheme');} else {_e('Comments','cosmotheme');} ?></span></h3>
<?php 
     
        if( strlen( $pgn ) > 0 ) {
            echo '<ul class="b_pag center p_b">';
            echo str_replace( 'next' , 'no_link' , str_replace('prev' , 'no_link' , str_replace('<a' , '<li><a' , str_replace('</a>' , '</a></li>' , str_replace( '<span' , '<li class="active"><span' , str_replace('</span>', '</span></li>' , $pgn ) ) ) ) ) );
            echo '</ul>';
        }
?>
        

        <ol class="cosmo-comment-list cosmo-comment-plain">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use de_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * define de_comment() and that will be used instead.
                 * See de_comment() in news24/functions.php for more.
                 */
                wp_list_comments( array( 'callback' => 'de_comment' ) );
            ?>
        </ol>
            

<?php 
     
        if( strlen( $pgn ) > 0 ) {
            echo '<ul class="b_pag center p_b">';
            echo str_replace( 'next' , 'no_link' , str_replace('prev' , 'no_link' , str_replace('<a' , '<li><a' , str_replace('</a>' , '</a></li>' , str_replace( '<span' , '<li class="active"><span' , str_replace('</span>', '</span></li>' , $pgn ) ) ) ) ) );
            echo '</ul>';
        }

    }else{

        /* If there are no comments and comments are closed,
         * let's leave a little note, shall we?
         */
        if ( ! comments_open() ) {

        }
    }

    $commenter = wp_get_current_commenter();
    
    $fields =  array(
        'author' => '<div class="twelve columns"><p class="comment-form-author input">' . '<input class="required" placeholder="' . __( 'Your name','cosmotheme' ) . '" id="author" name="author" type="text" value="" size="30"  />' .
                    '</p>',
        'email'  => '<p class="comment-form-email input"><input  class="required" id="email" name="email" placeholder="' . __( 'Your email','cosmotheme' ) . '" type="text" value="" size="30" />' .
                    '</p>',
        'url'    => '<p class="comment-form-url input"><input id="url" name="url" type="text" value="" placeholder="' . __( 'Website','cosmotheme' ) . '" size="30" />' .
                    '</p></div>',
    );

    if( is_user_logged_in () ){
        $u_id = get_current_user_id();
    }else{
        $u_id = 0;
    }

    $args = array(  
        'title_reply' => '<span>'. __("Leave a reply",'cosmotheme') .'</span>' ,
        'comment_notes_after' =>'',
        'comment_notes_before' =>'<div class="twelve columns"><p class="comment-notes st">' . __( 'Your email address will not be published.' , 'cosmotheme' ) . '</p></div>',
        //'comment_notes_before' =>'',
        'logged_in_as' =>'<div class="twelve columns"><p class="logged-in-as">' . __( 'Logged in as' ,'cosmotheme' ) . ' <a href="' . home_url('/wp-admin/profile.php') . '">' . get_the_author_meta( 'nickname' , get_current_user_id() ) . '</a>. <a href="' . wp_logout_url( get_permalink( $post -> ID ) ) .'" title="' . __( 'Log out of this account' , 'cosmotheme' ) . '">' . __( 'Log out?' , 'cosmotheme' ) . ' </a></p></div>',        
        'fields' => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field' => '<div class="twelve columns"><p class="comment-form-comment textarea"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p></div>',
        'label_submit' => __("Add comment",'cosmotheme' )
    );
    
    echo '<div class="row">';
    comment_form( $args );
    echo '</div>';
    
?>

</div><!-- #comments -->
