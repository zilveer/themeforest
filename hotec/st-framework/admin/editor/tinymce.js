function init() {
    tinyMCEPopup.resizeToInnerSize();
}

function insertStshorcode(tagtext) {

    //var tagtext ='[abc]';
    if(typeof(tagtext)=='undefined'){
        return;
    }

    if(window.tinyMCE) {

        window.tinyMCE.activeEditor.insertContent(tagtext);
        //Peforms a clean up of the current editor HTML.
        //tinyMCEPopup.editor.execCommand('mceCleanup');
        //Repaints the editor. Sometimes the browser has graphic glitches.
        //tinyMCEPopup.editor.execCommand('mceRepaint');
        top.tinymce.activeEditor.windowManager.close();
    }
    return;
}
