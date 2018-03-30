
    var Editor = new Object();
    Editor.pos = 0;
    Editor.spos = 0;
    Editor.AddText = function (id, text) {
        jQuery(document).ready(function () {
            var editor = jQuery('textarea#' + id);
            if (editor.is(':visible')) {
                editor = document.getElementById(id);
                var pos = Editor.GetPosition(editor);
                if (parseInt(pos).toString() != "NaN") {
                    if (Editor.spos == pos) {
                        pos = Editor.pos;
                    } else {
                        Editor.spos = pos;
                    }
                } else {
                    pos = parseInt(editor.value.toString().length);
                    Editor.spos = pos;
                }

                var value = editor.value.substring(0, pos) + text + editor.value.substring(pos + 1, editor.value.length);
                value = value.replace(/-br-/gi, "");
                editor.value = value;
                Editor.pos = pos + parseInt(text.length);

            } else {
                text = text.replace(/\n/gi, "");
                text = text.replace(/\t/gi, "");
                text = text.replace(/-br-/gi, "<br />");
                tinyMCE.activeEditor.execCommand("mceInsertContent", true, text);
            }
        });
    };

    Editor.GetPosition = function (editor) {
        try {
            if (editor.selectionStart) {
                return editor.selectionStart;
            } else if (document.selection) {
                editor.focus();
                var r = document.selection.createRange();
                if (r == null) {
                    return "undefined";
                }

                var re = editor.createTextRange(),
                    rc = re.duplicate();
                re.moveToBookmark(r.getBookmark());
                rc.setEndPoint('EndToStart', re);
                return rc.text.length;
            }
        } catch (err) {
            return "undefined";
        }
    };



    var Tabber = new Object();
    Tabber.Set = function (id) {

        jQuery(document).ready(function () {
            jQuery(id).children('ul').children('li').click(function () {
                var panel = jQuery(this).attr('id');
                jQuery(id).children('ul').children('li').removeClass('current');
                jQuery(this).addClass('current');
                jQuery(this).parent('ul').parent('div').children('div.panels').children('div').addClass('none');
                jQuery(this).parent('ul').parent('div').children('div.panels').children('div#' + panel).removeClass('none');
            });
        });
    };

    Tabber.Set('.shcode-tabber');
    Tabber.Set('div#shbutton');

    
    function showNotify(){
    	jQuery('#notify').fadeIn('slow');
    	setTimeout("hideNotify();",3000);
    }

    function hideNotify(){
    	jQuery('#notify').fadeOut('slow');
    }

    function showErrorMessage(msg){
    	jQuery('#error_message p').html('<span class="cosmo-ico"></span>'+msg);
    	jQuery('#error_message').fadeIn('slow');
    	setTimeout("hideErrorMessage();",3000);
    }
    
    function hideErrorMessage(){
    	jQuery('#error_message').fadeOut('slow');
    }
