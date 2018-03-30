{* REQUIRED PARAMETERS *}
{*
    $item
	$meta - item's meta
*}

{*var $meta = $item->meta(item-data)*}
{var $imageUrl = $item->hasImage ? $item->imageUrl : $options->theme->item->noFeatured}
<div class="item-data">
	<h3>{!$item->title}</h3>
	<span class="item-address">{!$meta->map[address]}</span>
	<a href="{!$item->permalink}">
		<span class="item-button">{__ 'Show More'}</span>
	</a>
</div>
<div class="item-picture">
	<img src="{imageUrl $imageUrl, width => 145, height => 180, crop => 1}" alt="image">
	{if $elements->unsortable[header-map]->option('infoboxEnableTelephoneNumbers') && $meta->telephone }
	<a href="tel:{str_replace(' ', '', $meta->telephone)}" class="phone">{!$meta->telephone}</a>
	{/if}
</div>


