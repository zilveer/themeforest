jQuery(document).ready(function () {
	if (typeof(parent.InlineShortcodeViewContainerWithParent) != 'undefined') {
		//var controls = jQuery(parent.document.getElementById('vc_controls-template-default'));
		var controls = jQuery('#vc_controls-template-collection', window.parent.document);
		if (controls.length > 0) {
			// Assign classes to our shortcodes
			parent.InlineShortcodeView_trx_accordion = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_accordion_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_block = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_section = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_call_to_action = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_clients = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_clients_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_columns = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_column_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_form = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_form_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_content = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_gap = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_googlemap = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_googlemap_marker = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_list = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_list_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_parallax = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_popup = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_services = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_services_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_skills = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_skills_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_slider = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_slider_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_socials = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_social_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_tabs = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_tab = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_team = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_team_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_testimonials = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_testimonials_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
			parent.InlineShortcodeView_trx_toggles = parent.InlineShortcodeViewContainer.extend({
				controls_selector: '#vc_controls-template-collection'
			});
			parent.InlineShortcodeView_trx_toggles_item = parent.InlineShortcodeViewContainerWithParent.extend({
				controls_selector: '#vc_controls-template-collection-item'
			});
		}
	}
});
