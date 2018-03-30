jQuery(document).ready(function(){
	"use strict";
	
	setTimeout(function(){
		wd_yith_compare_add_temp_div();
	},1000);
});
function wd_yith_compare_add_temp_div(){
	var _yith_compare_wrapper = jQuery('.DTFC_ScrollWrapper')
	var _div_html = '<div class="wd_scroll_wrapper" style="position: fixed; bottom: 0; overflow-x: auto;"><div class="wd_scroll_content" style="display: inline-block;"></div></div>';
	_yith_compare_wrapper.append(_div_html);
	var _div_temp = _yith_compare_wrapper.find(".wd_scroll_wrapper");
	var _left = parseInt(_yith_compare_wrapper.find(".dataTables_scroll").css("left").replace(/px/gi,"")) + parseInt(jQuery(".dataTables_wrapper").css("padding-left")) + 2;
	_div_temp.css({
		width: _yith_compare_wrapper.find(".dataTables_scroll .dataTables_scrollBody").width()
		,height: scrollbarWidth+"px"
		,left: _left+"px"
	});
	_yith_compare_wrapper.find(".dataTables_scroll .dataTables_scrollBody").css({"overflow":"hidden"});
	_div_temp.find(".wd_scroll_content").css({
		width: _yith_compare_wrapper.find(".dataTables_scroll .dataTables_scrollBody table").width()
	});
	_div_temp.scroll(function(){
		_yith_compare_wrapper.find(".dataTables_scrollBody").scrollLeft(jQuery(this).scrollLeft());
	});
}
function scrollbarWidth() {
    var $inner = jQuery('<div style="width: 100%; height:200px;">test</div>'),
        $outer = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
        inner = $inner[0],
        outer = $outer[0];
     
    jQuery('body').append(outer);
    var width1 = inner.offsetWidth;
    $outer.css('overflow', 'scroll');
    var width2 = outer.clientWidth;
    $outer.remove();
 
    return (width1 - width2);
}
