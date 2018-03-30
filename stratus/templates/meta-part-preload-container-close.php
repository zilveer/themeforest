<?php
//-----------------------------------------------------
// Preloader, Section, Container Close
//-----------------------------------------------------
?>
<?php echo wp_kses_post($inner_container_close);?>
</section>
</div>

<?php
//-----------------------------------------------------
// backstretch for mobile support
//-----------------------------------------------------
if ($background_js > ""){ ?>
	<script>
	jQuery(document).ready(function($) {
		"use strict";
		if (Modernizr.touch) {
			<?php echo sanitize_text_field($background_js);  ?>
		}
	});
	</script>
<?php } ?>