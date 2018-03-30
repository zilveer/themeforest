  <!-- Post -->
  <?php $format = get_post_format();
  if( false === $format )  $format = 'standard'; ?>
  <article class="post row" id="post-<?php the_ID(); ?>" >

    <?php
    $ids = get_post_meta($post->ID, 'pp_gallery_slider', TRUE);
    $args = array(
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'post_mime_type' => 'image',
      'post__in' => explode( ",", $ids),
      'posts_per_page' => '-1',
      'orderby' => 'post__in'
      );

    $thumb_status = get_post_meta($post->ID, 'pp_thumb_status', TRUE);
    if(empty($thumb_status)) { $thumb_status = array(); }

    $images_array = get_posts( $args );
    if ( $images_array && !in_array("hide_blog", $thumb_status)) { ?>
    <figure class="post-img flexslider">
      <ul class="slides mediaholder">
        <?php foreach( $images_array as $images ) : setup_postdata($images); ?>
        <!-- 960 Container -->
        <?php
          $attachment = wp_get_attachment_image_src($images->ID, 'full');
          $thumb = wp_get_attachment_image_src($images->ID, 'slider-big');
        ?>
        <li>
            <img src="<?php echo $thumb[0] ?>" alt="<?php echo $images->post_title; ?>" />
        </li>
      <?php endforeach;  ?>
    </ul>
  </figure>
  <!-- End 960 Container -->
  <?php   } // ?>
  <?php printf( '<a href="%1$s" class="published-time" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',get_permalink(),esc_attr( get_the_time() ),get_the_date()); ?>
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'cookingpress'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

  <footer>
    <?php  cookingpress_posted_on(); ?>
  </footer>

</article>

