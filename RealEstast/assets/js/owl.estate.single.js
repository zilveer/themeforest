jQuery(function($){
    $(document).ready(function() {
        var sync1 = $("#pic-detail");
        var sync2 = $("#pic-control");

        sync1.owlCarousel({
            singleItem : true,
            navigation: false,
            pagination:false,
            lazyLoad: true,
            autoHeight : true,
            transitionStyle: "fade",
            afterAction : syncPosition
        });

        sync2.owlCarousel({
            items : 9,
            itemsDesktop : [1199,9],
            itemsDesktopSmall : [979,7],
            itemsTablet : [768,8],
            itemsMobile : [479,4],
            pagination:false,
            responsiveRefreshRate : 100,
            afterInit : function(el){
                el.find(".owl-item").eq(0).addClass("selected");
            }
        });

        function syncPosition(el){
            var current = this.currentItem;
            $("#pic-control").find(".owl-item").removeClass("selected").eq(current).addClass("selected");
            if($("#pic-control").data("owlCarousel") !== undefined){
                center(current)
            }
        }

        $("#pic-control").on("click", ".owl-item", function(e){
            e.preventDefault();
            if(!$(this).hasClass("selected")){
                var number = $(this).data("owlItem");
                sync1.trigger("owl.goTo",number);
            }
        });

        function center(number){
            var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
            var num = number;
            var found = false;
            for(var i in sync2visible){
                if(num === sync2visible[i]){
                    found = true;
                }
            }

            if(found===false){
                if(num>sync2visible[sync2visible.length-1]){
                    sync2.trigger("owl.goTo", num - sync2visible.length+2)
                }else{
                    if(num - 1 === -1){
                        num = 0;
                    }
                    sync2.trigger("owl.goTo", num);
                }
            } else if(num === sync2visible[sync2visible.length-1]){
                sync2.trigger("owl.goTo", sync2visible[1])
            } else if(num === sync2visible[0]){
                sync2.trigger("owl.goTo", num-1)
            }
        }
    });
});
