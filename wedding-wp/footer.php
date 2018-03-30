<?php 

GLOBAL $webnus_options; 

/***************************************/
/*			Close  head line if woocommerce available
/***************************************/		

if( isset($post) ){
if( 'product' == get_post_type( $post->ID ))
{
echo '</section>';
}
}

?>

<?php
$footer_show = 'true';
if(isset($post))
{
GLOBAL $webnus_page_options_meta;
$footer_show_meta = isset($webnus_page_options_meta)?$webnus_page_options_meta->the_meta():null;
$footer_show =(isset($footer_show_meta) && is_array($footer_show_meta) && isset($footer_show_meta['webnus_page_options'][0]['webnus_footer_show']))?$footer_show_meta['webnus_page_options'][0]['webnus_footer_show']:null;
}

if ($footer_show != 'false') : ?>
	<footer id="footer" <?php if( 2 == $webnus_options->webnus_footer_color() ) echo 'class="litex"';?>>
	<section class="container footer-in">
	  <?php 
		
	/***************************************/
	/*			Loading footer type 1,2,3,4,5
	/*			Each footer has it's own behaviour
	/***************************************/		
		
		$footer_type = $webnus_options->webnus_footer_type();
	  
		get_template_part('parts/footer',$footer_type);
			  
	  ?>
	  </section>
	<!-- end-footer-in -->
	<?php 
	if( $webnus_options->webnus_footer_bottom_enable() )
		get_template_part('parts/footer','bottom'); 

	?>
	<!-- end-footbot -->
	</footer>
	<!-- end-footer -->
<?php endif; ?>


<span id="scroll-top"><a class="scrollup"><i class="fa-chevron-up"></i></a></span></div>
<!-- end-wrap -->
<!-- End Document
================================================== -->
<?php

	// sticky menu
	GLOBAL $webnus_options;
	$is_sticky = $webnus_options->webnus_header_sticky();
	$scrolls_value = $webnus_options->webnus_header_sticky_scrolls();
	$scrolls_value = !empty($scrolls_value) ? $scrolls_value : 150;
	if( $is_sticky == '1' ) :
		echo '
		<script type="text/javascript">
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
		</script>
		';
	endif;

	echo $webnus_options->webnus_space_before_body();
	wp_footer(); 
	
?>
</body>
</html>