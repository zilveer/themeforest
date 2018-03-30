<?php	 		 	
	// Template Name: Blank Template
?>
<?php get_header(); ?>
<style>
.oi_head_holder, .oi_tag_line, .oi_footer_holder_main{ display:none;}
.oi_content_holder { margin-top:0px !important;}
.oi_vc_page_holder { padding-top:0px;}
body { background:#fff; overflow:hidden}
</style>
<script>
jQuery.noConflict()(function($){
	$('.oi_page_holder_custom').css('margin-top',($(window).outerHeight() - $('.oi_page_holder_custom').outerHeight())/2);
});
</script>
<div class="oi_vc_page_holder">
	<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<div class="container">
        <div class="oi_page_holder_custom">
            <?php the_content();  ?>
        </div>
        </div>
    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>