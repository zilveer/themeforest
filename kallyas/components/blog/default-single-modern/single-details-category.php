<?php if(! defined('ABSPATH')){ return; }
/**
 * Details category
 */
?>
<span class="itemCategory kl-blog-post-category"> <?php echo __( 'Published in ', 'zn_framework' ); ?> </span> <?php the_category( ", " ); ?>
