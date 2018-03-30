<?php
/**
 * The template for displaying the footer.
 *
 * @package shift_cv
 */
?>
    </div><!-- #main -->
	
	<footer id="footer" class="site_footer" role="contentinfo">
		<div class="footer_copyright">
			<?php
				echo get_theme_option('footer_copyright')
			?>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
<a href="#" id="toTop"></a>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery.reject({
			reject : {
				all: false, // Nothing blocked
				msie5: true, msie6: true, msie7: true // Covers MSIE 5-7
				/*
				 * Possibilities are endless...
				 *
				 * // MSIE Flags (Global, 5-8)
				 * msie, msie5, msie6, msie7, msie8,
				 * // Firefox Flags (Global, 1-3)
				 * firefox, firefox1, firefox2, firefox3,
				 * // Konqueror Flags (Global, 1-3)
				 * konqueror, konqueror1, konqueror2, konqueror3,
				 * // Chrome Flags (Global, 1-4)
				 * chrome, chrome1, chrome2, chrome3, chrome4,
				 * // Safari Flags (Global, 1-4)
				 * safari, safari2, safari3, safari4,
				 * // Opera Flags (Global, 7-10)
				 * opera, opera7, opera8, opera9, opera10,
				 * // Rendering Engines (Gecko, Webkit, Trident, KHTML, Presto)
				 * gecko, webkit, trident, khtml, presto,
				 * // Operating Systems (Win, Mac, Linux, Solaris, iPhone)
				 * win, mac, linux, solaris, iphone,
				 * unknown // Unknown covers everything else
				 */
			},
            imagePath: '<?php echo get_template_directory_uri(); ?>/js/jreject/images/',
            header: 'Your browser is out of date', // Header Text
            paragraph1: 'You are currently using an unsupported browser', // Paragraph 1
            paragraph2: 'Please install one of the many optional browsers below to proceed',
            closeMessage: 'Close this window at your own demise!' // Message below close window link
        });
    });
        empt = '<?php _e("Name field can not be empty", "wpspace"); ?>';
        to_lng = '<?php _e("Too long name field", "wpspace"); ?>';
        to_lng = '<?php _e("Too long name field", "wpspace"); ?>';
        empt_mail = '<?php _e("Too short (or empty) email address", "wpspace"); ?>';
        to_lng_mail = '<?php _e("Too long email address", "wpspace"); ?>';
        incor = '<?php _e("Incorrect email address", "wpspace"); ?>';
        mes_empt = '<?php _e("message can not be empty", "wpspace"); ?>';
        to_lng_mes = '<?php _e("Too long message", "wpspace"); ?>';
        <?php if(!isset($_COOKIE['tab_index'])): ?>
        init_ind = <?php echo get_theme_option('expanded_section') != '' ? get_theme_option('expanded_section') : -1; ?>
        <?php else: ?>
        init_ind = <?php echo $_COOKIE['tab_index']; ?>
        <?php endif; ?>
</script>
</body>
</html>