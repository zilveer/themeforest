<?php
add_shortcode('cs-next-event', 'cs_shortcode_next_event_render');
function cs_shortcode_next_event_render($params, $content = null) {

	$title = $image = $description = $class = '';

    extract(shortcode_atts(array(
        'title' => '',
        'image' => '',
        'description'=>'',
        'class' => ''
    ), $params));
    
    $date_sever = date_i18n('Y-m-d');
	$time_sever = date_i18n('H:i');
    
    $gmt_offset = get_option( 'gmt_offset' );
    
    //date_default_timezone_set("America/Los_Angeles");
    wp_enqueue_script('jquery-plugin', get_template_directory_uri() . "/framework/shortcodes/eventcountdown/js/jquery.plugin.min.js");
    wp_enqueue_script('jquery-countdown', get_template_directory_uri() . "/framework/shortcodes/eventcountdown/js/jquery.countdown.min.js");
    wp_enqueue_script('custom-countdown', get_template_directory_uri() . "/framework/shortcodes/eventcountdown/js/custom.countdown.js");

	$_query_lv1 = array(
		'post_type' => 'event',
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'meta_query'        => array(
			array(
				'key'     => '_event_start_date',
				'compare' => '>=',
				'value'	  => $date_sever,
				'type'    => 'DATE'
			)
		),
		'orderby'   => 'meta_value',
		'meta_key'  => '_event_start_date',
		'order'     => 'ASC'
	);

	$_event = new WP_Query($_query_lv1);
    
    if(!$_event->post) return;

	$_event_start_date = get_post_meta($_event->post->ID, '_event_start_date', true);
	
	if($_event_start_date == date_i18n('Y-m-d')) {
		$_query_lv2 = array(
			'post_type' => 'event',
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'meta_query' => array(
				array(
					'key' => '_event_start_date',
					'compare' => '=',
					'value' => $_event_start_date,
					'type' => 'DATE'
				),
				array(
					'key' => '_event_start_time',
					'compare' => '>=',
					'value'	=> $time_sever,
					'type' => 'TIME'
				)
			),
			'orderby' => 'meta_value',
			'meta_key' => '_event_start_time',
			'order' => 'ASC'
		);
	} else {
		$_query_lv2 = array(
			'post_type' => 'event',
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'meta_query' => array(
				array(
					'key' => '_event_start_date',
					'compare' => '=',
					'value' => $_event_start_date,
					'type' => 'DATE'
				),
				array(
					'key' => '_event_start_time',
					'compare' => 'EXISTS',
					'type' => 'TIME'
				)
			),
			'orderby' => 'meta_value',
			'meta_key' => '_event_start_time',
			'order' => 'ASC'
		);
	}

	$_event = new WP_Query($_query_lv2);

	if(!$_event->post) return;

	$_event_start_date = get_post_meta($_event->post->ID, '_event_start_date', true);
	$_event_start_time = get_post_meta($_event->post->ID, '_event_start_time', true);
    
    $pageposts = $_event->post;
    
    $utc_date = !empty($pageposts) ? date('Y,m,d,H,i,s', strtotime($_event_start_date." ".$_event_start_time)) : null;

	ob_start();

	?>
	<div class="cs-eventCount">
		<div class="cs-eventCount-header widget-block-header">
			<?php if($title): ?>
				<h1 class="cs-title"><?php echo esc_attr($title); ?></h1>
			<?php endif; ?>
			<?php if($description): ?>
				<p class="cs-desc"><?php echo esc_attr($description); ?></p>
			<?php endif; ?>
		</div>
		<div class="cs-eventCount-content">
			<div class='cs-eventCount-introImg col-xs-12 col-sm-12 col-md-6 col-lg-6'>
			<?php if($image): ?>
				<?php $image = wp_get_attachment_image_src($image, 'full'); ?>
				<img alt="<?php echo esc_html($pageposts->post_title); ?>" src="<?php echo esc_url($image[0]); ?>"/>
			<?php elseif (has_post_thumbnail($pageposts->ID)) : ?>
				<?php echo get_the_post_thumbnail( $pageposts->ID, 'full' ); ?>
			<?php endif; ?>
			</div>
			<div class="cs-eventCount-contentWrap col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<h3 class="cs-eventCount-title"><a href="<?php the_permalink($pageposts->ID); ?>"><?php echo esc_html($pageposts->post_title); ?></a></h3>
				<div class="cs-eventCount-content-main"><?php echo cshero_string_limit_words(strip_tags($pageposts->post_content), 20); ?>...</div>
				<span id="event_countdown" class="" data-count="<?php echo esc_attr($utc_date);?>" data-timezone="<?php echo esc_attr($gmt_offset); ?>" data-label="<?php echo esc_html__('DAYS', 'wp_nuvo').','.esc_html__('HOURS', 'wp_nuvo').','.esc_html__('MINUTES', 'wp_nuvo').','.esc_html__('SECONDS', 'wp_nuvo'); ?>"></span>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}