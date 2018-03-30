<?php 
/**
 * format-link.php
 *
 * The default template for post contents.
 */

?>

<div class="image-wrapper post-format-link">
	<!-- post inner content -->
    <div class="link-post-wrapper">  
      <a class="light-font" href="<?php echo get_post_meta(get_the_ID() , 'link' , true); ?>"><?php echo get_post_meta(get_the_ID() , 'link' , true); ?></a>
    </div>
    <!-- end inner content -->
</div>		



