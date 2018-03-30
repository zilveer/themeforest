{var $eventsCount = $eventsProOptions = get_option('ait_events_pro_options', array())}
{var $eventsCount = $eventsProOptions['sortingDefaultCount']}
{var $eventsQuery = aitItemRelatedEvents($itemId, array('posts_per_page' => $eventsCount))}

<div id="item-events">

{if $eventsQuery->have_posts}

{includePart portal/parts/search-filters, current => $eventsQuery->post_count, max => $eventsQuery->found_posts, disableRedirect => true, postType => "ait-event-pro"}
<div class="ajax-container">
	<div class="events-container elm-item-organizer">
		<div class="elm-item-organizer-container carousel-disabled layout-list column-1">
			<div class="content">

				{customLoop from $eventsQuery as $post}
					{includePart portal/parts/event-container}
				{/customLoop}

			</div>
			<div class="loading hidden" style="display: none;"><span class="ait-preloader">{!__ 'Loading&hellip;'}</span></div>
		</div>
	</div>
</div>
{includePart parts/pagination, location => pagination-below, max => $eventsQuery->max_num_pages, query => $eventsQuery, ignoreSingle => true}

<script>
	var tabs = jQuery('#item-events');

	tabs.each(function(){
		var count = {$eventsCount};
		var offset = 0;
		var orderby = {$eventsProOptions['sortingDefaultOrderBy']};
		var order = {$eventsProOptions['sortingDefaultOrder']};

		var postType = 'ait-event-pro';

		var filter = jQuery(this).find('.filters-container');
		var pageLinks = jQuery(this).find('.page-numbers');

		pageLinks.click(function(e){
			e.preventDefault();

			if (jQuery(this).hasClass('current')) {
				return;
			}

			jQuery(pageLinks, '.current').removeClass('current');
			jQuery(this).addClass('current');
			offset = (parseInt(jQuery(this).text()) - 1) * count;
			getPaginatedPosts(count, offset, postType, orderby, order);
		});

		jQuery(filter).find('.filter-orderby select').change(function(){
			if (this.value ==- orderby) {
				return
			}
			orderby = this.value;
			getPaginatedPosts(count, offset, postType, orderby, order);
		});

		jQuery(filter).find('.filter-order a').click(function(e){
			e.preventDefault();
			order = jQuery(this).data('value');
			getPaginatedPosts(count, offset, postType, orderby, order);
		});
	});



	function getPaginatedPosts(count, offset, postType, orderby, order) {
		var request_data               = {};
		request_data['type']           = 'pagedPosts';
		request_data['postType']       = postType;
		request_data['lang']           = {AitLangs::getCurrentLanguageCode()};
		request_data['offset']         = offset;
		request_data['orderby']   	   = orderby;
		request_data['order']   	   = order;
		request_data['itemId']   	   = {$itemId};

		request_data['posts_per_page'] = count;

		jQuery('#item-events .ajax-container .content').addClass('ajax-loading');
		jQuery('#item-events .ajax-container .loading.hidden').css('display', 'block');
		ait.ajax.post('get-items:retrieve', request_data).done(function(data){
			if(data.success == true){
		jQuery('#item-events .ajax-container .content').empty();
				jQuery('#item-events .ajax-container .content').append(data.data.html_data);
				jQuery('#item-events .ajax-container .content').removeClass('ajax-loading');
		jQuery('#item-events .ajax-container .loading.hidden').css('display', 'none');
				jQuery('html, body').animate({
					scrollTop: jQuery("#item-events").offset().top
				}, 1000);
			} else {
				console.log("not success");
			}
		}).fail(function(){
			console.log("fail");
		});
	}
</script>

{else}
	{includePart parts/none, message => nothing-found}
{/if}

</div>

