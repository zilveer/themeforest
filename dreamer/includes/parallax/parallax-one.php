<?php global $smof_data; //fetch options stored in $pulsar_data
//fetch first parallax data
$dreamer_parallax_one_page = $smof_data['parallax_one_page'];
$first_page_id = smof_get_ID_by_page_name($dreamer_parallax_one_page);
$page_data = get_page( $first_page_id ); 
//store page title and content in variables
$dreamer_parallax_one_page_title = $page_data->post_title; 
$dreamer_parallax_one_page_content = apply_filters('the_content', $page_data->post_content);
?>
<style>
	.parallax-one {
		background:#000 url(<?php echo $url_one = wp_get_attachment_url( get_post_thumbnail_id($first_page_id, 'large') ); ?>) 50% 0 no-repeat fixed;
	}
</style>
<!-- Parallax One - Content -->
<div class="parallax-one">
    <div class="quote1-pattern" id="parallax-one"></div>
    <div class="row">
        <div class="twelve columns parallax-container">
        	<h1 class="parallax-title"><?php echo $dreamer_parallax_one_page_title; ?></h1>
            <div class="parallax-divider">
            	<div class="parallax-divider-left"></div>
            	<img src="<?php global $smof_data; $dreamer_parallax_one_icon = $smof_data['parallax_one_icon']; echo $dreamer_parallax_one_icon ?>" alt="<?php echo $dreamer_parallax_one_page_title; ?>">
            	<div class="parallax-divider-right"></div>
            </div>
        	<h2 class="parallax-subtitle"><?php echo $dreamer_parallax_one_page_content; ?></h2>
        </div>
    </div>
</div>