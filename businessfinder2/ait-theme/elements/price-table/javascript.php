<script id="{$htmlId}-script">
jQuery(window).load(function(){
	{if $el->option(layout) == 'horizontal'}
		{!$el->jsObject}
		jQuery("#{!$htmlId}").pricetable({!$el->jsObjectName});
	{/if}

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
