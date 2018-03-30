<?php

require_once( 'shortcode_template.php' );
require_once( 'field_generators/formgenerator.php' );

//Get type of the shortcode
$type = trim($_GET['type']);
$form = new FormGenerator($type, $pxScTemplate[$type]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>

	<div id="px-sc" class="<?php if($form->HasPreview()){ echo "px-sc-has-preview"; } ?>">
			<div class="px-sc-wrap">
				<form action="/" method="post">
					<fieldset>
						<?php echo $form->ToString(); ?>
						<div class="px-separator"><span></span></div>
						<div class="px-submit-container clear-parent">
							<a  href="#" class="px-submit">Insert Shortcode</a>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="px-sc-preview-wrap">
				<div class="px-sc-head">
					<div>
						<h3>Shortcode Preview</h3>
						<a href="#"></a>
					</div>
				</div>
				<div class="px-sc-preview">
					<iframe id="px-sc-preview-frame" src="<?php echo MCE_URI; ?>/preview.php" frameborder="0"></iframe>
				</div>
			</div>
			<div class="clear"></div>
	</div>

</body>
</html>