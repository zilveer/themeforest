<?php
get_header();

		$subtitle='';
		$slider='none';
		$layout=get_opt('_blog_layout');
		if($layout==''){
			$layout='right';
		}
		
		include(TEMPLATEPATH . '/includes/page-header.php');
?>

<div id="content-container" class="center <?php echo $layoutclass; ?> ">
<div id="<?php echo $content_id; ?>">

<h2><?php echo get_opt('_404_text'); ?></h2>

  </div>
<?php 
if($layout!='full'){
	print_sidebar(get_opt('_blog_sidebar'));
}
?>

  </div>
<?php
get_footer();
?>

