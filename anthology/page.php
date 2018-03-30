<?php
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		$subtitle=get_post_meta($post->ID, 'subtitle_value', true);
		$slider=get_post_meta($post->ID, 'slider_value', $single = true);
		$layout=get_post_meta($post->ID, 'layout_value', true);
		if($layout==''){
			$layout='right';
		}
		$show_title=get_opt('_show_page_title');
		$sidebar=get_post_meta($post->ID, 'sidebar_value', $single = true);
		if($sidebar=='' || $sidebar=='default'){
			$sidebar='page';
		}
		
		include(TEMPLATEPATH . '/includes/page-header.php');
?>

<div id="content-container" class="center <?php echo $layoutclass; ?> ">
<div id="<?php echo $content_id; ?>">
	   <!--content-->
    <?php 
    
    if($show_title!='off'){?>
    	<h1 class="page-heading"><?php the_title(); ?></h1><hr/><hr/>	
    <?php }

the_content();
	}
}

?>

  </div>
<?php 
if($layout!='full'){
	print_sidebar($sidebar);
}
?>

  </div>
<?php
get_footer();
?>

