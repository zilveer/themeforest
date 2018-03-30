jQuery(document).ready(function(){
    var widget_id, offset;
    
    jQuery('.module-masonry').on('click','.load-more.active',function(){
        if(jQuery(this).hasClass('no-more')){
            jQuery(this).find('.load-more-text').text(loadbuttonstring.nomoreString);
            return;
        }
        var $this = jQuery(this);
        widget_id = jQuery(this).parents('.module-masonry').attr('id');
                
        entries_loadmore = parseInt(jQuery('#'+widget_id+' .bk-entries-loadmore').text());
        if (widget_id == null) {entries_loadmore = 4;};
        offset = $(this).siblings('.js-masonry').find('.item').length;   
                
        jQuery('.load-more').removeClass('active');
        jQuery(this).addClass('ajax-loading');
        jQuery(this).find('.load-more-text').text(loadbuttonstring.loadingString);
        cat_id = jQuery(this).attr('class').split(' ')[0];
        display = jQuery(this).parents('.masonry-post').attr('id');
          
        var $container = jQuery(this).siblings('.bk-masonry-content');        
        var data = {
				action			: 'bk_load_post',
                post_offset     : offset,
                postperpage     : entries_loadmore,
                cat_id          : cat_id,
                display         : display,
			};
        
		jQuery.post( ajaxurl, data, function( respond ){
            var el = jQuery(respond);
            respond_length = el.find('article').length;
            $container.append(el).masonry( 'appended', el );
            $container.imagesLoaded(function(){
                setTimeout(function() {
        			var postionscroll = jQuery(window).scrollTop();
                        $container.masonry('destroy');
                        $container.masonry({
                            itemSelector: '.item',
                            columnWidth: 1,
                            isAnimated: true,
                            isFitWidth: true,
                         });
        			window.scrollTo(0,postionscroll);
        			jQuery($container).find('.post-details').removeClass('hide');
                    jQuery('.load-more').addClass('active');
                    $this.removeClass('ajax-loading');
                    $this.find('.load-more-text').text(loadbuttonstring.loadmoreString);
                    $container.find('.item').addClass('bordered');
                    if(respond_length < entries_loadmore){
                        $this.find('.load-more-text').text(loadbuttonstring.nomoreString);
                        $this.addClass('no-more');
                    } 
                }, 500);
                var canvasArray  = el.find('.rating-canvas');
                $.each(canvasArray, function(i,canvas){
                    var percent = $(canvas).data('rating');
                    var ctx     = canvas.getContext('2d');
        
                    canvas.width  = $(canvas).parent().width();
                    canvas.height = $(canvas).parent().height();
                    if ($(canvas).parent().hasClass('rating-wrap')) {
                        lineWidth = 2;
                    } else {
                        lineWidth = 4;
                    }
          
                    var x = (canvas.width) / 2;
                    var y = (canvas.height) / 2;
                    if ($(canvas).parent().hasClass('rating-wrap')) {
                        radius = (canvas.width - 6) / 2;
                    } else {
                        radius = (canvas.width - 10) / 2;
                    }
                            
                    var endAngle = (Math.PI * percent * 2 / 100);
                    ctx.beginPath();
                    ctx.arc(x, y, radius, -(Math.PI/180*90), endAngle - (Math.PI/180*90), false);   
                    ctx.lineWidth = lineWidth;
                    ctx.strokeStyle = "#fff";
                    ctx.stroke(); 
                });
            });

        });
    });
});