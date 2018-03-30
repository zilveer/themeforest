<?php
/**
 * Template for displaying backgrounds on homepage, blog pages and category pages.
 *
 * @package StagFramework
 * @subpackage Crux
 */

if ( stag_if_contains_backgrounds() && stag_get_background() ) : ?>
	<div class="custom-background--wrapper">
		<div id="custom-background" class="custom-background">
			<script type="text/javascript">
				jQuery(document).ready(function($){
					$('#custom-background').backstretch("<?php echo esc_url( stag_get_background() ); ?>");
				});
			</script>
		</div><!-- .custom-background -->
	</div><!-- .custom-background-wrapper -->
<?php endif; ?>
