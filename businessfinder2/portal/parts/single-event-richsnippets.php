{* VARIABLES *}
{var $meta = isset($meta) ? $meta : $post->meta('event-pro-data')}
{var $address = aitEventAddress($post, true)}

{if !empty($meta->item)}
	{var $item = get_post($meta->item)}
	{var $item_link = get_permalink($item->ID)}
	{var $item_image = wp_get_attachment_image_src( get_post_thumbnail_id( $item->ID ), 'single-post-thumbnail' )}
	{var $item_meta = (object)get_post_meta($item->ID, '_ait-item_item-data', true)}
	{var $item_meta_address = $item_meta->map}
	{var $foundOrganizer = true}
{/if}

{* VARIABLES *}

<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "Event",
	"name": "{!$post->title}",
	"image": "{!$post->imageUrl}",
	"location": {
		"@type": "Place",
		"name" : "{!$address['address']}",
		"address": {
			"@type": "PostalAddress",
			"streetAddress": "{!$address['address']}"
		},
		"geo": {
			"@type": "GeoCoordinates",
			"latitude": "{!$address['latitude']}",
			"longitude": "{!$address['longitude']}"
		}
	},
	{if !empty($meta->fee)}

	{if count($meta->fee) == 1}
		{var $fee = (object)$meta->fee[0]}
		"offers": {
			"@type": "Offer",
			{if $fee->name != ""}"name" : "{!$fee->name}",{/if}
			{if $fee->desc != ""}"description": "{!$fee->desc}",{/if}
			"price": "{!$fee->price}",
			"priceCurrency": "{!$meta->currency}",
			"url" : "{if isset($fee->url) and $fee->url != ""}{!$fee->url}{else}{!$post->permalink}{/if}"
		},
	{else}
		{var $lowPrice = 0}
		{var $highPrice = 0}
		"offers": {
			"@type": "AggregateOffer",
			"priceCurrency": "{!$meta->currency}",
			"offerCount": "{count($meta->fee)}",
			"offers": [
				{foreach $meta->fee as $fee}
				{var $fee = (object)$fee}
				{if $iterator->first}
					{var $lowPrice = $fee->price}
					{var $highPrice = $fee->price}
				{else}
					{if $fee->price < $lowPrice}{var $lowPrice = $fee->price}{/if}
					{if $fee->price > $highPrice}{var $highPrice = $fee->price}{/if}
				{/if}
				{
					"@type": "Offer",
					{if $fee->name != ""}"name" : "{!$fee->name}",{/if}
					{if $fee->desc != ""}"description": "{!$fee->desc}",{/if}
					"price": "{!$fee->price}",
					"priceCurrency": "{!$meta->currency}",
					"url" : {if isset($fee->url) and $fee->url != ""}{!$fee->url}{else}{!$post->permalink}{/if}
				}{if !$iterator->last},{/if}
				{/foreach}
			],
			"lowPrice": "{!$lowPrice}",
			"highPrice": "{!$highPrice}"
		},
	{/if}

	{/if}
	"startDate": "{!$meta->dateFrom}",
	"endDate": "{!$meta->dateTo}",
	"url": "{!$post->permalink}",
	{if isset($foundOrganizer)}
	"organizer": {
		"@type": "Organization",
		"name" : "{!$item->post_title}",
		"url" : "{!$item_link}",
		"email" : "{!$item_meta->email}",
		"telephone" : "{!$item_meta->telephone}",
		"image": "{!$item_image[0]}",
		"location": {
			"@type": "Place",
			"name" : "{!$item_meta_address['address']}",
			"address": {
				"@type": "PostalAddress",
				"streetAddress": "{!$item_meta_address['address']}"
			},
			"geo": {
				"@type": "GeoCoordinates",
				"latitude": "{!$item_meta_address['latitude']}",
				"longitude": "{!$item_meta_address['longitude']}"
			}
		}
	}
	{/if}
}
</script>
