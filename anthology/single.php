<?php
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		$id=get_the_ID();
		$cat=get_the_category();
		$postTitle=get_the_title();
		$post_type=get_post_type( $post );
		$subtitle='';
		$slider='none';
		
		
		if($post_type=='post'){
			$layout=get_opt('_blog_layout');
		}else if($post_type=='portfolio'){   
			$layout=get_opt('_portfolio_layout');
		}
		
		include(TEMPLATEPATH . '/includes/page-header.php');
	
		 
		?>
		
		<div id="content-container" class="center <?php echo $layoutclass; ?> ">
		<div id="<?php echo $content_id; ?>">
		<!--content-->
	   	<?php


		if($post_type=='post'){
			include(TEMPLATEPATH . '/includes/single-blog.php');
		}else if($post_type=='portfolio'){   
		    include(TEMPLATEPATH . '/includes/single-portfolio.php');
		}

	}
}


if($layout!='full' && $post_type=='post'){
	print_sidebar(get_opt('_blog_sidebar'));
}elseif($layout!='full' && $post_type=='portfolio'){
	print_sidebar(get_opt('_portfolio_sidebar')); 
}

?>

</div>
<?php get_footer();   ?>
