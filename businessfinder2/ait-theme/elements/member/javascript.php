<script id="{$htmlId}-script" type="text/javascript">
jQuery(window).load(function(){
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
	
	{if $el->option("hideRows")}
		var container = jQuery("#{!$htmlId}").find('.desc-wrap .entry-content');
		
		container.css({'height': 'auto', 'visibility' : 'hidden'});
		var maxHeight = container.height();
		var minHeight = parseInt(container.css('line-height'))*parseInt({$el->option("textRows")});
		container.css({'height': minHeight, 'visibility' : ''});
		container.attr('data-maxheight', maxHeight);
		container.attr('data-minheight', minHeight);
		
		var hiderMore = container.parent().find('.entry-content-hider.state-more');
		var hiderLess = container.parent().find('.entry-content-hider.state-less');
		container.parent().find('.entry-content-hider').hide();
		if(maxHeight >= minHeight){
			container.css({"height" : container.data("minheight"), "overflow" : "hidden"});
			hiderMore.show();
			hiderMore.click(function(){
				container.animate({ height: container.data('maxheight') }, 500, function(){
					hiderMore.hide();
					hiderLess.show();
				});
			});

			hiderLess.click(function(){
				container.animate({ height: container.data('minheight') }, 500, function(){
					hiderLess.hide();
					hiderMore.show();
				});
			});
		}

	{/if}
});
</script>
