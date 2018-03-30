<?php get_header(); ?>

<?php get_template_part( 'template-part-page-slider', 'childtheme' ); ?>

<section id="content-container" class="clearfix">
    <div id="main-wrap" class="main-wrap-slider clearfix">
        <div class="page_content blog_page_content">
            <?php
                get_template_part( 'template-part-breadcrumbs', 'childtheme' );
                global $ttso;
                $blogbutton        = $ttso->st_blogbutton;
                $blogauthor        = $ttso->st_blogauthor;
                $posted_by         = $ttso->st_posted_by;
				$posted_categories = $ttso->st_posted_categories;

                if ( have_posts() ) : while ( have_posts() ) : the_post();
                    // Retrieve all post meta of posts in the loop.
                    $linkpost             = get_post_meta( get_the_ID(), '_jcycle_url_value', true );
                    $external_image_url   = get_post_meta( get_the_ID(), 'truethemes_external_image_url',true );
                    $video_url            = get_post_meta( get_the_ID(), 'truethemes_video_url', true );
                    $permalink            = get_permalink( get_the_ID() );

                    // Prepare to get image for cropping.
                    $thumb         = get_post_thumbnail_id();
                    $image_width   = 620;
                    $image_height  = 161;

                    // Use truethemes image cropping script
                    $image_src     = truethemes_crop_image( absint( $thumb ), esc_url( $external_image_url ), absint( $image_width ), absint( $image_height ) );
                    ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <article class="preview blog-main-preview">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

                            <?php
                                if ( 'true' == $posted_by ) { ?>
                                    <span class="metadata postinfo">
                                        <?php _e( 'Posted by ', 'tt_theme_framework' );?>  <span class="vcard author"><?php the_author_posts_link(); ?></span> <?php _e( ' on ', 'tt_theme_framework' ); ?> <span class="date updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
                                    </span>
                            <?php }

                            // Function to generate internal image, external image or video.
                            echo truethemes_generate_blog_image( esc_url( $image_src ), absint( $image_width ), absint( $image_height ), $blog_image_frame, esc_url( $linkpost ), esc_url( $permalink ), esc_url( $video_url ) );

                            the_content();
                            get_template_part( 'template-part-social-share', 'childtheme' );
                            get_template_part( 'template-part-inline-editing', 'childtheme' ); ?>

                            <div class="post-details">
                                <p class="post-tags"><?php the_tags(); ?></p>
                               
                        <?php if ( empty($posted_categories) || $posted_categories == 'true') { ?>
                            <p class="post-categories"><strong><?php _e( 'Posted in:', 'tt_theme_framework' ); ?></strong> 
							<?php the_category( ', ' ); ?></p>
						<?php } ?>
                            
                            <a class="post-leave-comment"<?php if ( 'false' == $posted_categories ) { echo ' style="float:left;"';}?>href="<?php echo get_permalink() . '#respond'; ?>"><?php _e( 'Leave a Comment', 'tt_theme_framework' ); ?> (<?php comments_number( '0', '1', '%' ); ?>) &darr;</a>
                            </div><!-- end .post-details -->
                        </article><!-- end .blog-main-preview -->
                    </div><!-- end #post-ID -->

				<?php if($ttso->st_blog_related_posts == 'true'): ?>
                <div class="tt-sterling-related-posts">
                    <p class="tt-comment-count"><?php _e( 'Related Posts' , 'tt_theme_framework' ); ?></p>
                    <?php truethemes_related_posts(); ?>
                </div><!-- END .tt-sterling-related-posts -->
                <?php endif; ?>


                    <?php
                        $show_post_comments = esc_attr( $ttso->st_post_comments );
                        if ( 'false' != $show_post_comments )
                            comments_template( '', true );
                        wp_link_pages();
                endwhile; else: ?>
                    <h2><?php _e( 'Nothing Found' , 'tt_theme_framework' ); ?></h2>
                    <p><?php _e( 'Sorry, it appears there is no content in this section.' , 'tt_theme_framework' ); ?></p>
                <?php endif; ?>

            <?php
                if ( function_exists( 'wp_pagenavi' ) )
                    wp_pagenavi();
                else
                    paginate_links();
            ?>
        </div><!-- end .page_content -->

        <aside class="sidebar">
            <?php dynamic_sidebar( 'Blog Sidebar' ); ?>
        </aside>
    </div><!-- end #main-wrap -->
<?php get_footer(); ?>