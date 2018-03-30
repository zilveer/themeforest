<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = sanitize_text_field( trim( $_GET['popup'] ) );
$shortcode = new us_zilla_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="us_zilla-popup">

	<div id="us_zilla-shortcode-wrap">
		
		<div id="us_zilla-sc-form-wrap">
		
			<div id="us_zilla-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
			
			</div>
			<!-- /#us_zilla-sc-form-head -->

			<div class="us_zilla-sc-form-wrap">
			
			<form method="post" id="us_zilla-sc-form">
			
				<table id="us_zilla-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary us_zilla-insert">Insert Shortcode</a></td>
						</tr>
					</tbody>
				
				</table>
				<!-- /#us_zilla-sc-form-table -->
				
			</form>

			</div>
			<!-- /#us_zilla-sc-form -->
		
		</div>
		<!-- /#us_zilla-sc-form-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#us_zilla-shortcode-wrap -->

</div>
<!-- /#us_zilla-popup -->

</body>
</html>