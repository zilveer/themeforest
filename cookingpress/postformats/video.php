

<!-- Post -->
<?php $format = get_post_format();
if( false === $format ) { $format = 'standard'; } ?>

<article  <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" >


  <?php printf( '<a href="%1$s" class="published-time" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',get_permalink(),esc_attr( get_the_time() ),get_the_date()); ?>
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'cookingpress'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php
  if (( function_exists( 'get_post_format' ) && 'video' == get_post_format( $post->ID ) )  ) {
    global $wp_embed;
    $videoembed = get_post_meta($post->ID, 'pp_video_embed', true);
    if($videoembed) {
      echo '<section class="video">'.$videoembed.'</section>';
    } else {
      $videolink = get_post_meta($post->ID, 'pp_video_link', true);
      $post_embed = $wp_embed->run_shortcode('[embed  width="355" ]'.$videolink.'[/embed]') ;
      echo '<section class="video">'.$post_embed.'</section>';
    }
  }
  ?>

  <footer>
    <?php  cookingpress_posted_on(); ?>
  </footer>
</article>






