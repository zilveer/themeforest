<?php get_header(); 

  $month = get_the_date('M');
  $day = get_the_date('j');

?>

	<div id="page-content">
    <div class="container">
      <div class="page-content bl-list">
        <div class="row">
          <div class="col-md-8">
            <div class="blog-list blog-post shortcodes">

                <?php
                  while ( have_posts() ) : the_post();
                ?>

                  <div id="ID-<?php the_ID(); ?>" <?php post_class('post-without-image'); ?>>

                    <div class="date-month">
                      <a href="<?php the_permalink(); ?>">
                        <span class="date"><?php echo esc_attr($day); ?></span>
                        <span class="month"><?php echo esc_attr($month); ?></span>
                      </a>
                    </div>

                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                    <p class="user">
                      <span class="author"><i class="fa fa-pencil-square-o"></i>
                        <?php

                          if (current_user_can('edit_post', $post->ID)) {
                            edit_post_link(esc_html__('Edit This', 'rentify'), '');
                          }
                        ?>
                      </span>
                      <span class="author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
                      <span class="category"><i class="fa fa-folder-open-o"></i><?php the_category(',&nbsp; '); ?></span>
                      <?php if (comments_open() && !post_password_required()) { ?>
                      <span class="comment"><i class="fa fa-comments-o"></i> <?php comments_popup_link('0 Comments', '1 Comment', '% Comments', ''); ?></span>
                      <?php } ?>
                    </p>

                    <div class="entry-content">

                      <div class="entry-attachment">
                        <?php
                          echo wp_get_attachment_image( get_the_ID(), 'full' );
                        ?>
                        <div class="clearfix"></div>
                        <?php if ( has_excerpt() ) : ?>
                          <div class="entry-caption">
                            <?php the_excerpt(); ?>
                          </div><!-- .entry-caption -->
                        <?php endif; ?>

                      </div><!-- .entry-attachment -->

                      <?php
                        the_content();
                        wp_link_pages( array(
                          'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'rentify' ) . '</span>',
                          'after'       => '</div>',
                          'link_before' => '<span>',
                          'link_after'  => '</span>',
                          'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'rentify' ) . ' </span>%',
                          'separator'   => '<span class="screen-reader-text">, </span>',
                        ) );
                      ?>
                    </div><!-- .entry-content -->

                    <div class="e-pagination">
                        <p class="prev_post"><?php previous_image_link('%link','<i class="fa fa-chevron-left"></i> Previous Post'); ?></p>
                        <p class="next_post"><?php next_image_link( '%link','Next Post <i class="fa fa-chevron-right"></i>' ); ?></p>
                      <br>
                    </div>

                  </div><!--IDst-## -->

                  <div class="clearfix"></div>
                    <div class="comments-section">

                      <?php
                      if ( comments_open() || get_comments_number() ) :
                        comments_template();
                      endif;
                      ?>

                    </div>

                    <?php
                  endwhile;
                ?>

            </div> <!-- end .blog-list -->

          </div> <!-- end .grid-layout -->

        </div> <!-- end .row -->
      </div> <!-- end .page-content -->
    </div> <!-- end .container -->

  </div> <!-- end #page-content -->

<?php get_footer(); ?>

