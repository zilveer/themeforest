<?php
/* for link post format */
global $post;

$link_text = get_post_meta($post->ID, 'MEDICAL_META_link_text', true); // link text
$link_url = get_post_meta($post->ID, 'MEDICAL_META_link_url', true); // link URL

?>
<div class="link clearfix">
    <div class="link-container">
        <?php
        if (!empty($link_text)) {
            ?>
            <h3 class="link-title"><?php echo $link_text; ?></h3>
        <?php
        } else {
            ?>
            <h3 class="link-title entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h3>
        <?php
        }

        if (!empty($link_url)) {
            ?><a class="link-anchor" href="<?php echo $link_url ?>" target="_blank"><?php echo $link_url ?></a><?php
        } else {
            the_content('');
        }
        ?>
    </div>
</div>