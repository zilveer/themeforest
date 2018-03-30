<script id="{$htmlId}-script" type="text/javascript">
jQuery(window).load(function(){
	{!$el->jsObject}
	{!$el->jsObjectName}.current.frontColor = {$options->theme->general->decColor};
	{!$el->jsObjectName}.current.backColor = {$options->theme->general->linesColor};

	{if $options->theme->general->progressivePageLoading}
		{!$el->jsObjectName}.current.progressive = true;
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}-main").waypoint(function(){
				jQuery("#{!$htmlId}-main").addClass('load-finished');
				jQuery("#{!$htmlId} .counter").charts({!$el->jsObjectName});
			}, { triggerOnce: true, offset: "95%" });
		} else {
			{!$el->jsObjectName}.current.progressive = false;
			jQuery("#{!$htmlId}-main").addClass('load-finished');
			jQuery("#{!$htmlId} .counter").charts({!$el->jsObjectName});
		}
	{else}
		{!$el->jsObjectName}.current.progressive = false;
		jQuery("#{!$htmlId}-main").addClass('load-finished');
		jQuery("#{!$htmlId} .counter").charts({!$el->jsObjectName});
	{/if}
});
</script>
