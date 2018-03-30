    <div class="slide-item" id="slide_item_<?php echo $unique_id ?>">

        <div class="slide-dragger"></div>

        <div class="slide-thumb">
            <img src="<?php echo esc_url(TMM_Helper::resize_image($post_thumb, '230*184')); ?>" alt="slide" />
            <input type="hidden" class='post_thumb' name="post_slides_group[<?php echo $unique_id ?>][imgurl]" value="<?php echo esc_attr($post_thumb); ?>" />
            <input type="hidden" name="post_slides_group[<?php echo $unique_id ?>][post_date]" value="<?php echo esc_attr($post_date); ?>" />
            <a href="#" class="button js_edit_slide" data-slide-id="<?php echo esc_attr($unique_id); ?>"><?php esc_html_e('Edit Image', 'diplomat'); ?></a>
        </div>

        <a href="#" class="js_delete_slide" slide-id="<?php echo esc_attr($unique_id); ?>" title="<?php esc_attr_e('Delete Slide', 'diplomat'); ?>"><?php esc_html_e('Delete Slide', 'diplomat'); ?></a>

            <div id="slide_options_<?php echo $unique_id ?>" class="post-slide-options" dialog-id="<?php echo esc_attr($unique_id); ?>">
                <input type="hidden" name="post_slides_group[<?php echo $unique_id ?>][post_id]" value="<?php echo esc_attr($post_id); ?>">

                <div class="one-half">

                    <?php
                    TMM_Slider :: draw_slider_option(array(
                            'title' => __('Post Title', 'diplomat'),
                            'type' => 'text',
                            'name' => 'post_slides_group[' . $unique_id .'][title]',
                            'default_value' => $post_title,
                            'description' => 'Leave field empty for not displaying post title',
                            'css_class' => 'post_title',
                            'custom_html' => ''
                        )
                    );

                    $post_date = TMM_Slider::get_post_date_format($post_date);
                    TMM_Slider :: draw_slider_option(array(
                            'title' => __('Post Date', 'diplomat'),
                            'type' => 'select',
                            'name' => 'post_slides_group[' . $unique_id .'][date]',
                            'values' => $post_date,
                            'default_value' => $date,
                            'description' => '',
                            'css_class' => 'post_date',
                            'custom_html' => ''
                        )
                    );

                    ?>

                </div>

                <div class="one-half">
                    <?php

                    TMM_Slider :: draw_slider_option(array(
                            'title' => __('Post Permalink', 'diplomat'),
                            'type' => 'text',
                            'name' => 'post_slides_group[' . $unique_id .'][lm_link]',
                            'default_value' => $post_permalink,
                            'description' => '',
                            'css_class' => 'post_lm_link',
                            'custom_html' => ''
                        )
                    );

                    TMM_Slider :: draw_slider_option(array(
                            'title' => __('Show / Hide Author Link', 'diplomat'),
                            'type' => 'checkbox',
                            'name' => 'post_slides_group[' . $unique_id .'][author_link]',
                            'default_value' => $author_link,
                            'description' => '',
                            'css_class' => 'post_author_link',
                            'custom_html' => ''
                        )
                    );

                    TMM_Slider :: draw_slider_option(array(
                            'title' => __('Show / Hide Comments Link', 'diplomat'),
                            'type' => 'checkbox',
                            'name' => 'post_slides_group[' . $unique_id .'][comments_link]',
                            'default_value' => $comments_link,
                            'description' => '',
                            'css_class' => 'post_comments_link',
                            'custom_html' => ''
                        )
                    );
                    ?>
                </div>

            </div>

            <div class="clear"></div>

    </div>
