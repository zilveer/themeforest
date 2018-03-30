jQuery.noConflict();
jQuery(document).ready(function() {    


jQuery('#show-toolbar').click(function(){ 
      jQuery(this).hide()
      jQuery(this).next('#hide-toolbar').show();
      jQuery("#toolbar").animate({left: '0'}, "slow");																																															
})
jQuery('#hide-toolbar').click(function(){ 
      jQuery(this).hide()
      jQuery(this).prev('#show-toolbar').show();
      jQuery("#toolbar").animate({left: '-150px'}, "slow");																																															
})


});

function changeBGTiled(tempValue){
	jQuery('#origami-slider').css("background", "url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/" + tempValue +")");
	jQuery('body').css("background","repeat");
}
function changeBGFull(tempValue,tempHex){
	jQuery('#origami-slider').css("background-image", "url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/" + tempValue +")");
	jQuery('#page-title').css("background-image", "url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/" + tempValue +")");
}

function changeCSS(tempValue){
	jQuery('head').append('<link rel="stylesheet" href="http://origami.gothemeteam.com/wp-content/themes/origami/js/toolbar/'+tempValue+'" type="text/css"/>');
}
var pad = function(num, totalChars) {
    var pad = '0';
    num = num + '';
    while (num.length < totalChars) {
        num = pad + num;
    }
    return num;
};

// Ratio is between 0 and 1
var changeColor = function(color, ratio, darker) {
    var difference = Math.round(ratio * 255) * (darker ? -1 : 1),
        decimal    = color.replace(
            /^#?([a-z0-9][a-z0-9])([a-z0-9][a-z0-9])([a-z0-9][a-z0-9])/i,
            function() {
                return parseInt(arguments[1], 16) + ',' +
                    parseInt(arguments[2], 16) + ',' +
                    parseInt(arguments[3], 16);
            }
        ).split(/,/);
    return [
        '#',
        pad(Math.max(parseInt(decimal[0], 10) + difference, 0).toString(16), 2),
        pad(Math.max(parseInt(decimal[1], 10) + difference, 0).toString(16), 2),
        pad(Math.max(parseInt(decimal[2], 10) + difference, 0).toString(16), 2)
    ].join('');
};
var lighterColor = function(color, ratio) {
    return changeColor(color, ratio, false);
};
var darkerColor = function(color, ratio) {
    return changeColor(color, ratio, true);
};

// Use
