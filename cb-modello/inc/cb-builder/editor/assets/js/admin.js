/**
 * WP Editor Widget object
 */
WPEditorWidget = {
	
	/** 
	 * @var string
	 */
	currentContentId: '',

	/**
	 * Show the editor
	 * @param string contentId
	 */
	showEditor: function(contentId) {
		jQuery('#wp-editor-widget-backdrop').show();
		jQuery('#wp-editor-widget-container').show();

		this.currentContentId = contentId;

		this.setEditorContent(contentId);
        return false;
	},

	/**
	 * Hide editor
	 */
	hideEditor: function() {
		jQuery('#wp-editor-widget-backdrop').hide();
		jQuery('#wp-editor-widget-container').hide();
			window.onbeforeunload = null;
	},

	/**
	 * Set editor content
	 */
	setEditorContent: function(contentId) {

		var editor = tinyMCE.EditorManager.get('wp-editor-widget');

		if (typeof editor == "undefined") {
			jQuery('#wp-editor-widget').val(jQuery('#'+ contentId).val());
		}
		else {
            if(jQuery('#wp-wp-editor-widget-wrap').hasClass('tmce-active'))
                editor.setContent(jQuery('#'+ contentId).val());
            else
                jQuery('#wp-editor-widget').val(jQuery('#'+ contentId).val());

		}
	},

	/**
	 * Update widget and close the editor
	 */
	updateWidgetAndCloseEditor: function() {
		var editor = tinyMCE.EditorManager.get('wp-editor-widget');
        var content ='';


		if (typeof editor == "undefined") {
            content= jQuery('#wp-editor-widget').val();
		}
		else {

            if(jQuery('#wp-wp-editor-widget-wrap').hasClass('tmce-active'))
                content = editor.getContent();
            else
                content= jQuery('#wp-editor-widget').val();
		}
        jQuery('#'+ this.currentContentId).val(content);
        jQuery('#'+ this.currentContentId+'_editor').html(content);
        jQuery('#'+ this.currentContentId+'_preview').html(content);
        
		this.hideEditor();
	}
	
};
