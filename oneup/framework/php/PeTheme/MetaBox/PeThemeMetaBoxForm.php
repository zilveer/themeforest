<?php

class PeThemeMetaBoxForm extends PeThemeAdminForm {

	protected function template() {
		global $post_ID;
		$html = <<< EOT
<div class="pe_theme pe_mbox [CLASSES]" data-postID="$post_ID" data-options="[OPTIONS]">
	<div class="pe_theme_wrap">
		<!--info bar top-->
		<div class="contents clearfix">
			<div id="options_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all clearfix">
				[TABS_BODY]
			</div>
		</div>				
	</div>
	</div>												   
EOT;
		return $html;	
	}

	// nonce not needed in each metabox
	protected function getNonce() {
		return "";
	}

}

?>
