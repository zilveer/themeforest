
function responsiveTabs(parentId, parentClass){
	var tabsContainer = jQuery(parentId).find('ul:first');
	var widthOfTabs = jQuery(parentId).attr('data-width');
	var wrapperWidth = jQuery(parentId).find('.tabs-wrapper').width();
	if(widthOfTabs >= wrapperWidth || isResponsive(640)){
		jQuery(parentId).removeClass( parentClass );

		tabsContainer.parent().addClass('responsive-tabs');
		tabsContainer.addClass('responsive-tabs').hide();
		tabsContainer.parent().find('.selected').html(tabsContainer.find('.ait-tabs-active a').text()).show();

		tabsContainer.parent().find('.selected').toggle(function(){
			tabsContainer.stop(true, true).slideDown();
			tabsContainer.parent().addClass('toggle-opened');
		},function(){
			tabsContainer.stop(true, true).slideUp();
			tabsContainer.parent().removeClass('toggle-opened');
		});

		/* new functionality for responsive */
		// display select instead of rendered tabs dropdown
		tabsContainer.parent().hide(); // hide the tabs
		jQuery(parentId).find('select.responsive-tabs-select').show();
		/* new functionality for responsive */
	} else {
		jQuery(parentId).addClass( parentClass );

		tabsContainer.parent().removeClass('responsive-tabs');
		tabsContainer.removeClass('responsive-tabs').show();
		tabsContainer.parent().find('.selected').unbind('click').hide();

		/* new functionality for responsive */
		// display select instead of rendered tabs dropdown
		tabsContainer.parent().show(); // hide the tabs
		jQuery(parentId).find('select.responsive-tabs-select').hide();
		/* new functionality for responsive */
	}
	tabsContainer.children('li').click(function(){
		jQuery(this).parent().parent().find('.selected').html(jQuery(this).find('.ui-tabs-anchor').text()).click();
	});

	/* new functionality for responsive */
	/*jQuery(parentId).find('select.responsive-tabs-select').on('change', function(){
		var $selected = jQuery(this).find('option:selected');
		tabsContainer.find('a[href="'+$selected.val()+'"]').trigger('click');
	});*/
	/* new functionality for responsive */
}

function tabsWidth(parentId, parentClass){
	var result = 0;
	if(parentClass == "ait-tabs-horizontal"){
		var tabsWidth = 0;
		jQuery(parentId).find('ul.ait-tabs-nav').children('li').each(function(){
			tabsWidth = tabsWidth + jQuery(this).outerWidth(true);
		});
		result = tabsWidth;
	} else {
		result = 0;
	}
	jQuery(parentId).attr('data-width', result);
}

function tabsHover(parentId, parentClass){
	var span = "<span class='ait-tab-hover'>{text}</span>";
	jQuery(parentId).find('ul.ait-tabs-nav').children('li').each(function(){
		var text = jQuery(this).children('a').text();
		jQuery(this).append(span.replace('{text}', text));
		var cont = jQuery(this).find('.ait-tab-hover');
		cont.attr({'data-twidth' : jQuery(this).find('.ait-tab-hover').outerWidth(true)});
		cont.css({'width' : '10%'});
		cont.click(function(){
			jQuery(this).parent().find('a').click();
		});

		jQuery(this).hover(function(){
			cont.css({'width' : cont.data('twidth')});
		}, function(){
			cont.css({'width' : "10%"});
		});
	});
}
