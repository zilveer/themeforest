/* Flickr Feeds */
/* -------------------------------------------------------------------- */
(function ($) {
    'use strict';
function mk_flickr_feeds() {

    $('.mk-flickr-feeds').each(function() {
        var $this = $(this),
            apiKey = $this.attr('data-key'),
            userId = $this.attr('data-userid'),
            perPage = $this.attr('data-count'),
            column = $this.attr('data-column');

        jQuery.getJSON('https://api.flickr.com/services/rest/?format=json&method=' + 'flickr.photos.search&api_key=' + apiKey + '&user_id=' + userId + '&&per_page=' + perPage + '&jsoncallback=?', function(data) {

            jQuery.each(data.photos.photo, function(i, rPhoto) {
                var basePhotoURL = 'http://farm' + rPhoto.farm + '.static.flickr.com/' + rPhoto.server + '/' + rPhoto.id + '_' + rPhoto.secret;

                var thumbPhotoURL = basePhotoURL + '_q.jpg';
                var mediumPhotoURL = basePhotoURL + '.jpg';

                var photoStringStart = '<a ';
                var photoStringEnd = 'title="' + rPhoto.title + '" rel="flickr-feeds" class="mk-lightbox flickr-item a_colitem" href="' + mediumPhotoURL + '"><img src="' + thumbPhotoURL + '" alt="' + rPhoto.title + '"/></a>;';
                var photoString = (i < perPage) ? photoStringStart + photoStringEnd : photoStringStart + photoStringEnd;

                jQuery(photoString).appendTo($this);
            });
        });
    });

}
    mk_flickr_feeds();
})(jQuery);