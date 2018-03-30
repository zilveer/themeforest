<?php
	get_header();
	the_post();
	
	//Calculate required sidebar layout
	$active = is_active_sidebar('primary');
	$sidebar = ( isset($_GET['layout']) ) ? $_GET['layout'] : false;
	$layout = ( $sidebar ) ? $sidebar : get_option('foundry_post_layout','sidebar-right');
	$layout = ( $active ) ? $layout : 'sidebar-none';

	$showtitle = get_option('foundry_blog_header_show_posttitle','no');
	if($showtitle == 'yes') {
		$posttitle = get_the_title($post->ID);
	} else {
		$posttitle = get_option('blog_title','Our Blog');
	}
	
	
	$thumbnail = false;
	if( has_post_thumbnail() ){
		$thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array('class' => 'background-image') );
	}

	//Page Title
	echo ebor_get_page_title( 
		$posttitle, 
		get_post_meta($post->ID, '_ebor_the_subtitle', 1), 
		get_post_meta($post->ID, '_ebor_page_title_icon', 1), 
		$thumbnail, 
		get_post_meta($post->ID, '_ebor_page_title_layout', 1) 
	);
?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row">
        	<?php get_template_part('inc/content-post', $layout); ?>
        </div>
    </div>
</section>

<?php get_footer();