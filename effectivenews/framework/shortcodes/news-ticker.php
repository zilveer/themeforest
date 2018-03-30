<?php function mom_news_ticker($atts, $content = null) {
	extract(shortcode_atts(array(
	'title' => __('LATEST NEWS', 'theme'),
	'display' => '',
	'category' => '',
	'tag' => '',
        'custom' => '',
        'count' => '5',
        'time' => '',
        'icon' => '',
	'time_format' => '',
	'clock_only' => '',
	), $atts));
	if ($title == '') {
	    $title =  __('LATEST NEWS', 'theme');
	}
	ob_start();
	$site_time = mom_option('main_time') != '' ? mom_option('main_time') : '+2';

            if ($icon == '') {
		if (is_rtl()) {
                $icon = '<i class="fa-icon-double-angle-left"></i>';
		} else {
                $icon = '<i class="fa-icon-double-angle-right"></i>';
		}
            } else {
                $icon = '<img src="'.$icon.'" alt="">';
            }
            $tm = '';
            if ($time == 'off') {
                $tm = 'style="margin:0;"'; 
            }
	?>
<?php
$search_b = '';
if (mom_option('nt_search') == 0) {
    $search_b = ' nt_search_off';
}
?>
        <div class="breaking-news <?php echo $search_b; ?>">
	<div class="inner">
    <div class="the_ticker" <?php echo $tm; ?>>
    <div class="bn-title"><span><?php echo $title; ?></span></div>
    <div class="news-ticker">
        <ul>
<?php
    if ($display != 'custom') { 
		if ($display == 'category') {
			$args = array(
			'posts_per_page' => $count,
			'cat' => $category,
		); 
		} elseif ($display == 'tag') {
			$args = array(
			'posts_per_page' => $count,
			'tag_id' => $tag,
		); 
		} else {
			$args = array(
				'posts_per_page' => $count,
			); 
		}

                $query = new WP_Query( $args );
                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();                
?>
            <li><?php echo $icon; ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; else: ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php } else {
    if ($custom != '') {
        $custom = explode(',', $custom);
        foreach($custom as $ct) {
            echo '<li>'.$icon.$ct.'</li>';
        } 
    }
} ?>
        </ul>
    </div> <!--news ticker-->
    </div>
	<div class="search-form mom-search-form">
	    <form method="get" action="<?php echo home_url(); ?>">
		<input class="sf" type="text" placeholder="<?php _e('SEARCH ...', 'theme'); ?>" autocomplete="off" name="s">
		<button class="button" type="submit"><i class="momizat-icon-search"></i></button>
	    </form>
	</div>
    </div> <!--breaking news-->
<?php

	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	
	}
add_shortcode('news_ticker', 'mom_news_ticker');