<div n:class="'address-container', $meta->displaySocialIcons && count($meta->socialIcons) > 0 ? social-icons-displayed">
	<h2>{__ 'Address'}</h2>

	{includePart portal/parts/single-item-social-icons}

	<div class="content">
		{if !$meta->map['address'] && $settings->addressHideEmptyFields}{else}
		<div class="address-row row-postal-address" itemscope itemtype="http://schema.org/PostalAddress">
			<div class="address-name"><h5>{__ 'Our Address'}:</h5></div>
			<div class="address-data" itemprop="streetAddress"><p>{if $meta->map['address']}{$meta->map['address']}{else}-{/if}</p></div>
		</div>
		{/if}

		{if !$settings->addressHideGpsField}
		{if ($meta->map['latitude'] === "1" && $meta->map['longitude'] === "1") != true}

		<div class="address-row row-gps" itemscope itemtype="http://schema.org/Place">
			<div class="address-name"><h5>{__ 'GPS'}:</h5></div>
			<div class="address-data" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
				<p>
					{if $meta->map['latitude'] && $meta->map['longitude']}
						{$meta->map['latitude']}, {$meta->map['longitude']}
						<meta itemprop="latitude" content="{$meta->map['latitude']}">
						<meta itemprop="longitude" content="{$meta->map['longitude']}">
					{else}-{/if}
				</p>
			</div>
		</div>
		{/if}
		{/if}

		{if !$meta->telephone && $settings->addressHideEmptyFields}{else}
		<div class="address-row row-telephone">
			<div class="address-name"><h5>{__ 'Telephone'}:</h5></div>
			<div class="address-data">
				{if $meta->telephone}
				<p>
					<span itemprop="telephone"><a href="tel:{str_replace(' ', '', $meta->telephone)}" class="phone">{$meta->telephone}</a></span>
				</p>
				{else}
				<p>-</p>
				{/if}

				{if is_array($meta->telephoneAdditional) && count($meta->telephoneAdditional) > 0}
					{foreach $meta->telephoneAdditional as $data}
					<p>
						<span itemprop="telephone"><a href="tel:{str_replace(' ', '', $data['number'])}" class="phone">{$data['number']}</a></span>
					</p>
					{/foreach}
				{/if}
			</div>

		</div>
		{/if}

		{if $settings->addressHideEmptyFields}
			{if $meta->email != ""}
				{if $meta->showEmail}
					<div n:class="address-row, row-email, !$meta->showEmail ? hide-email">
						<div class="address-name"><h5>{__ 'Email'}:</h5></div>
						<div class="address-data"><p><a href="mailto:{$meta->email}" target="_top" itemprop="email">{$meta->email}</a></p></div>
					</div>
				{else}
					{* dont display anything *}
				{/if}
			{else}
				{* dont display anything *}
			{/if}
		{else}
			{if $meta->email != ""}
				{if $meta->showEmail}
					<div n:class="address-row, row-email, !$meta->showEmail ? hide-email">
						<div class="address-name"><h5>{__ 'Email'}:</h5></div>
						<div class="address-data"><p><a href="mailto:{$meta->email}" target="_top" itemprop="email">{$meta->email}</a></p></div>
					</div>
				{else}
					<div n:class="address-row, row-email, !$meta->showEmail ? hide-email">
						<div class="address-name"><h5>{__ 'Email'}:</h5></div>
						<div class="address-data"><p>-</p></div>
					</div>
				{/if}
			{else}
				<div n:class="address-row, row-email, !$meta->showEmail ? hide-email">
					<div class="address-name"><h5>{__ 'Email'}:</h5></div>
					<div class="address-data"><p>-</p></div>
				</div>
			{/if}
		{/if}

		{if !$meta->web && $settings->addressHideEmptyFields}{else}
		<div class="address-row row-web">
			<div class="address-name"><h5>{__ 'Web'}:</h5></div>
			<div class="address-data"><p>{if $meta->web}<a href="{$meta->web}" target="_blank" itemprop="url" {if $settings->addressWebNofollow}rel="nofollow"{/if}>{if $meta->webLinkLabel}{$meta->webLinkLabel}{else}{$meta->web}{/if}</a>{else}-{/if}</p></div>
		</div>
		{/if}
	</div>
</div>
