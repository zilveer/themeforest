<?php
/**
 * ImageSlider shortcode template
 */
?>
<div class="mkd-image-slider <?php echo esc_html($slider_classes) ?>">
  <div class="flexslider">
    <ul class="slides">
      <?php foreach ($images as $image) { ?>
        <li data-thumb="<?php echo esc_url($image['thumb'])?>"> 
          <img src="<?php echo esc_url($image['url']);?>" alt="">
          <?php if((($image['title'] != '' || $image['caption'] != '' ) && ($slider_classes != '')) || (( $image['caption'] != '' ) && ($slider_classes == '')) ){ ?> 
            <!-- render caption holder if the content is not empty -->
            <div class="mkd-caption-holder">
              <?php if($slider_classes != '') { ?>
                <span class="flex-caption"><?php echo esc_html($image['title']); ?></span>
              <?php } ?>
                <p class="flex-caption"><?php echo esc_html($image['caption']); ?></p>
            </div>
          <?php } ?>
        </li>
       <?php } ?>
    </ul>
  </div>
  <?php if($slider_classes == '') { ?>
    <div class="mkd-slider-navigation">
      <a href="#" class="flex-prev"><span aria-hidden="true" class="arrow_carrot-left"></span></a>
      <a href="#" class="flex-next"><span aria-hidden="true" class="arrow_carrot-right"></span></a>
    </div>
  <?php } ?>
</div>
