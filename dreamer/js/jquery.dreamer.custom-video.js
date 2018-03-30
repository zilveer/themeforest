jQuery(document).ready(function(e) {
    var t = 290;
    var n = 240;
    var r = jQuery(window).width() / 2 + t;
    var i = jQuery(window).width() / 2 + n;
    jQuery(".colored-header").css("right", r);
    jQuery(".colored-header-triangle").css("right", i);
    jQuery("select").change(function() {
        window.location = jQuery(this).find("option:selected").val()
    });
    jQuery(".content-container").css("margin-top", jQuery(window).height());
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    var s = jQuery(window).width();
    jQuery(window).resize(function() {
        var e = jQuery(window).width()
    })
});
jQuery(window).load(function() {
    var e = jQuery(window).width();
    jQuery(window).resize(function() {
        var e = jQuery(window).width()
    });
    if (e > 1024) {
        jQuery("#contact-slider").orbit({
            fluid: "16x5",
            timer: false,
            directionalNav: false,
            bullets: true,
            bulletThumbs: true,
            bulletThumbLocation: ""
        });
        jQuery("#news-slider").orbit({
            fluid: "16x12",
            timer: false,
            directionalNav: false,
            bullets: true,
            bulletThumbs: true,
            bulletThumbLocation: ""
        })
    } else {
        if (e > 765) {
            jQuery("#contact-slider").orbit({
                fluid: "16x6",
                timer: false,
                directionalNav: false,
                bullets: true,
                bulletThumbs: true,
                bulletThumbLocation: ""
            });
            jQuery("#news-slider").orbit({
                fluid: "16x23",
                timer: false,
                directionalNav: false,
                bullets: true,
                bulletThumbs: true,
                bulletThumbLocation: ""
            })
        }
    }
})