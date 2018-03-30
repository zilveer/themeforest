<?php
/* For video post format */
global $post;

$embed_code = get_post_meta($post->ID, 'MEDICAL_META_embed_code', true); // video embed code

if (!empty($embed_code)) {
    ?>
    <div class="video clearfix">
        <div class="video-wrapper clearfix">
            <?php echo stripslashes(htmlspecialchars_decode($embed_code)); ?>
        </div>
    </div>
<?php
} else if (has_post_thumbnail()) {
    inspiry_standard_thumbnail();
}
?>