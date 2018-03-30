<script id="{$htmlId}-script">
	jQuery(window).load(function(){
		{!$el->jsObject}

		{if $options->theme->general->progressivePageLoading}
			{!$el->jsObjectName}.current.progressive = true;
			if(!isResponsive(1024)){
				jQuery("#{!$htmlId}").portfolio({!$el->jsObjectName});
			jQuery("#{!$htmlId}").waypoint(function(){
				jQuery("#{!$htmlId}").find('div.loading')/*.delay(1000)*/.fadeOut('fast');
				jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
			}, { triggerOnce: true, offset: '95%' });
		} else {
			{!$el->jsObjectName}.current.progressive = false;
			jQuery("#{!$htmlId}").portfolio({!$el->jsObjectName});
	}
	{else}
	{!$el->jsObjectName}.current.progressive = false;
	jQuery("#{!$htmlId}").portfolio({!$el->jsObjectName});
	{/if}
	});
</script>
