jQuery(document).ready(function($) {
    "use strict";

    $( ".field-favemenutype select" ).change(checkmenu);
    
    function checkmenu() {

        $(".field-favemenutype select").each(function()
        {
            var menuval = $(this).val();

            if( menuval == '3' ) {
                   $(this).parent().next("p").show();
                   $(this).parent().next().next("p").show();
              } else { 
                   $(this).parent().next("p").hide();
                   $(this).parent().next().next("p").hide();
              }
        });

    }


    jQuery('#page_template').change(checkFormat);


    $('#post-formats-select input').change(checkpostFormat);
    
    function checkpostFormat(){
        var format = $('#post-formats-select input:checked').attr('value');
        
        //only run on the posts page
        if(typeof format != 'undefined'){
            
            $('#post-body div[id^=fave_format_]').hide();
            $('#post-body #fave_format_'+format+'').stop(true,true).fadeIn(500);
        }
    }

    function checkFormat(){

        var format = jQuery('#page_template').attr('value');
        
        //only run on the posts page
        if(format == 'template/tpl-vc-latest-articles.php') {
            jQuery('#fave_homepage_latest_articles').stop(true,true).fadeIn(500);
            jQuery('#fave_homepage_loop_filter').stop(true,true).fadeIn(500);
            jQuery('#fave_default_sidebar').hide();

        } else {
            jQuery('#fave_homepage_latest_articles').hide();
            jQuery('#fave_homepage_loop_filter').hide();
        }

        if( format == 'template/tpl-authors.php' ) {
            jQuery('#fave_author_template').stop(true,true).fadeIn(500);
        } else {
            jQuery('#fave_author_template').hide();
        }

        if(format == 'template/tpl-vc-sidebar.php' || format == 'default' || format == 'template/tpl-authors.php'){
            jQuery('#fave_default_sidebar').stop(true,true).fadeIn(500);

        } else {
            jQuery('#fave_default_sidebar').hide();
        }

    }

    jQuery(window).load(function(){ 
        checkpostFormat();
        checkFormat();
        checkmenu();
    });



	$('#fave_final_score').attr('readonly', true);
    $("#favethemes_review .inside .rwmb-meta-box > div:gt(1)").wrapAll('<div class="fave-enabled-review">');
    $('.fave-enabled-review > div:gt(3):odd:lt(6)').each(function() {
        $(this).prev().addBack().wrapAll($('<div/>',{'class': 'fave-criteria'}));
    });

    var faveReviewCheckbox = $('#fave_review_checkbox'),
    faveReviewBox = $('.fave-enabled-review');

    if ( faveReviewCheckbox.is(":checked") ) {
            faveReviewBox.show();
        }

    faveReviewCheckbox.click(function(){
        faveReviewBox.slideToggle('slow');
    });

    function faveScoreCalc() {

        var i = 0;
        var fave_cs1 = parseFloat($('input[name=fave_cs1]').val());
        var fave_cs2 = parseFloat($('input[name=fave_cs2]').val());
        var fave_cs3 = parseFloat($('input[name=fave_cs3]').val());
        var fave_cs4 = parseFloat($('input[name=fave_cs4]').val());
        var fave_cs5 = parseFloat($('input[name=fave_cs5]').val());
        var fave_cs6 = parseFloat($('input[name=fave_cs6]').val());
        if (fave_cs1) { i+=1; } else { fave_cs1 = 0; }
        if (fave_cs2) { i+=1; } else { fave_cs2 = 0; }
        if (fave_cs3) { i+=1; } else { fave_cs3 = 0; }
        if (fave_cs4) { i+=1; } else { fave_cs4 = 0; }
        if (fave_cs5) { i+=1; } else { fave_cs5 = 0; }
        if (fave_cs6) { i+=1; } else { fave_cs6 = 0; }

        var faveTempTotal = (fave_cs1 + fave_cs2 + fave_cs3 + fave_cs4 + fave_cs5 + fave_cs6);
        var faveTotal = Math.round(faveTempTotal / i);

        $("#fave_final_score").val(faveTotal);

        if ( isNaN(faveTotal) ) { $("#fave_final_score").val(''); }

    } // end faveScoreCalc

    $('#fave_cs1, #fave_cs2, #fave_cs3, #fave_cs4, #fave_cs5, #fave_cs6').on('slidechange', faveScoreCalc);

    faveReviewCheckbox.after('<label for="fave_review_checkbox"></label>');
	
});