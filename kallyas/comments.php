<?php if(! defined('ABSPATH')){ return; }
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('Please do not load this page directly. Thanks!');
}

$blog_layout = zget_option('sg_layout', 'blog_options', false, 'classic');



echo '<div class="comment-form-wrapper kl-comments-wrapper kl-commlayout-'.$blog_layout.'">';

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

    <!-- You can start editing here. -->

<?php
global $post;
if ( comments_open() ) { ?>

    <div class="clear"></div>

    <div class="zn-separator zn-margin-b line"></div>

    <div class="zn_comments sixteen columns  kl-comments">

<?php } ?>

<?php if (have_comments()) : ?>

    <h3 id="comments" class="kl-comments-title" <?php echo WpkPageHelper::zn_schema_markup('subtitle'); ?>><?php comments_number( __( 'No Comments', 'zn_framework'), __( '1 Comment', 'zn_framework' ), __( '% Comments', 'zn_framework' ) ); ?> to &#8220;<?php the_title(); ?>&#8221;</h3>
    <ol class="commentlist kl-comments-list">
        <?php
        wp_list_comments(
            array(
                'callback' => 'zn_comment',
                'style' => 'ol',
            )
        ); ?>
    </ol>

    <?php
    $page = get_query_var('cpage');
    $args = array(
        'range' => 3,
        'showitems' => 7,
        'paged' => empty( $page ) ? 1 : $page,
        'method' => 'get_comments_pagenum_link',
        'pages' => get_comment_pages_count(),
        'previous_text' => __('Older comments', 'zn_framework'),
        'older_text' => __('Newer comments', 'zn_framework'),
    );

    zn_pagination( $args );

    ?>

    <div class="clear"></div>

<?php endif; ?>


<?php if ( comments_open() ) : ?>
        <?php if (get_option('comment_registration') && !$user_ID) : ?>

            <p><?php echo __("You must be ", 'zn_framework'); ?>
                <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">
                    <?php echo __("logged in", 'zn_framework'); ?>
                </a>
                <?php echo __("to post a comment.", 'zn_framework'); ?>
            </p>

        <?php else :

            $btn_style = 'btn btn-fullcolor';
            if($blog_layout == 'modern'){
                $btn_style = 'btn btn-lined lined-dark';
            }

            comment_form(array( 'class_submit' => $btn_style ));
        endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>

<?php if ( comments_open() ) { ?>

    </div>

<?php } ?>

<?php echo '</div>';
