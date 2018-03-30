<?php
get_header();
global $bd_data;

/* Sidebar */
$post_full = '';
$post_po = '';
if(get_post_meta($post->ID, 'bd_full_width', true)){
    $post_full      = ' post_full_width';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'left'){
    $post_po        = ' post_sidebar_left';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'right'){
    $post_po        = ' post_sidebar_right';
}

/*
 * Article Sidebar Position
 */
$article_sidebar = '';
if( bdayh_get_option( 'article_sidebar_position', true ) == 'article_sidebar_position_right' )
{
    $article_sidebar    = 'article_sidebar_position_right';
}
elseif( bdayh_get_option( 'article_sidebar_position', true ) == 'article_sidebar_position_left' )
{
    $article_sidebar    = 'article_sidebar_position_left';
}
elseif( bdayh_get_option( 'article_sidebar_position', true ) == 'article_sidebar_position_full' )
{
    $article_sidebar    = 'article_sidebar_position_full';
}

$bd_criteria_display = get_post_meta(get_the_ID(), 'bd_criteria_display', true); ?>

    <div class="bd-container <?php echo $article_sidebar; echo $post_po; echo $post_full; ?>">
        <div class="bd-main">
            <div class="blog-v1">
                <?php
                    $format = get_post_format();
                    if( false === $format ) { $format = 'standard'; }
                    get_template_part( 'loop', $format );
                ?>

                <?php if($bd_data['post_pagination']): ?>
                    <nav class="post-navigation" role="navigation">
                        <div class="nav-links">
                            <?php
                            if ( is_attachment() ) :
                                previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'bd' ) );
                            else :
                                echo '<span class="post-nav-left">'; previous_post_link( '%link', __( '<span class="meta-nav"><i class="icon-chevron-left"></i> &nbsp; Previous Post</span>%title', 'bd' ) ); echo '</span>';
                                echo '<span class="post-nav-right">'; next_post_link( '%link', __( '<span class="meta-nav">Next Post &nbsp; <i class="icon-chevron-right"></i></span>%title', 'bd' ) ); echo '</span>';
                            endif;
                            ?>
                        </div><!-- .nav-links -->
                    </nav><!-- .navigation -->
                <?php endif; ?>

                <?php if($bd_data['post_author_box']): ?>
                    <div class="post-author-box bbox">
                        <div class="box-title"><h2><b><?php _e( 'About', 'bd' ) ?> <?php the_author_posts_link(); ?></b></h2></div>
                        <?php echo bd_author_box() ?>
                        <div class="clear"></div>
                    </div>
                <?php endif; ?>

                <?php bd_in ('related-posts'); // Get Related Posts ?>

                <?php
                if( bdayh_get_option('post_fb_comments_box') ):
                    // Get the current page url for FB comments
                    ?>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";  fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
                    <?php
                    $url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    echo '<div class="fb-comments" data-href="'. $url .'" data-num-posts="4" data-width="740"></div>' ."\n";
                endif;

                if($bd_data['post_comments_box']):
                    comments_template();
                endif;
                ?>

            </div><!-- .blog-v1-->

        </div><!-- .bd-main-->

        <?php get_sidebar(); ?>
    </div><!-- .bd-container -->

<?php
get_footer();