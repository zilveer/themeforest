<p><?php esc_html_e( 'Published by', 'larx' ); ?>
    <a rel="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
        <?php echo get_the_author(); ?>
    </a>
</p>
<p><i class="fa fa-clock-o"></i><?php echo esc_html_e(' Posted on', 'larx'); ?>
    <?php echo get_the_date(); ?>
</p>
<?php the_content(); ?>