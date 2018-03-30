jQuery.noConflict();
jQuery(document).ready(function($) {
		$('.default_popup').magnificPopup({
			  type:'inline',
			  midClick: true
		});
		$('.items_popup').magnificPopup({
			  type:'inline',
			  midClick: true
		});
	});
function generator_shortcode(name_shortcode) {
	var shortcode = '';
	switch (name_shortcode) {
	case 'progressbar':
		shortcode = generator_shortcode_progressbar();
		break;
	case 'table':
		shortcode = generator_shortcode_table();
		break;
	case 'video':
		shortcode = generator_shortcode_video();
		break;
	default:
		break;
	}
    window.wp.media.editor.insert(shortcode);
}
function getsetting(shortcode){
		jQuery("#cs-item-popup-content").empty();
		jQuery("#cs_loader").css("display","block");
		jQuery.post(
			    ajaxurl,
			    {
			        'action': 'cs_shortcode_settings',
			        'shortcode':   shortcode
			    },
			    function(response){
			    	jQuery("#cs_loader").css("display","none");
				    jQuery("#cs-item-popup-content").html(response);
			    });
	}
/**
 * Generator setting shortcode progressbar
*/
function generator_shortcode_progressbar() {
	var cusclass='',type='',value='',stripped='',label='';
    if(jQuery('#cs-progressbar-stripped').prop('checked')){
        stripped=' barstyle="progress-striped';
        if(jQuery('#cs-progressbar-animated').prop('checked')){
            stripped +=' active';
        }
        stripped +='"';
    }
    if(jQuery('#cs-progressbar-class').val()!=''){
        cusclass= ' class="'+jQuery('#cs-progressbar-class').val()+'"';
    }
    if(jQuery('#cs-progressbar-style').val()!=''){
        type= ' bartype="'+jQuery('#cs-progressbar-style').val()+'"';
    }
    if(jQuery('#cs-progressbar-progress').val()!=''){
        value= ' value="'+jQuery('#cs-progressbar-progress').val()+'"';
    }
    if(jQuery('#cs-progressbar-label').val()!=''){
        label= ' label="'+jQuery('#cs-progressbar-label').val()+'"';
    }
    var shortcode = '[progressbar'+value+cusclass+type+stripped+label;

    shortcode += ']';
    return shortcode;
}
/**
 * Generator setting shortcode table
 */
function generator_shortcode_table() {
	var cusclass='';
    if(jQuery('#cs_table_class').val()!=''){
        cusclass= ' class="'+jQuery('#cs_table_class').val()+'"';
    }
    var columns = jQuery('#cs_table_columns').val();
    var rows = jQuery('#cs_table_rows').val();
    var value = jQuery('#cs_table_width').val();
    var osStyle = jQuery('#cs_table_style').val();
    var osHover = jQuery('#cs_table_effect').prop('checked') ? ' table-hover' : '' ;
    var osScroll = jQuery('#cs_table_responsive').prop('checked')? 'true': 'false';
	//creating table
    var shortcode = '[table ';
    shortcode += 'width ="' + value + '"';
    shortcode += ' style ="' + osStyle +osHover+ '"';
    shortcode += ' responsive ="' +osScroll+ '"'+cusclass;

    shortcode += ']<br/>[table_head]<br/>';
    for (var i=1;i<=columns;i++)
    {
        shortcode += '[th_column]Heading-'+i+'[/th_column]<br/>';
    }
    shortcode += '[/table_head]<br/>[table_body]<br/>';

    for (var j=1;j<=rows;j++)
    {
        shortcode += '[table_row]<br/>';
        for (var i=1;i<=columns;i++)
        {
            shortcode += '[row_column]value-'+i+'[/row_column]<br/>';
        }

        shortcode += '[/table_row]<br/>';
    }
    shortcode += '[/table_body]<br/>[/table]';
    return shortcode;
}
/**
 * Generator setting shortcode video
 */
function generator_shortcode_video() {
	var url = jQuery("#cs_video_url").val();
	var shortcode = "[csvideo height='"+jQuery("#cs_video_height").val()+"' width='"+jQuery("#cs_video_width").val()+"']"+url+"[/csvideo]"
	return shortcode;
}