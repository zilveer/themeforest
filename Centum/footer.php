<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Centum
 */
?>
</div>
</div>
<!-- Wrapper / End -->


<!-- Footer Start -->
<div id="footer">

 	<div class="container">
        <?php $footer_layout = ot_get_option('pp_footer_widgets','5,3,3,5');
        $footer_layout_array = explode(',', $footer_layout); 
        $x = 0;
        foreach ($footer_layout_array as $value) {
            $x++;
             ?>
             <div class="<?php echo incr_number_to_width($value); ?> columns">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer'.$x)) : endif; ?>
            </div>
        <?php } ?>

        <div class="sixteen columns">
			<div id="footer-bottom">
				<?php $copyrights = ot_get_option('copyrights' );  echo $copyrights?>
				<div id="scroll-top-top"><a href="#"></a></div>
			</div>
		</div>

    </div>

</div>
<!-- Footer End -->


<?php wp_footer(); ?>

</body>
</html>