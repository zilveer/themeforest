<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
    <?php } //eof for each?>
   </div>
<?php } //eof password protected ?>
  <section class="date">
    <span class="day"><?php echo get_the_date( 'j' ); ?></span>
    <span class="month"><?php echo get_the_date( 'M' ); ?></span>
  </section>

  <section class="post-content">

    <header class="meta">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
     <?php trizzy_posted_on(); ?>
    </header>

    <?php the_excerpt(); ?>

    <a href="<?php the_permalink(); ?>" class="button color"><?php _e('Read More','trizzy') ?></a>

  </section>

</article>




