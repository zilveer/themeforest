<section id="comments" class="comments">

    <?php if ( have_comments() ) : ?>

        <h3><?php comments_number( null, __( '1 Response', 'openframe' ), __( '% Responses', 'openframe' ) ); ?></h3>
        <hr>

        <ul class="comment-list">

        	<?php wp_list_comments( array( 'callback' => 'retro_commentlist', 'style' => 'ul', 'reply_text' => __( 'Reply', 'openframe' ), ) ); ?>
        			
        </ul>

    <?php endif; ?>

    <div class="comment-reply">

    	<h4><?php comment_form_title( __( 'Leave a Reply', 'openframe'), __( 'Leave a Reply to %s', 'openframe') ); ?></h4>
    	<hr>

        <?php
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' ) ? " aria-required='true'" : false;

        comment_form(
        	array(
        		'title_reply' => null,
        		'title_reply_to' => null,
                'cancel_reply_link' => __( 'Cancel reply', 'openframe' ),
        		'comment_field' => '<textarea id="comment" name="comment" rows="7" placeholder="' . esc_attr( __( 'Your Message', 'openframe' ) ) . '" aria-required="true"></textarea>',
        		'comment_notes_before' => null,
        		'comment_notes_after' => null,
        		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'You are signed in as %s. %s', 'openframe' ), '<a href="' . admin_url( 'profile.php' ) . '">' . $user_identity . '</a>', '<a href="' . wp_logout_url() . '">' . __( 'Logout', 'openframe' ) . '</a>' ) . '</p>',
                'label_submit' => __( 'Post Comment', 'openframe' ),
        		'fields' => array(
    				'author' => '<input id="author" name="author" type="text" placeholder="' . esc_attr( __( 'Your Name', 'openframe' ) ) . '" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" ' . $req . '>',
    				'email' => '<input id="email" name="email" type="text" placeholder="' . esc_attr( __( 'Your@Email.com', 'openframe' ) ) . '" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" ' . $req . '>',
    				'url' => '<input id="url" name="url" type="text" placeholder="' . esc_attr( __( 'Your Website or Profile', 'openframe' ) ) . '" value="' . esc_url( $commenter[ 'comment_author_url' ] ) . '">'
    			)
        	),
        	$post->ID
        );
        ?>

    </div><!-- comment-reply -->

</section> 