<?php
/*
 Template Name: Home page
 */

get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		$title=get_the_title();
		$pageId=get_the_ID();
		$subtitle=get_post_meta($pageId, 'subtitle_value', true);
		$slider=get_post_meta($pageId, 'slider_value', true);	 

		include(TEMPLATEPATH . '/includes/page-header.php');
?>

<div id="content-container" class="center">
   
	   <!--content-->
    <?php 
the_content();
	}
}
?>   

    <div >
<?php 
for($i=1; $i<=3; $i++){
	$suf=$i==3?'-3':'';
	?>
	 <div class="services-box three-columns<?php echo $suf; ?>">
	 <h4><span><?php echo get_opt('_home_box_title'.$i); ?></span></h4>
        <?php echo get_opt('_home_box_desc'.$i); ?> <br/>
        <img src="<?php echo get_opt('_home_box_icon'.$i); ?>" alt="img" /> <a href="<?php echo get_opt('_home_box_btn_link'.$i); ?>" class="button"><span><?php echo get_opt('_home_box_btn_text'.$i); ?></span></a> </div>
<?php }
?>
</div>
</div>

<?php
get_footer();
?>