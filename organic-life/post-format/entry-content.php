<?php global $themeum_options; ?>

<div class="clearfix entry-meta">
    <ul>

        <?php if (isset($themeum_options['blog-category']) && $themeum_options['blog-category'] ) { ?>
        <li class="category"><?php echo get_the_category_list(', '); ?></li>
        <?php }?>        

        <?php if (isset($themeum_options['blog-date']) && $themeum_options['blog-date'] ) { ?>
            <li class="publish-date"><time class="entry-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('j M,  Y'); ?></time></li>  
        <?php }?>       

        <?php if (isset($themeum_options['blog-author']) && $themeum_options['blog-author'] ) { ?>
        <li class="author"> <?php the_author_posts_link() ?></li> 
        <?php }?>         
        
        <?php if (isset($themeum_options['blog-tag']) && $themeum_options['blog-tag'] ) { ?>
        <li class="tag"><?php the_tags('', ', ', '<br />'); ?> </li>
        <?php }?>

        <?php if (isset($themeum_options['blog-comment']) && $themeum_options['blog-comment'] ){ ?> 
        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
            <li class="comments-link">
                <?php comments_popup_link( '<span class="leave-reply">' . __( 'No comment', 'themeum' ) . '</span>', __( 'One comment', 'themeum' ), __( '% comments', 'themeum' ) ); ?>
            </li>
        <?php endif; //.comment-link ?>
        <?php } ?>

        <?php if (isset($themeum_options['blog-edit-en']) && $themeum_options['blog-edit-en']) { ?>
            <li class="edit-link">
                 <?php edit_post_link( __( 'Edit', 'themeum' ), '<span class="edit-link">', '</span>' ); ?>
            </li>
        <?php } ?>
    </ul>
</div> <!--/.entry-meta -->


