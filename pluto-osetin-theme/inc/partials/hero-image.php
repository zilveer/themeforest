<?php if(get_field('add_big_header_with_image')){
  $hero_image = get_field('image_to_use_for_header_background');
  if( !empty($hero_image) ): ?>

    <div class="page-hero-image" style="background-image: url( <?php echo $hero_image['url']; ?>);">
      <?php the_field('text_for_header_with_image'); ?>
    </div>

  <?php endif; ?>
<?php } ?>