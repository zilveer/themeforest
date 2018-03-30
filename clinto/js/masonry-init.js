var container = document.querySelector('#masonry');
var msnry;
// initialize Masonry after all images have loaded
imagesLoaded(container, function () {
    msnry = new Masonry(container, {
        itemSelector: '.entry-event'
        //gutter: 40
    });
});
