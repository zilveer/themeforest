<?php
global $post, $wp_query, $jaw_data;
?>
<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-4', 'content-middle', 'content-attachment', 'format-standart')); ?>   >
    <div class="box ">
        <div class="image">
            <?php
            switch (jwOpt::get_option('std_post_image_clickable', '0')) {
                case '1': echo '<a href="' . esc_url(get_permalink()) . '"  title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '">';
                    break;
                case '2': echo '<a href="' . esc_url(jwUtils::get_thumbnail_link()) . '"  rel="prettyPhoto[posts-' . esc_attr(jaw_template_get_counter('pagination')) . ']" title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '">';
                    break;
            }
            echo '<img src="' . esc_url(jwUtils::get_thumbnail_link()) . '" alt="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '"/>';

            if (jwOpt::get_option('std_post_image_clickable', '0') != '0') {
                echo '</a>';
            }
            ?>
        </div>
        <div class="content-box">
            <header>
                <h2><a href="<?php the_permalink(); ?>" class="post_name"><?php echo jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60)); ?></a></h2>
            </header>    
        </div>
    </div>
</article>

