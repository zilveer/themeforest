<?php
add_shortcode('cs-introlist', 'cshero_intro_list_render');

function cshero_intro_list_render($params, $content = null) {
    global $post, $wp_query;
       
    extract(shortcode_atts(array(
        'category' => '1',
        'excerpt_length'=>'',
        'crop_big' => '',
        'big_width' => '465',
        'big_height' => '340',
        'crop_mini' => '',
        'mini_width' => '465',
        'mini_height' => '170',
        'orderby' => 'ID', 
        'order' => 'DESC'
    ), $params));
    
    wp_enqueue_style('introlist', get_template_directory_uri().'/framework/shortcodes/introlist/css/introlist.css', array(), '1.0.0');
    
    if (isset($category) && $category != '') {
    	$cats = explode(',', $category);
    	$category = array();
    	foreach ((array) $cats as $cat) :
    	$category[] = trim($cat);
    	endforeach;
		$args = array(
			'posts_per_page' => 4,
			'tax_query' => array(
					array(
							'taxonomy' => 'category',
							'field' => 'id',
							'terms' => $category
					)
			),
			'orderby' => $orderby,
			'order' => $order,
			'post_type' => 'post',
			'post_status' => 'publish'
		);

	} else {
		$args = array(
			'posts_per_page' => 4,
			'orderby' => $orderby,
			'order' => $order,
			'post_type' => 'post',
			'post_status' => 'publish'
		);
	}
    
	$wp_query = new WP_Query($args);
	$i = 0;
    ob_start();
    ?>
    <div class="cs-introlist">
    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $i++; ?>
        <?php if($i == 1 || $i == 3): ?>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <?php endif; ?>
            <?php if($i == 1 || $i == 4): ?>
            <?php 
            $attachment_image = "";
            if (has_post_thumbnail()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                if($crop_big){
                    $attachment_image = mr_image_resize( $image[0], $big_width, $big_height, true, 'c', false );
                } else {
                    $attachment_image = $image[0];
                }
            }
            ?>
            <div class="cs-introlist-big">
                <div class="cs-introlist-image">
                    <img alt="<?php the_title(); ?>" src="<?php echo esc_url($attachment_image); ?>">
                    <div class="cs-introlist-description">
                        <?php if($excerpt_length != ''){
                            echo cshero_string_limit_words(strip_tags(get_the_content()), (int)$excerpt_length);
                        } else {
                            echo strip_tags(get_the_content());
                        }
                        ?>
                    </div>
                    <div class="cs-introlist-title">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                    <div class="cs-introlist-more"><a href="<?php the_permalink(); ?>"><?php esc_html_e('More Info', 'wp_nuvo'); ?></a></div>
                    <a class="cs-introlist-overlay" href="<?php the_permalink(); ?>"></a>
                </div>
            </div>
            <?php endif; ?>
            <?php if($i == 2 || $i == 3): ?>
            <?php 
            $attachment_image = "";
            if (has_post_thumbnail()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                if($crop_mini){
                    $attachment_image = mr_image_resize( $image[0], $mini_width, $mini_height, true, 'c', false );
                } else {
                    $attachment_image = $image[0];
                }
            }
            ?>
            <div class="cs-introlist-mini">
                <div class="cs-introlist-image">
                    <img alt="<?php the_title(); ?>" src="<?php echo esc_url($attachment_image); ?>">
                    <div class="cs-introlist-title">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                    <div class="cs-introlist-more"><a href="<?php the_permalink(); ?>"><?php esc_html_e('More Info', 'wp_nuvo'); ?></a></div>
                    <a class="cs-introlist-overlay" href="<?php the_permalink(); ?>"></a>
                </div>
            </div>
            <?php endif; ?>
        <?php if($i == 2 || $i == 4): ?>
        </div>
        <?php endif; ?>
    <?php endwhile; ?>
    </div>
    <?php
    wp_reset_query();
    wp_reset_postdata();
    return ob_get_clean();
}