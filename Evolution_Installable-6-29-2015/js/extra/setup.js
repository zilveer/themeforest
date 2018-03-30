$(document).ready(function(){

	$('#basicuse').jflickrfeed({
		limit: 12,
		qstrings: {
			id: '37344888@N08'
		},
		itemTemplate: '<li><a href="http://www.flickr.com/photos/37344888@N08"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
	});
	
	$('#sidebarflickr').jflickrfeed({
		limit: 12,
		qstrings: {
			id: '34648819@N05'
		},
		itemTemplate: '<li><a href="http://www.flickr.com/photos/34648819@N05"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
	});

});