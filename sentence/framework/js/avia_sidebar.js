/**
 * This file holds the main javascript functions needed for avia-media uploads
 *
 * @author		Christian "Kriesi" Budschedl
 * @copyright	Copyright ( c ) Christian Budschedl
 * @link		http://kriesi.at
 * @link		http://aviathemes.com
 * @since		Version 1.0
 * @package 	AviaFramework
 */

(function($)
{
	var AviaSidebar = function(){
    
        this.widget_wrap = $('.widget-liquid-right');
        this.widget_area = $('#widgets-right');
        this.widget_add  = $('#avia-tmpl-add-widget');
       
        this.create_form();
        this.add_del_button();
        this.bind_events();
    		
	};
	
    AviaSidebar.prototype = {
    
        create_form: function()
        {
            this.widget_wrap.append(this.widget_add.html());
            this.widget_name = this.widget_wrap.find('input[name="avia-sidebar-widgets"]');
            this.nonce       = this.widget_wrap.find('input[name="avia-delete-custom-sidebar-nonce"]').val();   
        },
        
        add_del_button: function()
        {
            this.widget_area.find('.sidebar-avia-custom').append('<span class="avia-custom-sidebar-area-delete"></span>');
        },
        
        bind_events: function()
        {
            this.widget_wrap.on('click', '.avia-custom-sidebar-area-delete', $.proxy( this.delete_sidebar, this));
        },
        
        
        //delete the sidebar area with all widgets within, then re calculate the other sidebar ids and re save the order
        delete_sidebar: function(e)
        {
            var widget      = $(e.currentTarget).parents('.widgets-holder-wrap:eq(0)'),
                title       = widget.find('.sidebar-name h3'),
                spinner     = title.find('.spinner'),
                widget_name = $.trim(title.text()),
                obj         = this;
        
            $.ajax({
	 		  type: "POST",
	 		  url: window.ajaxurl,
	 		  data: {
	 		     action: 'avia_ajax_delete_custom_sidebar',
	 		     name: widget_name,
	 		     _wpnonce: obj.nonce
	 		  },
	 		  
	 		  beforeSend: function()
	 		  {
	 		        spinner.addClass('activate_spinner');
	 		  },
	 		  success: function(response)
	 		  {     
                   if(response == 'sidebar-deleted')
                   {
                        widget.slideUp(200, function(){
                            
                            $('.widget-control-remove', widget).trigger('click'); //delete all widgets inside
                            widget.remove();
                            
                            obj.widget_area.find('.widgets-holder-wrap .widgets-sortables').each(function(i) //re calculate widget ids
                            {
                                $(this).attr('id','sidebar-' + (i + 1));
                            });
                            
                            wpWidgets.saveOrder();
                            
                        });
                   } 
	 		  }
	 		});
        }
    
    };
	
	$(function()
	{
		new AviaSidebar();
 	});

	
})(jQuery);	 