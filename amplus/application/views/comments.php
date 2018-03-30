<?php

add_filter('comment_reply_link', 'bfi_comment_reply_link', 10, 4);
// Make the reply link a button
function bfi_comment_reply_link($link, $args, $comment, $post) {
    return $link;
    // return preg_replace('/comment\-reply\-link/', 'comment-reply-link button white small', $link);
}

// displays a comment

$comment_num = 1;
function bfi_comment( $comment, $args, $depth ) {
    global $comment_num;
    $GLOBALS['comment'] = $comment;

    switch ($comment->comment_type) {
        case '' :
            $id = 'comment-'.get_comment_ID();
            $class = join(' ', get_comment_class());
            $avatar = get_avatar($comment, 45, BFI_IMAGEURL.'mysteryman.png');
            $name = get_comment_author_link();
            $date = "<small class='comment-date'>".bfi_date_age(get_comment_date("U"))."</small>";
            // $date = "<small class='comment-date'>".sprintf(__( '%1$s %2$s', BFI_I18NDOMAIN ), get_comment_date("M d, Y"),  get_comment_time())."</small>";
            $reply = get_comment_reply_link(array_merge($args, array('reply_text' => sprintf(__('%s Reply', BFI_I18NDOMAIN), "<i class='icon-reply icon-large'></i>"), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
            // $edit = do_shortcode("[button class='comment-edit' href='".get_edit_comment_link()."' label='".__('Edit &rarr;', BFI_I18NDOMAIN )."' color='white' size='small']");
            $edit = "<a class='comment-edit' href='".get_edit_comment_link()."'>".sprintf(__('%s Edit', BFI_I18NDOMAIN ), "<i class='icon-pencil icon-large'></i>")."</a>";
            // $edit = "<a class='comment-edit' href='".get_edit_comment_link()."'>".__('(Edit)', BFI_I18NDOMAIN )."</a>";
            $text = apply_filters('the_content', get_comment_text());
            
            if (!current_user_can('edit_comment', $comment->comment_ID)) {
                $edit = "";
            }
            
            // fix some texts
            if ($comment->comment_parent != '0') {
                $name = "<span class='comment-name'>" . sprintf(__("%s replied %s", BFI_I18NDOMAIN), $name, $date) . "</span>";
            } else {
                $name = "<span class='comment-name'>" . sprintf(__("%s said %s", BFI_I18NDOMAIN), $name, $date) . "</span>";
            }

            if ($comment->comment_approved == '0') {
                $text .= "<p class='moderation bfi_infobox notice'>".__('Your comment is awaiting moderation.', BFI_I18NDOMAIN)."</p>";
            }
            
            echo "<li id='$id' class='$class'>$avatar<div><span class='comment-reply-edit'>$reply $edit</span> $name<hr>$text</div><div class='clearfix'></div></li>";
            break;
            
            
        case 'pingback'  :
        case 'trackback' :
            $label = __('Pingback:', BFI_I18NDOMAIN);
            $author = get_comment_author_link();
            $edit = get_edit_comment_link(__('(Edit)', BFI_I18NDOMAIN), ' ');
            
            echo "<li class='pingback trackback'>$label $author $edit<div class='clearfix'></div></li>";
            break;
    }
}

echo "<div class='clearfix'></div>";

if (have_comments()) {
    ?>
    <div id='comments'>
        <ul><?php wp_list_comments(array('callback' => 'bfi_comment')) ?></ul>
        <?php previous_comments_link(__('&larr; Older Comments', BFI_I18NDOMAIN)) ?>
        <?php next_comments_link(__('Newer Comments &rarr;', BFI_I18NDOMAIN)) ?>
        <div class='clearfix'></div>
    </div>
    <?php
}

if (comments_open()) {
    if(bfi_get_option('comment_registration') && !$user_ID) {
        ?>
        <div class='must_be_logged_in'>
            <p><?php _e('You must be logged in to post a comment.', BFI_I18NDOMAIN); ?></p>
            <?php
            echo do_shortcode("[button href='".bfi_get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink())."' label='".__('Log in now', BFI_I18NDOMAIN)."']");
            ?>
        </div>
        <?php
    } else {
        $commenter = wp_get_current_commenter();
        $fields = array(
                'author' => '<div class="one-third column alpha comment-form-author">' . '<label for="author"><i class="icon-user icon-large"></i>' . __('Name *', BFI_I18NDOMAIN) . '</label><input id="author" name="author" type="name" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required="required" placeholder="'.__('Enter your name', BFI_I18NDOMAIN).'"/></div>',
                'email' => '<div class="one-third column comment-form-email"><label for="email"><i class="icon-envelope-alt icon-large"></i>' . __('Email *', BFI_I18NDOMAIN) . '</label><input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required="required" placeholder="'.__('Enter your email', BFI_I18NDOMAIN).'"/></div>',
                'url' => '<div class="one-third column omega comment-form-url"><label for="url"><i class="icon-laptop icon-large"></i>' . __('Website', BFI_I18NDOMAIN) . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="http://"/></div>',
                );
  
        global $user_identity;
        $args = array(
            'fields' => $fields,
            'comment_field' => '<p class="comment-form-comment"><label for="comment"><i class="icon-comment icon-large"></i>' . __('Comment *', BFI_I18NDOMAIN) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required" placeholder="'.__('Enter your comment', BFI_I18NDOMAIN).'"></textarea></p>',
            'comment_notes_before' => '<small class="comment-notes">' . __('Your email address will not be published. Required fields are marked *', BFI_I18NDOMAIN) . '</small>',
            'comment_notes_after' => '',
            'label_submit' => __('Post comment', BFI_I18NDOMAIN),
            'title_reply' => __('Leave a Comment', BFI_I18NDOMAIN),
            'title_reply_to' => __('Leave a Comment', BFI_I18NDOMAIN),
            'cancel_reply_link' => __('Cancel reply', BFI_I18NDOMAIN),
            'must_log_in' => '<p class="must-log-in">' . __('You must be logged in to post a comment.', BFI_I18NDOMAIN) . ' <a href="' . wp_login_url(get_permalink()) . '">' . __('Log in now &rarr;', BFI_I18NDOMAIN) . '</a></p>',
            'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as %s.', BFI_I18NDOMAIN), '<a href="'.admin_url('profile.php').'">'.$user_identity.'</a>') . " <a href='".wp_logout_url(get_permalink())."'><i class='icon-off icon-large'></i> ".__('Log out now', BFI_I18NDOMAIN)."</a>" . '</p>',
            );
        bfi_comment_form($args);
        
        // validator
        echo "
        <script>
        jQuery(document).ready(function($){
            // somehow the name field won't update the errors. manually do it
            $('#commentform .button').click(function() {
                $('#commentform input[required=\"required\"]').keyup(function() {
                    $('#commentform').validate().resetForm(); $('#commentform').validate().form();
                });
            });
            var validator = $('#commentform').validate({
        		rules: {
        		    author: {
        				required: true
        		    },
        			recaptcha_response_field: {
        				required: true
        			},
        			email: {
        				required: true
        			},
        			comment: {
        				required: true
        			}
        		},
        		messages: {
        	        author: {
        	            required: '".__('The name field is required.', BFI_I18NDOMAIN)."'
        	        },
        			recaptcha_response_field: {
        				required: '".__('The captcha field is required.', BFI_I18NDOMAIN)."'
        			},
        			email: {
        				required: '".__('The email field is required.', BFI_I18NDOMAIN)."'
        			},
        			comment: {
        				required: '".__('The comment field is required.', BFI_I18NDOMAIN)."'
        			}
        	    },
        	    errorClass: 'error icon-warning-sign',
        	    errorContainer: '',
        	    errorLabelContainer: '#commentform .error_container',
        	    errorElement: 'div',
        		errorPlacement: function(error, element) {
        		}
        	});
        });
        </script>
        ";
    }
}
?>
