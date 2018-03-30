function domik_gmap(){
    jQuery('.domik_gmap').each(function(){
        var map = jQuery(this);
        var q = map.attr("data-latitude"), r = map.attr("data-longitude"), s = map.attr("data-location"), z = map.attr("data-zoom"), i = map.attr("data-marker");
        map.gMap({
            latitude: q,
            longitude: r,
            zoom: parseInt(z),
            maptype: "ROADMAP",
            markers: [ {
                latitude: q,
                longitude: r,
                html: s,
                popup: false,
                icon: {
                    image: i,
                    iconsize: [ 40, 40 ],
                    iconanchor: [ 40, 40 ]
                }
            } ]
        });
    });

}
