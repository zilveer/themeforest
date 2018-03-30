<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />

<div id="post_slides">
    <p>
        <a href="#" class="js_add_post_slide button button-primary"><?php esc_html_e('Add Post slides', 'diplomat'); ?></a>
        <a href="#" class="js_add_slide button button-primary"><?php esc_html_e('Add Image slides', 'diplomat'); ?></a>
    </p>
    <div id="tmm_posts_slide_group">
        <?php
        if (!empty($post_slides_group)){

            foreach($post_slides_group as $key => $group) {

                if (isset($group['slide_content'])){

                    echo TMM::draw_free_page(TMM_Slider::get_application_path() . '/views/meta_slide_item.php', array('group' => $group, 'index' => $key));

                }
                else{
                    $data = array();
                    $data['unique_id'] = $key;
                    $data['post_thumb'] = $group['imgurl'];
                    $data['post_id'] = $group['post_id'];
                    $data['post_title'] = $group['title'];
                    $data['post_date'] = $group['post_date'];
                    $data['date'] = $group['date'];
                    $data['post_permalink'] = $group['lm_link'];
                    $data['author_link'] = $group['author_link'];
                    $data['comments_link'] = $group['comments_link'];

                    echo TMM::draw_free_page(TMM_Slider::get_application_path().'/views/post_slide_item.php', $data);

                }

            }

        }

        ?>

        <div style="display:none;">

            <?php wp_editor('', 'slide_content_'.uniqid(), array('default_editor'   => 'tinymce')); ?>

        </div>

    </div>
</div>


<!-- ------------------------ Edit Row Template ----------------------------------------- -->
<div style="display: none">
    <div id="tmm_slider_add_post_slide">

        <?php TMM_Slider::get_slide_posts(); ?>

    </div>
</div>

<div class="clear"></div>