<div class="mkdf-pt-four-item mkdf-post-item">
    <div class="mkdf-pt-four-item-inner">
        <div class="mkdf-pt-four-content-holder">
            <?php
            hashmag_mikado_post_info_category(array(
                'category' => $display_category
            )); ?>
            <<?php echo esc_html($title_tag) ?> class="mkdf-pt-four-title mkdf-pt-title">
            <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo hashmag_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
        </<?php echo esc_html($title_tag) ?>>
        <?php if ($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes' || $display_count == 'yes' || $display_like == 'yes') { ?>
            <div class="mkdf-pt-info-section">
                <?php hashmag_mikado_post_info_author(array(
                    'author' => $display_author
                )) ?>
                <?php hashmag_mikado_post_info_date(array(
                    'date' => $display_date,
                    'date_format' => $date_format
                )) ?>
                <?php hashmag_mikado_post_info_comments(array(
                    'comments' => $display_comments
                )) ?>
                <?php hashmag_mikado_post_info_count(array(
                    'count' => $display_count
                )); ?>
                <?php hashmag_mikado_post_info_like(array(
                    'like' => $display_like
                )); ?>
            </div>
        <?php } ?>
    </div>
</div>
</div>