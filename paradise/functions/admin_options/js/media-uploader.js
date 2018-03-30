var mediaUploader = {
	OptionUploaderUseThisImage : function(id){
		
		var win = window.dialogArguments || opener || parent || top;
		
		win.theme.themeOptionGetImage(id);
		win.tb_remove();
		
	}
}
