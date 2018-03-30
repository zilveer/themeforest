<!-- Breakout Row -->
<?php if(get_option_tree('homepage_breakout_section') == 'on') { ?>
<?php get_template_part( 'element', 'breakoutrow' ); ?>
<?php } ?>


<!-- ============================================== -->


<!-- Super Container | Footer Widget Space (Optional) -->
<?php if (get_option_tree('footer_widgets') == 'on') { ?>
<div class="super-container full-width" id="section-footer">

<!-- 960 Container -->
<div class="container">
<!-- footer -->
<footer>
<div class="sixteen columns" id="header">
<br />
<!-- 1/4 -->
<div class="five columns alpha">
<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-1') ) ?>
</div>
<!-- /End 1/4 -->
<!-- 2/4 -->
<div class="five columns">
<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-2') ) ?>
</div>
<!-- /End 2/4 -->
<!-- 3/4 -->
<div class="three columns">
<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-3') ) ?>
</div>
<!-- /End 3/4 -->
<!-- 4/4 -->
<div class="three columns omega">
<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-4') ) ?>
</div>
<!-- /End 4/4 -->
<br />
</div>
</footer>
<!-- /End Footer -->

</div>
<!-- /End 960 Container -->
</div>
<!-- /End Super Container -->
<?php } else{} ?>


<!-- ============================================== -->


<!-- Super Container - SubFooter Space -->
<div class="super-container full-width" id="section-sub-footer">

<!-- 960 Container -->
<div class="container">

<div class="sixteen columns">
<?php if (get_option_tree('footer_blurb_left')) : ?><span class="copyright"><?php echo get_option_tree('footer_blurb_left'); ?></span><?php endif; ?>
<?php if (get_option_tree('footer_social') == 'on') { ?>
	<?php get_template_part( 'element', 'getsocial' ); ?>
<?php } else{} ?>
<?php if (get_option_tree('footer_blurb_right')) : ?><span class="colophon"><?php echo get_option_tree('footer_blurb_right'); ?></span><?php endif; ?>
</div>

</div>
<!-- /End 960 Container -->
</div>
<!-- /End Super Container -->



<!-- Default Portfolio View - Grabs the variable set in the template-xxx.php files -->
<?php
if(isset($GLOBALS['portfolio_view']) && $GLOBALS[ 'portfolio_view' ] == 'Hybrid') : ?>

<script type="text/javascript">
(function($) {
// Hybrid View Defaults
jQuery("#portfolio-list .module-container").removeClass("sixteen columns").addClass("columns");
jQuery("#portfolio-list .module-img").removeClass("twelve columns alpha");
jQuery("#portfolio-list .module-meta").fadeIn(300).removeClass("omega").addClass("columns alpha visible");
jQuery(".list_btn").css("opacity","1");
jQuery(".hybrid_btn").css("opacity","0.5");
jQuery(".grid_btn").css("opacity","1");
})(jQuery);
</script>

<?php elseif(isset($GLOBALS['portfolio_view']) && $GLOBALS[ 'portfolio_view' ] == 'List') : ?>

<script type="text/javascript">
(function($) {
// List View Defaults
jQuery("#portfolio-list .module-container").removeClass("four one-third columns").addClass("sixteen columns");
jQuery("#portfolio-list .module-img").addClass("twelve columns alpha");
jQuery("#portfolio-list .module-meta").fadeIn(300).removeClass("alpha").addClass("four columns omega visible");
jQuery(".list_btn").css("opacity","0.5");
jQuery(".hybrid_btn").css("opacity","1");
jQuery(".grid_btn").css("opacity","1");
})(jQuery);
</script>
<?php else : ?>
<script type="text/javascript">
(function($) {
// Grid View Defaults
// $("#portfolio-list .module-container").removeClass("sixteen columns").addClass("four columns");
// $("#portfolio-list .module-img").removeClass("twelve columns alpha");
// $("#portfolio-list .module-meta").fadeOut(100).removeClass("four columns alpha omega visible");
jQuery(".list_btn").css("opacity","1");
jQuery(".hybrid_btn").css("opacity","1");
jQuery(".grid_btn").css("opacity","0.5");
})(jQuery);
</script>
<?php endif; ?>
<!-- End Default Portfolio View -->

<?php wp_footer(); ?>
<?php get_template_part( 'element', 'slidervars' ); ?>

</body>
</html>