<script id="{$htmlId}-script">
jQuery(document).ready(function(){
	if(isResponsive(parseInt({$el->option(responsive)}))){
		jQuery('#{!$htmlId} .slider').addClass('reloadMe');
	}
});

jQuery(window).load(function(){
	if(isResponsive(parseInt({$el->option(responsive)}))){
		if(jQuery('#{!$htmlId} .slider-alternative').children('img').attr('src') != ""){
			jQuery('#{!$htmlId} .slider').hide();
			jQuery('#{!$htmlId} .slider-alternative').show();
		} else {
			jQuery('#{!$htmlId} .slider').show();
			jQuery('#{!$htmlId} .slider-alternative').hide();
		}
	} else {
		jQuery('#{!$htmlId} .slider').show();
		jQuery('#{!$htmlId} .slider-alternative').hide();
		if(jQuery('#{!$htmlId} .slider').hasClass('reloadMe')){
			jQuery('#{!$htmlId} .slider').removeClass('reloadMe');
			location.reload();
		}
	}
});

jQuery(window).resize(function(){
	if(isResponsive(parseInt({$el->option(responsive)}))){
		if(jQuery('#{!$htmlId} .slider-alternative').children('img').attr('src') != ""){
			jQuery('#{!$htmlId} .slider').hide();
			jQuery('#{!$htmlId} .slider-alternative').show();
		} else {
			jQuery('#{!$htmlId} .slider').show();
			jQuery('#{!$htmlId} .slider-alternative').hide();
		}
	} else {
		jQuery('#{!$htmlId} .slider').show();
		jQuery('#{!$htmlId} .slider-alternative').hide();
		if(jQuery('#{!$htmlId} .slider').hasClass('reloadMe')){
			jQuery('#{!$htmlId} .slider').removeClass('reloadMe');
			location.reload();
		}
	}
});
</script>
