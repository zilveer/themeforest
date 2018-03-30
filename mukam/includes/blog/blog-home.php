    <?php
    if ( function_exists( 'get_option_tree') ) {
        $theme_options = get_option('option_tree');  
    }     
    $animy2 = $animy3 = ''; 
    $animy = get_option_tree('enable_load_animation', $theme_options);
    if ( $animy == 'Yes' ) {
      
      $animy2 = ' fadein scaleInv anim_2';
      $animy3 = ' fadein scaleInv anim_3'; 
    }
    $after = "";
    $itemcount = 1;  
    $queryy = new WP_Query( array( 'posts_per_page' => 3, 'post_type' => 'post', 'offset' => 0 ) ); ?>
    <div class="html_carousel<?php echo $animy2; ?>">
    <div id="foo3">
    <?php while ( $queryy->have_posts() ) : $queryy->the_post(); ?>
      <div class="slide">
      <?php if (has_post_thumbnail()) { 
          $thumb = get_post_thumbnail_id(); 
          $image = vt_resize( $thumb, '', 1919, 545, true );
          
      ?><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" /><?php } ?>
      <div class="slide-intro">

        <div class="container"><div class="row"><div class="span12">

        <div class="blog-date hidden-xs"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>

        <div class="slide-excerpt">
        <h4><?php the_title(); ?></h4>
        <p class="hidden-xs"><?php echo wp_trim_words( get_the_content(), 58, ' ' ) ?>...<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php echo __('Read More', 'mukam');?></a></p>
        </div>

        <div class="pull-left"><p class="blog-meta hidden-xs"><?php echo __('By', 'mukam');?>: <?php the_author_posts_link(); ?> | <?php echo __('Tags', 'mukam');?>: <?php the_tags( '', ', ', $after ); ?> | <?php echo __('Comments', 'mukam');?>: <a href="<?php comments_link(); ?>">
          <?php comments_number( __('0', 'mukam'), __('1', 'mukam'), __('%', 'mukam') ); ?></a></p>
        </div>

        </div></div></div>
      </div>
      </div>  

    <?php endwhile; ?>

    <?php wp_reset_query();?> 
    </div>
    <div class="clearfix"></div>
    <div class="nextprev">
                <a class="prev" href="#"><div class="slidebox"><i class="icon-angle-left"></i></div></a>
                <a class="next" href="#"><div class="slidebox"><i class="icon-angle-right"></i></div></a>
    </div>
    </div>

<!-- Blog Content Start --> 
    <div class="bg-color grey<?php echo $animy2;?>">
      <div class="container">
        <div class="row">
        <div class="col-sm-9 col-md-9 blog-wrapper">
          <div class="blog-style-1">
            <div class="blog-sizer"></div>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article class="blog-item <?php if ($itemcount % 2 == 0) { echo 'n2'; } $itemcount++; ?>">
              <div class="blog-thumbnail">
                <?php 
                  if ( has_post_format( 'video' )) {
                      mukam_video('453');?>
                      <div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
                      <div class="blog-type-logo"><div class="half-round"><i class="mukam-video"></i></div></div><?php
                  } 

                  else if ( has_post_format( 'audio' )) {
                      mukam_audio();
                      ?>
                      <div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
                      <div class="blog-type-logo"><div class="half-round"><i class="icon-music"></i></div></div><?php
                      if ($itemcount % 2 != 0) { $itemcount++; }
                  }

                  else if ( has_post_format( 'gallery' )) {
                      mukam_gallery($id);
                      ?>
                      <div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
                      <div class="blog-type-logo"><div class="half-round"><i class="mukam-image"></i></div></div><?php
                  }   
                  else if (has_post_thumbnail()) { 
                      $thumb = get_post_thumbnail_id(); 
                      $image = vt_resize( $thumb, '', 805, 503, true );
                      $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                      ?><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php echo get_the_title($att); ?>" />
                      <div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
                      <div class="blog-type-logo"><div class="half-round"><i class="mukam-image"></i></div></div>
                      <?php } 
                ?>
              </div>
              <div class="blog-content">
              <h4 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
              <p class="blog-meta"><?php echo __('By', 'mukam');?>: <?php the_author_posts_link(); ?> | <?php echo __('Tags', 'mukam');?>: <?php the_tags( '', ', ', $after ); ?> | <?php echo __('Comments', 'mukam');?>: <a href="<?php comments_link(); ?>">
          <?php comments_number( __('0', 'mukam'), __('1', 'mukam'), __('%', 'mukam') ); ?></a></p>
              <p><?php echo wp_trim_words( get_the_content(), 58, ' ' ) ?></p>
              <span class="buton b_inherit buton-2 buton-mini"><a href="<?php the_permalink(); ?>"><?php echo __('READ MORE', 'mukam');?></a></span>
              </div>
            </article>
            <?php endwhile; else: ?>
            <p><?php echo __('Sorry, no posts matched your criteria.', 'mukam');?></p>
            <?php endif; ?>
          <div class="clearfix"></div>  
          </div>
          
          <div class="pagination-container">
          <?php mukam_pagination();
          ?></div>  
        </div>

    <?php get_sidebar() ?>

    </div>
  </div>
  </div>