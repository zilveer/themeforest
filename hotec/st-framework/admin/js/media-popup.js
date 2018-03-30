// this file only add to media upload popup page

jQuery(document).ready(function(){
  //  jQuery('.savesend input.button').val('Use this file');
  
  	stwindow = window.dialogArguments || opener || parent || top;
    if ( null !== stwindow){
         var uid = stwindow.STpanel_options.uploadID;
       //  alert(uid);
       
       // if not is slect id;
       if(stwindow.STpanel_options.upload_type!='hidden'){
            jQuery('.st_custom').hide();
       }else{
            jQuery('.savesend input[type=submit]').hide();
       }
       
       
       jQuery('.st_attach_btn').live('click',function(){
            
            var imgurl = jQuery(this).attr('data-src');
            var id = jQuery(this).attr('post_id');
             jQuery('#preview-'+uid,stwindow.document).html('<a class="viewfull-image" title="'+stwindow.STpanel_options.view_full_image+'" href="'+imgurl+'" target="_blank"><img src="'+imgurl+'" alt=""/></a>');
             jQuery('#'+stwindow.STpanel_options.uploadID,stwindow.document).val(id);
             stwindow.tb_remove();
             return false;
       });
        
    }
   
    
    
   
});