{if $meta->displayOpeningHours}
<div class="elm-opening-hours-main">
	<h2>{__ 'Opening Hours'}</h2>
	<div class="day-container">
		<div class="day-wrapper">
			<div class="day-title"><h5>{__ 'Monday'}</h5></div>
			{var $monday = AitLangs::getCurrentLocaleText($meta->openingHoursMonday)}
			<div class="day-data">
				<p>
					{if $monday}{$monday}
					<meta itemprop="openingHours" content="Mo {$monday}">
					{else}-{/if}
				</p>
			</div>
		</div>
		<div class="day-wrapper">
			<div class="day-title"><h5>{__ 'Tuesday'}</h5></div>
			{var $tuesday = AitLangs::getCurrentLocaleText($meta->openingHoursTuesday)}
			<div class="day-data">
				<p>
					{if $tuesday}{$tuesday}
					<meta itemprop="openingHours" content="Tu {$tuesday}">
					{else}-{/if}
				</p>
			</div>
		</div>
		<div class="day-wrapper">
			<div class="day-title"><h5>{__ 'Wednesday'}</h5></div>
			{var $wednesday = AitLangs::getCurrentLocaleText($meta->openingHoursWednesday)}
			<div class="day-data">
				<p>
					{if $wednesday}{$wednesday}
					<meta itemprop="openingHours" content="We {$wednesday}">
					{else}-{/if}
				</p>
			</div>
		</div>
		<div class="day-wrapper">
			<div class="day-title"><h5>{__ 'Thursday'}</h5></div>
			{var $thursday = AitLangs::getCurrentLocaleText($meta->openingHoursThursday)}
			<div class="day-data">
				<p>
					{if $thursday}{$thursday}
					<meta itemprop="openingHours" content="Th {$thursday}">
					{else}-{/if}
				</p>
			</div>
		</div>
		<div class="day-wrapper">
			<div class="day-title"><h5>{__ 'Friday'}</h5></div>
			{var $friday = AitLangs::getCurrentLocaleText($meta->openingHoursFriday)}
			<div class="day-data">
				<p>
					{if $friday}{$friday}
					<meta itemprop="openingHours" content="Fr {$friday}">
					{else}-{/if}
				</p>
			</div>
		</div>
		<div class="day-wrapper day-sat">
			<div class="day-title"><h5>{__ 'Saturday'}</h5></div>
			{var $saturday = AitLangs::getCurrentLocaleText($meta->openingHoursSaturday)}
			<div class="day-data">
				<p>
					{if $saturday}{$saturday}
					<meta itemprop="openingHours" content="Sa {$saturday}">
					{else}-{/if}
				</p>
			</div>
		</div>
		<div class="day-wrapper day-sun">
			<div class="day-title"><h5>{__ 'Sunday'}</h5></div>
			{var $sunday = AitLangs::getCurrentLocaleText($meta->openingHoursSunday)}
			<div class="day-data">
				<p>
					{if $sunday}{$sunday}
					<meta itemprop="openingHours" content="Su {$sunday}">
					{else}-{/if}
				</p>
			</div>
		</div>
	</div>
	{var $note = AitLangs::getCurrentLocaleText($meta->openingHoursNote)}
	{if $note != ""}
	<div class="note-wrapper">
		<p>{$note}</p>
	</div>
	{/if}
</div>
{/if}