<?php
if (has_post_thumbnail()) {
    ?>
    <figure>
        <span class="format-icon image"></span>
        <?php
        if (is_single()){
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_url($image_id);
            ?>
            <a href="<?php echo $image_url; ?>" class="<?php echo get_lightbox_plugin_class(); ?>" title="<?php the_title(); ?>">
            <?php
        }else{
            ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php
        }

        if (is_page_template('template-home.php')) {
            the_post_thumbnail('gallery-two-column-image');
        } else {
            the_post_thumbnail('post-featured-image');
        }
        ?>
        </a>
    </figure>
<?php
}
?>