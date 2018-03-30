<!-- Post #1 -->
<div class="one-third column masonry-item">
  <article id="post-<?php the_ID(); ?>" <?php post_class('from-the-blog'); ?>>
<?php
if ( ! post_password_required() ) {
$gallery = get_post_meta($post->ID, '_format_gallery', TRUE);
preg_match( '/ids=\'(.*?)\'/', $gallery, $matches );

  if ( isset( $matches[1] ) ) {
    // Found the IDs in the shortcode
    $ids = explode( ',', $matches[1] );
  } else {
    // The string is only IDs
    $ids = ! empty( $gallery ) && $gallery != '' ? explode( ',', $gallery ) : array();
  }
  echo '<div class="basic-slider royalSlider rsDefault">';
  foreach ($ids as $imageid) { ?>

      <?php   $image_link = wp_get_attachment_url( $imageid );
              if ( ! $image_link )
                 continue;
              $image          = wp_get_attachment_image_src( $imageid, 'large');
              $imageRSthumb   = wp_get_attachment_image_src( $imageid, 'shop-small-thumb' );
              $image_title    = esc_attr( get_the_title( $imageid ) ); ?>
        <a href="<?php echo $image[0]; ?>" class="mfp-gallery"  title="<?php echo $image_title?>"><img class="rsImg" src="<?php echo $image[0]; ?>"  data-rsTmb="<?php echo $imageRSthumb[0] ?>" /></a>
      <?php ?>

  <?php } ?>
</div>
<?php } //eof password protection ?>
  <section class="from-the-blog-content">
    <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
    <i>
    <?php 
    $metas = ot_get_option('pp_meta_blog',array());
    if (in_array("author", $metas)) { 
      echo __('By','trizzy'). ' <a class="author-link" itemprop="url" rel="author" href="'.get_author_posts_url(get_the_author_meta('ID' )).'">'; the_author_meta('display_name'); echo'</a>'; echo ' '; 
    }
    if (in_array("date", $metas)) {
      _e('on','trizzy');  echo ' '; echo get_the_date();
    } ?>
    </i>
    <span>
      <?php
        $excerpt = get_the_excerpt();
        $limit = ot_get_option('pp_masonry_excerpt',20);
        $short_excerpt = string_limit_words($excerpt,$limit);
        echo $short_excerpt.'..';
      ?>
    </span>
    <a href="<?php the_permalink(); ?>" class="button gray"><?php _e('Read More','trizzy') ?></a>
  </section>

</article>
</div>




