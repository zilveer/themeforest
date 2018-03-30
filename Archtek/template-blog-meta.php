<?php

$override_with_theme_options = false;
$show_meta_theme_options = array();

if ( function_exists( 'ot_get_option' ) ) {
		
	// Whether to prioritize Theme Options setting
	$override_with_theme_options = ot_get_option('uxbarn_to_setting_override_post_meta_info');
	if ( $override_with_theme_options == '' || $override_with_theme_options == 'false' ) {
		$override_with_theme_options = false;
	} else {
		$override_with_theme_options = true;
	}
	
	// Meta info settings from Theme Options
	$show_meta_theme_options = ot_get_option('uxbarn_to_post_meta_info_display');
	
}


// Post meta info
$show_meta_date = '';
$show_meta_author = '';
$show_meta_comment_count = '';

if ( $override_with_theme_options ) {
	
	$show_meta_date = !empty($show_meta_theme_options) ? (isset($show_meta_theme_options[0]) ? $show_meta_theme_options[0] : '') : '';
	$show_meta_author = !empty($show_meta_theme_options) ? (isset($show_meta_theme_options[1]) ? $show_meta_theme_options[1] : '') : '';
	$show_meta_comment_count = !empty($show_meta_theme_options) ? (isset($show_meta_theme_options[2]) ? $show_meta_theme_options[2] : '') : '';
	
	//echo 'Theme Options: ' . var_dump($override_with_theme_options) . ' ' . var_dump($show_meta_date) . ' ' . var_dump($show_meta_author) . ' ' . var_dump($show_meta_comment_count);
	
} else {
	
	// Show all info? (New option since the theme v1.7.0)
	$show_all_info = uxbarn_get_array_value( get_post_meta($post->ID, 'uxbarn_post_meta_info_and_elements_display'), 0);
	
	if ( $show_all_info == '' || $show_all_info == 'true' ) {
		
		$show_meta_date = 'date';
		$show_meta_author = 'author_name';
		$show_meta_comment_count = 'comment';
		
	} else {
		
		$show_meta_date = uxbarn_get_array_value( uxbarn_get_array_value( get_post_meta($post->ID, 'uxbarn_post_meta_info_display'), 0), 0);
		$show_meta_author = uxbarn_get_array_value( uxbarn_get_array_value( get_post_meta($post->ID, 'uxbarn_post_meta_info_display'), 0), 1);
		$show_meta_comment_count = uxbarn_get_array_value( uxbarn_get_array_value( get_post_meta($post->ID, 'uxbarn_post_meta_info_display'), 0), 2);
		
	}
	
	//echo 'Meta Box: ' . var_dump($show_all_info) . ' ' . var_dump($show_meta_date) . ' ' . var_dump($show_meta_author) . ' ' . var_dump($show_meta_comment_count);
	
}


?>

<?php if($show_meta_comment_count || $show_meta_date || $show_meta_author) : ?>
                        
<div class="blog-meta">
    <span class="date"><?php if($show_meta_date) : echo get_the_time(get_option('date_format')); endif; ?></span>
    <ul class="author-comments">
        <li>
            <?php if($show_meta_author) : ?>
                
                <i class="fa fa-user"></i><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a>
                
            <?php else : ?>
                &nbsp;
            <?php endif; ?>
        </li>
        <li>
            <?php if($show_meta_comment_count) : ?>
                
                <i class="fa fa-comments-o"></i><a href="<?php comments_link(); ?>"><?php comments_number( __('0 Comment', 'uxbarn'), __('1 Comment', 'uxbarn'), __('% Comments', 'uxbarn') ); ?></a>
                
            <?php else : ?>
                &nbsp;
            <?php endif; ?>
        </li>
    </ul>
</div>
<hr />

<?php endif; ?>