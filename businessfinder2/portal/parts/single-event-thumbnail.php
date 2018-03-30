{var $gallery = array()}

{if $post->hasImage}
	{? array_push($gallery, array(
		'title' => $post->title,
		'image' => $post->imageUrl
	))}
{/if}

<section class="elm-main elm-easy-slider-main gallery-single-image">
	<div class="elm-easy-slider-wrapper">
		<div class="elm-easy-slider easy-pager-thumbnails pager-pos-outside detail-thumbnail-wrap detail-thumbnail-slider">
			<div class="loading"><span class="ait-preloader">{!__ 'Loading&hellip;'}</span></div>

			<div class="event-taxonomy-wrap">
				{includePart "portal/parts/event-taxonomy", itemID => $post->id, taxonomy => 'ait-events-pro', onlyParent => true, count => 5}
			</div>

			<ul class="easy-slider"><!--
			{foreach $gallery as $item}
			{var $title = AitLangs::getCurrentLocaleText($item['title'])}
			--><li>
					<a href="{imageUrl $item['image'], width => 1000, crop => 1}" target="_blank" data-rel="item-gallery">
						<span class="easy-thumbnail">
							<img src="{imageUrl $item['image'], width => 590, height => 600, crop => 1}" alt="{$title}" />
						</span>
					</a>
				</li><!--
			{/foreach}
			--></ul>
		</div>
		<script type="text/javascript">
			jQuery(window).load(function(){
				{if $options->theme->general->progressivePageLoading}
					if(!isResponsive(1024)){
						jQuery(".detail-thumbnail-slider").waypoint(function(){
							jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
							jQuery('.detail-thumbnail-slider').find('ul').delay(500).animate({'opacity':1}, 500, function(){
								jQuery('.detail-thumbnail-slider').find('.loading').fadeOut('fast');
								jQuery.waypoints('refresh');
							});
						}, { triggerOnce: true, offset: "95%" });
					} else {
						jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
						jQuery('.detail-thumbnail-slider').find('ul').delay(500).animate({'opacity':1}, 500, function(){
							jQuery('.detail-thumbnail-slider').find('.loading').fadeOut('fast');
							jQuery.waypoints('refresh');
						});
					}
				{else}
					jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
					jQuery('.detail-thumbnail-slider').find('ul').delay(500).animate({'opacity':1}, 500, function(){
						jQuery('.detail-thumbnail-slider').find('.loading').fadeOut('fast');
						jQuery.waypoints('refresh');
					});
				{/if}
			});
		</script>
	</div>
</section>
