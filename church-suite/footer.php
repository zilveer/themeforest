<?php
$webnus_options = webnus_options(); 

/***************************************/
/*	Close  head line if woocommerce available
/***************************************/		
if( isset($post) ){
	if( 'product' == get_post_type( $post->ID )){
		echo '</section>';
	}
}
$footer_show = 'true';
if(isset($post)){
	GLOBAL $webnus_page_options_meta;
	$footer_show_meta = isset($webnus_page_options_meta)?$webnus_page_options_meta->the_meta():null;
	$footer_show =(isset($footer_show_meta) && is_array($footer_show_meta) && isset($footer_show_meta['webnus_page_options'][0]['webnus_footer_show']))?$footer_show_meta['webnus_page_options'][0]['webnus_footer_show']:null;
} ?>	
<section id="pre-footer">	
<?php //start footer bars
$webnus_options['webnus_footer_instagram_bar'] = isset( $webnus_options['webnus_footer_instagram_bar'] ) ? $webnus_options['webnus_footer_instagram_bar'] : '';
$webnus_options['webnus_footer_social_bar'] = isset( $webnus_options['webnus_footer_social_bar'] ) ? $webnus_options['webnus_footer_social_bar'] : '';
$webnus_options['webnus_footer_subscribe_bar'] = isset( $webnus_options['webnus_footer_subscribe_bar'] ) ? $webnus_options['webnus_footer_subscribe_bar'] : '';
if( $webnus_options['webnus_footer_instagram_bar'] )
	get_template_part('parts/instagram-bar');
if( $webnus_options['webnus_footer_social_bar'] )
	get_template_part('parts/social-bar');
if( $webnus_options['webnus_footer_subscribe_bar'] )
	get_template_part('parts/subscribe-bar');
?>
</section>
<?php
$webnus_options['webnus_footer_color'] = isset( $webnus_options['webnus_footer_color'] ) ? $webnus_options['webnus_footer_color'] : '';
$webnus_options['webnus_footer_type'] = isset( $webnus_options['webnus_footer_type'] ) ? $webnus_options['webnus_footer_type'] : '';
if ($footer_show != 'false') : ?>
	<footer id="footer" <?php if( $webnus_options['webnus_footer_color'] == 2 ) echo 'class="litex"';?>>
	<section class="container footer-in">
	<div class="row">
	<?php $footer_type = $webnus_options['webnus_footer_type'];
	switch($footer_type){
	case 1: ?>
	<div class="col-md-4"><?php dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-4"><?php dynamic_sidebar('footer-section-2'); ?></div>
	<div class="col-md-4"><?php dynamic_sidebar('footer-section-3'); ?></div>
	<?php break;
	case 2: ?>
	<div class="col-md-3"><?php dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-3"><?php dynamic_sidebar('footer-section-2'); ?></div>
	<div class="col-md-3"><?php dynamic_sidebar('footer-section-3'); ?></div>
	<div class="col-md-3"><?php dynamic_sidebar('footer-section-4'); ?></div>
	<?php break;
	case 3: ?>
	<div class="col-md-6"><?php dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-3"><?php dynamic_sidebar('footer-section-2'); ?></div>
	<div class="col-md-3"><?php dynamic_sidebar('footer-section-3'); ?></div>
	<?php break;
	case 4: ?>
	<div class="col-md-3"><?php dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-3"><?php dynamic_sidebar('footer-section-2'); ?></div>
	<div class="col-md-6"><?php dynamic_sidebar('footer-section-3'); ?></div>
	<?php break;
	case 5: ?>
	<div class="col-md-6"><?php dynamic_sidebar('footer-section-1'); ?></div>
	<div class="col-md-6"><?php dynamic_sidebar('footer-section-2'); ?></div>
	<?php break;
	case 6: ?>
	<div class="col-md-12"><?php dynamic_sidebar('footer-section-1'); ?></div>
	<?php break;
	 } ?>
	 </div>
	 </section>
	<!-- end-footer-in -->
	<?php
	$webnus_options['webnus_footer_bottom_enable'] = isset( $webnus_options['webnus_footer_bottom_enable'] ) ? $webnus_options['webnus_footer_bottom_enable'] : '';
	if( $webnus_options['webnus_footer_bottom_enable'] )
		get_template_part('parts/footer','bottom'); ?>
	<!-- end-footbot -->
	</footer>
	<!-- end-footer -->
<?php endif; ?>

<?php
	$webnus_options['webnus_scrollup'] = isset( $webnus_options['webnus_scrollup'] ) ? $webnus_options['webnus_scrollup'] : '';
	if($webnus_options['webnus_scrollup'])
	echo '<span id="scroll-top"><a class="scrollup"><i class="fa-chevron-up"></i></a></span></div>';
?>

<!-- end-wrap -->
<!-- End Document
================================================== -->
<?php
// sticky menu
$webnus_options['webnus_header_sticky'] = isset( $webnus_options['webnus_header_sticky'] ) ? $webnus_options['webnus_header_sticky'] : '';
$webnus_options['webnus_header_sticky_scrolls'] = isset( $webnus_options['webnus_header_sticky_scrolls'] ) ? $webnus_options['webnus_header_sticky_scrolls'] : '';
$is_sticky = $webnus_options['webnus_header_sticky'];
$scrolls_value = $webnus_options['webnus_header_sticky_scrolls'];
$scrolls_value = !empty($scrolls_value) ? $scrolls_value : 150;
if( $is_sticky == '1' ) :
	echo '<script type="text/javascript">
		jQuery(document).ready(function(){ 
			jQuery(function() {
				var header = jQuery("#header.horizontal-w");
				var navHomeY = header.offset().top;
				var isFixed = false;
				var scrolls_pure = parseInt("' . $scrolls_value . '");
				var $w = jQuery(window);
				$w.scroll(function(e) {
					var scrollTop = $w.scrollTop();
					var shouldBeFixed = scrollTop > scrolls_pure;
					if (shouldBeFixed && !isFixed) {
						header.addClass("sticky");
						isFixed = true;
					}
					else if (!shouldBeFixed && isFixed) {
						header.removeClass("sticky");
						isFixed = false;
					}
					e.preventDefault();
				});
			});
		});
	</script>';
endif;
$webnus_options['webnus_space_before_body'] = isset( $webnus_options['webnus_space_before_body'] ) ? $webnus_options['webnus_space_before_body'] : '';
echo $webnus_options['webnus_space_before_body'];
wp_footer(); ?>
</body>
</html>