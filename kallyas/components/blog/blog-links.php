<?php if(! defined('ABSPATH')){ return; } ?>

<?php if( has_category() ): ?>

<ul class="itemLinks kl-blog-item-links kl-font-alt clearfix">
    <li class="itemCategory kl-blog-item-category">
        <span class="kl-blog-item-category-icon" data-zniconfam='glyphicons_halflingsregular' data-zn_icon="&#xe117;"></span>
        <span class="kl-blog-item-category-text"><?php echo __( 'Published in', 'zn_framework' );?></span>
        <?php the_category( ", " ); ?>
    </li>
</ul>
<?php endif; ?>