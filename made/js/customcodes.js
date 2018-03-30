//ADD CUSTOM SHORTCODE BUTTONS TO TINYMCE EDITOR
(function() {	
	tinymce.create('tinymce.plugins.signoff', {
        init : function(ed, url) {
            ed.addButton('signoff', {
                title : 'Add signoff text - use 1, 2, or 3 for corresponding signoff text content',
                image : url+'/images/signoff.png',
                onclick : function() {
                     ed.selection.setContent('[signoff1]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	tinymce.create('tinymce.plugins.dropcap', {
        init : function(ed, url) {
            ed.addButton('dropcap', {
                title : 'Add dropcap',
                image : url+'/images/dropcap.png',
                onclick : function() {
                     ed.selection.setContent('[dropcap]' + ed.selection.getContent() + '[/dropcap]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	tinymce.create('tinymce.plugins.divider', {
        init : function(ed, url) {
            ed.addButton('divider', {
                title : 'Add divider',
                image : url+'/images/divider.png',
                onclick : function() {
                     ed.selection.setContent('[divider]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	tinymce.create('tinymce.plugins.quote', {
        init : function(ed, url) {
            ed.addButton('quote', {
                title : 'Add quote',
                image : url+'/images/quote.png',
                onclick : function() {
                     ed.selection.setContent('[quote]' + ed.selection.getContent() + '[/quote]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	tinymce.create('tinymce.plugins.pullquoteleft', {
        init : function(ed, url) {
            ed.addButton('pullquoteleft', {
                title : 'Add pullquote left',
                image : url+'/images/pullquote-left.png',
                onclick : function() {
                     ed.selection.setContent('[pullquote_left]' + ed.selection.getContent() + '[/pullquote_left]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	tinymce.create('tinymce.plugins.pullquoteright', {
        init : function(ed, url) {
            ed.addButton('pullquoteright', {
                title : 'Add pullquote right',
                image : url+'/images/pullquote-right.png',
                onclick : function() {
                     ed.selection.setContent('[pullquote_right]' + ed.selection.getContent() + '[/pullquote_right]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	// Creates a new plugin class and a custom listbox
    tinymce.create('tinymce.plugins.boxes', {
		
		init : function(ed, url) {

            ed.addButton( 'boxes', {
                type: 'listbox',
                text: 'Boxes',
                icon: false,
				fixedWidth: true,
                onselect: function(e) {
                }, 
                values: [

                    {text: 'Light Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_light]' + sel + '[/box_light]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Dark Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_dark]' + sel + '[/box_dark]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Info Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_info]' + sel + '[/box_info]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Download Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_download]' + sel + '[/box_download]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Help Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_help]' + sel + '[/box_help]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Success Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_success]' + sel + '[/box_success]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Alert Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_alert]' + sel + '[/box_alert]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Tip Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_tip]' + sel + '[/box_tip]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Error Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_error]' + sel + '[/box_error]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Warning Box', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[box_warning]' + sel + '[/box_warning]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},

                ]
            });  
		}        
    });	
	tinymce.create('tinymce.plugins.togglesimple', {
        init : function(ed, url) {
            ed.addButton('togglesimple', {
                title : 'Add a simple toggle',
                image : url+'/images/toggle-simple.png',
                onclick : function() {
                     ed.selection.setContent('[toggle_simple title="Title of toggle box" width="Width of toggle box"]' + ed.selection.getContent() + '[/toggle_simple]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	tinymce.create('tinymce.plugins.togglebox', {
        init : function(ed, url) {
            ed.addButton('togglebox', {
                title : 'Add a box toggle',
                image : url+'/images/toggle-box.png',
                onclick : function() {
                     ed.selection.setContent('[toggle_box title="Title of toggle box" width="Width of toggle box"]' + ed.selection.getContent() + '[/toggle_box]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	tinymce.create('tinymce.plugins.tabs', {
        init : function(ed, url) {
            ed.addButton('tabs', {
                title : 'Add tabbed content',
                image : url+'/images/tabs.png',
                onclick : function() {
                     ed.selection.setContent('[tabgroup][tab title="Title of tab 1"]' + ed.selection.getContent() + '[/tab][tab title="Title of tab 2"]Tab 2 content goes here. You can add as many tabs as you want using this technique.[/tab][tab title="Title of tab 3"]Tab 3 content goes here. You can add as many tabs as you want using this technique.[/tab][/tabgroup]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	tinymce.create('tinymce.plugins.slider', {
        init : function(ed, url) {
            ed.addButton('slider', {
                title : 'Add content slider',
                image : url+'/images/slider.png',
                onclick : function() {
                     ed.selection.setContent('[slider][pane]' + ed.selection.getContent() + '[/pane][pane]Pane 2 content goes here. You can add as many panes as you want using this technique.[/pane][pane]Pane 3 content goes here. You can add as many panes as you want using this technique.[/pane][/slider]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
	
	// Creates a new plugin class and a custom listbox
	 tinymce.create('tinymce.plugins.lists', {
		
		init : function(ed, url) {

            ed.addButton( 'lists', {
                type: 'listbox',
                text: 'List',
                icon: false,
				fixedWidth: true,
                onselect: function(e) {
                }, 
                values: [

                    {text: 'Fancy List', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[fancylist]' + sel + '[/fancylist]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Arrow List', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[arrowlist]' + sel + '[/arrowlist]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Check List', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[checklist]' + sel + '[/checklist]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Star List', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[starlist]' + sel + '[/starlist]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Plus List', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[pluslist]' + sel + '[/pluslist]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Heart List', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[heartlist]' + sel + '[/heartlist]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Info List', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Put your content here'; 
                        content = '[infolist]' + sel + '[/infolist]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},

                ]
            });  
		}        
    });	
	// Creates a new plugin class and a custom listbox
    tinymce.create('tinymce.plugins.columns', {
		
		init : function(ed, url) {

            ed.addButton( 'columns', {
                type: 'listbox',
                text: 'Column',
                icon: false,
				fixedWidth: true,
                onselect: function(e) {
                }, 
                values: [

                    {text: 'One Third', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_third]' + sel + '[/one_third]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'One Third (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_third_last]' + sel + '[/one_third_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Two Thirds', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[two_third]' + sel + '[/two_third]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Two Thirds (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[two_third_last]' + sel + '[/two_third_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'One Half', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_half]' + sel + '[/one_half]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'One Half (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_half_last]' + sel + '[/one_half_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'One Fourth', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_fourth]' + sel + '[/one_fourth]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'One Fourth (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_fourth_last]' + sel + '[/one_fourth_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Three Fourths', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[three_fourth]' + sel + '[/three_fourth]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Three Fourths (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[three_fourth_last]' + sel + '[/three_fourth_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'One Fifth', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_fifth]' + sel + '[/one_fifth]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'One Fifth (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_fifth_last]' + sel + '[/one_fifth_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Two Fifths', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[two_fifth]' + sel + '[/two_fifth]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Two Fifths (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[two_fifth_last]' + sel + '[/two_fifth_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Three Fifths', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[three_fifth]' + sel + '[/three_fifth]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Three Fifths (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[three_fifth_last]' + sel + '[/three_fifth_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Fourth Fifths', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[four_fifth]' + sel + '[/four_fifth]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Four Fifths (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[four_fifth_last]' + sel + '[/four_fifth_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'One Sixth', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_sixth]' + sel + '[/one_sixth]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'One Sixth (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[one_sixth_last]' + sel + '[/one_sixth_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Five Sixths', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[five_sixth]' + sel + '[/five_sixth]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Five Sixths (last)', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Column content'; 
                        content = '[five_sixth_last]' + sel + '[/five_sixth_last]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},

                ]
            });  
		} 
    });	
	
	// Creates a new plugin class and a custom splitbutton
    tinymce.create('tinymce.plugins.smallbuttons', {
		
		init : function(ed, url) {

            ed.addButton( 'smallbuttons', {
                type: 'listbox',
                text: 'Button',
                icon: false,
				fixedWidth: true,
                onselect: function(e) {
                }, 
                values: [

                    {text: 'Light Grey', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="lightgrey"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Grey', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="grey"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Dark Grey', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="darkgrey"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Black', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="black"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Slate', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="slate"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Blue', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="blue"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Sky', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="sky"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Green', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="green"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Moss', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="moss"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Red', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="red"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Rust', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="rust"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Brown', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="brown"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Pink', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="pink"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Purple', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="purple"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},

                ]
            });  
		} 
				
    });	
	
	// Creates a new plugin class and a custom splitbutton
    tinymce.create('tinymce.plugins.largebuttons', {
        init : function(ed, url) {

            ed.addButton( 'largebuttons', {
                type: 'listbox',
                text: 'Large Button',
                icon: false,
				fixedWidth: true,
                onselect: function(e) {
                }, 
                values: [

                    {text: 'Light Grey', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="lightgrey" size="large"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Grey', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="grey" size="large"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Dark Grey', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="darkgrey" size="large"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Black', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="black" size="large"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Slate', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="slate" size="large"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Blue', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="blue" size="large"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Sky', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="sky" size="large"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Green', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="green" size="large"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Moss', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="moss" size="large"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Red', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="red" size="large"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Rust', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="rust" size="large"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Brown', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="brown" size="large"]' + sel + '[/button]'; 
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Pink', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="pink" size="large"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},
					{text: 'Purple', onclick : function() {
                        var sel = tinyMCE.activeEditor.selection.getContent();                        
                        if (sel == '') sel = 'Button text'; 
                        content = '[button link="The URL of the button" variation="purple" size="large"]' + sel + '[/button]';  
                        tinymce.execCommand('mceInsertContent', false, content);						
                    }},

                ]
            });  
		}
    });	
	
	tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);
	tinymce.PluginManager.add('divider', tinymce.plugins.divider);
	tinymce.PluginManager.add('quote', tinymce.plugins.quote);
	tinymce.PluginManager.add('pullquoteleft', tinymce.plugins.pullquoteleft);
	tinymce.PluginManager.add('pullquoteright', tinymce.plugins.pullquoteright);	
	tinymce.PluginManager.add('togglesimple', tinymce.plugins.togglesimple);
	tinymce.PluginManager.add('togglebox', tinymce.plugins.togglebox);	
	tinymce.PluginManager.add('signoff', tinymce.plugins.signoff);	
	tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);
	tinymce.PluginManager.add('slider', tinymce.plugins.slider);
	tinymce.PluginManager.add('boxes', tinymce.plugins.boxes);		
	tinymce.PluginManager.add('columns', tinymce.plugins.columns);	
	tinymce.PluginManager.add('smallbuttons', tinymce.plugins.smallbuttons);
	tinymce.PluginManager.add('largebuttons', tinymce.plugins.largebuttons);
	tinymce.PluginManager.add('lists', tinymce.plugins.lists);		
})();