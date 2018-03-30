<?php $comment_count = get_comment_count( $post->ID ); ?>

<?php if ( $comment_count['approved'] > 0 ) : ?>

    <h2 class="heading-2 m-small"><span><?php echo __( 'Comments', 'beautyspot' ) . ' (' . $comment_count['approved'] . ')'; ?></span></h2>

    <!-- COMMENT LIST : begin -->
    <ul class="comment-list">

        <?php

        $args = array(
            'walker' => new lsvr_walker_comment,
            'reply_text' => __( 'Reply', 'beautyspot' ),
            'avatar_size' => 60,
            'format' => 'html5'
        );
        wp_list_comments( $args );

        $args = array(
            'echo' => false,
            'prev_next' => false,
            'type' => 'list'
        );
        $pagination = paginate_comments_links( $args );
        if ( ! is_null( $pagination ) ) {
            echo '<div class="c-pagination">' . $pagination . '</div>';
        }

        ?>

    </ul>
    <!-- COMMENT LIST : end -->

<?php endif; ?>

<!-- COMMENT FORM : begin -->
<div class="default-form to-remove<?php if ( is_user_logged_in() ) { echo ' user-logged-in'; } ?>">
    <?php comment_form(); ?>
</div>
<!-- COMMENT FORM : end -->