<?php get_header(); ?>

<!-- Start of page wrap -->
<div class="page_wrap">

    <?php 
    if ( has_post_thumbnail() ) {  ?>

    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

        <!-- Start of main image -->
        <div class="main_image" style="background:url('<?php echo ($image[0]); ?>') no-repeat scroll center center transparent; background-size:cover; height:684px; position:relative; z-index:1;">

    <?php }  else { ?>
            
    <?php if ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ) : ?>

    <?php $blogbgrnd = ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ); ?>

    <?php else : $blogbgrnd =  esc_url_raw( get_stylesheet_directory_uri() . '/img/default_image.jpg' ); ?>
            
    <?php endif; ?>

        <!-- Start of main image -->
        <div class="main_image" style="background: url('<?php echo $blogbgrnd; ?>') no-repeat scroll center center transparent; background-size:cover; height:684px; position:relative; z-index:1;">            
            
    <?php } ?>
        
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

            <h1 class="title"><?php the_title (); ?></h1>

        </div>
        <!-- End of main content title -->

    </div>
    <!-- End of main image -->

    <!-- Start of main content -->
    <div class="main_content">

        <!-- Start of left content -->
        <div class="left_content">

            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

                <!-- Start of post class -->
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php the_content('        '); ?>
                    
                    <?php if ( $numpages > '1' ) { ?>

                    <!-- Start of pagination -->
                    <div id="pagination2"> 

                      <!-- Start of pagination class -->
                      <div class="pagination2">
                        <?php wp_link_pages(); ?>

                      </div><!-- End of pagination class --> 

                    </div><!-- End of pagination -->

                    <?php } ?>

                    <!-- Start of blog meta data -->
                    <div class="blog_meta_data single">
                        
                        <hr class="short" />
                        
                        <div class="clear"></div>

                            <p class="lildarker"><?php _e( 'Published on', 'cr3_attend_theme' ); ?>&nbsp; <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo get_the_date(get_option('date_format')); ?></a>&nbsp;
                                <?php if (has_post_format('video')) { ?><?php $format = 'video'; ?>
                                <?php } elseif (has_post_format('audio')) { ?><?php $format = 'audio'; ?>
                                <?php } elseif (has_post_format('gallery')) { ?><?php $format = 'gallery'; ?>
                                <?php } elseif (has_post_format('quote')) { ?><?php $format = 'quote'; ?>
                                <?php } elseif (has_post_format('link')) { ?><?php $format = 'link'; ?>
                                <?php } else { ?><?php $format = 'standard'; ?><?php } ?>
                                <?php _e( 'in', 'cr3_attend_theme' ); ?>&nbsp;<?php the_category(', '); ?>&nbsp;
                               <?php _e( 'by', 'cr3_attend_theme' ); ?>&nbsp;<?php the_author_posts_link(); ?>
                            </p>

                            <p><?php _e( 'There are', 'cr3_attend_theme' ); ?>&nbsp; 
                                <?php if (get_comments_number()==1) { ?> 

                                    <?php comments_number('0', '1', '%' );?> <?php _e( 'Comment', 'cr3_attend_theme' ); ?>

                                    <?php } else { ?>

                                    <?php comments_number('0', '1', '%' );?> <?php _e( 'Comments', 'cr3_attend_theme' ); ?>

                                    <?php } ?>
                            </p>
                            
                            <p><?php _e( 'Tags for this post:', 'cr3_attend_theme' ); ?>&nbsp; 
                                
                                <?php the_tags('', ', ', ''); ?>
                            
                            </p>

                    </div>
                    <!-- End of blog meta data -->

                </div>
                <!-- End of post class -->

            <?php endwhile; ?>

            <?php else: ?>

            <p>
                <?php _e( 'There are no posts to display. Try using the search.', 'cr3_attend_theme' ); ?>
            </p>

            <?php endif; ?>

            <!-- Start of navigation wrapper -->
            <div class="navigation_wrapper"> 

                <?php
                $prev_link = get_next_post_link('%link');
                $next_link = get_previous_post_link('%link');
                ?>


              <!-- Start of alignleft -->
              <div class="alignleft">      

                  <?php if ($prev_link) { ?>

                  <h6 class="navigation"><?php _e( 'Previous Post', 'cr3_attend_theme' ); ?></h6>

                    <h6 class="navigation"><?php next_post_link('%link'); ?></h6>

                  <?php } ?>

              </div>
              <!-- End of alignleft --> 

              <!-- Start of alignright -->
              <div class="alignright">

                  <?php if ($next_link) { ?>

                  <h6 class="navigation"><?php _e( 'Next Post', 'cr3_attend_theme' ); ?></h6>

                    <h6 class="navigation"><?php previous_post_link('%link'); ?></h6>

                  <?php } ?>

              </div>
              <!-- End of alignright --> 

            </div>
            <!-- End of navigation wrapper --> 

            <?php if ('open' == $post->comment_status) { ?>

            <!-- Start of comment wrapper -->
            <div class="comment_wrapper">

                <!-- Start of comment wrapper main -->
                <div class="comment_wrapper_main">

                <?php comments_template(); ?>
                <?php comment_form(); ?>

                </div>
                <!-- End of comment wrapper main -->

                <div class="clear"></div>

            </div>
            <!-- End of comment wrapper -->

            <?php } ?>                 

        </div>
        <!-- End of left content -->

        <!-- Start of right content -->
        <div class="right_content">

            <?php get_sidebar( 'blog' ); ?>

        </div>
        <!-- End of right content -->

    </div>
    <!-- End of main content -->

<div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>