<?php
get_header();


$subtitle=get_opt("_posts_subtitle");
$slider=get_opt('_home_slider');
$layout=get_opt('_blog_layout');

include(TEMPLATEPATH . '/includes/page-header.php');

?>


<div id="content-container" class="center <?php echo $layoutclass; ?> ">
<div id="<?php echo $content_id; ?>"><?php


if(have_posts()){
	while(have_posts()){
		the_post();
		global $more;
		$more = 0;
		
	include(TEMPLATEPATH . '/includes/post-template.php');	
		
	} 
	print_pagination(); 

}else{
	echo ('<p>'.get_opt('_no_results_text').'</p>');
} ?> 

</div>

<?php 
if($layout!='full'){
print_sidebar(get_opt('_blog_sidebar')); 
}?>


</div>
<?php
get_footer();
?>
