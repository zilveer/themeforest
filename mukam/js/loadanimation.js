// ANIMATION 2
// ======================
jQuery(document).ready(function() {
    var body = jQuery('body');
    jQuery(window).load(function() {
        body.toggleClass('on off');
        jQuery('.on_off').click(function() {
            body.toggleClass('on off');
            setTimeout(function() {
                body.toggleClass('on off');
            }, 1000)
        });
    });  
    var transitionDelay=0;
    function findMaxYLValue(){
        var max=0;elArray=[];
        jQuery('*[class*="anim_"]').each(function(){
            var animValue=jQuery(this).attr('class').split(" ");
            var i,value;
            for(i=0;i<animValue.length;++i){
                value=animValue[i];if(value.substring(0,5)==="anim_"){
                    elArray.push(value.substring(5));
                    break;
                    }}});
            var maxValue='.anim_'+Math.max.apply(Math,elArray),maxValueEl=jQuery(maxValue).first();
            maxValueEl.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(e){
            var transitionDelayValue=maxValueEl.css("transition-delay");
            transitionDelay=Math.ceil(parseFloat(transitionDelayValue.substring(0,transitionDelayValue.length-1)*500)*1)/1;
            });}findMaxYLValue();jQuery('body').on('click','.trigger',function(e){
            e.preventDefault();
            body.toggleClass('on off');
            var link=jQuery(this).attr('href');
            setTimeout(function(){
            location.href=link;},transitionDelay);
    });
});