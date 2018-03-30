<form role="search" method="get" class="search-form" action="{$homeUrl}">
	<div>
		<label>
			<span class="screen-reader-text">{_x 'Search for:', 'label'}</span>
			<input type="text" class="search-field" placeholder="{!_x 'Search &hellip;', 'placeholder'}" value="{$wp->searchQuery}" name="s" title="{_x 'Search for:', 'label'}">
		</label>
		<input type="submit" class="search-submit" value="{_x 'Search', 'submit button'}">
	</div>
</form>
