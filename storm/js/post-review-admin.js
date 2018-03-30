jQuery(document).ready(function($){
    $('#bk_final_score').attr('readonly', true);
    $('#bk_review .inside .rwmb-meta-box > div:gt(0)').wrapAll('<div class="bk-enabled-review">');
    $('.bk-enabled-review > div:gt(0):even:lt(6)').each(function() {
        $(this).prev().addBack().wrapAll($('<div/>',{'class': 'bk-criteria'}));
    });
    var bkReviewCheckbox = $('#bk_review_checkbox'),
    bkReviewBox = $('.bk-enabled-review');

    if ( bkReviewCheckbox.is(":checked") ) {
            bkReviewBox.show();
        }
        
    bkReviewCheckbox.click(function(){
        bkReviewBox.slideToggle('slow');
    });
    function bkAvrScore() { 
        var i = 0;
        var bk_cs1=0, bk_cs2=0, bk_cs3=0, bk_cs4=0, bk_cs5=0, bk_cs6=0;
        
        var bk_ct1 = $('input[name=bk_ct1]').val();
        var bk_ct2 = $('input[name=bk_ct2]').val();
        var bk_ct3 = $('input[name=bk_ct3]').val();
        var bk_ct4 = $('input[name=bk_ct4]').val();
        var bk_ct5 = $('input[name=bk_ct5]').val();
        var bk_ct6 = $('input[name=bk_ct6]').val();          
        if (bk_ct1) { i+=1; bk_cs1 = parseFloat($('input[name=bk_cs1]').val()); } else { bk_ct1 = null; }
        if (bk_ct2) { i+=1; bk_cs2 = parseFloat($('input[name=bk_cs2]').val()); } else { bk_ct2 = null; }
        if (bk_ct3) { i+=1; bk_cs3 = parseFloat($('input[name=bk_cs3]').val()); } else { bk_ct3 = null; }
        if (bk_ct4) { i+=1; bk_cs4 = parseFloat($('input[name=bk_cs4]').val()); } else { bk_ct4 = null; }
        if (bk_ct5) { i+=1; bk_cs5 = parseFloat($('input[name=bk_cs5]').val()); } else { bk_ct5 = null; }
        if (bk_ct6) { i+=1; bk_cs6 = parseFloat($('input[name=bk_cs6]').val()); } else { bk_ct6 = null; }
        
        var bkTempTotal = (bk_cs1 + bk_cs2 + bk_cs3 + bk_cs4 + bk_cs5 + bk_cs6);
        
        bk_author_score = parseFloat($('input[name=bk_author_score]').val());
        if ((bk_author_score == 0) || (bk_author_score == null)) {
            var bkTotal = Math.round((bkTempTotal / i)*10)/10;            
        }else {
            var bkTotal = bk_author_score;
        }
        
        
        $("#bk_final_score").val(bkTotal);
        
        if ( isNaN(bkTotal) ) { $("#bk_final_score").val(''); }
    }
    $('.rwmb-input').on('change', bkAvrScore);
    $('#bk_cs1, #bk_cs2, #bk_cs3, #bk_cs4, #bk_cs5, #bk_cs6, #bk_author_score').on('slidechange', bkAvrScore);
});