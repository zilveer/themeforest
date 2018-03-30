<?php if( has_tag() ) { ?>
<div class="article-footer">
    <h3 class="meta-title"><?php esc_html_e( 'Tags:', 'houzez' ); ?></h3>
    <?php the_tags( '<ul class="meta-tags"><li>', '</li><li>', '</li></ul>' ); ?>
</div>
<?php } ?>