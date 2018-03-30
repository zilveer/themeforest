/* jquery appear */
(function(a){a.fn.appear=function(d,b){var c=a.extend({data:undefined,one:true,accX:0,accY:0},b);return this.each(function(){var g=a(this);g.appeared=false;if(!d){g.trigger("appear",c.data);return}var f=a(window);var e=function(){if(!g.is(":visible")){g.appeared=false;return}var r=f.scrollLeft();var q=f.scrollTop();var l=g.offset();var s=l.left;var p=l.top;var i=c.accX;var t=c.accY;var k=g.height();var j=f.height();var n=g.width();var m=f.width();if(p+k+t>=q&&p<=q+j+t&&s+n+i>=r&&s<=r+m+i){if(!g.appeared){g.trigger("appear",c.data)}}else{g.appeared=false}};var h=function(){g.appeared=true;if(c.one){f.unbind("scroll",e);var j=a.inArray(e,a.fn.appear.checks);if(j>=0){a.fn.appear.checks.splice(j,1)}}d.apply(this,arguments)};if(c.one){g.one("appear",c.data,h)}else{g.bind("appear",c.data,h)}f.scroll(e);a.fn.appear.checks.push(e);(e)()})};a.extend(a.fn.appear,{checks:[],timeout:null,checkAll:function(){var b=a.fn.appear.checks.length;if(b>0){while(b--){(a.fn.appear.checks[b])()}}},run:function(){if(a.fn.appear.timeout){clearTimeout(a.fn.appear.timeout)}a.fn.appear.timeout=setTimeout(a.fn.appear.checkAll,20)}});a.each(["append","prepend","after","before","attr","removeAttr","addClass","removeClass","toggleClass","remove","css","show","hide"],function(c,d){var b=a.fn[d];if(b){a.fn[d]=function(){var e=b.apply(this,arguments);a.fn.appear.run();return e}}})})(jQuery);

;(function($){
	
    "use strict";
        
    $(document).ready(function(){
        
        $(window).scroll(function() {
            
            if( $(this).scrollTop() >= 200 ) {
                 
                $('#ut-tool-bar').addClass('show');
                 	
            } else {
                
                $('#ut-tool-bar').removeClass('show');
                
            }
            
        });
        
        
        $('.ut-admin-main').css('min-height', $('.ut-backend-navigation-wrap').outerHeight() );
        
        /* Helper Function: create preview for 
         * different media files
		================================================== */         
        function unite_create_media_preview( attachment, unite_media_field ) {
            
            if( !attachment || !unite_media_field ) {
                return;            
            }
                        
            if( attachment.type === 'image' ) {
                
                /* remove old image object if exists */
                if( $('#' + unite_media_field + '_preview_icon').length ) {
                    
                    $('#' + unite_media_field + '_preview_icon').remove();
                    
                }
                
                /* check if image preview already exists */
                if( $('#' + unite_media_field + '_preview').length ) {
                    
                    $('#' + unite_media_field + '_preview').attr('src', attachment.url);
                    
                } else {
                
                    $('<img />',{ 'id': unite_media_field + '_preview', 'src': attachment.url, 'class': 'ut-image-preview' }).insertAfter('#' + unite_media_field );

                }
                
            } else if( attachment.type === 'video' ) {
                
                /* remove old image object if exists */
                if( $('#' + unite_media_field + '_preview').length ) {
                    
                    $('#' + unite_media_field + '_preview').remove();
                    
                }
                
                /* check if file icon already exists */
                if( $('#' + unite_media_field + '_preview_icon').length ) {
                    
                    $('#' + unite_media_field + '_preview_icon').attr('class','').attr('class', 'fa fa-file-video-o');
                    
                } else {
                
                    $('<i />',{ 'id': unite_media_field + '_preview_icon', 'class': 'fa fa-file-video-o' }).insertAfter('#' + unite_media_field );

                }               
            
            } else if( attachment.type === 'text' ) {
                
                /* remove old image object if exists */
                if( $('#' + unite_media_field + '_preview').length ) {
                    
                    $('#' + unite_media_field + '_preview').remove();
                    
                }
                
                /* check if file icon already exists */
                if( $('#' + unite_media_field + '_preview_icon').length ) {
                    
                    $('#' + unite_media_field + '_preview_icon').attr('class','').attr('class', 'fa fa-file-text');
                    
                } else {
                
                    $('<i />',{ 'id': unite_media_field + '_preview_icon', 'class': 'fa fa-file-text' }).insertAfter('#' + unite_media_field );

                }               
            
            } else {
            
                /* remove old image object if exists */
                if( $('#' + unite_media_field + '_preview').length ) {
                    
                    $('#' + unite_media_field + '_preview').remove();
                    
                }
                
                /* check if file icon already exists */
                if( $('#' + unite_media_field + '_preview_icon').length ) {
                    
                    $('#' + unite_media_field + '_preview_icon').attr('class','').attr('class', 'fa fa-file');
                    
                } else {
                
                    $('<i />',{ 'id': unite_media_field + '_preview_icon', 'class': 'fa fa-file' }).insertAfter('#' + unite_media_field );

                }
            
            }        
        
        }
        
        /* unite media upload
		================================================== */ 
        var unite_media_uploader = false,
            unite_media_title    = '',
            unite_media_field    = '',
            unite_media_preview  = true;
        
        $(document).on('click', '.ut-upload-media', function( event ) {
            
            event.preventDefault();
            
            unite_media_title   = $(this).data('title');
            unite_media_field   = $(this).data('field');
            unite_media_preview = $(this).attr('data-preview');
            
            /* re open upload object if already available */
            if( unite_media_uploader ) {
                unite_media_uploader.open();
                return;
            }            
            
            /* extend wp.media object */
            unite_media_uploader = wp.media.frames.file_frame = wp.media({
                title: unite_media_title,
                button: {
                    text: unite_media_title
                },
                multiple: false,
                library : {
                    type : $(this).data('mime')
                }
                
            });
            
            /* assign to field */
            unite_media_uploader.on('select', function() {
                
                var attachment = unite_media_uploader.state().get('selection').first().toJSON(),
                    //href       = attachment.attributes.url,
                    regex      = /^image\/(?:jpe?g|png|gif|ico)$/i;
                
                /* create preview */
                if( unite_media_preview === 'true' ) {
                    unite_create_media_preview( attachment, unite_media_field );                
                }
                
                $('#' + unite_media_field).val(attachment.url);
                
            });
            
            /* open dialog */
            unite_media_uploader.open();
            
        });
        
        $(document).on('click', '.ut-delete-media', function( event ) {
            
            event.preventDefault();
            
            var field = $(this).data('field');
            
            /* delete field value */
            $('#' + field).val('');
            
            /* delete preview image */
            if( $('#' + field + '_preview').length ) {
                
                $('#' + field + '_preview').fadeOut( 800, function(){
                    
                    $(this).remove();
                    
                });
                
            }
        
        });
        
        
        /* unite color picker
		================================================== */ 
        function unite_create_colorpicker( $option ) {
           
            if( !$option.hasClass('ut-color-picker') ) {
                return; 
            }
                         
            var mode = $option.data('mode');
           
            if( mode === 'rgb' ) {
                            
                $option.minicolors({
                    format : mode,
                    opacity: true,
                });
            
            } else {
                
                $option.minicolors({
                    format: mode,
                    letterCase: 'uppercase',
                });
                
            }            
        
        }        
        
        $('.ut-color-picker').appear( function() {
            
            unite_create_colorpicker( $(this) );
                
        });
        
        /* ace CSS and JS editor
		================================================== */ 
        $('.ut-ace-editor').each(function() {
            
            var $this       = $(this),
                id          = $this.attr('id'),
                area        = $this.data('id'),
                aceeditor   = ace.edit(id),
                mode        = $this.data('mode');
                
            /* set theme  */
            aceeditor.setTheme("ace/theme/tomorrow");
            
            /* set editor mode */
            aceeditor.getSession().setMode("ace/mode/"+mode);
            aceeditor.setShowPrintMargin(false);
            
            /* update textarea for theme options */
            aceeditor.on('change', function() {
                $( '#' + area ).val( aceeditor.getSession().getValue() );
                aceeditor.resize();
            }); 
                
        });
        
        
        /* unite admin tabs
		================================================== */ 
        function unite_update_main_content_title( title ) {
            
            if( !title ) {
                return;
            }
            
            $('.ut-admin-header-title').html( title );
        
        }
        
        function unite_show_hide_submenu() {
            
            $('.ut-backend-main-navigation-submenu').each(function() {
                
                if( !$(this).parent().hasClass('ut-current') ) {
                    
                    $(this).slideUp('fast');
                    
                } else {
                
                    $(this).slideDown('fast');
                    
                }  
                
            });
        
        }
        
        function unite_load_panel( panel_id ) {
                            
            if( !panel_id ) {
                return;
            } 
                        
            $.ajax({
                
                type: 'POST',
                url:  ajaxurl,
                data: {
                    "action"      : "load_settings_section", 
                    "section_id"  : panel_id 
                },
                success: function(response) {
                
                }
            
            });
        
        }
        
        function unite_update_panel( panel_id ) {
            
            if( !panel_id ) {
                return;
            }
            
            /* remove display class */                       
            $('.ut-admin-panel-group').removeClass('ut-show');
            
            /* add display class to panel */
            $('#' + panel_id ).addClass('ut-show'); 
            
            /* update main navigation */
            unite_update_main_navigation( panel_id );
        
        }
        
        var $navigation = $('.ut-backend-main-navigation');
        
        function unite_update_breadcrumb( lvl, title ) {
            
            if( lvl === 1 ) {
                
                $('.ut-breadcrumb .level-2' ).hide();
                $('.ut-breadcrumb .level-3' ).hide();
                
            } else if( lvl === 2 ) {
                
                $('.ut-breadcrumb .level-2' ).fadeIn();
                $('.ut-breadcrumb .level-1').text( $navigation.find('.ut-current a').data('title') );      
                    
            } else {
                
                $('.ut-breadcrumb .level-3' ).fadeIn();
                $('.ut-breadcrumb .level-2' ).fadeIn();
                $('.ut-breadcrumb .level-1').text( $navigation.find('.ut-current a').data('title') );      
                
            }
            
            $('.ut-breadcrumb .level-' + lvl ).text( title );
            
        }
        
        function unite_update_main_navigation( panel_id ) {
            
            if( !panel_id ) {
                return;
            }
            
            var $navigation = $('.ut-backend-main-navigation'),            
                $current    = $navigation.find("[data-panel='" + panel_id + "']");
            
            /* remove current class */
            $('.ut-current').removeClass('ut-current');
            
            /* add current class to parent li */
            $current.parent().addClass('ut-current');
            
            /* add current class to parent ul */
            if( $current.closest('ul').hasClass('ut-backend-main-navigation-submenu') ) {
                
                $current.closest('ul').parent().addClass('ut-current');                
            
            } 
            
            /* show hide submenu */
            unite_show_hide_submenu();
            
            /* update panel title */
            if( $current.data('title') ) {
                unite_update_main_content_title( $current.data('title') );
            }
            
            /* update breadcrumb */
            unite_update_breadcrumb( $current.data('lvl'), $current.data('title') );           
            
        }         
        
        /* adjust panel on click */ 
        var cookie_key = $('.ut-admin-wrap').data('cookiekey');
                        
        $('.ut-backend-main-navigation a').click(function(event){
            
            event.preventDefault();
            
            var $this    = $(this),
                panel_id = $this.data('panel');
            
            if( $this.data('') === '' ) {
                //unite_load_panel( panel_id ); @todo
            }            
            
            /* update panel */
            unite_update_panel( panel_id );
            
            /* set cookie */
            if( $this.data('panel') ) {
                $.cookie(cookie_key, $this.data('panel'), { expires: 1 });
            }
            
        });
        
        /* adjust panel on call */
        if( $.cookie(cookie_key) && cookie_key && $('#'+$.cookie(cookie_key)).length ) {
            
            /* activate panel */
            unite_update_panel( $.cookie(cookie_key) );
            
        } else {
                        
            unite_update_panel( $('.ut-menu-fallback-item').data('panel') );
        
        }  
        
        /* open panel by id */
        $('.ut-open-panel-tab').click(function(){
            
            $('[data-panel="' + $(this).data('openpanel') + '"]').trigger('click');
                       
        
        });
                
        /* group add item accordion
		================================================== */
        function ut_create_update_accordion( $group ) {
            
            if( !$group.hasClass("ui-accordion") ) {
                
                $group.accordion({ 
                    collapsible: true,
                    active: false,
                    icons: false,
                    animate: false,
                    heightStyle: "content",
                    beforeActivate: function( event, ui ) {
                        
                        $(this).addClass('closed');
                        
                    },
                    activate: function(event, ui) {
                        
                        if( $(this).hasClass('closed') ) {
                            
                            $(this).removeClass('closed');
                            
                        } else {
                            
                            $(this).addClass('closed');
                            
                        }
                        
                    }
                }).accordion({ active: 0 });
                
                
                $group.find('.ut-option-element').each(function() {
                    
                    /* create colorpicker */
                    unite_create_colorpicker( $(this) );

                });                
                
            }            
        
        }     
        
        /* group items accordion
		================================================== */
        $('.ut-repeat-group').not('.ut-to-copy').each(function() {
            
            $(this).accordion({ 
                collapsible: true,
                icons: false,
                active: false,
                animate: false,
                heightStyle: "content",
                activate: function(event, ui) {
                    
                    if( $(this).hasClass('closed') ) {
                        
                        $(this).removeClass('closed');
                        
                    } else {
                        
                        $(this).addClass('closed');
                        
                    }
                    
                }
            });            
        
        });
            
        /* group items copy
		================================================== */
        $('.ut-do-copy').click(function(event){
            
            event.preventDefault();
            
            /* get loop */
            var $loop = $(this).parent();
            
            /* define our new group */
            var $group = $loop.find('.ut-to-copy');
            
            /* create new group */
            var $newgroup = $group.clone().appendTo( $(this).prev('.ut-repeat-group-loop') ).removeClass('ut-to-copy').removeClass('ut-hide').find('.ut-group-item-to-copy').removeClass('ut-group-item-to-copy').end();
            
            /* create accordion for new group */
            ut_create_update_accordion( $newgroup );
            
            /* loop trough hidden group option elements */
            $group.find('.ut-option-element').each(function() {
                
                /* increase group name id */
                if( $(this).attr('name') !== undefined ) {

                    $(this).attr('name', $(this).attr('name').replace(/\[(\d+)\]/, function($0, $1) {
                        return '[' + (+$1 + 1) + ']';
                    }));
                    
                }
                
                /* increase group id */
                if( $(this).attr('id') !== undefined ) {
                
                    $(this).attr('id', $(this).attr('id').replace(/\_(\d+)/, function($0, $1) {
                        return '_' + (+$1 + 1);
                    }));
                
                }
                                
                /* increase data field */
                if( $(this).attr('data-field') !== undefined ) {
                                        
                    $(this).attr('data-field', $(this).attr('data-field').replace(/\_(\d+)/, function($0, $1) {
                        return '_' + (+$1 + 1);
                    }));
                
                }
                            
            });
        
        });
        
        /* Tooltipster
		================================================== */
        $('.unite-tooltip a').tooltipster({
            theme: 'unite-tooltipster'
        });
        
        
        $(document).on('click', '.ut-info-button', function( event ) {
            
            event.preventDefault();
        
        });
        
        /* group item delete
		================================================== */
        $(document).on('click', '.ut-delete-group', function( event ) {
            
            $(this).closest('.ut-repeat-group').remove();
            
            event.preventDefault();
             
        });        
        
        /* group item change title
		================================================== */
        $('.ut-repeat-group').each(function() {
            
            var $this  = $(this),
                $title = $this.find('.ut-admin-panel-header-title').first();
                
            $title.text( $this.find('.ut-admin-panel-content').first().find('input').first().val() );
                        
        });
        
        $(document).on('input propertychange', '.ut-repeat-group .ut-group-item-title input' , function() {
                
            $(this).closest('.ut-repeat-group').find('h3').first().text( $(this).val() );
            
        });
        
             
        
        /* icon picker
		================================================== */
        $('.ut-icon-select').each(function() {
            
            $(this).fontIconPicker({
                
                 theme: 'fip-inverted',
                 iconsPerPage: 50
                             
            });
                
        });
        
        /* slider
		================================================== */
        $('.ut-range-slider').each(function() {
            
            $(this).slider({
                
                min: $(this).data('min'),
                max: $(this).data('max'),
                step: $(this).data('step'),
                value: $(this).data('value'),
                slide: function( event, ui ) {
                    
                    $(this).parent().find('.ut-option-element').val( ui.value );
                    $(this).parent().find('.ut-range-value').text( ui.value );
                
                }
                             
            });
                
        });
        
        /* grid slider
		================================================== */
        $('.ut-grid-slider').each(function() {
            
            var grids     = $(this).data('gridsizes'),
                grids     = grids.split(','),
                gridvalue = $(this).data('value'),
                gridindex = 1;
            
            $.each(grids, function( index, value ) {
                
                if( gridvalue === value ) {
                    gridindex = index;
                }
                
            });
                
            $(this).slider({
                
                animate: 'slow',
                range: "min",
                min: 0,
                max: grids.length-1,
                step: 1,
                value: gridindex,
                slide: function( event, ui ) {
                    
                    var a = grids[ui.value].split(':');         
                    
                    /* update preview */                    
                    $('#'+$(this).data('id')+'-preview').find('.ut-grid-preview-left').attr('class','').addClass('grid-' + a[0] + ' ut-grid-preview-left').find('span').text( a[0] );
                    $('#'+$(this).data('id')+'-preview').find('.ut-grid-preview-right').attr('class','').addClass('grid-' + a[1] + ' ut-grid-preview-right').find('span').text( a[1] );
                    
                    /* update value */
                    $('#'+$(this).data('id')).val( grids[ui.value] );
                
                }
                             
            });
                
        });
                
        /* font weights
		================================================== */        
        function unite_update_font_weights( group, variants ) {
			
            var _variants = variants.replace("regular", "400");		
                _variants = _variants.split(",");
            
            if( $.inArray( $("#"+group+"-font-weight").val() , _variants ) === -1 ) {
				
                $("#"+group+"-font-weight").prop('selectedIndex', 0);
                
			}
            
            $("#"+group+"-font-weight option").each(function() {
				
				if( $.inArray( $(this).val() , _variants ) >= 0 || !$(this).val() ) {
				
					$(this).attr("disabled" , false);
				
				} else {
				
					$(this).attr("disabled" , true);
								
				}
					
			}); 
            
        }       
        
        /* font styles
		================================================== */       
        function unite_update_font_styles( group, variants ) {
		    
			var variants = variants.split(",");
            
            // console.log( variants ); @todo
		
		}
        
        /* update font fields
		================================================== */
        function unite_update_font_fields( group ) {
			
			if( !group ) {
				return;
			}
                        
            var $this       = $("#"+group+"-family"),
                variants	= $this.find(':selected').data('variants');
                                    
            if( variants !== undefined ) {
            
                unite_update_font_styles( group, variants );
                unite_update_font_weights( group, variants );            
            
            }
        
        }
        
        /* update all fields first call */
		$(".ut-font-select").each(function() {
            
            var group = $(this).data("group");				
            
            /* update fields */
            if( group !== undefined ) {
            
                unite_update_font_fields( group );                        
            
            }
            	
        });
        
        $(".ut-font-select").change(function(){
			
            var group = $(this).data("group");
            
            /* update fields */
            if( group !== undefined ) {
            
                unite_update_font_fields( group );
            
            }
			
        });
                
        /* sortable
		================================================== */
        $('.ut-sortable-list').each(function() {
            
            $(this).sortable({
                placeholder: "ut-sortable-placeholder",
                handle: ".ut-sortable-handle"
            });
                
        });
        
        /* field dependencies
		================================================== */
        function create_select_dependency( $this ){
            
            var val = $this.data('value').split(','); 
                                    
            $this.dependsOn({
                
                dependency: {
                    values: val
                }            
            
            });
        
        }
        
        function create_radio_dependency( $this ){
                       
            var val = $this.data('value').split(','); 
                                    
            $this.dependsOn({
                
                dependency: {
                    values: val
                }            
            
            });
        
        }
        
        function create_checkbox_dependency( $this ){            
             
            $this.dependsOn({
                
                dependency : {
                    checked: true
                }            
            
            });    
        
        }
        
        function create_switch_dependency( $this ){            
                         
            $this.dependsOn({
                
                dependency : {
                    checked: true
                }            
            
            });    
        
        }
        
        /* field dependencies
		================================================== */
        function unite_create_dependencies() {
            
             $("[data-dependency]").each( function() {
            
                var $this = $(this);            
                
                if( $this.hasClass('ut-dependency-loaded') || $this.parent().hasClass('ut-group-item-to-copy') ) {
                    
                    return true;

                }
                
                /* check if there is a sub dependency */            
                if( $("[name*=" + $this.data('dependency') + "]").closest('.ut-admin-panel-content').data('dependency') ) {
                    
                    /* add extra class to identify items */
                    $("[name*=" + $this.data('dependency') + "]").closest('.ut-admin-panel-content').addClass('ut-has-subdependency');                
    
                }            
                
                switch ( $("#" + $this.data('dependency') ).closest('.ut-admin-panel-content').data('optiontype') ) {
                    
                    case 'switch':
                        create_switch_dependency( $this );
                        break;
    
                    case 'select':
                        create_select_dependency( $this );
                        break;
                        
                    case 'radio':
                        create_radio_dependency( $this );
                        break;
                    
                    case 'checkbox':
                        create_checkbox_dependency( $this );
                        break;                                        
                
                }
                
                $this.addClass('ut-dependency-loaded');
                
                
            });
        
        }
        
        unite_create_dependencies();
                        
        /* Box Collapse
		================================================== 
        function collapse_admin_panel( panel_content_id, $panel ) {
             
            var panelVisible = localStorage.getItem( 'collapse_' + panel_content_id )  === 'true' || localStorage.getItem( 'collapse_' + panel_content_id ) === null;
            
            $('[data-panel-for="' + panel_content_id + '"]').toggle( panelVisible );
            $panel.toggleClass( 'ut-panel-open', panelVisible );        
                    
        } */
        
        /*  $("[data-action]").each( function() {
            
            var $this  = $(this),
                panel_content_id = $this.data('collapse-panel');
            
            collapse_admin_panel( panel_content_id, $this.parent() );
        
        });
        
        $(document).on('click', '[data-action]', function( event ) {
            
            var $this  = $(this),
                panel_content_id = $this.data('collapse-panel');                       
            
            $('[data-panel-for="' + panel_content_id + '"]').stop().slideToggle( 200, function () {
                
                localStorage.setItem( 'collapse_' + panel_content_id, $('[data-panel-for="' + panel_content_id + '"]').is(':visible') );
                $this.parent().toggleClass( 'ut-panel-open', $('[data-panel-for="' + panel_content_id + '"]').is(':visible') );
                
            });

            event.preventDefault();    
        
        }); */    
        
        
        /* Breadcrumb
		================================================== */
        $(document).on('click', '.ut-breadcrumb a', function( event ) {
            
            // @todo
            
            event.preventDefault();
            
        });
        
        
        /* Layout Manager
		================================================== */
        $(document).on('click', '.ut-manage-layouts, .ut-close-manage-layouts', function( event ) {  
            
            $('.unite-layout-manager').slideToggle();
            
            event.preventDefault();
            
        });
        
                     
        
        /* Tag Suggest
		================================================== */
        $('.ut-tag-suggest').each(function() {
            
            var $this = $(this);
            
            $this.tagEditor({
                
                autocomplete: {
                    source: unite_all_tags
                }
                
            });
            
        });
        
        /* admin notice dismiss
		================================================== */    
        $(document).on('click', '.unite-health-status .notice-dismiss', function( event ) {
            
            $.ajax({
                url: ajaxurl,
                data: {
                    action: 'hide_health_notification'
                }
            });
                        
            event.preventDefault();
            
        });
                
                    
    });
	
})(jQuery);