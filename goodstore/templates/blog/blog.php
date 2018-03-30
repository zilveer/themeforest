<?php
global $jaw_data, $post;
jaw_template_inc_counter('pagination');

$query = jaw_template_get_data();

if (isset($jaw_data['data']->type)) {
    $type = $jaw_data['data']->type;
} else {
    $type = 'default';
}

$first = true;
if (!$query->have_posts()) {
    ?>
    <div class="notice">
        <p class="bottom"><?php _e('We are sorry, no results were found. You can try to find some related posts using the search function.', 'jawtemplates'); ?></p>
    </div>
    <?php get_search_form();
    ?>	
<?php } ?>
<div class="jaw_blog">
    <div class="row elements_iso jaw_paginated_<?php echo esc_attr(jaw_template_get_counter('pagination')); ?>">
        <?php

        $col = jaw_template_get_var('box_size', jwLayout::parseColWidth());
        if ($col == 'max') {
            $col = jwLayout::parseColWidth();
        }

        while ($query->have_posts()) {
            $query->the_post();
            ?>

            <?php
            $format = '';
            switch (get_post_format()) {
                case 'video': $format = '-video';
                    break;
                case 'quote': $format = '-quote';
                    break;
                case 'image': $format = '-image';
                    break;
                case 'gallery': $format = '-gallery';
                    break;
                default: $format = '';
                    break;
            }
            $element_iso_width = 12;
            switch ($type) {
                case 'default': echo jaw_get_template_part('content-small' . $format, 'content');
                    $element_iso_width = 4;
                    break;
                case 'middle': echo jaw_get_template_part('content-middle' . $format, 'content');
                    $element_iso_width = 4;
                    break;
                case 'big': echo jaw_get_template_part('content-big' . $format, 'content');
                    break;
                case 'classical': echo jaw_get_template_part('content-classical' . $format, 'content');
                    break;
                case 'mix':
                    if ($first) {
                        echo jaw_get_template_part('content-middle' . $format, 'content');
                        $first = false;
                    } else {
                        echo jaw_get_template_part('content-small' . $format, 'content');
                    }
                    $element_iso_width = 4;
                    break;
            }

        }
        ?>

    </div>   
</div>

<div class="clear"></div>
<?php
echo jwRender::pagination(jaw_template_get_var('pagination', jwOpt::get_option('blog_pagination', 'number')), $query);
