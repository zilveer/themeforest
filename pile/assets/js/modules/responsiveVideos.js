/* --- $VIDEOS --- */

// function used to resize videos to fit their containers by keeping the original aspect ratio
function initVideos() {
    if (globalDebug) {console.group("videos::init");}

    var videos = $('.youtube-player, .entry-media iframe, .entry-media video, .entry-media embed, .entry-media object, iframe[width][height]');

    // Figure out and save aspect ratio for each video
    videos.each(function () {
        $(this).attr('data-aspectRatio', this.width / this.height)
            // and remove the hard coded width/height
            .removeAttr('height')
            .removeAttr('width');
    });

    resizeVideos();

    // Firefox Opacity Video Hack
    $('iframe').each(function () {
        var url = $(this).attr("src");
        if (!empty(url))
            $(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
    });

    if (globalDebug) {console.groupEnd();}
}

function resizeVideos() {
    if (globalDebug) {console.group("videos::resize");}

    var videos = $('.youtube-player, .entry-media iframe, .entry-media video, .entry-media embed, .entry-media object, iframe[data-aspectRatio]');

    videos.each(function () {
        var video = $(this),
            ratio = video.attr('data-aspectRatio'),
            w = video.css('width', '100%').width(),
            h = w / ratio;

        video.height(h);
    });

    if (globalDebug) {console.groupEnd();}
}