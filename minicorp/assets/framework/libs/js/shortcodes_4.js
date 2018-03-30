(function() {

    function ishAddSingle (object, editor, e, a, atribs, icon) {

        var atts = '';
        var icn = '';

        for (var key in atribs) {
            atts += ' '+ key + '="'+ atribs[key] + '"';
        }

        if (icon ) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = e;
        item['icon'] = icn;
        item['onclick'] = function () {
            editor.insertContent('['+ a + atts + ']');
        }

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddPair (object, editor, e, a, atribs, message, cbefore, cafter, icon ) {

        var atts = '';
        var cb = '';
        var ca = '';
        var msg = 'Enter your content here.'
        var icn = '';

        if (cbefore){
            cb = cbefore;
        }
        if (cafter){
            ca = cafter;
        }
        if (message){
            msg = message;
        }

        for (var key in atribs) {
            atts += ' '+ key + '="'+ atribs[key] + '"';
        }

        if (icon ) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = e;
        item['icon'] = icn;
        item['onclick'] = function () {
            if ( editor.selection.getContent() != '' ){
                editor.insertContent('['+ a + atts + ']'+ editor.selection.getContent() + '[/'+ a + ']');
                //tinyMCE.activeEditor.execCommand("mceInsertContent", false, '['+ a + atts + ']'+ tinyMCE.activeEditor.selection.getContent() + '[/'+ a + ']');
            }
            else{
                editor.insertContent('['+ a + atts + ']'+ cb + msg + ca + '[/'+ a + ']');
                //tinyMCE.activeEditor.execCommand("mceInsertContent", false, '['+ a + atts + ']'+ cb + msg + ca + '[/'+ a + ']') ;
            }
        }

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddBlockPair (object, editor, e, a, atribs, message, cbefore, cafter, icon ) {

        var atts = '';
        var cb = '';
        var ca = '';
        var msg = 'Enter your content here.'
        var icn = '';

        if (cbefore){
            cb = cbefore;
        }
        if (cafter){
            ca = cafter;
        }
        if (message){
            msg = message;
        }

        for (var key in atribs) {
            atts += ' '+ key + '="'+ atribs[key] + '"';
        }

        if (icon) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = e;
        item['icon'] = icn;
        item['onclick'] = function () {
            if ( editor.selection.getContent() != '' ){
                editor.insertContent('<p>['+ a + atts + ']</p>'+ editor.selection.getContent() + '<p>[/'+ a + ']</p>');
            }
            else{
                editor.insertContent('<p>['+ a + atts + ']</p>'+ cb + msg + ca + '<p>[/'+ a + ']</p>');
            }
        }

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddFree(object, editor, e, content ) {
        // Prepare the JSON Object item
        var item = {};
        item['text'] = e;
        item['onclick'] = function () {
            if ( editor.selection.getContent() != '' ){
                //editor.insertContent('['+ a + atts + ']'+ editor.selection.getContent() + '[/'+ a + ']');
            }
            else{
                editor.insertContent( content );
            }
        }

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddSubmenu(object, editor, title, icon, itemsObject ) {
        var icn = '';

        if (icon ) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = title;
        item['icon'] = icn;
        item['menu'] = itemsObject;

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddSeparator(object) {

        // Prepare the JSON Object item
        var item = {};
        item['text'] = '-';

        // Add the item to the JSON object
        object.push(item);
    }


    tinymce.PluginManager.add( 'ishyoboy_shortcodes_select', function( editor, url ) {

        var ish_sc_content = '';
        var buttonMenu = [];

        /*
         * 1: COLUMN SHORTCODES
         */

        // Row *********************************************************************************************************
        ishAddPair( buttonMenu, editor, 'Row', 'row', {}, '<p>Enter your content here.</p>');


            var buttonMenu_sublevel_1 = [];
            ishAddPair(buttonMenu_sublevel_1, editor, 'One full', 'one_full');
            ishAddPair(buttonMenu_sublevel_1, editor, 'One half', 'one_half');
            ishAddPair(buttonMenu_sublevel_1, editor, 'One third', 'one_third');
            ishAddPair(buttonMenu_sublevel_1, editor, 'One fourth', 'one_fourth');
            ishAddPair(buttonMenu_sublevel_1, editor, 'One sixth', 'one_sixth');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Two thirds', 'two_thirds');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Three fourths', 'three_fourths');
            ishAddSeparator(buttonMenu_sublevel_1);

            var buttonMenu_sublevel_2 = [];
            ishAddPair(buttonMenu_sublevel_2, editor, 'One full', 'one_full_nested1');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One half', 'one_half_nested1');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One third', 'one_third_nested1');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One fourth', 'one_fourth_nested1');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One sixth', 'one_sixth_nested1');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Two thirds', 'two_thirds_nested1');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Three fourths', 'three_fourths_nested1');
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Nested 1', null, buttonMenu_sublevel_2 );

            buttonMenu_sublevel_2 = [];
            ishAddPair(buttonMenu_sublevel_2, editor, 'One full', 'one_full_nested2');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One half', 'one_half_nested2');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One third', 'one_third_nested2');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One fourth', 'one_fourth_nested2');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One sixth', 'one_sixth_nested2');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Two thirds', 'two_thirds_nested2');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Three fourths', 'three_fourths_nested2');
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Nested 2', null, buttonMenu_sublevel_2 );

            buttonMenu_sublevel_2 = [];
            ishAddPair(buttonMenu_sublevel_2, editor, 'One full', 'one_full_nested3');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One half', 'one_half_nested3');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One third', 'one_third_nested3');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One fourth', 'one_fourth_nested3');
            ishAddPair(buttonMenu_sublevel_2, editor, 'One sixth', 'one_sixth_nested3');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Two thirds', 'two_thirds_nested3');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Three fourths', 'three_fourths_nested3');
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Nested 3', null, buttonMenu_sublevel_2 );

        ishAddSubmenu( buttonMenu, editor, 'Default', null, buttonMenu_sublevel_1 );

            buttonMenu_sublevel_1 = [];

            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 1', 'grid1');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 2', 'grid2');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 3', 'grid3');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 4', 'grid4');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 5', 'grid5');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 6', 'grid6');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 7', 'grid7');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 8', 'grid8');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 9', 'grid9');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 10', 'grid10');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 11', 'grid11');
            ishAddPair(buttonMenu_sublevel_1, editor, 'Grid 12', 'grid12');

        ishAddSubmenu( buttonMenu, editor, 'Advanced', null, buttonMenu_sublevel_1 );

            buttonMenu_sublevel_1 = [];

            ish_sc_content =
                '<p>[row]</p>'+
                    '<p>[one_full]</p>'+
                    '<p>[/one_full]</p>'+
                    '<p>[/row]</p>';
            ishAddFree(buttonMenu_sublevel_1, editor, 'Row full', ish_sc_content );

            ish_sc_content =
                '<p>[row]</p>'+
                    '<p>[one_half]</p>'+
                    '<p>[/one_half]</p>'+
                    '<p>[one_half]</p>'+
                    '<p>[/one_half]</p>'+
                    '<p>[/row]</p>';
            ishAddFree(buttonMenu_sublevel_1, editor, 'Row halfs', ish_sc_content );

            ish_sc_content =
                '<p>[row]</p>'+
                    '<p>[one_third]</p>'+
                    '<p>[/one_third]</p>'+
                    '<p>[one_third]</p>'+
                    '<p>[/one_third]</p>'+
                    '<p>[one_third]</p>'+
                    '<p>[/one_third]</p>'+
                    '<p>[/row]</p>';
            ishAddFree(buttonMenu_sublevel_1, editor, 'Row thirds', ish_sc_content );

            ish_sc_content =
                '<p>[row]</p>'+
                    '<p>[one_fourth]</p>'+
                    '<p>[/one_fourth]</p>'+
                    '<p>[one_fourth]</p>'+
                    '<p>[/one_fourth]</p>'+
                    '<p>[one_fourth]</p>'+
                    '<p>[/one_fourth]</p>'+
                    '<p>[one_fourth]</p>'+
                    '<p>[/one_fourth]</p>'+
                    '<p>[/row]</p>';
            ishAddFree(buttonMenu_sublevel_1, editor, 'Row fourths', ish_sc_content );

            ish_sc_content =
                '<p>[row]</p>'+
                    '<p>[one_sixth]</p>'+
                    '<p>[/one_sixth]</p>'+
                    '<p>[one_sixth]</p>'+
                    '<p>[/one_sixth]</p>'+
                    '<p>[one_sixth]</p>'+
                    '<p>[/one_sixth]</p>'+
                    '<p>[one_sixth]</p>'+
                    '<p>[/one_sixth]</p>'+
                    '<p>[one_sixth]</p>'+
                    '<p>[/one_sixth]</p>'+
                    '<p>[one_sixth]</p>'+
                    '<p>[/one_sixth]</p>'+
                    '<p>[/row]</p>';
            ishAddFree(buttonMenu_sublevel_1, editor, 'Row sixths', ish_sc_content );

        ishAddSubmenu( buttonMenu, editor, 'Predefined Rows', null, buttonMenu_sublevel_1 );

        ishAddSeparator( buttonMenu );

        ishAddSingle(buttonMenu, editor, 'Divider', 'divider', {});
        ishAddSingle(buttonMenu, editor, 'Separator', 'separator');

        // BUTTON 1
        editor.addButton( 'ishyoboy_columns_shortcodes' , {
            title: 'Column Shortcodes',
            tooltip: 'Column Shortcodes',
            // image: ishyoboy_globals.IYB_FRAMEWORK_URI + "/images/icon-columns.png",
            icon: 'ishyoboy_columns_shortcodes',
            type: 'menubutton',
            menu: buttonMenu
        });

        /*
         * 2: TYPOGRAPHY SHORTCODES
         */

        buttonMenu = [];

        // Dropcaps ****************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddPair(buttonMenu_sublevel_1, editor, 'Default', 'dropcap', {'color': 'color1'});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Boxed', 'dropcap', {'color': 'color1', 'boxed': 'yes'});
        ishAddSubmenu( buttonMenu, editor, 'Dropcaps', 'dropcaps', buttonMenu_sublevel_1 );

        // Headlines ***************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddPair(buttonMenu_sublevel_1, editor, 'Default', 'headline', {'tag': "h4", 'color': 'color2'});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Iconic', 'headline', {'tag': 'h4', 'color': 'color2', 'icon': 'icon-address'});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Lined', 'headline', {'tag': 'h4', 'lined': 'yes', 'color': 'color2'});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Section Headline', 'section_headline', {'tag': 'h4', 'lined': 'yes', 'color': 'color2'});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Text as Headline', 'headline', {'tag': 'div', 'css_class': 'h1', 'color': 'color2'});
        ishAddSubmenu( buttonMenu, editor, 'Headlines', 'headlines', buttonMenu_sublevel_1 );

        // Icons *******************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddSingle(buttonMenu_sublevel_1, editor, 'Default', 'icon', {'icon': 'icon-download-cloud', 'size': '36', 'align': 'left', 'color': 'color2', 'url': '', 'new_window': 'no'});
        ishAddSingle(buttonMenu_sublevel_1, editor, 'Square', 'icon', {'type': 'square', 'icon': 'icon-pin', 'size': '22', 'align': 'left', 'color': 'color2', 'url': '', 'new_window': 'no'});
        ishAddSingle(buttonMenu_sublevel_1, editor, 'Circle', 'icon', {'type': 'circle', 'icon': 'icon-pin', 'size': '22', 'align': 'left', 'color': 'color2', 'url': '', 'new_window': 'no'});
        ishAddSubmenu( buttonMenu, editor, 'Icons', 'icons', buttonMenu_sublevel_1 );

        // Lists *******************************************************************************************
        buttonMenu_sublevel_1 = [];
        ish_sc_content = '<ul><li>Item 1</li><li>Item 2</li></ul>';
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Plus', 'list', {'type': 'plus', 'color': 'color1'}, ish_sc_content, null, null, 'plus');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Minus', 'list', {'type': 'minus', 'color': 'color1'}, ish_sc_content, null, null, 'minus');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Tick', 'list', {'type': 'tick', 'color': 'color1'}, ish_sc_content, null, null, 'ok');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Cancel', 'list', {'type': 'cancel', 'color': 'color1'}, ish_sc_content, null, null, 'cancel');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Pointer', 'list', {'type': 'pointer', 'color': 'color1'}, ish_sc_content, null, null, 'pointer');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Square', 'list', {'type': 'square', 'color': 'color1'}, ish_sc_content, null, null, 'square');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Square empty', 'list', {'type': 'square-empty', 'color': 'color1'}, ish_sc_content, null, null, 'square-empty');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Circle', 'list', {'type': 'circle', 'color': 'color1'}, ish_sc_content, null, null, 'circle');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Circle empty', 'list', {'type': 'circle-empty', 'color': 'color1'}, ish_sc_content, null, null, 'circle-empty');
        ishAddSubmenu( buttonMenu, editor, 'Lists', 'lists', buttonMenu_sublevel_1 );

        // Mark ********************************************************************************************
        ishAddPair(buttonMenu, editor, 'Mark', 'mark', {'color': ''}, null, null, null, 'mark');

        // Quote & Pullquote *******************************************************************************************
        buttonMenu_sublevel_1 = [];

            // Quote ***************************************************************************************************
            buttonMenu_sublevel_2 = [];
            ishAddPair(buttonMenu_sublevel_2, editor, 'Default', 'quote', {'color': ''}, null , null ,'[author]The Author[/author]');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Boxed', 'quote', {'color': '', 'boxed': 'yes'}, null , null ,'[author]The Author[/author]');
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Quotes', null, buttonMenu_sublevel_2 );

            // Pullquote ***********************************************************************************************
            buttonMenu_sublevel_2 = [];
            ishAddPair(buttonMenu_sublevel_2, editor, 'Default', 'pullquote', {'color': '', 'align': 'left'}, null , null ,'[author]The Author[/author]');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Boxed', 'pullquote', {'color': '', 'align': 'left', 'boxed': "yes"}, null , null ,'[author]The Author[/author]');
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Pullquote', null, buttonMenu_sublevel_2 );

        ishAddSubmenu( buttonMenu, editor, 'Quote & Pullquote', 'quotes', buttonMenu_sublevel_1 );

        // BUTTON 2
        editor.addButton( 'ishyoboy_typography_shortcodes' , {
            title: 'Typography Shortcodes',
            tooltip: 'Typography Shortcodes',
            icon: 'ishyoboy_typography_shortcodes',
            type: 'menubutton',
            menu: buttonMenu
        });

        /*
         * 3: BLOCK SHORTCODES
         */

        buttonMenu = [];

        // Accordion & Toggle ******************************************************************************************
        buttonMenu_sublevel_1 = [];

        // Accordion ***********************************************************************************************
        buttonMenu_sublevel_2 = [];
        ish_sc_content =
            '<p>[accordion]</p>'+
                '<p>[acc_item title="Enter Title here." active="yes"]Enter your content here.[/acc_item]</p>'+
                '<p>[acc_item title="Enter Title here."]Enter your content here.[/acc_item]</p>'+
                '<p>[/accordion]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Accordion', ish_sc_content );
        ishAddPair(buttonMenu_sublevel_2, editor, 'Accordion Item', 'acc_item', {'title': 'Enter Title here.', 'active': 'no'});
        ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Accordion', null, buttonMenu_sublevel_2 );

        // Toggle *************************************************************************************************
        buttonMenu_sublevel_2 = [];
        ish_sc_content =
            '<p>[toggle]</p>'+
                '<p>[tgg_item title="Enter Title here." active="yes"]Enter your content here.[/tgg_item]</p>'+
                '<p>[tgg_item title="Enter Title here."]Enter your content here.[/tgg_item]</p>'+
                '<p>[/toggle]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Toggle', ish_sc_content );
        ishAddPair(buttonMenu_sublevel_2, editor, 'Toggle Item', 'tgg_item', {'title': 'Enter Title here.', 'active': 'no'});
        ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Toggle', null, buttonMenu_sublevel_2 );

        ishAddSubmenu( buttonMenu, editor, 'Accordion & Toggle', 'accordion', buttonMenu_sublevel_1 );



        // Alerts ******************************************************************************************
        buttonMenu_sublevel_1 = [];

            // Default *************************************************************************************************
            buttonMenu_sublevel_2 = [];
            ishAddPair(buttonMenu_sublevel_2, editor, 'Info',    'alert', {'type': 'info'}, 'Info');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Warning', 'alert', {'type': 'warning'}, 'Warning');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Success', 'alert', {'type': 'success'}, 'Success');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Error',   'alert', {'type': 'error'}, 'Error');
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Default', null, buttonMenu_sublevel_2 );

            // Closable *************************************************************************************************
            buttonMenu_sublevel_2 = [];
            ishAddPair(buttonMenu_sublevel_2, editor, 'Info',    'alert', {'type': 'info', 'closable': 'yes'}, 'Info');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Warning', 'alert', {'type': 'warning', 'closable': 'yes'}, 'Warning');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Success', 'alert', {'type': 'success', 'closable': 'yes'}, 'Success');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Error',   'alert', {'type': 'error', 'closable': 'yes'}, 'Error');
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Closable', null, buttonMenu_sublevel_2 );

            // Iconic *************************************************************************************************
            buttonMenu_sublevel_2 = [];
            ishAddPair(buttonMenu_sublevel_2, editor, 'Info',    'alert', {'type': 'info', 'icon': 'icon-help-2'}, 'Info');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Warning', 'alert', {'type': 'warning', 'icon': 'icon-attention-2'}, 'Warning');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Success', 'alert', {'type': 'success', 'icon': 'icon-ok'}, 'Success');
            ishAddPair(buttonMenu_sublevel_2, editor, 'Error',   'alert', {'type': 'error', 'icon': 'icon-cancel-2'}, 'Error');
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Iconic', null, buttonMenu_sublevel_2 );

        ishAddSubmenu( buttonMenu, editor, 'Alerts', 'alerts', buttonMenu_sublevel_1 );

        // Boxes *******************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddPair(buttonMenu_sublevel_1, editor, 'Default', 'box', {'color': '', 'icon': '', 'align': 'left'});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Iconic', 'iconic_box', {'color': '', 'icon': 'icon-star', 'align': 'left'});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Box Group', 'box_group');
        ishAddSubmenu( buttonMenu, editor, 'Boxes', 'boxes', buttonMenu_sublevel_1 );

        // Buttons *****************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddPair(buttonMenu_sublevel_1, editor, 'Small', 'button', {'url': '#', 'size': 'small', 'color': 'color1', 'new_window': 'no', 'full_width': 'no', 'align': 'left'} );
        ishAddPair(buttonMenu_sublevel_1, editor, 'Medium', 'button', {'url': '#', 'size': 'medium', 'color': 'color1', 'new_window': 'no', 'full_width': 'no', 'align': 'left'} );
        ishAddPair(buttonMenu_sublevel_1, editor, 'Big', 'button', {'url': '#', 'size': 'big', 'color': 'color1', 'new_window': 'no', 'full_width': 'no', 'align': 'left'} );
        ishAddPair(buttonMenu_sublevel_1, editor, 'Advanced', 'button', {'url': '#', 'size': 'small', 'new_window': 'no', 'bg_color': 'red', 'text_color': '#fff', 'full_width': 'no', 'align': 'left'} );
        ishAddSubmenu( buttonMenu, editor, 'Buttons', 'buttons', buttonMenu_sublevel_1 );

        // Menu ********************************************************************************************
        ishAddSingle(buttonMenu, editor, 'Menu', 'menu', {'menu': '', 'depth': '0', 'color': ''}, 'menu');

        // Pre & Code **************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddPair(buttonMenu_sublevel_1, editor, 'Pre', 'pre', {}, '...');
        ishAddPair(buttonMenu_sublevel_1, editor, 'Code', 'code', {}, '...');
        ishAddSubmenu( buttonMenu, editor, 'Pre & Code', 'precode', buttonMenu_sublevel_1 );

        // Skills ******************************************************************************************
        buttonMenu_sublevel_1 = [];
        ish_sc_content =
            '<p>[skill percent="88" outside="no"]Design[/skill]</p>' +
                '<p>[skill percent="41" outside="no"]HTML[/skill]</p>' +
                '<p>[skill percent="65" outside="no"]jQuery[/skill]</p>';
        ishAddPair(buttonMenu_sublevel_1, editor, 'Predefined', 'skills', {'color': 'color1'}, ish_sc_content);
        ishAddPair(buttonMenu_sublevel_1, editor, 'Skills', 'skills', {'color': ''});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Skill', 'skill', {'percent': '', 'outside': 'no'});
        ishAddSubmenu( buttonMenu, editor, 'Skills', 'skills', buttonMenu_sublevel_1 );

        // Tables & pricings *******************************************************************************
        buttonMenu_sublevel_1 = [];

        // Tables *************************************************************************************************
        buttonMenu_sublevel_2 = [];
        ish_sc_content =
            '<p>[table align="center"]</p>' +
                '<table>' +
                '<tbody>' +
                '<tr>' +
                '<th>Item 1</th>' +
                '<th>Item 2</th>' +
                '<th>Item 3</th>' +
                '<th>Item 4</th>' +
                '</tr>' +
                '<tr>' +
                '<td>Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td>Desc4</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td>Desc4</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>' +
                '<p>[/table]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Table', ish_sc_content );

        ish_sc_content =
            '<p>[table align="center" striped="yes"]</p>' +
                '<table>' +
                '<tbody>' +
                '<tr>' +
                '<th>Item 1</th>' +
                '<th>Item 2</th>' +
                '<th>Item 3</th>' +
                '<th>Item 4</th>' +
                '</tr>' +
                '<tr>' +
                '<td>Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td>Desc4</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td>Desc4</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>' +
                '<p>[/table]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Table - Striped', ish_sc_content );

        ish_sc_content =
            '<p>[table align="center" striped="yes"]</p>' +
                '<table>' +
                '<tbody>' +
                '<tr>' +
                '<th>Item 1</th>' +
                '<th class="highlight-col color1">Item 2</th>' +
                '<th>Item 3</th>' +
                '<th>Item 4</th>' +
                '</tr>' +
                '<tr>' +
                '<td>Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td>Desc4</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td>Desc4</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>' +
                '<p>[/table]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Table - Highlighted Column', ish_sc_content );

        ish_sc_content =
            '<p>[table align="center" striped="yes"]</p>' +
                '<table>' +
                '<tbody>' +
                '<tr>' +
                '<th>Item 1</th>' +
                '<th>Item 2</th>' +
                '<th>Item 3</th>' +
                '<th>Item 4</th>' +
                '</tr>' +
                '<tr class="highlight color2">' +
                '<td>Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td>Desc4</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td>Desc4</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>' +
                '<p>[/table]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Table - Highlighted Row', ish_sc_content );

        ish_sc_content =
            '<p>[table align="center" striped="yes"]</p>' +
                '<table>' +
                '<tbody>' +
                '<tr>' +
                '<th>Item 1</th>' +
                '<th class="highlight color1" >Item 2</th>' +
                '<th>Item 3</th>' +
                '<th>Item 4</th>' +
                '</tr>' +
                '<tr>' +
                '<td>Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td class="highlight">Desc4</td>' +
                '</tr>' +
                '<tr>' +
                '<td class="highlight color2">Desc1</td>' +
                '<td>Desc2</td>' +
                '<td>Desc3</td>' +
                '<td>Desc4</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>' +
                '<p>[/table]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Table - Highlighted Random', ish_sc_content );
        ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Tables', null, buttonMenu_sublevel_2 );

        // Pricing Tables *************************************************************************************************
        buttonMenu_sublevel_2 = [];
        ish_sc_content =
            '<p>[pricing_table align="center" background="yes" striped="yes"]</p>'+
                '<p>[pricing_row headline="yes" color="color1" highlight="yes"]</p>'+
                '<p>[headline tag="h2" color="color2"]Demo[/headline]</p>'+
                '<p>[headline tag="h3"]Free for 60 days[/headline]</p>'+
                '<p>Great for personal</p>'+
                '<p>[/pricing_row]</p>'+
                '<p>[pricing_row]3 accounts[/pricing_row]</p>'+
                '<p>[pricing_row]6 Export formats[/pricing_row]</p>'+
                '<p>[pricing_row]Enhanced security[/pricing_row]</p>'+
                '<p>[pricing_row]Offline access[/pricing_row]</p>'+
                '<p>[pricing_row]-[/pricing_row]</p>'+
                '<p>[pricing_row]-[/pricing_row]</p>'+
                '<p>[pricing_row]-[/pricing_row]</p>'+
                '<p>[pricing_row][button url="#" size="medium" color="color2" new_window="no"]Sign Up[/button][/pricing_row]</p>'+
                '<p>[/pricing_table]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Pricing Table - Color1', ish_sc_content );

        ish_sc_content =
            '<p>[pricing_table align="center" background="yes" striped="yes"]</p>'+
                '<p>[pricing_row headline="yes" color="color2" highlight="yes"]</p>'+
                '<p>[headline tag="h2" color="color1"]Demo[/headline]</p>'+
                '<p>[headline tag="h3"]Free for 60 days[/headline]</p>'+
                '<p>Great for personal</p>'+
                '<p>[/pricing_row]</p>'+
                '<p>[pricing_row]3 accounts[/pricing_row]</p>'+
                '<p>[pricing_row]6 Export formats[/pricing_row]</p>'+
                '<p>[pricing_row]Enhanced security[/pricing_row]</p>'+
                '<p>[pricing_row]Offline access[/pricing_row]</p>'+
                '<p>[pricing_row]-[/pricing_row]</p>'+
                '<p>[pricing_row]-[/pricing_row]</p>'+
                '<p>[pricing_row]-[/pricing_row]</p>'+
                '<p>[pricing_row][button url="#" size="medium" color="color1" new_window="no"]Sign Up[/button][/pricing_row]</p>'+
                '<p>[/pricing_table]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Pricing Table - Color2', ish_sc_content );

        ish_sc_content =
            '<p>[pricing_table align="center" background="yes" striped="yes"]</p>'+
                '<p>[pricing_row headline="yes" color="color3" highlight="no"]</p>'+
                '<p>[headline tag="h2" color="color1"]Demo[/headline]</p>'+
                '<p>[headline tag="h3"]Free for 60 days[/headline]</p>'+
                '<p>Great for personal</p>'+
                '<p>[/pricing_row]</p>'+
                '<p>[pricing_row]3 accounts[/pricing_row]</p>'+
                '<p>[pricing_row]6 Export formats[/pricing_row]</p>'+
                '<p>[pricing_row]Enhanced security[/pricing_row]</p>'+
                '<p>[pricing_row]Offline access[/pricing_row]</p>'+
                '<p>[pricing_row]-[/pricing_row]</p>'+
                '<p>[pricing_row]-[/pricing_row]</p>'+
                '<p>[pricing_row]-[/pricing_row]</p>'+
                '<p>[pricing_row][button url="#" size="medium" new_window="no"]Sign Up[/button][/pricing_row]</p>'+
                '<p>[/pricing_table]</p>';
        ishAddFree(buttonMenu_sublevel_2, editor, 'Pricing Table - Color3', ish_sc_content );
        ishAddSeparator(buttonMenu_sublevel_2);
        ishAddPair(buttonMenu_sublevel_2, editor, 'Pricing Row', 'pricing_row', {});
        ishAddPair(buttonMenu_sublevel_2, editor, 'Pricing Row headline', 'pricing_row', {'headline': 'yes', 'color': "color3", 'highlight': 'no'});
        ishAddPair(buttonMenu_sublevel_2, editor, 'Pricing Table', 'pricing_table', {'align': 'center', 'background': 'yes', 'striped': 'yes'});

        ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Pricing Tables', null, buttonMenu_sublevel_2 );

        ishAddSubmenu( buttonMenu, editor, 'Tables & Pricings', 'table', buttonMenu_sublevel_1 );

        // Tabs, Toogle ************************************************************************************
        buttonMenu_sublevel_1 = [];
        ish_sc_content =
            '<p>[tabs_navigation pair="tab_set_1"]</p>'+
                '<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
                '<p>[/tabs_navigation]</p>'+
                '<p>[tabs_content pair="tab_set_1"]</p>'+
                '<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
                '<p>[/tabs_content]</p>';
        ishAddFree(buttonMenu_sublevel_1, editor, 'Tabs - Top', ish_sc_content );

        ish_sc_content =
            '<p>[tabs_content pair="tab_set_2"]</p>'+
                '<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
                '<p>[/tabs_content]</p>'+
                '<p>[tabs_navigation pair="tab_set_2"]</p>'+
                '<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
                '<p>[/tabs_navigation]</p>';
        ishAddFree(buttonMenu_sublevel_1, editor, 'Tabs - Bottom', ish_sc_content );

        ish_sc_content =
            '<p>[row]</p>'+
                '<p>[one_fourth]</p>'+
                '<p>[tabs_navigation pair="tab_set_3" vertical="yes"]</p>'+
                '<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
                '<p>[/tabs_navigation]</p>'+
                '<p>[/one_fourth]</p>'+
                '<p>[three_fourths]</p>'+
                '<p>[tabs_content pair="tab_set_3"]</p>'+
                '<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
                '<p>[/tabs_content]</p>'+
                '<p>[/three_fourths]</p>'+
                '<p>[/row]</p>';
        ishAddFree(buttonMenu_sublevel_1, editor, 'Tabs - Left', ish_sc_content );

        ish_sc_content =
            '<p>[row]</p>'+
                '<p>[three_fourths]</p>'+
                '<p>[tabs_content pair="tab_set_3"]</p>'+
                '<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
                '<p>[/tabs_content]</p>'+
                '<p>[/three_fourths]</p>'+
                '<p>[one_fourth]</p>'+
                '<p>[tabs_navigation pair="tab_set_3" vertical="yes"]</p>'+
                '<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
                '<p>[/tabs_navigation]</p>'+
                '<p>[/one_fourth]</p>'+
                '<p>[/row]</p>';
        ishAddFree(buttonMenu_sublevel_1, editor, 'Tabs - Right', ish_sc_content );

        ish_sc_content =
            '<p>[tabs_navigation pair=""]</p>'+
                '<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
                '<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
                '<p>[/tabs_navigation]</p>';
        ishAddFree(buttonMenu_sublevel_1, editor, 'Tabs Navigation', ish_sc_content);

        ish_sc_content =
            '<p>[tabs_content pair=""]</p>'+
                '<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
                '<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
                '<p>[/tabs_content]</p>';
        ishAddFree(buttonMenu_sublevel_1, editor, 'Tabs Content', ish_sc_content);
        ishAddPair(buttonMenu_sublevel_1, editor, 'Tab Title', 'tab_title', {'pair': '', 'active': 'no'});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Tab Content', 'tab_content', {'pair': '', 'active': 'no'});
        ishAddSubmenu( buttonMenu, editor, 'Tabs', 'tabs', buttonMenu_sublevel_1 );

        // Tooltip *****************************************************************************************
        ishAddPair(buttonMenu, editor, 'Tooltip', 'tooltip', {'color': 'color1', 'tooltip': 'Tooltip text', 'tooltip_color': ''}, null, null, null, 'tooltip');


        // BUTTON 3
        editor.addButton( 'ishyoboy_block_shortcodes' , {
            title: 'Block Shortcodes',
            tooltip: 'Block Shortcodes',
            icon: 'ishyoboy_block_shortcodes',
            type: 'menubutton',
            menu: buttonMenu
        });

        /*
         * 4: SPECIAL SHORTCODES
         */

        buttonMenu = [];

        // Breadcrumbs *************************************************************************************
        ishAddSingle(buttonMenu, editor, 'Breadcrumbs', 'breadcrumbs', {}, 'breadcrumbs');

        // Charts ******************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddPair(buttonMenu_sublevel_1, editor, 'Default', 'chart', {
            'percent': '75',
            'align': 'center',
            'color': 'color1',
            'size': '150',
            'line_width': '10',
            'rounded': 'no',
            'animation_time': '2'
        }, '75%');
        ishAddPair(buttonMenu_sublevel_1, editor, 'Advanced', 'chart', {
            'percent': '75',
            'align': 'center',
            'size': '150',
            'line_width': '10',
            'rounded': 'no',
            'animation_time': '2',

            'icon': 'icon-chart-pie',
            'track_color': '#ccc',
            'bar_color': '#ff0000',
            'text_size': '30'
        }, ' 75%');
        ishAddSubmenu( buttonMenu, editor, 'Charts', 'charts', buttonMenu_sublevel_1 );


        // Section *****************************************************************************************
        buttonMenu_sublevel_1 = [];

            // Content break ***********************************************************************************************
            buttonMenu_sublevel_2 = [];
            ish_sc_content =
                '<p>[content_break]</p>'+
                    '<p>[section color="" full_width="no" pattern="yes" pattern_url=""]</p>'+
                    '<p>[/section]</p>'+
                    '<p>[/content_break]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Section', ish_sc_content );

            ish_sc_content =
                '<p>[content_break]</p>'+
                    '<p>[section color="color1" full_width="no" pattern="yes" pattern_url=""]</p>'+
                    '<p>[/section]</p>'+
                    '<p>[/content_break]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Colored Section', ish_sc_content );

            ish_sc_content =
                '<p>[content_break]</p>'+
                    '<p>[section color="" full_width="yes" pattern="yes" pattern_url=""]</p>'+
                    '<p>[/section]</p>'+
                    '<p>[/content_break]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Full-width Section', ish_sc_content );

            ish_sc_content =
                '<p>[content_break]</p>'+
                    '<p>[section color="color1" full_width="yes" pattern="yes" pattern_url=""]</p>'+
                    '<p>[/section]</p>'+
                    '<p>[/content_break]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Full-width colored Section', ish_sc_content );

            ish_sc_content =
                '<p>[content_break]</p>'+
                    '<p>[section color="" full_width="no" pattern="yes" pattern_url="" parallax_type="static"]</p>'+
                    '<p>[/section]</p>'+
                    '<p>[/content_break]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Parallax (Static) Section', ish_sc_content );

            ish_sc_content =
                '<p>[content_break]</p>'+
                    '<p>[section color="" full_width="no" pattern="yes" pattern_url="" parallax_type="dynamic" parallax_scroll="" parallax_duration="" parallax_easing=""]</p>'+
                    '<p>[/section]</p>'+
                    '<p>[/content_break]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Parallax (Dynamic) Section', ish_sc_content );
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Content break', null, buttonMenu_sublevel_2 );

            // Page break ***********************************************************************************************
            buttonMenu_sublevel_2 = [];
            ish_sc_content =
                '<p>[page_break]</p>'+
                    '<p>[/page_break]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Page break', ish_sc_content );

            ish_sc_content =
                '<p>[page_break full_width="yes"]</p>'+
                    '<p>[/page_break]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Full-width Page break', ish_sc_content );
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Page break', null, buttonMenu_sublevel_2 );

        ishAddSubmenu( buttonMenu, editor, 'Content & Page break', 'break', buttonMenu_sublevel_1 );


        // Embed ***************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddPair(buttonMenu_sublevel_1, editor, 'Default', 'embed', {}, 'Paste your third-party link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
        ishAddPair(buttonMenu_sublevel_1, editor, 'Flickr', 'embed', {}, 'Paste your Flickr image\'s page link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
        ishAddPair(buttonMenu_sublevel_1, editor, 'Instagram', 'embed', {}, 'Paste your Instagram image\'s page link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
        ishAddPair(buttonMenu_sublevel_1, editor, 'SoundCloud', 'embed', {}, 'Paste your Soundcloud mix link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
        ishAddPair(buttonMenu_sublevel_1, editor, 'Twitter', 'embed', {}, 'Paste your Twitter tweet\'s link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
        ishAddPair(buttonMenu_sublevel_1, editor, 'Videos', 'embed', {}, 'Paste your Vimeo, YouTube, DailyMotion, Viddler, Hulu, Qik, Revision3 or WordPress.tv video link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
        ishAddSubmenu( buttonMenu, editor, 'Embed & Multimedia', 'embed', buttonMenu_sublevel_1 );

        // Featured Image **********************************************************************************
        ishAddSingle(buttonMenu, editor, 'Featured Image', 'featured_image', {'align': '', 'size': 'theme-large', 'url': '', 'new_window': 'no', 'open_full_version': ''}, 'featured-image');

        // Map ***************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddSingle(buttonMenu_sublevel_1, editor, 'Default', 'map', {
            'lat_lng_1': '36.5099367, -4.8863523',
            'zoom': '15',
            'color': '',
            'invert_colors': 'no',
            'height': ''
        });
        ishAddSingle(buttonMenu_sublevel_1, editor, 'Advanced', 'map', {
            'lat_lng_1': '36.5099367, -4.8863523',
            'zoom': '15',
            'color': 'color1',
            'invert_colors': 'no',
            'height': '400'
        });
        ishAddSubmenu( buttonMenu, editor, 'Map', 'map', buttonMenu_sublevel_1 );



        // Portfolio ***************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddSingle(buttonMenu_sublevel_1, editor, 'Default', 'portfolio', {
            'category': '',
            'order': 'DESC',
            'navigation': 'yes',
            'pagination': 'yes',
            'view_all': 'no'
        });
        ishAddSingle(buttonMenu_sublevel_1, editor, 'Advanced', 'portfolio', {
            'category': '',
            'order': 'DESC',
            'navigation': 'yes',
            'pagination': 'yes',
            'view_all': 'no',
            'height': '',
            'per_page': '',
            'columns': '',
            'masonry': '',

            'fluid_layout': 'yes',
            'layout_style': '1',
            'show_title': 'yes',
            'show_categories': 'yes',
            'show_link_button': 'yes',
            'show_popup_button': 'yes',
            'animate_filter': 'yes'
        });

            // Detail ***********************************************************************************************
            buttonMenu_sublevel_2 = [];
            ishAddSingle(buttonMenu_sublevel_2, editor, 'Portfolio Gallery', 'portfolio_gallery', {'slideshow': 'yes', 'animation': 'slide', 'navigation': 'yes', 'autoslide': 'no', 'interval': '', 'thumbnail_size': ''});
            ishAddSingle(buttonMenu_sublevel_2, editor, 'Portfolio Prev / Next', 'portfolio_prev_next', {'prev_text': '', 'next_text': '', 'align': 'left'});
            ishAddSingle(buttonMenu_sublevel_2, editor, 'Portfolio Categories', 'portfolio_categories', {'separator': ', ', 'links': 'yes', 'align': 'left'});
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Detail', null, buttonMenu_sublevel_2 );

        ishAddSubmenu( buttonMenu, editor, 'Portfolio', 'portfolio', buttonMenu_sublevel_1 );

        // Recent Posts ************************************************************************************
        ishAddSingle(buttonMenu, editor, 'Recent Posts', 'recent_posts', {
            'category': '',
            'order': 'DESC',
            'columns': '4',
            'count': '4',
            'show_title_icon': 'no',
            'show_media': 'yes',
            'show_date': 'yes',
            'show_categories': 'yes',
            'show_read_more': 'yes',

            'show_author': 'no',
            'show_tags': 'no',
            'show_comments': 'no',

            'slideshow': 'no',
            'animation': '',
            'navigation': '',
            'autoslide': '',
            'interval': ''
        }, 'recent-posts');

        // Rounded images **********************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Rounded image', 'rounded_image', {'color': '', 'align': ''}, '<p>Insert your image here.</p>');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Rounded image with arrow', 'rounded_image', {'color': '', 'align': '', 'arrow': 'bottom'}, '<p>Insert your image here.</p>');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Rounded image advanced', 'rounded_image', {'color': '', 'align': '', 'arrow': 'bottom', 'width': '', 'border_width': ''}, '<p>Insert your image here.</p>');
        ishAddSubmenu( buttonMenu, editor, 'Rounded image', 'rimage', buttonMenu_sublevel_1 );

        // Slider ******************************************************************************************
        buttonMenu_sublevel_1 = [];
        ishAddSingle(buttonMenu_sublevel_1, editor, 'Ishyoboy Slider', 'slider', {'slider_name': "homepage", 'animation': 'slide', 'autoslide': "yes", 'interval': "7", 'navigation': "yes", 'height': ""});
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Slidable Slide', 'slidable', { 'autoslide': 'no', 'animation': 'slide', 'interval': "7", 'navigation': "yes"}, '<p>[slide][/slide]</p><p>[slide][/slide]</p>');
        ishAddBlockPair(buttonMenu_sublevel_1, editor, 'Slidable Fade', 'slidable', { 'autoslide': 'no', 'animation': 'fade', 'interval': "7", 'navigation': "yes"}, '<p>[slide][/slide]</p><p>[slide][/slide]</p>');
        ishAddSeparator(buttonMenu_sublevel_1);
        ishAddPair(buttonMenu_sublevel_1, editor, 'Slidable container',    'slidable');
        ishAddPair(buttonMenu_sublevel_1, editor, 'Slidable slide', 'slide');
        ishAddSubmenu( buttonMenu, editor, 'Sliders', 'sliders', buttonMenu_sublevel_1 );

        // Social Share ************************************************************************************
        ishAddSingle(buttonMenu, editor, 'Social Share', 'social_share', {}, 'soc-share');

        // Social ******************************************************************************************
        //ishAddSingle(buttonMenu, editor, 'Social', 'social', {'icon': '', 'url': '', 'new_window': 'no', 'title': '', 'tooltip': '', 'text_color': ''}, 'soc-share');

        // The Title ***************************************************************************************
        ishAddSingle(buttonMenu, editor, 'The Title', 'the_title', {}, 'headlines');


        // Timeline ****************************************************************************************
        buttonMenu_sublevel_1 = [];

            // Predefined ***********************************************************************************************
            buttonMenu_sublevel_2 = [];
            ish_sc_content =
                '<p>[timeline hover_effect="no"]</p>'+
                    '<p>[timeline_item size="big"]</p>'+
                    '<p>[timeline_content][headline tag="h2" color="color1"]Timeline title[/headline][/timeline_content]</p>'+
                    '<p>[timeline_date]23. APR[/timeline_date]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="medium"]</p>'+
                    '<p>[timeline_date]21. APR[/timeline_date]</p>'+
                    '<p>[timeline_content border="no" color=""]Enter your medium sized item content here.[/timeline_content]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="small"]</p>'+
                    '<p>[timeline_content border="no" color=""]Enter your small sized item content here.[/timeline_content]</p>'+
                    '<p>[timeline_date]20. APR[/timeline_date]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="small"]</p>'+
                    '<p>[timeline_date]20. APR[/timeline_date]</p>'+
                    '<p>[timeline_content border="no" color=""]Enter your small sized item content here.[/timeline_content]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="medium"]</p>'+
                    '<p>[timeline_content border="no" color=""]Enter your medium sized item content here.[/timeline_content]</p>'+
                    '<p>[timeline_date]15. APR[/timeline_date]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="big"]</p>'+
                    '<p>[timeline_date]15. APR[/timeline_date]</p>'+
                    '<p>[timeline_content][headline tag="h2" color="color2"]Timeline footer[/headline][/timeline_content]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[/timeline]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Default', ish_sc_content);

            ish_sc_content =
                '<p>[timeline hover_effect="no"]</p>'+
                    '<p>[timeline_item size="big"]</p>'+
                    '<p>[timeline_content][headline tag="h2" color="color1"]Timeline title[/headline][/timeline_content]</p>'+
                    '<p>[timeline_date]23. APR[/timeline_date]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="medium"]</p>'+
                    '<p>[timeline_date]21. APR[/timeline_date]</p>'+
                    '<p>[timeline_content border="yes" color=""]Enter your medium sized item content here.[/timeline_content]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="small"]</p>'+
                    '<p>[timeline_content border="yes" color=""]Enter your small sized item content here.[/timeline_content]</p>'+
                    '<p>[timeline_date]20. APR[/timeline_date]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="small"]</p>'+
                    '<p>[timeline_date]20. APR[/timeline_date]</p>'+
                    '<p>[timeline_content border="yes" color=""]Enter your small sized item content here.[/timeline_content]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="medium"]</p>'+
                    '<p>[timeline_content border="yes" color=""]Enter your medium sized item content here.[/timeline_content]</p>'+
                    '<p>[timeline_date]15. APR[/timeline_date]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="big"]</p>'+
                    '<p>[timeline_date]15. APR[/timeline_date]</p>'+
                    '<p>[timeline_content][headline tag="h2" color="color2"]Timeline footer[/headline][/timeline_content]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[/timeline]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Bordered', ish_sc_content);

            ish_sc_content =
                '<p>[timeline hover_effect="no"]</p>'+
                    '<p>[timeline_item size="big"]</p>'+
                    '<p>[timeline_content][headline tag="h2" color="color1"]Timeline title[/headline][/timeline_content]</p>'+
                    '<p>[timeline_date]23. APR[/timeline_date]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="medium"]</p>'+
                    '<p>[timeline_date]21. APR[/timeline_date]</p>'+
                    '<p>[timeline_content border="yes" color="color2"]Enter your medium sized item content here.[/timeline_content]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="small"]</p>'+
                    '<p>[timeline_content border="yes" color="color1"]Enter your small sized item content here.[/timeline_content]</p>'+
                    '<p>[timeline_date]20. APR[/timeline_date]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="small"]</p>'+
                    '<p>[timeline_date]20. APR[/timeline_date]</p>'+
                    '<p>[timeline_content border="yes" color="color2"]Enter your small sized item content here.[/timeline_content]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="medium"]</p>'+
                    '<p>[timeline_content border="yes" color="color1"]Enter your medium sized item content here.[/timeline_content]</p>'+
                    '<p>[timeline_date]15. APR[/timeline_date]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[timeline_item size="big"]</p>'+
                    '<p>[timeline_date]15. APR[/timeline_date]</p>'+
                    '<p>[timeline_content][headline tag="h2" color="color2"]Timeline footer[/headline][/timeline_content]</p>'+
                    '<p>[/timeline_item]</p>'+
                    '<p>[/timeline]</p>';
            ishAddFree(buttonMenu_sublevel_2, editor, 'Colored', ish_sc_content);
            ishAddSubmenu( buttonMenu_sublevel_1, editor, 'Predefined', null, buttonMenu_sublevel_2 );

        ishAddPair(buttonMenu_sublevel_1, editor, 'Timeline item',   'timeline_item', {'size': 'small'});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Timeline date',   'timeline_date', {});
        ishAddPair(buttonMenu_sublevel_1, editor, 'Timeline content',   'timeline_content', {'border': 'no', 'color': ''});

        ishAddSubmenu( buttonMenu, editor, 'Timeline', 'timeline', buttonMenu_sublevel_1 );

        // BUTTON 4
        editor.addButton( 'ishyoboy_special_shortcodes' , {
            title: 'Special Shortcodes',
            tooltip: 'Special Shortcodes',
            icon: 'ishyoboy_special_shortcodes',
            type: 'menubutton',
            menu: buttonMenu
        });

    });

})();