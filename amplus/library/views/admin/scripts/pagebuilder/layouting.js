jQuery(document).ready(function($) {
    
    // STILL ALLOW INTERACTION WITH OTHER ELEMENTS SINCE
    // DIALOG-MODAL-MODE PREVENTS NON-JQUERY-UI ELEMENTS WHICH ARE ON TOP
    // FROM BEING USED
    $.widget( "ui.dialog", $.ui.dialog, {
    	_allowInteraction: function( event ) {
    	    return true;
    		return !!$( event.target ).closest( ".other-popups" ).length || this._super( event );
    	}
    });
    
    // auto-saving gives out an error because of the 
    // tinymce editors in our dialog boxes,
    // this removes the error by letting the function
    // ignore our dialog box editors
    tinymce.triggerSave = function () {
        $(this.editors, function(l) {
            if (l.id.indexOf('bfi_') == -1) { 
                l.save();
            }
        });
    };
    
    // save when enter is pressed
    if ($(window).data('pb_init') == undefined) {
        $(window).data('pb_init', true).keydown(function (e){
            if ($('.ui-dialog:visible').length > 0) {
                // if we are in a dialog, find the close/cancel button and trigger it
                if (e.keyCode == 27) {
                    var done = false;
                    $('.ui-dialog:visible .ui-button-text').each(function() {
                        if (done == true) { return; }
                        if ($(this).html().toLowerCase() == 'close') {
                            $(this).trigger('click');
                            done = true;
                        }
                    });
					e.preventDefault();
					return false;
                // if we are in a dialog, find the save button and trigger it
                } else if (e.keyCode == 13){
                    var done = false;
                    $('.ui-dialog:visible .ui-button-text').each(function() {
                        if (done == true) { return; }
                        if ($(this).html().toLowerCase() == 'save' ||
                            $(this).html().toLowerCase() == 'delete') {
                            $(this).trigger('click');
                            done = true;
                        }
                    });
					e.preventDefault();
					return false;
                }
            }
        });
    }
    
    // assign a unique id for each pagebuilder
    var uid = 1;
    $('.panels-container').each(function() {
        $(this).attr('id', 'pagebuilder' + uid++);
        
        // at the start, if nothing exists, create 1 section with 1 col
        bfi_layouting.createMultiRow($(this).attr('id'), [100]);
    })
    
    // init buttons
    $( "button" ).button();
    $('button.add-section')
        .unbind("click").click(function( event ) {
            event.preventDefault();
            $('*').blur();
            $("[id=dialog-section-new][data-ownerid=" + $(this).parents('.panels-container').attr('id') + "]").dialog("open");
        });
    
    
    // init main grid
    $(".grid-container")
        .sortable({
            revert: 100,
            handle: "button.move",
            cancel: '',
            opacity: 0.5
        }).disableSelection();
    
    $('.bfi-pagebuilder-dialog').each(function() {
        $(this).find('input[type=checkbox],select').change(function() {
            setTimeout(function() {
                jQuery('.bfi-pagebuilder-dialog:visible').find('.m').removeClass('last');
                jQuery('.bfi-pagebuilder-dialog:visible').find('.m:visible:last').addClass('last');
            }, 1);
        });
    });
    
    
    $('button.open-import-export').unbind('click').click(function(e) {
        e.preventDefault();
        $('[id=dialog-copy-paste][data-ownerid=' + $(this).parents('.panels-container').attr('id') + ']').dialog("open");
    });
 
    /**
     * New Panel Dialog box
     */
    jQuery('[id=dialog-panel-new]').each(function() {
        var ownerID = $(this).siblings('.panels-container').attr('id');
        $(this).attr('data-ownerid', ownerID)
            .dialog({
                autoOpen: false,
                width: "80%",
                modal: true,
                open: function(event, ui) {
                      $(this).find('button:eq(0)').focus();
                      
                      setTimeout("jQuery('.ui-widget-overlay').unbind('click').click(function() { \
                          jQuery('.ui-dialog-content').dialog('close'); \
                      });", 100);
                  }
            })
            .find('.panel-type')//.button()
            .unbind("click").click(function() {
                bfi_layouting.createNewPanel($(this).parents('[data-ownerid]').attr('data-ownerid'), $(this), true);
                $(this).parent().parent().dialog('close');
            });
    })
    
    /**
     * Add New Section Dialog box
     */
    $("[id=dialog-section-new]").each(function() {
        var ownerID = $(this).siblings('.panels-container').attr('id');
        $(this).attr('data-ownerid', ownerID)
            .dialog({
                  autoOpen: false,
                  width: 400,
                  modal: true,
                  open: function(event, ui) {
                      $(this).find('button:eq(0)').focus();
                      
                      setTimeout("jQuery('.ui-widget-overlay').unbind('click').click(function() { \
                          jQuery('.ui-dialog-content').dialog('close'); \
                      });", 100);
                  }
            })
            .find('button').unbind("click").click(function() {
                var row = bfi_layouting.createMultiRow(
                    $(this).parents('[id=dialog-section-new]').attr('data-ownerid'),
                    $(this).data('widths'));
                $(this).parent().dialog('close');
            });
    });
    
    /**
     * Add New Section Dialog box
     */
    $("[id=dialog-section-change]").each(function() {
        var ownerID = $(this).siblings('.panels-container').attr('id');
        $(this).attr('data-ownerid', ownerID)
            .dialog({
                  autoOpen: false,
                  width: 400,
                  modal: true,
                  open: function(event, ui) {
                      $(this).find('button:eq(0)').focus();
                      
                      setTimeout("jQuery('.ui-widget-overlay').unbind('click').click(function() { \
                          jQuery('.ui-dialog-content').dialog('close'); \
                      });", 100);
                  }
            })
            .find('button').unbind("click").click(function() {
                var row = bfi_layouting.modifyRowColumns(
                    $(this).parents('[id=dialog-section-change]').attr('data-ownerid'),
                    $('#' + $(this).parents('[id=dialog-section-change]').data('row-id')),
                    $(this).data('widths'));
                $(this).parent().dialog('close');
            });
    });
    
    /**
     * Add Delete Dialog box
     */
    $('[id=dialog-delete]').each(function() {
        var ownerID = $(this).siblings('.panels-container').attr('id');
        $(this).attr('data-ownerid', ownerID)
            .dialog({
                autoOpen: false,
                width: 300,
                modal: true,
                open: function(event, ui) {
                    $(this).find('.delete').focus();
                    
                    setTimeout("jQuery('.ui-widget-overlay').unbind('click').click(function() { \
                        jQuery('.ui-dialog-content').dialog('close'); \
                    });", 100);
                }
            })
            .find('button.cancel').unbind("click").click(function() {
                $(this).parent().dialog('close');
            })
            .end()
            .find('button.delete').unbind("click").click(function() {
                $('#' + $(this).parent().attr('data-ownerid') + ' [id=' + $(this).parent().data('delete-id') + ']').remove();
                $(this).parent().dialog('close');
            });
    });
    
    $('[id=dialog-copy-paste]').each(function() {
        var ownerID = $(this).siblings('.panels-container').attr('id');
        $(this).attr('data-ownerid', ownerID)
            .dialog({
                autoOpen: false,
                width: 450,
                modal: true,
                open: function(event, ui) {
                    $(this).parent().find('textarea.export').val(
                        bfi_layouting.encode64(bfi_layouting.getLayoutData($(this).attr('data-ownerid')))
                    );
                    $(this).parent().find('textarea.import').val('');
                    
                    setTimeout("jQuery('.ui-widget-overlay').unbind('click').click(function() { \
                        jQuery('.ui-dialog-content').dialog('close'); \
                    });", 100);
                }
            })
            .find('button.import').unbind('click').click(function() {
                var newData = bfi_layouting.decode64($(this).parent().find('textarea.import').val());
                if (newData != "") {
                    bfi_layouting.initPageBuilderData(
                        $(this).parents('[id=dialog-copy-paste]').attr('data-ownerid'),
                        newData
                    );
                }
                $(this).parent().dialog('close');
            })
            .end()
            .find('textarea.export').unbind('click').click(function() {
                $(this).select();
            })
            .end()
            .find('textarea.import').unbind('click').click(function() {
                $(this).select();
            });
    });
    
    $('.bfi-pagebuilder-dialog').each(function() {
        $(this).find('textarea:not(.plain)').each(function() {
            $(this).attr('id', "bfi_" + parseInt(Math.random() * 100000));
            tinyMCE.settings = {
                   // theme : "modern",
                   mode : "textareas",
                   wpautop: true,  
                   mode : "none",  
                   plugins: "fullscreen",
                   // valid_elements: "del,ul[*],li[*],ol[*],a[*],strong/b,em/i,div[style],span[style:],br,h1[*],h2[*],h3[*],h4[*],h5[*],h6[*],blockquote[*],hr,-span,-del,-a,-li,-ul,-ol,-strong,-b,-em,-i,-h1,-h2,-h3,-h4,-h5,-h6,-blockquote,-div",
                   valid_elements: "-p,img[!src],-del,-ul[*],-li[*],-ol[*],-a[*],-strong/b,-em/i,-div[!style],-span[*],-h1[*],-h2[*],-h3[*],-h4[*],-h5[*],-h6[*],-blockquote[*],hr,br",
                   force_br_newlines : false,
                   force_p_newlines : true,
                   forced_root_block : false,//"div",
                   // cleanup: false,
                   convert_urls: false,
                   relative_urls: false,
                   remove_script_host: false,
                   // cleanup_on_startup: false,
                   verify_html: false,
                   
                   
                   /*
                    * BUG FIX. 
                    * In different WP locales, TINYMCE will try and load a MISSING file
                    * /wp-includes/js/tinymce/langs/en.js
                    * setting the language to null removes this weird loading process
                    * but changes the labels of the editor
                    * labels are fixed below.
                    */
                   language: null, 
                   
                   theme_advanced_buttons1 : "source,bold,italic,underline,strikethrough,highlight,|,justifyleft,justifycenter,justifyright,|,undo,redo",
                   theme_advanced_buttons2 : "styleselect,hr,blockquote,link,unlink,|,dropcap,dropcircle",
                   theme_advanced_buttons3 : "bullist,starbullist,checkbullist,xbullist,numlist,|,outdent,indent,|,fullscreen,code",
                   theme_advanced_toolbar_location : "top",
                   theme_advanced_toolbar_align : "left",
                   style_formats : [
                       // {title : 'Normal'},
                       {title: 'Heading 1', block: 'h1'},
                       {title: 'Heading 2', block : 'h2'},
                       {title: 'Heading 3', block : 'h3'},
                       {title: 'Heading 4', block : 'h4'},
                       {title: 'Heading 5', block : 'h5'},
                       {title: 'Heading 6', block : 'h6'},
					   {title: 'Heading 1 Light', block: 'h1', attributes: { 'class': 'light' }},
					   {title: 'Heading 2 Light', block: 'h2', attributes: { 'class': 'light' }},
					   {title: 'Heading 3 Light', block: 'h3', attributes: { 'class': 'light' }},
					   {title: 'Heading 4 Light', block: 'h4', attributes: { 'class': 'light' }},
					   {title: 'Heading 5 Light', block: 'h5', attributes: { 'class': 'light' }},
					   {title: 'Heading 6 Light', block: 'h6', attributes: { 'class': 'light' }}
                       // {title : 'Biggest', inline : 'h3', attributes : { 'class' : 'biggest'}}
                      ],
                      formats: {
                          strikethrough: {inline: 'del'}
                      },
                   setup : function(ed) {
                         // Register example button
                         ed.addButton('highlight', {
                            title : 'Highlight selected text',
                            image : '',
                            onclick : function() {
                              ed.focus();
                              ed.selection.setContent('<span class="bfi_highlight">' + ed.selection.getContent() + '</span>');
                              
                            }
                         });
                         ed.addButton('starbullist', {
                             title : 'Star bullets',
                             image: '',
                             cmd: 'InsertUnorderedList',
                             onclick: function() {
                                 // make selection a bullet list
                                 ed.focus();
                                 tinyMCE.execCommand("InsertUnorderedList");
                                 // add the custom class to the ul parent
                                 bfi_layouting.tinyMCEAddClassToParent(ed, 'ul', 'star');
                             }
                         });
                         ed.addButton('checkbullist', {
                              title : 'Check bullets',
                              image: '',
                              cmd: 'InsertUnorderedList',
                              onclick: function() {
                                  // make selection a bullet list
                                  ed.focus();
                                  tinyMCE.execCommand("InsertUnorderedList");
                                  // add the custom class to the ul parent
                                  bfi_layouting.tinyMCEAddClassToParent(ed, 'ul', 'check');
                              }
                          });
                          ed.addButton('xbullist', {
                               title : 'X bullets',
                               image: '',
                               cmd: 'InsertUnorderedList',
                               onclick: function() {
                                   // make selection a bullet list
                                   ed.focus();
                                   tinyMCE.execCommand("InsertUnorderedList");
                                   // add the custom class to the ul parent
                                   bfi_layouting.tinyMCEAddClassToParent(ed, 'ul', 'x');
                               }
                           });
                           ed.addButton('dropcap', {
                               title : 'Dropcaps',
                               image : '',
                               onclick : function() {
                                 ed.focus();
                                 ed.selection.setContent('<span class="dropcap">' + ed.selection.getContent() + '</span>');
                               }
                            });
                            ed.addButton('dropcircle', {
                                title : 'Dropcaps Cricle',
                                image : '',
                                onclick : function() {
                                  ed.focus();
                                  ed.selection.setContent('<span class="dropcap_circle">' + ed.selection.getContent() + '</span>');
                                }
                             });
                      }
           };
           
           /*
            * BUG FIX.
            * Setting the language to null (see above settings) prompts tinymce to
            * lose all proper labels. Redefine the labels here.
            * code below acquired from:
            * /wp-includes/js/tinymce/langs/wp-langs-en.js
            */
            tinyMCE.addI18n("en.advanced",{
               style_select:"Styles",
               font_size:"Font size",
               fontdefault:"Font family",
               block:"Format",
               paragraph:"Paragraph",
               div:"Div",
               address:"Address",
               pre:"Preformatted",
               h1:"Heading 1",
               h2:"Heading 2",
               h3:"Heading 3",
               h4:"Heading 4",
               h5:"Heading 5",
               h6:"Heading 6",
               blockquote:"Blockquote",
               code:"Code",
               samp:"Code sample",
               dt:"Definition term ",
               dd:"Definition description",
               bold_desc:"Bold (Ctrl + B)",
               italic_desc:"Italic (Ctrl + I)",
               underline_desc:"Underline",
               striketrough_desc:"Strikethrough (Alt + Shift + D)",
               justifyleft_desc:"Align Left (Alt + Shift + L)",
               justifycenter_desc:"Align Center (Alt + Shift + C)",
               justifyright_desc:"Align Right (Alt + Shift + R)",
               justifyfull_desc:"Align Full (Alt + Shift + J)",
               bullist_desc:"Unordered list (Alt + Shift + U)",
               numlist_desc:"Ordered list (Alt + Shift + O)",
               outdent_desc:"Outdent",
               indent_desc:"Indent",
               undo_desc:"Undo (Ctrl + Z)",
               redo_desc:"Redo (Ctrl + Y)",
               link_desc:"Insert/edit link (Alt + Shift + A)",
               unlink_desc:"Unlink (Alt + Shift + S)",
               image_desc:"Insert/edit image (Alt + Shift + M)",
               cleanup_desc:"Cleanup messy code",
               code_desc:"Edit HTML Source",
               sub_desc:"Subscript",
               sup_desc:"Superscript",
               hr_desc:"Insert horizontal ruler",
               removeformat_desc:"Remove formatting",
               forecolor_desc:"Select text color",
               backcolor_desc:"Select background color",
               charmap_desc:"Insert custom character",
               visualaid_desc:"Toggle guidelines/invisible elements",
               anchor_desc:"Insert/edit anchor",
               cut_desc:"Cut",
               copy_desc:"Copy",
               paste_desc:"Paste",
               image_props_desc:"Image properties",
               newdocument_desc:"New document",
               help_desc:"Help",
               blockquote_desc:"Blockquote (Alt + Shift + Q)",
               clipboard_msg:"Copy/Cut/Paste is not available in Mozilla and Firefox.",
               path:"Path",
               newdocument:"Are you sure you want to clear all contents?",
               toolbar_focus:"Jump to tool buttons - Alt+Q, Jump to editor - Alt-Z, Jump to element path - Alt-X",
               more_colors:"More colors",
               shortcuts_desc:"Accessibility Help",
               help_shortcut:" Press ALT F10 for toolbar. Press ALT 0 for help.",
               rich_text_area:"Rich Text Area",
               toolbar:"Toolbar"
            });
               
            tinyMCE.execCommand('mceAddControl', false, $(this).attr('id'));
        });
    });
    
    /**
     * Individual dialog boxes for the different types of panels
     */
    var i = 1;
    $('.bfi-pagebuilder-dialog').each(function() {
        // save the default values into a data variable
        $(this).data('defaults', bfi_layouting.getDialogData($(this)));

        
        var ownerID = $(this).siblings('.panels-container').attr('id');
        $(this).attr('data-ownerid', ownerID)
            .dialog({
                autoOpen: false,
                width: 450,
                modal: true,
                buttons: {
                    Save: function() {
                        $(this).dialog('close');
                        
                        bfi_layouting.saveDialogDataToPanel($(this));
                    },
                    Cancel: function() {
                        $(this).dialog("close");
                    }
                },
                open: function(event, ui) {                    
                    
                    $(this).parents('.ui-dialog').find('.bfi-pagebuilder-dialog').css('maxHeight', jQuery(window).height() - 200);
                    
                    var objEdited = $('#' + $(this).attr('data-ownerid')).find('#' + $(this).data('panel'));
                    
                    // this is for editing panels
                    if (objEdited.length == 0) {
                        objEdited = $('#' + $(this).attr('data-ownerid')).find('#' + $(this).data('section'));
                    }
                    
                    // if possible, call the preopen function for this model
                    if (bfi_layouting['preopen_' + $(this).attr('data-model')] != undefined) {
                        if (objEdited.data('properties') == '') {
                            bfi_layouting['preopen_' + $(this).attr('data-model')]($(this).data('defaults'));
                        } else {
                            bfi_layouting['preopen_' + $(this).attr('data-model')](objEdited.data('properties'));
                        }
                    }
                    
                    // if panel has no properties, save the default properties for the panel
                    // set the dialog data to defaults (for new panels)
                    if (objEdited.data('properties') == '') {
                        bfi_layouting.setDialogData($(this), $(this).data('defaults'));
                        bfi_layouting.saveDialogDataToPanel($(this));
                    
                    // if panel has properties, set them in the dialog
                    } else {
                        // if the panel already has properties,
                        // extend with the defaults so that IF NEW OPTIONS
                        // have been added, we'd have those new defaults
                        bfi_layouting.setDialogData($(this), 
                            // do extend twice so not to overwrite the defautls
                            $.extend($.extend({}, $(this).data('defaults')), objEdited.data('properties')));
                    }
                
                    // if this is a tinymce, copy the contents to it
                    $(this).parents('.ui-dialog').find('textarea:not(.plain)').each(function() {
                        tinyMCE.get($(this).attr('id')).setContent($(this).val());
                    });
                    
                    // from http://www.jquery4u.com/dom-modification/jquery-change-css-iframe-content/
                    $('.mceIframeContainer iframe:not(.done)').each(function() {
                        var frm = frames[$(this).attr('id')].document; 
                        var otherhead = frm.getElementsByTagName("head")[0];
                        var link = frm.createElement("link");
                        link.setAttribute("rel", "stylesheet");
                        link.setAttribute("type", "text/css");
                        link.setAttribute("href", BFI_PAGEBUILDER_EDITOR_CSS);
                        otherhead.appendChild(link);
                        $(this).addClass('done');
                    });
                    
                    setTimeout("jQuery('.ui-widget-overlay').unbind('click').click(function() { \
                        jQuery('.ui-dialog-content').dialog('close'); \
                    });", 100);
                    
                    // trigger change on inputs for fixing the display
                    $(this).find('input[type=checkbox],select').trigger('change');
                    
                    // ddslick on
                    $(this).find('.option_selectIcon select').ddslick();
                },
                close: function(event, ui) {
                    $('.dd-container').ddslick('destroy');
                }
            });
    });
    
    /**
     * window resizing binding
     */
    if ($(window).data('bfi-page-builder-resize-bind') == undefined) {
        $(window).data('bfi-page-builder-resize-bind', true);
        $(window).bind('resize', function(event) {
            if (!$(event.target).hasClass('ui-resizable')) {
                $('.grid-container .row-container').each(function() {
                    var totalWidth = $(this).width();
                    totalWidth -= ($(this).children('.panel-container').length - 1) * 10;
                
                    for (var i = 0; i < $(this).children('.panel-container').length; i++) {
                        $(this).children('.panel-container').eq(i).width(
                            parseFloat($(this).children('.panel-container').eq(i).find('.measurement input').val()) / 100 * totalWidth
                            );
                    }
                });
            }
        });
    }
    
    /**
     * close any modal dialog on esc keypress
     * somehow doesn't work in the WP admin
     */
    $(document).keypress(function(e) {
        if (e.keyCode == 27) {
            $('.ui-dialog-content:eq(0)').dialog('close');
        }
    });
});

var bfi_layouting;

(function($) {
    
bfi_layouting = {
    
    _currID: 1,
    
    tinyMCEAddClassToParent: function(ed, parentElement, newClass) {
         var currNode = ed.selection.getNode();
         while (!ed.dom.is(currNode, parentElement)) {
             // just in case...
             if (ed.dom.is(currNode, 'html')) {
                 return;
             }
             currNode = currNode.parentNode;
         }
         if (ed.dom.is(currNode, parentElement)) {
             ed.dom.addClass(currNode, newClass);
         }  
    },
    
    generateID: function() {
        return "bfi_elem_" + this._currID++;
    },
    
    createMultiRow: function(pagebuilderID, colWidths) {
        // insert new row html
            // <span class='panel-name'>Panel #1</span> \
        var html = "<div id=" + this.generateID() + " class='row-container new'> \
            <div class='controls'> \
                <button class='delete' title='Delete'> \
                    <i class='icon-remove'></i> \
                </button> \
                <button class='columns' title='Change Columns'> \
                    <i class='icon-th-large'></i> \
                </button> \
                <button class='settings' title='Styles'> \
                    <i class='icon-tint'></i> \
                </button> \
                <button class='link off' title='Link Styles to Top'> \
                    <i class='icon-link'></i> \
                </button> \
                <button class='clone' title='Clone'> \
                    <i class='icon-copy'></i> \
                </button> \
                <button class='move' title='Move'> \
                    <i class='icon-resize-vertical'></i> \
                </button> \
            </div>";
        for (var i = 0; i < colWidths.length; i++) {
            html += "<div class='panel-container ui-corner-all ui-widget ui-state-default'> \
                <button class='add-panel-inside'><i class='icon-plus icon-large'></i> Panel</button> \
                <div class='measurement'> \
                    <input type='text' value='" + colWidths[i] + "%'/><hr> \
                </div> \
                </div>";
        }
        html += "<div class='clearfix'></div></div>";
        $('#' + pagebuilderID + ' .grid-container').append(html);
        html = "";
        
        // compute widths
        for (var i = 0; i < colWidths.length; i++) {
            var widthPercentage = parseFloat(colWidths[i]);
            var gapsWidth = (colWidths.length - 1) * 10;
            var totalWidth = $('#' + pagebuilderID + ' .grid-container').width();
            $('.row-container.new .panel-container:eq(' + i + ')')
                .width((totalWidth - gapsWidth) * widthPercentage / 100);
        }
        
        $('.row-container.new .add-panel-inside').unbind("click").click(function(event) {
            // unselect everything except this panel
            $(this).parents('.panels-container').find('.grid-container > .row-container > .ui-selected').removeClass('ui-selected');
            $(this).parents('.panel-container:eq(0)').addClass('ui-selected');
            // add a panel
            event.preventDefault();
            $('*').blur();
            
            $('[id=dialog-panel-new][data-ownerid=' + $(this).parents('.panels-container').attr('id') + ']').dialog("open");
        });
        
        // init buttons
        $('.row-container.new')
            .data('properties', '')
            .find('button:not(.add-panel)').button()
            .end()
            .find('button[title]').tooltip({
                position: { my: "center bottom-8", at: "center top" },
                show: { effect: "fade", duration: 200 },
                hide: false})
            // .end()
            // .find('.controls .panel-name').html('Panel ' + $('.row-container.new').parents('.panels-container').find('.row-container.new').index())
            .end()
            .find('.controls button.columns').unbind("click").click(function(event) {
                event.preventDefault();
                $('[id=dialog-section-change][data-ownerid=' + $(this).parents('.panels-container').attr('id') + ']').data('row-id', $(this).parents('.row-container').attr('id')).dialog('open');
            })
            .end()
            .find('.controls button.delete').unbind("click").click(function(event) {
                event.preventDefault();
                // $('*').blur();
                $('[id=dialog-delete][data-ownerid=' + $(this).parents('.panels-container').attr('id') + ']').data('delete-id', $(this).parents('.row-container').attr('id')).dialog("open");
            })
            .end()
            .find('.controls button.clone').unbind("click").click(function(event) {
                event.preventDefault();
                bfi_layouting.cloneSection($(this).parents('.row-container'));
            })
            .end()
            .find('.controls button.settings').unbind('click').click(function(event) {
                event.preventDefault();
                bfi_layouting.editSectionProperties($(this).parents('.row-container'));
            })
            .end()
            .find('.controls button.link').unbind('click').click(function(event) {
                event.preventDefault();
                $(this).toggleClass('off');
                $(this).parents('.controls').find('button.settings').toggleClass('off');
            });
        
        // init other stuff
        this.initPanelContainer('.row-container.new .panel-container');
        this.initRowContainer('.row-container.new');
        
        // unselect everything else and select the 1st cell
        $('#' + pagebuilderID + ' .grid-container > .row-container > .ui-selected').removeClass('ui-selected');
        $('.row-container.new .panel-container:eq(0)').addClass('ui-selected');
        
        // remove "new" class
        return $('#' + pagebuilderID + ' .grid-container .new').toggleClass('new');
    },
    
    createNewPanel: function(pagebuilderID, panelObject, autoEdit) {
        var selectedPanel;
        if ($('#' + pagebuilderID + ' .panel-container.ui-selected').length == 0) {
            selectedPanel = $('#' + pagebuilderID + ' .panel-container:eq(0)');
        } else {
            selectedPanel = $('#' + pagebuilderID + ' .panel-container.ui-selected');
        }

        selectedPanel.append(
            "<div id=" + this.generateID() + " class='new panel ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only'> \
                <button class='delete' title='Delete'><i class='icon-remove'></i></button> \
                <button class='edit' title='Edit'><i class='icon-pencil'></i></button> \
                <button class='clone' title='Clone'><i class='icon-copy'></i></button> \
                <span class='title'></span> \
                <span class='preview'></span> \
                <span class='desc'></span> \
            </div>");
        
        // add the data
        $('#' + pagebuilderID + ' .panel.new')
            .attr('data-class', panelObject.attr('data-class'))
            .attr('data-model', panelObject.attr('data-model'))
			.attr('data-is-container', panelObject.attr('data-is-container'))
            .data('properties', '')
            // update the text for the new panel (no preview for now)
            .find('.title').html(panelObject.find('.name').html())
            .end()
            .find('.desc').html(panelObject.find('.desc').html())
            .end()
            // add the buttons and events
            .find('button').button()
            .end()
            .find('button[title]').tooltip({
                position: { my: "center bottom-8", at: "center top" },
                show: { effect: "fade", duration: 200 },
                hide: false })
            .end()
            .find('button.delete').unbind("click").click(function(event) {
                event.preventDefault();
                // $('*').blur();
                $('[id=dialog-delete][data-ownerid=' + $(this).parents('.panels-container').attr('id') + ']').data('delete-id', $(this).parent().attr('id')).dialog("open");
            })
            .end()
            // double clicking the panel will trigger an edit
            .unbind('dblclick').dblclick(function(event) {
                event.preventDefault();
                bfi_layouting.editPanel($(this));
            })
            .find('button.clone').unbind("click").click(function(event) {
                event.preventDefault();
                bfi_layouting.clonePanel($(this).parents('.panel'));
            })
            // prevent fast clicking of clone from triggering an edit
            .unbind('dblclick').dblclick(function(event) {
                event.stopPropagation();
                event.preventDefault();
            })
            .end()
            .find('button.edit').unbind("click").click(function(event) {
                event.preventDefault();
                bfi_layouting.editPanel($(this).parents('.panel'));
            });

		if (panelObject.attr('data-is-container')) {
				this.initSubPanelContainer('#' + pagebuilderID + ' .panel.new');
					// this.initSuPanelContainer('#' + pagebuilderID + ' .panel.new');
		}
        
        // open up the edit panel for the new panel
        if (autoEdit) {
            return this.editPanel($('#' + pagebuilderID + ' .panel.new').toggleClass('new'));
        } else {
            return $('#' + pagebuilderID + ' .panel.new').toggleClass('new');
        }
    },
    
    updatePanelContainerPercentages: function(panelContainer) {
        var totalWidth = 0;
        panelContainer.parent().children('.panel-container').each(function() {
            totalWidth += $(this).width();
        });
        
        var width = Math.round(panelContainer.width() / totalWidth * 1000) / 10;
        panelContainer.find('.measurement input').val(width + "%");
        
        width = Math.round(panelContainer.next('.panel-container').width() / totalWidth * 1000) / 10;
        panelContainer.next('.panel-container').find('.measurement input').val(width + "%");
    },

    updateResizeHandle: function(rowContainer) {
        if (rowContainer.find('.resize-handle').length) {
          var maxHeight = 0;
          var panels = rowContainer.find('.panel-container');
          panels.each(function() {
              if ($(this).height() > maxHeight) {
                  maxHeight = $(this).height();
              }
          });
          maxHeight += parseInt(panels.css('paddingBottom'))
                     + parseInt(panels.css('paddingTop'));
          rowContainer.find('.resize-handle')
              .height(maxHeight);
        }
    },
    
    getLayoutData: function(pagebuilderID) {
        var sections = [];
        $('#' + pagebuilderID + ' .grid-container .row-container').each(function() { 
            
            var section = {
                "properties": $(this).data('properties'),
                "linked": !$(this).find('.controls .link').is('.off'),
                "columns": []
            };
            
            $(this).find('.panel-container').each(function() { 
                
                var panelContainer = {
                    "width": 100,
                    "panels": []
                };
                
                var colWidth = parseFloat($(this).find('.measurement input').val());
                panelContainer["width"] = colWidth;
                
                $(this).find('.panel').each(function(index) {
                    var panel = {
                        "preview" : $(this).find('.preview').html(),
                        "type": $(this).attr('data-model'),
                        "i": index,
                        "data": $(this).data('properties')
                    }
                    
                    panelContainer["panels"].push(panel);
                });
                
                section["columns"].push(panelContainer);
            });
            
            sections.push(section);
        });
        return JSON.stringify(sections);
    },

	
    initSubPanelContainer: function(panelContainerSelector) {
    },
    
    initPanelContainer: function(panelContainerSelector) {
        $(panelContainerSelector).each(function() {
            $(this).sortable({
                items: ".panel",
				tolerance: "intersect",
                revert: 100,
                placeholder: 'placeholder',  
                forcePlaceholderSize: true,
                opacity:0.5,
                // cursor:"pointer",
                // connectWith: '#' + $(this).parents('.panels-container').attr('id') + " .panel-container",
                connectWith: ['#' + $(this).parents('.panels-container').attr('id') + " .panel-container, #" + $(this).parents('.panels-container').attr('id') + " [data-is-container='true']"],
                stop: function(event, ui) {
                    ui.item.parents('.panels-container')
                        .find('.grid-container > .row-container > .ui-selected').removeClass('ui-selected');
                    ui.item.parent('.ui-selectee').addClass('ui-selected');
                    // change the handle heights
                    ui.item.parents('.row-container').eq(0).trigger('updateResizeHandle');
                },
                sort: function(event, ui) {
                    // change the handle heights
                    ui.item.parents('.row-container').eq(0).trigger('updateResizeHandle');
                },
                start: function(event, ui) {
                    ui.item.parents('.panels-container').find('*').blur();
                }
            });
        });
        
        $(panelContainerSelector).disableSelection();
        
        // $(panelContainerSelector).each(function() {
        //     bfi_layouting.updatePanelContainerPercentages($(this));
        // });
        $(panelContainerSelector).find('.measurement input').attr('disabled', 'disabled');
    },
    
    initRowContainer: function(rowContainerSelector) {
        $(rowContainerSelector).selectable({
            // unselect other selected container
            selecting: function( event, ui ) {
                $(this).parents('.panels-container')
                    .find('.grid-container > .row-container > .ui-selected').removeClass('ui-selected');
                $(this).parents('.panels-container')
                    .find('*').blur();
            }
        }).disableSelection();
        
        $(rowContainerSelector).each(function() {
            $(this).children('.panel-container:not(:last)')
                .addClass('has-resize-handle')
                .resizable({
                    handles: 'e',
                    resize: function(event, ui) {
                        ui.element.next().width(ui.element.data('nextStartWidth') + (ui.element.data('startWidth') - ui.element.width()));
                        bfi_layouting.updatePanelContainerPercentages(ui.element);
                    },
                    start: function(event, ui) {
                        ui.element.data('startWidth', ui.element.width());
                        ui.element.data('nextStartWidth', ui.element.next().width());

                        ui.element.resizable( "option", "minWidth", 
                            // Math.floor(ui.element.parent().width() * .1)
                            0
                        );
                        ui.element.resizable( "option", "maxWidth", 
                            ui.element.width() + ui.element.next().width() - ui.element.resizable("option", "minWidth")
                        );

                        $('*').blur();
                    }
                });
        });
        
        $(rowContainerSelector)
            .each(function() {
                $(this).children('.panel-container:not(:last)').trigger('resize');
            })
            // update the resize handle and counter
            .bind('updateResizeHandle', function() {
                bfi_layouting.updateResizeHandle($(this));
            });
    },
    
    clonePanel: function(panelSelector) {
        $(panelSelector)
            .clone(true)
            .attr('id', this.generateID())
            .appendTo($(panelSelector).parents('.panel-container'))
            .addClass('new')
            .find('.ui-state-hover').removeClass('ui-state-hover');
        
        // move to the correct position (just after the cloned panel)
        $(panelSelector).after(
            $('.panel.new').removeClass('new'));
            
        $('.ui-tooltip').remove();
    },
    
    cloneSection: function(sectionSelector) {
        var colWidths = [];
        $(sectionSelector).find('.measurement input').each(function(i) {
            colWidths[i] = parseFloat($(this).val());
        });
        var newRow = this.createMultiRow($(sectionSelector).parents('.panels-container').attr('id'), colWidths);
        
        if ($(sectionSelector).find('.controls button.link.off').length > 0) {
            newRow.find('.controls button.link').addClass('off');
            newRow.find('.controls button.settings').removeClass('off');
        } else {
            newRow.find('.controls button.link').removeClass('off');
            newRow.find('.controls button.settings').addClass('off');
        }
        
        // copy over the style settings
        newRow.data('properties', $(sectionSelector).data('properties'));
        
        $(sectionSelector).find('.panel-container').each(function(i) {
            $(this).find('.panel').each(function(k) {
                $(this).clone(true)
                    .attr('id', bfi_layouting.generateID())
                    .appendTo($(this).parents('.panels-container').find('.row-container:last .panel-container:eq(' + i + ')'))
                    .find('.ui-state-hover').removeClass('ui-state-hover');
            });
        });

        // move to the correct position (just after the cloned section/row)
        $(sectionSelector).after(
            $(sectionSelector).parents('.panels-container').find('.row-container:last'));

        $('.ui-tooltip').remove();
    },
    
    editPanel: function(panelSelector) {
        $('.bfi-pagebuilder-dialog[data-model=' + $(panelSelector).attr('data-model') + '][data-ownerid=' + $(panelSelector).parents('.panels-container').attr('id') + ']')
            .data('panel', $(panelSelector).attr('id'))
            .dialog('open');
        
        return $(panelSelector);
    },
    
    getDialogData: function(dialogSelector) {
        // get all the input names
        var inputNames = [];
        $(dialogSelector).find('[name^=' + BFI_SHORTNAME + '_]').each(function() {
            var name = $(this).attr('name');
            if (inputNames.indexOf(name) == -1) {
                inputNames.push(name);
            }
        });

        // get all the data and put them
        // all in an object
        var data = {};
        $.each(inputNames, function(i, name) {
            var panelName = name.replace(BFI_SHORTNAME + '_', '').replace('[]', '');

            // if multi-check
            if (name.indexOf('[]') != -1) {
                var checkedVals = [];
                $(dialogSelector).find('[name="' + name + '"]:checked').each(function() {
                    checkedVals.push($(this).val());
                });
                data[panelName] = checkedVals;
            // normal input
            } else {
                // check if checkbox
                if ($(dialogSelector).find('[name=' + name + ']').is('[type=checkbox]')) {
                    data[panelName] = $(dialogSelector).find('[name=' + name + ']').is(':checked');
                // check if tinymce is implemented
                } else if ($(dialogSelector).find('[name=' + name + ']').is('textarea:not(.plain)') &&
                    $(dialogSelector).find('[name=' + name + ']').next().is('.mceEditor')) {
                    data[panelName] = tinyMCE.get($(dialogSelector).find('[name=' + name + ']').attr('id')).getContent();
                    data[panelName] = data[panelName].replace(/font-family\:[^;]+;?/g, '');
                    data[panelName] = data[panelName].replace(/font-size\:[^;]+;?/g, '');
                    data[panelName] = data[panelName].replace(/font\:[^;]+;?/g, '');
                    // data[panelName] = data[panelName].replace(/\:[^;]+;?/g, '');
                // } else ($(dialogSelector).find('[name=' + name + ']').is('textarea.preserve')) {
                    // data[panelName] = $(dialogSelector).find('[name=' + name + ']').val();
                } else {
                    data[panelName] = $(dialogSelector).find('[name=' + name + ']').val();
                }    
                
                // .preserve class preserves all 
                // if ($(dialogSelector).find('[name=' + name + ']').is(':not(.preserve)')) {
                    data[panelName] = bfi_layouting.cleanUpText(data[panelName]);
                // }
            }
        });
        
        return data;
    },
    
    // cleans up single quotes since they're not valid in json
    cleanUpText: function(text) {
        text = typeof(text) == "string" ? text.replace(/'/g, "&apos;") : text;
        return text;
        // return typeof(text) == "string" ? text.replace(/\\\n/g, '').replace(/\n/g, '') : text;
        // return text.replace(/'/g, "\"");
    },
    
    saveDialogDataToPanel: function(dialogSelector) {
        var objEdited = $('#' + $(dialogSelector).attr('data-ownerid')).find('#' + $(dialogSelector).data('panel'));
        if (objEdited.length == 0) {
            objEdited = $('#' + $(dialogSelector).attr('data-ownerid')).find('#' + $(dialogSelector).data('section'));
        }
        this.updatePanelPreview(dialogSelector);
        objEdited.data('properties', this.getDialogData(dialogSelector));
    },
    
    updatePanelPreview: function(dialogSelector) {
        // only do this for panels
        var objEdited = $('#' + $(dialogSelector).attr('data-ownerid')).find('#' + $(dialogSelector).data('panel'));
        if (objEdited.length == 0) {
            return;
        }
        
        var s = "";
        $(dialogSelector).find('select,input,textarea').each(function() {
            var newVal = "";
            if ($(this).is('select')) {
                newVal = $(this).find('option[value=' + $(this).val() + ']').text();
            } else if ($(this).is('input[type=checkbox][name*="[]"]')) {
                if ($(this).is(':checked')) {
                    newVal = $(this).next('span').text();
                }
            } else if ($(this).is('input[type=checkbox]')) {
                newVal = ''; //$(this).is(':checked').toString();
            } else if ($(this).is('textarea:not(.plain)')) {
                newVal = $('<div>').html(tinyMCE.get($(this).attr('id')).getContent()).text();
            } else {
                newVal = $('<div>').html($(this).val()).text();
            }
            if (newVal != "") {
                s += s ? ', ' : '';
                s += newVal;
            }
        });
        if (s == "") {
            s = "(EMPTY)";
        } else if (s.length > 50) {
            s = $.trim(s).substring(0, 50)
                 // .split(" ")
                 // .slice(0, -1)
                 // .join(" ") 
                 + "...";
        }
        objEdited.find('.preview').html(s);
    },
    
    setDialogData: function(dialogSelector, data) {
        $.each(data, function(name, v) {
            // arrays (multichecks)
            name = BFI_SHORTNAME + '_' + name;
            if (typeof(v) == "boolean") {
                $(dialogSelector).find('[name="' + name + '"]').prop('checked', v);
            } else if (typeof(v) == 'object') {
                name = name + '[]';
                
                $(dialogSelector).find('[name="' + name + '"]').prop('checked', false);
                $.each(v, function(i2, v2) {
                    $(dialogSelector).find('[name="' + name + '"][value="' + v2 + '"]').prop('checked', true);
                });
            } else if ($(dialogSelector).find('[name="' + name + '"]').next().is('.colorSelector')) {
                $(dialogSelector).find('[name="' + name + '"]').val(v)
                    .next('.colorSelector').find('> div').css('backgroundColor', v);
            // normal value
            } else {
                // fix apostrophies also
                $(dialogSelector).find('[name="' + name + '"]').val(v.replace(/&apos;/g, "'"));
            }
        });
    },
    
    editSectionProperties: function(sectionSelector) {
        $('.bfi-pagebuilder-dialog[data-model=' + SECTION_PROPERTIES_MODEL + '][data-ownerid=' + $(sectionSelector).parents('.panels-container').attr('id') + ']')
            .data('section', $(sectionSelector).attr('id'))
            .dialog('open');
    },
    
    modifyRowColumns: function(pagebuilderID, sectionSelector, widths) {
        var currColCount = $(sectionSelector).find('.panel-container').length;
        var newColCount = widths.length;
        
        var newRow = this.createMultiRow(pagebuilderID, widths);
        
        if ($(sectionSelector).find('.controls button.link.off').length > 0) {
            newRow.find('.controls button.link').addClass('off');
            newRow.find('.controls button.settings').removeClass('off');
        } else {
            newRow.find('.controls button.link').removeClass('off');
            newRow.find('.controls button.settings').addClass('off');
        }
        
        // copy over the style settings
        newRow.data('properties', $(sectionSelector).data('properties'));
            
        $(sectionSelector).find('.panel-container').each(function(i) {
            $(this).find('.panel').each(function(k) {
                // if the new layout has more columns, put the panels 
                // in their original panel indices
                // if the new layout has less columns, put the lost panels
                // in the last panel index
                var newColi = i;
                if (i > newColCount - 1 && currColCount > newColCount) {
                    newColi = newColCount - 1;
                }
                $(this).clone(true)
                    .attr('id', bfi_layouting.generateID())
                    .appendTo(newRow.find('.panel-container:eq(' + newColi + ')'))
                    .find('.ui-state-hover').removeClass('ui-state-hover');
            });
        });

        // move to the correct position (just after the cloned section/row)
        $(sectionSelector).after(
            $(sectionSelector).parents('.panels-container').find('.row-container:last'));
        
        // remove original section
        $(sectionSelector).remove();

        $('.ui-tooltip').remove();
    },
    
    initPageBuilderData: function(pagebuilderID, data) {
        var origData = this.getLayoutData(pagebuilderID);
        try {
            // check for stringified data
            if (typeof(data) == "string") {
                data = this.cleanUpText(data);
                try {
                  data = JSON.parse(data);
                } catch (exception) {
                  data = '[{"properties":"","columns":[{"width":100,"panels":[]}]}]';
                }
            }
        
        
            // clear everything first
            $('#' + pagebuilderID + ' .row-container').remove();
        
            $.each(data, function(i, sectionData) {
                // get all col widths
                var colWidths = [];
                $.each(sectionData.columns, function(i, column) {
                    colWidths.push(column.width);
                });
            
                // create the new section
                var newRow = bfi_layouting.createMultiRow(pagebuilderID, colWidths)
                    // add the section properties
                    .data('properties', sectionData.properties);
                
                
            
                // by default, a created row is not linked
                if (sectionData.linked) {
                    newRow.find('.controls .link').removeClass('off');
                    newRow.find('.controls .settings').addClass('off');
                }
            
                // build the panels
                $.each(sectionData.columns, function(columnNum, column) {
                    $.each(column.panels, function(i, panel) {
                        // select the current panel container since we're
                        // going to add panels to it
                        var currPanelContainer = $('#' + pagebuilderID + ' .row-container:last').find('.panel-container').eq(columnNum);
                        $('#' + pagebuilderID).find('.grid-container > .row-container > .ui-selected').removeClass('ui-selected');
                        currPanelContainer.addClass('ui-selected');
                    
                        // create the panel
                        var newPanel = bfi_layouting.createNewPanel(pagebuilderID, $('.panel-type[data-model="' + panel.type + '"]:eq(0)'), false);
                    
                        // add the properties
                        newPanel.data('properties', panel.data);
                    
                        // add the preview if possible
                        if (panel.preview != undefined) {
                            newPanel.find('.preview').html(panel.preview);
                        }
                    });
                });
            });
        } catch (exception) {
            alert('The import data is invalid.');
            this.initPageBuilderData(pagebuilderID, origData);
        }
    },
    
    encode64: function(input) {
        keyStr = "ABCDEFGHIJKLMNOP" +
                 "QRSTUVWXYZabcdef" +
                 "ghijklmnopqrstuv" +
                 "wxyz0123456789+/" +
                 "=";
                         
        input = escape(input);
        var output = "";
        var chr1, chr2, chr3 = "";
        var enc1, enc2, enc3, enc4 = "";
        var i = 0;
      
        do {
           chr1 = input.charCodeAt(i++);
           chr2 = input.charCodeAt(i++);
           chr3 = input.charCodeAt(i++);
      
           enc1 = chr1 >> 2;
           enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
           enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
           enc4 = chr3 & 63;
      
           if (isNaN(chr2)) {
              enc3 = enc4 = 64;
           } else if (isNaN(chr3)) {
              enc4 = 64;
           }
      
           output = output +
              keyStr.charAt(enc1) +
              keyStr.charAt(enc2) +
              keyStr.charAt(enc3) +
              keyStr.charAt(enc4);
           chr1 = chr2 = chr3 = "";
           enc1 = enc2 = enc3 = enc4 = "";
        } while (i < input.length);
      
        return output;
    },

    decode64: function (input) {
        keyStr = "ABCDEFGHIJKLMNOP" +
                 "QRSTUVWXYZabcdef" +
                 "ghijklmnopqrstuv" +
                 "wxyz0123456789+/" +
                 "=";
                         
        var output = "";
        var chr1, chr2, chr3 = "";
        var enc1, enc2, enc3, enc4 = "";
        var i = 0;
    
        // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
        var base64test = /[^A-Za-z0-9\+\/\=]/g;
        if (base64test.exec(input)) {
           alert("There were invalid base64 characters in the input text.\n" +
                 "The data is invalid, importing failed.");
            return "";
        }
        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
    
        do {
           enc1 = keyStr.indexOf(input.charAt(i++));
           enc2 = keyStr.indexOf(input.charAt(i++));
           enc3 = keyStr.indexOf(input.charAt(i++));
           enc4 = keyStr.indexOf(input.charAt(i++));
    
           chr1 = (enc1 << 2) | (enc2 >> 4);
           chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
           chr3 = ((enc3 & 3) << 6) | enc4;
    
           output = output + String.fromCharCode(chr1);
    
           if (enc3 != 64) {
              output = output + String.fromCharCode(chr2);
           }
           if (enc4 != 64) {
              output = output + String.fromCharCode(chr3);
           }
    
           chr1 = chr2 = chr3 = "";
           enc1 = enc2 = enc3 = enc4 = "";
    
        } while (i < input.length);
    
        return unescape(output);
    }
}

})(jQuery);