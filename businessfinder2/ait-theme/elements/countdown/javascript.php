<script id="{$htmlId}-script">
jQuery(window).load(function(){
	{!$el->jsObject}
	{!$el->jsObjectName}.current.now = new Date("{!= date('c')}");
	{!$el->jsObjectName}.current.frontColor = {$options->theme->general->decColor};
	{!$el->jsObjectName}.current.backColor = {$options->theme->general->linesColor};

	{if $options->theme->general->progressivePageLoading}
		{!$el->jsObjectName}.current.progressive = true;
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}").countdown({!$el->jsObjectName});
			jQuery("#{!$htmlId}-main").waypoint(function(){
				jQuery("#{!$htmlId}-main").addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			{!$el->jsObjectName}.current.progressive = false;
			jQuery("#{!$htmlId}-main").addClass('load-finished');
			jQuery("#{!$htmlId}").countdown({!$el->jsObjectName});
		}
	{else}
		{!$el->jsObjectName}.current.progressive = false;
		jQuery("#{!$htmlId}-main").addClass('load-finished');
		jQuery("#{!$htmlId}").countdown({!$el->jsObjectName});
	{/if}
});
</script>
