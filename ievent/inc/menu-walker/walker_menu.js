jQuery(document).ready(function($){
								
	jQuery('.edit-menu-item-fontawesome').val();
  	
	jQuery('.edit-menu-item-fontawesome').on('focus',function(){
		
		jQuery(this).parent().parent().parent().find('.fonticon-group').css({'display':'block'});
		jQuery('.edit-menu-item-fontawesome').val();
		
	});
	
	jQuery('.fonticon-group > li',this).on('click',function(){
		
		var get_class_name =$('.icon-name',this).html();

		jQuery(this).parent().parent().find('.edit-menu-item-fontawesome').attr("value", get_class_name);
		//jQuery('.edit-menu-item-fontawesome').attr("value", get_class_name);	
		
		jQuery(this).parent().css({'display':'none'});
		
	});
	
});