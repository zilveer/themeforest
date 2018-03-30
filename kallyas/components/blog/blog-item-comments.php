<?php if(! defined('ABSPATH')){ return; } ?>
<div class="itemComments kl-blog-item-comments">
    <a href="<?php the_permalink(); ?>" class="kl-blog-item-comments-link kl-font-alt"><?php comments_number( __( 'No Comments', 'zn_framework'), __( '1 Comment', 'zn_framework' ), __( '% Comments', 'zn_framework' ) ); ?></a>
</div>
