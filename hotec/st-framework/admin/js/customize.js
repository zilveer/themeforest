jQuery(document).ready(function(){
    
    // set auto hieght for slect  chosen
   jQuery(".customize-section-content .customize-control-select select").chosen().each(function () {
    var  p = jQuery(this).parents('.customize-control-select');
    var gp = jQuery(this).parents('.customize-section-content');
        jQuery(this).on("liszt:showing_dropdown", function (c) {
           //  alert('open');
            var id=  c.target.id;
           var h = jQuery('#'+id+'_chzn .chzn-drop',p).height();
               p.animate({
                    height: '+='+h
                    },0,function(){  
                    }) ;
          // console.log(id);
        })
        .on('liszt:hiding_dropdown',function(c){

             var id=  c.target.id;
           var h = jQuery('#'+id+'_chzn .chzn-drop',p).height();
            p.removeAttr('style');
           /*
               p.animate({
                    height: '-='+h
                    },100,function(){  
                       
                    }) ;
                    */
        });
    });

});