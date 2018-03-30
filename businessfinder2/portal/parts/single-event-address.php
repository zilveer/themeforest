{var $address                = aitEventAddress($post, true)}
{var $eventAdress            = $address['address']}
{var $eventLocationLatitude  = $address['latitude']}
{var $eventLocationLongitude = $address['longitude']}
{var $addressHideGpsField    = $eventsProOptions['addressHideGpsField']}
{var $addressHideEmptyFields = $eventsProOptions['addressHideEmptyFields']}

<div class="address-container data-container">

	<div class="content">
		{if !$eventAdress && $addressHideEmptyFields}{else}
		<div class="address data">
			<div class="address-text data-content">
				<div class="address-data">
					<h4>{__ 'Event Venue'}</h4>
					<p>{if $eventAdress}{$eventAdress}{else}-{/if}</p>
				</div>
				{if !$addressHideGpsField}
				<div class="address-gps">
					<p>
						<strong>{__ "GPS:"} </strong>
						{if $eventLocationLatitude && $eventLocationLongitude}
							{$eventLocationLatitude}, {$eventLocationLongitude}
						{else}-{/if}
					</p>
				</div>
				{/if}

				{*if defined('AIT_GET_DIRECTIONS_ENABLED')*}
				<!--<div class="ait-get-directions-button"></div>-->
				{*/if*}
			</div>
		</div>
		{/if}
	</div>

</div>