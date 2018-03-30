<?php
/**
 * @package Trizzy
 */

$format = get_post_format();
if( false === $format )  $format = 'standard'; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
<?php if ( ! post_password_required() ) { ?>
<?php
	if($format == 'standard') {
	 	if(has_post_thumbnail()) {
	 		$fullimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 		?>
	<figure class="post-img">
		<a href="<?php echo $fullimage[0]; ?>" class="mfp-image"><?php the_post_thumbnail();  ?>
			<div class="hover-icon"></div>
		</a>
	</figure>
	<?php }
	} // eof image
?>

<?php
	if($format == 'gallery') { ?>
	<?php
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
		              $image_title    = get_the_title( $imageid ); ?>
		        <a href="<?php echo $image[0]; ?>" class="mfp-gallery"  title="<?php echo esc_attr($image_title); ?>"><img class="rsImg" src="<?php echo $image[0]; ?>"  data-rsTmb="<?php echo $imageRSthumb[0] ?>" /></a>
		<?php } ?>
		</div>
		<?php
	} // eof gallery
?>

<?php
	if($format == 'quote') { ?>
	<?php
  $quote_content = get_post_meta($post->ID, '_format_quote_content', TRUE);
  $quote_source  = get_post_meta($post->ID, '_format_quote_source_url', TRUE);
  $quote_author  = get_post_meta($post->ID, '_format_quote_source_name', TRUE);
if(!empty($quote_content)) {?>
  <figure class="post-quote">
    <span class="icon"></span>
    <blockquote>
      <?php echo $quote_content; ?>
      <?php if(!empty($quote_source)) { ?><a href="<?php echo esc_url($quote_source); ?>"> <?php } ?>
        <span>- <?php echo $quote_author; ?></span>
      <?php if(!empty($quote_source)) { ?></a> <?php } ?>
    </blockquote>
  </figure>
<?php } ?>
	<?php
	} // eof gallery
?>

<?php
	if($format == 'video') {
	$video = get_post_meta($post->ID, '_format_video_embed', true);
	if(!empty($video)) {
		?>
		  <div class="embed">
		    <?php

		      if(wp_oembed_get($video)) { echo wp_oembed_get($video); } else { echo $video;}
		    ?>
		  </div>
	<?php
		}
	} // eof gallery
?>
<?php } // eof password protection  ?>

	<section class="date">
		<span class="day"><?php echo get_the_date( 'j' ); ?></span>
		<span class="month"><?php echo get_the_date( 'M' ); ?></span>
	</section>

	<section class="post-content">
		<header class="meta">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php trizzy_posted_on(); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'trizzy' ),
				'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->


		</section>
	</article><!-- #post-## -->
