(function($) {

    $(document).ready(function($){

        // Infinite page scroll in timeline page
        timelineScroll();

    });

    function timelineScroll(){
        // check if we are in timeline page
        if ( $( 'ol#timeline' ).length ){
            var count = 2;
            var total = Math.ceil(dynData.total_results / localData.posts_per_page);
            var cat   = dynData.category;
            $(window).scroll(function(){
                if(Math.abs ( $(document).height() - $(window).scrollTop() - $(window).height() ) < 2 ){
                    if (count > total){
                        return false;
                    }
                    else {
                        loadArticle(count, cat);
                        count++;
                    }
                }
            });
        }
    }

    function loadArticle(pageNumber, cat){
        $.post( localData.ajaxurl,
            {
                action   :'infinite_scroll',
                nonce    : localData.nonce,
                page_no  : pageNumber,
                category : cat
            },
            function( html ){
                $("ol#timeline").append(html);   // This will be the div where our content will be loaded
            }
        );
        return false;
    }
})(jQuery);