<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the header content
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit;

do_action('widget_area_manager_hook','content_bottom');
?>

<div class="clear"></div>

</div> <!-- inner_wrapper -->
</div> <!-- inner_content -->

<div id="footer">
	<div id="footer_left"></div>
	<div id="footer_right"></div>
</div> <!-- footer -->
<div class="clear"></div>
<?php
// after content widget area (optional)
do_action('widget_area_manager_hook','footer');
?>
</div> <!-- wrapper -->
</div> <!-- holder -->

<?php wp_footer(); ?>
</body>
</html>
