<?php get_header();
	$vbegy_sidebar_all = rwmb_meta('vbegy_sidebar','select',$post->ID);
	if (has_post_thumbnail()) {
    	$post_type = " image_post";
	}else {
    	$post_type = " no_image_post";
	}?>
	<article <?php post_class('post clearfix '.$post_type);?> role="article" itemscope="" itemtype="http://schema.org/Article">
		<div class="post-wrap">
    		<div class="post-inner">
				<div class="post-inner-content">
					<?php woocommerce_content(); ?>
				</div>
    			<div class="clearfix"></div>
    		</div><!-- End post-inner -->
		</div><!-- End post-wrap -->
	</article><!-- End post -->
	
<?php get_footer();?>