<?php
/**
 * This template is used for displaying comments in posts
 */
global $post;

do_action('layers_before_comments'); ?>
<?php if ( have_comments() ) : ?>
<section id="comments" class="push-top-large">

		<div class="section-title">
			<h4 class="heading comment-title">
				<?php _e("Comments", TL_DOMAIN); ?>
                <mark>(<?php echo  get_comments_number(); ?>)</mark>
			</h4>
		</div>

		<div <?php layers_wrapper_class( 'comment_list', 'grid comment-list' ); ?>>
			<?php wp_list_comments( array( 'callback' => '\Handyman\Front\tl_layers_comment', 'style' => 'div' ) ); ?>
		</div><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="pagination">
				<div class="previous"><?php previous_comments_link( __( '&larr;' , 'layerswp' ) ); ?></div>
				<div class="next"><?php next_comments_link( __( '&rarr;' , 'layerswp' ) ); ?></div>
			</nav>
		<?php endif // check for comment navigation ?>

</section><!-- #comments .comments-area -->
<?php endif; ?>


<section class="comment-form-wrapper push-top-large">

    <?php if(comments_open($post->ID)) : ?>
        <?php comment_form();  ?>
        <div><a class="button send-comment-fake"><?php _e('Send Comment', TL_DOMAIN); ?></a></div>
    <?php else: ?>
        <p class="closed-comments"><?php _e('Comments are closed.', TL_DOMAIN); ?></p>
    <?php endif; ?>
</section>
<?php do_action('layers_after_comments');