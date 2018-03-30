jQuery(document).ready(function($) {
    $('.fotorama').each(function() {
        var $slider = $(this);
        //var opts = $slider.data('options');
        $slider.fotorama();
    });
});
