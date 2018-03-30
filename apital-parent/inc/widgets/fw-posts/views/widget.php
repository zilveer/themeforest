<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */
?>
<?php if ( ! empty( $instance ) ) :
	$items = 5;
	if(isset($instance['posts_number']) && $instance['posts_number'] != ''){
		$items = (int)$instance['posts_number'];
	}

	$args = array(
		'sort' => $instance['type'],
		'items' => $items,
		'image_post' => true,
		'return_image_tag' => false,
		'return_for_fw_image' => true,
		'image_width' => 70,
		'image_height' => 70,
		'image_class' => '',
		'date_format' => 'j M',
		'category' => $instance['category'],
	);
	$fw_posts = fw_theme_get_posts($args);

	echo do_shortcode($before_widget);
	echo do_shortcode($title);
	?>
    <ul class="w-list-unstyled">
		<?php foreach($fw_posts as $item): ?>
            <li class="li-post" data-ix="show-dt-blog">
                <div class="w-clearfix">
                    <?php if(!empty($item['post_img'])):?>
                        <a class="w-inline-block blog-item blog-popular-sidebar" href="<?php echo esc_url($item['post_link']);?>">
                            <img src="<?php echo esc_url($item['post_img']);?>" alt="">
                            <div class="dt-blog" data-ix="move-dt-blog">
                                <div><?php echo esc_attr($item['post_date_post']);?></div>
                            </div>
                        </a>
                    <?php endif;?>
                    <div class="blog-wrapper">
                        <h5 class="portfolio-tittle blog-tittle">
                            <a class="blog-link" href="<?php echo esc_url($item['post_link']);?>">
                                <?php echo do_shortcode($item['post_title']);?>
                            </a>
                        </h5>
                    </div>
                </div>
            </li>
		<?php endforeach; ?>
	</ul>
	<?php
	echo do_shortcode($after_widget);
endif; ?>