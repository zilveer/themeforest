<?php
if (!defined('ABSPATH')) die('No direct access allowed');

$featured_image_alias = TMM_Gallery::get_gallery_image_alias('');

if (!isset($galleries)) {
	$galleries = TMM_Gallery::get_galleries_images($display_images);
}

if (isset($galleries[$post_key])){
    $gall = $galleries[$post_key];
	$title = __($gall['title'], 'diplomat');

    $single_page = TMM::get_option('gall_single_page');
    $title_link = '';
    $title_class = '';
    if ($single_page){
        $title_link = get_permalink($gall['id']);
    }else{
        $title_link = TMM_Content_Composer::resize_image($gall['imgurl'], '');
        $title_class = 'gallery popup-link';
    }
    ?>

    <article id="post-<?php echo $post_key ?>" class="mix <?php echo esc_attr($gall['slug']); ?>">

        <div class="work-item">

            <a href="<?php echo esc_url(TMM_Content_Composer::resize_image($gall['imgurl'], '')); ?>" class="gallery popup-link">
                <div class="item-overlay gallery">
                    <img src="<?php echo esc_url(TMM_Content_Composer::resize_image($gall['imgurl'], $featured_image_alias)); ?>" alt="<?php echo esc_attr($title); ?>">
                </div>
            </a>

            <?php if ($show_categories){ ?>
                <h4 class="caption"><a class='<?php echo esc_attr($title_class) ?>' href="<?php echo esc_url($title_link); ?>"><?php echo esc_html($title); ?></a></h4>
            <?php } ?>

        </div><!--/ .work-item-->

    </article><!--/ .project-item-->

	<?php

}
