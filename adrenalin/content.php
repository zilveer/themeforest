<?php
/**
 * @package commercegurus
 */
global $cg_options;
$cg_blog_images = '';
$cg_ismedium = '';
$cg_hasthumb = '';
$cg_isdefaultblog = '';

if ( isset( $cg_options['cg_blog_images'] ) ) {
    $cg_blog_images = $cg_options['cg_blog_images'];

    if ( isset( $_GET['blogimages'] ) ) {
        $cg_blog_images = $_GET['blogimages'];
    }

    if ( $cg_blog_images == 'left' || $cg_blog_images == 'right' ) {
        $cg_ismedium = 'blog-style medium-blog';
    } else {
        $cg_isdefaultblog = ' default-blog';
    }
} else {
    $cg_isdefaultblog = ' default-blog';    
}

if ( !has_post_thumbnail() ) {
    $cg_hasthumb = ' cg-has-no-thumb';
}
?>

<div class="row animate <?php echo $cg_ismedium . $cg_hasthumb . $cg_isdefaultblog; ?>" data-animate="fadeInDown">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
        if ( has_post_thumbnail() ) {
            if ( $cg_blog_images == 'left' ) {
                // left blog 
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="image">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                            <?php the_post_thumbnail(); ?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>   
                        <?php if ( 'post' == get_post_type() ) : ?>
                            <div class="entry-meta">
                                <?php cg_posted_on(); ?>
                            </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </header><!-- .entry-header -->
                    <!-- Displays the excerpt unless the post type is a Link or a Quote -->
                    <div class="entry-content">
                        <?php if ( has_post_format( 'link' ) ) : ?>
                            <?php the_content(); ?>
                        <?php elseif ( has_post_format( 'quote' ) ) : ?>
                            <?php the_content(); ?>
                        <?php else : ?>
                            <?php the_excerpt( __( 'Read more', 'commercegurus' ) ); ?>
                        <?php endif; ?>
                    </div><!-- .entry-content -->
                    <footer class="entry-meta">
                        <?php if ( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                            <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'commercegurus' ), __( '1 Comment', 'commercegurus' ), __( '% Comments', 'commercegurus' ) ); ?></span>
                        <?php endif; ?>
                        <?php edit_post_link( __( 'Edit', 'commercegurus' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta --> 
                </div>
                <?php
            } else if ( $cg_blog_images == 'right' ) {
                // right blog 
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>   
                        <?php if ( 'post' == get_post_type() ) : ?>
                            <div class="entry-meta">
                                <?php cg_posted_on(); ?>
                            </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </header><!-- .entry-header -->
                    <!-- Displays the excerpt unless the post type is a Link or a Quote -->
                    <div class="entry-content">
                        <?php if ( has_post_format( 'link' ) ) : ?>
                            <?php the_content(); ?>
                        <?php elseif ( has_post_format( 'quote' ) ) : ?>
                            <?php the_content(); ?>
                        <?php else : ?>
                            <?php the_excerpt( __( 'Read more', 'commercegurus' ) ); ?>
                        <?php endif; ?>
                    </div><!-- .entry-content -->
                    <footer class="entry-meta">
                        <?php if ( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                            <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'commercegurus' ), __( '1 Comment', 'commercegurus' ), __( '% Comments', 'commercegurus' ) ); ?></span>
                        <?php endif; ?>
                        <?php edit_post_link( __( 'Edit', 'commercegurus' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta --> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="image">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                            <?php the_post_thumbnail(); ?>
                        </a>
                    </div>
                </div>
                <?php
            } else {
                // default blog with images 
                ?>
                <div class="image">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                        <?php the_post_thumbnail(); ?>
                    </a>  
                </div>
                <header class="entry-header">
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>   
                    <?php if ( 'post' == get_post_type() ) : ?>
                        <div class="entry-meta">
                            <?php cg_posted_on(); ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>
                </header><!-- .entry-header -->
                <?php if ( is_search() ) { // Only display Excerpts for Search  ?>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->
                <?php } else { ?>
                    <div class="entry-content">
                        <?php
                        the_content( __( 'Read more', 'commercegurus' ) );
                        wp_link_pages( array(
                            'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'commercegurus' ) . '</span>',
                            'after' => '</div>',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                        ) );
                        ?>
                    </div><!-- .entry-content -->
                <?php } ?>
                <footer class="entry-meta">
                    <?php if ( 'post' == get_post_type() ) { // Hide category and tag text for pages on Search ?>
                        <?php
                        /* translators: used between list items, there is a space after the comma */
                        $categories_list = get_the_category_list( __( ', ', 'commercegurus' ) );
                        if ( $categories_list && cg_categorized_blog() ) {
                            ?>
                            <span class="cat-links">
                                <?php printf( __( 'Posted in %1$s', 'commercegurus' ), $categories_list ); ?>
                            </span>
                        <?php } // End if categories ?>

                        <?php
                        /* translators: used between list items, there is a space after the comma */
                        $tags_list = get_the_tag_list( '', __( ', ', 'commercegurus' ) );
                        if ( $tags_list ) {
                            ?>
                            <span class="tags-links">
                                <?php // printf( __( 'Tagged %1$s', 'commercegurus' ), $tags_list ); ?>
                            </span>
                        <?php } // End if $tags_list ?>
                    <?php } // End if 'post' == get_post_type()  ?>

                    <?php if ( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
                        <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'commercegurus' ), __( '1 Comment', 'commercegurus' ), __( '% Comments', 'commercegurus' ) ); ?></span>
                    <?php } ?>

                    <?php edit_post_link( __( 'Edit', 'commercegurus' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-meta --> 
                <?php
            }
            // close has_post_thumbnail, output for all other posts
        } else {
            // no thumbnail contents 
            ?>
            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>   
                <?php if ( 'post' == get_post_type() ) : ?>
                    <div class="entry-meta">
                        <?php cg_posted_on(); ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->
            <?php if ( is_search() ) { // Only display Excerpts for Search ?>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
            <?php } else { ?>
                <div class="entry-content">
                    <?php
                    the_content( __( 'Read more', 'commercegurus' ) );
                    wp_link_pages( array(
                        'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'commercegurus' ) . '</span>',
                        'after' => '</div>',
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                    ) );
                    ?>
                </div><!-- .entry-content -->
            <?php } ?>
            <footer class="entry-meta">
                <?php if ( 'post' == get_post_type() ) { // Hide category and tag text for pages on Search ?>
                    <?php
                    /* translators: used between list items, there is a space after the comma */
                    $categories_list = get_the_category_list( __( ', ', 'commercegurus' ) );
                    if ( $categories_list && cg_categorized_blog() ) {
                        ?>
                        <span class="cat-links">
                            <?php printf( __( 'Posted in %1$s', 'commercegurus' ), $categories_list ); ?>
                        </span>
                    <?php } // End if categories ?>

                    <?php
                    /* translators: used between list items, there is a space after the comma */
                    $tags_list = get_the_tag_list( '', __( ', ', 'commercegurus' ) );
                    if ( $tags_list ) {
                        ?>
                        <span class="tags-links">
                            <?php // printf( __( 'Tagged %1$s', 'commercegurus' ), $tags_list );  ?>
                        </span>
                    <?php } // End if $tags_list  ?>
                <?php } // End if 'post' == get_post_type() ?>

                <?php if ( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
                    <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'commercegurus' ), __( '1 Comment', 'commercegurus' ), __( '% Comments', 'commercegurus' ) ); ?></span>
                <?php } ?>

                <?php edit_post_link( __( 'Edit', 'commercegurus' ), '<span class="edit-link">', '</span>' ); ?>
            </footer><!-- .entry-meta -->   
            <?php
        }
        ?>
    </article><!-- #post-## -->
</div>