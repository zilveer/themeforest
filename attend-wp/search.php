<?php get_header(); ?>

<!-- Start of page wrap -->
<div class="page_wrap">
            
    <?php if ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ) : ?>

    <?php $blogbgrnd = ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ); ?>

    <?php else : $blogbgrnd =  esc_url_raw( get_stylesheet_directory_uri() . '/img/default_image.jpg' ); ?>
            
    <?php endif; ?>
            
        <!-- Start of main image -->
        <div class="main_image" style="background: url('<?php echo $blogbgrnd; ?>') no-repeat scroll center center transparent; background-size:cover; height:684px; position:relative; z-index:1;">
        
        <!-- Start of button holder -->
        <div class="button_holder">
        <?php $topurl = ( get_theme_mod( 'cr3ativ_conference_url' ) ); ?>
            <?php $topurltext = ( get_theme_mod( 'cr3ativ_conference_url_text' ) ); ?>

            <?php if ($topurl != ('')){ ?>           

            <!-- Start of top of page button -->
            <div class="top_of_page_button">

                <a href="<?php echo ($topurl); ?>"><?php echo ($topurltext); ?></a>

            </div>
            <!-- End of top of page button -->

            <?php } ?>
        </div>
        <!-- End of button holder -->

        <!-- Start of main content title -->
        <div class="main_content_title">

            <h1 class="title"><?php _e( 'Results For ', 'cr3_attend_theme' ); ?>"<?php echo get_search_query(); ?>"</h1>

        </div>
        <!-- End of main content title -->

    </div>
    <!-- End of main image -->

    <!-- Start of main content -->
    <div class="main_content">

        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        
            <?php if (has_post_format('quote')) { ?>
        
            <!-- Start of post class -->
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!-- Start of blog meta data -->
                <div class="blog_meta_data">

                    <hr />

                    <!-- Start of metadate -->
                    <div class="metadate">

                        <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo get_the_date(get_option('date_format')); ?></a>

                    </div>
                    <!-- End of metadate -->

                </div>
                <!-- End of blog meta data -->

                <!-- Start of blog content -->
                <div class="blog_content">

                    <blockquote><?php the_content(); ?></blockquote>

                    <h1 class="quote_title"><?php the_title(); ?></h1>

                </div>
                <!-- End of blog content -->

            </div>
            <!-- End of post class -->
                
            <?php } elseif (has_post_format('link')) { ?>
        
            <!-- Start of post class -->
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!-- Start of blog meta data -->
                <div class="blog_meta_data">

                    <hr />

                    <!-- Start of metadate -->
                    <div class="metadate">

                        <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo get_the_date(get_option('date_format')); ?></a>

                    </div>
                    <!-- End of metadate -->

                </div>
                <!-- End of blog meta data -->

                <!-- Start of blog content -->
                <div class="blog_content">

                    <h1 class="link_title"><?php the_title(); ?></h1>

                        <!-- Start of linkpostcontent -->
                        <div class="linkpostcontent">

                            <?php the_content('        '); ?>

                        </div>
                        <!-- End of linkpostcontent -->

                </div>
                <!-- End of blog content -->

            </div>
            <!-- End of post class -->
                
            <?php } else { ?>  
                
            <!-- Start of post class -->
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!-- Start of featured image wrapper -->
                <div class="featured_image_wrapper">

                    <?php if ( has_post_thumbnail() ) { ?>

                    <a href="<?php the_permalink (); ?>"><?php the_post_thumbnail(''); ?></a>

                    <?php } ?>

                </div>
                <!-- End of featured image wrapper -->

                <!-- Start of blog meta data -->
                <div class="blog_meta_data">

                    <hr />

                    <h1 class="blog_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                    <!-- Start of metadate -->
                    <div class="metadate">

                        <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo get_the_date(get_option('date_format')); ?></a>

                    </div>
                    <!-- End of metadate -->

                    <!-- Start of metaauthor -->
                    <div class="metaauthor">

                        <?php the_author_posts_link(); ?>

                    </div>
                    <!-- End of metaauthor -->

                    <!-- Start of metacats -->
                    <div class="metacats">

                        <?php the_category(' '); ?>

                    </div>
                    <!-- End of metacats -->

                    <?php if ('open' == $post->comment_status) { ?>

                    <!-- Start of metacomments -->
                    <div class="metacomments">

                        <?php
                        if (get_comments_number()==1) { ?>

                        <a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?>&nbsp;
                        <?php _e( 'comment', 'cr3_attend_theme' ); ?></a>

                        <?php } else { ?>

                        <a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?>&nbsp;
                        <?php _e( 'comments', 'cr3_attend_theme' ); ?></a>

                        <?php } ?>

                    </div>
                    <!-- End of metacomments -->

                    <?php } ?>

                </div>
                <!-- End of blog meta data -->

                <!-- Start of blog content -->
                <div class="blog_content">

                    <?php the_excerpt (); ?>

                    <!-- Start of read more link -->
                    <div class="read_more_link">

                        <a href="<?php the_permalink(); ?>"><?php _e( 'More', 'cr3_attend_theme' ); ?></a>

                    </div>
                    <!-- End of read more link -->

                </div>
                <!-- End of blog content -->

                <div class="clear"></div>

            </div>
            <!-- End of post class -->
        
            <?php } ?>

        <?php endwhile; ?>

        <?php else: ?>

        <p>
            <?php _e( 'There are no posts to display. Try using the search.', 'cr3_attend_theme' ); ?>
        </p>

        <?php endif; ?>

        <?php
        $prev_link = get_previous_posts_link(__('Newer', 'cr3_attend_theme'));
        $next_link = get_next_posts_link(__('Older', 'cr3_attend_theme'));
        ?>

        <!-- Start of pagination -->
        <div id="pagination">

            <?php 
            if ($prev_link && $next_link) {
              if ($prev_link){
                echo '<div class="paginationprev">'.$prev_link .'</div>';
              }
              if ($next_link){
                echo '<div class="paginationnext">'.$next_link .'</div>';
              }
            } else if ($next_link) {
                echo '<div class="paginationnext">'.$next_link .'</div>';
            } else if ($prev_link) {
                echo '<div class="paginationprev">'.$prev_link .'</div>';
            }
            ?>

            <div class="clearfix"></div>    

        </div>
        <!-- End of pagination -->    

    </div>
    <!-- End of main content -->

    <div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>
