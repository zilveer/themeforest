<?php
/**
 * The template for displaying posts in the Audio post format
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */
?>

<?php
/* Helper variables for this template */
$is_single = is_single();
$post_meta_enabled = kleo_postmeta_enabled();

$audio = get_cfield('audio');
$post_media_enabled = ( kleo_postmedia_enabled() && ! empty( $audio ) );

/* Check if we need an extra container for meta and media */
$show_extra_container = $is_single && sq_kleo()->get_option( 'has_vc_shortcode' ) && $post_media_enabled;

$post_class = 'clearfix';
if ( $is_single && get_cfield('centered_text') == 1 ) {
    $post_class .= ' text-center';
}
?>

<!-- Begin Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(array($post_class)); ?>>

    <?php if ( ! $is_single ) : ?>
        <h2 class="article-title entry-title">
            <a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>
    <?php endif; ?>

    <?php if ( $show_extra_container ) : /* Small fix for full width layout to center media and meta */ ?>
        <div class="container">
    <?php endif; ?>

        <?php if ( $post_meta_enabled ): ?>
            <div class="article-meta">
                <span class="post-meta">
                    <?php kleo_entry_meta(); ?>
                </span>
                <?php edit_post_link(esc_html__('Edit', 'kleo_framework'), '<span class="edit-link">', '</span>'); ?>
            </div><!--end article-meta-->
        <?php endif; ?>

        <?php
        
        if ( $post_media_enabled ) { ?>
        <div class="article-media post-audio">
            <audio id="audio_<?php the_id(); ?>" class="kleo-audio" style="width:100%;" src="<?php echo $audio; ?>"></audio>
        </div><!--end article-media-->
        <?php } ?>

    <?php if ( $show_extra_container ) : /* Small fix for full width layout to center media and meta */ ?>
        </div>
    <?php endif; ?>

    <div class="article-content">
        <?php if ( ! $is_single ) : // Only display Excerpts for Search ?>

            <?php echo kleo_excerpt(50); ?>
            <p class="kleo-continue">
                <a class="btn btn-default" href="<?php the_permalink() ?>"><?php esc_html_e("Continue reading", 'kleo_framework'); ?></a>
            </p>

        <?php else : ?>

            <?php the_content(esc_html__('Continue reading <span class="meta-nav">&rarr;</span>', 'kleo_framework')); ?>
            <?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'kleo_framework'), 'after' => '</div>')); ?>

        <?php endif; ?>
    </div><!--end article-content-->

</article>
<!-- End  Article -->
