{* REQUIRED PARAMETERS *}
{*
	$post - global wp post
	$meta - meta data of Item
*}

{if $meta->displayGallery}

<div class="item-featured-wrap{if !$post->hasImage} no-image{/if}">

	{* FEATURES SECTION *}
	{includePart portal/parts/single-item-features}
	{* FEATURES SECTION *}

	{if $post->hasImage}
	<a href="{$post->imageUrl}" target="_blank" data-rel="item-gallery">
		<div class="item-featured-img" style="background-image: url('{imageUrl $post->imageUrl, width => 1000, height => 500, crop => 1}')"></div>
	</a>
	{/if}
</div>

{/if}
