<?php
/**
 * Footer
 * @package by Theme Record
 * @auther: MattMao
 */
?>

<!--Begin Footer-->
<footer>

<?php theme_footer_widgets(); ?>

<?php theme_footer_contact_info(); ?>

<div class="footer-message">
<div class="col-width clearfix">
	<div class="footer-left-section">
	<?php if (has_nav_menu('bottom menu')) { theme_bottom_wp_nav(); } ?>
	<?php theme_site_copyright(); ?>
	</div>

	<?php theme_social_networking(); ?>
</div>
</div>

<!--End Footer-->
</footer>

</div>
<!-- # page -->

<div id="toTop">Back to top</div>

<?php wp_footer(); ?>
<!--End Body-->
</body>

<!--End Html-->
</html>