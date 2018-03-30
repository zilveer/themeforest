function init() {
    tinyMCEPopup.resizeToInnerSize();
}

function submitData($form) {
    try {
        $form = $form || jQuery('form');
        if(parent.tinymce){
            var selectedContent = tinyMCE.activeEditor.selection.getContent(),
                id = tinyMCE.activeEditor.editorId || 'content',
                shortcodeName = $form.attr('name'),
                shortcode = ' [' + shortcodeName + ' ';

            $form.find('[data-name]').each(function() {
                var $this	=	jQuery(this),
                    type	=	$this.data('type'),
                    value	=	($this.attr('type') == 'checkbox')
                        ?	($this.is(':checked')) ? 'on' : ''
                        :	$this.val() || '';
                value = fitValue(type, value);
                shortcode += $this.data('name') + '="' + value + '" ';
            });
            shortcode += ']' + selectedContent + '[/' + shortcodeName + '] ';

            parent.tinymce.activeEditor.execCommand('mceInsertContent',false,shortcode);
            tinyMCEPopup.editor.execCommand('mceRepaint');
            tinyMCEPopup.close();
        }
    } catch (e) {
        console.error(e);
    }
    return;
}

function fitValue(type, value) {
    switch(type) {
        case 'url':
            var pattern = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            if (!pattern.test(value)) {
                alert('email is not valid');
                throw 'email is not valid';
            }
            break;
        case 'number':
            value = parseInt(value, 10);
            break;
        default:
            break;
    }
    return value;
}