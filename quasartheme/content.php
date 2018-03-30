<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Quasar
 * @since Quasar 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> rel="<?php if(is_single()): echo 'single-post'; else: echo 'loop-post'; endif; ?>">
	<header class="entry-header">
		<?php echo quasar_get_entry_header(); ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() || !is_single() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php echo quasar_get_post_loop_description(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php echo quasar_get_the_content(); ?>
		<?php quasar_get_link_pages(); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
    	<div class="entry-footer-details">
			<?php if ( ! is_single() ) : ?>
            	<?php if(comments_open()): ?>
                    <div class="comments-link">
                        <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'quasar' ) . '</span>', __( 'One comment so far', 'quasar' ), __( 'View all "%" comments', 'quasar' ) ); ?>
                    </div><!-- .comments-link -->
                <?php endif; ?>
                <div class="post-view">
                    <?php echo quasar_get_post_views(); ?>
                </div>
            <?php endif; // comments_open() ?>
            <div class="clear"></div>
		</div>
        
		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
    <?php 
		if(is_single()) :
			echo quasar_get_post_share(array('social_html' => '<div class="post-view-single">'.quasar_get_post_views().'</div>'));
		endif;
	?>
</article><!-- #post -->