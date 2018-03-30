(function ($) {
    
    $(function () {      
        
        var data = QueryString();  
        
        if (data.action=='unsubscribe_request' && data.email){

	        var subscribeDialog = document.getElementById( 'subscribeDialog' ),
		        subscribeDlg = new DialogFx(subscribeDialog);

            jQuery.post(ajaxurl, data, function(response) {
                response = jQuery.parseJSON(response);
	            var message = '';

                if (response.is_errors) {
	                message = response.is_errors;
                } else {
	                message = response.info;
                }

                $(subscribeDialog).find('.message').text(message);
                subscribeDlg.toggle(subscribeDlg);
            });
        }              
        
        $('.subscription-form').submit(function() {
            SubscribeSubmit(this);
		    return false;
	    });
    });    
    
    function QueryString(){
        
        var query_string = {},
        query = window.location.search.substring(1),    
        vars = query.split('&');
        
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            
            if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = pair[1];             
            } else if (typeof query_string[pair[0]] === "string") {
                var arr = [ query_string[pair[0]], pair[1] ];
                query_string[pair[0]] = arr;                
            } else {
              query_string[pair[0]].push(pair[1]);
            }
        }
        return query_string;
    }
    
    function SubscribeSubmit($this){
        
        $response = $($this).find(jQuery(".subscription_form_responce"));
	    $response.find("ul").html("");
	    $response.find("ul").removeClass();
        
        var data = {
            action: "subscribe_request",
            values: $($this).serialize()
        };
        jQuery.post(ajaxurl, data, function(response) {            
            response = jQuery.parseJSON(response);
            if (response.is_errors) {
                $($this).find(".subscription_form_responce ul").addClass("error type-2").append('<li>' + response.is_errors + '</li>');
                $response.show(450);
            } else {
                $($this).find(".subscription_form_responce ul").addClass("success type-2").append('<li>' + response.info + '</li>');
                $response.show(450).delay(1800).hide(400);
            }         
            
        });        
        
    }

}(jQuery));


