<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new pulp_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="pulp-popup">

	<div id="zilla-shortcode-wrap">
		
		<div id="zilla-sc-form-wrap">
		
			<div id="zilla-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
				
			</div>
			<!-- /#zilla-sc-form-head -->

			<form method="post" id="zilla-sc-form">
			
				<table id="zilla-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary zilla-insert"><?php echo __('Insert Shortcode', 'morphis'); ?></a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#zilla-sc-form-table -->
				
			</form>
			<!-- /#zilla-sc-form -->
		
		</div>
		<!-- /#zilla-sc-form-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#zilla-shortcode-wrap -->

</div>
<!-- /#pulp-popup -->
<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/inc/shortcodes/tinymce/css/farb-popup.css' type='text/css' media='all' />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/shortcodes/tinymce/js/field_color.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	var tempLinkValue = '';	
	jQuery('#zilla_allow_lightbox').click( function() {		
		if(jQuery(this).is(":checked")) {			
			tempLinkValue = jQuery('#zilla_img_link_url').val();
			jQuery('#zilla_img_link_url').val("");	
			jQuery('#zilla_img_link_url').attr("disabled", "disabled");							
		} else {			
			jQuery('#zilla_img_link_url').val(tempLinkValue);
			jQuery('#zilla_img_link_url').removeAttr("disabled");			
		}		
	});	
});
</script>

</body>
</html>