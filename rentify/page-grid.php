<?php

/**
 * Template Name: Simple Builder Grid Blog with sidebar
 *
 * @package WordPress
 * @subpackage simple builder
 * @since 1.0
 */

get_header(); ?>
                
  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">


    <article <?php post_class( 'uou-block-7f'); ?> id="post-<?php the_ID(); ?>" >
              <?php 
              if ( has_post_thumbnail() ) {
                $image_id     = get_post_thumbnail_id( get_the_ID() );
                $large_image  = wp_get_attachment_url( $image_id ,'full');  
                $resize     = sb_aq_resize( $large_image, true );
               ?>
            <img class="thumb" src= "<?php echo esc_url($resize); ?>" alt="">

          <div class="meta">
            <span class="time-ago"> <?php echo eesc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></span>
                  <?php if(has_category()): ?>
                          <span class="category">
                            Posted in: <?php the_category('&nbsp;,&nbsp;'); ?>
                          </span>
                      <?php endif; ?>

                        <span class="comments">
                          <?php 
                            if(comments_open() && !post_password_required()){
                              comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
                            }
                          ?>            
                        </span>
          </div>

          <h1><a href= "<?php the_permalink(); ?>" > <?php the_title(); ?></a></h1>
        <p> <?php the_excerpt(); ?> </p>
        <a href="<?php the_permalink(); ?>" class="btn btn-small btn-primary">Read More</a>


      <?php  } else { ?>

          <div class="meta">
              <span class="time-ago"><?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></span>
                  <?php if(has_category()): ?>
                          <span class="category">
                            Posted in: <?php the_category('&nbsp;,&nbsp;'); ?>
                          </span>
                      <?php endif; ?>
                        <span class="comments">
                          <?php 
                            if(comments_open() && !post_password_required()){
                              comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
                            }
                          ?>            
                        </span>
          </div>
          <h1><a href= "<?php the_permalink(); ?>" > <?php the_title(); ?></a></h1>
        <p> <?php the_excerpt(); ?> </p>
        <a href="<?php the_permalink(); ?> " class="btn btn-small btn-primary">Read More</a>
      <?php } ?>
    

    </article>


            </div><!-- /.blog-main -->

<!-- ************************** Start Sidebar **************************** -->

<!--  Start Sidebar ** -->

         <!-- SIDEBAR : begin -->  

            <div class="col-md-3">
              <div class="uou-sidebar pt40">

            <?php if ( is_active_sidebar( 'mainsidebar' ) ) : ?>
                  
              <?php dynamic_sidebar( 'mainsidebar' ); ?>
                  
            <?php else : ?>
              <div class="alert alert-message">
              
                <p><?php _e("Please activate some Widgets","rentify"); ?></p>
              
                </div>

            <?php endif; ?>

             </div>
            </div>
            
          <!-- SIDEBAR : end -->



<!-- ************************** End Sidebar **************************** -->

        </div><!-- /.row -->
    </div> <!-- /.container -->
  </div>





<?php get_footer(); ?>


