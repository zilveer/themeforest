function vt_loading_more( loading ){
	var post_id = jQuery('div#videotube-loading-rolling').attr('post_id');
	var next_paged = jQuery('div#videotube-loading-rolling').attr('next_paged');
	var paged = jQuery('div#videotube-loading-rolling').attr('paged');
	var current_indexpage = jQuery('div#videotube-loading-rolling').attr('current_indexpage');
	var post_type = jQuery('div#videotube-loading-rolling').attr('post_type');
	
	if( paged > 0 && next_paged == 'no' && (loading == undefined || loading == 'yes' ) ){
		jQuery.cookie('loading','no');
		jQuery.ajax({
			type:'POST',
			data:'post_id='+post_id+'&paged='+paged+'&action=loading_more_videos&current_indexpage='+current_indexpage+'&post_type='+post_type,
			url:mars_ajax_url,
			beforeSend:function(){
				jQuery('div.loading-wrapper button.loading-more-icon').show();
			},
			success:function(data){
				var data = jQuery.parseJSON(data);
				jQuery('div#videotube-loading-rolling').attr('paged', data.paged);
				if( data.message != 'nothing' && data.resp == 'success' ){
					jQuery('div.loading-wrapper div#'+post_id).after( data.message );
				}
				else if ( data.resp == 'next_paged' ){
					jQuery('div#videotube-loading-rolling').attr('next_paged', 'yes');
					jQuery('button.loading-more-icon').after(data.message);
				}
				jQuery('div.loading-wrapper button.loading-more-icon').hide();
				jQuery.cookie('loading','yes');
			},
			error:function( xhr, ajaxOptions, thrownError ){
				jQuery.cookie('loading','yes');
			}
		});
		return false;
	}
}