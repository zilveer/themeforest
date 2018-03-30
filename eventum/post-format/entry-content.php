<?php global $themeum_options; ?>

<div class="entry-headder">
    <h2 class="entry-title blog-entry-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
        <sup class="featured-post"><i class="fa fa-star-o"></i><?php esc_html_e( 'Sticky', 'eventum' ) ?></sup>
        <?php } ?>
    </h2> <!-- //.entry-title --> 
</div>
<div class="entry-blog-meta">
    <ul>
        <?php if (isset($themeum_options['blog-author']) && $themeum_options['blog-author'] ) { ?>
          <li class="author-by"><i class="fa fa-user"></i> <span class="author"> <?php the_author_posts_link() ?></span> </li>
        <?php }?> 
        
        <?php if (isset($themeum_options['blog-category']) && $themeum_options['blog-category'] ) { ?>
        <li class="category"><i class="fa fa-folder-open-o"></i><?php echo get_the_category_list(', '); ?></li>
        <?php }?>      

        <?php if (isset($themeum_options['blog-date']) && $themeum_options['blog-date'] ) { ?>
            <li class="publish-date"><i class="fa fa-calendar-o"></i><time class="entry-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('M j,  Y'); ?></time></li>  
        <?php }?>   
  
        <?php if (isset($themeum_options['blog-tag']) && $themeum_options['blog-tag'] ) { ?>
            <li class="tag"> <?php the_tags('', ', ', '<br />'); ?> </li>
        <?php }?>

        <?php if (isset($themeum_options['blog-comment']) && $themeum_options['blog-comment'] ){ ?> 
        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
            <li class="comments-link">
              <i class="fa fa-comments-o"></i><?php comments_popup_link( '<span class="leave-reply">' . esc_html__( 'No comment', 'eventum' ) . '</span>', esc_html__( 'One comment', 'eventum' ), esc_html__( '% comments', 'eventum' ) ); ?>
            </li>
        <?php endif; //.comment-link ?>
        <?php } ?>

        <?php if (isset($themeum_options['blog-edit-en']) && $themeum_options['blog-edit-en']) { ?>
            <li class="edit-link">
                <i class="fa fa-edit"></i><?php edit_post_link( esc_html__( 'Edit', 'eventum' ), '<span class="edit-link">', '</span>' ); ?>
            </li>
        <?php } ?>
    </ul>
</div> <!--/.entry-meta -->

<div class="clearfix"></div>

<div class="entry-summary clearfix">
    <?php if ( is_single() ) {
        the_content();
    } else {
        echo the_excerpt_max_charlength(150);
        if ( isset($themeum_options['blog-continue-en']) && $themeum_options['blog-continue-en']==1 ) {
            if ( isset($themeum_options['blog-continue']) && $themeum_options['blog-continue'] ) {
                $continue = esc_html($themeum_options['blog-continue']);
                echo '<p class="wrap-btn-style"><a class="btn btn-style" href="'.get_permalink().'">'. $continue .'</a></p>';
            } else {
                echo '<p class="wrap-btn-style"><a class="btn btn-style" href="'.get_permalink().'">'. esc_html__( 'Continue Reading', 'eventum' ) .'</a></p>';
            } 
        }
 
    } 
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'eventum' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );

     if (isset($themeum_options['blog-social']) && $themeum_options['blog-social'] ){
        if(is_single()) {
            get_template_part( 'post-format/social-buttons' );
        }
    }?>
</div> <!-- //.entry-summary -->



