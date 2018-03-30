(function($) {
	$('body, iframe').on('click','.vc_container_for_children.vc_empty-container, #vc_add-new-element, [data-vc-element="add-element-action"], .vc_controls [data-vc-control="add"], [data-vc-element="add-element-action"], #vc_add-new-element, .vc_control-btn-prepend, .vc_control-btn-append, .vc_controls [data-vc-control="prepend"], .vc_controls [data-vc-control="append"]',function() {
		$('#vc_ui-panel-add-element .vc_edit-form-tab-control button:contains("Ronneby 2.0")').click();
	});
	$(window).load(function() {
		if($('.composer-switch').length > 0) {
			$('#postdivrich').addClass('vc_enabled');
			
			if(!$('.composer-switch').hasClass('vc_backend-status'))
				$('#post-body-content').addClass('visible');

			$('body').on('click touchend', '.wpb_switch-to-composer', function() {
				$('#post-body-content').toggleClass('visible');
			});
		}
	});
})(jQuery);