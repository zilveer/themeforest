<?php
if (jwOpt::get_option('fbcomments_switch', '0') == '0') {

    function jw_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li class="post pingback">
                    <p><?php _e('Pingback:', 'jawtemplates', 'comments_reply'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'jawtemplates'), '<span class="edit-link">', '</span>'); ?></p>
                    <?php
                    break;
                default :
                    ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div class="author-avatar">
                        <div class="comment-author vcard">
                            <?php
                            $avatar_size = 68;
                            if ('0' != $comment->comment_parent)
                                $avatar_size = 68;
                            echo get_avatar($comment, $avatar_size);
                            ?>                      

                        </div><!-- .comment-author .vcard -->
                        <div class="reply">
                            <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'jawtemplates'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </div><!-- .reply -->
                    </div> 

                    <div id="comment-<?php comment_ID(); ?>" class="comment comment-item">
                        <div class="comment-item-content">
                            <?php if ($comment->comment_approved == '0') : ?>
                                <footer class="comment-meta">
                                    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'jawtemplates'); ?></em>
                                    <br />
                                </footer>  
                            <?php endif; ?>

                            <div>
                                <?php edit_comment_link(__('Edit', 'jawtemplates'), '<span class="edit-link">', '</span>'); ?>


                                <strong><?php echo get_comment_author_link(); ?></strong>
                                <br>
                                <a class="comment-item-date" href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php echo get_comment_date() . " at " . get_comment_time() ?></a>

                            </div>

                            <div class="comment-content"><?php comment_text(); ?></div>
                            <div class="box_arrow"><span class="icon-arrow-left2"></span></div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- #comment-## -->

                    <?php
                    break;
            endswitch;
        }

        // Do not delete these lines
        if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
            die(__('Please do not load this page directly. Thanks!', 'jawtemplates'));

        if (post_password_required()) {
            ?>
            <section id="comments">
                <div class="notice">
                    <p class="bottom"><?php _e('This post is password protected. Enter the password to view comments.', 'jawtemplates'); ?></p>
                </div>
            </section>
            <?php
            return;
        }
        ?>
        <?php // You can start editing here. Customize the respond form below  ?>
        <?php if (have_comments()) : ?>
            <section id="comments">
                <h3><?php comments_number(__('No Responses to', 'jawtemplates', 'comments_noresponse'), __('One Response to', 'jawtemplates'), '% ' . __('Responses to', 'jawtemplates')); ?> &#8220;<?php the_title(); ?>&#8221;</h3>
                <ol class="commentlist">
                    <?php wp_list_comments(array('callback' => 'jw_comment')); ?>
                </ol>
                <footer>
                    <nav id="comments-nav">
                        <div class="comments-previous"><?php previous_comments_link(__('<i class="icon-arrow-slide-left"></i> Older comments', 'jawtemplates')); ?></div>
                        <div class="comments-next"><?php next_comments_link(__('Newer comments <i class="icon-arrow-slide-right"></i>', 'jawtemplates')); ?></div>
                        <div class="clear"></div>
                    </nav>
                </footer>
            </section>
        <?php else : // this is displayed if there are no comments so far   ?>
            <?php if (comments_open()) : ?>
            <?php else : // comments are closed  ?>
                <section id="comments">
                    <div class="notice">
                        <p class="bottom"><?php _e('Comments are closed.', 'jawtemplates') ?></p>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>
        <?php
        

        if (!isset($comment_question)) {
            $comment_question = '';
        }


        $textarea_class = '';
        if (jwOpt::get_option('comments_antispam_toggle', '0') != '0') {
            $textarea_class = 'question-on';
        }

        $args = array(
            'id_form' => 'commentform',
            'id_submit' => 'submit',
            'title_reply' => __('Leave a Reply', 'jawtemplates'),
            'title_reply_to' => __('Leave a Reply to', 'jawtemplates') . ' %s',
            'label_submit' => __('Submit Comment', 'jawtemplates'),
            'comment_field' => '<div ' . (is_user_logged_in() ? '' : 'class="comment-twothird"') . '>
                                                <p>
                                                    <label for="comment">' . __('Comment', 'jawtemplates') . '</label>
                                                    <textarea name="comment" class="' . $textarea_class . '" id="comment" tabindex="4" placeholder="Comment"></textarea>
                                                </p></div>',
            'must_log_in' => '<p>' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'jawtemplates'), wp_login_url(get_permalink())) . '</p>',
            'logged_in_as' => '<p>' . sprintf(__('Logged in as', 'jawtemplates') . ' <a href="%s/wp-admin/profile.php">%s</a>.', get_option('siteurl'), $user_identity) . ' <a href="' . wp_logout_url(get_permalink()) . '" title="' . __('Log out of this account', 'jawtemplates') . '">' . __('Log out &raquo;', 'jawtemplates') . '</a></p>',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'fields' => apply_filters('comment_form_default_fields', array(
                'author' => '<div class="comment-onethird">
                                                    <p>
                                                    <label for="author">' .
                __('Name', 'jawtemplates') .
                ($req ? __(' (required)', 'jawtemplates') : '')
                . '</label> 
                                                     <input type="text" class="five" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" tabindex="1" ' . ($req ? "aria-required='true'" : '') . ' placeholder="Name"> </p>',
                'email' => '<p>
                                                    <label for="email">' .
                __('E-mail', 'jawtemplates') .
                ($req ? __(' (required)', 'jawtemplates') : '')
                . '</label>
                                                    <input type="text" class="five" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="2"  ' . ($req ? "aria-required='true'" : '') . ' placeholder="youremail@yourdomain.com"> </p>',
                'url' => '<p>
                                                    <label for="url">' . __('Website', 'jawtemplates') . '</label>
                                                    <input type="text" class="five" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" tabindex="3" placeholder="www.website.com">
                                                    </p>',
                'question' => '<p style="display:' . ((jwOpt::get_option('comments_antispam_toggle', '0') == '0') ? 'none' : 'inherit' ) . '" >
                                                    <label for="question">' . __(jwOpt::get_option('comments_antispam_question'), 'jawtemplates') . ($req ? __(' (required)', 'jawtemplates') : '') . '</label>
                                                    <input type="text" class="five" name="question" id="question" value="' . esc_attr($comment_question) . '" size="22" tabindex="4" ' . ($req ? "aria-required='true'" : '') . ' placeholder="answer" >
                                                    </p>
                                                    </div>'
        )));
        comment_form($args);
    } else {
        jwFacebook::get_fb_comment();
    }
