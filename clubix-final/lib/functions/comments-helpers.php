<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Custom Function for Displaying Comments
 *
 * @since 1.0.0
 */
function zen_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>

        <li id="comment-<?php comment_ID(); ?>" >

        <div <?php comment_class(); ?>>

            <div class="left-section">
            </div>

            <div class="right-section">

                <h1>

                    <a><?php _e('Pingback:', LANGUAGE_ZONE); ?></a>

                </h1>

                <div class="clear"></div>

                <div class="comment-text">

                    <p><?php comment_author_link(); ?></p>

                </div>

                <div class="replay">
                    <p class="time-comment"><i class="fa fa-clock-o"></i>  <?php comment_date(); ?> at <?php comment_time(); ?> </p>
                </div>

            </div>

            <div class="clear"></div>

        </div>

    <?php endif; ?>

    <?php if (get_comment_type() == 'comment') : ?>
    <li id="comment-<?php comment_ID(); ?>" >

        <div <?php comment_class(); ?>>

            <div class="left-section">
                <?php
                $avatar_size = 92;

                echo get_avatar($comment, $avatar_size);
                ?>
            </div>

            <div class="right-section">

                <h1>

                    <a><?php comment_author_link(); ?></a>

                </h1>

                <div class="clear"></div>

                <div class="comment-text">

                    <?php if ($comment->comment_approved == '0') : ?>

                        <p class="awaiting-moderation"><?php _e('Your comment is awaiting moderation.', LANGUAGE_ZONE); ?></p>

                    <?php endif; ?>

                    <?php comment_text(); ?>

                </div>

                <div class="replay">
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text'=>'<i class="fa fa-reply"></i> '. __('Reply', LANGUAGE_ZONE)))); ?>
                    <p class="time-comment"><i class="fa fa-clock-o"></i>  <?php comment_date(); ?> at <?php comment_time(); ?> </p>
                </div>

            </div>

            <div class="clear"></div>

        </div>

    <?php endif;
}

function zen_custom_comment_form($defaults) {

    $defaults['comment_notes_before'] = '';
    $defaults['comment_notes_after'] = '';
    $defaults['id_form'] = 'comment-form';
    $defaults['comment_field'] = '<textarea name="comment" id="comment" placeholder="'. __('Message *', LANGUAGE_ZONE) .'"></textarea>';

    return $defaults;
}

function zen_custom_comment_fields() {
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');

    $fields = array(
        'author' => '<ul class="comment-form-inputs"><li>' .
            '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req .
            ' placeholder="' . __('Name ', LANGUAGE_ZONE) . ($req ? __('*', LANGUAGE_ZONE) : '') . '" /></li>',
        'email' => '<li>' .
            '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req .
            ' placeholder="' . __('Email ', LANGUAGE_ZONE) . ($req ? __('*', LANGUAGE_ZONE) : '') . '"/>' .
            '</li>',
        'url' => '<li>' .
            '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
            '" placeholder="' . __('Website ', LANGUAGE_ZONE) . '" />' .
            '</li></ul>'
    );

    return $fields;
}