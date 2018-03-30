<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

//added security check
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) wp_die(__("You are not allowed to be here","tt_theme_framework"));

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new tt_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="tt-popup">

	<div id="tt-shortcode-wrap">
		
		<div id="tt-sc-form-wrap">
		
			<form method="post" id="tt-sc-form">
			
				<table id="tt-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="tt-insert button media-button button-primary button-large media-button-insert">Insert Shortcode</a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#tt-sc-form-table -->
				
			</form>
			<!-- /#tt-sc-form -->
		
		</div>
		<!-- /#tt-sc-form-wrap -->
		
		<div id="tt-sc-preview-wrap">
		
			<div id="tt-sc-preview-head">
		
				Shortcode Preview
					
			</div>
			<!-- /#tt-sc-preview-head -->
			
			<?php if( $shortcode->no_preview ) : ?>
			<div id="tt-sc-nopreview">This shortcode has no preview</div>		
			<?php else : ?>			
			<iframe src="<?php echo TT_TINYMCE_URI; ?>/preview.php?sc=" width="249" frameborder="0" id="tt-sc-preview"></iframe>
			<?php endif; ?>
			
		</div>
		<!-- /#tt-sc-preview-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#tt-shortcode-wrap -->

</div>
<!-- /#tt-popup -->

</body>
</html>