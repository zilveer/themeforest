jQuery(document).ready(function(){
	var saving = 0;
	
	controlCheckbox();
	
    //////////// General Tab ////////////////
    

	/* Save Data Form */
    var optionsGeneral = {
		beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			
			// Reload html for logo
			var obj_logo = jQuery(data).find('#preview-logo');
			jQuery('#preview-logo').html(obj_logo.html());
				
			jQuery('#logo_image').val('');	
			
			// Reload html for favicon
			var obj_icon = jQuery(data).find('#preview-icon');
			jQuery('#preview-icon').html(obj_icon.html());
			
			jQuery('#icon_image').val('');	
			controlCheckbox();
			saving = 0;
        }
    };
    jQuery('#config-theme').ajaxForm(optionsGeneral);
	/* Reset Default Value */
	jQuery('#reset_general').click(function(){
		if(saving == 0){
			jQuery('#config-theme .images input,#config-theme .social-embbed input').val('');
			jQuery('#config-theme .num-post input').val(5);
			jQuery('#config-theme .first_post_image input').val(0);
			jQuery('#config-theme .first_post_image .switch_container .active').removeClass('active');
			jQuery('#config-theme .first_post_image .switch_container .disable').addClass('active');
			jQuery('#config-theme .about input').val('Apgentiv');
		}
	});
	
    //////////// Seo Config Tab ///////
    /* Save Data Form */
    var optionsSeo = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
    jQuery('#config-seo').ajaxForm(optionsSeo);

	
	//////////// Seo Ads Tab ///////
    /* Save Data Form */
    var optionsAds = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
    jQuery('#config-ads').ajaxForm(optionsAds);
	
    //////////// Custom Interface Tab ///////
    /* Save Data Form */
    var options_interface = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
    jQuery('#config-custom-interface').ajaxForm(options_interface);
	
	/* Reset Default Value */
	jQuery('#reset_custom_interface').bind('click',function(){
		if(saving == 0){
			jQuery('.select-layout li.active').removeClass('active');
			jQuery('.select-layout li.last').addClass('active');
			jQuery('#label-layout').html(jQuery('.select-layout li.active a').attr('title'));
			jQuery('#change-layout').val(jQuery('.select-layout li.active a').attr('alt'));
			
			jQuery('.color-scheme select option:selected').removeAttr('selected');
			jQuery('.select-cat select option:selected').removeAttr('selected');
			
			jQuery('.social-embbed li input').val('');
		}	
	});
	
	/* Select Layout */
	jQuery('.select-layout .list-layout li a').bind('click',function(){
		var parent = jQuery(this).parent();
		var divRoot = jQuery(this).parent().parent().parent();divRoot.addClass('abc');
		if(!parent.hasClass('active')){
			divRoot.find('.list-layout li.active').removeClass('active');
			parent.addClass('active');
			divRoot.find('.label-layout').html(jQuery(this).attr('title'));
			divRoot.find('.change-layout').val(jQuery(this).attr('alt'));
			
		}
	});

    //////////// Navigation Tab /////////////
    jQuery( "#tabs-custom-menu" ).tabs({fx: {opacity: 'toggle', duration:'slow'}}).addClass( "ui-tabs-vertical ui-helper-clearfix" );
    jQuery( "#tabs-custom-menu li.item-custom-menu" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    
	jQuery( "#config-seo" ).tabs({fx: {opacity: 'toggle', duration:'slow'}}).addClass( "ui-tabs-vertical ui-helper-clearfix" );
    jQuery( "#config-seo li.item-seo" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    
	
    /* Save Data Form */
    var options_nav = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
    jQuery('#config-custom-menu').ajaxForm(options_nav);

    /* Reset Default Value */
    jQuery('#reset_custom_menu').click(function() {
		if(saving == 0){
			jQuery('.categories-select input:not(:checked),.galleries-select input:not(:checked),.pages-select input:not(:checked)')
				.attr('checked','checked').parent().addClass('choosed');
			
			jQuery('.categories-dropdown-empty li.first input:not(:checked),.galleries-dropdown-empty li.first input:not(:checked),.pages-dropdown-empty li.first input:not(:checked)')
				.attr('checked', 'checked').parent().addClass('choosed');
				
			jQuery('.categories-dropdown-empty li.last input[checked="checked"],.galleries-dropdown-empty li.first input[checked="checked"]')
				.removeAttr("checked").parent().removeClass('choosed');
			
			jQuery('.cat-sort select,.gal_sort select').val('ID');
			jQuery('.page_sort select').val('post_title');
			jQuery('.cat_order select,.gal_order select,.page_order select').val('ASC');
			
			jQuery('.cat-level input,.galleries-level input,.page-level input').val(0);
			
			jQuery('#tabs-custom-menu-settings .order-menu li select').each(function(index){
				jQuery(this).val(index+1);
			});
			
			jQuery('#tabs-custom-menu-settings .use_default_menu a.active').removeClass('active');
			jQuery('#tabs-custom-menu-settings .use_default_menu a.disable').addClass('active');
			jQuery('#tabs-custom-menu-settings .use_default_menu input').val(0);
		}	
    });
	
	jQuery('#reset_config_product_single').click(function() {
		if(saving == 0){
			jQuery('#_single_prod_show_image').prop('checked', true);
			jQuery('#_single_prod_show_label').prop('checked', true);
			jQuery('#_single_prod_show_title').prop('checked', true);
			jQuery('#_single_prod_show_sku').prop('checked', true);
			jQuery('#_single_prod_show_review').prop('checked', true);
			jQuery('#_single_prod_show_availability').prop('checked', true);
			jQuery('#_single_prod_show_add_to_cart').prop('checked', true);
			jQuery('#_single_prod_show_price').prop('checked', true);
			jQuery('#_single_prod_show_short_desc').prop('checked', true);
			jQuery('#_single_prod_show_meta').prop('checked', true);
			jQuery('#_single_prod_show_related').prop('checked', true);
			jQuery('#_single_prod_related_title').val('Related Products');
			jQuery('#_single_prod_show_sharing').prop('checked', true);
			jQuery('#_single_prod_sharing_title').val('Share this');
			jQuery('#sharing_intro').val('Love it?Share with your friend');
			jQuery('#sharing_custom_code').val('');
			jQuery('#_single_prod_show_ship_return').prop('checked', true);
			jQuery('#_single_prod_ship_return_title').val('FREE SHIPPING & RETURN');
			jQuery('#ship_return_content').val('<a href="#"><img src="http://demo.wpdance.com/imgs/woocommerce/return_shipping.png" alt="free shipping and return" title="free shipping and return"></a><div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</div>');
			jQuery('#_single_prod_show_tabs').prop('checked', true);
			jQuery('#_single_prod_show_custom_tab').prop('checked', true);
			jQuery('#_single_prod_custom_tab_title').val('Custom Tabs Title');
			jQuery('#custom_tab_content').val('<div>Table content goes here</div>');
			jQuery('#_single_prod_show_upsell').prop('checked', true);			
			jQuery('#_single_prod_upsell_title').val('YOU MAY ALSO BE INTERESTED IN THE FOLLOWING PRODUCT(S)');
			jQuery('#_single_prod_layout').val('0-1-0');
			
		
		}
	});
	
	
	///////// Slideshow ///////////
	/* Save Data Form */
    var options_slide = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
    jQuery('#config-slideshow').ajaxForm(options_slide);
	/* Reset Default Value */
	jQuery('#reset_slideshow').click(function(){
		if(saving == 0){
			jQuery('#config-slideshow .delaytime input').val(1500);
			jQuery('#config-slideshow .autorun select').val('1');
			jQuery('#config-slideshow .autorun select').last().val('0');
		}	
	});
	
	
	///////// Integration /////////
	/* Save Data Form */
    var options_int = {
		beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
    jQuery('#config-integration').ajaxForm(options_int);
	jQuery('#reset_integration').click(function(){
		jQuery('#config-integration textarea').val('');
	});
	
	//////// Control Tooltip ///////////////
	jQuery(".tooltip_control").hover(
	  function () {
		jQuery(this).parent().children('.tooltip_content').show();
	  }, 
	  function () {
		jQuery(this).parent().children('.tooltip_content').hide();
	  }
	);
	
	////// Add Action for Switch Button ////////
	jQuery('.switch_container a').bind('click',function(){
		var parent = jQuery(this).parent();
		if(!jQuery(this).hasClass('active')){
			parent.children('input').val(jQuery(this).attr('title'));
			parent.children('a.active').removeClass('active');
			jQuery(this).addClass('active');
		}
	});
	
	
	//////////// Seo Ads Tab ///////
    /* Save Data Form */
    var optionsArchive = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
    jQuery('#config-archive-page').ajaxForm(optionsArchive);	
	
	
    /* Save Data Form */
    var options_prod_archive = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
    jQuery('#config-product-single').ajaxForm(options_prod_archive);		
	jQuery('#config-product-category').ajaxForm(options_prod_archive);	
	
	///////// Custom Sidebar /////////
	/* Save Data Form */
    // var options_sidebar = {
        // beforeSubmit:function(){
			// alert(123);
			// if(saving == 1)
			// {
				// alert('There is tab is saving. Please wait...');
				// return false;
			// }
			// saving = 1;	
			// jQuery('.loader').show();
		// },
        // success:    function(data) {
			// jQuery('.loader').hide();
			// jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			// saving = 0;	
			
			// // Reload html for template sidebar
			// //var obj_ts = jQuery(data).find('.template-custom-sidebar .area-content');
			// //jQuery('.template-custom-sidebar .area-content').html(obj_ts.html());
        // }
    // };
    var _options_sidebar = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };	
	jQuery('#config-custom-sidebar-1').ajaxForm(_options_sidebar);
	
    var _options_menu = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };	
	jQuery('#config-mega-menu').ajaxForm(_options_sidebar);	
	
	
	//custom advertisement header
	var options_adverheader = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
	jQuery('#config-advertisement').ajaxForm(options_adverheader);
	
	
	var options_single = {
        beforeSubmit:function(){
			if(saving == 1)
			{
				alert('There is tab is saving. Please wait...');
				return false;
			}
			saving = 1;	
			jQuery('.loader').show();
		},
        success:    function(data) {
			jQuery('.loader').hide();
			jQuery('.successful').fadeIn(300).delay(300).fadeOut(300);
			saving = 0;
        }
    };
	jQuery('#config-single').ajaxForm(options_single);
	////// Create new sidebar /////////
	jQuery('#btn-add-sidebar').bind('click',function(){
		if(jQuery('#name_sidebar').val() != ''){
			var li = jQuery('<li></li>');
			if(jQuery('.edit-custom-sidebar .list-sidebar li.first').length == 0)
				li.addClass('first');
			if(jQuery('.edit-custom-sidebar .list-sidebar li.last').length > 0)
				jQuery('.edit-custom-sidebar .list-sidebar li.last').removeClass('last');
			li.addClass('last');
			
			var div1 = jQuery('<div></div>');
			div1.addClass('bg-input');
			
			var div2 = jQuery('<div></div>');
			div2.addClass('bg-input-inner');
			
			var span = jQuery('<span></span>');
			span.addClass('name-sidebar');
			span.html(jQuery('#name_sidebar').val());
			
			div2.append(span);
			div1.append(div2);
			
			var button = jQuery('<a></a>');
			button.addClass('button1 delete_sidebar');
			button.html('<span><span>Delete</span></span>');
			
			var input = jQuery('<input type="hidden" name="areas[]"/>');
			input.attr('value',jQuery('#name_sidebar').val().replace(/\u20ac /, ''));
			
			li.append(div1);
			li.append(button);
			li.append(input);
			jQuery('.edit-custom-sidebar .list-sidebar').append(li);
			jQuery('#name_sidebar').val('');
			
			delete_sidebar_trigger();
		}
	});
	
	delete_sidebar_trigger();
	//The

	jQuery('.list-layout  a').click(function(){
		if(jQuery(this).attr('alt')=='1column') {
			jQuery(this).parent().parent().parent().children('.select-box-content').hide();
		}
		else{
			jQuery(this).parent().parent().parent().children('.select-box-content').show('slow');
		}
	});
	jQuery('.list-layout .active a').each(function(){
		if(jQuery(this).attr('alt')!='1column'){
			jQuery(this).parent().parent().parent().children('.select-box-content').show('slow');
		}
	});
	//the	
	jQuery('a.remove-logo').click(function(){
		if(jQuery('#preview-logo > img').length > 0)
			{
				if(jQuery('#preview-logo > img').hasClass('hide')==false){
					jQuery('#preview-logo > img').hide();
					jQuery('#preview-logo > img').addClass('hide');
				}
				else{
					jQuery('#preview-logo > img').removeClass('hide');
					jQuery('#preview-logo > img').show();
				}
			}
	});
});

////// Delete Sidebar ///////
function delete_sidebar_trigger()
{
	jQuery('.edit-custom-sidebar .delete_sidebar').bind('click',function(){
		jQuery(this).parent().remove();
	});
}


/////////////// Set value for custom checkbox //////////////
function controlCheckbox(){
	jQuery('.style-checkbox').bind('click', function() {
		var checked = jQuery(this).children('input').is(':checked');
		//var checked = jQuery(this).is(':checked');alert('check');
		if(checked)
		{
			jQuery(this).removeClass('choosed');
			jQuery(this).children('input').removeAttr('checked');	
		}
		else
		{
			jQuery(this).addClass('choosed');
			jQuery(this).children('input').attr('checked','checked')

		}
	});
}