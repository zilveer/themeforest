jQuery(function($){      
	var themeurl = template_url+'/loopHandler.php';    
    var $content = $("body .grid.pinterest");  	
	var $load_button = $('.grid.pinterest #load_more');		
	
	var limit = parseInt($load_button.attr('data-limit'));
	var categories_to_display = $load_button.attr('data-cats');
	var tp_page_pingrid_excerpt = $load_button.attr('data-excerpt');
	var tp_page_pingrid_review = $load_button.attr('data-review');
	var tp_page_pingrid_date = $load_button.attr('data-date');
	var tp_page_pingrid_comm = $load_button.attr('data-comm');
	var tp_page_pingrid_commtxt = $load_button.attr('data-commtxt');
	var tp_page_pingrid_author = $load_button.attr('data-author');
		
	
	
    var load_posts = function(){  
		$load_button = $('.grid.pinterest #load_more');		
		offset = parseInt($load_button.attr('data-offset')) + limit;	//current + limit
				
            $.ajax({  
                type       : "GET",  
                data       : {offset : offset,categories_to_display : categories_to_display,tp_page_pingrid_excerpt : tp_page_pingrid_excerpt,tp_page_pingrid_review : tp_page_pingrid_review,tp_page_pingrid_date : tp_page_pingrid_date,tp_page_pingrid_comm : tp_page_pingrid_comm,tp_page_pingrid_commtxt : tp_page_pingrid_commtxt,tp_page_pingrid_author : tp_page_pingrid_author},  
                dataType   : "html",  
                url        : themeurl,
				cache: false,
                beforeSend : function(){                      
					$load_button.html('<img id="pinloading" src="'+template_url+'/images/loading.gif" />');                      
                },  
                success    : function(data){                  					
                    if(data.length){  
						$load_button.remove();					                        
						$content.append(data).masonry('reload');  						
						$('body .grid.pinterest .loaded').hide();
						$('body .grid.pinterest .loaded').fadeIn(500);
						
                    } else {  
                        $load_button.remove();
                    }  
                },  
                error     : function(jqXHR, textStatus, errorThrown) {  
                    $load_button.remove();  
                    alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);  
                }  
        });  
    }  
    $('.grid').on('click','#load_more a',function(event) {  		
		
		load_posts();  
		event.preventDefault();
    });  
    
});  