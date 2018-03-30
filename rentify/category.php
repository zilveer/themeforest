
<?php get_header(); ?>


  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <?php if (have_posts()) : ?>

                    <h1><?php printf( esc_html__( 'Category Archives: %s', 'rentify' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

                    <?php if ( category_description() ) : // Show an optional category description ?>
                        <div><?php echo esc_attr(category_description()); ?></div><br>
                    <?php endif; ?>

                  <?php while ( have_posts() ) : the_post(); ?>
                    <article <?php post_class( 'uou-block-7f blog-post-content'); ?> id="post-<?php the_ID(); ?>" >
                      <?php 
                      if ( has_post_thumbnail() ) {
                        $image_id =  get_post_thumbnail_id( get_the_ID() );
                        $large_image = wp_get_attachment_url( $image_id ,'full');  
                        $resize = sb_aq_resize( $large_image, true );
                       ?>
                      <img src="<?php echo esc_url($resize); ?>" alt="">
                      <?php } ?>


                      <div class="meta">
                         <span class="time-ago"> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></span>
                        <?php if(has_category()): ?>
                          <span class="category">
                            <?php the_category('&nbsp;,&nbsp;'); ?>
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

                     <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h1>
                      <p> <?php the_content(); ?> </p> 

                      <?php endwhile; else : ?>
                        <?php esc_html_e('No post have found!', 'rentify'); ?> 
                      <?php endif; ?>
            </article>


            <!--  start pagination * -->
              <?php if (function_exists("rentify_pagination")) {
                rentify_pagination();
            } ?>
            <!--  End of pagination * -->

            </div> <!-- end .blog-list -->


<!-- ************************** Start Sidebar **************************** -->


            <div class="col-md-3">
              <div class="uou-sidebar pt40">

            <?php if ( is_active_sidebar( 'mainsidebar' ) ) : ?>
                  
              <?php dynamic_sidebar( 'mainsidebar' ); ?>
                  
            <?php else : ?>
              <div class="alert alert-message">
              
                <p><?php esc_html_e("Please activate some Widgets","rentify"); ?></p>
              
                </div>

            <?php endif; ?>

             </div>
            </div>

<!-- ************************** End Sidebar **************************** -->

      </div> 
    </div>
  </div> <!-- end .page-content -->



<?php get_footer(); ?>