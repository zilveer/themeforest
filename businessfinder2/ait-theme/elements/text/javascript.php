<script id="{$htmlId}-script">
jQuery(window).load(function(){
	{if $options->theme->general->progressivePageLoading}
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}-main").find('img').each(function(){
				if(jQuery(this).parent().closest('div').hasClass('wp-caption')){
					jQuery(this).waypoint(function(){
						jQuery(this).parent().closest('div').addClass('load-finished');
					}, { triggerOnce: true, offset: "95%" });
				} else {
					jQuery(this).waypoint(function(){
						jQuery(this).addClass('load-finished');
					}, { triggerOnce: true, offset: "95%" });
				}
			});
			jQuery("#{!$htmlId}-main").waypoint(function(){
				jQuery(this).addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#{!$htmlId}-main").find('img').each(function(){
				if(jQuery(this).parent().closest('div').hasClass('wp-caption')){
					jQuery(this).parent().closest('div').addClass('load-finished');
				} else {
					jQuery(this).addClass('load-finished');
				}
			});
			jQuery("#{!$htmlId}-main").addClass('load-finished');
		}
	{else}
		jQuery("#{!$htmlId}-main").find('img').each(function(){
			if(jQuery(this).parent().hasClass('wp-caption')){
				jQuery(this).parent().addClass('load-finished');
			} else {
				jQuery(this).addClass('load-finished');
			}
		});
		jQuery("#{!$htmlId}-main").addClass('load-finished');
	{/if}
});
</script>