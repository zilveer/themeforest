<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			comments.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

?>

<!-- ############################# Comment section ############################# -->
<section id="comments" class="comments-section">
    <div class="section-sign">
        <span class="icon icon-bubbles"></span>
    </div>

    <!-- container -->
    <div class="container">
        

        <?php
        // protect password protected comments
        if ( post_password_required() ) : ?>

        	<p class="comment-message"><?php _e( 'This post is password protected. Enter the password to view any comments.', SPECTRA_THEME ); ?></p>
        	
        <?php return; endif; ?>

        <?php if ( have_comments() ) : ?>
            <h4 class="comments-title"><?php printf( _n( '1 comment on "%2$s"', '%1$s comments on "%2$s"', get_comments_number(), SPECTRA_THEME ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>', SPECTRA_THEME );
            ?></h4>
        	<div class="comments-container clearfix">	
        		<ul class="comment-list">
        			<?php 
                        wp_list_comments( array(
                            'type' => 'all',
                            'short_ping' => true,
                            'callback'=> 'spectra_comments'
                        ) );
                    ?>
        		</ul>		
        		<nav class="comments-navigation" role="navigation">
        		    <div class="nav-prev"><?php previous_comments_link(); ?></div>
        		    <div class="nav-next"><?php next_comments_link(); ?></div>
        		</nav>
        	</div>

        <?php else : // there are no comments so far ?>

        	<?php if ( comments_open() ) : ?>
        		<!-- If comments are open, but there are no comments. -->
        		<p class="comment-message"><?php _e( 'Currently there are no comments related to this article. You have a special honor to be the first commenter. Thanks!', SPECTRA_THEME ); ?></p>
        	 <?php else : // comments are closed ?>
        		<!-- If comments are closed. -->
        		<p class="comment-message"><?php _e( 'Comments are closed.', SPECTRA_THEME ); ?></p>
        	<?php endif; ?>

        <?php endif; ?>


        <?php
        $fields = array();
        function custom_fields( $fields ) {
            global $comment_author, $comment_author_email, $comment_author_url;

            $fields['author'] = '<div class="col-1-3">
                    <label for="author">' . __('Name (required)', SPECTRA_THEME ) . '</label>
                    <input type="text" name="author" id="author" value="' . $comment_author . '" size="22" tabindex="1" required />
                    </div>';
            $fields['email'] = '<div class="col-1-3">
                    <label for="email">' . __('Email (required)', SPECTRA_THEME ) . '</label>
                    <input type="text" name="email" id="email" value="' . $comment_author_email . '" size="22" tabindex="2" required />
                    </div>';
            $fields['url'] = '<div class="col-1-3 last">
                    <label for="url">' . __('Website URL', SPECTRA_THEME ) . '</label>
                    <input type="text" name="url" id="url" value="' . $comment_author_url . '" size="22" tabindex="3" />
                    </div>';
            return $fields;
        }

        add_filter('comment_form_default_fields', 'custom_fields');

        $form_fields = array(
            'fields' => apply_filters( 'comment_form_default_fields', $fields ),
            'title_reply' => __('Join the discussion', SPECTRA_THEME),
            'title_reply_to' => __('Leave a Reply.', SPECTRA_THEME),
            'cancel_reply_link' => __('(Click here to cancel reply)', SPECTRA_THEME),
            'comment_notes_before' => '',
            'label_submit' => __('Post Comment', SPECTRA_THEME),
            'comment_notes_after' => '<p class="form-allowed-tags">' . __('* Your email address will not be published.', SPECTRA_THEME) . '<br/>' . sprintf( __('You may use these HTML tags and attributes: %s', SPECTRA_THEME), ' <span>' . allowed_tags() . '</span>' ) . '</p>',
            'comment_field' => '<div class="comment-field">
                    <label for="comment">' . __('Your Comment (required)', SPECTRA_THEME) . '</label>
                    <textarea tabindex="4" rows="9" id="comment" name="comment" class="textarea" required></textarea>
                    </div>'
        );
        ?>
        <?php comment_form( $form_fields ); ?>
    </div>
</section>
<!-- /comments -->