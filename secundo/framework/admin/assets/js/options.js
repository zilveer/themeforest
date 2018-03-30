jQuery(document).ready(function () {
    var cmStyle = CodeMirror.fromTextArea(document.getElementById("code_custom_styles_css"), {
        mode: "text/css",
        lineNumbers: true,
        styleActiveLine: true,
        matchBrackets: true
    });
    var cmJs = CodeMirror.fromTextArea(document.getElementById("code_custom_styles_js"), {
        mode: "text/javascript",
        lineNumbers: true,
        styleActiveLine: true,
        matchBrackets: true
    });

    //we need to refresh them because by default they are hidden
    var group = jQuery('#code_custom_styles_css').closest('.nhp-opts-group-tab');
    jQuery('#' + group.attr('id') + "_li").click(function () {
        refreshEditors();
        setTimeout(refreshEditors, 500);
    });

    function refreshEditors() {
        console.log('refresh');
        cmStyle.refresh();
        cmJs.refresh();
    }

});