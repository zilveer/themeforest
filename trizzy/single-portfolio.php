<?php
/**
* The main template file.
* @package WordPress
*/
$htype = ot_get_option('pp_header_menu');
get_header($htype);
?>

<!-- Titlebar
  ================================================== -->
<section class="titlebar">
  <div class="container">
    <div class="sixteen columns">
      <h2><?php the_title(); ?></h2>
      <nav id="breadcrumbs">
        <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
      </nav>
    </div>
  </div>
</section>
  <?php while (have_posts()) : the_post(); ?>
  <!-- Container -->
  <div class="container single-portfolio-container">
    <!-- Slider -->
    <?php   $layout =  get_post_meta($post->ID, 'pp_pf_layout', true);
    if($layout == 'half') { ?>
      <div class="eleven columns">
    <?php } else { ?>
      <div class="sixteen columns">
    <?php }
    $type  = get_post_meta($post->ID, 'pp_pf_type', true);
    if($type == 'video') {
      $videoembed = get_post_meta($post->ID, 'pp_pfvideo_embed', true);
      if($videoembed) {
        if($layout == 'half') {
          echo '<div class="video video-cont">'.$videoembed.'</div>';
        } else {
          echo '<div class="video video-cont">'.$videoembed.'</div>';
        }
      } else {
        global $wp_embed;
        $videolink = get_post_meta($post->ID, 'pp_pfvideo_link', true);

         if($layout == 'half') {
           $post_embed = $wp_embed->run_shortcode('[embed width="805" height="530"]'.$videolink.'[/embed]') ;
          echo '<div class="video video-cont">'.$post_embed.'</div>';
        } else {
           $post_embed = $wp_embed->run_shortcode('[embed width="1180"]'.$videolink.'[/embed]') ;
          echo '<div class="video video-cont">'.$post_embed.'</div>';
        }

      }
    } else {
      // Check what to display above post title (image,vide, slideshow)
      $ids = get_post_meta($post->ID, 'pp_gallery_slider', TRUE);
      $args = array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'post_mime_type' => 'image',
        'post__in' => explode( ",", $ids),
        'posts_per_page' => '-1',
        'orderby' => 'post__in'
      );

      $images_array = get_posts( $args );

      if ( $images_array ) {
        $slides = count($images_array);
        $captions = ot_get_option('pp_portfolio_caption');
      ?>
     <div class="slider-padding">
        <div id="basic-slider" class="basic-slider royalSlider rsDefault">
            <?php foreach( $images_array as $images ) : 
            setup_postdata($images);
              $attachment = wp_get_attachment_image_src($images->ID, 'full');
                if($layout == 'half') {
                  $thumb = wp_get_attachment_image_src($images->ID, 'portfolio-half');
                } else {
                  $thumb = wp_get_attachment_image_src($images->ID, 'portfolio-wide');
                }
            ?>
            
                <a href="<?php echo $attachment[0] ?>" class="<?php if($slides > 1){ echo 'mfp-gallery';  } else { echo 'mfp-image'; } ?>" title="<?php echo $images->post_title; ?>" >
                  <img src="<?php echo $thumb[0] ?>" alt="<?php echo $images->post_excerpt; ?>"  class="rsImg"/>
                  <?php if($captions == 'on' && !empty( $images->post_excerpt)) { ?><div class="slide-caption"><h3><?php echo $images->post_excerpt; ?></h3></div><?php } ?>
                </a>

            <?php endforeach;  ?>
         </div>
       <div class="clearfix"></div>
    </div>
    <?php
      } //eof if type
    wp_reset_query();
  } //eof if type ?>
  </div>
<!-- Slider / End -->

<?php if($layout == 'half') { ?>
  <div class="five columns">
    <div class="product-page">
     <?php the_content() ?>
  </div>
</div>
<?php } ?>
</div>
<!-- Container / End -->

<?php if($layout != 'half') { ?>
<!-- Container -->
<div class="container">
  <div class="sixteen columns">
    <?php the_content() ?>
  </div>
</div>
<!-- Container / End -->
<?php }
endwhile; // End the loop. Whew.  ?>

<?php  if(ot_get_option('pp_related_pf','on') == 'on') {
  $relateditems_array = get_post_meta($post->ID, 'pp_related_items', true);
  if(!empty($relateditems_array)) {
    $relateditems = implode(", ", array_keys($relateditems_array));
  } else {
    $relateditems = "";
  }
  ?>
<div class="container related">
  <div class="columns sixteen">


  <h3 class="headline margin-top-20"><?php echo ot_get_option('pp_recenttext_pf','Recent Work'); ?></h3>
  <span class="line margin-bottom-0" ></span>
  <?php

  if(ot_get_option('pp_samefilter_pf') == 'same') {
    $filters =  get_the_terms( $post->ID, 'filters');
    $exclusivefilters = '';
    foreach ($filters as $filter) {
      $exclusivefilters = $filter->slug.',';
    }
    echo do_shortcode( '[recent_work limit="4" filters="'.$exclusivefilters.'" exclude_posts="'.$id.'" place="none" include_posts="'.$relateditems.'" ][/recent_work]' );
  } else {
    echo do_shortcode( '[recent_work limit="4" exclude_posts="'.$id.'" place="none" include_posts="'.$relateditems.'"][/recent_work]' );
  }
  ?>
  </div>
</div>
<?php
}
get_footer();
?>