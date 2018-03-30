<?php if(is_tax() && taxonomy_exists('portfolio-category')) { 
 include('portfolio-list.php');

 } else { 
	 
	 global $tpl_body_arhive_id;
	 $tpl_body_id = 'blog_overview';
	 $tpl_body_arhive_id = 'blog_overview_archive';
	 get_header(); 
	 global $postParentPageID,$data;
	 $postParentPageID = $post->ID; //Page POSTID
	 get_template_part( 'loop' ); ?>

<?php } ?>			

<?php get_footer(); ?>