<?php
/** Single Page
  *
  * This file is used to display the contents of
  * single pages
  *
  * @package Elderberry
  *
  */

  global $blueprint;
  $indent_side = ( $blueprint->get_sidebar_position() == 'right' ) ? 'left' : 'right';

?>
<div class='content indent <?php echo $indent_side ?>'>
<?php the_content() ?>
</div>