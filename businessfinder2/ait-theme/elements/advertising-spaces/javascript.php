<script id="{$htmlId}-script">
jQuery(window).load(function(){
	{!$el->jsObject}

	{if $options->theme->general->progressivePageLoading}
		{!$el->jsObjectName}.current.progressive = true;

		if(!isResponsive(1024)){
			if(jQuery.fn.adSpaces !== undefined){
				jQuery("#{!$htmlId}").adSpaces({!$el->jsObjectName});
			}
			jQuery("#{!$htmlId}-main").waypoint(function(){
				jQuery("#{!$htmlId}-main").addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			{!$el->jsObjectName}.current.progressive = false;
			jQuery("#{!$htmlId}-main").addClass('load-finished');
			jQuery("#{!$htmlId}").adSpaces({!$el->jsObjectName});
		}
	{else}

		{!$el->jsObjectName}.current.progressive = false;
		jQuery("#{!$htmlId}-main").addClass('load-finished');

		if(jQuery.fn.adSpaces !== undefined){
			jQuery("#{!$htmlId}").adSpaces({!$el->jsObjectName});
		}

	{/if}
});
</script>
