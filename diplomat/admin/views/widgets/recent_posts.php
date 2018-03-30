<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_recent_posts">
    <div class="tabs-holder">	

	<?php if ($instance['title'] != '') { ?>
		<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
	<?php } ?>
    <?php 
    $def_array = array(
        'popular' => __('Popular', 'diplomat'),
        'latest' => __('Latest', 'diplomat'),
        'comments' => __('Comments', 'diplomat')
                        );
    $tabs_array = (count($instance['category'])!=0) ? $instance['category'] : $def_array;
     
    ?>
    
    <ul class="tabs-nav">
        <?php foreach ($tabs_array as $key => $value){ ?>
            <li><h3><?php echo esc_html($value) ?></h3></li>
        <?php } ?>
    </ul><!--/ .tabs-nav-->    
    
    <div class="tabs-container">
       
	<?php foreach ($tabs_array as $key => $value){ ?>
        
        <div class="tab-content">

            <?php
            $args = array();
             if (count($instance['category'])==0){

                switch ($key){
                    case 'popular':
                        $args = array(
                            'post_type' => 'post',
                            'numberposts' => $instance['number_popular_posts'],
                            'meta_key' => 'tmm_post_views_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'suppress_filters' => false
                        );
                        break;
                    case 'latest':
                        $args = array(
                            'post_type' => 'post',
                            'numberposts' => $instance['number_latest_posts'],
                            'orderby'   => 'post_date',
                            'order' => 'DESC',
                            'suppress_filters' => false
                        );
                        break;

                }

            }else{

                $args = array(
                            'post_type' => 'post',
                            'numberposts' => $instance['number_category_posts'],
                            'category_name' => $key,
                            'suppress_filters' => false
                        );

            }

            if ($key != 'comments'){
                $posts =  get_posts($args);
                foreach ($posts as $post){
                    $post_pod_type = get_post_format($post->ID);
                    ?>

                    <div class="recent-post">

                        <?php
                        if ($post_pod_type == 'video'){
                            $post_type_values = get_post_meta($post->ID, 'post_type_values', true);
                            $source_url = (isset($post_type_values['video'])) ? $post_type_values['video'] : '';
                            $video_width = '105';
                            $video_height = '80';

                            if (!empty($source_url)) {
                                echo do_shortcode('[tmm_video cover_id="' . $post->ID . '" width="' . $video_width . '" height="' . $video_height . '"]' . $source_url . '[/tmm_video]');
                            }

                        }
                        elseif ($instance['show_thumbnail']) { ?>
                            <div class="post-media">
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="item-overlay">
                                    <img alt="<?php echo esc_attr($post->post_title); ?>" src="<?php echo esc_url(TMM_Helper::get_post_featured_image($post->ID, '105*80')); ?>" />
                                </a>
                            </div><!--/ .entry-media-->
                        <?php } ?>

                        <div class="post-holder">
                            <h4 class="post-title">
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">

		                            <?php
		                            if ((int) $instance['title_excerpt'] > 0) {
			                            echo esc_html(substr(strip_tags($post->post_title), 0, (int)$instance['title_excerpt']) . " ...");
		                            } else {
			                            echo esc_html($post->post_title);
		                            }
		                            ?>

                                </a>

                            </h4>

                            <?php if ($instance['show_exerpt']) { ?>
                                <p>
                                    <?php $excerpt = $post->post_excerpt; ?>
                                    <?php if (!empty($excerpt)){ ?>
                                        <?php
                                        if ((int) $instance['exerpt_symbols_count'] > 0) {
                                            echo esc_html(substr(strip_tags($excerpt), 0, (int)$instance['exerpt_symbols_count']) . " ...");
                                        } else {
                                            echo esc_html($excerpt);
                                        }
                                        ?>
                                    <?php } else { ?>

                                        <?php echo esc_html(substr(strip_tags($post->post_content), 0, (int)$instance['exerpt_symbols_count']) . " ..."); ?>
                                    <?php } ?>
                                </p>
                            <?php } ?>

                            <div class="entry-meta">
                                <span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y', $post->ID))); ?>"><?php echo get_the_date(TMM::get_option('date_format'), $post->ID) ?></a></span>
                                <span class="comments-link"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>#comments"><?php echo esc_html($post->comment_count); ?></a></span>
                            </div>
                        </div><!--/ .post-holder-->

                    </div><!--/ .recent-post-->

                <?php

                }
            }else{

                $comments = get_comments(array('number' => $instance['number_comments_posts']));
                if (!empty($comments)) {
                    foreach ($comments as $comment) {
                        ?>
                        <div class="recent-comment">
                            <?php if ($instance['show_thumbnail']) { ?>
                                <div class="author-image">
                                    <?php echo get_avatar($comment, 45); ?>
                                </div>
                            <?php } ?>
                            <div class="author-data">
	                            <h4 class="author-name"><?php echo esc_html($comment->comment_author) ?></h4>
	                            <h4 class="author-title">
                                    <a href="<?php echo esc_url(get_permalink($comment->comment_post_ID));?>#comment-<?php echo $comment -> comment_ID; ?>"><?php echo esc_html(get_the_title($comment->comment_post_ID)); ?></a>
                                </h4>
                                <p>
                                   <?php echo esc_html($comment->comment_content); ?>
                                </p>
                            </div>

                        </div><!--/ .recent-comment-->
                        <?php
                    }
                }
            }
            ?>

        </div><!--/ .tab-content-->
        
        <?php } ?>         

    </div><!--/ .tabs-container-->
    
                            
    </div><!--/ .tabs-holder-->               

</div><!--/ .widget-container-->

