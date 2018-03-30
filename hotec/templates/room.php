<?php
global $post, $page;
the_post();
$st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
$builder_content = get_page_builder_content($post->ID);

?>
<div class="page-content">
    <?php
    $thumb_html = st_post_thumbnail($post->ID,'st_medium',false, true);
    if($page<2 && $thumb_html!=''):
        ?>
        <div class="page-featured-image cpt-thumb-wrapper">
            <?php echo $thumb_html;?>
        </div>
    <?php endif;

    // service included
    $services_included =  get_post_meta($post->ID,'_st_services_included',true);
    $room_services = false;
    if($services_included){


        $args =  array(
            'orderby'         => 'post__in',
            'order'           => '',
            'post__in'=>$services_included,
            'post_type'       => 'room_service',
            'post_status'     => 'publish',
            'posts_per_page' =>'-1'
        );

        // added in ver 1.3
        if(st_is_wpml()){
            $args['sippress_filters'] = true;
            $args['language'] = get_bloginfo('language');
        }

        $new_query = new WP_Query($args);
        $room_services =  $new_query->posts;

    }

    if($room_services){
        ?>
        <div class="services-included">
            <h3><?php _e('Services Included','smooththemes'); ?></h3>
            <ul>
                <?php foreach($room_services as $s):

                    $thumb_url='';
                    if(has_post_thumbnail($s->ID)){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($s->ID), 'thumbnail_size' );
                        $thumb_url = $thumb['0'];
                    }

                    ?>
                    <li>
                        <span class="service-item">
                        <?php if($thumb_url): ?>
                            <img src="<?php echo $thumb_url; ?>" alt="icon" />
                        <?php endif; ?>
                            <?php echo apply_filters('the_title',$s->post_title); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php
    }// end if has $room_services

    do_action('st_before_the_content',$post);
    echo '<div class="text-content">';
    the_content();
    echo '</div>';
    do_action('st_after_the_content',$post);
    do_action('st_after_page_content');

    $args = array(
        'before'           => '<p class="single-pagination">' . __('Pages:','smooththemes'),
        'after'            => '</p>',
        'link_before'      => '',
        'link_after'       => '',
        'next_or_number'   => 'number',
        'nextpagelink'     => __('Next page','smooththemes'),
        'previouspagelink' => __('Previous page','smooththemes'),
        'pagelink'         => '%',
        'echo'             => 1
    );
    wp_link_pages( $args );

    ?>
    <div class="clear"></div>
</div><!-- END page-content-->

<div class="page-single-element">
    <?php /*
        <p class="page-tags">
            <?php echo get_the_term_list($post->ID,'room_cat','<b>'.__('Category:','smooththemes').'</b> ',', ',''); ?>
        </p>
        <div class="clear"></div>
    */ ?>

    <?php  do_action('st_before_author'); ?>

    <div class="clear"></div>
</div><!-- Single Page Element -->