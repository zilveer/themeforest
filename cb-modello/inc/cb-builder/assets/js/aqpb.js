/**
 * AQPB js
 *
 * contains the core js functionalities to be used
 * inside AQPB
 */
Math.decimal = function(n, k)
{
    var factor = Math.pow(10, k+1);
    n = Math.round(Math.round(n*factor)/10);
    return n/(factor/10);
}

jQuery.noConflict();





jQuery(window).bind("load",function(){

	jQuery('#cbb-page-builder img.builder_loader').fadeOut('fast');
	jQuery('#page-builder-frame').hide().css({visibility: "visible"}).fadeIn("slow");
});


/** Fire up jQuery - let's dance! **/
jQuery(document).ready(function($){


	var span='span12';
	/** Variables 
	------------------------------------------------------------------------------------**/
	var step = Math.decimal($('#blocks-to-edit').width()/12, 0);
	
	var block_archive, 
		block_number, 
		parent_id, 
		block_id, 
		intervalId,
		resizable_args = {
			grid: step,
            minWidth:step*2,
            maxWidth:$('#blocks-to-edit').width(),
			handles: 'w,e',
			
			resize: function(event, ui) { 
			    ui.helper.css("height", "inherit");
                ui.helper.removeClass (function (index, css) {
                    return (css.match (/\bspan\S+/g) || []).join(' ');
                });
			},
			stop: function(event, ui) {
				ui.helper.css('left', ui.originalPosition.left);
                span = block_size( $(ui.helper).css('width'),ui.helper.parent().width() );
				ui.helper.removeClass (function (index, css) {
				    return (css.match (/\bspan\S+/g) || []).join(' ');
				}).addClass(span);
				ui.helper.find('> div > .size').val(span);
                ui.helper.find('> div > div >  .size').val(span);
			ui.helper.find('> div > div > .selected_size').removeClass (function (index, css) {
                return (css.match (/\bs_span\S+/g) || []).join(' ');
            }).addClass('s_'+span);
                 }
		},
		tabs_width = $('.aqpb-tabs').outerWidth(), 
		mouseStilldown = false,
		max_marginLeft = 720 - Math.abs(tabs_width),
		activeTab_pos = $('.aqpb-tab-active').next().position(),
		act_mleft,
		$parent, 
		$clicked;
	
	
	/** Functions 
	------------------------------------------------------------------------------------**/
	
	/** create unique id **/
	function makeid()
	{
	    var text = "";
	    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	
	    for( var i=0; i < 5; i++ )
	        text += possible.charAt(Math.floor(Math.random() * possible.length));
	
	    return text;
	}
	
	/** Get correct class for block size **/
	function block_size(width,container) {
		var span = "span10";
		//var container = $('#blocks-to-edit').width();
		width = parseInt(width);
        var ratio = width/container;
        if (ratio > 0 && ratio < 0.12){ span = "span1"; }
        else if (ratio >= 0.12 && ratio < 0.2){ span = "span2"; }
        else if (ratio >= 0.2 && ratio < 0.29){ span = "span3"; }
        else if (ratio >= 0.29 && ratio < 0.37){ span = "span4"; }
        else if (ratio >= 0.37 && ratio < 0.45){ span = "span5"; }
        else if (ratio >= 0.45 && ratio < 0.54){ span = "span6"; }
        else if (ratio >= 0.54 && ratio < 0.62){ span = "span7"; }
        else if (ratio > 0.62 && ratio < 0.7){ span = "span8"; }
        else if (ratio >= 0.7 && ratio < 0.79){ span = "span9"; }
        else if (ratio >= 0.79 && ratio < 0.87){ span = "span10"; }
        else if (ratio >= 0.87 && ratio < 0.95){ span = "span11"; }
        else { span = "span12"; }
        //alert(ratio);



        //alert(container);
		/*
		if (width > 0 && width < 130){ span = "span2"; }
		else if (width == 166){ span = "span3"; }
		else if (width == 228){ span = "span4"; }
		else if (width == 290){ span = "span5"; }
		else if (width == 352){ span = "span6"; }
		else if (width == 414){ span = "span7"; }
		else if (width == 476){ span = "span8"; }
		else if (width == 538){ span = "span9"; }
		else if (width == 600){ span = "span10"; }
		else if (width == 662){ span = "span11"; }
		else if (width == 724){ span = "span12"; }
		*/
		return span;
	}
	
	/** Blocks resizable dynamic width **/
	function resizable_dynamic_width(blockID) {
		var blockPar = $('#' + blockID).parent(),
			maxWidth = parseInt($(blockPar).parent().parent().css('width'));
		
		//set maxWidth for blocks inside columns
		if($(blockPar).hasClass('column-blocks')) {
			$('#' + blockID + '.ui-resizable').resizable( "option", "maxWidth", maxWidth );

        }
		
		//set widths when the parent resized
		$('#' + blockID).bind( "resizestop", function(event, ui) {

            if($('#' + blockID).hasClass('block-aq_column_block')) {
				var $blockColumn = $('#' + blockID),
					new_maxWidth = parseInt($blockColumn.css('width'));
					child_maxWidth = new Array();
					
				//reset maxWidth for child blocks
				$blockColumn.find('ul.blocks > li').each(function() {
					child_blockID = $(this).attr('id');
					$('#' + child_blockID + '.ui-resizable').resizable( "option", "maxWidth", new_maxWidth );
					child_maxWidth.push(parseInt($('#' + child_blockID).css('width')));
                    /*var next = false
                    $('#' + child_blockID + ' .size ul >li').each(function() {
                        if($(this).attr('class')=='s_'+block_size(new_maxWidth))next=true;
                        if(!next)$(this).hide();
                        else $(this).show();

                    });*/
				});
				
				//get maxWidth of child blocks, use it to set the minWidth for column
				var minWidth = Math.max.apply( Math, child_maxWidth );
				$('#' + blockID + '.ui-resizable').resizable( "option", "minWidth", minWidth );

			}
						if($('#' + blockID).hasClass('block-aq_frame_block')) {
				var $blockColumn = $('#' + blockID),
					new_maxWidth = parseInt($blockColumn.css('width'));
					child_maxWidth = new Array();

				//reset maxWidth for child blocks
				$blockColumn.find('ul.blocks > li').each(function() {
					child_blockID = $(this).attr('id');
					$('#' + child_blockID + '.ui-resizable').resizable( "option", "maxWidth", new_maxWidth );
					child_maxWidth.push(parseInt($('#' + child_blockID).css('width')));
                    /*var next = false
                    $('#' + child_blockID + ' .size ul >li').each(function() {
                        if($(this).hasClass('s_'+block_size(new_maxWidth)))next=true;
                        if(!next)$(this).hide();
                        else $(this).show();

                    });*/
				});
				
				//get maxWidth of child blocks, use it to set the minWidth for column
				var minWidth = Math.max.apply( Math, child_maxWidth );
				$('#' + blockID + '.ui-resizable').resizable( "option", "minWidth", minWidth );
			}
			
				if($('#' + blockID).hasClass('block-aq_full_block')) {
				var $blockColumn = $('#' + blockID),
					new_maxWidth = parseInt($blockColumn.css('width'));
					child_maxWidth = new Array();

				//reset maxWidth for child blocks
				$blockColumn.find('ul.blocks > li').each(function() {
					child_blockID = $(this).attr('id');
					$('#' + child_blockID + '.ui-resizable').resizable( "option", "maxWidth", new_maxWidth );
					child_maxWidth.push(parseInt($('#' + child_blockID).css('width')));
                   /* var next = false
                    $('#' + child_blockID + ' .size ul >li').each(function() {
                        if($(this).attr('class')=='s_'+block_size(new_maxWidth))next=true;
                        if(!next)$(this).hide();
                        else $(this).show();

                    });
                    */
				});
				
				//get maxWidth of child blocks, use it to set the minWidth for column
				var minWidth = Math.max.apply( Math, child_maxWidth );
				$('#' + blockID + '.ui-resizable').resizable( "option", "minWidth", minWidth );
			}
			
			
						if($('#' + blockID).hasClass('block-aq_fframe_block')) {
							var $blockColumn = $('#' + blockID),
								new_maxWidth = parseInt($blockColumn.css('width'));
								child_maxWidth = new Array();

							//reset maxWidth for child blocks
							$blockColumn.find('ul.blocks > li').each(function() {
								child_blockID = $(this).attr('id');
								$('#' + child_blockID + '.ui-resizable').resizable( "option", "maxWidth", new_maxWidth );
								child_maxWidth.push(parseInt($('#' + child_blockID).css('width')));
                                /*var next = false
                                $('#' + child_blockID + ' .size ul >li').each(function() {
                                    if($(this).attr('class')=='s_'+block_size(new_maxWidth))next=true;
                                    if(!next)$(this).hide();
                                    else $(this).show();

                                });*/
							});
							
							//get maxWidth of child blocks, use it to set the minWidth for column
							var minWidth = Math.max.apply( Math, child_maxWidth );
							$('#' + blockID + '.ui-resizable').resizable( "option", "minWidth", minWidth );
						}
		});
		
	}
	
	/** Update block order **/
	function update_block_order() {
		$('ul.blocks').each( function() {
			$(this).children('li.block').each( function(index, el) {
				$(el).find('.order').last().val(index + 1);
				
				if($(el).parent().hasClass('column-blocks')) {
					parent_order = $(el).parent().siblings('.order').val();
					$(el).find('.parent').last().val(parent_order);
				} else {
					$(el).find('.parent').last().val(0);
					if($(el).hasClass('block-aq_column_block')) {
						block_order = $(el).find('.order').last().val();
						$(el).find('li.block').each(function(index,elem) {
							$(elem).find('.parent').val(block_order);
						});
					}
						if($(el).hasClass('block-aq_frame_block')) {
						block_order = $(el).find('.order').last().val();
						$(el).find('li.block').each(function(index,elem) {
							$(elem).find('.parent').val(block_order);
						});
					}
							if($(el).hasClass('block-aq_full_block')) {
						block_order = $(el).find('.order').last().val();
						$(el).find('li.block').each(function(index,elem) {
							$(elem).find('.parent').val(block_order);
						});
					}
						if($(el).hasClass('block-aq_fframe_block')) {
							block_order = $(el).find('.order').last().val();
							$(el).find('li.block').each(function(index,elem) {
								$(elem).find('.parent').val(block_order);
							});
						}
				}
				
			});
		});
	}
	
	/** Update block number **/
	function update_block_number() {
		$('ul.blocks li.block').each( function(index, el) {
			$(el).find('.number').last().val(index + 1);
		});
	}
	
	function columns_sortable() {
		//$('ul#blocks-to-edit, .block-aq_column_block ul.blocks').sortable('disable');
		$('#page-builder .column-blocks').sortable({
			placeholder: 'placeholder',
			connectWith: '#blocks-to-edit, .column-blocks',
			items: 'li.block'
		});
	}
	
	/** Menu functions **/
	function moveTabsLeft() {
		if(max_marginLeft < $('.aqpb-tabs').css('margin-left').replace("px", "") ) {
			$('.aqpb-tabs').animate({'marginLeft': ($('.aqpb-tabs').css('margin-left').replace("px", "") - 7) + 'px' }, 
			1, 
			function() {
				if(mouseStilldown) {
					moveTabsLeft();
				}
			});
		}
	}
	
	function moveTabsRight() {
		if($('.aqpb-tabs').css('margin-left').replace("px", "") < 0) {
			$('.aqpb-tabs').animate({'marginLeft': Math.abs($('.aqpb-tabs').css('margin-left').replace("px", ""))*(-1) + 7 + 'px' }, 
			1, 
			function() {
				if(mouseStilldown) {
					moveTabsRight();
				}
			});
		}
	}
	
	function centerActiveTab() {
		if($('.aqpb-tab-active').hasClass('aqpb-tab-add')) {
			act_mleft = 690 - $('.aqpb-tab-active').position().left - $('.aqpb-tab-active').width();
			$('.aqpb-tabs').css('margin-left' , act_mleft + 'px');
		} else
		if(720 < activeTab_pos.left) {
			act_mleft = 730 - activeTab_pos.left;
			$('.aqpb-tabs').css('margin-left' , act_mleft + 'px');
		}
	}
	
	/** Actions
	------------------------------------------------------------------------------------**/
	/** Apply CSS float:left to blocks **/
	$('li.block').css('float', 'none');
	
	/** Open/close blocks **/
	$(document).on('click', '#page-builder a.block-edit', function() {

		var blockID = $(this).parents('li').attr('id');
        if ($(this).hasClass('cb-show-options')){
            tb_show('Block options','#TB_inline?height='+tbo_position()+'&width=670&inlineId=' +$(this).attr('data-show'));
        tbo_position();
        tchild();
            $('#TB_window select').select2();


        }
        else
            $('#' + blockID + ' .block-settings').slideToggle('fast');
		if( $('#' + blockID).hasClass('block-edit-active') == false ) {
			$('#' + blockID).addClass('block-edit-active');
		} else {
			$('#' + blockID).removeClass('block-edit-active');
		};
		
		return false;
	});

	
	
	
	tbo_position = function() {
        var tbWindow = $('#TB_window');
        var width = $(window).width();
        var H = $(window).height();

        if ( tbWindow.size() ) {
            tbWindow.height( H - 65 );
            $('#TB_ajaxContent').height( H - 115 );
        };
        H=H-85;
        return H;
    };

    $(window).resize( function() { tbo_position(); } );
    
    tchild = function() {
    	$('#TB_ajaxContent .aq_desc').first().addClass('first');
    };

    $(window).resize( function() { tchild(); } );
	

    /** Open options **/
    $(document).on('click', '#page-builder a.block-options', function() {
        var blockID = $(this).parents('li').attr('id');
       // $('#' + blockID + ' .block-settings').slideToggle('fast');
        tb_show('Block options','#TB_inline?height='+tbo_position()+'&width=670&inlineId=' + blockID + ' .inside-options');
        tbo_position();
        tchild();
        $('#TB_window select').select2();

        /*if( $('#' + blockID).hasClass('block-edit-active') == false ) {
            $('#' + blockID).addClass('block-edit-active');
        } else {
            $('#' + blockID).removeClass('block-edit-active');
        };*/

        return false;
    });
	
	/** Blocks resizable **/
	$('ul.blocks li.block').each(function() {
		var blockID = $(this).attr('id'),
			blockPar = $(this).parent();
			
		//blocks resizing
		$('#' + blockID).resizable(resizable_args);
		
		//set dynamic width for blocks inside columns
		resizable_dynamic_width(blockID);
		
		//trigger resize
		$('#' + blockID).trigger("resize");
		$('#' + blockID).trigger("resizestop");
		
		//disable resizable on .not-resizable blocks
		$(".ui-resizable.not-resizable").resizable("destroy");
		
	});
	
	/** Blocks draggable (archive) **/
	$('#blocks-archive > li.block').each(function() {
		$(this).draggable({
			connectToSortable: "#blocks-to-edit",
			helper: 'clone',
			revert: 'invalid',
			start: function(event, ui) {
				block_archive = $(this).attr('id');

			},
            stop:function(event, ui) {
                //jQuery('.blocks-to-add').slideUp();
            }
		});
	});
	
	/** Blocks sorting (settings) **/
	$('#blocks-to-edit').sortable({
		placeholder: "placeholder",
		handle: '.block-handle, .block-settings-column',
		connectWith: '#blocks-archive, .column-blocks',
		items: 'li.block'
	});
	
	/** Columns Sortable **/
	columns_sortable();
	
	/** Sortable bindings **/
	$( "ul.blocks" ).bind( "sortstart", function(event, ui) {
		ui.placeholder.css('width', ui.helper.css('width'));
		ui.placeholder.css('height', ( ui.helper.css('height').replace("px", "") - 13 ) + 'px' );
		$('.empty-template').remove();
	});
	
	$( "ul.blocks" ).bind( "sortstop", function(event, ui) {
		
		//if coming from archive
		if (ui.item.hasClass('ui-draggable')) {
		
			//remove draggable class
		    ui.item.removeClass('ui-draggable');
		    
		    //set random block id
		    block_number = makeid();
		    
		    //replace id
		    ui.item.html(ui.item.html().replace(/<[^<>]+>/g, function(obj) {
		        return obj.replace(/__i__|%i%/g, block_number)
		    }));
		    
		    ui.item.attr("id", block_archive.replace("__i__", block_number));
		    
		    //if column, remove handle bar
		    if(ui.item.hasClass('block-aq_column_block')) {
		    	ui.item.find('.block-bar').remove();
		    	ui.item.find('.block-settings').removeClass('block-settings').addClass('block-settings-column');
		    }
			  if(ui.item.hasClass('block-aq_frame_block')) {
			    	ui.item.find('.block-bar').remove();
			    	ui.item.find('.block-settings').removeClass('block-settings').addClass('block-settings-column');
			    }
						  if(ui.item.hasClass('block-aq_full_block')) {
			    	ui.item.find('.block-bar').remove();
			    	ui.item.find('.block-settings').removeClass('block-settings').addClass('block-settings-column');
			    }
			  if(ui.item.hasClass('block-aq_fframe_block')) {
			    	ui.item.find('.block-bar').remove();
			    	ui.item.find('.block-settings').removeClass('block-settings').addClass('block-settings-column');
			    }
		    
		    //init resize on newly added block
		    ui.item.resizable(resizable_args);
		    
		    //set dynamic width for blocks inside columns
		    resizable_dynamic_width(ui.item.attr('id'));
		    
		    //trigger resize
		    ui.item.trigger("resize");
		    ui.item.trigger("resizestop");
		    
		    //open on drop
		   // ui.item.find('size').show();
           /* if( ui.item.parent().closest('li').hasClass('block-aq_column_block')){
                ui.item.addClass('not-resizable');
            }*/
		    //disable resizable on .not-resizable blocks
		    $(".ui-resizable.not-resizable").resizable("destroy");
		    
		}
		
		//if moving column inside column, cancel it
		if(ui.item.hasClass('block-aq_column_block')) {
			if(ui.item.parent().hasClass('column-blocks')) {


				$(this).sortable('cancel');
                alert('You can\'t insert this block here');
                ui.item.remove();

			}
			columns_sortable();

		}
			if(ui.item.hasClass('block-aq_frame_block')) {
			if(ui.item.parent().hasClass('column-blocks')) {
				$(this).sortable('cancel');
                alert('You can\'t insert this block here');
                ui.item.remove();
			}
			columns_sortable();
		}
					if(ui.item.hasClass('block-aq_full_block')) {
			if(ui.item.parent().hasClass('column-blocks')) {
				$(this).sortable('cancel');
                alert('You can\'t insert this block here');
                ui.item.remove();
			}
			columns_sortable();
		}
			if(ui.item.hasClass('block-aq_fframe_block')) {
				if(ui.item.parent().hasClass('column-blocks')) {
					$(this).sortable('cancel');
                    alert('You can\'t insert this block here');
                    ui.item.remove();
				}
				columns_sortable();
			}
		
		//@todo - resize column to maximum width of dropped item
		
		//update order & parent ids
		update_block_order();
		
		//update number
		update_block_number();
	
	});
	
	/** Blocks droppable (removing blocks) **/
	$('#page-builder-archive').droppable({
		accept: "#blocks-to-edit .block",
		tolerance: "pointer",
		over : function(event, ui) {
			$(this).find('#removing-block').fadeIn('fast');
			ui.draggable.parent().find('.placeholder').hide();
		},
		out : function(event, ui) {
			$(this).find('#removing-block').fadeOut('fast');
			ui.draggable.parent().find('.placeholder').show();
		},
		drop: function(ev, ui) {
	        ui.draggable.remove();
	        $(this).find('#removing-block').fadeOut('fast');
		}
	});
	
	/** Delete Block (via "Delete" anchor) **/
	$(document).on('click', '.del-icon', function() {
		$clicked = $(this);
		$parent = $(this.parentNode.parentNode.parentNode);
		

			$parent.find('> .block-bar .block-handle').css('background', 'red');
			$parent.slideUp(function() {
				$(this).parent().remove();
				update_block_order();
				update_block_number();
			}).fadeOut('fast');

		return false;
	});
    $(document).on('click', '.del-col', function() {
        $clicked = $(this);
        $parent = $(this.parentNode.parentNode);


        $parent.find('> .block-bar .block-handle').css('background', 'red');
        $parent.slideUp(function() {
            $(this).remove();
            update_block_order();
            update_block_number();
        }).fadeOut('fast');

        return false;
    });
	
	/** Disable blocks archive if no template **/
	$('#page-builder-column.metabox-holder-disabled').click( function() { return false })
	$('#page-builder-column.metabox-holder-disabled #blocks-archive .block').draggable("destroy");
	
	
	
	
	/** Confirm delete template **/
	$('a.template-delete').click( function() { 
		var agree = confirm('You are about to permanently delete this template. \'Cancel\' to stop, \'OK\' to delete.');
		if(agree) { return } else { return false }
	});
	
	/** Cancel template save/create if no template name **/
	$('#save_template_header, #save_template_footer').click(function() {
		var template_name = $('#template-name').val().trim();
		if(template_name.length === 0) {
			$('.major-publishing-actions .open-label').addClass('form-invalid');
			return false;
		}
	});
	
	/** Nav tabs scrolling **/
	if(720 < tabs_width) {
		$('.aqpb-tabs-arrow').show();
		centerActiveTab();
		$('.aqpb-tabs-arrow-right a').mousedown(function() {
			mouseStilldown = true;
		    moveTabsLeft();
		}).bind('mouseup mouseleave', function() {
		    mouseStilldown = false;
		});
		
		$('.aqpb-tabs-arrow-left a').mousedown(function() {
			mouseStilldown = true;
		    moveTabsRight();
		}).bind('mouseup mouseleave', function() {
		    mouseStilldown = false;
		});
		
	}
	
	/** Sort nav order **/
	$('.aqpb-tabs').sortable({
		items: '.aqpb-tab-sortable',
		axis: 'x',
	});
	
	/** Apply CSS float:left to blocks **/
	$('li.block').css('float', '');
	
	/** prompt save on page change **
	var aqpb_html = $('#update-page-template').html();
	$(window).bind('beforeunload', function(e) {
		var aqpb_html_new = $('#update-page-template').html();
		if(aqpb_html_new != aqpb_html) { 
			return "The changes you made will be lost if you navigate away from this page.";
		}
	}); */
    $(document).on({
        mouseenter: function () {
            $(this).find('.size').show();
        },
        mouseleave: function () {
            $(this).find('.size').hide();
        }
    },'.select_size');
    $(document).on('click', '.size li', function() {
        var n = $(this).attr('class').split("_");
        var par = $(this).closest('.block');
        par[0].className = par[0].className.replace(/\bspan.*?\b/g, '');
        par.removeClass (function (index, css) {
            return (css.match (/\bspan\S+/g) || []).join(' ');
        }).addClass(n[1]);
        par.removeAttr( 'style' );

        var sele = $(this).closest('.select_size').find('.selected_size');
        sele.removeClass (function (index, css) {
            return (css.match (/\bs_span\S+/g) || []).join(' ');
        }).addClass($(this).attr('class'));
        par.find('.block-settings .size').val(n[1]);
        $(this).parent().find('.sel_size').removeClass('sel_size');
        $(this).addClass('sel_size');

    });
    $(document).on('click', '.block-preview', function() {
        var id_prev = $(this).attr('href');
        if($(id_prev).is(':visible')){
            $(id_prev).slideUp('slow');
        }
        else{
            $(id_prev).slideDown('slow'); 
            $(id_prev).html($(this).closest('li').find('.prev-value').html());
    }

        return false;

    });
    $(document).on('change', '.cb-color-select', function() {
        $('#template-block-'+$(this).attr('data-block-number')+' .fully-color').removeClass (function (index, css) {
            return (css.match (/\bfullbg-\S+/g) || []).join(' ');
        }).addClass('fullbg-'+$(this).val()).attr('title','Color - '+$(this).find('option:selected').text());

    });

   
        $('#cb_page_new_meta_box select').select2();

    	$('.block-effect').click(function() {
    		$(this).parent().find('.fade').slideToggle('fast');
    		});

});
