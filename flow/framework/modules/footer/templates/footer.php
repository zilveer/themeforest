<?php
/**
 * Footer template part
 */

flow_elated_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<?php if (!isset($_REQUEST["ajax_req"]) || $_REQUEST["ajax_req"] != 'yes') { ?>
<footer <?php flow_elated_class_attribute($footer_classes); ?>>
	<div class="eltd-footer-inner clearfix">

		<?php

		if($display_footer_top) {
			flow_elated_get_footer_top();
		}
		if($display_footer_bottom) {
			flow_elated_get_footer_bottom();
		}
		?>

	</div>
</footer>
<?php } ?>

</div> <!-- close div.eltd-wrapper-inner  -->
</div> <!-- close div.eltd-wrapper -->
<?php wp_footer(); ?>
</body>
</html>