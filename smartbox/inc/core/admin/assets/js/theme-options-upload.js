var oxyThemeOptions = {
    mediaOptionSelectImage : function( inputID, url, postID ) {
        parent.updateImageOption( inputID, url, postID );
        var win = window.dialogArguments || opener || parent || top;
        win.tb_remove();
    }
}