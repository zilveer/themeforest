(function($) {
	$('body, iframe').on('click','.vc_container_for_children.vc_empty-container, #vc_add-new-element, [data-vc-element="add-element-action"], .vc_controls [data-vc-control="add"], [data-vc-element="add-element-action"], #vc_add-new-element, .vc_control-btn-prepend, .vc_control-btn-append, .vc_controls [data-vc-control="prepend"], .vc_controls [data-vc-control="append"]',function() {
		$('#vc_ui-panel-add-element .vc_edit-form-tab-control button:contains("Ronneby 2.0")').click();
	});
	$(window).load(function() {
		if(typeof vc !== undefined && typeof vc.events !== undefined) {
			if($('.composer-switch').length && $('.composer-switch').hasClass('vc_backend-status')) {
				if(!$('#postdivrich').hasClass('vc_enabled'))
					$('#postdivrich').addClass('vc_enabled');
			}

			vc.events.on('vc:backend_editor:switch', function() {
				if(typeof vc.app.status !== undefined) {
					if(vc.app.status == 'shown') {
						$('#postdivrich').removeClass('visible');
					} else {
						$('#postdivrich').addClass('visible');
					}
				}
			});
		}
	});
})(jQuery);