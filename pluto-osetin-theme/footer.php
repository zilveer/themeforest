<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package Pluto
 * @since Pluto 1.0
 */
?>

  <a href="#" class="os-back-to-top"></a>
  <div class="display-type"></div>
  <?php
    // if protect images checkbox in admin is set to true - load tag with copyright text
    if(get_field('protect_images_from_copying', 'option') === true){
      $copyright_text = (get_field('text_for_image_right_click', 'option') != '') ? get_field('text_for_image_right_click', 'option') : __('This photo is copyright protected', 'pluto');
      echo '<div class="copyright-tooltip">'.$copyright_text.'</div>';
    }
  ?>
  <?php wp_footer(); ?>
</body>
</html>