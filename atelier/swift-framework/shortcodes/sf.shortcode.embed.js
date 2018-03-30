function embedSelectedShortcode() {

    var shortcodeHTML;
    var shortcode_panel = document.getElementById( 'shortcode_panel' );
    var current_shortcode = shortcode_panel.className.indexOf( 'current' );

    if ( current_shortcode != -1 ) {

        // SHORTCODE SELECT
        var shortcode_select = document.getElementById( 'shortcode-select' ).value;


        /////////////////////////////////////////
        ////	SHORTCODE OPTION VARIABLES
        /////////////////////////////////////////

        // Add to Cart Button
        var addtocart_button_productid = document.getElementById( 'addtocart-button-productid' ).value;
        var addtocart_button_colour = document.getElementById( 'addtocart-button-colour' ).value;
        var addtocart_button_extraclass = document.getElementById( 'addtocart-button-extraclass' ).value;

        // Button
        var button_size = document.getElementById( 'button-size' ).value;
        var button_type = document.getElementById( 'button-type' ).value;
        var button_icon = document.getElementById( 'button-icon' ).value;
        var button_colour = document.getElementById( 'button-colour' ).value;
        var button_text = document.getElementById( 'button-text' ).value;
        var button_url = document.getElementById( 'button-url' ).value;
        var button_extraclass = document.getElementById( 'button-extraclass' ).value;
        var button_target = button_dropshadow = button_rounded = "";

        if ( document.getElementById( 'button-target' ).checked ) {
            button_target = "_blank";
        } else {
            button_target = "_self";
        }

        if ( document.getElementById( 'button-dropshadow' ).checked ) {
            button_dropshadow = "yes";
        } else {
            button_dropshadow = "no";
        }
        
        if ( document.getElementById( 'button-rounded' ).checked ) {
            button_rounded = "yes";
        } else {
            button_rounded = "no";
        }

        // Icons
        var icon_size = document.getElementById( 'icon-size' ).value;
        var icon_image = document.getElementById( 'icon-image' ).value;
        var icon_character = document.getElementById( 'icon-character' ).value;
        var icon_cont = document.getElementById( 'icon-cont' ).value;
        var icon_float = document.getElementById( 'icon-float' ).value;
        var icon_color = document.getElementById( 'icon-color' ).value;

        // Icon Box
        var iconbox_type = document.getElementById( 'iconbox-type' ).value;
        var iconbox_image = document.getElementById( 'iconbox-image' ).value;
        var iconbox_character = document.getElementById( 'iconbox-character' ).value;
        var iconbox_color = document.getElementById( 'iconbox-color' ).value;
        var iconbox_title = document.getElementById( 'iconbox-title' ).value;
        var iconbox_link = document.getElementById( 'iconbox-link' ).value;
        var iconbox_animation = document.getElementById( 'iconbox-animation' ).value;
        var iconbox_animation_delay = document.getElementById( 'iconbox-animation-delay' ).value;
        var iconbox_target;

        if ( document.getElementById( 'iconbox-target' ).checked ) {
            iconbox_target = "_blank";
        } else {
            iconbox_target = "_self";
        }

        // Image Banner
        var imagebanner_image = document.getElementById( 'imagebanner-image' ).value;
        var imagebanner_animation = document.getElementById( 'imagebanner-animation' ).value;
        var imagebanner_contentpos = document.getElementById( 'imagebanner-contentpos' ).value;
        var imagebanner_textalign = document.getElementById( 'imagebanner-textalign' ).value;
        var imagebanner_extraclass = document.getElementById( 'imagebanner-extraclass' ).value;
        var imagebanner_link = document.getElementById( 'imagebanner-link' ).value;
        var imagebanner_target;

        if ( document.getElementById( 'imagebanner-target' ).checked ) {
            imagebanner_target = "_blank";
        } else {
            imagebanner_target = "_self";
        }

        // Typography
        var typography_type = document.getElementById( 'typography-type' ).value;

        // Columns
        var column_options = document.getElementById( 'column-options' ).value;

        // Progress Bar
        var progressbar_percentage = document.getElementById( 'progressbar-percentage' ).value;
        var progressbar_text = document.getElementById( 'progressbar-text' ).value;
        var progressbar_value = document.getElementById( 'progressbar-value' ).value;
        var progressbar_type = document.getElementById( 'progressbar-type' ).value;
        var progressbar_colour = document.getElementById( 'progressbar-colour' ).value;

        // Chart
        var chart_percentage = document.getElementById( 'chart-percentage' ).value;
        var chart_content = document.getElementById( 'chart-content' ).value;
        var chart_size = document.getElementById( 'chart-size' ).value;
        var chart_barcolour = document.getElementById( 'chart-barcolour' ).value;
        var chart_trackcolour = document.getElementById( 'chart-trackcolour' ).value;
        var chart_align = document.getElementById( 'chart-align' ).value;

        // Counters
        var count_from = document.getElementById( 'count-from' ).value;
        var count_to = document.getElementById( 'count-to' ).value;
        var count_prefix = document.getElementById( 'count-prefix' ).value;
        var count_suffix = document.getElementById( 'count-suffix' ).value;
        var count_subject = document.getElementById( 'count-subject' ).value;
        var count_speed = document.getElementById( 'count-speed' ).value;
        var count_refresh = document.getElementById( 'count-refresh' ).value;
        var count_textstyle = document.getElementById( 'count-textstyle' ).value;
        var count_textcolor = document.getElementById( 'count-textcolor' ).value;
        var count_commas;

        if ( document.getElementById( 'count-commas' ).checked ) {
            count_commas = "true";
        } else {
            count_commas = "false";
        }

        // Countdown
        var countdown_year = document.getElementById( 'countdown-year' ).value;
        var countdown_month = document.getElementById( 'countdown-month' ).value;
        var countdown_day = document.getElementById( 'countdown-day' ).value;
        var countdown_displaytext = document.getElementById( 'countdown-displaytext' ).value;

        // Tooltip
        var tooltip_text = document.getElementById( 'tooltip-text' ).value;
        var tooltip_link = document.getElementById( 'tooltip-link' ).value;
        var tooltip_direction = document.getElementById( 'tooltip-direction' ).value;

        // Modal
        var modal_link_type = document.getElementById( 'modal-link-type' ).value;
        var modal_link_text = document.getElementById( 'modal-link-text' ).value;
        var modal_button_size = document.getElementById( 'modal-button-size' ).value;
        var modal_button_type = document.getElementById( 'modal-button-type' ).value;
        var modal_button_colour = document.getElementById( 'modal-button-colour' ).value;
        var modal_button_text = document.getElementById( 'modal-button-text' ).value;
        var modal_button_icon = document.getElementById( 'modal-button-icon' ).value;
        var modal_header = document.getElementById( 'modal-header' ).value;

        // Fullscreen Video
        var fwvideo_type = document.getElementById( 'fwvideo-type' ).value;
        var fwvideo_imageurl = document.getElementById( 'fwvideo-imageurl' ).value;
        var fwvideo_btntext = document.getElementById( 'fwvideo-btntext' ).value;
        var fwvideo_videourl = document.getElementById( 'fwvideo-videourl' ).value;
        var fwvideo_extraclass = document.getElementById( 'fwvideo-extraclass' ).value;

        // Responsive Visibilty
        var responsivevis_config = document.getElementById( 'responsivevis-config' ).value;

        // Social
        var social_size = document.getElementById( 'social-size' ).value;

        // Table
        var table_type = document.getElementById( 'table-type' ).value;
        var table_head = document.getElementById( 'table-head' ).value;
        var table_columns = document.getElementById( 'table-columns' ).value;
        var table_rows = document.getElementById( 'table-rows' ).value;

        // Lists
        var list_icon = document.getElementById( 'list-icon' ).value;
        var list_items = document.getElementById( 'list-items' ).value;
		var list_extraclass = document.getElementById( 'list-extraclass' ).value;
		
		/////////////////////////////////////////
        ////	ADD TO CART BUTTON SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-addtocart-button' ) {
            shortcodeHTML = '[sf_addtocart_button product_id="' + addtocart_button_productid + '" colour="' + addtocart_button_colour + '" extraclass="' + addtocart_button_extraclass + '"]';
        }

        /////////////////////////////////////////
        ////	BUTTON SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-buttons' ) {
            shortcodeHTML = '[sf_button colour="' + button_colour + '" type="' + button_type + '" size="' + button_size + '" link="' + button_url + '" target="' + button_target + '" icon="' + button_icon + '" dropshadow="' + button_dropshadow + '" rounded="' + button_rounded + '" extraclass="' + button_extraclass + '"]' + button_text + '[/sf_button]';
        }

        /////////////////////////////////////////
        ////	ICON SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-icons' ) {
            shortcodeHTML = '[icon image="' + icon_image + '" character="' + icon_character + '" size="' + icon_size + '" cont="' + icon_cont + '" float="' + icon_float + '" color="' + icon_color + '"]';
        }

        /////////////////////////////////////////
        ////	ICON BOX SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-iconbox' ) {
            shortcodeHTML = '[sf_iconbox image="' + iconbox_image + '" character="' + iconbox_character + '" color="' + iconbox_color + '" type="' + iconbox_type + '" title="' + iconbox_title + '" link="' + iconbox_link + '" target="' + iconbox_target + '" animation="' + iconbox_animation + '" animation_delay="' + iconbox_animation_delay + '"]<br/>Enter your Icon Box content here<br/>[/sf_iconbox]';
        }

        /////////////////////////////////////////
        ////	IMAGE BANNER SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-imagebanner' ) {
            shortcodeHTML = '[sf_imagebanner image="' + imagebanner_image + '" animation="' + imagebanner_animation + '" contentpos="' + imagebanner_contentpos + '" textalign="' + imagebanner_textalign + '" href="' + imagebanner_link + '" target="' + imagebanner_target + '" extraclass="' + imagebanner_extraclass + '"]<br/>Enter your Image Banner content here<br/>[/sf_imagebanner]';
        }

        /////////////////////////////////////////
        ////	SOCIAL SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-social' ) {
            shortcodeHTML = '[social size="' + social_size + '"]';
        }

        /////////////////////////////////////////
        ////	SOCIAL SHARE SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-social-share' ) {
            shortcodeHTML = '[sf_social_share]';
        }

        /////////////////////////////////////////
        ////	TYPOGRAPHY SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-typography' ) {
            shortcodeHTML = "[" + typography_type + "]TEXT HERE[/" + typography_type + "]";
        }

        /////////////////////////////////////////
        ////	COLUMNS SHORTCODE OUTPUT
        /////////////////////////////////////////


        if ( shortcode_select == 'shortcode-columns' && column_options == 'two_halves' ) {
            shortcodeHTML = "[one_half]1/2 Text[/one_half]<br/>[one_half_last]1/2 Text[/one_half_last]";
        }

        if ( shortcode_select == 'shortcode-columns' && column_options == 'three_thirds' ) {
            shortcodeHTML = "[one_third]1/3 Text[/one_third]<br/>[one_third]1/3 Text[/one_third]<br/>[one_third_last]1/3 Text[/one_third_last]";
        }

        if ( shortcode_select == 'shortcode-columns' && column_options == 'one_third_two_thirds' ) {
            shortcodeHTML = "[one_third]1/3 Text[/one_third]<br/>[two_third_last]2/3 Text[/two_third_last]";
        }

        if ( shortcode_select == 'shortcode-columns' && column_options == 'two_thirds_one_third' ) {
            shortcodeHTML = "[two_third]2/3 Text[/two_third]<br/>[one_third_last]1/3 Text[/one_third_last]";
        }

        if ( shortcode_select == 'shortcode-columns' && column_options == 'four_quarters' ) {
            shortcodeHTML = "[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth_last]1/4 Text[/one_fourth_last]";
        }

        if ( shortcode_select == 'shortcode-columns' && column_options == 'one_quarter_three_quarters' ) {
            shortcodeHTML = "[one_fourth]1/4 Text[/one_fourth]<br/>[three_fourth_last]3/4 Text[/three_fourth_last]";
        }

        if ( shortcode_select == 'shortcode-columns' && column_options == 'three_quarters_one_quarter' ) {
            shortcodeHTML = "[three_fourth]3/4 Text[/three_fourth]<br/>[one_fourth_last]1/4 Text[/one_fourth_last]";
        }

        if ( shortcode_select == 'shortcode-columns' && column_options == 'one_quarter_one_quarter_one_half' ) {
            shortcodeHTML = "[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth]1/4 Text[/one_fourth]<br/>[one_half_last]1/2 Text[/one_half_last]";
        }

        if ( shortcode_select == 'shortcode-columns' && column_options == 'one_quarter_one_half_one_quarter' ) {
            shortcodeHTML = "[one_fourth]1/4 Text[/one_fourth]<br/>[one_half]1/2 Text[/one_half]<br/>[one_fourth_last]1/4 Text[/one_fourth_last]";
        }

        if ( shortcode_select == 'shortcode-columns' && column_options == 'one_half_one_quarter_one_quarter' ) {
            shortcodeHTML = "[one_half]1/2 Text[/one_half]<br/>[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth_last]1/4 Text[/one_fourth_last]";
        }

        /////////////////////////////////////////
        ////	PROGRESS BAR SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-progressbar' ) {

            shortcodeHTML = '[progress_bar percentage="' + progressbar_percentage + '" name="' + progressbar_text + '" value="' + progressbar_value + '" type="' + progressbar_type + '" colour="' + progressbar_colour + '"]<br/>';

        }

        /////////////////////////////////////////
        ////	CHART SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-chart' ) {

            shortcodeHTML = '[chart percentage="' + chart_percentage + '" size="' + chart_size + '" barcolour="' + chart_barcolour + '" trackcolour="' + chart_trackcolour + '" content="' + chart_content + '" align="' + chart_align + '"]<br/>';

        }

        /////////////////////////////////////////
        ////	COUNTERS SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-counters' ) {

            shortcodeHTML = '[sf_count from="' + count_from + '" to="' + count_to + '" speed="' + count_speed + '" refresh="' + count_refresh + '" textstyle="' + count_textstyle + '" subject="' + count_subject + '" prefix="' + count_prefix + '" suffix="' + count_suffix + '" commas="' + count_commas + '" color="' + count_textcolor + '"]<br/>';

        }

        /////////////////////////////////////////
        ////	COUNTDOWN SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-countdown' ) {

            shortcodeHTML = '[sf_countdown year="' + countdown_year + '" month="' + countdown_month + '" day="' + countdown_day + '" displaytext="' + countdown_displaytext + '"]<br/>';

        }

        /////////////////////////////////////////
        ////	TOOLTIP SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-tooltip' ) {

            shortcodeHTML = '[sf_tooltip link="' + tooltip_link + '" direction="' + tooltip_direction + '" title="' + tooltip_text + '"]TEXT HERE[/sf_tooltip]';

        }

        /////////////////////////////////////////
        ////	MODAL SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-modal' ) {

            shortcodeHTML = '[sf_modal header="' + modal_header + '" link_type="' + modal_link_type + '" link_text="' + modal_link_text + '" btn_colour="' + modal_button_colour + '" btn_type="' + modal_button_type + '" btn_size="' + modal_button_size + '" btn_icon="' + modal_button_icon + '" btn_text="' + modal_button_text + '"]<br/>ENTER THE MODAL BODY HERE<br/>[/sf_modal]<br/>';

        }

        /////////////////////////////////////////
        ////	FULLSCREEN VIDEO SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-fwvideo' ) {

            shortcodeHTML = '[sf_fullscreenvideo type="' + fwvideo_type + '" btntext="' + fwvideo_btntext + '" imageurl="' + fwvideo_imageurl + '" videourl="' + fwvideo_videourl + '" extraclass="' + fwvideo_extraclass + '"]<br/>';

        }

        /////////////////////////////////////////
        ////	RESPONSIVE VIS SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-responsivevis' ) {

            shortcodeHTML = '[sf_visibility class="' + responsivevis_config + '"]<br/>ENTER THE RESPONSIVE VISIBILITY CONTENT HERE<br/>[/sf_visibility]<br/>';

        }

        /////////////////////////////////////////
        ////	TABLE SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-tables' ) {

            shortcodeHTML = '[table type="' + table_type + '"]<br/>';

            if ( table_head == "yes" ) {
                shortcodeHTML += '[trow]<br/>';
                for ( var hc = 0; hc < table_columns; hc++ ) {
                    shortcodeHTML += '[thcol]HEAD COL ' + parseInt( hc + 1 ) + '[/thcol]<br/>';
                }
                shortcodeHTML += '[/trow]<br/>';
            }

            for ( var r = 0; r < table_rows; r++ ) {
                shortcodeHTML += '[trow]<br/>';
                for ( var nc = 0; nc < table_columns; nc++ ) {
                    shortcodeHTML += '[tcol]ROW ' + parseInt( r + 1 ) + ' COL ' + parseInt( nc + 1 ) + '[/tcol]<br/>';
                }
                shortcodeHTML += '[/trow]<br/>';
            }

            shortcodeHTML += '[/table]<br/>';
        }

        /////////////////////////////////////////
        ////	LIST SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-lists' ) {
            shortcodeHTML = '[list extraclass="' + list_extraclass + '"]<br/>';

            for ( var li = 0; li < list_items; li++ ) {
                shortcodeHTML += '[list_item icon="' + list_icon + '"]Item text ' + parseInt( li + 1 ) + '[/list_item]<br/>';
            }

            shortcodeHTML += '[/list]<br/>';
        }

        /////////////////////////////////////////
        ////	DIVIDER SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-divider' ) {
            shortcodeHTML = '[hr]';
        }

        /////////////////////////////////////////
        ////	ACCORDION SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-accordion' ) {
            shortcodeHTML = '[accordion]<br />[panel title="Panel #1"]First panel text[/panel]<br />[panel title="Panel #2"]Second panel text[/panel]<br />[panel title="Panel #3"]Third panel text[/panel]<br />[/accordion]';
        }

        /////////////////////////////////////////
        ////	TABS SHORTCODE OUTPUT
        /////////////////////////////////////////

        if ( shortcode_select == 'shortcode-tabs' ) {
            shortcodeHTML = '[tabs tab_one="Tab #1" tab_two="Tab #2" tab_three="Tab #3" tab_four="Tab #4"]<br />[tab]Tab #1 Content[/tab]<br />[tab]Tab #2 Content[/tab]<br />[tab]Tab #3 Content[/tab]<br />[tab]Tab #4 Content[/tab]<br />[/tabs]';
        }

    }

    /////////////////////////////////////////
    ////	TinyMCE Callback & Embed
    /////////////////////////////////////////

    if ( current_shortcode != -1 ) {
        activeEditor = window.tinyMCE.activeEditor.id;
        if ( window.tinyMCE.majorVersion >= 4 ) {
            window.tinymce.get( activeEditor ).insertContent( shortcodeHTML );
        } else {
            window.tinyMCE.execInstanceCommand( activeEditor, 'mceInsertContent', false, shortcodeHTML );
        }
        tinyMCEPopup.editor.execCommand( 'mceRepaint' );
        tinyMCEPopup.close();
    } else {
        tinyMCEPopup.close();
    }

    return;
}