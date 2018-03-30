/* <![CDATA[ */
(function($){
	
	"use strict";
		
    $(document).ready(function(){
		    
        /*
        |--------------------------------------------------------------------------
        | Icon Modal
        |--------------------------------------------------------------------------
        */
        
        var iconbutton = '',
            iconpreview = '',
            iconinput  = '';
        
        
        $('.ut-choose-icon').click( function(event) {
           
            iconbutton = $(this),
            iconinput  = iconbutton.siblings('input:text').first();
            iconpreview = iconbutton.siblings('.ut-icon-preview');
            
            $(".ut-modal-option-tree").fadeIn(); 
            
            event.preventDefault();
            
        });
        
        $(document).on("click", ".close-ut-modal-option-tree", function(event){ 
					
            event.preventDefault();
            $(".ut-modal-option-tree").fadeOut();
            
        });
        
        
        $(document).on("click", ".ut-icon-option-tree", function(event){ 
					
            var icon = $(this).data('icon');
            
            $(iconinput).val(icon);
            $(iconpreview).children('.ut-preview-icon').attr('class' , '').addClass('ut-preview-icon fa ' + icon);
            $(".ut-modal-option-tree").fadeOut();
        
        });        
        
        $(document).on("click", ".ut-delete-icon", function(event){ 
           
           $(this).parent().children('.ut-preview-icon').attr('class' , '').addClass('ut-preview-icon fa');
           $(this).parent().next('input').val('');
           
            event.preventDefault();         
            
        });
        
		
        /*
        |--------------------------------------------------------------------------
        | ui select groups
        |--------------------------------------------------------------------------
        */
        var adjust_second_level_options = function($options) {
            
            if ( $options instanceof Array ) {
                    
                for (var i = 0; i < $options.length; i++) {
                  
                    $("#"+$options[i]).trigger('change');                                       
                    
                }
              
            } else {
                  
                $("#"+$options).trigger('change');
              
            }
            
        }
        
		$(".option-tree-ui-group-select").each(function(){
			
			var current_for = $(this).find(':selected').data('for');
            
			$(this).children("option").each(function() {
                
				/* hide other elements */
				if( $(this).data("for") !== 'current_for') {
					
                    var hide_options = $(this).data("for").split(',');
                    
                    if ( hide_options instanceof Array ) {
                        
                        for (var i = 0; i < hide_options.length; i++) {
                        
                            $("#setting_"+ hide_options[i] ).hide();
                        
                        }
                    
                    } else {
                        
                        $("#setting_"+ $(this).data("for") ).hide();
                    
                    }
                    
				}
				
            });
			
			var show_options = current_for.split(','),
                second_level = [];
            
            if ( show_options instanceof Array ) {
                    
                for (var i = 0; i < show_options.length; i++) {
                  
                    $("#setting_"+ show_options[i] ).show();
                    
                    if( $("#"+show_options[i]).hasClass('option-tree-ui-group-select') ) {
                        second_level.push(show_options[i]);
                    } 
                  
                }
              
            } else {
                  
                $("#setting_"+ current_for ).show();
                if( $("#"+current_for).hasClass('option-tree-ui-group-select') ) {
                    second_level.push(show_options[i]);
                }
              
            }
			
            adjust_second_level_options(second_level);
            
		});
		
		$(".option-tree-ui-group-select").change(function(){
			
			var current_for = $(this).find(':selected').data('for');
			            
			$(this).children("option").each(function() {
                                
				/* hide other elements */
				if( $(this).data("for") !== 'current_for') {
					
                    var hide_options = $(this).data("for").split(',');
                    
                    if ( hide_options instanceof Array ) {
                        
                        for (var i = 0; i < hide_options.length; i++) {
                        
                            $("#setting_"+ hide_options[i] ).hide();
                        
                        }
                    
                    } else {
                        
                        $("#setting_"+ $(this).data("for") ).hide();
                    
                    }                    
                    
				}
				
            });
			
			var show_options = current_for.split(','),
                second_level = [];
            
            if ( show_options instanceof Array ) {
                    
                for (var i = 0; i < show_options.length; i++) {
                  
                    $("#setting_"+show_options[i]).show('highlight', { color: '#CEF4FF' }, 800 );
                    
                    if( $("#"+show_options[i]).hasClass('option-tree-ui-group-select') ) {
                        second_level.push(show_options[i]);
                    }                    
                    
                }
              
            } else {
                  
                $("#setting_"+ current_for ).show('highlight', { color: '#CEF4FF' }, 800 );
                if( $("#"+current_for).hasClass('option-tree-ui-group-select') ) {
                    second_level.push(show_options[i]);
                } 
              
            }
            
            adjust_second_level_options(second_level);
			
		});        
		
        $('.ut-toplevel-select-option').trigger('change');
        
        /*
        |--------------------------------------------------------------------------
        | ui radio groups
        |--------------------------------------------------------------------------
        */
                
        $(".ot-type-radio-group").each(function(){
            
            var group = $(this).data('group'),
                current_for = $("input:radio[name ='"+group+"']:checked").data('for');
           
            /* loop through */
            $(this).parent().parent().find('input').each(function(){
            
                /* hide other elements */
                if( $(this).data("for") !== current_for ) {
                    
                    var hide_options = $(this).data("for").split(',');
                    
                    if ( hide_options instanceof Array ) {
                        
                        for (var i = 0; i < hide_options.length; i++) {
                        
                            $("#setting_"+ hide_options[i] ).hide();
                        
                        }
                    
                    } else {
                        
                        $("#setting_"+ $(this).data("for") ).hide();
                    
                    }
                    
                }
            
            });            
            
            var show_options = current_for.split(',');
            
            if ( show_options instanceof Array ) {
                    
                for (var i = 0; i < show_options.length; i++) {
                  
                    $("#setting_"+ show_options[i] ).show();
                  
                }
              
            } else {
                  
                $("#setting_"+ current_for ).show();
              
            }
            
        });
        
        var show_hide_option_set = function( current_for ) {
            
            $("#setting_"+ current_for ).slideDown('fast', function() {                        
                        
                var $this = $(this);
                $this.find(".option-tree-ui-group-radio").filter(':checked').trigger("change");
                
            }); 
        
        }        
        
        $(".option-tree-ui-group-radio").change(function(){
            
            var current_for = $(this).filter(':checked').data('for');
            
            /* loop through */
            $(this).parent().parent().find('input').each(function(){
            
                /* hide other elements */
                if( $(this).data("for") !== current_for ) {
                    
                    var hide_options = $(this).data("for").split(',');
                    
                    if ( hide_options instanceof Array ) {
                        
                        for (var i = 0; i < hide_options.length; i++) {
                        
                            $("#setting_"+ hide_options[i] ).hide();
                        
                        }
                    
                    } else {
                        
                        $("#setting_"+ $(this).data("for") ).hide();
                    
                    }
                    
                }
            
            });            
            
            var show_options = current_for.split(',');
            
            if ( show_options instanceof Array ) {
                                    
                for (var i = 0; i < show_options.length; i++) {                    
                    
                    show_hide_option_set( show_options[i] );                                   
                  
                }
              
            } else {
                
                show_hide_option_set( current_for );                
              
            }
            
        });
        
		
        
        /*
        |--------------------------------------------------------------------------
        | google font integration
        |--------------------------------------------------------------------------
        */
		var update_google_font_link = function( group ) {
			
			if(!group) {
				return;
			}
			
			var $this		= $("#"+group+"-font-family"),
				url 		= 'http://fonts.googleapis.com/css?family=',
				family  	= $this.find(':selected').data('family'),
				font_weight	= $("#"+group+"-font-weight").val(),
				font_style	= $("#"+group+"-font-style").val();		
			
			$("#ut-google-style-link-"+group).attr("href" , url+family+':'+font_weight+font_style);
		
		};
		
		var update_google_font_preview = function( group , font_size , font, font_weight, font_style, text_transform ) {
		    
            $("#ut-google-style-"+group).text('#ut-google-preview-'+group+' { font-size: '+font_size+'; font-family: "'+ font +'" !important; font-weight: '+font_weight+'; font-style: '+font_style+'; text-transform: '+text_transform+'; }');
		    
		};
		
		var update_google_font_subsets = function( group , subsets ) {
			
			subsets = subsets.split(","); 
			
			/* reset select field if selected state is not available anymore */		
			if( $.inArray( $("#"+group+"-font-subset").val() , subsets ) === -1 ) {
				$("#"+group+"-font-subset").prop('selectedIndex', 0).prev('span').replaceWith('<span>' + $("#"+group+"-font-subset").find('option:selected').text() + '</span>');
			}
			
			/* update available subsets */
			$("#"+group+"-font-subset option").each(function() {
				
				if( $.inArray( $(this).val() , subsets ) >= 0 || !$(this).val() ) {
					
					$(this).attr("disabled" , false);
					
				} else {
				
					$(this).attr("disabled" , true);
					
				}
				
			});
		
		};	
		
		var update_google_font_weights = function( group , variants ) {
			
            variants = variants.replace("regular", "400");			
            variants = variants.split(",");
						
			/* reset select field if selected state is not available anymore */	
			if( $.inArray( $("#"+group+"-font-weight").val() , variants ) === -1 ) {
				$("#"+group+"-font-weight").prop('selectedIndex', 0).prev('span').replaceWith('<span>' + $("#"+group+"-font-weight").find('option:selected').text() + '</span>');
			}
			
			$("#"+group+"-font-weight option").each(function() {
				
				if( $.inArray( $(this).val() , variants ) >= 0 || !$(this).val() ) {
				
					$(this).attr("disabled" , false);
				
				} else {
				
					$(this).attr("disabled" , true);
								
				}
					
			});
		};		
		
		var update_google_font_styles = function( group , variants ) {
		
			variants = variants.split(",");
			
			/* reset select field if selected state is not available anymore */	
			if( $.inArray( $("#"+group+"-font-style").val() , variants ) === -1 ) {
				$("#"+group+"-font-style").prop('selectedIndex', 0).prev('span').replaceWith('<span>' + $("#"+group+"-font-style").find('option:selected').text() + '</span>').show();
			}
			
			$("#"+group+"-font-style option").each(function() {
				
				if( $.inArray( $(this).val() , variants ) >= 0 || !$(this).val() ) {
				
					$(this).attr("disabled" , false);
				
				} else {
				
					$(this).attr("disabled" , true);
								
				}			
			
			});
		
		};
		
		var update_google_font_fields = function( group ) {
			
			if(!group) {
				return;
			}
			
			var $this		   = $("#"+group+"-font-family"),
				font 		   = $this.find(':selected').data('font'),
				subsets		   = $this.find(':selected').data('subsets'),
				//family  	   = $this.find(':selected').data('family'),
				variants	   = $this.find(':selected').data('variants'),
				font_id		   = $this.find(':selected').data('fontid'),
				font_size	   = $("#"+group+"-font-size").val(),
				font_weight	   = $("#"+group+"-font-weight").val(),
                text_transform = $("#"+group+"-text-transform").val(),
				font_style	   = $("#"+group+"-font-style").val();			
			
			if( font ) {
			
				/* update subsets */			
				update_google_font_subsets( group , subsets );
				
				/* update weights*/
				update_google_font_weights( group , variants );
				
				/* update styles*/
				update_google_font_styles( group , variants );
				
				/* change link attr */
				update_google_font_link( group );
							
				/* update font preview */
				update_google_font_preview( group , font_size , font, font_weight, font_style, text_transform );		
				
				/* update hidden ID */
				$("#"+group+"-fontid").val(font_id);
				
			} else {
                
                $("#ut-google-style-"+group).text('');
            
            }
			
		};
		
		/* update all fields first */
		$(".ut-google-font-select").each(function() {
            
			var group = $(this).data("group");
								
			/* update fields */
			update_google_font_fields( group );
			
        });
		
		
		$(".ut-google-font-select").change(function(){
			
			var group = $(this).data("group");
								
			/* update fields */
			update_google_font_fields( group );
			
		});
		
		
		$(".ut-google-font-size").change(function(){
			
			var group = $(this).data("group");
					
			/* update fields */
			update_google_font_fields( group );
			
		});
		
		$(".ut-google-font-weight").change(function(){
			
			var group = $(this).data("group");
								
			/* update fields */
			update_google_font_fields( group );
			
		});
        
        $(".ut-google-text-transform").change(function(){
			
			var group = $(this).data("group");
								
			/* update fields */
			update_google_font_fields( group );
			
		});
		
		$(".ut-google-font-style").change(function(){
			
			var group = $(this).data("group");
					
			/* update fields */
			update_google_font_fields( group );
			
		});
		
        
        
		/*
        |--------------------------------------------------------------------------
        | Header Styles Preview Boxes
        |--------------------------------------------------------------------------
        */
		tb_position = function() {
			var tbWindow = $('#TB_window');
			var width = 840;
			var H = 600;
			var W = width;
	
			if ( tbWindow.size() ) {
				tbWindow.width( W - 50 ).height( H - 45 );
				$('#TB_iframeContent').width( W - 50 ).height( H - 75 );
				tbWindow.css({'margin-left': '-' + parseInt((( W - 50 ) / 2),10) + 'px'});
				if ( typeof document.body.style.maxWidth != 'undefined' )
					tbWindow.css({'top':'40px','margin-top':'0'});
			};
	
			return $('a.thickbox').each( function() {
				var href = $(this).attr('href');
				if ( ! href ) return;
				href = href.replace(/&width=[0-9]+/g, '');
				href = href.replace(/&height=[0-9]+/g, '');
				$(this).attr( 'href', href + '&width=' + ( W - 80 ) + '&height=' + ( H - 85 ) );
			});
		};
	
		$('a.thickbox').click(function(){
			if ( typeof tinyMCE != 'undefined' &&  tinyMCE.activeEditor ) {
				tinyMCE.get('content').focus();
				tinyMCE.activeEditor.windowManager.bookmark = tinyMCE.activeEditor.selection.getBookmark('simple');
			}
		});
		
		/* show font style */
		$('.ut-font-preview').click( function() {
			
			tb_show('', ut_font_popup.pop_url + 'fontpreview.html?TB_iframe=true');
 			return false;
			
		});
				
		/* show header style */
		$('.ut-header-preview').click( function() {
			
			tb_show('', ut_font_popup.pop_url + 'headerpreview.html?TB_iframe=true');
 			return false;
			
		});
		
		/* show header style */
		$('.ut-hero-preview').click( function() {
			
			tb_show('', ut_font_popup.pop_url + 'heropreview.html?TB_iframe=true');
 			return false;
			
		});	
				
		/*
        |--------------------------------------------------------------------------
        | Parallax 
        |--------------------------------------------------------------------------
        */
        
		/* disable background settings of parallax is active // front page */
		var parallax_status = $("#ut_front_header_parallax").val();
				
		if( parallax_status === 'on' ) {
			
			$("#ut_front_header_image-attachment").prop('selectedIndex', 0);
			$("#ut_front_header_image-attachment").attr("disabled", true ).parent().wrap('<div class="disabled" />');
			
			$("#ut_front_header_image-position").prop('selectedIndex', 0);
			$("#ut_front_header_image-position").attr("disabled", true ).parent().wrap('<div class="disabled" />');
		
		}
		
		$("#ut_front_header_parallax").change(function() { 
		
			parallax_status = $(this).val();
			
			if( parallax_status === 'on' ) {
				
				$("#ut_front_header_image-attachment").prop('selectedIndex', 0).trigger("change");
				$("#ut_front_header_image-attachment").attr("disabled", true ).parent().wrap('<div class="disabled" />');
				
				$("#ut_front_header_image-position").prop('selectedIndex', 0).trigger("change");
				$("#ut_front_header_image-position").attr("disabled", true ).parent().wrap('<div class="disabled" />');
							
			} else {
				
				$("#ut_front_header_image-attachment").attr("disabled", false ).parent().unwrap();				
				$("#ut_front_header_image-position").attr("disabled", false ).parent().unwrap();			

			}			
		
		});
		
		/* disable background settings of parallax is active // blog */
		parallax_status = $("#ut_blog_header_parallax").val();
				
		if( parallax_status === 'on' ) {
			
			$("#ut_blog_header_image-attachment").prop('selectedIndex', 0);
			$("#ut_blog_header_image-attachment").attr("disabled", true ).parent().wrap('<div class="disabled" />');
			
			$("#ut_blog_header_image-position").prop('selectedIndex', 0);
			$("#ut_blog_header_image-position").attr("disabled", true ).parent().wrap('<div class="disabled" />');
		
		}
		
		$("#ut_front_header_parallax").change(function() { 
		
			parallax_status = $(this).val();
			
			if( parallax_status === 'on' ) {
				
				$("#ut_blog_header_image-attachment").prop('selectedIndex', 0).trigger("change");
				$("#ut_blog_header_image-attachment").attr("disabled", true ).parent().wrap('<div class="disabled" />');
				
				$("#ut_blog_header_image-position").prop('selectedIndex', 0).trigger("change");
				$("#ut_blog_header_image-position").attr("disabled", true ).parent().wrap('<div class="disabled" />');
							
			} else {
				
				$("#ut_blog_header_image-attachment").attr("disabled", false ).parent().unwrap();				
				$("#ut_blog_header_image-position").attr("disabled", false ).parent().unwrap();			
			
			}			
		
		});
		
		
		/* disable background settings of parallax is active // contact section */
		parallax_status = $("#ut_csection_parallax").val();
				
		if( parallax_status === 'on' ) {
			
			$("#ut_csection_background_image-attachment").prop('selectedIndex', 0);
			$("#ut_csection_background_image-attachment").attr("disabled", true ).parent().wrap('<div class="disabled" />');
			
			$("#ut_csection_background_image-position").prop('selectedIndex', 0);
			$("#ut_csection_background_image-position").attr("disabled", true ).parent().wrap('<div class="disabled" />');
		
		}
		
		$("#ut_csection_parallax").change(function() { 
		
			parallax_status = $(this).val();
			
			if( parallax_status === 'on' ) {
				
				$("#ut_csection_background_image-attachment").prop('selectedIndex', 0).trigger("change");
				$("#ut_csection_background_image-attachment").attr("disabled", true ).parent().wrap('<div class="disabled" />');
				
				$("#ut_csection_background_image-position").prop('selectedIndex', 0).trigger("change");
				$("#ut_csection_background_image-position").attr("disabled", true ).parent().wrap('<div class="disabled" />');
							
			} else {
				
				$("#ut_csection_background_image-attachment").attr("disabled", false ).parent().unwrap();				
				$("#ut_csection_background_image-position").attr("disabled", false ).parent().unwrap();			
			
			}			
		
		});
        
        
        /*
        |--------------------------------------------------------------------------
        | Font Select
        |--------------------------------------------------------------------------
        
        $('.ut-google-font-select').each(function() {
            
            $(this).select2({
                ajax: {
                    url: ut_font_popup.google_fonts,
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                                                                
                        return {
                            results: $.map( data.items, function (item, i) {
                                
                                return {
                                    id: item.family_id,
                                    text: item.family,
                                    attrs: {'data-font':item.family,'data-family':item.family,'data-subsets':item.subsets.join(),'data-variants':item.variants.join(),'data-fontid':i}
                                };
                                
                            })
                        };
                         
                    },
                    cache: true
                },
                allowClear: true,
                minimumResultsForSearch: Infinity
            });
            
            $(this).on("select2:unselect", function (e) { 
                
                $(e.delegateTarget).prop('selectedIndex', 0).trigger("change");
                $("#"+ $(e.delegateTarget).data('group')  +"-fontid").val('');                
            
            });
                 
        });*/ 
        
	});

})(jQuery);
 /* ]]> */	