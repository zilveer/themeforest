jQuery(document).ready(function(){
	"use strict";
	function runNow(select_data,p,theme){
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action': 'sample',
                'select_data':  select_data,
                'theme' : theme
            },
            success: function(data, textStatus, XMLHttpRequest){
                jQuery('.cs_process_width').css({
                    'width':p+'%',
                    '-webkit-transition':'width 1s',
                    'transition':'width 1s'
                });
                jQuery('#msg .status').text(' Loading '+p+'%');
                if(isNaN(select_data)){
                    jQuery('#msg').parent().css('width','100%');
                    jQuery('#msg').append(data);
                }
                if(select_data=='grid'){
                    p+=5;
                    runNow(15,p,theme);
                }
                if(select_data>1 && select_data<16){
                    runNow(select_data-1,p+5,theme);
                }
                if(select_data==1){
                    runNow(16,100,theme);
                }
                if(select_data==16){
                    jQuery('#msg').parent().css('width','100%');
                    jQuery('#msg .status').html('');
                    jQuery('#msg').append(data);
                }
            }
        });
    }
    jQuery('#sample').click(function(){
        var r = confirm("Are you want import the demo data?");
        if (r == true) {
            jQuery('.cs_process').show();
            var theme = jQuery("#theme").val();
            jQuery(this).attr('disabled','true');
            jQuery('#msg .status').html('&nbsp;Loading&nbsp;');
            var p = 0;
            var arr = ["widget","slider","grid"];
            arr.forEach(function(entry){
                p+=5;
                runNow(entry,p,theme);
            });
        }
    });
});