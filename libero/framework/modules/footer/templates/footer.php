<?php
/**
 * Footer template part
 */

libero_mikado_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<footer <?php libero_mikado_class_attribute($footer_classes); ?>>
	<div class="mkd-footer-inner clearfix">

		<?php

		if($display_footer_top) {
			libero_mikado_get_footer_top();
		}
		if($display_footer_bottom) {
			libero_mikado_get_footer_bottom();
		}
		?>

	</div>
</footer>

</div> <!-- close div.mkd-wrapper-inner  -->
</div> <!-- close div.mkd-wrapper -->
<?php wp_footer(); ?>
</body>
</html>