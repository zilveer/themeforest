/*global jQuery, document, redux_upload, formfield:true, preview:true, tb_show, window, imgurl:true, tb_remove, $relid:true*/
/*
This is the uploader for wordpress starting from version 3.5
*/
jQuery(document).ready(function(){
		
	jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').val("default").trigger('change');

    jQuery(".redux-opts-upload-scheme").click( function( event ) {
        var activeFileUploadContext = jQuery(this).parent();
        var relid = jQuery(this).attr('rel-id');

        event.preventDefault();

        // If the media frame already exists, reopen it.
        /*if ( typeof(custom_file_frame)!=="undefined" ) {
            custom_file_frame.open();
            return;
        }*/

        // if its not null, its broking custom_file_frame's onselect "activeFileUploadContext"
        custom_file_frame = null;

        // Create the media frame.
        custom_file_frame = wp.media.frames.customHeader = wp.media({
            // Set the title of the modal.
            title: jQuery(this).data("choose"),

            // Tell the modal to show only images. Ignore if want ALL
            library: {
                type: 'text'
            },
            // Customize the submit button.
            button: {
                // Set the text of the button.
                text: jQuery(this).data("import")
            }
        });

        custom_file_frame.on( "select", function() {
            // Grab the selected attachment.
            var attachment = custom_file_frame.state().get("selection").first();
                        
            if ( attachment.attributes.url ) {
                
                // parse the file and add csv data to database
                
                var default_params = {
                	width: 'resolve',
                	triggerChange: true,
                	allowClear: true
                };
                
			    jQuery.ajax({
			           url:ajaxurl,
			           type:'POST',
			           dataType: "html",
			           data:'action=sf_add_schema_ajax&file_id=' + attachment.attributes.id + '&file_url=' + attachment.attributes.url + '&xxx=',
			           success:function(results) {
				         	jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').select2('destroy');
				         	jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').replaceWith(results);
				         	jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').select2(default_params);
				         	jQuery("#import-schema-message").show();
						    jQuery("#sf_atelier_options-colour_scheme_select_scheme").change( function( event ) {
						    
						    	jQuery("ul.color-list").fadeOut();
						        
						        var selected = jQuery(this).find('select').val();
						        
						        updateSchemaHTML ( selected );
						        
						    });
						    alert ("Colour scheme added, you can now find it in the colour schemes list.");
			           }
			        });
                
            }
                
        });

        custom_file_frame.open();
    });


    jQuery("a.save-this-scheme").click( function( event ) {
    
	    event.preventDefault();    
    
        var scheme_name = jQuery(".save-this-scheme-name").val();

        if ( scheme_name ) {
	        	        
		    jQuery.ajax({
		           url:ajaxurl,
		           type:'POST',
		           dataType: "html",
		           data:'action=sf_save_schema_ajax&schema_name=' + scheme_name + '&xxx=',
		           success:function(results) {
				        
				        var default_params = {
				        	width: 'resolve',
				        	triggerChange: true,
				        	allowClear: true
				        };
				        
				        jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').select2('destroy');
			         	jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').replaceWith(results);
			         	jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').select2(default_params);
			         	jQuery(".save-this-scheme-name").hide();
			         	jQuery(".save-this-scheme").hide();
					    jQuery("#sf_atelier_options-colour_scheme_select_scheme").change( function( event ) {
					    
					    	jQuery("ul.color-list").fadeOut();
					        
					        var selected = jQuery(this).find('select').val().trigger("change");
					        
					        updateSchemaHTML ( selected );
					        
					    });	
					    
				        alert ("The colour scheme has been saved to your colour schemes option list.");
				        
		           }
		        });
	        

	        
        }

    });

    jQuery("a.use-this-scheme").click( function( event ) {
    
	    event.preventDefault();    
    
        var selected = jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').val();

        if ( selected ) {
	        	        
		    jQuery.ajax({
		           url:ajaxurl,
		           type:'POST',
		           dataType: "html",
		           data:'action=sf_use_schema_ajax&schema_id=' + selected + '&xxx=',
		           success:function(results) {
				        
				        if ( results == "success" ) {
				        
					        // move the select box back to default
					        
					        jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').val("default").trigger("change");
					        
					        // update the HTML preview
					        
					        updateSchemaHTML ( 0 );
					        
					        alert ("This colour scheme is now being used on the site.");
				        
				        }
				        
		           }
		        });
	        

	        
        }

    });


    jQuery("a.delete-this-scheme").click( function( event ) {
    
	    event.preventDefault();    
    
        var selected = jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').val();
        if ( selected ) {
	        
	        // delete the sucker from the database
	        
		    jQuery.ajax({
		           url:ajaxurl,
		           type:'POST',
		           dataType: "html",
		           data:'action=sf_delete_schema_ajax&schema_id=' + selected + '&xxx=',
		           success:function(results) {
				        if ( results == "success" ) {
				        	
					        // move the select box back to default
					        jQuery("#sf_atelier_options-colour_scheme_select_scheme option[value='" + selected + "']").remove();
					        
						    jQuery("#sf_atelier_options-colour_scheme_select_scheme").find('select').val("default").trigger('change');
					        
					        // update the HTML preview
					        
					        updateSchemaHTML ( 0 );
					        
					        alert ("The schema has been removed, and preview reset to your current values.");
				        
				        }
				        
		           }
		        });
	        

	        
        }

    });




    jQuery("#sf_atelier_options-colour_scheme_select_scheme").change( function( event ) {
    
    	jQuery("ul.color-list").fadeOut();
        
        var selected = jQuery(this).find('select').val();
        
        updateSchemaHTML ( selected );
        
    });
	        
	        
	        
	        
	function updateSchemaHTML ( selected ) {
	    jQuery.ajax({
	           url:ajaxurl,
	           type:'POST',
	           dataType: "html",
	           data:'action=sf_get_schema_html_ajax&schema_id=' + selected + '&xxx=',
	           success:function(results) {
		           jQuery("#sf_atelier_options-color-list").replaceWith(results);
		           if ( selected && (selected != 0 && selected != "default") ) {
			           jQuery("#scheme-preview-text").html('You are currently previewing the <strong>' + selected + '</strong> color scheme.');
			           jQuery("#scheme-preview-text").css('color','#ff0000');
			           jQuery(".delete-this-scheme").show();
			           jQuery(".use-this-scheme").show();
			           jQuery(".save-this-scheme").hide();
			           jQuery(".save-this-scheme-name").hide();
			       } else {
			           jQuery("#scheme-preview-text").html('These colors are what currently exist in the WordPress theme customizer.');
			           jQuery("#scheme-preview-text").css('color','#666666');				       
			           jQuery(".delete-this-scheme").hide();
			           jQuery(".use-this-scheme").hide();
			           jQuery(".save-this-scheme").show();
			           jQuery(".save-this-scheme-name").show();
			       }
	           }
	        });		
		
	}        
	   
});