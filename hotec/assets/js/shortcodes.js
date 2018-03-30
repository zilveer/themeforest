jQuery.noConflict();
jQuery(document).ready(function(){

    // Shortcodes
    // Alert 
    jQuery('.close').click(function(){
        jQuery(this).parent().fadeOut("slow");
    });


// Widget Content Tabbed
    jQuery(".content-tabbed .list-tabbed li").click(function() {
        var  p = jQuery(this).parents('.content-tabbed');
        //  First remove class "active" from currently active tab
        jQuery(".list-tabbed li",p).removeClass('list-tabbed-active');
 
        //  Now add class "active" to the selected/clicked tab
        jQuery(this).addClass("list-tabbed-active");
 
        //  Hide all tab content
        jQuery(".tabbed_content",p).hide();
 
        //  Here we get the href value of the selected tab
        //var selected_tab = jQuery(this).find("a").attr("href");
        var selected_tab = jQuery(this).find("a").attr("for-tab");
 
        //  Show the selected tab content
       
        if(typeof(selected_tab)!='undefined'){
            jQuery('.'+selected_tab,p).fadeIn();
        }
        
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });

       
		// ST Tabs 
        var st_tabs = jQuery('.st-tabs');
		st_tabs.each(function() {
			var st_tab =jQuery(this);  
			
			
			st_tab.find('ul.tab-title li').click(function(){
				var tab = jQuery(this);
				if(tab.hasClass('current')) return;
				var tab_id = tab.attr('tab-id');
				
				var tab_title = tab.parents('ul.tab-title');
				var tab_content = jQuery('.tab-content-wrapper',  st_tab);

				tab_title .find('li.current').removeClass('current');
				jQuery(this).addClass('current');
				
				if (tab_content.find('[tab-id="' + tab_id + '"]')) {
				//	console.debug(tab_id);
				} 
			
				
				tab_content.find('.tab-content').removeClass('active').css('display','none');
				//tab_content.find('[tab-id="' + tab_id + '"]').fadeIn().addClass('active');
				tab_content.find('#' + tab_id ).fadeIn().addClass('active');
			});
			
			st_tab.find('ul.tab-title li').eq(0).click();
		
		});
		
        
        
        

        // Accordion
        jQuery('.st-accordion').each(function(){
            var p = jQuery(this);
        
            jQuery('.acc-title',p).toggleClass('acc-title-inactive');
            //Open accordion by default by class "acc-opened".
            jQuery('.acc-opened .acc-title',p).toggleClass('acc-title-active').toggleClass('acc-title-inactive');
            jQuery('.acc-opened .acc-content',p).slideDown().toggleClass('open-content');
    
            jQuery('li .acc-title',p).click(function(){                
                var  li =  jQuery(this).parents('li');
                var  t = jQuery(this);
               
                t.toggleClass('acc-title-active').toggleClass('acc-title-inactive');
                jQuery('.acc-content',li).slideToggle().toggleClass('open-content');
                
                jQuery('li',p).not(li).each(function(){
                    var e = jQuery(this);
                
                    jQuery('.acc-title',e).removeClass('acc-title-active');
                    jQuery('.acc-content',e).slideUp(400,function(){
                          jQuery('.acc-content',e).removeClass('open-content');
                    });
                
                });
            });
            
        })
       

        // Toggle
        jQuery('.toggle-title').click(function(){
            var toggle_tab = jQuery(this).parent();
            toggle_tab.find('> :last-child').stop(true, true).slideToggle();
            if (jQuery(this).hasClass('toggle_current'))
            {
                jQuery(this).removeClass('toggle_current');
            }
            else
            {
                jQuery(this).addClass('toggle_current');
            }
        });
    
}); // End of Jquery DOM ready

