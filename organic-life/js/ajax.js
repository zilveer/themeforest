/*global $:false */

jQuery(document).ready(function($){'use strict';

   $('#download').on('click',function(e){
      e.preventDefault();
      
      var ajaxurl = $(this).data('url');
         $.ajax({
        url: ajaxurl,
        data: {
            'action':'themeum_free_download',
            'fruit' : fruit
        },
        success:function(data) {
            // This outputs the result of the ajax request
            console.log(data);
        },
        error: function(errorThrown){
            console.log(errorThrown);
        }
    });  

   });

});

