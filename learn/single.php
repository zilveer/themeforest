<?php

get_header();

 $link_audio = get_post_meta(get_the_ID(),'_cmb_link_audio', true);
 $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true);
?>

<section id="main_content">

    <div class="container">

        <?php learn_breadcrumbs(); ?>

        <div class="row">

            <aside class="col-md-4">
                <?php get_sidebar();?>
            </aside>

            <?php while (have_posts()) : the_post(); ?>
            <div class="col-md-8">
              <div class="post single-post">
                
                <?php $format = get_post_format(); ?>
                <?php if($format=='video') { ?>

                <iframe src="<?php echo esc_url( $link_video ); ?>"></iframe>

                <?php }elseif($format=='audio') {?>

                <iframe style="width:100%" src="<?php echo esc_url($link_audio); ?>"></iframe>

                <?php }elseif($format=='gallery'){ ?>
                  <?php
                    if ( function_exists('rwmb_meta') ) { 
                  ?>  
                  <?php $images = rwmb_meta( '_cmb_images', "type=image" ); ?>
                  <?php if($images){ ?>
                    <div class="owl-carousel owl-theme owl-post">
                      <?php                                                        
                        foreach ( $images as $image ) {                              
                      ?>
                      <?php $img = $image['full_url']; ?>
                        <div><img src="<?php echo esc_url($img); ?>" alt=""></div> 
                      <?php } ?>                   
                    </div>
                  <?php } ?>
                <?php } ?>
  
                <?php }elseif($format=='image'){ ?>
                  <?php
                    if ( function_exists('rwmb_meta') ) { 
                  ?>
                    <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
                    <?php if($images){ ?>
                    <?php                                                        
                      foreach ( $images as $image ) {                              
                      ?>
                      <?php $img = $image['full_url']; ?>
                      <img src="<?php echo esc_url($img); ?>" alt="">
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>

                <?php }else{ ?>
                  <?php if(has_post_thumbnail()) { ?><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" /><?php } ?>
                <?php } ?>

                <div class="post_info clearfix">
                  <div class="post-left">
                    <ul>
                      <li><i class="icon-calendar-empty"></i><?php esc_html_e('On','learn'); ?> <span><?php the_time( get_option( 'date_format' ) ); ?></span></li>
                      <li><i class="icon-user"></i><?php esc_html_e('By','learn'); ?> <?php the_author_posts_link(); ?></li>
                      <?php if(has_tag()) { ?><li><i class="icon-tags"></i><?php esc_html_e('Tags','learn'); ?> <?php the_tags(' '); ?></li><?php } ?>
                    </ul>
                  </div>
                  <div class="post-right"><i class="icon-comment"></i><?php comments_number( '0 '.esc_html__("comment","learn"), '1 '.esc_html__("comment","learn"), '% '.esc_html__("comments","learn") ); ?></div>
                </div>

                <h2><?php the_title(); ?></h2>

                <?php the_content(); ?>

                <?php
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'learn' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'learn' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                ?>

              </div>
          
              <?php 
                the_post_navigation( array(
                  'next_text' => '<span aria-hidden="true">' . esc_html__( 'Next Post', 'learn' ) . '</span> ' .
                    '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'learn' ) . '</span> ',
                  'prev_text' => '<span aria-hidden="true">' . esc_html__( 'Previous Post', 'learn' ) . '</span> ' .
                    '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'learn' ) . '</span> ',
                ) ); 
              ?>

              <hr>

              <h4><?php comments_number( '0 '.esc_html__("comment","learn"), '1 '.esc_html__("comment","learn"), '% '.esc_html__("comments","learn") ); ?></h4>

              <?php
               if ( comments_open() || get_comments_number() ) :
                comments_template();
               endif;
              ?>

            </div>
            <?php endwhile;?>

        </div>

    </div>

</section>

<?php get_footer(); ?>	





  