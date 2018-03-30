<?php
/**
 * Related Post
 *
 * @author 		G5Theme
 */

global $post;
$g5plus_options = &G5Plus_Global::get_options();
$show_related_post = isset($g5plus_options['show_related_post']) ? $g5plus_options['show_related_post'] : 1;
if ($show_related_post == 0) {
    return;
}

if (!isset($post) || empty($post)) {
    return;
}

$posts_per_page = isset($g5plus_options['related_post_count']) ? $g5plus_options['related_post_count'] : 6 ;
$related = g5plus_get_related_post($post->ID, $posts_per_page);
if ( sizeof( $related ) == 0 ) return;
$columns = isset($g5plus_options['related_post_columns']) ? $g5plus_options['related_post_columns'] : 3 ;
$args = apply_filters( 'g5plus_related_post_args', array(
    'post_type'            => 'post',
    'ignore_sticky_posts'  => 1,
    'no_found_rows'        => 1,
    'posts_per_page'       => $posts_per_page,
    'post__in'             => $related,
	'tax_query'            => array(
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio'),
			'operator' => 'NOT IN'
		)
	)
));


$data_plugin_options = '"margin": 30, "responsiveClass": true, "dots" : false, "nav" : false, "autoplay": false, "autoplayHoverPause": true';
switch ($columns) {
    case 4:
        $data_plugin_options .= ',"responsive" : {"0" : {"items" : 1, "margin": 0}, "600": {"items" : 2, "margin": 30}, "992": {"items" : 4, "margin": 30}}';
        break;
    case 3 :
        $data_plugin_options .= ',"responsive" : {"0" : {"items" : 1, "margin": 0}, "600": {"items" : 2, "margin": 30}, "992": {"items" : 3, "margin": 30}}';
        break;
    case 2 :
        $data_plugin_options .= ',"responsive" : {"0" : {"items" : 1, "margin": 0}, "600": {"items" : 2, "margin": 30}}';
        break;
}

$query = new WP_Query( $args );
if ( $query->have_posts() ) : ?>
    <div class="post-related-wrap">
        <div class="owl-carousel"  data-plugin-options='{<?php echo esc_attr($data_plugin_options); ?>}'>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
               <?php g5plus_get_template('single-blog/content','related'); ?>
            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
<?php endif;
wp_reset_postdata();
