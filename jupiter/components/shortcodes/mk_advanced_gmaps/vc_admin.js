function mk_gmap_iterator($id) {
	$ = jQuery;


	$('.gmap-new-loaction-btn').on('click', openModal);
	$('#mk-popup-cancel-btn').on('click', cancelModal);
	$('#mk-popup-submit-btn').on('click', submitModal);
	$(document).on('click', '.gmap-delete-btn', remove);
	$(document).on('click', '.gmap-edit-btn', edit);


	function openModal(e) {
		e.preventDefault();
		var $modal = $('.gmap-marker-popup'),
			date = new Date(),
			time = date.getTime();

		$modal.find('input').val('');	
		$modal.find('.show-upload-image').html();
		$modal.fadeIn(200);
	}

	function cancelModal(e) {
		e.preventDefault();
		$('.gmap-marker-popup').fadeOut(200);
	}

	function submitModal(e) {
		e.preventDefault();
		var $submitBtn = $(this),
			$popup = $submitBtn.parents('.gmap-marker-popup'),
			$inputs = $popup.find('input'),
			$inputUniq = $inputs.filter('[name="uniqid"]'),
			uniq = $inputUniq.val(),
			date = new Date(),
			time = date.getTime(),
			data = {};

		// For new entry
		if(!uniq) $inputUniq.val(time);

		$inputs.each(function() {
			var $input = $(this),
				val = $input.val();
			if(val) data[$input.attr('name')] = val;
		});

		if(data && !uniq)     { appendData(data); appendRow(data); }
		else if(data && uniq) { updateData(data); updateRow(data); }

		$popup.fadeOut(200);
	}

	function appendData(data) {
		var currentData = getCurrentData();
		currentData.push(data);
		save(currentData);
	}

	function appendRow(data) {
		var $list = $('.gmap-marker-locations');
		var $item = $list.find('li').eq(0).clone();

		$item.attr('style', '');
		$item.removeClass('temp');
		$item.attr('data-id', data.uniqid);
		$item.find('span').html(data.title);
		$item.appendTo($list);
	}

	function updateData(data) {
		var currentData = getCurrentData(),
			index = getRowIndex(currentData, data.uniqid);

		currentData[index] = data;
		save(currentData);
	}

	function updateRow(data){
		$item = $('.gmap-marker-locations li[data-id="'+ data.uniqid +'"]');
		$item.find('span').html(data.title);
	}

	function addMarker() {

	}

	function save(data) {
		$('.gmap-marks-collector').val(escape(JSON.stringify(data)));
	}

	function remove(e) {
		e.preventDefault();
		var id = getRowId(e),
			data = getCurrentData(),
			index = getRowIndex(data, id);

		$('.gmap-marker-locations li:not(.temp)').eq(index).remove();
		data.splice(index, 1);
		save(data);
	}

	function edit(e) {
		e.preventDefault();
		var id = getRowId(e),
			data = getCurrentData(),
			index = getRowIndex(data, id),
			$modal = $('.gmap-marker-popup');

		$modal.find('input[name="uniqid"]').val(data[index].uniqid);
		$modal.find('input[name="title"]').val(data[index].title);
		$modal.find('input[name="latitude"]').val(data[index].latitude);
		$modal.find('input[name="longitude"]').val(data[index].longitude);
		$modal.find('input[name="address"]').val(data[index].address);
		$modal.find('input[name="marker_icon"]').val(data[index].marker_icon);
		$modal.find('.show-upload-image').html((!!data[index].marker_icon) ? ('<img src="'+data[index].marker_icon+'">') : '');
		$modal.fadeIn(200);
	}

	function getRowId(e) {
		var $btn = $(e.currentTarget),
			$item = $btn.parents('li'),
			id = $item.data('id');

		return id;
	}

	function getRowIndex(data, id) {
		var index = null;
		// find index to delete
		data.forEach(function(location, i){
			if(parseFloat(location.uniqid) === parseFloat(id)) index =  i;
		});
		return index;
	}

	function getCurrentData() {
		var data = $('.gmap-marks-collector').val();
		return (!!data && data !== 'false') ? JSON.parse(unescape(data)) : [];
	}
}