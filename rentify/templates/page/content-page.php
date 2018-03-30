

<article <?php post_class( 'blog-post-content page-content'); ?> id="post-<?php the_ID(); ?>" >
              <?php 
              if ( has_post_thumbnail() ) {
                $image_id     = get_post_thumbnail_id( get_the_ID() );
                $large_image  = wp_get_attachment_url( $image_id ,'full');  
                $resize     = sb_aq_resize( $large_image, true );
               ?>
              <img class="thumb" src= "<?php echo esc_url($resize); ?>" alt="">

                <div class="meta">
                   <span class="time-ago"><a href = "<?php the_permalink(); ?>" ><i class="fa fa-clock-o"></i> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></a></span>
                  <span class="category">
                  <?php if(has_category()): ?>
                    
                      <i class="fa fa-sitemap"></i>
                      <?php the_category('&nbsp;,&nbsp;'); ?>
                    
                  <?php endif; ?>
                  </span>
                  <span class="author">
                    <i class="fa fa-user"></i>
                    <?php the_author_posts_link(); ?>
                  </span>
                  <span class="comments">
                    <i class="fa fa-comments"></i>
                    <?php 
                      if(comments_open() && !post_password_required()){
                        comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
                      }
                    ?>            
                  </span>
                </div>

                <h4> <?php the_title(); ?> </h4>
                <?php the_content(); ?> 
        


              <?php  } else { ?>

                      <div class="meta">
                         <span class="time-ago"><a href = "<?php the_permalink(); ?>" ><i class="fa fa-clock-o"></i> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></a></span>
                        <span class="category">
                        <?php if(has_category()): ?>
                          
                            <i class="fa fa-sitemap"></i>
                            <?php the_category('&nbsp;,&nbsp;'); ?>
                          
                        <?php endif; ?>
                        </span>
                        <span class="author">
                          <i class="fa fa-user"></i>
                          <?php the_author_posts_link(); ?>
                        </span>
                        <span class="comments">
                          <i class="fa fa-comments"></i>
                          <?php 
                            if(comments_open() && !post_password_required()){
                              comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
                            }
                          ?>            
                        </span>
                      </div>
          <h4> <?php the_title(); ?> </h4>
         <?php the_content(); ?> 
        
      <?php } ?>
    

    </article>