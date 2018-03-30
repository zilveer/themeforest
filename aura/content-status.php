<div class="post-content">
<?php aurawp_excerpt();?>
</div>
<div class="post-minfo"><?php the_time('F j, Y'); ?> / <?php comments_popup_link( '', __( '1 Comment / ', 'aurat2d' ), __( '% Comments / ', 'aurat2d' )); ?><?php _e( 'by', 'aurat2d' ); ?> <?php the_author_posts_link(); ?> <?php echo "/  "; the_tags(); ?></div>