<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$posts_per_page = (int)$atts['posts_number'];

$args = array(
    'sort' => $atts['type'],
    'items' => $posts_per_page,
    'image_post' => true,
    'return_image_tag' => false,
    'return_for_fw_image' => true,
    'image_width' => 70,
    'image_height' => 70,
    'image_class' => '',
    'date_format' => 'j M',
);
$fw_posts = fw_theme_get_posts($args);
?>
<?php if(!empty($fw_posts)):?>
    <div class="w-slider carousel-project" data-animation="slide" data-duration="500" data-infinite="1" data-nav-spacing="5">
        <div class="w-slider-mask">

            <?php  $cnt = 0; foreach($fw_posts as $item):  $cnt++; ?>

                <?php if($cnt == 1 || ($cnt-1) % 2 == 0):?>
                    <div class="w-slide">
                        <ul class="w-list-unstyled">
                <?php endif;?>

                        <li class="li-post" data-ix="show-dt-blog">
                            <div class="w-clearfix">
                                <?php if(!empty($item['post_img'])):?>
                                    <a class="w-inline-block blog-item blog-popular-sidebar" href="<?php echo esc_url($item['post_link']);?>">
                                        <img src="<?php echo esc_url($item['post_img']);?>" alt="">
                                        <div class="dt-blog" data-ix="move-dt-blog">
                                            <div><?php echo esc_html($item['post_date_post']);?></div>
                                        </div>
                                    </a>
                                <?php endif;?>
                                <div class="blog-wrapper">
                                    <h5 class="portfolio-tittle blog-tittle">
                                        <a class="blog-link" href="<?php echo esc_url($item['post_link']);?>">
                                            <?php echo esc_attr($item['post_title']);?>
                                        </a>
                                    </h5><br />
                                    <?php echo substr($item['post_excerpt'],0,100); ?>... <a class="link" href="<?php echo esc_url($item['post_link']);?>"><?php _e('See More','fw');?> →</a>

                                </div>
                            </div>
                        </li>

                <?php if($cnt % 2 == 0 || $cnt == count($fw_posts)):?>
                        </ul>
                    </div>
                <?php endif;?>

            <?php endforeach; ?>
        </div>
        <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
    </div>
<?php endif;?>

