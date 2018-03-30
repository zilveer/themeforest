<?php
$categories = get_the_category();
$output = '';
if (!empty($categories)) {
    foreach( $categories as $category ) {
        $output .= esc_html($category->name);
        break;
    }
}
?>
<li class="mkdf-pswt-slide" data-thumb="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id()))?>" data-posttitle="<?php echo esc_attr(get_the_title()) ?>" data-postcategory="<?php echo esc_attr($output); ?>">
    <?php if (has_post_thumbnail()) { ?>
    <div class="mkdf-pswt-image">
        <a itemprop="url" class="mkdf-pswt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
            <?php
                if($thumb_image_size != 'custom_size') {
                    echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                } elseif($thumb_image_width != '' && $thumb_image_height != ''){
                    echo hashmag_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
                }
            ?>
        </a>
    </div>
    <?php } ?>
    <div class="mkdf-pswt-content-holder">
        <div class="mkdf-pswt-content">
            <div class="mkdf-pswt-content-inner">
                <?php hashmag_mikado_post_info_category(array(
                    'category' => $display_category
                )) ?>
                <<?php echo esc_html($title_tag)?> class="mkdf-pswt-title">
                    <a itemprop="url" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo esc_attr(get_the_title()) ?></a>
                </<?php echo esc_html($title_tag) ?>>
                <?php if($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes'){ ?>
                    <div class="mkdf-pswt-info">
                        <?php hashmag_mikado_post_info_author(array(
                            'author' => $display_author
                        )) ?>
                        <?php hashmag_mikado_post_info_date(array(
                            'date' => $display_date,
                            'date_format' => $date_format
                        )) ?>
                        <?php hashmag_mikado_post_info_like(array(
                            'like' => $display_like
                        )) ?>
                        <?php hashmag_mikado_post_info_comments(array(
                            'comments' => $display_comments
                        )) ?>
                        <?php hashmag_mikado_post_info_count(array(
                            'count' => $display_count
                        )) ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</li>