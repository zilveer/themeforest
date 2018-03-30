jQuery(document).ready(function(){
    var blog_widget_id, blog_offset;
        
    jQuery('.module-classic-blog').on('click','.load-more.active',function(){
        if(jQuery(this).hasClass('no-more')){
            jQuery(this).find('.load-more-text').text(loadbuttonstring.nomoreString);
            return;
        }
        var $this = jQuery(this);
        blog_widget_id = jQuery(this).parents('.module-classic-blog').attr('id');
        blog_entries_loadmore = parseInt(jQuery('#'+blog_widget_id+' .bk-entries-loadmore').text());
        if (blog_widget_id == null) {blog_entries_loadmore = 4;};
        blog_offset = $(this).siblings('.js-classic-blog').find('.item').length;
        //console.log(blog_offset);

        jQuery('.load-more').removeClass('active');
        jQuery(this).addClass('ajax-loading');
        jQuery(this).find('.load-more-text').text(loadbuttonstring.loadingString);
        blog_cat_id = jQuery(this).attr('class').split(' ')[0];
     
        if(jQuery(this).siblings('.bk-classic-blog-content').hasClass('bk-classic-small')){
            size = 'small';
        }else if(jQuery(this).siblings('.bk-classic-blog-content').hasClass('bk-classic-big')){
            size = 'big';
        }

        if(jQuery(this).parents('.classic-blog-post').hasClass('blog-video')){
            display = 'video';
        }else if(jQuery(this).parents('.classic-blog-post').hasClass('blog-thumbnail')){
            display = 'thumbnail';
        }
        var $container = jQuery(this).siblings('.bk-classic-blog-content');        
        var data = {
				action			: 'bk_blog_load_post',
                post_offset     : blog_offset,
                postperpage     : blog_entries_loadmore,
                cat_id          : blog_cat_id,
                size            : size,
                display         : display,
			};

		jQuery.post( ajaxurl, data, function( respond ){
            var el = jQuery(respond);
            respond_length = el.find('article').length;
             $container.imagesLoaded(function(){
                setTimeout(function() {
                    $container.append(el);
                    jQuery('.load-more').addClass('active');
                    jQuery('.load-more').removeClass('ajax-loading');
                    $this.find('.load-more-text').text(loadbuttonstring.loadmoreString);
                    if(respond_length < blog_entries_loadmore){
                        $this.find('.load-more-text').text(loadbuttonstring.nomoreString);
                        $this.addClass('no-more');
                    }
                    
                    var canvasArray  = $(el).find('.rating-canvas');
                    //console.log(canvasArray);
                    $.each(canvasArray, function(i,canvas){
                        //console.log(canvas);
                        var percent = $(canvas).data('rating');
                        var ctx     = canvas.getContext('2d');
                        //console.log($(canvas).parent());
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
                }, 500);
                
             });
            
        });
   });
});