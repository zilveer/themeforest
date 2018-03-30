/**
 * Created by kuba on 14.02.14.
 */
CbButton = {
    currentContentId: '',
    showEditor: function (contentId) {
        jQuery('#button_text').val('');
        jQuery('#button_link').val('');
        jQuery('#button_target').val(jQuery('#button_target option:first').val());
        jQuery('#button_bg').val(jQuery('#button_bg option:first').val());
        jQuery('#button_ani_select').val(jQuery('#button_ani_select option:first').val());
       jQuery('#button_align').val(jQuery('#button_align option:first').val());
        jQuery('#cb-button-backdrop').show();
        jQuery('#cb-button-container').show();
        this.currentContentId = contentId;


        return false;
    },
    hideEditor: function() {
        jQuery('#cb-button-backdrop').hide();
        jQuery('#cb-button-container').hide();
        window.onbeforeunload = null;
    },
    save: function() {
        var button_text = jQuery('#button_text').val();
        var button_link = jQuery('#button_link').val();
        var button_target = jQuery('#button_target').val();
        var button_bg = jQuery('#button_bg').val();
        var button_ani_select = jQuery('#button_ani_select').val();
        var button_align = jQuery('#button_align').val();

        var data='<a href="'+button_link+'" target="'+button_target+'" data-ani="'+button_ani_select+'" class="'+button_bg+'" style="text-align:'+button_align+';">'+button_text+'</a>';
        window.send_to_editor(data);
        this.hideEditor();
    }
};