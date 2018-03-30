<?php
/**
 * Footer template part
 */
?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<footer>
	<div class="mkdf-footer-inner clearfix">
		<?php
			if($display_footer_top) {
				hashmag_mikado_get_footer_top();
			}
			if($display_footer_bottom) {
				hashmag_mikado_get_footer_bottom();
			}
		?>
	</div>
</footer>

</div> <!-- close div.mkdf-wrapper-inner  -->
</div> <!-- close div.mkdf-wrapper -->
<?php wp_footer(); ?>
</body>
</html>