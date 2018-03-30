{if $el->option(type) == 'accordion'}
<script id="{$htmlId}-script">
jQuery(function(){
	jQuery('#{!$htmlId}').accordion({ heightStyle: "content" });

	{if $options->theme->general->progressivePageLoading}
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}-main").waypoint(function(){
				jQuery("#{!$htmlId}-main").addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#{!$htmlId}-main").addClass('load-finished');
		}
	{else}
		jQuery("#{!$htmlId}-main").addClass('load-finished');
	{/if}
});
</script>
{elseif $el->option(type) == 'toggle'}
<script id="{$htmlId}-script">
jQuery(function(){
	jQuery('#{!$htmlId}').find('.toggle-content').css({'display':'none'});
	jQuery('#{!$htmlId}').find('.toggle-header').each(function(){
		jQuery(this).prepend('<span class="ui-icon"></span>');
		jQuery(this).addClass('toggle-inactive');
		jQuery(this).click(function(){
			jQuery(this).next().slideToggle('fast', function(){
				jQuery(this).prev().toggleClass('toggle-inactive');
				jQuery(this).prev().toggleClass('toggle-active');
			});
		});
	});

	{if $options->theme->general->progressivePageLoading}
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}").waypoint(function(){
				jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
		}
	{else}
		jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
	{/if}
});
</script>
{elseif $el->option(type) == 'htabs'}
<script id="{$htmlId}-script">
jQuery(function(){
	jQuery('#{!$htmlId}').tabs({
			beforeActivate: function(event, ui){
				ui.newPanel.children().hide();
			},
			activate: function(event, ui){
				ui.newPanel.children().not('.modal-wrap').fadeIn('slow');
			}
	}).addClass("ait-tabs-horizontal");

	{if $options->theme->general->progressivePageLoading}
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}").waypoint(function(){
				jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
		}
	{else}
		jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
	{/if}
});
jQuery(window).load(function(){
	tabsWidth('#{!$htmlId}', "ait-tabs-horizontal");
	responsiveTabs('#{!$htmlId}', "ait-tabs-horizontal");
});
jQuery(window).resize(function(){
	responsiveTabs('#{!$htmlId}', "ait-tabs-horizontal");
});

/* new functionality for responsive */
jQuery("#{!$htmlId}").find('select.responsive-tabs-select').on('change', function(){
	var tabsContainer = jQuery("#{!$htmlId}").find('ul:first');
	var $selected = jQuery(this).find('option:selected');
	tabsContainer.find('a[href="'+$selected.val()+'"]').trigger('click');
});
/* new functionality for responsive */
</script>
{else}
<script id="{$htmlId}-script">
jQuery(function(){
	jQuery('#{!$htmlId}').tabs({
		beforeActivate: function(event, ui){
				ui.newPanel.children().hide();
			},
			activate: function(event, ui){
				ui.newPanel.children().not('.modal-wrap').fadeIn('slow');
			}
	}).addClass("ait-tabs-vertical");
	jQuery('#{!$htmlId} li').removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

	{if $options->theme->general->progressivePageLoading}
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}").waypoint(function(){
				jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
		}
	{else}
		jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
	{/if}
});
jQuery(window).load(function(){
	tabsWidth('#{!$htmlId}', "ait-tabs-vertical");
	responsiveTabs('#{!$htmlId}', "ait-tabs-vertical");

	tabsHover('#{!$htmlId}', "ait-tabs-vertical");
});
jQuery(window).resize(function(){
	responsiveTabs('#{!$htmlId}', "ait-tabs-vertical");
});

/* new functionality for responsive */
jQuery("#{!$htmlId}").find('select.responsive-tabs-select').on('change', function(){
	var tabsContainer = jQuery("#{!$htmlId}").find('ul:first');
	var $selected = jQuery(this).find('option:selected');
	tabsContainer.find('a[href="'+$selected.val()+'"]').trigger('click');
});
/* new functionality for responsive */
</script>
{/if}
