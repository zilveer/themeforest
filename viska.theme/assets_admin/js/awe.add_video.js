(function($, document, window, undefined)
{

    "user strict"; 

    

    $.AWE_MEDIA = $.AWE_MEDIA || {};

    var returnUrl;

    $.AWE_MEDIA.init =  function(options)
    {
        var oDefaults = 
        {
            url      : "",
            targetClass   : ".te-use-media",
            redata: {}
        }

        var $options = $.extend( {}, oDefaults, options);
        

        $.AWE_MEDIA.setup($options);
    }

    $.AWE_MEDIA = 
    {
        setup: function($options)
        {
            this.init($options);
        },

        init: function($options)
        {
           
            var $url = $options.url;

            var $img =    $.AWE_MEDIA.excu_parse($url);
            return $img;
            
        },

        excu_parse: function(getUrl)
        {   
            var getUrl , img={};
               
            
                
                if ( $.AWE_MEDIA.is_youtube(getUrl) )
                {
                    return $.AWE_MEDIA.get_background_youtube(getUrl);
                }else if( $.AWE_MEDIA.is_vimeo(getUrl) )
                {
                    return $.AWE_MEDIA.get_background_vimdeo(getUrl);
                }else{
                    alert("Are you kidding me");
                }

               

        },

        get_background_youtube : function(url) 
        {
            var id = url.match("[\\?&]v=([^&#]*)"),ivalue={},img='', data;
            ivalue={'type':'youtube','src':'//www.youtube.com/embed/'+id[1],'image':'http://i.ytimg.com/vi/'+id[1]+'/hqdefault.jpg'};
            
            img = [
                  '<img width="128" height="128" src="'+ivalue['image']+'">',
                  ];
            youtube=[ivalue.id];

            data = {image:img.join(""), src: ivalue.src, type: 'youtube', poster: ivalue.image};
            
            return data;
        },

        get_background_vimdeo: function(url) 
        {   
            if(url.search('channels') != -1)
            {
                var id_vimeo,m = url.match(/^.+vimeo.com\/channels\/(.*\/)?([^#\?]*)/),ivalue={},img='', vimeo, xdata={};
            }else{
                var id_vimeo,m = url.match(/^.+vimeo.com\/(.*\/)?([^#\?]*)/),ivalue={},img='', vimeo, xdata={};
            }
            id_vimeo = m ? m[2] || m[1] : null;
           
            if(id_vimeo!=undefined)
            {
                return {type: 'vimeo', id_vimeo: id_vimeo};             
            }else alert('Can not get Vimeo ID');


        },

        is_youtube: function(url)
        {
            // var matches = url.match(/youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)/);
            if (url.indexOf('youtube.com') > -1)
                return true;
            if (url.indexOf('youtu.be') > -1)
                return true;
            return false;
        },
        
        is_vimeo: function(url)
        {
            if(url.indexOf('vimeo.com') > -1)
                return true
            return false;
        }

    }

// $("input.media-add-video").get_video();

})(jQuery, document, window)
