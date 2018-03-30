{if isset($_POST['type']) and $_POST['type'] == 'event-detail'}
	{AitEventsPro::prepareICSRecurringEvent($post)}
	{AitEventsProICSExport::openData()}
	{foreach AitEventsPro::prepareICSRecurringEvent($post) as $event}
		{AitEventsProICSExport::addEvent($event)}
	{/foreach}
	{AitEventsProICSExport::closeData()}
	{AitEventsProICSExport::getFile()}
{/if}

<form method="post">
	<input type="hidden" name="type" value="event-detail">
	<input type="hidden" name="id" value="{$post->id}">
	<button type="submit" id="ics-export-button" class="ait-button" ><span><i class="fa fa-list-alt"></i> <?php _e('Export to iCalendar', 'ait-events-pro') ?></span></button>
</form>


