<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new icy_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="icy-popup">

	<div id="icy-shortcode-wrap">
		
		<div id="icy-sc-form-wrap">
		
			<div id="icy-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
			
			</div>
			<!-- /#icy-sc-form-head -->
			
			<form method="post" id="icy-sc-form">
			
				<table id="icy-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary icy-insert">Insert Shortcode</a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#icy-sc-form-table -->
				
			</form>
			<!-- /#icy-sc-form -->
		
		</div>
		<!-- /#icy-sc-form-wrap -->
		
		<div id="icy-sc-preview-wrap">
		
			<div id="icy-sc-preview-head">
		
				Shortcode Preview
					
			</div>
			<!-- /#icy-sc-preview-head -->
			
			<?php if( $shortcode->no_preview ) : ?>
			<div id="icy-sc-nopreview">Shortcode has no preview</div>		
			<?php else : ?>			
			<iframe src="<?php echo ICY_TINYMCE_URI; ?>/preview.php?sc=" width="249" frameborder="0" id="icy-sc-preview"></iframe>
			<?php endif; ?>
			
		</div>
		<!-- /#icy-sc-preview-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#icy-shortcode-wrap -->

</div>
<!-- /#icy-popup -->

</body>
</html>