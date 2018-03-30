<?php 
/**
 * Template Name: Portfolio Template
 */

get_header(); /* get the header */

	if(@$_GET['info']=='description'){
		echo $pageDescription;
		exit; 
	}elseif(@$_GET['info']=='title'){
		wp_title( '|', true, 'right' );
		exit;
	}elseif(@$_GET['info']=='page'){
		if(have_posts())
		{
			the_post();
			$postID	= get_the_ID();
			$content = get_the_content();
			$content = apply_filters('the_content', $content);
			$title = get_the_title();
			echo $content;
		}
	}else{
		redirectWithEscapeFragment();
	}
?> 
